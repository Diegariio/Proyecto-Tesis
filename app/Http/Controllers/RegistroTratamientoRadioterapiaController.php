<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegistroTratamientoRadioterapia;
use App\Models\Paciente;
use App\Models\CodigoGES;
use App\Models\CodigoTratamiento;
use App\Models\ZonaIrradiada;
use App\Models\QuimioterapiaConcominante;
use App\Models\CodigoCie10;
use App\Models\Radioterapeuta;

class RegistroTratamientoRadioterapiaController extends Controller
{
    public function create(Request $request)
    {
        // Validaciones similares al controlador de gestión de casos
        $request->validate([
            'fecha_ingreso_inicio' => 'nullable|date|before_or_equal:fecha_ingreso_fin',
            'fecha_ingreso_fin' => 'nullable|date|after_or_equal:fecha_ingreso_inicio',
            'rut_paciente' => 'nullable|regex:/^[0-9]{1,2}\.[0-9]{3}\.[0-9]{3}-[0-9kK]$/',
            'nombres' => 'nullable|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/|min:2|max:50',
            'primer_apellido' => 'nullable|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s-]+$/|min:2|max:50',
            'segundo_apellido' => 'nullable|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s-]+$/|min:2|max:50',
            'numero_archivo' => 'nullable|string|max:50',
        ]);

        // Buscar directamente en la tabla paciente con funcionalidad completa
        $pacientes = collect();

        // Buscar si hay cualquier filtro aplicado (restaurar funcionalidad original)
        $filtrosAplicados = $request->filled('fecha_ingreso_inicio') || 
                           $request->filled('fecha_ingreso_fin') || 
                           $request->filled('rut_paciente') || 
                           $request->filled('nombres') || 
                           $request->filled('primer_apellido') || 
                           $request->filled('segundo_apellido') || 
                           $request->filled('numero_archivo');

        \Log::info('DEBUG - Filtros de tratamiento:', [
            'filtrosAplicados' => $filtrosAplicados,
            'request_data' => $request->all(),
            'rut_paciente_filled' => $request->filled('rut_paciente'),
            'nombres_filled' => $request->filled('nombres'),
            'primer_apellido_filled' => $request->filled('primer_apellido'),
            'segundo_apellido_filled' => $request->filled('segundo_apellido'),
            'numero_archivo_filled' => $request->filled('numero_archivo')
        ]);

        if ($filtrosAplicados) {
            // Buscar directamente en la tabla paciente con las relaciones necesarias
            $query = Paciente::with(['sexo', 'comuna', 'servicio']);

            // Filtro por RUT (exacto)
            if ($request->filled('rut_paciente')) {
                $query->where('rut', $request->input('rut_paciente'));
            }

            // Filtros por nombres (LIKE - búsqueda parcial)
            if ($request->filled('nombres')) {
                $query->where('nombre', 'LIKE', '%' . $request->input('nombres') . '%');
            }

            if ($request->filled('primer_apellido')) {
                $query->where('primer_apellido', 'LIKE', '%' . $request->input('primer_apellido') . '%');
            }

            if ($request->filled('segundo_apellido')) {
                $query->where('segundo_apellido', 'LIKE', '%' . $request->input('segundo_apellido') . '%');
            }

            if ($request->filled('numero_archivo')) {
                $query->where('numero_archivo', 'LIKE', '%' . $request->input('numero_archivo') . '%');
            }

            $resultados = $query->get();

            // Formatear resultados para la vista (directamente desde paciente)
            $pacientes = $resultados->map(function($paciente) {
                return [
                    'rut' => $paciente->rut,
                    'paciente' => $paciente->nombre . ' ' . 
                                $paciente->primer_apellido . ' ' . 
                                $paciente->segundo_apellido,
                    'n_archivo' => $paciente->numero_archivo,
                    'sexo' => $paciente->sexo ? $paciente->sexo->sexo : 'N/A'
                ];
            });
            
            \Log::info('Resultados de búsqueda:', [
                'total_pacientes' => $resultados->count(),
                'primer_paciente' => $pacientes->first()
            ]);
        }

        // Cargar datos para los selects del modal
        $codigosGes = CodigoGES::all();
        $codigosTratamiento = CodigoTratamiento::all();
        $zonasIrradiadas = ZonaIrradiada::all();
        $quimioterapias = QuimioterapiaConcominante::all();
        $codigosCie10 = CodigoCie10::all();
        $radioterapeutas = Radioterapeuta::all();

        return view('tratamientos.registroTratamientoRadioterapia', compact(
            'pacientes', 
            'codigosGes', 
            'codigosTratamiento', 
            'zonasIrradiadas', 
            'quimioterapias', 
            'codigosCie10', 
            'radioterapeutas'
        ));
    }

    public function validarRut(Request $request)
    {
        $rut = $request->input('rut');
        
        // Validar formato de RUT chileno
        if (!$this->validarFormatoRut($rut)) {
            return response()->json([
                'valido' => false,
                'mensaje' => 'Formato de RUT inválido'
            ]);
        }
        
        // Validar que existe en BD
        $paciente = Paciente::where('rut', $rut)->first();
        if (!$paciente) {
            return response()->json([
                'valido' => false,
                'mensaje' => 'RUT no encontrado en la base de datos'
            ]);
        }
        
        return response()->json([
            'valido' => true,
            'mensaje' => 'RUT válido',
            'paciente' => [
                'nombre' => $paciente->nombre,
                'apellidos' => $paciente->primer_apellido . ' ' . $paciente->segundo_apellido
            ]
        ]);
    }

    public function obtenerDatosPaciente(Request $request)
    {
        $rut = $request->input('rut');
        
        if (!$rut) {
            return response()->json([
                'success' => false,
                'mensaje' => 'RUT no proporcionado'
            ]);
        }
        
        $paciente = Paciente::with(['sexo', 'comuna', 'servicio'])
                           ->where('rut', $rut)
                           ->first();
        
        if ($paciente) {
            return response()->json([
                'success' => true,
                'paciente' => [
                    'rut' => $paciente->rut,
                    'nombre' => $paciente->nombre . ' ' . $paciente->primer_apellido . ' ' . $paciente->segundo_apellido,
                    'sexo' => $paciente->sexo ? $paciente->sexo->sexo : 'N/A',
                    'comuna' => $paciente->comuna ? $paciente->comuna->comuna : 'N/A',
                    'servicio_salud' => $paciente->servicio ? $paciente->servicio->servicio_de_salud : 'N/A'
                ]
            ]);
        } else {
            return response()->json([
                'success' => false,
                'mensaje' => 'Paciente no encontrado'
            ]);
        }
    }

    private function validarFormatoRut($rut)
    {
        // Limpiar el RUT (solo números y K)
        $rut = preg_replace('/[^0-9kK]/', '', $rut);
        
        if (strlen($rut) < 2) return false;
        
        // Separar número y dígito verificador
        $dv = substr($rut, -1);        // Último carácter (DV)
        $numero = substr($rut, 0, -1); // Todo menos el último (número)
        
        // Calcular DV esperado
        $i = 2;
        $suma = 0;
        
        // Multiplicar cada dígito por su peso (de derecha a izquierda)
        foreach (array_reverse(str_split($numero)) as $v) {
            if ($i == 8) $i = 2; // Los pesos van de 2 a 7, luego se repiten
            $suma += $v * $i;
            ++$i;
        }
        
        // Calcular DV
        $dvEsperado = 11 - ($suma % 11);
        
        // Casos especiales
        if ($dvEsperado == 11) $dvEsperado = '0';
        if ($dvEsperado == 10) $dvEsperado = 'K';
        else $dvEsperado = (string)$dvEsperado;
        
        // Comparar
        return strtoupper($dv) == $dvEsperado;
    }
    public function store(Request $request)
    {
        try {
            // 1. Validación
            $validatedData = $request->validate([
                'rut_paciente_modal' => 'required|regex:/^[0-9]{1,2}\.[0-9]{3}\.[0-9]{3}-[0-9kK]$/|exists:paciente,rut',
                'id_codigo_ges' => 'required|exists:tron_codigo_ges,id_codigo_ges',
                'id_codigo_tratamiento' => 'required|exists:tron_codigo_tratamiento,id_codigo_tratamiento',
                'id_zona' => 'required|exists:tron_zona_irradiada,id_zona',
                'id_quimioterapia_concominante' => 'required|exists:tron_quimioterapia_concominante,id_quimioterapia_concominante',
                'id_codigo' => 'required|exists:codigo_cie10,id_codigo',
                'id_radioterapeuta' => 'required|exists:tron_radioterapeuta,id_radioterapeuta',
                'n_sesiones_programadas' => 'required|integer|min:1|max:40',
                'intencion' => 'required|string|in:Curativo,Paliativo',
                'fecha_inicio' => 'required|date',
                'fecha_termino' => 'required|date|after:fecha_inicio',
                'fecha_indicacion' => 'required|date|before_or_equal:fecha_inicio',
                'cobertura_ges' => 'required|boolean',
                'horario_tratamiento' => 'required|string|in:Diurno,Vespertino',
                'observaciones' => 'nullable|string|max:1000',
            ]);

            // 2. Preparar datos para guardar
            $datosGuardar = [
                'rut' => $validatedData['rut_paciente_modal'],
                'id_codigo_ges' => $validatedData['id_codigo_ges'],
                'id_codigo_tratamiento' => $validatedData['id_codigo_tratamiento'],
                'id_zona' => $validatedData['id_zona'],
                'id_quimioterapia_concominante' => $validatedData['id_quimioterapia_concominante'],
                'id_codigo' => $validatedData['id_codigo'],
                'id_radioterapeuta' => $validatedData['id_radioterapeuta'],
                'n_sesiones_programadas' => $validatedData['n_sesiones_programadas'],
                'intencion' => $validatedData['intencion'],
                'fecha_inicio' => $validatedData['fecha_inicio'],
                'fecha_termino' => $validatedData['fecha_termino'],
                'fecha_simulacion_tratamiento' => $validatedData['fecha_inicio'], // Por ahora igual a fecha inicio
                'fecha_indicacion' => $validatedData['fecha_indicacion'],
                'cobertura_ges' => $validatedData['cobertura_ges'],
                'horario_tratamiento' => $validatedData['horario_tratamiento'],
                'observaciones' => $validatedData['observaciones'] ?? null,
            ];

            // 3. Crear y guardar el tratamiento
            $tratamiento = RegistroTratamientoRadioterapia::create($datosGuardar);

            // 4. Respuesta exitosa
            return response()->json([
                'success' => true,
                'mensaje' => 'Tratamiento registrado correctamente',
                'id_tratamiento' => $tratamiento->id_registro_tratamiento
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'mensaje' => 'Error de validación',
                'errores' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Error al guardar tratamiento: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'mensaje' => 'Error interno del servidor'
            ], 500);
        }
    }
}
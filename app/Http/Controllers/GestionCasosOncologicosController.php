<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegistroRequerimiento;
use App\Models\Categoria;
use App\Models\CodigoCie10;
use App\Models\EntidadQueResuelve;
use App\Models\Requerimiento;
use App\Models\Responsable;
use App\Models\Paciente;

class GestionCasosOncologicosController extends Controller
{

    public function gestionCasosOncologicos(Request $request)
    {
        $request->validate([
            'fecha-desde' => 'nullable|date|before_or_equal:fecha-hasta',
            'fecha-hasta' => 'nullable|date|after_or_equal:fecha-desde',
            'fecha-proxima-revision' => 'nullable|date',
            'rut-paciente' => 'nullable|regex:/^[0-9]{1,2}\.[0-9]{3}\.[0-9]{3}-[0-9kK]$/',
            'nombres' => 'nullable|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/|min:2|max:50',
            'primer-apellido' => 'nullable|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s-]+$/|min:2|max:50',
            'segundo-apellido' => 'nullable|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s-]+$/|min:2|max:50',
            'categoria' => 'nullable|exists:categoria,id_categoria',
            'cie10' => 'nullable|exists:codigo_cie10,id_codigo',
            'entidad' => 'nullable|exists:entidad_que_resuelve,id_entidad',
            'requerimiento' => 'nullable|exists:requerimiento,id_requerimiento',
            'responsable' => 'nullable|exists:responsable,id_responsable', // NUEVO: Validar responsable
        ]);
    
        // Cargar TODAS las relaciones necesarias
        $query = RegistroRequerimiento::with([
            'paciente',
            'responsable',    // Ya está cargado
            'codigo',
            'requerimiento',
            'categoria',
            'entidad',
            'emisor'
        ]);
    
        // Filtro por RUT (prioridad alta)
        if ($request->filled('rut-paciente')) {
            $query->where('rut', $request->input('rut-paciente'));
        }
        // Filtros por nombres (cuando no hay RUT)
        else {
            $rutsEncontrados = collect();
            
            // Buscar pacientes por nombres
            $pacientesQuery = Paciente::query();
            
            if ($request->filled('nombres')) {
                $pacientesQuery->where('nombre', 'LIKE', '%' . $request->input('nombres') . '%');
            }
            
            if ($request->filled('primer-apellido')) {
                $pacientesQuery->where('primer_apellido', 'LIKE', '%' . $request->input('primer-apellido') . '%');
            }
            
            if ($request->filled('segundo-apellido')) {
                $pacientesQuery->where('segundo_apellido', 'LIKE', '%' . $request->input('segundo-apellido') . '%');
            }
            
            // Si se aplicaron filtros de nombres, obtener los RUTs
            if ($request->filled('nombres') || $request->filled('primer-apellido') || $request->filled('segundo-apellido')) {
                $rutsEncontrados = $pacientesQuery->pluck('rut');
                
                if ($rutsEncontrados->count() > 0) {
                    $query->whereIn('rut', $rutsEncontrados);
                } else {
                    // Si no se encontraron pacientes, retornar resultados vacíos
                    $query->where('rut', 'INEXISTENTE');
                }
            }
        }
    
        // Filtros por fechas de creación
        if ($request->filled('fecha-desde')) {
            $query->whereDate('created_at', '>=', $request->input('fecha-desde'));
        }
    
        if ($request->filled('fecha-hasta')) {
            $query->whereDate('created_at', '<=', $request->input('fecha-hasta'));
        }
    
        // Filtro por fecha próxima revisión
        if ($request->filled('fecha-proxima-revision')) {
            $query->whereDate('fecha_proxima_revision', $request->input('fecha-proxima-revision'));
        }
    
        // Filtro por categoría
        if ($request->filled('categoria')) {
            $query->where('id_categoria', $request->input('categoria'));
        }
    
        // Filtro por código CIE10
        if ($request->filled('cie10')) {
            $query->where('id_codigo', $request->input('cie10'));
        }
    
        // Filtro por entidad que resuelve
        if ($request->filled('entidad')) {
            $query->where('id_entidad', $request->input('entidad'));
        }
    
        // Filtro por requerimiento
        if ($request->filled('requerimiento')) {
            $query->where('id_requerimiento', $request->input('requerimiento'));
        }
    
        // NUEVO: Filtro por responsable
        if ($request->filled('responsable')) {
            $query->where('id_responsable', $request->input('responsable'));
        }
    
        $resultados = $query->get();
    
        // Debugging mejorado
        $debugData = [
            'sql' => $query->toSql(),
            'bindings' => $query->getBindings(),
            'request_data' => $request->all(),
            'resultados_count' => $resultados->count(),
            'primer_registro' => $resultados->first() ? [
                'id' => $resultados->first()->id,
                'rut' => $resultados->first()->rut,
                'id_categoria' => $resultados->first()->id_categoria,
                'id_codigo' => $resultados->first()->id_codigo,
                'id_entidad' => $resultados->first()->id_entidad,
                'id_requerimiento' => $resultados->first()->id_requerimiento,
                'id_responsable' => $resultados->first()->id_responsable, // NUEVO
                'fecha_proxima_revision' => $resultados->first()->fecha_proxima_revision,
                'requerimiento_relation' => $resultados->first()->requerimiento,
                'responsable_relation' => $resultados->first()->responsable,
                'codigo_relation' => $resultados->first()->codigo,
                'entidad_relation' => $resultados->first()->entidad,
                'requerimiento_nombre' => $resultados->first()->requerimiento->requerimiento ?? 'N/A',
                'responsable_nombre' => $resultados->first()->responsable->responsable ?? 'N/A' // NUEVO
            ] : null
        ];
    
        // Cargar datos para dropdowns
        $categorias = Categoria::all();
        $codigo = CodigoCie10::all();
        $entidades = EntidadQueResuelve::all();
        $requerimientos = Requerimiento::all();
        $responsables = Responsable::all();
    
        return view('gestionOncologica.gestionCasosOncologicos', compact(
            'resultados',
            'categorias',
            'codigo',
            'entidades',
            'requerimientos',
            'responsables',
            'debugData'
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
            'apellidos' => $paciente->apellidos
        ]
    ]);
}

private function validarFormatoRut($rut)
{
    // 1. Limpiar el RUT (solo números y K)
    $rut = preg_replace('/[^0-9kK]/', '', $rut);
    
    if (strlen($rut) < 2) return false;
    
    // 2. Separar número y dígito verificador
    $dv = substr($rut, -1);        // Último carácter (DV)
    $numero = substr($rut, 0, -1); // Todo menos el último (número)
    
    // 3. Calcular DV esperado
    $i = 2;
    $suma = 0;
    
    // Multiplicar cada dígito por su peso (de derecha a izquierda)
    foreach (array_reverse(str_split($numero)) as $v) {
        if ($i == 8) $i = 2; // Los pesos van de 2 a 7, luego se repiten
        $suma += $v * $i;
        ++$i;
    }
    
    // 4. Calcular DV
    $dvEsperado = 11 - ($suma % 11);
    
    // Casos especiales
    if ($dvEsperado == 11) $dvEsperado = '0';
    if ($dvEsperado == 10) $dvEsperado = 'K';
    else $dvEsperado = (string)$dvEsperado;
    
    // 5. Comparar
    return strtoupper($dv) == $dvEsperado;
}
}

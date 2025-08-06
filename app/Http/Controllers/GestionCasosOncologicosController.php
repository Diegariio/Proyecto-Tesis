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
use App\Models\EmisorRequerimiento;
use App\Models\Tiene;
use App\Models\GestionRequerimiento;
use App\Models\ResolucionComite;
use App\Models\Gestion;
use App\Models\Respuesta;

class GestionCasosOncologicosController extends Controller
{
    public function obtenerCie10PorRut(Request $request)
    {
        $request->validate([
            'rut' => 'required|regex:/^[0-9]{1,2}\.[0-9]{3}\.[0-9]{3}-[0-9kK]$/'
        ]);

        $rut = $request->input('rut');

        // Buscar los códigos CIE10 asociados al RUT a través de la tabla 'tiene'
        $codigosCie10 = Tiene::where('rut', $rut)
            ->with('codigo:id_codigo,codigo_cie10,descripcion')
            ->get()
            ->pluck('codigo')
            ->unique('id_codigo')
            ->values();

        return response()->json([
            'success' => true,
            'codigos' => $codigosCie10
        ]);
    }
    public function gestionCasosOncologicos(Request $request)
    {
        $request->validate([
            'fecha-desde' => 'nullable|date|before_or_equal:fecha-hasta',
            'fecha-hasta' => 'nullable|date|after_or_equal:fecha-desde',
            'fecha-proxima-revision' => 'nullable|date',
            'rut-paciente' => 'nullable|regex:/^[0-9]{1,2}\.[0-9]{3}\.[0-9]{3}-[0-9kK]$/',
            'numero-archivo' => 'nullable|string|max:8',
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
            'emisor',
            'gestiones'       // Necesario para calcular el estado_actual
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
            
            if ($request->filled('numero-archivo')) {
                $pacientesQuery->where('numero_archivo', 'LIKE', '%' . $request->input('numero-archivo') . '%');
            }
            
            // Si se aplicaron filtros de nombres, obtener los RUTs
            if ($request->filled('nombres') || $request->filled('primer-apellido') || $request->filled('segundo-apellido') || $request->filled('numero-archivo')) {
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
    
        // Filtro por responsable
        if ($request->filled('responsable')) {
            $query->where('id_responsable', $request->input('responsable'));
        }
    
        // Solo ejecutar la consulta si hay algún filtro aplicado (restaurar funcionalidad original)
        $hayFiltros = $request->filled('fecha-desde') || 
                      $request->filled('fecha-hasta') || 
                      $request->filled('fecha-proxima-revision') || 
                      $request->filled('rut-paciente') ||
                      $request->filled('nombres') || 
                      $request->filled('primer-apellido') || 
                      $request->filled('segundo-apellido') || 
                      $request->filled('categoria') || 
                      $request->filled('cie10') ||
                      $request->filled('entidad') || 
                      $request->filled('requerimiento') || 
                      $request->filled('responsable') || 
                      $request->filled('numero-archivo');
        
        \Log::info('DEBUG - Filtros aplicados:', [
            'hayFiltros' => $hayFiltros,
            'rut-paciente' => $request->input('rut-paciente'),
            'rut-paciente_filled' => $request->filled('rut-paciente')
        ]);
        
        if ($hayFiltros) {
            $resultados = $query->get();
            \Log::info('DEBUG - Consulta ejecutada:', [
                'sql' => $query->toSql(),
                'bindings' => $query->getBindings(),
                'resultados_count' => $resultados->count()
            ]);
        } else {
            $resultados = collect(); // Colección vacía cuando no hay RUT
            \Log::info('DEBUG - Sin RUT aplicado, devolviendo colección vacía');
        }
    
        // Debugging mejorado
        $debugData = [
            'sql' => $hayFiltros ? $query->toSql() : 'No se ejecutó consulta - sin filtros',
            'bindings' => $hayFiltros ? $query->getBindings() : [],
            'request_data' => $request->all(),
            'hay_filtros' => $hayFiltros,
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
        $emisores = EmisorRequerimiento::all();
    
        return view('gestionOncologica.gestionCasosOncologicos', compact(
            'resultados',
            'categorias',
            'codigo',
            'entidades',
            'requerimientos',
            'responsables',
            'emisores',
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
                'apellidos' => $paciente->primer_apellido . ' ' . $paciente->segundo_apellido
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

public function buscarPacientePorRut(Request $request)
{
    $rut = $request->input('rut') ?? $request->query('rut');
    
    \Log::info('Buscando paciente con RUT: ' . $rut);
    
    if (!$rut) {
        return response()->json([
            'success' => false,
            'mensaje' => 'RUT no proporcionado'
        ]);
    }
    
    $paciente = Paciente::where('rut', $rut)->first();
    
    \Log::info('Paciente encontrado: ' . ($paciente ? 'SÍ' : 'NO'));
    
    if ($paciente) {
        return response()->json([
            'success' => true,
            'paciente' => [
                'rut' => $paciente->rut,
                'nombre' => $paciente->nombre,
                'apellidos' => $paciente->primer_apellido . ' ' . $paciente->segundo_apellido,
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
public function infoCasoOncologico(Request $request)
{
    $rut = $request->query('rut');
    $tienes = \App\Models\Tiene::where('rut', $rut)->with('codigo')->get();

    $diagnosticos = $tienes->map(function($tiene) {
        $resolucion = \App\Models\ResolucionComite::where('id_tiene', $tiene->id_tiene)->first();
        return [
            'codigo' => $tiene->codigo->codigo_cie10 ?? '',
            'descripcion' => $tiene->codigo->descripcion ?? '',
            'resolucion_comite' => $resolucion ? $resolucion->resolucion_comite : 'Sin resolución'
        ];
    });

    return response()->json([
        'success' => true,
        'diagnosticos' => $diagnosticos
    ]);
}
public function obtenerDetallesRequerimiento($idRegistro)
{
    try {
        $registro = RegistroRequerimiento::with([
            'paciente.comuna',
            'paciente.sexo',
            'paciente.servicio',
            'categoria',
            'responsable',
            'requerimiento',
            'entidad',
            'emisor',
            'cierre'
        ])->find($idRegistro);
        
        if (!$registro) {
            return response()->json([
                'success' => false,
                'mensaje' => 'Requerimiento no encontrado'
            ]);
        }
        
        // Información del paciente
        $paciente = [
            'rut' => $registro->paciente->rut,
            'nombre' => $registro->paciente->nombre . ' ' . $registro->paciente->primer_apellido . ' ' . $registro->paciente->segundo_apellido,
            'sexo' => $registro->paciente->sexo ? $registro->paciente->sexo->sexo : 'N/A',
            'comuna' => $registro->paciente->comuna ? $registro->paciente->comuna->comuna : 'N/A',
            'servicio_salud' => $registro->paciente->servicio ? $registro->paciente->servicio->servicio_de_salud : 'N/A'
        ];
        
        // Información del requerimiento
        $requerimiento = [
            'fecha_formateada' => $registro->fecha ? \Carbon\Carbon::parse($registro->fecha)->format('d/m/Y') : 'N/A',
            'responsable' => $registro->responsable ? $registro->responsable->responsable : 'N/A',
            'categoria' => $registro->categoria ? $registro->categoria->tipo_categoria : 'N/A',
            'requerimiento' => $registro->requerimiento ? $registro->requerimiento->requerimiento : 'N/A',
            'emisor' => $registro->emisor ? $registro->emisor->catalogo : 'N/A',
            'entidad' => $registro->entidad ? $registro->entidad->catalogo : 'N/A',
            'resolucion_caso' => $registro->cierre ? $registro->cierre->catalogo_cierre ?? 'N/A' : '------', // Mostrar cierre si existe
            'fecha_proxima_revision_formateada' => $registro->fecha_proxima_revision ? \Carbon\Carbon::parse($registro->fecha_proxima_revision)->format('d/m/Y') : 'N/A',
            'observaciones' => $registro->observaciones ?? 'N/A',
            'esta_cerrado' => $registro->id_cierre_requerimiento !== null, // Información sobre si está cerrado
            'id_cierre_requerimiento' => $registro->id_cierre_requerimiento, // ID del cierre si existe
            'estado_actual' => $registro->estado_actual, // Estado calculado
        ];
        
        return response()->json([
            'success' => true,
            'paciente' => $paciente,
            'requerimiento' => $requerimiento
        ]);
        
    } catch (\Exception $e) {
        \Log::error('Error al obtener detalles del requerimiento: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'mensaje' => 'Error interno del servidor'
        ]);
    }
}
public function diagnosticoResolucion($id)
{
    $registro = RegistroRequerimiento::find($id);
    if (!$registro) {
        return response()->json(['diagnostico' => '', 'resolucion' => '']);
    }
    $cie10 = odigoCie10::find($registro->id_codigo);
    $diagnostico = $cie10 ? ($cie10->codigo_cie10 . ' - ' . $cie10->descripcion) : '';
    $tiene = Tiene::where('rut', $registro->rut)->where('id_codigo', $registro->id_codigo)->first();
    $resolucion = '';
    if ($tiene) {
        $res = ResolucionComite::where('id_tiene', $tiene->id_tiene)->first();
        $resolucion = $res ? $res->resolucion_comite : '';
    }
    return response()->json(['diagnostico' => $diagnostico, 'resolucion' => $resolucion]);
}
public function guardarGestionRequerimiento(Request $request)
{
    try {
        // Validar los datos de entrada
        $request->validate([
            'id_registro_requerimiento' => 'required|integer',
            'fecha_gestion' => 'required|date',
            'id_gestion' => 'required|integer',
            'id_respuesta' => 'nullable|integer'
        ]);

        $idRegistro = $request->input('id_registro_requerimiento');
        $fechaGestion = $request->input('fecha_gestion');
        $idGestion = $request->input('id_gestion');
        $idRespuesta = $request->input('id_respuesta');

        // Buscar el registro de requerimiento
        $registro = \App\Models\RegistroRequerimiento::find($idRegistro);
        if (!$registro) {
            return response()->json(['success' => false, 'message' => 'Registro de requerimiento no encontrado']);
        }

        \Log::info('Registro encontrado:', [
            'id' => $registro->id_registro_requerimiento,
            'rut' => $registro->rut,
            'id_codigo' => $registro->id_codigo
        ]);

        // Crear la gestión de requerimiento directamente
        // No necesitamos buscar en la tabla "tiene" para este proceso
        $gestionRequerimiento = new \App\Models\GestionRequerimiento();
        $gestionRequerimiento->id_registro_requerimiento = $idRegistro;
        $gestionRequerimiento->id_gestion = $idGestion;
        $gestionRequerimiento->id_respuesta = $idRespuesta; // Puede ser null
        $gestionRequerimiento->fecha_gestion = $fechaGestion;
        $gestionRequerimiento->estado_gestion = 'PENDIENTE'; // Valor por defecto
        // El campo 'respuesta' (texto) se deja null por ahora
        $gestionRequerimiento->save();

        \Log::info('Gestión de requerimiento guardada:', [
            'id_gestion_requerimiento' => $gestionRequerimiento->id_gestion_requerimiento,
            'id_registro_requerimiento' => $idRegistro,
            'id_gestion' => $idGestion,
            'id_respuesta' => $idRespuesta,
            'fecha_gestion' => $fechaGestion
        ]);

        return response()->json(['success' => true, 'message' => 'Gestión guardada correctamente']);

    } catch (\Exception $e) {
        \Log::error('Error al guardar gestión: ' . $e->getMessage());
        return response()->json(['success' => false, 'message' => 'Error interno del servidor: ' . $e->getMessage()]);
    }
}

public function opcionesGestion()
{
    $gestiones = Gestion::all(['id_gestion', 'gestion']);
    
    return response()->json([
        'success' => true,
        'gestiones' => $gestiones
    ]);
}

public function opcionesRespuesta()
{
    $respuestas = Respuesta::all(['id_respuesta', 'catalogo_respuestas']);
    
    // Mapear el campo para que el frontend reciba 'respuesta'
    $respuestasFormateadas = $respuestas->map(function($respuesta) {
        return [
            'id_respuesta' => $respuesta->id_respuesta,
            'respuesta' => $respuesta->catalogo_respuestas
        ];
    });
    
    return response()->json([
        'success' => true,
        'respuestas' => $respuestasFormateadas
    ]);
}

public function obtenerGestionesRequerimiento($idRegistroRequerimiento)
{
    try {
        $gestiones = \App\Models\GestionRequerimiento::where('id_registro_requerimiento', $idRegistroRequerimiento)
            ->with(['gestion:id_gestion,gestion', 'respuesta:id_respuesta,catalogo_respuestas'])
            ->orderBy('fecha_gestion', 'desc')
            ->get();

        $gestionesFormateadas = $gestiones->map(function($gestion) {
            return [
                'id_gestion_requerimiento' => $gestion->id_gestion_requerimiento,
                'estado_gestion' => $gestion->estado_gestion,
                'fecha_gestion' => $gestion->fecha_gestion ? \Carbon\Carbon::parse($gestion->fecha_gestion)->format('Y-m-d') : '',
                'fecha_gestion_formateada' => $gestion->fecha_gestion ? \Carbon\Carbon::parse($gestion->fecha_gestion)->format('d/m/Y') : 'N/A',
                'gestion' => $gestion->gestion ? $gestion->gestion->gestion : 'N/A',
                'respuesta' => $gestion->respuesta ? $gestion->respuesta->catalogo_respuestas : null,
                'respuesta_texto' => $gestion->respuesta ? $gestion->respuesta->catalogo_respuestas : null,
                'tiene_respuesta' => $gestion->tieneRespuesta()
            ];
        });

        return response()->json([
            'success' => true,
            'gestiones' => $gestionesFormateadas
        ]);

    } catch (\Exception $e) {
        \Log::error('Error al obtener gestiones: ' . $e->getMessage());
        return response()->json([
            'success' => false, 
            'message' => 'Error al cargar las gestiones: ' . $e->getMessage()
        ]);
    }
}

public function actualizarRespuestaGestion(Request $request)
{
    try {
        // Validar los datos de entrada
        $request->validate([
            'id_gestion_requerimiento' => 'required|integer',
            'id_respuesta' => 'required|integer'
        ]);

        $idGestionRequerimiento = $request->input('id_gestion_requerimiento');
        $idRespuesta = $request->input('id_respuesta');

        // Buscar la gestión de requerimiento
        $gestionRequerimiento = \App\Models\GestionRequerimiento::find($idGestionRequerimiento);
        if (!$gestionRequerimiento) {
            return response()->json([
                'success' => false, 
                'message' => 'Gestión de requerimiento no encontrada'
            ]);
        }

        // Actualizar la respuesta
        $gestionRequerimiento->id_respuesta = $idRespuesta;
        $saved = $gestionRequerimiento->save();

        \Log::info('Respuesta actualizada para gestión:', [
            'id_gestion_requerimiento' => $idGestionRequerimiento,
            'id_respuesta' => $idRespuesta,
            'guardado_exitoso' => $saved,
            'tiene_respuesta_despues' => $gestionRequerimiento->tieneRespuesta()
        ]);

        return response()->json([
            'success' => true, 
            'message' => 'Respuesta añadida correctamente'
        ]);

    } catch (\Exception $e) {
        \Log::error('Error al actualizar respuesta: ' . $e->getMessage());
        return response()->json([
            'success' => false, 
            'message' => 'Error interno del servidor: ' . $e->getMessage()
        ]);
    }
}

public function opcionesCierre()
{
    $cierres = \App\Models\CierreRequerimiento::all(['id_cierre_requerimiento', 'catalogo_cierre']);
    
    return response()->json([
        'success' => true,
        'cierres' => $cierres
    ]);
}

public function cerrarRequerimiento(Request $request)
{
    try {
        // Validar los datos de entrada
        $request->validate([
            'id_registro_requerimiento' => 'required|integer',
            'id_cierre_requerimiento' => 'required|integer|exists:cierre_requerimiento,id_cierre_requerimiento'
        ]);

        $idRegistro = $request->input('id_registro_requerimiento');
        $idCierre = $request->input('id_cierre_requerimiento');

        // Buscar el registro de requerimiento
        $registro = \App\Models\RegistroRequerimiento::find($idRegistro);
        if (!$registro) {
            return response()->json([
                'success' => false, 
                'message' => 'Registro de requerimiento no encontrado'
            ]);
        }

        // Verificar que no esté ya cerrado
        if ($registro->id_cierre_requerimiento !== null) {
            return response()->json([
                'success' => false, 
                'message' => 'Este requerimiento ya está cerrado'
            ]);
        }

        // Verificar que todas las gestiones tengan respuesta
        $gestionesSinRespuesta = \App\Models\GestionRequerimiento::where('id_registro_requerimiento', $idRegistro)
            ->whereNull('id_respuesta')
            ->count();

        if ($gestionesSinRespuesta > 0) {
            return response()->json([
                'success' => false, 
                'message' => 'No se puede cerrar el requerimiento. Hay gestiones sin respuesta.'
            ]);
        }

        // Cerrar el requerimiento
        $registro->id_cierre_requerimiento = $idCierre;
        $registro->save();

        \Log::info('Requerimiento cerrado:', [
            'id_registro_requerimiento' => $idRegistro,
            'id_cierre_requerimiento' => $idCierre
        ]);

        return response()->json([
            'success' => true, 
            'message' => 'Requerimiento cerrado correctamente'
        ]);

    } catch (\Exception $e) {
        \Log::error('Error al cerrar requerimiento: ' . $e->getMessage());
        return response()->json([
            'success' => false, 
            'message' => 'Error interno del servidor: ' . $e->getMessage()
        ]);
    }
}
}

@extends('layouts.app')

@section('title', 'Gestión de Requerimientos')


@section('content')
<h1 class="h4">
    <i class="fas fa-notes-medical me-2"></i>
    Gestión de Casos Oncológicos
</h1>
@if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif
    <div class="card mt-4">
    <div class="card-header bg-light">
        <h5 class="mb-0 text-primary">
            <i class="fas fa-search me-2"></i>Filtro de búsqueda
        </h5>
    </div>
        <div class="card-body">
            <form method="GET" action="{{ route('gestionCasosOncologicos') }}">
                <div class="row g-2">
                    <div class="form-group col-md-3">
                        <label for="fecha-desde" class="form-label">Fecha desde</label>
                        <input type="date" id="fecha-desde" name="fecha-desde" class="form-control" value="{{ request('fecha-desde') }}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="fecha-hasta" class="form-label">Fecha hasta</label>
                        <input type="date" id="fecha-hasta" name="fecha-hasta" class="form-control" value="{{ request('fecha-hasta') }}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="numero-archivo" class="form-label">N° Archivo</label>
                        <input type="text" id="numero-archivo" name="numero-archivo" class="form-control" placeholder="12345678" maxlength="8" value="{{ request('numero-archivo') }}">
                    </div>
                    <div class="form-group col-md-3" id="grut">
                        <label for="rut-paciente" class="form-label">RUT Paciente</label>
    <div class="position-relative">
        <input type="text" id="rut-paciente" name="rut-paciente" 
               class="form-control" placeholder="12.345.678-9" 
               maxlength="12" value="{{ request('rut-paciente') }}">
        <div class="position-absolute top-0 end-0 h-100 d-flex align-items-center pe-3">
            <i class="fas fa-check text-success" id="iconrut" style="display: none;"></i>
        </div>
    </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="nombres" class="form-label">Nombres</label>
                        <input type="text" id="nombres" name="nombres" class="form-control" value="{{ request('nombres') }}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="primer-apellido" class="form-label">Primer Apellido</label>
                        <input type="text" id="primer-apellido" name="primer-apellido" class="form-control" value="{{ request('primer-apellido') }}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="segundo-apellido" class="form-label">Segundo Apellido</label>
                        <input type="text" id="segundo-apellido" name="segundo-apellido" class="form-control" value="{{ request('segundo-apellido') }}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="categoria" class="form-label">Categoría</label>
                        <select id="categoria" name="categoria" class="form-select">
                            <option value="">Seleccionar categoría</option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id_categoria }}" {{ request('categoria') == $categoria->id_categoria ? 'selected' : '' }}>
                                    {{ $categoria->tipo_categoria }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="cie10" class="form-label">CIE 10</label>
                        <select id="cie10" name="cie10" class="form-select">
                            <option value="">Seleccionar CIE 10</option>
                            @foreach($codigo as $codigo)
                                <option value="{{ $codigo->id_codigo }}" {{ request('cie10') == $codigo->id_codigo ? 'selected' : '' }}>
                                    {{ $codigo->codigo_cie10 }} - {{ $codigo->descripcion }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="entidad" class="form-label">Entidad que resuelve</label>
                        <select id="entidad" name="entidad" class="form-select">
                            <option value="">Seleccionar entidad</option>
                            @foreach($entidades as $entidad)
                                <option value="{{ $entidad->id_entidad }}" {{ request('entidad') == $entidad->id_entidad ? 'selected' : '' }}>
                                    {{ $entidad->catalogo }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="requerimiento" class="form-label">Requerimiento</label>
                        <select id="requerimiento" name="requerimiento" class="form-select">
                            <option value="">Seleccionar requerimiento</option>
                            @foreach($requerimientos as $req)
                                <option value="{{ $req->id_requerimiento }}" {{ request('requerimiento') == $req->id_requerimiento ? 'selected' : '' }}>
                                    {{ $req->requerimiento }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="fecha-revision" class="form-label">Fecha próxima revisión</label>
                        <input type="date" id="fecha-revision" name="fecha-revision" class="form-control" value="{{ request('fecha-revision') }}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="responsable" class="form-label">Responsable</label>
                        <select id="responsable" name="responsable" class="form-select">
                            <option value="">Seleccionar responsable</option>
                            @foreach($responsables as $res)
                                <option value="{{ $res->id_responsable }}" {{ request('responsable') == $res->id_responsable ? 'selected' : '' }}>
                                    {{ $res->responsable }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                            <!-- Botones de acción -->
            <div class="d-flex flex-wrap gap-2 mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-filter"></i> Filtrar
                </button>
                
                <button type="button" class="btn btn-secondary">
                    <i class="fas fa-eraser"></i> Limpiar
                </button>
                
                <button type="button" class="btn btn-success" id="btn-agregar-requerimiento" disabled style="opacity: 0.5; pointer-events: none;">
                        <i class="fas fa-plus-circle"></i> Agregar Nuevo Requerimiento
                </button>
            </div>
            </form>
        </div>
    </div>

    @if($resultados->count() > 0)
    <!-- TÍTULO DE RESULTADOS -->
        <div class="card mt-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <i class="fas fa-search me-2"></i>
                    Resultados de la búsqueda ({{ $resultados->count() }} registros encontrados)
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-hover text-nowrap mb-0">
                        <thead>
                            <tr>
                                <th>Acciones</th>
                                <th>RUT Paciente</th>
                                <th>Nombre Paciente</th>
                                <th>Diagnóstico</th>
                                <th>Fecha Requerimiento</th>
                                <th>Fecha Próxima Revisión</th>
                                <th>Requerimiento</th>
                                <th>Responsable</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($resultados as $index => $registro)
                            <tr>
                                <td>
                                    <button class="btn btn-secondary btn-sm btn-ver-detalles" 
                                            title="Ver detalles" 
                                            data-id="{{ $registro->id_registro_requerimiento }}">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                                <td>{{ $registro->paciente->rut ?? 'N/A' }}</td>
                                <td>
                                    {{ $registro->paciente->nombre ?? '' }} 
                                    {{ $registro->paciente->primer_apellido ?? '' }} 
                                    {{ $registro->paciente->segundo_apellido ?? '' }}
                                </td>
                                <td>
                                    @if($registro->codigo)
                                        {{ $registro->codigo->codigo_cie10 ?? '' }} - 
                                        {{ $registro->codigo->descripcion ?? '' }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>{{ $registro->created_at ? $registro->created_at->format('d/m/Y') : 'N/A' }}</td>
                                <td>
                                    @if($registro->fecha_proxima_revision)
                                        @php
                                            $fecha = \Carbon\Carbon::parse($registro->fecha_proxima_revision);
                                            $hoy = \Carbon\Carbon::now();
                                            $diasRestantes = $hoy->diffInDays($fecha, false);
                                        @endphp
                                        <span class="{{ $diasRestantes <= 7 ? 'text-danger fw-bold' : ($diasRestantes <= 14 ? 'text-warning' : 'text-success') }}">
                                            {{ $fecha->format('d/m/Y') }}
                                            @if($diasRestantes <= 7)
                                                <i class="fas fa-exclamation-triangle ms-1" title="Revisión próxima"></i>
                                            @endif
                                        </span>
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    @if($registro->requerimiento)
                                        {{ $registro->requerimiento->requerimiento ?? 'N/A' }}
                                    @else
                                        N/A (ID: {{ $registro->id_requerimiento }})
                                    @endif
                                </td>
                                <td>
                                    @if($registro->responsable)
                                        {{ $registro->responsable->responsable ?? 'N/A' }}
                                    @else
                                        N/A (ID: {{ $registro->id_responsable }})
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
@else
    <!-- MENSAJE CUANDO NO HAY RESULTADOS -->
    <div class="card mt-4">
        <div class="card-body">
            <div class="alert alert-info mb-0">
                <i class="fas fa-info-circle me-2"></i>
                No se encontraron registros con los filtros aplicados.
            </div>
        </div>
    </div>
@endif

<div class="modal fade" id="modalRequerimiento" tabindex="-1" aria-labelledby="modalRequerimientoLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl"> <!-- Cambiado a modal-xl -->
    <div class="modal-content shadow-lg"> <!-- Sombra extra -->
      <div class="modal-header">
        <h5 class="modal-title" id="modalRequerimientoLabel">Registro de Requerimiento</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
                <!-- Aquí van los recuadros de información y el formulario -->
<div id="info-paciente-modal" class="card mb-3" style="display: none;">
    <div class="card-header bg-primary text-white">
        <h6 class="mb-0">
            <i class="fas fa-user me-2"></i>
            Ficha del Paciente
        </h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-2">
                    <strong>RUT:</strong> <span id="modal-rut"></span>
                </div>
                <div class="mb-2">
                    <strong>Nombre:</strong> <span id="modal-nombre"></span>
                </div>
                <div class="mb-2">
                    <strong>Sexo:</strong> <span id="modal-sexo"></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-2">
                    <strong>Comuna:</strong> <span id="modal-comuna"></span>
                </div>
                <div class="mb-2">
                    <strong>Servicio de Salud:</strong> <span id="modal-servicio"></span>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="info-paciente-error" class="alert alert-danger" style="display: none;">
    Paciente no encontrado.
</div>
        <div id="info-caso" class="mb-3">
          <!-- Recuadro de información del caso oncológico (rellenar con datos) -->
        </div>

        @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif

<h5 class="mb-3 text-primary">
    <i class="fas fa-file-medical me-2"></i>
    Registro del Requerimiento
</h5>

<form id="form-requerimiento" method="POST" action="{{ route('registroRequerimiento.store') }}">
    @csrf
    <input type="hidden" name="rut" id="input-rut-modal">
    
    <!-- Primera fila: Categoría, Emisor del Requerimiento, Fecha del Requerimiento -->
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="categoria-modal" class="form-label">Categoría</label>
            <select name="categoria" id="categoria-modal" class="form-select" required>
                <option value="">Seleccionar categoría</option>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id_categoria }}">{{ $categoria->tipo_categoria }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <label for="emisor-modal" class="form-label">Emisor del Requerimiento</label>
            <select name="emisor" id="emisor-modal" class="form-select" required>
                <option value="">Seleccionar emisor</option>
                @foreach($emisores as $emisor)
                    <option value="{{ $emisor->id_emisor }}">{{ $emisor->catalogo }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <label for="fecha-requerimiento" class="form-label">Fecha del Requerimiento</label>
            <input type="date" name="fecha_requerimiento" id="fecha-requerimiento" class="form-control" required>
        </div>
    </div>
    
    <!-- Segunda fila: Requerimiento, Quien Resuelve, Responsable -->
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="requerimiento-modal" class="form-label">Requerimiento</label>
            <select name="requerimiento" id="requerimiento-modal" class="form-select" required>
                <option value="">Seleccionar requerimiento</option>
                @foreach($requerimientos as $req)
                    <option value="{{ $req->id_requerimiento }}">{{ $req->requerimiento }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <label for="entidad-modal" class="form-label">Quien Resuelve</label>
            <select name="entidad" id="entidad-modal" class="form-select" required>
                <option value="">Seleccionar entidad</option>
                @foreach($entidades as $entidad)
                    <option value="{{ $entidad->id_entidad }}">{{ $entidad->catalogo }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <label for="responsable-modal" class="form-label">Responsable</label>
            <select name="responsable" id="responsable-modal" class="form-select" required>
                <option value="">Seleccionar responsable</option>
                @foreach($responsables as $res)
                    <option value="{{ $res->id_responsable }}">{{ $res->responsable }}</option>
                @endforeach
            </select>
        </div>
    </div>
    
    <!-- Tercera fila: Fecha Próxima Revisión -->
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="fecha-proxima-revision" class="form-label">Fecha Próxima Revisión</label>
            <input type="date" name="fecha_proxima_revision" id="fecha-proxima-revision" class="form-control" required>
            <div class="form-text text-muted">
                <small>Debe ser posterior a la fecha del requerimiento</small>
            </div>
        </div>
    </div>
    
    <!-- Tercera fila: Observaciones (solo al final) -->
    <div class="row mb-3">
        <div class="col-12">
            <label for="observaciones" class="form-label">Observaciones</label>
            <textarea name="observaciones" id="observaciones" class="form-control" rows="3" placeholder="Ingrese observaciones adicionales..."></textarea>
        </div>
    </div>
    
    <!-- Botones -->
    <div class="d-flex justify-content-end gap-2">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            <i class="fas fa-times me-1"></i> Cancelar
        </button>
        <button type="submit" class="btn btn-primary" id="btn-guardar-requerimiento">
            <i class="fas fa-save me-1"></i> Registrar Requerimiento
        </button>
    </div>
</form>
      </div>
    </div>
  </div>
</div>

<!-- Modal para Ver Detalles del Requerimiento -->
<div class="modal fade" id="modalDetallesRequerimiento" tabindex="-1" aria-labelledby="modalDetallesRequerimientoLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content shadow-lg">
      <div class="modal-header">
        <h5 class="modal-title" id="modalDetallesRequerimientoLabel">
          <i class="fas fa-eye me-2"></i>
          Detalles del Requerimiento
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <!-- Ficha del Paciente -->
        <div id="info-paciente-detalles" class="card mb-3" style="display: none;">
          <div class="card-header bg-primary text-white">
            <h6 class="mb-0">
              <i class="fas fa-user me-2"></i>
              Ficha del Paciente
            </h6>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="mb-2">
                  <strong>RUT:</strong> <span id="detalles-rut"></span>
                </div>
                <div class="mb-2">
                  <strong>Nombre:</strong> <span id="detalles-nombre"></span>
                </div>
                <div class="mb-2">
                  <strong>Sexo:</strong> <span id="detalles-sexo"></span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-2">
                  <strong>Comuna:</strong> <span id="detalles-comuna"></span>
                </div>
                <div class="mb-2">
                  <strong>Servicio de Salud:</strong> <span id="detalles-servicio"></span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Información del Requerimiento -->
        <div id="info-requerimiento-detalles" class="card mb-3" style="display: none;">
          <div class="card-header bg-secondary text-white">
            <h6 class="mb-0">
              <i class="fas fa-file-medical me-2"></i>
              Información del Requerimiento
            </h6>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-4">
                <div class="mb-2">
                  <strong>Estado del Requerimiento:</strong><br>
                  <span id="detalles-estado">En gestión</span>
                </div>
                <div class="mb-2">
                  <strong>Fecha del Requerimiento:</strong><br>
                  <span id="detalles-fecha-requerimiento"></span>
                </div>
                <div class="mb-2">
                  <strong>Responsable:</strong><br>
                  <span id="detalles-responsable"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="mb-2">
                  <strong>Categoría:</strong><br>
                  <span id="detalles-categoria"></span>
                </div>
                <div class="mb-2">
                  <strong>Requerimiento:</strong><br>
                  <span id="detalles-requerimiento"></span>
                </div>
                <div class="mb-2">
                  <strong>Fecha de Resolución:</strong><br>
                  <span id="detalles-fecha-resolucion">------</span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="mb-2">
                  <strong>Emisor del Requerimiento:</strong><br>
                  <span id="detalles-emisor"></span>
                </div>
                <div class="mb-2">
                  <strong>¿Quién Resuelve?:</strong><br>
                  <span id="detalles-entidad"></span>
                </div>
                <div class="mb-2">
                  <strong>Resolución del Caso:</strong><br>
                  <span id="detalles-resolucion-caso">------</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Botones de Acción -->
        <div class="d-flex justify-content-end gap-2 mb-3">
          <button type="button" class="btn btn-primary" id="btn-agregar-gestion">
            <i class="fas fa-plus me-1"></i>
            Agregar Gestión
          </button>
          <button type="button" class="btn btn-danger" id="btn-cerrar-requerimiento">
            <i class="fas fa-lock me-1"></i>
            Cerrar Requerimiento
          </button>
        </div>

        <!-- Tabla de Gestiones (placeholder) -->
        <div class="card">
          <div class="card-header bg-light">
            <h6 class="mb-0">
              <i class="fas fa-list me-2"></i>
              Historial de Gestiones
            </h6>
          </div>
          <div class="card-body">
            <div class="alert alert-info mb-0">
              <i class="fas fa-info-circle me-2"></i>
              Aquí se mostrará el historial de gestiones del requerimiento.
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // ===== VARIABLES GLOBALES =====
    const rutInput = document.getElementById('rut-paciente');
    const grut = document.getElementById('grut');
    const iconrut = document.getElementById('iconrut');
    const cie10Select = document.getElementById('cie10');
    const btnAgregar = document.getElementById('btn-agregar-requerimiento');
    
    let timeoutId;
    let rutValidado = false;

    // ===== FORMATEO Y VALIDACIÓN DE RUT =====
    if (rutInput) {
        // Event listener para input
        rutInput.addEventListener('input', function(e) {
            let value = e.target.value;
            let formattedValue = formatearRUT(value);
            
            // Solo actualizar si el valor cambió para evitar loops
            if (formattedValue !== value) {
                e.target.value = formattedValue;
            }
            
            // Resetear validación cuando cambia el RUT
            rutValidado = false;
            resetearEstilo();
            restaurarTodosLosCie10();
            checkFields();
            
            // Validación de RUT después del formateo
            clearTimeout(timeoutId);
            timeoutId = setTimeout(() => {
                validarRut(e.target.value);
            }, 1000);
        });

        // Event listener para paste
        rutInput.addEventListener('paste', function(e) {
            setTimeout(() => {
                let pastedValue = e.target.value;
                let formattedValue = formatearRUT(pastedValue);
                e.target.value = formattedValue;
                
                // Resetear validación
                rutValidado = false;
                resetearEstilo();
                restaurarTodosLosCie10();
                checkFields();
                
                // Validar después del formateo
                clearTimeout(timeoutId);
                timeoutId = setTimeout(() => {
                    validarRut(e.target.value);
                }, 500);
            }, 0);
        });
    }

    // ===== FUNCIONES DE FORMATEO DE RUT =====
    function formatearRUT(input) {
        // Remover todo excepto números y K/k
        let cleanValue = input.replace(/[^\dKk]/g, '');
        
        // Si hay una K o k, asegurar que esté solo al final
        let hasK = /[Kk]/.test(cleanValue);
        let dvChar = '';
        
        if (hasK) {
            // Extraer la K y ponerla al final
            cleanValue = cleanValue.replace(/[Kk]/g, '');
            dvChar = 'K';
        }
        
        // Si no hay K pero hay números, el último número es el DV
        if (!hasK && cleanValue.length > 1) {
            dvChar = cleanValue.slice(-1);
            cleanValue = cleanValue.slice(0, -1);
        } else if (!hasK && cleanValue.length === 1) {
            return cleanValue;
        }
        
        // Si solo tenemos números sin DV, no formatear aún
        if (!dvChar && cleanValue.length <= 8) {
            return cleanValue;
        }
        
        // Formatear el cuerpo del RUT con puntos
        if (cleanValue.length > 0) {
            let formatted = '';
            let reversed = cleanValue.split('').reverse().join('');
            
            for (let i = 0; i < reversed.length; i++) {
                if (i !== 0 && i % 3 === 0) {
                    formatted = '.' + formatted;
                }
                formatted = reversed[i] + formatted;
            }
            
            return formatted + (dvChar ? '-' + dvChar : '');
        } else {
            return dvChar ? '-' + dvChar : '';
        }
    }

    // ===== FUNCIONES DE VALIDACIÓN DE RUT =====
    function validarRut(rut) {
        if (rut.length < 8) {
            resetearEstilo();
            rutValidado = false;
            restaurarTodosLosCie10();
            checkFields();
            return;
        }
        
        fetch('/validar-rut', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ rut: rut })
        })
        .then(response => response.json())
        .then(data => {
            if (data.valido) {
                mostrarExito();
                rutValidado = true;
                obtenerCie10PorRut(rut);
            } else {
                mostrarError(data.mensaje);
                rutValidado = false;
                restaurarTodosLosCie10();
            }
            checkFields();
        })
        .catch(error => {
            mostrarError('Error de conexión. Intente nuevamente.');
            rutValidado = false;
            restaurarTodosLosCie10();
            checkFields();
        });
    }

    // ===== FUNCIONES DE ESTILO Y UI =====
    function mostrarExito() {
        grut.className = 'form-group col-md-3';
        const input = rutInput;
        input.classList.add('is-valid');
        iconrut.style.display = 'block';
        iconrut.className = 'fas fa-check text-success';
    }

    function mostrarError(mensaje) {
        grut.className = 'form-group col-md-3';
        const input = rutInput;
        input.classList.add('is-invalid');
        iconrut.style.display = 'block';
        iconrut.className = 'fas fa-times text-danger';
        
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: mensaje,
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6',
            customClass: {
                popup: 'swal2-custom-popup',
                title: 'swal2-custom-title',
                content: 'swal2-custom-content',
                confirmButton: 'swal2-custom-button'
            }
        });
    }

    function resetearEstilo() {
        grut.className = 'form-group col-md-3';
        const input = rutInput;
        input.classList.remove('is-valid', 'is-invalid');
        iconrut.style.display = 'none';
    }

    // ===== FUNCIONES DE CIE10 =====
    function obtenerCie10PorRut(rut) {
        fetch('/obtener-cie10-por-rut', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ rut: rut })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                filtrarSelectCie10(data.codigos);
            } else {
                console.error('Error al obtener códigos CIE10');
                restaurarTodosLosCie10();
            }
        })
        .catch(error => {
            console.error('Error en la petición:', error);
            restaurarTodosLosCie10();
        });
    }

    function filtrarSelectCie10(codigosEncontrados) {
        const selectCie10 = document.getElementById('cie10');
        const todasLasOpciones = selectCie10.querySelectorAll('option');
        
        // Obtener los IDs de los códigos encontrados
        const codigosIds = codigosEncontrados.map(codigo => codigo.id_codigo);
        
        // Mostrar/ocultar opciones según si están en los resultados
        todasLasOpciones.forEach(option => {
            if (option.value === '') {
                // Mantener la opción "Seleccionar CIE 10" siempre visible
                option.style.display = '';
            } else {
                // Mostrar solo si está en los códigos encontrados
                option.style.display = codigosIds.includes(parseInt(option.value)) ? '' : 'none';
            }
        });
        
        // Limpiar la selección actual
        selectCie10.value = '';
    }

    function restaurarTodosLosCie10() {
        const selectCie10 = document.getElementById('cie10');
        const todasLasOpciones = selectCie10.querySelectorAll('option');
        
        todasLasOpciones.forEach(option => {
            option.style.display = '';
        });
        
        // Limpiar la selección actual
        selectCie10.value = '';
    }

    // ===== VALIDACIÓN DE CAMPOS =====
    function checkFields() {
        if (rutValidado && cie10Select && cie10Select.value.trim() !== '') {
            if (btnAgregar) {
                btnAgregar.disabled = false;
                btnAgregar.style.opacity = 1;
                btnAgregar.style.pointerEvents = 'auto';
            }
        } else {
            if (btnAgregar) {
                btnAgregar.disabled = true;
                btnAgregar.style.opacity = 0.5;
                btnAgregar.style.pointerEvents = 'none';
            }
        }
    }

    // Event listeners para validación de campos
    if (rutInput && cie10Select && btnAgregar) {
        rutInput.addEventListener('input', checkFields);
        cie10Select.addEventListener('change', checkFields);
    }

    // ===== VALIDACIÓN DE FECHAS =====
    const fechaDesde = document.getElementById('fecha-desde');
    const fechaHasta = document.getElementById('fecha-hasta');

    if (fechaDesde && fechaHasta) {
        fechaDesde.addEventListener('change', function() {
            if (fechaDesde.value) {
                fechaHasta.min = fechaDesde.value;
            } else {
                fechaHasta.min = '';
            }
        });

        fechaHasta.addEventListener('change', function() {
            if (fechaHasta.value) {
                fechaDesde.max = fechaHasta.value;
            } else {
                fechaDesde.max = '';
            }
        });
    }

    // ===== MODAL DE REQUERIMIENTO =====
    if (btnAgregar && rutInput) {
        btnAgregar.addEventListener('click', function() {
            const rut = rutInput.value.trim();
            console.log('RUT a buscar:', rut);
            document.getElementById('input-rut-modal').value = rut;

            document.getElementById('info-paciente-modal').style.display = 'none';
            document.getElementById('info-paciente-error').style.display = 'none';

            fetch(`/paciente/buscar?rut=${encodeURIComponent(rut)}`)
                .then(response => {
                    console.log('Response status:', response.status);
                    return response.json();
                })
                .then(data => {
                    console.log('Datos recibidos:', data);
                    if (data.success) {
                        document.getElementById('modal-rut').textContent = data.paciente.rut;
                        document.getElementById('modal-nombre').textContent = data.paciente.nombre;
                        document.getElementById('modal-sexo').textContent = data.paciente.sexo;
                        document.getElementById('modal-comuna').textContent = data.paciente.comuna;
                        document.getElementById('modal-servicio').textContent = data.paciente.servicio_salud;
                        document.getElementById('info-paciente-modal').style.display = 'block';
                    } else {
                        document.getElementById('info-paciente-error').style.display = 'block';
                    }
                    var modal = new bootstrap.Modal(document.getElementById('modalRequerimiento'));
                    modal.show();
                })
                .catch((error) => {
                    console.error('Error al buscar paciente:', error);
                    document.getElementById('info-paciente-error').style.display = 'block';
                    var modal = new bootstrap.Modal(document.getElementById('modalRequerimiento'));
                    modal.show();
                });
        });
    }

    // ===== VALIDACIÓN DE CAMPOS DE TEXTO =====
    validarCamposTexto();
    
    // ===== CONFIGURACIÓN INICIAL DE FECHAS EN MODAL =====
    const fechaRequerimiento = document.getElementById('fecha-requerimiento');
    const fechaProximaRevision = document.getElementById('fecha-proxima-revision');
    
    if (fechaRequerimiento) {
        const hoy = new Date().toISOString().split('T')[0];
        fechaRequerimiento.value = hoy;
        
        // Establecer fecha mínima para próxima revisión (mañana)
        const manana = new Date();
        manana.setDate(manana.getDate() + 1);
        const mananaFormato = manana.toISOString().split('T')[0];
        
        if (fechaProximaRevision) {
            fechaProximaRevision.min = mananaFormato;
            fechaProximaRevision.value = mananaFormato;
        }
    }
    
    // ===== VALIDACIÓN DE FECHAS EN EL MODAL =====
    if (fechaRequerimiento && fechaProximaRevision) {
        fechaRequerimiento.addEventListener('change', function() {
            const fechaReq = this.value;
            if (fechaReq) {
                // Establecer fecha mínima para próxima revisión
                const fechaMinima = new Date(fechaReq);
                fechaMinima.setDate(fechaMinima.getDate() + 1);
                const fechaMinimaFormato = fechaMinima.toISOString().split('T')[0];
                
                fechaProximaRevision.min = fechaMinimaFormato;
                
                // Si la fecha de próxima revisión es menor que la nueva fecha mínima, actualizarla
                if (fechaProximaRevision.value && fechaProximaRevision.value < fechaMinimaFormato) {
                    fechaProximaRevision.value = fechaMinimaFormato;
                }
            }
        });
        
        fechaProximaRevision.addEventListener('change', function() {
            const fechaRevision = this.value;
            const fechaReq = fechaRequerimiento.value;
            
            if (fechaRevision && fechaReq && fechaRevision <= fechaReq) {
                Swal.fire({
                    icon: 'error',
                    title: 'Fecha inválida',
                    text: 'La fecha de próxima revisión debe ser posterior a la fecha del requerimiento.',
                    confirmButtonText: 'Entendido',
                    confirmButtonColor: '#3085d6',
                    customClass: {
                        popup: 'swal2-custom-popup',
                        title: 'swal2-custom-title',
                        content: 'swal2-custom-content',
                        confirmButton: 'swal2-custom-button'
                    }
                });
                
                // Resetear a la fecha mínima válida
                const fechaMinima = new Date(fechaReq);
                fechaMinima.setDate(fechaMinima.getDate() + 1);
                const fechaMinimaFormato = fechaMinima.toISOString().split('T')[0];
                this.value = fechaMinimaFormato;
            }
        });
    }

    // ===== SWEETALERT DE ÉXITO CON BLADE =====
    @if(session('success_alert'))
        Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: '{{ session('success_alert') }}',
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#00a65a',
            customClass: {
                popup: 'swal2-custom-popup',
                title: 'swal2-custom-title',
                content: 'swal2-custom-content',
                confirmButton: 'swal2-custom-button'
            }
        });
    @endif
    
    // ===== MANEJO DEL FORMULARIO =====
    const formRequerimiento = document.getElementById('form-requerimiento');
    const btnGuardar = document.getElementById('btn-guardar-requerimiento');
    
    if (formRequerimiento && btnGuardar) {
        formRequerimiento.addEventListener('submit', function(e) {
            // Mostrar indicador de carga
            btnGuardar.disabled = true;
            btnGuardar.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Guardando...';
            
            // El formulario se enviará normalmente
            // La SweetAlert se mostrará después del redirect
        });
    }
    
    // ===== MANEJO DE DETALLES DE REQUERIMIENTO =====
    document.addEventListener('click', function(e) {
        if (e.target.closest('.btn-ver-detalles')) {
            e.preventDefault();
            const btn = e.target.closest('.btn-ver-detalles');
            const idRegistro = btn.getAttribute('data-id');
            
            if (idRegistro) {
                cargarDetallesRequerimiento(idRegistro);
            }
        }
    });
    
    // ===== VALIDACIÓN INICIAL DE RUT =====
    var rutInputValidacion = document.getElementById('rut_paciente');
    if (rutInputValidacion && rutInputValidacion.value.trim() !== '') {
        validarRut(rutInputValidacion.value.trim());
    }
});

// ===== FUNCIONES EXTERNAS =====
function validarCamposTexto() {
    const campos = [
        { id: 'nombres', nombre: 'Nombres', tipo: 'nombre' },
        { id: 'primer-apellido', nombre: 'Primer apellido', tipo: 'apellido' },
        { id: 'segundo-apellido', nombre: 'Segundo apellido', tipo: 'apellido' }
    ];

    campos.forEach(campo => {
        const input = document.getElementById(campo.id);
        if (input) {
            // Validación en tiempo real mientras escribe
            input.addEventListener('input', function() {
                const valor = this.value;
                
                if (campo.tipo === 'nombre') {
                    // Para nombres: solo letras y máximo 1 espacio
                    const valorLimpio = valor.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, '');
                    const espacios = (valorLimpio.match(/\s/g) || []).length;
                    
                    if (espacios > 1) {
                        // Si hay más de 1 espacio, eliminar extras
                        this.value = valorLimpio.replace(/\s+/g, ' ').trim();
                    } else {
                        this.value = valorLimpio;
                    }
                } else {
                    // Para apellidos: solo letras, espacios, guiones
                    this.value = valor.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s-]/g, '');
                }
            });

            // Validación al salir del campo
            input.addEventListener('blur', function() {
                const valor = this.value.trim();
                
                if (valor && !validarNombreApellido(valor, campo.tipo)) {
                    this.classList.add('is-invalid');
                    mostrarErrorCampo(`${campo.nombre} contiene caracteres inválidos`);
                } else {
                    this.classList.remove('is-invalid');
                }
            });
        }
    });
}

function validarNombreApellido(texto, tipo) {
    if (texto.trim().length < 2) {
        return false;
    }

    if (tipo === 'nombre') {
        // Para nombres: solo letras y máximo 1 espacio
        const regex = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+(\s[a-zA-ZáéíóúÁÉÍÓÚñÑ]+)?$/;
        return regex.test(texto) && texto.trim().length >= 2;
    } else {
        // Para apellidos: letras, espacios, guiones
        const regex = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s-]+$/;
        return regex.test(texto) && texto.trim().length >= 2;
    }
}

function mostrarErrorCampo(mensaje) {
    Swal.fire({
        icon: 'warning',
        title: 'Campo inválido',
        text: mensaje,
        confirmButtonText: 'OK',
        confirmButtonColor: '#3085d6',
        customClass: {
            popup: 'swal2-custom-popup',
            title: 'swal2-custom-title',
            content: 'swal2-custom-content',
            confirmButton: 'swal2-custom-button'
        }
    });
}

function cargarDetallesRequerimiento(idRegistro) {
    console.log('Cargando detalles para registro:', idRegistro);
    
    // Mostrar indicador de carga
    document.getElementById('info-paciente-detalles').style.display = 'none';
    document.getElementById('info-requerimiento-detalles').style.display = 'none';
    
    // Hacer petición AJAX para obtener los detalles
    fetch(`/requerimiento/detalles/${idRegistro}`)
        .then(response => response.json())
        .then(data => {
            console.log('Datos recibidos:', data);
            if (data.success) {
                // Cargar información del paciente
                document.getElementById('detalles-rut').textContent = data.paciente.rut;
                document.getElementById('detalles-nombre').textContent = data.paciente.nombre;
                document.getElementById('detalles-sexo').textContent = data.paciente.sexo;
                document.getElementById('detalles-comuna').textContent = data.paciente.comuna;
                document.getElementById('detalles-servicio').textContent = data.paciente.servicio_salud;
                document.getElementById('info-paciente-detalles').style.display = 'block';
                
                // Cargar información del requerimiento
                document.getElementById('detalles-fecha-requerimiento').textContent = data.requerimiento.fecha_formateada;
                document.getElementById('detalles-responsable').textContent = data.requerimiento.responsable;
                document.getElementById('detalles-categoria').textContent = data.requerimiento.categoria;
                document.getElementById('detalles-requerimiento').textContent = data.requerimiento.requerimiento;
                document.getElementById('detalles-emisor').textContent = data.requerimiento.emisor;
                document.getElementById('detalles-entidad').textContent = data.requerimiento.entidad;
                document.getElementById('info-requerimiento-detalles').style.display = 'block';
                
                // Mostrar el modal
                var modal = new bootstrap.Modal(document.getElementById('modalDetallesRequerimiento'));
                modal.show();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.mensaje || 'No se pudieron cargar los detalles del requerimiento',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#3085d6'
                });
            }
        })
        .catch(error => {
            console.error('Error al cargar detalles:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error de conexión',
                text: 'No se pudieron cargar los detalles del requerimiento',
                confirmButtonText: 'OK',
                confirmButtonColor: '#3085d6'
            });
        });
}
</script>

@endsection
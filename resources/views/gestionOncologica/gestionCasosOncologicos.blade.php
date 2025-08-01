@extends('layouts.app')

@section('title', 'Gestión de Requerimientos')


@section('content')
<h1 class="h4">Gestión de Casos Oncológicos</h1>
@if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif
    <div class="card mt-4">
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
    <input type="text" id="rut-paciente" name="rut-paciente" 
           class="form-control" placeholder="12.345.678-9" 
           maxlength="12" value="{{ request('rut-paciente') }}">
    <i class="fa form-control-feedback fa-check" id="iconrut" style="display: none;"></i>
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
                <div class="d-flex justify-content-between mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i> Buscar
                    </button>
                    <a href="{{ route('gestionCasosOncologicos') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-rotate-left"></i> Limpiar
                    </a>
                    <button type="button" class="btn btn-success" id="btn-agregar-requerimiento" disabled style="opacity: 0.5; pointer-events: none;">
                    <i class="fas fa-plus-circle"></i> Agregar Nuevo Requerimiento
                    </button>
                </div>
            </form>
        </div>
    </div>

    @if(isset($resultados))
        <div class="card mt-4">
            <div class="card-body">
                <h4>Resultados de la búsqueda</h4>
                <div class="table-responsive">
                    <table class="table table-sm table-hover text-nowrap mb-0">
                        @if($resultados->count() == 0)
                            <caption class="text-center">No se encontraron registros que coincidan con los criterios de búsqueda.</caption>
                        @endif
                        <thead>
                            <tr>
                                <th>Acciones</th>
                                <th>RUT Paciente</th>
                                <th>Nombre Paciente</th>
                                <th>Diagnóstico</th>
                                <th>Fecha Requerimiento</th>
                                <th>Requerimiento</th>
                                <th>Responsable</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($resultados as $registro)
                                @foreach($registro->requerimientos as $req)
                                    <tr>
                                        <td><a href="#" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a></td>
                                        <td>{{ $registro->paciente->rut ?? 'N/A' }}</td>
                                        <td>{{ $registro->paciente->nombre ?? '' }} {{ $registro->paciente->apellidos?? '' }} </td>
                                        <td>{{ $registro->codigo->descripcion ?? 'N/A' }}</td>
                                        <td>{{ $registro->fecha ?? 'N/A' }}</td>
                                        <td>{{ $req->requerimiento ?? 'N/A' }}</td>
                                        <td>{{ $registro->responsable->responsable ?? 'N/A' }}</td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
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
    <div class="card-body">
        <strong>RUT:</strong> <span id="modal-rut"></span><br>
        <strong>Nombre:</strong> <span id="modal-nombre"></span><br>
        <strong>Apellidos:</strong> <span id="modal-apellidos"></span>
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
<form id="form-requerimiento" method="POST" action="{{ route('registroRequerimiento.store') }}">
    @csrf
    <input type="hidden" name="rut" id="input-rut-modal">
    <!-- Aquí los demás campos: requerimiento, fecha, responsable, etc. -->
    <div class="mb-3">
        <label for="requerimiento" class="form-label">Requerimiento</label>
        <select name="requerimiento" id="requerimiento" class="form-select">
            @foreach($requerimientos as $req)
                <option value="{{ $req->id_requerimiento }}">{{ $req->requerimiento }}</option>
            @endforeach
        </select>
    </div>
    <!-- ...otros campos... -->
    <button type="submit" class="btn btn-primary">Registrar Requerimiento</button>
</form>
      </div>
    </div>
  </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Formateo de RUT (MANTIENE el original, solo permite K al final)
    const rutInput = document.getElementById('rut-paciente');
    const grut = document.getElementById('grut');
    const iconrut = document.getElementById('iconrut');
    
    let timeoutId;
    let rutValidado = false;
    
    if (rutInput) {
        rutInput.addEventListener('input', function (e) {
            let value = e.target.value;
            
            // Función para formatear RUT que preserva la K
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
            
            // Aplicar el formateo
            let formattedValue = formatearRUT(value);
            
            // Solo actualizar si el valor cambió para evitar loops
            if (formattedValue !== value) {
                e.target.value = formattedValue;
            }
            
            // Resetear validación cuando cambia el RUT
            rutValidado = false;
            resetearEstilo();
            checkFields();
            
            // Validación de RUT después del formateo
            clearTimeout(timeoutId);
            timeoutId = setTimeout(() => {
                validarRut(e.target.value);
            }, 500);
        });

        // Manejar el evento de pegado específicamente
        rutInput.addEventListener('paste', function(e) {
            // Permitir que el paste ocurra normalmente
            setTimeout(() => {
                // Después del paste, formatear el contenido
                let pastedValue = e.target.value;
                let formattedValue = formatearRUT(pastedValue);
                e.target.value = formattedValue;
                
                // Resetear validación
                rutValidado = false;
                resetearEstilo();
                checkFields();
                
                // Validar después del formateo
                clearTimeout(timeoutId);
                timeoutId = setTimeout(() => {
                    validarRut(e.target.value);
                }, 500);
            }, 0);
        });

        // Función auxiliar para formatear RUT (reutilizable)
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
    }

    // Función de validación de RUT
    function validarRut(rut) {
        if (rut.length < 8) {
            resetearEstilo();
            rutValidado = false;
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
            } else {
                mostrarError(data.mensaje);
                rutValidado = false;
            }
            checkFields();
        })
        .catch(error => {
            mostrarError('Error de conexión. Intente nuevamente.');
            rutValidado = false;
            checkFields();
        });
    }
    
    function mostrarExito() {
        grut.className = 'form-group col-md-3 has-feedback has-success';
        iconrut.style.display = 'block';
        iconrut.className = 'fa form-control-feedback fa-check';
    }
    
    function mostrarError(mensaje) {
        grut.className = 'form-group col-md-3 has-feedback has-error';
        iconrut.style.display = 'block';
        iconrut.className = 'fa form-control-feedback fa-times';
        
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
        iconrut.style.display = 'none';
    }

    // Habilitar botón solo si RUT es válido Y CIE10 está completo
    const cie10Select = document.getElementById('cie10');
    const btnAgregar = document.getElementById('btn-agregar-requerimiento');

    function checkFields() {
        if (rutValidado && cie10Select.value.trim() !== '') {
            btnAgregar.disabled = false;
            btnAgregar.style.opacity = 1;
            btnAgregar.style.pointerEvents = 'auto';
        } else {
            btnAgregar.disabled = true;
            btnAgregar.style.opacity = 0.5;
            btnAgregar.style.pointerEvents = 'none';
        }
    }

    if (rutInput && cie10Select && btnAgregar) {
        rutInput.addEventListener('input', checkFields);
        cie10Select.addEventListener('change', checkFields);
    }

    // Validación de fechas
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

    // Mostrar el modal al hacer click
    if (btnAgregar && rutInput) {
        btnAgregar.addEventListener('click', function() {
            const rut = rutInput.value.trim();
            document.getElementById('input-rut-modal').value = rut;

            document.getElementById('info-paciente-modal').style.display = 'none';
            document.getElementById('info-paciente-error').style.display = 'none';

            fetch(`/paciente/buscar?rut=${encodeURIComponent(rut)}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('modal-rut').textContent = data.paciente.rut;
                        document.getElementById('modal-nombre').textContent = data.paciente.nombre;
                        document.getElementById('modal-apellidos').textContent = data.paciente.apellidos;
                        document.getElementById('info-paciente-modal').style.display = 'block';
                    } else {
                        document.getElementById('info-paciente-error').style.display = 'block';
                    }
                    var modal = new bootstrap.Modal(document.getElementById('modalRequerimiento'));
                    modal.show();
                })
                .catch(() => {
                    document.getElementById('info-paciente-error').style.display = 'block';
                    var modal = new bootstrap.Modal(document.getElementById('modalRequerimiento'));
                    modal.show();
                });
        });
    }
});
</script>
@endsection
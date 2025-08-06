@extends('layouts.app')

@section('title', 'Registro Clínico de Tratamiento Oncológico Ambulatorio')

@section('content')
<h1 class="h4">
    <i class="fas fa-laptop-medical me-2"></i>
    Registro Clínico de Tratamiento Oncológico Ambulatorio
</h1>

<div class="card mt-4">
    <div class="card-header bg-light">
        <h5 class="mb-0 text-primary">
            <i class="fas fa-search me-2"></i>Filtro de búsqueda
        </h5>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('registro-tratamiento.create') }}">
            <!-- Fila 1: Fechas de ingreso -->
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label for="fecha_ingreso_inicio" class="form-label">Fecha de Ingreso (Inicio)</label>
                    <input type="date" id="fecha_ingreso_inicio" name="fecha_ingreso_inicio" 
                           class="form-control" value="{{ request('fecha_ingreso_inicio') }}">
                </div>
                <div class="col-md-6">
                    <label for="fecha_ingreso_fin" class="form-label">Fecha de Ingreso (Fin)</label>
                    <input type="date" id="fecha_ingreso_fin" name="fecha_ingreso_fin" 
                           class="form-control" value="{{ request('fecha_ingreso_fin') }}">
                </div>
            </div>

            <!-- Fila 2: RUT y N° archivo -->
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label for="rut_paciente" class="form-label">RUT Paciente</label>
                    <div class="position-relative">
                    <input type="text" id="rut_paciente" name="rut_paciente" class="form-control"
                               value="{{ request('rut_paciente') }}" placeholder="Ingrese RUT" maxlength="12">
                        <div class="position-absolute top-0 end-0 h-100 d-flex align-items-center pe-3">
                            <i class="fas fa-check text-success" id="icon-rut-tratamiento" style="display: none;"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="numero_archivo" class="form-label">N° Archivo</label>
                    <input type="text" id="numero_archivo" name="numero_archivo" class="form-control"
                           value="{{ request('numero_archivo') }}" placeholder="12345678"maxlength="8">
                </div>
            </div>

            <!-- Fila 3: Nombres y apellidos -->
            <div class="row g-3 mb-3">
                <div class="col-md-4">
                    <label for="nombres" class="form-label">Nombres</label>
                    <input type="text" id="nombres" name="nombres" class="form-control"
                           value="{{ request('nombres') }}" placeholder="Ingrese nombres">
                </div>
                <div class="col-md-4">
                    <label for="primer_apellido" class="form-label">Primer Apellido</label>
                    <input type="text" id="primer_apellido" name="primer_apellido" class="form-control"
                           value="{{ request('primer_apellido') }}" placeholder="Ingrese primer apellido">
                </div>
                <div class="col-md-4">
                    <label for="segundo_apellido" class="form-label">Segundo Apellido</label>
                    <input type="text" id="segundo_apellido" name="segundo_apellido" class="form-control"
                           value="{{ request('segundo_apellido') }}" placeholder="Ingrese segundo apellido">
                </div>
            </div>

            <!-- Fila 4: Ver tratamientos -->
            <div class="row g-3 mb-3">
                <div class="col-md-12">
                    <label for="ver_tratamientos" class="form-label">Ver Tratamientos</label>
                    <select id="ver_tratamientos" name="ver_tratamientos" class="choices-select form-select">
                        <option value="">Seleccione una opción</option>
                        <option value="misos" {{ request('ver_tratamientos') == 'misos' ? 'selected' : '' }}>
                            Mis Tratamientos
                        </option>
                        <option value="todos" {{ request('ver_tratamientos') == 'todos' ? 'selected' : '' }}>
                            Todos los Tratamientos
                        </option>
                    </select>
                </div>
            </div>

            <!-- Botones de acción -->
            <div class="d-flex flex-wrap gap-2 mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-filter"></i> Filtrar
                </button>
                
                <button type="button" class="btn btn-secondary" onclick="limpiarFormulario()">
                    <i class="fas fa-eraser"></i> Limpiar
                </button>
                

            </div>
        </form>
    </div>
</div>

<!-- Modal: Opciones de Tratamiento Oncológico -->
<div class="modal fade" id="modalTratamientosOncologicos" tabindex="-1" aria-labelledby="modalTratamientosOncologicosLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" style="max-width: 90%;">
        <div class="modal-content shadow-lg">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTratamientosOncologicosLabel">Registro Clínico de Tratamiento Oncológico</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <div class="row g-4">
                            <!-- Quimioterapia - No disponible -->
                            <div class="col-md-6 col-lg-4">
                                <button type="button" 
                                        class="btn btn-outline-primary text-uppercase fw-bold w-100 py-4 d-flex flex-column justify-content-center h-100 disabled"
                                        role="button" aria-disabled="true">
                                    QUIMIOTERAPIA
                                    <span class="text-secondary fw-normal small mt-1">No disponible</span>
                                </button>
                            </div>

                            <!-- Radioterapia - Activo -->
                            <div class="col-md-6 col-lg-4">
                                <button type="button" 
                                        class="btn btn-outline-primary text-uppercase fw-bold w-100 py-4 d-flex flex-column justify-content-center h-100"
                                        onclick="abrirModalRadioterapia()">
                                    RADIOTERAPIA
                                </button>
                            </div>

                            <!-- Inmunoterapia - No disponible -->
                            <div class="col-md-6 col-lg-4">
                                <button type="button" 
                                        class="btn btn-outline-primary text-uppercase fw-bold w-100 py-4 d-flex flex-column justify-content-center h-100 disabled"
                                        role="button" aria-disabled="true">
                                    INMUNOTERAPIA
                                    <span class="text-secondary fw-normal small mt-1">No disponible</span>
                                </button>
                            </div>

                            <!-- Hormonoterapia - No disponible -->
                            <div class="col-md-6 col-lg-4">
                                <button type="button" 
                                        class="btn btn-outline-primary text-uppercase fw-bold w-100 py-4 d-flex flex-column justify-content-center h-100 disabled"
                                        role="button" aria-disabled="true">
                                    HORMONOTERAPIA
                                    <span class="text-secondary fw-normal small mt-1">No disponible</span>
                                </button>
                            </div>

                            <!-- Braquiterapia - No disponible -->
                            <div class="col-md-6 col-lg-4">
                                <button type="button" 
                                        class="btn btn-outline-primary text-uppercase fw-bold w-100 py-4 d-flex flex-column justify-content-center h-100 disabled"
                                        role="button" aria-disabled="true">
                                    BRAQUITERAPIA
                                    <span class="text-secondary fw-normal small mt-1">No disponible</span>
                                </button>
                            </div>

                            <!-- Cuidados Paliativos - No disponible -->
                            <div class="col-md-6 col-lg-4">
                                <button type="button" 
                                        class="btn btn-outline-primary text-uppercase fw-bold w-100 py-4 d-flex flex-column justify-content-center h-100 disabled"
                                        role="button" aria-disabled="true">
                                    CUIDADOS PALIATIVOS
                                    <span class="text-secondary fw-normal small mt-1">No disponible</span>
                                </button>
                            </div>

                            <!-- Terapia Blanco - No disponible -->
                            <div class="col-md-6 col-lg-4">
                                <button type="button" 
                                        class="btn btn-outline-primary text-uppercase fw-bold w-100 py-4 d-flex flex-column justify-content-center h-100 disabled"
                                        role="button" aria-disabled="true">
                                    TERAPIA BLANCO
                                    <span class="text-secondary fw-normal small mt-1">No disponible</span>
                                </button>
                            </div>

                            <!-- Yodo Terapia - No disponible -->
                            <div class="col-md-6 col-lg-4">
                                <button type="button" 
                                        class="btn btn-outline-primary text-uppercase fw-bold w-100 py-4 d-flex flex-column justify-content-center h-100 disabled"
                                        role="button" aria-disabled="true">
                                    YODO TERAPIA
                                    <span class="text-secondary fw-normal small mt-1">No disponible</span>
                                </button>
                            </div>

                            <!-- Cirugía Oncológica - No disponible -->
                            <div class="col-md-6 col-lg-4">
                                <button type="button" 
                                        class="btn btn-outline-primary text-uppercase fw-bold w-100 py-4 d-flex flex-column justify-content-center h-100 disabled"
                                        role="button" aria-disabled="true">
                                    CIRUGÍA ONCOLÓGICA
                                    <span class="text-secondary fw-normal small mt-1">No disponible</span>
                                </button>
                            </div>

                            <!-- Cirugía No Oncológica - No disponible -->
                            <div class="col-md-6 col-lg-4">
                                <button type="button" 
                                        class="btn btn-outline-primary text-uppercase fw-bold w-100 py-4 d-flex flex-column justify-content-center h-100 disabled"
                                        role="button" aria-disabled="true">
                                    CIRUGÍA NO ONCOLÓGICA
                                    <span class="text-secondary fw-normal small mt-1">No disponible</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal: Agregar Indicación de Tratamiento Oncológico -->
<div class="modal fade" id="modalIndicacionTratamiento" tabindex="-1" aria-labelledby="modalIndicacionTratamientoLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content shadow-lg">
            <form id="form-indicacion-tratamiento">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalIndicacionTratamientoLabel">Agregar Indicación de Tratamiento Oncológico</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <!-- Recuadro de información del paciente -->
                    <div id="info-paciente-modal-indicacion" class="card mb-3">
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
                                        <strong>RUT:</strong> <span id="modal-indicacion-rut">12.345.678-9</span>
                                    </div>
                                    <div class="mb-2">
                                        <strong>Nombre:</strong> <span id="modal-indicacion-nombre">Juan Pérez Soto</span>
                                    </div>
                                    <div class="mb-2">
                                        <strong>Sexo:</strong> <span id="modal-indicacion-sexo">Masculino</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <strong>Comuna:</strong> <span id="modal-indicacion-comuna">Concepción</span>
                                    </div>
                                    <div class="mb-2">
                                        <strong>Servicio de Salud:</strong> <span id="modal-indicacion-servicio">SS Concepción</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Fin recuadro paciente -->

                    <!-- Título del formulario -->
                    <h5 class="mb-3 text-primary">Registro Indicación Tratamiento</h5>

                    <!-- Formulario: 4 campos por fila -->
                    <div class="row g-3">
                        <!-- Fila 1 -->
                        <div class="col-md-3">
                            <label for="codigo_ges" class="form-label">Código GES de radioterapia</label>
                            <select id="codigo_ges" name="id_codigo_ges" class="form-select" required>
                                <option value="">Seleccione</option>
                                @foreach($codigosGes as $codigo)
                                    <option value="{{ $codigo->id_codigo_ges }}">{{ $codigo->codigo_ges }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="codigo_tratamiento" class="form-label">Código de Tratamiento</label>
                            <select id="codigo_tratamiento" name="id_codigo_tratamiento" class="form-select" required>
                                <option value="">Seleccione</option>
                                @foreach($codigosTratamiento as $codigo)
                                    <option value="{{ $codigo->id_codigo_tratamiento }}">{{ $codigo->codigo }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="zona_irradiar" class="form-label">Zona a irradiar</label>
                            <select id="zona_irradiar" name="id_zona" class="form-select" required>
                                <option value="">Seleccione</option>
                                @foreach($zonasIrradiadas as $zona)
                                    <option value="{{ $zona->id_zona }}">{{ $zona->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="diagnostico_cie10" class="form-label">Diagnóstico CIE 10</label>
                            <select id="diagnostico_cie10" name="id_codigo" class="form-select" required>
                                <option value="">Seleccione</option>
                                @foreach($codigosCie10 as $codigo)
                                    <option value="{{ $codigo->id_codigo }}">{{ $codigo->codigo_cie10 }} - {{ $codigo->descripcion }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Fila 2 -->
                        <div class="col-md-3">
                            <label for="quimioterapia" class="form-label">Quimioterapia</label>
                            <select id="quimioterapia" name="id_quimioterapia_concominante" class="form-select" required>
                                <option value="">Seleccione</option>
                                @foreach($quimioterapias as $quimio)
                                    <option value="{{ $quimio->id_quimioterapia_concominante }}">{{ $quimio->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="n_sesiones" class="form-label">N° sesiones programadas</label>
                            <select id="n_sesiones" name="n_sesiones_programadas" class="form-select" required>
                                <option value="">Seleccione</option>
                                @for($i = 1; $i <= 40; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="intencion" class="form-label">Intención</label>
                            <select id="intencion" name="intencion" class="form-select" required>
                                <option value="">Seleccione</option>
                                <option value="Curativo">Curativo</option>
                                <option value="Paliativo">Paliativo</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="radioterapeuta" class="form-label">Radioterapeuta</label>
                            <select id="radioterapeuta" name="id_radioterapeuta" class="form-select" required>
                                <option value="">Seleccione</option>
                                @foreach($radioterapeutas as $radioterapeuta)
                                    <option value="{{ $radioterapeuta->id_radioterapeuta }}">{{ $radioterapeuta->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Fila 3 -->
                        <div class="col-md-3">
                            <label for="fecha_indicacion" class="form-label">Fecha de indicación</label>
                            <input type="date" id="fecha_indicacion" name="fecha_indicacion" class="form-control" required>
                        </div>
                        <div class="col-md-3">
                            <label for="fecha_inicio" class="form-label">Fecha de inicio tratamiento</label>
                            <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control" required>
                        </div>
                        <div class="col-md-3">
                            <label for="fecha_termino" class="form-label">Fecha de término</label>
                            <input type="date" id="fecha_termino" name="fecha_termino" class="form-control" required>
                        </div>
                        <div class="col-md-3">
                            <label for="cobertura_ges" class="form-label">Cobertura GES</label>
                            <select id="cobertura_ges" name="cobertura_ges" class="form-select" required>
                                <option value="">Seleccione</option>
                                <option value="1">Sí</option>
                                <option value="0">No</option>
                            </select>
                        </div>

                        <!-- Fila 4 -->
                        <div class="col-md-3">
                            <label for="horario" class="form-label">Horario</label>
                            <select id="horario" name="horario_tratamiento" class="form-select" required>
                                <option value="">Seleccione</option>
                                <option value="Diurno">Diurno</option>
                                <option value="Vespertino">Vespertino</option>
                            </select>
                        </div>

                        <!-- Observaciones al final, ancho completo -->
                        <div class="col-12 mt-4">
                            <label for="observaciones" class="form-label">Observaciones</label>
                            <textarea id="observaciones" name="observaciones" class="form-control" rows="3" maxlength="1000" placeholder="Ingrese observaciones adicionales..."></textarea>
                        </div>
                        
                        <!-- Campo oculto para el RUT del paciente -->
                        <input type="hidden" id="rut_paciente_modal" name="rut_paciente_modal" value="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar Indicación</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="card mt-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm table-hover text-nowrap mb-0">
                <thead>
                    <tr>
                        <th>Acciones</th>
                        <th>RUT</th>
                        <th>Paciente</th>
                        <th>N° Archivo</th>
                        <th>Sexo</th>
                    </tr>
                </thead>
                <tbody>
                                        @if(isset($pacientes) && $pacientes->count() > 0)
                        @foreach($pacientes as $paciente)
                    <tr>
                        <td>
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTratamientosOncologicos" 
                                            title="Registrar Indicación" onclick="window.rutPacienteSeleccionado = '{{ $paciente['rut'] }}';">
                                        <i class="fas fa-address-book"></i>
                            </button>
                        </td>
                                <td>{{ $paciente['rut'] }}</td>
                                <td>{{ $paciente['paciente'] }}</td>
                                <td>{{ $paciente['n_archivo'] }}</td>
                                <td>{{ $paciente['sexo'] }}</td>

                    </tr>
                        @endforeach
                    @else
                        @if(request()->hasAny(['fecha_ingreso_inicio', 'fecha_ingreso_fin', 'rut_paciente', 'nombres', 'primer_apellido', 'segundo_apellido', 'numero_archivo']))
                            <tr>
                                <td colspan="5" class="text-center text-muted">No se encontraron resultados para los filtros aplicados</td>
                    </tr>
                        @else
                            <tr>
                                <td colspan="5" class="text-center text-muted">Utilice los filtros para buscar pacientes</td>
                    </tr>
                        @endif
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Collapse: Registrar tratamientos de hoy -->
<div class="mt-4">
        <button class="btn btn-outline-primary mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTratamientosHoy" aria-expanded="false" aria-controls="collapseTratamientosHoy" onclick="cargarSesionesHoy()">
        Registrar Sesiones de hoy
    </button>
    <div class="collapse" id="collapseTratamientosHoy">
        <div class="card card-body">
            <h5 class="mb-4 text-primary"><i class="fas fa-calendar-day me-2"></i>Sesiones de hoy</h5>
            
            <!-- Loading indicator -->
            <div id="loading-sesiones" class="text-center d-none">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Cargando...</span>
                            </div>
                <p class="mt-2 text-muted">Cargando sesiones de hoy...</p>
                        </div>
            
            <!-- Contenedor para las cards dinámicas -->
            <div id="contenedor-sesiones" class="row g-4">
                <!-- Las cards se cargarán dinámicamente aquí -->
                            </div>
            
            <!-- Mensaje cuando no hay sesiones -->
            <div id="sin-sesiones" class="text-center d-none">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    No hay sesiones programadas para hoy.
                            </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detalle Tratamiento 1 -->
<div class="modal fade" id="modalDetalleTratamiento1" tabindex="-1" aria-labelledby="modalDetalleTratamiento1Label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content shadow-lg">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetalleTratamiento1Label">Detalle Tratamiento de Juan Pérez Soto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-6"><strong>RUT:</strong> 12.345.678-9</div>
                    <div class="col-md-6"><strong>Nombre:</strong> Juan Pérez Soto</div>
                    <div class="col-md-6"><strong>Diagnóstico CIE10:</strong> C50 - Mama</div>
                    <div class="col-md-6"><strong>Zona a Irradiar:</strong> Tórax</div>
                    <div class="col-md-6"><strong>Quimioterapia:</strong> Sí</div>
                    <div class="col-md-6"><strong>N° Sesión Actual:</strong> 5</div>
                    <div class="col-md-6"><strong>Horario:</strong> Diurno</div>
                    <div class="col-md-6"><strong>Radioterapeuta:</strong> Dr. Juan Pérez</div>
                    <div class="col-md-12"><strong>Observaciones:</strong> Sin novedades</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detalle Tratamiento 2 -->
<div class="modal fade" id="modalDetalleTratamiento2" tabindex="-1" aria-labelledby="modalDetalleTratamiento2Label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content shadow-lg">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetalleTratamiento2Label">Detalle Tratamiento de María López Díaz</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-6"><strong>RUT:</strong> 21.987.654-3</div>
                    <div class="col-md-6"><strong>Nombre:</strong> María López Díaz</div>
                    <div class="col-md-6"><strong>Diagnóstico CIE10:</strong> C61 - Próstata</div>
                    <div class="col-md-6"><strong>Zona a Irradiar:</strong> Pelvis</div>
                    <div class="col-md-6"><strong>Quimioterapia:</strong> No</div>
                    <div class="col-md-6"><strong>N° Sesión Actual:</strong> 10</div>
                    <div class="col-md-6"><strong>Horario:</strong> Vespertino</div>
                    <div class="col-md-6"><strong>Radioterapeuta:</strong> Dra. Ana López</div>
                    <div class="col-md-12"><strong>Observaciones:</strong> Paciente con leve dolor</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detalle Tratamiento 3 -->
<div class="modal fade" id="modalDetalleTratamiento3" tabindex="-1" aria-labelledby="modalDetalleTratamiento3Label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content shadow-lg">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetalleTratamiento3Label">Detalle Tratamiento de Carlos Ruiz Mena</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-6"><strong>RUT:</strong> 15.123.456-7</div>
                    <div class="col-md-6"><strong>Nombre:</strong> Carlos Ruiz Mena</div>
                    <div class="col-md-6"><strong>Diagnóstico CIE10:</strong> C34 - Pulmón</div>
                    <div class="col-md-6"><strong>Zona a Irradiar:</strong> Abdomen</div>
                    <div class="col-md-6"><strong>Quimioterapia:</strong> Capecitabina</div>
                    <div class="col-md-6"><strong>N° Sesión Actual:</strong> 3</div>
                    <div class="col-md-6"><strong>Horario:</strong> Diurno</div>
                    <div class="col-md-6"><strong>Radioterapeuta:</strong> Dr. Carlos Ruiz</div>
                    <div class="col-md-12"><strong>Observaciones:</strong> Presenta náuseas leves</div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// ===== FUNCIÓN PARA FORMATEAR RUT =====
function formatRut(input) {
    let value = input.value.replace(/\D/g, '');
    if (value.length > 1) {
        const cuerpo = value.slice(0, -1);
        const dv = value.slice(-1);
        let formatted = '';
        let reversed = cuerpo.split('').reverse().join('');
        for (let i = 0; i < reversed.length; i++) {
            if (i !== 0 && i % 3 === 0) {
                formatted = '.' + formatted;
            }
            formatted = reversed[i] + formatted;
        }
        input.value = formatted + '-' + dv;
    } else {
        input.value = value;
    }
}

// ===== FUNCIÓN PARA LIMPIAR FORMULARIO =====
function limpiarFormulario() {
    // Limpiar todos los campos del formulario
    document.getElementById('fecha_ingreso_inicio').value = '';
    document.getElementById('fecha_ingreso_fin').value = '';
    document.getElementById('rut_paciente').value = '';
    document.getElementById('numero_archivo').value = '';
    document.getElementById('nombres').value = '';
    document.getElementById('primer_apellido').value = '';
    document.getElementById('segundo_apellido').value = '';
    
    // Limpiar validaciones de RUT
    const rutInput = document.getElementById('rut_paciente');
    if (rutInput) {
        rutInput.classList.remove('is-valid', 'is-invalid');
    }
    
    // Recargar la página sin parámetros
    window.location.href = window.location.pathname;
}

// ===== FUNCIÓN PARA ABRIR MODAL DE RADIOTERAPIA =====
function abrirModalRadioterapia() {
    // Cerrar el modal de opciones de tratamiento
    const modalTratamientos = bootstrap.Modal.getInstance(document.getElementById('modalTratamientosOncologicos'));
    if (modalTratamientos) {
        modalTratamientos.hide();
    }
    
    // Esperar un poco para que se cierre el modal anterior
    setTimeout(() => {
        // Usar el RUT del paciente seleccionado desde la tabla
        if (window.rutPacienteSeleccionado) {
            const rut = window.rutPacienteSeleccionado;
            console.log('RUT seleccionado para radioterapia:', rut);
            
            // Validar que el RUT existe (aunque ya viene de la tabla)
            if (!rut || rut.trim() === '') {
                mostrarAlerta('error', 'No se pudo obtener el RUT del paciente seleccionado.');
                return;
            }

            // Realizar petición AJAX para obtener datos del paciente
            fetch('/obtener-datos-paciente', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ rut: rut })
            })
            .then(response => response.json())
            .then(data => {
                console.log('Respuesta del servidor:', data);
                if (data.success) {
                    const paciente = data.paciente;
                
                    // Llenar información del paciente en el modal
                    document.getElementById('modal-indicacion-rut').textContent = rut;
                    document.getElementById('modal-indicacion-nombre').textContent = paciente.nombre;
                    document.getElementById('modal-indicacion-sexo').textContent = paciente.sexo;
                    document.getElementById('modal-indicacion-comuna').textContent = paciente.comuna;
                    document.getElementById('modal-indicacion-servicio').textContent = paciente.servicio_salud;
                    
                    // Establecer el RUT en el campo oculto
                    document.getElementById('rut_paciente_modal').value = rut;
                    
                    // Limpiar el formulario
                    document.getElementById('form-indicacion-tratamiento').reset();
                    document.getElementById('rut_paciente_modal').value = rut; // Mantener el RUT después del reset
                    
                    // Abrir el modal de indicación de tratamiento
                    const modalIndicacion = new bootstrap.Modal(document.getElementById('modalIndicacionTratamiento'));
                    modalIndicacion.show();
                } else {
                    mostrarAlerta('error', data.message || 'No se pudieron obtener los datos del paciente.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                mostrarAlerta('error', 'Error al obtener los datos del paciente. Por favor, intente nuevamente.');
            });
        } else {
            mostrarAlerta('error', 'No se ha seleccionado ningún paciente.');
        }
    }, 300); // Esperar 300ms para que se cierre el modal anterior
}

// ===== CONFIGURACIÓN DE EVENTOS DOM =====
document.addEventListener('DOMContentLoaded', function() {
    // Validación de fechas
    const fechaIngresoInicio = document.getElementById('fecha_ingreso_inicio');
    const fechaIngresoFin = document.getElementById('fecha_ingreso_fin');

    fechaIngresoInicio.addEventListener('change', function() {
        if (fechaIngresoInicio.value) {
            fechaIngresoFin.min = fechaIngresoInicio.value;
        } else {
            fechaIngresoFin.min = '';
        }
    });

    fechaIngresoFin.addEventListener('change', function() {
        if (fechaIngresoFin.value) {
            fechaIngresoInicio.max = fechaIngresoFin.value;
        } else {
            fechaIngresoInicio.max = '';
        }
    });

    // Formateo de RUT para filtros de búsqueda
    const rutInput = document.getElementById('rut_paciente');
    const iconRutTratamiento = document.getElementById('icon-rut-tratamiento');
    let rutValidadoTratamiento = false;
    let timeoutRutTratamiento;
    
    if (rutInput) {
        rutInput.addEventListener('input', function (e) {
            formatRut(e.target);
            
            // Resetear validación cuando cambia el RUT
            rutValidadoTratamiento = false;
            resetearEstiloRutTratamiento();
            
            // Validación después de 1 segundo de inactividad
            clearTimeout(timeoutRutTratamiento);
            timeoutRutTratamiento = setTimeout(() => {
                validarRutTratamiento(e.target.value);
            }, 1000);
        });

        // Validación de RUT en tiempo real para búsqueda
        rutInput.addEventListener('blur', function() {
        if (rutInput.value.trim() !== '') {
                validarRutTratamiento(rutInput.value);
            } else {
                resetearEstiloRutTratamiento();
            }
        });
    }
    
    // ===== FUNCIONES DE VALIDACIÓN DE RUT PARA TRATAMIENTO =====
    function validarRutTratamiento(rut) {
        if (rut.length < 8) {
            resetearEstiloRutTratamiento();
            rutValidadoTratamiento = false;
            return;
        }
        
        fetch('/validar-rut', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ rut: rut })
        })
        .then(response => response.json())
        .then(data => {
            if (data.valido) {
                mostrarExitoRutTratamiento();
                rutValidadoTratamiento = true;
        } else {
                mostrarErrorRutTratamiento();
                rutValidadoTratamiento = false;
                mostrarAlerta('error', data.mensaje);
            }
        })
        .catch(error => {
            console.error('Error validando RUT:', error);
            mostrarErrorRutTratamiento();
            rutValidadoTratamiento = false;
        });
    }
    
    function mostrarExitoRutTratamiento() {
        rutInput.classList.remove('is-invalid');
        rutInput.classList.add('is-valid');
        iconRutTratamiento.style.display = 'block';
        iconRutTratamiento.className = 'fas fa-check text-success';
    }
    
    function mostrarErrorRutTratamiento() {
        rutInput.classList.remove('is-valid');
        rutInput.classList.add('is-invalid');
        iconRutTratamiento.style.display = 'block';
        iconRutTratamiento.className = 'fas fa-times text-danger';
    }
    
    function resetearEstiloRutTratamiento() {
        rutInput.classList.remove('is-valid', 'is-invalid');
        if (iconRutTratamiento) {
            iconRutTratamiento.style.display = 'none';
        }
    }
    
    // ===== VALIDACIÓN INICIAL DE RUT AL CARGAR LA PÁGINA =====
    // Validar RUT si tiene valor al cargar la página (para mantener estado como en gestión de casos)
    if (rutInput && rutInput.value.trim() !== '') {
        console.log('Revalidando RUT al cargar página de tratamiento:', rutInput.value);
        validarRutTratamiento(rutInput.value.trim());
    }

    // Manejar el envío del formulario del modal
    const formIndicacion = document.getElementById('form-indicacion-tratamiento');
    
    if (formIndicacion) {
        formIndicacion.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(formIndicacion);
            const submitButton = formIndicacion.querySelector('button[type="submit"]');
            const originalText = submitButton.textContent;
            
            // Deshabilitar botón y mostrar loading
            submitButton.disabled = true;
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Guardando...';
            
            fetch('/registroTratamientoRadioterapia', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Cerrar modal
                    const modal = bootstrap.Modal.getInstance(document.getElementById('modalIndicacionTratamiento'));
                    modal.hide();
                    
                    // Mostrar mensaje de éxito y recargar cuando se haga clic en Aceptar
                    mostrarAlertaConCallback('success', 'Tratamiento registrado correctamente', function() {
                        window.location.reload();
                    });
                } else {
                    if (data.errores) {
                        let mensajeError = 'Errores de validación:\n';
                        Object.keys(data.errores).forEach(campo => {
                            mensajeError += `• ${campo}: ${data.errores[campo].join(', ')}\n`;
                        });
                        mostrarAlerta('error', mensajeError);
                    } else {
                        mostrarAlerta('error', data.mensaje);
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                mostrarAlerta('error', 'Error al guardar el tratamiento');
            })
            .finally(() => {
                // Restaurar botón
                submitButton.disabled = false;
                submitButton.textContent = originalText;
            });
        });
    }
    
    // Validación de fechas en el modal
    const fechaIndicacion = document.getElementById('fecha_indicacion');
    const fechaInicio = document.getElementById('fecha_inicio');
    const fechaTermino = document.getElementById('fecha_termino');
    
    if (fechaIndicacion && fechaInicio && fechaTermino) {
        fechaIndicacion.addEventListener('change', function() {
            if (fechaIndicacion.value) {
                fechaInicio.min = fechaIndicacion.value;
            }
        });
        
        fechaInicio.addEventListener('change', function() {
            if (fechaInicio.value) {
                fechaTermino.min = fechaInicio.value;
            }
        });
    }
});

// ===== FUNCIÓN GLOBAL PARA MOSTRAR ALERTAS =====
function mostrarAlerta(tipo, mensaje) {
    let icono, titulo, color;
    
    switch(tipo) {
        case 'success':
            icono = 'success';
            titulo = '¡Éxito!';
            color = '#00a65a';
            break;
        case 'info':
            icono = 'info';
            titulo = 'Información';
            color = '#17a2b8';
            break;
        default:
            icono = 'error';
            titulo = 'Error';
            color = '#3085d6';
    }

    Swal.fire({
        icon: icono,
        title: titulo,
        text: mensaje,
        confirmButtonText: 'Aceptar',
        confirmButtonColor: color,
        allowOutsideClick: false,
        allowEscapeKey: false,
        allowEnterKey: true,
        customClass: {
            popup: 'swal2-custom-popup',
            title: 'swal2-custom-title',
            content: 'swal2-custom-content',
            confirmButton: 'swal2-custom-button'
        }
    });
}

// ===== FUNCIÓN PARA MOSTRAR ALERTAS CON CALLBACK =====
function mostrarAlertaConCallback(tipo, mensaje, callback) {
    const icono = tipo === 'success' ? 'success' : 'error';
    const titulo = tipo === 'success' ? '¡Éxito!' : 'Error';
    const color = tipo === 'success' ? '#00a65a' : '#3085d6';
    
    Swal.fire({
        icon: icono,
        title: titulo,
        text: mensaje,
        confirmButtonText: 'Aceptar',
        confirmButtonColor: color,
        allowOutsideClick: false,
        allowEscapeKey: false,
        allowEnterKey: true,
        customClass: {
            popup: 'swal2-custom-popup',
            title: 'swal2-custom-title',
            content: 'swal2-custom-content',
            confirmButton: 'swal2-custom-button'
        }
    }).then((result) => {
        if (result.isConfirmed && callback) {
            callback();
        }
    });
}

// ===== INICIALIZACIÓN ADICIONAL AL CARGAR LA PÁGINA =====
document.addEventListener('DOMContentLoaded', function() {
    // Inicializar tooltips si hay elementos con data-bs-toggle="tooltip"
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    // Mostrar alertas de sesión si existen
    @if(session('success_alert'))
        Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: '{{ session('success_alert') }}',
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#00a65a',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true,
            customClass: {
                popup: 'swal2-custom-popup',
                title: 'swal2-custom-title',
                content: 'swal2-custom-content',
                confirmButton: 'swal2-custom-button'
            }
        });
    @endif

    @if(session('error_alert'))
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '{{ session('error_alert') }}',
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#3085d6',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true,
            customClass: {
                popup: 'swal2-custom-popup',
                title: 'swal2-custom-title',
                content: 'swal2-custom-content',
                confirmButton: 'swal2-custom-button'
            }
        });
    @endif
    
    // ===== EVENT LISTENERS PARA CÁLCULO DE FECHA TÉRMINO =====
    const nSesionesSelect = document.getElementById('n_sesiones');
    const fechaInicioInput = document.getElementById('fecha_inicio');
    
    if (nSesionesSelect && fechaInicioInput) {
        // Calcular cuando cambie el número de sesiones
        nSesionesSelect.addEventListener('change', function() {
            console.log('Cambió número de sesiones:', this.value);
            calcularFechaTermino();
        });
        
        // Calcular cuando cambie la fecha de inicio
        fechaInicioInput.addEventListener('change', function() {
            console.log('Cambió fecha de inicio:', this.value);
            calcularFechaTermino();
        });
        
        console.log('✅ Event listeners para cálculo de fecha término agregados');
    } else {
        console.error('❌ No se encontraron los campos para el cálculo de fecha término');
    }
    
    // ===== INICIALIZAR VARIABLE GLOBAL PARA CONTROL DE CARGA =====
    window.sesionesYaCargadas = false;

// ===== FUNCIÓN PARA CALCULAR FECHA DE TÉRMINO =====
function calcularFechaTermino() {
    const nSesiones = document.getElementById('n_sesiones').value;
    const fechaInicio = document.getElementById('fecha_inicio').value;
    const fechaTerminoInput = document.getElementById('fecha_termino');
    
    console.log('Calculando fecha término:', { nSesiones, fechaInicio });
    
    // Solo calcular si ambos campos tienen valores
    if (nSesiones && fechaInicio) {
        const sesiones = parseInt(nSesiones);
        const inicio = new Date(fechaInicio);
        
        // Verificar que la fecha de inicio sea válida
        if (isNaN(inicio.getTime())) {
            fechaTerminoInput.value = '';
            return;
        }
        
        let diasAgregados = 0;
        let fechaActual = new Date(inicio);
        
        // Necesitamos sesiones-1 días adicionales (la primera sesión es el día de inicio)
        const diasAdicionales = sesiones - 1;
        
        while (diasAgregados < diasAdicionales) {
            fechaActual.setDate(fechaActual.getDate() + 1);
            
            // Solo contar días laborables (lunes=1 a viernes=5)
            const diaSemana = fechaActual.getDay();
            if (diaSemana >= 1 && diaSemana <= 5) {
                diasAgregados++;
            }
        }
        
        // Formatear la fecha para el input (YYYY-MM-DD)
        const fechaTermino = fechaActual.toISOString().split('T')[0];
        fechaTerminoInput.value = fechaTermino;
        
        console.log(`✅ Calculado: ${sesiones} sesiones desde ${fechaInicio} = ${fechaTermino}`);
    } else {
        // Limpiar fecha de término si faltan datos
        fechaTerminoInput.value = '';
        console.log('❌ Faltan datos para calcular fecha término');
    }
}

});
</script>

<script>
// ===== FUNCIONES GLOBALES PARA SESIONES DE HOY =====

// ===== FUNCIÓN PARA CARGAR SESIONES DE HOY =====
function cargarSesionesHoy() {
    // Solo cargar si no se han cargado ya
    if (window.sesionesYaCargadas) {
        console.log('Las sesiones ya fueron cargadas previamente');
        return;
    }
    
    console.log('Cargando sesiones de hoy...');
    
    // Mostrar loading
    document.getElementById('loading-sesiones').classList.remove('d-none');
    document.getElementById('contenedor-sesiones').classList.add('d-none');
    document.getElementById('sin-sesiones').classList.add('d-none');
    
    fetch('/sesiones-hoy')
        .then(response => {
            console.log('Status de respuesta:', response.status);
            if (!response.ok) {
                throw new Error(`HTTP ${response.status}: ${response.statusText}`);
            }
            return response.json();
        })
        .then(data => {
            console.log('🔍 Respuesta completa del servidor:', data);
            
            // Ocultar loading
            document.getElementById('loading-sesiones').classList.add('d-none');
            
            if (data.success) {
                console.log(`📊 Total de sesiones encontradas: ${data.total || 0}`);
                console.log(`📅 Fecha consultada: ${data.fecha_hoy}`);
                
                if (data.data && data.data.length > 0) {
                    console.log('✅ Mostrando cards de sesiones:', data.data);
                    // Mostrar las cards con las sesiones
                    mostrarCardsSesiones(data.data);
                    document.getElementById('contenedor-sesiones').classList.remove('d-none');
                } else {
                    console.log('ℹ️ No hay sesiones programadas para hoy');
                    // No hay sesiones para hoy
                    document.getElementById('sin-sesiones').classList.remove('d-none');
                }
                
                // Marcar como cargadas
                window.sesionesYaCargadas = true;
                
                // Mostrar estadísticas en consola
                console.log(`✅ Proceso completado: ${data.total || 0} sesiones para ${data.fecha_hoy}`);
            } else {
                console.error('❌ Error del servidor:', data.message);
                mostrarErrorCargaSesiones();
            }
        })
        .catch(error => {
            console.error('Error al cargar sesiones:', error);
            document.getElementById('loading-sesiones').classList.add('d-none');
            mostrarErrorCargaSesiones();
        });
}

// ===== FUNCIÓN PARA MOSTRAR LAS CARDS DE SESIONES =====
function mostrarCardsSesiones(sesiones) {
    const contenedor = document.getElementById('contenedor-sesiones');
    contenedor.innerHTML = ''; // Limpiar contenido anterior
    
    sesiones.forEach(sesion => {
        const cardCol = document.createElement('div');
        cardCol.className = 'col-md-6 col-lg-4';
        
        // Determinar el color del borde según el estado
        const borderClass = sesion.sesion_realizada ? 'border-success' : 'border-info';
        
        cardCol.innerHTML = `
            <div class="card shadow-sm ${borderClass}">
                <div class="card-body">
                    <h6 class="card-title mb-2 text-info">${sesion.paciente_nombre}</h6>
                    <p class="mb-1"><strong>RUT:</strong> ${sesion.paciente_rut}</p>
                    <p class="mb-1"><strong>Diagnóstico CIE10:</strong> ${sesion.diagnostico_cie10}</p>
                    <p class="mb-1"><strong>Zona a Irradiar:</strong> ${sesion.zona_irradiar}</p>
                    <p class="mb-1"><strong>Quimioterapia:</strong> ${sesion.quimioterapia}</p>
                    <p class="mb-1"><strong>N° Sesión Actual:</strong> ${sesion.sesion_actual}</p>
                    <p class="mb-1"><strong>N° Sesiones totales:</strong> ${sesion.sesiones_totales}</p>
                    <p class="mb-1"><strong>Horario:</strong> ${sesion.horario}</p>
                    <p class="mb-1"><strong>Radioterapeuta:</strong> ${sesion.radioterapeuta}</p>
                    <p class="mb-2"><strong>Observaciones Indicación:</strong> ${sesion.observaciones_indicacion}</p>
                    <p class="mb-2"><strong>Observaciones Última sesión:</strong> ${sesion.observaciones_ultima_sesion}</p>
                    
                    <div class="d-flex gap-2">
                        ${sesion.sesion_realizada === null ? 
                            // No registrada aún - mostrar ambos botones
                            '<button class="btn btn-success btn-sm" title="Marcar como realizada" onclick="marcarSesion(' + sesion.id_registro_tratamiento + ', true)"><i class="fas fa-check me-1"></i>Sí</button>' +
                            '<button class="btn btn-danger btn-sm" title="Marcar como no realizada" onclick="marcarSesion(' + sesion.id_registro_tratamiento + ', false)"><i class="fas fa-times me-1"></i>No</button>' :
                            sesion.sesion_realizada === true ?
                            // Ya registrada como realizada
                            '<span class="badge bg-success"><i class="fas fa-check me-1"></i>Realizada</span>' +
                            '<button class="btn btn-outline-danger btn-sm" title="Cambiar a no realizada" onclick="marcarSesion(' + sesion.id_registro_tratamiento + ', false)"><i class="fas fa-times me-1"></i>Cambiar a No</button>' :
                            // Ya registrada como no realizada
                            '<button class="btn btn-outline-success btn-sm" title="Cambiar a realizada" onclick="marcarSesion(' + sesion.id_registro_tratamiento + ', true)"><i class="fas fa-check me-1"></i>Cambiar a Sí</button>' +
                            '<span class="badge bg-danger"><i class="fas fa-times me-1"></i>No realizada</span>'
                        }
                    </div>
                </div>
            </div>
        `;
        
        contenedor.appendChild(cardCol);
    });
}

// ===== FUNCIÓN PARA MOSTRAR ERROR EN CARGA =====
function mostrarErrorCargaSesiones() {
    const contenedor = document.getElementById('contenedor-sesiones');
    contenedor.innerHTML = `
        <div class="col-12">
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-triangle me-2"></i>
                Error al cargar las sesiones de hoy. Por favor, intente nuevamente.
                <button class="btn btn-sm btn-outline-danger ms-2" onclick="recargarSesiones()">
                    <i class="fas fa-refresh me-1"></i>Reintentar
                </button>
            </div>
        </div>
    `;
    document.getElementById('contenedor-sesiones').classList.remove('d-none');
}

// ===== FUNCIÓN PARA RECARGAR SESIONES =====
function recargarSesiones() {
    window.sesionesYaCargadas = false;
    cargarSesionesHoy();
}

// ===== FUNCIÓN PARA MARCAR SESIÓN (SÍ O NO) =====
function marcarSesion(idTratamiento, seRealizo) {
    const textoAccion = seRealizo ? 'realizado' : 'no realizado';
    const iconoAccion = seRealizo ? 'success' : 'warning';
    
    console.log(`Marcando sesión como ${textoAccion} para tratamiento:`, idTratamiento);
    
    Swal.fire({
        title: '¿Confirmar registro?',
        text: `¿Quieres confirmar que este paciente ${seRealizo ? 'SÍ se ha realizado' : 'NO se ha realizado'} su sesión?`,
        icon: iconoAccion,
        showCancelButton: true,
        confirmButtonText: 'Sí, confirmar',
        cancelButtonText: 'Cancelar',
        confirmButtonColor: seRealizo ? '#28a745' : '#dc3545',
        cancelButtonColor: '#6c757d'
    }).then((result) => {
        if (result.isConfirmed) {
            // Enviar al servidor
            registrarSesion(idTratamiento, seRealizo);
        }
    });
}

// ===== FUNCIÓN PARA REGISTRAR EN EL SERVIDOR =====
function registrarSesion(idTratamiento, seRealizo) {
    const formData = new FormData();
    formData.append('id_registro_tratamiento', idTratamiento);
    formData.append('se_realizo', seRealizo ? '1' : '0');
    formData.append('fecha_registro', new Date().toISOString().split('T')[0]); // Fecha actual
    
    fetch('/registrar-sesion', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP ${response.status}: ${response.statusText}`);
        }
        return response.json();
    })
    .then(data => {
        console.log('✅ Respuesta del servidor:', data);
        
        if (data.success) {
            Swal.fire({
                title: '¡Guardado correctamente!',
                text: data.message || 'La sesión ha sido registrada exitosamente',
                icon: 'success',
                confirmButtonText: 'Aceptar',
                confirmButtonColor: '#28a745'
            }).then(() => {
                // Recargar las sesiones para mostrar el estado actualizado
                window.sesionesYaCargadas = false;
                cargarSesionesHoy();
            });
        } else {
            Swal.fire({
                title: 'Error al guardar',
                text: data.message || 'Hubo un problema al registrar la sesión',
                icon: 'error',
                confirmButtonText: 'Aceptar',
                confirmButtonColor: '#dc3545'
            });
        }
    })
    .catch(error => {
        console.error('❌ Error al registrar sesión:', error);
        Swal.fire({
            title: 'Error de conexión',
            text: 'No se pudo conectar con el servidor',
            icon: 'error',
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#dc3545'
        });
    });
}



</script>



@endsection

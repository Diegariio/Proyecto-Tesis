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
                    <input type="text" id="rut_paciente" name="rut_paciente" class="form-control"
                           value="{{ request('rut_paciente') }}" placeholder="Ingrese RUT">
                </div>
                <div class="col-md-6">
                    <label for="numero_archivo" class="form-label">N° Archivo</label>
                    <input type="text" id="numero_archivo" name="numero_archivo" class="form-control"
                           value="{{ request('numero_archivo') }}" placeholder="Ingrese N° archivo">
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
                
                <button type="button" class="btn btn-success" id="btn-agregar-tratamiento" onclick="abrirModalTratamiento()" disabled style="opacity: 0.5; pointer-events: none;">
                    <i class="fas fa-plus-circle"></i> Agregar indicación de tratamiento oncológico
                </button>
            </div>
        </form>
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
                        <th>Fecha Inicio</th>
                        <th>Diagnostico CIE10</th>
                        <th>Zona a Irradiar</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($pacientes) && $pacientes->count() > 0)
                        @foreach($pacientes as $paciente)
                            <tr>
                                <td>
                                    <button class="btn btn-outline-info btn-sm" onclick="verDetalles('{{ $paciente['rut'] }}')" title="Ver detalles">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                                <td>{{ $paciente['rut'] }}</td>
                                <td>{{ $paciente['paciente'] }}</td>
                                <td>{{ $paciente['n_archivo'] }}</td>
                                <td>{{ $paciente['fecha_inicio'] }}</td>
                                <td>{{ $paciente['cie10'] }}</td>
                                <td>{{ $paciente['zona'] }}</td>
                            </tr>
                        @endforeach
                    @else
                        @if(request()->hasAny(['fecha_ingreso_inicio', 'fecha_ingreso_fin', 'rut_paciente', 'nombres', 'primer_apellido', 'segundo_apellido', 'numero_archivo']))
                            <tr>
                                <td colspan="7" class="text-center text-muted">No se encontraron resultados para los filtros aplicados</td>
                            </tr>
                        @else
                            <tr>
                                <td colspan="7" class="text-center text-muted">Utilice los filtros para buscar pacientes</td>
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
    <button class="btn btn-outline-primary mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTratamientosHoy" aria-expanded="false" aria-controls="collapseTratamientosHoy">
        Registrar Sesiones de hoy
    </button>
    <div class="collapse" id="collapseTratamientosHoy">
        <div class="card card-body">
            <h5 class="mb-4 text-primary"><i class="fas fa-calendar-day me-2"></i>Sesiones de hoy</h5>
            <div class="row g-4">
                <!-- Card 1 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm border-info">
                        <div class="card-body">
                            <h6 class="card-title mb-2 text-info">Juan Pérez Soto</h6>
                            <p class="mb-1"><strong>RUT:</strong> 12.345.678-9</p>
                            <p class="mb-1"><strong>Diagnóstico CIE10:</strong> C50 - Mama</p>
                            <p class="mb-1"><strong>Zona a Irradiar:</strong> Tórax</p>
                            <p class="mb-1"><strong>Quimioterapia:</strong> Sí</p>
                            <p class="mb-1"><strong>N° Sesión Actual:</strong> 5</p>
                            <p class="mb-1"><strong>N° Sesiones totales:</strong> 10</p>
                            <p class="mb-1"><strong>Horario:</strong> Diurno</p>
                            <p class="mb-1"><strong>Radioterapeuta:</strong> Dr. Juan Pérez</p>
                            <p class="mb-2"><strong>Observaciones Indicación:</strong> Sin novedades</p>
                            <p class="mb-2"><strong>Observaciones Utlima sesion:</strong> Sin novedades</p>

                            <div class="d-flex gap-2">
                                <button class="btn btn-success btn-sm" title="Marcar como realizado"><i class="fas fa-check"></i></button>
                                <button class="btn btn-danger btn-sm" title="Marcar como no realizado"><i class="fas fa-times"></i></button>
                                <button class="btn btn-secondary btn-sm" title="Agregar observación"><i class="fas fa-comment"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Card 2 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm border-info">
                        <div class="card-body">
                            <h6 class="card-title mb-2 text-info">María López Díaz</h6>
                            <p class="mb-1"><strong>RUT:</strong> 21.987.654-3</p>
                            <p class="mb-1"><strong>Diagnóstico CIE10:</strong> C61 - Próstata</p>
                            <p class="mb-1"><strong>Zona a Irradiar:</strong> Pelvis</p>
                            <p class="mb-1"><strong>Quimioterapia:</strong> No</p>
                            <p class="mb-1"><strong>N° Sesión Actual:</strong> 10</p>
                            <p class="mb-1"><strong>N° Sesiones totales:</strong> 10</p>
                            <p class="mb-1"><strong>Horario:</strong> Vespertino</p>
                            <p class="mb-1"><strong>Radioterapeuta:</strong> Dra. Ana López</p>
                                <p class="mb-2"><strong>Observaciones:</strong> Paciente con leve dolor</p>
                                <p class="mb-2"><strong>Observaciones Utlima sesion:</strong> Sin novedades</p>

                                <div class="d-flex gap-2">
                                <button class="btn btn-success btn-sm" title="Marcar como realizado"><i class="fas fa-check"></i></button>
                                <button class="btn btn-danger btn-sm" title="Marcar como no realizado"><i class="fas fa-times"></i></button>
                                <button class="btn btn-secondary btn-sm" title="Agregar observación"><i class="fas fa-comment"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Card 3 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm border-info">
                        <div class="card-body">
                            <h6 class="card-title mb-2 text-info">Carlos Ruiz Mena</h6>
                            <p class="mb-1"><strong>RUT:</strong> 15.123.456-7</p>
                            <p class="mb-1"><strong>Diagnóstico CIE10:</strong> C34 - Pulmón</p>
                            <p class="mb-1"><strong>Zona a Irradiar:</strong> Abdomen</p>
                            <p class="mb-1"><strong>Quimioterapia:</strong> Capecitabina</p>
                            <p class="mb-1"><strong>N° Sesión Actual:</strong> 3</p>
                            <p class="mb-1"><strong>N° Sesiones totales:</strong> 10</p>
                            <p class="mb-1"><strong>Horario:</strong> Vespertino</p>
                            <p class="mb-1"><strong>Radioterapeuta:</strong> Dr. Carlos Ruiz</p>
                            <p class="mb-2"><strong>Observaciones Indicación:</strong> Presenta náuseas leves</p>
                            <p class="mb-2"><strong>Observaciones Utlima sesion:</strong> Sin novedades</p>

                            <div class="d-flex gap-2">
                                <button class="btn btn-success btn-sm" title="Marcar como realizado"><i class="fas fa-check"></i></button>
                                <button class="btn btn-danger btn-sm" title="Marcar como no realizado"><i class="fas fa-times"></i></button>
                                <button class="btn btn-secondary btn-sm" title="Agregar observación"><i class="fas fa-comment"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Puedes agregar más cards de ejemplo aquí -->
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

    // Habilitar botón solo si RUT está completo
    const rutInput = document.getElementById('rut_paciente');
    const btnAgregar = document.getElementById('btn-agregar-tratamiento');

    function checkRutField() {
        if (rutInput.value.trim() !== '') {
            btnAgregar.disabled = false;
            btnAgregar.style.opacity = 1;
            btnAgregar.style.pointerEvents = 'auto';
        } else {
            btnAgregar.disabled = true;
            btnAgregar.style.opacity = 0.5;
            btnAgregar.style.pointerEvents = 'none';
        }
    }

    // Formateo de RUT
    if (rutInput) {
        rutInput.addEventListener('input', function (e) {
            let value = e.target.value.replace(/\D/g, '');
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
                e.target.value = formatted + '-' + dv;
            } else {
                e.target.value = value;
            }
            // Verificar estado del botón después de formatear
            checkRutField();
        });
    }
    
    // Verificar estado inicial
    checkRutField();

    // Validación de RUT en tiempo real
    const rutFeedback = document.createElement('div');
    rutFeedback.className = 'invalid-feedback';
    rutInput.parentNode.appendChild(rutFeedback);

    rutInput.addEventListener('blur', function() {
        if (rutInput.value.trim() !== '') {
            fetch('/validar-rut', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ rut: rutInput.value })
            })
            .then(response => response.json())
            .then(data => {
                if (data.valido) {
                    rutInput.classList.remove('is-invalid');
                    rutInput.classList.add('is-valid');
                    rutFeedback.style.display = 'none';
                } else {
                    rutInput.classList.remove('is-valid');
                    rutInput.classList.add('is-invalid');
                    rutFeedback.textContent = data.mensaje;
                    rutFeedback.style.display = 'block';
                    
                    // Mostrar error con SweetAlert
                    mostrarAlerta('error', data.mensaje);
                }
            });
        } else {
            rutInput.classList.remove('is-valid', 'is-invalid');
            rutFeedback.style.display = 'none';
        }
    });
});

function limpiarFormulario() {
    // Limpiar todos los campos del formulario
    document.getElementById('fecha_ingreso_inicio').value = '';
    document.getElementById('fecha_ingreso_fin').value = '';
    document.getElementById('rut_paciente').value = '';
    document.getElementById('numero_archivo').value = '';
    document.getElementById('nombres').value = '';
    document.getElementById('primer_apellido').value = '';
    document.getElementById('segundo_apellido').value = '';
    document.getElementById('ver_tratamientos').value = '';
    
    // Limpiar validaciones de RUT
    const rutInput = document.getElementById('rut_paciente');
    rutInput.classList.remove('is-valid', 'is-invalid');
    const rutFeedback = rutInput.parentNode.querySelector('.invalid-feedback');
    if (rutFeedback) {
        rutFeedback.style.display = 'none';
    }
    
    // Recargar la página sin parámetros
    window.location.href = window.location.pathname;
}

function verDetalles(rut) {
    // Implementar funcionalidad para ver detalles del tratamiento
    console.log('Ver detalles del paciente con RUT:', rut);
    // Aquí puedes abrir un modal o redirigir a una página de detalles
}

function abrirModalTratamiento() {
    const rutInput = document.getElementById('rut_paciente');
    const rut = rutInput.value.trim();
    
    if (!rut) {
        mostrarAlerta('error', 'Por favor, ingrese un RUT válido antes de agregar un tratamiento.');
        return;
    }
    
    // Cargar datos del paciente
    fetch('/obtener-datos-paciente', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ rut: rut })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Llenar los datos del paciente en el modal
            document.getElementById('modal-indicacion-rut').textContent = data.paciente.rut;
            document.getElementById('modal-indicacion-nombre').textContent = data.paciente.nombre;
            document.getElementById('modal-indicacion-sexo').textContent = data.paciente.sexo;
            document.getElementById('modal-indicacion-comuna').textContent = data.paciente.comuna;
            document.getElementById('modal-indicacion-servicio').textContent = data.paciente.servicio_salud;
            
            // Establecer el RUT en el campo oculto
            document.getElementById('rut_paciente_modal').value = data.paciente.rut;
            
            // Limpiar el formulario
            document.getElementById('form-indicacion-tratamiento').reset();
            document.getElementById('rut_paciente_modal').value = data.paciente.rut;
            
            // Abrir el modal
            const modal = new bootstrap.Modal(document.getElementById('modalIndicacionTratamiento'));
            modal.show();
        } else {
            mostrarAlerta('error', data.mensaje);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        mostrarAlerta('error', 'Error al obtener los datos del paciente');
    });
}

// Manejar el envío del formulario del modal
document.addEventListener('DOMContentLoaded', function() {
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
    
    // ===== SWEETALERT DE ÉXITO CON BLADE =====
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
});

// ===== FUNCIÓN GLOBAL PARA MOSTRAR ALERTAS =====
function mostrarAlerta(tipo, mensaje) {
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
</script>
@endsection
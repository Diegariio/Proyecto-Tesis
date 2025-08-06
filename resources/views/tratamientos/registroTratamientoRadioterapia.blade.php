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
        <form method="GET" action="{{ route('demo-filtro') }}">
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
                
                <button type="button" class="btn btn-secondary">
                    <i class="fas fa-eraser"></i> Limpiar
                </button>
                
                <button type="button" class="btn btn-success" id="btn-agregar-tratamiento" data-bs-toggle="modal" data-bs-target="#modalIndicacionTratamiento" disabled style="opacity: 0.5; pointer-events: none;">
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
            <form>
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

                    <!-- Formulario: 3 campos por fila -->
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="codigo_ges" class="form-label">Código GES de radioterapia</label>
                            <select id="codigo_ges" name="codigo_ges" class="form-select">
                                <option value="">Seleccione</option>
                                <option value="GES01">GES01 - Cáncer de mama</option>
                                <option value="GES02">GES02 - Cáncer de próstata</option>
                                <option value="GES03">GES03 - Cáncer de pulmón</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="zona_irradiar" class="form-label">Zona a irradiar</label>
                            <select id="zona_irradiar" name="zona_irradiar" class="form-select">
                                <option value="">Seleccione</option>
                                <option value="cabeza">Cabeza</option>
                                <option value="torax">Tórax</option>
                                <option value="abdomen">Abdomen</option>
                                <option value="pelvis">Pelvis</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="diagnostico_cie10" class="form-label">Diagnóstico CIE 10</label>
                            <select id="diagnostico_cie10" name="diagnostico_cie10" class="form-select">
                                <option value="">Seleccione</option>
                                <option value="C50">C50 - Mama</option>
                                <option value="C61">C61 - Próstata</option>
                                <option value="C34">C34 - Pulmón</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="quimioterapia" class="form-label">Quimioterapia</label>
                            <select id="quimioterapia" name="quimioterapia" class="form-select">
                                <option value="">Seleccione</option>
                                <option value="no">No</option>
                                <option value="si">Sí</option>
                                <option value="temolozamida">Temolozamida</option>
                                <option value="capecitabina">Capecitabina</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="n_sesiones" class="form-label">N° sesiones programadas</label>
                            <select id="n_sesiones" name="n_sesiones" class="form-select">
                                <option value="">Seleccione</option>
                                @for($i = 1; $i <= 40; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="intencion" class="form-label">Intención</label>
                            <select id="intencion" name="intencion" class="form-select">
                                <option value="">Seleccione</option>
                                <option value="curativo">Curativo</option>
                                <option value="paliativo">Paliativo</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="fecha_inicio" class="form-label">Fecha de inicio tratamiento</label>
                            <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="fecha_termino" class="form-label">Fecha de término</label>
                            <input type="date" id="fecha_termino" name="fecha_termino" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="cobertura_ges" class="form-label">Cobertura GES</label>
                            <select id="cobertura_ges" name="cobertura_ges" class="form-select">
                                <option value="">Seleccione</option>
                                <option value="si">Sí</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="horario" class="form-label">Horario</label>
                            <select id="horario" name="horario" class="form-select">
                                <option value="">Seleccione</option>
                                <option value="diurno">Diurno</option>
                                <option value="vespertino">Vespertino</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="radioterapeuta" class="form-label">Radioterapeuta</label>
                            <select id="radioterapeuta" name="radioterapeuta" class="form-select">
                                <option value="">Seleccione</option>
                                <option value="1">Dr. Juan Pérez</option>
                                <option value="2">Dra. Ana López</option>
                                <option value="3">Dr. Carlos Ruiz</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="observaciones" class="form-label">Observaciones</label>
                            <textarea id="observaciones" name="observaciones" class="form-control" rows="1"></textarea>
                        </div>
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
                    <!-- Fila 1 -->
                    <tr>
                        <td>
                            <button class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalDetalleTratamiento1" title="Ver detalles">
                                <i class="fas fa-eye"></i>
                            </button>
                        </td>
                        <td>12.345.678-9</td>
                        <td>Juan Pérez Soto</td>
                        <td>123456</td>
                        <td>2025-08-01</td>
                        <td>C50 - Mama</td>
                        <td>Tórax</td>
                    </tr>
                    <!-- Fila 2 -->
                    <tr>
                        <td>
                            <button class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalDetalleTratamiento2" title="Ver detalles">
                                <i class="fas fa-eye"></i>
                            </button>
                        </td>
                        <td>21.987.654-3</td>
                        <td>María López Díaz</td>
                        <td>654321</td>
                        <td>2025-08-01</td>
                        <td>C61 - Próstata</td>
                        <td>Pelvis</td>
                    </tr>
                    <!-- Fila 3 -->
                    <tr>
                        <td>
                            <button class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalDetalleTratamiento3" title="Ver detalles">
                                <i class="fas fa-eye"></i>
                            </button>
                        </td>
                        <td>15.123.456-7</td>
                        <td>Carlos Ruiz Mena</td>
                        <td>789123</td>
                        <td>2025-08-01</td>
                        <td>C34 - Pulmón</td>
                        <td>Abdomen</td>
                    </tr>
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
});
</script>
@endsection
@extends('layouts.app')

@section('title', 'Registro Clínico de Tratamiento Oncológico Ambulatorio')

@section('content')
    <h1 class="h4">
        <i class="fas fa-laptop-medical me-2"></i>
        Registro Clínico de Tratamiento Oncológico Ambulatorio
    </h1>

    <div class="card mt-4">
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
                    
                    <button type="button" class="btn btn-success" id="btn-agregar-tratamiento" disabled style="opacity: 0.5; pointer-events: none;">
                <i class="fas fa-plus"></i> Agregar Tratamiento Oncológico
</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabla de resultados (ejemplo) -->
    <div class="card mt-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-hover text-nowrap mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>RUT</th>
                            <th>Paciente</th>
                            <th>N° Archivo</th>
                            <th>Fecha Ingreso</th>
                            <th>Tratamiento</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Aquí irían los datos de la tabla -->
                        <tr>
                            <td colspan="7" class="text-center">No hay registros disponibles</td>
                        </tr>
                    </tbody>
                </table>
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
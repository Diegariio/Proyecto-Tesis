@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Registrar Tratamiento Radioterapia</h2>
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

    <form method="POST" action="{{ route('registro-tratamiento.store') }}">        
        @csrf

        {{-- Fila 1: Relaciones principales (4 cols) --}}
        <div class="row mb-3">
            <div class="col-md-6 col-lg-3">
                <label for="id_diagnostico" class="form-label">Diagnóstico</label>
                <select name="id_diagnostico" id="id_diagnostico" class="form-select">
                    <option></option>
                    @foreach($diagnosticos as $diagnostico)
                        <option value="{{ $diagnostico->id_diagnostico }}">
                            {{ $diagnostico->codigo }} - {{ $diagnostico->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 col-lg-3">
                <label for="id_zona" class="form-label">Zona Irradiada</label>
                <select name="id_zona" id="id_zona" class="form-select">
                    <option></option>
                    @foreach($zonas as $zona)
                        <option value="{{ $zona->id_zona }}">{{ $zona->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 col-lg-3">
                <label for="id_equipo" class="form-label">Equipo</label>
                <select name="id_equipo" id="id_equipo" class="form-select">
                    <option></option>
                    @foreach($equipos as $equipo)
                        <option value="{{ $equipo->id_equipo }}">{{ $equipo->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 col-lg-3">
                <label for="id_radioterapeuta" class="form-label">Radioterapeuta</label>
                <select name="id_radioterapeuta" id="id_radioterapeuta" class="form-select">
                    <option></option>
                    @foreach($radioterapeutas as $medico)
                        <option value="{{ $medico->id_radioterapeuta }}">{{ $medico->nombre }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- Fila 2: Relaciones restantes (4 cols también) --}}
        <div class="row mb-3">
            <div class="col-md-6 col-lg-3">
                <label for="id_codigo_tratamiento" class="form-label">Código Tratamiento</label>
                <select name="id_codigo_tratamiento" id="id_codigo_tratamiento" class="form-select">
                    <option></option>
                    @foreach($codigosTratamiento as $codigo)
                        <option value="{{ $codigo->id_codigo_tratamiento }}">
                            {{ $codigo->codigo }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 col-lg-3">
                <label for="id_codigo_ges" class="form-label">Código GES</label>
                <select name="id_codigo_ges" id="id_codigo_ges" class="form-select">
                    <option></option>
                    @foreach($codigosGes as $codigo)
                        <option value="{{ $codigo->id_codigo_ges }}">{{ $codigo->codigo_ges }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 col-lg-3">
                <label for="id_quimioterapia_concominante" class="form-label">Quimioterapia</label>
                <select name="id_quimioterapia_concominante" id="id_quimioterapia_concominante" class="form-select">
                    <option></option>
                    @foreach($quimioterapias as $quimio)
                        <option value="{{ $quimio->id_quimioterapia_concominante }}">{{ $quimio->nombre }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Aquí completamos la fila con el cuarto campo para no romper la cuadrícula --}}
            <div class="col-md-6 col-lg-3">
                <label for="tipo_atencion" class="form-label">Tipo de Atención</label>
                <select class="form-select" disabled>
                    <option selected>Ambulatorio</option>
                </select>
                <input type="hidden" name="tipo_atencion" value="Ambulatorio">
            </div>
        </div>
        {{-- Fila 3: Sesiones e intención --}}
        <div class="row mb-3">

            <div class="col-md-6 col-lg-3">
                <label for="n_sesiones_programadas" class="form-label">Sesiones Programadas</label>
                <input id="n_sesiones_programadas" class="form-control" type="number" name="n_sesiones_programadas"
                    min="1" max="40" value="{{ old('n_sesiones_programadas') }}">
            </div>

            <div class="col-md-6 col-lg-3">
                <label for="n_sesiones_realizadas" class="form-label">Sesiones Realizadas</label>
                <input id="n_sesiones_realizadas" class="form-control" type="number" name="n_sesiones_realizadas"
                    min="1" max="40" value="{{ old('n_sesiones_realizadas') }}">
            </div>



            <div class="col-md-6 col-lg-3">
                <label for="intencion" class="form-label">Intención</label>
                <select id="intencion" name="intencion" class="form-select">
                    <option value="Curativo">Curativo</option>
                    <option value="Paliativo">Paliativo</option>
                </select>
                <x-input-error :messages="$errors->get('intencion')" class="mt-2" />
            </div>
        </div>

        {{-- Fila 4: Fechas --}}
        <div class="row mb-3">
            <div class="col-md-6 col-lg-3">
                <label for="fecha_indicacion" class="form-label">Fecha Indicación</label>
                <input id="fecha_indicacion" class="form-control" type="date" name="fecha_indicacion"
                    value="{{ old('fecha_indicacion') }}">
            </div>

            <div class="col-md-6 col-lg-3">
                <label for="fecha_comite" class="form-label">Fecha Comité</label>
                <input id="fecha_comite" class="form-control" type="date" name="fecha_comite"
                    value="{{ old('fecha_comite') }}">
            </div>

            <div class="col-md-6 col-lg-3">
                <label for="fecha_simulacion" class="form-label">Fecha Simulación</label>
                <input id="fecha_simulacion" class="form-control" type="date" name="fecha_simulacion"
                    value="{{ old('fecha_simulacion') }}">
            </div>

            <div class="col-md-6 col-lg-3">
                <label for="fecha_inicio" class="form-label">Fecha Inicio</label>
                <input id="fecha_inicio" class="form-control" type="date" name="fecha_inicio"
                    value="{{ old('fecha_inicio') }}">
            </div>
        </div>

        {{-- Fila 5: Fechas, tipo y observación --}}
        <div class="row mb-3">
            <div class="col-md-6 col-lg-3">
                <label for="fecha_termino" class="form-label">Fecha Término</label>
                <input id="fecha_termino" class="form-control" type="date" name="fecha_termino"
                    value="{{ old('fecha_termino') }}">
            </div>

            <div class="col-md-6 col-lg-3">
                <label for="horario" class="form-label">Horario</label>
                <select id="horario" name="horario" class="form-select">
                    <option value="Diurno">Diurno</option>
                    <option value="Vespertino">Vespertino</option>
                </select>
            </div>

            <div class="col-md-6 col-lg-3">
                <label for="tipo_tratamiento" class="form-label">Tipo Tratamiento</label>
                <select id="tipo_tratamiento" name="tipo_tratamiento" class="form-select">
                    <option value="RX Externa">RX Externa</option>
                    <option value="Braquiterapia">Braquiterapia</option>
                </select>
            </div>

            <div class="col-md-6 col-lg-3 d-flex align-items-center">
                <div class="form-check mt-4">
                    <input class="form-check-input" type="checkbox" id="cobertura_ges" name="cobertura_ges"
                        value="1" {{ old('cobertura_ges') ? 'checked' : '' }}>
                    <label class="form-check-label" for="cobertura_ges">Cobertura GES</label>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="observaciones" class="form-label">Observaciones</label>
            <textarea id="observaciones" class="form-control" name="observaciones" rows="3">{{ old('observaciones') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Tratamiento</button>
    </form>
</div>
<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<!-- jQuery y Select2 JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function () {
        const selects = [
            { id: '#id_diagnostico', placeholder: 'Seleccione un diagnóstico' },
            { id: '#id_zona', placeholder: 'Seleccione una zona irradiada' },
            { id: '#id_equipo', placeholder: 'Seleccione un equipo' },
            { id: '#id_radioterapeuta', placeholder: 'Seleccione un radioterapeuta' },
            { id: '#id_codigo_tratamiento', placeholder: 'Seleccione un código de tratamiento' },
            { id: '#id_codigo_ges', placeholder: 'Seleccione un código GES' },
            { id: '#id_quimioterapia', placeholder: 'Seleccione una quimioterapia' }
        ];

        selects.forEach(({ id, placeholder }) => {
            $(id).select2({
                placeholder: placeholder,
                allowClear: true,
                width: '100%',
            });
        });
    });
</script>
@endsection
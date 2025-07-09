@extends('layouts.app')

@section('content')
    <style>
        .filter-container {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 20px;
            max-width: 1200px;
            margin: 20px auto;
        }

        .filter-title {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            padding: 10px 15px;
            margin: -20px -20px 20px -20px;
            font-weight: bold;
            color: #495057;
            border-radius: 4px 4px 0 0;
        }
    </style>

    <div class="filter-container">
        <div class="filter-title">Filtros de búsqueda</div>

        <form>
            <div class="container">
                <div class="row">
                    {{-- Fecha de requerimiento --}}
                    <div class="col-md-3 mb-3">
                        <label for="fecha-desde" class="form-label">Fecha desde</label>
                        <input type="date" id="fecha-desde" name="fecha-desde" class="form-control" value="2020-01-01">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="fecha-hasta" class="form-label">Fecha hasta</label>
                        <input type="date" id="fecha-hasta" name="fecha-hasta" class="form-control" value="2025-06-12">
                    </div>

                    {{-- N° Archivo --}}
                    <div class="col-md-3 mb-3">
                        <label for="numero-archivo" class="form-label">N° Archivo</label>
                        <input type="text" id="numero-archivo" name="numero-archivo" class="form-control" placeholder="123456">
                    </div>

                    {{-- RUT Paciente --}}
                    <div class="col-md-3 mb-3">
                        <label for="rut-paciente" class="form-label">RUT Paciente</label>
                        <input type="text" id="rut-paciente" name="rut-paciente" class="form-control" placeholder="12.345.678-9" maxlength="12">
                    </div>

                    {{-- Más campos aquí --}}
                    {{-- Puedes dejar el resto de los <div class="col-md-3 mb-3"> ... </div> tal como ya estaban --}}
                    <!-- Nombres -->
                    <div class="col-md-3 mb-3">
                      <label for="nombres" class="form-label">Nombres</label>
                      <input type="text" id="nombres" name="nombres" class="form-control">
                    </div>

                    <!-- Primer Apellido -->
                    <div class="col-md-3 mb-3">
                      <label for="primer-apellido" class="form-label">Primer Apellido</label>
                      <input type="text" id="primer-apellido" name="primer-apellido" class="form-control">
                    </div>

                    <!-- Segundo Apellido -->
                    <div class="col-md-3 mb-3">
                      <label for="segundo-apellido" class="form-label">Segundo Apellido</label>
                      <input type="text" id="segundo-apellido" name="segundo-apellido" class="form-control">
                    </div>
                    <!-- Estado del requerimiento -->
                    <div class="col-md-3 mb-3">
                      <label for="categoria" class="form-label">Estado Requerimiento</label>
                        <select id="estado" name="estado" class="form-select">
                          <option value="">Seleccionar estado</option>
                          @foreach($estados as $estado)
                            <option value="{{ $estado->id_estado_proceso }}">{{ $estado->estado_proceso }}</option>
                          @endforeach
                        </select>
                    </div>
                    <!-- Categoría -->
                    <div class="col-md-3 mb-3">
                      <label for="categoria" class="form-label">Categoría</label>
                        <select id="categoria" name="categoria" class="form-select">
                          <option value="">Seleccionar categoría</option>
                          @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id_categoria }}">{{ $categoria->tipo_categoria }}</option>
                          @endforeach
                        </select>
                    </div>

                    <!-- CIE 10 -->
                    <div class="col-md-3 mb-3">
                      <label for="cie10" class="form-label">CIE 10</label>
                        <select id="cie10" name="cie10" class="form-select">
                          <option value="">Seleccionar CIE 10</option>
                          @foreach($cie10 as $codigo)
                            <option value="{{ $codigo->id_codigo }}">{{ $codigo->codigo }} - {{ $codigo->descripcion }}</option>
                          @endforeach
                        </select>
                    </div>

                    <!-- Emisor del requerimiento -->
                    <div class="col-md-3 mb-3">
                      <label for="emisor" class="form-label">Emisor del requerimiento</label>
                        <select id="emisor" name="emisor" class="form-select">
                          <option value="">Seleccionar emisor</option>
                          @foreach($emisores as $emisor)
                            <option value="{{ $emisor->id_emisor }}">{{ $emisor->emisor }}</option>
                          @endforeach
                        </select>
                    </div>

                    <!-- Entidad que resuelve -->
                    <div class="col-md-3 mb-3">
                      <label for="entidad-resuelve" class="form-label">Entidad que resuelve</label>
                        <select id="entidad" name="entidad" class="form-select">
                          <option value="">Seleccionar entidad</option>
                          @foreach($entidades as $entidad)
                            <option value="{{ $entidad->id_entidad }}">{{ $entidad->catalogo }}</option>
                          @endforeach
                        </select>
                    </div>

                    <!-- Requerimiento -->
                    <div class="col-md-3 mb-3">
                      <label for="requerimiento" class="form-label">Requerimiento</label>
                        <select id="requerimiento" name="requerimiento" class="form-select">
                          <option value="">Seleccionar requerimiento</option>
                          @foreach($requerimientos as $req)
                            <option value="{{ $req->id_requerimiento }}">{{ $req->requerimiento }}</option>
                          @endforeach
                        </select>
                    </div>

                    <!-- Fecha próxima revisión -->
                    <div class="col-md-3 mb-3">
                      <label for="fecha-revision" class="form-label">Fecha próxima revisión</label>
                      <input type="date" id="fecha-revision" name="fecha-revision" class="form-control">
                    </div>

                    <!-- Responsable -->
                    <div class="col-md-3 mb-3">
                      <label for="responsable" class="form-label">Responsable</label>
                        <select id="responsable" name="responsable" class="form-select">
                          <option value="">Seleccionar responsable</option>
                          @foreach($responsables as $res)
                            <option value="{{ $res->id_responsable }}">{{ $res->responsable }}</option>
                          @endforeach
                        </select>
                    </div>
                  </div>


                    {{-- Botones --}}
                    <div class="d-flex justify-content-between mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-search"></i> Buscar
                        </button>
                        <button type="reset" class="btn btn-secondary">
                            <i class="bi bi-arrow-counterclockwise"></i> Limpiar
                        </button>
                        <button type="button" class="btn btn-success">
                            <i class="bi bi-plus-circle"></i> Agregar Nuevo Requerimiento
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const rutInput = document.getElementById('rut-paciente');

    rutInput.addEventListener('input', function (e) {
        let value = e.target.value.replace(/\D/g, ''); // Eliminar todo lo que no sea dígito
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
    });
});
</script>
@endsection

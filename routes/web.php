<?php

use Illuminate\Support\Facades\Route;
use App\Models\Diagnostico;
use App\Models\ZonaIrradiada;
use App\Models\EquipoTratamiento;
use App\Models\Radioterapeuta;
use App\Models\CodigoTratamiento;
use App\Models\CodigoGES;
use App\Models\QuimioterapiaConcominante;
use App\Http\Controllers\RegistroTratamientoRadioterapiaController;

use App\Models\EstadoProceso;
use App\Models\Categoria;
use App\Models\CodigoCie10;
use App\Models\EmisorRequerimiento;
use App\Models\EntidadQueResuelve;
use App\Models\Requerimiento;
use App\Models\Responsable;
use App\Http\Controllers\GestionCasosOncologicosController;
use App\Http\Controllers\RegistroRequerimientoController;

Route::get('/', function () {
    return view('home');
});

Route::get('/registroTratamientoRadioterapia', function () {
    $diagnosticos = Diagnostico::all(); // o ->orderBy('nombre')->get()
    $zonas = ZonaIrradiada::all(); // o ->orderBy('nombre')->get()
    $equipos = EquipoTratamiento::all(); // o ->orderBy('nombre')->get()
    $radioterapeutas = Radioterapeuta::all(); // o ->orderBy('nombre')->get()
    $codigosTratamiento = CodigoTratamiento::all(); // o ->orderBy('nombre')->get()
    $codigosGes = CodigoGES::all(); // o ->orderBy('nombre')->get()
    $quimioterapias = QuimioterapiaConcominante::all(); // o ->orderBy('nombre')->get()
    return view('tratamientos.registroTratamientoRadioterapia', compact(
        'diagnosticos',
        'zonas',
        'equipos',
        'radioterapeutas',
        'codigosTratamiento',
        'codigosGes',
        'quimioterapias'
    ));
});

Route::post('/registroTratamientoRadioterapia', [RegistroTratamientoRadioterapiaController::class, 'store'])->name('registro-tratamiento.store');


Route::get('/gestionCasosOncologicos', [GestionCasosOncologicosController::class, 'gestionCasosOncologicos'])->name('gestionCasosOncologicos');
Route::get('/paciente/buscar', [GestionCasosOncologicosController::class, 'buscarPacientePorRut'])->name('paciente.buscar');
Route::post('/registro-requerimiento', [RegistroRequerimientoController::class, 'store'])->name('registroRequerimiento.store');

Route::get('/profile', function() {
    return redirect('/');
})->name('profile');

Route::get('/changepass', function() {
    return redirect('/');
})->name('changepass');

Route::get('/logout', function() {
    return redirect('/');
})->name('logout');


Route::get('/demo-filtro', function() {
    return view('demo-filtro');
})->name('demo-filtro');
Route::post('/validar-rut', [GestionCasosOncologicosController::class, 'validarRut'])->name('validar.rut');
Route::post('/obtener-cie10-por-rut', [GestionCasosOncologicosController::class, 'obtenerCie10PorRut'])->name('obtenerCie10PorRut');
Route::get('/requerimiento/detalles/{id}', [GestionCasosOncologicosController::class, 'obtenerDetallesRequerimiento'])->name('requerimiento.detalles');
Route::get('/caso-oncologico/info', [GestionCasosOncologicosController::class, 'infoCasoOncologico']);
Route::get('/requerimiento/diagnostico-resolucion/{id}', [GestionCasosOncologicosController::class, 'diagnosticoResolucion']);
Route::post('/gestion-requerimiento/guardar', [GestionCasosOncologicosController::class, 'guardarGestionRequerimiento']);
Route::get('/gestiones/opciones', [GestionCasosOncologicosController::class, 'opcionesGestion']);
Route::get('/respuestas/opciones', [GestionCasosOncologicosController::class, 'opcionesRespuesta']);
Route::get('/requerimiento/{id}/gestiones', [GestionCasosOncologicosController::class, 'obtenerGestionesRequerimiento']);
Route::post('/gestion-requerimiento/actualizar-respuesta', [GestionCasosOncologicosController::class, 'actualizarRespuestaGestion']);
Route::get('/cierres/opciones', [GestionCasosOncologicosController::class, 'opcionesCierre']);
Route::post('/requerimiento/cerrar', [GestionCasosOncologicosController::class, 'cerrarRequerimiento']);
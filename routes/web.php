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


Route::get('/gestionCasosOncologicos', [GestionCasosOncologicosController::class, 'index'])->name('gestionCasosOncologicos');

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
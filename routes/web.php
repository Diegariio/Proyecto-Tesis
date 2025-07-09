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


Route::get('/gestionCasosOncologicos', function () {
    return view('gestionOncologica.gestionCasosOncologicos', [
        'estados' => EstadoProceso::orderBy('estado_proceso')->get(),
        'categorias' => Categoria::orderBy('tipo_categoria')->get(),
        'cie10' => CodigoCIE10::all(),
        'emisores' => EmisorRequerimiento::all(),
        'entidades' => EntidadQueResuelve::orderBy('catalogo')->get(),
        'requerimientos' => Requerimiento::orderBy('requerimiento')->get(),
        'responsables' => Responsable::all(),
    ]);
})->name('gestionCasosOncologicos');

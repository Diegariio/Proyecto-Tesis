<?php

use Illuminate\Support\Facades\Route;
use App\Models\Diagnostico;
use App\Models\ZonaIrradiada;
use App\Models\EquipoTratamiento;
use App\Models\Radioterapeuta;
use App\Models\CodigoTratamiento;
use App\Models\CodigoGES;
use App\Models\QuimioterapiaConcominante;

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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegistroRequerimiento;
use App\Models\Categoria;
use App\Models\CodigoCie10;
use App\Models\EntidadQueResuelve;
use App\Models\Requerimiento;
use App\Models\Responsable;

class GestionCasosOncologicosController extends Controller
{
    public function index(Request $request)
    {
        $query = RegistroRequerimiento::with([
            'paciente',
            'codigo',
            'responsable',
            'requerimientos.emisor',
        ]);

        // Filtro por RUT
        if ($request->filled('rut-paciente')) {
            $rut = preg_replace('/[^0-9kK]/', '', $request->input('rut-paciente'));

            $query->whereHas('paciente', function ($q) use ($rut) {
                $q->whereRaw("REPLACE(REPLACE(REPLACE(rut, '.', ''), '-', ''), 'K', 'k') LIKE ?", ["%$rut%"]);
            });
        }

        // Otros filtros (puedes ir agregando más)
        if ($request->filled('fecha-desde')) {
            $query->whereDate('fecha', '>=', $request->input('fecha-desde'));
        }

        if ($request->filled('fecha-hasta')) {
            $query->whereDate('fecha', '<=', $request->input('fecha-hasta'));
        }

        // Trae los resultados si se realizó al menos una búsqueda
        $resultados = $request->all() ? $query->get() : collect();

        return view('gestionOncologica.gestionCasosOncologicos', [
            'resultados' => $resultados,
            'categorias' => Categoria::all(),
            'codigo' => CodigoCie10::all(),
            'entidades' => EntidadQueResuelve::all(),
            'requerimientos' => Requerimiento::all(),
            'responsables' => Responsable::all(),
        ]);
    }
}

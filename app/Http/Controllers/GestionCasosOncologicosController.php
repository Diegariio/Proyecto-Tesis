<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegistroRequerimiento;
use App\Models\Categoria;
use App\Models\CodigoCie10;
use App\Models\EntidadQueResuelve;
use App\Models\Requerimiento;
use App\Models\Responsable;
use App\Models\Paciente;

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

   public function buscarPacientePorRut(Request $request)
   {
       $rut = $request->query('rut');
       $paciente = \App\Models\Paciente::where('rut', $rut)->first();

       if ($paciente) {
           return response()->json([
               'success' => true,
               'paciente' => [
                   'rut' => $paciente->rut,
                   'nombre' => $paciente->nombre,
                   'apellidos' => $paciente->apellidos,
                   // agrega más campos si necesitas
               ]
           ]);
       } else {
           return response()->json(['success' => false, 'message' => 'Paciente no encontrado']);
       }
   }

   public function validarRut(Request $request)
{
    $rut = $request->input('rut');
    
    // Validar formato de RUT chileno
    if (!$this->validarFormatoRut($rut)) {
        return response()->json([
            'valido' => false,
            'mensaje' => 'Formato de RUT inválido'
        ]);
    }
    
    // Validar que existe en BD
    $paciente = Paciente::where('rut', $rut)->first();
    if (!$paciente) {
        return response()->json([
            'valido' => false,
            'mensaje' => 'RUT no encontrado en la base de datos'
        ]);
    }
    
    return response()->json([
        'valido' => true,
        'mensaje' => 'RUT válido',
        'paciente' => [
            'nombre' => $paciente->nombre,
            'apellidos' => $paciente->apellidos
        ]
    ]);
}

private function validarFormatoRut($rut)
{
    // 1. Limpiar el RUT (solo números y K)
    $rut = preg_replace('/[^0-9kK]/', '', $rut);
    
    if (strlen($rut) < 2) return false;
    
    // 2. Separar número y dígito verificador
    $dv = substr($rut, -1);        // Último carácter (DV)
    $numero = substr($rut, 0, -1); // Todo menos el último (número)
    
    // 3. Calcular DV esperado
    $i = 2;
    $suma = 0;
    
    // Multiplicar cada dígito por su peso (de derecha a izquierda)
    foreach (array_reverse(str_split($numero)) as $v) {
        if ($i == 8) $i = 2; // Los pesos van de 2 a 7, luego se repiten
        $suma += $v * $i;
        ++$i;
    }
    
    // 4. Calcular DV
    $dvEsperado = 11 - ($suma % 11);
    
    // Casos especiales
    if ($dvEsperado == 11) $dvEsperado = '0';
    if ($dvEsperado == 10) $dvEsperado = 'K';
    else $dvEsperado = (string)$dvEsperado;
    
    // 5. Comparar
    return strtoupper($dv) == $dvEsperado;
}
}

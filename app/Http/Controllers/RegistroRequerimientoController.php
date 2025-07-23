<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\RegistroRequerimiento;

class RegistroRequerimientoController extends Controller
{
    public function store(Request $request)
    {   

        // Validar los datos recibidos
        $request->validate([
            'rut' => 'required|exists:paciente,rut',
            'requerimiento' => 'required|exists:requerimiento,id_requerimiento',
            // Agrega aquí las validaciones de los otros campos del formulario
        ]);

        // Buscar el paciente por RUT
        $paciente = Paciente::where('rut', $request->rut)->first();

        // Crear el registro de requerimiento
        $registro = new RegistroRequerimiento();
        $registro->rut = $paciente->rut; // Ajusta el nombre del campo si es necesario
        $registro->id_requerimiento = $request->requerimiento;
        $registro->id_codigo = 1; 
        $registro->id_gestion= 1; 
        $registro->id_categoria= 1; 
        $registro->id_responsable= 1; 

        // Asigna aquí los otros campos del formulario
        $registro->save();

        // Redirigir o mostrar mensaje de éxito
        return redirect()->back()->with('success', 'Requerimiento registrado correctamente');
    }
}

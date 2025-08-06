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
            'categoria' => 'required|exists:categoria,id_categoria',
            'emisor' => 'required|exists:emisor_requerimiento,id_emisor',
            'fecha_requerimiento' => 'required|date',
            'fecha_proxima_revision' => 'required|date|after:fecha_requerimiento',
            'requerimiento' => 'required|exists:requerimiento,id_requerimiento',
            'entidad' => 'required|exists:entidad_que_resuelve,id_entidad',
            'responsable' => 'required|exists:responsable,id_responsable',
            'observaciones' => 'nullable|string|max:500'
        ]);

        // Buscar el paciente por RUT
        $paciente = Paciente::where('rut', $request->rut)->first();

        // Crear el registro de requerimiento
        $registro = new RegistroRequerimiento();
        $registro->rut = $paciente->rut;
        $registro->id_requerimiento = $request->requerimiento;
        $registro->id_categoria = $request->categoria;
        $registro->id_responsable = $request->responsable;
        $registro->id_entidad = $request->entidad;
        $registro->id_emisor = $request->emisor;
        $registro->fecha = $request->fecha_requerimiento;
        $registro->fecha_proxima_revision = $request->fecha_proxima_revision;
        $registro->observaciones = $request->observaciones;
        
        // Valores por defecto para campos requeridos por la BD
        $registro->id_codigo = 1; // Valor por defecto
        $registro->id_gestion = 1; // Valor por defecto

        $registro->save();

        // Redirigir con mensaje de éxito para SweetAlert
        return redirect()->back()->with('success_alert', 'Requerimiento registrado correctamente');
    }
}

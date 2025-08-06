<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegistroTratamientoRadioterapia;

class RegistroTratamientoRadioterapiaController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validación
        $validatedData = $request->validate([
            'id_diagnostico' => 'required|exists:tron_diagnostico,id_diagnostico',
            'id_zona' => 'required|exists:tron_zona_irradiada,id_zona',
            'id_equipo' => 'required|exists:tron_equipo_tratamiento,id_equipo',
            'id_radioterapeuta' => 'required|exists:tron_radioterapeuta,id_radioterapeuta',
            'id_codigo_tratamiento' => 'required|exists:tron_codigo_tratamiento,id_codigo_tratamiento',
            'id_codigo_ges' => 'nullable|exists:tron_codigo_ges,id_codigo_ges',
            'id_quimioterapia' => 'nullable|exists:tron_quimioterapia_concominante,id_quimioterapia_concominante',
            'tipo_atencion' => 'required|string',
            'n_sesiones_programadas' => 'required|integer|min:1|max:40',
            'n_sesiones_realizadas' => 'required|integer|min:1|max:40',
            'intencion' => 'required|string|in:Curativo,Paliativo',
            'fecha_indicacion' => 'nullable|date',
            'fecha_comite' => 'nullable|date',
            'fecha_simulacion' => 'nullable|date',
            'fecha_inicio' => 'nullable|date',
            'fecha_termino' => 'nullable|date',
            'horario' => 'required|string|in:Diurno,Vespertino',
            'tipo_tratamiento' => 'required|string|in:RX Externa,Braquiterapia',
            'cobertura_ges' => 'nullable|boolean',
            'observaciones' => 'nullable|string',
        ]);

        // 2. Marcar cobertura_ges como false si no viene
        $validatedData['cobertura_ges'] = $request->has('cobertura_ges');

        // 3. Crear y guardar el tratamiento
        $tratamiento = new RegistroTratamientoRadioterapia();
        $tratamiento->fill($validatedData);
        $tratamiento->save();

        // 4. Redirigir con mensaje
        return redirect()->back()->with('success_alert', 'Registro de tratamiento guardado correctamente');
    }
}
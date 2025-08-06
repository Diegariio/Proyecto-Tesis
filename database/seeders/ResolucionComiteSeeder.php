<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ResolucionComite;

class ResolucionComiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $resoluciones = [
            'QT rescate R-bendamustina x DAC 4 ciclos y evaluar respuesta',
            'AGENDADA PERO SIN REGISTRO DE COMITÉ',
            'Leucemia aguda debut en pcte no FIT para Quimioterapia intensiva, subsidiario a manejo paliativo en su centro de origen ( H Coronel)',
            'En contexto de linfoma T agresivo, se define refractariedad a tratamiento, corresponde manejo paliativo en su centro de origen H Lota.',
            'QT induccion Flagida + estudio HLA pcte y familia para presentar a TPH',
            'MAnejo activo, paciente fit para quimioterapia intensiva.Inicia quimioterapia induccion BFM <45 años + ritiuximab x DAC +- itk segun biologia molecular . Estudio HLA pcte y familiaSegun riesgo citogenetico y dinamica de respuesta a definir TPH Alogenico',
            'SE DECIDE QT PALIATIVA Y CCPP (YA ESTÁ EN SEGUIMIENTO)',
            'BIOPSIA POR RX INTERVENCIONAL DE LESION HEPATICA',
            'A SEGUIMIENTO POR HEPATOLOGIA',
            'EVALUADO EN COMITE SE DECIDE CIRUGIA DE ENTRADA',
            'SE DECIDE CONTINUAR CON SEGUIMIENTO',
            'EVALUADO EN COMITE SE DECIDE QMT ADYUVANTE',
            'MASA QUE RETRAE FONDO, IMPRESIONA CA DE VESÍCULA. SE EVALUAN IMAGENES, ENGROSAMIENTO EN FONDO VESICULAR, SE PODRIA INTENTAR BIOPSIA PERCUTANEA IC A CCPPIC A ONCOLOGIA CON RESUTADO DE BIOPSIA PENDIENTE',
            'MANTENER CCPP',
            'A QT ADYUVANTE CON FOLFIRINOX',
            'SE DECIDE COMPLETAR QMT ADYUVANTE',
            'SE DECIDE CIRUGÍA (MC KEOWN)',
            'A ONCOLOGIA PARA QT ADYUVANTE',
            'cx vs amputacion. Se desestima reirradiacion por riesgo de ulceracion de la piel, y qt por baja respuesta. No hay financiamiento para Inmunoterapia.',
            'Se decide en comité radioterapia ("consolidación/paliativa").',
            'evaluar en comite de coloprocto CX ?',
            // ... el resto no se usará
        ];
    
        // Solo los primeros 21
        $resoluciones = array_slice($resoluciones, 0, 21);
    
        foreach ($resoluciones as $resolucion) {
            ResolucionComite::create([
                'resolucion_comite' => $resolucion,
                'id_tiene' => rand(1, 21),
            ]);
        }
    }
}

<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Paciente;

class PacienteSeeder extends Seeder
{
   public function run(): void
   {
    $pacientes = [
        ['rut' => '7.901.833-3', 'nombre' => 'Juan Esteban', 'primer_apellido' => 'Pérez', 'segundo_apellido' => 'Gómez', 'id_comuna' => 1, 'id_servicio_salud' => 1, 'id_sexo' => 1],
        ['rut' => '6.712.280-1', 'nombre' => 'María José', 'primer_apellido' => 'López', 'segundo_apellido' => 'Fernández', 'id_comuna' => 45, 'id_servicio_salud' => 3, 'id_sexo' => 2],
        ['rut' => '26.606.887-5', 'nombre' => 'Carlos Andrés', 'primer_apellido' => 'Martínez', 'segundo_apellido' => 'Soto', 'id_comuna' => 120, 'id_servicio_salud' => 7, 'id_sexo' => 1],
        ['rut' => '7.762.628-K', 'nombre' => 'Ana Beatriz', 'primer_apellido' => 'García', 'segundo_apellido' => 'Ruiz', 'id_comuna' => 89, 'id_servicio_salud' => 5, 'id_sexo' => 2],
        ['rut' => '18.342.068-2', 'nombre' => 'Pedro Pablo', 'primer_apellido' => 'Rodríguez', 'segundo_apellido' => 'Silva', 'id_comuna' => 200, 'id_servicio_salud' => 12, 'id_sexo' => 1],
        ['rut' => '15.063.707-4', 'nombre' => 'Laura Fernanda', 'primer_apellido' => 'Hernández', 'segundo_apellido' => 'Morales', 'id_comuna' => 156, 'id_servicio_salud' => 8, 'id_sexo' => 2],
        ['rut' => '2.780.792-5', 'nombre' => 'Diego Ignacio', 'primer_apellido' => 'Vásquez', 'segundo_apellido' => 'Torres', 'id_comuna' => 78, 'id_servicio_salud' => 4, 'id_sexo' => 1],
        ['rut' => '30.801.956-K', 'nombre' => 'Carmen Gloria', 'primer_apellido' => 'Jiménez', 'segundo_apellido' => 'Castillo', 'id_comuna' => 234, 'id_servicio_salud' => 11, 'id_sexo' => 2],
        ['rut' => '34.865.257-5', 'nombre' => 'Luis Felipe', 'primer_apellido' => 'Moreno', 'segundo_apellido' => 'Aguilar', 'id_comuna' => 167, 'id_servicio_salud' => 9, 'id_sexo' => 1],
        ['rut' => '14.815.545-3', 'nombre' => 'Diego Antonio', 'primer_apellido' => 'Núñez', 'segundo_apellido' => 'Vargas', 'id_comuna' => 298, 'id_servicio_salud' => 14, 'id_sexo' => 2],
        ['rut' => '25.541.515-8', 'nombre' => 'Roberto Alejandro', 'primer_apellido' => 'Sánchez', 'segundo_apellido' => 'Pinto', 'id_comuna' => 23, 'id_servicio_salud' => 2, 'id_sexo' => 1],
        ['rut' => '26.335.658-6', 'nombre' => 'Francisca Belén', 'primer_apellido' => 'Contreras', 'segundo_apellido' => 'Díaz', 'id_comuna' => 145, 'id_servicio_salud' => 6, 'id_sexo' => 2],
        ['rut' => '15.517.731-4', 'nombre' => 'Andrés Nicolás', 'primer_apellido' => 'Espinoza', 'segundo_apellido' => 'Ramos', 'id_comuna' => 67, 'id_servicio_salud' => 10, 'id_sexo' => 1],
        ['rut' => '25.548.374-9', 'nombre' => 'Valentina Sofía', 'primer_apellido' => 'Muñoz', 'segundo_apellido' => 'Herrera', 'id_comuna' => 189, 'id_servicio_salud' => 13, 'id_sexo' => 2],
        ['rut' => '16.233.043-8', 'nombre' => 'Matías Alonso', 'primer_apellido' => 'Rojas', 'segundo_apellido' => 'Delgado', 'id_comuna' => 112, 'id_servicio_salud' => 15, 'id_sexo' => 1],
        ['rut' => '4.613.253-K', 'nombre' => 'Sofía Antonia', 'primer_apellido' => 'Poblete', 'segundo_apellido' => 'Cortés', 'id_comuna' => 276, 'id_servicio_salud' => 1, 'id_sexo' => 2],
        ['rut' => '11.981.401-4', 'nombre' => 'Gonzalo Tomás', 'primer_apellido' => 'Figueroa', 'segundo_apellido' => 'Mendoza', 'id_comuna' => 34, 'id_servicio_salud' => 3, 'id_sexo' => 1],
        ['rut' => '25.287.934-K', 'nombre' => 'Camila Andrea', 'primer_apellido' => 'Araya', 'segundo_apellido' => 'Valenzuela', 'id_comuna' => 203, 'id_servicio_salud' => 7, 'id_sexo' => 2],
        ['rut' => '1.649.584-0', 'nombre' => 'Sebastián Emilio', 'primer_apellido' => 'Carrasco', 'segundo_apellido' => 'Peña', 'id_comuna' => 158, 'id_servicio_salud' => 4, 'id_sexo' => 1],
        ['rut' => '12.328.543-3', 'nombre' => 'Isidora Catalina', 'primer_apellido' => 'Bravo', 'segundo_apellido' => 'Campos', 'id_comuna' => 92, 'id_servicio_salud' => 8, 'id_sexo' => 2],
        ['rut' => '21.012.009-2', 'nombre' => 'Diego Antonio', 'primer_apellido' => 'Vargas', 'segundo_apellido' => 'Gómez', 'id_comuna' => 92, 'id_servicio_salud' => 8, 'id_sexo' => 1],
    ];
    

       // Array para almacenar números de archivo ya generados y evitar duplicados
       $numerosArchivosUsados = [];
       
       foreach ($pacientes as $paciente) {
           // Generar número de archivo único aleatorio de máximo 8 dígitos
           do {
               $numeroArchivo = str_pad(rand(1, 99999999), 8, '0', STR_PAD_LEFT);
           } while (in_array($numeroArchivo, $numerosArchivosUsados));
           
           $numerosArchivosUsados[] = $numeroArchivo;
           
           // Asignar edad específica para Diego Antonio, aleatoria para otros
           $edad = ($paciente['rut'] === '21.012.009-2') ? 23 : rand(18, 85);
           
           Paciente::updateOrCreate(
               ['rut' => $paciente['rut']],
               [
                   'numero_archivo' => $numeroArchivo,
                   'nombre' => $paciente['nombre'], 
                   'primer_apellido' => $paciente['primer_apellido'],
                   'segundo_apellido' => $paciente['segundo_apellido'],
                   'edad' => $edad,
                   'id_comuna' => $paciente['id_comuna'],
                   'id_servicio' => $paciente['id_servicio_salud'],
                   'id_sexo' => $paciente['id_sexo']
               ]
           );
       }
   }
}
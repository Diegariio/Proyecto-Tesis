<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Paciente;

class PacienteSeeder extends Seeder
{
   public function run(): void
   {
    $pacientes = [
        ['rut' => '7.901.833-3', 'nombre' => 'Juan Esteban', 'apellidos' => 'Pérez Gómez', 'id_comuna' => 1, 'id_servicio_salud' => 1, 'id_sexo' => 1],
        ['rut' => '6.712.280-1', 'nombre' => 'María José', 'apellidos' => 'López Fernández', 'id_comuna' => 45, 'id_servicio_salud' => 3, 'id_sexo' => 2],
        ['rut' => '26.606.887-5', 'nombre' => 'Carlos Andrés', 'apellidos' => 'Martínez Soto', 'id_comuna' => 120, 'id_servicio_salud' => 7, 'id_sexo' => 1],
        ['rut' => '7.762.628-K', 'nombre' => 'Ana Beatriz', 'apellidos' => 'García Ruiz', 'id_comuna' => 89, 'id_servicio_salud' => 5, 'id_sexo' => 2],
        ['rut' => '18.342.068-2', 'nombre' => 'Pedro Pablo', 'apellidos' => 'Rodríguez Silva', 'id_comuna' => 200, 'id_servicio_salud' => 12, 'id_sexo' => 1],
        ['rut' => '15.063.707-4', 'nombre' => 'Laura Fernanda', 'apellidos' => 'Hernández Morales', 'id_comuna' => 156, 'id_servicio_salud' => 8, 'id_sexo' => 2],
        ['rut' => '2.780.792-5', 'nombre' => 'Diego Ignacio', 'apellidos' => 'Vásquez Torres', 'id_comuna' => 78, 'id_servicio_salud' => 4, 'id_sexo' => 1],
        ['rut' => '30.801.956-K', 'nombre' => 'Carmen Gloria', 'apellidos' => 'Jiménez Castillo', 'id_comuna' => 234, 'id_servicio_salud' => 11, 'id_sexo' => 2],
        ['rut' => '34.865.257-5', 'nombre' => 'Luis Felipe', 'apellidos' => 'Moreno Aguilar', 'id_comuna' => 167, 'id_servicio_salud' => 9, 'id_sexo' => 1],
        ['rut' => '14.815.545-3', 'nombre' => 'Diego Antonio', 'apellidos' => 'Núñez Vargas', 'id_comuna' => 298, 'id_servicio_salud' => 14, 'id_sexo' => 2],
        ['rut' => '25.541.515-8', 'nombre' => 'Roberto Alejandro', 'apellidos' => 'Sánchez Pinto', 'id_comuna' => 23, 'id_servicio_salud' => 2, 'id_sexo' => 1],
        ['rut' => '26.335.658-6', 'nombre' => 'Francisca Belén', 'apellidos' => 'Contreras Díaz', 'id_comuna' => 145, 'id_servicio_salud' => 6, 'id_sexo' => 2],
        ['rut' => '15.517.731-4', 'nombre' => 'Andrés Nicolás', 'apellidos' => 'Espinoza Ramos', 'id_comuna' => 67, 'id_servicio_salud' => 10, 'id_sexo' => 1],
        ['rut' => '25.548.374-9', 'nombre' => 'Valentina Sofía', 'apellidos' => 'Muñoz Herrera', 'id_comuna' => 189, 'id_servicio_salud' => 13, 'id_sexo' => 2],
        ['rut' => '16.233.043-8', 'nombre' => 'Matías Alonso', 'apellidos' => 'Rojas Delgado', 'id_comuna' => 112, 'id_servicio_salud' => 15, 'id_sexo' => 1],
        ['rut' => '4.613.253-K', 'nombre' => 'Sofía Antonia', 'apellidos' => 'Poblete Cortés', 'id_comuna' => 276, 'id_servicio_salud' => 1, 'id_sexo' => 2],
        ['rut' => '11.981.401-4', 'nombre' => 'Gonzalo Tomás', 'apellidos' => 'Figueroa Mendoza', 'id_comuna' => 34, 'id_servicio_salud' => 3, 'id_sexo' => 1],
        ['rut' => '25.287.934-K', 'nombre' => 'Camila Andrea', 'apellidos' => 'Araya Valenzuela', 'id_comuna' => 203, 'id_servicio_salud' => 7, 'id_sexo' => 2],
        ['rut' => '1.649.584-0', 'nombre' => 'Sebastián Emilio', 'apellidos' => 'Carrasco Peña', 'id_comuna' => 158, 'id_servicio_salud' => 4, 'id_sexo' => 1],
        ['rut' => '12.328.543-3', 'nombre' => 'Isidora Catalina', 'apellidos' => 'Bravo Campos', 'id_comuna' => 92, 'id_servicio_salud' => 8, 'id_sexo' => 2],
        ['rut' => '21.012.009-2', 'nombre' => 'Diego Antonio', 'apellidos' => 'Vargas Gómez', 'id_comuna' => 92, 'id_servicio_salud' => 8, 'id_sexo' => 1],
    ];
    

       foreach ($pacientes as $paciente) {
           Paciente::updateOrCreate(
               ['rut' => $paciente['rut']],
               [
                   'nombre' => $paciente['nombre'], 
                   'apellidos' => $paciente['apellidos'],
                   'id_comuna' => $paciente['id_comuna'],
                   'id_servicio' => $paciente['id_servicio_salud'],
                   'id_sexo' => $paciente['id_sexo']
               ]
           );
       }
   }
}
<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Paciente;

class PacienteSeeder extends Seeder
{
   public function run(): void
   {
       $pacientes = [
           ['rut' => '12345678-9', 'nombre' => 'Juan', 'apellidos' => 'Pérez Gómez', 'id_comuna' => 1, 'id_servicio_salud' => 1, 'id_sexo' => 1],
           ['rut' => '98765432-1', 'nombre' => 'María', 'apellidos' => 'López Fernández', 'id_comuna' => 45, 'id_servicio_salud' => 3, 'id_sexo' => 2],
           ['rut' => '11223344-5', 'nombre' => 'Carlos', 'apellidos' => 'Martínez Soto', 'id_comuna' => 120, 'id_servicio_salud' => 7, 'id_sexo' => 1],
           ['rut' => '55667788-0', 'nombre' => 'Ana', 'apellidos' => 'García Ruiz', 'id_comuna' => 89, 'id_servicio_salud' => 5, 'id_sexo' => 2],
           ['rut' => '33445566-K', 'nombre' => 'Pedro', 'apellidos' => 'Rodríguez Silva', 'id_comuna' => 200, 'id_servicio_salud' => 12, 'id_sexo' => 1],
           ['rut' => '77889900-2', 'nombre' => 'Laura', 'apellidos' => 'Hernández Morales', 'id_comuna' => 156, 'id_servicio_salud' => 8, 'id_sexo' => 2],
           ['rut' => '22334455-7', 'nombre' => 'Diego', 'apellidos' => 'Vásquez Torres', 'id_comuna' => 78, 'id_servicio_salud' => 4, 'id_sexo' => 1],
           ['rut' => '99887766-3', 'nombre' => 'Carmen', 'apellidos' => 'Jiménez Castillo', 'id_comuna' => 234, 'id_servicio_salud' => 11, 'id_sexo' => 2],
           ['rut' => '44556677-8', 'nombre' => 'Luis', 'apellidos' => 'Moreno Aguilar', 'id_comuna' => 167, 'id_servicio_salud' => 9, 'id_sexo' => 1],
           ['rut' => '66778899-1', 'nombre' => 'Patricia', 'apellidos' => 'Núñez Vargas', 'id_comuna' => 298, 'id_servicio_salud' => 14, 'id_sexo' => 2],
           ['rut' => '88990011-4', 'nombre' => 'Roberto', 'apellidos' => 'Sánchez Pinto', 'id_comuna' => 23, 'id_servicio_salud' => 2, 'id_sexo' => 1],
           ['rut' => '00112233-6', 'nombre' => 'Francisca', 'apellidos' => 'Contreras Díaz', 'id_comuna' => 145, 'id_servicio_salud' => 6, 'id_sexo' => 2],
           ['rut' => '11334455-9', 'nombre' => 'Andrés', 'apellidos' => 'Espinoza Ramos', 'id_comuna' => 67, 'id_servicio_salud' => 10, 'id_sexo' => 1],
           ['rut' => '22445566-0', 'nombre' => 'Valentina', 'apellidos' => 'Muñoz Herrera', 'id_comuna' => 189, 'id_servicio_salud' => 13, 'id_sexo' => 2],
           ['rut' => '33556677-K', 'nombre' => 'Matías', 'apellidos' => 'Rojas Delgado', 'id_comuna' => 112, 'id_servicio_salud' => 15, 'id_sexo' => 1],
           ['rut' => '55778899-2', 'nombre' => 'Sofía', 'apellidos' => 'Poblete Cortés', 'id_comuna' => 276, 'id_servicio_salud' => 1, 'id_sexo' => 2],
           ['rut' => '77990011-5', 'nombre' => 'Gonzalo', 'apellidos' => 'Figueroa Mendoza', 'id_comuna' => 34, 'id_servicio_salud' => 3, 'id_sexo' => 1],
           ['rut' => '99001122-7', 'nombre' => 'Camila', 'apellidos' => 'Araya Valenzuela', 'id_comuna' => 203, 'id_servicio_salud' => 7, 'id_sexo' => 2],
           ['rut' => '00223344-8', 'nombre' => 'Sebastián', 'apellidos' => 'Carrasco Peña', 'id_comuna' => 158, 'id_servicio_salud' => 4, 'id_sexo' => 1],
           ['rut' => '44667788-1', 'nombre' => 'Isidora', 'apellidos' => 'Bravo Campos', 'id_comuna' => 92, 'id_servicio_salud' => 8, 'id_sexo' => 2],
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
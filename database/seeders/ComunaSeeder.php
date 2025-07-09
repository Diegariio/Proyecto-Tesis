<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comuna;

class ComunaSeeder extends Seeder
{
    public function run(): void
    {
    $comunas = [
        'Aisen', 'Algarrobo', 'Alhue', 'Alto Biobio', 'Alto Del Carmen', 'Alto Hospicio',
        'Ancud', 'Andacollo', 'Angol', 'Antartica', 'Antofagasta', 'Antuco', 'Arauco', 'Arica',
        'Buin', 'Bulnes', 'Cabildo', 'Cabo De Hornos (Exnavarino)', 'Cabrero', 'Calama',
        'Calbuco', 'Caldera', 'Calera', 'Calera De Tango', 'Calle Larga', 'Camarones', 'Camiña',
        'Canela', 'Cañete', 'Carahue', 'Cartagena', 'Casablanca', 'Castro', 'Catemu',
        'Cauquenes', 'Cerrillos', 'Cerro Navia', 'Chépica', 'Chaiten', 'Chanco', 'Chañaral',
        'Chiguayante', 'Chilechico', 'Chillan', 'Chimbarongo', 'Cholchol', 'Chonchi', 'Cisnes',
        'Cobquecura', 'Cochamo', 'Cochrane', 'Codegua', 'Coelemu', 'Coihueco', 'Coinco',
        'Colbun', 'Colchane', 'Colina', 'Collipulli', 'Coltauco', 'Combarbala', 'Concepcion',
        'Conchali', 'Concon', 'Constitucion', 'Contulmo', 'Copiapo', 'Coquimbo', 'Coronel',
        'Corral', 'Coyhaique', 'Cunco', 'Curacautin', 'Curacavi', 'Curaco De Velez',
        'Curanilahue', 'Curarrehue', 'Curepto', 'Curico', 'Dalcahue', 'Diego De Almagro',
        'Doñihue', 'El Bosque', 'El Monte', 'El Quisco', 'El Tabo', 'El Carmen', 'Empedrado',
        'Ercilla', 'Estacion Central', 'Florida', 'Freire', 'Freirina', 'Fresia', 'Frutillar',
        'Futaleufu', 'Futrono', 'Galvarino', 'General Lagos', 'Gorbea', 'Graneros', 'Guaitescas',
        'Hijuelas', 'Hualaihue', 'Hualpen', 'Hualqui', 'Huara', 'Huasco', 'Huechuraba',
        'Illapel', 'Independencia', 'Iquique', 'Isla De Maipo', 'Isla De Pascua', 'Juan Fernandez',
        'La Cisterna', 'La Cruz', 'La Estrella', 'La Florida', 'La Granja', 'La Higuera',
        'La Ligua', 'La Pintana', 'La Reina', 'La Serena', 'La Union', 'Lago Ranco', 'Lagoverde',
        'Laguna Blanca', 'Laja', 'Lampa', 'Lanco', 'Laraquete', 'Las Cabras', 'Las Condes',
        'Lautaro', 'Lebu', 'Licanten', 'Limache', 'Linares', 'Litueche', 'Llaillay', 'Llanquihue',
        'Lo Barnechea', 'Lo Espejo', 'Lo Prado', 'Lolol', 'Loncoche', 'Longavi', 'Lonquimay',
        'Los Alamos', 'Los Andes', 'Los Angeles', 'Los Lagos', 'Los Muermos', 'Los Sauces',
        'Los Vilos', 'Lota', 'Lumaco', 'Máfil', 'Machali', 'Macul', 'Maipu', 'Malloa',
        'Marchihue', 'Maria Elena', 'Maria Pinto', 'Mariquina', 'Maule', 'Maullin', 'Mejillones',
        'Melipeuco', 'Melipilla', 'Molina', 'Montepatria', 'Mulchen', 'Nacimiento', 'Nancagua',
        'Natales', 'Navidad', 'Negrete', 'Ninhue', 'Nogales', 'Nueva Imperial', 'Ñiquen', 'Ñuñoa',
        'Ohiggins', 'Olivar', 'Ollague', 'Olmuhe', 'Osorno', 'Ovalle', 'Padre Hurtado',
        'Padre Las Casas', 'Paiguano', 'Paillaco', 'Paine', 'Palena', 'Palmilla', 'Panguipulli',
        'Panquehue', 'Papudo', 'Paredones', 'Parral', 'Pedro Aguirre Cerda', 'Pelarco',
        'Pelluhue', 'Pemuco', 'Pencahue', 'Penco', 'Peñaflor', 'Peñalolen', 'Peralillo',
        'Perquenco', 'Petorca', 'Peumo', 'Pica', 'Pichidegua', 'Pichilemu', 'Pinto', 'Pirque',
        'Pitufquen', 'Placilla', 'Portezuelo', 'Porvenir', 'Pozo Almonte', 'Primavera',
        'Providencia', 'Puchuncavi', 'Pucon', 'Pudahuel', 'Puente Alto', 'Puerto Montt',
        'Puerto Octay', 'Puerto Varas', 'Puerto Wiliams', 'Pumanque', 'Punitaqui', 'Punta Arenas',
        'Puqueldon', 'Puren', 'Purranque', 'Putaendo', 'Putre', 'Puyehue', 'Queilen', 'Quellon',
        'Quemchi', 'Quilaco', 'Quilicura', 'Quilleco', 'Quillon', 'Quillota', 'Quilpue', 'Quinchao',
        'Quinta De Tilcoco', 'Quinta Normal', 'Quintero', 'Quirihue', 'Rancagua', 'Ranquil',
        'Ríoibáñez', 'Rauco', 'Recoleta', 'Renaico', 'Renca', 'Rengo', 'Requinoa', 'Retiro',
        'Rinconada', 'Rio Bueno', 'Rio Claro', 'Rio Hurtado', 'Rio Negro', 'Rio Verde', 'Romeral',
        'Saavedra', 'Sagrada Familia', 'Salamanca', 'San Antonio', 'San Carlos', 'San Clemente',
        'San Esteban', 'San Fabian', 'San Felipe', 'San Fernando', 'San Franciscode Mostazal',
        'San Gregorio', 'San Ignacio', 'San Javier De Loncomilla', 'San Joaquin',
        'San Jose De Maipo', 'San Juan De La Costa', 'San Miguel', 'San Nicolas', 'San Pablo',
        'San Pedro', 'San Pedro De Atacama', 'San Pedro De La Paz', 'San Rafael', 'San Ramon',
        'San Rosendo', 'San Vicente De Tagua Tagua', 'Sanbernardo', 'Santa Barbara', 'Santa Juana',
        'Santa Maria', 'Santacruz', 'Santiago', 'Santo Domingo', 'Sierra Gorda', 'Talagante',
        'Talca', 'Talcahuano', 'Taltal', 'Temuco', 'Teno', 'Teodoro Schmidt', 'Tierra Amarilla',
        'Tiltil', 'Timaukel', 'Tirua', 'Tocopilla', 'Tolten', 'Tome', 'Torres Del Paine', 'Tortel',
        'Traiguen', 'Trehuaco', 'Tucapel', 'Valdivia', 'Vallenar', 'Valparaiso', 'Vichuquen',
        'Victoria', 'Vicuña', 'Vilcun', 'Villa Alegre', 'Villa Alemana', 'Villarrica',
        'Viña Del Mar', 'Vitacura', 'Yerbas Buenas', 'Yumbel', 'Yungay', 'Zapallar'
    ];
        foreach ($comunas as $nombre) {
            Comuna::firstOrCreate(['comuna' => $nombre]);
        }
    }
}

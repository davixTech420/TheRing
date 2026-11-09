<?php

namespace Database\Seeders;

use App\Models\Dress;
use Illuminate\Database\Seeder;

class DressSeeder extends Seeder
{
    public function run(): void
    {
        $dresses = [
            // ==================== BODAS ====================
            [
                'name' => 'Corte Princesa Real de Encaje Francés',
                'category' => 'boda',
                'silhouette' => 'princesa',
                'color' => 'Blanco Nupcial / Marfil',
                'price' => 850000,
                'images' => [
                    'https://images.unsplash.com/photo-1594552072238-b8a33785b261?q=80&w=800',
                    'https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=800',
                ],
                'description' => 'Majestuosa falda de tul ilusión con corset estructurado bordado a mano con pedrería y perlas cultivadas. Espalda tipo corsetería ajustable y velo catedral opcional.',
                'sizes' => ['XS', 'S', 'M', 'L', 'A Medida'],
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'name' => 'Corte Sirena Glamour & Cola Catedral',
                'category' => 'boda',
                'silhouette' => 'sirena',
                'color' => 'Blanco Marfil',
                'price' => 950000,
                'images' => [
                    'https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=800',
                    'https://images.unsplash.com/photo-1583939003579-730e3918a45a?q=80&w=800',
                ],
                'description' => 'Silueta entallada que realza la figura con encaje chantilly, transparencias sutiles en escote V pronunciado y una deslumbrante cola de 2.5 metros con botones forrados.',
                'sizes' => ['S', 'M', 'L'],
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'name' => 'Línea A Romántica con Apliques Florales 3D',
                'category' => 'boda',
                'silhouette' => 'linea_a',
                'color' => 'Champagne Suave',
                'price' => 780000,
                'images' => [
                    'https://images.unsplash.com/photo-1583939003579-730e3918a45a?q=80&w=800',
                    'https://images.unsplash.com/photo-1549465220-1a8b9238cd48?q=80&w=800',
                ],
                'description' => 'Caída fluida de gasa de seda con bordados de ramas y flores en relieve tridimensional. Escote corazón con tirantes finos de pedrería y abertura sutil en la pierna.',
                'sizes' => ['XS', 'S', 'M', 'L', 'XL'],
                'is_active' => true,
                'is_featured' => false,
            ],
            [
                'name' => 'Boho Chic Nupcial de Encaje & Seda',
                'category' => 'boda',
                'silhouette' => 'linea_a',
                'color' => 'Blanco Cálido / Crudo',
                'price' => 720000,
                'images' => [
                    'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?q=80&w=800',
                    'https://images.unsplash.com/photo-1532712938310-34cb3982ef74?q=80&w=800',
                ],
                'description' => 'Ideal para celebraciones campestres o de atardecer. Encaje geométrico bohemio, mangas murciélago desmontables y espalda abierta con lazos de seda natural.',
                'sizes' => ['S', 'M', 'L'],
                'is_active' => true,
                'is_featured' => false,
            ],

            // ==================== 15 AÑOS ====================
            [
                'name' => 'Princesa Real Quinceañera Rosa Pastel & Cristales',
                'category' => '15_anos',
                'silhouette' => 'princesa',
                'color' => 'Rosa Pastel / Blush',
                'price' => 750000,
                'images' => [
                    'https://images.unsplash.com/photo-1566737236500-c8ac43014a67?q=80&w=800',
                    'https://images.unsplash.com/photo-1515934751635-c81c6bc9a2d8?q=80&w=800',
                ],
                'description' => 'Falda imperial ultra voluminosa con 12 capas de tul brillante escarchado, corset tipo joya incrustado de cristales Swarovski y corona a juego incluida.',
                'sizes' => ['XS', 'S', 'M', 'A Medida'],
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'name' => 'Soberana Esmeralda Quinceañera & Bordados de Oro',
                'category' => '15_anos',
                'silhouette' => 'princesa',
                'color' => 'Esmeralda Imperial',
                'price' => 820000,
                'images' => [
                    'https://images.unsplash.com/photo-1539109136881-3be0616acf4b?q=80&w=800',
                    'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?q=80&w=800',
                ],
                'description' => 'Color verde esmeralda de impacto real con finos arabescos dorados bordados a mano, hombros caídos con aplicaciones florales y enagua estructurada.',
                'sizes' => ['XS', 'S', 'M', 'L'],
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'name' => 'Noche de Gala Azul Medianoche & Constelaciones',
                'category' => '15_anos',
                'silhouette' => 'princesa',
                'color' => 'Azul Medianoche',
                'price' => 790000,
                'images' => [
                    'https://images.unsplash.com/photo-1518895949257-7621c3c786d7?q=80&w=800',
                    'https://images.unsplash.com/photo-1566737236500-c8ac43014a67?q=80&w=800',
                ],
                'description' => 'Falda en tul azul profundo salpicado de micro-brillos que simulan un cielo nocturno estrellado bajo las luces de discoteca y robóticas.',
                'sizes' => ['XS', 'S', 'M'],
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'name' => 'Lila Celestial Quinceañera con Mariposas 3D',
                'category' => '15_anos',
                'silhouette' => 'princesa',
                'color' => 'Lila / Lavanda',
                'price' => 760000,
                'images' => [
                    'https://images.unsplash.com/photo-1572804013309-59a88b7e92f1?q=80&w=800',
                    'https://images.unsplash.com/photo-1566737236500-c8ac43014a67?q=80&w=800',
                ],
                'description' => 'Diseño de ensueño en tul lavanda con mariposas móviles en 3D que recorren el corset hasta la falda. Incluye capa de tul desmontable para el vals.',
                'sizes' => ['XS', 'S', 'M', 'L'],
                'is_active' => true,
                'is_featured' => false,
            ],
            [
                'name' => 'Reina Rubí Imperial & Escote Corazón',
                'category' => '15_anos',
                'silhouette' => 'princesa',
                'color' => 'Rojo Rubí / Borgoña',
                'price' => 840000,
                'images' => [
                    'https://images.unsplash.com/photo-1509631179647-0177331693ae?q=80&w=800',
                    'https://images.unsplash.com/photo-1539109136881-3be0616acf4b?q=80&w=800',
                ],
                'description' => 'Dramatismo y elegancia pura en rojo rubí encendido con pedrería tonal, cola desmontable y estructura de corset reforzado para un entallado perfecto.',
                'sizes' => ['S', 'M', 'L'],
                'is_active' => true,
                'is_featured' => false,
            ],
            [
                'name' => 'Oro Glaseado Vanguardista & Capa Imperial',
                'category' => 'ambos',
                'silhouette' => 'vanguardista',
                'color' => 'Oro Champagne',
                'price' => 890000,
                'images' => [
                    'https://images.unsplash.com/photo-1549465220-1a8b9238cd48?q=80&w=800',
                    'https://images.unsplash.com/photo-1515934751635-c81c6bc9a2d8?q=80&w=800',
                ],
                'description' => 'Pieza exclusiva de alta costura para novias o quinceañeras de gala. Tejido metalizado sutil en oro claro con capa imperial desmontable desde los hombros.',
                'sizes' => ['XS', 'S', 'M', 'A Medida'],
                'is_active' => true,
                'is_featured' => true,
            ],
        ];

        foreach ($dresses as $data) {
            Dress::updateOrCreate(
                ['name' => $data['name']],
                $data
            );
        }
    }
}


<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\Staff;
use Illuminate\Database\Seeder;

class PlatformSeeder extends Seeder
{
    public function run(): void
    {
        // 1. SEED STAFF
        $staffMembers = [
            [
                'name'  => 'Valentina Morales',
                'role'  => 'Coordinadora General de Protocolo',
                'phone' => '+57 310 456 7890',
                'email' => 'valentina.protocolo@thering.com',
            ],
            [
                'name'  => 'Carlos Andrés Gómez',
                'role'  => 'Director de Luces & Efectos Especiales',
                'phone' => '+57 315 678 9012',
                'email' => 'carlos.audio@thering.com',
            ],
            [
                'name'  => 'Sofía Castro',
                'role'  => 'Diseñadora Floral & Escenografía',
                'phone' => '+57 320 123 4567',
                'email' => 'sofia.decor@thering.com',
            ],
            [
                'name'  => 'Mateo Rodríguez',
                'role'  => 'Chef Ejecutivo & Banquete',
                'phone' => '+57 300 987 6543',
                'email' => 'mateo.catering@thering.com',
            ],
            [
                'name'  => 'Felipe Herrera',
                'role'  => 'Jefe de Seguridad & Logística VIP',
                'phone' => '+57 311 234 5678',
                'email' => 'felipe.seguridad@thering.com',
            ],
        ];

        foreach ($staffMembers as $s) {
            Staff::updateOrCreate(['email' => $s['email']], $s);
        }

        // 2. SEED SERVICES
        $services = [
            // EFECTOS & SHOWS
            [
                'name'        => 'Show de Robots y Trajes LED',
                'category'    => 'Efectos & Shows',
                'base_price'  => 450000,
                'description' => 'Impactantes personajes gigantes con tecnología lumínica programable y pistolas de CO2 para animar la fiesta.',
                'images'      => ['https://images.unsplash.com/photo-1545128485-c400e7702796?q=80&w=800'],
            ],
            [
                'name'        => 'Cámara de Niebla Criogénica (Nubes)',
                'category'    => 'Efectos & Shows',
                'base_price'  => 350000,
                'description' => 'Efecto de niebla baja densa que cubre el piso simulando bailar sobre las nubes, perfecto para el vals y momentos cumbre.',
                'images'      => ['https://images.unsplash.com/photo-1492684223066-81342ee5ff30?q=80&w=800'],
            ],
            [
                'name'        => 'Pista LED Infinita 3D',
                'category'    => 'Efectos & Shows',
                'base_price'  => 1200000,
                'description' => 'Piso interactivo con espejos infinitos y visuales programables sincronizados al ritmo de la música y del DJ.',
                'images'      => ['https://images.unsplash.com/photo-1470229722913-7c090be5bc6e?q=80&w=800'],
            ],
            [
                'name'        => 'Cañones de Chispas Frías (Sparkular)',
                'category'    => 'Efectos & Shows',
                'base_price'  => 500000,
                'description' => 'Disparos de pirotecnia fría 100% segura para interiores, sin humo ni olor, ideal para entrada de novios o brindis.',
                'images'      => ['https://images.unsplash.com/photo-1514525253161-7a46d19cd819?q=80&w=800'],
            ],

            // GASTRONOMÍA & BANQUETES
            [
                'name'        => 'Fuente de Chocolate Belga & Frutas',
                'category'    => 'Gastronomía',
                'base_price'  => 400000,
                'description' => 'Cascada continua de chocolate importado prémium servido con brochetas de fresas frescas, kiwi y repostería artesanal.',
                'images'      => ['https://images.unsplash.com/photo-1621303837174-89787a7d4729?q=80&w=800'],
            ],
            [
                'name'        => 'Mesa de Dulces & Candy Bar de Lujo',
                'category'    => 'Gastronomía',
                'base_price'  => 650000,
                'description' => 'Estación de pastelería fina de autor con macarons franceses, trufas, cake pops y decoración temática personalizada.',
                'images'      => ['https://images.unsplash.com/photo-1481391319762-47dff72954d9?q=80&w=800'],
            ],
            [
                'name'        => 'Banquete Gourmet Servido a la Mesa',
                'category'    => 'Gastronomía',
                'base_price'  => 1800000,
                'description' => 'Menú emplatado de 3 tiempos preparado por chefs profesionales con cortes prémium, salsas reducidas y guarniciones finas.',
                'images'      => ['https://images.unsplash.com/photo-1555244162-803834f70033?q=80&w=800'],
            ],
            [
                'name'        => 'Barra Libre de Mixología & Cócteles',
                'category'    => 'Gastronomía',
                'base_price'  => 950000,
                'description' => 'Bartenders con estación iluminada preparando cócteles clásicos y creaciones exclusivas con y sin licor.',
                'images'      => ['https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?q=80&w=800'],
            ],

            // ESCENOGRAFÍA & DECORACIÓN
            [
                'name'        => 'Sillería VIP & Tronos Reales',
                'category'    => 'Escenografía',
                'base_price'  => 550000,
                'description' => 'Juego de sillas Trono capitoneadas, Isabelinas y Tiffany para mesa principal de homenajeados y novios.',
                'images'      => ['https://images.unsplash.com/photo-1505236858219-8359eb29e329?q=80&w=800'],
            ],
            [
                'name'        => 'Backing Estructural & Muro de Flores',
                'category'    => 'Escenografía',
                'base_price'  => 700000,
                'description' => 'Muro monumental de flores con arco metálico, vegetación y letrero personalizado en Neón Flex de alta luminosidad.',
                'images'      => ['https://images.unsplash.com/photo-1519225421980-715cb0215aed?q=80&w=800'],
            ],
            [
                'name'        => 'Letras Gigantes 3D Iluminadas',
                'category'    => 'Escenografía',
                'base_price'  => 380000,
                'description' => 'Iniciales, números de 15 años o nombres de 1.20 metros con bombillería cálida tipo vintage o RGB.',
                'images'      => ['https://images.unsplash.com/photo-1514525253161-7a46d19cd819?q=80&w=800'],
            ],
            [
                'name'        => 'Cielo de Telas & Candelabros de Cristal',
                'category'    => 'Escenografía',
                'base_price'  => 850000,
                'description' => 'Estructura colgante con telas tensadas, cortinas micro-LED y candelabros imperiales de cristal.',
                'images'      => ['https://images.unsplash.com/photo-1530103862676-de3c9a728f4d?q=80&w=800'],
            ],

            // TECNOLOGÍA & AUDIOVISUAL
            [
                'name'        => 'Plataforma 360 Spin Booth',
                'category'    => 'Tecnología',
                'base_price'  => 600000,
                'description' => 'Plataforma con brazo robótico giratorio que graba videos en cámara lenta 360° listos para compartir por WhatsApp o redes.',
                'images'      => ['https://images.unsplash.com/photo-1516035069371-29a1b244cc32?q=80&w=800'],
            ],
            [
                'name'        => 'Pantalla LED Gigante de Alta Resolución',
                'category'    => 'Tecnología',
                'base_price'  => 1500000,
                'description' => 'Muro digital Pitch 2.9 para transmisión en vivo, videos de recuerdo, visuales dinámicos y presentación de novios.',
                'images'      => ['https://images.unsplash.com/photo-1505373877841-8d25f7d46678?q=80&w=800'],
            ],
            [
                'name'        => 'Cinematografía & Cobertura Drone 4K',
                'category'    => 'Tecnología',
                'base_price'  => 1100000,
                'description' => 'Producción de video estilo película con cámaras de cine, audio profesional, tomas aéreas con Drone y entrega en estuche VIP.',
                'images'      => ['https://images.unsplash.com/photo-1492691527719-9d1e07e534b4?q=80&w=800'],
            ],
        ];

        foreach ($services as $srv) {
            Service::updateOrCreate(['name' => $srv['name']], $srv);
        }
    }
}


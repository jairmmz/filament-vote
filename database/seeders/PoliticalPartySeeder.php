<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PoliticalPartySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $parties = [
            [
                'name' => 'Fuerza Popular',
                'slug' => 'fuerza-popular',
                'acronym' => 'FP',
                'logo' => null,
                'color' => '#FF6600',
                'description' => 'Partido político peruano de derecha fundado por Keiko Fujimori',
                'is_active' => true,
            ],
            [
                'name' => 'Perú Libre',
                'slug' => 'peru-libre',
                'acronym' => 'PL',
                'logo' => null,
                'color' => '#DC143C',
                'description' => 'Partido político peruano de izquierda marxista-leninista',
                'is_active' => true,
            ],
            [
                'name' => 'Alianza para el Progreso',
                'slug' => 'alianza-para-el-progreso',
                'acronym' => 'APP',
                'logo' => null,
                'color' => '#0066CC',
                'description' => 'Partido político peruano de centroderecha fundado por César Acuña',
                'is_active' => true,
            ],
            [
                'name' => 'Acción Popular',
                'slug' => 'accion-popular',
                'acronym' => 'AP',
                'logo' => null,
                'color' => '#E31E24',
                'description' => 'Partido político peruano de centro fundado por Fernando Belaúnde Terry',
                'is_active' => true,
            ],
            [
                'name' => 'Avanza País',
                'slug' => 'avanza-pais',
                'acronym' => 'AP',
                'logo' => null,
                'color' => '#00A0E3',
                'description' => 'Partido político peruano de derecha liberal',
                'is_active' => true,
            ],
            [
                'name' => 'Renovación Popular',
                'slug' => 'renovacion-popular',
                'acronym' => 'RP',
                'logo' => null,
                'color' => '#00B8E6',
                'description' => 'Partido político peruano de derecha conservadora fundado por Rafael López Aliaga',
                'is_active' => true,
            ],
            [
                'name' => 'Partido Morado',
                'slug' => 'partido-morado',
                'acronym' => 'PM',
                'logo' => null,
                'color' => '#663399',
                'description' => 'Partido político peruano de centroizquierda progresista',
                'is_active' => true,
            ],
            [
                'name' => 'Somos Perú',
                'slug' => 'somos-peru',
                'acronym' => 'SP',
                'logo' => null,
                'color' => '#FF8C00',
                'description' => 'Partido político peruano de centro fundado por Alberto Andrade',
                'is_active' => true,
            ],
            [
                'name' => 'Podemos Perú',
                'slug' => 'podemos-peru',
                'acronym' => 'PP',
                'logo' => null,
                'color' => '#9B59B6',
                'description' => 'Partido político peruano de centro fundado por José Luna Gálvez',
                'is_active' => true,
            ],
            [
                'name' => 'Juntos por el Perú',
                'slug' => 'juntos-por-el-peru',
                'acronym' => 'JPP',
                'logo' => null,
                'color' => '#C41E3A',
                'description' => 'Partido político peruano de izquierda democrática',
                'is_active' => true,
            ],
            [
                'name' => 'Partido Nacionalista Peruano',
                'slug' => 'partido-nacionalista-peruano',
                'acronym' => 'PNP',
                'logo' => null,
                'color' => '#E74C3C',
                'description' => 'Partido político peruano nacionalista fundado por Ollanta Humala',
                'is_active' => true,
            ],
            [
                'name' => 'Partido Aprista Peruano',
                'slug' => 'partido-aprista-peruano',
                'acronym' => 'PAP',
                'logo' => null,
                'color' => '#ED1C24',
                'description' => 'Partido político histórico peruano fundado por Víctor Raúl Haya de la Torre',
                'is_active' => true,
            ],
            [
                'name' => 'Perú Patria Segura',
                'slug' => 'peru-patria-segura',
                'acronym' => 'PPS',
                'logo' => null,
                'color' => '#2C3E50',
                'description' => 'Partido político peruano enfocado en seguridad ciudadana',
                'is_active' => true,
            ],
            [
                'name' => 'Frente Amplio',
                'slug' => 'frente-amplio',
                'acronym' => 'FA',
                'logo' => null,
                'color' => '#8B008B',
                'description' => 'Coalición política peruana de izquierda',
                'is_active' => true,
            ],
            [
                'name' => 'Democracia Directa',
                'slug' => 'democracia-directa',
                'acronym' => 'DD',
                'logo' => null,
                'color' => '#27AE60',
                'description' => 'Partido político peruano enfocado en la participación ciudadana',
                'is_active' => true,
            ],
        ];

        foreach ($parties as $party) {
            DB::table('political_parties')->insert([
                'name' => $party['name'],
                'slug' => $party['slug'],
                'acronym' => $party['acronym'],
                'logo' => $party['logo'],
                'color' => $party['color'],
                'description' => $party['description'],
                'is_active' => $party['is_active'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

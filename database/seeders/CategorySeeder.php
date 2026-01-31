<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Presidente de la República',
                'slug' => 'presidente-republica',
                'description' => 'Elección del Presidente y Vicepresidentes de la República del Perú para el periodo 2026-2031',
                'is_active' => true,
            ],
            [
                'name' => 'Congresista',
                'slug' => 'congresista',
                'description' => 'Elección de los 130 congresistas que integrarán el Congreso de la República',
                'is_active' => true,
            ],
            [
                'name' => 'Gobernador Regional',
                'slug' => 'gobernador-regional',
                'description' => 'Elección de Gobernadores Regionales en los 25 gobiernos regionales del Perú',
                'is_active' => true,
            ],
            [
                'name' => 'Consejero Regional',
                'slug' => 'consejero-regional',
                'description' => 'Elección de Consejeros Regionales que conforman los Consejos Regionales',
                'is_active' => true,
            ],
            [
                'name' => 'Alcalde Provincial',
                'slug' => 'alcalde-provincial',
                'description' => 'Elección de Alcaldes en las 196 provincias del Perú',
                'is_active' => true,
            ],
            [
                'name' => 'Alcalde Distrital',
                'slug' => 'alcalde-distrital',
                'description' => 'Elección de Alcaldes en los 1,874 distritos del Perú',
                'is_active' => true,
            ],
            [
                'name' => 'Regidor Provincial',
                'slug' => 'regidor-provincial',
                'description' => 'Elección de Regidores que integran los Concejos Municipales Provinciales',
                'is_active' => true,
            ],
            [
                'name' => 'Regidor Distrital',
                'slug' => 'regidor-distrital',
                'description' => 'Elección de Regidores que integran los Concejos Municipales Distritales',
                'is_active' => true,
            ],
            [
                'name' => 'Parlamento Andino',
                'slug' => 'parlamento-andino',
                'description' => 'Elección de representantes peruanos ante el Parlamento Andino',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'name' => $category['name'],
                'slug' => $category['slug'],
                'description' => $category['description'],
                'is_active' => $category['is_active'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

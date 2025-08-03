<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'name' => 'Agriculture Durable',
                'slug' => 'agriculture-durable',
                'description' => 'Projets et initiatives pour promouvoir une agriculture respectueuse de l\'environnement',
                'color' => '#10B981',
                'icon' => 'fas fa-seedling',
            ],
            [
                'name' => 'Environnement',
                'slug' => 'environnement',
                'description' => 'Protection de l\'environnement et biodiversité',
                'color' => '#059669',
                'icon' => 'fas fa-leaf',
            ],
            [
                'name' => 'Genre et Autonomisation',
                'slug' => 'genre-autonomisation',
                'description' => 'Autonomisation des femmes et des jeunes',
                'color' => '#EC4899',
                'icon' => 'fas fa-users',
            ],
            [
                'name' => 'Gouvernance',
                'slug' => 'gouvernance',
                'description' => 'Gouvernance participative et transparence',
                'color' => '#3B82F6',
                'icon' => 'fas fa-balance-scale',
            ],
            [
                'name' => 'Justice Sociale',
                'slug' => 'justice-sociale',
                'description' => 'Défense des droits et justice sociale',
                'color' => '#F59E0B',
                'icon' => 'fas fa-gavel',
            ],
            [
                'name' => 'Énergie Propre',
                'slug' => 'energie-propre',
                'description' => 'Efficacité énergétique et énergies renouvelables',
                'color' => '#EAB308',
                'icon' => 'fas fa-solar-panel',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}

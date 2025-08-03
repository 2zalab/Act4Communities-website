<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Category;

class ProjectSeeder extends Seeder
{
    public function run()
    {
        $projects = [
            [
                'title' => 'LandCam - Suivi de la gouvernance foncière',
                'excerpt' => 'Projet de suivi et amélioration de la gouvernance foncière au Cameroun',
                'description' => '<p>Le projet LandCam vise à améliorer la gouvernance foncière au Cameroun à travers le suivi, la sensibilisation et le renforcement des capacités des communautés locales.</p>',
                'status' => 'active',
                'start_date' => '2024-01-01',
                'end_date' => '2025-12-31',
                'location' => 'Nord et Extrême-Nord Cameroun',
                'budget' => 500000,
                'objectives' => ['Améliorer la gouvernance foncière', 'Renforcer les capacités des communautés'],
                'expected_results' => ['Réduction des conflits fonciers', 'Meilleure sécurisation des droits'],
                'category_id' => Category::where('slug', 'gouvernance')->first()->id,
                'is_featured' => true,
                'is_published' => true,
            ],
            [
                'title' => 'Autonomisation des femmes rurales',
                'excerpt' => 'Programme d\'autonomisation économique des femmes en milieu rural',
                'description' => '<p>Ce programme vise à renforcer les capacités économiques des femmes rurales à travers la formation, l\'accès au crédit et le développement d\'activités génératrices de revenus.</p>',
                'status' => 'active',
                'start_date' => '2024-03-01',
                'end_date' => '2024-12-31',
                'location' => 'Région du Nord',
                'budget' => 250000,
                'objectives' => ['Former 500 femmes', 'Créer 100 AGR'],
                'expected_results' => ['Augmentation des revenus', 'Autonomie financière'],
                'category_id' => Category::where('slug', 'genre-autonomisation')->first()->id,
                'is_featured' => true,
                'is_published' => true,
            ],
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }
    }
}

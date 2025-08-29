<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ResourceCategory;

class CategoriesResourcesSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Rapports & Études',
                'slug' => 'rapports-etudes',
                'description' => 'Rapports d\'activités, études de terrain et analyses sectorielles',
                'icon' => 'fas fa-chart-line',
                'color' => '#3B82F6',
                'sort_order' => 1,
            ],
            [
                'name' => 'Guides & Manuels',
                'slug' => 'guides-manuels',
                'description' => 'Guides pratiques et manuels de formation',
                'icon' => 'fas fa-book',
                'color' => '#10B981',
                'sort_order' => 2,
            ],
            [
                'name' => 'Politiques & Procédures',
                'slug' => 'politiques-procedures',
                'description' => 'Documents de politique et procédures organisationnelles',
                'icon' => 'fas fa-gavel',
                'color' => '#F59E0B',
                'sort_order' => 3,
            ],
            [
                'name' => 'Outils & Templates',
                'slug' => 'outils-templates',
                'description' => 'Outils de travail et modèles de documents',
                'icon' => 'fas fa-tools',
                'color' => '#8B5CF6',
                'sort_order' => 4,
            ],
            [
                'name' => 'Formations & Présentations',
                'slug' => 'formations-presentations',
                'description' => 'Supports de formation et présentations',
                'icon' => 'fas fa-presentation',
                'color' => '#EF4444',
                'sort_order' => 5,
            ],
            [
                'name' => 'Médias & Publications',
                'slug' => 'medias-publications',
                'description' => 'Brochures, newsletters et supports de communication',
                'icon' => 'fas fa-newspaper',
                'color' => '#06B6D4',
                'sort_order' => 6,
            ],
        ];

        foreach ($categories as $category) {
            ResourceCategory::create($category);
        }
    }
}

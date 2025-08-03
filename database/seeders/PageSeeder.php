<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;

class PageSeeder extends Seeder
{
    public function run()
    {
        $pages = [
            [
                'title' => 'À propos',
                'slug' => 'about',
                'content' => '<p>Action pour le Développement Communautaire (ADC) est une OSC camerounaise défendant les droits des communautés locales et autochtones à travers la recherche-action, l\'information et la sensibilisation, le renforcement des capacités et le plaidoyer.</p><p>Notre vision est celle d\'un « Cameroun où le développement est centré sur la personne humaine ».</p>',
                'template' => 'about',
                'is_published' => true,
            ],
            [
                'title' => 'Politique de confidentialité',
                'slug' => 'privacy-policy',
                'content' => '<p>Votre vie privée est importante pour nous. Cette politique de confidentialité explique quelles informations personnelles nous collectons et comment nous les utilisons.</p>',
                'template' => 'default',
                'is_published' => true,
            ],
            [
                'title' => 'Conditions d\'utilisation',
                'slug' => 'terms-of-service',
                'content' => '<p>En utilisant notre site web, vous acceptez ces conditions d\'utilisation.</p>',
                'template' => 'default',
                'is_published' => true,
            ],
        ];

        foreach ($pages as $page) {
            Page::create($page);
        }
    }
}

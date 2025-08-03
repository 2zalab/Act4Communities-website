<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Partner;

class PartnerSeeder extends Seeder
{
    public function run()
    {
        $partners = [
            [
                'name' => 'Union Européenne',
                'description' => 'Partenaire institutionnel',
                'type' => 'donor',
                'website' => 'https://europa.eu',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'USAID',
                'description' => 'Agence de développement international',
                'type' => 'donor',
                'website' => 'https://usaid.gov',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'GIZ',
                'description' => 'Coopération allemande',
                'type' => 'partner',
                'website' => 'https://giz.de',
                'is_active' => true,
                'sort_order' => 3,
            ],
        ];

        foreach ($partners as $partner) {
            Partner::create($partner);
        }
    }
}


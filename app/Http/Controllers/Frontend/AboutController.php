<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Page;

class AboutController extends Controller
{
    public function index()
    {
        $aboutPage = Page::where('slug', 'about')->published()->first();

        $teamMembers = [
            [
                'name' => 'Louise LOKUMU',
                'position' => 'Coordinatrice',
                'email' => 'contact@actforcommunities.org',
                'photo' => null
            ],
            [
                'name' => 'Moïse Mbimbe',
                'position' => 'Responsable Projets',
                'email' => 'contact@actforcommunities.org',
                'photo' => null
            ]
        ];

        $missions = [
            'Défendre les droits des communautés locales et autochtones',
            'Promouvoir le développement durable',
            'Renforcer les capacités des communautés',
            'Favoriser la gouvernance participative'
        ];

        $interventionAreas = [
            'Agriculture durable',
            'Autonomisation des femmes et jeunes',
            'Protection de l\'environnement',
            'Gouvernance et transparence',
            'Justice sociale',
            'Énergie propre'
        ];

        return view('frontend.about', compact(
            'aboutPage',
            'teamMembers',
            'missions',
            'interventionAreas'
        ));
    }

    public function team()
    {
        return view('frontend.team');
    }
}

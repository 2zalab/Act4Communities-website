<?php

namespace Database\Seeders;

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;

class PostSeeder extends Seeder
{
    public function run()
    {
        $user = User::first();

        $posts = [
            [
                'title' => 'Atelier de lancement du processus de suivi de la gouvernance foncière au Cameroun',
                'excerpt' => 'Dans le cadre du projet LandCam, ADC a organisé un atelier de lancement pour échanger avec les acteurs interagissant dans et autour de la gouvernance foncière.',
                'content' => '<p>Dans le cadre du projet LandCam, Action pour le Développement Communautaire (ADC) a organisé un atelier de lancement du processus de suivi de la gouvernance foncière au Cameroun.</p><p>Cet atelier a réuni les principaux acteurs du secteur foncier pour définir les modalités de suivi et d\'évaluation de la gouvernance foncière dans le pays.</p>',
                'type' => 'news',
                'category_id' => Category::where('slug', 'gouvernance')->first()->id,
                'user_id' => $user->id,
                'is_featured' => true,
                'is_published' => true,
                'published_at' => now()->subDays(5),
                'views_count' => 150,
            ],
            [
                'title' => 'Des interventions multiformes pour des communautés plus résilientes',
                'excerpt' => 'Action pour le Développement Communautaire continue ses interventions diversifiées pour renforcer la résilience des communautés locales.',
                'content' => '<p>Action pour le Développement Communautaire (ADC) poursuit ses interventions multiformes visant à renforcer la résilience des communautés locales face aux défis du développement.</p><p>Ces interventions couvrent plusieurs domaines : agriculture durable, autonomisation des femmes, protection de l\'environnement et gouvernance participative.</p>',
                'type' => 'article',
                'category_id' => Category::where('slug', 'environnement')->first()->id,
                'user_id' => $user->id,
                'is_featured' => false,
                'is_published' => true,
                'published_at' => now()->subDays(10),
                'views_count' => 89,
            ],
            [
                'title' => 'Formation sur l\'agriculture durable dans la région du Nord',
                'excerpt' => 'ADC a organisé une série de formations sur les techniques d\'agriculture durable pour les producteurs de la région du Nord.',
                'content' => '<p>Dans le cadre de son programme d\'appui à l\'agriculture durable, ADC a organisé une série de formations destinées aux producteurs de la région du Nord.</p><p>Ces formations ont porté sur les techniques agroécologiques, la gestion durable des sols et l\'adaptation aux changements climatiques.</p>',
                'type' => 'news',
                'category_id' => Category::where('slug', 'agriculture-durable')->first()->id,
                'user_id' => $user->id,
                'is_featured' => false,
                'is_published' => true,
                'published_at' => now()->subDays(15),
                'views_count' => 67,
            ],
            [
                'title' => 'Lancement du programme d\'autonomisation des jeunes',
                'excerpt' => 'Un nouveau programme visant l\'autonomisation économique des jeunes a été lancé dans trois communes de la région du Nord.',
                'content' => '<p>ADC a officiellement lancé son programme d\'autonomisation économique des jeunes dans trois communes pilotes de la région du Nord.</p><p>Ce programme vise à accompagner 200 jeunes dans le développement d\'activités génératrices de revenus et l\'acquisition de compétences entrepreneuriales.</p>',
                'type' => 'news',
                'category_id' => Category::where('slug', 'genre-autonomisation')->first()->id,
                'user_id' => $user->id,
                'is_featured' => true,
                'is_published' => true,
                'published_at' => now()->subDays(3),
                'views_count' => 234,
            ],
        ];

        foreach ($posts as $post) {
            Post::create($post);
        }
    }
}

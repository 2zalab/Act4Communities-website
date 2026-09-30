<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Project;
use App\Models\Resource;

class SitemapController extends Controller
{
    /**
     * Plan du site pour les moteurs de recherche (Google Search Console).
     */
    public function index()
    {
        $urls = collect([
            ['loc' => route('home'), 'priority' => '1.0'],
            ['loc' => route('about'), 'priority' => '0.9'],
            ['loc' => route('team'), 'priority' => '0.7'],
            ['loc' => route('projects.index'), 'priority' => '0.9'],
            ['loc' => route('projects.ongoing'), 'priority' => '0.7'],
            ['loc' => route('projects.completed'), 'priority' => '0.7'],
            ['loc' => route('posts.index'), 'priority' => '0.8'],
            ['loc' => route('resources.index'), 'priority' => '0.7'],
            ['loc' => route('frontend.acd-lab'), 'priority' => '0.7'],
            ['loc' => route('contact.index'), 'priority' => '0.8'],
            ['loc' => route('contact.volunteer'), 'priority' => '0.6'],
            ['loc' => route('contact.partnership'), 'priority' => '0.6'],
        ]);

        Project::where('is_published', true)->get(['slug', 'updated_at'])
            ->each(fn ($p) => $urls->push(['loc' => route('projects.show', $p->slug), 'lastmod' => $p->updated_at, 'priority' => '0.8']));

        Post::published()->get(['slug', 'updated_at'])
            ->each(fn ($p) => $urls->push(['loc' => route('posts.show', $p->slug), 'lastmod' => $p->updated_at, 'priority' => '0.6']));

        Resource::published()->get(['slug', 'updated_at'])
            ->each(fn ($r) => $urls->push(['loc' => route('resources.show', $r->slug), 'lastmod' => $r->updated_at, 'priority' => '0.5']));

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        foreach ($urls as $url) {
            $xml .= "  <url>\n    <loc>" . e($url['loc']) . "</loc>\n";
            if (!empty($url['lastmod'])) {
                $xml .= '    <lastmod>' . $url['lastmod']->toAtomString() . "</lastmod>\n";
            }
            $xml .= '    <priority>' . $url['priority'] . "</priority>\n  </url>\n";
        }
        $xml .= '</urlset>';

        return response($xml, 200, ['Content-Type' => 'application/xml; charset=UTF-8']);
    }
}

<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Post;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ContentTranslationTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        Role::findOrCreate('admin');
        $user = User::factory()->create();
        $user->assignRole('admin');

        return $user;
    }

    public function test_admin_can_save_english_version_of_a_project(): void
    {
        $category = Category::create(['name' => 'Gouvernance', 'slug' => 'gouvernance', 'color' => '#059669', 'icon' => 'fas fa-leaf']);

        $this->actingAs($this->admin())->post(route('admin.projects.store'), [
            'title' => 'Projet eau potable',
            'excerpt' => 'Résumé en français',
            'description' => 'Description en français',
            'category_id' => $category->id,
            'status' => 'active',
            'objectives' => ['Objectif 1'],
            'translations' => ['en' => [
                'title' => 'Drinking water project',
                'excerpt' => 'English summary',
                'description' => '',
                'objectives' => "Objective 1\nObjective 2",
            ]],
        ])->assertRedirect(route('admin.projects.index'));

        $project = Project::firstOrFail();

        $this->assertSame('Projet eau potable', $project->title);
        $this->assertSame('Drinking water project', $project->translation('title'));
        $this->assertSame(['Objective 1', 'Objective 2'], $project->translation('objectives'));
        $this->assertNull($project->translation('description'));
    }

    public function test_public_site_shows_english_content_with_french_fallback(): void
    {
        $category = Category::create([
            'name' => 'Gouvernance', 'slug' => 'gouvernance', 'color' => '#059669', 'icon' => 'fas fa-leaf',
            'translations' => ['en' => ['name' => 'Governance']],
        ]);

        Project::create([
            'title' => 'Projet eau potable',
            'excerpt' => 'Résumé en français',
            'description' => 'Description en français',
            'category_id' => $category->id,
            'status' => 'active',
            'is_published' => true,
            'translations' => ['en' => ['title' => 'Drinking water project']],
        ]);

        $this->get(route('projects.show', 'projet-eau-potable'))
            ->assertSee('Projet eau potable')
            ->assertDontSee('Drinking water project');

        $this->withSession(['locale' => 'en'])
            ->get(route('projects.show', 'projet-eau-potable'))
            ->assertSee('Drinking water project')
            ->assertSee('Governance')
            // pas de traduction : repli sur le français
            ->assertSee('Description en français');
    }

    public function test_admin_edit_form_keeps_french_values_when_browsing_in_english(): void
    {
        $post = Post::create([
            'title' => 'Article en français',
            'excerpt' => 'Extrait',
            'content' => 'Contenu',
            'category_id' => Category::create(['name' => 'Actu', 'slug' => 'actu', 'color' => '#059669', 'icon' => 'fas fa-leaf'])->id,
            'user_id' => $this->admin()->id,
            'translations' => ['en' => ['title' => 'English article']],
        ]);

        $this->actingAs(User::first())
            ->withSession(['locale' => 'en'])
            ->get(route('admin.posts.edit', $post))
            ->assertSee('value="Article en français"', false)
            ->assertSee('value="English article"', false);
    }

    public function test_admin_forms_show_english_fields(): void
    {
        $this->actingAs($this->admin());
        $category = Category::create(['name' => 'Gouvernance', 'slug' => 'gouvernance', 'color' => '#059669', 'icon' => 'fas fa-leaf']);
        $project = Project::create(['title' => 'P', 'excerpt' => 'E', 'description' => 'D', 'category_id' => $category->id, 'status' => 'active']);
        $post = Post::create(['title' => 'A', 'excerpt' => 'E', 'content' => 'C', 'category_id' => $category->id, 'user_id' => User::first()->id]);
        $resourceCategory = \App\Models\ResourceCategory::create(['name' => 'Guides', 'slug' => 'guides']);

        $urls = [
            route('admin.projects.create'), route('admin.projects.edit', $project),
            route('admin.posts.create'), route('admin.posts.edit', $post),
            route('admin.categories.create'), route('admin.categories.edit', $category),
            route('admin.resources.create'),
            route('admin.resource-categories.create'), route('admin.resource-categories.edit', $resourceCategory),
        ];

        foreach ($urls as $url) {
            $this->get($url)->assertOk()->assertSee('Version anglaise (English)');
        }
    }
}

<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        // Créer les permissions
        $permissions = [
            'view_admin',
            'manage_projects',
            'manage_posts',
            'manage_categories',
            'manage_contacts',
            'manage_partners',
            'manage_pages',
            'manage_users',
            'manage_media',
            'manage_settings',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Créer les rôles
        $adminRole = Role::create(['name' => 'admin']);
        $editorRole = Role::create(['name' => 'editor']);

        // Attribuer toutes les permissions à l'admin
        $adminRole->givePermissionTo(Permission::all());

        // Attribuer des permissions limitées à l'éditeur
        $editorRole->givePermissionTo([
            'view_admin',
            'manage_projects',
            'manage_posts',
            'manage_media',
        ]);
    }
}

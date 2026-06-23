<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Create roles
        $superAdmin = Role::create(['name' => 'super_admin']);
        $admin = Role::create(['name' => 'admin']);
        $editor = Role::create(['name' => 'editor']);

        // Create permissions
        $permissions = [
            'view_admin_panel',
            'manage_hero',
            'manage_about',
            'manage_services',
            'manage_why_choose_us',
            'manage_products',
            'manage_product_categories',
            'manage_projects',
            'manage_project_categories',
            'manage_articles',
            'manage_article_categories',
            'manage_testimonials',
            'manage_contacts',
            'manage_messages',
            'manage_seo',
            'manage_settings',
            'manage_users',
        ];

        foreach ($permissions as $perm) {
            Permission::create(['name' => $perm]);
        }

        $superAdmin->givePermissionTo(Permission::all());
        $admin->givePermissionTo([
            'view_admin_panel', 'manage_hero', 'manage_about',
            'manage_services', 'manage_why_choose_us', 'manage_products',
            'manage_product_categories', 'manage_projects',
            'manage_project_categories', 'manage_articles',
            'manage_article_categories', 'manage_testimonials',
            'manage_contacts', 'manage_messages', 'manage_seo',
        ]);
        $editor->givePermissionTo([
            'view_admin_panel', 'manage_products', 'manage_projects',
            'manage_articles', 'manage_testimonials',
        ]);

        // Create Super Admin
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@djayamandiriteknik.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ])->assignRole('super_admin');
    }
}

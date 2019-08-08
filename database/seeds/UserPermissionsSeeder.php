<?php

use Illuminate\Database\Seeder;

class UserPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_permissions')->insert(
            [
                ['name' => 'read_settings'],
                ['name' => 'update_settings'],
                ['name' => 'create_users'],
                ['name' => 'read_users'],
                ['name' => 'update_users'],
                ['name' => 'delete_users'],
                ['name' => 'create_user_roles'],
                ['name' => 'read_user_roles'],
                ['name' => 'update_user_roles'],
                ['name' => 'delete_user_roles'],
                ['name' => 'create_pages'],
                ['name' => 'read_pages'],
                ['name' => 'update_pages'],
                ['name' => 'delete_pages'],
                ['name' => 'create_posts'],
                ['name' => 'read_posts'],
                ['name' => 'update_posts'],
                ['name' => 'delete_posts'],
                ['name' => 'create_menus'],
                ['name' => 'read_menus'],
                ['name' => 'update_menus'],
                ['name' => 'delete_menus'],
            ]
        );
    }
}

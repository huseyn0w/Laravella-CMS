<?php

use Illuminate\Database\Seeder;

class UserRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_roles')->insert(
            [
                ['name' => 'Guest'],
                ['name' => 'User'],
                ['name' => 'Administrator'],
                ['name' => 'Editor']
            ]
        );
    }
}

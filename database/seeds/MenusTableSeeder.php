<?php

use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menu_content = [
            ['slug' => '/', 'type' => 'pages', 'title' => 'Homepage'],
            ['slug' => 'contact', 'type' => 'pages', 'title' => 'Contact']
        ];

        DB::table('menus')->insert(
            [
                'title' => 'Header Menu',
                'status' => '1',
                'content' => json_encode($menu_content)
            ]
        );
    }
}

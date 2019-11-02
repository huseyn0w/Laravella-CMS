<?php

use Illuminate\Database\Seeder;

class CPanelCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'title' => "Main parent category",
                'slug' => "parent_category",
                'description' => "This is main category",
                'meta_description' => 'Main parent category',
                'meta_keywords' => 'main category, category, parent category',
            ],
            [
                'title' => "About",
                'slug' => "about",
                'description' => "Here is news from About category",
                'meta_description' => 'About category',
                'meta_keywords' => 'about, category',
            ]
        ]);
    }
}

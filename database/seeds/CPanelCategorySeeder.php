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
            ]
        ]);
    }
}

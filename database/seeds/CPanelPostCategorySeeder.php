<?php

use Illuminate\Database\Seeder;

class CPanelPostCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category_post')->insert([
            [
                'category_id' => 1,
                'post_id' => 1
            ]
        ]);
    }
}

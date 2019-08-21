<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pages')->insert([
            [
                'name' => 'Homepage',
                'slug' => '/',
                'author_id' => 1,
                'status' => 1,
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Contact',
                'slug' => '/contact',
                'author_id' => 1,
                'status' => 1,
                'created_at' => Carbon::now()
            ],
        ]);
    }
}

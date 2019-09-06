<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CPanelPostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            [
                'title' => 'First post',
                'slug' => 'first-post',
                'author_id' => 1,
                'status' => 1,
                'likes' => 0,
                'dislikes' => 0,
                'preview' => "Preview of the first post",
                'content' => "Content of the first post",
                'created_at' => Carbon::now()
            ]
        ]);
    }
}
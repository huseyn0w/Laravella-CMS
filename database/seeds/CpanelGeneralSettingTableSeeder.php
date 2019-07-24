<?php

use Illuminate\Database\Seeder;

class CpanelGeneralSettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('general_settings')->insert([
            'website_name' => Str::random(10),
            'tagline' => Str::random(100),
            'email' => 'thehuseyn0w@gmail.com',
            'membership' => true,
            'active_template_name' => 'default',
        ]);
    }
}

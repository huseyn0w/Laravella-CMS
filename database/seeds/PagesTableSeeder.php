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
        $home_page_custom_fields = array (
            'headline' =>
                array (
                    'value' => 'Laravella CMS',
                    'type' => 'text',
                    'admin_label' => 'Headline',
                ),
            'headline-image' =>
                array (
                    'value' => 'http://laravella.loc/filemanager/images/5d9ca59b897a2.jpg',
                    'type' => 'image',
                    'admin_label' => 'Headline Image',
                ),
            'about-headline' =>
                array (
                    'value' => 'About Us',
                    'type' => 'text',
                    'admin_label' => 'About Headline',
                ),
            'about-description' =>
                array (
                    'value' => 'Who exactly create this CMS?',
                    'type' => 'text',
                    'admin_label' => 'About description',
                ),
            'about-big-text' =>
                array (
                    'value' => 'inappropriate behavior is often laughed off as “boys will be boys,” women face higher conduct standards especially in the workplace. That’s why it’s crucial that, as women, our behavior on the job is beyond reproach. inappropriate behavior is often laughed off as “boys will be boys,” women face higher conduct standards especially in the workplace. That’s why it’s crucial that.
inappropriate behavior is often laughed off as “boys will be boys,” women face higher conduct standards especially in the workplace. That’s why it’s crucial that, as women.',
                    'type' => 'textarea',
                    'admin_label' => 'About Full Description',
                ),
            'authors' =>
                array (
                    'type' => 'repeater',
                    'admin_label' => 'Authors',
                    'value' =>
                        array (
                            'row-0' =>
                                array (
                                    'author-image' =>
                                        array (
                                            'value' => 'http://laravella.loc/filemanager/images/5dbb536d16ce8.JPG',
                                            'type' => 'image',
                                            'admin_label' => 'Author Image',
                                        ),
                                    'author-name' =>
                                        array (
                                            'value' => 'Elman Hüseynov',
                                            'type' => 'text',
                                            'admin_label' => 'Author Name',
                                        ),
                                    'author-position' =>
                                        array (
                                            'value' => 'Laravella CMS Author',
                                            'type' => 'text',
                                            'admin_label' => 'Author Position',
                                        ),
                                    'author-linkedin' =>
                                        array (
                                            'value' =>
                                                array (
                                                    'label' => '#',
                                                    'url' => 'https://linkedin.com/in/huseyn0w/',
                                                    'target' => '1',
                                                ),
                                            'type' => 'link',
                                            'admin_label' => 'Author Linkedin',
                                        ),
                                ),
                            'row-1' =>
                                array (
                                    'author-image' =>
                                        array (
                                            'value' => 'http://laravella.loc/filemanager/images/5db367b4093af.jpg',
                                            'type' => 'image',
                                            'admin_label' => 'Author Image',
                                        ),
                                    'author-name' =>
                                        array (
                                            'value' => 'Ilkin Alibayli',
                                            'type' => 'text',
                                            'admin_label' => 'Author Name',
                                        ),
                                    'author-position' =>
                                        array (
                                            'value' => 'Laravella CMS Contributor',
                                            'type' => 'text',
                                            'admin_label' => 'Author Position',
                                        ),
                                    'author-linkedin' =>
                                        array (
                                            'value' =>
                                                array (
                                                    'label' => '#',
                                                    'url' => 'https://www.linkedin.com/in/ilkin-alibayli/',
                                                    'target' => '1',
                                                ),
                                            'type' => 'link',
                                            'admin_label' => 'Author Linkedin',
                                        ),
                                ),
                        ),
                ),
        );

        DB::table('pages')->insert([
            [
                'title' => 'Homepage',
                'slug' => '/',
                'author_id' => 1,
                'status' => 1,
                'meta_keywords' => 'page, homepage',
                'meta_description' => 'This is homepage of CMS Laravella',
                'custom_fields' => json_encode($home_page_custom_fields),
                'template' => 'home',
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'Contact',
                'slug' => 'contact',
                'author_id' => 1,
                'status' => 1,
                'meta_keywords' => 'page, contact',
                'meta_description' => 'Contact page',
                'template' => 'contacts',
                'custom_fields' => json_encode([]),
                'created_at' => Carbon::now()
            ],
        ]);
    }
}

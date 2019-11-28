<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CPanelPagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $home_page_custom_fields = array (
            'en' => array(
                'headline' =>
                    array (
                        'value' => 'Laravella CMS',
                        'type' => 'text',
                        'admin_label' => 'Headline',
                    ),
                'headline-image' =>
                    array (
                        'value' => env('APP_URL').'filemanager/images/5d9ca59b897a2.jpg',
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
                        'value' => 'Authors description will be here',
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
                                                'value' => env('APP_URL').'filemanager/images/5dbb536d16ce8.JPG',
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
                                                'value' => env('APP_URL').'filemanager/images/5db367b4093af.jpg',
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
            ),
            'ru' => array(
                'headline' =>
                    array (
                        'value' => 'Laravella CMS',
                        'type' => 'text',
                        'admin_label' => 'Заголовок',
                    ),
                'headline-image' =>
                    array (
                        'value' => env('APP_URL').'filemanager/images/5d9ca59b897a2.jpg',
                        'type' => 'image',
                        'admin_label' => 'Заголовок изображения',
                    ),
                'about-headline' =>
                    array (
                        'value' => 'О нас',
                        'type' => 'text',
                        'admin_label' => 'Заголовок раздела о нас',
                    ),
                'about-description' =>
                    array (
                        'value' => 'Немного об авторах',
                        'type' => 'text',
                        'admin_label' => 'Краткое описание раздела об авторах',
                    ),
                'about-big-text' =>
                    array (
                        'value' => 'Текст об авторах будет тут',
                        'type' => 'textarea',
                        'admin_label' => 'Подробное описание раздела об авторах',
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
                                                'value' => env('APP_URL').'filemanager/images/5dbb536d16ce8.JPG',
                                                'type' => 'image',
                                                'admin_label' => 'Изображение автора',
                                            ),
                                        'author-name' =>
                                            array (
                                                'value' => 'Elman Hüseynov',
                                                'type' => 'text',
                                                'admin_label' => 'Имя автора',
                                            ),
                                        'author-position' =>
                                            array (
                                                'value' => 'Создатель Laravella CMS',
                                                'type' => 'text',
                                                'admin_label' => 'Должность',
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
                                                'admin_label' => 'Linkedin',
                                            ),
                                    ),
                                'row-1' =>
                                    array (
                                        'author-image' =>
                                            array (
                                                'value' => env('APP_URL').'filemanager/images/5db367b4093af.jpg',
                                                'type' => 'image',
                                                'admin_label' => 'Изображение автора',
                                            ),
                                        'author-name' =>
                                            array (
                                                'value' => 'Ilkin Alibayli',
                                                'type' => 'text',
                                                'admin_label' => 'Имя автора',
                                            ),
                                        'author-position' =>
                                            array (
                                                'value' => 'Содействующий в создании Laravella CMS',
                                                'type' => 'text',
                                                'admin_label' => 'Должность',
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
                                                'admin_label' => 'Linkedin',
                                            ),
                                    ),
                            ),
                    ),
            )
        );

        DB::table('pages')->insert([
            [],
            []
        ]);

        DB::table('page_translations')->insert([
            [
                'title' => 'Homepage',
                'locale' => 'en',
                'page_id' => 1,
                'slug' => '/',
                'author_id' => 1,
                'status' => 1,
                'meta_keywords' => 'page, homepage',
                'meta_description' => 'This is homepage of CMS Laravella',
                'custom_fields' => json_encode($home_page_custom_fields['en']),
                'template' => 'home',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Главная страница',
                'locale' => 'ru',
                'page_id' => 1,
                'slug' => '/',
                'author_id' => 1,
                'status' => 1,
                'meta_keywords' => 'страница, главная',
                'meta_description' => 'Это главная страница CMS Laravella',
                'custom_fields' => json_encode($home_page_custom_fields['ru']),
                'template' => 'home',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Contact',
                'slug' => 'contact',
                'locale' => 'en',
                'page_id' => 2,
                'author_id' => 1,
                'status' => 1,
                'meta_keywords' => 'page, contact',
                'meta_description' => 'Contact page',
                'template' => 'contacts',
                'custom_fields' => json_encode([]),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Контакты',
                'slug' => 'kontakti',
                'locale' => 'ru',
                'page_id' => 2,
                'author_id' => 1,
                'status' => 1,
                'meta_keywords' => 'страница, контакты',
                'meta_description' => 'Контактная страница',
                'template' => 'contacts',
                'custom_fields' => json_encode([]),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}

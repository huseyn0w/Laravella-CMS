<?php

namespace App\Http\Controllers\CPanel;

use App\Repositories\LocalizationRepository;


class CPanelLanguageController extends CPanelBaseController
{
    public function __construct(LocalizationRepository $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }

    public function index($lang)
    {
        $this->setLang($lang);

        if($this->checkIfAdminArea()) return redirect()->route('cpanel_home');

        return $this->findTranslatedEntity($lang);
    }

    private function checkIfAdminArea()
    {
        $previous_url = url()->previous();
        $cPanel_url = env('APP_URL').'/cpanel';

        $position = strpos($previous_url, $cPanel_url);

        if($position !== false) return true;
    }

    protected function findTranslatedEntity($lang)
    {
//        $slug = \Session::get('slug');
////
////
////        if(is_null($slug)) $slug = '/';
////
////        $entity = null;
////
//////
//////        $previous_route_name = app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName();
//////        $locale = get_current_lang();
//////
////////
////////        switch ($previous_route_name)
////////        {
////////            case 'front_pages':
////////                $entity = 'page';
////////                break;
////////            case 'posts':
////////                $entity = 'post';
////////                break;
////////            case 'categories_first_page':
////////                $entity = 'category';
////////                break;
////////            default:
////////                $entity = 'page';
////////                break;
////////        }


////
//        $new_slug = $this->repository->getTranslatedSlug($slug, $entity);
////        if(!$new_slug || is_null($entity)) return redirect('/');
//        return redirect()->route($previous_route_name, ['locale' => $locale, 'slug' => $new_slug]);


    }







}

<?php

namespace App\Http\Controllers\CPanel;

use App\Http\Requests\MenuRequest;
use App\Repositories\CPanelMenuRepository;
use Illuminate\Http\Request;

class CPanelMenuController extends CPanelBaseController
{

    private $post_fields, $categories_fields, $pages_fields;

    public function __construct(CPanelMenuRepository $repository)
    {
        parent::__construct();
        $this->repository = $repository;
        $this->post_fields = ['posts.id', 'post_translations.title', 'post_translations.slug'];
        $this->pages_fields = ['pages.id', 'page_translations.title', 'page_translations.slug'];
        $this->categories_fields = ['category_translations.category_id', 'category_translations.title', 'category_translations.slug'];
    }



    public function index()
    {
        $menus_list = $this->repository->only($this->per_page);
        return view('cpanel.menus.menus_list', compact("menus_list"));
    }

    public function addMenu()
    {
        $array = [
            "terms_list" => $this->getTermsListForMenu()
        ];

        if(request()->route('lang'))
        {
            $array['translation_links'] = get_entity_translation_links('menus', request()->id);
        }

        return view('cpanel.menus.new_menu', $array);
    }

    public function createMenu(MenuRequest $request)
    {
        if(!empty($request->route('id'))) unset($request['slug']);

        parent::create($request);
        return redirect()->route('cpanel_menu_list')->with('menu_added', " ");
    }

    public function editMenu($id)
    {
        $this->result = $this->repository->getBy('id', $id);

        if(is_null($this->result)) return $this->addMenu();

        return view('cpanel.menus.edit_menu', [
            "entity" => $this->result,
            "terms_list" => $this->getTermsListForMenu(),
            "translation_links" => get_entity_translation_links('menus', $id)
        ]);
    }

    private function getTermsListForMenu()
    {
        return [
            'posts' => get_post_list($this->post_fields),
            'pages' => get_pages_list($this->pages_fields),
            'categories' => get_post_categories_list($this->categories_fields),
        ];
    }

    public function updateMenu($id, MenuRequest $request)
    {
        return parent::update($id, $request);
    }

}

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
        $this->pages_fields = ['posts.id', 'post_translations.title', 'post_translations.slug'];
        $this->categories_fields = ['posts.id', 'post_translations.title', 'post_translations.slug'];
    }



    public function index()
    {
        $menus_list = $this->repository->only($this->per_page);
        return view('cpanel.menus.menus_list', compact("menus_list"));
    }

    public function addMenu()
    {
        return view('cpanel.menus.new_menu', [
            "terms_list" => $this->get_terms_list_for_menu()
        ]);
    }

    public function createMenu(MenuRequest $request)
    {
        parent::create($request);
        return redirect()->route('cpanel_menu_list')->with('menu_added', " ");
    }

    public function editMenu($id)
    {
        parent::edit($id);

        return view('cpanel.menus.edit_menu', [
            "entity" => $this->result,
            "terms_list" => $this->get_terms_list_for_menu()
        ]);
    }

    private function get_terms_list_for_menu()
    {
        return [
            'posts' => get_post_list($this->post_fields),
            'pages' => get_post_list($this->pages_fields),
            'categories' => get_post_list($this->categories_fields),
        ];
    }

    public function updateMenu($id, MenuRequest $request)
    {
        return parent::update($id, $request);
    }

}

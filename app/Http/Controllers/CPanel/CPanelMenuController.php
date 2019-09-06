<?php

namespace App\Http\Controllers\CPanel;

use App\Http\Requests\MenuRequest;
use App\Repositories\CPanelMenuRepository;
use Illuminate\Http\Request;

class CPanelMenuController extends CPanelBaseController
{

    public function __construct(CPanelMenuRepository $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }

    public function index()
    {
        $menus_list = $this->repository->only($this->per_page);
        return view('cpanel.menus.menus_list', compact("menus_list"));
    }

    public function addMenu()
    {
        return view('cpanel.menus.new_menu');
    }

    public function createMenu(MenuRequest $request)
    {
        parent::create($request);
        return redirect()->route('cpanel_menu_list')->with('menu_added', " ");
    }

    public function editMenu($id)
    {
        parent::edit($id);

        return view('cpanel.menus.edit_menu', ["menu" => $this->result]);
    }

    public function updateMenu($id, MenuRequest $request)
    {
        return parent::update($id, $request);
    }

}

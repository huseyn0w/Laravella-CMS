<?php

namespace App\Http\Controllers\CPanel;

use App\Http\Requests\PageListRequest;
use App\Http\Requests\ValidatePageData;
use App\Repositories\CPanelPageRepository;
use Illuminate\Http\Request;

class CPanelPageController extends CPanelBaseController
{

    private $users_list;
    private $page_templates;

    public function __construct(CPanelPageRepository $repository)
    {
        parent::__construct();
        $this->repository = $repository;
        $this->users_list = get_authors_list();
        $this->page_templates = get_page_templates_list();
    }


    public function index()
    {
        $pages_list = $this->repository->only($this->per_page);

        return view('cpanel.pages.pages_list', compact("pages_list"));
    }

    public function multipleDelete(PageListRequest $request)
    {
        $result = $this->repository->delete($request->pages);

        return back()->with('message', $result);
    }


    public function editPage($id)
    {
        parent::edit($id);

        return view('cpanel.pages.edit_page', ["entity" => $this->result, "users_list" => $this->users_list, "page_templates" => $this->page_templates]);
    }

    public function createPage(ValidatePageData $request)
    {
        parent::create($request);
        return redirect()->route('cpanel_pages_list')->with('page_added', " ");

    }


    public function updatePage($id, ValidatePageData $request)
    {
        return parent::update($id, $request);
    }



    public function addPage()
    {
        return view('cpanel.pages.new_page', ["users_list" => $this->users_list, "page_templates" => $this->page_templates]);
    }






}

<?php

namespace App\Http\Controllers\CPanel;

use App\Http\Requests\PageListRequest;
use App\Http\Requests\ValidatePageData;
use App\Repositories\CPanelPageRepository;
use Illuminate\Http\Request;

class CPanelPageController extends CPanelBaseController
{
    private $pages_per_page = 10;

    public function __construct(CPanelPageRepository $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }


    public function index()
    {
        $pages_list = $this->repository->only($this->pages_per_page);

        return view('cpanel.pages', compact("pages_list"));
    }

    public function multipleDelete(PageListRequest $request)
    {
        $result = $this->repository->delete($request->pages);

        return back()->with('message', $result);
    }


    public function editPage($id)
    {
        parent::edit($id);

        return view('cpanel.edit_page', ["page" => $this->result]);
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
        return view('cpanel.new_page');
    }






}

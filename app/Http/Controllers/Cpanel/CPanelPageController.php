<?php

namespace App\Http\Controllers\Cpanel;

use App\Http\Requests\PageListRequest;
use App\Http\Requests\ValidatePageData;
use App\Repositories\PagesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CPanelPageController extends CPanelBaseController
{
    private $pages_per_page = 10;

    public function __construct(PagesRepository $repository)
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

    public function show($id)
    {

    }

    public function edit($id)
    {

        $page = $this->repository->getBy('id', $id);

        if(!$page) abort(404);
        return view('cpanel.edit_page', compact("page"));
    }

    public function create(ValidatePageData $request)
    {
        $result = $this->repository->create($request->all());

        if(!$result) return back()->with('message', $result);

        return redirect()->route('cpanel_pages_list')->with('page_added', " ");

    }

    public function read()
    {

    }

    public function update($id, ValidatePageData $request)
    {
        $result = $this->repository->update($request->except('_token','_method'), $id);

        return back()->with('message', $result);

    }




    public function delete($id)
    {

    }

    public function addPage()
    {
        return view('cpanel.new_page');
    }






}

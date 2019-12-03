<?php

namespace App\Http\Controllers\CPanel;

use App\Http\Requests\CategoryListRequest;
use App\Http\Requests\CategoryRequest;
use App\Repositories\CategoryRepository;
use App\Repositories\CPanelCategoryRepository;
use Illuminate\Http\Request;

class CPanelCategoryController extends CPanelBaseController
{

    public function __construct(CPanelCategoryRepository $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }

    public function createCategory(CategoryRequest $request)
    {
        $this->repository->create($request);

        return redirect()->route('cpanel_category_list')->with('category_added', " ");

    }

    public function edit($id)
    {
       parent::edit($id);
       return view('cpanel.post_categories.edit_category', ['category' => $this->result]);
    }

    public function index()
    {
        $categories_list = $this->repository->only($this->per_page);

        return view('cpanel.post_categories.post_categories_list', compact("categories_list"));
    }

    public function addCategory()
    {
        return view('cpanel.post_categories.new_category');
    }

    public function multipleDelete(CategoryListRequest $request)
    {
        $result = $this->repository->delete($request->categories);

        return back()->with('message', $result);
    }

    public function updateCategory($id, CategoryRequest $request)
    {
        return parent::update($id, $request);
    }


}

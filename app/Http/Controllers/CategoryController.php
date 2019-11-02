<?php

namespace App\Http\Controllers;

use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class CategoryController extends BaseController
{
    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(string $category_slug,  int $page = 1)
    {
//        Paginator::setCurrentPage($page);
//        Paginator::setBaseUrl('categories_list'); // use here route name and not the url
//        Paginator::setPageName('page');

        $data = $this->repository->getBy('slug', $category_slug);

        $data->posts = $this->repository->displayList($data->id);

        return view('default/categories/category', compact('data'));
    }

}

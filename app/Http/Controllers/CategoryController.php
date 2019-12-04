<?php

namespace App\Http\Controllers;

use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class CategoryController extends BaseController
{
    public function __construct(CategoryRepository $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }

    public function index(string $category_slug, int $page = 1)
    {

        $data = $this->repository->getBy('slug', $category_slug);

        $data->posts = $this->repository->displayList($data->id, $page);


        return view('default/categories/category', ['data' => $data, 'home_page_data' => $this->home_page_data]);
    }

}

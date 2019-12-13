<?php

namespace App\Http\Controllers;

use App\Repositories\CategoryRepository;


class CategoryController extends BaseController
{
    public function __construct(CategoryRepository $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }

    public function index(string $category_slug, string $locale = null, int $page = 1)
    {
        $result = parent::index($category_slug, $locale);

        if(is_object($result)) return $result;

        $this->data->posts = $this->repository->displayList($this->data->id, $page);

        return view('default/categories/category', ['data' => $this->data]);
    }

}

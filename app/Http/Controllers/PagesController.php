<?php

namespace App\Http\Controllers;

use App\Http\Models\Page;
use App\Repositories\PageRepository;
use Illuminate\Http\Request;

class PagesController extends BaseController
{

    public function __construct(PageRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($page_slug = "/")
    {

       $page_data = $this->repository->getBy('slug', $page_slug);

       if(empty($page_data->custom_fields)) return view('default/pages/'.$page_data->template, compact('page_data'));

       $custom_fields = json_decode($page_data->custom_fields, true);



       return view('default/pages/'.$page_data->template, compact('page_data', 'custom_fields'));
    }



}

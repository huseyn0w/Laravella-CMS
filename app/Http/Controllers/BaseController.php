<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    protected $repository;

    protected $home_page_data;

    public function __construct()
    {
        $this->home_page_data = get_data(1, 'page', ['slug', 'title']);
    }
}

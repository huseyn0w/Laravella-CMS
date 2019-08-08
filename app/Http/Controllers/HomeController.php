<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\User as User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('default/home');
    }
}

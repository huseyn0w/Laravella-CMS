<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class cPanel extends Controller
{
    public function  __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('cpanel.home');
    }

    public function settings()
    {
        return view('cpanel.settings');
    }

    public function myprofile()
    {
        return view('cpanel.myprofile');
    }


}

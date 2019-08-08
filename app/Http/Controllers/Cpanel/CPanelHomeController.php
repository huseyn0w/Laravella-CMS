<?php

namespace App\Http\Controllers\Cpanel;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class cPanelHomeController extends CPanelBaseController
{
    public function  __construct()
    {
        parent::__construct();

    }


    public function index(Request $request)
    {
        return view('cpanel.home');
    }



}

<?php

namespace App\Http\Controllers\Cpanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class cPanelHomeController extends Controller
{
    public function  __construct()
    {

    }

    public function index()
    {
        return view('cpanel.home');
    }



}

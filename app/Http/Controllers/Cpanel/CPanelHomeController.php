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
//        $user = auth()->user();
//
//        print_r(json_decode($user->role->permissions, true));
//        dd();
        return view('cpanel.home');
    }



}

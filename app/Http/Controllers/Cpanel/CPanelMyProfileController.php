<?php

namespace App\Http\Controllers\Cpanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CPanelMyProfileController extends Controller
{
    public function index()
    {
        return view('cpanel.myprofile');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class LanguageController extends Controller
{
    public function index($lang)
    {
        \Session::put('locale',$lang);

        $previous_url = url()->previous();
        $cpanel_url = env('APP_URL').'cpanel';

        $position = strpos($previous_url, $cpanel_url);

        if($position !== false) return redirect()->route('cpanel_home');
        return redirect('/');
    }
}

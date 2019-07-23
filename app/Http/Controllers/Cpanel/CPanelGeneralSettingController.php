<?php

namespace App\Http\Controllers\Cpanel;

use App\Http\Requests\StoreGeneralSettings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class cPanelGeneralSettingController extends Controller
{
    public function index()
    {
        return view('cpanel.general-settings');
    }

    public function store(StoreGeneralSettings $request)
    {
        $input = $request->all();
        dd($input);

    }
}

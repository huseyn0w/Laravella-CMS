<?php

namespace App\Http\Controllers\Cpanel;

use App\Http\Requests\StoreGeneralSettings;
use App\Repositories\CPanelGeneralSettingRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class cPanelGeneralSettingController extends Controller
{
    public function index()
    {
        return view('cpanel.general-settings');
    }

    public function store(StoreGeneralSettings $request, CPanelGeneralSettingRepository $repository)
    {
        $result = $repository->saveSettings($request->all());

        $result ? $message = 'salam' : $message = null;

    }
}

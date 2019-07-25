<?php

namespace App\Http\Controllers\Cpanel;

use App\Http\Requests\StoreGeneralSettings;
use App\Repositories\CPanelGeneralSettingRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class cPanelGeneralSettingController extends Controller
{
    public function index(CPanelGeneralSettingRepository $repository)
    {
        $general_settings = $repository->getAllSettings();

        return view('cpanel.general-settings', compact("general_settings"));
    }

    public function store(StoreGeneralSettings $request, CPanelGeneralSettingRepository $repository)
    {
        $result = $repository->saveSettings($request->all());

        if($result){
            return back()->with('success','Settings has beed saved!');
        }
        else{
            return back()->with('danger', $result);
        }



    }
}

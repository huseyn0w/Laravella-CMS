<?php

namespace App\Http\Controllers\Cpanel;

use App\Http\Requests\StoreGeneralSettings;
use App\Repositories\CPanelGeneralSettingRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class cPanelGeneralSettingController extends Controller
{

    private $repository;

    public function __construct(CPanelGeneralSettingRepository $repository)
    {
        $this->repository = $repository;
    }


    public function index()
    {
        $general_settings = $this->repository->all();

        return view('cpanel.general-settings', compact("general_settings"));
    }

    public function store(StoreGeneralSettings $request)
    {
        $result = $this->repository->update($request->all());

        return back()->with('message', $result);
    }
}

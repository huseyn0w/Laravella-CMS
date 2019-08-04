<?php

namespace App\Http\Controllers\Cpanel;

use App\Http\Requests\ValidateGeneralSettings;
use App\Repositories\CPanelGeneralSettingRepository;
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

    public function store(ValidateGeneralSettings $request)
    {
        $result = $this->repository->update($request);

        return back()->with('message', $result);
    }
}

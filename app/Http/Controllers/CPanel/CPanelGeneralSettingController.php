<?php

namespace App\Http\Controllers\CPanel;

use App\Http\Requests\ValidateGeneralSettings;
use App\Repositories\CPanelGeneralSettingRepository;
use App\Http\Models\CPanel\CPanelGeneralSettings;
use Illuminate\Support\Facades\Auth;

class CPanelGeneralSettingController extends CPanelBaseController
{

    public function __construct(CPanelGeneralSettingRepository $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }


    public function index(CPanelGeneralSettings $general_settings)
    {
        $general_settings = $this->repository->first();

        return view('cpanel.settings.general-settings', compact("general_settings"));
    }

    public function store(ValidateGeneralSettings $request)
    {
        $result = $this->repository->update($request);

        return back()->with('message', $result);
    }
}

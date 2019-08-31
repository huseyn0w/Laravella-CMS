<?php

namespace App\Http\Controllers\Cpanel;

use App\Http\Requests\ValidateGeneralSettings;
use App\Repositories\CPanelGeneralSettingRepository;
use App\Http\Models\Cpanel\CPanelGeneralSettings;
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

        return view('cpanel.general-settings', compact("general_settings"));
    }

    public function store(ValidateGeneralSettings $request)
    {
        $result = $this->repository->update($request);

        return back()->with('message', $result);
    }
}

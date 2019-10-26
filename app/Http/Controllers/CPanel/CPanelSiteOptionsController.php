<?php

namespace App\Http\Controllers\CPanel;

use App\Http\Requests\ValidateSiteOptions;
use App\Repositories\CPanelSiteOptionsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CPanelSiteOptionsController extends CPanelBaseController
{
    public function __construct(CPanelSiteOptionsRepository $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }


    public function index()
    {
        $site_options = $this->repository->first();

        return view('cpanel.settings.site-options', compact("site_options"));
    }

    public function store(ValidateSiteOptions $request)
    {
        $result = $this->repository->update($request);

        return back()->with('message', $result);
    }


}

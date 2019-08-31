<?php

namespace App\Http\Controllers\Cpanel;

use App\Http\Requests\MediaRequest;
use App\Repositories\CPanelMediaRepository;
use Illuminate\Http\Request;

class CPanelMediaController extends CPanelBaseController
{
    public function __construct(CPanelMediaRepository $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }


    public function index()
    {
        return view('cpanel.media');
    }

    public function store(MediaRequest $request)
    {
        $result = $this->repository->uploadMedia($request);

        if($result) return response()->json(['message' => "Upload completed"]);

    }

}

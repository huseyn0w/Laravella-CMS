<?php

namespace App\Http\Controllers\CPanel;

use App\Http\Requests\MediaRequest;
use App\Repositories\CPanelMediaRepository;
use Illuminate\Http\Request;

class CPanelMediaController extends CPanelBaseController
{


    public function index()
    {
        return view('cpanel.media');
    }


}

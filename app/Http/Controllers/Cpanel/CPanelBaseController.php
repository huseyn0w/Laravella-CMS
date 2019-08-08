<?php

namespace App\Http\Controllers\Cpanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class CPanelBaseController extends Controller
{
    protected $repository;

    public function __construct()
    {
        //
    }

    protected function checkUserPermission($permissionName, $modelName)
    {
        if (Auth::user()->cannot($permissionName, $modelName)) return false;

        return true;

    }

    protected function redirectUnathorizedUser()
    {
        return redirect()->route('unathorized');
    }

}

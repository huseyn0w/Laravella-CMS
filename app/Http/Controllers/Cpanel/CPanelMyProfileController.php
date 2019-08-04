<?php

namespace App\Http\Controllers\Cpanel;

use App\Http\Requests\ValidateUserSettings;
use App\Repositories\CPanelUserSettingRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CPanelMyProfileController extends Controller
{
    private $repository;

    public function __construct(CPanelUserSettingRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $user = auth()->user();
        return view('cpanel.myprofile', compact('user'));
    }

    public function store(ValidateUserSettings $request)
    {

        $user = auth()->user();
        $update_for_user_id = $user->id;
        $result = $this->repository->update($request, $update_for_user_id);


        return back()->with('message', $result);
    }
}

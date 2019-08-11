<?php

namespace App\Http\Controllers\Cpanel;

use App\Http\Requests\ValidateUserSettings;
use App\Repositories\CPanelUserRepository;
use Illuminate\Http\Request;

class CPanelMyProfileController extends CPanelBaseController
{

    public function __construct(CPanelUserRepository $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }

    public function index()
    {
        $user = auth()->user();
        return view('cpanel.profile', compact('user'));
    }

    public function store(ValidateUserSettings $request)
    {

        $user = auth()->user();
        $update_for_user_id = $user->id;
        $result = $this->repository->update($request, $update_for_user_id);


        return back()->with('message', $result);
    }
}

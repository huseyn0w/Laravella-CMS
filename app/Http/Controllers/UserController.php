<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\FrontEndUserRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Hash;

class UserController extends BaseController
{
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $user = $this->repository->getLoggedUserInfo();
        return view('default.users.profile', compact('user'));
    }

    public function update(FrontEndUserRequest $request)
    {
        $this->result = $this->repository->updateUser($request);

        return back()->with('message', " ");
    }

    public function password()
    {
        return view('default.users.change_password');
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $result = $this->result = $this->repository->changePassword($request);

        if(!$result) return redirect()->back()->withErrors('Your current password does not matches with the password you provided. Please try again.');

        return back()->with('message', " ");
    }
}

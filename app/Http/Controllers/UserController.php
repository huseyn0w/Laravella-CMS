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
        parent::__construct();
        $this->repository = $repository;
    }

    public function yourProfile()
    {
        $username = get_logged_user_username();
        $user = $this->repository->getBy('username', $username);

        return view('default.users.yourprofile', compact('user'));
    }

    public function update(FrontEndUserRequest $request)
    {
        $user_id = get_logged_user_id();
        $this->repository->update($user_id, $request);

        return back()->with('message', " ");
    }

    public function password()
    {
        return view('default.users.change_password');
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $result = $this->repository->changePassword($request);

        if(!$result) return redirect()->back()->withErrors(trans('cpanel/controller.password_match'));

        return back()->with('message', " ");
    }

    public function show($username)
    {
        $user = $this->repository->getBy('username', $username);
        return view('default.users.profile', compact('user'));
    }
}

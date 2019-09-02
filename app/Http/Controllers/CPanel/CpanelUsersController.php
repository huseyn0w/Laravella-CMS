<?php

namespace App\Http\Controllers\CPanel;

use App\Http\Models\User;
use App\Http\Requests\UserListRequest;
use App\Http\Requests\ValidateUserSettings;
use App\Repositories\CPanelUserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CPanelUsersController extends CPanelBaseController
{


    public function __construct(CPanelUserRepository $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }


    public function index()
    {

        $users_list = $this->repository->only($this->users_per_page);

        return view('cpanel.users', compact("users_list"));
    }


    public function editUser($id = null)
    {

        if(is_null($id)) $id = $this->user->id;

        $user = $this->repository->getUserInfo($id);

        return view('cpanel.profile', compact('user'));
    }


    public function updateUser($id, ValidateUserSettings $request)
    {
        return parent::update($id, $request);
//
//        $result = $this->repository->update($request, $id);
//
//        return back()->with('message', $result);
    }


    public function multipleDelete(UserListRequest $request)
    {
        $result = $this->repository->delete($request->users);

        return back()->with('message', $result);
    }

    public function addUser()
    {
        return view('cpanel.new_user');
    }

    public function createUser(ValidateUserSettings $request)
    {
        parent::create($request);

        return redirect()->route('cpanel_all_users_list')->with('user_added', " ");
    }

}

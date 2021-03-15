<?php

namespace App\Http\Controllers\CPanel;

use App\Http\Models\User;
use App\Http\Requests\UserListRequest;
use App\Http\Requests\ValidateUserSettings;
use App\Repositories\CPanelUserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CPanelUserController extends CPanelBaseController
{

    private $user_roles;
    private $countries;

    public function __construct(CPanelUserRepository $repository)
    {
        parent::__construct();
        $this->repository = $repository;
        $this->user_roles = get_user_roles();
        $this->countries = get_countries_array();
    }


    public function index()
    {
        $users_list = $this->repository->only($this->per_page);

        return view('cpanel.users.users_list', compact("users_list"));
    }


    public function editUser($id = null)
    {

        if(is_null($id)) $id = $this->user->id;

        $user = $this->repository->getBy('id',$id);

        return view('cpanel.users.profile', ['user' => $user, "countries" => $this->countries, "user_roles" => $this->user_roles]);
    }


    public function updateUser($id, ValidateUserSettings $request)
    {
        return parent::update($id, $request);

    }


    public function multipleDelete(UserListRequest $request)
    {
        $result = $this->repository->delete($request->users);

        return back()->with('message', $result);
    }

    public function addUser()
    {
        return view('cpanel.users.new_user', ["countries" => $this->countries, "user_roles" => $this->user_roles]);
    }

    public function createUser(ValidateUserSettings $request)
    {
        parent::create($request);

        return redirect()->route('cpanel_all_users_list')->with('user_added', " ");
    }

}

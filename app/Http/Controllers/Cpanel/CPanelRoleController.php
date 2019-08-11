<?php

namespace App\Http\Controllers\Cpanel;

use App\Http\Requests\ValidateUserRoles;
use App\Repositories\CPanelUserRolesRepository;
use Illuminate\Http\Request;

class CPanelRoleController extends CPanelBaseController
{
    public function __construct(CPanelUserRolesRepository $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }

    public function index()
    {
        $roles_list = $this->repository->only($this->users_per_page);

        return view('cpanel.roles', compact("roles_list"));
    }

    public function addRole()
    {
        return view('cpanel.new_role');
    }

    public function saveRole(ValidateUserRoles $request)
    {
        $result = $this->repository->create($request);

        if(!$result) return back()->with('message', $result);

        return redirect()->route('cpanel_user_roles')->with('role_added', '-');
    }

    public function edit($id)
    {

        $role = $this->repository->getBy('id', $id);

        if(!$role) abort(404);
        return view('cpanel.edit_role', compact("role"));
    }

    public function update($id, ValidateUserRoles $request)
    {
        $result = $this->repository->update($request,$id);
        if(!$result) return back()->with('fail', '-');
        return back()->with('message', '-');
    }
}

<?php

namespace App\Http\Controllers\CPanel;

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

    public function createRole(ValidateUserRoles $request)
    {
        parent::create($request);

        return redirect()->route('cpanel_user_roles')->with('role_added', '-');
    }

    public function editRole($id)
    {
        parent::edit($id);
        return view('cpanel.edit_role', ["role" => $this->result]);
    }

    public function updateRole($id, ValidateUserRoles $request)
    {
        return parent::update($id, $request);
    }
}

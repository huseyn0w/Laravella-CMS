<?php

namespace App\Http\Controllers\CPanel;

use App\Http\Models\User;
use App\Repositories\CPanelUserListRepository;
use Illuminate\Http\Request;

class CpanelUsersController extends CPanelBaseController
{
    private $users_per_page = 10;

    public function __construct(CPanelUserListRepository $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }

    public function index(User $user)
    {
        $this->authorize('seeAllUsers', $user);

        $users_list = $this->repository->only($this->users_per_page);

        return view('cpanel.users', compact("users_list"));
    }

    public function edit($id)
    {

    }

    public function update($id)
    {

    }

    public function delete()
    {

    }
}

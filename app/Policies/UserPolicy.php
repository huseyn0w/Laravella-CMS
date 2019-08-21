<?php

namespace App\Policies;

use App\Http\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
    use HandlesAuthorization;

    private $user_permissions;

    public function __construct()
    {
        $this->user_permissions = json_decode(Auth::user()->permissions());
    }

    public function manage_general_settings()
    {
        $result = false;

        if($this->user_permissions->manage_general_settings === 1) $result = true;

        return $result;
    }

    public function manage_users()
    {
        $result = false;

        if($this->user_permissions->manage_users === 1) $result = true;

        return $result;
    }


    public function manage_user_roles()
    {
        $result = false;

        if($this->user_permissions->manage_user_roles === 1) $result = true;

        return $result;
    }

    public function manage_pages()
    {
        $result = false;

        if($this->user_permissions->manage_pages === 1) $result = true;

        return $result;
    }




}
<?php

namespace App\Policies;

use App\Http\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
    use HandlesAuthorization;

    protected $user_permissions;

    public function __construct()
    {
        $this->user_permissions = json_decode(Auth::user()->permissions());
    }

    public function changeCpanelGeneralSettings()
    {
        $result = false;

        if($this->user_permissions->read_settings === 1 && $this->user_permissions->update_settings === 1) $result = true;

        return $result;
    }

    public function seeAllUsers()
    {
        $result = false;

        if($this->user_permissions->read_users === 1) $result = true;

        return $result;
    }



}
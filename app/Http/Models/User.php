<?php

namespace App\Http\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth as Auth;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'role_id',
        'password',
        'username',
        'city',
        'country',
        'about_me',
        'linkedin_url',
        'xing_url',
        'facebook_url',
        'google_url'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Add a mutator to ensure hashed passwords
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    public function role()
    {
        return $this->hasOne('App\Http\Models\UserRoles', 'id', 'role_id');
    }

    public function isAdmin()
    {
        return $this->role->id === 1;
    }

    public function permissions()
    {
        return $this->role->permissions;
    }

    public function likes()
    {
        return $this->hasMany(Likes::class);
    }

    public function post()
    {
        return $this->hasMany(Post::class);
    }


}

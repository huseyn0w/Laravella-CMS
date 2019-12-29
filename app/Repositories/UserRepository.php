<?php
/**
 * Laravella CMS
 * File: PageRepository.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 24.10.2019
 */

namespace App\Repositories;

use App\Http\Models\User;
use Illuminate\Support\Facades\Auth;
use Image;
use Hash;

class UserRepository extends BaseRepository
{
    private  $logged_user_id;

    protected $select_fields = [
        'email',
        'username',
        'name',
        'surname',
        'gender',
        'country',
        'city',
        'role_id',
        'facebook_url',
        'twitter_url',
        'google_url',
        'instagram_url',
        'linkedin_url',
        'xing_url',
        'about_me',
        'created_at',
        'avatar',
    ];

    public function __construct(User $model)
    {
        parent::__construct();
        $this->model = $model;
    }


    private function get_logged_user_id()
    {
        if(!is_logged_in()) return false;

        $this->logged_user_id = get_logged_user_id();
    }

    public function update(int $id, $request)
    {

        $data = $request->all();

        if($request->hasFile('avatar')){
            $data = $request->except(['avatar']);
            $data['avatar'] = uploadImage($request->avatar);
        }

        $user = $this->model->findOrFail($id);

        $result = $user->update($data) ? true : false;


        return $result;
    }


    public function changePassword($request)
    {
        if (!is_logged_in() || !(Hash::check($request->current_password, \Auth::user()->password))) return false;

        $this->get_logged_user_id();

        $user = $this->model->findOrFail($this->logged_user_id);
        $result = $user->update(['password'=> $request->password]);


        return $result;
    }
    
}
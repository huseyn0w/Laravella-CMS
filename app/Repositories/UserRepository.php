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


    public function updateUser($updatedRequest)
    {

        $this->get_logged_user_id();


        try {
            $except_fields = ["_token", "_method","g-recaptcha-response"];

            $newData = $updatedRequest->except($except_fields);

            if($updatedRequest->hasFile('avatar')){
                $newData['avatar'] = $this->uploadImage($updatedRequest);
            }

            $user = $this->model::findOrFail($this->logged_user_id);
            $user->update($newData);
            $result = true;

        } catch (QueryException $e) {
            return $this->throwAbort();
        }

        return $result;
    }


    private function get_logged_user_id()
    {
        if(!is_logged_in()) return false;

        $this->logged_user_id = get_logged_user_id();

    }

    private function uploadImage($request)
    {
        $this->get_logged_user_id();

        $imageName = time().'.'.$request->avatar->getClientOriginalName();

        $dir = public_path('uploads/avatars/'.$this->logged_user_id);


        if($this->deleteDirectory($dir))
        {
            mkdir($dir);

            $path = public_path('uploads/avatars/'.$this->logged_user_id.'/'.$imageName);


            Image::make($request->file('avatar'))
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path);

            return asset('uploads/avatars/'.$this->logged_user_id.'/'.$imageName);
        }

        return false;

    }

    private function deleteDirectory($dir)
    {
        if (!file_exists($dir)) {
            return true;
        }

        if (!is_dir($dir)) {
            return unlink($dir);
        }

        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }

            if (!$this->deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
                return false;
            }

        }

        return rmdir($dir);
    }

    public function changePassword($request)
    {
        if (!is_logged_in() || !(Hash::check($request->current_password, \Auth::user()->password))) return false;

        $this->get_logged_user_id();
//        dd($this->logged_user_id);

//        $new_password = bcrypt($request->password);

        $user = $this->model->findOrFail($this->logged_user_id);
        $result = $user->update(['password'=> $request->password]);

        return $result;
    }
    
}
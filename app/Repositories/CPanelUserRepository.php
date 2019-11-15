<?php
/**
 * Laravella CMS
 * File: CPanelUserRepository.phpCreated by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 09.08.2019
 */

namespace App\Repositories;

use Image;
use App\Http\Models\User;
use App\Http\Models\UserRoles;
use Illuminate\Support\Facades\Auth;

class CPanelUserRepository extends BaseRepository
{
    public function __construct(User $model)
    {
        parent::__construct();
        $this->model = $model;
    }

    public function getUserInfo(int $id)
    {
        $user_fields = [
            'id',
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

        $userdata = $this->getBy('id', $id, $user_fields);

        return $userdata;
    }

    public function only($count, $fields = [])
    {
        $fields = ['id','username','email','name','surname','country', 'city', 'role_id'];

        try{

            !empty($fields) ? $data = $this->model::select($fields)->with('role')->paginate($count) : false;
        }
        catch (QueryException $e){
            $data = $e->errorInfo;
        }

        return $data;
    }

    public function update($id, $updatedRequest)
    {
        try {

            $newData = $updatedRequest->except(["_token", "_method", "password_confirmation"]);
            $newData['password'] = bcrypt($updatedRequest->password);

            if(empty($updatedRequest->password)){
                $newData = $updatedRequest->except(["_token", "_method", "password", "password_confirmation"]);
            }




            $this->model::where('id', $id)->update($newData);
            $result = true;

        } catch (QueryException $e) {
            $result = $e->errorInfo;
        }

        return $result;
    }


    private function getImageName($request, $id)
    {
        $imageName = time().'.'.$request->avatar->getClientOriginalName();
        Image::make($request->file('avatar'))
            ->resize('200','200')
            ->save(public_path('uploads/avatars/'.$id.'/'.$imageName));
        return $imageName;
    }
}
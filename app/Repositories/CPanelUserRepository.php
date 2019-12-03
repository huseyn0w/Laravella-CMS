<?php
/**
 * Laravella CMS
 * File: CPanelUserRepository.phpCreated by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 09.08.2019
 */

namespace App\Repositories;

use Image;
use App\Http\Models\User;
use Illuminate\Database\QueryException;
use Doctrine\DBAL\Driver\PDOException;

class CPanelUserRepository extends BaseRepository
{
    protected $select_fields = [
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

    public function __construct(User $model)
    {
        parent::__construct();
        $this->model = $model;
    }


    public function non_translated_only($count)
    {
        $fields = [
            'id','username','email','name','surname','country', 'city', 'role_id'
        ];

        try{
            $data = !empty($fields) ? $data = $this->model::select($fields)->with('role')->paginate($count) : false;
        } catch (QueryException $e) {
            throwAbort();
        } catch (PDOException $e) {
            throwAbort();
        } catch (\Error $e) {
            throwAbort();
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

            $user = $this->model::findOrFail($id);

            if($user->update($newData)) $result = true;


        } catch (QueryException $e) {
            $result = $e->errorInfo;
        }

        return $result;
    }


}
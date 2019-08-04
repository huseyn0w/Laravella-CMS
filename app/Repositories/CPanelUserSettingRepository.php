<?php
/**
 * Laravella CMS
 * File: CPanelUserSettingRepository.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 04.08.2019
 */

namespace App\Repositories;

use App\Http\Models\User;
use Image;

class CPanelUserSettingRepository extends BaseRepository
{
    protected $model;


    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function update($updatedRequest, $id = 1)
    {
        try {

            $newData = $updatedRequest->except(["_token"]);

            if($updatedRequest->hasFile('avatar')){
                $imageName = time().'.'.$updatedRequest->avatar->getClientOriginalName();
                Image::make($updatedRequest->file('avatar'))
                    ->resize('200','200')
                    ->save(public_path('uploads/images/avatars/'.$id.'/'.$imageName));
                $newData['avatar'] = $imageName;
            }

            $this->model::where('id', $id)->update($newData);
            $result = true;

        } catch (QueryException $e) {
            $result = $e->errorInfo;
        }

        return $result;
    }

}
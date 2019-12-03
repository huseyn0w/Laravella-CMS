<?php
/**
 * Laravella CMS
 * File: CPanelUserRepository.phpCreated by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 09.08.2019
 */

namespace App\Repositories;

use Image;
use App\Http\Models\UserRoles;
use Illuminate\Support\Facades\Auth;

class CPanelUserRolesRepository extends BaseRepository
{
    public function __construct(UserRoles $model)
    {
        parent::__construct();
        $this->model = $model;
    }

    public function create($request)
    {
        $data = $this->prepare_role_data($request);

        $result = false;
        if($this->model::create($data)) $result = true;

        return $result;
    }

    public function update($id,$request)
    {
        $data = $this->prepare_role_data($request);

        $result = $this->model::where('id', $id)->update($data);

        return $result;
    }


    private function prepare_role_data($request)
    {
        $data = [];

        $all_permissions = get_user_role_permissions();

        $data['name'] = $request['name'];
        foreach($all_permissions as $permission){
            $data['permissions'][$permission->name] = 0;
        }

        if(isset($request['permissions']) && !empty($request['permissions']) && is_array($request['permissions']))
        {
            foreach($request['permissions'] as $key => $permission_name){
                $data['permissions'][$permission_name] = 1;
            }
        }


        $data['permissions'] = json_encode($data['permissions']);

        return $data;

    }
}
<?php
/**
 * Laravella CMS
 * File: CPanelUserRepository.phpCreated by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 09.08.2019
 */

namespace App\Repositories;

use App\Http\Models\Page;

class CPanelPageRepository extends BaseRepository
{
    public function __construct(Page $model)
    {
        parent::__construct();
        $this->model = $model;
    }

    public function only($count, $fields = [])
    {
        $fields = ['id', 'title', 'slug', 'status', 'author_id', 'created_at'];
        $data = $this->model->select($fields)->with('author')->paginate($count);

        if(empty($data)) abort(403, 'Some problem occured');

        return $data;
    }

    public function create($request)
    {
        $newData = $request->except('custom_fields');

        if(isset($request->custom_fields)) $newData['custom_fields'] = json_encode($request->custom_fields);


        try{
            $post_saved = $this->model::create($newData);
            if($post_saved) return true;
        }
        catch (\Exception $e){
            abort(403, 'Some problem occured');
        }

    }

    public function update($id,$request)
    {
//        dd($request->custom_fields);
        $newData = $request->except(["_token", "_method", "custom_fields"]);

        if(isset($request->custom_fields)) $newData['custom_fields'] = json_encode($request->custom_fields);


        try{
            $post_saved = $this->model::where('id', $id)->update($newData);
            if($post_saved) return true;
        }
        catch (\Exception $e){
            abort(403, 'Some problem occured');
        }
    }

}
<?php
/**
 * Laravella CMS
 * File: BaseRepository.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 25.07.2019
 */

namespace App\Repositories;


use Illuminate\Database\QueryException;

abstract class BaseRepository implements  BaseRepositoryInterface{

    protected $model;

    public function __construct()
    {

    }

    public function create($request)
    {
        $result = false;
        if($this->model::create($request->all())) $result = true;

        return $result;
    }

    public function all()
    {
        $result = false;

        $result = $this->model::all();

        return $result;
    }
    public function get($id, $fields = [])
    {

    }

    public function selectBy($fields)
    {

        $data = $this->model::select($fields)->get;

        return $data;

    }

    public function first()
    {
        try{
            $data = $this->model::first();
        }
        catch (QueryException $e){
            $data = $e->errorInfo;
        }

        return $data;
    }

    public function only($count, $fields = []){

        try{
            empty($fields) ? $data = $this->model::paginate($count) : $data = $this->model::select($fields)->paginate($count);
        }
        catch (QueryException $e){
            $data = $e->errorInfo;
        }

        return $data;
    }

    public function getBy($paramName, $paramValue, $fields = [])
    {

        if(!empty($fields)){
            $data = $this->model::select($fields)->where($paramName, $paramValue)->first();
        }
        else{
            $data = $this->model::where($paramName, $paramValue)->first();
        }

        if(!$data) return false;

        return $data;
    }




    public function update($id, $newData)
    {

        try {
            $this->model::where('id', $id)->update($newData->except(["_token", "_method"]));
            $result = true;

        } catch (QueryException $e) {
            $result = $e->errorInfo;
        }

        return $result;

    }
    public function updateWhere($data, $parameter = 'id')
    {

    }
    public function delete($id)
    {
        $result = false;
        if($this->model::destroy($id)) $result = true;

        return $result;
    }

    public function deleteWhere($parameter = 'id')
    {

    }

    public function restore($id)
    {
        $result = false;
        if($this->model::withTrashed()->where('id', $id)->restore()) $result = true;
        return $result;
    }

    public function destroy($id)
    {
        $result = false;
        if($this->model::where('id', $id)->forceDelete()) $result = true;

        return $result;
    }




}
<?php
/**
 * Laravella CMS
 * File: BaseRepository.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 25.07.2019
 */

namespace App\Repositories;


abstract class BaseRepository implements  BaseRepositoryInterface{

    protected $model;

    public function __construct()
    {

    }

    public function create($data)
    {

    }

    public function all()
    {

    }
    public function get($id)
    {

    }

    public function first()
    {
        $data = $this->model::first();

        return $data;
    }

    public function only($count){

        $data = $this->model::paginate($count);

        return $data;
    }

    public function getBy($paramName = 'id')
    {

    }
    public function update($validatedRequest, $id = 1)
    {
        try {

            $newData = $validatedRequest->except(["_token"]);


            $this->model::where('id', $id)->update($newData);
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

    }

    public function deleteWhere($parameter = 'id')
    {

    }




}
<?php
/**
 * Laravella CMS
 * File: BaseRepository.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 25.07.2019
 */

namespace App\Repositories;


abstract class BaseRepository implements  BaseRepositoryInterface{

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
    public function getBy($paramName = 'id')
    {

    }
    public function update($data, $id = 1)
    {

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
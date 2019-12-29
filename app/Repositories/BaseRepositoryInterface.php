<?php
/**
 * Laravella CMS
 * File: BaseRepositoryInterface.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 28.07.2019
 */

namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{


    /**
     * @param $data
     */
    public function create($data);

    /**
     * Get all records
     */
    public function all();


    /**
     * Get only limited amount of records
     * @param $count
     */
    public function only($count, $page = 1);

    /**
     * Get first value from database
     */
    public function first();


    /**
     * Get one record by $param
     * @param $param
     */
    public function get($param);


    /**
     * Get one record by custom parameter
     * @param $parameter
     * @param $value
     * @param array $fields
     */
    public function getBy($parameter, $value, $field = []);

    /**
     * Get record by ID
     * @param $newData
     * @param $id
     */
    public function update(int $id, $newData);

    /**
     * Update one record by custom parameter
     * @param $newData
     */
    public function updateWhere($newData, $parameter);

    /**
     * Delete record by ID
     * @param $id
     */
    public function delete($id);

    /**
     * Delete record by custom parameter
     * @param $parameter
     */
    public function deleteWhere($parameter);


}
<?php
/**
 * Laravella CMS
 * File: BaseRepositoryInterface.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 28.07.2019
 */

namespace App\Repositories;


interface BaseRepositoryInterface
{

    /**
     * Create new record
     * @param $data
     * @return mixed
     */
    public function create($data);

    /**
     * Get all records
     * @return mixed
     */
    public function all();


    /**
     * Get only limited amount of records
     * @param $count
     * @return mixed
     */
    public function only($count, $page = 1);

    /**
     * Get first value from database
     * @return mixed
     */
    public function first();


    /**
     * Get one record by $param
     * @param $param
     * @return mixed
     */
    public function get($param);


    /**
     * Get one record by custom parameter
     * @param $parameter
     * @param $value
     * @param array $fields
     * @return mixed
     */
    public function getBy($parameter, $value, $field = []);

    /**
     * Get record by ID
     * @param $newData
     * @param $id
     * @return mixed
     */
    public function update(int $id, $newData);

    /**
     * Update one record by custom parameter
     * @param $newData
     * @param $parameter
     * @return mixed
     */
    public function updateWhere($newData, $parameter);

    /**
     * Delete record by ID
     * @param $id
     * @return mixed
     */
    public function delete($id);

    /**
     * Delete record by custom parameter
     * @param $parameter
     * @return mixed
     */
    public function deleteWhere($parameter);


}
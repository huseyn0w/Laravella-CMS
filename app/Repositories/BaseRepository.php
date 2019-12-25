<?php
/**
 * Laravella CMS
 * File: BaseRepository.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 25.07.2019
 */

namespace App\Repositories;


use Illuminate\Database\QueryException;
use Doctrine\DBAL\Driver\PDOException;

abstract class BaseRepository implements  BaseRepositoryInterface
{

    protected $model;

    protected $locale;

    protected $select;

    protected $select_fields;

    protected $main_table;

    protected $translated_table;

    protected $translated_model;

    protected $translated_table_join_column;

    protected $select_fields_ready_array;


    public function __construct()
    {

    }

    protected function checkForTranslation($request)
    {
        if($request->route('id') && !empty($request->route('id') && !is_null($this->translated_model)))
        {
            $this->model = $this->translated_model;
            $id = $request->route('id');
            $request->merge([$this->translated_table_join_column => $id, 'locale' => get_current_lang()]);
        }

        return $request;
    }


    public function create($request)
    {
        $final_request = $this->checkForTranslation($request);


        try {
            $data = $final_request->all();
            $result = $this->model::create($data);
        } catch (QueryException $e) {
            dd($e->getMessage());
            throwAbort();
        } catch (PDOException $e) {
            dd($e->getMessage());
            throwAbort();
        } catch (\Error $e) {
            dd($e->getMessage());
            throwAbort();
        }


        return $result;

    }

    public function all()
    {
        try {
            $data = $this->model::all();
        } catch (QueryException $e) {
            throwAbort();
        } catch (PDOException $e) {
            throwAbort();
        } catch (\Error $e) {
            throwAbort();
        }

        return $data;
    }

    public function get($param)
    {
        try {
            $data = $this->model::find($param)->first()->get();
        } catch (QueryException $e) {
            throwAbort();
        } catch (PDOException $e) {
            throwAbort();
        } catch (\Error $e) {
            throwAbort();
        }


        return $data;
    }

    public function selectBy($fields)
    {
        try {
            $data = $this->model::select($fields)->get();
        } catch (QueryException $e) {
            throwAbort();
        } catch (PDOException $e) {
            throwAbort();
        } catch (\Error $e) {
            throwAbort();
        }

        return $data;

    }

    public function first()
    {
        try {
            $data = $this->model::first();
        } catch (QueryException $e) {
            throwAbort();
        } catch (PDOException $e) {
            throwAbort();
        } catch (\Error $e) {
            throwAbort();
        }

        return $data;
    }

    public function only($count, $page = 1)
    {

        if (!empty($this->translated_table && !empty($this->translated_table_join_column))) {
            $data = $this->translated_only($count, $this->main_table, $this->translated_table, $this->translated_table_join_column, $page);
        } else {
            $data = $this->nonTranslatedOnly($count);
        }


        return $data;
    }

    protected function nonTranslatedOnly($count)
    {
        $fields = $this->select_fields;

        try {
            empty($fields) ? $data = $this->model::paginate($count) : $data = $this->model::select($fields)->paginate($count);
        } catch (QueryException $e) {
            throwAbort();
        } catch (PDOException $e) {
            throwAbort();
        } catch (\Error $e) {
            throwAbort();
        }

        return $data;
    }


    protected function translated_only($count, $main_table_name, $translated_table_name, $parent_table_join_column, $page = 1)
    {

        $this->select_fields_ready_array = $this->generateSelectFieldsArray($this->select_fields);
        $this->locale = get_current_lang();



        try {
            $data = $this->model::join($translated_table_name, $main_table_name . '.id', '=', $translated_table_name . '.' . $parent_table_join_column)
                ->select($this->select_fields_ready_array)
                ->where($translated_table_name . '.locale', $this->locale)
                ->with('author')->paginate($count, array('*'), 'page', $page);

        } catch (QueryException $e) {
//            dd($e->getMessage());
            throwAbort();
        } catch (PDOException $e) {
//            dd($e->getMessage());
            throwAbort();
        } catch (\Error $e) {
//            dd($e->getMessage());
            throwAbort();
        }

        return $data;

    }

    public function getBy($paramName, $paramValue, $fields = [])
    {
        if (!empty($this->translated_table && !empty($this->translated_table_join_column))) {
            $data = $this->get_translated_by($paramName, $paramValue);
        } else {
            $data = $this->get_non_translated_by($paramName, $paramValue, $fields);
        }

        return $data;
    }

    protected function get_non_translated_by($paramName, $paramValue, $fields = [])
    {

        if (!empty($fields)) {
            $data = $this->model::select($fields)->where($paramName, $paramValue)->first();
        } else {
            $data = $this->model::where($paramName, $paramValue)->first();
        }

        if (!$data) return $this->throwNotFound();

        return $data;
    }



//    protected function pre_get_translated_by($param, $value)
//    {
//        return $this->translated_table_model::where($param, $value)->firstOrFail();
//    }


    public function get_translated_by($param, $value)
    {

        $this->select_fields_ready_array = $this->generateSelectFieldsArray($this->select_fields);

        $this->locale = get_current_lang();


        $searchColumn = $this->getSearchedTable($param);


        if(is_null($searchColumn)) throwAbort();

        try{
            $data = $this->model::join($this->translated_table, $this->main_table.'.id', '=', $this->translated_table.'.'.$this->translated_table_join_column)
                ->select($this->select_fields_ready_array)
                ->where($this->translated_table.'.locale', $this->locale)
                ->where($searchColumn.'.'.$param, $value)
                ->with('author')->first();

        } catch (QueryException $e) {
            dd($e->getMessage());
            throwAbort();
        } catch (PDOException $e) {
            dd($e->getMessage());
            throwAbort();
        } catch (\Error $e) {
            dd($e->getMessage());
            throwAbort();
        }

        return $data;
    }





    public function update(int $id, $request)
    {
        try {

            $instance = $this->model::find($id);
            $instance->update($request->all());

            if($instance) $result = true;

        } catch (QueryException $e) {
//            dd($e->getMessage());
            throwAbort();
        } catch (PDOException $e) {
//            dd($e->getMessage());
            throwAbort();
        } catch (\Error $e) {
//            dd($e->getMessage());
            throwAbort();
        }

        return $result;

    }
    public function updateWhere($data, $parameter = 'id')
    {

    }
    public function delete($id)
    {
        $result = false;
        try{
            if($this->model::destroy($id)) $result = true;
        } catch (QueryException $e) {
            throwAbort();
        } catch (PDOException $e) {
            throwAbort();
        } catch (\Error $e) {
            throwAbort();
        }


        return $result;
    }

    public function deleteWhere($parameter = 'id')
    {

    }

    public function restore($id)
    {
        $result = false;

        try{
            if($this->model::withTrashed()->where('id', $id)->restore()) $result = true;
        } catch (QueryException $e) {
            throwAbort();
        } catch (PDOException $e) {
            throwAbort();
        } catch (\Error $e) {
            throwAbort();
        }

        return $result;
    }

    public function destroy($id)
    {
        $result = false;
        try{
            if($this->model::where('id', $id)->forceDelete()) $result = true;
        } catch (QueryException $e) {
            throwAbort();
        } catch (PDOException $e) {
            throwAbort();
        } catch (\Error $e) {
            throwAbort();
        }


        return $result;
    }


    protected function generateSelectFieldsArray($fields, $main_table_name = null, $translated_table_name = null)
    {
        if(empty($fields) || !is_array($fields)) return false;

        if(is_null($main_table_name)) $main_table_name = $this->main_table;
        if(is_null($translated_table_name)) $translated_table_name = $this->translated_table;

        $fields_array = [];

        $main_table_columns = $this->model->getConnection()->getSchemaBuilder()->getColumnListing($main_table_name);

        if(!empty($translated_table_name))
        {
            $translated_table_columns = $this->model->getConnection()->getSchemaBuilder()->getColumnListing($translated_table_name);
        }

        foreach ($fields as $field) {
            if(in_array($field, $main_table_columns))
            {
                $fields_array[] = $main_table_name.'.'.$field;
            }
            else if(!empty($translated_table_name) && in_array($field, $translated_table_columns))
            {
                $fields_array[] = $translated_table_name.'.'.$field;
            }
        }

        return $fields_array;
    }

    protected function getSearchedTable($column)
    {
        $table_name = null;
//        dd($this->
//);
        if(in_array($this->main_table.'.'.$column, $this->select_fields_ready_array))
        {
            $table_name = $this->main_table;
        }
        else if(isset($this->translated_table) && in_array($this->translated_table.'.'.$column, $this->select_fields_ready_array))
        {
            $table_name = $this->translated_table;
        }



        return $table_name;
    }





}
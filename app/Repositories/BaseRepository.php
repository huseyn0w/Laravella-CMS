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

abstract class BaseRepository implements  BaseRepositoryInterface{

    protected $model;

    protected $locale;

    protected $select;

    protected $main_table;

    protected $translated_table;

    protected $translated_table_join_column;

    protected $translated_table_model;

    public function __construct()
    {

    }


    public function create($request)
    {

        try{
            $result = $this->model::create($request);
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
    public function all()
    {
        try{
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
        try{
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
        try{
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
        try{
            $data = $this->model::first();
        } catch (QueryException $e) {
            throwAbort();
        }catch (PDOException $e) {
            throwAbort();
        }catch (\Error $e) {
            throwAbort();
        }

        return $data;
    }

    public function only($count, $fields = []){

        try{
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

    public function get_translated_data($count)
    {
        return $this->translated_only($count, $this->main_table, $this->translated_table, $this->translated_table_join_column, $this->select);
    }

    protected function pre_get_translated_by($model, $param, $value)
    {
//        dd($model, $param, $value, $this->locale);
        return $model::where($param, $value)->firstOrFail();
    }


    public function get_translated_by($param, $value)
    {
        $this->locale = get_current_lang();

        $this->pre_get_translated_by($this->translated_table_model, $param, $value);

        try{
            $data = $this->model::join($this->translated_table, $this->main_table.'.id', '=', $this->translated_table.'.'.$this->translated_table_join_column)
                ->select($this->select)
                ->where($this->translated_table.'.locale', $this->locale)
                ->where($this->translated_table.'.'.$param, $value)
                ->with('author')->first();

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


    public function translated_only($count, $main_table_name, $translated_table_name, $parent_table_join_column, $select, $page = 1){

        $this->locale = get_current_lang();

        try{
            $data = $this->model::join($translated_table_name, $main_table_name.'.id', '=', $translated_table_name.'.'.$parent_table_join_column)
                ->select($select)
                ->where($translated_table_name.'.locale', $this->locale)
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

        if(!empty($fields)){
            $data = $this->model::select($fields)->where($paramName, $paramValue)->first();
        }
        else{
            $data = $this->model::where($paramName, $paramValue)->first();
        }

        if(!$data) return $this->throwNotFound();

        return $data;

    }








    public function update(int $id, $request)
    {

        try {
            $instance = $this->model::findOrFail($id);
            //$updated_except = ["_token", "_method"];
            //if(!empty($newData['g-recaptcha-response'])) $updated_except[] = 'g-recaptcha-response';
            //if(!empty($newData['password_confirmation'])) $updated_except[] = 'password_confirmation';
            $instance->update($request->all());

            if($instance) $result = true;

        } catch (QueryException $e) {
            throwAbort();
        } catch (PDOException $e) {
            throwAbort();
        } catch (\Error $e) {
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





}
<?php
/**
 * Laravella CMS
 * File: CPanelUserRepository.phpCreated by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 09.08.2019
 */

namespace App\Repositories;

use App\Http\Models\Category;
use App\Http\Models\Post;
use Doctrine\DBAL\Driver\PDOException;
use Illuminate\Database\QueryException;

class CPanelPostRepository extends BaseRepository
{
    protected $main_table = 'posts';

    protected $translated_table = 'post_translations';

    protected $translated_table_join_column = 'post_id';


    public function __construct(Post $model)
    {
        parent::__construct();
        $this->model = $model;


        //Select and JOIN conditions (posts.id, posts.author.id) and etc...
        $this->select = [
            $this->main_table.'.id',
            $this->translated_table.'.author_id',
            $this->translated_table.'.title',
            $this->translated_table.'.slug',
            $this->translated_table.'.status',
            $this->translated_table.'.created_at',
            $this->translated_table.'.updated_at',
        ];
    }

    public function get_translated_data($count)
    {
        return $this->translated_only($count, $this->main_table, $this->translated_table, $this->translated_table_join_column, $this->select);
    }

    public function trashedPosts($count){
        try{
            $data = $this->model::join($this->translated_table, $this->main_table.'.id', '=', $this->translated_table.'.'.$this->translated_table_join_column)
                ->select($this->select)
                ->where($this->translated_table.'.locale', $this->locale)
                ->with('author')->onlyTrashed()->paginate($count);

        } catch (QueryException $e) {
            $this->throwAbort();
        } catch (PDOException $e) {
            $this->throwAbort();
        } catch (\Error $e) {
            $this->throwAbort();
        }

        return $data;
    }


    public function getBy($paramName, $paramValue, $fields = [])
    {

        if(!empty($fields)){
            $data = $this->model::select($fields)->where($paramName, $paramValue)->withTrashed()->first();
        }
        else{
            $data = $this->model::where($paramName, $paramValue)->withTrashed()->first();
        }

        if(!$data) return $this->throwAbort();

        return $data;
    }

    public function create($request)
    {


        $data[$this->locale] = $request->all();


        try{
            $categories_list = $request->category;

            $created_post = $this->model->create($data);

            $category = Category::find($categories_list);

            if($created_post) $category_saved = $created_post->categories()->attach($category);

            if($created_post && is_null($category_saved)) return true;

        }catch (QueryException $e) {
            $this->throwAbort();
        }catch (PDOException $e) {
            $this->throwAbort();
        }catch (\Error $e) {
            $this->throwAbort();
        }


    }


    public function update(int $id, $request)
    {
        $post = $this->pre_update($id, $request);

        $categories_list = $request->category;

        $category = Category::find($categories_list);

        try{
            $post->categories()->detach();

            $data[$this->locale] = $request->all();

            $post_updated = $post->update($data);

            if($post_updated) $category_saved = $post->categories()->attach($category);

            if($post_updated && is_null($category_saved)) $result = true;

        }catch (QueryException $e) {
            $this->throwAbort();
        }catch (PDOException $e) {
            $this->throwAbort();
        }catch (\Error $e) {
            $this->throwAbort();
        }

        return $result;

    }

    private function pre_update(int $id, $request)
    {
        $post = $this->model::findOrFail($id);

        $preview = clean($request->preview);
        $content = clean($request->content);

        if( $request->merge(['preview' => $preview, 'content' => $content]) ) return $post;

        return $this->throwAbort();
    }


    public function delete($id)
    {

        if(is_array($id))
        {
            foreach($id as $post_id)
            {
                $result = $this->deletePost($post_id);
            }
        }
        else{
            $result = $this->deletePost($id);

        }

        if(!$result) $this->throwAbort();

        return $result;


    }

    private function deletePost($id)
    {

        $result = false;
        $post = Post::find($id);
        if($post && $post->delete()) $result = true;

        return $result;

    }

    public function destroy($id)
    {
        if(is_array($id))
        {
            foreach($id as $post_id)
            {
                $result = $this->destroyPost($post_id);
            }
        }
        else{
            $result = $this->destroyPost($id);

        }

        if(!$result) $this->throwAbort();

        return $result;


    }

    public function restore($id)
    {

        if(is_array($id))
        {
            foreach($id as $post_id)
            {
                $result = $this->restorePost($post_id);
            }
        }
        else{
            $result = $this->restorePost($id);

        }

        if(!$result) $this->throwAbort();

        return $result;

    }

    public function restorePost($id)
    {

        if($this->model::withTrashed()->where('id', $id)->restore()) $result = true;

        if(!$result) return $this->throwAbort();

        return $result;
    }




    private function destroyPost($id)
    {
        $deleted_post = false;

        $result = false;
        $post = Post::withTrashed()->find($id);
        if($post && $post->forceDelete()) $deleted_post = true;
        if($deleted_post)
        {
            $post->categories()->detach();
            $result = true;
        }

        return $result;

    }



}
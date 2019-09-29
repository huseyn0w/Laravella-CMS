<?php
/**
 * Laravella CMS
 * File: CPanelUserRepository.phpCreated by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 09.08.2019
 */

namespace App\Repositories;

use App\Http\Models\Category;
use App\Http\Models\Post;

class CPanelPostRepository extends BaseRepository
{
    public function __construct(Post $model)
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

    public function trashedPosts($count, $fields = [])
    {
        $fields = ['id', 'title', 'slug', 'status', 'author_id', 'created_at'];
        $data = $this->model->select($fields)->with('author')->onlyTrashed()->paginate($count);

        if(empty($data)) abort(403, 'Some problem occured');

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
        $post = new Post();
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->preview = clean($request->preview);
        $post->content = clean($request->content);
        $post->author_id = $request->author_id;
        $post->status = $request->status;
        if(isset($post->custom_fields)) $post->custom_fields = json_encode($request->custom_fields);


        $categories_list = $request->category;

        $category = Category::find($categories_list);

        $post_saved = $post->save();

        if($post_saved) $category_saved = $post->categories()->attach($category);

        if($post_saved && is_null($category_saved)) return true;

        abort(403, 'Some problem occured');

    }

    public function update($id, $request)
    {
        $post = Post::find($id);
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->preview = clean($request->preview);
        $post->content = clean($request->content);
        $post->author_id = $request->author_id;
        $post->status = $request->status;

        $categories_list = $request->category;

        $category = Category::find($categories_list);

        if($category)
        {
            $post->categories()->detach();

            $post_updated = $post->save();
        }

        if($post_updated) $category_saved = $post->categories()->attach($category);

        if($post_updated && is_null($category_saved)) return true;

        abort(403, 'Some problem occured');

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

        if(!$result) abort(403, 'Some problem occured');

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

        if(!$result) abort(403, 'Some problem occured');

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

        if(!$result) abort(403, 'Some problem occured');

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
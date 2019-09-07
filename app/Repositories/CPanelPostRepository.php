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

        if(empty($data)) return false;

        return $data;
    }

    public function trashedPosts($count, $fields = [])
    {
        $fields = ['id', 'title', 'slug', 'status', 'author_id', 'created_at'];
        $data = $this->model->select($fields)->with('author')->onlyTrashed()->paginate($count);

        if(empty($data)) return false;

        return $data;
    }

    public function create($request)
    {
        $result = false;

        $post = new Post();
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->preview = clean($request->preview);
        $post->content = clean($request->content);
        $post->author_id = $request->author_id;
        $post->status = $request->status;

        $categories_list = $request->category;

        $category = Category::find($categories_list);

        $post_saved = $post->save();

        if($post_saved) $category_saved = $post->categories()->attach($category);

        if($post_saved && is_null($category_saved)) $result = true;

        return $result;

    }

    public function update($id, $request)
    {
        $result = false;

        $post = Post::find($id);
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->preview = clean($request->preview);
        $post->content = clean($request->content);
        $post->author_id = $request->author_id;
        $post->status = $request->status;

        $categories_list = $request->category;

        $category = Category::find($categories_list);

        if($category){
            $post->categories()->detach();

            $post_updated = $post->save();
        }

        if($post_updated) $category_saved = $post->categories()->attach($category);

        if($post_updated && is_null($category_saved)) $result = true;

        return $result;

    }

    public function delete($id)
    {
        $result = false;

        if(is_array($id)){
            foreach($id as $post_id){
                $result = $this->deletePost($post_id);
            }
        }
        else{
            $result = $this->deletePost($id);

        }

        return $result;
    }


    private function deletePost($id)
    {
        $deleted_post = false;

        $result = false;
        $post = Post::find($id);
        if($post && $post->delete()) $deleted_post = true;
        if($deleted_post) {
            $post->categories()->detach();
            $result = true;
        }

        return $result;

    }

}
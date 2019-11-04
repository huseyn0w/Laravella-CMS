<?php
/**
 * Laravella CMS
 * File: PageRepository.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 24.10.2019
 */

namespace App\Repositories;


use App\Http\Models\Likes;
use App\Http\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostRepository extends BaseRepository
{
    public function __construct(Post $model)
    {
        parent::__construct();
        $this->model = $model;
    }


    public function handleLike(int $post_id, int $user_id)
    {
        if(Auth::user()->id !== $user_id) return false;

        $result = false;

        $data = Likes::where('post_id', $post_id)->where('user_id', $user_id)->first();
        if(empty($data))
        {
            $like_added = Likes::insert([
                ['user_id' => $user_id, 'post_id' => $post_id]
            ]);

            if($like_added) {
                $this->model::where('id', $post_id)->increment('likes');
                $result = "Like has been added";
            }
        }
        else{
            $like_deleted = Likes::where('post_id', $post_id)->where('user_id', $user_id)->delete();
            if($like_deleted){
                $this->model::where('id', $post_id)->decrement('likes');
                $result = "Like has been deleted";
            }
        }

        return $result;

    }
    
}
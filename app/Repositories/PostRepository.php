<?php
/**
 * Laravella CMS
 * File: PageRepository.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 24.10.2019
 */

namespace App\Repositories;


use App\Http\Models\Comments;
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


    public function getBy($paramName, $paramValue, $fields = [])
    {
        $comments_per_page = get_comments_count_per_page();
        $data = parent::getBy($paramName, $paramValue, $fields);
        $data->setRelation('comments', $data->comments()->with('replies')->with('user')->orderBy('id', 'DESC')->paginate($comments_per_page));

        return $data;


    }
    
}
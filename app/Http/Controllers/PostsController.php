<?php

namespace App\Http\Controllers;

use App\Http\Models\Comments;
use App\Http\Requests\LikesRequest;
use App\Repositories\PostCommentsRepository;
use App\Repositories\PostRepository;
use Illuminate\Http\Request;
use PhpParser\Comment;

class PostsController extends BaseController
{
    public function __construct(PostRepository $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }



    public function index(string $post_slug, string $locale = null)
    {
        $result = parent::index($post_slug, $locale);

        if(is_object($result)) return $result;

        return view('default/posts/post', ['data' => $this->data]);
    }

    public function handleLike(LikesRequest $request)
    {
        $result = $this->repository->handleLike($request['postId'], $request['userId']);
        return json_encode($result);
    }


}

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
        $this->repository = $repository;
    }

    public function index(string $post_slug)
    {
        $data = $this->repository->getBy('slug', $post_slug);

        return view('default/posts/post', compact('data'));
    }

    public function handleLike(LikesRequest $request)
    {
        $result = $this->repository->handleLike($request['postId'], $request['userId']);
        return json_encode($result);
    }


}

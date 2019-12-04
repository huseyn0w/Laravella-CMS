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

    public function index(string $post_slug)
    {
        $data = $this->repository->getBy('slug', $post_slug);

//        dd($data);

        return view('default/posts/post', ['data' => $data, 'home_page_data' => $this->home_page_data]);
    }

    public function handleLike(LikesRequest $request)
    {
        $result = $this->repository->handleLike($request['postId'], $request['userId']);
        return json_encode($result);
    }


}

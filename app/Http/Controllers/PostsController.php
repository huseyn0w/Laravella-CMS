<?php

namespace App\Http\Controllers;

use App\Repositories\PostRepository;
use Illuminate\Http\Request;

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


}

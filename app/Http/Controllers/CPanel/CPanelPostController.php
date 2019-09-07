<?php

namespace App\Http\Controllers\CPanel;

use App\Http\Requests\PostListRequest;
use App\Http\Requests\ValidatePostData;
use App\Repositories\CPanelPostRepository;
use Illuminate\Http\Request;

class CPanelPostController extends CPanelBaseController
{

    public function __construct(CPanelPostRepository $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }


    public function index()
    {
        $posts_list = $this->repository->only($this->per_page);

        return view('cpanel.posts.posts_list', compact("posts_list"));
    }

    public function trashedPosts()
    {
        $posts_list = $this->repository->trashedPosts($this->per_page);

        return view('cpanel.posts.posts_list', compact("posts_list"));
    }


    public function multipleDelete(PostListRequest $request)
    {
        $result = $this->repository->delete($request->posts);

        return back()->with('message', $result);
    }


    public function editPost($id)
    {
        parent::edit($id);

        return view('cpanel.posts.edit_post', ["post" => $this->result]);
    }

    public function createPost(ValidatePostData $request)
    {
        parent::create($request);
        return redirect()->route('cpanel_posts_list')->with('post_added', " ");

    }


    public function updatePost($id, ValidatePostData $request)
    {
        return parent::update($id, $request);
    }





    public function addPost()
    {
        return view('cpanel.posts.new_post');
    }


}

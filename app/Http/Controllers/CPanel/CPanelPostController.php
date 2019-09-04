<?php

namespace App\Http\Controllers\CPanel;

use App\Http\Requests\PostListRequest;
use App\Http\Requests\ValidatePostData;
use App\Repositories\CPanelPostRepository;
use Illuminate\Http\Request;

class CPanelPostController extends CPanelBaseController
{
    private $posts_per_page = 10;

    public function __construct(CPanelPostRepository $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }


    public function index()
    {
        $posts_list = $this->repository->only($this->posts_per_page);

        return view('cpanel.posts', compact("posts_list"));
    }

    public function multipleDelete(PostListRequest $request)
    {
        $result = $this->repository->delete($request->posts);

        return back()->with('message', $result);
    }


    public function editPost($id)
    {
        parent::edit($id);

        return view('cpanel.edit_post', ["post" => $this->result]);
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
        return view('cpanel.new_post');
    }


}

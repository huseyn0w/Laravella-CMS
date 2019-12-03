<?php

namespace App\Http\Controllers\CPanel;

use App\Http\Models\Post;
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
        $this->repository->delete($request->posts);

        return back()->with("deleted", true);
    }

    public function multipleDestroy(PostListRequest $request)
    {
        $this->repository->destroy($request->posts);

        return back()->with("destroyed", true);
    }

    public function multipleRestore(PostListRequest $request)
    {

        $this->repository->restore($request->posts);

        return back()->with("restored", true);
    }

    public function multipleActions(PostListRequest $request)
    {
        $action = $request->posts_action;
        switch ($action)
        {
            case "restore":
                return $this->multipleRestore($request);
                break;
            case "destroy":
                return $this->multipleDestroy($request);
                break;
            default:
                return redirect()->back();
                break;
        }
    }

    public function editPost($id)
    {
        parent::edit($id);

        return view('cpanel.posts.edit_post', ["post" => $this->result]);
    }

    public function createPost(ValidatePostData $request)
    {
        $this->repository->create($request);

        return redirect()->route('cpanel_posts_list')->with('post_added', true);
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

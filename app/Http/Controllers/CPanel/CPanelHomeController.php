<?php

namespace App\Http\Controllers\CPanel;


use App\Http\Models\Comments;
use App\Http\Models\Post;
use App\Http\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CPanelHomeController extends CPanelBaseController
{
    public function  __construct()
    {
        parent::__construct();
    }


    public function index(Request $request)
    {
        $count = 5;
        $posts = $this->get_posts($count);
        $users = $this->get_users($count);
        $comments = $this->get_comments($count);

        return view('cpanel.home', compact('posts','users', 'comments'));
    }

    private function get_posts($count)
    {
        $posts = Post::listsTranslations('title')->orderBy('id', 'desc')->take($count)->get();
        return $posts;
    }

    private function get_users($count)
    {
        $users = User::select('username')->orderBy('id', 'desc')->take($count)->get();
        return $users;
    }

    private function get_comments($count)
    {
        $pages = Comments::select('comment')->orderBy('id', 'desc')->take($count)->get();
        return $pages;
    }



}

<?php

namespace App\Http\Controllers\CPanel;

use App\Http\Requests\CPanelCommentsRequest;
use App\Repositories\CPanelCommentRepository;
use Illuminate\Http\Request;

class CPanelCommentController extends CPanelBaseController
{
    public function __construct(CPanelCommentRepository $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }


    public function index()
    {
        $comments_list = $this->repository->only($this->per_page);

        return view('cpanel.comments.comments_list', compact("comments_list"));
    }



    public function approve(int $id)
    {
        $this->validateCommentID($id);

        $result = $this->repository->approve($id);

        if($result){
            echo 'OK';
        }
        else{
            echo $result;
        }

        return;
    }

    public function unapprove(int $id)
    {

        $this->validateCommentID($id);


        $result = $this->repository->unapprove($id);



        if($result){
            echo 'OK';
        }
        else{
            echo $result;
            echo "Problem";
        }

        return;
    }

    public function multipleDelete(CPanelCommentsRequest $request)
    {
        $result = $this->repository->delete($request->comments);

        return back()->with('deleted', $result);
    }

    public function validateCommentID($id)
    {
        if($id <= 0){
            echo "ID should be integer and more than 0";
            return false;
        }

        return true;
    }


}

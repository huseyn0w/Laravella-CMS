<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCommentsRequest;
use App\Repositories\PostCommentsRepository;
use Illuminate\Http\Request;

class PostCommentsController extends BaseController
{
    public function __construct(PostCommentsRepository $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }


    public function store(PostCommentsRequest $request)
    {
        if($this->repository->create($request)) return back()->with('comment_added', true);

        return false;

    }

    public function delete(PostCommentsRequest $request)
    {
        $result = $this->repository->delete($request);
        return json_encode($result);
    }

    public function update(PostCommentsRequest $request)
    {
        $result = $this->repository->update($request);
        if($result) return back()->with('comment_updated', true);

        return false;
    }


}

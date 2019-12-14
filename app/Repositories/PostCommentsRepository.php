<?php
/**
 * Laravella CMS
 * File: PageRepository.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 24.10.2019
 */

namespace App\Repositories;


use App\Http\Models\Comments;

class PostCommentsRepository extends BaseRepository
{
    public function __construct(Comments $model)
    {
        parent::__construct();
        $this->model = $model;
    }

    public function create($request)
    {
        if(!is_logged_in()) return false;

        $comment_status = 0;

        $user_id = get_logged_user_id();

        if(Auth()->user()->role->id === 1) $comment_status = 1;

        $request->merge(['status' => $comment_status, 'user_id' => $user_id]);

        return parent::create($request);

    }

    public function delete($request)
    {
        $result = "Some problem occured";

        if(!is_logged_in()) return false;

        $logged_username = Auth()->user()->username;

        $comment_id = $request['commentId'];
        $username = $request['username'];

        if($logged_username !== $username && Auth()->user()->role->id !== 1) return false;

        $comment_deleted = parent::delete($comment_id);

        if($comment_deleted) $result = "Comment has been deleted";

        return $result;

    }

    public function update($request, $id = null)
    {
        if(!is_logged_in()) abort(403, 'You are not authorized to make this action');

        $logged_username_id = Auth()->user()->id;

        if(Auth()->user()->role->id !== 1) abort(403, 'You are not authorized to make this action');

        $newData = $request->except(["_token", "_method", "updated_comment_id"]);

        $comment_id = $request->updated_comment_id;

        try{
            $comment = $this->model::where('id', $comment_id)->where('user_id', $logged_username_id)->findOrFail();
            $comment_updated = $comment->update($newData);
            if($comment_updated) return true;
        }
        catch (\Exception $e){
            abort(403, trans('cpanel/controller.problem_occurred'));
        }

        return $comment_updated;

    }




}
<?php
/**
 * Laravella CMS
 * File: CPanelUserRepository.phpCreated by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 09.08.2019
 */

namespace App\Repositories;

use App\Http\Models\Comments;


class CPanelCommentRepository extends BaseRepository
{
    public function __construct(Comments $model)
    {
        parent::__construct();
        $this->model = $model;
    }


    public function approve(int $id)
    {
        $result = false;
        if($this->model::where('id', $id)->update(['status' => '1'])) $result = true;


        return $result;

    }

    public function unapprove(int $id)
    {
        $result = false;
        if($this->model::where('id', $id)->update(['status' => '0'])) $result = true;

        return $result;
    }




}
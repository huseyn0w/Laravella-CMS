<?php
/**
 * Laravella CMS
 * File: CPanelUserRepository.phpCreated by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 09.08.2019
 */

namespace App\Repositories;

use App\Http\Models\Post;

class CPanelPostRepository extends BaseRepository
{
    public function __construct(Post $model)
    {
        parent::__construct();
        $this->model = $model;
    }

    public function only($count, $fields = [])
    {
        $fields = ['id', 'title', 'slug', 'status', 'author_id', 'created_at'];
        $data = $this->model->select($fields)->with('author')->paginate($count);

        if(empty($data)) return false;

        return $data;
    }

}
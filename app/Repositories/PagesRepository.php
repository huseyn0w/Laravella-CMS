<?php
/**
 * Laravella CMS
 * File: CPanelUserRepository.phpCreated by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 09.08.2019
 */

namespace App\Repositories;

use App\Http\Models\Page;

class PagesRepository extends BaseRepository
{
    public function __construct(Page $model)
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

    public function create($data)
    {

        $result = parent::create($data);

        return $result;
    }

    public function update($newData, $id = 1)
    {
        $result = parent::update($newData, $id);

        return $result;
    }
}
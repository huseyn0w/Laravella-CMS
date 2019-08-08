<?php
/**
 * Laravella CMS
 * File: CPanelUserListRepository.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 09.08.2019
 */

namespace App\Repositories;


use App\Http\Models\User;

class CPanelUserListRepository extends BaseRepository
{
    public function __construct(User $model)
    {
        parent::__construct();
        $this->model = $model;
    }
}
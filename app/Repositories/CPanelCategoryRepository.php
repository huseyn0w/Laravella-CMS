<?php
/**
 * Laravella CMS
 * File: CPanelUserRepository.phpCreated by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 09.08.2019
 */

namespace App\Repositories;

use App\Http\Models\Category;

class CPanelCategoryRepository extends BaseRepository
{
    public function __construct(Category $model)
    {
        parent::__construct();
        $this->model = $model;
    }


}
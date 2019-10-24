<?php
/**
 * Laravella CMS
 * File: PageRepository.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 24.10.2019
 */

namespace App\Repositories;


use App\Http\Models\Page;

class PageRepository extends BaseRepository
{
    public function __construct(Page $model)
    {
        parent::__construct();
        $this->model = $model;
    }
    
}
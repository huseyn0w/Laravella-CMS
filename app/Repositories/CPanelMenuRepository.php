<?php
/**
 * Laravella CMS
 * File: CPanelUserRepository.phpCreated by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 09.08.2019
 */

namespace App\Repositories;

use App\Http\Models\Menu;
use Image;
use Illuminate\Support\Facades\Auth;

class CPanelMenuRepository extends BaseRepository
{
    public function __construct(Menu $model)
    {
        parent::__construct();
        $this->model = $model;
    }

    public function update($id, $newData)
    {
        $result = false;
        if($this->model::where('id', $id)->update($newData->except(["_token", "_method", "link_label", "link_url"]))) $result = true;

        return $result;

    }


}
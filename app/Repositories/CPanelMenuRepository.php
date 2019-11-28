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
    protected $main_table = 'menus';

    protected $translated_table = 'menu_translations';

    protected $translated_table_join_column = 'menu_id';

    public function __construct(Menu $model)
    {
        parent::__construct();
        $this->model = $model;

        //Select and JOIN conditions (posts.id, posts.author.id) and etc...
        $this->select = [
            $this->main_table.'.id',
            $this->main_table.'.slug',
            $this->translated_table.'.author_id',
            $this->translated_table.'.title',
        ];
    }


    public function create($request)
    {

        $data['slug'] = $request->slug;

        $data[$this->locale] = $request->except('slug');

        return parent::create($data);
    }


}
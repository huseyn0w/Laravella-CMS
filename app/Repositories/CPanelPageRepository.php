<?php
/**
 * Laravella CMS
 * File: CPanelUserRepository.phpCreated by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 09.08.2019
 */

namespace App\Repositories;

use App\Http\Models\Page;

class CPanelPageRepository extends BaseRepository
{
    protected $main_table = 'pages';

    protected $translated_table = 'page_translations';

    protected $translated_table_join_column = 'page_id';


    public function __construct(Page $model)
    {
        parent::__construct();
        $this->model = $model;

        //Select and JOIN conditions (posts.id, posts.author.id) and etc...
        $this->select = [
            $this->main_table.'.id',
            $this->translated_table.'.author_id',
            $this->translated_table.'.title',
            $this->translated_table.'.slug',
            $this->translated_table.'.status',
            $this->translated_table.'.created_at',
            $this->translated_table.'.updated_at',
        ];
    }

    public function only($count, $fields = [])
    {
        $fields = ['id', 'title', 'slug', 'status', 'author_id', 'created_at'];
        $data = $this->model->select($fields)->with('author')->paginate($count);

        if(empty($data)) abort(403, trans('cpanel/controller.problem_occurred'));

        return $data;
    }

    public function create($request)
    {
        $this->locale = get_current_lang();

        $data[$this->locale] = $request->all();

        if(isset($request->custom_fields)){
            $custom_fields = json_encode($request->custom_fields);
            $request->merge(['custom_fields' => $custom_fields]);
        }

        return parent::create($data);
    }

    public function update($id,$request)
    {

        if(isset($request->custom_fields)) {
            $custom_fields = json_encode($request->custom_fields);
            $request->merge(['custom_fields' => $custom_fields]);
        }

        if(isset($request->content)){
            $new_content = clean($request->content);
            $request->merge(['content' => $new_content]);
        }

        return parent::update($id,$request);


    }


}
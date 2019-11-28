<?php
/**
 * Laravella CMS
 * File: PageRepository.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 24.10.2019
 */

namespace App\Repositories;


use App\Http\Models\Category;
use App\Http\Models\Post;

class CPanelCategoryRepository extends BaseRepository
{
    protected $main_table = 'categories';

    protected $translated_table = 'category_translations';

    protected $translated_table_join_column = 'category_id';

    public function __construct(Category $model)
    {
        parent::__construct();
        $this->model = $model;

        $this->select = [
            $this->main_table.'.id',
            $this->translated_table.'.author_id',
            $this->translated_table.'.title',
            $this->translated_table.'.slug'
        ];

    }

    public function create($request)
    {
        $data[$this->locale] = $request->all();
        $request->merge(['data' => $data]);

        return parent::create($data);
    }


    public function displayList(int $category_id, int $page = 1)
    {
        $fields = ['id','title', 'slug', 'thumbnail', 'preview', 'likes', 'created_at'];
        $count = get_general_settings('posts_per_page');

        if ($page === 1) {
            $data = Post::select($fields)
                ->with('categories')
                ->whereHas('categories', function($query) use($category_id) {
                    $query->select('category_id');
                    $query->where('category_id',$category_id);
                })->paginate($count);
        }
        else
        {
            $data = Post::select($fields)
                ->with('categories')
                ->whereHas('categories', function($query) use($category_id) {
                    $query->select('category_id');
                    $query->where('category_id',$category_id);
                })->paginate($count, array('*'), 'page', $page);
        }


        return $data;
    }
    
}
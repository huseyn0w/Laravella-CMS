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

class CategoryRepository extends BaseRepository
{
    public function __construct(Category $model)
    {
        parent::__construct();
        $this->model = $model;
    }

    public function displayList(int $category_id, int $page = 1)
    {
        $fields = ['title', 'slug', 'thumbnail', 'preview', 'likes', 'created_at'];
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
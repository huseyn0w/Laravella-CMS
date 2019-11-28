<?php
/**
 * Laravella CMS
 * File: PageRepository.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 24.10.2019
 */

namespace App\Repositories;


use App\Http\Models\Category;
use App\Http\Models\CategoryTranslation;
use Illuminate\Database\QueryException;
use Doctrine\DBAL\Driver\PDOException;
use App\Http\Models\Post;

class CategoryRepository extends BaseRepository
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
            $this->translated_table.'.meta_description',
            $this->translated_table.'.meta_keywords',
            $this->translated_table.'.description',
            $this->translated_table.'.slug'
        ];

        $this->translated_table_model = new CategoryTranslation;

    }



    public function displayList(int $category_id, int $page = 1)
    {
        $main_table_name = "posts";
        $translated_table_name= "post_translations";
        $join_column = "post_id";

        $select = [
            $main_table_name.'.id',
            $translated_table_name.'.title',
            $translated_table_name.'.slug',
            $translated_table_name.'.thumbnail',
            $translated_table_name.'.preview',
            $translated_table_name.'.likes',
            $translated_table_name.'.created_at'];

        $count = get_general_settings('posts_per_page');


        try{
            $data = Post::join($translated_table_name, $main_table_name.'.id', '=', $translated_table_name.'.'.$join_column)
                ->select($select)
                ->where($translated_table_name.'.locale', $this->locale)
                ->whereHas('categories', function($query) use($category_id) {
                    $query->select('category_id');
                    $query->where('category_id',$category_id);
                })
                ->with('author')->paginate($count, array('*'), 'page', $page);

        } catch (QueryException $e) {
            dd($e->getMessage());
            $this->throwAbort();
        } catch (PDOException $e) {
            dd($e->getMessage());
            $this->throwAbort();
        } catch (\Error $e) {
            dd($e->getMessage());
            $this->throwAbort();
        }


        return $data;



    }
    
}
<?php
/**
 * Laravella CMS
 * File: PageRepository.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 24.10.2019
 */

namespace App\Repositories;


use App\Http\Models\CategoryTranslation;
use App\Http\Models\PageTranslation;
use App\Http\Models\PostTranslation;
use Illuminate\Database\QueryException;
use Doctrine\DBAL\Driver\PDOException;

class LocalizationRepository extends BaseRepository
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getTranslatedSlug($slug, $entity)
    {
        $lang = get_current_lang();

        switch ($entity)
        {
            case 'page':
                $this->model = new PageTranslation;
                $return_value = 'page_id';
                break;
            case 'post':
                $this->model = new PostTranslation;
                $return_value = 'post_id';
                break;
            case 'category':
                $this->model = new CategoryTranslation;
                $return_value = 'category_id';
                break;
        }

        $select = $entity.'_id';


        try{

            $id = $this->model->select($select)->where('slug', $slug)->first();

            $data = $this->model->select('slug')->where($select, $id->$return_value)->where('locale', $lang)->first();

        } catch (QueryException $e) {
            return false;
        } catch (PDOException $e) {
            return false;
        } catch (\Error $e) {
            return false;
        }

        return $data->slug;

    }
    
}
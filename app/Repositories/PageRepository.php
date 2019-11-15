<?php
/**
 * Laravella CMS
 * File: PageRepository.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 24.10.2019
 */

namespace App\Repositories;


use App\Http\Models\Page;
use App\Http\Models\Post;
use App\Http\Models\User;

class PageRepository extends BaseRepository
{
    public function __construct(Page $model)
    {
        parent::__construct();
        $this->model = $model;
    }

    public function getSearchResult($request, $count = 1)
    {

        $filter = $request->filter;

        $searched_string = $request->get('query');

        $result = $this->getFilteredResult($searched_string, $filter, $count);

        return $result;

    }

    public function getPaginatedSearchResult($string, $filter, $current_page)
    {
        $result = $this->getFilteredResult($string, $filter, $current_page);


        return $result;
    }

    private function getFilteredResult(string $searched_string, string $filter, $current_page=1, $count = 1)
    {
        switch ($filter)
        {
            case "page":
                $result = $this->filterByPage($searched_string, $count, $current_page);
                break;
            case "user":
                $result = $this->filterByUser($searched_string, $count, $current_page);
                break;
            case "post":
                $result = $this->filterByPost($searched_string, $count, $current_page);
                break;
            default:
                $result = $this->throwAbort();
                break;
        }

        return $result;
    }

    private function FilterByPage($key, $count, $current_page)
    {
        $pages = Page::select(['title', 'slug'])
            ->where ('title', 'LIKE', '%' . $key . '%')
            ->orWhere('slug', 'LIKE', '%' . $key . '%')
            ->orWhere('content', 'LIKE', '%' . $key . '%')
            ->orWhere('custom_fields', 'LIKE', '%' . $key . '%')
            ->paginate($count, ['*'], 'page', $current_page);

        return $pages;
    }

    private function filterByUser($key, $count, $current_page)
    {
        $users = User::select(['name', 'surname', 'username', 'about_me'])
            ->where ('name', 'LIKE', '%' . $key . '%')
            ->orWhere('surname', 'LIKE', '%' . $key . '%')
            ->orWhere('username', 'LIKE', '%' . $key . '%')
            ->orWhere('country', 'LIKE', '%' . $key . '%')
            ->orWhere('city', 'LIKE', '%' . $key . '%')
            ->orWhere('email', 'LIKE', '%' . $key . '%')
            ->paginate($count, ['*'], 'page', $current_page);

        return $users;
    }

    private function filterByPost($key, $count, $current_page)
    {
        $posts = Post::select(['title', 'slug',])
            ->where ('title', 'LIKE', '%' . $key . '%')
            ->orWhere('slug', 'LIKE', '%' . $key . '%')
            ->orWhere('preview', 'LIKE', '%' . $key . '%')
            ->orWhere('content', 'LIKE', '%' . $key . '%')
            ->paginate($count, ['*'], 'page', $current_page);

        return $posts;
    }
    
}
<?php
/**
 * Laravella CMS
 * File: LaravellaRequest.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 23.11.2019
 */


namespace App\Http\Requests;

use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;

class LaravellaRequest extends FormRequest
{

    protected $locale;

    protected $table;

    protected $ignore_column;

    protected $route_name;

    public function __construct(array $query = [], array $request = [], array $attributes = [], array $cookies = [], array $files = [], array $server = [], $content = null)
    {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);

        $this->locale = app()->getLocale();

        $this->term_id = (int) $this->route('id');

        $this->route_name = Route::currentRouteName();
    }

    protected function newRecordRule(string $field)
    {
        return Rule::unique($this->table, $field)->where(function ($query) {
            return $query->where('locale', $this->locale);
        });
    }

    protected function updateRecordRule(string $field)
    {
        $term_id = $this->route('id');


        return Rule::unique($this->table, $field)->where(function ($query) {
            return $query->where('locale', $this->locale);
        })->ignore($term_id, $this->ignore_column);
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }




}

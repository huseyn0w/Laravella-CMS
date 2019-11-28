<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;

class CategoryRequest extends LaravellaRequest
{
    protected $table = 'category_translations';

    protected $ignore_column = 'category_id';

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $rules = [
            'description'       => 'string|nullable',
            'meta_description'  => 'string|nullable',
            'meta_keywords'     => 'string|nullable',
            'title'             => ['required', 'string', 'max:30'],
            'slug'              => ['required', 'string', 'max:30'],
            'parent_category'   => ['nullable', 'numeric']
        ];

        $title = $this->newRecordRule('title');
        $slug = $this->newRecordRule('slug');


        if($this->route_name === "cpanel_update_category")
        {
            $title = $this->updateRecordRule('title');
            $slug = $this->updateRecordRule('slug');

            $rules['parent_category'][] = Rule::notIn([$this->term_id]);
        }

        $rules['title'][] = $title;
        $rules['slug'][] = $slug;


        return $rules;
    }

}

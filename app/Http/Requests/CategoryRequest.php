<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{
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
        $route_name = Route::currentRouteName();
        $category_id = (int) $this->route('id');

        $rules = [
            'description' => 'string|nullable',
            'meta_description' => 'string|nullable',
            'meta_keywords' => 'string|nullable'
        ];


        if($route_name === "cpanel_update_category")
        {

            $title = ['required',
                'string',
                'required',
                'max:50',
                Rule::unique('categories','title')->ignore($category_id)
            ];

            $slug = ['required',
                'string',
                'required',
                'max:20',
                Rule::unique('categories','slug')->ignore($category_id)
            ];

            $parent_category = 'numeric|nullable|not_in:'.$category_id;


        }
        else
        {
            $title = 'required|string|max:50|unique:categories,title';
            $slug = 'required|string|max:20|unique:categories,slug';
            $parent_category = 'nullable|numeric';
        }

        $rules['title'] = $title;
        $rules['slug'] = $slug;
        $rules['parent_category'] = $parent_category;


        return $rules;
    }

}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;

class ValidatePageData extends FormRequest
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
        $page_id = (int) $this->route('id');

        $rules = [
            'author_id' => 'required|string|exists:users,id',
            'created_at' => 'required|string',
            'content' => 'nullable|string',
            'meta_keywords' => 'string|nullable',
            'meta_description' => 'string|nullable',
            'custom_fields' => 'array',
            'template' => 'required|string',
            'status' => 'required|numeric',
        ];


        if($route_name === "cpanel_update_page")
        {

            $title = ['required',
                'string',
                'required',
                'max:50',
                Rule::unique('pages','title')->ignore($page_id)
            ];

            $slug = ['required',
                'string',
                'required',
                'max:20',
                Rule::unique('pages','slug')->ignore($page_id)
            ];
        }
        else
        {
            $title = 'required|string|max:50|unique:pages,title';
            $slug = 'required|string|max:20|unique:pages,slug';
        }

        $rules['title'] = $title;
        $rules['slug'] = $slug;


        return $rules;
    }
}

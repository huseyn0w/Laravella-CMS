<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;

class ValidatePostData extends FormRequest
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
        $post_id = (int) $this->route('id');

        $rules = [
            'author_id' => 'required|string|exists:users,id',
            'created_at' => 'required|string',
            'content' => 'nullable|string',
            'meta_keywords' => 'string|nullable',
            'meta_description' => 'string|nullable',
            'category' => 'required|array',
            'custom_fields' => 'array',
            'status' => 'required|numeric',
        ];


        if($route_name === "cpanel_update_post")
        {

            $title = ['required',
                'string',
                'required',
                'max:50',
                Rule::unique('posts','title')->ignore($post_id)
            ];

            $slug = ['required',
                'string',
                'required',
                'max:20',
                Rule::unique('posts','slug')->ignore($post_id)
            ];
        }
        else
        {
            $title = 'required|string|max:50|unique:posts,title';
            $slug = 'required|string|max:20|unique:posts,slug';
        }

        $rules['title'] = $title;
        $rules['slug'] = $slug;


        return $rules;
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;


class MenuRequest extends FormRequest
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
        $menu_id = (int) $this->route('id');

        $rules = [
            'content' => 'required|string'
        ];


        if($route_name === "cpanel_update_menu")
        {

            $title = ['required',
                'string',
                'required',
                'max:50',
                Rule::unique('menus','title')->ignore($menu_id)
            ];

        }
        else
        {
            $title = 'required|string|max:50|unique:menus,title';
        }

        $rules['title'] = $title;


        return $rules;
    }
}

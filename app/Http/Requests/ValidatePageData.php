<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;

class ValidatePageData extends LaravellaRequest
{
    protected $table = 'page_translations';

    protected $ignore_column = 'page_id';

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
            'title'              => ['required', 'string', 'max:20'],
            'slug'               => ['required', 'string', 'max:20'],
            'author_id'          => 'required|string|exists:users,id',
            'updated_at'         => 'required|string',
            'content'            => 'nullable|string',
            'meta_keywords'      => 'string|nullable',
            'meta_description'   => 'string|nullable',
            'custom_fields'      => 'array',
            'template'           => 'required|string',
            'status'             => 'required|numeric',
        ];

        $title = $this->newRecordRule('title');
        $slug = $this->newRecordRule('slug');


        if($this->route_name === "cpanel_update_page")
        {
            $title = $this->updateRecordRule('title');
            $slug = $this->updateRecordRule('slug');
        }


        $rules['title'][] = $title;
        $rules['slug'][] = $slug;


        return $rules;
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ValidateUserSettings extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'email'         => 'required|email',
            'name'          => 'nullable|string',
            'surname'       => 'nullable|string',
            'country'       => 'nullable|string',
            'city'          => 'nullable|string',
            'about_me'      => 'nullable|string',
            'facebook_url'  => 'nullable|url',
            'twitter_url'   => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'google_url'    => 'nullable|url',
            'linkedin_url'  => 'nullable|url',
            'xing_url'      => 'nullable|url',
            'gender'        => 'nullable|in:male,female',
            'avatar'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }
}

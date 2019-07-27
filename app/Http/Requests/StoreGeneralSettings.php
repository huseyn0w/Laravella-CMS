<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGeneralSettings extends FormRequest
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
        $membership = $this->request->get('membership');

        if($membership === 'on') {
            $this->request->add(['membership' => '1']);
        }
        else {
            $this->request->add(['membership' => '0']);
        }


        return [
            'website_name' => 'required|string',
            'tagline' => 'required|string',
            'contact_email' => 'required|email',
            'active_template' => 'required|string',
        ];

    }
}

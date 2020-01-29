<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTenant extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //autorisation happens in the controller
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'given_name' => ['alpha', 'required'],
            'family_name' => ['alpha', 'required'],
            'share_of_rent_in_gbp' => ['integer', 'min:0', 'nullable']
        ];
    }
}

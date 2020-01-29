<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProperty extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //currently all users are agents, so all of them should be able to store a property
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
            'address_line_1' => ['required', 'alpha_num_spaces_dashes'],
            'address_line_2' => ['alpha_num_spaces_dashes', 'nullable'],
            'town' => ['required', 'alpha'],
            'county' => ['required', 'alpha'],
            'postcode' => ['required'],
            'monthly_rent_in_gbp' => ['numeric', 'nullable']
        ];
    }
}

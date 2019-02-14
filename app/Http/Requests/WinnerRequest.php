<?php

namespace Rosa\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WinnerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            'placement' => 'max:5|min:5|numeric|required',
            'user_id'   => 'numeric|required',
        ];
    }
}

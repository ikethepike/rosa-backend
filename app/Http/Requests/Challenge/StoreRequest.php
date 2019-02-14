<?php

namespace Rosa\Http\Requests\Challenge;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'week_id'     => 'numeric|nullable',
            'title'       => 'required',
            'description' => 'string|nullable',
            'image'       => 'url|nullable',
        ];
    }
}

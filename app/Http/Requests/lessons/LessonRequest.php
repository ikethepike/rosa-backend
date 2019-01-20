<?php

namespace Rosa\Http\Requests\lessons;

use Illuminate\Foundation\Http\FormRequest;

class LessonRequest extends FormRequest
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
            'id'        => 'integer|nullable',
            'title'     => 'required|min:2',
            'text'      => 'required',
            'masthead'  => 'nullable',
            'snippets'  => 'array|nullable',
        ];
    }
}

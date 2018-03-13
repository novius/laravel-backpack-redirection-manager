<?php

namespace Novius\Backpack\RedirectionManager\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RedirectionRequest extends FormRequest
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
            'from' => 'required|min:1|max:2048',
            'to' => 'required|min:1|max:2048',
        ];
    }
}

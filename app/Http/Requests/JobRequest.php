<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobRequest extends FormRequest
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
            'title' => 'required|min:5|max:100',
            'place' => 'required',
            'description' => 'required|min:50',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':Attribute wajib diisi !',
            'min' => ':Attribute harus diisi minimal :min karakter !',
            'max' => ':Attribute harus diisi maksimal :max karakter !',
        ];
    }
}

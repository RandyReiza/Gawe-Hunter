<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['nullable', 'min:8'],
            'tgl_lahir' => ['required', 'string', 'before:-17 years'],
        ];
    }

    public function messages()
    {
        return [
            'required' => ':Attribute wajib diisi !',
            'min' => ':Attribute harus diisi minimal :min karakter !',
            'max' => ':Attribute harus diisi maksimal :max karakter !',
            'string' => ':Attribute harus berupa huruf',
            'email' => 'Penulisan :Attribute harus sesuai dengan Format Email',
            'before' => 'Umur harus lebih dari 17 tahun',
        ];
    }
}

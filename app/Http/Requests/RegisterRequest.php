<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'username' => 'required|unique:users|max:20',
            'name' => 'required|max:100',
            'email' => 'required|max:50|email|unique:users',
            'password' => 'required|max:255',
            'phone' => 'required|numeric',
            'gender' => 'required',
            'division' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'username' => 'Username',
            'name' => 'Nama',
            'email' => 'Email',
            'password' => 'Password',
            'phone' => 'Nomor Telepon',
            'gender' => 'Jenis Kelamin',
            'division' => 'Divisi',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute wajib diisi.',
            'unique' => ':attribute telah terdaftar.',
            'numeric' => ':attribute wajib berupa angka.',
            'email' => ':attribute tidak valid',
            'username.max' => 'Panjang maksimal :attribute adalah 20 karakter.',
            'name.max' => 'Panjang maksimal :attribute adalah 100 karakter.',
            'email.max' => 'Panjang maksimal :attribute adalah 50 karakter.',
            'password.max' => 'Panjang maksimal :attribute adalah 255 karakter.',
        ];
    }
}

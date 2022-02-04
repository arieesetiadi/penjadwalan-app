<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required|max:20|unique:users,username,' . request()->route()->user,
            'name' => 'required|max:100',
            'email' => 'required|max:50|email|unique:users,email,' . request()->route()->user,
            'password' => 'max:255',
            'phone' => 'required|numeric',
            'gender' => 'required',
            'role' => 'required',
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
            'role' => 'Jenis Pengguna',
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

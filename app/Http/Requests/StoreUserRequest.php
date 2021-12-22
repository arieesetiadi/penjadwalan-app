<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'username' => 'required|max:20',
            'name' => 'required|max:100',
            'email' => 'required|max:100|email|unique:users',
            'password' => 'required|max:255',
            'phone' => 'required|numeric',
            'gender' => 'required',
            'userRole' => 'required',
            'instansi' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Nama',
            'email' => 'Email',
            'phone' => 'Nomor telepon',
            'gender' => 'Jenis kelamin',
            'userRole' => 'Jenis pengguna',
        ];
    }
}

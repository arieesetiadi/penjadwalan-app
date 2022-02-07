<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreScheduleRequest extends FormRequest
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
            'date' => 'required',
            'start' => 'required',
            'end' => 'required',
            'description' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'date' => 'Tanggal',
            'start' => 'Waktu Mulai',
            'end' => 'Waktu Selesai',
            'description' => 'Keterangan'
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute wajib diisi.',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoteRequest extends FormRequest
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
            'title' => 'required',
            'contentImages' => 'array',
            'contentFiles' => 'array',
            'contentImages.*' => 'mimes:jpg,jpeg,bmp,png|image',
            'contentFiles.*' => 'mimes:pdf,doc,docx,pptx,xlsx,txt|file'
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'Judul Notulen',
            'contentImages' => 'Gambar',
            'contentFiles' => 'File'
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute wajib diisi',
            'mimes' => 'Format dari :attribute tidak sesuai.',
            'image' => 'Format dari :attribute tidak sesuai.',
            'file' => 'Format dari :attribute tidak sesuai.'
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'slug' => 'unique:news,slug',
            'image' => 'required|mimes:png,jpg,jpeg,gif,giffile,mp4,avi,mov',
            'description'=> 'required|string',
            'date'=> 'required|date',
            'category' => 'array|required',
            'category.*' => 'required',
            'sub_category' => 'array|required',
            'sub_category.*' => 'required',
            'tag' => 'array|required',
            'tag.*' => 'required',
        ];
    }

     /**
     * Pesan kesalahan yang berlaku untuk permintaan ini.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Nama berita wajib diisi.',
            'image.required' => 'Gambar berita wajib diisi',
            'description.required' => 'Isi berita mohon diisi',
            'date.required' => 'Tanggal berita mohon diisi',
            'category.required' => 'Kategori mohon diisi',
            'sub_category' => 'Sub Kategori mohon diisi',
            'tag.required' => 'Tag mohon diisi',
        ];
    }
}

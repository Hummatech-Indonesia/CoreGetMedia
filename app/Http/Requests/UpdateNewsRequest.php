<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNewsRequest extends FormRequest
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
     * Get the validation messages that apply to the request.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Nama harus diisi.',
            'name.string' => 'Nama harus berupa string.',
            'slug.unique' => 'Slug sudah digunakan.',
            'image.required' => 'Gambar harus diisi.',
            'image.mimes' => 'Format gambar harus PNG, JPG, JPEG, GIF, atau MP4.',
            'description.required' => 'Deskripsi harus diisi.',
            'description.string' => 'Deskripsi harus berupa string.',
            'date.required' => 'Tanggal harus diisi.',
            'date.date' => 'Tanggal harus berupa tanggal yang valid.',
            'category.required' => 'Kategori harus diisi.',
            'category.array' => 'Kategori harus berupa array.',
            'category.*.required' => 'Setiap kategori harus diisi.',
            'sub_category.required' => 'Sub kategori harus diisi.',
            'sub_category.array' => 'Sub kategori harus berupa array.',
            'sub_category.*.required' => 'Setiap sub kategori harus diisi.',
            'tag.required' => 'Tag harus diisi.',
            'tag.array' => 'Tag harus berupa array.',
            'tag.*.required' => 'Setiap tag harus diisi.',
        ];
    }
}

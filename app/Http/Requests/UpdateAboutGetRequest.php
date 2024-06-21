<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAboutGetRequest extends FormRequest
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
            'image' => 'required',
            'slogan' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
            'header' => 'required',
            'description' => 'required',
            'url_facebook' => 'required',
            'url_twitter' => 'required',
            'url_instagram' => 'required',
            'url_linkedin' => 'required',
        ];
    }
}

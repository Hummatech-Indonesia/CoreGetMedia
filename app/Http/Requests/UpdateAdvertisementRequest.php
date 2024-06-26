<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdvertisementRequest extends FormRequest
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
            'image' => 'mimes:jpg,jpeg,png,mp4,avi,mov,mkv',
            'start_date' => 'required',
            'end_date' => 'required',
            'type' => 'required',
            'position_advertisement_id' => 'required',
            'url' => 'required'
        ];
    }
}

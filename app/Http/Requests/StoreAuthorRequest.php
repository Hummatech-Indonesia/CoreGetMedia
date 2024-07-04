<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAuthorRequest extends FormRequest
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
        $callingMethod = $this->input('calling_method');

        $rules = [
            'cv' => 'required|mimes:pdf',
            'name' => 'required',
            'email' => 'required',
            'phone_number' => 'required'
        ];

        if ($callingMethod === 'storeByAdmin') {
            $rules['password'] = 'required';
        } else {
            $rules['password'] = 'nullable';
        }

        return $rules;
    }

    public function messages() : array
    {
        return [
            'cv.required' => 'Cv mohon untuk di isi',
            'cv.mimes' => 'Cv harus berupa pdf',
            'name.required' => 'Nama mohon untuk di isi',
            'email.required' => 'Email mohon untuk di isi',
            'password.required' => 'Password mohon untuk di isi',
            'phone_number.required' => 'Nomer Telepon mohon untuk di isi',
        ];
    }
}

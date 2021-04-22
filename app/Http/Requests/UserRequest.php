<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'nip' => ['required', 'unique:users,nip', 'min:0', 'max:255'],
            'name' => ['required', 'min:0', 'max:255'],
            'email' => ['required', 'min:0', 'max:255', 'email', 'unique:users,email'],
            'religion' => ['required', 'min:0', 'max:16'],
            'gender' => ['required', 'min:0', 'max:8'],
            'blood_type' => ['required', 'min:0', 'max:2'],
            'place_born' => ['required', 'min:0', 'max:32'],
            'date_born' => ['required'],
            'marital_status' => ['required', 'min:0', 'max:16'],
            'address' => ['required', 'min:0', 'max:255'],
            'telephone_number' => ['required', 'min:0', 'max:24']
        ];
    }
}

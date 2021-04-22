<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FamilyRequest extends FormRequest
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
            'nik' => ['required', 'min:0', 'max:16'],
            'name' => ['required', 'min:0', 'max:64'],
            'place_born' => ['required', 'min:0', 'max:32'],
            'date_born' => ['required'],
            'education' => ['required', 'min:0', 'max:16'],
            'work' => ['required', 'min:0', 'max:32'],
            'relationship' => ['required', 'min:0', 'max:32']
        ];
    }
}

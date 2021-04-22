<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EducationRequest extends FormRequest
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
            'principal' => ['required', 'min:0', 'max:32'],
            'grade' => ['required', 'min:0', 'max:8'],
            'final_grade' => ['required'],
            'school_name' => ['required', 'min:0', 'max:64'],
            'location' => ['required', 'min:0', 'max:64'],
            'major' => ['required', 'min:0', 'max:64'],
            'diploma_number' => ['required', 'min:0', 'max:64'],
            'diploma_date' => ['required', 'min:0', 'max:64'],
            'diploma_file' => ['required', 'max:5000']
        ];
    }
}

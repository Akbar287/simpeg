<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MutationRequest extends FormRequest
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
            'work_unit' => ['required', 'min:0', 'max:64'],
            'region_work_unit' => ['required', 'min:0', 'max:64'],
            'address' => ['required'],
            'type_mutation' => ['required'],
            'stamp' => ['required'],
            'sk_number' => ['required'],
            'sk_date_start' => ['required']
        ];
    }
}

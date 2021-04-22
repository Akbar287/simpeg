<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FurloughRequest extends FormRequest
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
            'type_furlough' => ['required', 'min:0', 'max:32'],
            'long_furlough' => ['required'],
            'in_number' => ['required', 'min:0', 'max:32'],
            'time_format' => ['required', 'min:0', 'max:8'],
            'start_date' => ['required'],
            'finish_date' => ['required'],
            'sk_date_start' => ['required'],
            'stamp' => ['required'],
            'sk_number' => ['required'],
            'finish_date' => ['required']
        ];
    }
}

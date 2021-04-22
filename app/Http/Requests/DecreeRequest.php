<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DecreeRequest extends FormRequest
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
            'title' => ['required', 'min:0', 'max:128'],
            'sk_number' => ['required', 'min:0', 'max:128'],
            'sk_date_start' => ['required'],
            'sk_date_finish' => ['required'],
            'sk_file' => ['required', 'min:0', 'max:255'],
            'signature' => ['required'],
            'information' => []
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrainingRequest extends FormRequest
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
            'training_name' => ['required', 'min:0', 'max:255'],
            'seconds_total' => ['required'],
            'organizer' => ['required', 'min:0', 'max:32'],
            'place' => ['required', 'min:0', 'max:128'],
            'year_training' => ['required'],
            'start_date' => ['required'],
            'finish_date' => ['required'],
            'file_certificate' => ['required', 'min:0', 'max:128']
        ];
    }
}

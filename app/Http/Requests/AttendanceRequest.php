<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttendanceRequest extends FormRequest
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
            'date_work' => ['required'],
            'start_work' => ['required'],
            'finish_work' => ['required'],
            'stamp' => ['required', 'numeric'],
            'jenis_kerja' => ['required', 'min:0', 'max:8'],
            'kehadiran' => ['required', 'min:0', 'max:8']
        ];
    }
}

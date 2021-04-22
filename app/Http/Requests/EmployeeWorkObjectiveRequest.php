<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeWorkObjectiveRequest extends FormRequest
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
            'assessor_officials' => ['required', 'min:0', 'max:32'],
            'appraisal_official_superior' => ['required', 'min:0', 'max:32'],
            'start_date' => ['required'],
            'finish_date' => ['required'],
            'service_orientation_value' => ['required', 'numeric'],
            'integrity_value' => ['required', 'numeric'],
            'commitment_value' => ['required', 'numeric'],
            'discipline_value' => ['required', 'numeric'],
            'teamwork_value' => ['required', 'numeric'],
            'leader_value' => ['required', 'numeric'],
            'rating_result' => ['required', 'min:0', 'max:16'],
        ];
    }
}

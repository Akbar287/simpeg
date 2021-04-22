<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeWorkObjective extends Model
{
    protected $table = 'employee_work_objectives';
    protected $primaryKey = 'employee_work_objective_id';
    protected $fillable = [
        'assessor_officials',
        'appraisal_official_superior',
        'start_date',
        'finish_date',
        'service_orientation_value',
        'integrity_value',
        'commitment_value',
        'discipline_value',
        'teamwork_value',
        'leader_value',
        'rating_result'
    ];
    protected $hidden = ['user_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}

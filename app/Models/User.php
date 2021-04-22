<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Family;
use App\Models\Signature;
use Spatie\Permission\Models\Role;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    protected $primaryKey = 'user_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nip',
        'name',
        'email',
        'password',
        'profile_photo',
        'religion',
        'gender',
        'blood_type',
        'place_born',
        'date_born',
        'marital_status',
        'address',
        'telephone_number'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->belongsToMany(Role::class, 'user_role', 'user_id', 'id');
    }

    public function family()
    {
        return $this->hasMany(Family::class, 'user_id', 'user_id');
    }

    public function education()
    {
        return $this->belongsToMany(Education::class, 'user_education', 'user_id', 'education_id');
    }

    public function schedule()
    {
        return $this->hasMany(Schedule::class, 'user_id', 'user_id');
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class, 'user_id', 'user_id');
    }

    public function training()
    {
        return $this->hasMany(Training::class, 'user_id', 'user_id');
    }

    public function employee_work_objective()
    {
        return $this->hasMany(EmployeeWorkObjective::class, 'user_id', 'user_id');
    }

    public function occupation()
    {
        return $this->hasMany(Occupation::class, 'user_id', 'user_id');
    }

    public function signature()
    {
        return $this->hasMany(Signature::class, 'user_id', 'user_id');
    }

    public function occupation_group()
    {
        return $this->belongsToMany(OccupationGroup::class, 'occupations', 'user_id', 'occupation_group_id');
    }

    public function employment()
    {
        return $this->belongsToMany(Employments::class, 'occupations', 'user_id', 'employment_id');
    }

    public function mutation()
    {
        return $this->belongsToMany(Mutation::class, 'user_mutation', 'user_id', 'mutation_id');
    }

    public function daily_work_report()
    {
        return $this->belongsToMany(DailyWorkReport::class, 'user_daily_work_report', 'user_id', 'daily_work_report_id');
    }

    public function furlough()
    {
        return $this->belongsToMany(Furlough::class, 'user_furloughs', 'user_id', 'furlough_id');
    }

    public function work_unit()
    {
        return $this->belongsToMany(WorkUnit::class, 'user_work_unit', 'user_id', 'work_unit_id');
    }
}

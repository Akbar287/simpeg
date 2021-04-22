<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Occupation extends Model
{
    protected $table = 'occupations';
    protected $primaryKey = 'occupation_id';
    protected $fillable = [
        'status'
    ];

    protected $hidden = [
        'user_id',
        'occupation_group_id',
        'employment_id',
    ];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function occupation_group()
    {
        return $this->hasOne(OccupationGroup::class, 'occupations_group_id', 'occupations_group_id');
    }

    public function employment()
    {
        return $this->hasOne(Employments::class, 'employment_id', 'employment_id');
    }

    public function decree()
    {
        return $this->belongsToMany(Decree::class, 'occupation_decrees', 'occupation_id', 'decree_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $table = 'educations';
    protected $primaryKey = 'education_id';
    protected $fillable = [
        'principal',
        'grade',
        'final_grade',
        'school_name',
        'location',
        'major',
        'diploma_number',
        'diploma_date',
        'diploma_file'
    ];

    protected $hidden = ['user_id'];

    public function user()
    {
        return $this->belongsToMany(User::class, 'user_education', 'education_id', 'user_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OccupationGroup extends Model
{
    protected $table = 'occupation_groups';
    protected $primaryKey = 'occupation_group_id';
    protected $fillable = [
        'occupation_group_name'
    ];
    public $timestamps = false;

    public function occupation()
    {
        return $this->belongsTo(Occupation::class, 'occupations_group_id', 'occupations_group_id');
    }

    public function user()
    {
        return $this->belongsToMany(User::class, 'occupations', 'occupation_group_id', 'user_id');
    }
}

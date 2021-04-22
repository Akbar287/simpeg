<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkUnit extends Model
{
    protected $table = 'work_units';
    protected $primaryKey = 'work_unit_id';
    protected $fillable = [
        'work_unit_name'
    ];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsToMany(User::class, 'user_work_unit', 'work_unit_id', 'user_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employments extends Model
{
    protected $table = 'employments';
    protected $primaryKey = 'employment_id';
    protected $fillable = [
        'employment_name'
    ];
    public $timestamps = false;

    public function occupation()
    {
        return $this->belongsTo(Occupation::class, 'employment_id', 'employment_id');
    }
}

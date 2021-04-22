<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    protected $table = 'families';
    protected $primaryKey = 'family_id';
    protected $fillable = [
        'nik',
        'name',
        'place_born',
        'date_born',
        'education',
        'work',
        'relationship'
    ];

    protected $hidden = ['user_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}

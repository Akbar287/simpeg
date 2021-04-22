<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    protected $table = 'trainings';
    protected $primaryKey = 'training_id';
    protected $fillable = [
        'training_name',
        'seconds_total',
        'organizer',
        'place',
        'year_training',
        'start_date',
        'finish_date',
        'file_certificate'
    ];
    protected $hidden = ['user_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}

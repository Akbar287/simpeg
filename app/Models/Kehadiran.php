<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kehadiran extends Model
{
    protected $table = 'kehadiran';
    protected $primaryKey = 'kehadiran_id';
    protected $fillable = [
        'name',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
    public function attendace()
    {
        return $this->belongsToMany(Attendance::class, 'kehadiran_attendance', 'kehadiran_id', 'attendance_id');
    }
}

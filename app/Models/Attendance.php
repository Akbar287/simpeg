<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = 'attendances';
    protected $primaryKey = 'attendance_id';
    protected $fillable = [
        'date_work',
        'start_work',
        'finish_work',
        'jenis_kerja',
        'stamp',
        'keterangan',
        'image',
        'location',
    ];

    protected $hidden = ['user_id',];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
    public function kehadiran()
    {
        return $this->belongsToMany(Kehadiran::class, 'kehadiran_attendance', 'attendance_id', 'kehadiran_id');
    }
}

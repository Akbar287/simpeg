<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyWorkReport extends Model
{
    protected $table = 'daily_work_reports';
    protected $primaryKey = 'daily_work_report_id';
    protected $fillable = [
        'date_work',
        'keterangan'
    ];

    public function user()
    {
        return $this->belongsToMany(User::class, 'user_daily_work_report', 'daily_work_report_id', 'user_id');
    }
    public function activity()
    {
        return $this->belongsToMany(DailyWorkActivity::class, 'work_activity', 'report_id', 'activity_id');
    }
}

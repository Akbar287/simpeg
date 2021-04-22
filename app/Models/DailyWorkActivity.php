<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyWorkActivity extends Model
{
    protected $table = 'daily_work_activity';
    protected $primaryKey = 'daily_work_activity_id';
    protected $fillable = [
        'activity',
        'result',
        'volume'
    ];
    public function DailyWorkReport()
    {
        return $this->belongsToMany(DailyWorkReport::class, 'work_activity','activity_id', 'report_id');
    }
}

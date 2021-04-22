<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Furlough extends Model
{
    protected $table = 'furloughs';
    protected $primaryKey = 'furlough_id';
    protected $fillable = [
        'type_furlough',
        'long_furlough',
        'in_number',
        'time_format',
        'start_date',
        'finish_date',
        'status'
    ];

    public function user()
    {
        return $this->belongsToMany(User::class, 'user_furloughs', 'furlough_id', 'user_id');
    }

    public function provision()
    {
        return $this->belongsToMany(Provision::class, 'provision_furlough', 'provision_id', 'furlough_id');
    }

    public function effluent()
    {
        return $this->belongsToMany(Effluent::class, 'effluent_furlough', 'effluent_id', 'furlough_id');
    }

    public function decree()
    {
        return $this->belongsToMany(Decree::class, 'furlough_decrees', 'furlough_id', 'decree_id');
    }
}

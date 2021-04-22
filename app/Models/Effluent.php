<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Effluent extends Model
{
    protected $table = 'effluents';
    protected $primaryKey = 'effluent_id';
    protected $fillable = [
        'effluent_name'
    ];
    public $timestamps = false;

    public function furlough()
    {
        return $this->belongsToMany(Furlough::class, 'effluent_furlough', 'furlough_id', 'effluent_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provision extends Model
{
    protected $table = 'provisions';
    protected $primaryKey = 'provision_id';
    protected $fillable = [
        'provision_name'
    ];
    public $timestamps = false;

    public function furlough()
    {
        return $this->belongsToMany(Furlough::class, 'provision_furlough', 'furlough_id', 'provision_id');
    }
}

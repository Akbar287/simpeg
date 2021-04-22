<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Decree extends Model
{
    protected $table = 'decrees';
    protected $primaryKey = 'decree_id';
    protected $fillable = [
        'title',
        'sk_number',
        'sk_date_start',
        'sk_date_finish',
        'sk_file',
        'signature',
        'information'
    ];

    public function furlough()
    {
        return $this->belongsToMany(Furlough::class, 'furlough_decrees', 'decree_id', 'furlough_id');
    }

    public function mutation()
    {
        return $this->belongsToMany(Mutation::class, 'mutation_decrees', 'decree_id', 'mutation_id');
    }

    public function occupation()
    {
        return $this->belongsToMany(Occupation::class, 'occupation_decrees', 'decree_id', 'occupation_id');
    }
}

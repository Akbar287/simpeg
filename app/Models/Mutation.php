<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mutation extends Model
{
    protected $table = 'mutations';
    protected $primaryKey = 'mutation_id';
    protected $fillable = [
        'new_work_unit',
        'region_work',
        'address',
        'status',
        'date_mutation'
    ];

    protected $hidden = [
    ];

    public function user()
    {
        return $this->belongsToMany(User::class, 'user_mutation', 'mutation_id', 'user_id');
    }

    public function decree()
    {
        return $this->belongsToMany(Decree::class, 'mutation_decrees', 'mutation_id', 'decree_id');
    }

    public function effluent()
    {
        return $this->belongsToMany(Effluent::class, 'effluent_mutation', 'effluent_id', 'mutation_id');
    }

    public function type_mutation()
    {
        return $this->belongsToMany(TypeMutation::class, 'mutation_type', 'mutation_id', 'type_mutation_id');
    }
}

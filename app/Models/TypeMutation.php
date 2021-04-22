<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeMutation extends Model
{
    protected $table = 'type_mutations';
    protected $primaryKey = 'type_mutation_id';
    protected $fillable = [
        'type_mutation_name'
    ];
    public $timestamps = false;

    public function mutation()
    {
        return $this->belongsToMany(Mutation::class, 'mutation_type', 'type_mutation_id', 'mutation_id');
    }
}

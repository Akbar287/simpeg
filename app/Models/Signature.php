<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Signature extends Model
{
    protected $table = 'signature';
    protected $primaryKey = 'signature_id';
    protected $fillable = [
        'signature',
        'sig_svg'
    ];
    protected $hidden = ['user_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}

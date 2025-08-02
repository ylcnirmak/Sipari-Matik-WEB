<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rezervasyon extends Model
{
    protected $table = 'rezervasyon';
    
    protected $fillable = [
        'restaurant_id',
        'kim'
    ];
}

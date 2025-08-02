<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adisyon extends Model
{
    protected $table = 'adisyon';
    
    protected $fillable = [
        'restaurant_id',
        'test'
    ];
}

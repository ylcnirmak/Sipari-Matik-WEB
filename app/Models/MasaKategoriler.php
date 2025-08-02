<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasaKategoriler extends Model
{
    protected $table = 'masalarkategori';
    
    protected $fillable = [
        'restaurant_id',
        'masakategoriadi'
    ];

    public function masalar()
{
    return $this->hasMany(Masalar::class, 'masakategori_id');
}
}

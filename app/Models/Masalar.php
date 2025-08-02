<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Masalar extends Model
{
    protected $table = 'masalar';
    
    protected $fillable = [
        'restaurant_id',
        'masakategori_id',
        'masaadi',
        'kisi_sayisi',
        'garson_id',
        'sira',
        'adisyonyaz',
        'adisyon_id',
        'rezervasyon_id',
        'sure',
        'aktif',
        'toplam_tutar',
        'indirim',
        'geneltoplam'
    ];

    public function masaKategorisi()
    {
        return $this->belongsTo(MasaKategoriler::class, 'masakategori_id');
    }

    public function adisyon()
    {
        return $this->hasOne(Adisyon::class, 'id', 'adisyon_id');
    }

    public function rezervasyon() 
    {
        return $this->hasOne(Rezervasyon::class, 'id', 'rezervasyon_id');
    }
}

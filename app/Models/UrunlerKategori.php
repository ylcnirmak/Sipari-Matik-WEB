<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UrunlerKategori extends Model
{
    use HasFactory;

    protected $table = 'urunlerkategori';

    protected $fillable = [
        'restaurant_id',
        'kategori_adi',
        'aciklama',
        'KDV',
        'resim',
        'sira',
        'aktif'
    ];

    protected $casts = [
        'KDV' => 'decimal:2',
        'aktif' => 'boolean',
        'sira' => 'integer'
    ];

    // İlişkiler
    public function urunler()
    {
        return $this->hasMany(Urunler::class, 'kategori_id');
    }

    // Scope'lar
    public function scopeAktif($query)
    {
        return $query->where('aktif', true);
    }

    public function scopeRestaurant($query, $restaurantId)
    {
        return $query->where('restaurant_id', $restaurantId);
    }

    public function scopeSirali($query)
    {
        return $query->orderBy('sira');
    }
}
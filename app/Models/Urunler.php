<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Urunler extends Model
{
    use HasFactory;

    protected $table = 'urunler';

    protected $fillable = [
        'restaurant_id',
        'kategori_id',
        'urunadi',
        'aciklama',
        'fiyat',
        'resim',
        'hazirlanma_suresi',
        'stokta_var',
        'aktif',
        'sira'
    ];

    protected $casts = [
        'fiyat' => 'decimal:2',
        'hazirlanma_suresi' => 'integer',
        'stokta_var' => 'boolean',
        'aktif' => 'boolean',
        'sira' => 'integer'
    ];

    // İlişkiler
    public function kategori()
    {
        return $this->belongsTo(UrunlerKategori::class, 'kategori_id');
    }

    // Scope'lar
    public function scopeAktif($query)
    {
        return $query->where('aktif', true);
    }

    public function scopeStokta($query)
    {
        return $query->where('stokta_var', true);
    }

    public function scopeRestaurant($query, $restaurantId)
    {
        return $query->where('restaurant_id', $restaurantId);
    }

    public function scopeKategori($query, $kategoriId)
    {
        return $query->where('kategori_id', $kategoriId);
    }

    public function scopeSirali($query)
    {
        return $query->orderBy('sira');
    }

    // Accessor'lar
    public function getFiyatFormatliAttribute()
    {
        return number_format($this->fiyat, 2) . ' ₺';
    }

    public function getKdvDahilFiyatAttribute()
    {
        $kdvOrani = $this->kategori->KDV ?? 0;
        return $this->fiyat * (1 + ($kdvOrani / 100));
    }
}
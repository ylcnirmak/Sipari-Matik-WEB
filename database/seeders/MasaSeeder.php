<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MasaSeeder extends Seeder
{
    public function run(): void
    {
        $restaurantId = 2;
        $now = Carbon::now();
        
        // Masa kategorilerini ekle
        $kategoriler = [
            ['id' => 1, 'restaurant_id' => $restaurantId, 'masakategoriadi' => 'İç Salon', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 2, 'restaurant_id' => $restaurantId, 'masakategoriadi' => 'Bahçe', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 3, 'restaurant_id' => $restaurantId, 'masakategoriadi' => 'Bar', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 4, 'restaurant_id' => $restaurantId, 'masakategoriadi' => 'VIP', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 5, 'restaurant_id' => $restaurantId, 'masakategoriadi' => 'Teras', 'created_at' => $now, 'updated_at' => $now],
        ];

        DB::table('masalarkategori')->insert($kategoriler);

        // Masaları ekle
        $masalar = [];

        // İç Salon masaları (1-16)
        for ($i = 1; $i <= 16; $i++) {
            $masalar[] = [
                'restaurant_id' => $restaurantId,
                'masakategori_id' => 1, // İç Salon
                'masaadi' => "Masa {$i}",
                'kisi_sayisi' => rand(2, 8),
                'garson_id' => null,
                'sira' => $i,
                'adisyonyaz' => null,
                'adisyon_id' => null,
                'rezervasyon_id' => null,
                'sure' => '0',
                'aktif' => true,
                'toplam_tutar' => 0,
                'indirim' => 0,
                'geneltoplam' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        // Bahçe masaları (17-24)
        for ($i = 17; $i <= 24; $i++) {
            $masalar[] = [
                'restaurant_id' => $restaurantId,
                'masakategori_id' => 2, // Bahçe
                'masaadi' => "Masa {$i}",
                'kisi_sayisi' => rand(4, 10),
                'garson_id' => null,
                'sira' => $i,
                'adisyonyaz' => null,
                'adisyon_id' => null,
                'rezervasyon_id' => null,
                'sure' => '0',
                'aktif' => true,
                'toplam_tutar' => 0,
                'indirim' => 0,
                'geneltoplam' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        // Bar masaları (25-30)
        for ($i = 25; $i <= 30; $i++) {
            $masalar[] = [
                'restaurant_id' => $restaurantId,
                'masakategori_id' => 3, // Bar
                'masaadi' => "Bar {$i}",
                'kisi_sayisi' => rand(2, 4),
                'garson_id' => null,
                'sira' => $i,
                'adisyonyaz' => null,
                'adisyon_id' => null,
                'rezervasyon_id' => null,
                'sure' => '0',
                'aktif' => true,
                'toplam_tutar' => 0,
                'indirim' => 0,
                'geneltoplam' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        // VIP masaları (31-34)
        for ($i = 31; $i <= 34; $i++) {
            $masalar[] = [
                'restaurant_id' => $restaurantId,
                'masakategori_id' => 4, // VIP
                'masaadi' => "VIP {$i}",
                'kisi_sayisi' => rand(6, 12),
                'garson_id' => null,
                'sira' => $i,
                'adisyonyaz' => null,
                'adisyon_id' => null,
                'rezervasyon_id' => null,
                'sure' => '0',
                'aktif' => true,
                'toplam_tutar' => 0,
                'indirim' => 0,
                'geneltoplam' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        // Teras masaları (35-44)
        for ($i = 35; $i <= 44; $i++) {
            $masalar[] = [
                'restaurant_id' => $restaurantId,
                'masakategori_id' => 5, // Teras
                'masaadi' => "Teras {$i}",
                'kisi_sayisi' => rand(2, 6),
                'garson_id' => null,
                'sira' => $i,
                'adisyonyaz' => null,
                'adisyon_id' => null,
                'rezervasyon_id' => null,
                'sure' => '0',
                'aktif' => true,
                'toplam_tutar' => 0,
                'indirim' => 0,
                'geneltoplam' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        DB::table('masalar')->insert($masalar);
    }
}
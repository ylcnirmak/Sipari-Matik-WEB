<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StaffPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Örnek yetki atamaları
        $staffPermissions = [
            ['cashier_id' => 1, 'permission_id' => 1], // Satış Yapma
            ['cashier_id' => 1, 'permission_id' => 2], // Satış Görüntüleme
            ['cashier_id' => 1, 'permission_id' => 3], // Satış Düzenleme
            ['cashier_id' => 1, 'permission_id' => 5], // İade İşlemi
            ['cashier_id' => 1, 'permission_id' => 6], // İndirim Uygulama
            ['cashier_id' => 1, 'permission_id' => 7], // Nakit Ödeme
            ['cashier_id' => 1, 'permission_id' => 8], // Kart Ödeme
            ['cashier_id' => 1, 'permission_id' => 9], // Stok Görüntüleme
            ['cashier_id' => 1, 'permission_id' => 10], // Stok Düzenleme
            ['cashier_id' => 1, 'permission_id' => 11], // Rapor Görüntüleme
            ['cashier_id' => 1, 'permission_id' => 13], // Müşteri Ekleme
            ['cashier_id' => 1, 'permission_id' => 14], // Müşteri Düzenleme
            ['cashier_id' => 1, 'permission_id' => 15], // Vardiya Açma
            ['cashier_id' => 1, 'permission_id' => 16], // Vardiya Kapatma
            ['cashier_id' => 1, 'permission_id' => 17], // Kasa Sayımı
            ['cashier_id' => 1, 'permission_id' => 18], // İşlem İptali
        ];

        foreach ($staffPermissions as $staffPermission) {
            DB::table('staff_permissions')->updateOrInsert(
                [
                    'cashier_id' => $staffPermission['cashier_id'],
                    'permission_id' => $staffPermission['permission_id']
                ],
                [
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );
        }
    }
}
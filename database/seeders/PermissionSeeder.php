<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ['name' => 'sale_create', 'display_name' => 'Satış Yapma'],
            ['name' => 'sale_view', 'display_name' => 'Satış Görüntüleme'],
            ['name' => 'sale_edit', 'display_name' => 'Satış Düzenleme'],
            ['name' => 'sale_delete', 'display_name' => 'Satış Silme'],
            ['name' => 'refund_process', 'display_name' => 'İade İşlemi'],
            ['name' => 'discount_apply', 'display_name' => 'İndirim Uygulama'],
            ['name' => 'payment_cash', 'display_name' => 'Nakit Ödeme'],
            ['name' => 'payment_card', 'display_name' => 'Kart Ödeme'],
            ['name' => 'inventory_view', 'display_name' => 'Stok Görüntüleme'],
            ['name' => 'inventory_edit', 'display_name' => 'Stok Düzenleme'],
            ['name' => 'report_view', 'display_name' => 'Rapor Görüntüleme'],
            ['name' => 'report_export', 'display_name' => 'Rapor Dışa Aktarma'],
            ['name' => 'customer_create', 'display_name' => 'Müşteri Ekleme'],
            ['name' => 'customer_edit', 'display_name' => 'Müşteri Düzenleme'],
            ['name' => 'shift_open', 'display_name' => 'Vardiya Açma'],
            ['name' => 'shift_close', 'display_name' => 'Vardiya Kapatma'],
            ['name' => 'cash_count', 'display_name' => 'Kasa Sayımı'],
            ['name' => 'void_transaction', 'display_name' => 'İşlem İptali'],
        ];

        foreach ($permissions as $permission) {
            DB::table('permissions')->updateOrInsert(
                ['name' => $permission['name']],
                [
                    'display_name' => $permission['display_name'],
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );
        }
    }
}
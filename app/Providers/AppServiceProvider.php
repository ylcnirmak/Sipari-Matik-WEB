<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
use App\Models\Permission;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Tüm view'larda permissions kullanılabilir olsun
        View::composer('*', function ($view) {
            // Tüm yetkiler (cache'siz)
            $allPermissions = Permission::all()->pluck('display_name', 'name');

            // Aktif kasiyerin yetkileri (cache'siz)
            $cashierPermissions = [];
            $cashierName = session('cashier_name'); // Session'dan al
            
            if (session()->has('cashier_id')) {
                $cashier = \App\Models\Cashier::with('permissions')->find(session('cashier_id'));
                if ($cashier) {
                    $cashierPermissions = $cashier->permissions->pluck('name')->toArray();
                    
                    // Eğer session'da name yoksa veya farklıysa güncelle
                    if (!$cashierName || $cashierName !== $cashier->name) {
                        session(['cashier_name' => $cashier->name]);
                        $cashierName = $cashier->name;
                    }
                }
            }

            $view->with([
                'allPermissions' => $allPermissions,
                'cashierPermissions' => $cashierPermissions,
                'cashierName' => $cashierName,
                'cashierId' => session('cashier_id'),
                'isAdmin' => false // Geçici - blade dosyalarını güncelleyene kadar
            ]);
        });

        // Blade directive'leri
        Blade::directive('canCashier', function ($permission) {
            return "<?php if(in_array($permission, \$cashierPermissions ?? [])): ?>";
        });

        Blade::directive('endcanCashier', function () {
            return "<?php endif; ?>";
        });

        Blade::directive('cannotCashier', function ($permission) {
            return "<?php if(!in_array($permission, \$cashierPermissions ?? [])): ?>";
        });

        Blade::directive('endcannotCashier', function () {
            return "<?php endif; ?>";
        });
    }
}
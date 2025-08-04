<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Kurye\KuryeController;

use App\Http\Controllers\Garson\GarsonController;
use App\Http\Controllers\Muhasebe\MuhasebeController;
use App\Http\Controllers\Restaurant\RestaurantController;

Route::get('/', function () {
    // Cookie kontrol et
    $restaurantId = request()->cookie('restaurant_logged');
    
    if ($restaurantId) {
        $user = App\Models\User::find($restaurantId);
        if ($user && $user->role == 'restaurant') {
            Auth::login($user);
            return redirect('/CashierVerify');
        }
    }
    
    // Auth kontrol et
    if (Auth::check()) {
        $user = Auth::user();
        switch ($user->role) {
            case 'admin': return redirect('/Desk');
            case 'restaurant': return redirect('/CashierVerify');
            case 'garson': return redirect('/WaiterDesk');
            case 'kurye': return redirect('/CourierDesk');
            case 'muhasebe': return redirect('/AccountingDesk');
            default: return redirect('/login');
        }
    }
    
    return redirect('/login');
});

Route::middleware(['auth', 'role:admin'])->group(function(){
    Route::get('/Desk', [AdminController::class, 'dashboard'])->name('Desk');
});

Route::middleware(['auth', 'role:restaurant'])->group(function(){
    Route::get('/CashierVerify', [RestaurantController::class, 'CashierVerify'])->name('CashierVerify');
    Route::post('/CashierVerify', [RestaurantController::class, 'verifyCashier'])->name('CashierVerifyPost');
    Route::get('/RestaurantDesk', [RestaurantController::class, 'dashboard'])->name('RestaurantDesk');
    
    // Restaurant logout (kasiyer ekranına dön)
    Route::post('/restaurant-logout', [RestaurantController::class, 'logout'])->name('restaurant.logout');
    Route::get('/NewOrder/{table}', [OrderController::class, 'newOrder'])->name('newOrder');
    Route::get('/OrderDetail/{table}', [OrderController::class, 'orderDetail'])->name('orderDetail');
    Route::post('/unlock-table', [OrderController::class, 'unlockTable'])->name('unlockTable');
    

});

// Tamamen çıkış yap
Route::get('/clear-restaurant-session', [RestaurantController::class, 'clearRestaurantSession'])->name('restaurant.clear-session');

Route::middleware(['auth', 'role:garson'])->group(function(){
    Route::get('/WaiterDesk', [GarsonController::class, 'dashboard'])->name('WaiterDesk');
});

Route::middleware(['auth', 'role:kurye'])->group(function(){
    Route::get('/CourierDesk', [KuryeController::class, 'dashboard'])->name('CourierDesk');
});

Route::middleware(['auth', 'role:muhasebe'])->group(function(){
    Route::get('/AccountingDesk', [MuhasebeController::class, 'dashboard'])->name('AccountingDesk');
});

require __DIR__.'/auth.php';
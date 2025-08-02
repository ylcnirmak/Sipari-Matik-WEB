<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\Cashier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RestaurantController extends Controller
{
    public function dashboard()
    {
        if (!session('cashier_id')) {
            return redirect()->route('CashierVerify');
        }

        return view('Restaurant.Bilesenler.dashboard');
    }

// RestaurantController'da CashierVerify'ı güncelleyin
public function CashierVerify()
{
    // Cookie'de restaurant bilgisi var mı kontrol et
    $restaurantId = request()->cookie('restaurant_logged');
    
    if ($restaurantId) {
        // Cookie'den restaurant bilgisini al ve otomatik login yap
        $user = User::find($restaurantId);
        if ($user && $user->role == 'restaurant') {
            if (!Auth::check()) {
                Auth::login($user);
            }
            
            // Direkt kasiyer şifre sayfasını göster
            return view('Restaurant.Bilesenler.dogrulama', [
                'auto_login' => true,
                'restaurant_name' => $user->name ?? $user->email
            ]);
        } else {
            // Geçersiz cookie varsa temizle ve login'e yönlendir
            cookie()->queue(cookie()->forget('restaurant_logged'));
            cookie()->queue(cookie()->forget('restaurant_email'));
            return redirect()->route('login');
        }
    }

    // Cookie yoksa ve auth da yoksa login'e git
    if (!auth()->check()) {
        return redirect()->route('login');
    }

    return view('Restaurant.Bilesenler.dogrulama', ['auto_login' => false]);
}

    public function verifyCashier(Request $request)
    {
        try {
            $request->validate([
                'password' => 'required'
            ]);

            // Cookie'den restaurant ID'sini al, yoksa auth'dan al
            $restaurant_id = request()->cookie('restaurant_logged') ?? auth()->user()->id;
            
            $cashiers = Cashier::where('restaurant_id', $restaurant_id)
                             ->where('is_active', true)
                             ->get();

            if ($cashiers->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Bu restoran için kasiyer bulunamadı!'
                ]);
            }

            $validCashier = null;
            foreach ($cashiers as $cashier) {
                if (strlen($cashier->password) == 60 && substr($cashier->password, 0, 4) == '$2y$') {
                    if (Hash::check($request->password, $cashier->password)) {
                        $validCashier = $cashier;
                        break;
                    }
                } else {
                    if ($request->password == $cashier->password) {
                        $validCashier = $cashier;
                        $cashier->password = Hash::make($request->password);
                        $cashier->save();
                        break;
                    }
                }
            }

            if (!$validCashier) {
                return response()->json([
                    'success' => false,
                    'message' => 'Hatalı kasiyer şifresi!'
                ]);
            }

            session([
                'cashier_id' => $validCashier->id, 
                'cashier_name' => $validCashier->name
            ]);

            return response()->json([
                'success' => true,
                'redirect' => route('RestaurantDesk')
            ]);

        } catch (\Exception $e) {
            Log::error('Cashier verify error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Sistem hatası!'
            ], 500);
        }
    }

    // Restaurant logout - sadece kasiyer session'ını temizle
    public function logout(Request $request)
    {
        // Sadece kasiyer session'ını temizle
        $request->session()->forget('cashier_id');
        $request->session()->forget('cashier_name');
        
        // Kasiyer şifre ekranına yönlendir (restaurant cookie'si duruyor)
        return redirect()->route('CashierVerify');
    }

    // Tamamen çıkış yap (cookie'leri de temizle)
    public function clearRestaurantSession()
    {
        cookie()->queue(cookie()->forget('restaurant_logged'));
        cookie()->queue(cookie()->forget('restaurant_email'));
        Auth::logout();
        return redirect()->route('login');
    }
}
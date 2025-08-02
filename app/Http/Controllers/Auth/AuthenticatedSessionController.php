<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View|RedirectResponse
    {
        // Zaten giriş yapmışsa yönlendir
        if (Auth::check()) {
            $user = Auth::user();
            switch ($user->role) {
                case 'admin': return redirect('Desk');
                case 'restaurant': return redirect()->route('CashierVerify');
                case 'garson': return redirect('WaiterDesk');
                case 'kurye': return redirect('CourierDesk');
                case 'muhasebe': return redirect('AccountingDesk');
            }
        }

        // Cookie'de restaurant bilgisi var mı kontrol et (giriş yapmamışsa)
        $restaurantId = request()->cookie('restaurant_logged');
        
        if ($restaurantId && !Auth::check()) {
            // Cookie'den restaurant bilgisini al ve otomatik login yap
            $user = User::find($restaurantId);
            if ($user && $user->role == 'restaurant') {
                Auth::login($user);
                return redirect()->route('CashierVerify');
            } else {
                // Geçersiz cookie varsa temizle
                cookie()->queue(cookie()->forget('restaurant_logged'));
                cookie()->queue(cookie()->forget('restaurant_email'));
            }
        }

        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        $user = $request->user();

        if ($user->role == "admin") {
            return redirect()->intended('Desk');
        } 
        else if ($user->role == "restaurant") {
            // Restaurant bilgilerini cookie'ye kaydet (30 gün)
        cookie()->queue('restaurant_logged', $user->id, 2628000);
        cookie()->queue('restaurant_email', $user->email, 2628000);
            
            // Kasiyer şifre ekranına yönlendir
            return redirect()->route('CashierVerify');
        }
        else if (in_array($user->role, ['garson', 'kurye', 'muhasebe'])) {
            if (!$user->restaurant_id) {
                Auth::logout();
                return redirect()->back()->withErrors(['error' => 'Restoran bilgisi eksik.']);
            }
            
            switch ($user->role) {
                case 'garson': 
                    return redirect()->intended('WaiterDesk');
                case 'kurye': 
                    return redirect()->intended('CourierDesk');
                case 'muhasebe': 
                    return redirect()->intended('AccountingDesk');
            }
        }

        // Fallback
        Auth::logout();
        return redirect()->route('login')->withErrors(['error' => 'Geçersiz kullanıcı rolü.']);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
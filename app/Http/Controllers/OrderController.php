<?php

namespace App\Http\Controllers;

use App\Models\Masalar;
use App\Models\Urunler;
use Illuminate\Http\Request;
use App\Models\UrunlerKategori;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function newOrder($table)
    {
        $kimlik = Auth::user()->id;
        $masaId = decrypt(urldecode($table));

        Masalar::where('id', $masaId)->update(['kilit' => 1]);

        $HangiMasa = Masalar::where('id', $masaId)->first();

        // Model'lerle veri çekme
        $kategoriler = UrunlerKategori::restaurant($kimlik)
            ->aktif()
            ->sirali()
            ->get();
        
        $urunler = Urunler::with('kategori')
            ->restaurant($kimlik)
            ->aktif()
            ->stokta()
            ->sirali()
            ->get();

        return view('Restaurant.NewOrder', compact('masaId','HangiMasa','kategoriler','urunler'));
    }
    
    public function orderDetail($table)
    {
        $masaId = decrypt(urldecode($table));

        Masalar::where('id', $masaId)->update(['kilit' => 1]);

        $HangiMasa = Masalar::where('id', $masaId)->first();

        return view('Restaurant.OrderDetail', compact('masaId','HangiMasa'));
    }

    public function unlockTable(Request $request)
    {
        $masaId = $request->input('masaId');
        
        Masalar::where('id', $masaId)->update(['kilit' => 0]);
        
        return response()->json(['success' => true]);
    }
}
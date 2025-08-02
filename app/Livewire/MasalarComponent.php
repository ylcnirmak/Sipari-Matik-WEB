<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Masalar;
use App\Models\MasaKategoriler;
use Illuminate\Support\Facades\Auth;

class MasalarComponent extends Component
{
    public $masalar;
    public $masaKategorileri;
    public $selectedKategori = null;
    public $cashierName;

    public function mount()
    {
        $this->cashierName = Auth::user()->name ?? 'Kasiyer';
        $this->loadData();
    }

    public function loadData()
    {
        $restaurantId = Auth::id();
        
        // Login olan kullanıcının restaurant_id'si ile eşleşen verileri getir
        $this->masaKategorileri = MasaKategoriler::where('restaurant_id', $restaurantId)->get();
        
        // Masa sorgusunu hazırla
        $query = Masalar::where('restaurant_id', $restaurantId)
                        ->with(['masaKategorisi', 'adisyon', 'rezervasyon']);
        
        // Eğer kategori seçilmişse, o kategoriye göre filtrele
        if ($this->selectedKategori) {
            $query->where('masakategori_id', $this->selectedKategori);
        }
        
        $this->masalar = $query->get()->map(function($masa) {
            // Masa durumunu belirle
            if ($masa->kilit == 1) {
                $masa->computed_durum = 'kilitli';  
            } elseif ($masa->rezervasyon_id) {
                $masa->computed_durum = 'rezerve';
            } elseif ($masa->adisyon_id) {
                $masa->computed_durum = 'dolu';
            } else {
                $masa->computed_durum = 'bos';
            }
            
            return $masa;
        });
    }

    public function selectCategory($kategoriId = null)
    {
        $this->selectedKategori = $kategoriId;
        $this->loadData();
    }

    public function render()
    {
        return view('livewire.masalar-component')->extends('Restaurant.Bilesenler.app')->section('content');
    }
}
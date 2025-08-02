<?php

namespace App\Http\Controllers\Kurye;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KuryeController extends Controller
{
     public function dashboard()
    {
        return view('Kurye.Bilesenler.dashboard');
    }
}

<?php

namespace App\Http\Controllers\Garson;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GarsonController extends Controller
{
     public function dashboard()
    {
        return view('Garson.Bilesenler.dashboard');
    }
}

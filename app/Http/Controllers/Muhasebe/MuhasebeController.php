<?php

namespace App\Http\Controllers\Muhasebe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MuhasebeController extends Controller
{
     public function dashboard()
    {
        return view('Muhasebe.Bilesenler.dashboard');
    }
}

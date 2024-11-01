<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservationsController extends Controller
{
 
    public function add(Request $request)
    {
        dd($request->all());    
    }

 
    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ServicesController extends Controller
{
    
    public function update(Request $request)
    {
       $request= $request->except('_token');
         $id = $request['id'];
         
         DB::table('services')
            ->where('id', $id)
            ->update($request);

        return redirect()->back()->with('success', 'Hizmet başarıyla güncellendi');
    }
    
}

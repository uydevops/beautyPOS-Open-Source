<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ServicesController extends Controller
{


    public function uploadImage(Request $request)
    {
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        return $imageName;
    }
    
    public function update(Request $request)
    {
       $request= $request->except('_token');
         $id = $request['id'];

         if($request['image'] != null){
            $imageName = time().'.'.$request['image']->extension();
            $request['image']->move(public_path('images'), $imageName);
            $request['image'] = $imageName;
        }
         
         DB::table('services')
            ->where('id', $id)
            ->update($request);

        return redirect()->back()->with('success', 'Hizmet başarıyla güncellendi');
    }

    public function delete($id)
    {
        DB::table('services')->where('id', $id)->delete();

        return redirect()->back()->with('success', 'Hizmet başarıyla silindi');
    }

    public function add(Request $request)
    {
        $request= $request->except('_token');

        if($request['image'] != null){
            $imageName = time().'.'.$request['image']->extension();
            $request['image']->move(public_path('images'), $imageName);
            $request['image'] = $imageName;
        }

        DB::table('services')->insert($request);
        return redirect()->back()->with('success', 'Hizmet başarıyla eklendi');
    }
    
}

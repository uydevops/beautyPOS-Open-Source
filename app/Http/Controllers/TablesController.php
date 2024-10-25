<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class TablesController extends Controller
{
    public function add(Request $request)
    {
        // CSRF token'ı hariç tut
        $requestData = $request->except('_token');
        for ($i = 0; $i < count($requestData['name']); $i++) {
            DB::table('tables')->insert([
                'name' => $requestData['name'][$i], // 'name' dizisindeki her bir değeri al
                'capacity' => $requestData['capacity'][$i], // 'capacity' dizisindeki her bir değeri al
            ]);
        }
    
        return redirect()->back()->with('success', 'Masalar başarıyla eklendi.');
    }
    public function update(Request $request, $id)
    {
        // CSRF token'ı hariç tut
        $requestData = $request->except('_token');
    
        // Geçerli alanları kontrol et
        if (!isset($requestData['name']) && !isset($requestData['capacity'])) {
            return response()->json(['message' => 'Geçersiz veri gönderildi.'], 400);
        }
    
        // Masa verilerini güncelle
        DB::table('tables')->where('id', $id)->update($requestData); // Dinamik olarak güncelle
    
        return response()->json(['message' => 'Table updated successfully!'], 200);
    }

    public function delete($id)
    {
        // Masa verilerini sil
        DB::table('tables')->where('id', $id)->delete();
    
        return redirect()->back()->with('success', 'Masa başarıyla silindi.');
    }
    

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class TablesController extends Controller
{
    public function add(Request $request)
    {
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
        $requestData = $request->except('_token');
        DB::table('tables')->where('id', $id)->update($requestData);
    
        if (isset($requestData['employee_id']) && is_null($requestData['employee_id'])) {
            DB::table('employees')->where('table_id', $id)->update(['table_id' => null]);
        }
    
        return response()->json(['message' => 'Table updated successfully!'], 200);
    }
    

    public function delete($id)
    {
        DB::table('tables')->where('id', $id)->delete();
    
        return redirect()->back()->with('success', 'Masa başarıyla silindi.');
    }
    

}

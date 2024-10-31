<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservationsController extends Controller
{
    public function emptyTable()
    {
        // Boş tabloları veritabanından çekiyoruz
        $tables = DB::table('tables')->where('status', 0)->get();

        return response()->json($tables);
    }

    public function reservedTable()
    {
        // Rezerve edilmiş masaları çek
        $reservedTables = DB::table('reservations')
            ->join('tables', 'reservations.table_id', '=', 'tables.id')
            ->select('tables.id as table_id', 'tables.name', 'tables.capacity', 'reservations.customer_name', 'reservations.reservation_date')
            ->get();
    
        return response()->json($reservedTables);
    }

    public function add(Request $request)
    {
        $data = $request->except('_token');
        $customer_name = $data['customer_name'] ?? null;
        $reservation_date = $data['reservation_date'] ?? null;
        $table_id = $data['table_id'] ?? null;

        if (is_null($customer_name) || is_null($reservation_date) || is_null($table_id)) {
            return response()->json(['status' => 'error', 'message' => 'Gerekli alanlar eksik.'], 400);
        }

        try {
            DB::table('tables')->where('id', $table_id)->update(['status' => 1]);

            DB::table('reservations')->insert([
                'customer_name' => $customer_name,
                'reservation_date' => $reservation_date,
                'table_id' => $table_id,
                'status' => 'confirmed',
            ]);

            return response()->json(['status' => 'success', 'message' => 'Masa başarıyla rezerve edildi.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Bir hata oluştu: ' . $e->getMessage()], 500);
        }
    }

    public function release(Request $request)
    {
        $data = $request->except('_token');
        $table_id = $data['table_id'] ?? null;
    
        if (is_null($table_id)) {
            return response()->json(['status' => 'error', 'message' => 'Masa ID eksik.'], 400);
        }
    
        try {
            $reservation = DB::table('reservations')->where('table_id', $table_id)->first();
            
            if (!$reservation) {
                return response()->json(['status' => 'error', 'message' => 'Silinecek rezervasyon bulunamadı.'], 404);
            }
    
            DB::table('tables')->where('id', $table_id)->update(['status' => 0]);
    
            DB::table('reservations')->where('table_id', $table_id)->delete();
    
            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Bir hata oluştu: ' . $e->getMessage()], 500);
        }
    }
    
}

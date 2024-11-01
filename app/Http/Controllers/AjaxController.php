<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Response;

class AjaxController extends Controller
{

    public function selectedServices(Request $request)
    {
        $this->data['services'] = DB::table('services')
            ->select('services.id as service_id', 'services.name as service_name', 'services.price as service_price', 'employees.name as employee_name', 'tables.name as table_name')
            ->join('employees', 'services.employee_id', '=', 'employees.id')
            ->join('tables', 'employees.id', '=', 'tables.employee_id')
            ->orderBy('services.id', 'desc')
            ->get();

        return response()->json($this->data);
    }
    public function emptyDate($dmy)
    {
        $reservations = DB::table('reservations')
            ->where('reservation_date', 'like', $dmy . '%') // reservation_date sütununu kontrol et
            ->get();

        $this->data['reservations'] = $reservations->map(function ($item) {
            $item->reservation_date = date('H:i', strtotime($item->reservation_date));
            return $item;
        });

        return response()->json($this->data);
    }

    public function findServices($services_id)
    {
        $this->data['services'] = DB::table('services')
            ->select(
                'employees.name as employee_name',
                'tables.name as table_name'
            )
            ->join('employees', 'services.employee_id', '=', 'employees.id')
            ->join('tables', 'employees.id', '=', 'tables.employee_id')
            ->where('services.id', $services_id)
            ->orderBy('services.id', 'desc')
            ->get();

        return response()->json($this->data);
    }
}

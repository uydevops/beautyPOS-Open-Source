<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//Method Illuminate\Support\Collection::items does not exist.
use Illuminate\Support\Collection;

class DashboardController extends Controller
{
    public function index()
    {
     
        return view('dashboard');
    }

    public function users()
    {
        $this->data['users'] = DB::table('users')->get();
        return view('users', $this->data);
    }



    public function settings()
    {

        $this->data['smsSettings'] = DB::table('sms_send_settings')->where('id', 1)->first(); // first() ile tek bir kayıt alın
        return view('settings', $this->data);
    }


    public function tables()
    {
        $this->data['tables'] = DB::table('tables')->get();
        $this->data['employees'] = DB::table('employees')->get();

        return view('tables', $this->data);
    }

    public function reservations()
    {
        $this->data['tables'] = DB::table('tables')->get();
        $this->data['reservations'] = DB::table('reservations')->get();
        return view('reservations', $this->data);
    }

    public function feedback()
    {
        $this->data['feedback'] = DB::table('feedback')->get();
        return view('feedback', $this->data);
    }

    public function employees()
    {
        $this->data['employees'] = DB::table('employees')->get();
        return view('employees', $this->data);
    }

    public function customers()
    {
        $this->data['customers'] = DB::table('customers')->get();
        return view('customers', $this->data);
    }

    public function campaigns()
    {
        $this->data['customers'] = DB::table('customers')
            ->select('id', DB::raw("CONCAT(first_name, ' ', last_name) as name"))
            ->orderBy('name', 'asc') // A-Z sıralama
            ->get();

        $this->data['campaigns'] = DB::table('campaigns')->get();
        return view('campaigns', $this->data);
    }

    public function services()
    {
        $this->data['services'] = DB::table('services')
            ->join('categories', 'services.category_id', '=', 'categories.id')
            ->join('employees', 'services.employee_id', '=', 'employees.id')
            ->select('services.*', 'categories.name as category_name', 'employees.name as staff_name')
            ->get();


        $this->data['categories'] = DB::table('categories')->get();
        $this->data['employees'] = DB::table('employees')->get();

        $services = $this->data['services']->map(function ($service) {
            unset($service->created_at, $service->updated_at);
            return $service;
        });

        $this->data['services'] = $services;

        return view('services', $this->data);
    }
}

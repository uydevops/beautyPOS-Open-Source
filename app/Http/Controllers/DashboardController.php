<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function tables()
    {
        $this->data['tables'] = DB::table('tables')->get();
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
}

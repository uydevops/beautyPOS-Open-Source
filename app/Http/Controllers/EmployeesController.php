<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class EmployeesController extends Controller
{
    


    public function add(Request $request)
    {
        $request = $request->except('_token');
        Db::table('employees')->insert($request);
        return redirect()->back()->with('message', 'Employee added successfully');
    }
}

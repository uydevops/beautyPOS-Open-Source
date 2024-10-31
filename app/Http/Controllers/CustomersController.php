<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CustomersController extends Controller
{





    public function add(Request $request)
    {
        $request = $request->except('_token');
        $insert = DB::table('customers')->insert($request);
        if ($insert) {
            return redirect()->back()->with('success', 'Müşteri başarıyla eklendi.');
        } else {
            return redirect()->back()->with('status', 'Müşteri eklenirken bir hata oluştu.');
        }
    }


    public function delete($id)
    {
        $delete = DB::table('customers')->where('id', $id)->delete();
        if ($delete) {
            return redirect()->back()->with('success', 'Müşteri başarıyla silindi.');
        } else {
            return redirect()->back()->with('status', 'Müşteri silinirken bir hata oluştu.');
        }
    }


    public function update(Request $request)
    {
        $request = $request->except('_token');
        $id = $request->id;
        $update = DB::table('customers')->where('id', $id)->update($request);
        if ($update) {
            return redirect()->back()->with('success', 'Müşteri başarıyla güncellendi.');
        } else {
            return redirect()->back()->with('status', 'Müşteri güncellenirken bir hata oluştu.');
        }
    }
}

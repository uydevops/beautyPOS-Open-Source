<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//auth , hash
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{


    public function addUser(Request $request)
    {
        $userData = $request->except('_token'); // Sadece _token hariç tut
        $userData['password'] = Hash::make($request->password); // Şifreyi hashle
        DB::table('users')->insert($userData);

        return redirect()->back()->with('success', 'Kullanıcı başarıyla eklendi.');
    }

    public function updateUser(Request $request)
    {
        $userData = $request->except($request->_token);
        $userData['password'] = Hash::make($request->password);
        DB::table('users')->where('id', $request->id)->update($userData);
        return redirect()->back()->with('success', 'Kullanıcı başarıyla güncellendi.');
    }

    public function deleteUser($id)
    {
        DB::table('users')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Kullanıcı başarıyla silindi.');
    }
}

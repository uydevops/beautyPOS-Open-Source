<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{






    public function updateSMS(Request $request)
    {
        $request = $request->except('_token');
        $username = $request['username'];
        $password = $request['password'];
        $title = $request['title'];

        DB::table('sms_send_settings')->where('id', 1)->update([
            'username' => $username,
            'password' => $password,
            'title' => $title,
            'updated_at' => now()
        ]);


        return redirect()->back()->with('success', 'SMS ayarları güncellendi');
    }
}

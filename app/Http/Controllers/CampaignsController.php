<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CampaignsController extends Controller
{
    public function add(Request $request)
    {


        $campaignData = [
            'campaign_name' => $request->campaign_name,
            'campaign_details' => $request->campaign_details,
            'campaign_type' => $request->send_type,
            'send_type' => $request->send_type,
            'date' => date('Y-m-d', strtotime($request->date)),
        ];


        $isAdded = DB::table('campaigns')->insert($campaignData);

        if ($isAdded) {
            return redirect()->back()->with('success', 'Kampanya başarıyla eklendi.');
        }

        return redirect()->back()->with('error', 'Kampanya eklenirken bir hata oluştu.');
    }


    public function delete($id)
    {
        $isDeleted = DB::table('campaigns')->where('id', $id)->delete();

        if ($isDeleted) {
            return redirect()->back()->with('success', 'Kampanya başarıyla silindi.');
        }

        return redirect()->back()->with('error', 'Kampanya silinirken bir hata oluştu.');
    }
}

<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AlertController extends Controller
{
    public static function pemberitahuan(Request $request)
    {
    	if ($request->deskripsi) {
    		$deskripsi = $request->deskripsi;
    	} else {
    		$deskripsi = 'default';
    	}
    	return view('dashboard.page.alert_page')
    	->with('message', $request->message)
    	->with('status', $request->status)
    	->with('deskripsi', $deskripsi)
        ->with('custom_message', $request->custom_message)
    	->with('link', $request->link);
    }
}

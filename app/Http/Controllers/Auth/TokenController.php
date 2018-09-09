<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Helper
use App\Helper\Guzzle;
use App\Helper\AuthTracker;
class TokenController extends Controller
{
    public static function getTokenApp()
    {
    	$param = [
            'method' => 'GET',
            'url' => 'get-token',
            'request' => [
                'headers' => [
                    'x-api-key' => '62ede90587d8efbf6dce52033a3dd7f5392a10df'
                ]
            ]
        ];
        return Guzzle::request($param);
    }

    public function checkPin(Request $request)
    {
        $param = [
            'method' => 'POST',
            'url' => 'auth/pin',
            'request' => [
                'headers' => [
                    'Authorization' => AuthTracker::info()->token['key']
                ],
                'form_params' => [
                    'nomor_peserta' => $request->nomor_peserta,
                    'pin' => $request->pin
                ]
            ]
        ];
        return Guzzle::request($param);
    }
}

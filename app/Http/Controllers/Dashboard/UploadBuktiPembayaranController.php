<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;
use App\Helper\AuthTracker;
use App\Helper\Guzzle;
class UploadBuktiPembayaranController extends Controller
{
    public function index()
    {
        try {
            $param = [
                'method' => 'POST',
                'url' => 'transaksi/pembayaran/history',
                'request' => [
                    'allow_redirects' => true,
                    'headers' => [
                        'Authorization' => AuthTracker::info()->token['key']
                    ],
                    'form_params' => [
                        'nomor_transaksi' => AuthTracker::info()->users['nomor_transaksi'],
                    ]
                ]
            ];
            $response = Guzzle::requestAsync($param);
            return view('dashboard.page.upload_bukti_pembayaran')
            ->with('history_pembayaran', $response);
        } catch (\Exception $e) {
            return redirect()->action(
                'Dashboard\AlertController@pemberitahuan', ['message' => 'error', 'status' => 'failed', 'link' => 'default']
            );
        }
    }

    public function postPembayaran(Request $request)
    {
    	try {
    		/**
    		* validasi pin
    		*/
    		$pin = [
                'method' => 'POST',
                'url' => 'auth/pin',
                'request' => [
                    'allow_redirects' => true,
                    'headers' => [
                        'Authorization' => AuthTracker::info()->token['key']
                    ],
                    'form_params' => [
                        'nomor_peserta' => AuthTracker::info()->users['nomor_peserta'],
                        'pin' => $request->pin
                    ]
                ]
            ];
            $response_pin = Guzzle::request($pin);

    		/**
    		* post upload dokumen
    		*/
    		$file_bukti = Storage::disk('public')->put('bukti-pembayaran/'.AuthTracker::info()->users['nomor_transaksi'], $request->file('file_bukti'));
	    	$param = [
	            'method' => 'POST',
	            'url' => 'transaksi/pembayaran',
	            'request' => [
	                'allow_redirects' => true,
	                'headers' => [
	                    'Authorization' => AuthTracker::info()->token['key']
	                ],
	                'form_params' => [
	                    'nomor_transaksi' => AuthTracker::info()->users['nomor_transaksi'],
	                    'jenis_pembayaran' => $request->jenis_pembayaran,
	                    'bukti' => asset('storage/'.$file_bukti),
	                    'tgl_pembayaran' => $request->tgl_pembayaran,
	                    'jumlah_pembayaran' => str_replace(['.',',','Rp'],'',$request->jumlah_pembayaran)
	                ]
	            ]
	        ];
	        if ($response_pin['data']) {
            	$response = Guzzle::requestAsync($param);
                if ($response['status'] == 200) {
                    return redirect()->action(
                        'Dashboard\AlertController@pemberitahuan', ['message' => 'upload_pembayaran_success', 'status' => 'success', 'link' => 'pembayaran']
                    );
                } else {
                    return redirect()->action(
                        'Dashboard\AlertController@pemberitahuan', ['message' => 'upload_pembayaran_failed', 'status' => 'failed', 'link' => 'pembayaran', 'custom_message' => $response['msg']]
                    );
                }
            } else {
            	return redirect()->action(
                    'Dashboard\AlertController@pemberitahuan', ['message' => 'pin_failed', 'status' => 'failed', 'link' => 'pembayaran']
                );
            }

    	} catch (\Exception $e) {
    		return redirect()->action(
                'Dashboard\AlertController@pemberitahuan', ['message' => 'error', 'status' => 'failed', 'link' => 'pembayaran']
            );
    	}
    	
    }
}

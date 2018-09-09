<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Storage;
use App\Helper\AuthTracker;
use App\Helper\Guzzle;
class UploadDokumenController extends Controller
{
    public function index()
    {
        $status_transaksi = self::statusTransaksi();
        $status_file_upload = self::statusFileUpload();
        // if ($status_transaksi['data']) {
            return view('dashboard.page.upload_dokumen')
            ->with('status_file', $status_file_upload);
        // } else {
        //     return redirect()->action(
        //         'Dashboard\AlertController@pemberitahuan', ['message' => 'akses_upload_dokumen', 'status' => 'failed', 'link' => 'default']
        //     );
        // }
    }

    public function postDokumen(Request $request, $field, $table = null)
    {
        // return $request->file;
    	// try {
    		// $pin = [
      //           'method' => 'POST',
      //           'url' => 'auth/pin',
      //           'request' => [
      //               'allow_redirects' => true,
      //               'headers' => [
      //                   'Authorization' => AuthTracker::info()->token['key']
      //               ],
      //               'form_params' => [
      //                   'nomor_peserta' => AuthTracker::info()->users['nomor_peserta'],
      //                   'pin' => $request->pin
      //               ]
      //           ]
      //       ];
      //       $response_pin = Guzzle::request($pin);

            // file
            $file_upload = Storage::disk('public')->put('dokumen/'.AuthTracker::info()->users['nomor_transaksi'].'', $request->file);

            $param = [
                'method' => 'POST',
                'url' => 'transaksi/dokument',
                'request' => [
                    'allow_redirects' => true,
                    'headers' => [
                        'Authorization' => AuthTracker::info()->token['key']
                    ],
                    'form_params' => [
                        'nomor_transaksi' => AuthTracker::info()->users['nomor_transaksi'],
                        'file' => asset('storage/'.$file_upload),
                        'field' => $field,
                        'table' => $table,
                        'nomor_peserta' => AuthTracker::info()->users['nomor_peserta']
                    ]
                ]
            ];

            // if ($response_pin['data']) {
            	$response = Guzzle::requestAsync($param);
                if ($response['status'] === 200) {


                    $foto = [
                        'method' => 'POST',
                        'url' => 'pendaftar/get-pendaftar-detail',
                        'request' => [
                            'allow_redirects' => true,
                            'headers' => [
                                'Authorization' => AuthTracker::info()->token['key']
                            ],
                            'form_params' => [
                                'nomor_peserta' => AuthTracker::info()->users['nomor_peserta']
                            ]
                        ]
                    ];
                    $response_foto = Guzzle::requestAsync($foto);
                    $collection = collect(session('users'));
                    $collection->put('foto', $response_foto['data']['foto']);
                    $collection->all();

                    session(['users' => $collection]);

                    return redirect()->back();
                } else {
                    return redirect()->action(
                        'Dashboard\AlertController@pemberitahuan', ['message' => 'upload_dokumen_failed', 'status' => 'failed', 'link' => 'dokumen']
                    );
                }
            // } else {
            // 	return redirect()->action(
            //         'Dashboard\AlertController@pemberitahuan', ['message' => 'pin_failed', 'status' => 'failed', 'link' => 'dokumen']
            //     );
            // }

    	// } catch (\Exception $e) {
     //        return $e->getMessage();
    	// 	return redirect()->action(
     //            'Dashboard\AlertController@pemberitahuan', ['message' => 'error', 'status' => 'failed', 'link' => 'dokumen']
     //        );
    	// }
    }

    public function statusTransaksi()
    {
        $param = [
            'method' => 'POST',
            'url' => 'status/transaksi',
            'request' => [
                'allow_redirects' => true,
                'headers' => [
                    'Authorization' => AuthTracker::info()->token['key']
                ],
                'form_params' => [
                    'nomor_peserta' => AuthTracker::info()->users['nomor_peserta']
                ]
            ]
        ];
        return $response = Guzzle::requestAsync($param);
    }

    public static function statusFileUpload($table = null)
    {
        $param = [
            'method' => 'POST',
            'url' => 'status/status-file-upload',
            'request' => [
                'allow_redirects' => true,
                'headers' => [
                    'Authorization' => AuthTracker::info()->token['key']
                ],
                'form_params' => [
                    'nomor_transaksi' => AuthTracker::info()->users['nomor_transaksi'],
                    'nomor_peserta' => AuthTracker::info()->users['nomor_peserta'],
                    'table' => $table
                ]
            ]
        ];
        return $response = Guzzle::requestAsync($param);   
    }

    public function splashUploadDokumen()
    {
        $status_file = self::statusFileUpload('dumper');
        return view('dashboard.splash_upload_dokumen', compact('status_file'));
    }
}

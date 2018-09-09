<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// 3Rd
use App\Helper\Guzzle;
use App\Helper\AuthTracker;
use App\Helper\TanggalMerah;
class TanggalBerangkatController extends Controller
{
    public function index()
    {
        $akses_umrah = self::akses();
        // $pemesanan_umrah = self::pemesanan();
        $embarkasi = [
            'method' => 'GET',
            'url' => 'embarkasi/get-data',
            'request' => [
                'allow_redirects' => true,
                'headers' => [
                    'Authorization' => AuthTracker::info()->token['key']
                ]
            ]
        ];
        $response_embarkasi = Guzzle::requestAsync($embarkasi);

        /**
        * Filter jika kondisi tidak memiliki akses
        */
        if ($akses_umrah['data']) {
            /**
            * Filter jika sudah memilih paket
            */
            // if ($pemesanan_umrah['data']) {

                return view('dashboard.page.pemilihan_tanggal')
                ->with('embarkasi', $response_embarkasi);
            // } else {
            //     return redirect()->action(
            //         'Dashboard\AlertController@pemberitahuan', ['message' => 'tanggal_book_failed', 'status' => 'failed', 'deskripsi' => 'tanggal_book_availabel', 'link' => 'default']
            //     );
            // }
        } else {
            return redirect()->action(
                'Dashboard\AlertController@pemberitahuan', ['message' => 'akses_umrah_failed', 'status' => 'failed', 'deskripsi' => 'akses_umrah_failed', 'link' => 'default']
            );
        }
    }

    public static function akses()
    {
        try {
            $param = [
                'method' => 'POST',
                'url' => 'status/akses-umrah',
                'request' => [
                    'allow_redirects' => true,
                    'headers' => [
                        'Authorization' => AuthTracker::info()->token['key']
                    ],
                    'form_params' => [
                        'nomor_peserta' => AuthTracker::info()->users['nomor_peserta'],
                    ]
                ]
            ];
            return $response = Guzzle::requestAsync($param);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public static function pemesanan()
    {
        try {
            $param = [
                'method' => 'POST',
                'url' => 'status/pemesanan-umrah',
                'request' => [
                    'allow_redirects' => true,
                    'headers' => [
                        'Authorization' => AuthTracker::info()->token['key']
                    ],
                    'form_params' => [
                        'nomor_peserta' => AuthTracker::info()->users['nomor_peserta'],
                    ]
                ]
            ];
            return $response = Guzzle::requestAsync($param);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public static function getTglUmrah(Request $request)
    {
        $param = [
            'method' => 'POST',
            'url' => 'produk/getproduk',
            'request' => [
                'allow_redirects' => true,
                'headers' => [
                    'Authorization' => AuthTracker::info()->token['key']
                ],
                'form_params' => [
                    'kode_embarkasi' => $request->kode_embarkasi
                ]
            ]
        ];
        $response = Guzzle::requestAsync($param);

        $json_calender = [];
        $json_calender_availabel = [];
        foreach ($response['data'] as $data) {
            if($data['availabel'] == true){
                $color = '#8CD049';
                $json_calender_availabel[$data['tanggal_keberangkatan']] = true;
            } else {
                $color = '#F44336';
                $json_calender_availabel[$data['tanggal_keberangkatan']] = false;
            }
            $array = [
                'id' => $data['kode_produk'],
                'title' => $data['kode_produk'],
                'resourceId' => 'PRUMH20180527548',
                'start' => $data['tanggal_keberangkatan'],
                'overlap' => false,
                'rendering' => 'background',
                'color' => $color
            ];
            array_push($json_calender, $array);
        }
        // array_push($json_calender, );
        $response_data =[
            'calendar' => array_collapse([$json_calender, TanggalMerah::libur()]),
            'availabel' => $json_calender_availabel
        ];
        return $response_data;
    }


    public function postTglBerangkat(Request $request)
    {
        try{

            if ($request->nomor_peserta) {
                $nomor_peserta = 'UMHPS'.$request->nomor_peserta;
            } else {
                $nomor_peserta = AuthTracker::info()->users['nomor_peserta'];
            }

            // Get produk
            $produk = [
                'method' => 'POST',
                'url' => 'produk/getproduk?tgl='.$request->input('tgl-berangkat'),
                'request' => [
                    'allow_redirects' => true,
                    'headers' => [
                        'Authorization' => AuthTracker::info()->token['key']
                    ],
                    'form_params' => [
                        'kode_embarkasi' => $request->input('kode_embarkasi')
                    ]
                ]
            ];
            $response_produk = Guzzle::requestAsync($produk);

            // PIN
            $pin = [
                'method' => 'POST',
                'url' => 'auth/pin',
                'request' => [
                    'allow_redirects' => true,
                    'headers' => [
                        'Authorization' => AuthTracker::info()->token['key']
                    ],
                    'form_params' => [
                        'nomor_peserta' => $nomor_peserta,
                        'pin' => $request->pin
                    ]
                ]
            ];
            $response_pin = Guzzle::request($pin);

            // Add Transaksi
            $param = [
                'method' => 'POST',
                'url' => 'transaksi/add',
                'request' => [
                    'allow_redirects' => true,
                    'headers' => [
                        'Authorization' => AuthTracker::info()->token['key']
                    ],
                    'form_params' => [
                        'kode_produk' => $response_produk['data']['kode_produk'],
                        'nomor_peserta' => $nomor_peserta,
                        'kode_embarkasi' => $request->input('kode_embarkasi')
                    ]
                ]
            ];
        } catch (\Exception $e){
            return redirect()->action(
                'Dashboard\AlertController@pemberitahuan', ['message' => 'error', 'status' => 'failed', 'link' => 'tanggal']
            );
        }
        
        if ($response_pin['data']) {
            try{
                $response = Guzzle::requestAsync($param);
                if ($response['status'] == 200) {
                    /**
                    * Update session kode produk
                    */

                    $peserta_detail = [
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
                    $response_peserta_detail = Guzzle::requestAsync($peserta_detail);
                    $collection = collect(session('users'));
                    $collection->put('kode_produk', $response_peserta_detail['data']['kode_produk']);
                    $collection->put('nomor_transaksi', $response_peserta_detail['data']['nomor_transaksi']);

                    session(['users' => $collection]);

                    return redirect()->action(
                        'Dashboard\AlertController@pemberitahuan', ['message' => 'tanggal_book_success', 'status' => 'success', 'link' => 'tanggal']
                    );
                } else {
                    return redirect()->action(
                        'Dashboard\AlertController@pemberitahuan', ['message' => 'tanggal_book_failed', 'status' => 'failed', 'link' => 'tanggal']
                    );
                }
            } catch (\Exception $e) {
                return redirect()->action(
                    'Dashboard\AlertController@pemberitahuan', ['message' => 'error', 'status' => 'failed', 'link' => 'tanggal']
                );
            }
        } else {
            return redirect()->action(
                'Dashboard\AlertController@pemberitahuan', ['message' => 'pin_failed', 'status' => 'failed', 'link' => 'tanggal']
            );
        }
    }
}

<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Helper\AuthTracker;
use App\Helper\Guzzle;
use App\Helper\DirectPage;
class KursiPesawatController extends Controller
{
    public function index(Request $request)
    {
        /**
        * Filter akses pesawat
        * kondisik akses pesawat di ambil jika response pemilihan tanggal keberangkatan false berarti bisa memilih kursi pesawat
        */
        $akses_pesawat = self::akses();
        // $pemilihan_pesawat = self::pemilihan();
        if ($akses_pesawat['data']) {
            return view('dashboard.page.pemilihan_seat_pesawat');
        } else {
            return redirect()->action(
                'Dashboard\AlertController@pemberitahuan', ['message' => 'akses_pesawat_failed', 'status' => 'failed', 'deskripsi' => 'default', 'link' => 'default', 'custom_message' => $akses_pesawat['msg']]
            );
        }
    }

    public static function form()
    {
        return view('dashboard.page.pemilihan_seat_pesawat_form');
    }

    public static function akses()
    {
        try {
            $param = [
                'method' => 'POST',
                'url' => 'status/akses-seat',
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
            return $response = Guzzle::requestAsync($param);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public static function pemilihan()
    {
        try {
            $param = [
                'method' => 'POST',
                'url' => 'status/pemesanan-seat',
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
            return $response = Guzzle::requestAsync($param);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public static function availabelSeat(Request $request)
    {
        try {
            $param = [
                'method' => 'POST',
                'url' => 'pesawat/getavailabelseat',
                'request' => [
                    'allow_redirects' => true,
                    'headers' => [
                        'Authorization' => AuthTracker::info()->token['key']
                    ],
                    'form_params' => [
                        'kode_produk' => AuthTracker::info()->users['kode_produk'],
                        'kode_pesawat' => $request->kode_pesawat
                    ]
                ]
            ];

            $response = Guzzle::requestAsync($param);
            // return (array) AuthTracker::info();
            $array_kursi = [];

            foreach ($response['data'] as $data) {
                array_push($array_kursi, $data['kode_kursi']);
            }

            
            $array_from_request = $request->array;
            $return_array = [];

            foreach ($array_from_request as $array_data) {
                if (in_array($request->kode_pesawat.$array_data, $array_kursi)) {
                    array_push($return_array, [$request->kode_pesawat.$array_data => 'true']);
                } else {
                    array_push($return_array, [$request->kode_pesawat.$array_data => 'false']);
                }
            }

            return array_collapse($return_array);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        
    }

    public function bookSeat(Request $request)
    {
        /**
         * Memasukan nomor_peserta kedalam array
         */

        $input_count = count($request->input('nomor_peserta'));

        for ($i=0; $i < $input_count; $i++) { 
            $input[] = [
                'nomor_peserta' => $request->input('nomor_peserta')[$i],
                'pin' => $request->input('pin')[$i],
                'seat' => $request->input('no_seat')[$i]
            ];
        }

        foreach ($input as $val) {
            $nomor_peserta = 'UMHPS'.$val['nomor_peserta'];

            /**
            * Validasi kode produk yang sama
            * peserta bisa menambahkan peserta lain dengan catatan harus memiliki kode produk yang sama
            */
            $validasi_produk = [
                'method' => 'POST',
                'url' => 'pendaftar/get-pendaftar-detail',
                'request' => [
                    'allow_redirects' => true,
                    'headers' => [
                        'Authorization' => AuthTracker::info()->token['key']
                    ],
                    'form_params' => [
                        'nomor_peserta' => $nomor_peserta
                    ]
                ]
            ];
            $response_validasi_produk = Guzzle::request($validasi_produk);

            if ($response_validasi_produk['data']['kode_produk'] != AuthTracker::info()->users['kode_produk']) {
                $result_book[] = [
                    'seat' => $val['seat'],
                    'message' => 'Tanggal penerbangan tidak sama',
                    'status' => 'error'
                ];
            }

            /**
            * END
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
                        'nomor_peserta' => $nomor_peserta,
                        'pin' => $val['pin']
                    ]
                ]
            ];
            $response_pin = Guzzle::request($pin);

            if ($response_pin['data']) {
                $param = [
                    'method' => 'POST',
                    'url' => 'pesawat/transaksi',
                    'request' => [
                        'allow_redirects' => true,
                        'headers' => [
                            'Authorization' => AuthTracker::info()->token['key']
                        ],
                        'form_params' => [
                            'kode_kursi' => $val['seat'],
                            'nomor_peserta' => $nomor_peserta
                        ]
                    ]
                ];
                try {
                    $response = Guzzle::requestAsync($param);
                    if (isset($response['data']['id'])) {
                        $result_book[] = [
                            'seat' => $val['seat'],
                            'message' => 'Kursi pesawat berhasil dipilih',
                            'status' => 'success'
                        ];
                    } else {
                        $result_book[] = [
                            'seat' => $val['seat'],
                            'message' => 'Kursi Pesawat tidak dapat dipilih',
                            'error' => $response,
                            'status' => 'error'
                        ];
                    }
                } catch (\Exception $e) {
                    return $e->getMessage();
                }   
            } else {
                $result_book[] = [
                    'seat' => $val['seat'],
                    'message' => 'Pin Salah',
                    'status' => 'error'
                ];
            }
        }

        /**
         * Membuat pesan dan me rolback jika terjadi kesalahan pada input peserta pesawat
         * dan jika salah satu peserta tidak ikut maka otomatis akan di rollback juga
         */
        

        foreach ($result_book as $item) {
            if ($item['status'] == 'error') {
                $message['status'] = 'error';
            }
            $message[$item['seat']]['message'][] = $item['message'];
        }

        if (isset($message['status'])) {
            foreach ($input as $item) {
                $revert = [
                    'method' => 'POST',
                    'url' => 'pesawat/revert',
                    'request' => [
                        'allow_redirects' => true,
                        'headers' => [
                            'Authorization' => AuthTracker::info()->token['key']
                        ],
                        'form_params' => [
                            'nomor_peserta' => 'UMHPS'.$item['nomor_peserta'],
                            'kode_kursi' => $item['seat']
                        ]
                    ]
                ];
                $response_arr[] = Guzzle::requestAsync($revert);
            }
        }

        return redirect('kursi-pesawat');
    }
}

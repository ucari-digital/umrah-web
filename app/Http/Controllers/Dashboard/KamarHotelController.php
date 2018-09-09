<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cookie;
use App\Http\Controllers\Dashboard\MainDashboardController;
use App\Helper\AuthTracker;
use App\Helper\Guzzle;
class KamarHotelController extends Controller
{
	public function kamarHotelAvailabel(Request $request)
	{
		$param = [
            'method' => 'POST',
            'url' => 'hotel/get-kamar-availabel',
            'request' => [
                'allow_redirects' => true,
                'headers' => [
                    'Authorization' => AuthTracker::info()->token['key']
                ],
                'form_params' => [
                    'kode_hotel' => $request->kode_hotel,
                    'lantai' => $request->lantai,
                    'kode_produk' => AuthTracker::info()->users['kode_produk'],
                    'hotel' => $request->hotel
                ]
            ]
        ];
        return $response = Guzzle::requestAsync($param);	
	}

    public static function getHotel($lokasi)
    {
        $param = [
            'method' => 'POST',
            'url' => 'hotel/gethotel',
            'request' => [
                'allow_redirects' => true,
                'headers' => [
                    'Authorization' => AuthTracker::info()->token['key']
                ],
                'form_params' => [
                    'lokasi' => $lokasi,
                ]
            ]
        ];
        return $response = Guzzle::request($param);
    }

    public static function statusDetail()
    {
        $param = [
            'method' => 'POST',
            'url' => 'status/statusDetail',
            'request' => [
                'allow_redirects' => true,
                'headers' => [
                    'Authorization' => AuthTracker::info()->token['key']
                ],
                'form_params' => [
                    'nomor_peserta' => AuthTracker::info()->users['nomor_peserta'],
                    'nomor_transaksi' => AuthTracker::info()->users['nomor_transaksi']
                ]
            ]
        ];
        return $response = Guzzle::request($param);
    }

    public function index(Request $request)
    {
        $hotel = self::getHotel('madinah');
    	return view('dashboard.page.pemilihan_hotel')
        ->with('hotel', $hotel);
    }

    public function indexMekkah()
    {
        $total_user = count(MainDashboardController::getPesertaRoom());
        $akses_mekkah = self::statusDetail();
    	if ($akses_mekkah['status_hotel_mekkah']) {
            $session = MainDashboardController::getPesertaRoom();
            $peserta = [];
            foreach ($session as $user) {
                $peserta_detail = [
                    'method' => 'POST',
                    'url' => 'pendaftar/get-pendaftar-detail',
                    'request' => [
                        'allow_redirects' => true,
                        'headers' => [
                            'Authorization' => AuthTracker::info()->token['key']
                        ],
                        'form_params' => [
                            'nomor_peserta' => $user['nomor_peserta']
                        ]
                    ]
                ];
                $response_peserta_detail = Guzzle::requestAsync($peserta_detail);
                array_push($peserta, ['nama' => $response_peserta_detail['data']['nama'], 'nomor_peserta' => $response_peserta_detail['data']['nomor_peserta']]);
            }
	    	$hotel = self::getHotel('mekkah');

	    	return view('dashboard.page.pemilihan_hotel_mekkah')
            ->with('peserta', $peserta)
            ->with('total_user', $total_user)
	    	->with('hotel', $hotel);
    	} else {
    		return redirect('kamar-hotel');
    	}
    }

    public function checkAddUser(Request $request)
    {
        $param = [
            'method' => 'POST',
            'url' => 'status/akses-peserta-hotel',
            'request' => [
                'allow_redirects' => true,
                'headers' => [
                    'Authorization' => AuthTracker::info()->token['key']
                ],
                'form_params' => [
                    'nomor_peserta' => 'UMHPS'.$request->nomor_peserta,
                    'pin' => $request->pin
                ]
            ]
        ];
        $response = Guzzle::request($param);

        // menghandle kode_produk kosong
        if (!isset($response['msg']['kode_produk'])) {
            return $response;
        }

        if ($response['msg']['kode_produk'] != AuthTracker::info()->users['kode_produk']) {
            return [
                'data' => false,
            ];
        } else {
            return $response;
        }
    }

    /**
    * @var type = jenis suami istri atau group
    */
    public function postHotel(Request $request)
    {
    	// try {
            /**
            * Mengecek kalo gk ada inputan berarti ambil data nya dari session, di pake di hotel mekkah
            * knapa pake request peserta1 karena ini yang paling pertama jadi gk mungkin lewatin peserta2 sebelum ngelewain peserta1
            */
            if ($request->nomor_peserta1) {
                session(
                    [
                        'hotel' => [
                            'madinah_room' => $request->room
                        ],
                        'hotel_user' => [
                            'peserta1' => AuthTracker::info()->users['nomor_peserta'],
                            'peserta2' => 'UMHPS'.$request->nomor_peserta1,
                            'peserta3' => 'UMHPS'.$request->nomor_peserta2,
                            'peserta4' => 'UMHPS'.$request->nomor_peserta3
                        ]
                    ]
                );
            }

            $hotel_user_array = [];

            /**
            * push ke array hotel_user_array dan memvalidasi supaya UMHPS tidak masuk ke dalam array
            */
            for ($i=1; $i <= 4; $i++) { 
                if(session('hotel_user')["peserta".$i] != 'UMHPS'){
                    array_push($hotel_user_array, session('hotel_user')['peserta'.$i]);    
                }
            }

            $hotel_user = array_filter($hotel_user_array);

            $user_produk = [];
            $jumlah_peserta_keluarga = 1; //Menghitung jumlah keluarga yang valid haruslah 4 orang
            $jumlah_peserta_group = 1; //Menghitung jumlah group yang valid haruslah 4 orang
            foreach ($hotel_user as $item) {
                /**
                * Validasi untuk hanya yang memiliki produk sama
                */

                $user_validator = [
                    'method' => 'POST',
                    'url' => 'pendaftar/get-pendaftar-detail',
                    'request' => [
                        'allow_redirects' => true,
                        'headers' => [
                            'Authorization' => AuthTracker::info()->token['key']
                        ],
                        'form_params' => [
                            'nomor_peserta' => $item
                        ]
                    ]
                ];
                $response_user_validator = Guzzle::requestAsync($user_validator);

                /**
                * Menghilangkan User diri sendiri
                * jadi data yang di tamilkan hanya data peserta orang lain tanpa data diri kita
                */
                if (AuthTracker::info()->users['email'] != $response_user_validator['data']['email']) {

                    /**
                    * Jika Suami Istri
                    */

                    if ($request->type == 2) {
                        if (AuthTracker::info()->users['nip'] != $response_user_validator['data']['nip'] or AuthTracker::info()->users['jk'] == $response_user_validator['data']['jk']) {
                            return redirect()->action(
                                'Dashboard\AlertController@pemberitahuan', ['message' => 'hotel_book_failed', 'status' => 'failed', 'link' => 'hotel', 'custom_message' => 'Peserta bukan suami istri']
                            );
                        }
                    }

                    /**
                    * Jika Group
                    */

                    if ($request->type == 4) {
                        // Jika NIP sama semua maka bertanda ia satu keluarga
                        if (AuthTracker::info()->users['nip'] == $response_user_validator['data']['nip']) {
                            $jumlah_peserta_keluarga += 1;
                        }

                        // Jika JK sama semua maka bertanda ia satu group
                        if (AuthTracker::info()->users['jk'] == $response_user_validator['data']['jk']) {
                            $jumlah_peserta_group += 1;
                        }
                    }
                }

                array_push($user_produk, $response_user_validator);
                // if (AuthTracker::info()->users['kode_produk'] == $response_user_validator['data']['kode_produk']) {
                //     array_push($user_produk, true);
                // }
            }

            /**
            * Validasi jika seluruh keluarga lengkap
            * Jika @var jumlah_peserta_keluarga tidak sama dengan 4 orang maka dia tidak bisa memesan hotel
            */
            if($jumlah_peserta_keluarga > $jumlah_peserta_group){
                if ($jumlah_peserta_keluarga != 4) {
                    return redirect()->action(
                        'Dashboard\AlertController@pemberitahuan', ['message' => 'hotel_book_failed', 'status' => 'failed', 'link' => 'hotel', 'custom_message' => 'Peserta Keluarga tidak lengkap, kemungkinan ada peserta yang bukan berasal dari keluarga Anda']
                    );
                }
            }

            /**
            * Validasi jika seluruh group lengkap
            * Jika @var jumlah_peserta_group tidak sama dengan 4 orang maka dia tidak bisa memesan hotel
            */
            if($jumlah_peserta_group > $jumlah_peserta_keluarga){
                if ($jumlah_peserta_group != 4) {
                    return redirect()->action(
                        'Dashboard\AlertController@pemberitahuan', ['message' => 'hotel_book_failed', 'status' => 'failed', 'link' => 'hotel', 'custom_message' => 'Peserta Group tidak lengkap! Peserta group haruslah 4 orang. kemungkinan ada peserta yang bukan mahram yang Anda ikut sertakan.']
                    );
                }
            }

            /**
            * Aksi jika user produk nya tidak sama dan jumlah pengguna nya tidak sesuai suami istri atau rombongan
            */
            if (count($user_produk) != $request->type) {
                return redirect()->action(
                    'Dashboard\AlertController@pemberitahuan', ['message' => 'hotel_book_failed', 'status' => 'failed', 'link' => 'hotel', 'custom_message' => 'Peserta tidak lengkap']
                );
            }

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

            $hotel_validator = $hotel_user; // Membuat variable sementara
            if($response_pin['data']){
                /**
                * Pengecekan apakah user telah booking hotel atau belum
                */
                $akses_pilih_hotel = [];
                foreach ($hotel_validator as $item) {
                    $transaksi = [
                        'method' => 'POST',
                        'url' => 'transaksi/user-detail',
                        'request' => [
                            'allow_redirects' => true,
                            'headers' => [
                                'Authorization' => AuthTracker::info()->token['key']
                            ],
                            'form_params' => [
                                'nomor_peserta' => $item,
                                'status' => 'approved',
                                'result' => 'single'
                            ]
                        ]
                    ];
                    $response_transaksi = Guzzle::request($transaksi);

                    if ($response_transaksi) {
                        /**
                        * Mengecek apakah user sudah booking hote atau belum dengan API
                        */

                        $telah_pilih_hotel = [
                            'method' => 'POST',
                            'url' => 'hotel/get-hotel-user',
                            'request' => [
                                'allow_redirects' => true,
                                'headers' => [
                                    'Authorization' => AuthTracker::info()->token['key']
                                ],
                                'form_params' => [
                                    'nomor_transaksi' => $response_transaksi['nomor_transaksi']
                                ]
                            ]
                        ];
                        $response_telah_pilih_hotel = Guzzle::requestAsync($telah_pilih_hotel);
                        

                        if (!$response_telah_pilih_hotel[$request->hotel]) {
                            array_push($akses_pilih_hotel, true);
                        }
                    }
                }

                /**
                * Melakukan redirect jika user tidak sesuai dengan spesifikasi
                * suami istri haruslah 2 orang dan group 4 orang
                * jika tidak seperti kriteria di atas maka sintax di bawah ini akan redirect
                */

                if (count($akses_pilih_hotel) != $request->type) {
                    return redirect()->action(
                        'Dashboard\AlertController@pemberitahuan', ['message' => 'hotel_book_failed', 'status' => 'failed', 'link' => 'hotel', 'custom_message' => 'Salah satu peserta telah memilih hotel di '.$request->hotel]
                    );
                }

                /**
                * Memalukan Transaksi Hotel
                */

                $response_array = [];
                foreach ($hotel_user as $user) {
                    $transaksi = [
                        'method' => 'POST',
                        'url' => 'transaksi/user-detail',
                        'request' => [
                            'allow_redirects' => true,
                            'headers' => [
                                'Authorization' => AuthTracker::info()->token['key']
                            ],
                            'form_params' => [
                                'nomor_peserta' => $user,
                                'status' => 'approved',
                                'result' => 'single'
                            ]
                        ]
                    ];
                    $response_transaksi = Guzzle::request($transaksi);

                    if ($response_transaksi) {

            	    	$param = [
            	            'method' => 'POST',
            	            'url' => 'transaksi/hotel',
            	            'request' => [
            	                'allow_redirects' => true,
            	                'headers' => [
            	                    'Authorization' => AuthTracker::info()->token['key']
            	                ],
            	                'form_params' => [
            	                    'nomor_transaksi' => $response_transaksi['nomor_transaksi'],
                                    'kode_kamar' => $request->kode_kamar,
                                    'hotel' => $request->hotel,
            	                ]
            	            ]
            	        ];
            	        $response = Guzzle::requestAsync($param);

                        $peserta_detail = [
                            'method' => 'POST',
                            'url' => 'pendaftar/get-pendaftar-detail',
                            'request' => [
                                'allow_redirects' => true,
                                'headers' => [
                                    'Authorization' => AuthTracker::info()->token['key']
                                ],
                                'form_params' => [
                                    'nomor_peserta' => $user
                                ]
                            ]
                        ];
                        $response_peserta_detail = Guzzle::requestAsync($peserta_detail);

                        array_push($response_array, ['status' => $response, 'peserta' => $response_peserta_detail['data']]);
                    } else {
                        $peserta_detail = [
                            'method' => 'POST',
                            'url' => 'pendaftar/get-pendaftar-detail',
                            'request' => [
                                'allow_redirects' => true,
                                'headers' => [
                                    'Authorization' => AuthTracker::info()->token['key']
                                ],
                                'form_params' => [
                                    'nomor_peserta' => $user
                                ]
                            ]
                        ];
                        $response_peserta_detail = Guzzle::requestAsync($peserta_detail);
                        array_push($response_array, [ 'status' => ['status' => 200, 'msg' => 'peserta belum diverifikasi oleh Admin'], 'peserta' => $response_peserta_detail['data']]);
                    }
                }
            }
	        if ($response_pin['data']) {
            	// $response = Guzzle::requestAsync($param);
                // if ($response['status'] == 200) {
                    return view('dashboard.page.pemilihan_hotel_status')
                    ->with('status', $response_array);
                    // return redirect()->action(
                    //     'Dashboard\AlertController@pemberitahuan', ['message' => 'hotel_book_success', 'status' => 'success', 'link' => 'default']
                    // );
                // } else {
                //     return redirect()->action(
                //         'Dashboard\AlertController@pemberitahuan', ['message' => 'hotel_book_failed', 'status' => 'failed', 'link' => 'hotel']
                //     );
                // }
            } else {
            	return redirect()->action(
                    'Dashboard\AlertController@pemberitahuan', ['message' => 'pin_failed', 'status' => 'failed', 'link' => 'hotel']
                );
            }

    	// } catch (\Exception $e) {
    	// 	return redirect()->action(
     //            'Dashboard\AlertController@pemberitahuan', ['message' => 'error', 'status' => 'failed', 'link' => 'default']
     //        );
    	// }
    }
}

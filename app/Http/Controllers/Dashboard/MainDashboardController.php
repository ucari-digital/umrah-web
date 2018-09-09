<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Helper\Guzzle;
use App\Helper\AuthTracker;
class MainDashboardController extends Controller
{
	public static function getTanggalKeberangkatan()
	{
		$param = [
            'method' => 'POST',
            'url' => 'transaksi/tglkeberangkatan',
            'request' => [
                'allow_redirects' => true,
                'headers' => [
                    'Authorization' => AuthTracker::info()->token['key']
                ],
                'form_params' => [
                    'nomor_transaksi' => AuthTracker::info()->users['nomor_transaksi']
                ]
            ]
        ];

        $response = Guzzle::requestAsync($param);
        if ($response) {
            $return = $response;
        } else {
            $return = [];
            array_push($array, ['tanggal_keberangkatan' => '-']);
        }
        return $return;
	}

    public static function getUserHotel()
    {
        $param = [
            'method' => 'POST',
            'url' => 'hotel/get-hotel-user',
            'request' => [
                'allow_redirects' => true,
                'headers' => [
                    'Authorization' => AuthTracker::info()->token['key']
                ],
                'form_params' => [
                    'nomor_transaksi' => AuthTracker::info()->users['nomor_transaksi']
                ]
            ]
        ];

        $response = Guzzle::requestAsync($param);
        return $response;
    }

    public static function getReff()
    {
        $param = [
            'method' => 'POST',
            'url' => 'pendaftar/getpendaftarreff',
            'request' => [
                'allow_redirects' => true,
                'headers' => [
                    'Authorization' => AuthTracker::info()->token['key']
                ],
                'form_params' => [
                    'no_reff' => AuthTracker::info()->users['nomor_reff']
                ]
            ]
        ];

        $response = Guzzle::requestAsync($param);
        return $response;
    }

    public static function getPesertaRoom()
    {
        $param = [
            'method' => 'POST',
            'url' => 'hotel/get-hotel-group',
            'request' => [
                'allow_redirects' => true,
                'headers' => [
                    'Authorization' => AuthTracker::info()->token['key']
                ],
                'form_params' => [
                    'nomor_transaksi' => AuthTracker::info()->users['nomor_transaksi']
                ]
            ]
        ];

        $response = Guzzle::requestAsync($param);
        return $response;
    }

	public function getPesawatInformasi()
	{
		$param = [
            'method' => 'POST',
            'url' => '/pesawat/gettransaksi',
            'request' => [
                'allow_redirects' => true,
                'headers' => [
                    'Authorization' => AuthTracker::info()->token['key']
                ],
                'form_params' => [
                    'nomor_transaksi' => AuthTracker::info()->users['nomor_transaksi']
                ]
            ]
        ];

        $response = Guzzle::requestAsync($param);
        if ($response) {
            $return = $response;
        } else {
            $return = [];
            array_push($return, ['nama_pesawat' => 'Belum dipilih', 'kursi' => 'Belum dipilih']);
        }
        return $return;
	}

    public static function getFileUpload()
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
                    'nomor_transaksi' => AuthTracker::info()->users['nomor_transaksi']
                ]
            ]
        ];

        $response = Guzzle::requestAsync($param);
        return $response;
    }

	public function index()
	{
		$tanggal_keberangkatan = self::getTanggalKeberangkatan();
		$getPesawatInformasi = self::getPesawatInformasi();
        $getReff = self::getReff();
        $hotel_user = self::getUserHotel();
        $peserta_room = self::getPesertaRoom();
        $file_upload = self::getFileUpload();
		return view('dashboard.page.main_page')
        ->with('tanggal_keberangkatan', $tanggal_keberangkatan)
		->with('referral', $getReff)
		->with('getPesawatInformasi', $getPesawatInformasi)
        ->with('peserta_room', $peserta_room)
        ->with('file_upload', $file_upload)
        ->with('hotel', $hotel_user);
	}

    /**
    * Fitur cancel tranasksi
    */

    public function pesawatCancel()
    {
        try {
            $param = [
                'method' => 'POST',
                'url' => 'cancel/seat',
                'request' => [
                    'allow_redirects' => true,
                    'headers' => [
                        'Authorization' => AuthTracker::info()->token['key']
                    ],
                    'form_params' => [
                        'nomor_transaksi' => AuthTracker::info()->users['nomor_transaksi']
                    ]
                ]
            ];

            $response = Guzzle::requestAsync($param);

            if ($response['status'] == 200) {
                return redirect()->back();
            }
        } catch (\Exception $e) {
            return redirect()->action(
                'Dashboard\AlertController@pemberitahuan', ['message' => 'error', 'status' => 'failed', 'link' => 'default']
            );
        }
    }

    public function produkCancel()
    {
        try {
            $param = [
                'method' => 'POST',
                'url' => 'cancel/produk',
                'request' => [
                    'allow_redirects' => true,
                    'headers' => [
                        'Authorization' => AuthTracker::info()->token['key']
                    ],
                    'form_params' => [
                        'nomor_transaksi' => AuthTracker::info()->users['nomor_transaksi']
                    ]
                ]
            ];

            $response = Guzzle::requestAsync($param);

            if ($response['status'] == 200) {
                return redirect()->back();
            }
        } catch (\Exception $e) {
            return redirect()->action(
                'Dashboard\AlertController@pemberitahuan', ['message' => 'error', 'status' => 'failed', 'link' => 'default']
            );
        }
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Hash;
// 3Rd
use App\Helper\AuthTracker;
use App\Helper\Guzzle;
use GeniusTS\HijriDate\Date as Hijriah;
use App\Model\Departemen;
class RegisterController extends Controller
{

    public static function nomor_peserta()
    {
        $tahun_hijriah_system = Hijriah::now();
        $tahun_hijriah = substr($tahun_hijriah_system->format('Y'), 2, 2);
        $nomor_peserta = $tahun_hijriah.rand(00000,99999);

        $pelengkap = str_split($nomor_peserta);

        $counter = 0;
        foreach ($pelengkap as $item) {
            $counter += $item;
        }

        $pelengkap_step2 = str_split($counter);
        $counter_step2 = 0;
        foreach ($pelengkap_step2 as $item) {
            $counter_step2 += $item;
        }

        $pelengkap_step3 = str_split($counter_step2);
        $counter_step3 = 0;
        foreach ($pelengkap_step3 as $item) {
            $counter_step3 += $item;
        }
        

        $angka_terakhir = $counter_step3;
        $angka_key = 8 - $angka_terakhir;

        if ($angka_key < 0) {
            $angka_key = 0;
        }

        return [
            'value' => $nomor_peserta,
            'counter' => $counter,
            'counter_step2' => $counter_step2,
            'counter_step3' => $counter_step3,
            'angka_terakhir' => $angka_terakhir,
            'pelengkap' => $angka_key,
            'nomor_peserta' => $nomor_peserta.$angka_key 
        ];

    }

    public static function getPerusahaan()
    {
        $param = [
            'method' => 'GET',
            'url' => 'perusahaan/getperusahaan',
            'request' => [
                'allow_redirects' => true,
                'headers' => [
                    'Authorization' => AuthTracker::info()->token['key']
                ]
            ]
        ];

        $response = Guzzle::request($param);
        return $response;
    }

    public static function bank()
    {
        $param = [
            'method' => 'GET',
            'url' => 'bank/data',
            'request' => [
                'allow_redirects' => true,
                'headers' => [
                    'Authorization' => AuthTracker::info()->token['key']
                ]
            ]
        ];

        $response = Guzzle::request($param);
        return $response;
    }

    public static function travel()
    {
        $param = [
            'method' => 'GET',
            'url' => 'travel/data',
            'request' => [
                'allow_redirects' => true,
                'headers' => [
                    'Authorization' => AuthTracker::info()->token['key']
                ]
            ]
        ];

        $response = Guzzle::request($param);
        return $response;
    }

    public function postRegister(Request $request)
    {
        try {
            if ($request->noreff) {
                $noreff = $request->noreff;
            } else {
                $noreff = random_int(10000000,99999999);
            }
            $token_app = TokenController::getTokenApp();

            $param = [
                'method' => 'POST',
                'url' => 'register',
                'request' => [
                    'allow_redirects' => true,
                    'headers' => [
                        'Authorization' => $token_app['data']['token']
                    ],
                    'form_params' => [
                        'nama' => $request->nama,
                        'jk' => $request->jk,
                        'email' => $request->email,
                        'telephone' => '62'.$request->telephone,
                        'nik' => $request->nik,
                        'kode_perusahaan' => $request->kode_perusahaan,
                        'nip' => $request->nip,
                        'departemen' => $request->departemen,
                        'jabatan' => $request->jabatan,
                        'password' => $request->password,
                        'no_reff' => $noreff,
                        'hubungan_keluarga' => $request->hub_keluarga,
                        'kode_bank' => $request->bank,
                        'kode_travel' => $request->travel,
                        'nomor_peserta' => 'UMHPS'.self::nomor_peserta()['nomor_peserta']
                    ]
                ]
            ];

            $response = Guzzle::request($param);

            /**
            * Validasi jenis error email atau telephone
            */
            if (str_contains($response['msg'], ['SQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry', "for key 'email unique'"])) {
                $custom_message = 'Email tidak bisa digunakan';
            } else {
                $custom_message = false;
            }

            if (str_contains($response['msg'], ['SQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry', "key 'telephone unique'"])) {
                $custom_message = 'No. Telp tidak bisa digunakan';
            } else {
                $custom_message = false;
            }
            // END

            if ($response['status'] == 200) {
                return redirect()->action(
                    'Dashboard\AlertController@pemberitahuan', ['message' => 'register_success', 'status' => 'success', 'link' => 'login']
                );
            } else {
                if($custom_message){
                    return redirect()->action(
                        'Dashboard\AlertController@pemberitahuan', ['message' => 'register_failed', 'status' => 'failed', 'link' => 'register', 'custom_message' => $custom_message]
                    );
                } else {
                    return redirect()->action(
                        'Dashboard\AlertController@pemberitahuan', ['message' => 'register_failed', 'status' => 'failed', 'link' => 'register']
                    );
                }
            }
        } catch (\Exception $e) {
            return redirect()->action(
                'Dashboard\AlertController@pemberitahuan', ['message' => 'register_failed', 'status' => 'failed', 'link' => 'register']
            );
        }
    }

    public function register()
    {
        $perusahaan = self::getPerusahaan();

        $bank = collect(self::bank()['data']);
        $bank = $bank->sortBy('nama_bank');
        $bank = $bank->values()->all();

        $travel = collect(self::travel()['data']);
        $travel = $travel->sortBy('nama_travel');
        $travel = $travel->values()->all();

        $departemen = collect(Departemen::all());
        $departemen = $departemen->sortBy('departemen');
        return view('auth.register')
        ->with('perusahaan', $perusahaan)
        ->with('bank', $bank)
        ->with('travel', $travel)
        ->with('departemen', $departemen);
    }
}

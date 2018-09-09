<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\TokenController;
// Helper
use App\Helper\Guzzle;
use App\Helper\AuthTracker;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        try {
            $token_app = TokenController::getTokenApp();
            $param = [
                'method' => 'POST',
                'url' => 'login',
                'request' => [
                    'allow_redirects' => true,
                    'headers' => [
                        'Authorization' => $token_app['data']['token'],
                        'x-ephone'      => $request->ephone,
                        'x-password'    => $request->password
                    ]
                ]
            ];

            $response = Guzzle::request($param);
            if ($response['data']) {
                $response_array = [
                    'token' => $response['data']['token'],
                    'generate' => $response['data']['generate'],
                    'expired' => $response['data']['expired'],
                    'id' => $response['data']['user']['id'],
                    'nomor_pendaftar' => $response['data']['user']['nomor_pendaftar'],
                    'nomor_peserta' => $response['data']['user']['nomor_peserta'],
                    'nomor_transaksi' => $response['data']['user']['nomor_transaksi'],
                    'nomor_reff' => $response['data']['user']['no_reff'],
                    'kode_produk' => $response['data']['user']['kode_produk'],
                    'nama' => $response['data']['user']['nama'],
                    'kode_perusahaan' => $response['data']['user']['kode_perusahaan'],
                    'email' => $response['data']['user']['email'],
                    'telephone' => $response['data']['user']['telephone'],
                    'jk' => $response['data']['user']['jk'],
                    'nip' => $response['data']['user']['nip'],
                    'nik' => $response['data']['user']['nik'],
                    'status' => $response['data']['user']['status'],
                    'foto' => $response['data']['user']['foto']
                ];
                AuthTracker::set($response_array);
            }
            if (AuthTracker::login()) {
                return redirect('/dashboard');
            } else {
                return redirect('login')->with('status', 'failed');
            }
        } catch (\Exception $e) {
            // return $e->getMessage();
            return redirect()->action(
                'Dashboard\AlertController@pemberitahuan', ['message' => 'error', 'status' => 'failed', 'link' => 'login']
            );
        }
        
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect('/');
    }

    public function session()
    {
        return (array) AuthTracker::info();
    }
}

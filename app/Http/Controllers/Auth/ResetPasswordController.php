<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use App\Helper\AuthTracker;
use App\Helper\Guzzle;
class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
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
        $this->middleware('guest');
    }

    public function resetPasswordCheck(Request $request)
    {
        return view('auth.reset_password_check');
    }

    public function resetPasswordCheckSSend(Request $request)
    {
        try {
            $param = [
                'method' => 'POST',
                'url' => 'auth/reset-password-validation',
                'request' => [
                    'allow_redirects' => true,
                    'headers' => [
                        'Authorization' => AuthTracker::info()->token['key']
                    ],
                    'form_params' => [
                        'phone' => $request->ephone,
                    ]
                ]
            ];

            $response = Guzzle::request($param);
            if ($response['data'] == false) {
                return redirect('reset-password-check')->with('status', 'failed');
            } else {
                return redirect('reset-password-pin');
            }
        } catch (\Exception $e) {
            return redirect()->action(
                'Dashboard\AlertController@pemberitahuan', ['message' => 'error', 'status' => 'failed', 'link' => 'default']
            );
        }
    }

    public function resetPasswordPin()
    {
        return view('auth.reset_password_pin');
    }

    public function resetPasswordPinSend(Request $request)
    {
        try {
            $param = [
                'method' => 'POST',
                'url' => 'auth/reset-password-pin',
                'request' => [
                    'allow_redirects' => true,
                    'headers' => [
                        'Authorization' => AuthTracker::info()->token['key']
                    ],
                    'form_params' => [
                        'pin' => $request->pin
                    ]
                ]
            ];

            $response = Guzzle::requestAsync($param);
            if ($response['data'] == false) {
                return redirect('reset-password-pin')->with('status', 'failed');
            } else {
                return redirect('reset-password/'.$request->pin);
            }
        } catch (\Exception $e) {
            return redirect()->action(
                'Dashboard\AlertController@pemberitahuan', ['message' => 'error', 'status' => 'failed', 'link' => 'default']
            );
        }
    }

    public function resetPassword()
    {
        return view('auth.reset_password');
    }

    public function resetPasswordSend(Request $request, $pin)
    {
        $param = [
            'method' => 'POST',
            'url' => 'auth/reset-password',
            'request' => [
                'allow_redirects' => true,
                'headers' => [
                    'Authorization' => AuthTracker::info()->token['key']
                ],
                'form_params' => [
                    'pin' => $pin,
                    'password' => $request->password
                ]
            ]
        ];

        $response = Guzzle::requestAsync($param);

        if ($response) {
            return redirect()->action(
                'Dashboard\AlertController@pemberitahuan', ['message' => 'reset_password_success', 'status' => 'success', 'link' => 'login']
            );
        }
    }
}

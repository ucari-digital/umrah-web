<?php

namespace App\Http\Controllers\Main;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Helper\Guzzle;
class MainController extends Controller
{
    public function Main(Request $request)
    {
        /**
        * mengambil nama perusahaan menggunakan url terakhir
        */
        $urlArray = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $segments = explode('/', $urlArray);
        $numSegments = count($segments); 
        $currentSegment = $segments[$numSegments - 1];

    	$param = [
            'method' => 'POST',
            'url' => 'perusahaan-search',
            'request' => [
                'allow_redirects' => true,
                'form_params' => [
                	'domain' => $currentSegment
                ]
            ]
        ];
        $response = Guzzle::requestAsync($param);

        session(['brand' => $response]);
        // return session('brand');

        if ($response) {
            return view('index');
            if (request('logister') == 'register') {
                return redirect()->to('register');
            } else if(request('logister') == 'login'){
                return redirect()->to('login');
            } else {
               return view('index');
            }
        } else {
            if ($currentSegment) {
                return redirect()->back();
            } else {
                return view('single-page');
            }
        }
    }
}

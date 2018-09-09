<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JamaahReffController extends Controller
{
	public function index()
	{
		return view('dashboard.page.jamaah_reff');
	}
}

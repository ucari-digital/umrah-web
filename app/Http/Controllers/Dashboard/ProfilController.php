<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Pendaftar;
use App\Helper\AuthTracker;
use Hash;
class ProfilController extends Controller
{
    public function index()
    {
    	$data = Pendaftar::where('nomor_pendaftar', AuthTracker::info()->users['nomor_pendaftar'])->first();
    	return view('dashboard.page.profil', compact('data'));
    }

    public function saveProfil(Request $request, $np)
    {
    	try {
    		if ($request->password) {
    			Pendaftar::where('nomor_pendaftar', $np)->update([
	    			'nip' => $request->nip,
	    			'departemen' => $request->departemen,
	    			'jabatan' => $request->jabatan,
	    			'password' => Hash::make($request->password)
	    		]);
    		} else {
	    		Pendaftar::where('nomor_pendaftar', $np)->update([
	    			'nip' => $request->nip,
	    			'departemen' => $request->departemen,
	    			'jabatan' => $request->jabatan
	    		]);
    		}
    		return redirect()->back()
    		->with('status', 'success')
    		->with('message', 'Profil berhasil dirubah');
    	} catch (\Exception $e) {
    		return redirect()->back()
    		->with('status', 'failed')
    		->with('message', $e->getMessage());
    	}
    }
}

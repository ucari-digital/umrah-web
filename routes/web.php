<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'Main\MainController@Main');

// Auth
Route::get('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout');
Route::get('register', 'Auth\RegisterController@register');
Route::get('reset-password-check', 'Auth\ResetPasswordController@resetPasswordCheck');
Route::post('reset-password-check/send', 'Auth\ResetPasswordController@resetPasswordCheckSSend');
Route::get('reset-password-pin', 'Auth\ResetPasswordController@resetPasswordPin');
Route::post('reset-password-pin/send', 'Auth\ResetPasswordController@resetPasswordPinSend');
Route::get('reset-password/{pin}', 'Auth\ResetPasswordController@resetPassword');
Route::post('reset-password/{pin}/send', 'Auth\ResetPasswordController@resetPasswordSend');
Route::get('splash_upload_dokumen', 'Dashboard\UploadDokumenController@splashUploadDokumen');
Route::post('api/dokumen/upload/{field}/{table?}', 'Dashboard\UploadDokumenController@postDokumen');

// Page Alert
Route::get('pemberitahuan', 'Dashboard\AlertController@pemberitahuan');
Route::group(['middleware' => ['Auth', 'dokumen']], function(){
	
	// Dashboard
	Route::get('dashboard', 'Dashboard\MainDashboardController@index');
	Route::get('tanggal-berangkat', 'Dashboard\TanggalBerangkatController@index');
	Route::get('kursi-pesawat', 'Dashboard\KursiPesawatController@index');
	Route::get('kursi-pesawat-form', 'Dashboard\KursiPesawatController@form');
	Route::get('kamar-hotel', 'Dashboard\KamarHotelController@index');
	Route::get('kamar-hotel-mekkah', 'Dashboard\KamarHotelController@indexMekkah');
	Route::get('profil', 'Dashboard\ProfilController@index');
	Route::post('profil/save/{np}', 'Dashboard\ProfilController@saveProfil');

	Route::get('upload-dokumen', 'Dashboard\UploadDokumenController@index');
	Route::get('upload-bukti-pembayaran', 'Dashboard\UploadBuktiPembayaranController@index');

	// Pendaftaran Jamaah Reff
	// ROute::get('jamaah/reff', 'Dashboard\JamaahReffController@index');
	
	/**
	* API
	*/
	Route::prefix('api')->group(function () {
		// PESAWAT
		Route::post('pesawat/availabel-seat', 'Dashboard\KursiPesawatController@availabelSeat');
		Route::post('pesawat/book-seat', 'Dashboard\KursiPesawatController@bookSeat');

		// Paket Umrah
		Route::post('umrah/jadwal', 'Dashboard\TanggalBerangkatController@getTglUmrah');
		Route::post('umrah/book', 'Dashboard\TanggalBerangkatController@postTglBerangkat');

		// Hotel
		Route::post('hotel/book', 'Dashboard\KamarHotelController@postHotel'); //Madinah
		Route::post('hotel/check-add-user', 'Dashboard\KamarHotelController@checkAddUser');
		Route::post('hotel/get-hotel-availabel', 'Dashboard\KamarHotelController@kamarHotelAvailabel');
		Route::get('cc', function(){
			return session('users');
		});

		// Dokumen
		Route::post('dokumen/upload/{field}/', 'Dashboard\UploadDokumenController@postDokumen');

		// Pembayaran
		Route::post('bukti-pembayaran/upload/', 'Dashboard\UploadBuktiPembayaranController@postPembayaran');

		// Auth
		Route::post('check-pin', 'Auth\TokenController@checkPin');

		// Cancel Transaksi
		Route::get('cancel/pesawat', 'Dashboard\MainDashboardController@pesawatCancel');
		Route::get('cancel/produk', 'Dashboard\MainDashboardController@produkCancel');

	});
});

Route::prefix('api')->group(function () {
	// Login
	Route::post('login', 'Auth\LoginController@postLogin');

	// Register
	Route::post('register', 'Auth\RegisterController@postRegister');

	// Session
	Route::get('session', 'Auth\LoginController@session');

});
Route::get('hijri', 'Auth\RegisterController@nomor_peserta');

Route::get('{subdomain}', 'Main\MainController@Main');

Route::get('hash-make', function() {
	return Hash::make('abc');
});

<?php
namespace App\Helper;

use GuzzleHttp\Client;
class AuthTracker
{
	public static function set($param)
	{
		session([
			'users' => [
				'id' => $param['id'],
				'nomor_pendaftar' => $param['nomor_pendaftar'],
				'nomor_peserta' => $param['nomor_peserta'],
				'nomor_transaksi' => $param['nomor_transaksi'],
				'kode_produk' => $param['kode_produk'],
				'nomor_reff' => $param['nomor_reff'],
				'nama' => $param['nama'],
				'kode_perusahaan' => $param['kode_perusahaan'],
				'email' => $param['email'],
				'telephone' => $param['telephone'],
				'jk' => $param['jk'],
				'nip' => $param['nip'],
				'nik' => $param['nik'],
				'status' => $param['status'],
				'foto' => $param['foto']
			],
			'token' => [
				'key' => $param['token'],
				'generate' => $param['generate'],
				'expired' => $param['expired']
			]
		]);
	}

	public static function login()
	{
		if (isset(session('token')['key'])) {
			return true;
		} else {
			return false;
		}
	}

	public static function info()
	{
		return (object) [
			'users' => session('users'),
			'token' => session('token')
		];
	}
}
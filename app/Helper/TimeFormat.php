<?php
namespace App\Helper;

class TimeFormat
{
	public static function bulan($time)
	{
		if ($time) {
			$bulan = substr($time, 5, 2);
		} else {
			$bulan = null;
		}
		// kondisi bulan
		if ($bulan == '01') {
			return 'Januari';
		}

		if ($bulan == '02') {
			return 'Februari';
		}

		if ($bulan == '03') {
			return 'Maret';
		}

		if ($bulan == '04') {
			return 'April';
		}

		if ($bulan == '05') {
			return 'Mei';
		}

		if ($bulan == '06') {
			return 'Juni';
		}

		if ($bulan == '07') {
			return 'Juli';
		}

		if ($bulan == '08') {
			return 'Agustus';
		}

		if ($bulan == '09') {
			return 'September';
		}

		if ($bulan == '10') {
			return 'Oktober';
		}

		if ($bulan == '11') {
			return 'November';
		}

		if ($bulan == '12') {
			return 'Desember';
		}

	}

	public static function hari($time)
	{
		$date = date("N", strtotime($time));

		$date_array = [
			'null',
			'Senin',
			'Selasa',
			'Rabu',
			'Kamis',
			'Jumat',
			'Sabtu',
			'Minggu'
		];
		return $date_array[$date];
	}

	public static function timeId($time)
	{
		$hari = self::hari($time);
		$tanggal = substr($time, 8, 2);
		$bulan = self::bulan($time);
		$tahun = substr($time, 0, 4);

		return $hari.', '.$tanggal.' '.$bulan.' '.$tahun;
	}

	public static function formatId($time)
	{
		$tahun = substr($time, 0, 4);
		$tanggal = substr($time, 8, 2);
		$bulan = self::bulan($time);
		return $tanggal.' '.$bulan.' '.$tahun;
	}
}
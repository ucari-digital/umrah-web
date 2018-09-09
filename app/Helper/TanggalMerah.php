<?php
namespace App\Helper;

class TanggalMerah
{
	public static function libur()
	{
		$array = [
			'2018-05-06',
			'2018-05-13',
			'2018-05-20',
			'2018-05-27',
			'2018-06-03',
			'2018-06-10',
			'2018-06-17',
			'2018-06-24',
			'2018-07-01',
			'2018-07-08',
		];

		$array_data = [];

		foreach ($array as $data) {
			$json_data = [
				'start' => $data,
	        	'overlap' => false,
	        	'rendering' => 'background',
	        	'color' => 'rgba(244, 67, 54, 0.1)',
			];
			array_push($array_data, $json_data);
		}
		return $array_data;
	}
}
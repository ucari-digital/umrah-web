<?php
namespace App\Helper;
use App\Http\Controllers\Dashboard\AlertController;
class DirectPage
{
	public function alert($message, $status, $url)
	{
		if ($url == '') {
			$link = 'dashboard';
		} else {
			$link = $url;
		}
		$param = [
			'message' => $message,
			'status' => $status,
			'link' => $link
		];
		return AlertController::pemberitahuan($param);
	}
}
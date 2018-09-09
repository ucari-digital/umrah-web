<?php
namespace App\Helper;

class Validator
{
	public static function null($param, $default = null)
	{
		if (!empty($param)) {
			return $param;
		} else {
			if (!empty($default)) {
				return $default;
			} else {
				return '';
			}
		}
	}
}
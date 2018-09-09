<?php
namespace App\Helper;

class Str
{
	public static function rmUMHPS($string)
	{
		return str_replace('UMHPS', '', $string);
	}
}
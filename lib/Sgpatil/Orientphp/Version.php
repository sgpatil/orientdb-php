<?php
namespace Sgpatil\Orientphp;

/**
 * Current library version
 */
class Version
{
	const CURRENT = '0.1.0';

	public static function userAgent()
	{
		return 'orintdb-php/'.self::CURRENT;
	}
}

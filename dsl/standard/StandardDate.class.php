<?php
namespace dsl\standard;

use dsl\context\BaseScriptableObject;

class StandardDate extends BaseScriptableObject
{
	/**
	 * Date.now()
	 *
	 * milliseconds since 1970.
	 *
	 * @return int
	 */
	public function now() {

		return floor(microtime(true) * 1000);
	}


	/**
	 * @param int $year year
	 * @param int $month month 0-based
	 * @param int $day day of month
	 * @param int $hour hour
	 * @param int $minute minute
	 * @param int $second second
	 * @return Date
	 */
	public function __invoke( $year = 0,$month = 0,$day = 0,$hour = 0,$minute = 0,$second = 0 )
	{
		if  ( is_string($year) )
			return new Date( strtotime($year) );

		if   ( is_numeric($year) && $year && !$month )
			return new Date( floor($year/1000) );

		$month++; // month in JS is 0-based, but in PHP 1-based.

		if   ( is_numeric($year) && $year )
			return new Date( mktime( $hour, $minute, $second, $month, $day, $year ) );

		return new Date();
	}

	/**
	 * Gets the current date object.
	 * @return Date
	 */
	public function getDate( $date = null ) {

		return new Date( $date );
	}



	public function __toString()
	{
		return "Date";
	}

	public function help()
	{
		return Helper::getHelp($this);
	}


	public function parse( $dateAsString ) {

		return strtotime( $dateAsString ) * 1000;
	}
}
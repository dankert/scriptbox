<?php


namespace dsl\standard;


use dsl\context\BaseScriptableObject;

class StandardString extends BaseScriptableObject
{
	private $value;

	/**
	 * Number constructor.
	 * @param $value
	 */
	public function __construct($value)
	{
		$this->value = $value;
	}

	public function __toString()
	{
		return $this->value;
	}


	public function __invoke( $value )
	{
		return new StandardString( $value );
	}


	public function split( $splitChar = null ) {
		if   ( $splitChar == '' )
			return str_split( $this->value );
		if   ( $splitChar == null )
			return array( $this->value );

		return explode( $splitChar, $this->value );
	}


	public function trim() {

	}
	public function trimEnd() {

	}
	public function trimStart() {

	}
	public function valueOf() {

	}
	public function charAt() {

	}
	public function concat() {

	}
	public function endsWith() {

	}
	public function indexOf() {

	}
	public function lastIndexOf() {

	}
	public function padEnd( $length,$pad=null) {

	}
	public function padStart($length,$pad=null) {

	}
	public function repeat( $cound) {

	}
	public function replace() {

	}
	public function replaceAll() {

	}
	public function slice( $begin,$end=null) {

	}
	public function startsWith($search) {

	}
	public function substring( $start,$end) {

	}
	public function toLowerCase() {

	}
	public function toUpperCase() {

	}

}
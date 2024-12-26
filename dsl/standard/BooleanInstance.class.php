<?php


namespace dsl\standard;


use dsl\context\BaseScriptableObject;

class BooleanInstance extends BaseScriptableObject
{
	private $value;

	/**
	 * Number constructor.
	 * @param $value
	 */
	public function __construct($value)
	{
		$this->value = boolval($value);
	}

	public function __toString()
	{
		return $this->value?'true':'false';
	}


	public function __invoke( $value )
	{
		return new BooleanInstance( $value );
	}
	public function length()
	{
		return 1;
	}

}
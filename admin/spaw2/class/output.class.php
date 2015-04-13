<?php

/**
 * SpawOutput
 * 
 * @package   
 * @author VBA
 * @copyright Nguyen Anh Tu
 * @version 2009
 * @access public
 */
class SpawOutput
{

	/**
	 * SpawOutput::buf()
	 * 
	 * @return
	 */
	function &buf()
	{
		static $buf;

		return $buf;
	}

	/**
	 * SpawOutput::add()
	 * 
	 * @param mixed $name
	 * @param mixed $code
	 * @return
	 */
	function add( $name, $code )
	{
		$buf = &SpawOutput::buf();
		$buf[$name] = $code;
	}

	/**
	 * SpawOutput::get()
	 * 
	 * @return
	 */
	function get()
	{
		$buf = &SpawOutput::buf();
		$str_buf = '';
		foreach ( $buf as $code )
		{
			$str_buf .= $code . "\r\n";
		}
		return $str_buf;
	}


	/**
	 * SpawOutput::show()
	 * 
	 * @return
	 */
	function show()
	{
		echo SpawOutput::get();
	}
}

?>
<?php

require_once ( str_replace('\\\\', '/', dirname(__file__)) . '/config.class.php' );

/**
 * SpawLang
 * 
 * @package   
 * @author VBA
 * @copyright Nguyen Anh Tu
 * @version 2009
 * @access public
 */
class SpawLang
{

	var $lang;

	/**
	 * SpawLang::setLang()
	 * 
	 * @param mixed $value
	 * @return
	 */
	function setLang( $value )
	{
		$this->lang = $value;
	}

	/**
	 * SpawLang::getLang()
	 * 
	 * @return
	 */
	function getLang()
	{
		return $this->lang;
	}


	var $module;

	/**
	 * SpawLang::setModule()
	 * 
	 * @param mixed $value
	 * @return
	 */
	function setModule( $value )
	{
		$this->module = $value;
	}

	/**
	 * SpawLang::getModule()
	 * 
	 * @return
	 */
	function getModule()
	{
		return $this->module;
	}


	var $block;

	/**
	 * SpawLang::setBlock()
	 * 
	 * @param mixed $value
	 * @return
	 */
	function setBlock( $value )
	{
		$this->block = $value;
	}

	/**
	 * SpawLang::getBlock()
	 * 
	 * @return
	 */
	function getBlock()
	{
		return $this->block;
	}


	var $charset;

	/**
	 * SpawLang::getCharset()
	 * 
	 * @return
	 */
	function getCharset()
	{
		return $this->charset;
	}

	var $output_charset;
	/**
	 * SpawLang::setOutputCharset()
	 * 
	 * @param mixed $value
	 * @return
	 */
	function setOutputCharset( $value )
	{
		$this->output_charset = $value;
	}
	/**
	 * SpawLang::getOutputCharset()
	 * 
	 * @return
	 */
	function getOutputCharset()
	{
		return $this->output_charset;
	}


	var $dir = 'ltr';

	/**
	 * SpawLang::getDir()
	 * 
	 * @return
	 */
	function getDir()
	{
		return $this->dir;
	}


	var $lang_data;


	var $en_lang_data;


	/**
	 * SpawLang::SpawLang()
	 * 
	 * @param string $lang
	 * @return
	 */
	function SpawLang( $lang = '' )
	{
		if ( $lang == '' )
		{

			$this->lang = SpawConfig::getStaticConfigValue( "default_lang" );
		}
		else
		{
			$this->lang = $lang;
		}

		$this->loadData( 'core' );
	}


	/**
	 * SpawLang::loadData()
	 * 
	 * @param mixed $module
	 * @return
	 */
	function loadData( $module )
	{
		$spaw_root = SpawConfig::getStaticConfigValue( "SPAW_ROOT" );

		if ( file_exists($spaw_root . 'plugins/' . $module . '/lib/lang/' . $this->lang . '.lang.inc.php') )
		{

			$filename = $spaw_root . 'plugins/' . $module . '/lib/lang/' . $this->lang . '.lang.inc.php';
		}
		else
		{

			$filename = $spaw_root . 'plugins/' . $module . '/lib/lang/en.lang.inc.php';
		}

		@include ( $filename );
		if ( $module == 'core' || empty($this->charset) )
		{
			$this->charset = $spaw_lang_charset;
			if ( ! empty($spaw_lang_direction) ) $this->dir = $spaw_lang_direction;
		}
		$this->lang_data[$module] = $spaw_lang_data;
		if ( $this->lang != 'en' )
		{

			$filename = $spaw_root . 'plugins/' . $module . '/lib/lang/en.lang.inc.php';
			@include ( $filename );
			$this->en_lang_data[$module] = $spaw_lang_data;
		}
		else
		{
			$this->en_lang_data[$module] = $spaw_lang_data;
		}
	}


	/**
	 * SpawLang::getMessage()
	 * 
	 * @param mixed $message
	 * @param string $block
	 * @param string $module
	 * @return
	 */
	function getMessage( $message, $block = '', $module = '' )
	{
		$_module = ( $module == '' ) ? $this->module : $module;
		$_block = ( $block == '' ) ? $this->block : $block;
		if ( empty($this->lang_data[$_module]) )
		{

			$this->loadData( $_module );
		}
		$msg = '';
		if ( ! empty($this->lang_data[$_module][$_block][$message]) )
		{
			$msg = $this->lang_data[$_module][$_block][$message];
		}
		else
			if ( ! empty($this->en_lang_data[$_module][$_block][$message]) )
			{
				$msg = $this->en_lang_data[$_module][$_block][$message];
			}
		if ( $msg != '' )
		{
			if ( SpawConfig::getStaticConfigValue("USE_ICONV") && isset($this->output_charset) && $this->charset != $this->output_charset )
			{

				$msg = iconv( $this->charset, $this->output_charset . '//IGNORE', $msg );
			}

			return $msg;
		}
		else
		{

			return '';
		}
	}


	/**
	 * SpawLang::m()
	 * 
	 * @param mixed $message
	 * @param string $block
	 * @param string $module
	 * @return
	 */
	function m( $message, $block = '', $module = '' )
	{
		return $this->getMessage( $message, $block, $module );
	}
}

?>
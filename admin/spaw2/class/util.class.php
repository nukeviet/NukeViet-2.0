<?php

/**
 * SpawVars
 * 
 * @package   
 * @author VBA
 * @copyright Nguyen Anh Tu
 * @version 2009
 * @access public
 */
class SpawVars
{
	/**
	 * SpawVars::getGetVar()
	 * 
	 * @param mixed $var_name
	 * @param string $empty_value
	 * @return
	 */
	function getGetVar( $var_name, $empty_value = '' )
	{
		global $HTTP_GET_VARS;
		if ( ! empty($_GET[$var_name]) ) return $_GET[$var_name];
		elseif ( ! empty($HTTP_GET_VARS[$var_name]) ) return $HTTP_GET_VARS[$var_name];
		else  return $empty_value;
	}


	/**
	 * SpawVars::getPostVar()
	 * 
	 * @param mixed $var_name
	 * @param string $empty_value
	 * @return
	 */
	function getPostVar( $var_name, $empty_value = '' )
	{
		global $HTTP_POST_VARS;
		if ( ! empty($_POST[$var_name]) ) return $_POST[$var_name];
		else
			if ( ! empty($HTTP_POST_VARS[$var_name]) ) return $HTTP_POST_VARS[$var_name];
			else  return $empty_value;
	}


	/**
	 * SpawVars::getFilesVar()
	 * 
	 * @param mixed $var_name
	 * @param string $empty_value
	 * @return
	 */
	function getFilesVar( $var_name, $empty_value = '' )
	{
		global $HTTP_POST_FILES;
		if ( ! empty($_FILES[$var_name]) ) return $_FILES[$var_name];
		else
			if ( ! empty($HTTP_POST_FILES[$var_name]) ) return $HTTP_POST_FILES[$var_name];
			else  return $empty_value;
	}


	/**
	 * SpawVars::getServerVar()
	 * 
	 * @param mixed $var_name
	 * @param string $empty_value
	 * @return
	 */
	function getServerVar( $var_name, $empty_value = '' )
	{
		global $HTTP_SERVER_VARS;
		if ( ! empty($_SERVER[$var_name]) ) return $_SERVER[$var_name];
		else
			if ( ! empty($HTTP_SERVER_VARS[$var_name]) ) return $HTTP_SERVER_VARS[$var_name];
			else  return $empty_value;
	}


	/**
	 * SpawVars::getSessionVar()
	 * 
	 * @param mixed $var_name
	 * @param string $empty_value
	 * @return
	 */
	function getSessionVar( $var_name, $empty_value = '' )
	{
		global $HTTP_SESSION_VARS;
		if ( ! empty($_SESSION[$var_name]) ) return $_SESSION[$var_name];
		else
			if ( ! empty($HTTP_SESSION_VARS[$var_name]) ) return $HTTP_SESSION_VARS[$var_name];
			else  return $empty_value;
	}


	/**
	 * SpawVars::setSessionVar()
	 * 
	 * @param mixed $var_name
	 * @param string $value
	 * @return
	 */
	function setSessionVar( $var_name, $value = '' )
	{
		global $HTTP_SESSION_VARS;
		if ( isset($_SESSION) ) $_SESSION[$var_name] = $value;
		else
			if ( isset($HTTP_SESSION_VARS) ) $HTTP_SESSION_VARS[$var_name] = $value;
	}


	/**
	 * SpawVars::stripSlashes()
	 * 
	 * @param mixed $var
	 * @return
	 */
	function stripSlashes( $var )
	{
		if ( get_magic_quotes_gpc() )
		{
			return stripslashes( $var );
		}
		return $var;
	}

}


define( "SPAW_AGENT_UNSUPPORTED", 0 );

define( "SPAW_AGENT_IE", 15 );

define( "SPAW_AGENT_GECKO", 240 );
define( "SPAW_AGENT_OPERA", 3840 );

define( "SPAW_AGENT_ALL", 65535 );


/**
 * SpawAgent
 * 
 * @package   
 * @author VBA
 * @copyright Nguyen Anh Tu
 * @version 2009
 * @access public
 */
class SpawAgent
{

	/**
	 * SpawAgent::getAgent()
	 * 
	 * @return
	 */
	function getAgent()
	{
		$result = SPAW_AGENT_UNSUPPORTED;
		$browser = SpawVars::GetServerVar( 'HTTP_USER_AGENT' );

		if ( eregi("MSIE[^;]*", $browser, $msie) )
		{

			if ( eregi("[0-9]+\.[0-9]+", $msie[0], $version) )
			{

				if ( (float)$version[0] >= 5.5 )
				{

					if ( ! eregi("opera", $browser) )
					{
						$result = SPAW_AGENT_IE;
					}
				}
			}
		} elseif ( ereg("Gecko/([0-9]*)", $browser, $build) )
		{

			if ( $build[1] > "20030312" ) $result = SPAW_AGENT_GECKO;
		} elseif ( eregi("Opera/([0-9]*)", $browser, $opera) )
		{
			if ( (float)$opera[1] >= 9 ) $result = SPAW_AGENT_OPERA;
		}
		return $result;
	}


	/**
	 * SpawAgent::getAgentName()
	 * 
	 * @return
	 */
	function getAgentName()
	{
		$result = '';
		switch ( SpawAgent::getAgent() )
		{
			case SPAW_AGENT_IE:
				$result = 'ie';
				break;
			case SPAW_AGENT_GECKO:
				$result = 'gecko';
				break;
			case SPAW_AGENT_OPERA:
				$result = 'opera';
				break;
			default:
				$result = '';
				break;
		}
		return $result;
	}
}

?>
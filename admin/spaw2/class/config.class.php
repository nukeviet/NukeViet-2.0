<?php

define( "SPAW_CFG_TRANSFER_NONE", 0 );

define( "SPAW_CFG_TRANSFER_JS", 1 );

define( "SPAW_CFG_TRANSFER_REQUEST", 2 );

define( "SPAW_CFG_TRANSFER_SECURE", 4 );


/**
 * SpawConfigItem
 * 
 * @package   
 * @author VBA
 * @copyright Nguyen Anh Tu
 * @version 2009
 * @access public
 */
class SpawConfigItem
{

	/**
	 * SpawConfigItem::SpawConfigItem()
	 * 
	 * @param mixed $name
	 * @param mixed $value
	 * @param mixed $transfer_type
	 * @return
	 */
	function SpawConfigItem( $name, $value, $transfer_type )
	{
		$this->name = $name;
		$this->value = $value;
		$this->transfer_type = $transfer_type;
	}

	var $name;

	var $value;

	var $transfer_type;
}


/**
 * SpawConfig
 * 
 * @package   
 * @author VBA
 * @copyright Nguyen Anh Tu
 * @version 2009
 * @access public
 */
class SpawConfig
{

	var $config;


	/**
	 * SpawConfig::SpawConfig()
	 * 
	 * @return
	 */
	function SpawConfig()
	{

		$this->config = SpawConfig::configVar();
	}


	/**
	 * SpawConfig::configVar()
	 * 
	 * @return
	 */
	function &configVar()
	{
		static $config;

		return $config;
	}


	/**
	 * SpawConfig::setStaticConfigItem()
	 * 
	 * @param mixed $name
	 * @param mixed $value
	 * @param mixed $transfer_type
	 * @return
	 */
	function setStaticConfigItem( $name, $value, $transfer_type = SPAW_CFG_TRANSFER_NONE )
	{
		$cfg = &SpawConfig::configVar();
		$cfg[$name] = new SpawConfigItem( $name, $value, $transfer_type );
	}


	/**
	 * SpawConfig::setConfigItem()
	 * 
	 * @param mixed $name
	 * @param mixed $value
	 * @param mixed $transfer_type
	 * @return
	 */
	function setConfigItem( $name, $value, $transfer_type = SPAW_CFG_TRANSFER_NONE )
	{
		$this->config[$name] = new SpawConfigItem( $name, $value, $transfer_type );
	}


	/**
	 * SpawConfig::getStaticConfigItem()
	 * 
	 * @param mixed $name
	 * @return
	 */
	function getStaticConfigItem( $name )
	{
		$cfg = &SpawConfig::configVar();
		if ( isset($cfg[$name]) ) return $cfg[$name];
		else  return null;
	}


	/**
	 * SpawConfig::getConfigItem()
	 * 
	 * @param mixed $name
	 * @return
	 */
	function getConfigItem( $name )
	{
		$cfg = $this->config;
		if ( isset($cfg[$name]) ) return $cfg[$name];
		else  return null;
	}


	/**
	 * SpawConfig::setStaticConfigValue()
	 * 
	 * @param mixed $name
	 * @param mixed $value
	 * @return
	 */
	function setStaticConfigValue( $name, $value )
	{
		$cfg_item = SpawConfig::getStaticConfigItem( $name );
		if ( $cfg_item )
		{
			$cfg_item->value = $value;
			SpawConfig::setStaticConfigItem( $cfg_item->name, $cfg_item->value, $cfg_item->transfer_type );
		}
	}

	/**
	 * SpawConfig::setStaticConfigValueElement()
	 * 
	 * @param mixed $name
	 * @param mixed $index
	 * @param mixed $value
	 * @return
	 */
	function setStaticConfigValueElement( $name, $index, $value )
	{
		$cfg_item = SpawConfig::getStaticConfigItem( $name );
		if ( $cfg_item && is_array($cfg_item->value) )
		{
			$cfg_item->value[$index] = $value;
			SpawConfig::setStaticConfigItem( $cfg_item->name, $cfg_item->value, $cfg_item->transfer_type );
		}
	}


	/**
	 * SpawConfig::setConfigValue()
	 * 
	 * @param mixed $name
	 * @param mixed $value
	 * @return
	 */
	function setConfigValue( $name, $value )
	{
		$cfg_item = $this->getConfigItem( $name );

		if ( $cfg_item )
		{
			$cfg_item->value = $value;
			$this->setConfigItem( $cfg_item->name, $cfg_item->value, $cfg_item->transfer_type );
		}
	}

	/**
	 * SpawConfig::setConfigValueElement()
	 * 
	 * @param mixed $name
	 * @param mixed $index
	 * @param mixed $value
	 * @return
	 */
	function setConfigValueElement( $name, $index, $value )
	{
		$cfg_item = $this->getConfigItem( $name );
		if ( $cfg_item && is_array($cfg_item->value) )
		{
			$cfg_item->value[$index] = $value;
			$this->setConfigItem( $cfg_item->name, $cfg_item->value, $cfg_item->transfer_type );
		}
	}


	/**
	 * SpawConfig::getStaticConfigValue()
	 * 
	 * @param mixed $name
	 * @return
	 */
	function getStaticConfigValue( $name )
	{
		$cfg_item = SpawConfig::getStaticConfigItem( $name );

		if ( $cfg_item ) return $cfg_item->value;
		else  return null;
	}

	/**
	 * SpawConfig::getStaticConfigValueElement()
	 * 
	 * @param mixed $name
	 * @param mixed $index
	 * @return
	 */
	function getStaticConfigValueElement( $name, $index )
	{
		$cfg_item = SpawConfig::getStaticConfigItem( $name );
		if ( $cfg_item && is_array($cfg_item->value) && ! empty($cfg_item->value[$index]) ) return $cfg_item->value[$index];
		else  return null;
	}


	/**
	 * SpawConfig::getConfigValue()
	 * 
	 * @param mixed $name
	 * @return
	 */
	function getConfigValue( $name )
	{
		$cfg_item = $this->getConfigItem( $name );

		if ( $cfg_item ) return $cfg_item->value;
		else  return null;
	}

	/**
	 * SpawConfig::getConfigValueElement()
	 * 
	 * @param mixed $name
	 * @param mixed $index
	 * @return
	 */
	function getConfigValueElement( $name, $index )
	{
		$cfg_item = $this->getConfigItem( $name );
		if ( $cfg_item && is_array($cfg_item->value) && ! empty($cfg_item->value[$index]) ) return $cfg_item->value[$index];
		else  return null;
	}

	/**
	 * SpawConfig::storeSecureConfig()
	 * 
	 * @return
	 */
	function storeSecureConfig()
	{
		$strcfg = '';
		$cfg = $this->config;
		$sec_cfg = array();
		$result = '';
		$stored_cfg = SpawVars::getSessionVar( "spaw_configs" );

		foreach ( $cfg as $key => $cfg_item )
		{
			if ( $cfg_item->transfer_type & SPAW_CFG_TRANSFER_SECURE )
			{
				$strcfg .= $key . serialize( $cfg_item );
				$sec_cfg[$key] = $cfg_item;
			}
		}
		if ( $strcfg != '' )
		{
			$result = md5( $strcfg );
			$stored_cfg[$result] = $sec_cfg;
			SpawVars::setSessionVar( "spaw_configs", $stored_cfg );
		}
		return $result;
	}


	/**
	 * SpawConfig::restoreSecureConfig()
	 * 
	 * @param mixed $scid
	 * @return
	 */
	function restoreSecureConfig( $scid )
	{
		$sec_cfg = SpawVars::getSessionVar( "spaw_configs" );
		if ( $sec_cfg != '' && is_array($sec_cfg[$scid]) )
		{
			foreach ( $sec_cfg[$scid] as $key => $cfg_item ) $this->setConfigItem( $cfg_item->name, $cfg_item->value, $cfg_item->transfer_type );
		}
	}
}

?>
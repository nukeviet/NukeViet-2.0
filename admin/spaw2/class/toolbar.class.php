<?php

require_once ( str_replace('\\\\', '/', dirname(__file__)) . '/util.class.php' );

define( "SPAW_TBI_IMAGE", "image" );

define( "SPAW_TBI_BUTTON", "button" );

define( "SPAW_TBI_DROPDOWN", "dropdown" );


/**
 * SpawTbItem
 * 
 * @package   
 * @author VBA
 * @copyright Nguyen Anh Tu
 * @version 2009
 * @access public
 */
class SpawTbItem
{
	var $module;

	var $name;
	var $agent;

	/**
	 * SpawTbItem::SpawTbItem()
	 * 
	 * @param mixed $module
	 * @param mixed $name
	 * @param mixed $agent
	 * @return
	 */
	function SpawTbItem( $module, $name, $agent = SPAW_AGENT_ALL )
	{
		$this->module = $module;
		$this->name = $name;
		$this->agent = $agent;
	}

	/**
	 * SpawTbItem::get()
	 * 
	 * @return
	 */
	function get()
	{

	}
}


/**
 * SpawTbImage
 * 
 * @package   
 * @author VBA
 * @copyright Nguyen Anh Tu
 * @version 2009
 * @access public
 */
class SpawTbImage extends SpawTbItem
{
	/**
	 * SpawTbImage::get()
	 * 
	 * @return
	 */
	function get()
	{

	}
}

/**
 * SpawTbButton
 * 
 * @package   
 * @author VBA
 * @copyright Nguyen Anh Tu
 * @version 2009
 * @access public
 */
class SpawTbButton extends SpawTbItem
{

	var $on_enabled_check;
	var $on_pushed_check;
	var $on_click;
	var $show_in_context_menu = false;

	/**
	 * SpawTbButton::SpawTbButton()
	 * 
	 * @param mixed $module
	 * @param mixed $name
	 * @param mixed $on_enabled_check
	 * @param mixed $on_pushed_check
	 * @param mixed $on_click
	 * @param mixed $agent
	 * @param bool $show_in_context_menu
	 * @return
	 */
	function SpawTbButton( $module, $name, $on_enabled_check, $on_pushed_check, $on_click, $agent = SPAW_AGENT_ALL, $show_in_context_menu = false )
	{
		parent::SpawTbItem( $module, $name, $agent );
		$this->on_enabled_check = $on_enabled_check;
		$this->on_pushed_check = $on_pushed_check;
		$this->on_click = $on_click;
		$this->show_in_context_menu = $show_in_context_menu;
	}
	/**
	 * SpawTbButton::get()
	 * 
	 * @return
	 */
	function get()
	{

	}
}

/**
 * SpawTbDropdown
 * 
 * @package   
 * @author VBA
 * @copyright Nguyen Anh Tu
 * @version 2009
 * @access public
 */
class SpawTbDropdown extends SpawTbItem
{

	var $data;

	var $on_enabled_check;
	var $on_status_check;
	var $on_change;

	/**
	 * SpawTbDropdown::SpawTbDropdown()
	 * 
	 * @param mixed $module
	 * @param mixed $name
	 * @param mixed $on_enabled_check
	 * @param mixed $on_status_check
	 * @param mixed $on_change
	 * @param string $data
	 * @param mixed $agent
	 * @return
	 */
	function SpawTbDropdown( $module, $name, $on_enabled_check, $on_status_check, $on_change, $data = '', $agent = SPAW_AGENT_ALL )
	{
		parent::SpawTbItem( $module, $name, $agent );
		if ( is_array($data) ) $this->data = $data;
		$this->on_enabled_check = $on_enabled_check;
		$this->on_status_check = $on_status_check;
		$this->on_change = $on_change;
	}
	/**
	 * SpawTbDropdown::get()
	 * 
	 * @return
	 */
	function get()
	{

	}
}

/**
 * SpawToolbar
 * 
 * @package   
 * @author VBA
 * @copyright Nguyen Anh Tu
 * @version 2009
 * @access public
 */
class SpawToolbar
{

	var $name;

	var $items;
	var $editor;

	/**
	 * SpawToolbar::SpawToolbar()
	 * 
	 * @param mixed $name
	 * @return
	 */
	function SpawToolbar( $name )
	{
		$this->name = $name;
		$this->items = array();
	}

	/**
	 * SpawToolbar::getToolbar()
	 * 
	 * @param mixed $name
	 * @return
	 */
	function getToolbar( $name )
	{
		$tb = new SpawToolbar( $name );
		$tb->loadData();
		return $tb;
	}

	/**
	 * SpawToolbar::loadData()
	 * 
	 * @return
	 */
	function loadData()
	{
		$pgdir = SpawConfig::getStaticConfigValue( "SPAW_ROOT" ) . 'plugins/';
		if ( is_dir($pgdir) )
		{
			if ( $dh = opendir($pgdir) )
			{
				while ( ($pg = readdir($dh)) !== false )
				{
					if ( file_exists($pgdir . $pg . '/lib/toolbars/' . $this->name . '.toolbar.php') )
					{

						include ( $pgdir . $pg . '/lib/toolbars/' . $this->name . '.toolbar.php' );
						if ( $pg != 'core' )
						{

							$this->items = array_merge( $this->items, $items );
						}
						else
						{

							$this->items = array_merge( $items, $this->items );
						}
						unset( $items );
					}
				}
				closedir( $dh );
			}
		}
	}

	/**
	 * SpawToolbar::renderToolbar()
	 * 
	 * @param mixed $prefix
	 * @param mixed $theme
	 * @return
	 */
	function renderToolbar( $prefix, $theme )
	{
		$js_res = '';
		$html_res = '';
		$pgdir = SpawConfig::getStaticConfigValue( "SPAW_DIR" ) . 'plugins/';
		$i = 0;
		if ( $this->items )
		{
			foreach ( $this->items as $obj )
			{
				if ( is_object($obj) && ($obj->agent & SpawAgent::getAgent()) )
				{
					$id = $prefix . '_' . $this->name . '_' . $i;
					switch ( strtolower(get_class($obj)) )
					{
						case "spawtbimage":
							{
								$js_res .= $prefix . '_obj.addToolbarItem(new SpawTbImage("' . $obj->module . '","' . $obj->name . '","' . $id . '"),"' . $this->name . '");';
								$html_res .= '<img id="' . $id . '" src="' . $pgdir . $obj->module . '/lib/theme/' . $theme->name . '/img/tb_' . $obj->name . '.gif"';
								if ( $theme->isCustomStyleTbi($obj->name) ) $html_res .= ' style="' . $theme->getCustomTbiStyle( $obj->name ) . '"';
								else  $html_res .= ' style="' . $theme->getDefaultTbImageStyle() . '"';
								$html_res .= ' />';
								break;
							}
						case "spawtbbutton":
							{
								$img_src = $obj->module . '/lib/theme/' . $theme->name . '/img/tb_' . $obj->name . '.gif';
								if ( ! file_exists(SpawConfig::getStaticConfigValue("SPAW_ROOT") . 'plugins/' . $img_src) )
								{

									$img_src = 'core/lib/theme/' . $theme->name . '/img/tb__plugin.gif';
								}

								$js_res .= $prefix . '_obj.addToolbarItem(new SpawTbButton("' . $obj->module . '","' . $obj->name . '","' . $id . '","' . $obj->on_enabled_check . '","' . $obj->on_pushed_check . '","' . $obj->on_click . '","' . $pgdir . $img_src . '",' . ( $obj->show_in_context_menu ? "true" : "false" ) . '),"' . $this->name . '");';

								$html_res .= '<img id="' . $id . '" src="' . $pgdir . $img_src . '"';
								if ( $theme->isCustomStyleTbi($obj->name) ) $html_res .= ' style="' . $theme->getCustomTbiStyle( $obj->name ) . ' cursor: default;"';
								else  $html_res .= ' style="' . $theme->getDefaultTbButtonStyle() . ' cursor: default;"';
								$html_res .= ' onclick="SpawPG' . $obj->module . '.' . $obj->on_click . '(' . $prefix . '_obj.getTargetEditor(),' . $prefix . '_obj.getToolbarItem(\'' . $id . '\'), this);"';
								$html_res .= ' onMouseOver="' . $prefix . '_obj.theme.buttonOver(' . $prefix . '_obj.getToolbarItem(\'' . $id . '\'), this);"';
								$html_res .= ' onMouseOut="' . $prefix . '_obj.theme.buttonOut(' . $prefix . '_obj.getToolbarItem(\'' . $id . '\'), this);"';
								$html_res .= ' onMouseDown="' . $prefix . '_obj.theme.buttonDown(' . $prefix . '_obj.getToolbarItem(\'' . $id . '\'), this);"';
								$html_res .= ' onMouseUp="' . $prefix . '_obj.theme.buttonUp(' . $prefix . '_obj.getToolbarItem(\'' . $id . '\'), this);"';
								$html_res .= ' alt="' . $this->editor->lang->m( 'title', $obj->name, $obj->module ) . '"';
								$html_res .= ' title="' . $this->editor->lang->m( 'title', $obj->name, $obj->module ) . '"';
								$html_res .= ' unselectable="on"';
								$html_res .= ' />';
								break;
							}
						case "spawtbdropdown":
							{
								if ( empty($obj->data) )
								{

									$obj->data = $this->editor->config->getConfigValue( 'dropdown_data_' . $obj->module . '_' . $obj->name );
								}
								if ( is_array($obj->data) )
								{
									$js_res .= $prefix . '_obj.addToolbarItem(new SpawTbDropdown("' . $obj->module . '","' . $obj->name . '","' . $id . '","' . $obj->on_enabled_check . '","' . $obj->on_status_check . '","' . $obj->on_change . '"),"' . $this->name . '");';

									$html_res .= '<select size="1" id="' . $id . '" ';
									if ( $theme->isCustomStyleTbi($obj->name) ) $html_res .= ' style="' . $theme->getCustomTbiStyle( $obj->name ) . '"';
									else  $html_res .= ' style="' . $theme->getDefaultTbDropdownStyle() . '"';
									$html_res .= ' onchange="SpawPG' . $obj->module . '.' . $obj->on_change . '(' . $prefix . '_obj.getTargetEditor(),' . $prefix . '_obj.getToolbarItem(\'' . $id . '\'), this);"';
									$html_res .= ' onMouseOver="' . $prefix . '_obj.theme.dropdownOver(' . $prefix . '_obj.getToolbarItem(\'' . $id . '\'), this);"';
									$html_res .= ' onMouseOut="' . $prefix . '_obj.theme.dropdownOut(' . $prefix . '_obj.getToolbarItem(\'' . $id . '\'), this);"';
									$html_res .= ' onMouseDown="' . $prefix . '_obj.theme.dropdownDown(' . $prefix . '_obj.getToolbarItem(\'' . $id . '\'), this);"';
									$html_res .= ' onMouseUp="' . $prefix . '_obj.theme.dropdownUp(' . $prefix . '_obj.getToolbarItem(\'' . $id . '\'), this);"';
									$html_res .= '>';
									$html_res .= '<option>' . $this->editor->lang->m( 'title', $obj->name, $obj->module ) . '</option>';
									foreach ( $obj->data as $key => $value )
									{
										$html_res .= '<option value="' . $key . '">' . $value . '</option>';
									}
									$html_res .= '</select>';
								}
							}
					}
				}
				$i++;
			}
			$res = '<script type="text/javascript">' . "\n<!--\n" . $js_res . "\n//-->\n" . '</script>' . $html_res;
			return $res;
		}
	}


}

?>

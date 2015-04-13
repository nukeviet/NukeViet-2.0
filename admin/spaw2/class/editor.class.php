<?php

require_once ( str_replace('\\\\', '/', dirname(__file__)) . '/config.class.php' );
require_once ( str_replace('\\\\', '/', dirname(__file__)) . '/toolbar.class.php' );
require_once ( str_replace('\\\\', '/', dirname(__file__)) . '/theme.class.php' );
require_once ( str_replace('\\\\', '/', dirname(__file__)) . '/lang.class.php' );

/**
 * SpawEditorPage
 * 
 * @package   
 * @author VBA
 * @copyright Nguyen Anh Tu
 * @version 2009
 * @access public
 */
class SpawEditorPage
{
	var $name;

	var $intputName;

	var $caption;

	var $direction;

	var $value;

	/**
	 * SpawEditorPage::SpawEditorPage()
	 * 
	 * @param mixed $name
	 * @param mixed $caption
	 * @param string $value
	 * @param string $direction
	 * @return
	 */
	function SpawEditorPage( $name, $caption, $value = '', $direction = 'ltr' )
	{

		$_page_count = SpawConfig::getStaticConfigItem( '_page_count' );
		if ( $_page_count != null )
		{
			SpawConfig::setStaticConfigItem( '_page_count', $_page_count->value + 1 );
		}
		else
		{
			SpawConfig::setStaticConfigItem( '_page_count', 1 );
		}
		$_pn = SpawConfig::getStaticConfigValue( '_page_count' );

		$ctrl_id = str_replace( ']', '_', str_replace('[', '_', $name) );
		if ( $ctrl_id != $name ) $ctrl_id = $ctrl_id . '_' . $_pn;

		$this->name = $ctrl_id;
		$this->inputName = $name;
		$this->caption = $caption;
		$this->value = $value;
		$this->direction = $direction;
	}
}


/**
 * SpawEditor
 * 
 * @package   
 * @author VBA
 * @copyright Nguyen Anh Tu
 * @version 2009
 * @access public
 */
class SpawEditor
{
	var $name;


	/**
	 * SpawEditor::scriptSent()
	 * 
	 * @return
	 */
	function &scriptSent()
	{
		static $script_sent;

		return $script_sent;
	}


	/**
	 * SpawEditor::SpawEditor()
	 * 
	 * @param mixed $name
	 * @param string $value
	 * @param string $lang
	 * @param string $toolbarset
	 * @param string $theme
	 * @param string $width
	 * @param string $height
	 * @param string $stylesheet
	 * @param string $page_caption
	 * @return
	 */
	function SpawEditor( $name, $value = '', $lang = '', $toolbarset = '', $theme = '', $width = '', $height = '', $stylesheet = '', $page_caption = '' )
	{
		$this->name = $name;

		$page_caption = ( $page_caption != '' ) ? $page_caption : $name;
		$page = new SpawEditorPage( $name, $page_caption, $value );
		if ( $page->name != $this->name ) $this->name = $page->name;
		$this->addPage( $page );
		$this->setActivePage( $page );

		if ( $lang != '' ) $this->setLanguage( $lang );


		if ( $theme != '' ) $this->setTheme( $theme );
		if ( $width != '' ) $this->setDimensions( $width, null );
		if ( $height != '' ) $this->setDimensions( null, $height );
		if ( $stylesheet != '' ) $this->setStylesheet( $stylesheet );

		$this->config = new SpawConfig();

		if ( $toolbarset != '' ) $this->setConfigValue( 'default_toolbarset', $toolbarset );
	}

	var $config;

	var $width;

	var $height;

	/**
	 * SpawEditor::setDimensions()
	 * 
	 * @param mixed $width
	 * @param mixed $height
	 * @return
	 */
	function setDimensions( $width, $height )
	{
		if ( $width != null && $width != '' ) $this->width = $width;
		if ( $height != null && $height != '' ) $this->height = $height;
	}


	var $toolbars;


	/**
	 * SpawEditor::addToolbars()
	 * 
	 * @param string $toolbar
	 * @return
	 */
	function addToolbars( $toolbar = '' )
	{
		$numargs = func_num_args();
		if ( $numargs )
		{

			$args = func_get_args();
			for ( $i = 0; $i < $numargs; $i++ )
			{
				$this->toolbars[$args[$i]] = SpawToolbar::getToolbar( $args[$i] );
				$this->toolbars[$args[$i]]->editor = &$this;
			}
		}
	}

	/**
	 * SpawEditor::addToolbarSet()
	 * 
	 * @param mixed $toolbarset
	 * @return
	 */
	function addToolbarSet( $toolbarset )
	{
		$tset = SpawConfig::getStaticConfigValue( "toolbarset_" . $toolbarset );
		if ( is_array($tset) )
		{
			foreach ( $tset as $substitute => $toolbar )
			{
				$this->addToolbar( $toolbar, $substitute );
			}
		}
	}


	/**
	 * SpawEditor::addToolbar()
	 * 
	 * @param mixed $toolbar
	 * @param string $substitute
	 * @return
	 */
	function addToolbar( $toolbar, $substitute = '' )
	{
		$index = empty( $substitute ) ? $toolbar : $substitute;

		$this->toolbars[$index] = SpawToolbar::getToolbar( $toolbar );
		$this->toolbars[$index]->editor = &$this;
	}

	var $theme;


	/**
	 * SpawEditor::setTheme()
	 * 
	 * @param mixed $theme
	 * @return
	 */
	function setTheme( $theme )
	{
		$this->theme = SpawTheme::getTheme( $theme );
	}

	var $lang;

	/**
	 * SpawEditor::setLanguage()
	 * 
	 * @param string $lang
	 * @param string $out_charset
	 * @return
	 */
	function setLanguage( $lang = '', $out_charset = '' )
	{
		$this->lang = new SpawLang( $lang );
		if ( $out_charset != null && $out_charset != '' ) $this->lang->setOutputCharset( $out_charset );
	}


	var $stylesheet;

	/**
	 * SpawEditor::setStylesheet()
	 * 
	 * @param mixed $filename
	 * @return
	 */
	function setStylesheet( $filename )
	{
		$this->stylesheet = $filename;
	}

	var $pages;

	/**
	 * SpawEditor::addPage()
	 * 
	 * @param mixed $page
	 * @return
	 */
	function addPage( $page )
	{
		$this->pages[$page->name] = $page;
	}

	/**
	 * SpawEditor::getPage()
	 * 
	 * @param mixed $name
	 * @return
	 */
	function getPage( $name )
	{
		if ( ! empty($this->pages[$name]) ) return $this->pages[$name];
		else  return null;
	}

	var $active_page;

	/**
	 * SpawEditor::setActivePage()
	 * 
	 * @param mixed $page
	 * @return
	 */
	function setActivePage( $page )
	{
		$this->active_page = $page;
	}

	/**
	 * SpawEditor::getActivePage()
	 * 
	 * @return
	 */
	function getActivePage()
	{
		return $this->active_page;
	}

	var $floating_mode = false;

	/**
	 * SpawEditor::setFloatingMode()
	 * 
	 * @param string $controlled_by
	 * @param bool $value
	 * @return
	 */
	function setFloatingMode( $controlled_by = '', $value = true )
	{
		$this->floating_mode = $value;
		if ( $value ) $this->setToolbarFrom( $controlled_by );
	}

	/**
	 * SpawEditor::getFloatingMode()
	 * 
	 * @return
	 */
	function getFloatingMode()
	{
		return $this->floating_mode;
	}

	var $toolbar_from;

	/**
	 * SpawEditor::setToolbarFrom()
	 * 
	 * @param string $controlled_by
	 * @return
	 */
	function setToolbarFrom( $controlled_by = '' )
	{
		if ( $controlled_by == '' ) $controlled_by = $this;
		$this->toolbar_from = $controlled_by;
	}

	/**
	 * SpawEditor::getToolbarFrom()
	 * 
	 * @return
	 */
	function getToolbarFrom()
	{
		if ( $this->toolbar_from ) return $this->toolbar_from;
		else  return $this;
	}

	var $is_mode_strip_visible = true;
	/**
	 * SpawEditor::showModeStrip()
	 * 
	 * @return
	 */
	function showModeStrip()
	{
		$this->is_mode_strip_visible = true;
	}
	/**
	 * SpawEditor::hideModeStrip()
	 * 
	 * @return
	 */
	function hideModeStrip()
	{
		$this->is_mode_strip_visible = false;
	}
	/**
	 * SpawEditor::isModeStripVisible()
	 * 
	 * @return
	 */
	function isModeStripVisible()
	{
		return $this->is_mode_strip_visible;
	}

	var $is_status_bar_visible = true;
	/**
	 * SpawEditor::showStatusBar()
	 * 
	 * @return
	 */
	function showStatusBar()
	{
		$this->is_status_bar_visible = true;
	}
	/**
	 * SpawEditor::hideStatusBar()
	 * 
	 * @return
	 */
	function hideStatusBar()
	{
		$this->is_status_bar_visible = false;
	}
	/**
	 * SpawEditor::isStatusBarVisible()
	 * 
	 * @return
	 */
	function isStatusBarVisible()
	{
		return $this->is_status_bar_visible;
	}

	var $is_resizable = true;
	/**
	 * SpawEditor::showResizingGrip()
	 * 
	 * @return
	 */
	function showResizingGrip()
	{
		$this->is_resizable = true;
	}
	/**
	 * SpawEditor::hideResizingGrip()
	 * 
	 * @return
	 */
	function hideResizingGrip()
	{
		$this->is_resizable = false;
	}
	/**
	 * SpawEditor::isResizingGripVisible()
	 * 
	 * @return
	 */
	function isResizingGripVisible()
	{
		return $this->is_resizable;
	}

	/**
	 * SpawEditor::setConfigItem()
	 * 
	 * @param mixed $name
	 * @param mixed $value
	 * @param mixed $transfer_type
	 * @return
	 */
	function setConfigItem( $name, $value, $transfer_type = SPAW_CFG_TRANSFER_NONE )
	{
		$this->config->setConfigItem( $name, $value, $transfer_type );
	}


	/**
	 * SpawEditor::getConfigItem()
	 * 
	 * @param mixed $name
	 * @return
	 */
	function getConfigItem( $name )
	{
		return $this->config->getConfigItem( $name );
	}


	/**
	 * SpawEditor::setConfigValue()
	 * 
	 * @param mixed $name
	 * @param mixed $value
	 * @return
	 */
	function setConfigValue( $name, $value )
	{
		$this->config->setConfigValue( $name, $value );
	}

	/**
	 * SpawEditor::setConfigValueElement()
	 * 
	 * @param mixed $name
	 * @param mixed $index
	 * @param mixed $value
	 * @return
	 */
	function setConfigValueElement( $name, $index, $value )
	{
		$this->config->setConfigValueElement( $name, $index, $value );
	}


	/**
	 * SpawEditor::getConfigValue()
	 * 
	 * @param mixed $name
	 * @return
	 */
	function getConfigValue( $name )
	{
		return $this->config->getConfigValue( $name );
	}

	/**
	 * SpawEditor::getConfigValueElement()
	 * 
	 * @param mixed $name
	 * @param mixed $index
	 * @return
	 */
	function getConfigValueElement( $name, $index )
	{
		return $this->config->getConfigValueElement( $name, $index );
	}

	/**
	 * SpawEditor::setDefaults()
	 * 
	 * @return
	 */
	function setDefaults()
	{
		if ( $this->theme == null ) $this->setTheme( $this->config->getConfigValue('default_theme') );
		if ( $this->toolbars == null ) $this->addToolbarSet( $this->config->getConfigValue('default_toolbarset') );
		if ( $this->stylesheet == null ) $this->setStylesheet( $this->config->getConfigValue('default_stylesheet') );
		if ( $this->width == null ) $this->setDimensions( $this->config->getConfigValue('default_width'), null );
		if ( $this->height == null ) $this->setDimensions( null, $this->config->getConfigValue('default_height') );
		if ( $this->lang == null ) $this->setLanguage( $this->config->getConfigValue('default_lang'), $this->config->getConfigValue('default_output_charset') );
	}

	/**
	 * SpawEditor::getHtml()
	 * 
	 * @return
	 */
	function getHtml()
	{
		$res = '';
		$this->setDefaults();
		if ( SpawAgent::getAgent() != SPAW_AGENT_UNSUPPORTED )
		{

			$head_res = '';
			$js_res = '';
			$html_res = '';
			$ssent = &SpawEditor::scriptSent();
			if ( ! $ssent )
			{
				$head_res .= '<script type="text/javascript" src="' . SpawConfig::getStaticConfigValue( "SPAW_DIR" ) . 'js/spaw.js.php"></script>';
				$js_res .= 'SpawEngine.setSpawDir("' . SpawConfig::getStaticConfigValue( "SPAW_DIR" ) . '");';
				$ssent = true;
			}
			$objname = $this->name . '_obj';
			$js_res .= 'var ' . $objname . ' = new SpawEditor("' . $this->name . '");';
			$js_res .= 'SpawEngine.registerEditor(' . $objname . ');';
			$js_res .= $objname . '.setTheme(SpawTheme' . $this->theme->name . ');';
			$js_res .= $objname . '.setLang("' . $this->lang->lang . '");';
			$js_res .= $objname . '.setOutputCharset("' . $this->lang->getOutputCharset() . '");';
			$js_res .= $objname . '.stylesheet = "' . $this->stylesheet . '";';
			$js_res .= $objname . '.scid = "' . $this->config->storeSecureConfig() . '";';

			$reqstr = '';
			foreach ( $this->config->config as $cfg )
			{
				if ( ($cfg->transfer_type & SPAW_CFG_TRANSFER_JS) && is_scalar($cfg->value) )
				{
					if ( is_numeric($cfg->value) ) $js_res .= $objname . '.setConfigValue("' . $cfg->name . '", ' . $cfg->value . ');';
					else
						if ( is_bool($cfg->value) ) $js_res .= $objname . '.setConfigValue("' . $cfg->name . '", ' . ( $cfg->value ? 'true' : 'false' ) . ');';
						else  $js_res .= $objname . '.setConfigValue("' . $cfg->name . '", "' . $cfg->value . '");';
				}
				if ( ($cfg->transfer_type & SPAW_CFG_TRANSFER_REQUEST) && is_scalar($cfg->value) )
				{
					if ( is_bool($cfg->value) ) $reqstr .= '&' . $cfg->name . '=' . ( $cfg->value ? 'true' : 'false' );
					else  $reqstr .= '&' . $cfg->name . '=' . $cfg->value;
				}
			}
			if ( $reqstr != '' ) ;
			{
				$js_res .= $objname . '.setConfigValue("__request_uri", "' . $reqstr . '");';
			}


			$tpl = '';

			$fedtpl = '';

			$other_present = false;

			$tbfrom = $this->getToolbarFrom();

			if ( ! $this->getFloatingMode() )
			{

				$tpl = $this->theme->getTemplate();
			}
			else
			{

				$tpl = '<span id="' . $this->name . '_toolbox" ';
				$tpl .= ' style="z-index: 10000; position: absolute; cursor: move;"';
				$tpl .= ' onMouseDown="' . $objname . '.floatingMouseDown(event);"';
				$tpl .= ' >';
				$tpl .= $this->theme->getTemplateToolbar();
				$tpl .= '</span>';
				$tpl .= $this->theme->getTemplateFloating();
			}

			if ( $tbfrom->name == $this->name )
			{
				foreach ( $this->toolbars as $key => $tb )
				{
					if ( strpos($tpl, '{SPAW TB=' . strtoupper($key) . '}') )
					{

						$tpl = preg_replace( '/(\{SPAW TB=' . strtoupper($key) . '\})(.*)(\{SPAW TOOLBAR\})(.*)(\{\/SPAW TB\})/sU', '$2' . $tb->renderToolbar($this->name, $this->theme) . '$4', $tpl );
					}
					else
					{

						$tpl = preg_replace( '/(\{SPAW TB=_OTHER\})(.*)(\{SPAW TOOLBAR\})(.*)(\{\/SPAW TB\})/sU', '$1$2' . $tb->renderToolbar($this->name, $this->theme) . '{SPAW TOOLBAR}$4$5', $tpl );
						$other_present = true;
					}
				}
			} elseif ( $this->getFloatingMode() && $this->toolbar_from->name != $this->name )
			{

				$tpl = $this->theme->getTemplateFloating();
			}

			$tpl = str_replace( "{SPAW DIR}", SpawConfig::getStaticConfigValue("SPAW_DIR"), $tpl );

			if ( $this->getFloatingMode() )
			{
				$js_res .= $objname . '.floating_mode = true;';
			}

			$js_res .= $tbfrom->name . '_obj.addControlledEditor(' . $objname . ');' . "\n";
			$js_res .= $objname . '.controlled_by = ' . $tbfrom->name . '_obj;' . "\n";

			if ( $other_present )
			{

				$tpl = preg_replace( '/(\{SPAW TB=_OTHER\})(.*)(\{SPAW TOOLBAR\})(.*)(\{\/SPAW TB\})/sU', '$2$4', $tpl );
			}

			$tpl = preg_replace( '/(\{SPAW TB=[^\}]*\})(.*)(\{\/SPAW TB\})/sU', '', $tpl );


			$tabtpl = '';
			$atabtpl = '';
			if ( sizeof($this->pages) > 1 )
			{

				if ( preg_match("/(\{SPAW TABSTRIP\})(.*)(\{SPAW TAB\})(.*)(\{\/SPAW TAB\})(.*)(\{\/SPAW TABSTRIP\})/sU", $tpl, $matches) )
				{
					$tabtpl = $matches[4];
				}

				if ( preg_match("/(\{SPAW TABSTRIP\})(.*)(\{SPAW TAB ACTIVE\})(.*)(\{\/SPAW TAB\})(.*)(\{\/SPAW TABSTRIP\})/sU", $tpl, $matches) )
				{
					$atabtpl = $matches[4];
				}

				$tpl = preg_replace( '/(\{SPAW TABSTRIP\})(.*)(\{\/SPAW TABSTRIP\})/sU', '$2', $tpl );
				$tpl = preg_replace( '/(\{SPAW TAB ACTIVE\})(.*)(\{\/SPAW TAB\})/sU', '{SPAW TABS}', $tpl );
				$tpl = preg_replace( '/(\{SPAW TAB\})(.*)(\{\/SPAW TAB\})/sU', '', $tpl );
			}
			else
			{

				$tpl = preg_replace( '/(\{SPAW TABSTRIP\})(.*)(\{\/SPAW TABSTRIP\})/sU', '', $tpl );
			}

			if ( strpos($tpl, '{SPAW MODESTRIP}') )
			{
				if ( $this->isModeStripVisible() )
				{

					$mstrip = SpawToolbar::getToolbar( "mode_strip" );
					$mstrip->editor = &$this;
					$tpl = preg_replace( '/(\{SPAW MODESTRIP\})(.*)(\{SPAW MODES\})(.*)(\{\/SPAW MODESTRIP\})/sU', '$2' . $mstrip->renderToolbar($this->name, $this->theme) . '$4', $tpl );
				}
				else
				{

					$tpl = preg_replace( '/(\{SPAW MODESTRIP\})(.*)(\{\/SPAW MODESTRIP\})/sU', '', $tpl );
				}
			}

			if ( strpos($tpl, '{SPAW STATUSBAR}') )
			{
				if ( $this->isStatusBarVisible() )
				{

					if ( $this->isResizingGripVisible() && $this->config->getConfigValue('resizing_directions') != 'none' )
					{
						$grip = '<img src="' . SpawConfig::getStaticConfigValue( "SPAW_DIR" ) . 'plugins/core/lib/theme/' . $this->theme->name . '/img/sizing_grip.gif" border="0" style="cursor: se-resize;"';
						$grip .= ' onmousedown="' . $objname . '.resizingGripMouseDown(event);"';
						$grip .= ' unselectable="on"';
						$grip .= ' />';
					}
					else
					{
						$grip = '';
					}
					$tpl = preg_replace( '/(\{SPAW STATUSBAR\})(.*)(\{SPAW STATUS\})(.*)(\{SPAW SIZINGGRIP\})(.*)(\{\/SPAW STATUSBAR\})/sU', '$2<span id="' . $this->name . '_status"></span>$4' . $grip . '$6', $tpl );
				}
				else
				{

					$tpl = preg_replace( '/(\{SPAW STATUSBAR\})(.*)(\{\/SPAW STATUSBAR\})/sU', '', $tpl );
				}
			}


			$pagetpl = '';
			$tabstpl = '';
			foreach ( $this->pages as $pname => $page )
			{
				$pagetpl .= '<textarea name="' . $page->inputName . '" id="' . $pname . '" style="width: 100%; height: ' . $this->height . '; display: none; overflow: scroll;">' . htmlspecialchars( $page->value ) . '</textarea>';
				$js_res .= 'var ' . $pname . '_page = new SpawEditorPage("' . $pname . '","' . htmlspecialchars( $page->caption ) . '","' . $page->direction . '");' . "\n";

				$js_res .= $objname . '.addPage(' . $pname . '_page);' . "\n";
				$js_res .= $objname . '.getTab("' . $pname . '").template = "' . addslashes( str_replace("{SPAW TAB CAPTION}", $page->caption, $tabtpl) ) . '";' . "\n";
				$js_res .= $objname . '.getTab("' . $pname . '").active_template = "' . addslashes( str_replace("{SPAW TAB CAPTION}", $page->caption, $atabtpl) ) . '";' . "\n";
				if ( $this->name == $pname ) $js_res .= $objname . '.active_page =' . $pname . '_page;' . "\n";

				$pagetpl .= '<iframe name="' . $pname . '_rEdit" id="' . $pname . '_rEdit" style="width: 100%; height: ' . $this->height . '; display: ' . ( ($this->name == $pname) ? 'inline' : 'none' ) . ';" frameborder="no" src="' . SpawConfig::getStaticConfigValue( "SPAW_DIR" ) . 'empty/empty.html"></iframe>';
				$tabstpl .= '<span id="' . $pname . '_tab" style="cursor: default;" onclick="' . $objname . '.setActivePage(\'' . $pname . '\');">' . str_replace( "{SPAW TAB CAPTION}", $page->caption, ($pname == $this->name) ? $atabtpl : $tabtpl ) . '</span>';
			}
			$tpl = preg_replace( '/\{SPAW EDITOR\}/sU', $pagetpl, $tpl );

			$tpl = str_replace( '{SPAW TABS}', $tabstpl, $tpl );

			$html_res .= '<table border="0" cellpadding="0" cellspacing="0" id="' . $this->name . '_enclosure" class="' . $this->theme->name . '" style="padding: 0px 0px 0px 0px; width: ' . $this->width . ';"><tr><td>' . $tpl . '</td></tr></table>';

			$js_res .= $objname . '.onLoadHookup();' . "\n";

			$res = $head_res . '<script type="text/javascript">' . "\n<!--\n" . $js_res . "\n//-->\n" . '</script>' . $html_res;
		}
		else
		{

			foreach ( $this->pages as $pname => $page )
			{
				if ( sizeof($this->pages) > 1 ) $res .= '<label for="' . $pname . '">' . $page->caption . '</label><br />';
				$res .= '<textarea name="' . $pname . '" id="' . $pname . '" width="' . $this->width . '" height="' . $this->height . '" style="width: ' . $this->width . '; height: ' . $this->height . ';" wrap="off">' . htmlspecialchars( $page->value ) . '</textarea><br />';
			}
		}
		return $res;
	}

	/**
	 * SpawEditor::show()
	 * 
	 * @return
	 */
	function show()
	{
		echo $this->getHtml();
	}

}

/**
 * SPAW_Wysiwyg
 * 
 * @package   
 * @author VBA
 * @copyright Nguyen Anh Tu
 * @version 2009
 * @access public
 */
class SPAW_Wysiwyg extends SpawEditor
{
	/**
	 * SPAW_Wysiwyg::SPAW_Wysiwyg()
	 * 
	 * @param string $control_name
	 * @param string $value
	 * @param string $lang
	 * @param string $mode
	 * @param string $theme
	 * @param string $width
	 * @param string $height
	 * @param string $css_stylesheet
	 * @param string $dropdown_data
	 * @return
	 */
	function SPAW_Wysiwyg( $control_name = 'richeditor', $value = '', $lang = '', $mode = '', $theme = '', $width = '100%', $height = '300px', $css_stylesheet = '', $dropdown_data = '' )
	{

		switch ( $mode )
		{
			case 'default':
				$mode = 'standard';
				break;
			case 'full':
				$mode = 'all';
				break;
			case 'mini':
				$mode = 'mini';
				break;
			default:
				$mode = '';
				break;
		}
		parent::SpawEditor( $control_name, $value, $lang, $mode, $theme, $width, $height, $css_stylesheet );

		if ( $mode == 'mini' ) $this->hideStatusBar();
	}
}

?>

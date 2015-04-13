<?php

require_once ( str_replace('\\\\', '/', dirname(__file__)) . '/config.class.php' );

/**
 * SpawTheme
 * 
 * @package   
 * @author VBA
 * @copyright Nguyen Anh Tu
 * @version 2009
 * @access public
 */
class SpawTheme
{

	var $name;


	/**
	 * SpawTheme::getName()
	 * 
	 * @return
	 */
	function getName()
	{
		return $this->name;
	}

	/**
	 * SpawTheme::SpawTheme()
	 * 
	 * @param mixed $name
	 * @return
	 */
	function SpawTheme( $name )
	{
		$this->name = $name;
	}

	/**
	 * SpawTheme::getTheme()
	 * 
	 * @param mixed $name
	 * @return
	 */
	function getTheme( $name )
	{
		$theme = new SpawTheme( $name );
		$theme->loadData();
		return $theme;
	}

	var $default_tb_button_style;

	/**
	 * SpawTheme::setDefaultTbButtonStyle()
	 * 
	 * @param mixed $style
	 * @return
	 */
	function setDefaultTbButtonStyle( $style )
	{
		$this->default_tb_button_style = $style;
	}

	/**
	 * SpawTheme::getDefaultTbButtonStyle()
	 * 
	 * @return
	 */
	function getDefaultTbButtonStyle()
	{
		return $this->default_tb_button_style;
	}
	var $default_tb_image_style;

	/**
	 * SpawTheme::setDefaultTbImageStyle()
	 * 
	 * @param mixed $style
	 * @return
	 */
	function setDefaultTbImageStyle( $style )
	{
		$this->default_tb_image_style = $style;
	}

	/**
	 * SpawTheme::getDefaultTbImageStyle()
	 * 
	 * @return
	 */
	function getDefaultTbImageStyle()
	{
		return $this->default_tb_image_style;
	}
	var $default_tb_dropdown_style;

	/**
	 * SpawTheme::setDefaultTbDropdownStyle()
	 * 
	 * @param mixed $style
	 * @return
	 */
	function setDefaultTbDropdownStyle( $style )
	{
		$this->default_tb_dropdown_style = $style;
	}

	/**
	 * SpawTheme::getDefaultTbDropdownStyle()
	 * 
	 * @return
	 */
	function getDefaultTbDropdownStyle()
	{
		return $this->default_tb_dropdown_style;
	}


	var $custom_tbi_styles = array();

	/**
	 * SpawTheme::isCustomStyleTbi()
	 * 
	 * @param mixed $name
	 * @return
	 */
	function isCustomStyleTbi( $name )
	{
		if ( isset($this->custom_tbi_styles[$name]) ) return true;
		else  return false;
	}

	/**
	 * SpawTheme::getCustomTbiStyle()
	 * 
	 * @param mixed $name
	 * @return
	 */
	function getCustomTbiStyle( $name )
	{
		if ( isset($this->custom_tbi_styles[$name]) ) return $this->custom_tbi_styles[$name];
		else  return null;
	}

	var $default_tb_button_css_class;

	/**
	 * SpawTheme::setDefaultTbButtonCssClass()
	 * 
	 * @param mixed $css_class
	 * @return
	 */
	function setDefaultTbButtonCssClass( $css_class )
	{
		$this->default_tb_button_css_class = $css_class;
	}

	/**
	 * SpawTheme::getDefaultTbButtonCssClass()
	 * 
	 * @return
	 */
	function getDefaultTbButtonCssClass()
	{
		return $this->default_tb_button_css_class;
	}
	var $default_tb_image_css_class;

	/**
	 * SpawTheme::setDefaultTbImageCssClass()
	 * 
	 * @param mixed $css_class
	 * @return
	 */
	function setDefaultTbImageCssClass( $css_class )
	{
		$this->default_tb_image_css_class = $css_class;
	}

	/**
	 * SpawTheme::getDefaultTbImageCssClass()
	 * 
	 * @return
	 */
	function getDefaultTbImageCssClass()
	{
		return $this->default_tb_image_css_class;
	}
	var $default_tb_dropdown_css_class;

	/**
	 * SpawTheme::setDefaultTbDropdownCssClass()
	 * 
	 * @param mixed $css_class
	 * @return
	 */
	function setDefaultTbDropdownCssClass( $css_class )
	{
		$this->default_tb_dropdown_css_class = $css_class;
	}

	/**
	 * SpawTheme::getDefaultTbDropdownCssClass()
	 * 
	 * @return
	 */
	function getDefaultTbDropdownCssClass()
	{
		return $this->default_tb_dropdown_css_class;
	}


	var $custom_tbi_css_classes = array();

	/**
	 * SpawTheme::isCustomCssClassTbi()
	 * 
	 * @param mixed $name
	 * @return
	 */
	function isCustomCssClassTbi( $name )
	{
		if ( isset($this->custom_tbi_css_classes[$name]) ) return true;
		else  return false;
	}

	/**
	 * SpawTheme::getCustomTbiCssClass()
	 * 
	 * @param mixed $name
	 * @return
	 */
	function getCustomTbiCssClass( $name )
	{
		if ( isset($this->custom_tbi_css_classes[$name]) ) return $this->custom_tbi_css_classes[$name];
		else  return null;
	}


	var $default_tb_button_events;

	/**
	 * SpawTheme::setDefaultTbButtonEvents()
	 * 
	 * @param mixed $events
	 * @return
	 */
	function setDefaultTbButtonEvents( $events )
	{
		$this->default_tb_button_events = $events;
	}

	/**
	 * SpawTheme::getDefaultTbButtonEvents()
	 * 
	 * @return
	 */
	function getDefaultTbButtonEvents()
	{
		return $this->default_tb_button_events;
	}


	var $custom_tbi_events = array();

	/**
	 * SpawTheme::isCustomEventsTbi()
	 * 
	 * @param mixed $name
	 * @return
	 */
	function isCustomEventsTbi( $name )
	{
		if ( isset($this->custom_tbi_events[$name]) ) return true;
		else  return false;
	}

	/**
	 * SpawTheme::getCustomTbiEvents()
	 * 
	 * @param mixed $name
	 * @return
	 */
	function getCustomTbiEvents( $name )
	{
		if ( isset($this->custom_tbi_events[$name]) ) return $this->custom_tbi_events[$name];
		else  return null;
	}


	var $template;

	/**
	 * SpawTheme::setTemplate()
	 * 
	 * @param mixed $template
	 * @return
	 */
	function setTemplate( $template )
	{
		$this->template = $template;
	}

	/**
	 * SpawTheme::getTemplate()
	 * 
	 * @return
	 */
	function getTemplate()
	{
		return $this->template;
	}

	var $template_floating;

	/**
	 * SpawTheme::setTemplateFloating()
	 * 
	 * @param mixed $template
	 * @return
	 */
	function setTemplateFloating( $template )
	{
		$this->template_floating = $template;
	}

	/**
	 * SpawTheme::getTemplateFloating()
	 * 
	 * @return
	 */
	function getTemplateFloating()
	{
		return $this->template_floating;
	}

	var $template_toolbar;

	/**
	 * SpawTheme::setTemplateToolbar()
	 * 
	 * @param mixed $template
	 * @return
	 */
	function setTemplateToolbar( $template )
	{
		$this->template_toolbar = $template;
	}

	/**
	 * SpawTheme::getTemplateToolbar()
	 * 
	 * @return
	 */
	function getTemplateToolbar()
	{
		return $this->template_toolbar;
	}

	var $template_dialog_header;

	/**
	 * SpawTheme::setTemplateDialogHeader()
	 * 
	 * @param mixed $template
	 * @return
	 */
	function setTemplateDialogHeader( $template )
	{
		$this->template_dialog_header = $template;
	}

	/**
	 * SpawTheme::getTemplateDialogHeader()
	 * 
	 * @return
	 */
	function getTemplateDialogHeader()
	{
		return $this->template_dialog_header;
	}

	var $template_dialog_footer;

	/**
	 * SpawTheme::setTemplateDialogFooter()
	 * 
	 * @param mixed $template
	 * @return
	 */
	function setTemplateDialogFooter( $template )
	{
		$this->template_dialog_footer = $template;
	}

	/**
	 * SpawTheme::getTemplateDialogFooter()
	 * 
	 * @return
	 */
	function getTemplateDialogFooter()
	{
		return $this->template_dialog_footer;
	}


	/**
	 * SpawTheme::loadData()
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
					if ( file_exists($pgdir . $pg . '/lib/theme/' . $this->name . '/config/theme.config.php') )
					{

						include ( $pgdir . $pg . '/lib/theme/' . $this->name . '/config/theme.config.php' );

						if ( $pg == "core" )
						{
							if ( isset($default_tb_button_style) )
							{
								$this->default_tb_button_style = $default_tb_button_style;
								unset( $default_tb_button_style );
							}
							if ( isset($default_tb_image_style) )
							{
								$this->default_tb_image_style = $default_tb_image_style;
								unset( $default_tb_image_style );
							}
							if ( isset($default_tb_dropdown_style) )
							{
								$this->default_tb_dropdown_style = $default_tb_dropdown_style;
								unset( $default_tb_dropdown_style );
							}
							if ( isset($default_tb_button_css_class) )
							{
								$this->default_tb_button_css_class = $default_tb_button_css_class;
								unset( $default_tb_button_css_class );
							}
							if ( isset($default_tb_image_css_class) )
							{
								$this->default_tb_image_css_class = $default_tb_image_css_class;
								unset( $default_tb_image_css_class );
							}
							if ( isset($default_tb_dropdown_css_class) )
							{
								$this->default_tb_dropdown_css_class = $default_tb_dropdown_css_class;
								unset( $default_tb_dropdown_css_class );
							}
							if ( isset($default_tb_button_events) )
							{
								$this->default_tb_button_events = $default_tb_button_events;
								unset( $default_tb_button_events );
							}
						}
						if ( isset($custom_tbi_styles) )
						{
							$this->custom_tbi_styles = array_merge( $this->custom_tbi_styles, $custom_tbi_styles );
							unset( $custom_tbi_styles );
						}
						if ( isset($custom_tbi_css_classes) )
						{
							$this->custom_tbi_css_classes = array_merge( $this->custom_tbi_css_classes, $custom_tbi_css_classes );
							unset( $custom_tbi_css_classes );
						}
						if ( isset($custom_tbi_events) )
						{
							$this->custom_tbi_events = array_merge( $this->custom_tbi_events, $custom_tbi_events );
							unset( $custom_tbi_events );
						}
					}
				}
				closedir( $dh );
			}

			if ( file_exists($pgdir . "core/lib/theme/" . $this->name . "/templates/editor.tpl") )
			{
				$fn = $pgdir . "core/lib/theme/" . $this->name . "/templates/editor.tpl";
				$handle = fopen( $fn, "r" );
				$this->template = fread( $handle, filesize($fn) );
				fclose( $handle );
			}

			if ( file_exists($pgdir . "core/lib/theme/" . $this->name . "/templates/editor_floating.tpl") )
			{
				$fn = $pgdir . "core/lib/theme/" . $this->name . "/templates/editor_floating.tpl";
				$handle = fopen( $fn, "r" );
				$this->template_floating = fread( $handle, filesize($fn) );
				fclose( $handle );
			}

			if ( file_exists($pgdir . "core/lib/theme/" . $this->name . "/templates/toolbar_floating.tpl") )
			{
				$fn = $pgdir . "core/lib/theme/" . $this->name . "/templates/toolbar_floating.tpl";
				$handle = fopen( $fn, "r" );
				$this->template_toolbar = fread( $handle, filesize($fn) );
				fclose( $handle );
			}

			if ( file_exists($pgdir . "core/lib/theme/" . $this->name . "/templates/dialog_header.tpl") )
			{
				$fn = $pgdir . "core/lib/theme/" . $this->name . "/templates/dialog_header.tpl";
				$handle = fopen( $fn, "r" );
				$this->template_dialog_header = fread( $handle, filesize($fn) );
				fclose( $handle );
			}

			if ( file_exists($pgdir . "core/lib/theme/" . $this->name . "/templates/dialog_footer.tpl") )
			{
				$fn = $pgdir . "core/lib/theme/" . $this->name . "/templates/dialog_footer.tpl";
				$handle = fopen( $fn, "r" );
				$this->template_dialog_footer = fread( $handle, filesize($fn) );
				fclose( $handle );
			}
		}
	}
}

?>

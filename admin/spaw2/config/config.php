<?php

define( "DATAFOLD", "includes/data" );

define( "NV_SYSTEM", true );

if ( ! function_exists('str_ireplace') )
{
	/**
	 * str_ireplace()
	 * 
	 * @param mixed $search
	 * @param mixed $replace
	 * @param mixed $subject
	 * @return
	 */
	function str_ireplace( $search, $replace, $subject )
	{
		$token = chr( 1 );
		$haystack = strtolower( $subject );
		$needle = strtolower( $search );
		while ( ($pos = strpos($haystack, $needle)) !== false )
		{
			$subject = substr_replace( $subject, $token, $pos, strlen($search) );
			$haystack = substr_replace( $haystack, $token, $pos, strlen($search) );
		}
		$subject = str_replace( $token, $replace, $subject );
		return $subject;
	}
}


require_once ( str_replace('\\\\', '/', dirname(__file__)) . '/../class/config.class.php' );
require_once ( str_replace('\\\\', '/', dirname(__file__)) . '/../class/util.class.php' );


SpawConfig::setStaticConfigItem( 'DOCUMENT_ROOT', str_replace("\\", "/", SpawVars::getServerVar("DOCUMENT_ROOT")) );
if ( ! ereg('/$', SpawConfig::getStaticConfigValue('DOCUMENT_ROOT')) ) SpawConfig::setStaticConfigItem( 'DOCUMENT_ROOT', SpawConfig::getStaticConfigValue('DOCUMENT_ROOT') . '/' );


SpawConfig::setStaticConfigItem( 'SPAW_ROOT', str_replace("\\", "/", realpath(dirname(__file__) . "/..") . '/') );


SpawConfig::setStaticConfigItem( 'SPAW_DIR', '/' . str_ireplace(SpawConfig::getStaticConfigValue("DOCUMENT_ROOT"), '', SpawConfig::getStaticConfigValue("SPAW_ROOT")) );

SpawConfig::setStaticConfigItem( 'SPAW_UPLOAD', '/' . str_ireplace(SpawConfig::getStaticConfigValue("DOCUMENT_ROOT"), '', str_replace("\\", "/", realpath(dirname(__file__) . "/../../..") . '/')) );
include ( str_replace("\\", "/", realpath(dirname(__file__) . "/../../..") . '/') . DATAFOLD . '/config_Editor.php' );
SpawConfig::setStaticConfigItem( 'SPAW_PASS', $editorconfig['editor_pass'] );


SpawConfig::setStaticConfigItem( 'default_lang', 'en' );

SpawConfig::setStaticConfigItem( 'default_output_charset', '' );

SpawConfig::setStaticConfigItem( 'default_theme', "" . $editorconfig['default_theme'] . "" );

SpawConfig::setStaticConfigItem( 'default_toolbarset', $editorconfig['default_toolbarset'] );

SpawConfig::setStaticConfigItem( 'default_stylesheet', SpawConfig::getStaticConfigValue('SPAW_DIR') . 'wysiwyg.css' );

SpawConfig::setStaticConfigItem( 'default_width', '100%' );

SpawConfig::setStaticConfigItem( 'default_height', '200px' );

SpawConfig::setStaticConfigItem( 'USE_ICONV', true );

SpawConfig::setStaticConfigItem( 'rendering_mode', 'xhtml', SPAW_CFG_TRANSFER_JS );

SpawConfig::setStaticConfigItem( 'beautify_xhtml_output', true, SPAW_CFG_TRANSFER_JS );

SpawConfig::setStaticConfigItem( 'base_href', '', SPAW_CFG_TRANSFER_JS );

SpawConfig::setStaticConfigItem( 'strip_absolute_urls', true, SPAW_CFG_TRANSFER_JS );

SpawConfig::setStaticConfigItem( 'resizing_directions', 'vertical', SPAW_CFG_TRANSFER_JS );

SpawConfig::setStaticConfigItem( "dropdown_data_core_style", array('' => 'Normal', 'style1' => 'Style No.1', 'style2' => 'Style No.2', ) );

SpawConfig::setStaticConfigItem( "table_styles", array('' => 'Normal', 'style1' => 'Style No.1', 'style2' => 'Style No.2', ) );

SpawConfig::setStaticConfigItem( "dropdown_data_core_fontname", array('Arial' => 'Arial', 'Courier' => 'Courier', 'Tahoma' => 'Tahoma', 'Times New Roman' => 'Times', 'Verdana' => 'Verdana') );

SpawConfig::setStaticConfigItem( "dropdown_data_core_fontsize", array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6') );

SpawConfig::setStaticConfigItem( "dropdown_data_core_formatBlock", array('Normal' => 'Normal', '<H1>' => 'Heading 1', '<H2>' => 'Heading 2', '<H3>' => 'Heading 3', '<H4>' => 'Heading 4', '<H5>' => 'Heading 5', '<H6>' => 'Heading 6') );

SpawConfig::setStaticConfigItem( "a_targets", array('_self' => 'Self', '_blank' => 'Blank', '_top' => 'Top', '_parent' => 'Parent') );


SpawConfig::setStaticConfigItem( 'toolbarset_standard', array("format" => "format", "style" => "style", "edit" => "edit", "table" => "table", "plugins" => "plugins", "insert" => "insert", "tools" => "tools") );

SpawConfig::setStaticConfigItem( 'toolbarset_all', array("format" => "format", "style" => "style", "edit" => "edit", "table" => "table", "plugins" => "plugins", "insert" => "insert", "tools" => "tools", "font" => "font") );

SpawConfig::setStaticConfigItem( 'toolbarset_mini', array("format" => "format_mini", "edit" => "edit", "tools" => "tools") );


SpawConfig::setStaticConfigItem( 'toolbarset_nv', array("format" => "format", "table" => "table", "plugins" => "plugins", "insert" => "insert", "font" => "font") );


SpawConfig::setStaticConfigItem( 'PG_SPAWFM_SETTINGS', array('allow_upload' => ($editorconfig['allow_upload']) ? true : false, 'allow_modify' => ($editorconfig['allow_modify']) ? true : false, 'max_upload_filesize' => $editorconfig['max_upload_filesize'], 'max_img_width' => $editorconfig['max_img_width'], 'max_img_height' => $editorconfig['max_img_height'], 'chmod_to' => false, 'allowed_filetypes' => $editorconfig['allowed_filetypes'], 'recursive' => false, 'allow_modify_subdirectories' => false, 'allow_create_subdirectories' => false, ), SPAW_CFG_TRANSFER_SECURE );

$gf_images = array( 'dir' => SpawConfig::getStaticConfigValue('SPAW_UPLOAD') . $editorconfig['img_dir'], 'caption' => 'Images', 'params' => array('default_dir' => true, 'allowed_filetypes' => array('images')) );

if ( $editorconfig['allowed_filetypes'] != array() && in_array("flash", $editorconfig['allowed_filetypes']) )
{
	$gf_flash = array( 'dir' => SpawConfig::getStaticConfigValue('SPAW_UPLOAD') . $editorconfig['flash_dir'], 'caption' => 'Flash movies', 'params' => array('allowed_filetypes' => array('flash')) );
}
else
{
	$gf_flash = array();
}

if ( $editorconfig['allowed_filetypes'] != array() && in_array("documents", $editorconfig['allowed_filetypes']) )
{
	$gf_doc = array( 'dir' => SpawConfig::getStaticConfigValue('SPAW_UPLOAD') . $editorconfig['doc_dir'], 'caption' => 'Documents', 'params' => array('allowed_filetypes' => array('documents')) );
}
else
{
	$gf_doc = array();
}

if ( $editorconfig['allowed_filetypes'] != array() && in_array("archives", $editorconfig['allowed_filetypes']) )
{
	$gf_arch = array( 'dir' => SpawConfig::getStaticConfigValue('SPAW_UPLOAD') . $editorconfig['arch_dir'], 'caption' => 'archives', 'params' => array('allowed_filetypes' => array('archives')) );
}
else
{
	$gf_arch = array();
}

SpawConfig::setStaticConfigItem( 'PG_SPAWFM_DIRECTORIES', array($gf_images, $gf_flash, $gf_doc, $gf_arch, ), SPAW_CFG_TRANSFER_SECURE );

?>
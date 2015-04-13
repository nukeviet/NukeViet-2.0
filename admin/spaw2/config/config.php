<?php
define( "DATAFOLD", "includes/data" );
define( "NV_SYSTEM", true );

$nv_rootdir = str_replace( "\\", "/", realpath( dirname( __file__ ) . "/../../.." ) );
if ( ! preg_match( "/\/$/", $nv_rootdir ) ) $nv_rootdir = $nv_rootdir . '/';

if ( ! defined( 'NV_MAINFILE' ) )
{
    @ini_set( 'magic_quotes_gpc', 'Off' );
    @ini_set( 'magic_quotes_runtime', 'Off' );
    @ini_set( 'magic_quotes_sybase', 'Off' );
    @ini_set( 'session.use_trans_sid', 0 );
    @ini_set( 'session.auto_start', '0' );
    @ini_set( 'display_errors', 0 );
    @ini_set( 'display_startup_errors', 0 );
    @ini_set( 'log_errors', 0 );
    @ini_set( 'error_reporting', 2039 );
    @ini_set( 'track_errors', 1 );
	error_reporting( 0 );

	if ( is_dir( $nv_rootdir . 'tmp' ) ) @ini_set( 'session.save_path', $nv_rootdir . 'tmp' );
	session_name( "NVS" );
	session_start();
}

require_once(str_replace('\\\\','/',dirname(__FILE__)).'/../class/config.class.php');
require_once(str_replace('\\\\','/',dirname(__FILE__)).'/../class/util.class.php');
require_once( str_replace("\\", "/", realpath(dirname(__file__) . "/../../..") . '/') . DATAFOLD . '/config_Editor.php' );

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

SpawConfig::setStaticConfigItem('DOCUMENT_ROOT', $nv_rootdir);
// sets physical filesystem directory where spaw files reside
// should work fine most of the time but if it fails set SPAW_ROOT manually by providing correct path
SpawConfig::setStaticConfigItem('SPAW_ROOT', str_replace("\\","/",realpath(dirname(__FILE__)."/..").'/'));

	if (isset($_SESSION['base_url_spaw_dir'])){
		$base_url_spaw_dir = strip_tags($_SESSION['base_url_spaw_dir']);
	}
	else{
	   $sturl = explode("/", $_SERVER["SCRIPT_NAME"]);
	   $base_url_spaw_dir = "";
	    for ( $i = 1; $i < count( $sturl )-1; $i++ ){
	        $base_url_spaw_dir .= '/' . $sturl[$i];
	    }
	   $base_url_spaw_dir .= '/spaw2/';
	   $_SESSION['base_url_spaw_dir'] = $base_url_spaw_dir;
	}
   $base_url_spaw_upload = "";
   $sturl = explode("/", $base_url_spaw_dir);
   for ( $i = 1; $i < count( $sturl)-3; $i++ ){
        $base_url_spaw_upload .= '/' . $sturl[$i];
   }
   $base_url_spaw_upload .= '/';
   SpawConfig::setStaticConfigItem('SPAW_DIR',$base_url_spaw_dir);
   SpawConfig::setStaticConfigItem('SPAW_UPLOAD',$base_url_spaw_upload);
   SpawConfig::setStaticConfigItem( 'SPAW_PASS', $editorconfig['editor_pass'] );

// DEFAULTS used when no value is set from code
// language 
SpawConfig::setStaticConfigItem('default_lang','vn');
// output charset (empty strings means charset specified in language file)
SpawConfig::setStaticConfigItem('default_output_charset','');
// theme 
SpawConfig::setStaticConfigItem('default_theme',$editorconfig['default_theme']);
// toolbarset 
SpawConfig::setStaticConfigItem('default_toolbarset','standard');
// stylesheet
SpawConfig::setStaticConfigItem('default_stylesheet',SpawConfig::getStaticConfigValue('SPAW_DIR').'wysiwyg.css');
// width 
SpawConfig::setStaticConfigItem('default_width','100%');
// height 
SpawConfig::setStaticConfigItem('default_height','200px');

// specifies if language subsystem should use iconv functions to convert strings to the specified charset
SpawConfig::setStaticConfigItem('USE_ICONV',true);
// specifies rendering mode to use: "xhtml" - renders using spaw's engine, "builtin" - renders using browsers engine
SpawConfig::setStaticConfigItem('rendering_mode', 'xhtml', SPAW_CFG_TRANSFER_JS);
// specifies that xhtml rendering engine should indent it's output
SpawConfig::setStaticConfigItem('beautify_xhtml_output', true, SPAW_CFG_TRANSFER_JS);
// specifies host and protocol part (like http://mydomain.com) that should be added to urls returned from file manager (and probably other places in the future) 
SpawConfig::setStaticConfigItem('base_href', '', SPAW_CFG_TRANSFER_JS);
// specifies if spaw should strip domain part from absolute urls (IE makes all links absolute)
SpawConfig::setStaticConfigItem('strip_absolute_urls', true, SPAW_CFG_TRANSFER_JS);
// specifies in which directions resizing is allowed (values: none, horizontal, vertical, both)
SpawConfig::setStaticConfigItem('resizing_directions', 'vertical', SPAW_CFG_TRANSFER_JS);
// specifies that special characters should be converted to the respective html entities
SpawConfig::setStaticConfigItem('convert_html_entities', false, SPAW_CFG_TRANSFER_JS);

// data for style (css class) dropdown list
SpawConfig::setStaticConfigItem("dropdown_data_core_style",
  array(
    '' => 'Normal',
    'style1' => 'Style No.1',
    'style2' => 'Style No.2',
  )
);
// data for style (css class) dropdown in table properties dialog
SpawConfig::setStaticConfigItem("table_styles",
  array(
    '' => 'Normal',
    'style1' => 'Style No.1',
    'style2' => 'Style No.2',
  )
);
// data for style (css class) dropdown in table cell properties dialog
SpawConfig::setStaticConfigItem("table_cell_styles",
  array(
    '' => 'Normal',
    'style1' => 'Style No.1',
    'style2' => 'Style No.2',
  )
);
// data for style (css class) dropdown in image properties dialog
SpawConfig::setStaticConfigItem("image_styles",
  array(
    '' => 'Normal',
    'style1' => 'Style No.1',
    'style2' => 'Style No.2',
  )
);
// data for fonts dropdown list
SpawConfig::setStaticConfigItem("dropdown_data_core_fontname",
  array(
    '' => 'Default',
    'Arial' => 'Arial',
    'Courier' => 'Courier',
    'Tahoma' => 'Tahoma',
    'Times New Roman' => 'Times',
    'Verdana' => 'Verdana'
  )
);
// data for fontsize dropdown list
SpawConfig::setStaticConfigItem("dropdown_data_core_fontsize",
  array(
    '' => 'Default',
    '1' => '1',
    '2' => '2',
    '3' => '3',
    '4' => '4',
    '5' => '5',
    '6' => '6'
  )
);
// data for paragraph dropdown list
SpawConfig::setStaticConfigItem("dropdown_data_core_formatBlock",
  array(
    '<p>' => 'Normal',
    '<H1>' => 'Heading 1',
    '<H2>' => 'Heading 2',
    '<H3>' => 'Heading 3',
    '<H4>' => 'Heading 4',
    '<H5>' => 'Heading 5',
    '<H6>' => 'Heading 6',
    '<pre>' => 'Preformatted',
    '<address>' => 'Address'
  )
);
// data for link targets drodown list in hyperlink dialog
SpawConfig::setStaticConfigItem("a_targets",
  array(
    '_self' => 'Self',
    '_blank' => 'Blank',
    '_top' => 'Top',
    '_parent' => 'Parent'
  )
);
// data for quick links dropdown (new in 2.0.6)
SpawConfig::setStaticConfigItem("quick_links",
  array(
    'http://spaweditor.com/' => 'SPAW Editor',
    'http://forums.solmetra.com/' => 'SPAW Support Forums',
    'http://blog.solmetra.com/' => 'Solmetra\'s Developer Blog'
  ),
  SPAW_CFG_TRANSFER_SECURE
);


// toolbar sets (should start with "toolbarset_"
// standard core toolbars
SpawConfig::setStaticConfigItem('toolbarset_standard',
  array(
    "format" => "format",
    "style" => "style",
    "edit" => "edit",
    "table" => "table",
    "plugins" => "plugins",
    "insert" => "insert",
    "tools" => "tools"
  ) 
);
// all core toolbars
SpawConfig::setStaticConfigItem('toolbarset_all',
  array(
    "format" => "format",
    "style" => "style",
    "edit" => "edit",
    "table" => "table",
    "plugins" => "plugins",
    "insert" => "insert",
    "tools" => "tools",
    "font" => "font"   
  ) 
);
// mini core toolbars
SpawConfig::setStaticConfigItem('toolbarset_mini',
  array(
    "format" => "format_mini",
    "edit" => "edit",
    "tools" => "tools"
  ) 
);

// colorpicker config
SpawConfig::setStaticConfigItem('colorpicker_predefined_colors',
  array(
    'black',
    'silver',
    'gray',
    'white',
    'maroon',
    'red',
    'purple',
    'fuchsia',
    'green',
    'lime',
    'olive',
    'yellow',
    'navy',
    'blue',
    '#fedcba',
    'aqua'
  ),
  SPAW_CFG_TRANSFER_SECURE
);

// SpawFm plugin config:

// global filemanager settings
SpawConfig::setStaticConfigItem(
  'PG_SPAWFM_SETTINGS',
  array(
    'allowed_filetypes'   => $editorconfig['allowed_filetypes'],  // allowed filetypes groups/extensions
    'allow_modify'        => ($editorconfig['allow_modify']) ? true : false,         // allow edit filenames/delete files in directory
    'allow_upload'        => ($editorconfig['allow_upload']) ? true : false,         // allow uploading new files in directory
    //'chmod_to'          => 0777,          // change the permissions of an uploaded file if allowed
                                            // (see PHP chmod() function description for details), or comment out to leave default
    'max_upload_filesize' => $editorconfig['max_upload_filesize'],             // max upload file size allowed in bytes, or 0 to ignore
    'max_img_width'       => $editorconfig['max_img_width'],             // max uploaded image width allowed, or 0 to ignore
    'max_img_height'      => $editorconfig['max_img_height'],             // max uploaded image height allowed, or 0 to ignore
    'recursive'           => false,         // allow using subdirectories
    'allow_modify_subdirectories' => false, // allow renaming/deleting subdirectories
    'allow_create_subdirectories' => false, // allow creating subdirectories
    'forbid_extensions'   => array('php'),  // disallow uploading files with specified extensions
    'forbid_extensions_strict' => true,     // disallow specified extensions in the middle of the filename
  ),
  SPAW_CFG_TRANSFER_SECURE
);

// directories
SpawConfig::setStaticConfigItem(
  'PG_SPAWFM_DIRECTORIES',
  array(
    array(
      'dir'     => SpawConfig::getStaticConfigValue('SPAW_UPLOAD') . $editorconfig['flash_dir'],
      'fsdir'   => $nv_rootdir.$editorconfig['flash_dir'], // optional absolute physical filesystem path
      'caption' => 'Flash movies', 
      'params'  => array(
        'allowed_filetypes' => array('flash')
      )
    ),
    array(
      'dir'     => SpawConfig::getStaticConfigValue('SPAW_UPLOAD') . $editorconfig['img_dir'],
      'fsdir'   => $nv_rootdir.$editorconfig['img_dir'], // optional absolute physical filesystem path
      'caption' => 'Images',
      'params'  => array(
        'default_dir' => true, // set directory as default (optional setting)
        'allowed_filetypes' => array('images')
      )
    ),
    array(
     // 'dir'     => SpawConfig::getStaticConfigValue('SPAW_UPLOAD') . $editorconfig['files_dir'],
      'fsdir'   => $nv_rootdir.$editorconfig['files_dir'], // optional absolute physical filesystem path
      'caption' => 'Files', 
      'params'  => array(
        'allowed_filetypes' => array('any')
      )
    ),
  ),
  SPAW_CFG_TRANSFER_SECURE
);
?>

<?php

// File: config_Editor.php.
// Created: 24-05-2009 03:01:05.
// Modified: 24-05-2009 03:23:38.
// Do not change anything in this file!

if ((!defined('NV_SYSTEM')) AND (!defined('NV_ADMIN'))) {
	die('Stop!!!');
}

$editorconfig = array(
	'default_theme' => 'spaw2',
	'default_toolbarset' => 'all',
	'allow_upload' => '1',
	'allow_modify' => '1',
	'max_upload_filesize' => '0',
	'max_img_width' => '0',
	'max_img_height' => '0',
	'allowed_filetypes' => array("images","flash","documents","archives"),
	'img_dir' => 'uploads/spaw2/images/',
	'flash_dir' => 'uploads/spaw2/flash/',
	'doc_dir' => 'uploads/spaw2/doc/',
	'arch_dir' => 'uploads/spaw2/compressed/',
	'editor_pass' => '3ze93#e^^0bk!ie9d#i25,'
);

?>
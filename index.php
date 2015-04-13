<?php

/*
* @Program:		NukeViet CMS
* @File name: 	NukeViet System
* @Author: 		NukeViet Group
* @Version: 	2.0 RC1
* @Date: 		01.05.2009
* @Website: 	www.nukeviet.vn
* @Copyright: 	(C) 2009
* @License: 	http://opensource.org/licenses/gpl-license.php GNU Public License
*/

if ( file_exists("install/install.php") )
{
	Header( "Location:install/install.php" );
	exit;
}

define( 'NV_SYSTEM', true );
if ( ! file_exists("mainfile.php") ) exit();
@require_once ( "mainfile.php" );

$name = $Home_Module;
$home = 1;
$module_title = _HOMEPAGE;
$modpath = '';

if ( ! isset($mop) ) $mop = "modload";
if ( ! isset($mod_file) ) $mod_file = "index";
if ( isset($file) ) $file = trim( $file );

$name = trim( $name );
$mod_file = trim( $mod_file );
$mop = trim( $mop );
if ( stripos_clone($name, "..") || (isset($file) && stripos_clone($file, "..")) || stripos_clone($mod_file, "..") || stripos_clone($mop, "..") ) die( "You are so cool..." );

$modpath .= "modules/" . $name . "/" . $mod_file . ".php";
if ( ! file_exists($modpath) )
{
	$index = 1;
	include ( "header.php" );
	OpenTable();
	if ( defined('IS_SPADMIN') )
	{
		echo "<center><font class=\"\"><b>" . _HOMEPROBLEM . "</b></font><br><br>[ <a href=\"" . $adminfold . "/" . $adminfile . ".php?op=modules\">" . _ADDAHOME . "</a> ]</center>";
	}
	else
	{
		echo "<center>" . _HOMEPROBLEMUSER . "</center>";
	}
	CloseTable();
	include ( "footer.php" );
	exit;
}
include ( $modpath );

?>
<?php

/*
* @Program:		NukeViet CMS v2.0 RC1
* @File name: 	Rss for Module Support
* @Author: 		laser (Nguyen The Hung)
* @Version: 	3.0
* @Date: 		25.06.2009
* @Website: 	www.nukeviet.vn
* @Copyright: 	(C) 2009
* @License: 	http://opensource.org/licenses/gpl-license.php GNU Public License
*/

if ( ! defined('NV_SYSTEM') )
{
	die( "You can't access this file directly..." );
}

$module_name = basename( dirname(__file__) );
@require_once ( "mainfile.php" );
if ( file_exists("" . $datafold . "/" . $module_name . "_config.php") )
{
	@require_once ( "" . $datafold . "/" . $module_name . "_config.php" );
}
get_lang( $module_name );
if ( file_exists("" . $datafold . "/config_" . $module_name . ".php") )
{
	@require_once ( "" . $datafold . "/config_" . $module_name . ".php" );
}
if ( defined('_MODTITLE') ) $module_title = _MODTITLE;
##########################################
global $prefix, $db, $nukeurl, $datafold, $currentlang, $multilingual, $module_name, $sitename;

$lang = "";
if ( isset($_GET['lang']) and ! ereg("[^a-zA-Z]", $_GET['lang']) )
{
	$lang = trim( $_GET['lang'] );
}

$cat = intval( $_GET['cat'] );
list( $titlecat) = $db->sql_fetchrow( $db->sql_query("SELECT title FROM " . $prefix . "_nvsupport_cat WHERE (cat='" . $cat . "' AND id='1')") );
if ( $titlecat == "" )
{
	$title = $module_name;
	$description = $sitename . " | " . $module_name;
}
else
{
	$title = $titlecat;
	$description = $sitename . " | " . $module_name . " | " . $titlecat;
}
$atomlink = $nukeurl . "/modules.php?name=" . $module_name . "&amp;file=rss";
if ( $cat == "" )
{
	if ( $lang == "" )
	{
		$result = $db->sql_query( "SELECT UNIX_TIMESTAMP(publtime) as 'time', id, question, answer FROM " . $prefix . "_nvsupport_all ORDER BY id DESC LIMIT 10" );
	}
	else
	{
		$result = $db->sql_query( "SELECT UNIX_TIMESTAMP(publtime) as 'time', id, question, answer FROM " . $prefix . "_nvsupport_all WHERE (language='" . $lang . "' OR language='') ORDER BY id DESC LIMIT 10" );
		$atomlink .= "&amp;lang=" . $lang;
	}
}
else
{
	$atomlink .= "&amp;cat=" . $cat;
	if ( $lang == "" )
	{
		$result = $db->sql_query( "SELECT UNIX_TIMESTAMP(publtime) as 'time', id, question, answer FROM " . $prefix . "_nvsupport_all WHERE catid=" . $cat . " ORDER BY id DESC LIMIT 10" );
	}
	else
	{
		$result = $db->sql_query( "SELECT UNIX_TIMESTAMP(publtime) as 'time', id, question, answer FROM " . $prefix . "_nvsupport_all WHERE catid=" . $cat . " AND (language='" . $lang . "' OR language='') ORDER BY id DESC LIMIT 10" );
		$atomlink .= "&amp;lang=" . $lang;
	}
}
//$atomlink .= "&amp;nv.rss";

$content = "<?xml version=\"1.0\" encoding=\"" . _CHARSET . "\"?>\n\n";
$content .= "<!--  RSS generation done by 'RSS generation 3.0 for NukeViet 2.0' -->\n\n";
//Sua cho nay
$content .= "<rss version=\"2.0\" xmlns:content=\"http://purl.org/rss/1.0/modules/content/\" xmlns:dc=\"http://purl.org/dc/elements/1.1/\" xmlns:atom=\"http://www.w3.org/2005/Atom\">\n\n";

$content .= "<channel>\n";
$content .= "<title>" . htmlspecialchars( $title ) . "</title>\n";
$content .= "<link>" . $nukeurl . "</link>\n";
//Them cho nay
$content .= "<atom:link href=\"" . $atomlink . "\" rel=\"self\" type=\"application/rss+xml\" />\n";

$content .= "<description>" . htmlspecialchars( $description ) . "</description>\n";
$content .= "<language>" . _LOCALE . "</language>\n";
$content .= "<copyright>" . htmlspecialchars( $sitename ) . "</copyright>\n";

$content .= "<docs>" . $nukeurl . "/modules.php?name=Rss</docs>\n";
$content .= "<generator>Modules RSS generation 3.0 for NukeViet 2.0</generator>\n\n";
$content .= "<image>\n";
$content .= "<url>" . $nukeurl . "/images/logo.gif</url>\n";
$content .= "<title>" . htmlspecialchars( $title ) . "</title>\n";
$content .= "<link>" . $nukeurl . "</link>\n";
$content .= "</image>\n\n";

while ( $row = $db->sql_fetchrow($result) )
{
	$rid = intval( $row['id'] );
	$rtime = $row['time'];
	$rtitle = $row['question'];
	$ranswer = $row['answer'];
	// cat ngan mo ta file
	$ranswer = stripslashes( check_html($ranswer, nohtml) );
	$ranswer = substr( $ranswer, 0, 500 );
	$phandoan = strrpos( $ranswer, " " );
	$ranswer = substr( $ranswer, 0, $phandoan );
	$more = "...";
	$rssnews = "$ranswer$more";

	$content .= "<item>\n";
	$content .= "<title>" . htmlspecialchars( $rtitle ) . "</title>\n";
	$content .= "<link>" . $nukeurl . "/modules.php?name=$module_name&amp;op=asp&amp;id=" . $rid . "</link>\n";
	//them cho nay
	$content .= "<guid isPermaLink=\"false\">article_" . $rid . "</guid>\n";
	$content .= "<description>" . htmlspecialchars( $rssnews ) . "</description>\n";
	$content .= "<pubDate>" . gmdate( "D, j M Y H:m:s", $rtime ) . " GMT</pubDate>\n";
	$content .= "</item>\n\n";
}
$content .= "</channel>\n";
$content .= "</rss>";

Header( "Content-Type: text/xml" );
Header( "Content-Type: application/rss+xml" );
Header( "Content-Encoding: none" );
echo $content;
die();

?>

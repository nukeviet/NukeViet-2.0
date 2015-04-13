<?php

/*
* @Program:		NukeViet CMS v2.0 RC4
* @File name: 	Module Addnews
* @Author: 		Nguyen Anh Tu (Nukeviet Group)
* @Version: 	2.0
* @Date: 		06.07.2009
* @Website: 	www.nukeviet.vn
* @Contact: 	anht@mail.ru
* @Copyright: 	(C) 2010
* @License: 	http://opensource.org/licenses/gpl-license.php GNU Public License
*/

$module_name = basename( dirname(__file__) );
@require_once ( "mainfile.php" );
get_lang( $module_name );
get_lang("News");
if ( file_exists($datafold . "/config_News.php") ) @require_once ( $datafold . "/config_News.php" );
if ( defined('_MODTITLE') ) $module_title = _MODTITLE;
$index = ( defined('MOD_BLTYPE') ) ? MOD_BLTYPE : 1;

//Start

if ( ! defined('IS_ADMMOD') )
{
	if ( ! $addnews )
	{
	  include ( "header.php" );
	  OpenTable();
	  echo "<center>" . _MODULENOTACTIVE . "<br><br>" . _GOBACK . "</center>";
	  CloseTable();
	  include ( "footer.php" );
	  die();
	} elseif($addnews == 2 and ! defined('IS_USER'))
	{
	  include ( "header.php" );
	  title( $sitename . ": " . _ACCESSDENIED );
	  OpenTable();
	  echo "<center><b>" . _RESTRICTEDAREA . "</b><br><br>" . _MODULEUSERS . _GOBACK;
	  echo "<meta http-equiv=\"refresh\" content=\"10;url=index.php\">";
	  CloseTable();
	  include ( "footer.php" );
	  die();
	}
}

$save = isset( $_POST['save'] ) ? intval( $_POST['save'] ) : 0;
$error = "";
if ( $save )
{
    $poster = trim( nv_htmlspecialchars( strip_tags( stripslashes($_POST['poster']) ) ) );
	if ( defined('IS_USER') ) $poster = $mbrow['username'];
    $title = trim( nv_htmlspecialchars( strip_tags( stripslashes($_POST['title']) ) ) );
	$bodytext = nv_nl2br( trim( content_filter( strip_tags( stripslashes( $_POST['bodytext'] ) ), 1 ) ), '<br />' );
    $source = trim( nv_htmlspecialchars( strip_tags( stripslashes($_POST['source']) ) ) );
    $seccode = trim( nv_htmlspecialchars( strip_tags( stripslashes($_POST['seccode']) ) ) );
    $imgtext = trim( nv_htmlspecialchars( strip_tags( stripslashes($_POST['imgtext']) ) ) );
	if ( empty($title) )
	{
		$error = _ADDNEWS0;
	} elseif ( empty($bodytext) )
	{
		$error = _ADDNEWS1;
	} elseif ( empty($poster) )
	{
		$error = _ADDNEWS2;
	} elseif ( extension_loaded("gd") and (! nv_capcha_txt($seccode)) )
	{
		$error = _ADDNEWS3;
	}
	else
	{
		$date = date( "Y-m-d H:i:s" );
        $db->sql_freeresult();
		$query = "INSERT INTO `" . $prefix . "_stories_temp` VALUES (NULL, 0, ".$db->dbescape($poster).", ".$db->dbescape($title).", ".$db->dbescape($date).", '', ".$db->dbescape($bodytext).", '', ".$db->dbescape($currentlang).", ".$db->dbescape($client_ip).", '', ".$db->dbescape($source).", 0, '')";
		$db->sql_query( $query );
        $sid = $db->sql_nextid();
        if ($sid > 0){
    		$images = @uploadimg( "", 0, 1, $sizenewsarticleimg, $temp_path );
    		if ( ! empty($images) )
    		{
    			$query = "UPDATE `" . $prefix . "_stories_temp` SET `images`='" . $images . "', `imgtext`='" . $imgtext . "' WHERE `sid`=" . $sid;
    			$db->sql_query( $query );
    		}
    		$_SESSION['is_addnews'] = 1;
			setcookie( "is_addnews",1, time() + 300, $cookie_path, $cookie_domain );
    		Header( "Location: modules.php?name=Addnews" );
    		exit();
        }
        else {
            $error = _ADDNEWS_ERR_SAVE;
        }
	}
}

$is_add = ( isset($_SESSION['is_addnews']) and $_SESSION['is_addnews'] == 1 ) ? true : false;
if (!$is_add){
    $is_add = ( isset($_COOKIE['is_addnews']) and $_COOKIE['is_addnews'] == 1 ) ? true : false;
    if ($is_add){
        $_SESSION['is_addnews'] = 1;
    }
}

include ( "header.php" );
OpenTable();
if ( $is_add )
{
	echo "<div style=\"margin:20px;text-align:center;\"><strong>" . _ADDNEWS11 . "</strong></div>\n";
	echo "<meta HTTP-EQUIV=\"refresh\" content=\"10;URL=index.php\">\n";
}
else
{
	echo "<br>\n";
	echo "<strong>" . _ADDNEWS4 . "</strong><br>" . _ADDNEWSNOTE . "<br><br>\n";
	if ( ! empty($error) ) echo "<span style=\"color: #FF0000;\"><strong>" . $error . "</strong></span><br><br>\n";
	echo "<form method=\"post\" action=\"modules.php?name=Addnews\" enctype=\"multipart/form-data\">\n";
	echo "<label>" . _ADDNEWS5 . ":</label><br>\n";
	echo "<input name=\"title\" type=\"text\" style=\"width: 100%\" value=\"" . $title . "\"><br><br>\n";
	echo "<label>" . _ADDNEWS6 . ": </label><input name=\"userfile\" type=\"file\" style=\"vertical-align: middle\"><br><br>\n";
	echo "<label>" . _ADDNEWS7 . ":</label><br>\n";
	echo "<input name=\"imgtext\" type=\"text\" style=\"width: 100%\" value=\"" . $imgtext . "\"><br><br>\n";
	echo "<label>" . _ADDNEWS8 . ":</label><br>\n";
	echo "<textarea name=\"bodytext\" cols=\"20\" rows=\"20\" style=\"width: 100%\">" . $bodytext . "</textarea><br><br>\n";
	echo "<label>" . _ADDNEWS12 . ":</label><br>\n";
	echo "<input name=\"source\" type=\"text\" style=\"width: 100%\" value=\"" . $source . "\"><br><br>\n";
	echo "<label>" . _SECURITYCODE . ":</label> <img width=\"73\" height=\"17\" src='?gfx=gfx' border='1' alt='" . _SECURITYCODE . "' title='" . _SECURITYCODE . "' style=\"vertical-align: middle\">\n";
	echo "<input name=\"seccode\" type=\"text\" style=\"vertical-align: middle\"><br><br>\n";
	if ( ! defined('IS_USER') )
	{
		echo _ADDNEWS9;
		echo ": <input name=\"poster\" type=\"text\" value=\"" . $poster . "\" style=\"vertical-align: middle\">\n";
	}
	echo "<input type=\"hidden\" name=\"save\" value=\"1\">\n";
	echo "<input name=\"send_art\" type=\"submit\" style=\"vertical-align: middle\" value=\"" . _ADDNEWS10 . "\"></form>\n";
}
CloseTable();
include ( "footer.php" );

?>
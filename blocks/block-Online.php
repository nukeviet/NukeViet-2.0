<?php

/*
* @Program:		NukeViet CMS
* @File name: 	NukeViet System
* @Version: 	2.0 RC4
* @Date: 		06.04.2010
* @Website: 	www.nukeviet.vn
* @Copyright: 	(C) 2010
* @License: 	http://opensource.org/licenses/gpl-license.php GNU Public License
*/

if ( (! defined('NV_SYSTEM')) and (! defined('NV_ADMIN')) )
{
	Header( "Location: ../index.php" );
	exit;
}

global $db, $user_prefix, $onls_m, $onls_g, $statcls, $stathits1, $datafold;

if ( $onls_m != "" )
{
	$onls_m1 = explode( "|", $onls_m );
	$num_h1 = sizeof( $onls_m1 );
}
else
{
	$num_h1 = 0;
}
if ( $onls_g != "" )
{
	$onls_g1 = explode( "|", $onls_g );
	$num_h2 = sizeof( $onls_g1 );
}
else
{
	$num_h2 = 0;
}

$num_h1 = str_pad( $num_h1, 3, "0", STR_PAD_LEFT );
$num_h2 = str_pad( $num_h2, 3, "0", STR_PAD_LEFT );
$num_h3 = str_pad( $num_h1 + $num_h2, 3, "0", STR_PAD_LEFT );
$num_h4 = str_pad( $stathits1, 9, "0", STR_PAD_LEFT );

$content = "<table border=\"0\" cellspacing=\"1\" style=\"border-collapse: collapse\" width=\"100%\">\n";
$content .= "<tr>\n";
$content .= "<td width=\"17\"><img src=\"" . INCLUDE_PATH . "images/blocks/ur-anony.gif\" height=\"14\" width=\"17\"></td>\n";
$content .= "<td>&nbsp;" . _OLGUESTS . ":</td>\n";
$content .= "<td align=\"right\">" . $num_h2 . "</td>\n";
$content .= "</tr>\n";
$content .= "<tr>\n";
$content .= "<td width=\"17\"><img src=\"" . INCLUDE_PATH . "images/blocks/ur-member.gif\" height=\"14\" width=\"17\"></td>\n";
$content .= "<td>&nbsp;" . _REGISTERED . ":</td>\n";
$content .= "<td align=\"right\">" . $num_h1 . "</td>\n";
$content .= "</tr>\n";
$content .= "<tr>\n";
$content .= "<td width=\"17\"><img src=\"" . INCLUDE_PATH . "images/blocks/ur-registered.gif\" height=\"14\" width=\"17\"></td>\n";
$content .= "<td>&nbsp;" . _OLTOTAL . "</td>\n";
$content .= "<td align=\"right\">" . $num_h3 . "</td>\n";
$content .= "</tr>\n";
$content .= "<tr>\n";
$content .= "<td width=\"17\"><img src=\"" . INCLUDE_PATH . "images/blocks/group-4.gif\" height=\"14\" width=\"17\"></td>\n";
$content .= "<td>&nbsp;" . _HITSOL . "</td>\n";
$content .= "<td align=\"right\">" . $num_h4 . "</td>\n";
$content .= "</tr>\n";
$content .= "</table>\n";
	if ( $onls_m != "" )
	{
		$array_user_id_online = array();
		$content .= "<hr>\n";
		$content .= "<table border=\"0\" cellspacing=\"1\" style=\"border-collapse: collapse\" width=\"100%\">\n";
		for ( $l = 0; $l < sizeof($onls_m1); $l++ )
		{
			$onls_m2 = explode( ":", $onls_m1[$l] );
			$array_user_id_online[] = intval($onls_m2[0]);
		}
		
		$list_user_id_online = implode(",",$array_user_id_online);
		if ( $list_user_id_online != "" ) {
			$ln = 0;
			$fsql = "SELECT user_id, username, viewuname, user_email FROM " . $user_prefix . "_users WHERE user_id IN (0,".$list_user_id_online.");";
			$fresult = $db->sql_query( $fsql );
			while ( $frow = $db->sql_fetchrow($fresult) ){
				$ln = $ln + 1;
				$ln = str_pad( $ln, 2, "0", STR_PAD_LEFT );
				$content .= "<tr>\n";
				$content .= "<td width=\"10\">" . $ln . "</td>\n";
				$content .= "<td align=\"right\"><a href=\"" . INCLUDE_PATH . "modules.php?name=Your_Account&op=userinfo&user_id=" . intval( $frow['user_id'] ) . "\">" . $frow['viewuname'] . "</td>\n";
				$content .= "</tr>\n";
			}
		}
		$content .= "</table>\n";
	}

$content .= "\n<center>" . _YOURIP . ": " . $_SERVER["REMOTE_ADDR"] . "</center>";

?>
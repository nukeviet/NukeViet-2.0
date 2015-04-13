<?php

/*
* @Program:		NukeViet CMS v2.0 RC4
* @File name: 	Module Your_Account
* @Version: 	1.0
* @Date: 		09.05.2009
* @Website: 	www.nukeviet.vn
* @Copyright: 	(C) 2010
* @License: 	http://opensource.org/licenses/gpl-license.php GNU Public License
*/

if ( ! defined( 'NV_SYSTEM' ) )
{
	die( "You can't access this file directly..." );
}

require_once ( "mainfile.php" );
$module_name = basename( dirname( __file__ ) );
get_lang( $module_name );
if ( file_exists( "" . $datafold . "/config_" . $module_name . ".php" ) )
{
	@require_once ( "" . $datafold . "/config_" . $module_name . ".php" );
}
if ( defined( '_MODTITLE' ) ) $module_title = _MODTITLE;

$index = ( defined( 'MOD_BLTYPE' ) ) ? MOD_BLTYPE : 1;
/********************************************/

/**
 * NV_userCheck2()
 * 
 * @param mixed $username
 * @return
 */
function NV_userCheck2( $username )
{
	global $nick_max, $nick_min, $bad_nick;
	$bad_nicks = ( ! empty( $bad_nick ) ) ? array_map( "trim", explode( "|", $bad_nick ) ) : array();

	if ( empty( $username ) || ( ! preg_match( "/^[a-zA-Z0-9_-]+$/", $username ) ) ) return _ERRORINVNICK;
	if ( strlen( $username ) > $nick_max ) return _NICK2LONG;
	if ( strlen( $username ) < $nick_min ) return _NICKADJECTIVE;
	if ( ! empty( $bad_nicks ) )
	{
		foreach ( $bad_nicks as $bad_nick )
		{
			if ( preg_match( "/" . preg_quote( $bad_nick ) . "/i", $username ) ) return _NAMERESTRICTED;
		}
	}

	return "";
}

/**
 * NV_userCheck()
 * 
 * @param mixed $username
 * @return
 */
function NV_userCheck( $username )
{
	global $user_prefix, $db;

	$result = NV_userCheck2( $username );

	if ( ! empty( $result ) ) return $result;
	if ( $db->sql_numrows( $db->sql_query( "SELECT username FROM " . $user_prefix . "_users WHERE username=" . $db->dbescape( $username ) ) ) > 0 ) return _NICKTAKEN;
	if ( $db->sql_numrows( $db->sql_query( "SELECT username FROM " . $user_prefix . "_users_temp WHERE username=" . $db->dbescape( $username ) ) ) > 0 ) return _NICKTAKEN;

	return "";
}

/**
 * NV_mailCheck2()
 * 
 * @param mixed $user_email
 * @return
 */
function NV_mailCheck2( $user_email )
{
	global $bad_mail;

	$bad_emails = ( ! empty( $bad_mail ) ) ? array_map( "trim", explode( "|", $bad_mail ) ) : array();

	if ( empty( $user_email ) ) return _ERRORINVEMAIL;
	if ( strrpos( $user_email, ' ' ) > 0 ) return _ERROREMAILSPACES;
	if ( ! nv_valid_email( $user_email ) ) return _ERRORINVEMAIL;
	if ( ! empty( $bad_emails ) )
	{
		foreach ( $bad_emails as $bad_email )
		{
			if ( preg_match( "/" . preg_quote( $bad_email ) . "/i", $user_email ) ) return _MAILBLOCKED . " <b>" . $user_email . "</b>";
		}
	}

	return "";
}

/**
 * NV_mailCheck()
 * 
 * @param mixed $user_email
 * @return
 */
function NV_mailCheck( $user_email )
{
	global $user_prefix, $db;
	$user_email = strtolower( $user_email );

	$result = NV_mailCheck2( $user_email );
	if ( ! empty( $result ) ) return $result;
	if ( $db->sql_numrows( $db->sql_query( "SELECT user_email FROM " . $user_prefix . "_users WHERE user_email=" . $db->dbescape( $user_email ) ) ) > 0 ) return _EMAILREGISTERED;
	if ( $db->sql_numrows( $db->sql_query( "SELECT user_email FROM " . $user_prefix . "_users WHERE user_email='" . md5( $user_email ) . "'" ) ) > 0 ) return _EMAILNOTUSABLE;
	if ( $db->sql_numrows( $db->sql_query( "SELECT user_email FROM " . $user_prefix . "_users_temp WHERE user_email=" . $db->dbescape( $user_email ) ) ) > 0 ) return _EMAILREGISTERED;

	return "";
}

/**
 * NV_passCheck()
 * 
 * @param mixed $user_pass1
 * @param mixed $user_pass2
 * @return
 */
function NV_passCheck( $user_pass1, $user_pass2 )
{
	global $pass_max, $pass_min;
	if ( strlen( $user_pass1 ) > $pass_max )
	{
		return _PASSLENGTH;
	} elseif ( strlen( $user_pass1 ) < $pass_min )
	{
		return _PASSLENGTH1;
	} elseif ( $user_pass1 != $user_pass2 )
	{
		return _PASSWDNOMATCH;
	}

	return "";
}

/**
 * NV_makePass()
 * 
 * @return
 */
function NV_makePass()
{
	$makepass = "";
	$strs = "abc2deQLTVf3ghj4kmn5opqDEF6rst7uvw8xyz9CBA";
	for ( $x = 0; $x < 7; $x++ )
	{
		mt_srand( ( double )microtime() * 1000000 );
		$str[$x] = substr( $strs, mt_rand( 0, strlen( $strs ) - 1 ), 1 );
		$makepass = $makepass . $str[$x];
	}
	return ( $makepass );
}

/**
 * disabled()
 * 
 * @return
 */
function disabled()
{
	include ( "header.php" );
	OpenTable();
	echo "<br><br><center><b><font class='option'>" . _ACTDISABLED . "</font></b></center><br><br>";
	CloseTable();
	include ( "footer.php" );
}

/**
 * finishNewUser()
 * 
 * @return
 */
function finishNewUser()
{
	global $module_name, $allowuserlogin, $allowuserreg, $sitekey, $gfx_chk, $pass_min, $pass_max, $user_prefix, $db, $useactivate, $nukeurl, $sitename, $adminmail, $expiring, $nick_max;
	if ( defined( 'IS_USER' ) )
	{
		header( "Location: modules.php?name=" . $module_name );
		exit();
	}
	if ( $allowuserreg != 0 )
	{
		info_exit( _ACTDISABLED );
	}
	$username = $_POST['username'];
	$user_email = $_POST['user_email'];

	$stop = NV_userCheck( $username );
	if ( empty( $stop ) )
	{
		$stop = NV_mailCheck( $user_email );
	}
	if ( ! empty( $stop ) )
	{
		include ( "header.php" );
		OpenTable();
		echo "<br><br><p align=\"center\"><b>" . $stop . "</b><br><br>" . _GOBACK . "</p><br><br>";
		CloseTable();
		include ( "footer.php" );
		exit;
	}

	$gfx_check = intval( $_POST['gfx_check'] );
	if ( extension_loaded( "gd" ) and ( ! nv_capcha_txt( $gfx_check ) ) and ( $gfx_chk == 3 or $gfx_chk == 4 or $gfx_chk == 6 or $gfx_chk == 7 ) )
	{
		include ( "header.php" );
		OpenTable();
		echo "<br><br><p align=\"center\"><b>" . _SECCODEINCOR . "</b><br><br>" . _GOBACK . "</p><br><br>";
		CloseTable();
		include ( "footer.php" );
		exit;
	}

	$user_password = trim( strip_tags( stripslashes( $_POST['user_password'] ) ) );
	$user_password2 = trim( strip_tags( stripslashes( $_POST['user_password2'] ) ) );
	if ( ! empty( $user_password ) and $user_password != $user_password2 )
	{
		include ( "header.php" );
		OpenTable();
		echo "<center><b>" . _PASSDIFFERENT . "</b><br><br>" . _GOBACK . "</center>";
		CloseTable();
		include ( "footer.php" );
		die();
	}

	if ( ! empty( $user_password ) and ( strlen( $user_password ) < $pass_min or strlen( $user_password ) > $pass_max ) )
	{
		include ( "header.php" );
		OpenTable();
		echo "<center>" . _YOUPASSMUSTBE . " <b>" . $pass_min . "</b> " . _YOUPASSMUSTBE2 . " <b>" . $pass_max . "</b> " . _YOUPASSMUSTBE3 . "<br><br>" . _GOBACK . "</center>";
		CloseTable();
		include ( "footer.php" );
		die();
	}

	$otviet = trim( nv_htmlspecialchars( strip_tags( stripslashes($_POST['otviet']) ) ) );
	if ( empty( $otviet ) )
	{
		include ( "header.php" );
		OpenTable();
		echo "<center>" . _EROTV . " <b>" . $vopros . "</b>.<br><br>" . _GOBACK . "</center>";
		CloseTable();
		include ( "footer.php" );
		die();
	}

	$viewuname = trim( nv_htmlspecialchars( strip_tags( stripslashes($_POST['viewuname']) ) ) );
	$vopros = trim( nv_htmlspecialchars( strip_tags( stripslashes($_POST['vopros']) ) ) );

	$opros = $vopros . "|" . $otviet;
	if ( empty( $viewuname ) ) $viewuname = $username;

	if ( empty( $user_password ) ) $user_password = NV_makePass();
	$new_password = md5( $user_password );

	if ( $useactivate == 0 )
	{
		$user_regdate = time();
		$user_avatar = "gallery/blank.gif";
		$user_avatar_type = 3;
		$query = "INSERT INTO " . $user_prefix . "_users (user_id, username, viewuname, user_email, user_regdate, user_password, opros, user_avatar, user_avatar_type) VALUES 
        (NULL, " . $db->dbescape( $username ) . ", " . $db->dbescape( $viewuname ) . ", " . $db->dbescape( $user_email ) . ", " . $db->dbescape( $user_regdate ) . ", " . $db->dbescape( $new_password ) . ", " . $db->dbescape( $opros ) . ", " . $db->dbescape( $user_avatar ) . ", " . $db->dbescape( $user_avatar_type ) . ")";
		if ( ! $db->sql_query( $query ) )
		{
			die( 'error add user' );
		}
		if ( $allowuserlogin == 1 )
		{
			info_exit( _ALLOWUSERLOGIN );
		}
		$query = "SELECT user_password, user_id FROM " . $user_prefix . "_users WHERE username=" . $db->dbescape( $username );
		$result = $db->sql_query( $query );
		$setinfo = $db->sql_fetchrow( $result );
		docookie( $setinfo['user_id'], $username, $new_password );
		$query = "UPDATE " . $user_prefix . "_users SET remember='1'  WHERE user_id='" . $setinfo['user_id'] . "'";
		$db->sql_query( $query );
		$uname = $_SERVER["REMOTE_ADDR"];
		del_online( $uname );
		include ( "header.php" );
		OpenTable();
		echo "<br><br><center><font class=\"option\"><b>" . _YOUARELOGGED . " " . _MEMBERS . "</b><br>" . _NICKNAME . ": <b>" . $username . "</b>, " . _PASSWORD . ": <b>" . $user_password . "</b></font></center>";
		echo "<p align=\"center\"><img border=\"0\" src=\"images/load_bar.gif\" width=\"97\" height=\"19\"></p>";
		if ( $user_password2 != "" )
		{
			echo "<p align=\"center\">[<a href=\"modules.php?name=" . $module_name . "&op=edituser\">" . _QLOGIN . "</a>]</p><br><br>";
			echo "<META HTTP-EQUIV=\"refresh\" content=\"10;URL=modules.php?name=" . $module_name . "&op=edituser\">";
		}
		else
		{
			echo "<p align=\"center\">[<a href=\"modules.php?name=" . $module_name . "&op=changpass\">" . _QLOGIN . "</a>]</p><br><br>";
			echo "<META HTTP-EQUIV=\"refresh\" content=\"10;URL=modules.php?name=" . $module_name . "&op=changpass\">";
		}
		CloseTable();
		include ( "footer.php" );
		exit();
	}
	else
	{
		mt_srand( ( double )microtime() * 1000000 );
		$maxran = 1000000;
		$check_num = mt_rand( 0, $maxran );
		$check_num = md5( $check_num );
		$time = time();
		$query = "INSERT INTO " . $user_prefix . "_users_temp (user_id, username, viewuname, user_email, user_password, opros, check_num, time) VALUES 
        (NULL, " . $db->dbescape( $username ) . ", " . $db->dbescape( $viewuname ) . ", " . $db->dbescape( $user_email ) . ", " . $db->dbescape( $new_password ) . ", " . $db->dbescape( $opros ) . ", " . $db->dbescape( $check_num ) . ", " . $db->dbescape( $time ) . ")";
		$db->sql_query( $query );
		$uid = $db->sql_nextid();
		if ( $useactivate == 1 )
		{
			$finishlink = $nukeurl . "/modules.php?name=" . $module_name . "&op=activate&user_id=" . $uid . "&check_num=" . $check_num;
			$message = _WELCOMETOS . " " . $sitename . "!\n\n" . _YOUUSEDEMAIL . " (" . $user_email . ") " . _TOREGISTER . " " . $sitename . ".\n\n " . _TOFINISHUSER . "\n\n " . $finishlink . "\n\n " . _FOLLOWINGMEM . "\n\n" . _UNICKNAME . " " . $username . "\n" . _UPASSWORD . " " . $user_password;
			$subject = "" . _ACTIVATIONSUB . "";
			$mailhead = "From: " . $sitename . "<" . $adminmail . ">\n";
			$mailhead .= "Content-Type: text/plain; charset= " . _CHARSET . "\n";
			@mail( $user_email, $subject, $message, $mailhead );
			$expiring = $expiring / 3600;
			$thongbao = "" . _FINISHUSERCONF . " " . $expiring . " " . _HOUR . ".";
		}
		else
		{
			$from_ip = $_SERVER['REMOTE_ADDR'];
			$message = "" . _NVADMIN1 . " " . $username . " (" . $user_email . ") " . _NVADMIN2 . ": " . $from_ip . " " . _NVADMIN3 . " " . $sitename . ".\r\n";
			$message .= "-----------------------------------------------------------\r\n";
			$message .= "" . _NVADMIN4 . ".";
			$subject = "" . _ACTIVATIONSUB . "";
			$mailhead = "From: " . $username . "<" . $user_email . ">\n";
			$mailhead .= "Content-Type: text/plain; charset= " . _CHARSET . "\n";
			@mail( $adminmail, $subject, $message, $mailhead );
			$thongbao = "" . _FINISHUSERCONF2 . "";
		}
		include ( "header.php" );
		OpenTable();
		echo "<center><b>" . _ACCOUNTCREATED . "</b><br><br>" . _YOUAREREGISTERED . "<br><br>" . $thongbao . "<br><br>" . _THANKSUSER . "</center>";
		CloseTable();
		include ( "footer.php" );
		exit();
	}
}

/**
 * activate()
 * 
 * @return
 */
function activate()
{
	global $db, $user_prefix, $module_name, $expiring, $allowuserlogin;
	if ( defined( 'IS_USER' ) )
	{
		header( "Location: modules.php?name=" . $module_name );
		exit();
	}
	if ( $expiring != 0 )
	{
		$past = time() - $expiring;
		$db->sql_query( "DELETE FROM " . $user_prefix . "_users_temp WHERE time < '" . intval( $past ) . "'" );
		$db->sql_query( "OPTIMIZE TABLE " . $user_prefix . "_users_temp" );
	}
	$user_id = intval( $_GET['user_id'] );
	$check_num = trim( $_POST['check_num'] );
	$sql = "SELECT * FROM " . $user_prefix . "_users_temp WHERE user_id='" . $user_id . "'";
	$result = $db->sql_query( $sql );
	if ( $db->sql_numrows( $result ) != 1 ) info_exit( _ACTERROR2 );

	$row = $db->sql_fetchrow( $result );
	$username = $row['username'];
	$new_pass = $row['user_password'];
	if ( $check_num != $row['check_num'] ) info_exit( _ACTERROR1 );

	$user_regdate = time();
	$user_avatar = "gallery/blank.gif";
	$user_avatar_type = 3;
	$query = "INSERT INTO " . $user_prefix . "_users (user_id, username, viewuname, user_email, user_regdate, user_password, opros, user_avatar, user_avatar_type) VALUES 
    (NULL, " . $db->dbescape( $row['username'] ) . ", " . $db->dbescape( $row['viewuname'] ) . ", " . $db->dbescape( $row['user_email'] ) . ", " . $db->dbescape( $user_regdate ) . ", " . $db->dbescape( $row['user_password'] ) . ", " . $db->dbescape( $row['opros'] ) . ", " . $db->dbescape( $user_avatar ) . ", " . $db->dbescape( $user_avatar_type ) . ")";
	$db->sql_query( $query );
	$db->sql_query( "DELETE FROM " . $user_prefix . "_users_temp WHERE user_id='" . intval( $user_id ) . "'" );
	$db->sql_query( "OPTIMIZE TABLE " . $user_prefix . "_users_temp" );
	if ( $allowuserlogin == 1 ) info_exit( _ALLOWUSERLOGIN );

	$sql = "SELECT user_password, user_id FROM " . $user_prefix . "_users WHERE username=" . $db->dbescape( $username );
	$result = $db->sql_query( $sql );
	$setinfo = $db->sql_fetchrow( $result );
	docookie( $setinfo['user_id'], $username, $new_pass );
	$db->sql_query( "UPDATE " . $user_prefix . "_users SET remember='1'  WHERE username=" . $db->dbescape( $username ) );
	$uname = $_SERVER["REMOTE_ADDR"];
	del_online( $uname );
	include ( "header.php" );
	OpenTable();
	echo "<br><br><center><font class=\"option\"><b>" . _ACTIVATIONYES . "<br>" . _YOUARELOGGED . " " . _MEMBERS . "</b></font></center>";
	echo "<p align=\"center\"><img border=\"0\" src=\"images/load_bar.gif\" width=\"97\" height=\"19\"></p><br><br>";
	echo "<META HTTP-EQUIV=\"refresh\" content=\"2;URL=modules.php?name=" . $module_name . "&op=edituser\">";
	CloseTable();
	include ( "footer.php" );
	exit();
}

/**
 * userinfo()
 * 
 * @return
 */
function userinfo()
{
	global $allowuserlogin, $adminfold, $adminfile, $onls_m, $user_prefix, $db, $user_ar, $module_name, $suspend_nick;
	if ( isset( $_GET['user_id'] ) )
	{
		$user_id = intval( $_GET['user_id'] );
	} elseif ( defined( 'IS_USER' ) )
	{
		$user_id = intval( $user_ar[0] );
	}
	else
	{
		Header( "Location: modules.php?name=" . $module_name );
		exit();
	}

	if ( $user_id <= 1 )
	{
		Header( "Location: modules.php?name=" . $module_name );
		exit();
	}

	$sql = "SELECT * FROM " . $user_prefix . "_users WHERE user_id='" . intval( $user_id ) . "'";
	$result = $db->sql_query( $sql );
	$userinfo = $db->sql_fetchrow( $result );
	if ( ! $userinfo ) info_exit( _ACCNOFIND );

	$username = $userinfo['username'];
	$suspend_nick = explode( "|", $suspend_nick );
	if ( ! empty( $suspend_nick ) )
	{
		if ( ! empty( $username ) and in_array( $username, $suspend_nick ) )
		{
			if ( defined( 'IS_USER' ) and $userinfo['user_id'] == $user_ar[0] )
			{
				Header( "Location: modules.php?name=" . $module_name . "&op=logout" );
				exit();
			}
			include ( "header.php" );
			OpenTable();
			echo "<center>";
			echo "<br><font class=\"option\">" . _SUSPENDUSER1 . " <b>" . $username . "</b> " . _SUSPENDUSER2 . "</font><br><br>";
			CloseTable();
			include ( "footer.php" );
			exit;
		}
	}

	include ( "header.php" );
	OpenTable();
	echo "<center>";

	if ( defined( 'IS_USER' ) and $userinfo['user_id'] == $user_ar[0] and $userinfo['user_password'] == $user_ar[2] )
	{
		echo "<font class=\"option\">" . _PERSONALINFO . ": <b>" . $userinfo['viewuname'] . "</b></font></center><br><br>";
		echo "<table border=\"0\" style=\"border-collapse: collapse\" width=\"100%\" cellspacing=\"3\">\n";
		if ( $allowuserlogin != 1 )
		{
			echo "<tr>\n";
			echo "<td width=\"20\">\n";
			echo "<a href=\"modules.php?name=Your_Account&amp;op=edituser\"><img border=\"0\" src=\"images/in.gif\" width=\"20\" height=\"20\"></a></td>\n";
			echo "<td><a href=\"modules.php?name=Your_Account&amp;op=edituser\">" . _CHANGEYOURINFO . "</a></td>\n";
			echo "<td width=\"20\">\n";
			echo "<a href=\"modules.php?name=Your_Account&amp;op=changpass\"><img border=\"0\" src=\"images/in.gif\" width=\"20\" height=\"20\"></a></td>\n";
			echo "<td><a href=\"modules.php?name=Your_Account&amp;op=changpass\">" . _CHPASSW . "</a></td>\n";
			echo "</tr>\n";
		}
		echo "<tr>\n";
		echo "<td width=\"20\">\n";
		echo "<a href=\"index.php\"><img border=\"0\" src=\"images/in.gif\" width=\"20\" height=\"20\"></a></td>\n";
		echo "<td><a href=\"index.php\">" . _HOMEPAGE . "</a></td>\n";
		echo "<td width=\"20\">\n";
		echo "<a href=\"modules.php?name=Your_Account&amp;op=logout\"><img border=\"0\" src=\"images/out.gif\" width=\"20\" height=\"20\"></a></td>\n";
		echo "<td><a href=\"modules.php?name=Your_Account&amp;op=logout\">" . _LOGOUTEXIT . "</a></td>\n";
		echo "</tr>\n";
		echo "</table>\n";
	}
	else
	{
		if ( ! empty( $userinfo['viewuname'] ) )
		{
			echo "<font class=\"option\">" . _PERSONALINFO . ": <b>" . $userinfo['viewuname'] . "</b></font></center><br><br>";
		}
		else
		{
			echo "<font class=\"option\">" . _PERSONALINFO . ": <b>" . $username . "</b></font></center><br><br>";
		}

		if ( ! empty( $userinfo['user_website'] ) and ! preg_match( "/^http\:\/\//", $userinfo['user_website'] ) ) $userinfo['user_website'] = "http://" . $userinfo['user_website'];

		if ( $userinfo['name'] || $userinfo['lastname'] || $userinfo['user_email'] || $userinfo['user_regdate'] || $userinfo['user_website'] || $userinfo['user_icq'] || $userinfo['user_telephone'] || $userinfo['user_location'] || $userinfo['user_interests'] || $userinfo['user_sig'] || $userinfo['user_viewemail'] )
		{
			echo "<center><table cellpadding=\"3\" border=\"0\" width=\"100%\">";
			if ( $userinfo['name'] )
			{
				echo "<tr><td><b>" . _NAME . ":</b></td><td>" . $userinfo['name'] . "</td></tr>\n";
			}
			if ( $userinfo['lastname'] )
			{
				echo "<tr><td><b>" . _LASTNAME . ":</b></td><td>" . $userinfo['lastname'] . "</td></tr>\n";
			}
			if ( $userinfo['user_website'] != "http://" and $userinfo['user_website'] != "" )
			{
				echo "<tr><td><b>" . _MYHOMEPAGE . ":</b></td><td><a href=\"" . $userinfo['user_website'] . "\" target=\"new\">" . $userinfo['user_website'] . "</a></td></tr>\n";
			}
			if ( ( $userinfo['user_email'] ) and ( $userinfo['user_viewemail'] == 1 ) )
			{
				echo "<tr><td><b>" . _EMAIL . ":</b></td><td><a href=\"mailto:" . $userinfo['user_email'] . "\">" . $userinfo['user_email'] . "</a></td></tr>\n";
			}
			if ( $userinfo['user_icq'] )
			{
				echo "<tr><td><b>" . _ICQ . ":</b></td><td>" . $userinfo['user_icq'] . "</td></tr>\n";
			}
			if ( $userinfo['user_telephone'] )
			{
				echo "<tr><td><b>" . _TELEPHONE . ":</b></td><td>" . $userinfo['user_telephone'] . "</td></tr>\n";
			}
			if ( $userinfo['user_from'] )
			{
				echo "<tr><td><b>" . _LOCATION . ":</b></td><td>" . $userinfo['user_from'] . "</td></tr>\n";
			}
			if ( $userinfo['user_interests'] )
			{
				echo "<tr><td><b>" . _INTERESTS . ":</b></td><td>" . $userinfo['user_interests'] . "</td></tr>\n";
			}
			if ( $userinfo['user_sig'] )
			{
				$userinfo['user_sig'] = nl2br( $userinfo['user_sig'] );
				echo "<tr><td><b>" . _SIGNATURE . ":</b></td><td>" . $userinfo['user_sig'] . "</td></tr>\n";
			}
			echo "<tr><td><b>" . _REGDATE . ":</b></td><td>" . viewtime( $userinfo['user_regdate'], 1 ) . "</td></tr>\n";
			$uonline = _OFFLINE;
			$onls_m = explode( "|", $onls_m );
			for ( $l = 0; $l < sizeof( $onls_m ); $l++ )
			{
				$onls_m1 = explode( ":", $onls_m[$l] );
				if ( $onls_m1[0] == $userinfo['user_id'] )
				{
					$uonline = _ONLINE;
					break;
				}
			}
			echo "<tr><td><b>" . _USERSTATUS . ":</b></td><td><b>" . $uonline . "</b></td></tr>\n";
			if ( defined( 'IS_ADMMOD' ) )
			{
				echo "<tr><td><b>" . _ADMINF . ":</b></td><td>[ <a href=\"" . $adminfold . "/" . $adminfile . ".php?op=modifyUser&chng_uid=" . $user_id . "\">" . _EDITUSER . "</a> | <a href=\"" . $adminfold . "/" . $adminfile . ".php?op=UsersConfig&chng_uid=" . $user_id . "#susp\">" . _SUSPENDUSER . "</a> | <a href=\"" . $adminfold . "/" . $adminfile . ".php?op=delUser&amp;chng_uid=" . $user_id . "\">" . _DELITUSER . "</a> ]</td></tr>";
			}
			echo "</center></font></table>";
		}
		else
		{
			echo "<center>" . _NOINFOFOR . " " . $username . "</center>";
		}
	}
	CloseTable();
	include ( "footer.php" );
}

/**
 * NV_main()
 * 
 * @return
 */
function NV_main()
{
	global $nick_max, $nick_min, $pass_max, $pass_min, $allowuserlogin, $gfx_chk, $module_name;
	if ( $allowuserlogin == 1 ) info_exit( _ALLOWUSERLOGIN );

	if ( defined( 'IS_USER' ) )
	{
		header( "Location: modules.php?name=Your_Account&op=userinfo" );
		exit();
	}

	$redirect = isset( $_GET['redirect'] ) ? stripslashes( FixQuotes( $_GET['redirect'] ) ) : '';
	$mode = isset( $_GET['mode'] ) ? stripslashes( FixQuotes( $_GET['mode'] ) ) : '';
	$f = isset( $_GET['f'] ) ? stripslashes( FixQuotes( $_GET['f'] ) ) : '';
	$t = isset( $_GET['t'] ) ? stripslashes( FixQuotes( $_GET['t'] ) ) : '';

	$kt = "/^[a-zA-Z0-9_]+$/";
	if ( ( ! empty( $redirect ) and ! preg_match( $kt, $redirect ) ) or ( ! empty( $mode ) and ! preg_match( $kt, $mode ) ) or ( ! empty( $f ) and ! preg_match( $kt, $f ) ) or ( ! empty( $t ) and ! preg_match( $kt, $t ) ) )
	{
		Header( "Location:index.php" );
		exit;
	}

	include ( "header.php" );
	if ( isset( $_GET['stop'] ) and intval( $_GET['stop'] ) == 1 )
	{
		title( _LOGININCOR );
	}
	else
	{
		title( _USERREGLOGIN );
	}
	OpenTable();
	echo "\n<script>\n";
	echo "function check_data(Forma) {\n";
	echo "if (Forma.username.value == \"\") {\n";
	echo "alert(\"" . _NICKNAME . " ?\");\n";
	echo "Forma.username.focus();\n";
	echo "return false;\n";
	echo "}\n";
	echo "dc = Forma.username.value.length;\n";
	echo "if(dc < " . $nick_min . "){\n";
	echo "alert(\"" . _NICKADJECTIVE . "\");\n";
	echo "Forma.username.focus();\n";
	echo "return false;\n";
	echo "}\n";
	echo "if(dc > " . $nick_max . "){\n";
	echo "alert(\"" . _NICK2LONG . "\");\n";
	echo "Forma.username.focus();\n";
	echo "return false;\n";
	echo "}\n";
	if ( extension_loaded( "gd" ) and ( $gfx_chk == 2 or $gfx_chk == 4 or $gfx_chk == 5 or $gfx_chk == 7 ) )
	{
		echo "if (Forma.gfx_check.value == \"\") {\n";
		echo "alert(\"" . _SECURITYCODE . " ?\");\n";
		echo "Forma.gfx_check.focus();\n";
		echo "return false;\n";
		echo "}\n";
	}
	echo "if (Forma.user_password.value == \"\") {\n";
	echo "alert(\"" . _PASSWORD . " ?\");\n";
	echo "Forma.user_password.focus();\n";
	echo "return false;\n";
	echo "}\n";
	echo "if (Forma.user_password.value != \"\") {\n";
	echo "dp = Forma.user_password.value.length;\n";
	echo "if(dp < " . $pass_min . "){\n";
	echo "alert(\"" . _PASSLENGTH1 . ". " . _YOUPASSMUSTBE . " " . $pass_min . " " . _YOUPASSMUSTBE2 . " " . $pass_max . " " . _YOUPASSMUSTBE3 . "\");\n";
	echo "Forma.user_password.focus();\n";
	echo "return false;\n";
	echo "}\n";
	echo "if(dc > " . $pass_max . "){\n";
	echo "alert(\"" . _PASSLENGTH . ". " . _YOUPASSMUSTBE . " " . $pass_min . " " . _YOUPASSMUSTBE2 . " " . $pass_max . " " . _YOUPASSMUSTBE3 . "\");\n";
	echo "Forma.user_password.focus();\n";
	echo "return false;\n";
	echo "}\n";
	echo "}\n";
	echo "return true; \n";
	echo "}\n";
	echo "</script>\n";

	echo "<center><form onsubmit=\"return check_data(this)\" action=\"modules.php?name=" . $module_name . "\" method=\"post\">\n";
	echo "<b>" . _USERLOGIN . "</b><br><br>\n";
	echo "<table border=\"0\"><tr><td>\n";
	echo "<b>" . _NICKNAME . ":</b></td><td><input type=\"text\" name=\"username\" size=\"20\" maxlength=\"" . $nick_max . "\"></td></tr>\n";
	echo "<tr><td><b>" . _PASSWORD . ":</b></td><td><input type=\"password\" name=\"user_password\" size=\"20\" maxlength=\"" . $pass_max . "\"></td></tr>\n";
	if ( extension_loaded( "gd" ) and ( $gfx_chk == 2 or $gfx_chk == 4 or $gfx_chk == 5 or $gfx_chk == 7 ) )
	{
		echo "<tr><td><b>" . _SECURITYCODE . ":</b></td><td><img width=\"73\" height=\"17\" src='?gfx=gfx' border='1' alt='" . _SECURITYCODE . "' title='" . _SECURITYCODE . "'></td></tr>\n";
		echo "<tr><td><b>" . _TYPESECCODE . ":</b></td><td><input type=\"text\" NAME=\"gfx_check\" SIZE=\"11\" MAXLENGTH=\"6\"></td></tr>\n";
	}
	echo "<tr><td colspan=2>" . _REMEMBER . " <input type=\"checkbox\" name=\"remember\" value=\"1\"></td></tr>";

	echo "</table><input type=\"hidden\" name=\"redirect\" value=\"" . $redirect . "\">\n";
	echo "<input type=\"hidden\" name=\"mode\" value=\"" . $mode . "\"\">\n";
	echo "<input type=\"hidden\" name=\"f\" value=\"" . $f . "\">\n";
	echo "<input type=\"hidden\" name=\"t\" value=\"" . $t . "\">\n";
	echo "<input type=\"hidden\" name=\"op\" value=\"login\">\n";
	echo "<br><input type=\"submit\" value=\"" . _LOGIN . "\"></form></center><br><br><br>\n\n";
	echo "<center><font class=\"content\">[ <a href=\"modules.php?name=" . $module_name . "&amp;op=pass_lost\">" . _PASSWORDLOST . "</a> | <a href=\"modules.php?name=" . $module_name . "&amp;op=new_user\">" . _REGNEWUSER . "</a> ]</font></center>\n";
	CloseTable();
	include ( "footer.php" );
}

/**
 * new_user()
 * 
 * @return
 */
function new_user()
{
	global $kb_password, $expiring, $pass_max, $pass_min, $nick_min, $nick_max, $module_name, $allowuserreg, $useactivate, $gfx_chk;
	if ( defined( 'IS_USER' ) )
	{
		header( "Location: modules.php?name=" . $module_name );
		exit();
	}
	if ( $allowuserreg != 0 ) info_exit( _ACTDISABLED );

	include ( "header.php" );
	//Cauhinh noi quy
	$caokhungnq = 30;
	$ngangkhungnq = 80;
	$docnoiqui = isset( $_POST['docnoiqui'] ) ? intval( $_POST['docnoiqui'] ) : 0;
	$nqagree = isset( $_POST['nqagree'] ) ? intval( $_POST['nqagree'] ) : 0;
	if ( $docnoiqui == 1 )
	{
		$docnoiqui = 0;
		if ( $nqagree == 0 )
		{
			header( "Location: index.php" );
			exit();
		}
		else
		{
			//
			OpenTable();
			echo "\n<script>\n";
			echo "function check_data(Forma) {\n";
			echo "if (Forma.username.value == \"\") {\n";
			echo "alert(\"" . _NAMERESTRICTED . "\");\n";
			echo "Forma.username.focus();\n";
			echo "return false;\n";
			echo "}\n";
			echo "dc = Forma.username.value.length;\n";
			echo "if(dc < $nick_min){\n";
			echo "alert(\"" . _NICKADJECTIVE . "\");\n";
			echo "Forma.username.focus();\n";
			echo "return false;\n";
			echo "}\n";
			echo "if(dc > $nick_max){\n";
			echo "alert(\"" . _NICK2LONG . "\");\n";
			echo "Forma.username.focus();\n";
			echo "return false;\n";
			echo "}\n";
            echo "var nv_namecheck = /^([a-zA-Z0-9_-])+$/;\n";
			echo "if (!nv_namecheck.test(Forma.username.value)) {\n";
			echo "alert(\"" . _NAMERESTRICTED . "\");\n";
			echo "Forma.username.focus();\n";
			echo "return false;\n";
			echo "}\n";
			echo "if (Forma.user_email.value == \"\")  {\n";
			echo "alert(\"" . _MAILBLOCKED . "\");\n";
			echo "Forma.user_email.focus();\n";
			echo "return false;\n";
			echo "}\n";
			echo "t = Forma.user_email.value.search(\"@\");\n";
			echo "k = Forma.user_email.value.search(\" \");\n";
			echo "if(k >= 0){\n";
			echo "alert(\"" . _EMAILNOTUSABLE . "\");\n";
			echo "Forma.user_email.focus();\n";
			echo "return false;\n";
			echo "}\n";
			echo "if(t <= -1){\n";
			echo "alert(\"" . _EMAILNOTUSABLE . "\");\n";
			echo "Forma.user_email.focus();\n";
			echo "return false;\n";
			echo "}\n";
			echo "var filter =/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,6})+$/;\n";
			echo "if (!filter.test(Forma.user_email.value)) {\n";
			echo "alert(\"" . _EMAILNOTUSABLE . "\");\n";
			echo "Forma.user_email.focus();\n";
			echo "return false;\n";
			echo "}\n";
			echo "if (Forma.otviet.value == \"\") {\n";
			echo "alert(\"" . _OTVIET . " ?\");\n";
			echo "Forma.otviet.focus();\n";
			echo "return false;\n";
			echo "}\n";
			echo "if (Forma.user_password.value != \"\") {\n";
			echo "dp = Forma.user_password.value.length;\n";
			echo "if(dp < $pass_min){\n";
			echo "alert(\"" . _PASSLENGTH1 . ". " . _YOUPASSMUSTBE . " $pass_min " . _YOUPASSMUSTBE2 . " $pass_max " . _YOUPASSMUSTBE3 . "\");\n";
			echo "Forma.user_password.focus();\n";
			echo "return false;\n";
			echo "}\n";
			echo "if(dc > $pass_max){\n";
			echo "alert(\"" . _PASSLENGTH . ". " . _YOUPASSMUSTBE . " $pass_min " . _YOUPASSMUSTBE2 . " $pass_max " . _YOUPASSMUSTBE3 . "\");\n";
			echo "Forma.user_password.focus();\n";
			echo "return false;\n";
			echo "}\n";
			echo "if (Forma.user_password.value != Forma.user_password2.value) {\n";
			echo "alert(\"" . _PASSDIFFERENT . "\");\n";
			echo "Forma.user_password.focus();\n";
			echo "return false;\n";
			echo "}\n";
			echo "}\n";
			if ( extension_loaded( "gd" ) and ( $gfx_chk == 3 or $gfx_chk == 4 or $gfx_chk == 6 or $gfx_chk == 7 ) )
			{
				echo "if (Forma.gfx_check.value == \"\") {\n";
				echo "alert(\"" . _SECURITYCODE . " ?\");\n";
				echo "Forma.gfx_check.focus();\n";
				echo "return false;\n";
				echo "}\n";
			}
			echo "return true; \n";
			echo "}\n";
			echo "</script>\n";
			echo "<form onsubmit=\"return check_data(this)\" action=\"modules.php?name=$module_name\" method=\"post\">\n";
			echo "<center><b>" . _NEWUSERREG . "</b></center><br><br>\n";
			echo "<center><table cellpadding=\"0\" cellspacing=\"2\" border=\"0\">\n";
			echo "<tr><td>" . _NICKNAME . ":<font color=red>*</font></td><td><input type=\"text\" name=\"username\" size=\"30\" maxlength=\"$nick_max\"></td></tr>\n";
			echo "<tr><td>" . _VIEWNAME . ":</td><td><input type=\"text\" name=\"viewuname\" size=\"30\" maxlength=\"100\"></td></tr>\n";
			echo "<tr><td>" . _EMAIL . ":<font color=red>*</font></td><td><input type=\"text\" name=\"user_email\" size=\"30\" maxlength=\"255\"></td></tr>\n";
			echo "<tr><td>" . _PASSWORD . ":</td><td><input type=\"password\" name=\"user_password\" size=\"30\" maxlength=\"$pass_max\"></td></tr>\n<tr><td>" . _RETYPEPASSWORD . ":</td><td><input type=\"password\" name=\"user_password2\" size=\"30\" maxlength=\"$pass_max\"></td></tr>\n";
			echo "<tr><td>" . _VOPROS . ":</td><td><select name=\"vopros\">\n";

			$vopros_ar = array( _VOPROS1, _VOPROS2, _VOPROS3, _VOPROS4, _VOPROS5 );
			for ( $l = 0; $l < sizeof( $vopros_ar ); $l++ )
			{
				echo "<option>" . $vopros_ar[$l] . "</option>\n";
			}
			echo "</select></td></tr>\n";
			echo "<tr><td>" . _OTVIET . ":<font color=red>*</font></td><td><input type=\"text\" name=\"otviet\" size=\"30\" maxlength=\"100\"></td></tr>\n";
			if ( extension_loaded( "gd" ) and ( $gfx_chk == 3 or $gfx_chk == 4 or $gfx_chk == 6 or $gfx_chk == 7 ) )
			{
				echo "<tr><td>" . _SECURITYCODE . ":</td><td><img width=\"73\" height=\"17\" src='?gfx=gfx' border='1' alt='" . _SECURITYCODE . "' title='" . _SECURITYCODE . "'></td></tr>\n";
				echo "<tr><td>" . _TYPESECCODE . ":<font color=red>*</font></td><td><input type=\"text\" NAME=\"gfx_check\" SIZE=\"11\" MAXLENGTH=\"6\"></td></tr>\n";
			}
			echo "<tr><td colspan='2' align=center>\n";
			echo "<input type=\"hidden\" name=\"op\" value=\"finish\">\n";
			echo "<br><input type=\"submit\" value=\"" . _NEWREG . "\">\n";
			echo "</td></tr></table></center>\n";
			echo "</form>\n";
			echo "<br><br>\n";
			echo "" . _ASREG1 . "<br>\n";
			if ( $kb_password == 1 )
			{
				echo "" . _ASREG2 . "<br>\n";
			}
			else
			{
				echo "" . _ASREG2A . "<br>\n";
			}
			echo "" . _INFOPR . "<br>\n";
			$expiring = $expiring / 3600;
			if ( $useactivate == 1 )
			{
				echo "" . _YOUWILLRECEIVE . " $expiring " . _HOUR . ".<br><br>\n";
			} elseif ( $useactivate == 2 )
			{
				echo "" . _YOUWILLRECEIVE2 . "\n";
			}
			echo "<br><br><center><font class=\"content\">[ <a href=\"modules.php?name=$module_name\">" . _USERLOGIN . "</a> | <a href=\"modules.php?name=$module_name&amp;op=pass_lost\">" . _PASSWORDLOST . "</a> ]</font></center>\n";
			CloseTable();
			// them trinh bay noi quy
		}
	}
	else
	{
		OpenTable();
		echo "<table align=\"center\" border=\"0\" cellspacing=\"10\">" . "<tr><td class=\"storytitle\">" . _NOIQUITITLE . "</td></tr>" . "<tr>" . "<td>" . "<form method=\"POST\" action=\"modules.php?name=$module_name&op=new_user\">" . "   <div height=\"200\" style=\"overflow: auto; height: 200px; width: 100%;\">" . _NOIQUI . "</div>" . "   <table align=\"center\" border=\"0\" width=\"100%\">" . "      <tr>" . "         <td>" . "         <p align=\"left\">" . "         <input type=\"radio\" value=\"1\" name=\"nqagree\">" . _AGREE . "</td>" . "         <td><input type=\"radio\" name=\"nqagree\" checked value=\"0\">" . _DEAGREE . "</td>" . "      </tr>" . "      <tr>" . "         <td colspan=\"2\">&nbsp;<input type=\"hidden\" value=\"1\" name=\"docnoiqui\"></td>" . "         <td colspan=\"2\"><input type=\"submit\" value=\"" . _NEXT . "\" name=\"nqread\"></td>" . "      </tr>" . "   </table>" . "</form>" . "</td>" . "</tr>" . "</table>";

		CloseTable();
	}
	//
	include ( "footer.php" );
}

/**
 * pass_lost()
 * 
 * @return
 */
function pass_lost()
{
	global $module_name, $nick_max, $gfx_chk;
	if ( defined( 'IS_USER' ) )
	{
		header( "Location: modules.php?name=$module_name" );
		exit();
	}
	include ( "header.php" );
	OpenTable();
	echo "<center><b>" . _PASSWORDLOST . "</b><br><br>\n";
	echo "" . _NOPROBLEM . "<br><br>\n";
	echo "<form action=\"modules.php?name=$module_name\" method=\"post\">\n";
	echo "<table border=\"0\"><tr><td>\n";
	echo "" . _NICKNAME . ":</td><td><input type=\"text\" name=\"username\" size=\"25\" maxlength=\"$nick_max\"></td></tr>\n";
	echo "<tr><td align='right'>" . _OREMAIL . ":</td><td><input type=\"text\" name=\"user_email\" size=\"25\" maxlength=\"50\"></td></tr>\n";
	if ( extension_loaded( "gd" ) and ( $gfx_chk == 2 or $gfx_chk == 4 or $gfx_chk == 5 or $gfx_chk == 7 ) )
	{
		echo "<tr><td align='right'>" . _SECURITYCODE . ":</td><td><img width=\"73\" height=\"17\" src='?gfx=gfx' border='1' alt='" . _SECURITYCODE . "' title='" . _SECURITYCODE . "'></td></tr>\n";
		echo "<tr><td align='right'>" . _TYPESECCODE . ":</td><td><input type=\"text\" NAME=\"gfx_check\" SIZE=\"11\" MAXLENGTH=\"6\"></td></tr>\n";
	}
	echo "</table><br>\n";
	echo "<input type=\"hidden\" name=\"op\" value=\"checkop\">\n";
	echo "<input type=\"submit\" value=\"" . _STEP2 . "\"></form><br>\n";
	echo "<font class=\"content\">[ <a href=\"modules.php?name=$module_name\">" . _USERLOGIN . "</a> | <a href=\"modules.php?name=$module_name&amp;op=new_user\">" . _REGNEWUSER . "</a> ]</font></center>\n";
	CloseTable();
	include ( "footer.php" );
}

/**
 * checkop()
 * 
 * @return
 */
function checkop()
{
	global $db, $user_prefix, $module_name, $gfx_chk, $sitekey, $sitename, $nukeurl, $adminmail, $nick_max;
	if ( defined( 'IS_USER' ) )
	{
		header( "Location: modules.php?name=" . $module_name );
		exit();
	}
	$username = isset( $_POST['username'] ) ? trim( $_POST['username'] ) : '';
	$user_email = isset( $_POST['user_email'] ) ? trim( $_POST['user_email'] ) : '';
	$ch_where = "";
	$error = "";
	if ( ! empty( $username ) )
	{
		$error = NV_userCheck2( $username );
		$ch_where = "WHERE username=" . $db->dbescape( $username );
	} elseif ( ! empty( $user_email ) )
	{
		$error = NV_mailCheck2( $user_email );
		$ch_where = "WHERE user_email=" . $db->dbescape( $user_email ) . "";
	}
	if ( ! empty( $error ) )
	{
		include ( "header.php" );
		OpenTable();
		echo "<br><br><p align=\"center\"><b>" . $error . "</b><br><br>" . _GOBACK . "</p><br><br>";
		CloseTable();
		include ( "footer.php" );
		exit;
	}

	if ( empty( $ch_where ) )
	{
		header( "Location: modules.php?name=" . $module_name . "&op=pass_lost" );
		exit();
	}

	$gfx_check = intval( $_POST['gfx_check'] );
	if ( extension_loaded( "gd" ) and ( ! nv_capcha_txt( $gfx_check ) ) and ( $gfx_chk == 2 or $gfx_chk == 4 or $gfx_chk == 5 or $gfx_chk == 7 ) )
	{
		include ( "header.php" );
		OpenTable();
		echo "<br><br><p align=\"center\"><b>" . _SECCODEINCOR . "</b><br><br>" . _GOBACK . "</p><br><br>";
		CloseTable();
		include ( "footer.php" );
		exit;
	}

	$sql = "SELECT user_email, opros FROM " . $user_prefix . "_users " . $ch_where;
	$result = $db->sql_query( $sql );
	$num = $db->sql_numrows( $result );
	if ( $num != 1 )
	{
		include ( "header.php" );
		OpenTable();
		echo "<center>" . _SORRYNOUSERINFO . "</center>";
		CloseTable();
		include ( "footer.php" );
		exit;
	}

	$row = $db->sql_fetchrow( $result );
	if ( empty( $row['opros'] ) )
	{
		header( "Location: index.php" );
		exit();
	}

	$opros = explode( "|", $row['opros'] );
	if ( empty( $opros[0] ) or empty( $opros[1] ) )
	{
		header( "Location: index.php" );
		exit();
	}

	$otviet = isset( $_POST['otviet'] ) ? trim( $_POST['otviet'] ) : '';

	if ( ! empty( $otviet ) and $otviet == $opros[1] )
	{
		$newpass = NV_makePass();
		$cryptpass = md5( $newpass );
		$query = "UPDATE " . $user_prefix . "_users SET user_password='" . $cryptpass . "' " . $ch_where;
		$db->sql_query( $query );
		$message = $sitename . " " . _NVMAILPASS . ":\n\n " . _YOURNEWPASSWORD . " " . $newpass . "\n\n " . _YOUCANCHANGE . " " . $nukeurl . "/modules.php?name=" . $module_name . "\n\n";
		$subject = "" . _USERPASSWORD4 . "";
		$mailhead = "From: " . $sitename . " <" . $adminmail . ">\n";
		$mailhead .= "Content-Type: text/plain; charset= " . _CHARSET . "\n";
		@mail( $row['user_email'], $subject, $message, $mailhead );
		unset( $username );
		unset( $user_email );
		include ( "header.php" );
		OpenTable();
		echo "<br><br><center>" . _PASSWORD4 . "</center><br><br>";
		echo "<meta http-equiv=\"refresh\" content=\"3;url=modules.php?name=" . $module_name . "\">";
		CloseTable();
		include ( "footer.php" );
		exit;
	}

	include ( "header.php" );
	OpenTable();

	echo "<form method=\"POST\" action=\"modules.php?name=" . $module_name . "\">\n";
	echo "<p align=\"center\">" . $opros[0] . " ?<br><br>\n";
	echo "<input type=\"text\" name=\"otviet\" size=\"30\" maxlength=\"255\">\n";
	echo "<input type=\"hidden\" name=\"username\" value=\"" . $username . "\">\n";
	echo "<input type=\"hidden\" name=\"user_email\" value=\"" . $user_email . "\">\n";
	echo "<input type=\"hidden\" name=\"gfx_check\" value=\"" . $gfx_check . "\">\n";
	echo "<input type=\"hidden\" name=\"op\" value=\"checkop\">\n";
	echo "<input type=\"submit\" value=\"" . _SENDPASSWORD . "\"></p>\n";
	echo "</form>\n";

	CloseTable();
	include ( "footer.php" );
}

/**
 * logout()
 * 
 * @param mixed $redirect
 * @param mixed $nvforw
 * @return
 */
function logout( $redirect, $nvforw )
{
	global $prefix, $db, $mbrow;

	if ( ! defined( 'IS_USER' ) )
	{
		header( "Location: index.php" );
		exit();
	}

	$r_uid = intval( $mbrow['user_id'] );
	$user = "";
	setcookie( USER_COOKIE, false );
	unset( $user );
	del_online( $r_uid );
	$db->sql_query( "DELETE FROM " . $prefix . "_bbsessions WHERE session_user_id='" . $r_uid . "'" );
	$db->sql_query( "OPTIMIZE TABLE " . $prefix . "_bbsessions" );

	include ( "header.php" );
	OpenTable();
	echo "<br><br><center><font class=\"option\"><b>" . _YOUARELOGGEDOUT . "</b></font></center>";
	echo "<p align=\"center\"><img border=\"0\" src=\"images/load_bar.gif\" width=\"97\" height=\"19\"></p><br><br>";
	if ( $nvforw != "" )
	{
		echo "<META HTTP-EQUIV=\"refresh\" content=\"3;URL=$nvforw\">";
	}
	else
		if ( $redirect != "" )
		{
			echo "<META HTTP-EQUIV=\"refresh\" content=\"3;URL=modules.php?name=$redirect\">";
		}
		else
		{
			echo "<META HTTP-EQUIV=\"refresh\" content=\"3;URL=index.php\">";
		}
		CloseTable();
	include ( "footer.php" );
}

/**
 * docookie()
 * 
 * @param mixed $setuid
 * @param mixed $setusername
 * @param mixed $setpass
 * @return
 */
function docookie( $setuid, $setusername, $setpass )
{
	$info = base64_encode( $setuid . ":" . $setusername . ":" . $setpass );
	setcookie( USER_COOKIE, $info, time() + 2592000 );
}

/**
 * docookie2()
 * 
 * @param mixed $setuid
 * @param mixed $setusername
 * @param mixed $setpass
 * @return
 */
function docookie2( $setuid, $setusername, $setpass )
{
	$info = base64_encode( $setuid . ":" . $setusername . ":" . $setpass );
	setcookie( USER_COOKIE, $info );
}

/**
 * login()
 * 
 * @param mixed $username
 * @param mixed $user_password
 * @param mixed $gfx_check
 * @param mixed $remember
 * @param mixed $nvforw
 * @return
 */
function login( $username, $user_password, $gfx_check, $remember, $nvforw )
{
	global $gfx_chk, $sitekey, $datafold, $user_prefix, $db, $module_name, $userredirect, $allowuserlogin, $suspend_nick, $nick_max;
	if ( defined( 'IS_USER' ) )
	{
		header( "Location: modules.php?name=Your_Account" );
		exit();
	}
	if ( $allowuserlogin == 1 )
	{
		info_exit( _ALLOWUSERLOGIN );
	}

	$username = trim( $_POST['username'] );
	if ( NV_userCheck2( $username ) != "" )
	{
		include ( "header.php" );
		OpenTable();
		echo "<br><br><p align=\"center\"><b>" . $stop . "</b><br><br>" . _GOBACK . "</p><br><br>";
		CloseTable();
		include ( "footer.php" );
		exit;
	}

	if ( ! empty( $suspend_nick ) )
	{
		$suspend_nick = explode( "|", $suspend_nick );
		if ( ! empty( $username ) and in_array( $username, $suspend_nick ) )
		{
			include ( "header.php" );
			OpenTable();
			echo "<br><center><font class=\"option\">" . _SUSPENDUSER1 . " <b>" . $username . "</b> " . _SUSPENDUSER2 . "</font></center><br><br>";
			CloseTable();
			include ( "footer.php" );
			exit();
		}
	}

	$gfx_check = isset( $_POST['gfx_check'] ) ? intval( $_POST['gfx_check'] ) : 0;
	if ( extension_loaded( "gd" ) and ( ! nv_capcha_txt( $gfx_check ) ) and ( $gfx_chk == 2 or $gfx_chk == 4 or $gfx_chk == 5 or $gfx_chk == 7 ) )
	{
		Header( "Location: modules.php?name=" . $module_name . "&stop=1" );
		die();
	}

	$sql = "SELECT user_password, user_id, remember FROM " . $user_prefix . "_users WHERE username=" . $db->dbescape( $username );
	$result = $db->sql_query( $sql );
	if ( $db->sql_numrows( $result ) != 1 )
	{
		Header( "Location: modules.php?name=" . $module_name . "&stop=1" );
		die();
	}

	$setinfo = $db->sql_fetchrow( $result );
	if ( $setinfo['user_id'] == 1 or empty( $setinfo['user_password'] ) )
	{
		Header( "Location: modules.php?name=" . $module_name . "&stop=1" );
		die();
	}

	$user_password = isset( $_POST['user_password'] ) ? trim( strip_tags( stripslashes( $_POST['user_password'] ) ) ) : '';
	$new_pass = md5( $user_password );
	if ( empty( $user_password ) or $new_pass != $setinfo['user_password'] )
	{
		Header( "Location: modules.php?name=" . $module_name . "&stop=1" );
		return;
	}

	$remember = isset( $_POST['remember'] ) ? intval( $_POST['remember'] ) : 0;
	if ( $remember == 1 )
	{
		docookie( $setinfo['user_id'], $username, $new_pass );
	}
	else
	{
		docookie2( $setinfo['user_id'], $username, $new_pass );
	}
	if ( $remember != $setinfo['remember'] )
	{
		$db->sql_query( "UPDATE " . $user_prefix . "_users SET remember='" . $remember . "'  WHERE username=" . $db->dbescape( $username ) );
	}

	$uname = $_SERVER["REMOTE_ADDR"];
	del_online( $uname );

	$redirect = addslashes( trim( ( isset( $_POST['redirect'] ) ) ? $_POST['redirect'] : ( isset( $_GET['redirect'] ) ? $_GET['redirect'] : '' ) ) );
	$mode = addslashes( trim( ( isset( $_POST['mode'] ) ) ? $_POST['mode'] : ( isset( $_GET['mode'] ) ? $_GET['mode'] : '' ) ) );
	if ( ! empty( $redirect ) and preg_match( "/[^a-zA-Z0-9_]/", $redirect ) )
	{
		$redirect = '';
	}

	if ( ! empty( $mode ) and preg_match( "/[^a-zA-Z0-9_]/", $mode ) )
	{
		$mode = '';
	}

	$f = intval( ( isset( $_POST['f'] ) ) ? $_POST['f'] : $_GET['f'] );
	$t = intval( ( isset( $_POST['t'] ) ) ? $_POST['t'] : $_GET['t'] );

	$forward = ereg_replace( "redirect=", "", $redirect );
	if ( ereg( "privmsg", $forward ) )
	{
		$pm_login = "active";
	}

	if ( ! empty( $nvforw ) and $nvforw != "index.php" )
	{
		$nvurl = $nvforw;
	} elseif ( ! empty( $pm_login ) )
	{
		$nvurl = "modules.php?name=Private_Messages&file=index&folder=inbox";
	} elseif ( empty( $redirect ) )
	{
		if ( empty( $userredirect ) )
		{
			$nvurl = "modules.php?name=Your_Account&op=userinfo";
		} elseif ( $userredirect == "home" )
		{
			$nvurl = "index.php";
		}
		else
		{
			$nvurl = "modules.php?name=" . $userredirect;
		}
	} elseif ( empty( $mode ) )
	{
		$nvurl = "modules.php?name=Forums&file=" . $forward;
	} elseif ( $t != "" )
	{
		$nvurl = "modules.php?name=Forums&file=" . $forward . "&mode=" . $mode . "&t=" . $t;
	}
	else
	{
		$nvurl = "modules.php?name=Forums&file=" . $forward . "&mode=" . $mode . "&f=" . $f;
	}

	include ( "header.php" );
	OpenTable();
	echo "<br><br><center><font class=\"option\"><b>" . _YOUARELOGGED . " " . _MEMBERS . "</b></font></center>";
	echo "<p align=\"center\"><img border=\"0\" src=\"images/load_bar.gif\" width=\"97\" height=\"19\"></p>";
	echo "<META HTTP-EQUIV=\"refresh\" content=\"2;URL=" . $nvurl . "\">";
	echo "<p align=\"center\">[<a href=\"" . $nvurl . "\">" . _QLOGIN . "</a>]</p><br><br>";
	CloseTable();
	include ( "footer.php" );
	exit();

}

/**
 * edituser()
 * 
 * @return
 */
function edituser()
{
	global $allowuserlogin, $allowmailchange, $suspend_nick, $module_name;

	if ( ! defined( 'IS_USER' ) )
	{
		Header( "Location: modules.php?name=" . $module_name );
		exit();
	}

	if ( $allowuserlogin == 1 )
	{
		info_exit( _ALLOWUSERLOGIN );
	}

	global $mbrow;

	if ( ! empty( $suspend_nick ) )
	{
		$suspend_nick = explode( "|", $suspend_nick );
		if ( empty( $mbrow['username'] ) or in_array( $mbrow['username'], $suspend_nick ) )
		{
			Header( "Location: modules.php?name=" . $module_name . "&op=logout" );
			exit;
		}
	}

	include ( "header.php" );
	OpenTable();
	echo "<center><font class=\"option\">" . _PERSONALINFO . ": <b>" . $mbrow['viewuname'] . "</b></font></center><br><br>";
	echo "<table border=\"0\" style=\"border-collapse: collapse\" width=\"100%\" cellspacing=\"3\">\n";
	echo "<tr>\n";
	echo "<td width=\"20\">\n";
	echo "<a href=\"modules.php?name=Your_Account\"><img border=\"0\" src=\"images/in.gif\" width=\"20\" height=\"20\"></a></td>\n";
	echo "<td><a href=\"modules.php?name=Your_Account\">" . _USERPAGE . "</a></td>\n";
	echo "<td width=\"20\">\n";
	echo "<a href=\"modules.php?name=Your_Account&amp;op=changpass\"><img border=\"0\" src=\"images/in.gif\" width=\"20\" height=\"20\"></a></td>\n";
	echo "<td><a href=\"modules.php?name=Your_Account&amp;op=changpass\">" . _CHPASSW . "</a></td>\n";
	echo "</tr>\n";
	echo "<tr>\n";
	echo "<td width=\"20\">\n";
	echo "<a href=\"index.php\"><img border=\"0\" src=\"images/in.gif\" width=\"20\" height=\"20\"></a></td>\n";
	echo "<td><a href=\"index.php\">" . _HOMEPAGE . "</a></td>\n";
	echo "<td width=\"20\">\n";
	echo "<a href=\"modules.php?name=Your_Account&amp;op=logout\"><img border=\"0\" src=\"images/out.gif\" width=\"20\" height=\"20\"></a></td>\n";
	echo "<td><a href=\"modules.php?name=Your_Account&amp;op=logout\">" . _LOGOUTEXIT . "</a></td>\n";
	echo "</tr>\n";
	echo "</table>\n";
	CloseTable();
	echo "<br>\n";
	OpenTable();
	echo "\n<script>\n";
	echo "function check_data(Forma) {\n";
	echo "if (Forma.user_email.value == \"\")  {\n";
	echo "alert(\"" . _MAILBLOCKED . "\");\n";
	echo "Forma.user_email.focus();\n";
	echo "return false;\n";
	echo "}\n";
	echo "t = Forma.user_email.value.search(\"@\");\n";
	echo "k = Forma.user_email.value.search(\" \");\n";
	echo "if(k >= 0){\n";
	echo "alert(\"" . _EMAILNOTUSABLE . "\");\n";
	echo "Forma.user_email.focus();\n";
	echo "return false;\n";
	echo "}\n";
	echo "if(t <= -1){\n";
	echo "alert(\"" . _EMAILNOTUSABLE . "\");\n";
	echo "Forma.user_email.focus();\n";
	echo "return false;\n";
	echo "}\n";
	echo "var filter =/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,6})+$/;\n";
	echo "if (!filter.test(Forma.user_email.value)) {\n";
	echo "alert(\"" . _EMAILNOTUSABLE . "\");\n";
	echo "Forma.user_email.focus();\n";
	echo "return false;\n";
	echo "}\n";
	echo "return true; \n";
	echo "}\n";
	echo "</script>\n";
	echo "<table cellpadding=\"3\" border=\"0\" width='100%'><tr><td>\n";
	echo "<form onsubmit=\"return check_data(this)\"  action=\"modules.php?name=$module_name\" method=\"post\">\n";
	echo "<b>" . _USRNICKNAME . "</b>:</td><td><b>" . $mbrow['username'] . "</b></td></tr><tr>\n";
	echo "<tr><td><b>" . _VIEWNAME . "</b>:<br>" . _OPTIONAL . "</td><td>\n";
	echo "<input type=\"text\" name=\"viewuname\" value=\"" . nv_htmlspecialchars( $mbrow['viewuname'] ) . "\" size=\"50\" maxlength=\"60\"></td></tr>\n";
	echo "<tr><td><b>" . _UREALNAME . "</b>:<br>" . _OPTIONAL . "</td><td>\n";
	echo "<input type=\"text\" name=\"realname\" value=\"" . nv_htmlspecialchars( $mbrow['name'] ) . "\" size=\"50\" maxlength=\"60\"></td></tr>\n";
	echo "<tr><td><b>" . _UREALLASTNAME . "</b>:<br>" . _OPTIONAL . "</td><td>\n";
	echo "<input type=\"text\" name=\"reallastname\" value=\"" . nv_htmlspecialchars( $mbrow['lastname'] ) . "\" size=\"50\" maxlength=\"60\"></td></tr>\n";
	if ( $allowmailchange == 1 )
	{
		echo "<tr><td><b>" . _UREALEMAIL . ":</b><br>" . _REQUIRED . "</td>\n";
		echo "<td><input type=\"text\" name=\"user_email\" value=\"" . $mbrow['user_email'] . "\" size=\"50\" maxlength=\"60\"></td></tr>\n";
	}
	else
	{
		echo "<tr><td><b>" . _UREALEMAIL . ":</b></td>\n";
		echo "<td>" . $mbrow['user_email'] . "</td></tr>\n";
		echo "<input type=\"hidden\" name=\"user_email\" value=\"" . $mbrow['user_email'] . "\">\n";
	}
	echo "<tr><td><b>" . _YOURHOMEPAGE . ":</b><br>" . _OPTIONAL . "</td>\n";
	echo "<td><input type=\"text\" name=\"user_website\" value=\"" . $mbrow['user_website'] . "\" size=\"50\" maxlength=\"255\"></td></tr>\n";
	echo "<tr><td><b>" . _YICQ . ":</b><br>" . _OPTIONAL . "</td>\n";
	echo "<td><input type=\"text\" name=\"user_icq\" value=\"" . nv_htmlspecialchars( $mbrow['user_icq'] ) . "\" size=\"30\" maxlength=\"100\"></td></tr>\n";
	echo "<tr><td><b>" . _YTELEPHONE . ":</b><br>" . _OPTIONAL . "</td>\n";
	echo "<td><input type=\"text\" name=\"user_telephone\" value=\"" . nv_htmlspecialchars( $mbrow['user_telephone'] ) . "\" size=\"30\" maxlength=\"100\"></td></tr>\n";
	echo "<tr><td><b>" . _YLOCATION . ":</b><br>" . _OPTIONAL . "</td>\n";
	echo "<td><input type=\"text\" name=\"user_from\" value=\"" . nv_htmlspecialchars( $mbrow['user_from'] ) . "\" size=\"30\" maxlength=\"100\"></td></tr>\n";
	echo "<tr><td><b>" . _YINTERESTS . ":</b><br>" . _OPTIONAL . "</td>\n";
	echo "<td><input type=\"text\" name=\"user_interests\" value=\"" . nv_htmlspecialchars( $mbrow['user_interests'] ) . "\" size=\"30\" maxlength=\"100\"></td></tr>\n";
	echo "<tr><td><b>" . _YSIGNATURE . ":</b><br>" . _OPTIONAL . "</td>\n";
	echo "<td><textarea wrap=\"virtual\" cols=\"50\" rows=\"5\" name=\"user_sig\">" . nv_htmlspecialchars( nv_br2nl( $mbrow['user_sig'] ) ) . "</textarea><br>" . _255CHARMAX . "</td></tr>\n";
	echo "<tr><td><b>" . _ALWAYSSHOWEMAIL . ":</b></td><td>\n";
	if ( $mbrow['user_viewemail'] == 1 )
	{
		echo "<input type=\"radio\" name=\"user_viewemail\" value=\"1\" checked>" . _YES . " &nbsp;\n";
		echo "<input type=\"radio\" name=\"user_viewemail\" value=\"0\">" . _NO . "";
	} elseif ( $mbrow['user_viewemail'] == 0 )
	{
		echo "<input type=\"radio\" name=\"user_viewemail\" value=\"1\">" . _YES . " &nbsp;\n";
		echo "<input type=\"radio\" name=\"user_viewemail\" value=\"0\" checked>" . _NO . "";
	}
	echo "</td></tr>\n";

	echo "<tr><td colspan='2' align='center'>\n";
	echo "<input type=\"hidden\" name=\"user_id\" value=\"" . $mbrow['user_id'] . "\">\n";
	echo "<input type=\"hidden\" name=\"op\" value=\"saveuser\">\n";
	echo "<input type=\"submit\" value=\"" . _SAVECHANGES . "\">\n";
	echo "</form></td></tr></table>\n";
	CloseTable();
	include ( "footer.php" );
}

/**
 * saveuser()
 * 
 * @return
 */
function saveuser()
{
	global $suspend_nick, $allowmailchange, $allowuserlogin, $user_prefix, $db, $module_name;
	if ( $allowuserlogin == 1 )
	{
		info_exit( _ALLOWUSERLOGIN );
	}
	if ( ! defined( 'IS_USER' ) )
	{
		info_exit( _MUSTBEUSER );
	}

	global $mbrow, $user_ar;
	if ( ! empty( $suspend_nick ) )
	{
		$suspend_nick = explode( "|", $suspend_nick );
		if ( empty( $mbrow['username'] ) or in_array( $mbrow['username'], $suspend_nick ) )
		{
			Header( "Location: modules.php?name=" . $module_name . "&op=logout" );
			exit;
		}
	}

	$user_id = intval( $_POST['user_id'] );
	list( $user_password, $user_email2 ) = $db->sql_fetchrow( $db->sql_query( "SELECT user_password, user_email FROM " . $user_prefix . "_users WHERE user_id='" . $user_id . "'" ) );
	if ( $user_id != $user_ar[0] || $user_password != $user_ar[2] )
	{
		Header( "Location: index.php" );
		exit();
	}

	$user_email = trim( nv_htmlspecialchars( strip_tags( stripslashes($_POST['user_email']) ) ) );
	$nemail = ( $allowmailchange == 0 ) ? $user_email2 : $user_email;

	if ( $allowmailchange and $nemail != $user_email2 )
	{
		$error = NV_mailCheck( $nemail );
		if ( $error != '' )
		{
			info_exit( $error . "<br><br>" . _GOBACK );
		}
	}

	$viewuname = trim( nv_htmlspecialchars( strip_tags( stripslashes( $_POST['viewuname'] ) ) ) );
	if ( empty( $viewuname ) ) $viewuname = $user_ar[1];

	$user_website = trim( strip_tags( stripslashes( $_POST['user_website'] ) ) );
	if ( ! empty( $user_website ) and ! preg_match( '#^http[s]?:\/\/#i', $user_website ) ) $user_website = "http://" . $user_website;
	if ( ! empty( $user_website ) and ! preg_match( '#^http[s]?\\:\\/\\/[a-z0-9-]+\.([a-z0-9-]+\.)?[a-z]+#i', $user_website ) ) $user_website = '';

	$realname = trim( nv_htmlspecialchars( strip_tags( stripslashes( $_POST['realname'] ) ) ) );
	$reallastname = trim( nv_htmlspecialchars( strip_tags( stripslashes( $_POST['reallastname'] ) ) ) );
	$user_icq = trim( nv_htmlspecialchars( strip_tags( stripslashes( $_POST['user_icq'] ) ) ) );
	$user_telephone = trim( nv_htmlspecialchars( strip_tags( stripslashes( $_POST['user_telephone'] ) ) ) );
	$user_from = trim( nv_htmlspecialchars( strip_tags( stripslashes( $_POST['user_from'] ) ) ) );
	$user_interests = trim( nv_htmlspecialchars( strip_tags( stripslashes( $_POST['user_interests'] ) ) ) );
	$user_viewemail = trim( nv_htmlspecialchars( strip_tags( stripslashes( $_POST['user_viewemail'] ) ) ) );
	$user_sig = nv_nl2br( trim( content_filter( strip_tags( stripslashes( $_POST['user_sig'] ) ), 1 ) ), '<br />' );

	$db->sql_query( "UPDATE " . $user_prefix . "_users SET 
                viewuname=" . $db->dbescape( $viewuname ) . ", 
                name=" . $db->dbescape( $realname ) . ", 
                lastname=" . $db->dbescape( $reallastname ) . ", 
                user_email=" . $db->dbescape( $nemail ) . ", 
                user_website=" . $db->dbescape( $user_website ) . ", 
                user_icq=" . $db->dbescape( $user_icq ) . ", 
                user_telephone=" . $db->dbescape( $user_telephone ) . ", 
                user_from=" . $db->dbescape( $user_from ) . ", 
                user_interests=" . $db->dbescape( $user_interests ) . ", 
                user_sig=" . $db->dbescape( $user_sig ) . ", 
                user_viewemail=" . $db->dbescape( $user_viewemail ) . " 
            WHERE user_id='" . intval( $user_id ) . "'" );

	Header( "Location: modules.php?name=" . $module_name . "&op=edituser" );
}

/**
 * changpass()
 * 
 * @return
 */
function changpass()
{
	global $suspend_nick, $allowuserlogin, $module_name, $pass_max;
	if ( $allowuserlogin == 1 )
	{
		info_exit( _ALLOWUSERLOGIN );
	}
	if ( ! defined( 'IS_USER' ) )
	{
		Header( "Location: modules.php?name=$module_name" );
		exit();
	}

	global $mbrow;
	if ( ! empty( $suspend_nick ) )
	{
		$suspend_nick = explode( "|", $suspend_nick );
		if ( empty( $mbrow['username'] ) or in_array( $mbrow['username'], $suspend_nick ) )
		{
			Header( "Location: modules.php?name=" . $module_name . "&op=logout" );
			exit;
		}
	}

	include ( "header.php" );
	OpenTable();
	echo "<center><font class=\"option\">" . _PERSONALINFO . ": <b>" . nv_htmlspecialchars( $mbrow['viewuname'] ) . "</b></font></center><br><br>";
	echo "<table border=\"0\" style=\"border-collapse: collapse\" width=\"100%\" cellspacing=\"3\">\n";
	echo "<tr>\n";
	echo "<td width=\"20\">\n";
	echo "<a href=\"modules.php?name=Your_Account&amp;op=edituser\"><img border=\"0\" src=\"images/in.gif\" width=\"20\" height=\"20\"></a></td>\n";
	echo "<td><a href=\"modules.php?name=Your_Account&amp;op=edituser\">" . _CHANGEYOURINFO . "</a></td>\n";
	echo "<td width=\"20\">\n";
	echo "<a href=\"modules.php?name=Your_Account\"><img border=\"0\" src=\"images/in.gif\" width=\"20\" height=\"20\"></a></td>\n";
	echo "<td><a href=\"modules.php?name=Your_Account\">" . _USERPAGE . "</a></td>\n";
	echo "</tr>\n";
	echo "<tr>\n";
	echo "<td width=\"20\">\n";
	echo "<a href=\"index.php\"><img border=\"0\" src=\"images/in.gif\" width=\"20\" height=\"20\"></a></td>\n";
	echo "<td><a href=\"index.php\">" . _HOMEPAGE . "</a></td>\n";
	echo "<td width=\"20\">\n";
	echo "<a href=\"modules.php?name=Your_Account&amp;op=logout\"><img border=\"0\" src=\"images/out.gif\" width=\"20\" height=\"20\"></a></td>\n";
	echo "<td><a href=\"modules.php?name=Your_Account&amp;op=logout\">" . _LOGOUTEXIT . "</a></td>\n";
	echo "</tr>\n";
	echo "</table>\n";
	CloseTable();
	echo "<br>\n";
	OpenTable();
	echo "<table cellpadding=\"3\" border=\"0\" width='100%'><tr><td>\n";
	echo "<form action=\"modules.php?name=" . $module_name . "\" method=\"post\">\n";
	echo "<b>" . _PASSWORD . "</b>:</td><td><input type=\"password\" name=\"pass\" size=\"22\" maxlength=\"" . $pass_max . "\"></td></tr><tr>\n";
	echo "<tr><td><b>" . _TYPENEWPASSWORD . "</b>:</td><td><input type=\"password\" name=\"newpass1\" size=\"22\" maxlength=\"" . $pass_max . "\"></td></tr><tr>\n";
	echo "<tr><td><b>" . _RETYPEPASSWORD . "</b>:</td><td><input type=\"password\" name=\"newpass2\" size=\"22\" maxlength=\"" . $pass_max . "\"></td></tr>\n";
	echo "<tr><td colspan='2' align='center'>\n";
	echo "<input type=\"hidden\" name=\"op\" value=\"savechangpass\">\n";
	echo "<input type=\"submit\" value=\"" . _SAVECHANGES . "\">\n";
	echo "</form></td></tr></table>\n";
	CloseTable();
	include ( "footer.php" );
}

/**
 * savechangpass()
 * 
 * @return
 */
function savechangpass()
{
	global $allowuserlogin, $suspend_nick, $module_name, $user_prefix, $db, $pass_max;
	if ( $allowuserlogin == 1 )
	{
		info_exit( _ALLOWUSERLOGIN );
	}
	if ( ! defined( 'IS_USER' ) )
	{
		Header( "Location: modules.php?name=" . $module_name );
		exit();
	}

	global $mbrow;
	if ( ! empty( $suspend_nick ) )
	{
		$suspend_nick = explode( "|", $suspend_nick );
		if ( empty( $mbrow['username'] ) or in_array( $mbrow['username'], $suspend_nick ) )
		{
			Header( "Location: modules.php?name=" . $module_name . "&op=logout" );
			exit;
		}
	}

	$pass = md5( stripslashes( $_POST['pass'] ) );
	if ( $pass != $mbrow['user_password'] )
	{
		info_exit( "<br><br><p align=\"center\">" . _LOGININCOR . "</p><br><br><META HTTP-EQUIV=\"refresh\" content=\"2;URL=modules.php?name=" . $module_name . "&op=changpass\">" );
	}
	$newpass1 = trim( strip_tags( stripslashes( $_POST['newpass1'] ) ) );
	$newpass2 = trim( strip_tags( stripslashes( $_POST['newpass2'] ) ) );
	$newpass1 = substr( $newpass1, 0, $pass_max );
	$newpass2 = substr( $newpass2, 0, $pass_max );

	$stop = NV_passCheck( $newpass1, $newpass2 );
	if ( ! empty( $stop ) )
	{
		info_exit( "<br><br><p align=\"center\"><b>" . _NOCHPASSW . "</b><br><br>" . $stop . "</p><br><br><meta http-equiv=\"refresh\" content=\"3;url=modules.php?name=" . $module_name . "&op=changpass\">" );
	}

	$newpass1a = md5( $newpass1 );
	if ( $newpass1a == $mbrow['user_password'] )
	{
		Header( "Location: modules.php?name=" . $module_name . "&op=changpass" );
		exit;
	}

	$query = "UPDATE " . $user_prefix . "_users SET user_password = " . $db->dbescape( $newpass1a ) . " WHERE user_id='" . $mbrow['user_id'] . "'";
	$db->sql_query( $query );
	del_online( $mbrow['user_id'] );
	$user = "";
	setcookie( USER_COOKIE, false );
	include ( "header.php" );
	OpenTable();
	echo "<br><br><p align=\"center\"><img border=\"0\" src=\"images/load_bar.gif\" width=\"97\" height=\"19\"></p><br><br>";
	echo "<META HTTP-EQUIV=\"refresh\" content=\"2;URL=modules.php?name=" . $module_name . "\">";
	CloseTable();
	include ( "footer.php" );
	exit;
}

switch ( $op )
{

	case "logout":
		logout( $redirect, $nvforw );
		break;

	case "lost_pass":
		lost_pass();
		break;

	case "finish":
		finishNewUser();
		break;

	case "userinfo":
		userinfo();
		break;

	case "login":
		login( $username, $user_password, $gfx_check, $remember, $nvforw );
		break;

	case "edituser":
		edituser();
		break;

	case "saveuser":
		saveuser();
		break;

	case "pass_lost":
		pass_lost();
		break;

	case "new_user":
		new_user();
		break;

	case "activate":
		activate();
		break;

	case "changpass":
		changpass();
		break;

	case "savechangpass":
		savechangpass();
		break;

	case "checkop":
		checkop();
		break;

	default:
		NV_main();
		break;

}

?>
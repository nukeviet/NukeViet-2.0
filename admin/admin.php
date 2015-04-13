<?php

/*
* @Program:		NukeViet CMS
* @File name: 	NukeViet System
* @Version: 	2.0 RC1
* @Date: 		01.05.2009
* @Website: 	www.nukeviet.vn
* @Copyright: 	(C) 2009
* @License: 	http://opensource.org/licenses/gpl-license.php GNU Public License
*/

if ( file_exists("../install/install.php") )
{
	Header( "Location:../install/install.php" );
	exit;
}
if ( ! file_exists("../mainfile.php") ) exit();

define( 'NV_ADMIN', true );
@require_once ( "../mainfile.php" );
@require ( "../" . $datafold . "/config_admin.php" );
if ( $editor )
{
	if ( file_exists("spaw2/spaw.inc.php") )
	{
		@require_once ( "spaw2/spaw.inc.php" );
	} elseif ( file_exists("" . INCLUDE_PATH . "spaw/spaw_control.class.php") )
	{
		@require_once ( "" . INCLUDE_PATH . "spaw/spaw_control.class.php" );
	}
}
if ( isset($aid) )
{
	if ( $aid and (! isset($_SESSION[ADMIN_COOKIE]) or empty($_SESSION[ADMIN_COOKIE])) and $op != 'login' )
	{
		unset( $aid );
		unset( $_SESSION[ADMIN_COOKIE] );
		die( "Access Denied" );
	}
}

$checkurl = $_SERVER['REQUEST_URI'];

if ( (stripos_clone($_SERVER["QUERY_STRING"], 'AddAuthor')) || (stripos_clone($_SERVER["QUERY_STRING"], 'VXBkYXRlQXV0aG9y')) || (stripos_clone($_SERVER["QUERY_STRING"], 'QWRkQXV0aG9y')) || (stripos_clone($_SERVER["QUERY_STRING"], 'UpdateAuthor')) || (preg_match("/\?admin/", "$checkurl")) || (preg_match("/\&admin/", "$checkurl")) )
{
	die( "Illegal Operation" );
}

get_lang( 'admin' );
$module_title = _ADMINPAGE;

if ( ($block_admin_ip) and ($allowed_admin_ip != "") )
{
	switch ( $ip_test_fields )
	{
		case 1:
			$ip_mask = "/\.[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}$/";
			break;
		case 2:
			$ip_mask = "/\.[0-9]{1,3}.[0-9]{1,3}$/";
			break;
		case 3:
			$ip_mask = "/\.[0-9]{1,3}$/";
			break;
		default:
			$ip_mask = "//";
	}

	$client_ip = $_SERVER['HTTP_CLIENT_IP'];
	if ( ! strstr($client_ip, ".") ) $client_ip = $_SERVER['REMOTE_ADDR'];
	if ( ! strstr($client_ip, ".") ) $client_ip = getenv( "REMOTE_ADDR" );
	$client_ip = trim( $client_ip );
	$client_ip_tmp = preg_replace( $ip_mask, "", $client_ip );
	$allowed_admin_array = explode( "|", $allowed_admin_ip );
	for ( $j = 0; $j < sizeof($allowed_admin_array); $j++ )
	{
		$allowed_admin_ip_tmp[$j] = preg_replace( $ip_mask, "", $allowed_admin_array[$j] );
	}
	if ( ! in_array($client_ip_tmp, $allowed_admin_ip_tmp) )
	{
		die();
	}
}


if ( ($firewall) and ($adv_admin != "") )
{
	if ( $op == "logout" )
	{
		setcookie( "adv_sdmin_test", "", 0, $cookie_path, $cookie_domain );
	}
	else
	{
		$adv_admin_array = explode( "|", $adv_admin );
		if ( isset($_POST["adv_op"]) && $_POST["adv_op"] == "go" )
		{
			$adv_admin_name_post = trim( $_POST['adv_admin_name_post'] );
			$adv_admin_pass_post = trim( $_POST['adv_admin_pass_post'] );
			$adv_admin_post_tmp = "$adv_admin_name_post:$adv_admin_pass_post";
			if ( ! in_array($adv_admin_post_tmp, $adv_admin_array) )
			{
				header( "Location: " . $adminfile . ".php" );
				exit;
			}
			setcookie( "adv_sdmin_test", md5($adv_admin_post_tmp), time() + $expiring_login, $cookie_path, $cookie_domain );
		}
		else
		{
			for ( $l = 0; $l < sizeof($adv_admin_array); $l++ )
			{
				$adv_admin_tmp[$l] = md5( $adv_admin_array[$l] );
			}
			if ( ! in_array($_COOKIE["adv_sdmin_test"], $adv_admin_tmp) )
			{
				echo "<html>\n\n<head>\n" . "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=" . _CHARSET . "\">\n" . "<link rel=\"StyleSheet\" href=\"../templates/$ThemeSel/style/style.css\" type=\"text/css\">\n" . "<title>Firewall</title>\n</head>\n\n" . "<body topmargin=\"20\" leftmargin=\"20\" rightmargin=\"20\" bottommargin=\"20\">\n\n" . "<table border=\"0\" cellpadding=\"0\" style=\"border-collapse: collapse\" width=\"100%\" height=\"100%\">\n" . "<tr>\n<td align=\"center\">\n" . "<table border=\"4\" cellpadding=\"5\" style=\"border-collapse: collapse\" bordercolor=\"#808000\" bgcolor=\"#FFFF9F\" cellspacing=\"5\">\n" . "<tr>\n<td align=\"center\"><b>Firewall</b><br><br>\n" . "<form method=\"POST\" action=\"" . $adminfile . ".php\">\n" . "<table border=\"0\" cellpadding=\"0\" style=\"border-collapse: collapse\" width=\"100%\">\n" . "<tr>\n<td><b>" . _NICKNAME . ":</b>&nbsp;&nbsp;</td>\n" . "<td><input type=\"text\" name=\"adv_admin_name_post\" size=\"20\" maxlength=\"50\"></td>\n</tr>\n" .
					"<tr>\n<td><b>" . _PASSWORD . ":</b>&nbsp;&nbsp;</td>\n" . "<td><input type=\"password\" name=\"adv_admin_pass_post\" size=\"20\" maxlength=\"30\"></td>\n</tr>\n" . "<tr><td>&nbsp;</td><td>\n" . "<input type=\"hidden\" name=\"adv_op\" value=\"go\">\n" . "<input type=\"submit\" value=\"" . _LOGIN . "\">\n" . "</td></tr></table></form>\n</td>\n</tr>\n</table>\n</td>\n</tr>\n</table>\n\n</body>\n\n</html>";
				exit();
			}
		}
	}
}

if ( ! file_exists("../$datafold/admlock.php") )
{
	/**
	 * create_first()
	 * 
	 * @return
	 */
	function create_first()
	{
		global $adminfile, $prefix, $db, $nukeurl, $adminmail;
		$first = $db->sql_numrows( $db->sql_query("SELECT * FROM " . $prefix . "_authors") );
		if ( $first == 0 )
		{
			$name = $_POST['name'];
			$pwd = $_POST['pwd'];
			$email = $_POST['email'];
			$url = $_POST['url'];
			$$user_new = $_POST['user_new'];
			$stop = "";
			if ( (! $name) || ($name == "") || (ereg("[^a-zA-Z0-9_-]", $name)) )
			{
				$stop = "" . _ERRORINVNICK . "";
			} elseif ( strlen($name) > 25 )
			{
				$stop = "" . _NICK2LONG . "";
			} elseif ( strlen($name) < 5 )
			{
				$stop = "" . _NICKADJECTIVE . "";
			} elseif ( strrpos($name, ' ') > 0 )
			{
				$stop = "" . _NICKNOSPACES . "";
			} elseif ( strlen($pwd) > 40 )
			{
				$stop = "" . _PASSLENGTH . "";
			} elseif ( strlen($pwd) < 5 )
			{
				$stop = "" . _PASSLENGTH1 . "";
			} elseif ( strrpos($pwd, ' ') > 0 )
			{
				$stop = "" . _PASSNOSPACES . "";
			}
			if ( $stop != "" )
			{
				info_exit( $stop );
			}
			$pwd = md5( $pwd );
			$the_adm = "God";
			$db->sql_query( "INSERT INTO " . $prefix . "_authors (aid, name, url, email, pwd, radminsuper, admlanguage) VALUES ('$name', '$the_adm', '$url', '$email', '$pwd', '1','')" );
			@chmod( "../$datafold/admlock.php", 0777 );
			@$file = fopen( "../$datafold/admlock.php", "w" );
			$content = "<?php\n\n";
			$content .= "?>";
			@$writefile = fwrite( $file, $content );
			@fclose( $file );
			@chmod( "../$datafold/admlock.php", 0604 );
			if ( $user_new == 1 )
			{
				$user_regdate = date( "M d, Y" );
				if ( $url == "http://" )
				{
					$url = "";
				}
				$db->sql_query( "INSERT INTO " . $user_prefix . "_users (user_id, username, user_email, user_website, user_regdate, user_password, theme, user_lang) VALUES (NULL,'$name','$email','$url','$user_regdate','$pwd','$Default_Theme','')" );
			}
			login();
		}
	}

	$the_first = $db->sql_numrows( $db->sql_query("SELECT * FROM " . $prefix . "_authors") );
	if ( $the_first == 0 )
	{
		if ( ! $name )
		{
			echo "<html>\n\n<head>\n" . "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=" . _CHARSET . "\">\n" . "<link rel=\"StyleSheet\" href=\"../templates/$ThemeSel/style/style.css\" type=\"text/css\">\n" . "<title>" . _NOADMINYET . "</title>\n</head>\n\n" . "<body topmargin=\"20\" leftmargin=\"20\" rightmargin=\"20\" bottommargin=\"20\">\n\n" . "<table border=\"0\" cellpadding=\"0\" style=\"border-collapse: collapse\" width=\"100%\" height=\"100%\">\n" . "<tr>\n<td align=\"center\">\n" . "<table width=\"300\" border=\"4\" cellpadding=\"5\" style=\"border-collapse: collapse\" bordercolor=\"#808000\" bgcolor=\"#FFFF9F\" cellspacing=\"5\">\n" . "<tr>\n<td align=\"center\"><b>" . _NOADMINYET . "</b><br><br>\n" . "<form method=\"POST\" action=\"" . $adminfile . ".php\">\n" . "<table border=\"0\" cellpadding=\"0\" style=\"border-collapse: collapse\" width=\"100%\">\n" . "<tr>\n<td><b>" . _NICKNAME . ":</b>&nbsp;&nbsp;</td>\n" . "<td><input type=\"text\" name=\"name\" size=\"20\" maxlength=\"25\"></td>\n</tr>\n" .
				"<tr>\n<td><b>" . _EMAIL . ":</b>&nbsp;&nbsp;</td>\n" . "<td><input type=\"text\" name=\"email\" size=\"20\" maxlength=\"100\"></td>\n</tr>\n" . "<tr>\n<td><b>" . _PASSWORD . ":</b>&nbsp;&nbsp;</td>\n" . "<td><input type=\"password\" name=\"pwd\" size=\"20\" maxlength=\"40\"></td>\n</tr>\n" . "<tr><td>&nbsp;</td><td>\n" . "<input type=\"hidden\" name=\"url\" value=\"$nukeurl\">" . "<input type=\"hidden\" name=\"user_new\" value=\"1\">" . "<input type=\"hidden\" name=\"fop\" value=\"create_first\">\n" . "<input type=\"submit\" value=\"" . _CREATEADMIN . "\">\n" . "</td></tr></table></form>\n</td>\n</tr>\n</table>\n</td>\n</tr>\n</table>\n\n</body>\n\n</html>";
		}
		switch ( $fop )
		{
			case "create_first":
				create_first();
				break;
		}
		die();
	}
}

if ( isset($aid) && (ereg("[^a-zA-Z0-9_-]", trim($aid))) )
{
	die( "Begone" );
}

if ( isset($aid) )
{
	$aid = substr( $aid, 0, 25 );
}
if ( isset($pwd) )
{
	$pwd = substr( $pwd, 0, 40 );
}
if ( (isset($aid)) && (isset($pwd)) && (isset($op)) && ($op == "login") )
{
	session_register( "adm_log" );
	session_register( "schet" );

	if ( ! isset($_SESSION['schet']) )
	{
		$_SESSION['schet'] = 0;
	}
	if ( ! isset($_SESSION['adm_log']) || ($_SESSION['adm_log'] >= time() + 86400) )
	{
		$_SESSION['adm_log'] = time();
	}
	if ( isset($_SESSION['adm_log']) && ($_SESSION['adm_log'] >= time()) && isset($_SESSION['schet']) && ($_SESSION['schet'] >= 5) )
	{
		$timeout2 = $_SESSION['adm_log'] - time() + 1;
		$info = "<script language=\"JavaScript\">\n";
		$info .= "var Timeout = $timeout2;\n";
		$info .= "var timeBegin = new Date();\n";
		$info .= "var msBegin = timeBegin.getTime();\n";
		$info .= "function showSeconds()\n";
		$info .= "{\n";
		$info .= "var timeCurrent = new Date();\n";
		$info .= "var msCurrent = timeCurrent.getTime();\n";
		$info .= "var ms = Math.round((msCurrent - msBegin)/1000);\n";
		$info .= "document.secForm.secField.value = Timeout - ms;\n";
		$info .= "if( Timeout <= ms )\n";
		$info .= "location.reload();\n";
		$info .= "}\n";
		$info .= "timerID = setInterval(\"showSeconds()\", 1000);\n";
		$info .= "</script>\n";
		$info .= "<p align=\"center\"><img border=\"0\" src=\"images/load_bar.gif\" width=\"97\" height=\"19\"></p>\n";
		$info .= "<form name=\"secForm\">\n";
		$info .= "" . _INFTIMEOUT . " " . $_SESSION['schet'] . " " . _INFTIMEOUT2 . "\n";
		$info .= "<input type=\"text\" align=\"right\" name=\"secField\" readonly Size=1>\n";
		$info .= "" . _SECONDS . ".\n";
		$info .= "</form>\n";
		info_exit( $info );
	}
	$_SESSION['schet']++;
	if ( $_SESSION['schet'] >= 5 )
	{
		$_SESSION['adm_log'] = time() + ( $_SESSION['schet'] - 4 ) * 300;
	}

	if ( extension_loaded("gd") and (! nv_capcha_txt($gfx_check)) and ($gfx_chk == 1 or $gfx_chk == 5 or $gfx_chk == 6 or $gfx_chk == 7) )
	{
		Header( "Location: " . $adminfile . ".php" );
		die();
	}
	if ( ! empty($aid) and ! empty($pwd) )
	{
		$pwd = md5( $pwd );
		list( $rpwd, $admlanguage, $bemail ) = $db->sql_fetchrow( $db->sql_query("SELECT pwd, admlanguage, email FROM " . $prefix . "_authors WHERE aid='$aid'") );
		$admlanguage = addslashes( $admlanguage );
		if ( $rpwd == $pwd and $bemail == $_POST['email'] )
		{
			mt_srand( (double)microtime() * 1000000 );
			$maxran = 1000000;
			$checknum = mt_rand( 0, $maxran );
			$checknum = md5( $checknum );
			$agent = substr( trim($_SERVER['HTTP_USER_AGENT']), 0, 80 );
			$addr_ip = substr( trim($client_ip), 0, 15 );
			$db->sql_query( "UPDATE " . $prefix . "_authors SET checknum = '$checknum', last_login = '" . time() . "', last_ip = '$addr_ip', agent = '$agent' WHERE aid='$aid'" );
			session_register( "" . ADMIN_COOKIE . "" );
			$_SESSION[ADMIN_COOKIE] = base64_encode( "" . $aid . "#:#" . $pwd . "#:#" . $admlanguage . "#:#" . $checknum . "#:#" . $agent . "#:#" . $addr_ip . "" );
			unset( $_SESSION['schet'] );
			$_SESSION['adm_log'] = time();
			unset( $op );
		}
	}
	nvheader( "" . $adminfile . ".php" );
	exit;
}

if ( isset($_SESSION[ADMIN_COOKIE]) && ! empty($_SESSION[ADMIN_COOKIE]) )
{
	$admin = addslashes( base64_decode($_SESSION[ADMIN_COOKIE]) );
	$admin = explode( "#:#", $admin );
	$aid = addslashes( $admin[0] );
	$pwd = $admin[1];
	$admlanguage = $admin[2];
	if ( empty($aid) or empty($pwd) )
	{
		$admintest = 0;
		echo "<html>\n";
		echo "<title>INTRUDER ALERT!!!</title>\n";
		echo "<body bgcolor=\"#FFFFFF\" text=\"#000000\">\n\n<br><br><br>\n\n";
		echo "<center><img src=\"images/eyes.gif\" border=\"0\"><br><br>\n";
		echo "<font face=\"Verdana\" size=\"+4\"><b>Get Out!</b></font></center>\n";
		echo "</body>\n";
		echo "</html>\n";
		exit;
	}
	$aid = substr( $aid, 0, 25 );
	$bossresult = $db->sql_query( "SELECT name, pwd, radminsuper FROM " . $prefix . "_authors WHERE aid='$aid' AND checknum = '$admin[3]' AND agent = '$admin[4]' AND last_ip = '$admin[5]'" );
	if ( ! $bossresult or ($admin[4] != substr(trim($_SERVER['HTTP_USER_AGENT']), 0, 80)) )
	{
		unset( $_SESSION[ADMIN_COOKIE] );
		header( "Location: " . $adminfile . ".php" );
		exit;
	}
	else
	{
		list( $rname, $rpwd, $xradminsuper ) = $db->sql_fetchrow( $bossresult );
		if ( $rpwd == $pwd && ! empty($rpwd) )
		{
			define( 'IS_ADMIN', true );
			$radminsuper = intval( $xradminsuper );
			$radminname = $rname;
			if ( $radminsuper == 1 )
			{
				define( 'IS_SPADMIN', true );
			}
		}
	}
}

$testmodhandle = @opendir( '../modules' );
$modlist = array();
while ( $file = @readdir($testmodhandle) )
{
	if ( (! ereg("[.]", $file)) ) $modlist[] = $file;
}
closedir( $testmodhandle );
sort( $modlist );

$listmods = array();
$listadmins = array();
$ml2result = $db->sql_query( "SELECT `title`, `admins` FROM `" . $prefix . "_modules`" );
while ( $rowmod = $db->sql_fetchrow($ml2result) )
{
	$titlemod = $rowmod['title'];
	if ( in_array($titlemod, $modlist) )
	{
		$listmods[] = $titlemod;
		$listadmins[] = $rowmod['admins'];
	}
	else
	{
		$db->sql_query( "DELETE FROM `" . $prefix . "_modules` WHERE `title`='" . $titlemod . "'" );
		$db->sql_query( "OPTIMIZE TABLE `" . $prefix . "_modules`" );
	}
}

$newmods = array();
foreach ( $modlist as $mod )
{
	if ( $mod != "" and ! in_array($mod, $listmods) )
	{
		$db->sql_query( "INSERT INTO `" . $prefix . "_modules` VALUES (NULL, '" . $mod . "', '" . $mod . "', 0, 0, 1, 1, '', '')" );
		$newmods[] = $mod;
		$listadmins[] = "";
	}
}
$listmods = array_merge( $listmods, $newmods );

if ( ! isset($op) )
{
	$op = "adminMain";
}


/**
 * login()
 * 
 * @return
 */
function login()
{
	global $adminfile, $gfx_chk, $ThemeSel;
	session_register( "adm_log" );
	session_register( "schet" );
	if ( ! isset($_SESSION['schet']) )
	{
		$_SESSION['schet'] = 0;
	}
	if ( ! isset($_SESSION['adm_log']) || ($_SESSION['adm_log'] >= time() + 86400) )
	{
		$_SESSION['adm_log'] = time();
		$_SESSION['schet'] = 0;
	}
	if ( isset($_SESSION['adm_log']) && ($_SESSION['adm_log'] >= time()) && isset($_SESSION['schet']) && ($_SESSION['schet'] >= 5) )
	{
		$timeout2 = $_SESSION['adm_log'] - time() + 1;
		$info = "<script language=\"JavaScript\">\n";
		$info .= "var Timeout = $timeout2;\n";
		$info .= "var timeBegin = new Date();\n";
		$info .= "var msBegin = timeBegin.getTime();\n";
		$info .= "function showSeconds()\n";
		$info .= "{\n";
		$info .= "var timeCurrent = new Date();\n";
		$info .= "var msCurrent = timeCurrent.getTime();\n";
		$info .= "var ms = Math.round((msCurrent - msBegin)/1000);\n";
		$info .= "document.secForm.secField.value = Timeout - ms;\n";
		$info .= "if( Timeout <= ms )\n";
		$info .= "location.reload();\n";
		$info .= "}\n";
		$info .= "timerID = setInterval(\"showSeconds()\", 1000);\n";
		$info .= "</script>\n";
		$info .= "<p align=\"center\"><img border=\"0\" src=\"../images/load_bar.gif\" width=\"97\" height=\"19\"></p>\n";
		$info .= "<form name=\"secForm\">\n";
		$info .= "" . _INFTIMEOUT . " " . $_SESSION['schet'] . " " . _INFTIMEOUT2 . "\n";
		$info .= "<input type=\"text\" name=\"secField\" readonly Size=2>\n";
		$info .= "" . _SECONDS . ".\n";
		$info .= "</form>\n";
		info_exit( $info );
	}
	echo "<html>\n\n<head>\n" . "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=" . _CHARSET . "\">\n" . "<link rel=\"StyleSheet\" href=\"../themes/$ThemeSel/style/style.css\" type=\"text/css\">\n" . "<title>" . _ADMINLOGIN . "</title>\n";

	echo "
<script type=\"text/javascript\">
	function dissc() {
		document.settform.B1.disabled = true;
		return true;
	}
	function Check_S() {
		var a = document.getElementById('l_aid');
		var b = document.getElementById('l_email');
		var c = document.getElementById('l_pwd');\n";
	if ( extension_loaded("gd") and ($gfx_chk == 1 or $gfx_chk == 5 or $gfx_chk == 6 or $gfx_chk == 7) )
	{
		echo "		var d = document.getElementById('gfx_check');\n";
	}
	echo "		var set = /^([a-zA-Z0-9_])+$/;
		var filter  = /^[A-Za-z0-9]+([_\.\-]{1}[A-Za-z0-9]+)*@[A-Za-z0-9]+([_\.\-]{1}[A-Za-z0-9]+)*\.[A-Za-z]{2,6}$/;\n";
	if ( extension_loaded("gd") and ($gfx_chk == 1 or $gfx_chk == 5 or $gfx_chk == 6 or $gfx_chk == 7) )
	{
		echo "		var set2 = /^([0-9])+$/;
		if(a.value.length>4 && a.value.length<20 && set.test(a.value) && b.value.length>7 && filter.test(b.value) && 	c.value.length>4 && c.value.length<20 && set.test(c.value) && d.value.length==6 && set2.test(d.value)) {\n";
	}
	else
	{
		echo "		if(a.value.length>4 && a.value.length<20 && set.test(a.value) && b.value.length>7 && filter.test(b.value) && 	c.value.length>4 && c.value.length<20 && set.test(c.value)) {\n";
	}
	echo "			document.settform.B1.disabled = false;
		} else {
			document.settform.B1.disabled = true;
		}
	}
</script>\n";

	echo "</head>\n\n" . "<body topmargin=\"20\" leftmargin=\"20\" rightmargin=\"20\" bottommargin=\"20\">\n\n";
	echo "<table border=\"0\" cellpadding=\"0\" style=\"border-collapse: collapse\" width=\"100%\" height=\"100%\">\n" . "<tr>\n<td align=\"center\">\n" . "<table border=\"4\" cellpadding=\"5\" style=\"border-collapse: collapse\" bordercolor=\"#2179FF\" bgcolor=\"#CCE6FF\" cellspacing=\"5\">\n" . "<tr>\n<td align=\"center\"><b>" . _ADMINLOGIN . "</b><br><br>\n" . "<form name=\"settform\" id=\"settform\" onsubmit=\"return dissc();\" method=\"POST\" action=\"" . $adminfile . ".php\">\n" . "<table border=\"0\" cellpadding=\"0\" style=\"border-collapse: collapse\" width=\"100%\">\n" . "<tr>\n<td><b>" . _NICKNAME . ":</b>&nbsp;&nbsp;</td>\n" . "<td><input type=\"text\" name=\"aid\" id=\"l_aid\" size=\"20\" maxlength=\"25\" onkeypress=\"Check_S();\" onkeyup=\"Check_S();\" onblur=\"Check_S();\"></td>\n</tr>\n" . "<tr>\n<td><b>" . _EMAIL . ":</b>&nbsp;&nbsp;</td>\n" . "<td><input type=\"text\" name=\"email\" id=\"l_email\" size=\"20\" maxlength=\"50\" onkeypress=\"Check_S();\" onkeyup=\"Check_S();\" onblur=\"Check_S();\"></td>\n</tr>\n" .
		"<tr>\n<td><b>" . _PASSWORD . ":</b>&nbsp;&nbsp;</td>\n" . "<td><input type=\"password\" name=\"pwd\" id=\"l_pwd\" size=\"20\" maxlength=\"40\" onkeypress=\"Check_S();\" onkeyup=\"Check_S();\" onblur=\"Check_S();\"></td>\n</tr>\n";
	if ( extension_loaded("gd") and ($gfx_chk == 1 or $gfx_chk == 5 or $gfx_chk == 6 or $gfx_chk == 7) )
	{
		echo "<tr><td><b>" . _SECURITYCODE . ":</b></td><td><img src='?gfx=gfx' border='1' alt='" . _SECURITYCODE . "' title='" . _SECURITYCODE . "'></td></tr>\n" . "<tr><td><b>" . _TYPESECCODE . ":</b></td><td><input type=\"text\" NAME=\"gfx_check\" id=\"gfx_check\" size=\"6\" maxlength=\"6\" onkeypress=\"Check_S();\" onkeyup=\"Check_S();\" onblur=\"Check_S();\" SIZE=\"11\" MAXLENGTH=\"6\"></td></tr>\n";
	}
	echo "<tr><td>&nbsp;</td><td>\n" . "<input type=\"hidden\" name=\"op\" value=\"login\">\n" . "<input type=\"submit\" value=\"" . _LOGIN . "\" name=\"B1\" id=\"B1\" disabled=\"disabled\">\n" . "</td></tr></table></form>\n</td>\n</tr>\n</table>\n</td>\n</tr>\n</table>\n\n";
	echo "</body>\n\n</html>";
}


/**
 * adminmenu()
 * 
 * @param mixed $url
 * @param mixed $title
 * @param mixed $image
 * @return
 */
function adminmenu( $url, $title, $image )
{
	global $counter, $admingraphic;
	$image = "../images/admin/$image";
	if ( $admingraphic == 1 )
	{
		$img = "<img src=\"$image\" border=\"0\" alt=\"$title\" title=\"$title\"></a><br>";
		$close = "";
	}
	else
	{
		$image = "";
		$close = "</a>";
	}
	echo "<td align=\"center\" width=\"17%\"><font class=\"content\"><a href=\"$url\">$img<b>$title</b>$close<br><br></font></td>";
	if ( $counter == 5 )
	{
		echo "</tr><tr>";
		$counter = 0;
	}
	else
	{
		$counter++;
	}
}

/**
 * checkmodac()
 * 
 * @param mixed $checkmodname
 * @return
 */
function checkmodac( $checkmodname )
{
	global $radminname, $radminsuper, $listmods, $listadmins;
	if ( $checkmodname == "stories" )
	{
		$checkmodname = "News";
	}
	if ( $checkmodname == "editusers" )
	{
		$checkmodname = "Your_Account";
	}
	if ( $checkmodname == "forums" )
	{
		$checkmodname = "Forums";
	}
	$checkmodname = ucfirst( $checkmodname );
	$auth_user = 0;
	for ( $l = 0; $l < sizeof($listmods); $l++ )
	{
		if ( $checkmodname == $listmods[$l] )
		{
			$admins = explode( ",", $listadmins[$l] );
			if ( $listadmins[$l] != "" && in_array($radminname, $admins) )
			{
				$auth_user = 1;
			}
		}
	}
	$adm_access = 0;
	if ( $radminsuper == 1 || $auth_user == 1 )
	{
		$adm_access = 1;
	}
	return ( $adm_access );
}

/**
 * GraphicAdmin()
 * 
 * @return
 */
function GraphicAdmin()
{
	global $adminfile, $radminsuper, $radminname, $listmods, $listadmins;
	OpenTable();
	echo "<center><a href=\"" . $adminfile . ".php\"><font class='title'><b>" . _ADMINMENU . "</b></font></a>";
	echo "<br><br>";
	echo "<table border=\"0\" width=\"100%\" cellspacing=\"1\"><tr>";
	$linksdir = dir( "links" );
	while ( $func = $linksdir->read() )
	{
		if ( substr($func, 0, 6) == "links." )
		{
			$testtest = explode( ".", $func );
			$checkmodname = $testtest[1];
			$adm_access = checkmodac( $checkmodname );
			if ( $adm_access == 1 )
			{
				$menulist .= "$func ";
			}
		}
	}
	closedir( $linksdir->handle );
	$menulist = explode( " ", $menulist );
	sort( $menulist );
	for ( $i = 0; $i < sizeof($menulist); $i++ )
	{
		if ( $menulist[$i] != "" )
		{
			$counter = 0;
			include ( $linksdir->path . "/$menulist[$i]" );
		}
	}
	adminmenu( "" . $adminfile . ".php?op=logout", "" . _ADMINLOGOUT . "", "logout.gif" );
	echo "</tr></table></center>";
	CloseTable();
	echo "<br>";
}


/**
 * adminMain()
 * 
 * @return
 */
function adminMain()
{
	global $prefix, $db, $sitename, $user_prefix, $bgcolor2, $nukeurl, $startdate;
	include ( "../header.php" );
	GraphicAdmin();
	OpenTable();
	$resulsadmin = $db->sql_query( "SELECT aid, name, radminsuper, email FROM " . $prefix . "_authors" );
	$admintc = "";
	$adminsuper = "";
	$adminmods = "";
	while ( $rowadmin = $db->sql_fetchrow($resulsadmin) )
	{
		$redadmin = "<a href=\"mailto:$rowadmin[email]\">$rowadmin[aid]</a>";
		if ( $rowadmin['name'] == "God" )
		{
			if ( $admintc != "" )
			{
				$admintc .= ", ";
			}
			$admintc .= "" . $redadmin . "";
		} elseif ( $rowadmin['radminsuper'] == 1 )
		{
			if ( $adminsuper != "" )
			{
				$adminsuper .= ", ";
			}
			$adminsuper .= "" . $redadmin . "";
		}
		else
		{
			if ( $adminmods != "" )
			{
				$adminmods .= ", ";
			}
			$adminmods .= "" . $redadmin . "";
		}
	}
	if ( $adminsuper == "" )
	{
		$adminsuper = "&nbsp;";
	}
	if ( $adminmods == "" )
	{
		$adminmods = "&nbsp;";
	}

	$usertotal = $db->sql_numrows( $db->sql_query("SELECT * FROM " . $user_prefix . "_users WHERE user_id!=1") );
	echo "<p align=\"center\"><b>" . _SITEINFO . "</b></p>\n" . "<table border=\"1\" cellpadding=\"3\" cellspacing=\"3\" width=\"100%\">\n" . "<tr>\n<td colspan=\"2\" bgcolor=\"$bgcolor2\"><b>" . _GENSITEINFO . "</b></td>\n</tr>\n" . "<tr>\n<td>" . _SITENAME . "</td>\n<td>$sitename</td>\n</tr>\n" . "<tr>\n<td>" . _SITEURL . "</td>\n<td><a href=\"$nukeurl\">$nukeurl</a></td>\n</tr>\n" . "<tr>\n<td>" . _STARTDATE . "</td>\n<td>$startdate</td>\n</tr>\n" . "<tr>\n<td colspan=\"2\" bgcolor=\"$bgcolor2\"><b>" . _ADMINSITE . "</b></td>\n</tr>\n" . "<tr>\n<td>" . _MAINACCOUNT . "</td>\n<td>$admintc</td>\n</tr>\n" . "<tr>\n<td>" . _SUPERUSER . "</td>\n<td>$adminsuper</td>\n</tr>\n" . "<tr>\n<td>" . _MODADMIN . "</td>\n<td>$adminmods</td>\n</tr>\n" . "<tr>\n<td colspan=\"2\" bgcolor=\"$bgcolor2\"><b>" . _USERS . "</b></td>\n</tr>\n" . "<tr>\n<td>" . _TOTALUSERS . "</td>\n<td>$usertotal</td>\n</tr>\n</table>\n\n";
	CloseTable();
	include ( "../footer.php" );
}

if ( defined('IS_ADMIN') )
{
	switch ( $op )
	{

		case "GraphicAdmin":
			GraphicAdmin();
			break;

		case "adminMain":
			adminMain();
			break;

		case "logout":
			unset( $admin );
			unset( $_SESSION[ADMIN_COOKIE] );
			unset( $admf );
			include ( "../header.php" );
			OpenTable();
			echo "<META HTTP-EQUIV=\"refresh\" content=\"3;URL=../index.php\">";
			echo "<center><font class=\"title\"><b>" . _YOUARELOGGEDOUT . "</b></font>";
			echo "<br><img border=\"0\" src=\"../images/indicator.gif\" width=\"31\" height=\"31\" align=\"absmiddle\"></p>\n";
			echo "<p>" . _LOGINOK2 . "</p> \n";
			echo "<a href=\"../\"><b>" . _LOGINOK3 . " " . _LOGINOK4 . "</b></a></td></center>\n";
			CloseTable();
			include ( "../footer.php" );
			break;

		case "login";
			unset( $op );

		default:
			$casedir = dir( "case" );
			while ( $func = $casedir->read() )
			{
				if ( substr($func, 0, 5) == "case." )
				{
					include ( $casedir->path . "/$func" );
				}
			}
			closedir( $casedir->handle );
			break;
	}
}
else
{
	switch ( $op )
	{
		default:
			login();
			break;
	}
}

?>
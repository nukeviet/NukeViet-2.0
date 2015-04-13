<?php

/*
* @Program:		NukeViet CMS
* @File name: 	NukeViet Setup
* @Author: 		NukeViet Group
* @Version: 	2.0 RC1
* @Date: 		01.05.2009
* @Website: 	www.nukeviet.vn
* @Copyright: 	(C) 2009
* @License: 	http://opensource.org/licenses/gpl-license.php GNU Public License
*/

error_reporting( E_ERROR | E_WARNING | E_PARSE ); // This will NOT report uninitialized variables
set_magic_quotes_runtime( 0 ); // Disable magic_quotes_runtime

/**
 * get_php_setting()
 * 
 * @param mixed $val
 * @return
 */
function get_php_setting( $val )
{
	$r = ( ini_get($val) == '1' ? 1 : 0 );
	return $r ? 'ON' : 'OFF';
}

if ( isset($HTTP_GET_VARS['langst']) )
{
	$setuplang = trim( $HTTP_GET_VARS['langst'] );
	setcookie( "langst", "" . $setuplang . "", time() + 3600 );
	Header( "Location: install.php" );
	exit();
}

if ( isset($_COOKIE["langst"]) and file_exists("./language/lang_" . $_COOKIE["langst"] . ".php") and ! eregi("\.", "" . $_COOKIE["langst"] . "") )
{
	@include ( "language/lang_" . $_COOKIE["langst"] . ".php" );
	define( 'LANGST', $_COOKIE["langst"] );
}
else
{
	@include ( "language/lang_vietnamese.php" );
	define( 'LANGST', 'vietnamese' );
}

$phpver_success = ( ! function_exists('version_compare') || version_compare(phpversion(), '4.3.0', '<') ) ? "<font color=\"#ffffff\"><b>" . _FAILED . "</b></font>" : "" . _SUCCESS . "";
$safe_mode_success = ( get_php_setting('safe_mode') == 'ON' ) ? "<font color=\"#ffffff\"><b>" . _FAILED . "</b></font>" : "" . _SUCCESS . "";
$mysqlsupport_success = ( ! function_exists('mysql_connect') ) ? "<font color=\"#ffffff\"><b>" . _FAILED . "</b></font>" : "" . _SUCCESS . "";
$register_globals_allowed = ( get_php_setting('register_globals') == 'On' ) ? "<font color=\"#ffffff\">" . _WARNING . "</font>" : "" . _SUCCESS . "";
$magic_quotes_runtime_allowed = ( get_php_setting('magic_quotes_runtime') == 'On' ) ? "<font color=\"#ffffff\">" . _WARNING . "</font>" : "" . _SUCCESS . "";
$magic_quotes_gpc_allowed = ( get_php_setting('magic_quotes_gpc') == 'On' ) ? "<font color=\"#ffffff\">" . _WARNING . "</font>" : "" . _SUCCESS . "";
$magic_quotes_sybase_allowed = ( get_php_setting('magic_quotes_sybase') == 'On' ) ? "<font color=\"#ffffff\">" . _WARNING . "</font>" : "" . _SUCCESS . "";
$output_buffering_allowed = ( get_php_setting('output_buffering') == 'On' ) ? "<font color=\"#ffffff\">" . _WARNING . "</font>" : "" . _SUCCESS . "";
$sessionauto_start_allowed = ( get_php_setting('session.auto_start') == '1' ) ? "<font color=\"#ffffff\">" . _WARNING . "</font>" : "" . _SUCCESS . "";
$display_errors_allowed = ( get_php_setting('display_errors') == 'On' ) ? "<font color=\"#ffffff\">" . _WARNING . "</font>" : "" . _SUCCESS . "";
$zlib_compression_allowed = ( ! extension_loaded('zlib') ) ? "<font color=\"#ffffff\">" . _WARNING . "</font>" : "" . _SUCCESS . "";
$gd_allowed = ( ! extension_loaded('gd') ) ? "<font color=\"#ffffff\">" . _WARNING . "</font>" : "" . _SUCCESS . "";
if ( in_array('set_time_limit', split(',\s*', ini_get('disable_functions'))) )
{
	$set_time_limit_allowed = "<font color=\"#ffffff\">" . _WARNING . "</font>";
}
else
{
	$set_time_limit_allowed = "" . _SUCCESS . "";
	set_time_limit( 180 );
}
$file_uploads_allowed = ( get_php_setting('file_uploads') == 'Off' ) ? "<font color=\"#ffffff\">" . _WARNING . "</font>" : "" . _SUCCESS . "";

$dbhost = trim( strip_tags((! empty($HTTP_POST_VARS['dbhost'])) ? $HTTP_POST_VARS['dbhost'] : 'localhost') );
$dbuname0 = trim( strip_tags((! empty($HTTP_POST_VARS['dbuname0'])) ? $HTTP_POST_VARS['dbuname0'] : '') );
$dbuname1 = trim( strip_tags((! empty($HTTP_POST_VARS['dbuname1'])) ? $HTTP_POST_VARS['dbuname1'] : '') );
$dbuname2 = trim( strip_tags((! empty($HTTP_POST_VARS['dbuname2'])) ? $HTTP_POST_VARS['dbuname2'] : '') );
$dbpass0 = trim( strip_tags((! empty($HTTP_POST_VARS['dbpass0'])) ? $HTTP_POST_VARS['dbpass0'] : '') );
$dbpass1 = trim( strip_tags((! empty($HTTP_POST_VARS['dbpass1'])) ? $HTTP_POST_VARS['dbpass1'] : '') );
$dbpass2 = trim( strip_tags((! empty($HTTP_POST_VARS['dbpass2'])) ? $HTTP_POST_VARS['dbpass2'] : '') );
$dbname = trim( strip_tags((! empty($HTTP_POST_VARS['dbname'])) ? $HTTP_POST_VARS['dbname'] : '') );
$prefix = trim( strip_tags((! empty($HTTP_POST_VARS['prefix'])) ? $HTTP_POST_VARS['prefix'] : 'nukeviet') );
$user_prefix = trim( strip_tags((! empty($HTTP_POST_VARS['user_prefix'])) ? $HTTP_POST_VARS['user_prefix'] : 'nukeviet') );
$sitename = trim( strip_tags((! empty($HTTP_POST_VARS['sitename'])) ? $HTTP_POST_VARS['sitename'] : '') );
$adminname = trim( strip_tags((! empty($HTTP_POST_VARS['adminname'])) ? $HTTP_POST_VARS['adminname'] : '') );
$adminmail = trim( strip_tags((! empty($HTTP_POST_VARS['adminmail'])) ? $HTTP_POST_VARS['adminmail'] : '') );
$adminpassword = trim( strip_tags((! empty($HTTP_POST_VARS['adminpassword'])) ? $HTTP_POST_VARS['adminpassword'] : '') );
$username = trim( strip_tags((! empty($HTTP_POST_VARS['username'])) ? $HTTP_POST_VARS['username'] : '') );
$usermail = trim( strip_tags((! empty($HTTP_POST_VARS['usermail'])) ? $HTTP_POST_VARS['usermail'] : '') );
$userpassword = trim( strip_tags((! empty($HTTP_POST_VARS['userpassword'])) ? $HTTP_POST_VARS['userpassword'] : '') );
$language = trim( strip_tags((! empty($HTTP_POST_VARS['language'])) ? $HTTP_POST_VARS['language'] : 'vietnamese') );
$datafold = trim( strip_tags((! empty($HTTP_POST_VARS['datafold'])) ? $HTTP_POST_VARS['datafold'] : 'includes/data') );
$adminfold = trim( strip_tags((! empty($HTTP_POST_VARS['adminfold'])) ? $HTTP_POST_VARS['adminfold'] : 'admin') );
$adminfile = trim( strip_tags((! empty($HTTP_POST_VARS['adminfile'])) ? $HTTP_POST_VARS['adminfile'] : 'admin') );
$automovef = trim( strip_tags((! empty($HTTP_POST_VARS['automovef'])) ? $HTTP_POST_VARS['automovef'] : '0') );
$step = ( isset($HTTP_POST_VARS['step']) ) ? $HTTP_POST_VARS['step'] : '';
if ( ! get_magic_quotes_gpc() )
{
	$dbhost = addslashes( $dbhost );
	$dbuname0 = addslashes( $dbuname0 );
	$dbuname1 = addslashes( $dbuname1 );
	$dbuname2 = addslashes( $dbuname2 );
	$dbpass0 = addslashes( $dbpass0 );
	$dbpass1 = addslashes( $dbpass1 );
	$dbpass2 = addslashes( $dbpass2 );
	$prefix = addslashes( $prefix );
	$user_prefix = addslashes( $user_prefix );
	$adminname = addslashes( $adminname );
	$adminmail = addslashes( $adminmail );
	$adminpassword = addslashes( $adminpassword );
	$usermail = addslashes( $usermail );
	$userpassword = addslashes( $userpassword );
	$language = addslashes( $language );
	$datafold = addslashes( $datafold );
	$adminfold = addslashes( $adminfold );
	$adminfile = addslashes( $adminfile );
	$dbuname = addslashes( $dbuname );
	$dbuname = addslashes( $dbuname );
	$dbuname = addslashes( $dbuname );
}
if ( ! empty($HTTP_POST_VARS['server_name']) )
{
	$server_name = $HTTP_POST_VARS['server_name'];
}
else
{
	if ( ! empty($HTTP_SERVER_VARS['SERVER_NAME']) || ! empty($HTTP_ENV_VARS['SERVER_NAME']) )
	{
		$server_name = ( ! empty($HTTP_SERVER_VARS['SERVER_NAME']) ) ? $HTTP_SERVER_VARS['SERVER_NAME'] : $HTTP_ENV_VARS['SERVER_NAME'];
	}
	else
		if ( ! empty($HTTP_SERVER_VARS['HTTP_HOST']) || ! empty($HTTP_ENV_VARS['HTTP_HOST']) )
		{
			$server_name = ( ! empty($HTTP_SERVER_VARS['HTTP_HOST']) ) ? $HTTP_SERVER_VARS['HTTP_HOST'] : $HTTP_ENV_VARS['HTTP_HOST'];
		}
		else
		{
			$server_name = '';
		}
}
$script_path = str_replace( '/install', '', dirname($HTTP_SERVER_VARS['PHP_SELF']) );
$cookie_path = "" . $script_path . "/";
$startdate = date( "d/m/Y" );
$cookie_domain = "";
$nukeurl = "http://" . $server_name . "" . $script_path . "";
$dbtype = "MySQL";
$cons = "bcdfghjklmnpqrstvwxyz";
$vocs = "aeiou";
$nums = "0123456789";
$znaks = "!@#$%^&*_+-.,;:";
for ( $x = 0; $x < 8; $x++ )
{
	$con[$x] = substr( $cons, mt_rand(0, strlen($cons) - 1), 1 );
	$voc[$x] = substr( $vocs, mt_rand(0, strlen($vocs) - 1), 1 );
	$num[$x] = substr( $nums, mt_rand(0, strlen($nums) - 1), 1 );
	$znak[$x] = substr( $znaks, mt_rand(0, strlen($znaks) - 1), 1 );
}
$sitekey = $num[4] . $con[2] . $voc[0] . $num[0] . $num[4] . $znak[1] . $voc[3] . $znak[2] . $znak[3] . $num[2] . $con[5] . $con[0] . $znak[4] . $voc[4] . $voc[3] . $num[0] . $con[6] . $znak[0] . $voc[2] . $num[3] . $num[1] . $znak[5];
$maxupload = str_replace( array('M', 'm'), '', @ini_get('upload_max_filesize') );
$maxupload = $maxupload * 1024 * 1024;
$make = "";
$strs = "abc2deQLTVf3ghj4kmn5opqDEF6rst7uvw8xyz9CBA";
for ( $x = 0; $x < 5; $x++ )
{
	mt_srand( (double)microtime() * 1000000 );
	$str[$x] = substr( $strs, mt_rand(0, strlen($strs) - 1), 1 );
	$make = $make . $str[$x];
}
$ucookies = "nvu_" . $make . "";
$acookies = "nva_" . $make . "";

$thongbao1 = _STEP135;
if ( ! function_exists('version_compare') || version_compare(phpversion(), '4.3.0', '<') || get_php_setting('safe_mode') == 'ON' || ! function_exists('mysql_connect') )
{
	$thongbao1 = _STEP1351;
} elseif ( get_php_setting('register_globals') == 'On' || get_php_setting('magic_quotes_runtime') == 'On' || get_php_setting('magic_quotes_gpc') == 'On' || get_php_setting('magic_quotes_sybase') == 'On' || get_php_setting('output_buffering') == 'On' || get_php_setting('session.auto_start') == '1' || get_php_setting('display_errors') == 'On' || ! extension_loaded('zlib') || ! extension_loaded('gd') || in_array('set_time_limit', split(',\s*', ini_get('disable_functions'))) || get_php_setting('file_uploads') == 'Off' )
{
	$thongbao1 = _STEP1352;
}
//kiemtradulieu
$errmsg = "";
$gostep2 = true;
$gostep3 = true;

$test1 = array( $dbuname0, $dbname, $prefix, $user_prefix, $adminname, $adminpassword, $username, $userpassword, $language, $adminfile );
$test2 = array( $adminname, $adminpassword, $username, $userpassword );
$test3 = array( $adminmail, $usermail );
$bad_email = array( 'yoursite.com', 'mysite.com', 'localhost', 'xxx' );
$bad_nicks = array( 'anonimo', 'anonymous', 'god', 'linux', 'nobody', 'operator', 'root' );
if ( ! function_exists('version_compare') || version_compare(phpversion(), '4.3.0', '<') || get_php_setting('safe_mode') == 'ON' || ! function_exists('mysql_connect') )
{
	$gostep2 = false;
	$gostep3 = false;
	$errmsg = constant( "_VERSIONPHP" );
}
else
{
	if ( $step == 3 )
	{

		if ( $adminfold == "" ) $errmsg = constant( "_ERRB8" );
		if ( $adminfile == "" ) $errmsg = constant( "_ERRB7" );
		for ( $i = 0; $i < sizeof($test1); $i++ )
		{
			if ( $test1[$i] == "" || ereg("[^a-zA-Z0-9_-]", $test1[$i]) || strrpos($test1[$i], ' ') > 0 )
			{
				$gostep3 = false;
				$errmsg = constant( "_ERRB1" . $i );
				break;
			}
		}


		for ( $i = 0; $i < sizeof($test2); $i++ )
		{
			if ( $errmsg != "" ) break;
			if ( strlen($test2[$i]) > 15 || strlen($test2[$i]) < 5 )
			{
				$gostep3 = false;
				$errmsg = constant( "_ERRB2" . $i );
				break;
			}
		}
		for ( $i = 0; $i < sizeof($test3); $i++ )
		{
			if ( $errmsg != "" ) break;
			if ( $test3[$i] == "" || strlen($test3[$i]) < 7 || ! eregi("^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,6}$", $test3[$i]) )
			{
				$gostep3 = false;
				$errmsg = constant( "_ERRB3" . $i );
				break;
			}
			else
			{
				foreach ( $bad_email as $bad_mail )
				{
					if ( eregi($bad_mail, $test3[$i]) )
					{
						$errmsg = constant( "_ERRB32" );
						$gostep3 = false;
						break;
					}
				}
			}
		}
		foreach ( $bad_nicks as $bad_nick )
		{
			if ( $errmsg != "" ) break;
			if ( eregi($bad_nick, $username) )
			{
				$errmsg = constant( "_ERRB33" );
				$gostep3 = false;
				break;
			}
		}

		if ( ! file_exists("../language/lang-" . $language . ".php") )
		{
			$gostep3 = false;
		}
		if ( ! file_exists("../" . $adminfold . "/" . $adminfile . ".php") )
		{
			$gostep3 = false;
		}
		if ( $gostep3 == true )
		{
			if ( ! file_exists("../" . $datafold . "") || ! is_dir("../" . $datafold . "") )
			{
				if ( ! @mkdir("../" . $datafold . "", 0777) )
				{
					$gostep3 = false;
				}
			}
			else
			{
				if ( ! is_writeable("../" . $datafold . "") )
				{
					if ( ! @chmod("../" . $datafold . "", 0777) )
					{
						$gostep3 = false;
					}
				}
			}
		}
		if ( $gostep3 == true )
		{

			$db0 = @mysql_connect( "$dbhost", "$dbuname0", "$dbpass0" );
			if ( ! $db0 )
			{
				$gostep3 = false;
				$errmsg = constant( "_ERRB34" );
			}
			else
			{
				$db0_selected = @mysql_select_db( $dbname, $db0 );
				if ( ! $db0_selected )
				{
					$gostep3 = false;
					$errmsg = constant( "_ERRB35" );
				}
			}
			if ( $dbpass0 == "" ) $errmsg = constant( "_ERRB9" );
			@mysql_close( $db0 );
			if ( $dbuname1 != "" )
			{
				$db1 = @mysql_connect( "$dbhost", "$dbuname1", "$dbpass1" );
				if ( ! $db1 )
				{
					$gostep3 = false;
					$errmsg = constant( "_ERRB34" );
				}
				else
				{
					$db1_selected = @mysql_select_db( $dbname, $db1 );
					if ( ! $db1_selected )
					{
						$gostep3 = false;
						$errmsg = constant( "_ERRB35" );
					}
				}
				@mysql_close( $db1 );
			}
			if ( $dbuname2 != "" )
			{
				$db2 = @mysql_connect( "$dbhost", "$dbuname2", "$dbpass2" );
				if ( ! $db2 )
				{
					$gostep3 = false;
					$errmsg = constant( "_ERRB34" );
				}
				else
				{
					$db2_selected = @mysql_select_db( $dbname, $db2 );
					if ( ! $db2_selected )
					{
						$gostep3 = false;
						$errmsg = constant( "_ERRB35" );
					}
				}
				@mysql_close( $db2 );
			}
		}

	}
}
//end

if ( $gostep2 == false )
{
	$gostep3 = false;
}

//$step = (isset($HTTP_POST_VARS['step'])) ? $HTTP_POST_VARS['step'] : '';
if ( file_exists("../mainfile.php") )
{
	$step = 4;
}


if ( $step == 4 and ! file_exists("../mainfile.php") )
{
	if ( ($gostep3) and ($automovef == "1") )
	{
		rename( "../$datafold/mainfile.php", "../mainfile.php" );
		$automovef = 0;
	}
	else
	{
		$errmsg = constant( "_ERRB40" );
		$step = 3;
	}
}
if ( $step == 3 and $gostep3 == false )
{
	$step = 2;
}

if ( $step == 2 and $gostep2 == false )
{
	$step = 1;
}


/**
 * themebody()
 * 
 * @param integer $step
 * @param string $content1
 * @param string $content2
 * @param string $content3
 * @return
 */
function themebody( $step = 1, $content1 = "&nbsp;", $content2 = "&nbsp;", $content3 = "&nbsp;" )
{
	if ( $step == 2 )
	{
		$cl1 = $cl3 = $cl4 = "td3";
		$cl2 = "td4";
	} elseif ( $step == 3 )
	{
		$cl1 = $cl2 = $cl4 = "td3";
		$cl3 = "td4";
	} elseif ( $step == 4 )
	{
		$cl1 = $cl2 = $cl3 = "td3";
		$cl4 = "td4";
	}
	else
	{
		$cl2 = $cl3 = $cl4 = "td3";
		$cl1 = "td4";
	}

?>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php

	echo "" . _CHARSET . "";

?>">
<style>
<!--
body, tr, td, table, p { font-family: tahoma, verdana, arial; font-size: 11px; color: #FFA200}
form {margin: 0px}
input, textarea, select {color: #A50000; border: 1px solid #FF2400; font-style:normal; font-variant:normal; font-weight:normal; font-size:11px; font-family:Tahoma; background-color:#FFA200}
.td2         { font-family: Verdana; font-size: 11px; color:#FFA200; font-weight:bold }
.td3         { font-family: Verdana; color: #FFC600; text-transform: uppercase; font-size: 10px; font-weight: bold }
.td4         { font-family: Verdana; color: #FFFFFF; text-transform: uppercase; font-size: 10px; font-weight: bold }
.td5         { color: #FF4D2D }
.td6         { border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px }
-->
</style>
<script>
    var XMLHttpRequestObject = false;
    if(window.XMLHttpRequest){
         XMLHttpRequestObject = new XMLHttpRequest();
    }else if(window.ActiveXObject){
         XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP")
    }

    function getData(dataSource, divID){
                 if(XMLHttpRequestObject){
                     var obj = document.getElementById(divID);
                     XMLHttpRequestObject.open("GET", dataSource);

                     XMLHttpRequestObject.onreadystatechange = function(){
                         if(XMLHttpRequestObject.readyState == 4 &&
                              XMLHttpRequestObject.status == 200){
                                  obj.innerHTML = XMLHttpRequestObject.responseText;
                              }
                     }
                 XMLHttpRequestObject.send(null);
                 }
             }
</script>
<title>install</title>
</head>

<body background="images/bg.jpg" topmargin="0" leftmargin="0" rightmargin="0" bottommargin="0">

<table border="0" cellpadding="0" style="border-collapse: collapse" width="100%" height="100%">
	<tr>
		<td align="center">
		<table border="0" cellpadding="0" style="border-collapse: collapse" width="543" height="561" bgcolor="#FFA200">
			<tr>
				<td valign="top" height="45">
				<table border="0" cellpadding="0" style="border-collapse: collapse" width="100%">
					<tr>
						<td width="319">
						<img border="0" src="<?php

	echo "images/" . LANGST . "_install.jpg";

?>" width="319" height="45"></td>
						<td background="images/bg.jpg">&nbsp;</td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td valign="top" height="42">
				<table border="0" cellpadding="0" style="border-collapse: collapse" width="100%">
					<tr>
						<td background="images/install_07.jpg">&nbsp;</td>
						<td background="images/install_07.jpg" width="259">
						<table border="0" cellpadding="0" style="border-collapse: collapse" width="100%">
							<tr>
								<td>
								<img border="0" src="images/spacer.gif" width="1" height="16"></td>
							</tr>
							<tr>
								<td>
								<a href="?langst=english">
								<img border="0" src="images/install_10.jpg" width="47" height="13"></a><a href="?langst=vietnamese"><img border="0" src="images/install_11.jpg" width="79" height="13"></a><a target="_blank" href="http://nukeviet.vn"><img border="0" src="images/install_12.jpg" width="61" height="13"></a><a href="http://nukeviet.vn" target="blank"><img border="0" src="images/install_13.jpg" width="72" height="13"></a></td>
							</tr>
							<tr>
								<td>
								<img border="0" src="images/spacer.gif" width="1" height="13"></td>
							</tr>
						</table>
						</td>
						<td width="43">
						<img border="0" src="images/install_09.jpg" width="43" height="42"></td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td height="9" background="images/install_16_02.jpg" align="right">
				<img border="0" src="images/install_16_04.jpg" width="19" height="9"></td>
			</tr>
			<tr>
				<td valign="top">
				<table border="0" cellpadding="0" style="border-collapse: collapse" width="100%" height="100%" bgcolor="#A50000">
					<tr>
						<td width="137" valign="top">
						<table border="0" cellpadding="0" style="border-collapse: collapse" width="100%" background="images/install_23.jpg">
							<tr>
								<td height="31">
								<table border="0" cellpadding="0" style="border-collapse: collapse" width="100%">
									<tr>
										<td width="27">
										<img border="0" src="images/install_21.jpg" width="27" height="31"></td>
										<td class="<?php

	echo "$cl1";

?>"><?php

	echo "" . _STEP1 . "";

?></td>
									</tr>
								</table>
								</td>
							</tr>
							<tr>
								<td height="31">
								<table border="0" cellpadding="0" style="border-collapse: collapse" width="100%">
									<tr>
										<td width="27">
										<img border="0" src="images/install_21.jpg" width="27" height="31"></td>
										<td class="<?php

	echo "$cl2";

?>"><?php

	echo "" . _STEP2 . "";

?></td>
									</tr>
								</table>
								</td>
							</tr>
							<tr>
								<td height="31">
								<table border="0" cellpadding="0" style="border-collapse: collapse" width="100%">
									<tr>
										<td width="27">
										<img border="0" src="images/install_21.jpg" width="27" height="31"></td>
										<td class="<?php

	echo "$cl3";

?>"><?php

	echo "" . _STEP3 . "";

?></td>
									</tr>
								</table>
								</td>
							</tr>
							<tr>
								<td height="31">
								<table border="0" cellpadding="0" style="border-collapse: collapse" width="100%">
									<tr>
										<td width="27">
										<img border="0" src="images/install_21.jpg" width="27" height="31"></td>
										<td class="<?php

	echo "$cl4";

?>"><?php

	echo "" . _STEP4 . "";

?></td>
									</tr>
								</table>
								</td>
							</tr>
						</table>
						<table border="0" cellpadding="0" style="border-collapse: collapse" width="100%">
							<tr>
								<td>
								<img border="0" src="images/spacer.gif" width="1" height="8"></td>
							</tr>
						</table>
						<table border="0" cellpadding="0" style="border-collapse: collapse" width="100%" height="100%">
							<tr>
								<td valign="top" width="8">
								<img border="0" src="images/spacer.gif" width="8" height="1"></td>
								<td valign="top" class="td5"><?php

	echo $content1;

?></td>
							</tr>
						</table>
						</td>
						<td valign="top">
						<table border="0" cellpadding="0" style="border-collapse: collapse" width="100%">
							<tr>
								<td width="25">
								<img border="0" src="images/install_17.jpg" width="25" height="28"></td>
								<td background="images/install_18a.jpg" class="td2"><?php

	echo $content2;

?></td>
								<td width="30">
								<img border="0" src="images/install_19.jpg" width="30" height="28"></td>
							</tr>
						</table>
						<table border="0" cellpadding="0" style="border-collapse: collapse" width="100%" height="100%">
							<tr>
								<td background="images/install_vi_23.jpg" width="25" valign="top">
								<img border="0" src="images/install_24.jpg" width="25" height="10"></td>
								<td valign="top" bgcolor="#880000">
								<table border="0" cellpadding="0" style="border-collapse: collapse" width="100%">
									<tr>
										<td background="images/install_25.jpg">
										<img border="0" src="images/install_25.jpg" width="17" height="10"></td>
									</tr>
								</table>
								<table border="0" cellpadding="0" style="border-collapse: collapse" width="100%" height="100%">
									<tr>
										<td valign="top"><?php

	echo $content3;

?></td>
									</tr>
								</table>
								</td>
								<td width="30" background="images/install_vi_24.jpg" valign="top">
								<img border="0" src="images/install_26.jpg" width="30" height="10"></td>
							</tr>
						</table>
						</td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td valign="top" height="67">
				<table border="0" cellpadding="0" style="border-collapse: collapse" width="100%">
					<tr>
						<td height="38">
						<table border="0" cellpadding="0" style="border-collapse: collapse" width="100%" bgcolor="#A50000">
							<tr>
								<td>&nbsp;</td>
								<td align="right" width="76">
								<a target="_blank" href="http://nukeviet.vn/">
								<img border="0" src="images/install_35.jpg" width="76" height="38"></a></td>
							</tr>
						</table>
						</td>
					</tr>
					<tr>
						<td height="29">
						<table border="0" cellpadding="0" style="border-collapse: collapse" width="100%">
							<tr>
								<td background="images/install_36_02.jpg">
								<img border="0" src="images/install_36_01.jpg" width="17" height="29"></td>
								<td width="305" background="images/install_36_02.jpg">
								<a style="color: #2A2A2A; text-decoration: none" target="_blank" href="http://nukeviet.vn/">
								&copy; 2006 - 2012 by Nukeviet Group</a><br><img border="0" src="images/spacer.gif" width="1" height="8"></td>
								<td width="76">
								<a target="_blank" href="http://nukeviet.vn/">
								<img border="0" src="images/install_38.jpg" width="76" height="29"></a></td>
							</tr>
						</table>
						</td>
					</tr>
				</table>
				</td>
			</tr>
		</table>
		</td>
	</tr>
</table>

</body>

</html>
<?

}

if ( $step == 4 )
{
	$content1 = "<font color=#ffffff>" . _ERRB41 . "</font>";
	$content2 = _STEP42;
	$content3 = "";
	$content3 .= "<table border=\"0\" cellpadding=\"3\" style=\"border-collapse: collapse\" width=\"100%\">\n";
	$content3 .= "</tr>\n";
	$content3 .= "	<tr>\n";
	$content3 .= "	<td align=\"left\">" . _STEP43 . "<br><br><input type=\"button\" value=\"" . _STEP44 . "\" onclick=\"window.location.href='../" . $adminfold . "/" . $adminfile . ".php'\"> <input type=\"button\" value=\"" . _STEP45 . "\" onclick=\"window.location.href='../index.php'\"></td>\n";
	$content3 .= "	</tr>\n";
	$content3 .= "	</table>\n";
	themebody( 4, $content1, $content2, $content3 );
} elseif ( $step == 3 )
{

	$content1 = "<font color=#ffffff>" . $errmsg . "</font>";
	$content2 = _STEP32;
	$content3 = "";
	$content3 .= "<form method=\"POST\" action=\"install.php\">\n";
	$content3 .= "<table border=\"0\" cellpadding=\"3\" style=\"border-collapse: collapse\" width=\"100%\">\n";
	if ( ! file_exists("../$datafold/config.php") && ! file_exists("../$datafold/mainfile.php") )
	{
		define( 'NV_DB', true );
		define( 'NV_SYSTEM', true );
		@require_once ( "dumper.php" );
		@require_once ( "dumper2.php" );
	}
	$content3 .= "<tr>\n";
	$content3 .= "<td bordercolor=\"#C41200\" class=\"td6\">" . _STEP33 . "</td>\n";
	$content3 .= "<td align=\"right\" bordercolor=\"#C41200\" class=\"td6\">OK</td>\n";
	$content3 .= "</tr>\n";
	$content3 .= "<tr>\n";
	$content3 .= "<td bordercolor=\"#C41200\" class=\"td6\">" . _STEP34 . "</td>\n";
	$content3 .= "<td align=\"right\" bordercolor=\"#C41200\" class=\"td6\">OK</td>\n";
	$content3 .= "</tr>\n";
	$content3 .= "	<tr>\n";
	$content3 .= "	<td align=\"left\" colspan=\"2\">" . _STEP36 . " " . $datafold . " " . _STEP37 . "<br><br>
<input type=\"hidden\" name=\"dbhost\" value=\"$dbhost\"><input type=\"hidden\" name=\"dbuname0\" value=\"$dbuname0\">
<input type=\"hidden\" name=\"dbpass0\" value=\"$dbpass0\"><input type=\"hidden\" name=\"dbuname1\" value=\"$dbuname1\">
<input type=\"hidden\" name=\"dbpass1\" value=\"$dbpass1\"><input type=\"hidden\" name=\"dbuname2\" value=\"$dbuname2\">
<input type=\"hidden\" name=\"dbpass2\" value=\"$dbpass2\"><input type=\"hidden\" name=\"dbname\" value=\"$dbname\">
<input type=\"hidden\" name=\"prefix\" value=\"$prefix\"><input type=\"hidden\" name=\"user_prefix\" value=\"$user_prefix\">
<input type=\"hidden\" name=\"sitename\" value=\"$sitename\"><input type=\"hidden\" name=\"adminname\" value=\"$adminname\">
<input type=\"hidden\" name=\"adminmail\" value=\"$adminmail\"><input type=\"hidden\" name=\"adminpassword\" value=\"$adminpassword\">
<input type=\"hidden\" name=\"username\" value=\"$username\"><input type=\"hidden\" name=\"usermail\" value=\"$usermail\">
<input type=\"hidden\" name=\"userpassword\" value=\"$userpassword\"><input type=\"hidden\" name=\"language\" value=\"$language\">
<input type=\"hidden\" name=\"datafold\" value=\"$datafold\"><input type=\"hidden\" name=\"adminfold\" value=\"$adminfold\">
<input type=\"hidden\" name=\"adminfile\" value=\"$adminfile\"><input type=\"hidden\" name=\"step\" value=\"4\">
<input type=\"checkbox\" name=\"automovef\" value=\"1\"/> " . _CHKTOCOPY . "<BR><BR>
<input type=\"submit\" value=\"" . _STEP35 . "\"></td>\n";
	$content3 .= "	</tr>\n";
	$content3 .= "	</table>\n";
	$content3 .= "</form>\n";

	themebody( 3, $content1, $content2, $content3 );

} elseif ( $step == 2 )
{
	if ( $errmsg ) $content1 = "<hr color=\"#999999\" size=\"1\"><font color=#ffffff><blink>" . $errmsg . "</blink></font><hr color=\"#999999\" size=\"1\">" . _STEP222 . "";
	else  $content1 = "" . _STEP2222 . " <hr color=\"#FF6600\" size=\"1\">" . _STEP222 . "";
	$content2 = _STEP22;
	$content3 = "";
	$content3 .= "<form method=\"POST\" action=\"install.php\">\n";
	$content3 .= "<table border=\"0\" cellpadding=\"3\" style=\"border-collapse: collapse\" width=\"100%\">\n";
	$content3 .= "<tr>\n";
	$content3 .= "<td bordercolor=\"#C41200\" class=\"td6\">" . _STEP23 . "</td>\n";
	$content3 .= "<td align=\"right\" bordercolor=\"#C41200\" class=\"td6\"><input type=\"text\" name=\"dbhost\" value=\"$dbhost\" onblur='if (this.value==\"\") this.value=\"localhost\";' onfocus='if (this.value==\"localhost\") this.value=\"\";'></td>\n";
	$content3 .= "</tr>\n";
	$content3 .= "<tr>\n";
	$content3 .= "<td bordercolor=\"#C41200\" class=\"td6\"><label id=\"step240\">" . _STEP240 . "</label</td>\n";
	$content3 .= "<td align=\"right\" bordercolor=\"#C41200\" class=\"td6\"><input type=\"text\" name=\"dbuname0\" value=\"$dbuname0\"></td>\n";
	$content3 .= "</tr>\n";
	$content3 .= "<tr>\n";
	$content3 .= "<td bordercolor=\"#C41200\" class=\"td6\">" . _STEP250 . "</td>\n";
	$content3 .= "<td align=\"right\" bordercolor=\"#C41200\" class=\"td6\"><input type=\"text\" name=\"dbpass0\" value=\"$dbpass0\"></td>\n";
	$content3 .= "</tr>\n";
	$content3 .= "<tr>\n";
	$content3 .= "<td bordercolor=\"#C41200\" class=\"td6\">" . _STEP241 . "</td>\n";
	$content3 .= "<td align=\"right\" bordercolor=\"#C41200\" class=\"td6\"><input type=\"text\" name=\"dbuname1\" value=\"$dbuname1\"></td>\n";
	$content3 .= "</tr>\n";
	$content3 .= "<tr>\n";
	$content3 .= "<td bordercolor=\"#C41200\" class=\"td6\">" . _STEP251 . "</td>\n";
	$content3 .= "<td align=\"right\" bordercolor=\"#C41200\" class=\"td6\"><input type=\"text\" name=\"dbpass1\" value=\"$dbpass1\"></td>\n";
	$content3 .= "</tr>\n";
	$content3 .= "<tr>\n";
	$content3 .= "<td bordercolor=\"#C41200\" class=\"td6\">" . _STEP242 . "</td>\n";
	$content3 .= "<td align=\"right\" bordercolor=\"#C41200\" class=\"td6\"><input type=\"text\" name=\"dbuname2\" value=\"$dbuname2\"></td>\n";
	$content3 .= "</tr>\n";
	$content3 .= "<tr>\n";
	$content3 .= "<td bordercolor=\"#C41200\" class=\"td6\">" . _STEP252 . "</td>\n";
	$content3 .= "<td align=\"right\" bordercolor=\"#C41200\" class=\"td6\"><input type=\"text\" name=\"dbpass2\" value=\"$dbpass2\"></td>\n";
	$content3 .= "</tr>\n";
	$content3 .= "<tr>\n";
	$content3 .= "<td bordercolor=\"#C41200\" class=\"td6\">" . _STEP26 . "</td>\n";
	$content3 .= "<td align=\"right\" bordercolor=\"#C41200\" class=\"td6\"><input type=\"text\" name=\"dbname\" value=\"$dbname\"></td>\n";
	$content3 .= "</tr>\n";
	$content3 .= "<tr>\n";
	$content3 .= "<td bordercolor=\"#C41200\" class=\"td6\">" . _STEP27 . "</td>\n";
	$content3 .= "<td align=\"right\" bordercolor=\"#C41200\" class=\"td6\"><input type=\"text\" name=\"prefix\" value=\"$prefix\" onblur='if (this.value==\"\") this.value=\"nukeviet\";' onfocus='if (this.value==\"nukeviet\") this.value=\"\";'></td>\n";
	$content3 .= "</tr>\n";
	$content3 .= "<tr>\n";
	$content3 .= "<td bordercolor=\"#C41200\" class=\"td6\">" . _STEP28 . "</td>\n";
	$content3 .= "<td align=\"right\" bordercolor=\"#C41200\" class=\"td6\"><input type=\"text\" name=\"user_prefix\" value=\"$user_prefix\" onblur='if (this.value==\"\") this.value=\"nukeviet\";' onfocus='if (this.value==\"nukeviet\") this.value=\"\";'></td>\n";
	$content3 .= "</tr>\n";
	$content3 .= "<tr>\n";
	$content3 .= "<td bordercolor=\"#C41200\" class=\"td6\">" . _STEP29 . "</td>\n";
	$content3 .= "<td align=\"right\" bordercolor=\"#C41200\" class=\"td6\"><input type=\"text\" name=\"sitename\" value=\"$sitename\"></td>\n";
	$content3 .= "</tr>\n";
	$content3 .= "<td bordercolor=\"#C41200\" class=\"td6\">" . _STEP210 . "</td>\n";
	$content3 .= "<td align=\"right\" bordercolor=\"#C41200\" class=\"td6\"><input type=\"text\" name=\"adminname\" value=\"$adminname\"></td>\n";
	$content3 .= "</tr>\n";
	$content3 .= "</tr>\n";
	$content3 .= "<td bordercolor=\"#C41200\" class=\"td6\">" . _STEP211 . "</td>\n";
	$content3 .= "<td align=\"right\" bordercolor=\"#C41200\" class=\"td6\"><input type=\"text\" name=\"adminmail\" value=\"$adminmail\"></td>\n";
	$content3 .= "</tr>\n";
	$content3 .= "<tr>\n";
	$content3 .= "<td bordercolor=\"#C41200\" class=\"td6\">" . _STEP212 . "</td>\n";
	$content3 .= "<td align=\"right\" bordercolor=\"#C41200\" class=\"td6\"><input type=\"text\" name=\"adminpassword\" value=\"$adminpassword\"></td>\n";
	$content3 .= "</tr>\n";
	$content3 .= "</tr>\n";
	$content3 .= "<td bordercolor=\"#C41200\" class=\"td6\">" . _STEP213 . "</td>\n";
	$content3 .= "<td align=\"right\" bordercolor=\"#C41200\" class=\"td6\"><input type=\"text\" name=\"username\" value=\"$username\"></td>\n";
	$content3 .= "</tr>\n";
	$content3 .= "</tr>\n";
	$content3 .= "<td bordercolor=\"#C41200\" class=\"td6\">" . _STEP214 . "</td>\n";
	$content3 .= "<td align=\"right\" bordercolor=\"#C41200\" class=\"td6\"><input type=\"text\" name=\"usermail\" value=\"$usermail\"></td>\n";
	$content3 .= "</tr>\n";
	$content3 .= "<tr>\n";
	$content3 .= "<td bordercolor=\"#C41200\" class=\"td6\">" . _STEP215 . "</td>\n";
	$content3 .= "<td align=\"right\" bordercolor=\"#C41200\" class=\"td6\"><input type=\"text\" name=\"userpassword\" value=\"$userpassword\"></td>\n";
	$content3 .= "</tr>\n";
	$content3 .= "</tr>\n";
	$content3 .= "<td bordercolor=\"#C41200\" class=\"td6\">" . _STEP216 . "</td>\n";
	$content3 .= "<td align=\"right\" bordercolor=\"#C41200\" class=\"td6\"><select name=\"language\">";
	$handle = @opendir( '../language' );
	while ( $file = @readdir($handle) )
	{
		if ( preg_match("/^lang\-(.+)\.php/", $file, $matches) )
		{
			$langFound = $matches[1];
			$languageslist .= "$langFound ";
		}
	}
	closedir( $handle );
	$languageslist = explode( " ", $languageslist );
	sort( $languageslist );
	for ( $i = 0; $i < sizeof($languageslist); $i++ )
	{
		if ( $languageslist[$i] != "" )
		{
			$content3 .= "<option value='" . $languageslist[$i] . "' ";
			if ( $languageslist[$i] == $language ) $content3 .= "selected";
			$content3 .= ">" . ucfirst( $languageslist[$i] ) . "</option>";
		}
	}
	$content3 .= "</select></td>\n";
	$content3 .= "</tr>\n";
	$content3 .= "</tr>\n";
	$content3 .= "<td bordercolor=\"#C41200\" class=\"td6\">" . _STEP217 . "</td>\n";
	$content3 .= "<td align=\"right\" bordercolor=\"#C41200\" class=\"td6\"><input type=\"text\" name=\"datafold\" value=\"$datafold\" onblur='if (this.value==\"\") this.value=\"includes/data\";' onfocus='if (this.value==\"includes/data\") this.value=\"\";'></td>\n";
	$content3 .= "</tr>\n";
	$content3 .= "</tr>\n";
	$content3 .= "<td bordercolor=\"#C41200\" class=\"td6\">" . _STEP218 . "</td>\n";
	$content3 .= "<td align=\"right\" bordercolor=\"#C41200\" class=\"td6\"><input type=\"text\" name=\"adminfold\" value=\"$adminfold\" onblur='if (this.value==\"\") this.value=\"admin\";' onfocus='if (this.value==\"admin\") this.value=\"\";'></td>\n";
	$content3 .= "</tr>\n";
	$content3 .= "</tr>\n";
	$content3 .= "<td bordercolor=\"#C41200\" class=\"td6\">" . _STEP219 . "</td>\n";
	$content3 .= "<td align=\"right\" bordercolor=\"#C41200\" class=\"td6\"><input type=\"text\" name=\"adminfile\" value=\"$adminfile\" onblur='if (this.value==\"\") this.value=\"admin\";' onfocus='if (this.value==\"admin\") this.value=\"\";'></td>\n";
	$content3 .= "</tr>\n";
	$content3 .= "	<tr>\n";
	$content3 .= "	<td align=\"center\" colspan=\"2\"><input type=\"hidden\" name=\"step\" value=\"3\"><input type=\"button\" value=\"" . _STEP221 . "\" onclick=\"window.location.href='install.php'\"><input type=\"submit\" value=\"" . _STEP220 . "\"></td>\n";
	$content3 .= "	</tr>\n";
	$content3 .= "	</table>\n";
	$content3 .= "</form>\n";

	themebody( 2, $content1, $content2, $content3 );
}
else
{
	$content1 = "$thongbao1";
	$content2 = _STEP12;
	$content3 = "";
	$content3 .= "<table border=\"0\" cellpadding=\"3\" style=\"border-collapse: collapse\" width=\"100%\">\n";
	$content3 .= "<tr><td bordercolor=\"#C41200\" class=\"td6\">" . _STEP121 . "</td>\n";
	$content3 .= "<td bordercolor=\"#C41200\" class=\"td6\">" . _STEP1211 . "</td>\n";
	$content3 .= "<td align=\"right\" bordercolor=\"#C41200\" class=\"td6\">" . $phpver_success . "</td>\n";
	$content3 .= "</tr>\n";
	$content3 .= "<tr>\n";
	$content3 .= "<td bordercolor=\"#C41200\" class=\"td6\">" . _STEP122 . "</td>\n";
	$content3 .= "<td bordercolor=\"#C41200\" class=\"td6\">" . _STEP1221 . "</td>\n";
	$content3 .= "<td align=\"right\" bordercolor=\"#C41200\" class=\"td6\">" . $safe_mode_success . "</td>\n";
	$content3 .= "</tr>\n";
	$content3 .= "<tr>\n";
	$content3 .= "<td bordercolor=\"#C41200\" class=\"td6\">" . _STEP125 . "</td>\n";
	$content3 .= "<td bordercolor=\"#C41200\" class=\"td6\">" . _STEP1251 . "</td>\n";
	$content3 .= "<td align=\"right\" bordercolor=\"#C41200\" class=\"td6\">" . $mysqlsupport_success . "</td>\n";
	$content3 .= "</tr>\n";
	$content3 .= "<tr>\n";
	$content3 .= "<td bordercolor=\"#C41200\" class=\"td6\">" . _STEP126 . "</td>\n";
	$content3 .= "<td bordercolor=\"#C41200\" class=\"td6\">" . _STEP1261 . "</td>\n";
	$content3 .= "<td align=\"right\" bordercolor=\"#C41200\" class=\"td6\">" . $register_globals_allowed . "</td>\n";
	$content3 .= "</tr>\n";
	$content3 .= "<tr>\n";
	$content3 .= "<td bordercolor=\"#C41200\" class=\"td6\">" . _STEP127 . "</td>\n";
	$content3 .= "<td bordercolor=\"#C41200\" class=\"td6\">" . _STEP1271 . "</td>\n";
	$content3 .= "<td align=\"right\" bordercolor=\"#C41200\" class=\"td6\">" . $magic_quotes_runtime_allowed . "</td>\n";
	$content3 .= "</tr>\n";
	$content3 .= "<tr>\n";
	$content3 .= "<td bordercolor=\"#C41200\" class=\"td6\">" . _STEP128 . "</td>\n";
	$content3 .= "<td bordercolor=\"#C41200\" class=\"td6\">" . _STEP1281 . "</td>\n";
	$content3 .= "<td align=\"right\" bordercolor=\"#C41200\" class=\"td6\">" . $magic_quotes_gpc_allowed . "</td>\n";
	$content3 .= "</tr>\n";
	$content3 .= "<tr>\n";
	$content3 .= "<td bordercolor=\"#C41200\" class=\"td6\">" . _STEP129 . "</td>\n";
	$content3 .= "<td bordercolor=\"#C41200\" class=\"td6\">" . _STEP1291 . "</td>\n";
	$content3 .= "<td align=\"right\" bordercolor=\"#C41200\" class=\"td6\">" . $magic_quotes_sybase_allowed . "</td>\n";
	$content3 .= "</tr>\n";
	$content3 .= "<tr>\n";
	$content3 .= "<td bordercolor=\"#C41200\" class=\"td6\">" . _STEP130 . "</td>\n";
	$content3 .= "<td bordercolor=\"#C41200\" class=\"td6\">" . _STEP1301 . "</td>\n";
	$content3 .= "<td align=\"right\" bordercolor=\"#C41200\" class=\"td6\">" . $output_buffering_allowed . "</td>\n";
	$content3 .= "</tr>\n";
	$content3 .= "<tr>\n";
	$content3 .= "<td bordercolor=\"#C41200\" class=\"td6\">" . _STEP131 . "</td>\n";
	$content3 .= "<td bordercolor=\"#C41200\" class=\"td6\">" . _STEP1311 . "</td>\n";
	$content3 .= "<td align=\"right\" bordercolor=\"#C41200\" class=\"td6\">" . $sessionauto_start_allowed . "</td>\n";
	$content3 .= "</tr>\n";
	$content3 .= "<tr>\n";
	$content3 .= "<td bordercolor=\"#C41200\" class=\"td6\">" . _STEP132 . "</td>\n";
	$content3 .= "<td bordercolor=\"#C41200\" class=\"td6\">" . _STEP1321 . "</td>\n";
	$content3 .= "<td align=\"right\" bordercolor=\"#C41200\" class=\"td6\">" . $display_errors_allowed . "</td>\n";
	$content3 .= "</tr>\n";
	$content3 .= "<tr>\n";
	$content3 .= "<td bordercolor=\"#C41200\" class=\"td6\">" . _STEP123 . "</td>\n";
	$content3 .= "<td bordercolor=\"#C41200\" class=\"td6\">" . _STEP1231 . "</td>\n";
	$content3 .= "<td align=\"right\" bordercolor=\"#C41200\" class=\"td6\">" . $set_time_limit_allowed . "</td>\n";
	$content3 .= "</tr>\n";
	$content3 .= "<tr>\n";
	$content3 .= "<td bordercolor=\"#C41200\" class=\"td6\">" . _STEP124 . "</td>\n";
	$content3 .= "<td bordercolor=\"#C41200\" class=\"td6\">" . _STEP1241 . "</td>\n";
	$content3 .= "<td align=\"right\" bordercolor=\"#C41200\" class=\"td6\">" . $file_uploads_allowed . "</td>\n";
	$content3 .= "</tr>\n";
	$content3 .= "<tr>\n";
	$content3 .= "<td bordercolor=\"#C41200\" class=\"td6\">" . _STEP133 . "</td>\n";
	$content3 .= "<td bordercolor=\"#C41200\" class=\"td6\">" . _STEP1331 . "</td>\n";
	$content3 .= "<td align=\"right\" bordercolor=\"#C41200\" class=\"td6\">" . $zlib_compression_allowed . "</td>\n";
	$content3 .= "</tr>\n";
	$content3 .= "<tr>\n";
	$content3 .= "<td bordercolor=\"#C41200\" class=\"td6\">" . _STEP134 . "</td>\n";
	$content3 .= "<td bordercolor=\"#C41200\" class=\"td6\">" . _STEP1341 . "</td>\n";
	$content3 .= "<td align=\"right\" bordercolor=\"#C41200\" class=\"td6\">" . $gd_allowed . "</td>\n";
	$content3 .= "</tr>\n";
	$content3 .= "</table>\n";
	if ( $gostep2 == true )
	{
		$content3 .= "<br><br><form method=\"POST\" action=\"install.php\">\n";
		$content3 .= "<table border=\"0\" width=\"100%\" cellpadding=\"0\" style=\"border-collapse: collapse\">\n";
		$content3 .= "	<tr>\n";
		$content3 .= "	<td align=\"center\"><input type=\"hidden\" name=\"step\" value=\"2\"><input type=\"submit\" value=\"" . _STEP136 . "\"></td>\n";
		$content3 .= "	</tr>\n";
		$content3 .= "	</table>\n";
		$content3 .= "</form>\n";
	}
	themebody( 1, $content1, $content2, $content3 );
}

?>
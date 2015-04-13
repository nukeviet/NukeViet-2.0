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

if ( ! defined('NV_DB') )
{
	header( "Location: ../" );
	exit();
}

@chmod( "../$datafold/index.html", 0777 );
@$file = fopen( "../$datafold/index.html", "w" );
@fclose( $file );
@chmod( "../$datafold/index.html", 0604 );

$content = "<filesmatch \"\.php$\">\n";
$content .= "deny from all\n";
$content .= "</filesmatch>\n";
$content .= "<filesmatch \"\.txt$\">\n";
$content .= "deny from all\n";
$content .= "</filesmatch>";
@chmod( "../$datafold/.htaccess", 0777 );
@$file = fopen( "../$datafold/.htaccess", "w" );
@$writefile = fwrite( $file, $content );
@fclose( $file );
@chmod( "../$datafold/.htaccess", 0604 );

@chmod( "../$datafold/mainfile.php", 0777 );
@$file = fopen( "../$datafold/mainfile.php", "w" );
$content = "<?php\n\n";
$fctime = date( "d-m-Y H:i:s", filectime("../$datafold/mainfile.php") );
$fmtime = date( "d-m-Y H:i:s" );
$content .= "// File: mainfile.php.\n// Created: $fctime.\n// Modified: $fmtime.\n// Program: NukeViet CMS v2.0 RC1.\n// Website: www.nukeviet.vn.\n// Do not change anything in this file!\n\n";
$content .= "define('NV_MAINFILE', true);\n";
$content .= "define('NV_ANTIDOS', true);\n\n";
$content .= "\$datafold = \"$datafold\";\n\n";
$content .= "if (file_exists(\"\$datafold/antidos.php\")) {\n";
$content .= "	include(\"\$datafold/antidos.php\");\n";
$content .= "} elseif(file_exists(\"../\$datafold/antidos.php\")) {\n";
$content .= "	include(\"../\$datafold/antidos.php\");\n";
$content .= "}\n\n";
$content .= "\$dbhost = \"$dbhost\";\n";
$content .= "\$dbname = \"$dbname\";\n\n";
$content .= "\$db_tmp = date(\"G\") % 3;\n";
$content .= "switch (\$db_tmp) {\n";
$content .= "	case 0:\n";
$content .= "		\$dbuname=\"$dbuname0\"; \n";
$content .= "		\$dbpass = \"$dbpass0\"; \n";
$content .= "		break;\n";
$content .= "	case 1:\n";
if ( $dbuname1 != "" )
{
	$content .= "		\$dbuname=\"$dbuname1\"; \n";
	$content .= "		\$dbpass = \"$dbpass1\"; \n";
}
else
{
	$content .= "		\$dbuname=\"$dbuname0\"; \n";
	$content .= "		\$dbpass = \"$dbpass0\"; \n";
}
$content .= "		break;\n";
$content .= "	case 2:\n";
if ( $dbuname2 != "" )
{
	$content .= "		\$dbuname=\"$dbuname2\"; \n";
	$content .= "		\$dbpass = \"$dbpass2\"; \n";
}
else
{
	$content .= "		\$dbuname=\"$dbuname0\"; \n";
	$content .= "		\$dbpass = \"$dbpass0\"; \n";
}
$content .= "		break;\n";
$content .= "}\n\n";
$content .= "\$prefix = \"$prefix\";\n";
$content .= "\$user_prefix = \"$user_prefix\";\n";
$content .= "\$dbtype = \"MySQL\";\n";
$content .= "\$sitekey = \"$sitekey\";\n\n";
$content .= "@require_once(\"includes/functions/mainfile.php\");\n\n";
$content .= "?>";
@$writefile = fwrite( $file, $content );
@fclose( $file );
@chmod( "../$datafold/mainfile.php", 0604 );

@chmod( "../$datafold/config.php", 0777 );
@$file = fopen( "../$datafold/config.php", "w" );
$content = "<?php\n\n";
$fctime = date( "d-m-Y H:i:s", filectime("../$datafold/config.php") );
$fmtime = date( "d-m-Y H:i:s" );
$content .= "// File: config.php.\n// Created: $fctime.\n// Modified: $fmtime.\n// Program: NukeViet CMS v2.0 RC1.\n// Website: www.nukeviet.vn.\n// Do not change anything in this file!\n\n";
$content .= "if ((!defined('NV_SYSTEM')) AND (!defined('NV_ADMIN'))) {\n";
$content .= "die('Stop!!!');\n";
$content .= "}\n";
$content .= "\n";
$content .= "define(\"USER_COOKIE\",\"$ucookies\");\n";
$content .= "define(\"ADMIN_COOKIE\",\"$acookies\");\n";
$content .= "\$sitename = \"$sitename\";\n";
$content .= "\$nukeurl = \"$nukeurl\";\n";
$content .= "\$site_logo = \"logo.gif\";\n";
$content .= "\$startdate = \"$startdate\";\n";
$content .= "\$adminmail = \"$adminmail\";\n";
$content .= "\$anonpost = \"1\";\n";
$content .= "\$Default_Theme = \"nv_silver\";\n";
$content .= "\$changtheme = \"0\";\n";
$content .= "\$actthemes = \"nv_green|nv_orange|nv_silver\";\n";
$content .= "\$live_cookie_time = \"365\";\n";
$content .= "\$cookie_path = \"$cookie_path\";\n";
$content .= "\$cookie_domain = \"$cookie_domain\";\n";
$content .= "\$language = \"$language\";\n";
$content .= "\$gfx_chk = \"7\";\n";
$content .= "\$multilingual = \"1\";\n";
$content .= "\$notify = \"1\";\n";
$content .= "\$anonymous = \"Guest\";\n";
$content .= "\$admingraphic = \"1\";\n";
$content .= "\$minpass = \"5\";\n";
$content .= "\$pollcomm = \"1\";\n";
$content .= "\$articlecomm = \"1\";\n";
$content .= "\$Home_Module = \"News\";\n";
$content .= "\$adminfold = \"$adminfold\";\n";
$content .= "\$adminfile = \"$adminfile\";\n";
$content .= "\$disable_site = \"0\";\n";
$content .= "\$disable_message = \"\";\n";
$content .= "\$gzip_method = \"0\";\n";
$content .= "\$eror_value = \"1\";\n";
$content .= "\$counteract = \"1\";\n";
$content .= "\$timecount = \"300\";\n";
$content .= "\$hourdiff = \"0\";\n";
$content .= "\$htg1 = \"d.m.Y\";\n";
$content .= "\$htg2 = \"d.m.Y H:i\";\n";
$content .= "\$width = 600;\n";
$content .= "\$max_size = $maxupload;\n";
$content .= "\$antidos = 0;\n";
$content .= "\$security_tags = \"script|object|iframe|applet|meta|style|form|img|onmouseover|body\";\n";
$content .= "\$security_url_get = 0;\n";
$content .= "\$security_url_post = 0;\n";
$content .= "\$security_union_get = 1;\n";
$content .= "\$security_union_post = 1;\n";
$content .= "\$security_cookies = 1;\n";
$content .= "\$security_sessions = 1;\n";
$content .= "\$security_files = \"php|php3|php4|pl|phtml|html|htm|asp|cgi\";\n";
$content .= "\$editor = \"1\";\n";
$content .= "\n";
$content .= "\$AllowableHTML = array(\"b\"=>1,\"i\"=>1,\"strike\"=>1,\"div\"=>2,\"u\"=>1,\"a\"=>2,\"em\"=>1,\"br\"=>1,\"strong\"=>1,\"blockquote\"=>1,\"tt\"=>1,\"li\"=>1,\"ol\"=>1,\"ul\"=>1);\n";
$content .= "define('NV_INSTALLED', true);\n";
$content .= "\n";
$content .= "?>";
@$writefile = fwrite( $file, $content );
@fclose( $file );
@chmod( "../$datafold/config.php", 0604 );

@chmod( "../$datafold/config_admin.php", 0777 );
@$file = fopen( "../$datafold/config_admin.php", "w" );
$content = "<?php\n\n";
$fctime = date( "d-m-Y H:i:s", filectime("../$datafold/config_admin.php") );
$fmtime = date( "d-m-Y H:i:s" );
$content .= "// File: config_admin.php.\n// Created: $fctime.\n// Modified: $fmtime.\n// Program: NukeViet CMS v2.0 RC1.\n// Website: www.nukeviet.vn.\n// Do not change anything in this file!\n\n";
$content .= "if (!defined('NV_ADMIN')) {\n";
$content .= "die('Stop!!!');\n";
$content .= "}\n";
$content .= "\n";
$content .= "\$superadmin_add_superadmin = 0;\n";
$content .= "\$superadmin_chg_superadmin = 0;\n";
$content .= "\$superadmin_chg_level = 0;\n";
$content .= "\$superadmin_edit = 1;\n";
$content .= "\$superadmin_edit_level = 0;\n";
$content .= "\$superadmin_add_modadmin = 1;\n";
$content .= "\$superadmin_edit_modadmin = 1;\n";
$content .= "\$emailgodadmin = 1;\n";
$content .= "\$firewall = 1;\n";
$content .= "\$adv_admin = \"\";\n";
$content .= "\$expiring_login = 36000;\n";
$content .= "\$block_admin_ip = 0;\n";
$content .= "\$allowed_admin_ip = \"\";\n";
$content .= "\$ip_test_fields = 1;\n";
$content .= "\n";
$content .= "?>";
@$writefile = fwrite( $file, $content );
@fclose( $file );
@chmod( "../$datafold/config_admin.php", 0604 );

@chmod( "../$datafold/config_Your_Account.php", 0777 );
@$file = fopen( "../$datafold/config_Your_Account.php", "w" );
$content = "<?php\n\n";
$fctime = date( "d-m-Y H:i:s", filectime("../$datafold/config_Your_Account.php") );
$fmtime = date( "d-m-Y H:i:s" );
$content .= "// File: config_Your_Account.php.\n// Created: $fctime.\n// Modified: $fmtime.\n// Program: NukeViet CMS v2.0 RC1.\n// Website: www.nukeviet.vn.\n// Do not change anything in this file!\n\n";
$content .= "if ((!defined('NV_SYSTEM')) AND (!defined('NV_ADMIN'))) {\n";
$content .= "die('Stop!!!');\n";
$content .= "}\n";
$content .= "\n";
$content .= "\$allowuserreg = 0;\n";
$content .= "\$allowuserlogin = 0;\n";
$content .= "\$useactivate = 0;\n";
$content .= "\$nick_max = 30;\n";
$content .= "\$nick_min = 5;\n";
$content .= "\$pass_max = 15;\n";
$content .= "\$pass_min = 4;\n";
$content .= "\$expiring = 86400;\n";
$content .= "\$userredirect = \"home\";\n";
$content .= "\$sendmailuser = 1;\n";
$content .= "\$send2mailuser = 0;\n";
$content .= "\$allowmailchange = 1;\n";
$content .= "\$bad_mail = \"yoursite.com|mysite.com|localhost|xxx\";\n";
$content .= "\$bad_nick = \"anonimo|anonymous|god|linux|nobody|operator|root\";\n";
$content .= "\$suspend_nick = \"\";\n";
$content .= "\n";
$content .= "?>";
@$writefile = fwrite( $file, $content );
@fclose( $file );
@chmod( "../$datafold/config_Your_Account.php", 0604 );

@chmod( "../$datafold/config_News.php", 0777 );
@$file = fopen( "../$datafold/config_News.php", "w" );
$content = "<?php\n\n";
$fctime = date( "d-m-Y H:i:s", filectime("../$datafold/config_News.php") );
$fmtime = date( "d-m-Y H:i:s" );
$content .= "// File: config_News.php.\n// Created: $fctime.\n// Modified: $fmtime.\n// Program: NukeViet CMS v2.0 RC1.\n// Website: www.nukeviet.vn.\n// Do not change anything in this file!\n\n";
$content .= "if ((!defined('NV_SYSTEM')) AND (!defined('NV_ADMIN'))) {\n";
$content .= "die('Stop!!!');\n";
$content .= "}\n";
$content .= "\n";
$content .= "\$articlecomm = 2;\n";
$content .= "\$commentcheck = 0;\n";
$content .= "\$addnews = 1;\n";
$content .= "\$newsprint = 1;\n";
$content .= "\$newssave = 1;\n";
$content .= "\$newsfriend = 1;\n";
$content .= "\$newshome = 1;\n";
$content .= "\$catnewshome = 0;\n";
$content .= "\$newspagenum = 15;\n";
$content .= "\$catnewshomeimg = \"left\";\n";
$content .= "\$sizecatnewshomeimg = 120;\n";
$content .= "\$sizeimgskqa = 200;\n";
$content .= "\$catimgnewshome = 1;\n";
$content .= "\$newsarticleimg = \"left\";\n";
$content .= "\$sizenewsarticleimg = 150;\n";
$content .= "\$hienthi_tlq = 10;\n";
$content .= "\$hienthi_ccd = 15;\n";
$content .= "\$comblbarstat = 1;\n";
$content .= "\$block_atl = 5;\n";
$content .= "\$sizeatl = 124;\n";
$content .= "\$htatl = 0;\n";
$content .= "\$temp_path = \"uploads/News/temp_pic\";\n";
$content .= "\$path = \"uploads/News/pic\";\n";
$content .= "\n";
$content .= "?>";
@$writefile = fwrite( $file, $content );
@fclose( $file );
@chmod( "../$datafold/config_News.php", 0604 );

@chmod( "../$datafold/config_Files.php", 0777 );
@$file = fopen( "../$datafold/config_Files.php", "w" );
$content = "<?php\n\n";
$fctime = date( "d-m-Y H:i:s", filectime("../$datafold/config_Files.php") );
$fmtime = date( "d-m-Y H:i:s" );
$content .= "// File: config_Files.php.\n// Created: $fctime.\n// Modified: $fmtime.\n// Program: NukeViet CMS v2.0 RC1.\n// Website: www.nukeviet.vn.\n// Do not change anything in this file!\n\n";
$content .= "if ((!defined('NV_SYSTEM')) AND (!defined('NV_ADMIN'))) {\n";
$content .= "die('Stop!!!');\n";
$content .= "}\n";
$content .= "\n";
$content .= "\$newscatid = 0;\n";
$content .= "\$numnews = 1;\n";
$content .= "\$catngan = 250;\n";
$content .= "\$choncatngan = 1;\n";
$content .= "\$ttt = 1;\n";
$content .= "\$prefilename = \"\";\n";
$content .= "\$autofilename = 0;\n";
$content .= "\$fnote = 1;\n";
$content .= "\$showsub = 1;\n";
$content .= "\$tabcolumn = 2;\n";
$content .= "\$filesperpage = 15;\n";
$content .= "\$download = 0;\n";
$content .= "\$fchecknum = 1;\n";
$content .= "\$addcomments = 2;\n";
$content .= "\$brokewarning = 2;\n";
$content .= "\$filesvote = 2;\n";
$content .= "\$addfiles = 2;\n";
$content .= "\$uploadfiles = 2;\n";
$content .= "\$files_mime = \"pdf,exe,zip,rar,gz,tgz,tar,bz2,doc,xls,ppt,png,jpeg,jpg,mp3,wav,mpeg,mpg,mpe,mov,wmv,avi\";\n";
$content .= "\$maxfilesize = 2000000;\n";
$content .= "\$path = 'uploads/Files/pub_dir';\n";
$content .= "\$temp_path = 'uploads/Files/temp_dir';\n";
$content .= "\$fhomemsg = 'Tai day ban co the tai cac phan mem tien ich.';\n";
$content .= "\n";
$content .= "?>";
@$writefile = fwrite( $file, $content );
@fclose( $file );
@chmod( "../$datafold/config_Files.php", 0604 );

@chmod( "../$datafold/admlock.php", 0777 );
@$file = fopen( "../$datafold/admlock.php", "w" );
$content = "<?php\n\n";
$fctime = date( "d-m-Y H:i:s", filectime("../$datafold/admlock.php") );
$fmtime = date( "d-m-Y H:i:s" );
$content .= "// File: admlock.php.\n// Created: $fctime.\n// Modified: $fmtime.\n// Program: NukeViet CMS v2.0 RC1.\n// Website: www.nukeviet.vn.\n// Do not change anything in this file!\n\n";
$content .= "?>";
@$writefile = fwrite( $file, $content );
@fclose( $file );
@chmod( "../$datafold/admlock.php", 0604 );

?>
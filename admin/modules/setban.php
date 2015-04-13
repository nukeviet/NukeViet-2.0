<?php

/*
* @Program:		NukeViet CMS
* @File name: 	NukeViet System
* @Version: 	2.0 RC3
* @Date: 		01.03.2010
* @Website: 	www.nukeviet.vn
* @Copyright: 	(C) 2010
* @License: 	http://opensource.org/licenses/gpl-license.php GNU Public License
*/

if ( ! defined('NV_ADMIN') )
{
	die( "Access Denied" );
}

if ( defined('IS_SPADMIN') )
{
	$checkmodname = "Setban";
	if ( file_exists("language/" . $checkmodname . "_" . $currentlang . ".php") )
	{
		include_once ( "language/" . $checkmodname . "_" . $currentlang . ".php" );
	}
	if ( file_exists("../$datafold/config_" . $checkmodname . ".php") )
	{
		include_once ( "../$datafold/config_" . $checkmodname . ".php" );
	}
	define( "IMG_PATH", "../images/modules/" . $checkmodname . "/" );


	/**
	 * ConfigureBan()
	 * 
	 * @param mixed $bad_ip
	 * @return
	 */
	function ConfigureBan()
	{
		global $adminfile, $datafold, $db, $prefix;
		include ( "../header.php" );
		GraphicAdmin();
		OpenTable();
		echo "<center><font class=\"title\"><b>" . _BANADMIN . "</b></font></center>";
		CloseTable();
		echo "<br>";
		OpenTable();
		$ip_ban_list = "";
		$bad_ip = ( isset($_GET['bad_ip']) ) ? trim( $_GET['bad_ip'] ) : (( isset($_POST['bad_ip']) ) ? trim( $_POST['bad_ip'] ) : "");
		
		echo"<p align=\"center\"><b>" . _BANBADADRES . " </b></p>";
		$a = 0;
		$result = $db->sql_query("SELECT `id`, `banip`, `settime` FROM `" . $prefix . "_banip`");
		echo"<table border=\"1\" cellpadding=\"3\" cellspacing=\"3\" align=\"center\" style=\"border-collapse: collapse;border: 1px solid #CCCCCC;\">";
			echo"<tr align=\"center\" style=\"background-color: #E4E4E4;font-weight: bold\"><td><b>STT</b></td><td><b>IP</b></td><td><b>Time</b></td><td>"._FUNCTIONS."</tr>";
		while ( list($id, $banip, $settime) = $db->sql_fetchrow($result) ) {
			$a++;
			echo"<tr><td align=\"center\">" . $a . "</td>" . "<td>".$banip."</td><td>".date("H:s d/m/Y", $settime)."</td><td align=\"center\"><a href=\"" . $adminfile . ".php?op=SaveSetBan&id=".$id."\">"._DELETE."</td></tr>";
		}
		echo"</table>\n";
		echo "<br><br><form action=\"" . $adminfile . ".php\" method=\"post\">\n" . "<table border=\"0\" align=\"center\">
		<tr><td>" . _BANADDADRES . "</td>" . "<td><input type=\"text\" size=\"16\" name=\"ip_ban_add\" value=\"$bad_ip\"></td>";
		echo "<td><input type=\"hidden\" name=\"op\" value=\"SaveSetBan\">\n";
		echo "" . "<input type=\"submit\" value=\"" . _BANSAVED . "\"></center>\n" . "</form>" . "</td></tr>\n" . "</table>\n";
		CloseTable();
		echo "<br>";
		include ( "../footer.php" );
	}

	function SaveSetBan()
	{
		global $db, $prefix, $adminfile, $datafold;
		if (isset($_POST['ip_ban_add'])) {
			$ip_ban_add = trim($_POST['ip_ban_add']);
			if (preg_match( '/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$/', $ip_ban_add) ) {
				$db->sql_query("CREATE TABLE IF NOT EXISTS `" . $prefix . "_banip` (
				  `id` int(10) NOT NULL auto_increment,
  				  `banip` varchar(20) NOT NULL default '',
				  `settime` int(11) NOT NULL default '1',
				  PRIMARY KEY  (`id`),
				  UNIQUE KEY `banip` (`banip`)
				)");
				 $db->sql_query("INSERT INTO " . $prefix . "_banip (`id`, `banip`, `settime`) VALUES (NULL, '".$ip_ban_add."', UNIX_TIMESTAMP())");
			}
		}
		elseif (isset($_GET['id'])) {
			 $db->sql_query("DELETE FROM " . $prefix . "_banip WHERE `id` = '".intval($_GET['id'])."' LIMIT 1");
		}
		
		$filename = "../".$datafold."/config_banip.php";
		if (!file_exists($filename)) {
			file_put_contents($filename, "");
		}

		@chmod($filename, 0777 );
		if (is_writable($filename)) {
			@$file = fopen($filename, "w" );
			$content = "<?php\n\n";
			$content .= "if ((!defined('NV_SYSTEM')) AND (!defined('NV_ADMIN'))) {\n";
			$content .= "\tdie('Stop!!!');\n";
			$content .= "}\n";
			$content .= "\$array_ip_ban = array();\n";
			$result = $db->sql_query("SELECT `banip` FROM `" . $prefix . "_banip`");
			while ( list($banip) = $db->sql_fetchrow($result) ) {
				$content .= "\$array_ip_ban[] ='".$banip."';\n";
			}
			$content .= "?>";
			@fwrite( $file, $content );
			@fclose( $file );
			@chmod($file, 0604 );
			Header( "Location: " . $adminfile . ".php?op=ConfigureBan" );
		}
		else {
			info_exit("The file ".$filename." is not writable");
		}
	}	


	switch ( $op )
	{

		case "ConfigureBan":
			ConfigureBan();
			break;

		case "SaveSetBan":
			SaveSetBan();
			break;

	}

}
else
{
	echo "Access Denied";
}

?>
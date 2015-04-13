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

if ( isset($_POST['admf']) )
{
	$admf = $_POST['admf'];
	if ( ! ereg("[^a-zA-Z0-9._-]", $admf) )
	{
		if ( ! ereg(".php", $admf) )
		{
			$admf = "" . $admf . ".php";
		}
		if ( file_exists("" . $admf . "") )
		{
			$info = base64_encode( "$admf" );
			setcookie( "admf", "$info" );
			Header( "Location: index.php" );
			exit();
		}
	}
}

if ( isset($_COOKIE['admf']) && ! ereg("[^a-zA-Z0-9._-]", addslashes(base64_decode($_COOKIE['admf']))) && file_exists("" . addslashes(base64_decode($_COOKIE['admf'])) . "") )
{
	Header( "Location: " . addslashes(base64_decode($_COOKIE['admf'])) . "" );
	exit;
}

?>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Welcome</title>
</head>

<body>

<table border="0" cellpadding="0" style="border-collapse: collapse" width="100%" height="100%">
	<tr>
		<td align="center">
		<form method="POST" action="index.php">
			<table border="0" cellpadding="3" style="border-collapse: collapse" cellspacing="3">
				<tr>
					<td><b>Admin File</b></td>
					<td><input type="password" name="admf" size="20" maxlength="20"><input type="submit" value="Go" style="font-weight: bold"></td>
				</tr>
			</table>
		</form>
		</td>
	</tr>
</table>

</body>

</html>
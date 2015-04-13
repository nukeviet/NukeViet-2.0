<?php

/*
* @Program:	NukeViet CMS
* @File name: 	NukeViet System
* @Version: 	2.0 RC1
* @Date: 		01.05.2009
* @Website: 	www.nukeviet.vn
* @Copyright: 	(C) 2009
* @License: 	http://opensource.org/licenses/gpl-license.php GNU Public License
*/

if ( ! defined('NV_ADMIN') ) die( "Access Denied" );

switch ( $op )
{

	case "modules":
	case "module_status":
	case "module_edit":
	case "module_edit_save":
		include ( "modules/modules.php" );
		break;

}

?>
<?php

/*
* @Program:		NukeViet CMS
* @File name: 	NukeViet Setup
* @Author: 		NukeViet Group
* @Version: 	2.0 RC2
* @Date: 		07.07.2009
* @Website: 	www.nukeviet.vn
* @Copyright: 	(C) 2009
* @License: 	http://opensource.org/licenses/gpl-license.php GNU Public License
*/

//addon error report by nta babentanh@yahoo.com 22/2/2009
define( "_ERRB40", "Error: File mainfile.php on root is not existed, please copy this file from include/data and paste to root of website" );
define( "_ERRB41", "Nukeviet 2.0 successfull installed. Please delete folder install on root to continue!" );
define( "_CHKTOCOPY", "Auto copy file manfile.php to root (Sometime it gets problem with MOD of directory.)" );
define( "_VERSIONPHP", "Error: Your PHP version is not suite with nukeviet, please update newer" );
define( "_ERRB35", "Error: CSDL table is not existed on server, please check your CSDL table name" );
define( "_ERRB34", "Error: Can't connect to CSDL, please check your username CSDL 1 and password" );
define( "_ERRB33", "Error: Username member is disallowed, please use another name" );
define( "_ERRB32", "Error: Email adddress is disallowed, please use another one" );
define( "_ERRB31", "Error: Members's email is not valid, email shouldn't content special symbols. (use standart email like this: abc@mail.com)" );
define( "_ERRB30", "Error: Admin's email is not valid, email shouldn't content special symbols. (use standart email like this: abc@mail.com)" );
define( "_ERRB23", "Error: User's password is not valid. Password should contain letters a-zA-Z,digit 0-9, at least 5 characters long and no more than 15" );
define( "_ERRB22", "Error: Username member is not valid. Username should contain letters a-zA-Z,digit 0-9, at least 5 characters long and no more than 15" );
define( "_ERRB21", "Error: Admin's password is not valid. Password should contain letters a-zA-Z,digit 0-9, at least 5 characters long and no more than 15" );
define( "_ERRB20", "Error: Admin name is not valid. It should contain letters a-zA-Z,digit 0-9, at least 5 characters long and no more than 15" );
define( "_ERRB19", "Error: Not declared name of admin folder" );
define( "_ERRB18", "Error: Choose main language for your site" );
define( "_ERRB17", "Error: User's password is not declared" );
define( "_ERRB16", "Error: Username member is not declared" );
define( "_ERRB15", "Error: Admin's password is not declared" );
define( "_ERRB14", "Error: Admin name is not declared" );
define( "_ERRB13", "Error: Please declare personal prefix for portal" );
define( "_ERRB12", "Error: Please declare prefix for portal" );
define( "_ERRB11", "Error: Please enter CDSL name" );
define( "_ERRB10", "Error: Username CSDL 1 is not declared" );
define( "_ERRB9", "Error: Please enter password for CSDL 1" );
define( "_ERRB8", "Error: You didn't enter admin folder name" );
define( "_ERRB7", "Error: File name Admin's not declared" );
//
define( "_CHARSET", "UTF-8" );
define( "_SUCCESS", "Available" );
define( "_FAILED", "Unavailable" );
define( "_WARNING", "WARNING" );
define( "_STEP1", "Check" );
define( "_STEP2", "Authorities" );
define( "_STEP3", "Create Database" );
define( "_STEP4", "Finish" );
define( "_STEP12", "Check your availability" );
define( "_STEP121", "PHP version" );
define( "_STEP1211", "Requirement 4.3.0 or above" );
define( "_STEP122", "Safe Mode" );
define( "_STEP1221", "Requirement: OFF" );
define( "_STEP123", "Set_time_limit()" );
define( "_STEP1231", "Recommend: ON" );
define( "_STEP124", "File Uploads" );
define( "_STEP1241", "Recommend: ON" );
define( "_STEP125", "MySQL Supported" );
define( "_STEP1251", "Requirement supported" );
define( "_STEP126", "Register Globals" );
define( "_STEP1261", "Recommend: ON" );
define( "_STEP127", "Magic Quotes Runtime" );
define( "_STEP1271", "Recommend: OFF" );
define( "_STEP128", "Magic Quotes GPC" );
define( "_STEP1281", "Recommend: OFF" );
define( "_STEP129", "Magic Quotes Sybase" );
define( "_STEP1291", "Recommend: OFF" );
define( "_STEP130", "Output Buffering" );
define( "_STEP1301", "Recommend: OFF" );
define( "_STEP131", "Session auto start" );
define( "_STEP1311", "Recommend: OFF" );
define( "_STEP132", "Display Errors" );
define( "_STEP1321", "Recommend: OFF" );
define( "_STEP133", "Zlib compression support" );
define( "_STEP1331", "Recommend supported" );
define( "_STEP134", "GD graphics support" );
define( "_STEP1341", "Recommend supported" );
define( "_STEP135", "Successful checked. Now you can continue to Setup" );
define( "_STEP1351", "Successful checked. Sorry, your server is not ready to install NukeViet." );
define( "_STEP1352", "Successful checked. Some equirements are not ready to install NukeViet, may be adverse effect to NukeViet system. You can continue to Setup and upgrade your server later." );
define( "_STEP136", "Continue to Step 2" );
define( "_STEP22", "Installation system" );
define( "_STEP23", "Database host *" );
define( "_STEP240", "Database user 1 *" );
define( "_STEP250", "Database password 1 *" );
define( "_STEP241", "Database user 2" );
define( "_STEP251", "Database password 2" );
define( "_STEP242", "Database user 3" );
define( "_STEP252", "Database password 3" );
define( "_STEP26", "Database name *" );
define( "_STEP27", "Public Prefix *" );
define( "_STEP28", "Private Prefix *" );
define( "_STEP29", "Site Name" );
define( "_STEP220", ">> Step 3" );
define( "_STEP221", "Step 1 <<" );
define( "_STEP210", "Admin username *" );
define( "_STEP211", "Admin Email *" );
define( "_STEP212", "Admin password *" );
define( "_STEP213", "First member username *" );
define( "_STEP214", "Member Email *" );
define( "_STEP215", "Member password *" );
define( "_STEP216", "Default language *" );
define( "_STEP217", "Data folder *" );
define( "_STEP218", "Admin folder *" );
define( "_STEP219", "Admin file *" );
define( "_STEP222", "Note:<li>The forms with '*' are requirement.</li><li>Database informations supplied by hosting provider.</li><li>Username and password must be alphanumberic, unavaiable: anonimo, god, linux, nobody, root, operator, anonymous...</li><li>Eail address must be real email.</li><li>Default, 'Data folder' is 'includes/data'. If you redeclaration, you must MOVE and CHMOD 777 before continue.</li><br>" );
define( "_STEP2222", "<font color=#ffffff>Fill all the (*) field to continue!!!</font>" );
define( "_STEP32", "Create system database" );
define( "_STEP33", "Create Database" );
define( "_STEP34", "Create Data files" );
define( "_STEP35", ">> Step 4" );
define( "_STEP36", "Now you must copy <b>mainfile.php</b> in" );
define( "_STEP37", "folder to system root folder, after that click <u>Step 4</u> button to continue." );
define( "_STEP42", "Install Finish" );
define( "_STEP43", "Congratulation!!! System installation is successful. Please DELETE the <b>install</b> folder and login to your Administration Panel to config your site.<br><b>Note:</b> Please <font color=\"#ffffff\">CHMOD <u>uploads</u> folder</font> and sub-folders on it to <b>777</b>. If you don't do that now, the system will unavailable to upload.<br>Need help? Visit: <a href=http://www.nukeviet.vn target=_blank><font color=\"#ffffff\">Nukeviet forum</font></a>.<br>Thanks!" );
define( "_STEP44", "Go to Administration Panel" );
define( "_STEP45", "Go to Homepage" );

?>
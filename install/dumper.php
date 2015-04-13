<?php

/*
* @Program:		NukeViet CMS
* @File name: 	NukeViet Setup
* @Author: 		NukeViet Group
* @Version: 	2.0 RC4
* @Date: 		06.04.2010
* @Website: 	www.nukeviet.vn
* @Copyright: 	(C) 2010
* @License: 	http://opensource.org/licenses/gpl-license.php GNU Public License
*/

if ( ! defined('NV_DB') )
{
	header( "Location: ../" );
	exit();
}

include ( "../includes/mysql.php" );
$time = time();
$user_regdate = date( "M d, Y" );

$db = new sql_db( $dbhost, $dbuname0, $dbpass0, $dbname, false );

$db->sql_query( "DROP TABLE IF EXISTS " . $prefix . "_authors" );
$db->sql_query( "CREATE TABLE " . $prefix . "_authors (
  aid varchar(25) NOT NULL default '',
  name varchar(50) default NULL,
  url varchar(255) NOT NULL default '',
  email varchar(255) NOT NULL default '',
  pwd varchar(40) default NULL,
  radminsuper tinyint(2) NOT NULL default '1',
  admlanguage varchar(30) NOT NULL default '',
  checknum varchar(40) NOT NULL default '',
  last_login int(11) default NULL,
  last_ip varchar(15) NOT NULL default '',
  agent varchar(80) NOT NULL default '',
  PRIMARY KEY  (aid),
  KEY aid (aid)
)" );

$db->sql_query( "INSERT INTO " . $prefix . "_authors VALUES ( '$adminname', 'God', '$nukeurl', '$adminmail', '" . md5($adminpassword) . "', '1', '', '', 0, '', '')" );

$db->sql_query( "DROP TABLE IF EXISTS " . $prefix . "_blocks" );
$db->sql_query( "CREATE TABLE " . $prefix . "_blocks (
  bid int(10) NOT NULL auto_increment,
  bkey int(1) NOT NULL default '0',
  title varchar(60) NOT NULL default '',
  url varchar(200) NOT NULL default '',
  bposition char(1) NOT NULL default '',
  weight int(10) NOT NULL default '1',
  active int(1) NOT NULL default '1',
  refresh int(10) NOT NULL default '0',
  time varchar(14) NOT NULL default '0',
  blanguage varchar(30) NOT NULL default '',
  blockfile varchar(255) NOT NULL default '',
  view int(1) NOT NULL default '0',
  expire varchar(14) NOT NULL default '0',
  action char(1) NOT NULL default '',
  link varchar(255) NOT NULL,
  module varchar(255) NOT NULL, 
  PRIMARY KEY  (bid),
  KEY bid (bid),
  KEY title (title)
)" );

$db->sql_query( "INSERT INTO " . $prefix . "_blocks VALUES ( '1', '0', 'Tiện ích trên site', '', 'l', '1', '1', '0', '1240857254', 'vietnamese', 'block-Menu1_default.php', '0', '0', 'd', '', 'all')" );
$db->sql_query( "INSERT INTO " . $prefix . "_blocks VALUES ( '2', '0', 'Tra bài theo ngày', '', 'l', '2', '1', '0', '1246781227', 'vietnamese', 'block-Calendar.php', '0', '0', 'd', '', 'all')" );
$db->sql_query( "INSERT INTO " . $prefix . "_blocks VALUES ( '3', '0', 'Nhận tin qua mail', '', 'l', '3', '1', '0', '1246781289', 'vietnamese', 'block-Letter.php', '0', '0', 'd', '', 'all')" );
$db->sql_query( "INSERT INTO " . $prefix . "_blocks VALUES ( '4', '0', 'Trực tuyến trên site', '', 'l', '4', '1', '0', '1246781347', 'vietnamese', 'block-Online.php', '0', '0', 'd', '', 'all')" );
$db->sql_query( "INSERT INTO " . $prefix . "_blocks VALUES ( '5', '0', 'Select language', '', 'r', '1', '1', '0', '1246781398', 'vietnamese', 'block-Languages.php', '0', '0', 'd', '', 'all')" );
$db->sql_query( "INSERT INTO " . $prefix . "_blocks VALUES ( '6', '0', 'Tìm kiếm', '', 'r', '2', '1', '0', '1246781442', 'vietnamese', 'block-Search.php', '0', '0', 'd', '', 'all')" );
$db->sql_query( "INSERT INTO " . $prefix . "_blocks VALUES ( '7', '0', 'Danh mục tin', '', 'r', '3', '1', '0', '1246781473', 'vietnamese', 'block-Categories.php', '0', '0', 'd', '', 'all')" );
$db->sql_query( "INSERT INTO " . $prefix . "_blocks VALUES ( '8', '0', 'Bình chọn', '', 'r', '4', '1', '0', '1246781535', 'vietnamese', 'block-RandomVoting.php', '0', '0', 'd', '', 'all')" );
$db->sql_query( "INSERT INTO " . $prefix . "_blocks VALUES ( '9', '0', 'Lịch vạn sự', '', 'r', '5', '1', '0', '1246781644', 'vietnamese', 'block-Amlich.php', '0', '0', 'd', '', 'all')" );
$db->sql_query( "INSERT INTO " . $prefix . "_blocks VALUES ( '10', '0', 'Danh ngôn', '', 'c', '1', '1', '0', '1246782623', 'vietnamese', 'block-Danhngon_ty_cs.php', '0', '0', 'd', '', 'all')" );
$db->sql_query( "INSERT INTO " . $prefix . "_blocks VALUES ( '11', '0', 'Main menu', '', 'l', '1', '1', '0', '1240857254', 'english', 'block-Menu1_default.php', '0', '0', 'd', '', 'all')" );
$db->sql_query( "INSERT INTO " . $prefix . "_blocks VALUES ( '12', '0', 'Calendar', '', 'l', '2', '1', '0', '1246781227', 'english', 'block-Calendar.php', '0', '0', 'd', '', 'all')" );
$db->sql_query( "INSERT INTO " . $prefix . "_blocks VALUES ( '13', '0', 'Newsletter', '', 'l', '3', '1', '0', '1246781289', 'english', 'block-Letter.php', '0', '0', 'd', '', 'all')" );
$db->sql_query( "INSERT INTO " . $prefix . "_blocks VALUES ( '14', '0', 'Online', '', 'l', '4', '1', '0', '1246781347', 'english', 'block-Online.php', '0', '0', 'd', '', 'all')" );
$db->sql_query( "INSERT INTO " . $prefix . "_blocks VALUES ( '15', '0', 'Select language', '', 'r', '1', '1', '0', '1246781398', 'english', 'block-Languages.php', '0', '0', 'd', '', 'all')" );
$db->sql_query( "INSERT INTO " . $prefix . "_blocks VALUES ( '16', '0', 'Search', '', 'r', '2', '1', '0', '1246781442', 'english', 'block-Search.php', '0', '0', 'd', '', 'all')" );
$db->sql_query( "INSERT INTO " . $prefix . "_blocks VALUES ( '17', '0', 'Categories', '', 'r', '3', '1', '0', '1246781473', 'english', 'block-Categories.php', '0', '0', 'd', '', 'all')" );
$db->sql_query( "INSERT INTO " . $prefix . "_blocks VALUES ( '18', '0', 'Random Voting', '', 'r', '4', '1', '0', '1246781535', 'english', 'block-RandomVoting.php', '0', '0', 'd', '', 'all')" );
$db->sql_query( "INSERT INTO " . $prefix . "_blocks VALUES ( '19', '0', 'Lunar Calendar', '', 'r', '5', '1', '0', '1246781644', 'english', 'block-Amlich.php', '0', '0', 'd', '', 'all')" );
$db->sql_query( "INSERT INTO " . $prefix . "_blocks VALUES ( '20', '0', 'Famous saying', '', 'c', '1', '1', '0', '1246782623', 'english', 'block-Danhngon_ty_cs.php', '0', '0', 'd', '', 'all')" );

$db->sql_query( "DROP TABLE IF EXISTS " . $prefix . "_files" );
$db->sql_query( "CREATE TABLE " . $prefix . "_files (
   lid int(11) NOT NULL auto_increment,
   cid int(11) DEFAULT '0' NOT NULL,
   title varchar(100) NOT NULL,
   description text NOT NULL,
   url varchar(500) NOT NULL,
   date datetime,
   filesize int(11) DEFAULT '0' NOT NULL,
   version varchar(10) NOT NULL,
   name varchar(100) NOT NULL,
   email varchar(100) NOT NULL,
   homepage varchar(200) NOT NULL,
   ip_sender varchar(60),
   votes int(11) DEFAULT '0' NOT NULL,
   totalvotes int(11) DEFAULT '0' NOT NULL,
   totalcomments int(11) DEFAULT '0' NOT NULL,
   hits int(11) DEFAULT '0' NOT NULL,
   status int(1) DEFAULT '0' NOT NULL,
   PRIMARY KEY (lid),
   KEY lid (lid),
   KEY cid (cid),
   KEY title (title)
);" );

$db->sql_query( "DROP TABLE IF EXISTS " . $prefix . "_files_categories" );
$db->sql_query( "CREATE TABLE " . $prefix . "_files_categories (
   cid int(11) NOT NULL auto_increment,
   title varchar(50) NOT NULL,
   cdescription text NOT NULL,
   parentid int(11) DEFAULT '0' NOT NULL,
   PRIMARY KEY (cid),
   KEY cid (cid),
   KEY title (title)
);" );

$db->sql_query( "DROP TABLE IF EXISTS " . $prefix . "_files_comments" );
$db->sql_query( "CREATE TABLE " . $prefix . "_files_comments (
   tid int(11) NOT NULL auto_increment,
   lid int(11) DEFAULT '0' NOT NULL,
   date datetime,
   name varchar(60) NOT NULL,
   email varchar(60),
   url varchar(60),
   host_name varchar(60),
   subject varchar(255) NOT NULL,
   comment text NOT NULL,
   PRIMARY KEY (tid),
   KEY tid (tid),
   KEY lid (lid)
);" );

$db->sql_query( "DROP TABLE IF EXISTS " . $prefix . "_files_poolchec" );
$db->sql_query( "CREATE TABLE " . $prefix . "_files_poolchec (
   lid int(11) NOT NULL,
   time varchar(14) NOT NULL,
   host_addr varchar(48) NOT NULL,
   KEY time (time)
);" );

$db->sql_query( "DROP TABLE IF EXISTS " . $prefix . "_headlines" );
$db->sql_query( "CREATE TABLE " . $prefix . "_headlines (
  hid int(11) NOT NULL auto_increment,
  sitename varchar(30) NOT NULL default '',
  headlinesurl varchar(200) NOT NULL default '',
  PRIMARY KEY  (hid),
  KEY hid (hid)
)" );

$db->sql_query( "INSERT INTO " . $prefix . "_headlines VALUES (1, 'PHP-Nuke', 'http://phpnuke.org/backend.php')" );
$db->sql_query( "INSERT INTO " . $prefix . "_headlines VALUES (2, 'NukeCops', 'http://www.nukecops.com/backend.php')" );
$db->sql_query( "INSERT INTO " . $prefix . "_headlines VALUES (3, 'NukeViet', 'http://nukeviet.vn/phpbb/rss.php')" );

$db->sql_query( "DROP TABLE IF EXISTS " . $prefix . "_message" );
$db->sql_query( "CREATE TABLE " . $prefix . "_message (
  mid int(11) NOT NULL auto_increment,
  title varchar(100) NOT NULL default '',
  content text NOT NULL,
  date varchar(14) NOT NULL default '',
  expire int(7) NOT NULL default '0',
  active int(1) NOT NULL default '1',
  view int(1) NOT NULL default '1',
  mlanguage varchar(30) NOT NULL default '',
  PRIMARY KEY  (mid),
  UNIQUE KEY mid (mid)
)" );

$db->sql_query( "INSERT INTO " . $prefix . "_message VALUES (1, 'Bạn đang sử dụng hệ thống xây dựng website NUKEVIET!', '<center><br>Xin chúc mừng, việc cài đặt hệ thống <b><font color=blue>NUKEVIET</font></b> đã hoàn tất!\r\n<br>Hệ thống này có chức năng giúp bạn xây dựng webportal dựa trên nền tảng PHP-Nuke.<br>Bạn sẽ luôn tìm thấy sự giúp đỡ trong việc cài đặt, sử dụng cũng như những modules, blocks, giao diện mới cho NUKEVIET tại <a href=http://nukeviet.vn>website nukeviet.vn</a>.</center>', '$time', 0, 1, 1, 'vietnamese')" );
$db->sql_query( "INSERT INTO " . $prefix . "_message VALUES (2, 'NukeViet installation successful!', '<center>You are using NukeViet web-portal version 2.0. The installation is completed.<br />Thanks for choice <a href=http://nukeviet.vn>NukeViet</a>!</center>', '$time', 0, 1, 1, 'english')" );

$db->sql_query( "DROP TABLE IF EXISTS " . $prefix . "_modules" );
$db->sql_query( "CREATE TABLE " . $prefix . "_modules (
  mid int(10) NOT NULL auto_increment,
  title varchar(255) NOT NULL default '',
  custom_title varchar(255) NOT NULL default '',
  active int(1) NOT NULL default '0',
  view int(1) NOT NULL default '0',
  bltype TINYINT(1) DEFAULT '1' NOT NULL,
  inmenu tinyint(1) NOT NULL default '1',
  theme varchar(100) NOT NULL default '',
  admins varchar(255) NOT NULL default '',
  PRIMARY KEY  (mid),
  KEY mid (mid),
  KEY title (title),
  KEY custom_title (custom_title)
)" );

$db->sql_query( "INSERT INTO " . $prefix . "_modules VALUES ( '1', 'News', 'Tin tức', '1', '0', '1', '4', '', '')" );
$db->sql_query( "INSERT INTO " . $prefix . "_modules VALUES ( '2', 'Contact', 'Liên hệ', '1', '0', '1', '4', '', '')" );
$db->sql_query( "INSERT INTO " . $prefix . "_modules VALUES ( '3', 'Search', 'Tìm kiếm', '1', '0', '4', '4', '', '')" );
$db->sql_query( "INSERT INTO " . $prefix . "_modules VALUES ( '4', 'Voting', 'Thăm dò dư luận', '1', '0', '1', '4', '', '')" );
$db->sql_query( "INSERT INTO " . $prefix . "_modules VALUES ( '5', 'Your_Account', 'Thông tin thành viên', '1', '0', '3', '1', '', '')" );
$db->sql_query( "INSERT INTO " . $prefix . "_modules VALUES ( '6', 'Newsletter', 'Tin tức qua email', '1', '0', '4', '1', '', '')" );
$db->sql_query( "INSERT INTO " . $prefix . "_modules VALUES ( '7', 'Files', 'Tải Files', '1', '0', '1', '4', '', '')" );
$db->sql_query( "INSERT INTO " . $prefix . "_modules VALUES ( '8', 'AutoTranslate', 'Dịch tự động', '1', '0', '1', '1', '', '')" );
$db->sql_query( "INSERT INTO " . $prefix . "_modules VALUES ( '9', 'Sitemap', 'Sơ đồ site', '1', '0', '4', '3', '', '')" );
$db->sql_query( "INSERT INTO " . $prefix . "_modules VALUES ( '10', 'Weblinks', 'Weblinks', '1', '0', '1', '1', '', '')" );
$db->sql_query( "INSERT INTO " . $prefix . "_modules VALUES ( '11', 'Addnews', 'Gửi bài', '1', '0', '1', '2', '', '')" );
$db->sql_query( "INSERT INTO " . $prefix . "_modules VALUES ( '12', 'Rss', 'Rss', '1', '0', '1', '0', '', '')" );
$db->sql_query( "INSERT INTO " . $prefix . "_modules VALUES ( '13', 'Support', 'Support', '1', '0', '1', '1', '', '')" );

$db->sql_query( "DROP TABLE IF EXISTS " . $prefix . "_newsletter" );
$db->sql_query( "CREATE TABLE " . $prefix . "_newsletter (
   id int(11) NOT NULL auto_increment,
   email varchar(100) NOT NULL,
   status int(11) DEFAULT '0' NOT NULL,
   html int(11) DEFAULT '0' NOT NULL,
   checkkey int(11) DEFAULT '0' NOT NULL,
   time varchar(14) NOT NULL default '',
   newsletterid varchar(255) NOT NULL default '',
   PRIMARY KEY (id)
)" );

$db->sql_query( "DROP TABLE IF EXISTS " . $prefix . "_newsletter_send" );
$db->sql_query( "CREATE TABLE " . $prefix . "_newsletter_send (
  id int(11) NOT NULL auto_increment,
  subject varchar(255) default NULL,
  text text,
  html text,
  send datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY (id),
  KEY id(id)
)" );

$db->sql_query( "DROP TABLE IF EXISTS " . $prefix . "_nvvoting_comments" );
$db->sql_query( "CREATE TABLE " . $prefix . "_nvvoting_comments (
  tid int(11) NOT NULL auto_increment,
  pollid int(11) NOT NULL default '0',
  date datetime default NULL,
  name varchar(60) NOT NULL default '',
  email varchar(60) default NULL,
  url varchar(60) default NULL,
  host_name varchar(60) default NULL,
  subject varchar(60) NOT NULL default '',
  comment text NOT NULL,
  PRIMARY KEY  (tid),
  KEY tid (tid),
  KEY pollID (pollid)
)" );

$db->sql_query( "DROP TABLE IF EXISTS " . $prefix . "_nvvoting_votes" );
$db->sql_query( "CREATE TABLE " . $prefix . "_nvvoting_votes (
  ip varchar(20) NOT NULL default '',
  vottime varchar(14) NOT NULL default '',
  pollid int(10) NOT NULL default '0'
)" );

$db->sql_query( "DROP TABLE IF EXISTS " . $prefix . "_nvvotings" );
$db->sql_query( "CREATE TABLE " . $prefix . "_nvvotings (
  pollid smallint(5) unsigned NOT NULL auto_increment,
  question varchar(255) NOT NULL default '',
  votes text NOT NULL,
  optiontext text NOT NULL,
  options tinyint(3) unsigned NOT NULL default '0',
  acomm int(1) NOT NULL default '0',
  totalvotes int(11) NOT NULL default '0',
  totalcomm int(11) NOT NULL default '0',
  time int(10) NOT NULL default '0',
  planguage varchar(30) NOT NULL default '',
  ttbc tinyint(2) DEFAULT '1' NOT NULL,
  PRIMARY KEY  (pollid)
)" );

$db->sql_query( "INSERT INTO " . $prefix . "_nvvotings VALUES ( '1', 'Đánh giá của bạn về Website này?', '0|0|0|0|0', 'Tuyệt vời|Tốt|Trung bình|Không có gì để nói|Rất tồi', '5', '2', '0', '0', '$time', 'vietnamese', '1')" );
$db->sql_query( "INSERT INTO " . $prefix . "_nvvotings VALUES ( '2', 'Bạn đến từ khu vực nào?', '0|0|0|0|0', 'Hà Nội|Huế|Quy Nhơn|TP Hồ Chí Minh|Một khu vực khác', '5', '2', '0', '0', '$time', 'vietnamese', '1')" );
$db->sql_query( "INSERT INTO " . $prefix . "_nvvotings VALUES ( '3', 'How are you feeling about Website?', '0|0|0|0|0', 'Excellent|Good|Normal|Bad|Very bad', '5', '2', '0', '0', '$time', 'english', '1')" );
$db->sql_query( "INSERT INTO " . $prefix . "_nvvotings VALUES ( '4', 'Where are you from?', '0|0|0|0|0', 'Euro|Asian|America|Australia|Africa', '5', '2', '0', '0', '$time', 'english', '1')" );

$db->sql_query( "DROP TABLE IF EXISTS " . $prefix . "_stats" );
$db->sql_query( "CREATE TABLE " . $prefix . "_stats (
  online text NOT NULL,
  clients text NOT NULL,
  hits bigint(20) NOT NULL default '0'
)" );

$db->sql_query( "INSERT INTO " . $prefix . "_stats VALUES ('', '', 0)" );

$db->sql_query( "DROP TABLE IF EXISTS " . $prefix . "_stories" );
$db->sql_query( "CREATE TABLE " . $prefix . "_stories (
  sid int(11) NOT NULL auto_increment,
  catid int(11) NOT NULL default '0',
  aid varchar(30) NOT NULL default '',
  title varchar(255) default NULL,
  time datetime default NULL,
  hometext text,
  bodytext text NOT NULL,
  images varchar(100) NOT NULL default '',
  comments int(11) default '0',
  counter mediumint(8) unsigned default NULL,
  notes text NOT NULL,
  ihome int(1) NOT NULL default '1',
  alanguage varchar(30) NOT NULL default '',
  acomm int(1) NOT NULL default '0',
  imgtext varchar(150) default NULL,
  source varchar(60) NOT NULL default '',
  topicid int(11) NOT NULL default '0',
  newsst int(1) NOT NULL default '0',
  PRIMARY KEY  (sid),
  KEY sid (sid),
  KEY catid (catid),
  KEY topicid (topicid)
)" );

$db->sql_query( "INSERT INTO " . $user_prefix . "_stories VALUES ( '1', '1', '', 'Ra mắt công ty mã nguồn mở đầu tiên tại Việt Nam', '2010-03-01 00:00:01', 'Mã nguồn mở NukeViet vốn đã quá quen thuộc với cộng đồng CNTT Việt Nam trong mấy năm qua. Tuy chưa hoạt động chính thức, nhưng chỉ trong khoảng 5 năm gần đây, mã nguồn mở NukeViet đã được dùng phổ biến ở Việt Nam, áp dụng ở hầu hết các lĩnh vực, từ tin tức đến thương mại điện tử, từ các website cá nhân cho tới những hệ thống website doanh nghiệp.', 'Để chuyên nghiệp hóa việc phát hành mã nguồn mở NukeViet, Ban quản trị 
NukeViet quyết định thành lập doanh nghiệp chuyên quản NukeViet mang tên
 <span style=\"font-weight: bold;\">Công ty cổ phần Phát triển nguồn mở Việt Nam</span> (Viết tắt là 
VINADES.,JSC), chính thức ra 
mắt vào 
ngày 25-2-2010 (trụ sở tại 67B/35 Khương Hạ, Khương Đình, Thanh Xuân, Hà
 Nội) nhằm phát triển, phổ biến hệ thống NukeViet tại Việt Nam.<br /><br />Theo 
ông Nguyễn Anh Tú, Chủ tịch HĐQT VINADES, công ty sẽ phát triển bộ mã 
nguồn NukeViet nhất quán theo con đường mã nguồn mở đã chọn, chuyên 
nghiệp và quy mô 
hơn bao giờ hết. Đặc biệt là hoàn toàn miễn phí đúng tinh thần mã nguồn 
mở quốc tế. <br /><br />NukeViet là một hệ quản trị nội dung mã nguồn
 mở (Opensource Content Management 
System) thuần Việt từ nền tảng PHP-Nuke và cơ sở dữ liệu MySQL. Người sử
 dụng thường gọi NukeViet là portal vì nó có khả năng tích hợp nhiều ứng
 dụng
 trên nền web, cho phép người sử dụng có thể dễ dàng xuất bản và quản 
trị các nội dung của họ lên internet hoặc intranet. <br /><br />NukeViet cung cấp 
nhiều dịch vụ và ứng dụng nhờ khả năng tăng cường tính năng thêm các 
module, block... tạo sự dễ dàng cài đặt, quản lý, ngay cả với những 
người mới tiếp cận với website. Người dùng có thể tìm hiểu thêm thông 
tin và tải về sản phẩm tại địa chỉ <a target=\"_blank\" href=\"http://nukeviet.vn/\">http://nukeviet.vn</a><br />', '', '0', '3', '', '1', 'vietnamese', '0', '', 'Quỳnh Nhi &#x002F; Hanoimoi.com.vn', '0', '0')" );
$db->sql_query( "INSERT INTO " . $user_prefix . "_stories VALUES ( '2', '2', 'Nguyễn Thế Hùng', 'Giới thiệu về mã nguồn mở NukeViet', '2010-03-01 00:00:01', 'Chắc hẳn đây không phải lần đầu tiên bạn nghe nói đến mã nguồn mở. Và nếu bạn là người mê lướt web thì hẳn bạn từng nhìn thấy đâu đó cái tên NukeViet. NukeViet, phát âm là Nu-Ke-Việt, chính là phần mềm dùng để xây dựng các Website mà bạn ngày ngày online để truy cập đấy.', '<h3>THÔNG
TIN VỀ MÃ NGUỒN MỞ NUKEVIET </h3> 
<p style=\"font-weight: bold;\">I. Giới thiệu chung:</p> 
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; NukeViet
là một hệ quản trị nội dung mã
nguồn mở (Opensource Content Management System), người sử dụng thường 
gọi NukeViet là portal vì nó có khả năng tích hợp nhiều ứng dụng trên 
nền Web. NukeViet được Nguyễn Anh Tú
- một lưu
học sinh người Việt tại Nga - cùng cộng đồng phát
triển thành một ứng dụng thuần Việt từ nền tảng
PHP-Nuke. NukeViet được viết bằng ngôn ngữ PHP và
chủ yếu sử dụng cơ sở dữ liệu MySQL,
cho phép người sử dụng có thể dễ dàng xuất bản &amp;
quản trị các nội dung của họ lên
Internet hoặc Intranet.</p> 
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; NukeViet được sử dụng ở nhiều website, từ những
website cá nhân cho tới những hệ thống website doanh nghiệp, nó cung cấp
 nhiều dịch vụ và ứng dụng nhờ khả năng
tăng cường tính năng
bằng cách cài thêm các
module, block... NukeViet có thể dễ dàng cài đặt, dễ dàng quản lý kể cả 
với những người mới sử dụng.</p> 
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Thông tin chi tiết về NukeViet có thể
tìm thấy ở bách khoa toàn thư mở Wikipedia: <a href=\"http://vi.wikipedia.org/wiki/NukeViet\">http://vi.wikipedia.org/wiki/NukeViet</a></p> 
<p style=\"font-weight: bold;\">II. Thông tin về diễn đàn NukeViet:</p> 
<p>Diễn đàn
NukeViet hoạt động trên website: <a href=\"http://nukeviet.vn/\"><b>http://nukeviet.vn</b></a> hiện có trên 9.500 thành viên thực gồm học sinh, sinh viên &amp; nhiều 
thành
phần khác thuộc giới trí thức ở trong và ngoài nước.</p> 
<p>Là một
diễn đàn của các nhà quản lý website, rất nhiều thành viên trong diễn 
đàn
NukeViet là cán bộ, lãnh đạo từ đủ mọi lĩnh vực: công nghệ thông tin, 
xây dựng,
văn hóa - xã hội, thể thao, dịch vụ - du lịch... từ cử nhân, bác sĩ, kỹ 
sư cho
đến bộ đội, công an...</p> 
<p>Nhiều học
sinh, sinh viên tham gia diễn đàn NukeViet, đam mê mã nguồn mở và đã 
thành công
với chính công việc mà họ yêu thích.</p> 
<p style=\"font-weight: bold;\">III. Ban Quản Trị NukeViet:</p> 
<p style=\"font-weight: bold;\">1. Lập trình viên 
chính &amp; là người
sáng lập NukeViet:</p> 
<ul> 
  <li>Họ và tên: Nguyễn Anh Tú</li> 
  <li>Nick Name: AnhTu</li> 
  <li>Thông tin chung: Nguyên du học sinh người Việt tại Liên
bang Nga, nguyên chánh văn phòng hội người Việt tại Liên bang Nga. Hiện 
đang
sống và làm việc tại Mát-xcơ-va, Liên bang Nga.</li> 
</ul> 
<p style=\"font-weight: bold;\">2. Các quản trị viên</p> 
<p>* Nguyễn Thế Hùng</p> 
<ul> 
  <li>Nick Name: laser</li> 
  <li>Thông tin chung: Quản trị viên phụ trách chung. Hiện 
đang
sống và làm việc tại Hải Phòng.</li> 
</ul> 
<p>* Bùi Diệp Linh</p> 
<ul> 
  <li>Nick Name: convoi</li> 
  <li>Thông tin chung: Quản trị viên phụ trách khu vực phía 
Nam. Hiện đang sống và làm việc tại Vũng Tàu.</li> 
</ul> 
<p>Ngoài 3
quản trị viên trên còn có một số quản trị viên khác và hơn 20 điều hành 
viên
phụ trách điều phối &amp; hỗ trợ diễn đàn.</p> 
<p style=\"font-weight: bold;\">IV. Các bài báo nói về NukeViet:</p> 
<ul> 
  <li>NukeViet
và 4 cú nhấp chuột: Báo Sài Gòn tiếp thị &amp; Dân trí điện tử đăng ngày
 18/05/2006</li> 
  <li>Nukeviet
và câu chuyện của 3 chàng \"ngự lâm\": Tạp chí Thế Giới Vi Tính - PC World
 VN
ngày 11/5/2006</li> 
  <li>E-book
hướng dẫn sử dụng NukeViet: Tạp chí Echip số 125 ra ngày 18-1-2008</li> 
  <li>Dùng nguồn mở không công khai: Vấn nạn phần
mềm Việt?: Báo điện tử VietNamNet ngày 25/11/2006</li>
</ul><br />', '', '0', '1', '', '1', 'vietnamese', '0', '', 'nukeviet.vn', '0', '0')" );
$db->sql_query( "INSERT INTO " . $user_prefix . "_stories VALUES ( '3', '3', '', 'First open-source company starts operation', '2010-03-01 00:00:01', 'The Vietnam Open Source Development Joint Stock Company (VINADES., JSC), the first firm operating in the field of open source in the country, made its debut on February 25.', '
<p>The Hanoi-based company will
 further develop and popularise an open source content management system
 best known as NukeViet in the country. </p>
<p>VINADES Chairman Nguyen Anh Tu said NukeViet is totally free and 
users can download the product at www.nukeviet.vn. </p>
<p>NukeViet has been widely used across the country over the past five 
years. The system, built on PHP-Nuke and MySQL database, enables users 
to easily post and manage files on the Internet or Intranet.</p>', '', '0', '0', '', '1', 'english', '0', '', 'VOVNews&#x002F;VNA', '0', '0')" );


$db->sql_query( "DROP TABLE IF EXISTS " . $prefix . "_stories_auto" );
$db->sql_query( "CREATE TABLE " . $prefix . "_stories_auto (
  anid int(11) NOT NULL auto_increment,
  catid int(11) NOT NULL default '0',
  aid varchar(30) NOT NULL default '',
  title varchar(255) NOT NULL default '',
  time varchar(19) NOT NULL default '',
  hometext text NOT NULL,
  bodytext text NOT NULL,
  images varchar(100) NOT NULL default '',
  notes text NOT NULL,
  ihome int(1) NOT NULL default '0',
  alanguage varchar(30) NOT NULL default '',
  acomm int(1) NOT NULL default '0',
  imgtext varchar(150) default NULL,
  source varchar(60) NOT NULL default '',
  topicid int(11) NOT NULL default '0',
  PRIMARY KEY  (anid),
  KEY anid (anid)
)" );

$db->sql_query( "DROP TABLE IF EXISTS " . $prefix . "_stories_temp" );
$db->sql_query( "CREATE TABLE " . $prefix . "_stories_temp (
  sid int(11) NOT NULL auto_increment,
  catid int(11) NOT NULL default '0',
  aid varchar(30) NOT NULL default '',
  title varchar(255) default NULL,
  time datetime default NULL,
  hometext text,
  bodytext text NOT NULL,
  images varchar(100) default NULL,
  alanguage varchar(30) NOT NULL default '',
  sender_ip varchar(20) NOT NULL default '',
  imgtext varchar(150) default NULL,
  source varchar(60) NOT NULL default '',
  topicid int(11) NOT NULL default '0',
  notes text NOT NULL,
  PRIMARY KEY  (sid),
  KEY sid (sid)
)" );

$db->sql_query( "DROP TABLE IF EXISTS " . $prefix . "_stories_cat" );
$db->sql_query( "CREATE TABLE " . $prefix . "_stories_cat (
  catid int(11) NOT NULL auto_increment,
  parentid int(11) DEFAULT '0' NOT NULL,
  title varchar(255) NOT NULL default '',
  weight int(10) NOT NULL default '1',
  catimage varchar(20) default NULL,
  ihome int(1) NOT NULL default '0',
  storieshome int(11) NOT NULL default '0',
  linkshome int(11) NOT NULL default '3',
  PRIMARY KEY  (catid),
  KEY catid (catid)
)" );

$db->sql_query( "INSERT INTO " . $user_prefix . "_stories_cat VALUES ( '1', '0', 'Tin tức', '1', 'bieudo.gif', '1', '0', '3')" );
$db->sql_query( "INSERT INTO " . $user_prefix . "_stories_cat VALUES ( '2', '0', 'Bài viết', '2', 'but.gif', '1', '0', '3')" );
$db->sql_query( "INSERT INTO " . $user_prefix . "_stories_cat VALUES ( '3', '0', 'News', '3', 'bieudo.gif', '1', '0', '3')" );

$db->sql_query( "DROP TABLE IF EXISTS " . $prefix . "_stories_topic" );
$db->sql_query( "CREATE TABLE " . $prefix . "_stories_topic (
   topicid int(11) NOT NULL auto_increment,
   topictitle varchar(255) NOT NULL,
   PRIMARY KEY (topicid),
   KEY topicid (topicid)
)" );

$db->sql_query( "DROP TABLE IF EXISTS " . $prefix . "_stories_images" );
$db->sql_query( "CREATE TABLE " . $prefix . "_stories_images (
  imgid int(11) NOT NULL auto_increment,
  imgtitle varchar(255) NOT NULL default '',
  imgtext text NOT NULL,
  imglink varchar(255) NOT NULL default '',
  sid int(11) NOT NULL default '0',
  catid int(11) NOT NULL default '0',
  ihome int(1) NOT NULL default '0',
  ilanguage varchar(30) NOT NULL default '',
  PRIMARY KEY  (imgid),
  KEY imgid (imgid)
)" );

$db->sql_query( "DROP TABLE IF EXISTS " . $prefix . "_stories_comments" );
$db->sql_query( "CREATE TABLE " . $prefix . "_stories_comments (
  tid int(11) NOT NULL auto_increment,
  sid int(11) NOT NULL default '0',
  date datetime default NULL,
  name varchar(60) NOT NULL default '',
  email varchar(60) default NULL,
  url varchar(60) default NULL,
  host_name varchar(60) default NULL,
  subject varchar(255) NOT NULL default '',
  comment text NOT NULL,
  online tinyint(2) DEFAULT '0' NOT NULL,
  PRIMARY KEY  (tid),
  KEY tid (tid),
  KEY sid (sid)
)" );

$db->sql_query( "DROP TABLE IF EXISTS " . $user_prefix . "_users" );
$db->sql_query( "CREATE TABLE `" . $user_prefix . "_users` (
  `user_id` int(11) NOT NULL auto_increment,
  `username` varchar(60) NOT NULL,
  `user_password` varchar(40) NOT NULL,
  `user_regdate` int(11) NOT NULL default '0',
  `user_viewemail` tinyint(2) default NULL,
  `user_avatar` varchar(255) NOT NULL default 'gallery/blank.gif',
  `user_avatar_type` tinyint(4) NOT NULL default '3',
  `user_email` varchar(255) NOT NULL default '',
  `user_icq` varchar(15) default NULL,
  `user_website` varchar(255) NOT NULL default '',
  `user_from` varchar(100) default NULL,
  `user_sig` text,
  `user_yim` varchar(25) default NULL,
  `user_interests` varchar(255) NOT NULL default '',
  `user_telephone` varchar(60) NOT NULL default '',
  `name` varchar(60) NOT NULL default '',
  `lastname` varchar(60) NOT NULL default '',
  `viewuname` varchar(100) NOT NULL default '',
  `opros` text,
  `remember` int(1) NOT NULL default '0',
  PRIMARY KEY  (`user_id`)
)" );

$db->sql_query( "INSERT INTO " . $user_prefix . "_users VALUES (NULL, 'Anonymous', '', " . $time . ", NULL, '', 0, '', NULL, '', NULL, NULL, NULL, '', '', '', '', '', '', 0)" );
$db->sql_query( "INSERT INTO " . $user_prefix . "_users VALUES (NULL, '".$username."', '" . md5($userpassword) . "', " . $time . ", 1, 'gallery/091.gif', 3, '" . $usermail . "', NULL, '".$nukeurl."', NULL, NULL, NULL, '', '', '', '".$username."', '', 'Tên của bạn|bravo', 0)" );

$db->sql_query( "DROP TABLE IF EXISTS " . $user_prefix . "_users_temp" );
$db->sql_query( "CREATE TABLE " . $user_prefix . "_users_temp (
  user_id int(10) NOT NULL auto_increment,
  username varchar(60) NOT NULL default '',
  viewuname varchar(100) NOT NULL default '',
  user_email varchar(255) NOT NULL default '',
  user_password varchar(40) NOT NULL default '',
  opros text NOT NULL,
  check_num varchar(50) NOT NULL default '',
  time varchar(14) NOT NULL default '',
  PRIMARY KEY  (user_id)
)" );

$db->sql_query( "DROP TABLE IF EXISTS " . $prefix . "_contact" );
$db->sql_query( "CREATE TABLE " . $prefix . "_contact (
   pid int(3) NOT NULL auto_increment,
   phone_name varchar(255),
   add_name varchar(255),
   phone_num varchar(60),
   fax_num varchar(60),
   email_name varchar(60),
   web_name varchar(60),
   note_name varchar(255),
   PRIMARY KEY (pid),
   KEY pid (pid)
)" );

$db->sql_query( "DROP TABLE IF EXISTS " . $prefix . "_contact_contact" );
$db->sql_query( "CREATE TABLE " . $prefix . "_contact_contact (
   pid int(3) NOT NULL auto_increment,
   name varchar(60),
   add_name varchar(255),
   phone_num varchar(30),
   email_name varchar(50),
   dip_name int(3),
   messenger text,
   reply int(3),
   time datetime,
   PRIMARY KEY (pid),
   KEY pid (pid)
)" );


$db->sql_query( "DROP TABLE IF EXISTS " . $prefix . "_contact_dept" );
$db->sql_query( "CREATE TABLE " . $prefix . "_contact_dept (
   did int(3) NOT NULL auto_increment,
   dept_name varchar(60),
   dept_email varchar(60),
   dept_contact int(3),
   PRIMARY KEY (did),
   KEY did (did)
)" );

$db->sql_query( "INSERT INTO " . $user_prefix . "_contact_dept VALUES ( '1', '$adminname', '$adminmail', '3')" );

$db->sql_query( "DROP TABLE IF EXISTS " . $prefix . "_weblinks_cats" );
$db->sql_query( "CREATE TABLE " . $prefix . "_weblinks_cats (
  id int(11) NOT NULL auto_increment,
  title varchar(100) NOT NULL default '',
  description varchar(255) NOT NULL default '',
  language varchar(30) NOT NULL default '',
  ihome int(1) NOT NULL default '0',
  PRIMARY KEY (id),
  KEY title (title)
);" );

$db->sql_query( "INSERT INTO " . $user_prefix . "_weblinks_cats VALUES ( '1', 'Links with Site', 'Các Website liên kết.', 'vietnamese', '1')" );

$db->sql_query( "DROP TABLE IF EXISTS " . $prefix . "_weblinks_links" );
$db->sql_query( "CREATE TABLE " . $prefix . "_weblinks_links (
  id int(11) NOT NULL auto_increment,
  cid int(11) NOT NULL default '0',
  title varchar(255) NOT NULL default '',
  url varchar(255) NOT NULL default '',
  urlimg varchar(255) NOT NULL default '',
  description varchar(255) NOT NULL default '',
  addtime int(11) default NULL,
  hits int(11) NOT NULL default '0',
  active int(1) NOT NULL default '0',
  PRIMARY KEY (id),
  KEY title (title)
);" );

$db->sql_query( "INSERT INTO " . $user_prefix . "_weblinks_links VALUES ( '1', '1', 'Mã nguồn mở NukeViet', 'http://nukeviet.vn', 'http://nukeviet.ws/img/nukeviet.png', 'Website chính thức hỗ trợ sử dụng mã nguồn mở tạo web NukeViet.', '$time', '1', '1')" );
$db->sql_query( "INSERT INTO " . $user_prefix . "_weblinks_links VALUES ( '2', '1', 'VINADES.,JSC', 'http://vinades.vn', 'http://vinades.vn/logo120x60.png', 'Công ty cổ phần Phát triển nguồn mở Việt Nam', '$time', '1', '1')" );


$db->sql_query( "DROP TABLE IF EXISTS " . $prefix . "_nvsupport_cat" );
$db->sql_query( "CREATE TABLE " . $prefix . "_nvsupport_cat (
   `id` int(11) NOT NULL auto_increment,
   `subid` int(11) NOT NULL default '0',
   `language` varchar(30) NOT NULL,
   `title` varchar(255) NOT NULL  default '',
   `active` int(1) NOT NULL default '0',
   `weight` int(10) DEFAULT '0' NOT NULL,
   PRIMARY KEY (`id`),
   KEY `subid` (`subid`),
   KEY `title` (`title`)
)" );

$db->sql_query( "INSERT INTO " . $user_prefix . "_nvsupport_cat VALUES ( '1', '0', 'vietnamese', 'Sử dụng Website', '1', '1')" );


$db->sql_query( "DROP TABLE IF EXISTS " . $prefix . "_nvsupport_all" );
$db->sql_query( "CREATE TABLE " . $prefix . "_nvsupport_all (
   `id` int(11) NOT NULL auto_increment,
   `catid` int(11) NOT NULL default '0',
   `language` varchar(30) NOT NULL,
   `question` varchar(255) NOT NULL,
   `answer` text NOT NULL,
   `view` int(10) DEFAULT '0' NOT NULL,
   `publtime` int(11) DEFAULT '0' NOT NULL,
   PRIMARY KEY (`id`),
   KEY `catid` (`catid`),
   KEY `question` (`question`),
   KEY `publtime` (`publtime`)
)" );


$db->sql_query( "INSERT INTO " . $user_prefix . "_nvsupport_all VALUES ( '1', '1', 'vietnamese', 'Làm thế nào gõ tiếng Việt trên Website này?', 'Diễn đàn đã tích hợp bộ gõ AVIM - bộ gõ tiếng Việt trên Web nên bạnhoàn toàn có thể gõ tiếng Việt có dấu một cách dễ dàng (nếu truy cập bằng các trình duyệt mà AVIM hỗ trợ như: Opera 9, FireFox 1.5,2 ,Internet Explorer 5,6,7) mà không cần bất cứ công cụ nào khác.Bộ gõ đã được cấu hình để có thể tương thích với tất cả các kiểu gõ hiện nay, vì vậy nếu bạn đã từng soạn thảo một tài liệu tiếng Việt, hãy gõ như bạn đã từng gõ! Nếu bạn chưa biết các gõ tiếng Việt có dấu, xin hãy xem Cách gõ tiếng Việt có dấu và Các kiểu gõ tiếng Việt có dấu! Hãy viết tiếng Việt có dấu trong trường hợp có thể.', '0', '$time')" );
$db->sql_query( "INSERT INTO " . $user_prefix . "_nvsupport_all VALUES ( '2', '1', 'vietnamese', 'Làm thế nào để lấy lại mật khẩu của mình?', 'Nếu bạn lỡ quên mật khẩu vào Website thì cũng đừng lo lắng! Tuy mật khẩu của bạn không thể phục hồi lại được nhưng cóthể được tạo lại dễ dàng. Trong trang đăng nhập, bạn hãy bấm vào liên kết <em>Quên mật khẩu</em>. Hãy làm theo hướng dẫn của công cụ này và bạn sẽ có thể đăng nhập trở lại vào hệ thống một cách nhanh chóng.', '0', '$time')" );
$db->sql_query( "INSERT INTO " . $user_prefix . "_nvsupport_all VALUES ( '3', '1', 'vietnamese', 'Tại sao tôi không thể đăng nhập được?', 'Có thể có một vài nguyên nhân dẫn đến việc này. Trước tiên, hãy chắc chắn rằng tên thành viên và mật khẩu của bạn đã nhập vào chính xác. Kiểm tra xem có phải do phím CapsLock đang bật không? Có phải do bộ gõ tiếng Việt đang bỏ dấu không? Nếu vậy hãy tắt nó đi trước khi gõ mật khẩu.<br /><br />Nếu bạn đã nhập chính xác mà vẫn không thể đăng nhập được, hãy liên hệ với người quản trị để chắc chắn rằng bạn không bị cấm tham gia. Cũng có thể,người quản lý website đã cấu hình sai hệ thống ở một chỗ nào đó và họcần bạn thông báo để biết mà tiến hành khắc phục.', '0', '$time')" );
$db->sql_query( "INSERT INTO " . $user_prefix . "_nvsupport_all VALUES ( '4', '1', 'vietnamese', 'Tại sao tôi cần phải đăng ký làm thành viên?', 'Bạn có thể không cần phải làm như thế nhưng đôi khi bạn cần phải đăng ký mới có thể truy cập các khu vực dành cho thành viên, tuỳ theo yêu cầu của người quản trị. Tuy nhiên, việc đăng ký làm thành viên sẽ giúp bạn sử dụng được hết tất cả các chức năng mà Website chỉ dành cho các thành viên đã đăng ký và không dành cho khách sử dụng, ví dụ như gửitin nhắn, gửi Email đến các thành viên khác, tham gia vào các nhóm… Bạn chỉ mất vài phút để hoàn tất việc đăng ký, vì vậy hãy đăng ký làm thành viên của chúng tôi.', '0', '$time')" );
$db->sql_query( "INSERT INTO " . $user_prefix . "_nvsupport_all VALUES ( '5', '1', 'vietnamese', 'Mã chống Spam là gì?', 'Đây là chuỗi ký tự ngẫu nhiên gồm 6 chữ số, Website bắt bạn nhập vào dãy ký tự này để hệ thống hiểu rằng đây là do con người nhập chứ không phải do các chương trình tự động hoặc Virut máy tính.<br />', '0', '$time')" );
$db->sql_query( "INSERT INTO " . $user_prefix . "_nvsupport_all VALUES ( '6', '1', 'vietnamese', 'Tôi có thể sử dụng mã HTML được không?', 'Để bảo vệ Website, chúng tôi không cho sử dụng HTML. Nếu bạn muốn gửi cho chúng tôi những bài viết có định dạng, vui lòng soạn trên Microsoft Word và gửi cho chúng tôi qua email.<br />', '0', '$time')" );
$db->sql_query( "INSERT INTO " . $user_prefix . "_nvsupport_all VALUES ( '7', '1', 'vietnamese', 'Website này xây dựng bằng mã nguồn nào?', 'Website này được viết bằng ngôn ngữ PHP, xây dựng trên nền tảng mã nguồn mở NukeViet. Vui lòng truy cập <a href=\"http://nukeviet.vn\" target=\"_blank\">nukeviet.vn</a> để biết thêm chi tiết.<br />', '1', '$time')" );
$db->sql_query( "INSERT INTO " . $user_prefix . "_nvsupport_all VALUES ( '8', '1', 'vietnamese', 'Cách sử dụng bộ gõ tiếng Việt trên Website?', '<h4>Hướng dẫn sử dụng bộ gõ tiếng việt tích hợp trên Web</h4><ul><li><p align=\"justify\"><b>Website đã tích hợp sẵn bộ gõ tiếng Việt AVIM</b>. Bạn có thể gõ tiếng việt có dấu mà không cần các chương trình hỗ trợ tiếng Việt khác như Vietkey hay Unikey (nên tắt Vietkey, Unikey đi để tránh xung đột).</p></li></ul><p align=\"justify\"><i><b><h4>Cách sử dụng:</h4></b></i></p><ul><li><p align=\"justify\">Mặc định, bộ gõ đã được bật với chế độ Tự động. Chế độ tự động là chế độ mà bạn có thể gõ tiếng Việt bằng bất kỳ kiểu gõ nào (Telex, VNI, VIQR ...) đều được.</p></li><li><p align=\"justify\">Ấn phím F9 (ở hàng trên cùng của bàn phím) để đổi lần lượt các kiểu gõ (Telex, VNI, VIQR) cho phù hợp với bạn. Nếu không rõ mình thường gõ tiếng Việt theo kiểu gõ nào, bạn hãy chọn chế độ Tự động. Để biết thêm về cách gõ chữ Việt, xin xem thêm <a href=\"http://mangvn.org/nukeviet/modules.php?name=Dictionary&file=gotiengviet\">tại đây</a>.</p></li><li><p align=\"justify\">Ấn phím F8 để tắt/bật chế độ kiểm tra chính tả.</p></li><li><p align=\"justify\">Nhấp F7 để chọn chế độ bỏ dấu kiểu cũ (oà) hay mới (òa). </p></li><li><p align=\"justify\">Nhấp F12 để bật tắt chế độ bỏ dấu tiếng Việt.</p></li></ul><p align=\"justify\"><i><b><h4>Chú ý:</h4></b></i></p><ul><li><p align=\"justify\">Tắt Vietkey, Unikey trên máy tính của bạn nếu bạn muốn sử dụng bộ gõ có sẵn trên web để tránh bị lỗi khi gõ tiếng Việt.</p></li><li><p align=\"justify\">Nếu bạn muốn sử dụng Vietkey hoặc Unikey thì phải tắt bộ gõ AVIM trên web đi, lưu ý cấu hình Vietkey và Unikey với bảng mã là Unicode.</p></li><li><p align=\"justify\">Bạn có thể thấy thông tin về bộ gõ sẽ thể hiện trên thanh trạng thái (Statusbar, nằm ở cuối cửa sổ) của trình duyệt Internet Explorer hay Opera (trong FireFox không nhìn thấy nhưng vẫn hoạt động bình thường) <br />&nbsp;</p></li></ul>', '1', '$time')" );
$db->sql_query( "INSERT INTO " . $user_prefix . "_nvsupport_all VALUES ( '9', '1', 'vietnamese', 'Có các kiểu gõ chữ Việt có thể sử dụng trên Website này?', '<ul><li><p align=\"justify\"><b>Các chữ cái đặc biệt của tiếng Việt</b> được gõ qua bàn phím bằng cách gõ chữ cái latin tương ứng rồi gõ liền đó một phím thứ hai (xem bảng dưới).&nbsp;<br /></p></li><li><p align=\"justify\"><b>Các từ có dấu thanh của tiếng Việt</b> được gõ qua bàn phím bằng cách gõ từ không dấu và liền đó gõ 1 phím nhất định khác (xem bảng dưới).</p></li></ul><table cellspacing=\"1\" cellpadding=\"2\" width=\"400\" border=\"0\" align=\"center\">  <tbody><tr>    <td align=\"center\"><b>Dấu &amp; nguyên âm</b></td>    <td align=\"center\"><b>Cách gõ Telex</b></td>    <td align=\"center\"><b>Cách gõ VNI</b></td>    <td align=\"center\"><b>Cách gõ VIQR</b></td>  </tr>  <tr bgcolor=\"#f0f0f0\">    <td align=\"center\">â</td>    <td align=\"center\">aa</td>    <td align=\"center\">a6</td>    <td align=\"center\">a^</td>  </tr>  <tr bgcolor=\"#f0f0f0\">    <td align=\"center\">ê</td>    <td align=\"center\">ee</td>    <td align=\"center\">e6</td>    <td align=\"center\">e^</td>  </tr>  <tr bgcolor=\"#f0f0f0\">    <td align=\"center\">ô</td>    <td align=\"center\">oo</td>    <td align=\"center\">o6</td>    <td align=\"center\">o^</td>  </tr>  <tr bgcolor=\"#f0f0f0\">    <td align=\"center\">ă</td>    <td align=\"center\">aw</td>    <td align=\"center\">a8</td>    <td align=\"center\">a(</td>  </tr>  <tr bgcolor=\"#f0f0f0\">    <td align=\"center\">ơ</td>    <td align=\"center\">ow</td>    <td align=\"center\">o7</td>    <td align=\"center\">o+</td>  </tr>  <tr bgcolor=\"#f0f0f0\">    <td align=\"center\">ư</td>    <td align=\"center\">uw</td>    <td align=\"center\">u7</td>    <td align=\"center\">u+</td>  </tr>  <tr bgcolor=\"#f0f0f0\">    <td align=\"center\">đ</td>    <td align=\"center\">dd</td>    <td align=\"center\">d9</td>    <td align=\"center\">dd</td>  </tr>  <tr bgcolor=\"#e0e0e0\">    <td align=\"center\">sắc</td>    <td align=\"center\">s</td>    <td align=\"center\">1</td>    <td align=\"center\">\'</td>  </tr>  <tr bgcolor=\"#e0e0e0\">    <td align=\"center\">huyền</td>    <td align=\"center\">f</td>    <td align=\"center\">2</td>    <td align=\"center\">`</td>  </tr>  <tr bgcolor=\"#e0e0e0\">    <td align=\"center\">nặng</td>    <td align=\"center\">j</td>    <td align=\"center\">5</td>    <td align=\"center\">.</td>  </tr>  <tr bgcolor=\"#e0e0e0\">    <td align=\"center\">hỏi</td>    <td align=\"center\">r</td>    <td align=\"center\">3</td>    <td align=\"center\">?</td>  </tr>  <tr bgcolor=\"#e0e0e0\">    <td align=\"center\">ngã</td>    <td align=\"center\">x</td>    <td align=\"center\">4</td>    <td align=\"center\">~</td>  </tr>  <tr bgcolor=\"#e0e0e0\">    <td align=\"center\">xoá dấu</td>    <td align=\"center\">z</td>    <td align=\"center\">0</td>    <td align=\"center\">-</td>  </tr>  <tr bgcolor=\"#d5d5d5\">    <td align=\"center\">Ví dụ: <br />Tiếng việt</td>    <td align=\"center\">Vis duj: <br />Tieengs Vieetj</td>    <td align=\"center\">Vi1 du5: <br />Tie6ng1 Vie6t5</td>    <td align=\"center\">Vi\' du.: <br />Tie^\'ng Vie^.t</td>  </tr></tbody></table>Chế độ tự động là chế độ mà bạn có thể gõ bằng bất kỳ cách nào đều được.<b><br />Lưu ý:</b><ul><li>Dấu của một từ có thể được gõ vào ngay sau nguyên âm mang dấu, nhưng để tránh điền dấu sai nên đánh sau từ, dấu sẽ được tự động đánh vào vị trí phù hợp.&nbsp;<br /></li><li>Trong trường hợp gõ nhầm dấu, có thể sửa lại bằng cách chuyển con trỏ tới cuối từ đó và gõ luôn vào phím dấu đúng mà không cần phải xoá cả từ đi gõ lại.&nbsp;<br /></li><li>Để gõ vào những chữ cái hoặc chữ số đã được dùng làm phím đánh dấu thì gõ phím đó liền 2 lần, ví dụ: aw tạo ă, nhưng aww tạo aw, hoặc aaa tạo aa...&nbsp;<br /></li><li>Để viết nhanh nên dùng cách gõ Telex, vì các phím dấu được chọn 1 cách khoa học, phù hợp với sự phân bố các dấu và các tổ hợp thường gặp.</li></ul>', '1', '$time')" );


$db->sql_query( "DROP TABLE IF EXISTS " . $prefix . "_nvsupport_user" );
$db->sql_query( "CREATE TABLE " . $prefix . "_nvsupport_user (
   `id` int(11) NOT NULL auto_increment,
   `catid` int(11) NOT NULL default '0',
   `status` tinyint(1) unsigned NOT NULL default '0',
   `view` tinyint(1) unsigned NOT NULL default '0',
   `language` varchar(30) NOT NULL,
   `title` varchar(255) NOT NULL,
   `question` text NOT NULL,
   `answer` text NOT NULL,
   `questiontime` int(11) DEFAULT '0' NOT NULL,
   `answertime` int(11) DEFAULT '0' NOT NULL,
   `sendername` varchar(100) NOT NULL default '',
  `senderemail` varchar(100) NOT NULL default '',
  `senderip` varchar(40) NOT NULL default '',
   PRIMARY KEY (`id`),
   KEY `catid` (`catid`),
   KEY `status` (`status`),
   KEY `title` (`title`),
   KEY `questiontime` (`questiontime`),
   KEY `answertime` (`answertime`),
   KEY `sendername` (`sendername`)
)" );

$db->sql_query( "DROP TABLE IF EXISTS " . $prefix . "_banip" );
$db->sql_query( "CREATE TABLE " . $prefix . "_banip (
  `id` int(10) NOT NULL auto_increment,
  `banip` varchar(20) NOT NULL default '',
  `settime` int(11) NOT NULL default '1',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `banip` (`banip`)
)");

$db->sql_close();
?>
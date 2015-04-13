<?php

/*
* @Program:		NukeViet CMS
* @File name: 	NukeViet Setup
* @Author: 		NukeViet Group
* @Version: 	2.0 RC4
* * @Date: 		06.04.2010
* @Website: 	www.nukeviet.vn
* @Copyright: 	(C) 2009
* @License: 	http://opensource.org/licenses/gpl-license.php GNU Public License
*/

//# addon thong bao loi by nta babentanh@yahoo.com 22/2/2009
define( "_ERRB40", "Lỗi: File mainfile.php tại thư mục gốc của site không tồn tại, hãy copy file này từ include/data ra thư mục gốc của site" );
define( "_ERRB41", "Nukeviet 2.0 đã cài đặt thành công. Hãy xóa thư mục install trên host để bắt đầu sử dụng!" );
define( "_CHKTOCOPY", "Tự động chuyển tập tin manfile.php về thư mục gốc (Có thể gặp lỗi nếu bạn chưa change mod cho thư mục gốc của site.)" );
define( "_VERSIONPHP", "Lỗi: Version PHP của bạn không tương thích với nukeviet" );
define( "_ERRB35", "Lỗi: Tên CDSL không tồn tại trên host, hãy kiểm tra lại tên CDSL của bạn" );
define( "_ERRB34", "Lỗi: Không thể kết nối với CDSL, hãy kiểm tra lại tên truy cập CSDL 1 và mật khẩu" );
define( "_ERRB33", "Lỗi: Tên sử dụng đã bị cấm, hãy lựa chọn 1 tên khác" );
define( "_ERRB32", "Lỗi: Email sử dụng đã bị cấm, hãy lựa chọn 1 email khác" );
define( "_ERRB31", "Lỗi: Email của thành viên không hợp lệ, email không nên chứa các ký tự đặc biệt. (email chuẩn có dạng: abc@mail.com)" );
define( "_ERRB30", "Lỗi: Email của Admin không hợp lệ, email không nên chứa các ký tự đặc biệt. (email chuẩn có dạng: abc@mail.com)" );
define( "_ERRB23", "Lỗi: Mật khẩu truy cập của thành viên không hợp lệ. Mật mã phải lớn hơn 4 ký tự và không quá 15 ký tự" );
define( "_ERRB22", "Lỗi: Tên truy cập của thành viên không hợp lệ. Độ dài phải lớn hơn 4 ký tự và không quá 15 ký tự" );
define( "_ERRB21", "Lỗi: Mật khẩu truy cập của Admin không hợp lệ. Mật mã phải lớn hơn 4 ký tự và không quá 15 ký tự" );
define( "_ERRB20", "Lỗi: Độ dài tên admin không hợp yêu cầu. Tên admin phải lớn hơn 4 ký tự và không quá 15 ký tự" );
define( "_ERRB19", "Lỗi: Chưa khai báo tên tập tin admin" );
define( "_ERRB18", "Lỗi: Hãy chọn ngôn ngữ chính của site" );
define( "_ERRB17", "Lỗi: Chưa khai báo (hoặc khai báo chưa đúng quy cách) mật khẩu truy cập của thành viên" );
define( "_ERRB16", "Lỗi: Chưa khai báo tên truy cập của thành viên" );
define( "_ERRB15", "Lỗi: Chưa khai báo (hoặc khai báo chưa đúng quy cách) mật khẩu truy cập của Admin " );
define( "_ERRB14", "Lỗi: Chưa khai báo tên truy cập của Admin " );
define( "_ERRB13", "Lỗi: Chưa khai báo tiếp đầu tố cá nhân" );
define( "_ERRB12", "Lỗi: Chưa khai báo tiếp đầu tố chung(prefix) cho portal" );
define( "_ERRB11", "Lỗi: Chưa khai báo tên CDSL" );
define( "_ERRB10", "Lỗi: Chưa khai báo tên truy cập CSDL 1" );
define( "_ERRB9", "Lỗi: Chưa khai báo mật khẩu truy cập CSDL 1" );
define( "_ERRB8", "Lỗi: Chưa khai báo tên thư mục Admin" );
define( "_ERRB7", "Lỗi: Chưa khai báo tên tập tin Admin" );
//
define( "_CHARSET", "UTF-8" );
define( "_SUCCESS", "Tương thích" );
define( "_FAILED", "Không tương thích" );
define( "_WARNING", "Cảnh báo" );
define( "_STEP1", "Kiểm tra" );
define( "_STEP2", "Khai báo" );
define( "_STEP3", "Tạo CSDL" );
define( "_STEP4", "Kết thúc" );
define( "_STEP12", "Kiểm tra tính tương thích của máy chủ cài đặt" );
define( "_STEP121", "Phiên bản PHP" );
define( "_STEP1211", "Bắt buộc >= 4.3.0" );
define( "_STEP122", "Safe Mode" );
define( "_STEP1221", "Bắt buộc tắt" );
define( "_STEP123", "Set_time_limit()" );
define( "_STEP1231", "nên bật" );
define( "_STEP124", "File Uploads" );
define( "_STEP1241", "nên bật" );
define( "_STEP125", "Hỗ trợ MySQL" );
define( "_STEP1251", "Bắt buộc hỗ trợ" );
define( "_STEP126", "Register Globals" );
define( "_STEP1261", "Nên tắt" );
define( "_STEP127", "Magic Quotes Runtime" );
define( "_STEP1271", "Nên tắt" );
define( "_STEP128", "Magic Quotes GPC" );
define( "_STEP1281", "Nên tắt" );
define( "_STEP129", "Magic Quotes Sybase" );
define( "_STEP1291", "Nên tắt" );
define( "_STEP130", "Output Buffering" );
define( "_STEP1301", "Nên tắt" );
define( "_STEP131", "Session auto start" );
define( "_STEP1311", "Nên tắt" );
define( "_STEP132", "Display Errors" );
define( "_STEP1321", "Nên tắt" );
define( "_STEP133", "Zlib compression support" );
define( "_STEP1331", "Nên hỗ trợ" );
define( "_STEP134", "GD graphics support" );
define( "_STEP1341", "Nên hỗ trợ" );
define( "_STEP135", "Việc kiểm tra đã hoàn tất. Bạn có thể tiếp tục cài đặt" );
define( "_STEP1351", "Việc kiểm tra đã hoàn tất. Rất tiếc là cấu hình máy chủ của bạn không thích hợp cho việc cài đặt hệ thống Nukeviet" );
define( "_STEP1352", "Việc kiểm tra đã hoàn tất. Một số đòi hỏi của hệ thống không được đáp ứng, rất có thể ảnh hưởng đến hiệu quả làm việc của Nukeviet. Bạn có thể tiếp tục cài đặt và thay đổi cấu hình máy chủ sau" );
define( "_STEP136", "Chuyển sang bước 2" );
define( "_STEP22", "Khai báo cài đặt hệ thống Nukeviet" );
define( "_STEP23", "Host chứa CSDL *" );
define( "_STEP240", "Tên truy cập CSDL*" );
define( "_STEP250", "Mật khẩu truy cập CSDL*" );
define( "_STEP26", "Tên CSDL *" );
define( "_STEP27", "Tiếp đầu tố chung *" );
define( "_STEP28", "Tiếp đầu tố cá nhân *" );
define( "_STEP29", "Tên gọi của site" );
define( "_STEP220", ">> Bước 3" );
define( "_STEP221", "Bước 1 <<" );
define( "_STEP210", "Tên truy cập của Admin *" );
define( "_STEP211", "Email của Admin *" );
define( "_STEP212", "Mật khẩu truy cập của Admin *" );
define( "_STEP213", "Tên truy cập của thành viên *" );
define( "_STEP214", "Email của thành viên *" );
define( "_STEP215", "Mật khẩu truy cập của thành viên *" );
define( "_STEP216", "Ngôn ngữ chính của site *" );
define( "_STEP217", "Thư mục Data *" );
define( "_STEP218", "Thư mục Admin *" );
define( "_STEP219", "Tập tin Admin *" );
define( "_STEP222", "<b>Các chú ý khi khai báo:</b><li>Tất cả các dòng đánh dấu hoa thị (*) phải được khai báo đầy đủ</li><li>Các thông số về CSDL được xác định từ nhà cung cấp hosting</li><li>Tên truy cập, Mật khẩu của Admin và Thành viên nhỏ hơn 10, lớn hơn 4 ký tự, chỉ dùng các chữ cái và số trong bảng chữ cái latin, không có khoảng trắng, không dùng những tên bị cấm như: anonimo, god, linux, nobody, root, operator, anonymous...</li><li>Email của Admin và Thành viên phải là email thật, được viết đúng theo nguyên tắc chung</li><li>Vị trí 'thư mục data' mặc định là includes/data. Trong quá trình cài, nếu bạn khai báo lại 'Thư mục Data' thì nó phải di chuyển nó về vị trí đã khai báo và CHMOD 777 trước khi cài đặt.</li>" );
define( "_STEP2222", "Quá trình cài đặt chỉ diễn ra khi tất cả các khai báo đầy đủ và chính xác!" );
define( "_STEP32", "Quá trình tạo cơ sở dữ liệu cho hệ thống Nukeviet" );
define( "_STEP33", "Tạo CSDL" );
define( "_STEP34", "Tạo các tập tin Data" );
define( "_STEP35", ">> Bước 4" );
define( "_STEP36", "Chỉ còn một động tác cuối cùng là chuyển tập tin mainfile.php trong thư mục" );
define( "_STEP37", "ra ngoài thư mục gốc, sau đó nhấn chuột vào nút <u>Bước 4</u> để kết thúc cài đặt." );
define( "_STEP42", "Kết thúc cài đặt" );
define( "_STEP43", "Xin chúc mừng!!! Bạn đã cài đặt thành công hệ thống Nukeviet. <font color=\"#ffffff\"><b>Hãy xóa ngay thư mục install</b></font> khỏi server và đăng nhập vào khu vực quản lý để tiến hành các bước cấu hình site.<br><br><b>Chú ý:</b> Hãy <font color=\"#ffffff\">CHMOD thư mục <u>uploads</u></font> trên webroot và các thư mục con nằm trong nó ở chế độ 777. Nếu không làm việc này ngay, hệ thống sẽ không cho phép bạn upload các tập tin lên host.<br>Mọi nhu cầu về hỗ trợ kỹ thuật xin liên hệ tại <a href=http://nukeviet.vn target=_blank><font color=\"#ffffff\">diễn đàn Nukeviet.VN</font></a>.<br>Xin cảm ơn và chúc thành công!" );
define( "_STEP44", "Vào khu vực quản lý site" );
define( "_STEP45", "Đến trang chủ" );

?>
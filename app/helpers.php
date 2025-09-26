<?php 
if (! function_exists('getState')) {
    function getState ($state) {
	    if ($state == 0) {
	        return 'Ẩn';
	    }
	    if ($state == 1) {
	        return 'Hiển thị';
	    }
	}
}

if (! function_exists('check_variable')) {
    function check_variable ($var) {
	    if (is_array($var)) {
	        return 'là mảng';
	    }

	    if (is_numeric($var)) {
	        return 'là số';
	    }

	    if (is_string($var)) {
	        return 'là chuỗi';
	    }

	    if (is_bool($var)) {
	        return 'là boolean';
	    }

	    if (is_object($var)) {
	        return 'là đối tượng';
	    }

	    return 'không xác định';
	}
}

if (! function_exists('date_2')) {
    function date_2 ($date_in) {
	    $date = new DateTime($date_in);
	    $date->modify('+10 day');
	    return $date->format('Y-m-d');
	    // echo "Ngày sau khi thay đổi: " . $date->format('Y-m-d'); // 2023-06-28

	    // $interval = new DateInterval('P2D'); // Cộng thêm 2 ngày
	    // date_add($date, $interval);
	    // echo "Ngày sau khi cộng thêm 2 ngày: " . date_format($date, 'Y-m-d'); // 2023-06-30

	    // $interval = new DateInterval('P2D'); // Trừ đi 2 ngày
	    // date_sub($date, $interval);
	    // echo "Ngày sau khi trừ đi 2 ngày: " . date_format($date, 'Y-m-d'); // 2023-06-28
	}
}

if (! function_exists('vi_to_en')) {
    function vi_to_en ($str){
 
	    $unicode = array(
	     
	    'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
	     
	    'd'=>'đ',
	     
	    'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
	     
	    'i'=>'í|ì|ỉ|ĩ|ị',
	     
	    'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
	     
	    'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
	     
	    'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
	     
	    'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
	     
	    'D'=>'Đ',
	     
	    'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
	     
	    'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
	     
	    'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
	     
	    'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
	     
	    'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
	     
	    );
	     
	    foreach($unicode as $nonUnicode=>$uni){
	     
	        $str = preg_replace("/($uni)/i", $nonUnicode, $str);
	 
	    }
	    $str = str_replace(' ','-',$str);

	    $str = strtolower($str);

	    $str = preg_replace("/[^A-Za-z0-9\-]/", "",$str);
	 
	    return $str;

	}
}
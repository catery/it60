<?php
	
	if(!function_exists('convert_title')) {
		function convert_title($str) {
			return isset($str) ? htmlentities($str) : '';
		}
	}

	if(!function_exists('convert_cthuong')) {
		function convert_cthuong($str) {
			return isset($str) ? strtolower(stripslashes(trim($str))) : '';
		}
	}

	if(!function_exists('convert_date')) {
		function convert_date($str) {
			return isset($str) ? date('d/m/Y', strtotime($str)) : '';
		}
	}

	if(!function_exists('convert_tags')) {
		function convert_tags($str) {
			return isset($str) ? strip_tags($str, '') : '';
		}
	}

	if(!function_exists('convert_explode')) {
		function convert_explode($str) {
			return isset($str) ? explode('file_manager', $str) : '';
		}
	}

	if(!function_exists('convert_implode')) {
		function convert_implode($str) {
			return 'file_manager'.convert_explode($str)[1];
		}
	}

	if(!function_exists('convert_ktrang')) {
		function convert_ktrang($str) {
			return isset($str) ? stripslashes(trim($str)) : '';
		}
	}

	if(!function_exists('convert_mkhau')) {
		function convert_mkhau($str) {
			return isset($str) ? md5(strtolower(stripslashes(trim($str)))) : '';
		}
	}

	if(!file_exists('convert_dau')) {
		function convert_dau($str) {
			$str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/i", 'a', $str); 
			$str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/i", 'e', $str); 
			$str = preg_replace("/(ì|í|ị|ỉ|ĩ)/i", 'i', $str); 
			$str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/i", 'o', $str); 
			$str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/i", 'u', $str); 
			$str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/i", 'y', $str); 
			$str = preg_replace("/(đ)/i", 'd', $str); 
			$str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str); 
			$str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str); 
			$str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str); 
			$str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str); 
			$str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str); 
			$str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str); 
			$str = preg_replace("/(Đ)/", 'D', $str);
			$str = preg_replace("/(!|\$|%|\,)/", '', $str);
			$str = preg_replace("/\(|\)/", '', $str);
			$str = preg_replace("/%/", '', $str);
			$str = preg_replace("/\"|\"/", '', $str);
			$str = preg_replace("/\'|\'/", '', $str);
			$str = preg_replace("/(̀́\||\/|\|̉|\$|>)/", '', $str);
			$str = preg_replace ("''si", "", $str);
			$str = str_replace(" / ","-",$str);
			$str = str_replace("/","-",$str);
			$str = str_replace(".","",$str);
			$str = str_replace("#","-sharp",$str);
			$str = str_replace("+","-plus",$str);
			$str = str_replace(" - ","-",$str);
			$str = str_replace("_","-",$str);
			$str = str_replace(" ","-",$str);
			$str = str_replace( "ß", "ss", $str);
			$str = str_replace( "&", "", $str);
			$str = str_replace( "%", "", $str);
			$str = str_replace("----","-",$str);
			$str = str_replace("---","-",$str);
			$str = str_replace("--","-",$str);
			return $str;
		}
	}

	if(!file_exists('convert_link')) {
		function convert_link($str){
    		return str_replace(' ', '-', trim(strtolower(convert_dau($str))));
    	}
	}
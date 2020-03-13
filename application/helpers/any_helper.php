<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
* @Function_name : Generate_Css
* @Return_type : String
* @Author : Samirah Rahayu /085723211904
*/
if (!function_exists('generate_css'))
{
	function generate_css($_CSS = NULL)
	{
		if(!isset($_CSS) or $_CSS == NULL) {
			return NULL;
		}
		if(is_array($_CSS)) {
			$str = "";
			foreach ($_CSS as $key => $value) {
				$str .= '<link href="'.base_url('source/assets').'/'.$value.'" type="text/css" rel="stylesheet">';
			}
			return $str;
		} else if(is_string($_CSS)) {
			return '<link href="'.base_url('source/assets').'/'.$_CSS.'" type="text/css" rel="stylesheet">';
		}
	}
}

/*
* @Function_name : Generate_Js
* @Return_type : String
* @Author : Samirah Rahayu /085723211904
*/	
if (!function_exists('generate_js'))
{
	function generate_js($JS =  NULL)
	{
		if(!isset($JS) or $JS == NULL) {
			return NULL;
		}
		if(is_array($JS)) {
			$str = "";
			foreach ($JS as $key => $value) {
				$str .= '<script src="'.base_url('source/assets').'/'.$value.'" type="text/javascript"></script>';
			}
			return $str;
		} else if(is_string($JS)) {
			return '<script src="'.base_url('source/assets').'/'.$JS.'" type="text/javascript"></script>';
		}
	}
}

/*
* @Function_name : getActiveCtlr
* @Return_type : String
* @Author : Restu Adtywarman /085797090845
*/	
if (!function_exists('getActiveCtlr'))
{
	function getActiveCtlr($ctlr = null)
	{
		$CI =& get_instance();

		$aktif =  $CI->uri->segment(1);
		if (in_array($aktif, $ctlr)) {
		    return "active open";
		}else{
			return false;
		}
	}
}

/*
* @Function_name : getArrowCtlr
* @Return_type : String
* @Author : Restu Adtywarman /085797090845
*/	
if (!function_exists('getArrowCtlr'))
{
	function getArrowCtlr($ctlr = null)
	{
		$CI =& get_instance();

		$aktif =  $CI->uri->segment(1);
		if (in_array($aktif, $ctlr)) {
		    return "open";
		}else{
			return false;
		}
	}
}


/*
* @Function_name : getActiveFunc
* @Return_type : String
* @Author : Restu Adtywarman /085797090845
*/	
if (!function_exists('getActiveFunc'))
{
	function getActiveFunc($funct = null)
	{
		$CI =& get_instance();

		$ctlr =  $CI->uri->segment(1);
		$func =  $CI->uri->segment(2);
		if (empty($func)){
			$func = "index";
		}
		if ($funct == $ctlr."/".$func) {
		    return 'class="active"';
		}else{
			return false;
		}
	}
}

if (!function_exists('getActiveFunction'))
{
	function getActiveFunction($funct = null)
	{
		$CI =& get_instance();

		$ctlr =  $CI->uri->segment(1);
		$func =  $CI->uri->segment(2);
		$func3 =  $CI->uri->segment(3);
		if (empty($func)){
			$func = "index";
		}
		if ($funct == $ctlr."/".$func."/".$func3) {
		    return "class='active'";
		}else{
			return false;
		}
		echo $funct;
	}
}

if (!function_exists('getFlag'))
{
	function getFlag($semester)
	{
		$ganjil = array(1,3,5);
		if (in_array($semester, $ganjil)) {
		    return "Ganjil";
		}else{
			return "Genap";
		}
	}
}
	
/*
* @Function_name : showLevel
* @Return_type : String
* @Author : Restu Adtywarman /085797090845
*/	
if ( ! function_exists('showLevel'))
{
	function showLevel($level)
	{
		//$currentLevel = $_SESSION['userlog']['sess_role'];
		$currentLevel = $_SESSION['user_role'];
		if (in_array($currentLevel, $level)) {
		    return "";
		}else{
			return "display: none;";
		}	
	}
}

if ( ! function_exists('showLevelApp'))
{
	function showLevelApp($level)
	{
		$currentLevel = $_SESSION['app']['sess_role'];
		
		if (in_array($currentLevel, $level)) {
		    return "";
		}else{
			return "display: none;";
		}	
	}
}

/*
* @Function_name : uploadPic
* @Return_type : Array
* @Author : Restu Adtywarman /085797090845
*/	
if (!function_exists('uploadPic'))
{
	function uploadPic($File, $location, $format)
	{
		$aExt = array("jpeg", "jpg", "png");
		$t 	 = explode(".", $File["name"]);
		$ext = end($t);
		if ((($File["type"] == "image/png") || ($File["type"] == "image/jpg") || ($File["type"] == "image/jpeg")) && ($File["size"] < 2000000)&& in_array($ext, $aExt))
			{
				if ($File["error"] > 0){
						$data = array('code' => 500, 'message' => 'Terjadi kesalahan pada file yang di upload');
				}else{
					$sPath = $File['tmp_name'];
					$nPic = $format.".".$ext;
					$tPath = "./assets/global/".$location."/".$nPic;
					move_uploaded_file($sPath,$tPath);
					$data = array('code' => 200, 'upload_data' => $nPic);
				}
			}else{
				$data = array('code' => 500, 'message' => 'Terjadi kesalahan pada file yang di upload');
			}
		return $data;
	}
}

/*
* @Function_name : deletePic
* @Return_type : Array
* @Author : Restu Adtywarman /085797090845
*/	
if (!function_exists('deletePic'))
{
	function deletePic($File, $location)
	{
		if (file_exists("./assets/global/".$location."/". $File)) {
			unlink("./assets/global/".$location."/". $File);
			$data = array('code' => 200, 'message' => 'Gambar berhasil di hapus');
		}else{
			$data = array('code' => 505, 'message' => 'File not found');
		}
		return $data;
	}
}

/*
* @Function_name : uploadFile
* @Return_type : Array
* @Author : Restu Adtywarman /085797090845
*/	
if (!function_exists('uploadFile'))
{
	function uploadFile($File, $location,$format)
	{
		$aExt = array("jpeg", "jpg", "png");
		$t = explode(".", $File["name"]);
		$ext = end($t);
		if (($File["size"] < 50000000))
			{
				if ($File["error"] > 0){
						$data = array('code' => 500, 'message' => 'Terjadi kesalahan pada file yang di upload');
				}else{
					$lokasi = "./assets/global/".$location;
					if (!file_exists($lokasi)) {
					    mkdir($lokasi, 0777, true);
					}

					$sPath = $File['tmp_name'];
					$nPic = "file_".$format.".".$ext;
					$tPath = $lokasi.$nPic;
					move_uploaded_file($sPath,$tPath);
					$data = array('code' => 200, 'upload_data' => $nPic, 'lokasi_data' => $lokasi);
				}
			}else{
				$data = array('code' => 500, 'message' => 'file terlalu besar');
			}
		return $data;
	}
}

/*
* @Function_name : Ambil email
* @Return_type : String
* @Author : Anton Purnama /082118115288
*/
if (!function_exists('email'))
{
	function email($id=null)
	{
		$CI =& get_instance();

		$get = $CI->Mod_crud->getData();
		if ($get) :
			return $get->email_user;
		else :
			return false;
		endif;
	}
}

/*
* @Function_name : timestep
* @Return_type : Date
* @Author : Anton Purnama /082118115288
*/
if (!function_exists('timestep'))
{
	function timestep($timestamp)
	{
	    $diff = time() - strtotime($timestamp) ;
	    $seconds = $diff ;
	    $minute = round($diff / 60 );
	    $hour = round($diff / 3600 );
	    $day = round($diff / 86400 );
	    $week = round($diff / 604800 );
	    $month = round($diff / 2419200 );
	    $year = round($diff / 29030400 );
	    if ($seconds <= 60) {
	        $time = $seconds.' seconds ago';
	    } else if ($minute <= 60) {
	        $time = $minute.' minute ago';
	    } else if ($hour <= 24) {
	        $time = $hour.' hour ago';
	    } else if ($day <= 7) {
	        $time = $day.' day ago';
	    } else if ($week <= 4) {
	        $time = $week.' week ago';
	    } else if ($month <= 12) {
	        $time = $month.' month ago';
	    } else {
	        $time = $year.' year ago';
	    }
	    return $time;
	}
}

if (!function_exists('get_type_form'))
{
	function get_type_form($id=null)
	{
		$CI =& get_instance();

		$get = $CI->mod->getData('row', 'id_type', 'form_ms_tc', null, null, null, array('id_ms_form'=>$id));
		if ($get) :
			return $get->id_type;
		else :
			return false;
		endif;
	}
}

if (!function_exists('name_type'))
{
	function name_type($id=null)
	{
		$CI =& get_instance();

		$get = $CI->mod->getData('row', 'name_type', 'type_tc', null, null, null, array('id_type'=>$id));
		if ($get) :
			return $get->name_type;
		else :
			return false;
		endif;
	}
}

if (!function_exists('name_form'))
{
	function name_form($id=null)
	{
		$CI =& get_instance();

		$get = $CI->mod->getData('row', 'name_form', 'form_ms_tc', null, null, null, array('id_ms_form'=>$id));
		if ($get) :
			return $get->name_form;
		else :
			return false;
		endif;
	}
}

if (!function_exists('check_id_form'))
{
	function check_id_form($id=null)
	{
		$CI =& get_instance();

		$get = $CI->mod->checkData('id_ms_form', 'form_ms_tc', array('id_ms_form = "'.$id.'"'));
		if ($get) :
			return true;
		else :
			return false;
		endif;
	}
}

if (!function_exists('check_id_checker'))
{
	function check_id_checker($id=null)
	{
		$CI =& get_instance();

		$get = $CI->mod->checkData('id_ms_trans', 'trans_ms_tc', array('id_ms_trans = "'.$id.'"'));
		if ($get) :
			return true;
		else :
			return false;
		endif;
	}
}

if (!function_exists('check_type'))
{
	function check_type($id=null)
	{
		$CI =& get_instance();

		$get = $CI->mod->checkData('id_type', 'type_tc', array('id_type = "'.$id.'"'));
		if ($get) :
			return true;
		else :
			return false;
		endif;
	}
}

if (!function_exists('get_form_name'))
{
	function get_form_name($id=null)
	{
		$CI =& get_instance();

		$get = $CI->mod->getData('row', 'name_form', 'form_ms_tc', null, null, null, array('id_ms_form'=>$id));
		if ($get) :
			return $get->name_form;
		else :
			return false;
		endif;
	}
}

if (!function_exists('check_id_detail'))
{
	function check_id_detail($id=null)
	{
		$CI =& get_instance();

		$get = $CI->mod->checkData('id_dt_form', 'form_dt_tc', array('id_dt_form = "'.$id.'"'));
		if ($get) :
			return true;
		else :
			return false;
		endif;
	}
}

if (!function_exists('cekLevel'))
{
	function cekLevel($id=null)
	{
		$CI =& get_instance();

		$get = $CI->mod->checkData('parent_id', 'form_dt_tc', array('parent_id = "'.$id.'"'));
		if ($get) :
			return true;
		else :
			return false;
		endif;
	}
}

if (!function_exists('name_testcase'))
{
	function name_testcase($id=null)
	{
		$CI =& get_instance();

		$get = $CI->mod->getData('row', 'tc_name', 'form_dt_tc', null, null, null, array('tc_id'=>$id));
		if ($get) :
			return $get->tc_name;
		else :
			return false;
		endif;
	}
}

if (!function_exists('cek_value_exsist'))
{
	function cek_value_exsist($tc_id = null, $id_device = null)
	{
		$CI =& get_instance();

		$get = $CI->mod->checkData('tc_id, id_device', 'trans_dt_tc', array('tc_id = "'.$tc_id.'"','id_device = "'.$id_device.'"'));
		if ($get) :
			return true;
		else :
			return false;
		endif;
	}
}

if (!function_exists('cek_comment_exsist'))
{
	function cek_comment_exsist($tc_id = null)
	{
		$CI =& get_instance();

		$get = $CI->mod->checkData('tc_id', 'trans_dt_tc', array('tc_id = "'.$tc_id.'"'));
		if ($get) :
			return true;
		else :
			return false;
		endif;
	}
}

if (!function_exists('cek_create_checker'))
{
	function cek_create_checker($id_ms_trans = null, $id_device = null)
	{
		$CI =& get_instance();
		$get = $CI->mod->checkData('id_device', 'trans_dt_tc', array('id_ms_trans = "'.$id_ms_trans.'"','id_device = "'.$id_device.'"'));
		if ($get) :
			return 'Open';
		else :
			return 'Close';
		endif;
	}
}



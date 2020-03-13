<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// THE HELPER
//cek auth
if (!function_exists('auth_check'))
{
	function auth_check()
	{
		$CI =& get_instance();
		$log = $CI->session->userdata('authlog');
		if ($log['user_login_access'] == FALSE)
		{
			redirect(base_url('auth/auth'),'refresh');
		}else{
			return true;
		}
	}
}
//auth level
if (!function_exists('auth_level'))
{
	function auth_level($type = null, $level = null, $module = null)
	{
		$CI =& get_instance();
		
		if(is_null($level) || is_null($type)){
			return false;
		}
		
		if(is_null($module)){
			$module = 'home';
		}
		
		$CI->load->model('user_model');
		$check = $CI->user_model->check_user_level($type, strtolower($module), $level);
		
		return $check;
	}
}
//level check
if (!function_exists('level_check'))
{
	function level_check($level = null, $module = null)
	{
		$CI =& get_instance();
		$module = $CI->module;
		if(isset($_SESSION['is_login']) && $_SESSION['is_login']){
			
			if(auth_level($_SESSION['type'], $level, $module)){
				return true;
			}
			
			return false;
		}
		
		return false;
	}
}
//auth redirect
if (!function_exists('auth_redirect'))
{
	function auth_redirect()
	{
		$CI =& get_instance();
		$log = $CI->session->userdata('userlog');
		switch($log['LevelUser']){
			case '1':
				redirect(base_url('baak/dashboard'),'refresh');
				break;
			case '2':
				redirect(base_url('jurusan/dashboard'),'refresh');
				break;
			case '3':
				redirect(base_url('dosen/dashboard'),'refresh');
				break;
			case '4':
				redirect(base_url('mahasiswa/dashboard'),'refresh');
				break;
			default:
				redirect(base_url(),'refresh');
				break;
		}
	}
}

/*
* @Function_name : what role
* @Return_type : string
* @Author : Anton Purnama /082118115288
*/
if (!function_exists('role_name'))
{
	function role_name($role)
	{

		$CI =& get_instance();

		$get = $CI->mod->getData('row', 'role', 'role_access', null, null, null, array('id_role'=>$role));
		if ($get) :
			return $get->role;
		else :
			return false;
		endif;
	}
}
/*
* @Function_name : helper_log
* @Return_type : -
* @Author : Anton Purnama /082118115288
*/
if (!function_exists('helper_log'))
{
	function helper_log($tipe = null, $str = null, $usrID = null)
	{
		$CI =& get_instance();
		$CI->load->library('user_agent');
		$CI->db->trans_start();
		if ($CI->agent->is_browser())
		{
		    $agent = $CI->agent->browser().' '.$CI->agent->version();
		}
		elseif ($CI->agent->is_robot())
		{
		    $agent = $CI->agent->robot();
		}
		elseif ($CI->agent->is_mobile())
		{
		    $agent = $CI->agent->mobile();
		}
		else
		{
		    $agent = 'Unidentified User Agent';
		}

		$typelog = $CI->Mod_crud->getData('result','*','t_log_type');

		if ($typelog) {
        	$i= 1;
    	    foreach ($typelog as $key) {
    	    	if (strtolower($tipe) == $key->typeName) {
    	    		$logtype = $key->logTypeID;
    	    	}
        	}
    	}
		$cLog = $CI->Mod_crud->insertData('t_log_activity', array(
				'logUsrID' 		=> $usrID,
				'logTime' 		=> date('Y-m-d H:i:s'),
				'logTypeID' 	=> $logtype,
				'logDesc'		=> $str,
				'logBrowser' 	=> $agent,
				'logIP'			=> $CI->input->ip_address(),
				'logPlatform' 	=> $CI->agent->platform()
			)
		);

		if($cLog) {
			$CI->db->trans_complete();
		}
	}
}

/*
* @Function_name : query_session
* @Return_type : -
* @Author : Anton Purnama /082118115288
*/
if (!function_exists('query_session'))
{
	function query_session()
	{
		$CI =& get_instance();
		$dsn = $CI->Mod_common->qry_session();
	}
}

/*
* @Function_name : create_notification
* @Return_type : -
* @Author : Anton Purnama /082118115288
*/
if (!function_exists('create_notification'))
{
	function create_notification($tipe = null, $title = null, $notif = null, $url = null)
	{
		$CI =& get_instance();
		$CI->db->trans_start();
		
		$cLog = $CI->Mod_crud->insertData('t_notification', array(
				'notifType'		=> $tipe,
				'notifTitle'	=> $title,
				'notification'	=> $notif,
				'notifUrl'		=> $url,
				'create_by'		=> $CI->session->userdata('userlog')['sess_usrID'],
				'create_at' 	=> date('Y-m-d H:i:s'),
			)
		);

		if($cLog) {
			$CI->db->trans_complete();
		}
	}
}
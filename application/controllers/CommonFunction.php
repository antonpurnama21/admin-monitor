<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CommonFunction extends CI_Controller {

	public $data = array();
	public $sess = null;

	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('authlog')['user_login_access'] != TRUE) :
			redirect(base_url('auth/login')) ; 
		endif;
		$this->load->database();
		$this->load->model('Mod_crud','mod');
		$this->sess = $this->session->userdata();
		
		 
    }

    public function get_type_tc()
    {
        $resp = array();
		$data = $this->mod->getData('result', '*', 'type_tc');
		if (!empty($data)) {
			foreach ($data as $key) {
				$mk['id'] = $key->id_type;
				$mk['text'] = $key->id_type.'::'.ucwords($key->name_type);
				array_push($resp, $mk);
			}
		}
		echo json_encode($resp);
	}

	public function get_role()
    {
        $resp = array();
		$data = $this->mod->getData('result', '*', 'role_access');
		if (!empty($data)) {
			foreach ($data as $key) {
				$mk['id'] = $key->id_role;
				$mk['text'] = $key->id_role.'::'.ucwords($key->role);
				array_push($resp, $mk);
			}
		}
		echo json_encode($resp);
	}

	public function get_param()
    {
        $resp = array();
		$data = $this->mod->getData('result', '*', 'param_check',5);
		if (!empty($data)) {
			foreach ($data as $key) {
				$mk['id'] = $key->id;
				$mk['text'] = strtoupper($key->value);
				array_push($resp, $mk);
			}
		}
		echo json_encode($resp);
	}
	
	public function get_parent($id = null)
    {
		$resp = array();
		$id = $this->input->post('id');
		if(empty($id)){
			die();
		}
		$data = $this->mod->getData('result', 'tc_id, tc_name', 'form_dt_tc',null,null,null,array('id_ms_form'=>base64_decode($id)));
		if (!empty($data)) {
			foreach ($data as $key) {
				$mk['id'] = $key->tc_id;
				$mk['text'] = $key->tc_id.'::'.ucwords($key->tc_name);
				array_push($resp, $mk);
			}
		}
		echo json_encode($resp);
	}
	
	public function get_ms_form($id = null)
    {
		$resp = array();
		$id = $this->input->post('id');
		if(empty($id)){
			die();
		}
		$data = $this->mod->getData('result', 'id_ms_form, name_form', 'form_ms_tc',null,null,null,array('id_type'=>($id)));
		if (!empty($data)) {
			foreach ($data as $key) {
				$mk['id'] = $key->id_ms_form;
				$mk['text'] = $key->id_ms_form.'::'.ucwords($key->name_form);
				array_push($resp, $mk);
			}
		}
		echo json_encode($resp);
    }
    
}

/* End of file CommonFunction.php */
/* Location: ./application/controllers/CommonDash.php */
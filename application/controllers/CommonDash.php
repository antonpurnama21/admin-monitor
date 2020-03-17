<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CommonDash extends CI_Controller {

	public $data = array();
	public $sess = null;

	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('authlog')['user_login_access'] != TRUE) :
			redirect(base_url('auth/login')) ; 
		endif;
		$this->load->database();
		$this->load->library('table');
		$this->load->model('Mod_crud','mod');
		$this->sess = $this->session->userdata('authlog');
		 
	}

	public function render($template, $view, $dt)
	{
		$id = $this->sess['user_login_id'];
		$data = array_merge($dt, array(
				'sesi' => $this->sess,
				)
		);
		
		$this->template->load($template, $view, $data);
	}
}

/* End of file CommonDash.php */
/* Location: ./application/controllers/CommonDash.php */
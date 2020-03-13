<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH."controllers/CommonDash.php");

class Device extends CommonDash {

	public function __construct()
	{
        parent::__construct();
        
	}

    public function index()
	{
		$data = array(
            '_CSS' => generate_CSS(array(
                'vendor/datatables/media/css/dataTables.bootstrap4.css'                
                )
            ),
			'_JS' => generate_js(array(
                'js/pages/index-device-script.js',
                'vendor/jquery-validation/jquery.validate.js',
                'vendor/datatables/media/js/jquery.dataTables.min.js',
                'vendor/datatables/media/js/dataTables.bootstrap4.min.js',
				)
			),
			'titleWeb' 	=> 'List | Device Form Testcase',
			'breadcrumb'=> explode(',', 'Dashboard, List Device'),
            'data'      => $this->mod->getData('result','*','device_tc'),
        );
		$this->render('dashboard_template', 'pages/device/index', $data);
    }

    public function modalAdd(){
		$data = array(
                'modalTitle' => 'Add New Device',
                'formAction' => base_url('device/do_save'),
				'Req' => ''
			);
		$this->load->view('pages/device/modal_form', $data);
    }

    public function do_save()
    {
        $response = array();
        $name     = $this->input->post('device_name');
        $type     = $this->input->post('id_type');
        $date     = date('Y-m-d h:i:sa');
        
        #Login input validation\
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<span class="text-white">', '</span>');
        $this->form_validation->set_rules('device_name', 'Device Name', 'trim|xss_clean|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('id_type', 'Type', 'trim|xss_clean|required');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array('code' => 404, 'message' => validation_errors()));
        } else {
            $cek_name = $this->mod->checkData('device_name','device_tc',array('device_name = "'.$name.'"'));
            if ($cek_name == TRUE) {
                echo json_encode(array('code' => 366, 'message' => 'Device Name already available!!'));
            }else{
                $insertdata = $this->mod->insertData('device_tc',array(
                    'id_device'	    => $this->mod->autoNumber('id_device','device_tc','1',2),
                    'id_type' 		=> $type,
                    'device_name'	=> $name,
                    'created_by'    => $this->session->userdata('authlog')['user_login_id'],
                    'created_at'	=> $date
                    )
                );

                if ($insertdata){//jika bernilai true
                    $this->alert->set('success', "Insert success !");
                    echo json_encode(array('code' => 200, 'message' => 'Insert new device success !'));
                }else{
                    echo json_encode(array('code' => 500, 'message' => 'An error occurred while saving data !'));
                }
            }
        }
        
    }

    public function modalEdit(){
        $ID = explode('~',$this->input->post('id'));
		$data = array(
                'modalTitle' => 'Edit '.$ID[1],
                'formAction' => base_url('device/do_edit'),
                'dMaster'    => $this->mod->getData('row','*','device_tc',null,null,null,array('id_device'=>base64_decode($ID[0]))),
				'Req' => ''
            );
        //echo json_encode($data);
		$this->load->view('pages/device/modal_form', $data);
    }

    public function do_edit()
    {
        $response = array();
        $name     = $this->input->post('device_name');
        $type     = $this->input->post('id_type');
        $date     = date('Y-m-d h:i:sa');
        
        #Login input validation\
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<span class="text-white">', '</span>');
        $this->form_validation->set_rules('device_name', 'Device Name', 'trim|xss_clean|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('id_type', 'Type', 'trim|xss_clean|required');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array('code' => 404, 'message' => validation_errors()));
        } else {
            $cek_name = $this->mod->checkData('device_name','device_tc',array('device_name = "'.$name.'"','id_device != "'.base64_decode($this->input->post('id_device')).'"'));
            if ($cek_name == TRUE) {
                echo json_encode(array('code' => 366, 'message' => 'Device Name already available!!'));
            }else{
                $updatedata = $this->mod->updateData('device_tc',array(
                    'id_type' 		=> $type,
                    'device_name'	=> $name,
                    'updated_by'    => $this->session->userdata('authlog')['user_login_id'],
                    'updated_at'	=> $date
                    ), array('id_device'=>base64_decode($this->input->post('id_device')))
                );

                if ($updatedata){//jika bernilai true
                    $this->alert->set('success', "Update success !");
                    echo json_encode(array('code' => 200, 'message' => 'Update Device success !'));
                }else{
                    echo json_encode(array('code' => 500, 'message' => 'An error occurred while saving data !'));
                }
            }
            
        }
        
    }

    public function modalDelete(){
        $ID = explode('~',$this->input->post('id'));
		$data = array(
                'modalTitle' => 'Delete '.$ID[1],
                'id'         => $ID[0],
				'formAction' => base_url('device/do_delete'),
				'Req' => ''
			);
		$this->load->view('pages/device/modal_confirm', $data);
    }
    
    public function do_delete(){
        $query 	= $this->mod->deleteData('device_tc', array('id_device' => base64_decode($this->input->post('id'))));        
		if ($query){
            $this->alert->set('success', "Delete success !");
            echo json_encode(array('code' => 200, 'message' => 'Delete success !'));
        }else{
            echo json_encode(array('code' => 500, 'message' => 'An error occurred while deleting data !'));
        }
		
    }

}

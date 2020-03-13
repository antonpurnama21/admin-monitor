<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH."controllers/CommonDash.php");

class Testcase extends CommonDash {

	public function __construct()
	{
        parent::__construct();
        
	}
    
    public function index()
	{
		 echo "Disabled Access!";
	}

    public function form_list()
	{
		$data = array(
            '_CSS' => generate_CSS(array(
                'vendor/datatables/media/css/dataTables.bootstrap4.css'                
                )
            ),
			'_JS' => generate_js(array(
                'js/pages/index-form-script.js',
                'vendor/jquery-validation/jquery.validate.js',
                'vendor/datatables/media/js/jquery.dataTables.min.js',
                'vendor/datatables/media/js/dataTables.bootstrap4.min.js',
				)
			),
			'titleWeb' 	=> 'List | Document Form Testcase',
			'breadcrumb'=> explode(',', 'Dashboard, List Form'),
            'data'      => $this->mod->getData('result','*','form_ms_tc'),
        );
		$this->render('dashboard_template', 'pages/form/form_list', $data);
    }

    public function add_form()
	{
        
		$data = array(
			'_JS' => generate_js(array(
                'vendor/jquery-validation/jquery.validate.js',
                'js/pages/add-form-script.js'
				)
			),
			'titleWeb' 	=> 'New | Document Form Testcase',
            'breadcrumb'=> explode(',', 'Dashboard, Add Form'),
            'formAction'=> base_url('testcase/next_form')
		);
		$this->render('dashboard_template', 'pages/form/add_form', $data);
    }

    public function modalEdit_form(){
        $ID = explode('~',$this->input->post('id'));
		$data = array(
                'modalTitle' => 'Edit '.$ID[1],
                'formAction' => base_url('testcase/do_edit_form'),
                'dMaster'    => $this->mod->getData('row','*','form_ms_tc',null,null,null,array('id_ms_form'=>base64_decode($ID[0]))),
				'Req' => ''
			);
		$this->load->view('pages/form/modal_form', $data);
    }

    public function do_edit_form()
    {
        $response = array();
        $id       = base64_decode($this->input->post('id_ms_form'));
        $name     = $this->input->post('name_form');
        $type     = $this->input->post('type_id');
        $date     = date('Y-m-d h:i:sa');
        
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<span class="text-white">', '</span>');
        $this->form_validation->set_rules('name_form', 'Insert Form Name', 'trim|xss_clean|required|min_length[5]|max_length[50]');
        $this->form_validation->set_rules('type_id', 'Select Type Testcase', 'trim|xss_clean|required');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array('code' => 404, 'message' => validation_errors()));
        } else {
            $update_master_form = $this->mod->updateData('form_ms_tc', array(
                'id_type'       => $type,
                'name_form'     => $name,
                'updated_by'    => $this->session->userdata('authlog')['user_login_id'],
                'updated_at'    => $date
            ), array('id_ms_form' => $id,));
            $lokasi = base_url('testcase/form_list');
            echo json_encode(array('code' => 200, 'aksi' => "window.location.href = '".$lokasi."'"));
        }
        
    }
    
    public function next_form()
    {
        $response = array();
        $name     = $this->input->post('name_form');
        $type     = $this->input->post('type_id');
        $date     = date('Y-m-d h:i:sa');
        $desc     = 'This document was created at '.$date;
        
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<span class="text-white">', '</span>');
        $this->form_validation->set_rules('name_form', 'Insert Form Name', 'trim|xss_clean|required|min_length[5]|max_length[50]');
        $this->form_validation->set_rules('type_id', 'Select Type Testcase', 'trim|xss_clean|required');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array('code' => 404, 'message' => validation_errors()));
        } else {
            $id = $this->mod->autoNumber('id_ms_form','form_ms_tc',date('Y'),2);
            $insert_master_form = $this->mod->insertData('form_ms_tc', array(
                'id_ms_form'    => $id,
                'id_type'       => $type,
                'name_form'     => $name,
                'description'   => $desc,
                'created_by'    => $this->session->userdata('authlog')['user_login_id'],
                'created_at'    => $date
            ));
            $next_id = base64_encode($id); 
            $lokasi = base_url('testcase/detail_form/'.$next_id);
            echo json_encode(array('code' => 200, 'aksi' => "window.location.href = '".$lokasi."'"));
        }

    }

    public function detail_form($id = null)
    {
        $cek = check_id_form(base64_decode($id));
        if ($cek != FALSE) {
        $data = array(
            '_CSS' => generate_CSS(array(
                'vendor/datatables/media/css/dataTables.bootstrap4.css'                
                )
            ),
			'_JS' => generate_js(array(
                'vendor/datatables/media/js/jquery.dataTables.min.js',
                'vendor/datatables/media/js/dataTables.bootstrap4.min.js',
                'vendor/jquery-validation/jquery.validate.js',
                'js/pages/detail-form-script.js'
				)
			),
			'titleWeb' 	=> 'Detail | Document Form Testcase',
            'breadcrumb'=> explode(',', 'Form Testcase, Detail'),
            'id_ms_form'=> $id,
            'dtDetail'  => $this->mod->getData('result','*','form_dt_tc',null,null,null,array('id_ms_form'=>base64_decode($id), 'parent_id'=>'null'),null,array('tc_id'=>'ASC')),
        );
        $this->render('dashboard_template', 'pages/form/detail_list', $data);
        }else{
            echo 'access forbidden ! <a href="'.base_url().'"> Back To Dashboard </a>';
        }
    }

    public function modalAdd_detail(){
        $ID = $this->input->post('id');
		$data = array(
                'modalTitle' => 'Add New Testcase',
                'formAction' => base_url('testcase/do_save_detail'),
                'dMaster'    => ["id_ms_form"=>$ID],
				'Req' => ''
			);
		$this->load->view('pages/form/modal_form_detail', $data);
    }

    public function do_save_detail()
    {
        $response = array();   
        // Recieving post input of email, password from request
        $name     = $this->input->post('testcase_name');
        $parent   = $this->input->post('parent_id');
        $date     = date('Y-m-d h:i:sa');
        $desc     = $this->input->post('description');
        
        #Login input validation\
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<span class="text-white">', '</span>');
        $this->form_validation->set_rules('testcase_name[]', 'Testcase Name', 'trim|xss_clean|required|min_length[2]|max_length[50]');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array('code' => 404, 'message' => validation_errors()));
        } else {
            $index = 0;
            $type = get_type_form(base64_decode($this->input->post('id_ms_form')));
            $nm = count($name);
            for ($i = 0; $i < $nm; $i++) {
                $id_detail = $this->mod->autoNumber('id_dt_form','form_dt_tc',date('y'),3);
                $tc_id = $this->mod->autoNumber('tc_id','form_dt_tc','1',3);
                $insertdata = $this->mod->insertData('form_dt_tc',array(
                    'id_dt_form'	=> $id_detail,
                    'id_ms_form'	=> base64_decode($this->input->post('id_ms_form')),
                    'id_type' 		=> $type,
                    'parent_id'		=> $parent,
                    'tc_id' 		=> $tc_id,
                    'tc_name'	    => $name[$i],
                    'description'	=> $desc[$i],
                    'created_by'    => $this->session->userdata('authlog')['user_login_id'],
                    'created_at'	=> $date
                    )
                );
            }

            if ($insertdata){//jika bernilai true
				$this->alert->set('success', "Insert success !");
                echo json_encode(array('code' => 200, 'message' => 'Insert new testcase success !'));
       		}else{
       			echo json_encode(array('code' => 500, 'message' => 'An error occurred while saving data !'));
       		}
            
        }
        
    }

    public function modalEdit_detail(){
        $ID = explode('~',$this->input->post('id'));
		$data = array(
                'modalTitle' => 'Edit '.$ID[1],
                'formAction' => base_url('testcase/do_edit_detail'),
                'dMaster'    => $this->mod->getData('row','*','form_dt_tc',null,null,null,array('id_dt_form'=>base64_decode($ID[0]))),
				'Req' => ''
            );
        //echo json_encode($data);
		$this->load->view('pages/form/modal_form_detail', $data);
    }

    public function do_edit_detail()
    {
        $response = array();   
        $id       = $this->input->post('id_dt_form');
        $name     = $this->input->post('testcase_name');
        $parent   = $this->input->post('parent_id');
        $date     = date('Y-m-d h:i:sa');
        $desc     = $this->input->post('description');
        
        #Login input validation\
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<span class="text-white">', '</span>');
        $this->form_validation->set_rules('testcase_name[]', 'Testcase Name', 'trim|xss_clean|required|min_length[2]|max_length[50]');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array('code' => 404, 'message' => validation_errors()));
        } else {
            $index = 0;
            $type = get_type_form(base64_decode($this->input->post('id_ms_form')));
            $nm = count($name);
            for ($i = 0; $i < $nm; $i++) {
                $updatedata = $this->mod->updateData('form_dt_tc',array(
                    'parent_id'	    => $parent,
                    'tc_name'	    => $name[$i],
                    'description'	=> $desc[$i],
                    'updated_by'    => $this->session->userdata('authlog')['user_login_id'],
                    'updated_at'	=> $date
                    ), array('id_dt_form'=>base64_decode($id))
                );
            }

            if ($updatedata){//jika bernilai true
				$this->alert->set('success', "Update success !");
                echo json_encode(array('code' => 200, 'message' => 'Update testcase success !'));
       		}else{
       			echo json_encode(array('code' => 500, 'message' => 'An error occurred while saving data !'));
       		}
            
        }
        
    }

    public function modalDelete_detail(){
        $ID = explode('~',$this->input->post('id'));
		$data = array(
                'modalTitle' => 'Delete '.$ID[1],
                'id'         => $ID[0],
				'formAction' => base_url('testcase/do_delete_detail'),
				'Req' => ''
			);
		$this->load->view('pages/form/modal_confirm', $data);
    }

    public function do_delete_detail(){
        $get_id = $this->mod->getData('row','tc_id','form_dt_tc',null,null,null,array('id_dt_form'=>base64_decode($this->input->post('id'))));
        $delete_transdetil = $this->mod->deleteData('trans_dt_tc', array('tc_id' => $get_id->tc_id));
        $query 	= $this->mod->deleteData('form_dt_tc', array('id_dt_form' => base64_decode($this->input->post('id'))));        
		if ($query){
            $this->alert->set('success', "Delete success !");
            echo json_encode(array('code' => 200, 'message' => 'Delete success !'));
        }else{
            echo json_encode(array('code' => 500, 'message' => 'An error occurred while deleting data !'));
        }
		
	}

    public function modalDelete_form(){
        $ID = explode('~',$this->input->post('id'));
		$data = array(
                'modalTitle' => 'Delete '.$ID[1],
                'id'         => $ID[0],
				'formAction' => base_url('testcase/do_delete_form'),
				'Req' => ''
			);
		$this->load->view('pages/form/modal_confirm', $data);
    }
    
    public function do_delete_form(){
        $delete_detail = $this->mod->deleteData('form_dt_tc', array('id_ms_form' => base64_decode($this->input->post('id'))));
        $query 	= $this->mod->deleteData('form_ms_tc', array('id_ms_form' => base64_decode($this->input->post('id'))));        
		if ($query){
            $this->alert->set('success', "Delete success !");
            echo json_encode(array('code' => 200, 'message' => 'Delete success !'));
        }else{
            echo json_encode(array('code' => 500, 'message' => 'An error occurred while deleting data !'));
        }
		
    }
    
    

}

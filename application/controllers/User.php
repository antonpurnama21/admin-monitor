<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH."controllers/CommonDash.php");

class User extends CommonDash {

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
                'js/pages/index-user-script.js',
                'vendor/jquery-validation/jquery.validate.js',
                'vendor/datatables/media/js/jquery.dataTables.min.js',
                'vendor/datatables/media/js/dataTables.bootstrap4.min.js',
				)
			),
			'titleWeb' 	=> 'List | User list',
			'breadcrumb'=> explode(',', 'Dashboard, List user'),
        );
        /** Generate Tabel */
        /** Set Heading Tabel */
        $this->table->set_heading(
            array('data' => 'NO', 'width' => '5%'), 
            array('data' => 'ID User', 'width' => '5%'), 
            array('data' => 'Email', 'width' => '30%'),
            array('data' => 'Firstname', 'width' => '20%'),
            array('data' => 'Lastname', 'width' => '20%'),
            array('data' => 'Role Access', 'width' => '10%'), 
            array('data' => 'Action', 'width' => '10%')
        );

        /** Get Data dari database */
        $dtMaster = $this->mod->getData('result','*','users');
        /** Kondisi jika hasil feedback dari database tidak kosong */
        if (!empty($dtMaster)) {
            $no = 0;
            /** Perulangan data */
                foreach ($dtMaster as $key) {
                    $no++;
                    /** Atribut untuk Kolom Aksi */
                    $link = base_url('user/modalEdit');
                    $link_delete = base_url('user/modalDelete');
                    $param = base64_encode($key->id_user).'~'.$key->firstname;

                    /** Button Aksi */
                    $action = '<a class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" title="Edit" onclick="showModal(\''.$link.'\',\''.$param.'\',\'edit\');"><i class="icon-pencil"></i></a> <a class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" title="Delete" onclick="showModal(\''.$link_delete.'\',\''.$param.'\',\'edit\');"><i class="icon-trash"></i></a>';
                    
                    /** Set Row Tabel */
                    $this->table->add_row(
                        array('data'=> $no), 
                        array('data'=> $key->id_user), 
                        array('data'=> $key->email),
                        array('data'=> $key->firstname),
                        array('data'=> $key->lastname),
                        array('data'=> role_name($key->id_role)),/** role_name dari auth_helper */
                        array('data'=> $action,'class'=>'text-center')
                    );
                }
            }else{
                /** Row jika hasil feedback dari database kosong */
                $row_empty = array('data'=> 'Data Empty !', 'colspan'=>4);
                $this->table->add_row($row_empty);
            }
		$this->render('dashboard_template', 'pages/user/index', $data);
    }

    public function modalAdd(){
		$data = array(
                'modalTitle' => 'Add New User',
                'formAction' => base_url('user/do_save'),
				'Req' => ''
			);
		$this->load->view('pages/user/modal_form', $data);
    }

    public function do_save()
    {
        $response = array();
        $email          = $this->input->post('v_email');
        $pass           = sha1($this->input->post('v_email'));
        $firstname      = $this->input->post('v_firstname');
        $lastname       = $this->input->post('v_lastname');
        $role           = $this->input->post('v_id_role');
        $date           = date('Y-m-d h:i:sa');
        
        #Login input validation\
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<span class="text-white">', '</span>');
        $this->form_validation->set_rules('v_email', 'Email', 'trim|xss_clean|valid_email|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('v_email', 'Password', 'trim|xss_clean|required|min_length[5]|max_length[50]');
        $this->form_validation->set_rules('v_firstname', 'Firstname', 'trim|xss_clean|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('v_lastname', 'Lastname', 'trim|xss_clean|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('v_id_role', 'role', 'trim|xss_clean|required');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array('code' => 404, 'message' => validation_errors()));
        } else {
            $cek_email = $this->mod->checkData('email','users',array('email = "'.$email.'"'));
            if ($cek_email == TRUE) {
                echo json_encode(array('code' => 366, 'message' => 'user email already available!!'));
            }else{
                $insertdata = $this->mod->insertData('users',array(
                    'id_user'	    => $this->mod->autoNumber('id_user','users','usr_',2),
                    'email'	        => $email,
                    'password'      => $pass,
                    'firstname'     => $firstname,
                    'lastname'      => $lastname,
                    'id_role' 		=> $role,
                    'created_by'    => $this->session->userdata('authlog')['user_login_id'],
                    'created_at'	=> $date
                    )
                );

                if ($insertdata){//jika bernilai true
                    $this->alert->set('success', "Insert success !");
                    echo json_encode(array('code' => 200, 'message' => 'Insert new user success !'));
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
                'formAction' => base_url('user/do_edit'),
                'dMaster'    => $this->mod->getData('row','*','users',null,null,null,array('id_user'=>base64_decode($ID[0]))),
				'Req' => ''
            );
        //echo json_encode($data);
		$this->load->view('pages/user/modal_form', $data);
    }

    public function do_edit()
    {
        $response = array();
        $email          = $this->input->post('v_email');
        $pass           = sha1($this->input->post('v_password'));
        $firstname      = $this->input->post('v_firstname');
        $lastname       = $this->input->post('v_lastname');
        $role           = $this->input->post('v_id_role');
        $date           = date('Y-m-d h:i:sa');
        
        #Login input validation\
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<span class="text-white">', '</span>');
        $this->form_validation->set_rules('v_email', 'Email', 'trim|xss_clean|valid_email|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('v_password', 'Password', 'trim|xss_clean|required|min_length[5]|max_length[50]');
        $this->form_validation->set_rules('v_firstname', 'Firstname', 'trim|xss_clean|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('v_lastname', 'Lastname', 'trim|xss_clean|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('v_id_role', 'role', 'trim|xss_clean|required');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array('code' => 404, 'message' => validation_errors()));
        } else {
            $cek_email = $this->mod->checkData('email','users',array('email = "'.$email.'"','id_user != "'.base64_decode($this->input->post('v_id_user')).'"'));
            if ($cek_email == TRUE) {
                echo json_encode(array('code' => 366, 'message' => 'user email already available!!'));
            }else{
                $updatedata = $this->mod->updateData('users',array(
                    'email'	        => $email,
                    'password'      => $pass,
                    'firstname'     => $firstname,
                    'lastname'      => $lastname,
                    'id_role' 		=> $role,
                    'updated_by'    => $this->session->userdata('authlog')['user_login_id'],
                    'updated_at'	=> $date
                    ), array('id_user'=>base64_decode($this->input->post('v_id_user')))
                );

                if ($updatedata){//jika bernilai true
                    $this->alert->set('success', "Update success !");
                    echo json_encode(array('code' => 200, 'message' => 'Update user success !'));
                }else{
                    echo json_encode(array('code' => 500, 'message' => 'An error occurred while saving data !'));
                }
            }
            
        }
        
    }

    public function modalDelete(){
        $ID = explode('~',$this->input->post('id'));
		$data = array(
                'modalTitle' => 'Delete User '.$ID[1],
                'id'         => $ID[0],
				'formAction' => base_url('user/do_delete'),
				'Req' => ''
			);
		$this->load->view('pages/user/modal_confirm', $data);
    }
    
    public function do_delete(){
        $query 	= $this->mod->deleteData('users', array('id_user' => base64_decode($this->input->post('id'))));        
		if ($query){
            $this->alert->set('success', "Delete success !");
            echo json_encode(array('code' => 200, 'message' => 'Delete success !'));
        }else{
            echo json_encode(array('code' => 500, 'message' => 'An error occurred while deleting data !'));
        }
		
    }

}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH."controllers/CommonDash.php");

class Role extends CommonDash {

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
                'js/pages/index-role-script.js',
                'vendor/jquery-validation/jquery.validate.js',
                'vendor/datatables/media/js/jquery.dataTables.min.js',
                'vendor/datatables/media/js/dataTables.bootstrap4.min.js',
				)
			),
			'titleWeb' 	=> 'List | Role Access',
			'breadcrumb'=> explode(',', 'Dashboard, List role'),
        );
        /** Generate Tabel */
        /** Set Heading Tabel */
        $this->table->set_heading(
            array('data' => 'NO', 'width' => '5%'), 
            array('data' => 'ID Role', 'width' => '10%'), 
            array('data' => 'Role Name', 'width' => '70%'), 
            array('data' => 'Action', 'width' => '15%')
        );

        /** Get Data dari database */
        $dtMaster = $this->mod->getData('result','*','role_access');
        /** Kondisi jika hasil feedback dari database tidak kosong */
        if (!empty($dtMaster)) {
            $no = 0;
            /** Perulangan data */
                foreach ($dtMaster as $key) {
                    $no++;
                    /** Atribut untuk Kolom Aksi */
                    $link = base_url('role/modalEdit');
                    $link_delete = base_url('role/modalDelete');
                    $param = base64_encode($key->id_role).'~'.$key->role;
                    /** Button Aksi */
                    $action = '<a class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" title="Edit" onclick="showModal(\''.$link.'\',\''.$param.'\',\'edit\');"><i class="icon-pencil"></i></a> <a class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" title="Delete" onclick="showModal(\''.$link_delete.'\',\''.$param.'\',\'edit\');"><i class="icon-trash"></i></a>';
                    
                    /** Set Row Tabel */
                    $this->table->add_row(
                        array('data'=> $no), 
                        array('data'=> $key->id_role), 
                        array('data'=> $key->role),
                        array('data'=> $action,'class'=>'text-center')
                    );
                }
            }else{
                /** Row jika hasil feedback dari database kosong */
                $row_empty = array('data'=> 'Data Empty !', 'colspan'=>4);
                $this->table->add_row($row_empty);
            }

		$this->render('dashboard_template', 'pages/role/index', $data);
    }

    public function modalAdd(){
		$data = array(
                'modalTitle' => 'Add New Role',
                'formAction' => base_url('role/do_save'),
				'Req' => ''
			);
		$this->load->view('pages/role/modal_form', $data);
    }

    public function do_save()
    {
        $response = array();
        $name     = $this->input->post('v_role');
        $date     = date('Y-m-d h:i:sa');
        
        #Login input validation\
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<span class="text-white">', '</span>');
        $this->form_validation->set_rules('v_role', 'Role Name', 'trim|xss_clean|required|min_length[2]|max_length[50]');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array('code' => 404, 'message' => validation_errors()));
        } else {
            $cek_name = $this->mod->checkData('role','role_access',array('role = "'.$name.'"'));
            if ($cek_name == TRUE) {
                echo json_encode(array('code' => 366, 'message' => 'Role Name already available!!'));
            }else{
                $insertdata = $this->mod->insertData('role_access',array(
                    'id_role'	    => $this->mod->autoNumber('id_role','role_access','r',1),
                    'role'	        => $name,
                    'created_by'    => $this->session->userdata('authlog')['user_login_id'],
                    'created_at'	=> $date
                    )
                );

                if ($insertdata){//jika bernilai true
                    $this->alert->set('success', "Insert success !");
                    echo json_encode(array('code' => 200, 'message' => 'Insert new role success !'));
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
                'formAction' => base_url('role/do_edit'),
                'dMaster'    => $this->mod->getData('row','*','role_access',null,null,null,array('id_role'=>base64_decode($ID[0]))),
				'Req' => ''
            );
        //echo json_encode($data);
		$this->load->view('pages/role/modal_form', $data);
    }

    public function do_edit()
    {
        $response = array();
        $name     = $this->input->post('v_role');
        $date     = date('Y-m-d h:i:sa');
        
        #Login input validation\
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<span class="text-white">', '</span>');
        $this->form_validation->set_rules('v_role', 'Role Name', 'trim|xss_clean|required|min_length[2]|max_length[50]');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array('code' => 404, 'message' => validation_errors()));
        } else {
            $cek_name = $this->mod->checkData('role','role_access',array('role = "'.$name.'"','id_role != "'.base64_decode($this->input->post('id_role')).'"'));
            if ($cek_name == TRUE) {
                echo json_encode(array('code' => 366, 'message' => 'Role Name already available!!'));
            }else{
                $updatedata = $this->mod->updateData('role_access',array(
                    'role'	        => $name,
                    'updated_by'    => $this->session->userdata('authlog')['user_login_id'],
                    'updated_at'	=> $date
                    ), array('id_role'=>base64_decode($this->input->post('v_id_role')))
                );

                if ($updatedata){//jika bernilai true
                    $this->alert->set('success', "Update success !");
                    echo json_encode(array('code' => 200, 'message' => 'Update role success !'));
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
				'formAction' => base_url('role/do_delete'),
				'Req' => ''
			);
		$this->load->view('pages/role/modal_confirm', $data);
    }
    
    public function do_delete(){
        $query 	= $this->mod->deleteData('role_access', array('id_role' => base64_decode($this->input->post('id'))));        
		if ($query){
            $this->alert->set('success', "Delete success !");
            echo json_encode(array('code' => 200, 'message' => 'Delete success !'));
        }else{
            echo json_encode(array('code' => 500, 'message' => 'An error occurred while deleting data !'));
        }
		
    }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH."controllers/CommonDash.php");

class TypeCase extends CommonDash {

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
                'js/pages/index-type-script.js',
                'vendor/jquery-validation/jquery.validate.js',
                'vendor/datatables/media/js/jquery.dataTables.min.js',
                'vendor/datatables/media/js/dataTables.bootstrap4.min.js',
				)
			),
			'titleWeb' 	=> 'List | Type Testcase',
			'breadcrumb'=> explode(',', 'Dashboard, List type'),
        );
        /** Generate Tabel */
        /** Set Heading Tabel */
        $this->table->set_heading(
            array('data' => 'NO', 'width' => '5%'), 
            array('data' => 'ID Type', 'width' => '10%'), 
            array('data' => 'Type Name', 'width' => '70%'), 
            array('data' => 'Action', 'width' => '15%')
        );

        /** Get Data dari database */
        $dtMaster = $this->mod->getData('result','*','type_tc');
        /** Kondisi jika hasil feedback dari database tidak kosong */
        if (!empty($dtMaster)) {
            $no = 0;
            /** Perulangan data */
                foreach ($dtMaster as $key) {
                    $no++;
                    /** Atribut untuk Kolom Aksi */
                    $link = base_url('typecase/modalEdit');
                    $link_delete = base_url('typecase/modalDelete');
                    $param = base64_encode($key->id_type).'~'.$key->name_type;
                    /** Button Aksi */
                    $action = '<a class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" title="Edit" onclick="showModal(\''.$link.'\',\''.$param.'\',\'edit\');"><i class="icon-pencil"></i></a> <a class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" title="Delete" onclick="showModal(\''.$link_delete.'\',\''.$param.'\',\'edit\');"><i class="icon-trash"></i></a>';
                    
                    /** Set Row Tabel */
                    $this->table->add_row(
                        array('data'=> $no), 
                        array('data'=> $key->id_type), 
                        array('data'=> $key->name_type),
                        array('data'=> $action,'class'=>'text-center')
                    );
                }
            }else{
                /** Row jika hasil feedback dari database kosong */
                $row_empty = array('data'=> 'Data Empty !', 'colspan'=>4);
                $this->table->add_row($row_empty);
            }
		$this->render('dashboard_template', 'pages/type/index', $data);
    }

    public function modalAdd(){
		$data = array(
                'modalTitle' => 'Add New Type',
                'formAction' => base_url('typecase/do_save'),
				'Req' => ''
			);
		$this->load->view('pages/type/modal_form', $data);
    }

    public function do_save()
    {
        $response = array();
        $name     = $this->input->post('v_name_type');
        $date     = date('Y-m-d h:i:sa');
        
        #Login input validation\
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<span class="text-white">', '</span>');
        $this->form_validation->set_rules('v_name_type', 'Type Name', 'trim|xss_clean|required|min_length[2]|max_length[50]');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array('code' => 404, 'message' => validation_errors()));
        } else {
            $cek_name = $this->mod->checkData('name_type','type_tc',array('name_type = "'.$name.'"'));
            if ($cek_name == TRUE) {
                echo json_encode(array('code' => 366, 'message' => 'Type Name already available!!'));
            }else{
                $insertdata = $this->mod->insertData('type_tc',array(
                    'id_type'	    => $this->mod->autoNumber('id_type','type_tc','1',1),
                    'name_type'	    => $name,
                    'created_by'    => $this->session->userdata('authlog')['user_login_id'],
                    'created_at'	=> $date
                    )
                );

                if ($insertdata){//jika bernilai true
                    $this->alert->set('success', "Insert success !");
                    echo json_encode(array('code' => 200, 'message' => 'Insert new type success !'));
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
                'formAction' => base_url('typecase/do_edit'),
                'dMaster'    => $this->mod->getData('row','*','type_tc',null,null,null,array('id_type'=>base64_decode($ID[0]))),
				'Req' => ''
            );
        //echo json_encode($data);
		$this->load->view('pages/type/modal_form', $data);
    }

    public function do_edit()
    {
        $response = array();
        $name     = $this->input->post('v_name_type');
        $date     = date('Y-m-d h:i:sa');
        
        #Login input validation\
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<span class="text-white">', '</span>');
        $this->form_validation->set_rules('v_name_type', 'Type Name', 'trim|xss_clean|required|min_length[2]|max_length[50]');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array('code' => 404, 'message' => validation_errors()));
        } else {
            $cek_name = $this->mod->checkData('name_type','type_tc',array('name_type = "'.$name.'"','id_type != "'.base64_decode($this->input->post('id_type')).'"'));
            if ($cek_name == TRUE) {
                echo json_encode(array('code' => 366, 'message' => 'Type Name already available!!'));
            }else{
                $updatedata = $this->mod->updateData('type_tc',array(
                    'name_type'	    => $name,
                    'updated_by'    => $this->session->userdata('authlog')['user_login_id'],
                    'updated_at'	=> $date
                    ), array('id_type'=>base64_decode($this->input->post('v_id_type')))
                );

                if ($updatedata){//jika bernilai true
                    $this->alert->set('success', "Update success !");
                    echo json_encode(array('code' => 200, 'message' => 'Update type success !'));
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
				'formAction' => base_url('typecase/do_delete'),
				'Req' => ''
			);
		$this->load->view('pages/type/modal_confirm', $data);
    }
    
    public function do_delete(){
        $query 	= $this->mod->deleteData('type_tc', array('id_type' => base64_decode($this->input->post('id'))));        
		if ($query){
            $this->alert->set('success', "Delete success !");
            echo json_encode(array('code' => 200, 'message' => 'Delete success !'));
        }else{
            echo json_encode(array('code' => 500, 'message' => 'An error occurred while deleting data !'));
        }
		
    }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH."controllers/CommonDash.php");

class Device extends CommonDash {

	public function __construct()
	{
        parent::__construct();
        
	}

    /** Function index = untuk melihat daftar list Device */
    public function index()
	{
        /** untuk load assets yang dibutuhkan */
        $data = array(
            /** load CSS */
            '_CSS' => generate_CSS(array(
                'vendor/datatables/media/css/dataTables.bootstrap4.css'                
                )
            ),
            /** load JS */
			'_JS' => generate_js(array(
                'js/pages/index-device-script.js',
                'vendor/jquery-validation/jquery.validate.js',
                'vendor/datatables/media/js/jquery.dataTables.min.js',
                'vendor/datatables/media/js/dataTables.bootstrap4.min.js',
				)
            ),
            /** atribut identitas halaman */
			'titleWeb' 	=> 'List | Device Form Testcase',
			'breadcrumb'=> explode(',', 'Dashboard, List Device'),
        );

        /** Generate Tabel */
        /** Set Heading Tabel */
        $this->table->set_heading(
            array('data' => 'NO', 'width' => '5%'), 
            array('data' => 'ID Device', 'width' => '10%'), 
            array('data' => 'Device Name', 'width' => '50%'), 
            array('data' => 'Type', 'width' => '20%'), 
            array('data' => 'Action', 'width' => '15%')
        );

        /** Get Data dari database */
        $dMaster = $this->mod->getData('result','*','device_tc');
        /** Kondisi jika hasil feedback dari database tidak kosong */
        if (!empty($dMaster)) {
            $no = 0;
            /** Perulangan data */
                foreach ($dMaster as $key) {
                    $no++;
                    /** Atribut untuk Kolom Aksi */
                    $link = base_url('device/modalEdit');
                    $link_delete = base_url('device/modalDelete');
                    $param = base64_encode($key->id_device).'~'.$key->device_name;
                    /** Button Aksi */
                    $action = '<a class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" title="Edit" onclick="showModal(\''.$link.'\',\''.$param.'\',\'edit\');"><i class="icon-pencil"></i></a> <a class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" title="Delete" onclick="showModal(\''.$link_delete.'\',\''.$param.'\',\'edit\');"><i class="icon-trash"></i></a>';
                    
                    /** Set Row Tabel */
                    $this->table->add_row(
                        array('data'=> $no), 
                        array('data'=> $key->id_device), 
                        array('data'=> $key->device_name), 
                        array('data'=> name_type($key->id_type)),/** name_type function dari any_helper */
                        array('data'=> $action,'class'=>'text-center')
                    );
                }
            }else{
                /** Row jika hasil feedback dari database kosong */
                $row_empty = array('data'=> 'Data Empty !', 'colspan'=>5);
                $this->table->add_row($row_empty);
            }

		/** Menuju library template untuk load view */
	    $this->render('dashboard_template', 'pages/device/index', $data);
    }

    /** Function ModalAdd = untuk menampilkan Modal Tambah Data */
    public function modalAdd(){
        /** atribut identitas modal */
		$data = array(
                'modalTitle' => 'Add New Device',
                'formAction' => base_url('device/do_save'),
				'Req' => ''
            );
        /** load view untuk modal */
		$this->load->view('pages/device/modal_form', $data);
    }

    /** Function do_save = untuk aksi menambahkan data */
    public function do_save()
    {   
        /** Initializing Post to variable */
        $name     = $this->input->post('v_device_name');
        $type     = $this->input->post('v_id_type');
        $date     = date('Y-m-d h:i:sa');

        /** Library Form Validation */
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<span class="text-white">', '</span>');
        $this->form_validation->set_rules('v_device_name', 'Device Name', 'trim|xss_clean|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('v_id_type', 'Type', 'trim|xss_clean|required');

        /** Jika Validation bernilai FALSE */
        if ($this->form_validation->run() == FALSE) {
            /** print validation error */
            echo json_encode(array('code' => 404, 'message' => validation_errors()));
        } else {/** Jika Bernilai TRUE */
            /** cek data device */
            $cek_name = $this->mod->checkData('device_name','device_tc',array('device_name = "'.$name.'"'));
            /** jika bernilai True */
            if ($cek_name == TRUE) {
                /** print pesan error */
                echo json_encode(array('code' => 366, 'message' => 'Device Name already available!!'));
            }else{
                /** Insert Data untuk device */
                $insertdata = $this->mod->insertData('device_tc',array(
                    'id_device'	    => $this->mod->autoNumber('id_device','device_tc','1',2), /** autoNumber untuk generate id Otomatis */
                    'id_type' 		=> $type,
                    'device_name'	=> $name,
                    'created_by'    => $this->session->userdata('authlog')['user_login_id'], /** Session user_login_id */
                    'created_at'	=> $date
                    )
                );
                /** jika insert berhasil */
                if ($insertdata){
                    /** print alert sukses */
                    $this->alert->set('success', "Insert success !");
                    echo json_encode(array('code' => 200, 'message' => 'Insert new device success !'));
                }else{
                    /** print alert gagal */
                    echo json_encode(array('code' => 500, 'message' => 'An error occurred while saving data !'));
                }
            }
        }
        
    }

    /** Function modalEdit = untuk menampilkan modal edit data  */
    public function modalEdit(){
        /** array post id */
        $ID = explode('~',$this->input->post('id'));
        /** atribut modal edit */
        $data = array(
                'modalTitle' => 'Edit '.$ID[1],
                'formAction' => base_url('device/do_edit'),
                'dMaster'    => $this->mod->getData('row','*','device_tc',null,null,null,array('id_device'=>base64_decode($ID[0]))),
				'Req' => ''
            );
        /** load view modal */
		$this->load->view('pages/device/modal_form', $data);
    }
    /** Function do_edit = untuk aksi edit data */
    public function do_edit()
    {
        /** Initializing Post to variable */
        $name     = $this->input->post('v_device_name');
        $type     = $this->input->post('v_id_type');
        $date     = date('Y-m-d h:i:sa');
        /** Library Form Validation */
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<span class="text-white">', '</span>');
        $this->form_validation->set_rules('v_device_name', 'Device Name', 'trim|xss_clean|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('v_id_type', 'Type', 'trim|xss_clean|required');
        /** Jika Validation bernilai FALSE */
        if ($this->form_validation->run() == FALSE) {
            /** print validation error */
            echo json_encode(array('code' => 404, 'message' => validation_errors()));
        } else {/** Jika Bernilai TRUE */
            /** cek data device */
            $cek_name = $this->mod->checkData('device_name','device_tc',array('device_name = "'.$name.'"','id_device != "'.base64_decode            ($this->input->post('id_device')).'"'));
            /** jika bernilai True */
            if ($cek_name == TRUE) {
                /** print pesan error */
                echo json_encode(array('code' => 366, 'message' => 'Device Name already available!!'));
            }else{
                /** Update Data untuk device */
                $updatedata = $this->mod->updateData('device_tc',array(
                    'id_type' 		=> $type,
                    'device_name'	=> $name,
                    'updated_by'    => $this->session->userdata('authlog')['user_login_id'],
                    'updated_at'	=> $date
                    ), array('id_device'=>base64_decode($this->input->post('v_id_device')))
                );
                /** jika Update berhasil */
                if ($updatedata){
                    /** print alert sukses */
                    $this->alert->set('success', "Update success !");
                    echo json_encode(array('code' => 200, 'message' => 'Update Device success !'));
                }else{
                    /** print alert gagal */
                    echo json_encode(array('code' => 500, 'message' => 'An error occurred while saving data !'));
                }
            }
            
        }
        
    }

    /** Function modalDelete = untuk menampilkan modal delete */
    public function modalDelete(){
        /** array post id */
        $ID = explode('~',$this->input->post('id'));
        /** atribut modal delete */
        $data = array(
                'modalTitle' => 'Delete '.$ID[1],
                'id'         => $ID[0],
				'formAction' => base_url('device/do_delete'),
				'Req' => ''
            );
        /** load modal view confirm */
		$this->load->view('pages/device/modal_confirm', $data);
    }
    /** funtion do_delete = untuk aksi delete data */
    public function do_delete(){
        /** delete data */
        $query 	= $this->mod->deleteData('device_tc', array('id_device' => base64_decode($this->input->post('id'))));        
        /** jika delete berhasil */
        if ($query){
            /** print alert sukses */
            $this->alert->set('success', "Delete success !");
            echo json_encode(array('code' => 200, 'message' => 'Delete success !'));
        }else{
            /** print alert gagal */
            echo json_encode(array('code' => 500, 'message' => 'An error occurred while deleting data !'));
        }
		
    }

}

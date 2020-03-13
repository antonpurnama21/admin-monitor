<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH."controllers/CommonDash.php");

class Checker extends CommonDash {

	public function __construct()
	{
        parent::__construct();
        
	}
    
    public function index()
	{
		 echo "Disabled Access!";
	}

    public function checker_list()
	{
		$data = array(
            '_CSS' => generate_CSS(array(
                'vendor/datatables/media/css/dataTables.bootstrap4.css'                
                )
            ),
			'_JS' => generate_js(array(
                'js/pages/index-checker-script.js',
                'vendor/jquery-validation/jquery.validate.js',
                'vendor/datatables/media/js/jquery.dataTables.min.js',
                'vendor/datatables/media/js/dataTables.bootstrap4.min.js',
				)
			),
			'titleWeb' 	=> 'List | Checker Testcase',
			'breadcrumb'=> explode(',', 'Dashboard, List Checker'),
            'data'      => $this->mod->getData('result','*','trans_ms_tc',null,null,null,null,null,array('id_ms_trans'=>'DESC')),
        );
		$this->render('dashboard_template', 'pages/checker/checker_list', $data);
    }

    public function modalAdd_splash(){
		$data = array(
                'modalTitle' => 'Select Test Type For ?',
                'formAction' => base_url('checker/do_splash'),
				'Req' => ''
			);
		$this->load->view('pages/checker/modal_splash', $data);
    }

    public function do_splash()
    {
        $id = $this->input->post('id_type');
        if ($id == 13) {
            $lokasi = base_url('checker/add_checker_stb/'.$id);
            echo json_encode(array('code' => 200, 'aksi' => "window.location.href = '".$lokasi."'"));
        }else{
            $lokasi = base_url('checker/add_checker/'.$id);
            echo json_encode(array('code' => 200, 'aksi' => "window.location.href = '".$lokasi."'"));
        }
    }

    public function add_checker($id_type = null)
	{
        $cek = check_type($id_type);
        if ($cek != FALSE) {
		$data = array(
			'_JS' => generate_js(array(
                'vendor/jquery-validation/jquery.validate.js',
                'js/pages/add-checker-script.js'
				)
			),
			'titleWeb' 	=> 'New | Checker Testcase',
            'breadcrumb'=> explode(',', 'Dashboard, Add Checker'),
            'formAction'=> base_url('checker/do_add_checker'),
            'id_type'   => $id_type
		);
        $this->render('dashboard_template', 'pages/checker/add_checker', $data);
        }else{
            echo 'access forbidden ! <a href="'.base_url().'"> Back To Dashboard </a>';
        }
    }

    public function add_checker_stb($id_type = null)
	{
        $cek = check_type($id_type);
        if ($cek != FALSE) {
		$data = array(
			'_JS' => generate_js(array(
                'vendor/jquery-validation/jquery.validate.js',
                'js/pages/add-checker-script.js',
				)
			),
			'titleWeb' 	=> 'New | Checker Testcase',
            'breadcrumb'=> explode(',', 'Dashboard, Add Checker'),
            'formAction'=> base_url('checker/do_add_checker'),
            'id_type'   => $id_type
		);
        $this->render('dashboard_template', 'pages/checker/add_checker_stb', $data);
        }else{
            echo 'access forbidden ! <a href="'.base_url().'"> Back To Dashboard </a>';
        }
    }

    public function do_add_checker()
    {
        $response = array();
        $project_name       = $this->input->post('project_name');
        $id_ms_form         = $this->input->post('id_ms_form');
        $device_or_version  = $this->input->post('device_or_version');
        $apk_version        = $this->input->post('apk_version');
        $android_version    = $this->input->post('android_version');
        $date_test          = $this->input->post('date_test');
        $esti_day           = $this->input->post('day_estimate');
        $modification       = $this->input->post('modification');
        $pic                = $this->input->post('pic');
        $developed_by       = $this->input->post('developed_by');
        $date               = date('Y-m-d h:i:sa');

        $start_date         = !empty($esti_day) ? date_format(date_create($date_test), 'Y-m-d') : '';
        $end_date           = !empty($esti_day) ? date('Y-m-d', strtotime($date_test. ' + '.$esti_day.' days')) : '';
        
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<span class="text-white">', '</span>');
        $this->form_validation->set_rules('project_name', 'Insert Project Name', 'trim|xss_clean|required|min_length[5]|max_length[50]');
        $this->form_validation->set_rules('pic', 'Insert Pic Name', 'trim|xss_clean|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('id_ms_form', 'Select Form Testcase', 'trim|xss_clean|required');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array('code' => 404, 'message' => validation_errors()));
        } else {
            $cek_name = $this->mod->checkData('project_name','trans_ms_tc',array('project_name = "'.$project_name.'"'));
            if ($cek_name == TRUE) {
                echo json_encode(array('code' => 366, 'message' => 'Project Name already available!!'));
            }else{
                $id = $this->mod->autoNumber('id_ms_trans','trans_ms_tc','101',2);
                $insert_master_form = $this->mod->insertData('trans_ms_tc', array(
                    'id_ms_trans'           => $id,
                    'id_ms_form'            => $id_ms_form,
                    'project_name'          => $project_name,
                    'date'                  => (!empty($date_test) ? date_format(date_create($date_test), 'Y-m-d') : ''),
                    'estimated_day'         => $esti_day,
                    'start_date'            => $start_date,
                    'end_date'              => $end_date,
                    'device_or_version'     => $device_or_version,
                    'apk_version'           => $apk_version,
                    'android_version'       => $android_version,
                    'modification'          => $modification,
                    'pic'                   => $pic,
                    'developed_by'          => $developed_by,
                    'created_by'            => $this->session->userdata('authlog')['user_login_id'],
                    'created_at'            => $date
                )); 
                $lokasi = base_url('checker/checker_list');
                echo json_encode(array('code' => 200, 'aksi' => "window.location.href = '".$lokasi."'"));
            }
        }

    }

    public function modalEdit(){
        $ID = explode('~',$this->input->post('id'));
        $id_form = $this->mod->getData('row','id_ms_form','trans_ms_tc',null,null,null,array('id_ms_trans'=>base64_decode($ID[0])));
        $cek = get_type_form($id_form->id_ms_form);
		$data = array(
                'modalTitle' => 'Edit '.$ID[1],
                'formAction' => base_url('checker/do_edit_checker'),
                'dMaster'    => $this->mod->getData('row','*','trans_ms_tc',null,null,null,array('id_ms_trans'=>base64_decode($ID[0]))),
                'id_type'    => $cek,
				'Req' => ''
            );
        if ($cek != 13 ) {
            $this->load->view('pages/checker/modal_checker', $data);    
        }else{
            $this->load->view('pages/checker/modal_checker_stb', $data);
        }
    }

    public function do_edit_checker()
    {
        $response = array();
        $project_name       = $this->input->post('project_name');
        $id_ms_form         = $this->input->post('id_ms_form');
        $device_or_version  = $this->input->post('device_or_version');
        $apk_version        = $this->input->post('apk_version');
        $android_version    = $this->input->post('android_version');
        $date_test          = $this->input->post('date_test');
        $esti_day           = $this->input->post('day_estimate');
        $modification       = $this->input->post('modification');
        $pic                = $this->input->post('pic');
        $developed_by       = $this->input->post('developed_by');
        $date               = date('Y-m-d h:i:sa');

        $start_date         = !empty($esti_day) ? date_format(date_create($date_test), 'Y-m-d') : '';
        $end_date           = !empty($esti_day) ? date('Y-m-d', strtotime($date_test. ' + '.$esti_day.' days')) : '';
        
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<span class="text-white">', '</span>');
        $this->form_validation->set_rules('project_name', 'Insert Project Name', 'trim|xss_clean|required|min_length[5]|max_length[50]');
        $this->form_validation->set_rules('pic', 'Insert Pic Name', 'trim|xss_clean|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('id_ms_form', 'Select Form Testcase', 'trim|xss_clean|required');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array('code' => 404, 'message' => validation_errors()));
        } else {
            $cek_name = $this->mod->checkData('project_name','trans_ms_tc',array('project_name = "'.$project_name.'"','id_ms_trans != "'.base64_decode($this->input->post('id_ms_trans')).'"'));
            if ($cek_name == TRUE) {
                echo json_encode(array('code' => 366, 'message' => 'Project Name already available!!'));
            }else{
                $update_master = $this->mod->updateData('trans_ms_tc', array(
                    'id_ms_form'            => $id_ms_form,
                    'project_name'          => $project_name,
                    'date'                  => (!empty($date_test)) ? date_format(date_create($date_test), 'Y-m-d') : '',
                    'estimated_day'         => $esti_day,
                    'start_date'            => $start_date,
                    'end_date'              => $end_date,
                    'device_or_version'     => $device_or_version,
                    'apk_version'           => $apk_version,
                    'android_version'       => $android_version,
                    'modification'          => $modification,
                    'pic'                   => $pic,
                    'developed_by'          => $developed_by,
                    'updated_by'            => $this->session->userdata('authlog')['user_login_id'],
                    'updated_at'            => $date
                ), array('id_ms_trans' => base64_decode($this->input->post('id_ms_trans'))));

                if ($update_master){
                    $this->alert->set('success', "Update Success !");
                    echo json_encode(array('code' => 200, 'message' => 'Update Success !'));
                }else{
                    echo json_encode(array('code' => 500, 'message' => 'An error occurred while saving data !'));
                }
            }
        }       
    }

    public function detail_checker($id = null)
    {
        $id_devis = json_decode($_COOKIE['id_device'], true);
        foreach ($id_devis as $key => $value) {
            $wh[] = 'id_device = "'.$value.'"';
        }

        $where = implode('OR ',$wh);
        $cek = check_id_checker($id);
        if ($cek != FALSE) {
        $get_id_form = $this->mod->getData('row','id_ms_form','trans_ms_tc',null,null,null,array('id_ms_trans'=>$id));
        if (get_type_form($get_id_form->id_ms_form) != 13) {
            $param_set = $this->mod->getData('result','*','param_check',5);
        }else{
            $param_set = $this->mod->getData('result','*','param_check',2,null,null,null,null,array('id'=>'DESC'));
        }
        $data = array(
            '_CSS' => generate_CSS(array(
                'vendor/datatables/media/css/dataTables.bootstrap4.css'                
                )
            ),
			'_JS' => generate_js(array(
                'vendor/jquery-validation/jquery.validate.js',
                'vendor/datatables/media/js/jquery.dataTables.min.js',
                'vendor/datatables/media/js/dataTables.bootstrap4.min.js',
                'js/pages/detail-checker-script.js'
				)
			),
			'titleWeb' 	=> 'Detail | Checker Testcase',
            'breadcrumb'=> explode(',', 'Checker Testcase, Detail'),
            'param'     => $param_set,
            'countD'    => count($id_devis),
            'dtDevice'  => $this->mod->qry('result',"SELECT * FROM device_tc WHERE ".$where),            
            'dtDetail'  => $this->mod->getData('result','*','form_dt_tc',null,null,null,array('id_ms_form'=>$get_id_form->id_ms_form,'parent_id'=>'null'),null,array('tc_id'=>'ASC')),
            'id_ms_trans'=> $id,
            'id_ms_form' => $get_id_form->id_ms_form,
        );
        $this->render('dashboard_template', 'pages/checker/detail_checker', $data);
        }else{
            echo 'access forbidden ! <a href="'.base_url().'"> Back To Dashboard </a>';
        }
    }

    public function do_check()
    {
        $tc_id = $this->input->post('tc_id');
        $id_device = $this->input->post('id_device');
        $param = $this->input->post('param_cek');

        $update_data = $this->mod->updateData('trans_dt_tc', array(
            'value'       => $param,
            'updated_at'  => date('Y-m-d h:i:sa')
        ),array('tc_id'=>$tc_id,'id_device'=>$id_device));
        
        if ($update_data){
            $this->alert->set('success', "Submit Updated !");
        echo json_encode(array('code' => 200, 'message' => 'Submit Updated !'));
        }else{
            echo json_encode(array('code' => 500, 'message' => 'An error occurred while saving data !'));
        }

    }

    public function do_comment()
    {
        $id_ms_form = $this->input->post('id_ms_form');
        $id_ms_trans = $this->input->post('id_ms_trans');
        $tc_id = $this->input->post('tc_id');
        $id_device = $this->input->post('id_device');
        $comment = $this->input->post('comment_cek');

        $cek_detail_trans = cek_comment_exsist($tc_id);
        if ($cek_detail_trans != FALSE) {
            $update_data = $this->mod->updateData('trans_dt_tc', array(
                'comment'     => $comment,
                'updated_at'  => date('Y-m-d h:i:sa')
            ),array('tc_id'   =>$tc_id));
            
            if ($update_data){
				$this->alert->set('success', "Submit Updated !");
                echo json_encode(array('code' => 200, 'message' => 'Submit Updated !'));
       		}else{
       			echo json_encode(array('code' => 500, 'message' => 'An error occurred while saving data !'));
       		}
        }else{
            $insert_data = $this->mod->insertData('trans_dt_tc', array(
                'id_dt_trans' => $this->mod->autoNumber('id_dt_trans','trans_dt_tc','111',3),
                'id_ms_trans' => $id_ms_trans,
                'id_ms_form'  => $id_ms_form,
                'tc_id'       => $tc_id,
                'comment'     => $comment,
                'created_at'  => date('Y-m-d h:i:sa')
            ));

            if ($insert_data){
				$this->alert->set('success', "Submit Success !");
                echo json_encode(array('code' => 200, 'message' => 'Submit Success !'));
       		}else{
       			echo json_encode(array('code' => 500, 'message' => 'An error occurred while saving data !'));
       		}
        }

        // echo json_encode(array('id_ms_form'=>$id_ms_form,'tc_id' => $tc_id,'param'=>$param,'id_device'=>$id_device,'message' => 'good !!!!'));
    }

    public function modalDelete(){
        $ID = explode('~',$this->input->post('id'));
		$data = array(
                'modalTitle' => 'Delete '.$ID[1],
                'id'         => $ID[0],
				'formAction' => base_url('checker/do_delete'),
				'Req' => ''
			);
		$this->load->view('pages/checker/modal_confirm', $data);
    }
    
    public function do_delete(){
        $delete_detail = $this->mod->deleteData('trans_dt_tc', array('id_ms_trans' => base64_decode($this->input->post('id'))));
        $query 	= $this->mod->deleteData('trans_ms_tc', array('id_ms_trans' => base64_decode($this->input->post('id'))));        
		if ($query){
            $this->alert->set('success', "Delete success !");
            echo json_encode(array('code' => 200, 'message' => 'Delete success !'));
        }else{
            echo json_encode(array('code' => 500, 'message' => 'An error occurred while deleting data !'));
        }
		
    }

    public function modalSplashDetail(){
        $ID = explode('~',$this->input->post('id'));
        $id_form = $this->mod->getData('row','id_ms_form','trans_ms_tc',null,null,null,array('id_ms_trans'=>base64_decode($ID[0])));
        $id_type = get_type_form($id_form->id_ms_form);
		$data = array(
                'modalTitle' => 'Check Device For '.$ID[1],
                'formAction' => base_url('checker/do_splash_detail'),
                'dMaster'    => $this->mod->getData('result','*','device_tc',null,null,null,array('id_type'=>$id_type)),
                'id_ms_trans'=> base64_decode($ID[0]),
                'id_ms_form' => $id_form->id_ms_form,
				'Req' => ''
            );
        $this->load->view('pages/checker/modal_splash_detail', $data);
    }

    public function do_splash_detail()
    {
        setcookie('id_device', '');
        $id_ms_form = $this->input->post('id_ms_form');
        $id_ms_trans = $this->input->post('id_ms_trans');
        $id_device = $this->input->post('id_device');

        $this->load->library('form_validation');
        $this->form_validation->set_rules('id_device[]', 'Device', 'trim|xss_clean|required');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array('code' => 367, 'message' => 'Required Field !'));
        } else {
            $device = count($id_device);
            setcookie('id_device', json_encode($id_device) , time() + (86400 * 30));
            if ($device <= 3) {
                $lokasi = base_url('checker/detail_checker/'.$id_ms_trans);
                echo json_encode(array('code' => 200, 'aksi' => "window.location.href = '".$lokasi."'"));
            }else{
                echo json_encode(array('code' => 367, 'message' => 'Cannot more than 3 devices'));
            }
        }
    }
    
    

}

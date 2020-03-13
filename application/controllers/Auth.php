<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('Mod_crud','mod');
	}
	public function index()
	{
		 echo "Disabled Access!";
	}
    public function login() {
        #Redirect to Admin dashboard after authentication
        if (isset($this->session->userdata('authlog')['user_login_access']) == TRUE)
            redirect(base_url('dashboard/index'));

        $data = array(
            '_JS' => generate_js(array(
                'js/pages/login-script.js'
                )
            ),
            'titleWeb' => 'Login Administrator',
            'titlePage' => 'Administrator | Login',
		);
		$this->template->load('login_template', null, $data);
    }
    
    public function do_login() {
        
        $response = array();
        
        // Recieving post input of email, password from request
        $email    = $this->input->post('email');
        $password = sha1($this->input->post('password'));
        $remember = $this->input->post('rememberme');
        
        #Login input validation\
        $this->form_validation->set_error_delimiters('<span class="text-white">', '</span>');
        $this->form_validation->set_rules('email', 'User Email', 'trim|xss_clean|required|min_length[5]');
        $this->form_validation->set_rules('password', 'Password', 'trim|xss_clean|required|min_length[5]');
        
        // $this->form_validation->set_rules('g-recaptcha-response', 'Captcha', 'callback_google_captcha');
        // $this->form_validation->set_rules('g-recaptcha-response', 'Captcha', 'required|callback_validate_captcha');
        
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array('code' => 404, 'message' => validation_errors()));
        } else {
            // Validating login
            $cek_user = $this->mod->getData('row','email','users',null,null,null,array('email'=>$email));
            if ($cek_user == false) {
                echo json_encode(array('code' => 366, 'message' => 'Email not found'));
            }else{
                $login_status = $this->validate_login($email, $password);
                $response['login_status'] = $login_status;
                if ($login_status == 'success') {
                    $lokasi = base_url('dashboard'); //set lokasi
                    $this->mod->updateData('users', array('last_login' => date('Y/m/d H:i:s')),array('emaiL' => $this->input->post('email') ));
                    
                    if ($this->input->post('rememberme')) {
                        setcookie('email', $email, time() + (86400 * 30));
                        setcookie('password', $this->input->post('password'), time() + (86400 * 30));
                        $this->alert->set('success', 'Welcome '.$this->session->userdata('authlog')['firstname'].', you login as '.role_name($this->session->userdata('authlog')['role']).' !');
                        echo json_encode(array('code' => 200, 'aksi' => "window.location.href = '".$lokasi."'"));
                        
                    } else {
                        if (isset($_COOKIE['email'])) {
                            setcookie('email', '');
                        }
                        if (isset($_COOKIE['password'])) {
                            setcookie('password', '');
                        }
                        $this->alert->set('success', 'Welcome '.$this->session->userdata('authlog')['firstname'].', you login as '.role_name($this->session->userdata('authlog')['role']).' !');
                        echo json_encode(array('code' => 200, 'aksi' => "window.location.href = '".$lokasi."'"));
                    }
                    
                } else {
                    echo json_encode(array('code' => 367, 'message' => 'Wrong password'));
                }
            }
            
        }
    }

    // Validate google reCaptcha
    function validate_captcha() {
        $captchaResponse = $this->input->post('g-recaptcha-response');
        $captchaUrl      = 'https://www.google.com/recaptcha/api/siteverify';
        $secretSitekey   = '6Lep8j8UAAAAAJkV0OGSqNtIS5C_q_MUKrg1eI4Y';
        $captchaResponse = file_get_contents($captchaUrl . "?secret=" . $secretSitekey . "&response=" . $captchaResponse . "&remoteip=" . $_SERVER["REMOTE_ADDR"]);
        $captchaData = json_decode($captchaResponse, true);
        if($captchaData['success'] == TRUE) {
            return TRUE;             
        } else {
            $this->form_validation->set_message('validate_captcha', 'Forgot to check the reCaptcha?');
            return FALSE;
        }
    }
    // Validating login from request
	function validate_login($email = null, $password = null) 
	{
		$query = $this->mod->getData('row','*','users',null,null,null,array('email'=>$email,'password'=>$password));
        if ($query == TRUE) {
            $login['user_login_access'] = TRUE;
            $login['user_login_id']     = $query->id_user;
            $login['email']             = $query->email;
            $login['password']          = $query->password;
            $login['firstname']         = $query->firstname;
            $login['lastname']          = $query->lastname;
            $login['role']              = $query->id_role;
            $this->session->set_userdata('authlog',$login);
            return 'success';
        }
    }
    /*Logout method*/
    function logout() {
        $this->session->unset_userdata('authlog');
        $this->session->set_flashdata('feedback', 'logged_out');
        redirect(base_url(), 'refresh');
	}
    
    
}
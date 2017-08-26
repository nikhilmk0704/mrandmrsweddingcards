<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends CI_Controller {

	//Load login page  
    public function index() {
        $data['error'] = "";
         if ($this->session->userdata('userloggedin') == TRUE) {
            if (($this->session->userdata('userloggedin') == TRUE)) {
                redirect('dashboard');
            }
        } else {
            if (($this->session->userdata('userloggedin') == FALSE )) {
                $sessionValue = array('username' => " ");
                $this->session->set_userdata($sessionValue);
            } else {
                $data['error'] = "";
            }
            $this->load->view('login_view', $data);
        }
    }
	
	    //check admin login details
    public function check_user() {
		    if (($this->session->userdata('userloggedin') == TRUE) && ($this->session->userdata('status') == 1)) {
                redirect('dashboard');
            }
			$data['error']='';
        if (isset($_POST['usermail']) && isset($_POST['password'])) {
            $email = $_POST["usermail"];
            $password = $_POST["password"];
            $this->load->model('login_model');
            $checkresult = $this->login_model->get_user($email,$password);
              if (($this->session->userdata('userloggedin') == TRUE)){          
                        echo 100;
                } else {
             			echo 200;
            }
        } else {
           echo 200;
        }
    }
	//user logout
    public function logout() {
        $user_data = $this->session->all_userdata();
        foreach ($user_data as $key => $value) {
            if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
                $this->session->unset_userdata($key);
            }
        }
        $this->session->sess_destroy();
        redirect('login');
    }
	
}

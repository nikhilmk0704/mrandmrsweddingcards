<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Triphistory extends CI_Controller {
	 public function __construct()
       {
            parent::__construct();
      
	   }
	
    //Dashboard view
     public function index() {
        if ($this->session->userdata('userloggedin') == TRUE) {
            $userid = $this->session->userdata('userid');
            $this->load->model('triphistory/triphistory_model');
            $data['tripList'] = $this->triphistory_model->tripList();
			//checking permission
			$user_role_id = $this->session->userdata('role');
			$this->load->model('permission_models');
			$permission = $this->permission_models->getPermissionForController_view($user_role_id,$this->uri->segment(2));
			$data['checking'] = $this->permission_models->getPermissionForController($user_role_id,$this->uri->segment(2));
			 $data['menus'] = $this->permission_models->getMenuNames();
		 	if($permission=='1'){   
             $this->load->view('triphistory/triphistory_view',$data);   
       		}else{
			  $this->load->view('no_permission');
			}
           
        	} else {
            	redirect('login');
        	}
    }
    public function mapView(){
       if ($this->session->userdata('userloggedin') == TRUE) {
            $tripid = $_POST['tripid'];
        	$this->load->model('triphistory/triphistory_model');
            $data['tripList'] = $this->triphistory_model->mapList($tripid);
            echo json_encode($data['tripList']);
        	} else {
            	redirect('login');
        	}
        
    }
	public function updateTable(){
		if ($this->session->userdata('userloggedin') == TRUE) {
			$tripid = $_POST['tripid'];
			$this->load->model('triphistory/triphistory_model');
			echo $this->triphistory_model->updateData($tripid);
		} else {
			redirect('login');
		}

	}
}
<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Driverpayment extends CI_Controller {
	 public function __construct()
       {
            parent::__construct();
      
	   }
	
    //Dashboard view
     public function index() {
        if ($this->session->userdata('userloggedin') == TRUE) {
            $userid = $this->session->userdata('userid');
            $this->load->model('driverpayment/driverpayment_model');
            $data['paymentList'] = $this->driverpayment_model->driverPaymentList();
			//checking permission
			$user_role_id = $this->session->userdata('role');
			$this->load->model('permission_models');
			$permission = $this->permission_models->getPermissionForController_view($user_role_id,$this->uri->segment(2));
			$data['checking'] = $this->permission_models->getPermissionForController($user_role_id,$this->uri->segment(2));
			 $data['menus'] = $this->permission_models->getMenuNames();
		 	if($permission=='1'){   
             $this->load->view('driverpayment/driverpayment_view',$data);   
       		}else{
			  $this->load->view('no_permission');
			}
           
        	} else {
            	redirect('login');
        	}
    }
}
<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Customers extends CI_Controller {
	 public function __construct()
       {
            parent::__construct();
      
	   }
	
    //Dashboard view
     public function index() {
        if ($this->session->userdata('userloggedin') == TRUE) {
            $userid = $this->session->userdata('userid');
            $this->load->model('customer/customermodel');
            $data['customerList'] = $this->customermodel->customerList();
			
			//checking permission
			$user_role_id = $this->session->userdata('role');
			$this->load->model('permission_models');
			$permission = $this->permission_models->getPermissionForController_view($user_role_id,$this->uri->segment(2));
			$data['checking'] = $this->permission_models->getPermissionForController($user_role_id,$this->uri->segment(2));
			 $data['menus'] = $this->permission_models->getMenuNames();
		 	if($permission=='1'){   
             $this->load->view('customer/customerview',$data);   
       		}else{
			  $this->load->view('no_permission');
			}
           
        	} else {
            	redirect('login');
        	}
    }
     //edit the template 
    
    public function edit_view()
    {
         if ($this->session->userdata('userloggedin') == TRUE) {
			$id = $_POST['customer_id']; 
        	$this->load->model('customer/customermodel');
        	$data['customers'] = $this->customermodel->getCustomer($id);
			$this->load->view('customer/customer_edit_view', $data);
        	} else {
            	redirect('login');
        	}
    }
	public function updateCustomer(){
		 if ($this->session->userdata('userloggedin') == TRUE) {
			 $this->load->model('customer/customermodel');
			 $file_id = $this->customermodel->updateCustomer($_POST['id'],$_POST['firstname'], $_POST['lastname'], $_POST['phone_edit']);
			 echo $file_id;
		 }else {
            	redirect('login');
        	}
	}
    //public function delete
    public function active()
    {
	   $id = $_POST['customerId'];
       $this->load->model('customer/customermodel');
       echo $this->customermodel->activateCustomer($id);
    }	
}
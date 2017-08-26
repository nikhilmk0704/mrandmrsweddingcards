<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Promocode extends CI_Controller {
	 public function __construct()
       {
            parent::__construct();
      
	   }
	
    //Dashboard view
     public function index() {
        if ($this->session->userdata('userloggedin') == TRUE) {
            $userid = $this->session->userdata('userid');
			//permission checking
			$user_role_id = $this->session->userdata('role');
			$this->load->model('permission_models');
			$permission = $this->permission_models->getPermissionForController_view($user_role_id,$this->uri->segment(2));
			$data['checking'] = $this->permission_models->getPermissionForController($user_role_id,$this->uri->segment(2));
			$data['menus'] = $this->permission_models->getMenuNames();
			$this->load->model('promocodes/promocode_model');
			$data['coupon'] = $this->promocode_model->couponList();
		 	if($permission=='1'){   
             $this->load->view('promocodes/promocode_view',$data);   
       		}else{
			  $this->load->view('no_permission');
			}
           
        } else {
            redirect('login');
        }
    }
    
    //add template data
    public function add()
    {
	if ($this->session->userdata('userloggedin') == TRUE) {	
			$this->load->model('promocodes/promocode_model');
					$file_id = $this->promocode_model->addPromo($_POST['code'],$_POST['total_count'],$_POST['valid_from'],$_POST['valid_to'],$_POST['message'],$_POST['value']); 
					echo $file_id;
				
			 } else {
            redirect('login');
        } 
    }
    
	
	  //public function delete
    public function delete()
    {
	   $id = $_POST['coupon_id'];
       $this->load->model('promocodes/promocode_model');
        echo $this->promocode_model->deleteCoupon($id);
    }
}
<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Roles extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
		
    if ($this->session->userdata('userloggedin') == TRUE) {
				$user_role_id = $this->session->userdata('role');
				$data['role_id'] = $this->session->userdata('role');
				$data['url'] = $this->uri->segment(1);
				$this->load->model('rolemodel');
                $data['result'] = $this->rolemodel->roles_list();
		       
				$this->load->model('permissionmodel');
			    $data['menu'] = $this->permissionmodel->menus($user_role_id);				
		        $data['user_id']=  $this->session->userdata('user_id');
				$this->load->model('permission_models');
				$permission = $this->permission_models->getPermissionForController_view($user_role_id,$this->uri->segment(1));
				$data['menus'] = $this->permission_models->getMenuNames();
		  
		 if($permission=='1')
           {   
             $this->load->view('roles',$data);
       }else{
			  $this->load->view('no_permission');
		}
               
                		
          }else{
              redirect(base_url('index.php') . '/login', 'refresh');
          }
        }
}
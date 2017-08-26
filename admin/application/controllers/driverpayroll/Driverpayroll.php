<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Driverpayroll extends CI_Controller {
	 public function __construct()
       {
            parent::__construct();
      
	   }
	
    //Dashboard view
     public function index() {
        if ($this->session->userdata('userloggedin') == TRUE) {
            $userid = $this->session->userdata('userid');
            $this->load->model('driverpayroll/driverpayroll_model');
            $data['payrollList'] = $this->driverpayroll_model->payrollList();
           $this->load->model('vehiclebasetypes/basetypemodel');
            $data['baseTypeList'] = $this->basetypemodel->baseTypeList();
		
			//permission checking
			$user_role_id = $this->session->userdata('role');
			$this->load->model('permission_models');
			$permission = $this->permission_models->getPermissionForController_view($user_role_id,$this->uri->segment(2));
			$data['checking'] = $this->permission_models->getPermissionForController($user_role_id,$this->uri->segment(2));
			 $data['menus'] = $this->permission_models->getMenuNames();
		 	if($permission=='1'){   
             $this->load->view('driverpayroll/payroll_view',$data);   
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
			$this->load->model('driverpayroll/driverpayroll_model');
					$file_id = $this->driverpayroll_model->addPayRoll($_POST['basetype'],$_POST['capacity'],$_POST['monthly'],$_POST['min_duty_hr'],$_POST['km_unit'],$_POST['ot_rate']); 
					echo $file_id;
				
			 } else {
            redirect('login');
        } 
    }
    //public function delete
    public function updateStatus()
    {
	   $id = $_POST['capacity_id'];
	   $status = $_POST['status'];
       $this->load->model('vehiclecapacities/capacitymodel');
        echo $this->capacitymodel->capacityUpdate($id,$status);
    }
	// ajax loading
	
	public function ajaxLoadCapacity(){
		$id = $_POST['basetype_id'];
        $this->load->model('hire/for_hire_model');
        $data = $this->for_hire_model->capacityGet($id);
		$str = '<option value="0">Select</option>';
		if ($data != 0){
			foreach($data as $data){
				$str .= '<option value="'.$data['capacity_id'].'">'.$data['capacity'].'</option>';
			}
		}
		echo $str;
	}
	  //public function delete
    public function delete()
    {
	   $id = $_POST['hireId'];
       $this->load->model('driverpayroll/driverpayroll_model');
        echo $this->driverpayroll_model->deletePayroll($id);
    }
}
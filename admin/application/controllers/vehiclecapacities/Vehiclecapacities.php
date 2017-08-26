<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Vehiclecapacities extends CI_Controller {
	 public function __construct()
       {
            parent::__construct();
      
	   }
	
    //Dashboard view
     public function index() {
        if ($this->session->userdata('userloggedin') == TRUE) {
            $userid = $this->session->userdata('userid');
            $this->load->model('vehiclecapacities/capacitymodel');
            $data['capacityList'] = $this->capacitymodel->capacityList();
			$this->load->model('vehiclebasetypes/basetypemodel');
            $data['baseTypeList'] = $this->basetypemodel->baseTypeList();
			
			//permission checking
			$user_role_id = $this->session->userdata('role');
			$this->load->model('permission_models');
			$permission = $this->permission_models->getPermissionForController_view($user_role_id,$this->uri->segment(2));
			$data['checking'] = $this->permission_models->getPermissionForController($user_role_id,$this->uri->segment(2));
			$data['menus'] = $this->permission_models->getMenuNames();
		 	if($permission=='1'){   
             $this->load->view('vehiclecapacities/capacityview',$data);
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
		
		$file_element_name = 'vehicle_capacity_image';
            $config['upload_path'] = './uploads/vehicle_capacity_image';
            $config['allowed_types'] = 'png|PNG|jpg|gif|bmp|jpeg';
            $config['max_size'] = 10242311;
            $config['max_width'] = '1000011';
            $config['max_height'] = '1000011';
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
			$this->load->model('vehiclecapacities/capacitymodel');
			if($_FILES['vehicle_capacity_image']['name']!=''){
				if ($this->upload->do_upload($file_element_name)) {
					$data = $this->upload->data();
					$file_id = $this->capacitymodel->addCapacity($_POST['basetype'],$_POST['capacity'],$data['file_name']/*,$_POST['basefare'],$_POST['kmunit'],$_POST['timeunit'],$_POST['min_hrs']*/);
					echo $file_id;
				}else {
					$file_id='';
					echo $file_id;
				}
			}else{
				$filename='';
				$file_id = $this->capacitymodel->addCapacity($_POST['basetype'],$_POST['capacity'],$filename/*,$_POST['basefare'],$_POST['kmunit'],$_POST['timeunit'],$_POST['min_hrs']*/);
				echo $file_id;
			} 
    }
    //edit the template 
    
    public function edit_view()
    {
         if ($this->session->userdata('userloggedin') == TRUE) {
			$id = $_POST['capacity_id']; 
        	$this->load->model('vehiclecapacities/capacitymodel');
        	$data['capacity'] = $this->capacitymodel->getCapacity($id);
			$this->load->model('vehiclebasetypes/basetypemodel');
            $data['baseTypeList'] = $this->basetypemodel->baseTypeList();
			$this->load->view('vehiclecapacities/capacity_edit_view', $data);
        	} else {
            	redirect('login');
        	}
    }
    
    public function updateCapacity()
    {
	   		$file_element_name = 'capacity_image_edit';
            $config['upload_path'] = './uploads/vehicle_capacity_image';
            $config['allowed_types'] = 'png|PNG|jpg|gif|bmp|jpeg';
            $config['max_size'] = 10242311;
            $config['max_width'] = '1000011';
            $config['max_height'] = '1000011';
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
			$this->load->model('vehiclecapacities/capacitymodel');
			if($_FILES['capacity_image_edit']['name']!=''){
				if ($this->upload->do_upload($file_element_name)) {
					$data = $this->upload->data();
					$file_id = $this->capacitymodel->updateCapacity($_POST['basetype'],$_POST['capacity_id'], $_POST['capacity'],$data['file_name']/*,$_POST['basefare'],$_POST['kmunit'],$_POST['timeunit'],$_POST['min_hrs']*/);
					if($_POST['old_image']!=''){	
						if(file_exists("uploads/vehicle_capacity_image/".basename($_POST['old_image']))){
							unlink("uploads/vehicle_capacity_image/".basename($_POST['old_image']));
						}
					}
					echo $file_id;
				}else {
					$file_id='';
					echo $file_id;
				}
			}else{
				$filename=''; 
				$file_id = $file_id = $this->capacitymodel->updateCapacity($_POST['basetype'],$_POST['capacity_id'], $_POST['capacity'],$filename/*,$_POST['basefare'],$_POST['kmunit'],$_POST['timeunit'],$_POST['min_hrs']*/);
				echo $file_id;
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
}
<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Vehiclebasetypes extends CI_Controller {
	 public function __construct()
       {
            parent::__construct();
      
	   }
	
    //Dashboard view
     public function index() {
        if ($this->session->userdata('userloggedin') == TRUE) {
            $userid = $this->session->userdata('userid');
            $this->load->model('vehiclebasetypes/basetypemodel');
            $data['baseTypeList'] = $this->basetypemodel->baseTypeList();
			//permission checking
			$user_role_id = $this->session->userdata('role');
			$this->load->model('permission_models');
			$permission = $this->permission_models->getPermissionForController_view($user_role_id,$this->uri->segment(2));
			$data['checking'] = $this->permission_models->getPermissionForController($user_role_id,$this->uri->segment(2));
			$data['menus'] = $this->permission_models->getMenuNames();
		 	if($permission=='1'){   
              $this->load->view('vehiclebasetypes/basetypeview',$data);   
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
			$file_element_name = 'vehicle_basetype_image';
            $config['upload_path'] = './uploads/vehicle_basetype_image';

            $config['allowed_types'] = 'png|PNG|jpg|gif|bmp|jpeg';
            $config['max_size'] = 10242311;
            $config['max_width'] = '1000011';
            $config['max_height'] = '1000011';
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
			$this->load->model("vehiclebasetypes/basetypemodel");
			if($_FILES['vehicle_basetype_image']['name']!=''){
				if ($this->upload->do_upload($file_element_name)) {
					$data = $this->upload->data();
					$file_id = $this->basetypemodel->addBasetype($_POST['basetype'],$data['file_name']); 
					echo $file_id;
				}else {
					$file_id='';
					echo $file_id;
				}
			}else{
				$filename='';
				$file_id = $this->basetypemodel->addBasetype($_POST['basetype'],$filename);
				echo $file_id;
			}
    }
    //edit the template 
    
    public function edit_view()
    {
         if ($this->session->userdata('userloggedin') == TRUE) {
			$id = $_POST['basetype_id']; 
        	$this->load->model('vehiclebasetypes/basetypemodel');
        	$data['basetype'] = $this->basetypemodel->getBasetype($id);
			$this->load->view('vehiclebasetypes/basetype_edit_view', $data);
        	} else {
            	redirect('login');
        	}
    }
    
    //update the school temp details
    public function updateBasetype()
    {
		 $file_element_name = 'basetype_image_edit';
            $config['upload_path'] = './uploads/vehicle_basetype_image';

            $config['allowed_types'] = 'png|PNG|jpg|gif|bmp|jpeg';
            $config['max_size'] = 10242311;
            $config['max_width'] = '1000011';
            $config['max_height'] = '1000011';
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
			 $this->load->model('vehiclebasetypes/basetypemodel');
			if($_FILES['basetype_image_edit']['name']!=''){
				if ($this->upload->do_upload($file_element_name)) {
					$data = $this->upload->data();
					$file_id = $this->basetypemodel->updateBasetype($_POST['basetype'], $_POST['basetype_id'],$data['file_name']);
					if($_POST['old_image']!=''){	
						if(file_exists("uploads/vehicle_basetype_image/".basename($_POST['old_image']))){
							unlink("uploads/vehicle_basetype_image/".basename($_POST['old_image']));
						}
					}
					echo $file_id;
				}else {
					$file_id='';
					echo $file_id;
				}
			}else{
				$filename=''; 
				$file_id = $this->basetypemodel->updateBasetype($_POST['basetype'], $_POST['basetype_id'],$filename);
				echo $file_id;
			}
    }
    //public function delete
    public function delete()
    {
	   $id = $_POST['basetypeId'];
	   $status = $_POST['status'];
       $this->load->model('vehiclebasetypes/basetypemodel');
        echo $this->basetypemodel->baseTypeUpdate($id,$status);
    }
}
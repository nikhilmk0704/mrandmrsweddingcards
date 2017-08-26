<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Vendors extends CI_Controller {
	public function __construct()
       {
            parent::__construct();
            $this->load->model('vendors_model');
      
	   }
	
    //Dashboard view
     public function index() {
        if ($this->session->userdata('userloggedin') == TRUE) {
            
			$userid = $this->session->userdata('id');
            $data['vendorList']  = $this->vendors_model->vendorList();
  
            $this->load->view('vendors/vendor_view',$data);     
		} else {
            
			redirect('login');
        }
    }
    //add template data
    public function add(){
      	if ($this->session->userdata('userloggedin') == TRUE) {
            
            $file_id = $this->vendors_model->addVendor(
                $_POST['name'], $_POST['email'], 
                $_POST['phone']
            );
            
            echo $file_id;
        }else {
            redirect('login');
        }			 
    	
    }
	 //edit the template 
    
    public function edit_view()
    {
         if ($this->session->userdata('userloggedin') == TRUE) {
			$id = $_POST['vendor_id']; 
        	$this->load->model('vendors_model');
        	$data['vendors'] = $this->vendors_model->getVendors($id);
			$this->load->view('vendors/vendors_edit_view', $data);
        	} else {
                redirect('login');
            }
    }
	 //update the school temp details
    public function updateVendor(){
		   
		$file_id = $this->vendors_model->updateVendor($_POST['id'],$_POST['name'], $_POST['email'],
            $_POST['phone']
        );
		 echo $file_id;
				
    }
    //public function delete
    public function active()
    {
	   $id = $_POST['vendorId'];
       echo $this->vendors_model->activateVendor($id);
    }	
}
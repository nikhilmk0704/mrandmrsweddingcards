<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Productshape extends CI_Controller {
	public function __construct()
       {
            parent::__construct();
            $this->load->model('shape_model');
      
	   }
	
    //Dashboard view
     public function index() {
        if ($this->session->userdata('userloggedin') == TRUE) {
            
			$userid = $this->session->userdata('id');
            $data['shapeList']  = $this->shape_model->shapeList();
  
            $this->load->view('shape/shape_view',$data);     
		} else {
            
			redirect('login');
        }
    }
    //add template data
    public function add(){
      	if ($this->session->userdata('userloggedin') == TRUE) {
            
            $file_id = $this->shape_model->addShape($_POST['name']);
            
            echo $file_id;
        }else {
            redirect('login');
        }			 
    	
    }
	 //edit the template 
    
    public function edit_view()
    {
         if ($this->session->userdata('userloggedin') == TRUE) {
			$id = $_POST['shape_id']; 
        	
        	$data['shape'] = $this->shape_model->getShape($id);
			$this->load->view('shape/shape_edit_view', $data);
        } else {
                redirect('login');
        }
    }
	 //update the school temp details
    
    public function updateShape(){
		   
		$file_id = $this->shape_model->updateShape($_POST['id'],$_POST['name']);
		 echo $file_id;
				
    }
    //public function delete
    public function active(){
	   
       $id = $_POST['shape_id'];
       echo $this->shape_model->activateShape($id);
    }
}
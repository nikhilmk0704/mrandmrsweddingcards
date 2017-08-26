<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Productcolor extends CI_Controller {
	public function __construct()
       {
            parent::__construct();
            $this->load->model('color_model');
      
	   }
	
    //Dashboard view
     public function index() {
        if ($this->session->userdata('userloggedin') == TRUE) {
            
			$userid = $this->session->userdata('id');
            $data['colorList']  = $this->color_model->colorList();
  
            $this->load->view('color/color_view',$data);     
		} else {
            
			redirect('login');
        }
    }
    //add template data
    public function add(){
      	if ($this->session->userdata('userloggedin') == TRUE) {
            
            $file_id = $this->color_model->addColor($_POST['name'],$_POST['color']);
            
            echo $file_id;
        }else {
            redirect('login');
        }			 
    	
    }
	 //edit the template 
    
    public function edit_view()
    {
         if ($this->session->userdata('userloggedin') == TRUE) {
			$id = $_POST['color_id']; 
        	
        	$data['color'] = $this->color_model->getColor($id);
			$this->load->view('color/color_edit_view', $data);
        	} else {
                redirect('login');
            }
    }
	 //update the school temp details
    public function updateColor(){
		   
		$file_id = $this->color_model->updateColor($_POST['id'],$_POST['name'],$_POST['color']);
		 echo $file_id;
				
    }
    //public function delete
    public function active(){
	   
       $id = $_POST['color_id'];
       echo $this->color_model->activateColor($id);
    }
}
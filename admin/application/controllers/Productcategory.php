<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Productcategory extends CI_Controller {
	public function __construct()
       {
            parent::__construct();
            $this->load->model('category_model');
      
	   }
	
    //Dashboard view
     public function index() {
        if ($this->session->userdata('userloggedin') == TRUE) {
            
			$userid = $this->session->userdata('id');
            $data['categoryList']  = $this->category_model->categoryList();
  
            $this->load->view('category/category_view',$data);     
		} else {
            
			redirect('login');
        }
    }
    //add template data
    public function add(){
      	if ($this->session->userdata('userloggedin') == TRUE) {
            
            $file_id = $this->category_model->addCategory($_POST['name']);
            
            echo $file_id;
        }else {
            redirect('login');
        }			 
    	
    }
	 //edit the template 
    
    public function edit_view()
    {
         if ($this->session->userdata('userloggedin') == TRUE) {
			$id = $_POST['category_id']; 
        	
        	$data['category'] = $this->category_model->getCategory($id);
			$this->load->view('category/category_edit_view', $data);
        	} else {
                redirect('login');
            }
    }
	 //update the school temp details
    public function updateCategory(){
		   
		$file_id = $this->category_model->updateCategory($_POST['id'],$_POST['name']);
		 echo $file_id;
				
    }
    //public function delete
    public function active()
    {
	   $id = $_POST['categoryId'];
       echo $this->category_model->activateCategory($id);
    }
}
<?php

class Transaction extends CI_Controller {
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

            $this->load->model('transact/transaction_model');

            $data['transaction'] = $this->transaction_model->transactList();

            if($permission=='1'){
             $this->load->view('transact/transaction_view',$data);
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

			$this->load->model('transact/transaction_model');
					$file_id = $this->transaction_model->addStandard($_POST['country'],$_POST['currency'],$_POST['xRate'],$_POST['distanceUnit'],$_POST['countryName']);
					echo $file_id;
				
			 } else {
            redirect('login');
        } 
    }

    public function edit_view()
    {
        if ($this->session->userdata('userloggedin') == TRUE) {
            $id = $_POST['standardId'];

            $this->load->model('transact/transaction_model');
            $data['standard'] = $this->transaction_model->getStandard($id);

            $this->load->view('transact/standard_edit_view', $data);
        } else {
            redirect('login');
        }
    }
	  //public function delete
    public function delete()
    {
	   $id = $_POST['standardId'];
       $this->load->model('transact/transaction_model');
        echo $this->transaction_model->deleteStandard($id);
    }

    public function update()
    {

        $this->load->model('transact/transaction_model');
        $file_id = $this->transaction_model->updateStandard($_POST['id'],$_POST['country_edit'],$_POST['currency_edit'], $_POST['xRate_edit'],$_POST['distanceUnit_edit'],$_POST['countryName_edit']);
        echo $file_id;

    }
}
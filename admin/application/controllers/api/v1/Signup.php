<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Signup extends CI_Controller {
	function signupinfo(){
		$usertype=1;
		$emailtype=2;
	if(isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['email']) && isset($_POST['password'])  && isset($_POST['token']) && isset($_POST['ostype']) && isset($_POST['certype']) && isset($_POST['phone'])){
		if($_POST['firstName']!='' && $_POST['lastName']!='' && $_POST['email']!='' && $_POST['password']!=''  && $_POST['certype']!='' && $_POST['ostype']!='' && $_POST['token']!='' && $_POST['phone']!=''){
		$this->load->model('api/v1/login_model');
		$arr=$this->login_model->save_user_info($_POST['firstName'],$_POST['lastName'],$_POST['email'],$_POST['password'],$usertype,$_POST['token'],$_POST['certype'],$_POST['ostype'],$_POST['phone']);	
		}else{
		$arr=array("status"=>"fail","description"=>"username or password cant be empty");	
		}	
	}else{
			$arr=array("status"=>"fail","description"=>"username or password cant be empty");
		}	
		$this->output
    			->set_content_type('application/json')
   				->set_output(json_encode($arr));
				
}
}
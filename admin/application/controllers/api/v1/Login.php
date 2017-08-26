<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends CI_Controller {
	//username=test&pass=test1234&token=1212&ostype=1&certype=1
	function logout(){
	if(isset($_POST['token']) && isset($_POST['devicetoken'])){
		if($_POST['token']!='' && 	$_POST['devicetoken']!='' ){
			$this->load->model('api/v1/login_model');
			$output=$this->login_model->clear_token($_POST['token'],$_POST['devicetoken']);
		}else{
			$output=array("status"=>"fail","description"=>"token or devicetoken cant be empty");
		}
	}else{
		$output=array("status"=>"fail","description"=>"token or devicetoken cant be empty");
	}
	$this->output
    			->set_content_type('application/json')
   				->set_output(json_encode($output));
	}
	function loginrequest(){
		if(isset($_POST['username']) && isset($_POST['pass']) && isset($_POST['token']) && isset($_POST['ostype']) && isset($_POST['certype'])){
			if($_POST['username']!='' && 	$_POST['pass']!=''  && $_POST['token']!=''  && $_POST['ostype']!='' && $_POST['certype']!=''){
			$this->load->model('api/v1/login_model');
			$email=$_POST['username'];
			$password=$_POST['pass'];
			$token=$_POST['token'];
			$ostype=$_POST['ostype'];
			$certype=$_POST['certype'];
			$output=$this->login_model->validate_user($email,$password,$token,$ostype,$certype);
			}else{
			$output=array("status"=>"fail","description"=>"username or password cant be empty");
			}
		}else{
			$output=array("status"=>"fail","description"=>"username or password cant be empty");
		}	
		//header("content-type:json");ååååå
		$this->output
    			->set_content_type('application/json')
   				->set_output(json_encode($output));
	}
	function forgetpassword(){
			if(isset($_POST['username'])){
			if($_POST['username']!=''){
			$this->load->model('api/v1/login_model');
			$output=$this->login_model->forget_password($_POST['username']);
			}else{
			$output=array("status"=>"fail","description"=>"Email cant be empty");
			}
			}else{
			$output=array("status"=>"fail","description"=>"Email cant be empty");
			}
			$this->output
    			->set_content_type('application/json')
   				->set_output(json_encode($output));
	}
	function changepassword(){
					$this->load->model('api/v1/login_model');
			if(isset($_POST['token']) && isset($_POST['old_pass']) && isset($_POST['new_pass']) ){
					if($_POST['token']!='' && $_POST['old_pass']!='' && $_POST['new_pass']!=''){
				$output=$this->login_model->chage_password($_POST['token'],$_POST['old_pass'],$_POST['new_pass']);
					}else{
			$output=array("status"=>"fail","description"=>"token or password is empty");
						
					}
		}else{
			$output=array("status"=>"fail","description"=>"token or password is empty");
			}
			$this->output
    			->set_content_type('application/json')
   				->set_output(json_encode($output));
	}
	function edit_profile(){
	}
	
}
<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Addpromo extends CI_Controller {
	public function __construct(){
            parent::__construct();
      
	}
	function addPromo(){
		if(isset($_POST['promocode']) && isset($_POST['user_token'])){
			if($_POST['promocode']!='' && $_POST['user_token']!=''){
				$this->load->model('api/v1/addpromomodel');
				$output=$this->addpromomodel->promoAdd($_POST['promocode'],$_POST['user_token']);
			}else{
				$output=array("status"=>"fail","description"=>"You missed required data");
			}
		}else{
			$output=array("status"=>"fail","description"=>"You missed required data");
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($output));	
	}
}
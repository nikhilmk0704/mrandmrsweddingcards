<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Getforhiredetail extends CI_Controller {
	
	function getForHire(){
		if(isset($_POST['token']) && isset($_POST['for_hire_id'])){
			if($_POST['token']!='' && $_POST['for_hire_id']){	
				$token = $_POST['token'];
				$for_hire_id = $_POST['for_hire_id'];
				$this->load->model('api/v1/gethiremodel');
				$data=$this->gethiremodel->getHire($token,$for_hire_id);
			}else{
				$data=array("status"=>"fail","description"=>"You missed required data");
			}
		}else{
			$data=array("status"=>"fail","description"=>"You missed required data");
		}
		$this->output
    			->set_content_type('application/json')
   				->set_output(json_encode($data));
	}
}
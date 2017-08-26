<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Listforhire extends CI_Controller {
	
	function getForHireList(){
		if(isset($_POST['token'])){
			if($_POST['token']!=''){	
				$token = $_POST['token'];
				$this->load->model('api/v1/forhiremodel');
				$data=$this->forhiremodel->getHire($token);
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
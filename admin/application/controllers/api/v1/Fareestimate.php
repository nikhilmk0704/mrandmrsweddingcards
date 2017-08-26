<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Fareestimate extends CI_Controller {
	public function __construct(){
            parent::__construct();
      
	}
	function estimateFare(){
		if(isset($_POST['source']) && isset($_POST['destination']) && isset($_POST['user_token']) && isset($_POST['basetype']) && isset($_POST['capacity']) && isset($_POST['country_code'])){
			if($_POST['source']!='' && $_POST['destination']!='' && $_POST['user_token']!='' && $_POST['basetype']!='' && $_POST['capacity'] && $_POST['country_code']!=''){
				$this->load->model('api/v1/fareestimatemodel');
				$output=$this->fareestimatemodel->fareEstimate($_POST['source'],$_POST['destination'],$_POST['user_token'],$_POST['basetype'],$_POST['capacity'],$_POST['country_code']);
			}else{
				$output=array("status"=>"fail","description"=>"You missed required data");
			}
		}else{
			$output=array("status"=>"fail","description"=>"You missed required data");
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($output));	
	}
}
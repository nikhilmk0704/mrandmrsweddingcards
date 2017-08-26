<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tripstatus extends CI_Controller {
	function getTripStatus(){
		if(isset($_POST['trip_id']) && isset($_POST['token']) && isset($_POST['country_code'])){
			if($_POST['trip_id']!='' && $_POST['token']!='' && $_POST['country_code']!=''){
				$this->load->model('api/v1/tripstatusmodel');
				$output=$this->tripstatusmodel->getStatus($_POST['trip_id'],$_POST['token'],$_POST['country_code']);
			}else{
				$output=array("status"=>"fail","description"=>"You missed required data");
			}
		}else{
			$output=array("status"=>"fail","description"=>"You missed required data");
		}
			$this->output
    			->set_content_type('application/json')
   				->set_output(json_encode($output));	
	}
}
<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Locatedcustomerupdate extends CI_Controller {
	function update(){
		if(isset($_POST['driver_token'])){
			if($_POST['driver_token']!=''){
				$this->load->model('api/v1/locatecustomerupdatemodel');
				$output=$this->locatecustomerupdatemodel->updateLocatecustomer($_POST['driver_token']);
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
<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Transactiondonestatus extends CI_Controller {
	function update(){
		if(isset($_POST['user_token']) && isset($_POST['trip_id'])){
			if($_POST['user_token']!='' && $_POST['trip_id']!=''){
				$this->load->model('api/v1/tripstatusupdate');
				$output=$this->tripstatusupdate->updateTrip($_POST['user_token'],$_POST['trip_id']);
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
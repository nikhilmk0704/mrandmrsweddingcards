<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Endtrip extends CI_Controller {
	function tripEnd(){
		if(isset($_POST['trip_id']) && isset($_POST['driver_token']) && isset($_POST['endtime']) && isset($_POST['km_done'])){
			if($_POST['trip_id']!='' && $_POST['driver_token']!='' && $_POST['endtime']!='' && $_POST['km_done']!=''){
				$this->load->model('api/v1/endtripmodel');
				$output=$this->endtripmodel->updateEndTrip($_POST['trip_id'],$_POST['driver_token'],$_POST['endtime'],$_POST['km_done']);
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
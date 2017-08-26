<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Starttrip extends CI_Controller {
	function update(){
		if(isset($_POST['driver_token']) && isset($_POST['time'])){
			if($_POST['driver_token']!='' && $_POST['time']){
				$this->load->model('api/v1/starttripmodel');
				$output=$this->starttripmodel->updateTrip($_POST['driver_token'],$_POST['time']);
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
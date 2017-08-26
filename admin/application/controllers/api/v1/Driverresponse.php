<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Driverresponse extends CI_Controller {
	public function __construct(){
            parent::__construct();
      
	}
	function acceptReject(){
		if(isset($_POST['request_id']) && isset($_POST['driver_token']) && isset($_POST['time']) && isset($_POST['type'])){
			if($_POST['request_id']!='' && $_POST['driver_token']!='' && $_POST['time']!='' && $_POST['type']!='' ){
				$this->load->model('api/v1/response_model');
				$output=$this->response_model->updateDriverResponse($_POST['request_id'],$_POST['driver_token'],$_POST['time'],$_POST['type']);
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
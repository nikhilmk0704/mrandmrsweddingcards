<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Updatelocation extends CI_Controller {
	function locationUpdate(){
		//get the json Array
		$dataJSON=file_get_contents("php://input");
		if($dataJSON != ''){
		$dataArray=json_decode($dataJSON,TRUE);
			if($dataArray['trip_id']!='' && $dataArray['driver_token']){
			$this->load->model('api/v1/save_upadate_location');
			$output=$this->save_upadate_location->saveLoc($dataArray);
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
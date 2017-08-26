<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Test extends CI_Controller {
	function saveData(){
		//get the json Array
		$dataJSON=file_get_contents("php://input");
		if($dataJSON != ''){
		$dataArray=json_decode($dataJSON,TRUE);
			if($dataArray['description']!=''){
			$this->load->model('api/v1/test_model');
			$output=$this->test_model->dataSave($dataArray);
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
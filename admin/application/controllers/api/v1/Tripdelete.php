<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tripdelete extends CI_Controller {
	function deleteTrip(){
		if(isset($_POST['trip_id']) && isset($_POST['token'])){
			if($_POST['trip_id']!='' && $_POST['token']!=''){
				$this->load->model('api/v1/tripdeletemodel');
				$output=$this->tripdeletemodel->tripDelete($_POST['trip_id'],$_POST['token']);
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
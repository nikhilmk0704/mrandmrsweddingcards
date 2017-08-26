<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Rating extends CI_Controller {
	function save(){
		if(isset($_POST['user_token']) && isset($_POST['trip_id'])&& isset($_POST['rating'])){
			if($_POST['user_token']!='' && $_POST['trip_id']!='' && $_POST['rating']!=''){
				$this->load->model('api/v1/ratingupdate');
				$output=$this->ratingupdate->updateRating($_POST['user_token'],$_POST['trip_id'],$_POST['rating']);
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
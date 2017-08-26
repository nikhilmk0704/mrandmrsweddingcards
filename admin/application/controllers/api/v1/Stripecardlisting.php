<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Stripecardlisting extends CI_Controller {
	function cardListing(){
		if(isset($_POST['user_token'])){
			if($_POST['user_token']!=''){	
				$this->load->model('api/v1/cardlistingmodel');
				$output=$this->cardlistingmodel->listCard($_POST['user_token']);
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

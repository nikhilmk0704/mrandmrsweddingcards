<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Updatedefaultcard extends CI_Controller {
	function cardDefaultUpdate(){
		if(isset($_POST['user_token']) && isset($_POST['card_id'])){
			if($_POST['user_token']!='' && $_POST['card_id']!=''){	
				$this->load->model('api/v1/cardupdatemodel');
				$output=$this->cardupdatemodel->updateCard($_POST['user_token'],$_POST['card_id']);
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

<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mapplot extends CI_Controller {
	public function __construct(){
            parent::__construct();
      
	}
	function addMap(){
		if(isset($_POST['tripid'])){
			if($_POST['tripid']!='' ){
				$this->load->model('api/v1/mapplotmodel');
				$output=$this->mapplotmodel->getDetail($_POST['tripid'],$_POST['choose']);
			}else{
				$output=array("status"=>"fail","description"=>"You missed required data");
			}
		}else{
			$output=array("status"=>"fail","description"=>"You missed required data");
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($output));	
	}
}


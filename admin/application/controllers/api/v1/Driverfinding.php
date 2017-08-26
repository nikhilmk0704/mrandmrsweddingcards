<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Driverfinding extends CI_Controller {
	function findDriver(){
		$this->load->model('api/v1/driverfindingmodel');
		$output=$this->driverfindingmodel->findDriver();
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}
}
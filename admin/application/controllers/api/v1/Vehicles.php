<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Vehicles extends CI_Controller {
	
	function getVehiclescapacity(){
		if(isset($_POST['lat']) && isset($_POST['longi']) && isset($_POST['token'])){
			if($_POST['lat']!='' && $_POST['longi']!='' && $_POST['token']!=''){	
				$lat=$_POST['lat'];
				$longi=$_POST['longi'];
				$token = $_POST['token'];
				$this->load->model('api/v1/vehicle');
				$data=$this->vehicle->getVehiclesCapacity($lat,$longi,$token);
			}else{
				$data=array("status"=>"fail","description"=>"You missed required data");
			}
		}else{
			$data=array("status"=>"fail","description"=>"You missed required data");
		}
		$this->output
    			->set_content_type('application/json')
   				->set_output(json_encode($data));
	}
}
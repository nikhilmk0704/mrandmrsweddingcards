<?php 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Gethiremodel extends CI_Model {
	function getBaseType($basetypeid){
		$sql="SELECT `base_type_id`, `basetype`,image, `last_updated` FROM `vehicle_basetype` WHERE 1 and base_type_id='$basetypeid' AND `isdeleted`='1'";
		$basetypes = $this->db->query($sql);
		$rowTriesCount = $basetypes->row();	
		return $rowTriesCount->basetype;
	}
	function getBaseTypeImage($basetypeid){
		$sql="SELECT `base_type_id`, `basetype`,image, `last_updated` FROM `vehicle_basetype` WHERE 1 and base_type_id='$basetypeid' AND `isdeleted`='1'";
		$basetypes = $this->db->query($sql);
		$rowTriesCount = $basetypes->row();	
		return $rowTriesCount->image;
	}
	function getCapacityType($capacity){
		$sql="SELECT `capacity_id`, `capacity`, `last_updated`, `basetype`, `image` 
			FROM `vehiclecapacities` WHERE 1 and capacity_id='$capacity' AND `status`='1'";
		$capacity = $this->db->query($sql);
		$rowTriesCount = $capacity->row();	
		return $rowTriesCount->capacity;
	}
	function getCapacityTypeImage($capacity){
		$sql="SELECT `capacity_id`, `capacity`, `last_updated`, `basetype`, `image` 
			FROM `vehiclecapacities` WHERE 1 and capacity_id='$capacity' AND `status`='1'";
		$capacity = $this->db->query($sql);
		$rowTriesCount = $capacity->row();	
		return $rowTriesCount->image;
	}
	function getHire($token,$for_hire_id){
		$this->load->model('api/v1/login_model');
		$userid=$this->login_model->get_userinfo_token($token);
		if($userid!='a'){
			$sql_hire = "SELECT `for_hire_trips`.`id`, `for_hire_trips`.`basetype`, `for_hire_trips`.`capacity`, `for_hire_trips`.`rates`, `for_hire_trips`.`free_hrs`, `for_hire_trips`.`per_hr`,`forhire_from_to`.`from`,`forhire_from_to`.`to`,`forhire_from_to`.`from_lat`,`forhire_from_to`.`from_long`,`forhire_from_to`.`to_lat`,`forhire_from_to`.`to_long` FROM `for_hire_trips` LEFT JOIN `forhire_from_to` ON `forhire_from_to`.`id`=`for_hire_trips`.`from_to` WHERE 1 AND `from_to` ='".$for_hire_id."' AND `for_hire_trips`.`basetype` IN 
            
            (SELECT `divers_allocated_vehicles`.`basetype` FROM `divers_allocated_vehicles` LEFT JOIN `driver_location` ON `divers_allocated_vehicles`.`drivers_id`= `driver_location`.`userid` WHERE 1 AND FROM_UNIXTIME(`driver_location`.`timecreated`) > (NOW() - INTERVAL 15 MINUTE))  GROUP BY `for_hire_trips`.`basetype`";
			$hire = $this->db->query($sql_hire);
			$hireArray = array();
			if($hire->num_rows() > 0){
				 foreach ($hire->result_array() as $rowTrip) {
					$getSQL = "SELECT `id`,`capacity`, `from_to`, `rates`, `free_hrs`, `per_hr` FROM `for_hire_trips` WHERE 1 AND `basetype`='".$rowTrip['basetype']."' AND `for_hire_trips`.`capacity` IN        
            (SELECT `divers_allocated_vehicles`.`capacity` FROM `divers_allocated_vehicles` LEFT JOIN `driver_location` ON `divers_allocated_vehicles`.`drivers_id`= `driver_location`.`userid` WHERE 1 AND FROM_UNIXTIME(`driver_location`.`timecreated`) > (NOW() - INTERVAL 15 MINUTE))";
					$getQuery = $this->db->query($getSQL);
					$hireArrayInner = array();
					if($getQuery->num_rows() > 0){
						 foreach ($getQuery->result_array() as $rowTripInner) {
							 $hireArrayInner[]=array(
							 		"id"=>$rowTripInner['id'],
									"capacity_id"=>$rowTripInner['capacity'],
									"capacity"=>$this->getCapacityType($rowTripInner['capacity']),
									"image"=>$this->getCapacityTypeImage($rowTripInner['capacity']),
									"rates"=>$rowTripInner['rates'],
									"free_hrs"=>$rowTripInner['free_hrs'],
									"per_hr"=>$rowTripInner['per_hr'],
									);
						 }
					}
					$hireArray[]=array(
									
									"base_typeid"=>$rowTrip['basetype'],
									"basetype_name"=>$this->getBaseType($rowTrip['basetype']),
									"photo"=>base_url().'uploads/vehicle_basetype_image/'.$this->getBaseTypeImage($rowTrip['basetype']),
									"from"=>$rowTrip['from'],
									"to"=>$rowTrip['to'],
									"from_lat"=>$rowTrip['from_lat'],
									"from_long"=>$rowTrip['from_long'],
									"to_lat"=>$rowTrip['to_lat'],
									"to_long"=>$rowTrip['to_long'],
									"capacity"=> $hireArrayInner
									);
			 }
			}
			 return array("status"=>"success","data"=>array("basetype"=>$hireArray));
		}else{
			return array("status"=>"fail","description"=>"Not a valid user token");
		}
	}
}
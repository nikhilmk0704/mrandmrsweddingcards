<?php 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Vehicle extends CI_Model {
	function getBaseType($basetypeid){
		$sql="SELECT `base_type_id`, `basetype`,image, `last_updated` FROM `vehicle_basetype` WHERE 1 and base_type_id='$basetypeid' AND `isdeleted`='1'";
		$basetypes = $this->db->query($sql);
		$rowTriesCount = $basetypes->row();	
		return $rowTriesCount->basetype;
	}
	function getCapacityType($capacity){
		$sql="SELECT `capacity_id`, `capacity`, `last_updated`, `basetype`, `image` 
			FROM `vehiclecapacities` WHERE 1 and capacity_id='$capacity' AND `status`='1'";
		$capacity = $this->db->query($sql);
		$rowTriesCount = $capacity->row();	
		return $rowTriesCount->capacity;
	}
	function getVehiclesCapacity($latitude,$longitude,$token){
		$this->load->model('api/v1/login_model');
		$userid=$this->login_model->get_userinfo_token($token);
		if($userid!='a'){
			$array_capacity="";
			$array="";
			$getCountSql = "SELECT `tries` FROM `gen_settings_sendmail` WHERE 1";
			$getCountSqlQuery = $this->db->query($getCountSql);
			$rowTriesCount = $getCountSqlQuery->row();	
			$i=$rowTriesCount->tries;	
			$sql_location = "SELECT `driver_location`.`id`,`driver_location`.`userid`, `driver_location`.`created`, `driver_location`.`tripid`, `driver_location`.`latitude`, `driver_location`.`longitude`,
			
			( 6373 * ACOS( COS( RADIANS( $latitude ) ) * COS( RADIANS( `latitude` ) ) * COS( RADIANS(  `longitude` ) - RADIANS( $longitude ) ) + SIN( RADIANS( $latitude ) ) * SIN( RADIANS(  `latitude` ) ) ) ),divers_allocated_vehicles.capacity,divers_allocated_vehicles.basetype
			
			
			FROM `driver_location`,divers_allocated_vehicles WHERE 1 AND ( 6373 * ACOS( COS( RADIANS( $latitude ) ) * COS( RADIANS( `latitude` ) ) * COS( RADIANS(  `longitude` ) - RADIANS( $longitude ) ) + SIN( RADIANS( $latitude ) ) * SIN( RADIANS(  `latitude` ) ) ) ) < (SELECT `radius` FROM `gen_settings_sendmail` WHERE 1) AND `tripid`='' and divers_allocated_vehicles.drivers_id=driver_location.userid AND FROM_UNIXTIME(`driver_location`.`timecreated`) > (NOW() - INTERVAL 15 MINUTE)";
			$driver_location = $this->db->query($sql_location);
			$ar_driver_location = array();
			if($driver_location->num_rows() > 0){
				 foreach ($driver_location->result_array() as $rowdriver) {
					$ar_driver_location[]=array("lati"=>$rowdriver['latitude'],"longi"=>$rowdriver['longitude'],"vehicleCapacityid"=>$rowdriver['capacity'],"vehicleCapacity"=>$this->getCapacityType($rowdriver['capacity']),"basetypeid"=>$rowdriver['basetype'],"basetype"=>$this->getBaseType($rowdriver['basetype']));
			 }
			}
			//getting ALL the basetype and capacity 
			 $sql="SELECT DISTINCT `vehicle_info`.`basetype`,`vehicle_basetype`.`basetype` as `basetype_name`,`vehicle_basetype`.`image`,`vehicle_info`.`capacity` FROM `vehicle_info` LEFT JOIN `vehicle_basetype` ON `vehicle_info`.`basetype` = `vehicle_basetype`.`base_type_id` WHERE 1 AND `vehicle_info`.`idvendorprofile` IN (SELECT `divers_allocated_vehicles`.`vehicle_id` FROM `divers_allocated_vehicles` LEFT JOIN `driver_location` ON `divers_allocated_vehicles`.`drivers_id`= `driver_location`.`userid` WHERE 1 AND ( 6373 * ACOS( COS( RADIANS( $latitude ) ) * COS( RADIANS( `latitude` ) ) * COS( RADIANS(  `longitude` ) - RADIANS( $longitude ) ) + SIN( RADIANS( $latitude ) ) * SIN( RADIANS(  `latitude` ) ) ) ) < (SELECT `radius` FROM `gen_settings_sendmail` WHERE 1) AND FROM_UNIXTIME(`timecreated`) > (NOW() - INTERVAL 15 MINUTE) )  GROUP BY `vehicle_info`.`basetype`";
			$basetypes = $this->db->query($sql);
			$array1 = array();
			 foreach ($basetypes->result_array() as $row) {
				 $capactyArray = array();
				  $getCapacitySQL = "SELECT DISTINCT `vehicle_info`.`capacity`,`vehiclecapacities`.`capacity_id`,`vehiclecapacities`.`capacity` AS `capacity_name`, `vehiclecapacities`.`last_updated`, `vehiclecapacities`.`basetype`, `vehiclecapacities`.`image` FROM `vehicle_info` LEFT JOIN `vehiclecapacities` ON `vehicle_info`.`capacity`= `vehiclecapacities`.`capacity_id` WHERE 1 AND  `vehicle_info`.`basetype` ='".$row['basetype']."' AND `vehiclecapacities`.`status`='1' AND  `vehicle_info`.`idvendorprofile` 
IN (SELECT `divers_allocated_vehicles`.`vehicle_id` FROM `divers_allocated_vehicles` 
LEFT JOIN `driver_location` ON 
`divers_allocated_vehicles`.`drivers_id`= `driver_location`.`userid` WHERE 1 
AND ( 6373 * ACOS( COS( RADIANS( $latitude ) ) * COS( RADIANS( `latitude` ) ) * 
COS( RADIANS(  `longitude` ) - RADIANS( $longitude ) ) + SIN( RADIANS( $latitude) ) * 
SIN( RADIANS(  `latitude` ) ) ) ) < (SELECT `radius` FROM `gen_settings_sendmail` WHERE 1) 
AND FROM_UNIXTIME(`timecreated`) > (NOW() - INTERVAL 15 MINUTE) )";
				 
				$capacities = $this->db->query($getCapacitySQL);
				
				if($capacities->num_rows() > 0){
					foreach ($capacities->result() as $rowCapacity) {
					$capactyArray[] = array("capacity_id"=>$rowCapacity->capacity_id,"capacity"=>$rowCapacity->capacity_name,"image"=>base_url().'uploads/vehicle_capacity_image/'.$rowCapacity->image);
					}
					
				}
				$array1[]=array("base_typeid"=>$row['basetype'],"basetype_name"=>$row['basetype_name'],"photo"=>base_url().'uploads/vehicle_basetype_image/'.$row['image'],"capacity"=>$capactyArray);
		
			 }
		// get the user trip detail	 
			 $sqlTripDetail = "SELECT `id_trip_request`, `requestType`, `createdTime`, `request_from_customer_id`, `basetype`, `vehicletype`, `fromlat`, `tolocation`, `status`, `drivers_id`, `vehicle_current`, `trip_start_time`, `trip_end_time`, `km_coverd`, `trip_amount`, `driver_acceptedTime`, `fromlng`, `fldsendcount`, `charge_id`,`couponValue`, `customerPaidAmount` FROM `trip_request` WHERE 1 AND `request_from_customer_id`='".$userid."' AND `status` < '8'";
			 $tripArray = array();
			 $tripDetail = $this->db->query($sqlTripDetail);
			 if($tripDetail->num_rows() > 0){
				 $rowTrip = $tripDetail->row();
				 $tripArray[] = array("id_trip_request"=>$rowTrip->id_trip_request,"requestType"=>$rowTrip->requestType,"createdTime"=>$rowTrip->createdTime,"request_from_customer_id"=>$rowTrip->request_from_customer_id,"basetype"=>$rowTrip->basetype,"vehicletype"=>$rowTrip->vehicletype,"fromlat"=>$rowTrip->fromlat,"tolocation"=>$rowTrip->tolocation,"status"=>$rowTrip->status,"drivers_id"=>$rowTrip->drivers_id,"vehicle_current"=>$rowTrip->vehicle_current,"trip_start_time"=>$rowTrip->trip_start_time,"trip_end_time"=>$rowTrip->trip_end_time,"km_coverd"=>$rowTrip->km_coverd,"trip_amount"=>$rowTrip->trip_amount,"driver_acceptedTime"=>$rowTrip->driver_acceptedTime,"driver_acceptedTime"=>$rowTrip->driver_acceptedTime,"fromlng"=>$rowTrip->fromlng,"fldsendcount"=>$rowTrip->fldsendcount,"charge_id"=>$rowTrip->charge_id,"customerPaidAmount" => $rowTrip->customerPaidAmount,"couponValue"=>$rowTrip->couponValue);
			 
			 }
			 
			 $array[]=array("basetype"=>$array1,"driver_available"=>$ar_driver_location,"tripdetail"=>$tripArray);
				
			 return array("status"=>"success","data"=>$array);
		}else{
			return array("status"=>"fail","description"=>"Not a valid user token");
		}
	}
	
}
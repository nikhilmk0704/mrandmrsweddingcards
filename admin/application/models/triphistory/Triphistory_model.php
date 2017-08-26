<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Triphistory_model extends CI_Model {
    public function tripList()
    {
        // get the user trip detail	 
			 $sqlTripDetail = "SELECT `id_trip_request`, `requestType`, `createdTime`, `request_from_customer_id`, `basetype`, `vehicletype`, `fromlat`, `tolocation`, `status`, `drivers_id`, `vehicle_current`, `trip_start_time`, `trip_end_time`, `km_coverd`, `trip_amount`, `driver_acceptedTime`, `fromlng`, `fldsendcount`, `charge_id`, `driver_rating`, `for_hire_id`, `coupon_code`, `trip_time`,`couponValue`, `customerPaidAmount` FROM `trip_request` WHERE 1";
			 $tripArray = array();
			 $tripDetail = $this->db->query($sqlTripDetail);
			 if($tripDetail->num_rows() > 0){
               foreach($tripDetail->result() as $rowTrip){ 
				
                $driverName = $this->getUserName($rowTrip->drivers_id);
                $customername = $this->getUserName($rowTrip->request_from_customer_id);
                $vehicleno =    $this->getVehicle($rowTrip->vehicle_current);
				$tripArray[] = array("id_trip_request"=>$rowTrip->id_trip_request,"requestType"=>$rowTrip->requestType,"createdTime"=>$rowTrip->createdTime,"customername"=>$customername,"basetype"=>$rowTrip->basetype,"vehicletype"=>$rowTrip->vehicletype,"fromlat"=>$rowTrip->fromlat,"tolocation"=>$rowTrip->tolocation,"status"=>$rowTrip->status,"driverName"=>$driverName,"vehicle_current"=>$vehicleno,"trip_start_time"=>$rowTrip->trip_start_time,"trip_end_time"=>$rowTrip->trip_end_time,"km_coverd"=>$rowTrip->km_coverd,"trip_amount"=>$rowTrip->trip_amount,"driver_acceptedTime"=>$rowTrip->driver_acceptedTime,"driver_acceptedTime"=>$rowTrip->driver_acceptedTime,"fromlng"=>$rowTrip->fromlng,"fldsendcount"=>$rowTrip->fldsendcount,"charge_id"=>$rowTrip->charge_id,"trip_time"=>$rowTrip->trip_time,"driver_rating"=>$rowTrip->driver_rating,"for_hire_id"=>$rowTrip->for_hire_id,"coupon_code"=>$rowTrip->coupon_code,"customerPaidAmount" => $rowTrip->customerPaidAmount,"couponValue"=>$rowTrip->couponValue);
               }
            return $tripArray;
             }else{
            return 0 ;    
             }
    }
    function getUserName($userid){
		$sql="SELECT  `firstname`, `lastname` FROM `users` WHERE 1 AND `user_id`='$userid'";
		$userName = $this->db->query($sql);
        if($userName->num_rows() > 0){
		  $rowTriesCount = $userName->row();	
		  return $rowTriesCount->firstname." ".$rowTriesCount->lastname;
        }else{
            return null;
        }
	}
    function getVehicle($vehicleId){
		$sql="SELECT  `vehicle_no` FROM `vehicle_info` WHERE 1 AND `idvendorprofile`='$vehicleId'";
		$userName = $this->db->query($sql);
        if($userName->num_rows() > 0){
		  $rowTriesCount = $userName->row();
		  return $rowTriesCount->vehicle_no;
        }else{
            return null;
        }
	}
    function mapList($tripId){
        $sql="SELECT `latitude`, `longitude` FROM `locationupdate` WHERE 1 AND `trip_id`='$tripId'";
		$points = $this->db->query($sql);
        $pointsArray = array();
        if($points->num_rows() > 0){
		   foreach($points->result() as $rowTrip){ 
		      $pointsArray[]=array("latitude"=>$rowTrip->latitude,"longitude"=>$rowTrip->longitude);
             }
            return $pointsArray;
        }else{
            return 0;
        }
    }
    function updateData($tripId){
        $data = array(
            'status' => 6,
        );

        $this->db->where('id_trip_request', $tripId);
        $this->db->update('trip_request', $data);
        return 1;
    }


}
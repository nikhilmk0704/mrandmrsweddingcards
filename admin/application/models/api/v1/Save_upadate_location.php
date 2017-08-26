<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Save_upadate_location extends CI_Model {
	function saveLoc($dataArray){
		$this->load->model('api/v1/login_model');
			$userid=$this->login_model->get_userinfo_token($dataArray['driver_token']);
		if($userid!='a'){
			date_default_timezone_set('GMT');
			// Check driver on same trip
			$sql = "SELECT `id_trip_request` FROM `trip_request` WHERE 1 AND `id_trip_request`='".$dataArray['trip_id']."' AND `drivers_id`='".$userid."' AND `status`='4'";
			
			$trip = $this->db->query($sql);
			
			if($trip->num_rows() > 0){
				foreach($dataArray['points'] as $points){
					$sqlCheck = "SELECT `id` FROM `locationupdate` WHERE 1 AND `trip_id`='".$dataArray['trip_id']."' AND `driver_id`='".$userid."' AND `time` = '".$points['time']."'";
					$sqlCheckQuery = $this->db->query($sqlCheck);
					if($sqlCheckQuery->num_rows() == 0) {
						$dataInsert = array("trip_id" => $dataArray['trip_id'],
							"driver_id" => $userid,
							"latitude" => $points['latitude'],
							"longitude" => $points['longitude'],
							"time" => $points['time'],
							"accuracy" => $points['accuracy'],
							"distance" => $points['distance']
						);
						$this->db->insert('locationupdate', $dataInsert);
					}
				}
				//update driver location in driver_location table
				$sqlLastTime = "SELECT `id`, `trip_id`, `driver_id`, `latitude`, `longitude`, `time` AS updatedtime FROM `locationupdate` WHERE 1 AND `driver_id`='".$userid."' AND `trip_id`='".$dataArray['trip_id']."' ORDER BY `time` DESC LIMIT 1";
				
				$lastRowResult = $this->db->query($sqlLastTime);
				$rowGetTopTime = $lastRowResult->row();
				
				if($lastRowResult->num_rows() > 0){
					$sql_drivers="SELECT `id`, `timecreated`, `latitude`,`longitude`, `userid`,`created`, `tripid` FROM `driver_location` where 1 and userid='".$userid."' AND `iscompleted`=0";
			$drivers=$this->db->query($sql_drivers);
			  if($drivers->num_rows() > 0){
				$drivers = $drivers->row();
				$data=array('latitude'=>$rowGetTopTime->latitude,'longitude'=>$rowGetTopTime->longitude,'timecreated'=>$rowGetTopTime->updatedtime);
				$where=array('id'=>$drivers->id);
				$this->db->where($where);
				$this->db->update('driver_location',$data);
			  
			  }else{
				$insertArray=array(
					 'latitude'=>$rowGetTopTime->latitude,
					 'longitude' => $rowGetTopTime->longitude,
					 'userid' => $userid,
					 'timecreated'=>$rowGetTopTime->updatedtime
					 );
					 $this->db->insert('driver_location',$insertArray);
					  
			  }
				}
				// get the user trip detail	 
			 $sqlTripDetail = "SELECT `id_trip_request`, `requestType`, `createdTime`, `request_from_customer_id`, `basetype`, `vehicletype`, `fromlat`, `tolocation`, `status`, `drivers_id`, `vehicle_current`, `trip_start_time`, `trip_end_time`, `km_coverd`, `trip_amount`, `driver_acceptedTime`, `fromlng`, `fldsendcount`, `charge_id`,`couponValue`, `customerPaidAmount` FROM `trip_request` WHERE 1 AND `id_trip_request`='".$dataArray['trip_id']."'";
			 $tripArray = array();
			 $tripDetail = $this->db->query($sqlTripDetail);
			 if($tripDetail->num_rows() > 0){
				 $rowTrip = $tripDetail->row();
				 $tripArray = array("id_trip_request"=>$rowTrip->id_trip_request,"requestType"=>$rowTrip->requestType,"createdTime"=>$rowTrip->createdTime,"request_from_customer_id"=>$rowTrip->request_from_customer_id,"basetype"=>$rowTrip->basetype,"vehicletype"=>$rowTrip->vehicletype,"fromlat"=>$rowTrip->fromlat,"tolocation"=>$rowTrip->tolocation,"status"=>$rowTrip->status,"drivers_id"=>$rowTrip->drivers_id,"vehicle_current"=>$rowTrip->vehicle_current,"trip_start_time"=>$rowTrip->trip_start_time,"trip_end_time"=>$rowTrip->trip_end_time,"km_coverd"=>$rowTrip->km_coverd,"trip_amount"=>$rowTrip->trip_amount,"driver_acceptedTime"=>$rowTrip->driver_acceptedTime,"driver_acceptedTime"=>$rowTrip->driver_acceptedTime,"fromlng"=>$rowTrip->fromlng,"fldsendcount"=>$rowTrip->fldsendcount,"charge_id"=>$rowTrip->charge_id,"customerPaidAmount" => $rowTrip->customerPaidAmount,"couponValue"=>$rowTrip->couponValue);
			 }
				
				$output=array("status"=>"success","description"=>"Locations saved","data"=>$dataArray,"tripdetail"=>$tripArray);
			}else{
			 	$output=array("status"=>"fail","description"=>"Miss match driver and trip");
			}
			
			
		}else{
				 $output=array("status"=>"fail","description"=>"Not a valid user token");
		}
		return $output;
	}
}
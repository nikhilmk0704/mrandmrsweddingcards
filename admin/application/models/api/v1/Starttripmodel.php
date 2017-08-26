<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Starttripmodel extends CI_Model {
	function updateTrip($driver_token,$time){
		$this->load->model('api/v1/login_model');
			$userid=$this->login_model->get_userinfo_token($driver_token);
		if($userid!='a'){
			date_default_timezone_set('GMT');
			// rejected request
			$sql = "SELECT `id_trip_request` FROM `trip_request` WHERE 1 AND `drivers_id`='".$userid."' AND `status`='3'";
			$trip = $this->db->query($sql);
			if($trip->num_rows() > 0){
				$rowId = $trip->row();
				//update trip_request table
				$data=array('status'=>4,'trip_start_time'=>$time);
				
				$where = array('id_trip_request' => $rowId->id_trip_request,'status'=>3,'drivers_id'=>$userid);
				
				$this->db->where($where);
				
				$this->db->update('trip_request',$data);
				
				// get the user trip detail	 
			 $sqlTripDetail = "SELECT `id_trip_request`, `requestType`, `createdTime`, `request_from_customer_id`, `basetype`, `vehicletype`, `fromlat`, `tolocation`, `status`, `drivers_id`, `vehicle_current`, `trip_start_time`, `trip_end_time`, `km_coverd`, `trip_amount`, `driver_acceptedTime`, `fromlng`, `fldsendcount`, `charge_id` FROM `trip_request` WHERE 1 AND `drivers_id`='".$userid."' AND `status`='4'";
			 $tripArray = array();
			 $tripDetail = $this->db->query($sqlTripDetail);
			 if($tripDetail->num_rows() > 0){
				 $rowTrip = $tripDetail->row();
				 $tripArray = array("id_trip_request"=>$rowTrip->id_trip_request,"requestType"=>$rowTrip->requestType,"createdTime"=>$rowTrip->createdTime,"request_from_customer_id"=>$rowTrip->request_from_customer_id,"basetype"=>$rowTrip->basetype,"vehicletype"=>$rowTrip->vehicletype,"fromlat"=>$rowTrip->fromlat,"tolocation"=>$rowTrip->tolocation,"status"=>$rowTrip->status,"drivers_id"=>$rowTrip->drivers_id,"vehicle_current"=>$rowTrip->vehicle_current,"trip_start_time"=>$rowTrip->trip_start_time,"trip_end_time"=>$rowTrip->trip_end_time,"km_coverd"=>$rowTrip->km_coverd,"trip_amount"=>$rowTrip->trip_amount,"driver_acceptedTime"=>$rowTrip->driver_acceptedTime,"driver_acceptedTime"=>$rowTrip->driver_acceptedTime,"fromlng"=>$rowTrip->fromlng,"fldsendcount"=>$rowTrip->fldsendcount,"charge_id"=>$rowTrip->charge_id);

				 //send pushnotification
				 $this->load->model('Pushnotification_model');
				 $message = "Trip Started";
				 $this->Pushnotification_model->sendPushNotification($rowTrip->request_from_customer_id,$message);
			 }
			 $output=array("status"=>"success","description"=>"successfully done","tripDetail"=>$tripArray);
			}else{
			 $output=array("status"=>"fail","description"=>"No Driver accepted");
			}
			
			
		}else{
				 $output=array("status"=>"fail","description"=>"Not a valid user token");
		}
		return $output;
	}
}
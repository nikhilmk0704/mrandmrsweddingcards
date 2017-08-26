<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mytruckarrivedupdate extends CI_Model {
	function updateArrived($user_token){
		$this->load->model('api/v1/login_model');
			$userid=$this->login_model->get_userinfo_token($user_token);
		if($userid!='a'){
			date_default_timezone_set('GMT');
			// rejected request
			$sql = "SELECT `id_trip_request` FROM `trip_request` WHERE 1 AND `request_from_customer_id`='".$userid."' AND `status`='2'";
			$trip = $this->db->query($sql);
			if($trip->num_rows() > 0){
				$rowId = $trip->row();
				//update trip_request table
				$data=array('status'=>3);
				
				$where = array('id_trip_request' => $rowId->id_trip_request,'status'=>2,'request_from_customer_id'=>$userid);
				$this->db->where($where);
				
				$this->db->update('trip_request',$data);
				
				// get the user trip detail	 
			 $sqlTripDetail = "SELECT `id_trip_request`, `requestType`, `createdTime`, `request_from_customer_id`, `basetype`, `vehicletype`, `fromlat`, `tolocation`, `status`, `drivers_id`, `vehicle_current`, `trip_start_time`, `trip_end_time`, `km_coverd`, `trip_amount`, `driver_acceptedTime`, `fromlng`, `fldsendcount`, `charge_id`, `couponValue`, `customerPaidAmount` FROM `trip_request` WHERE 1 AND `request_from_customer_id`='".$userid."' AND `status` = '3'";
			 $tripArray = array();
			 $tripDetail = $this->db->query($sqlTripDetail);
			 if($tripDetail->num_rows() > 0){
				 $rowTrip = $tripDetail->row();
				 $tripArray = array("id_trip_request"=>$rowTrip->id_trip_request,"requestType"=>$rowTrip->requestType,"createdTime"=>$rowTrip->createdTime,"request_from_customer_id"=>$rowTrip->request_from_customer_id,"basetype"=>$rowTrip->basetype,"vehicletype"=>$rowTrip->vehicletype,"fromlat"=>$rowTrip->fromlat,"tolocation"=>$rowTrip->tolocation,"status"=>$rowTrip->status,"drivers_id"=>$rowTrip->drivers_id,"vehicle_current"=>$rowTrip->vehicle_current,"trip_start_time"=>$rowTrip->trip_start_time,"trip_end_time"=>$rowTrip->trip_end_time,"km_coverd"=>$rowTrip->km_coverd,"trip_amount"=>$rowTrip->trip_amount,"driver_acceptedTime"=>$rowTrip->driver_acceptedTime,"driver_acceptedTime"=>$rowTrip->driver_acceptedTime,"fromlng"=>$rowTrip->fromlng,"fldsendcount"=>$rowTrip->fldsendcount,"charge_id"=>$rowTrip->charge_id,"customerPaidAmount" => $rowTrip->customerPaidAmount,"couponValue"=>$rowTrip->couponValue);

				 //send pushnotification
				 $this->load->model('Pushnotification_model');
				 $message = "Driver arrived";
				 $this->Pushnotification_model->sendPushNotification($rowTrip->request_from_customer_id,$message);

				 $output=array("status"=>"success","description"=>"successfully done","tripDetail"=>$tripArray);

			 }else if ($tripDetail->num_rows() == 0) {
				 //check trip cancelled or not

				 $cancelledSql = "SELECT `id_trip_request` FROM `cancelled_trip_request` WHERE 1 AND `drivers_id`='" . $userid . "' AND `status`='2'";

				 $cancelledTrip = $this->db->query($cancelledSql);

				 if ($cancelledTrip->num_rows() > 0) {

					 $output = array("status" => "fail", "description" => "Trip has been cancelled");

				 }else{
					 $output = array("status" => "fail", "description" => "No trip found");
				 }

			 }else{
				 $output = array("status" => "fail", "description" => "No trip found");
			 }

			}else{
			 $output=array("status"=>"fail","description"=>"No Driver accepted");
			}
			
			
		}else{
				 $output=array("status"=>"fail","description"=>"Not a valid user token");
		}
		return $output;
	}
}
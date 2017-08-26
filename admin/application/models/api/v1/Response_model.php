<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Response_model extends CI_Model {
	function updateDriverResponse($request_id,$driver_token,$time,$type){
		$this->load->model('api/v1/login_model');
			$userid=$this->login_model->get_userinfo_token($driver_token);
			
			$getVehicleSql="SELECT `vehicle_id` FROM `divers_allocated_vehicles` WHERE 1 AND `drivers_id`='".$userid."'";
			
			$vehicles = $this->db->query($getVehicleSql);
			if($vehicles->num_rows() > 0){
				$rowVehicles = $vehicles->row();
				$vehicle_id = $rowVehicles->vehicle_id;
			}else{
				$vehicle_id=0;
			}
		if($userid!='a'){
			$customerDetail = array();
			date_default_timezone_set('GMT');
			// rejected request
			if($type==0){
	
				$data=array('status'=>2,'time'=>$time);
				
				$where = array('tripid' => $request_id, 'userid' => $userid,'status'=>0);
				
				$this->db->where($where);
				
			 	$this->db->update('tbltriprequest_drivers',$data);
				
				//reduce the send count by one
				if($this->db->affected_rows() == 1){
					$sqlSendCount = "SELECT `fldsendcount` FROM `trip_request` WHERE 1 AND `id_trip_request`='".$request_id."'";
					$querySendCount = $this->db->query($sqlSendCount);
					if($querySendCount->num_rows()>0){
						$rowSendCount = $querySendCount->row();
						$sendCount = $rowSendCount->fldsendcount;
						$sendCount = $sendCount -1;
						$data=array('fldsendcount'=>$sendCount);
						$where = array('id_trip_request' => $request_id,'status'=>0);
					
						$this->db->where($where);
					
						$this->db->update('trip_request',$data);
					}
				}
			$output=array("status"=>"success","description"=>"rejected");	
				
			}
			// accepted req
			if($type==1){
				
				//update trip_request table
					$data=array('status'=>1,'drivers_id'=>$userid,'vehicle_current'=>$vehicle_id,'driver_acceptedTime'=>$time);
					
					$where = array('id_trip_request' => $request_id,'status'=>0);
					
					$this->db->where($where);
					
					$this->db->update('trip_request',$data);
					
				
				if($this->db->affected_rows() == 1){
					
					//update tbltriprequest_drivers table
				
					$datafor=array('status'=>1,'time'=>$time);
				
					$wherefor = array('tripid' => $request_id, 'userid' => $userid,'status'=>0);
				
					$this->db->where($wherefor);
				
					$this->db->update('tbltriprequest_drivers',$datafor);
					//update driver location table
					
					$dataloc = array('tripid' => $request_id);
					
					$whereloc = array('userid' => $userid);
					
					$this->db->where($whereloc);
					
					$this->db->update('driver_location',$dataloc);



	
					$customerSql = "SELECT `trip_request`.`id_trip_request`, `trip_request`.`createdTime`, `trip_request`.`request_from_customer_id`, `trip_request`.`fromlat`,`trip_request`.`fromlng`, `users`.`firstname`, `users`.`lastname`, `users`.`useremail`,`users`.`phone` FROM `trip_request` LEFT JOIN `users` ON `trip_request`.`request_from_customer_id` = `users`.`user_id` WHERE 1 AND `trip_request`.`id_trip_request` = '".$request_id."'";
					
					$query = $this->db->query($customerSql);
					if($query->num_rows()>0){
						$rowCustomer = $query->row();
						$customerDetail = array("createdTime"=>$rowCustomer->createdTime,"customerLat"=>$rowCustomer->fromlat,"customerLon"=>$rowCustomer->fromlng,"firstname"=>$rowCustomer->firstname,
							"lastname"=>$rowCustomer->lastname,"useremail"=>$rowCustomer->useremail,"phone"=>$rowCustomer->phone);
						//send pushnotification
						$this->load->model('Pushnotification_model');
						$message = "Driver accepted the trip request";
						$this->Pushnotification_model->sendPushNotification($rowCustomer->request_from_customer_id,$message);
					}
					$output=array("status"=>"success","description"=>"successfully done","customerDetail"=>$customerDetail);				
				}else{
					$output=array("status"=>"fail","description"=>"Someone already accepted");
				}
			}
		}
		else{
				 $output=array("status"=>"fail","description"=>"Not a valid user token");
		}
		return $output;
	}
}
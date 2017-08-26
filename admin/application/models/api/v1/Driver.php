<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Driver extends CI_Model {
	function getRadius(){
		$sql="SELECT `tries`, `radius` FROM `gen_settings_sendmail` WHERE 1";
		$query = $this->db->query($sql);
		 if($query->num_rows() > 0) {
		 	$row = $query->row();
			return $row->radius;
		 }else{
		 	return "a"; 
		 }
	}
	function getTries(){
		$sql="SELECT `tries`, `radius` FROM `gen_settings_sendmail` WHERE 1";
		$query = $this->db->query($sql);
		 if($query->num_rows() > 0) {
		 	$row = $query->row();
			return $row->tries;
		 }else{
		 	return "a"; 
		 }
	}
	
	function save($time,$lat,$longi,$userid){
		$this->load->model('api/v1/login_model');
		$userid=$this->login_model->get_userinfo_token($userid);
		if($userid!='a'){
			$radius=$this->getRadius();
			$tries=$this->getTries();
			date_default_timezone_set('GMT');
			// add availiable items
			$available_items = array();
			$sql_drivers="SELECT `id`, `timecreated`, `latitude`,`longitude`, `userid`,`created`, `tripid` FROM `driver_location` where 1 and userid='$userid' AND `iscompleted`=0";
			$drivers=$this->db->query($sql_drivers);
			  if($drivers->num_rows() > 0){
				$drivers = $drivers->row();
				$data=array('latitude'=>$lat,'longitude'=>$longi,'timecreated'=>$time);
				$where=array('id'=>$drivers->id);
				$this->db->where($where);
				$this->db->update('driver_location',$data);
			  
			  }else{
				$insertArray=array(
					 'latitude'=>$lat,
					 'longitude' => $longi,
					 'userid' => $userid,
					 'timecreated'=>$time
					 );
					 $this->db->insert('driver_location',$insertArray);
					  
			  }
			$sqlFilter="SELECT `id`, `timecreated`, `latitude`,`longitude`, `userid`,`created`, `tripid` FROM `driver_location` where 1 and userid='$userid' ORDER BY `timecreated` DESC LIMIT 0,1";
			$getTripQuery = $this->db->query($sqlFilter);
			
			if($getTripQuery->num_rows() > 0){
				$rowGetTrip = $getTripQuery->row();
				$trip_id = $rowGetTrip->tripid;
				//open trip request details to drivers
				if($trip_id==''){
					$sql="SELECT `tbltriprequest_drivers`.`id`, `tbltriprequest_drivers`.`tripid`, `tbltriprequest_drivers`.`userid`,
`tbltriprequest_drivers`.`status`, `tbltriprequest_drivers`.`time` as acceptedtime FROM
`tbltriprequest_drivers` LEFT JOIN `trip_request` ON `tbltriprequest_drivers`.`tripid` = `trip_request`.`id_trip_request`
WHERE 1 AND `userid`='".$userid."' AND `tbltriprequest_drivers`.`status`=0 AND `trip_request`.`status` = 0";
			$available = $this->db->query($sql);
				if($available->num_rows() > 0){
					foreach ($available->result() as $row) {	
						$available_items[]=array("id"=>$row->id,"tripid"=>$row->tripid,"userid"=>$row->userid,"status"=>$row->status,"time"=>$row->acceptedtime,"ontrip"=>"0");
					}
				}
				}else{
			//accepted trip request details to drivers	
				
					$sqlTripData="SELECT `trip_request`.`id_trip_request`, `trip_request`.`createdTime`, `trip_request`.`request_from_customer_id`,`trip_request`.`fromlat`, `trip_request`.`tolocation` ,`trip_request`.`trip_start_time`, `trip_request`.`driver_acceptedTime`, `trip_request`.`fromlng`,`trip_request`.`status`,`trip_request`.`drivers_id`, `trip_request`.`vehicle_current`, `trip_request`.`trip_start_time`, `trip_request`.`trip_end_time`, `trip_request`.`km_coverd`, `trip_request`.`trip_amount`, `trip_request`.`driver_acceptedTime`, `trip_request`.`fromlng`, `trip_request`.`fldsendcount`, `trip_request`.`charge_id`, `couponValue`, `customerPaidAmount`,`users`.`firstname`, `users`.`lastname`, `users`.`useremail`, `users`.`phone` FROM `trip_request` LEFT JOIN `users` ON `trip_request`.`request_from_customer_id` = `users`.`user_id` WHERE 1
		 AND `trip_request`.id_trip_request='".$trip_id."' AND `trip_request`.`drivers_id`='".$userid."' AND `trip_request`.`status`<= 5";	
		 			$trips = $this->db->query($sqlTripData);
					if($trips->num_rows() > 0){
						$rowTrip = $trips->row();
			 			$available_items[]=array("id_trip_request"=>$rowTrip->id_trip_request,"createdTime"=>$rowTrip->createdTime,"request_from_customer_id"=>$rowTrip->request_from_customer_id,"fromlat"=>$rowTrip->fromlat,"tolocation"=>$rowTrip->tolocation,"trip_start_time"=>$rowTrip->trip_start_time,"driver_acceptedTime"=>$rowTrip->driver_acceptedTime,"fromlng"=>$rowTrip->fromlng,"firstname"=>$rowTrip->firstname,"lastname"=>$rowTrip->lastname,"useremail"=>$rowTrip->useremail,"phone"=>$rowTrip->phone,"ontrip"=>"1","status"=>$rowTrip->status,"drivers_id"=>$rowTrip->drivers_id,"vehicle_current"=>$rowTrip->vehicle_current,"trip_start_time"=>$rowTrip->trip_start_time,"trip_end_time"=>$rowTrip->trip_end_time,"km_coverd"=>$rowTrip->km_coverd,"trip_amount"=>$rowTrip->trip_amount,"driver_acceptedTime"=>$rowTrip->driver_acceptedTime,"fromlng"=>$rowTrip->fromlng,"fldsendcount"=>$rowTrip->fldsendcount,"charge_id"=>$rowTrip->charge_id,"customerPaidAmount" => $rowTrip->customerPaidAmount,"couponValue"=>$rowTrip->couponValue);
					}
				}
			}
			$output=array("status"=>"success","description"=>"successfully saved your location","available"=>$available_items);
		}else{
				 $output=array("status"=>"fail","description"=>"Not a valid user token");
		}
		return $output;
	}
}
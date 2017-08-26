<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ratingupdate extends CI_Model {
	function updateRating($user_token,$trip_id,$rating){
		$this->load->model('api/v1/login_model');
			$userid=$this->login_model->get_userinfo_token($user_token);
		if($userid!='a'){
			date_default_timezone_set('GMT');
			// rejected request
			$sql = "SELECT `id_trip_request`,`drivers_id`,`driver_rating` FROM `trip_request` WHERE 1 AND `request_from_customer_id`='".$userid."' AND `id_trip_request`='".$trip_id."'";
			$trip = $this->db->query($sql);
			if($trip->num_rows() == 1){
				$rowId = $trip->row();
				if($rowId->driver_rating == 0 || $rowId->driver_rating == '0' ){
				//update trip_request table
				
				$data=array('driver_rating'=>$rating,'status'=>8);
				
				$where = array('id_trip_request' => $rowId->id_trip_request, 'status'=>7);
				
				$this->db->where($where);
				
				$this->db->update('trip_request',$data);
				
				//update the driver profile
				$sqlTotal = "SELECT `rating`, `trip_count` FROM `driver_profile` WHERE 1 AND `id_drivers_profile`='".$rowId->drivers_id."'";
				$dri = $this->db->query($sqlTotal);
				if($dri->num_rows() > 0){
					$rowDriverData = $dri->row();
					$countTrip = $rowDriverData->trip_count;
					$ratingDb = $rowDriverData->rating;
					
					$countTrip = $countTrip+1;
					$ratingDb = $ratingDb+$rating;
					
					$data=array('rating'=>$ratingDb,'trip_count'=>$countTrip);
				
					$where = array('id_drivers_profile' => $rowId->drivers_id);
				
					$this->db->where($where);
				
					$this->db->update('driver_profile',$data);
					
					
				}
				
				// get the user trip detail	 
			 $output=array("status"=>"success","description"=>"successfully done");
				}else{
					 $output=array("status"=>"success","description"=>"already rated");
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
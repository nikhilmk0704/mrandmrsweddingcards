<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tripstatusupdate extends CI_Model {
	function updateTrip($user_token,$trip_id){
		$this->load->model('api/v1/login_model');
			$userid=$this->login_model->get_userinfo_token($user_token);
		if($userid!='a'){
			date_default_timezone_set('GMT');
			// rejected request
			$sql = "SELECT `id_trip_request` FROM `trip_request` WHERE 1 AND `request_from_customer_id`='".$userid."' AND `id_trip_request`='".$trip_id."'";
			$trip = $this->db->query($sql);
			if($trip->num_rows() == 1){
				$rowId = $trip->row();
				//update trip_request table
				$data=array('status'=>7);
				
				$where = array('id_trip_request' => $rowId->id_trip_request,'status'=>6);
				
				$this->db->where($where);
				
				$this->db->update('trip_request',$data);
				
				// get the user trip detail	 
			 $output=array("status"=>"success","description"=>"successfully done");
			}else{
			 $output=array("status"=>"fail","description"=>"No Driver accepted");
			}
			
			
		}else{
				 $output=array("status"=>"fail","description"=>"Not a valid user token");
		}
		return $output;
	}
}
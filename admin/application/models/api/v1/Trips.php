<?php 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
include_once("stripe/stripe-php/init.php");
\Stripe\Stripe::setApiKey("sk_test_mdJbzHsFHJp425OUolBNlBo2");
class Trips extends CI_Model {
	function createtrips($fromlocationlat,$vehiclecapacityies,$token,$vehiclebasetypes,$fromlocationlong,$time_current,$coupon_code,$country_code){
		$this->load->model('api/v1/login_model');
		$userid=$this->login_model->get_userinfo_token($token);
		if($userid!='a'){
			//validate the customer stripe account
			$isStripeSql = "SELECT `stripe_cust_id` FROM `users` WHERE 1 AND `user_id`='".$userid."'";
			$getStripeID = $this->db->query($isStripeSql);
			if($getStripeID->num_rows() > 0){
				$rowStripe = $getStripeID->row();
				$stripe_cust_id = $rowStripe->stripe_cust_id;
					
					if($stripe_cust_id != ''){
						try {
						$customer = \Stripe\Customer::retrieve($stripe_cust_id);
						$customerArray = $customer->__toArray(true); 
						$default_card = $customerArray['default_source'];
						if($default_card !=''){
							$sql="SELECT `id_trip_request`, `createdTime`, `request_from_customer_id`, `basetype`, `vehicletype`, `fromlat`, `tolocation`, `status`, `drivers_id`, `vehicle_current`, `trip_start_time`, `trip_end_time`, `km_coverd`, `trip_amount`, `driver_acceptedTime`, `fromlng` FROM `trip_request` WHERE 1
		 and request_from_customer_id='$userid' and status='0'";	
		 				
						$trips = $this->db->query($sql);
						if($trips->num_rows() > 0){
				 			$output=array("status"=>"fail","description"=>"User has already open requests wait for some Driver to respond");
						}else{
							$data = array(
								'request_from_customer_id' => $userid,
								'basetype' => $vehiclebasetypes,
								'vehicletype' => $vehiclecapacityies,
								'fromlat' =>$fromlocationlat,
								'fromlng'=>$fromlocationlong,
								'status'=>'0',
								'createdTime'=>$time_current,
								'coupon_code'=>$coupon_code,
								'country'=>$country_code
							);
							$this->db->insert('trip_request',$data);
							$last_insert_id=$this->db->insert_id();
							$this->load->model('api/v1/driverfindingmodel');
							$this->driverfindingmodel->findDriver();
							$output=array("status"=>"success","description"=>"Trip request has been created","tripid"=>$last_insert_id);
						}
						}else{
							$output=array("status"=>"fail","description"=>'No default card found');
						}
						
					}
					catch (\Stripe\Error\InvalidRequest $e) {
						$output=array("status"=>"stripefail","description"=>$e);
					}
						catch (\Stripe\Error\Card $e) {
							$output=array("status"=>"stripefail","description"=>$e);
						}
					}else{
						$output=array("status"=>"fail","description"=>"No stripe account found!");
					}
		
		
		}
		
		}else{
			 $output=array("status"=>"fail","description"=>"Not a valid user token");
		}
		return $output;
	}
	//for hire response
	function createtripsForHire($fromlocationlat,$vehiclecapacityies,$token,$vehiclebasetypes,$fromlocationlong,$time_current,$isforhire,$for_hire_trip_id,$coupon_code){
		$this->load->model('api/v1/login_model');
		$userid=$this->login_model->get_userinfo_token($token);
		if($userid!='a'){
			//validate the customer stripe account
			$isStripeSql = "SELECT `stripe_cust_id` FROM `users` WHERE 1 AND `user_id`='".$userid."'";
			$getStripeID = $this->db->query($isStripeSql);
			if($getStripeID->num_rows() > 0){
				$rowStripe = $getStripeID->row();
				$stripe_cust_id = $rowStripe->stripe_cust_id;
					
					if($stripe_cust_id != ''){
						try {
						$customer = \Stripe\Customer::retrieve($stripe_cust_id);
						$customerArray = $customer->__toArray(true); 
						$default_card = $customerArray['default_source'];
						if($default_card !=''){
							$sql="SELECT `id_trip_request`, `createdTime`, `request_from_customer_id`, `basetype`, `vehicletype`, `fromlat`, `tolocation`, `status`, `drivers_id`, `vehicle_current`, `trip_start_time`, `trip_end_time`, `km_coverd`, `trip_amount`, `driver_acceptedTime`, `fromlng` FROM `trip_request` WHERE 1
		 and request_from_customer_id='$userid' and status='0'";	
		 				
						$trips = $this->db->query($sql);
						if($trips->num_rows() > 0){
				 			$output=array("status"=>"fail","description"=>"User has already open requests wait for some Driver to respond");
						}else{
							$data = array('request_from_customer_id' => $userid,'basetype' => $vehiclebasetypes,
			'vehicletype' => $vehiclecapacityies,'fromlat' =>$fromlocationlat,'fromlng'=>$fromlocationlong,
			'status'=>'0','createdTime'=>$time_current,	'requestType'=>$isforhire,'for_hire_id'=>$for_hire_trip_id,'coupon_code'=>$coupon_code);
							$this->db->insert('trip_request',$data);
							$last_insert_id=$this->db->insert_id();
							$this->load->model('api/v1/driverfindingmodel');
							$this->driverfindingmodel->findDriver();
							
							$output=array("status"=>"success","description"=>"Trip request has been created","tripid"=>$last_insert_id);
						}
						}else{
							$output=array("status"=>"stripefail","description"=>'No default card found');
						}
						
					}
					catch (\Stripe\Error\Card $e) {
						$output=array("status"=>"stripefail","description"=>$e);
					}						
					}else{
						$output=array("status"=>"fail","description"=>"No stripe account found!");
					}
		
		
		}
		
		}else{
			 $output=array("status"=>"fail","description"=>"Not a valid user token");
		}
		return $output;
	}
}
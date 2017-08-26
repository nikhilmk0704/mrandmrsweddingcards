<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include_once("stripe/stripe-php/init.php");

\Stripe\Stripe::setApiKey("sk_test_mdJbzHsFHJp425OUolBNlBo2");

class Carddeletemodel extends CI_Model {
	function cardDelete($user_token,$card_id){
		
		$this->load->model('api/v1/login_model');
		
		//get user id from user token
		$userid=$this->login_model->get_userinfo_token($user_token);
		if($userid!='a'){
			//check already registered customer
			$sql = "SELECT `stripe_cust_id` FROM `users` WHERE 1 AND `user_id`='".$userid."'";
			$getStripeID = $this->db->query($sql);
			if($getStripeID->num_rows() > 0){
				$rowStripe = $getStripeID->row();
				$stripe_cust_id = $rowStripe->stripe_cust_id;
				
				if($stripe_cust_id != ''){
					$sqlOpenTrip = "SELECT `id_trip_request` FROM `trip_request` WHERE 1 AND `status` > '0' AND `status` < '6' AND `request_from_customer_id`='".$userid."'";
					$customer = \Stripe\Customer::retrieve($stripe_cust_id);
						$customer = $customer->__toArray(true);
					$openTrip = $this->db->query($sqlOpenTrip);
					if($openTrip->num_rows() > 0 && $customer['default_source']==$card_id){
							$output=array("status"=>"fail","description"=>"Please complete your open trip!");
					}else{
						try {
							$cu = \Stripe\Customer::retrieve($stripe_cust_id);
							$cu->sources->retrieve($card_id)->delete();
							$output=array("status"=>"success","description"=>"card deleted");
						}catch (Stripe\Error\InvalidRequest $e) {
							
							$output=array("status"=>"stripefail","description"=>$e);
						}
					}
					
										
				}else{
					$output=array("status"=>"fail","description"=>"No stripe id");
					}
			}
			}else{
				 $output=array("status"=>"fail","description"=>"Not a valid user token");
		}
		return $output;
	}
}
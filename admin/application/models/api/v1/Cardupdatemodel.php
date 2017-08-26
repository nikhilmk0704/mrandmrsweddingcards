<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include_once("stripe/stripe-php/init.php");

\Stripe\Stripe::setApiKey("sk_test_mdJbzHsFHJp425OUolBNlBo2");

class Cardupdatemodel extends CI_Model {
	function updateCard($user_token,$card_id){
		
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
					
					try {
					$cu = \Stripe\Customer::retrieve($stripe_cust_id);
					$cu->default_source =$card_id ;
					$cu->save();
					$output=array("status"=>"success","description"=>"default updated successfully");
					}
					catch (Stripe\Error\InvalidRequest $e) {
						$output=array("status"=>"stripefail","description"=>$e);
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
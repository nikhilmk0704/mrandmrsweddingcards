<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include_once("stripe/stripe-php/init.php");

\Stripe\Stripe::setApiKey("sk_test_mdJbzHsFHJp425OUolBNlBo2");

class Cardlistingmodel extends CI_Model {
	function listCard($user_token){
		
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
				$customer = array();
				if($stripe_cust_id != ''){
					
					try {
						$customer = \Stripe\Customer::retrieve($stripe_cust_id);
						$customer = $customer->__toArray(true); 
						$output=array("status"=>"success","description"=>"card list","data"=>$customer);
					}
					catch (\Stripe\Error\Card $e) {
						$output=array("status"=>"stripefail","description"=>$e);
					}
					catch(\Stripe\Error\InvalidRequest $e){
						$output=array("status"=>"stripefail","description"=>$e);
					}

				}else{
					$customer=null;
					$output=array("status"=>"success","description"=>"No stripe id","data"=>$customer);
					}
			}
			}else{
				 $output=array("status"=>"fail","description"=>"Not a valid user token");
		}
		return $output;
	}
}
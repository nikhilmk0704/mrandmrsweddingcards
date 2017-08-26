<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
include_once("stripe/stripe-php/init.php");

\Stripe\Stripe::setApiKey("sk_test_mdJbzHsFHJp425OUolBNlBo2");
class Cardsavingmodel extends CI_Model
{
    function saveCard($user_token, $card_number, $cvv, $exp_year, $exp_month)
    {

        $this->load->model('api/v1/login_model');

        //get user id from user token
        $userid = $this->login_model->get_userinfo_token($user_token);
        if ($userid != 'a') {
            //check already registered customer
            $sql = "SELECT `stripe_cust_id` FROM `users` WHERE 1 AND `user_id`='" . $userid . "'";
            $getStripeID = $this->db->query($sql);
            if ($getStripeID->num_rows() > 0) {
                $rowStripe = $getStripeID->row();
                $stripe_cust_id = $rowStripe->stripe_cust_id;

                if ($stripe_cust_id == '') {
                    // Create a Customer
                    try {
                        $customer = \Stripe\Customer::create(array(
                                "source" => array("object" => "card", "number" => $card_number, "exp_month" => $exp_month, "exp_year" => $exp_year, "cvc" => $cvv))
                        );

                        //save stripe customer id to database
                        $data = array("stripe_cust_id" => $customer['id']);
                        $this->db->where('user_id', $userid);
                        $this->db->update('users', $data);
                        $output = array("status" => "success", "description" => "User created and card saved successfully", "customer" => $customer);
                    } catch (\Stripe\Error\Card $e) {
                        $output = array("status" => "fail", "description" => $e);
                    }


                } else {
                    //add card to the existing customer
                    try {
                        $cu = \Stripe\Customer::retrieve($stripe_cust_id);
                        $cu->sources->create(array("source" => array("object" => "card", "number" => $card_number, "exp_month" => $exp_month, "exp_year" => $exp_year, "cvc" => $cvv)));

                        $output = array("status" => "success", "description" => "card saved successfully");
                    } catch (\Stripe\Error\Card $e) {
                        $output = array("status" => "stripefail", "description" => $e);
                    }
                }
            }
        } else {
            $output = array("status" => "fail", "description" => "Not a valid user token");
        }
        return $output;
    }
}
<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Stripecardsaving extends CI_Controller {
	function cardSaving(){
		if(isset($_POST['user_token']) && isset($_POST['card_number']) && isset($_POST['cvv']) && isset($_POST['exp_year']) &&  isset($_POST['exp_month'])){
			if($_POST['user_token']!='' && $_POST['card_number']!='' && $_POST['cvv']!='' && $_POST['exp_year']!='' && $_POST['exp_month'] !='' ){	
				$this->load->model('api/v1/cardsavingmodel');
				$output=$this->cardsavingmodel->saveCard($_POST['user_token'],$_POST['card_number'],$_POST['cvv'],$_POST['exp_year'],$_POST['exp_month']);
			}else{
				$output=array("status"=>"fail","description"=>"You missed required data");
			}
		}else{
			$output=array("status"=>"fail","description"=>"You missed required data");
		}
			$this->output
    			->set_content_type('application/json')
   				->set_output(json_encode($output));	
	
	}
}

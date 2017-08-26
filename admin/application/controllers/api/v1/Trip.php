<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Trip extends CI_Controller {
	function tripcreation(){
		if(isset($_POST['fromlocationlat']) && isset($_POST['vehiclecapacityies'])  && isset($_POST['token']) && isset($_POST['vehiclebasetypes']) && isset($_POST['fromlocationlong']) && isset($_POST['isforhire']) && isset($_POST['coupon_code']) && isset($_POST['country_code'])){
			if($_POST['fromlocationlat']!='' &&  $_POST['vehiclecapacityies']!='' && $_POST['token']!='' && $_POST['vehiclebasetypes']!='' && $_POST['fromlocationlong']!='' && $_POST['isforhire']!='' && $_POST['country_code']!=''){
				$this->load->model('api/v1/trips');
				if($_POST['isforhire']=='0'||$_POST['isforhire']==0){	
					$output=$this->trips->createtrips($_POST['fromlocationlat'],$_POST['vehiclecapacityies'],$_POST['token'],$_POST['vehiclebasetypes'],$_POST['fromlocationlong'],$_POST['currenttime'],$_POST['coupon_code'],$_POST['country_code']);
				}else if($_POST['isforhire']=='1'||$_POST['isforhire']==1){
					if(isset($_POST['for_hire_trip_id'])){
						if($_POST['for_hire_trip_id']!=''){
							$output=$this->trips->createtripsForHire($_POST['fromlocationlat'],$_POST['vehiclecapacityies'],$_POST['token'],$_POST['vehiclebasetypes'],$_POST['fromlocationlong'],$_POST['currenttime'],$_POST['isforhire'],$_POST['for_hire_trip_id'],$_POST['coupon_code']);
						}else{
							$output=array("status"=>"fail","description"=>"some datas are missing ");
						}
					}else{
						$output=array("status"=>"fail","description"=>"some datas are missing ");
				}
				}
			}
			}else{
				$output=array("status"=>"fail","description"=>"some datas are missing ");
				}
					$this->output
    					->set_content_type('application/json')
   						->set_output(json_encode($output));
			}
}
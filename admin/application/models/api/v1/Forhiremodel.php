<?php 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Forhiremodel extends CI_Model {
	function getHire($token){
		$this->load->model('api/v1/login_model');
		$userid=$this->login_model->get_userinfo_token($token);
		if($userid!='a'){
			$sql_hire = "SELECT `from`, `to`, `from_lat`, `from_long`, `to_lat`, `to_long` FROM `forhire_from_to` WHERE 1 AND `id` IN (SELECT from_to FROM for_hire_trips)  GROUP BY `from_lat`,`from_long` ";
			$hire = $this->db->query($sql_hire);
			$hireArray = array();
			if($hire->num_rows() > 0){
				 foreach ($hire->result_array() as $rowTrip) {
					$sqlgetToLoc = "SELECT `id`,`from`, `to`, `from_lat`, `from_long`, `to_lat`, `to_long` FROM `forhire_from_to` WHERE 1 AND `from_lat`='".$rowTrip['from_lat']."' AND `from_long`='".$rowTrip['from_long']."' AND `id` IN (SELECT from_to FROM for_hire_trips)";
					$toArrayQuery = $this->db->query($sqlgetToLoc);
					$toArray = array();
					if($toArrayQuery->num_rows() > 0){
						 foreach ($toArrayQuery->result_array() as $rowTo) {
							 $toArray[]=array("id"=>$rowTo['id'],"to_lat"=>$rowTo['to_lat'],"to_long"=>$rowTo['to_long'],"to"=>$rowTo['to']);
						 }
					}
					$hireArray[]=array("from"=>$rowTrip['from'],"from_lat"=>$rowTrip['from_lat'],"from_long"=>$rowTrip['from_long'],"tolocations"=>$toArray);
			 }
			}
			 return array("status"=>"success","data"=>$hireArray);
		}else{
			return array("status"=>"fail","description"=>"Not a valid user token");
		}
	}
}
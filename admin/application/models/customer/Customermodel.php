<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Customermodel extends CI_Model {
    //school template list
    public function customerList()
    {
      $sql = "SELECT `users`.`user_id`, `users`.`firstname`, `users`.`lastname`, `users`.`useremail`, `users`.`password`, `users`.`type`, `users`.`status`, `users`.`phone`, `users`.`datetime`, `users`.`pictures`, `users`.`timezone`, `users`.`roles`,(SELECT count(`id_trip_request`) FROM `trip_request` WHERE 1 AND `request_from_customer_id` = `users`.`user_id`) AS tripcount,(SELECT SUM(`trip_amount`) FROM `trip_request` WHERE 1 AND `request_from_customer_id` = `users`.`user_id`) AS `total_revenue` ,(SELECT count(`row_id`) FROM `tbl_userdevice_manage` WHERE 1 AND `user_id` = `users`.`user_id` AND `dev_type`='0') AS `ioscount`,(SELECT count(`row_id`) FROM `tbl_userdevice_manage` WHERE 1 AND `user_id` = `users`.`user_id` AND `dev_type`='1') AS `androidcount` FROM `users` WHERE 1 AND `type`='1'";
    $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            foreach($query->result() as $rowRes){
		$customer[]=array("user_id" => $rowRes->user_id,"firstname" => $rowRes->firstname,"lastname" => $rowRes->lastname, "useremail" => $rowRes->useremail,
            "status" => $rowRes->status, "phone" => $rowRes->phone,"pictures" => $rowRes->pictures,"androidcount"=>$rowRes->androidcount,
            "ioscount"=>$rowRes->ioscount,"tripcount"=>$rowRes->tripcount,"total_revenue"=>$rowRes->total_revenue);
            }
                return $customer;
        } else {
            return 0;
        }
    }
	
	  //get the school template
    public function getCustomer($id)
    {
         $sql = "SELECT `users`.`user_id`, `users`.`firstname`, `users`.`lastname`, `users`.`useremail`, `users`.`password`, `users`.`type`, `users`.`status`, `users`.`phone`, `users`.`datetime`, `users`.`pictures`, `users`.`timezone`, `users`.`roles`,(SELECT count(`id_trip_request`) FROM `trip_request` WHERE 1 AND `request_from_customer_id` = `users`.`user_id`) AS tripcount,(SELECT count(`row_id`) FROM `tbl_userdevice_manage` WHERE 1 AND `user_id` = `users`.`user_id` AND `dev_type`='0') AS `ioscount`,(SELECT count(`row_id`) FROM `tbl_userdevice_manage` WHERE 1 AND `user_id` = `users`.`user_id` AND `dev_type`='1') AS `androidcount` FROM `users` WHERE 1 AND `type`='1' AND `users`.`user_id`='".$id."'";
		 
    $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
         $rowRes = $query->row();  
		$customer=array("user_id" => $rowRes->user_id,"firstname" => $rowRes->firstname,"lastname" => $rowRes->lastname, "useremail" => $rowRes->useremail, "status" => $rowRes->status, "phone" => $rowRes->phone,"pictures" => $rowRes->pictures,"androidcount"=>$rowRes->androidcount,"ioscount"=>$rowRes->ioscount,"tripcount"=>$rowRes->tripcount);
         
                return $customer;
        } else {
            return 0;
        }
    }
	  //delete the temp
    public function activateCustomer($id)
    {
    	$sql = "SELECT `status` FROM `users` WHERE 1 AND `user_id`='".$id."'";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			$row = $query->row();
			$status = $row->status;
			if($status==0||$status=='0'){
				$data = array('status'=>1);
				$this->db->where('user_id',$id);
				$this->db->update('users',$data);
			}else{
				$data = array('status'=>0);
				$this->db->where('user_id',$id);
				$this->db->update('users',$data);
			}
			return 1;
		}

       
    }
	
	  public function updateCustomer($id,$firstname,$lastname, $phone)
    {
		
           $data = array(
        		'firstname' => $firstname,
				'lastname' => $lastname,
				'phone' => $phone, 
          );
		  $this->db->where('user_id', $id);
          $this->db->update('users', $data);  
		  return 1; 
	}
}
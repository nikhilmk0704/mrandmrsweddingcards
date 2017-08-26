<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Vendors_model extends CI_Model {
	public function __construct()
       {
            parent::__construct();
            date_default_timezone_set('Asia/Kolkata');
      
	   }
    //school template list
    public function vendorList(){
    	$sql = "SELECT `id`, `name`, `emailId`, `phoneNumber`, `createdAt`, `updatedAt`, `enabled` FROM `vendor` WHERE 1";
    	$query = $this->db->query($sql);
        
        if ($query->num_rows() > 0) {
            return $query->result_array();
	
        } else {
            return 0;
        }
    }
	
    //add template details
    public function addVendor($name, $email,$phone){
		$sql = "SELECT `id`  FROM `vendor` WHERE 1 AND `emailId`='".$email."'";
		$query = $this->db->query($sql);
	
	if($query->num_rows() == 0){	
        $data = array(
        	'name' => $name,
			'emailId' => $email,
			'phoneNumber' => $phone, 
        );
        $this->db->insert('vendor', $data);
		$userid = $this->db->insert_id();
		return 1;
	}else{
		return 2;
	}
	}
    public function mail_notification($u_id){
    	
		$this->load->model('notification_model');
    	$type=2;
    	$tablename='users';
    	$this->notification_model->notification_save($type,$tablename,$u_id); 
    }
    //get the school template
    public function getVendors($id){
        
        $sql = "SELECT `id`, `name`, `emailId`, `phoneNumber`, `createdAt`, `updatedAt`,";
        $sql.= " `enabled` FROM `vendor` WHERE 1 AND `vendor`.`id` = '".$id."'";
         //echo $sql;
    	$query = $this->db->query($sql);
        	if ($query->num_rows() > 0) {
            	$rowRes = $query->row_array();
                return $rowRes; 
        	} else {
            	return 0;
       		}
    }
    
    //update the temp

    public function updateVendor($id,$name,$email,$phone)
    {
		
       $data = array(
    		'name' => $name,
			'phoneNumber' => $phone,
			'updatedAt'=>date('Y-m-d H:i:s',time()),
			'emailId' => $email
      );
	  $this->db->where('id', $id);
      $this->db->update('vendor', $data);  
	  return 1; 

    }
    //delete the temp
    public function activateVendor($id){
    	$sql = "SELECT `enabled` FROM `vendor` WHERE 1 AND `id`='".$id."'";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			$row = $query->row();
			$enabled = $row->enabled;
			if($enabled==0||$enabled=='0'){
				$data = array('enabled'=>1);
				$this->db->where('id',$id);
				$this->db->update('vendor',$data);
			}else{
				$data = array('enabled'=>0);
				$this->db->where('id',$id);
				$this->db->update('vendor',$data);
			}
			return 1;
		}
       
    }
	
}
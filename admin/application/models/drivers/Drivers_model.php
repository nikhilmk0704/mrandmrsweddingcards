<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Drivers_model extends CI_Model {
	 public function __construct()
       {
            parent::__construct();
            date_default_timezone_set('Asia/Dubai');
      
	   }
    //school template list
    public function driverList()
    {
      $sql = "SELECT `driver_profile`.`id_drivers_profile`, `driver_profile`.`dob`, `driver_profile`.`rating`, `driver_profile`.`licenseNo`, `driver_profile`.`address1`, `driver_profile`.`address`, `driver_profile`.`city`,`driver_profile`.`status` AS `profile_status`,`driver_profile`.`country`, `driver_profile`.`pin`, `driver_profile`.`companydetails`,  `users`.`user_id`, `users`.`firstname`, `users`.`lastname`, `users`.`useremail`, `users`.`password`, `users`.`type`, `users`.`status`, `users`.`phone`, `users`.`datetime`,`vehicle_info`.`vehicle_no`,`users`.`pictures`, `users`.`timezone`,`driver_location`.timecreated FROM `driver_profile` LEFT JOIN `users` on `driver_profile`.`id_drivers_profile` = `users`.`user_id` LEFT JOIN `vehicle_info` ON `vehicle_info`.`idvendorprofile` = `driver_profile`.`assignedvehicle_id` LEFT JOIN driver_location ON `driver_profile`.`id_drivers_profile` = driver_location.userid WHERE 1";
	  if($this->session->userdata('role')!='1' || $this->session->userdata('role')!=1){
		  $sql .= " AND `driver_profile`.`created_user_id`='".$this->session->userdata('userid')."'";
	  }
    $query = $this->db->query($sql);
	$drivers="";
        if ($query->num_rows() > 0) {
            foreach($query->result() as $rowRes){
		$drivers[]=array("id_drivers_profile" => $rowRes->id_drivers_profile,"dob" => $rowRes->dob,"licenseNo" => $rowRes->licenseNo, "address1" => $rowRes->address1, "address" => $rowRes->address, "city" => $rowRes->city,"country" => $rowRes->country,"pin" => $rowRes->pin,"firstname" => $rowRes->firstname,"lastname" => $rowRes->lastname,"useremail" => $rowRes->useremail,"phone" => $rowRes->phone,"pictures" => $rowRes->pictures,"assignedvehicle"=>$rowRes->vehicle_no,"rating"=>$rowRes->rating,"profile_status"=>$rowRes->profile_status,"lastactive"=>$rowRes->timecreated,"status"=>$rowRes->status);
            }
			
                return $drivers;
        } else {
            return 0;
        }
    }
    
	//add template details
    public function addDriver($firstname,$lastname, $email, $rating, $phone, $dob, $lno, $addr1,$addr2,$city,$country,$pin,$file_name,$vendor_id)
    {
		if ($vendor_id == 0) {
			$vendor_user_id = $this->session->userdata('userid');
		} else {
			$vendor_user_id = $vendor_id;
		}
	$sql = "SELECT `user_id`  FROM `users` WHERE 1 AND `useremail`='".$email."'";
	$query = $this->db->query($sql);
	if($query->num_rows() == 0){	
        $data = array(
        'firstname' => $firstname,
		'lastname' => $lastname,
		'type' => 3,
		'useremail' => $email,  
		'phone' => $phone,
		'status'=>0,
		'roles'=>3,
		'pictures' => $file_name
          );
        $this->db->insert('users', $data);
		$userid = $this->db->insert_id();
		if($userid!=0){		
			$data2 = array(
        			'id_drivers_profile' => $userid,
					'dob' => $dob,
					'licenseNo' => $lno, 
					'address1' => $addr1, 
					'address' => $addr2, 
					'city' => $city,
					'status'=>0,
					'country' => $country,
					'pin' => $pin,
					'rating' => $rating,
					'created_user_id' => $vendor_user_id,
          );
			$this->db->insert('driver_profile',$data2);
			$this->mail_notification($userid);
			return 1;
    	}
	}else{
		return 2;
	}
	}
    
    //get the school template
    public function getDrivers($id)
    {
         $sql = "SELECT `driver_profile`.`id_drivers_profile`,`driver_profile`.`created_user_id`, `driver_profile`.`dob`, `driver_profile`.`licenseNo`,`driver_profile`.`rating`, `driver_profile`.`address1`, `driver_profile`.`address`, `driver_profile`.`city`, `driver_profile`.`country`, `driver_profile`.`pin`, `driver_profile`.`companydetails`,  `users`.`user_id`, `users`.`firstname`, `users`.`lastname`, `users`.`useremail`, `users`.`password`, `users`.`type`, `users`.`status`, `users`.`phone`, `users`.`datetime`, `users`.`pictures`, `users`.`timezone` FROM `driver_profile` LEFT JOIN users on `driver_profile`.`id_drivers_profile` = `users`.`user_id` WHERE 1 AND `driver_profile`.`id_drivers_profile`='".$id."'";
         //echo $sql;
    $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $rowRes = $query->row();

		$drivers=array("created_user_id"=>$rowRes->created_user_id,"id_drivers_profile" => $rowRes->id_drivers_profile,"dob" => $rowRes->dob,"licenseNo" => $rowRes->licenseNo, "address1" => $rowRes->address1, "address" => $rowRes->address, "city" => $rowRes->city,"country" => $rowRes->country,"pin" => $rowRes->pin,"firstname" => $rowRes->firstname,"lastname" => $rowRes->lastname,"useremail" => $rowRes->useremail,"phone" => $rowRes->phone,"pictures" => $rowRes->pictures,"rating"=>$rowRes->rating);
                return $drivers; 
        } else {
            return 0;
        }
    }
    
    //update the temp
    public function updateDrivers($id,$firstname,$lastname, $rating, $phone, $dob, $lno, $addr1,$addr2,$city,$country,$pin,$file_name,$vendor_id)
    {
		if ($vendor_id == 0) {
			$vendor_user_id = $this->session->userdata('userid');
		} else {
			$vendor_user_id = $vendor_id;
		}
		if($file_name!=''){
           $data = array(
        		'firstname' => $firstname,
				'lastname' => $lastname,
				'phone' => $phone, 
				'pictures' => $file_name,
          );
		  $this->db->where('user_id', $id);
          $this->db->update('users', $data);  
		  $data2 = array(
        			
					'dob' => $dob,
					'licenseNo' => $lno, 
					'address1' => $addr1, 
					'address' => $addr2, 
					'city' => $city,
					'country' => $country,
					'pin' => $pin,
					'rating' => $rating,
			  		'created_user_id' => $vendor_user_id
          );
		  $this->db->where('id_drivers_profile', $id);
          $this->db->update('driver_profile', $data2);
		  
		 return 1;
		}else{
			$data = array(
        		'firstname' => $firstname,
				'lastname' => $lastname,
				'phone' => $phone
          );
		  $this->db->where('user_id', $id);
          $this->db->update('users', $data);  
		  $data2 = array(
        			
					'dob' => $dob,
					'licenseNo' => $lno, 
					'address1' => $addr1, 
					'address' => $addr2, 
					'city' => $city,
					'country' => $country,
					'pin' => $pin,
			  		'created_user_id' => $vendor_user_id
          );
		  $this->db->where('id_drivers_profile', $id);
          $this->db->update('driver_profile', $data2);
		  return 1;
			
		}
      
    }
    //delete the temp
    public function deleteVehicles($id)
    {
    	$this->db->delete('vehicle_info', array('idvendorprofile' => $id)); 

       return 1;
    }
	public function vehicleAssign($vehicle_id,$driver_id)
    {
		$sqlVehicleDetail = "SELECT `capacity`, `basetype` FROM `vehicle_info` WHERE 1 AND `idvendorprofile` = '".$vehicle_id."'";
		$queryVehicle = $this->db->query($sqlVehicleDetail);
		$rowRes = $queryVehicle->row();
    	
		$sql="SELECT `id_drivers_allocated_vehicles` FROM `divers_allocated_vehicles` WHERE 1 AND `drivers_id`='".$driver_id."' OR `vehicle_id`='".$vehicle_id."'";
		
		$query = $this->db->query($sql);
        if ($query->num_rows() == 0) {
			$data = array(
						'drivers_id' => $driver_id,
						'vehicle_id' => $vehicle_id,
						'capacity' =>   $rowRes->capacity,
						'basetype' =>   $rowRes->basetype
						);
			$this->db->insert('divers_allocated_vehicles',$data);
			$data2 = array(
						'driver_id' => $driver_id
						);
			$this->db->where('idvendorprofile', $vehicle_id);
          	$this->db->update('vehicle_info', $data2);
			
			$data3 = array(
						'assignedvehicle_id' => $vehicle_id
						);
			$this->db->where('id_drivers_profile', $driver_id);
          	$this->db->update('driver_profile', $data3);		
			return 1;
		}else{
			$this->db->where('drivers_id', $driver_id);
			$this->db->delete('divers_allocated_vehicles');
			
			$this->db->where('vehicle_id', $vehicle_id);
			$this->db->delete('divers_allocated_vehicles');
			
			$this->db->where('driver_id', $driver_id);
			$this->db->update('vehicle_info',array('driver_id'=>'')); 
			
			$this->db->where('assignedvehicle_id', $vehicle_id);
			$this->db->update('driver_profile',array('assignedvehicle_id'=>''));
			
			$data = array(
						'drivers_id' => $driver_id,
						'vehicle_id' => $vehicle_id,
						'capacity' =>   $rowRes->capacity,
						'basetype' =>   $rowRes->basetype
						);
			$this->db->insert('divers_allocated_vehicles',$data);
			$data2 = array(
						'driver_id' => $driver_id
						);
			$this->db->where('idvendorprofile', $vehicle_id);
          	$this->db->update('vehicle_info', $data2);
			
			$data3 = array(
						'assignedvehicle_id' => $vehicle_id
						);
			$this->db->where('id_drivers_profile', $driver_id);
          	$this->db->update('driver_profile', $data3);		
			
			return 1;
		}
    }
	public function vehicleLoad($vehicle_id){
		 $sql = "SELECT `vehicle_info`.`idvendorprofile`, `vehicle_info`.`driver_id`, `vehicle_info`.`vehicle_no`, `vehicle_info`.`make`,`vehicle_info`.`capacity`, `vehicle_info`.`basetype`, `vehicle_info`.`kmreading`, `vehicle_info`.`vendor_userid`, `vehicle_info`.`price_time`, `vehicle_info`.`price_km`, `vehicle_info`.`lattitude`, `vehicle_info`.`longitude`, `vehicle_info`.`status`, `vehicle_info`.`model`, `vehicle_info`.`photo`,`vehicle_basetype`.`basetype` AS `basetype_name` ,`vehicle_info`.`revenue`,`vehiclecapacities`.`capacity` as capacityname FROM `vehicle_info` LEFT JOIN `vehicle_basetype` ON `vehicle_info`.`basetype` = `vehicle_basetype`.`base_type_id` LEFT JOIN `vehiclecapacities` ON `vehiclecapacities`.`capacity_id` = `vehicle_info`.`capacity`   WHERE 1 AND `vehicle_info`.`idvendorprofile`='".$vehicle_id."'";
		  
		  $sqlAlreadyAllocated = "SELECT `id_drivers_allocated_vehicles` FROM `divers_allocated_vehicles` WHERE 1 AND `vehicle_id`='".$vehicle_id."'";
        $sqlAlreadyAllocatedquery = $this->db->query($sqlAlreadyAllocated);
		if ($sqlAlreadyAllocatedquery->num_rows() > 0) {
			$allocated = 1;
		}else{
			$allocated = 0;
		}
		
		$query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $rowRes = $query->row();
		
		$vehicles=array("vehicle_no" => $rowRes->vehicle_no, "capacity" => $rowRes->capacityname, "basetype" => $rowRes->basetype,"photo" => $rowRes->photo,"basetype_name" => $rowRes->basetype_name,"allocated"=>$allocated);
                
	   return $vehicles; 
        }
	}
	public function mail_notification($u_id){
    	
		$this->load->model('notification_model');
    	$type=3;
    	$tablename='users';
    	$this->notification_model->notification_save($type,$tablename,$u_id); 
    }
	 //--send email based on notification
    public function mail_details($userid,$email,$firstname,$lastname)
    {
		$this->load->model('common_model');
        //---------------------------------------------------------------------- get the mail content
        $ip=$this->config->item('ip');
        $key = md5(mt_rand());
        $encr_user_id = urlencode($key . "|" . $userid . "|" . $email);
        //----------
        $link= $ip ."index.php/drivers/drivers/updatePassword/". $encr_user_id;

		$today = date("Y-m-d H:i:s");

		$message = $this->load->view('emailtemplates/driver_invitation_email', '',true);

		$subject="SCT - SignUp Invitation";
        $message = str_replace('{date}',$today, $message);
        $message = str_replace('{user}',$firstname, $message);
        $message = str_replace('{CLICKHERE}',$link, $message);
        $this->common_model->sendEmail($email,$subject,$message);
    }
	
	function driverUnassign($driver_id){
		$this->db->where('drivers_id', $driver_id);
		$this->db->delete('divers_allocated_vehicles');
		
		$this->db->where('id_drivers_profile', $driver_id);
		$this->db->update('driver_profile',array('assignedvehicle_id'=>''));
		
		$this->db->where('driver_id', $driver_id);
		$this->db->update('vehicle_info',array('driver_id'=>'')); 
		return 1;
	}
	
	 //delete the temp
    public function driverUpdate($id,$status)
    {
				//driver table change 
				$this->db->where('id_drivers_profile',$id);
    			$this->db->update('driver_profile', array('status' => $status,'assignedvehicle_id'=>''));
				
				//divers_allocated_vehicles
				$this->db->where('drivers_id',$id);
    			$this->db->delete('divers_allocated_vehicles');
				
				
				//vehicle table change
				$this->db->where('driver_id',$id);
    			$this->db->update('vehicle_info', array('driver_id' => '')); 
        		
				//vehicle table change
				$this->db->where('user_id',$id);
    			$this->db->update('users', array('status' =>$status)); 
				return 1;
		 
    }
	
	  //--check email exist or not
    public function check_sh_data($id,$email)
    {
        $sql = "SELECT `user_id`, `firstname`, `lastname`, `useremail`, `password`, `type`, `status`, `phone`, 
        		`datetime`, `pictures`, `timezone`, `roles`, `stripe_cust_id` FROM `users` WHERE 1 AND `user_id`='".$id."'";

        $q = $this->db->query($sql);
        if ($q->num_rows() > 0) {
        foreach ($q->result() as $row) {
        $data_array = array("user_id" => $row->user_id,"firstname" => $row->firstname,"lastname"=> $row->lastname,
                              "useremail"=> $row->useremail,"type"=> $row->type);             
        }
        return $data_array;
        } else {
            return 0;
        }
    }

    //update password
     public function passwordUpdate($password, $userid)
    {
    	$password = md5($password);
		$this->db->where('user_id',$userid);
    	$this->db->update('users', array('password' =>$password,'status' => 1 ));

    	$this->db->where('id_drivers_profile',$userid);
    	$this->db->update('driver_profile', array('status' => 1 ));

		return 1; 
    }
	
}
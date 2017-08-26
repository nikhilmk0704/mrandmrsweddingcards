<?php 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Login_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Dubai');

	}
	function get_userinfo_token($token){
			$sql="SELECT `row_id`, `user_id`, `device_id`, `dev_type`, `req_type`, `token`, `timestamp` FROM `tbl_userdevice_manage` WHERE 1  and token='$token' ";
		$query = $this->db->query($sql);
		 if($query->num_rows() > 0) {
		 	$row = $query->row();
			return $row->user_id;
		 }else{
		 	return "a"; 
		 }
	}
	function clear_token($token,$deviceid){
		$sql="SELECT `row_id`, `user_id`, `device_id`, `dev_type`, `req_type`, `token`, `timestamp` FROM `tbl_userdevice_manage` WHERE 1 and device_id='$deviceid' and token='$token' ";
		$query = $this->db->query($sql);
		 if($query->num_rows() > 0) {
		 	$this->db->delete('tbl_userdevice_manage', array('token' => $token)); 
			$output=array("status"=>"success","description"=>"Successfully Loggedout");
		 }else{
		 	$output=array("status"=>"fail","description"=>"Token not found");
		 }
		 return $output;
	}
	function getCompany($companyId){
	}
	function validate_user($email,$password,$token,$ostype,$certype){
		//user login 
		date_default_timezone_set('America/Los_Angeles');
		$pwd = md5($password);
        $sql = "SELECT `user_id`, `firstname`, `lastname`, `useremail`, `password`, `type`, `status`, `phone`, `datetime`, `pictures`, `timezone`, `roles`,`tempPasswordFlag`
		 FROM `users` WHERE 1 and useremail='$email' AND password='$pwd' AND status='1'  ";
	 	$query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
			$row = $query->row();
			$profile = array();
			if($row->type==1 || $row->type=='1'){
			$sql_customers="SELECT `idcustomer`, `customer_id`, `address1`, `address2`, `city`, `country`, `pin`, `dob`, `timezone` FROM `customer_profile` WHERE 1 and customer_id='".$row->user_id."'";
			$profiles = $this->db->query($sql_customers);
			if ($profiles->num_rows() > 0) {
			$row_profile = $profiles->row();
			$profile=array("address1"=>$row_profile->address1,"address2"=>$row_profile->address2,"city"=>$row_profile->city,"country"=>$row_profile->country,"pin"=>$row_profile->pin,"dob"=>$row_profile->dob,"timezone"=>$row_profile->timezone);
			}else{
					$profile=null;
			}
			}else if($row->type==3 || $row->type=='3'){
			$sql_drivers="SELECT `dob`, `licenseNo`, `address1`, `address`, `city`, `country`, `pin`, `companydetails`, `id_drivers_profile` FROM `driver_profile` WHERE 1 and id_drivers_profile='".$row->user_id."'";
			$profiles = $this->db->query($sql_drivers);
			if ($profiles->num_rows() > 0) {
			$row_profile = $profiles->row();
			$profile=array("dob"=>$row_profile->dob,"licenseNo"=>$row_profile->licenseNo,"address1"=>$row_profile->address1,"address"=>$row_profile->address,"city"=>$row_profile->city,"country"=>$row_profile->country,"pin"=>$row_profile->pin);
			}
			else{
				$profile=null;
			}
			}
			$key_generate=md5(time().$row->user_id);
			$usserid=$row->user_id;
			$dev_type=$ostype;
			$req_type=$certype;
			$sql_device_check="SELECT `row_id`, `user_id`, `device_id`, `dev_type`, `req_type`, `token`, `timestamp` FROM `tbl_userdevice_manage` WHERE 1 
			and device_id='$token'";
			$device_info = $this->db->query($sql_device_check);
			 if ($device_info->num_rows() > 0) {
				 //update
				
				$data = array('user_id' => $usserid,'device_id' => $token,'dev_type' => $dev_type,'req_type' => $certype,'token'=>$key_generate);
				$this->db->where('device_id',$token);
				$this->db->update('tbl_userdevice_manage', $data);
				$output=array("status"=>"success","description"=>"successfully logged In","data"=>array('user_id' => $usserid,'device_id' => $token,'dev_type' => $dev_type,'req_type' => $certype,'token'=>$key_generate),"usertype"=>$row->type,"tempPasswordFlag"=>$row->tempPasswordFlag,"name"=>$row->firstname,'lastname'=>$row->lastname,"email"=>$row->useremail,"phone"=>$row->phone,"profile"=>$profile);
			 }else{
				 //insert 
				$data = array('user_id' => $usserid,'device_id' => $token,'dev_type' => $dev_type,'req_type' => $certype,'token'=>$key_generate,'device_id'=>$token);
				
			    $this->db->insert('tbl_userdevice_manage',$data); 
					$output=array("status"=>"success","description"=>"successfully logged In","data"=>array('user_id' => $usserid,'device_id' => $token,'dev_type' => $dev_type,'req_type' => $certype,'token'=>$key_generate),"usertype"=>$row->type,"tempPasswordFlag"=>$row->tempPasswordFlag,"name"=>$row->firstname,'lastname'=>$row->lastname,"email"=>$row->useremail,"phone"=>$row->phone,"profile"=>$profile);
				
			 }
		}else{
				$output=array("status"=>"fail","description"=>"username or password is not matching");
		}
		return $output;
	}
	function clear_devicetoken($dt,$val){
		if($val==1){
			$sql_device_check="SELECT `row_id`, `user_id`, `device_id`, `dev_type`, `req_type`, `token`, `timestamp` FROM `tbl_userdevice_manage` WHERE 1 
			and device_id='$token'";
			$device_info = $this->db->query($sql_device_check);
		}else{
		
		}
	}
	function forget_password($email){
		 $email_type=1;
		 $sql = "SELECT `user_id`, `firstname`, `lastname`, `useremail`, `password`, `type`, `status`, `phone`, `datetime`, `pictures`, `timezone`, `roles`
		 FROM `users` WHERE 1 and useremail='$email' AND status='1'";
		$userinfo = $this->db->query($sql);
			 if ($userinfo->num_rows() > 0) {
			 	$row = $userinfo->row();
				$name=$row->firstname.' '.$row->lastname;
				$password=rand(1000,9999);
				$data = array('password' =>md5($password),'tempPasswordFlag'=>1);
				$this->db->where('useremail',$email);
				$this->db->update('users', $data);
				$this->load->model('email_template');
				$output=$this->email_template->email_template_get_forget_password($email_type,$name,$password,$email);
			 }else{
			 $output=array("status"=>"fail","description"=>"This email not a valid");
			 }
			 return $output;
	}
	function chage_password($token,$old_pass,$new_pass){
	$sql_device_check="SELECT `row_id`, `user_id`, `device_id`, `dev_type`, `req_type`, `token`, `timestamp` FROM `tbl_userdevice_manage` WHERE 1 
	and token='$token'";
			$device_info = $this->db->query($sql_device_check);
			 if ($device_info->num_rows() > 0) {
				$row = $device_info->row();
				$userid=$row->user_id;
				$old=md5($old_pass);
				$new=md5($new_pass);
		$sql = "SELECT `user_id`, `firstname`, `lastname`, `useremail`, `password`, `type`, `status`, `phone`, `datetime`, `pictures`, `timezone`, `roles`
		 FROM `users` WHERE 1 and user_id='$userid' AND password='$old' AND status='1'";
	 	$query = $this->db->query($sql);
         if ($query->num_rows() > 0) {
			$row_user = $query->row();
			if($row_user->password==$old){
				$data = array('password' =>$new, 'tempPasswordFlag' => 0);
				$this->db->where('user_id',$row_user->user_id);
				$this->db->update('users', $data);
			$output=array("status"=>"success","description"=>"Password has been successfully changed");	
			}else{
			$output=array("status"=>"fail","description"=>"Your Current Password is not matching ");	
			}
			
		 }else{
			  $output=array("status"=>"fail","description"=>"You are an unauthorized user");
		 }
		 }else{
				 $output=array("status"=>"fail","description"=>"You are an unauthorized user");
			 }
			return $output; 
	}
	function save_user_info($firstname,$lastname,$email,$pass,$type,$token,$certype,$ostype,$phone){
		//SELECT `user_id`, `firstname`, `lastname`, 
		//`useremail`, `password`, `type`, `status`, `phone`, 
		//`datetime`, `pictures`, `timezone`, `roles` FROM `users` WHERE 1
 $sql = "SELECT `user_id`, `firstname`, `lastname`, `useremail`, `password`, `type`, `status`, `phone`, `datetime`, `pictures`, `timezone`,
  `roles` FROM `users` WHERE 1 and useremail='$email'";
		$userinfo = $this->db->query($sql);
			 if ($userinfo->num_rows() > 0) {
		
					$output=array("status"=>"fail","description"=>"Email Already exist");	
		
			 }else{
				$data = array('firstname' => $firstname,'lastname' => $lastname,
		'useremail' => $email,'password' =>md5($pass),'type'=>$type,
		'status'=>'1','phone'=>$phone);
			$this->db->insert('users',$data);

				 $this->mail_notification($this->db->insert_id());
		
		$data1=array("customer_id"=>$this->db->insert_id(),"timezone"=>"GMT");
$this->db->insert('customer_profile',$data1);
	$output=$this->validate_user($email,$pass,$token,$ostype,$certype);
				//	$output=array("status"=>"success","description"=>"User Created Successfully");
			 }
				return $output;
		
	}
	//--send email based on notification
	public function mail_details($userid,$email,$firstname,$lastname)
	{
		$this->load->model('common_model');

		$message = $this->load->view('emailtemplates/user_invitation_email', '',true);

		$today = date("Y-m-d H:i:s");

		$subject="SCT - SignUp Invitation";
		$message = str_replace('{date}',$today, $message);
		$message = str_replace('{user}',$firstname, $message);
		$this->common_model->sendEmail($email,$subject,$message);
	}

	public function mail_notification($u_id){

		$this->load->model('notification_model');
		$type=1;
		$tablename='users';
		$this->notification_model->notification_save($type,$tablename,$u_id);
	}
}
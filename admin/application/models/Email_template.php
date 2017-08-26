<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Email_template extends CI_Model {
	function email_template_get_forget_password($emailtype,$username,$new_pass,$to){
		date_default_timezone_set('GMT');

		$sql="SELECT `id`, `email_template`, `subject`, `type`, `datetime` FROM `email_templates` WHERE 1 and type='$emailtype'";

		$userinfo = $this->db->query($sql);

		$row = $userinfo->row();
		//$message=$row->email_template;
		$message = $this->load->view('emailtemplates/forgot_password_mobile', '',true);
		$subject=$row->subject;
		$today = date("Y-m-d H:i:s");
		$message = str_replace('{user}', $username, $message); 
		$message = str_replace('{pin}', $new_pass, $message);
		$message = str_replace('{date}',$today,$message);
		$this->load->model('common_model');
		$sentStatus=$this->common_model->sendEmail($to,$subject,$message);
		if($sentStatus){
			$output=array("status"=>"success","description"=>"send details to the mail");
			return $output;
		}else {
			$output=array("status"=>"fail","description"=>"email sending failed");
			return $output;
		}

	}
}
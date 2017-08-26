<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Notification_model extends CI_Model {
    public function index() {

    }
    //-- save notification details 
    public function notification_save($type,$tablename,$userid)
    {
        $data = array(
                    'type' => $type,
                    'table_name' => $tablename,
                    'status' =>0,
                    'userid'=>$userid
                     );
        $sql = "SELECT * from notification where type='$type' and table_name='$tablename' and status=0 and userid='$userid'";
        $query = $this->db->query($sql);
        if ($query->num_rows() == 0) {
          $this->db->insert('notification', $data);
        }
        
    }
    
    //--get all notification detail based on status - 0 
    public function get_notification()
    {
        $sql = "SELECT * from notification where  status=0";
        $query = $this->db->query($sql);
        if ($query->num_rows()> 0) {
           return $query->result_array();
        } else {
            return 0;
        }
    }

    //--update tht status 1 - notification details
    public function update_status($id){
        $data1 = array(
            'status' =>1);
        $this->db->where('id', $id);
        $this->db->update('notification', $data1);
    }

    //-------------
     public function get_table_details($type,$tablename,$userid)
     {
        
            $sql = "SELECT `useremail`,`user_id`,`firstname`,`lastname` FROM `users` WHERE 1 AND `user_id`='".$userid."'";
            $query = $this->db->query($sql);
            if ($query->num_rows()> 0) {
              $row = $query->row();
                $invitedArray=array(  "useremail"=>$row->useremail,
                                        "userid"=>$row->user_id,
										"firstname"=>$row->firstname,
										"lastname"=>$row->lastname
                                  		);  
               if(count($invitedArray)>0){
                if($type==3){
                   $this->load->model('drivers/drivers_model');
                   $mail_list=$this->drivers_model->mail_details($invitedArray['userid'],$invitedArray['useremail'],$invitedArray['firstname'],$invitedArray['lastname']);
                }elseif ($type==2) {
                  $this->load->model('vendors/vendors_model');
                  $mail_list=$this->vendors_model->mail_details($invitedArray['userid'],$invitedArray['useremail'],$invitedArray['firstname'],$invitedArray['lastname']);
                    
                }elseif ($type==1) {
                   $this->load->model('api/v1/login_model');
                   $mail_list=$this->login_model->mail_details($invitedArray['userid'],$invitedArray['useremail'],$invitedArray['firstname'],$invitedArray['lastname']);

               }
               }
            return 1;
            }
       
    //---------------
    }

}
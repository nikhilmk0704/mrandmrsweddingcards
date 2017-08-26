<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cronjob extends CI_Controller {
	 public function __construct()
       {
            parent::__construct();
            //date_default_timezone_set('GMT');
       }
    public function index() {
        
    }

    public function send_mail() {
        $this->load->model('notification_model');
        $get_data = $this->notification_model->get_notification();
        if ($get_data != 0) {
            if (count($get_data) > 0) {
                for ($i = 0; $i < count($get_data); $i++){
                    $type = $get_data[$i]['type'];
                    $id = $get_data[$i]['id'];
                    $tablename = $get_data[$i]['table_name'];
                    //-----
                    $userid= $get_data[$i]['userid'];
                    //-----
                    $get_table_data = $this->notification_model->get_table_details($type,$tablename,$userid);
                    if($get_table_data){
                        $this->notification_model->update_status($id);
                    }
                }
            }
        }
    }

}
?>
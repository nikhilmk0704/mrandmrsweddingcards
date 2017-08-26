<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login_model extends CI_Model {

    public function index() {
  
    }
	
    //Check the username and password.
    public function get_user($email,$password) {
        $pwd = md5($password);
        $sql = "SELECT `id`, `firstName`, `lastName`, `mobileNumber`, `emailId`, `password`, `status`, `createdAt`,";
        $sql.=" `updatedAt` FROM `user` WHERE 1 AND `emailId`='".$email."' AND `password`='".$pwd."'";
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $row = $query->row();
            $id = $row->id;
            $firstName = $row->firstName;
            $lastName = $row->lastName;
            $emailId = $row->emailId;
            $status = $row->status;
            $mobileNumber = $row->mobileNumber;
            
            $sessionValue = array(
                'userloggedin' => TRUE,
                'id' => $id,
                'firstName' => $firstName,
                'lastName' => $lastName,
                'emailId' => $emailId,
                'status' => $status,
                'mobileNumber' => $mobileNumber
                );
            $this->session->set_userdata($sessionValue);
            return $sessionValue;
        } else {
            return false;
        }
    }
}
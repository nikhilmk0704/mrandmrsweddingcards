<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mapplotmodel extends CI_Model {
	function getDetail($trip_id,$choose){
        if($choose=='test'){
		 $sql = "SELECT * FROM sct.test where 1 and `description` = '".$trip_id."' ORDER BY time ASC"; 
        }else{
           $sql = "SELECT * FROM sct.locationupdate where 1 and trip_id='".$trip_id."' ORDER BY time ASC";
        }
        $query = $this->db->query($sql);
        $arrayData = array();
        if($query->num_rows() > 0){
            foreach ($query->result() as $row) {
                $arrayData[] = array("latitude"=>$row->latitude,"longitude"=>$row->longitude,"time"=>$row->time,"accuracy"=>$row->accuracy,"distance"=>$row->distance);
            }
            
        }
        $output = array("data"=>$arrayData);
        return $output;
	}
}
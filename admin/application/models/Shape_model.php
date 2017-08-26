<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Shape_model extends CI_Model {
	public function __construct()
       {
            parent::__construct();
            date_default_timezone_set('Asia/Kolkata');
      
	   }
    //school template list
    public function shapeList(){
    	$sql = "SELECT `id`, `shapeName`, `createdAt`, `updatedAt`, `enabled` FROM `productshape` WHERE 1";
    	
        $query = $this->db->query($sql);
        
        if ($query->num_rows() > 0) {
            return $query->result_array();
	
        } else {
            return 0;
        }
    }
	
    //add template details
    public function addShape($name){
		
        $sql = "SELECT `id` FROM `productshape` where 1 AND `shapeName`='".strtolower($name)."'";
		
        $query = $this->db->query($sql);
	
    	if($query->num_rows() == 0){	
            $data = array(
            	'shapeName' => strtolower($name),
            );
            $this->db->insert('productshape', $data);
    		$userid = $this->db->insert_id();
    		return 1;
    	}else{
    		return 2;
    	}
	}
   
    public function getShape($id){
        
        $sql = "SELECT `id`, `shapeName`, `createdAt`, `updatedAt`, `enabled` ";
        $sql.= "  FROM `productshape` WHERE 1 AND `id` = '".$id."'";
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

    public function updateShape($id,$name){
		
       $data = array(
    		'shapeName' => strtolower($name),
			'updatedAt'=>date('Y-m-d H:i:s',time())
       );

	  $this->db->where('id', $id);
      $this->db->update('productshape', $data);  
	  return 1; 

    }
    //delete the temp
    public function activateShape($id){
    	$sql = "SELECT `enabled` FROM `productshape` WHERE 1 AND `id`='".$id."'";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			$row = $query->row();
			$enabled = $row->enabled;
			if($enabled==0||$enabled=='0'){
				$data = array('enabled'=>1);
				$this->db->where('id',$id);
				$this->db->update('productshape',$data);
			}else{
				$data = array('enabled'=>0);
				$this->db->where('id',$id);
				$this->db->update('productshape',$data);
			}
			return 1;
		}
       
    }
	
}
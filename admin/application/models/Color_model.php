<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Color_model extends CI_Model {
	public function __construct()
       {
            parent::__construct();
            date_default_timezone_set('Asia/Kolkata');
      
	   }
    //school template list
    public function colorList(){
    	$sql = "SELECT `id`, `colorName`, `colorCode`, `createdAt`, `updatedAt`, `enabled` FROM `productcolor` WHERE 1";
    	$query = $this->db->query($sql);
        
        if ($query->num_rows() > 0) {
            return $query->result_array();
	
        } else {
            return 0;
        }
    }
	
    //add template details
    public function addColor($name,$color){
		
        $sql = "SELECT `id` FROM `productcolor` WHERE 1 AND `colorCode`='".$color."'";
		
        $query = $this->db->query($sql);
	
    	if($query->num_rows() == 0){	
            $data = array(
            	'colorName' => strtolower($name),
                'colorCode' => $color
            );
            $this->db->insert('productcolor', $data);
    		$userid = $this->db->insert_id();
    		return 1;
    	}else{
    		return 2;
    	}
	}
   
    public function getColor($id){
        
        $sql = "SELECT `id`, `colorName`, `colorCode`, `createdAt`, `updatedAt`, ";
        $sql.= "  `enabled` FROM `productcolor` WHERE 1 AND `id` = '".$id."'";
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

    public function updateColor($id,$name,$color)
    {
		
       $data = array(
    		'colorName' => strtolower($name),
            'colorCode' => $color,
			'updatedAt'=>date('Y-m-d H:i:s',time())
      );
	  $this->db->where('id', $id);
      $this->db->update('productcolor', $data);  
	  return 1; 

    }
    //delete the temp
    public function activateColor($id){
    	$sql = "SELECT `enabled` FROM `productcolor` WHERE 1 AND `id`='".$id."'";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			$row = $query->row();
			$enabled = $row->enabled;
			if($enabled==0||$enabled=='0'){
				$data = array('enabled'=>1);
				$this->db->where('id',$id);
				$this->db->update('productcolor',$data);
			}else{
				$data = array('enabled'=>0);
				$this->db->where('id',$id);
				$this->db->update('productcolor',$data);
			}
			return 1;
		}
       
    }
	
}
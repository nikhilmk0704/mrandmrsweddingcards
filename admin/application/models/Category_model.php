<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Category_model extends CI_Model {
	public function __construct()
       {
            parent::__construct();
            date_default_timezone_set('Asia/Kolkata');
      
	   }
    //school template list
    public function categoryList(){
    	$sql = "SELECT `id`, `categoryName`, `createdAt`, `updatedAt`, `enabled` FROM `productcategory` WHERE 1";
    	$query = $this->db->query($sql);
        
        if ($query->num_rows() > 0) {
            return $query->result_array();
	
        } else {
            return 0;
        }
    }
	
    //add template details
    public function addCategory($name){
		$sql = "SELECT `id` FROM `productcategory` WHERE 1 AND `categoryName`='".strtolower($name)."'";
		
        $query = $this->db->query($sql);
	
    	if($query->num_rows() == 0){	
            $data = array(
            	'categoryName' => strtolower($name)
            );
            $this->db->insert('productcategory', $data);
    		$userid = $this->db->insert_id();
    		return 1;
    	}else{
    		return 2;
    	}
	}
   
    public function getCategory($id){
        
        $sql = "SELECT `id`, `categoryName`, `createdAt`, `updatedAt`, ";
        $sql.= " `enabled` FROM `productcategory` WHERE 1 AND `id` = '".$id."'";
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

    public function updateCategory($id,$name)
    {
		
       $data = array(
    		'categoryName' => strtolower($name),
			'updatedAt'=>date('Y-m-d H:i:s',time())
      );
	  $this->db->where('id', $id);
      $this->db->update('productcategory', $data);  
	  return 1; 

    }
    //delete the temp
    public function activateCategory($id){
    	$sql = "SELECT `enabled` FROM `productcategory` WHERE 1 AND `id`='".$id."'";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			$row = $query->row();
			$enabled = $row->enabled;
			if($enabled==0||$enabled=='0'){
				$data = array('enabled'=>1);
				$this->db->where('id',$id);
				$this->db->update('productcategory',$data);
			}else{
				$data = array('enabled'=>0);
				$this->db->where('id',$id);
				$this->db->update('productcategory',$data);
			}
			return 1;
		}
       
    }
	
}
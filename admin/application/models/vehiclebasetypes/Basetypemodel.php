<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Basetypemodel extends CI_Model {
    //school template list
    public function baseTypeList()
    {
     $sql = "SELECT `base_type_id`, `basetype`,`image`,`last_updated`,`isdeleted` FROM `vehicle_basetype` WHERE 1";
    $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            foreach($query->result() as $rowRes){

                $countSQL = "SELECT count(*) as countVehicle FROM sct.vehicle_info where 1 and basetype='".$rowRes->base_type_id."'";

                $countQUery = $this->db->query($countSQL);
                $row = $countQUery->row();
		$basetype[]=array("base_type_id" => $rowRes->base_type_id,"basetype" => $rowRes->basetype,
                                    "last_updated" => $rowRes->last_updated,"photo"=>$rowRes->image,"isdeleted"=>$rowRes->isdeleted,"countVehicle"=>$row->countVehicle);
            }
                return $basetype;
        } else {
            return 0;
        }
    }
    //add template details
    public function addBasetype($basetype,$filename)
    {
        $data = array(
        'basetype' => $basetype,
		'image' => $filename
         );
        $this->db->insert('vehicle_basetype', $data);
		return 1;
    }
    
    //get the school template
    public function getBasetype($id)
    {
         $sql = "SELECT `base_type_id`, `basetype`,`image`,`last_updated` FROM `vehicle_basetype` WHERE 1 AND `base_type_id`='".$id."'";
         //echo $sql;
    $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $rowRes = $query->row();
		$basetype=array("base_type_id" => $rowRes->base_type_id,"basetype" => $rowRes->basetype,
                                    "last_updated" => $rowRes->last_updated,"photo"=>$rowRes->image);
            
          
                return $basetype; 
            
           // return $query->result_array();
        } else {
            return 0;
        }
    }
    
    //update the temp
    public function updateBasetype($basetype, $basetype_id,$file_name)
    {
         $id = $basetype_id;
		if($file_name != ''){ 
         $data = array(
        'basetype' => $basetype,
		'image' => $file_name
          );
		}else{
			$data = array(
        		'basetype' => $basetype,
          );
		}
       // print_r($data1);
        $this->db->where('base_type_id', $id);
        $this->db->update('vehicle_basetype', $data);
		return 1;  
    }
    //delete the temp
    public function baseTypeUpdate($id,$status)
    {
		// update status in basetype
		$this->db->where('base_type_id',$id);
    	$this->db->update('vehicle_basetype', array('isdeleted' => $status)); 
		// update status in capacity table
		$this->db->where('basetype',$id);
    	$this->db->update('vehiclecapacities', array('status' => $status));
		//update 
		$this->db->where('basetype',$id);
    	$this->db->update('vehicle_info', array('status' => $status));
		
		//driver allocated vehilces
		$this->db->where('basetype', $id);
		$this->db->delete('divers_allocated_vehicles'); 
		 
        return 1;
    }
}
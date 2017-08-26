<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class For_hire_model extends CI_Model {
    //school template list
    public function forHireList()
    {
      $sql = "SELECT `for_hire_trips`.`id`,`for_hire_trips`.`rates`, `for_hire_trips`.`free_hrs`,`vehiclecapacities`.`capacity`,`for_hire_trips`.`per_hr`,`vehicle_basetype`.`basetype` as `basetype_name`,`forhire_from_to`.`from`,`forhire_from_to`.`to` FROM `for_hire_trips` LEFT JOIN `vehicle_basetype` ON `for_hire_trips`.`basetype` = `vehicle_basetype`.`base_type_id` LEFT JOIN `vehiclecapacities` ON `for_hire_trips`.`capacity` = `vehiclecapacities`.`capacity_id` LEFT JOIN `forhire_from_to` ON `forhire_from_to`.`id`=`for_hire_trips`.`from_to` WHERE 1";
    $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            foreach($query->result() as $rowRes){
		$hireList[]=array("id"=>$rowRes->id,"from"=>$rowRes->from,"to"=>$rowRes->to,"rates"=>$rowRes->rates,"free_hrs"=>$rowRes->free_hrs,"per_hr"=>$rowRes->per_hr,"basetype_name"=>$rowRes->basetype_name,"capacity"=>$rowRes->capacity);
            }
             return $hireList;
        } else {
            return 0;
        }
    }
	
    //add template details
    public function addHireTrip($basetype,$capacity,$from_to,$rates,$free_hrs,$per_hr_rate)
    {
        $data = array(
			'basetype' => $basetype,
			'capacity' => $capacity,
			'from_to' => $from_to,
			'rates'=>$rates,
			'free_hrs'=>$free_hrs,
			'per_hr'=>$per_hr_rate,
          );
        $this->db->insert('for_hire_trips', $data);
		return 1;
		
    }
   
    public function capacityGet($id)
    {
		 $sql = "SELECT `vehiclecapacities`.`capacity_id`, `vehiclecapacities`.`capacity` FROM `vehiclecapacities`  WHERE 1 AND`vehiclecapacities`.`basetype`='".$id."' AND `status`='1'";
         //echo $sql;
    $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
			foreach($query->result() as $rowRes){
           
		$capacity[]=array("capacity_id" => $rowRes->capacity_id,"capacity" => $rowRes->capacity);
            
			}
                return $capacity; 
            
        } else {
            return 0;
        }
    }
	 //delete the temp
    public function deleteHireTrip($id)
    {
    	$this->db->delete('for_hire_trips', array('id' => $id)); 

       return 1;
    }
	
//----------------------------------------------location saving-----------------------------------------------------	
	 public function forHireLocationList()
    {
      $sql = "SELECT `id`, `from`, `to`, `from_lat`, `from_long`, `to_lat`, `to_long`,`isdeleted` FROM `forhire_from_to` WHERE 1 AND `isdeleted`='1'";
    $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            foreach($query->result() as $rowRes){
		$hireListLocation[]=array("id"=>$rowRes->id,"from" => $rowRes->from,"to" => $rowRes->to,"from_lat" => $rowRes->from_lat, "from_long" => $rowRes->from_long, "to_lat" => $rowRes->to_lat, "to_long" => $rowRes->to_long,"isdeleted"=>$rowRes->isdeleted);
            }
             return $hireListLocation;
        } else {
            return 0;
        }
    }
	 //add template details
    public function addHireTripLocation($from,$to,$from_lat,$from_long,$to_lat,$to_long)
    {
        $data = array(
			'from' => $from,
			'to'=>$to,
			'from_lat'=>$from_lat,
			'from_long'=>$from_long,
			'to_lat' =>$to_lat,
			'to_long'=>$to_long
          );
        $this->db->insert('forhire_from_to', $data);
		return 1;
		
    }
	 //delete the temp
    public function deleteHireTripLocation($id)
    {
		$data = array('isdeleted'=>0);
		$this->db->where('id' , $id);
    	$this->db->update('forhire_from_to',$data); 

       return 1;
    }
}

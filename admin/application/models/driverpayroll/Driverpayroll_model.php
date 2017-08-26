<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Driverpayroll_model extends CI_Model {
    //school template list
    public function payrollList()
    {
      $sql = "SELECT driver_payroll.`id`, driver_payroll.`basetype`, driver_payroll.`capacity`, driver_payroll.`monthly`, driver_payroll.`min_duty_hr`, driver_payroll.`km_unit`, driver_payroll.`ot_rate`, driver_payroll.`is_active`,`vehicle_basetype`.`basetype` as `basetype_name`,`vehiclecapacities`.`capacity` AS capacity_name FROM `driver_payroll` LEFT JOIN `vehicle_basetype` ON `driver_payroll`.`basetype` = `vehicle_basetype`.`base_type_id` LEFT JOIN `vehiclecapacities` ON `driver_payroll`.`capacity` = `vehiclecapacities`.`capacity_id` WHERE 1 AND driver_payroll.`is_active`='1'";
    $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            foreach($query->result() as $rowRes){
		$payrollList[]=array("id"=>$rowRes->id,"monthly"=>$rowRes->monthly,"min_duty_hr"=>$rowRes->min_duty_hr,"km_unit"=>$rowRes->km_unit,"ot_rate"=>$rowRes->ot_rate,"basetype_name"=>$rowRes->basetype_name,"capacity_name"=>$rowRes->capacity_name);
            }
             return $payrollList;
        } else {
            return 0;
        }
    }
    //add template details
    public function addPayRoll($basetype,$capacity,$monthly,$min_duty_hr,$km_unit,$ot_rate)
    {
        $data = array(
			'basetype' => $basetype,
			'capacity' => $capacity,
			'monthly' => $monthly,
			'min_duty_hr'=>$min_duty_hr,
			'km_unit'=>$km_unit,
			'ot_rate'=>$ot_rate
          );
        $this->db->insert('driver_payroll', $data);
		return 1;
		
    }
   
    public function capacityGet($id)
    {
		 $sql = "SELECT `vehiclecapacities`.`capacity_id`, `vehiclecapacities`.`capacity` FROM `vehiclecapacities`  WHERE 1 AND`vehiclecapacities`.`basetype`='".$id."' AND `status`='1'";
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
    public function deletePayroll($id)
    {
             $this->db->where('id',$id);
    	$this->db->update('driver_payroll', array('is_active' => 0)); 
       return 1;
    }
}

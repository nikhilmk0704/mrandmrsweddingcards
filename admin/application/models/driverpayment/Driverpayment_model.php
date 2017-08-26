<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Driverpayment_model extends CI_Model {
    public function driverPaymentList()
    {
    $sql = "SELECT DISTINCT `drivers_id` FROM `trip_request` WHERE 1";
    $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $totaltriptime = 0;
            $totalkm_ran = 0;
            foreach($query->result() as $rowRes){
                          $getSQL = "SELECT `trip_request`.`id_trip_request`,`trip_request`.`km_coverd`, `trip_request`.`drivers_id`, `trip_request`.`trip_time`,`driver_payroll`.`monthly`, `driver_payroll`.`min_duty_hr`, `driver_payroll`.`km_unit`, `driver_payroll`.`ot_rate` FROM `trip_request` LEFT JOIN `driver_payroll` ON `trip_request`.`vehicletype` = `driver_payroll`.`capacity` WHERE 1  AND `trip_request`.`drivers_id` =  '".$rowRes->drivers_id."'AND `trip_request`.`status`='8' AND `trip_request`.`driver_payment_status` = '0'";
                         $getQuery =  $this->db->query($getSQL);
                            if ($getQuery->num_rows() > 0) {                            
                                $dataArray = array();
                                foreach($getQuery->result() as $rowGetRes){
                                    $totalkm_ran = $rowGetRes->km_coverd;
                                    $totaltriptime = $rowGetRes->trip_time;
                                    $this->calculateDriverWages($rowGetRes->monthly,$totalkm_ran,$rowGetRes->km_unit,$totaltriptime,$rowGetRes->ot_rate,$rowGetRes->min_duty_hr,$rowGetRes->drivers_id,$rowGetRes->id_trip_request);
                                
                                }
                               
                     }  
            }
            $sqlWage = "SELECT sum(`driver_wages`.`triptime`) as `triptime`, sum(`driver_wages`.`km_ran`) as `kmran`, sum(`driver_wages`.`total_amount`) as totalamnt,`users`.`firstname`,`users`.`lastname` FROM `driver_wages` LEFT JOIN `users` ON `driver_wages`.`driver_id`=`users`.`user_id` WHERE 1 GROUP BY `driver_wages`.`driver_id`";
            $dataWageResponse = array();
            $queryWage = $this->db->query($sqlWage);
            if ($queryWage->num_rows() > 0) {
                foreach($queryWage->result() as $rowWage){
                    $dataWageResponse[] = array("triptime"=>$rowWage->triptime,"kmran"=>$rowWage->kmran,"totalamnt"=>$rowWage->totalamnt,"firstname"=>$rowWage->firstname,"lastname"=>$rowWage->lastname);
                }
            }
            return $dataWageResponse;
        } 
        else {
            return 0;
        }
    }
    
    // calcullate wages 
    public function calculateDriverWages($monthly,$km,$unitkm,$overtime,$unittime,$min_duty_hr,$drivers_id,$trip_id){
        if($overtime > $min_duty_hr){
            $extratime = $overtime - $min_duty_hr;
            $totalWage = ceil($monthly + ($km * $unitkm)+($extratime * $unittime));
        }else{
            $totalWage = ceil($monthly + ($km * $unitkm)+(0 * $unittime));
        }
        $data = array(
                'triptime' =>$overtime,
                'km_ran'=>$km,
                'total_amount'=>$totalWage,
                'driver_id'=>$drivers_id,
              );
        $this->db->insert('driver_wages', $data);
        $data=array('driver_payment_status'=>1);
				
				$where = array('id_trip_request' => $trip_id,'status'=>8);
				$this->db->where($where);				
				$this->db->update('trip_request',$data);
        
    }
}
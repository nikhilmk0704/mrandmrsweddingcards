<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Capacitymodel extends CI_Model
{
    //school template list
    public function capacityList()
    {
        $sql = "SELECT vehiclecapacities.`capacity_id`, vehiclecapacities.`capacity`, vehiclecapacities.`last_updated`, vehiclecapacities.`basetype`, vehiclecapacities.`image`, vehiclecapacities.`status`, vehiclecapacities.`basefare`, vehiclecapacities.`km_multiplier`, vehiclecapacities.`time_multiplier`,`vehicle_basetype`.`basetype` as `basetype_name`,vehiclecapacities.`min_hrs` FROM `vehiclecapacities` LEFT JOIN `vehicle_basetype` ON `vehiclecapacities`.`basetype` = `vehicle_basetype`.`base_type_id`  WHERE 1";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $rowRes) {
                $countSQL = "SELECT count(*) as countVehicle FROM sct.vehicle_info where 1 and capacity='".$rowRes->capacity_id."'";

                $countQUery = $this->db->query($countSQL);
                $row = $countQUery->row();
                $capacity[] = array("capacity_id" => $rowRes->capacity_id, "capacity" => $rowRes->capacity, "last_updated" => $rowRes->last_updated, "basetype" => $rowRes->basetype, "photo" => $rowRes->image, "basetype_name" => $rowRes->basetype_name, "status" => $rowRes->status, "basefare" => $rowRes->basefare, "km_multiplier" => $rowRes->km_multiplier, "time_multiplier" => $rowRes->time_multiplier, "min_hrs" => $rowRes->min_hrs,"countVehicle"=>$row->countVehicle);
            }
            return $capacity;
        } else {
            return 0;
        }
    }

    //add template details
    public function addCapacity($basetype, $capacity, $image/*, $basefare, $kmunit, $timeunit, $min_hrs*/)
    {
        $data = array(
            'basetype' => $basetype,
            'capacity' => $capacity,
            /*'time_multiplier' => $timeunit,
            'km_multiplier' => $kmunit,
            'basefare' => $basefare,
            'min_hrs' => $min_hrs,*/
            'image'=>$image
        );
        $this->db->insert('vehiclecapacities', $data);
        return $this->db->insert_id();

    }

    //get the school template
    public function getCapacity($id)
    {
        $sql = "SELECT `vehiclecapacities`.`capacity_id`, `vehiclecapacities`.`capacity`, `vehiclecapacities`.`last_updated`, `vehiclecapacities`.`basetype`, `vehiclecapacities`.`image`, `vehiclecapacities`.`basefare`,`vehiclecapacities`.`km_multiplier`,`vehiclecapacities`.`time_multiplier`,`vehicle_basetype`.`basetype` as `basetype_name`,vehiclecapacities.`min_hrs`,`vehiclecapacities`.`status` FROM `vehiclecapacities` LEFT JOIN `vehicle_basetype` ON `vehiclecapacities`.`basetype` = `vehicle_basetype`.`base_type_id`  WHERE 1 AND`vehiclecapacities`.`capacity_id`='" . $id . "'";
        //echo $sql;
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $rowRes = $query->row();
            $capacity = array("capacity_id" => $rowRes->capacity_id, "capacity" => $rowRes->capacity, "last_updated" => $rowRes->last_updated, "basetype" => $rowRes->basetype, "photo" => $rowRes->image, "basetype_name" => $rowRes->basetype_name, "basefare" => $rowRes->basefare, "km_multiplier" => $rowRes->km_multiplier, "time_multiplier" => $rowRes->time_multiplier, "status" => $rowRes->status, "min_hrs" => $rowRes->min_hrs);
            return $capacity;

            // return $query->result_array();
        } else {
            return 0;
        }
    }

    public function getCapacityBaseTypeBased($id)
    {
        $sql = "SELECT `vehiclecapacities`.`capacity_id`, `vehiclecapacities`.`capacity`, `vehiclecapacities`.`last_updated`, `vehiclecapacities`.`basetype`, `vehiclecapacities`.`image`, `vehiclecapacities`.`basefare`,`vehiclecapacities`.`km_multiplier`,`vehiclecapacities`.`time_multiplier`,`vehicle_basetype`.`basetype` as `basetype_name`,vehiclecapacities.`min_hrs`,`vehiclecapacities`.`status` FROM `vehiclecapacities` LEFT JOIN `vehicle_basetype` ON `vehiclecapacities`.`basetype` = `vehicle_basetype`.`base_type_id`  WHERE 1 AND`vehiclecapacities`.`basetype`='" . $id . "'";
        //echo $sql;
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $rowRes) {
                $capacity[] = array("capacity_id" => $rowRes->capacity_id, "capacity" => $rowRes->capacity, "last_updated" => $rowRes->last_updated, "basetype" => $rowRes->basetype, "photo" => $rowRes->image, "basetype_name" => $rowRes->basetype_name, "status" => $rowRes->status, "basefare" => $rowRes->basefare, "km_multiplier" => $rowRes->km_multiplier, "time_multiplier" => $rowRes->time_multiplier, "min_hrs" => $rowRes->min_hrs);
            }
            return $capacity;
        } else {
            return 0;
        }

    }

    //update the temp
    public function updateCapacity($basetype, $capacity_id, $capacity,$image/*, $basefare, $kmunit, $timeunit, $min_hrs*/)
    {
        $id = $capacity_id;
        if($image != '') {
            $data = array(
                'basetype' => $basetype,
                'capacity' => $capacity,
                /*'time_multiplier' => $timeunit,
                'km_multiplier' => $kmunit,
                'basefare' => $basefare,
                'min_hrs' => $min_hrs,*/
                'image' => $image
            );
        }else {
            $data = array(
                'basetype' => $basetype,
                'capacity' => $capacity,
                /*'time_multiplier' => $timeunit,
                'km_multiplier' => $kmunit,
                'basefare' => $basefare,
                'min_hrs' => $min_hrs*/
            );
        }

        $this->db->where('capacity_id', $id);
        $this->db->update('vehiclecapacities', $data);
        return 1;
    }

    //delete the temp
    public function capacityUpdate($id, $status)
    {
        $sql = "SELECT `vehicle_basetype`.`isdeleted` FROM `vehiclecapacities` LEFT JOIN `vehicle_basetype` ON `vehiclecapacities`.`basetype` =  `vehicle_basetype`.`base_type_id` WHERE 1 AND `vehiclecapacities`.`capacity_id`='" . $id . "'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $rowRes = $query->row();
            if ($rowRes->isdeleted == '1' || $rowRes->isdeleted == 1) {
                //capacity table change
                $this->db->where('capacity_id', $id);
                $this->db->update('vehiclecapacities', array('status' => $status));

                //vehicle table change
                $this->db->where('capacity', $id);
                $this->db->update('vehicle_info', array('status' => $status));

                //driver allocated vehilces
                $this->db->where('capacity', $id);
                $this->db->delete('divers_allocated_vehicles');

                return 1;
            } else {
                return 2;
            }
        }
    }
}
<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Vehiclesmodel extends CI_Model
{
    //school template list
    public function vehicleList()
    {
        $sql = "SELECT `vehicle_info`.`idvendorprofile`, `vehicle_info`.`driver_id`, `vehicle_info`.`vehicle_no`, `vehicle_info`.`make`,`vehicle_info`.`capacity`, `vehicle_info`.`basetype`, `vehicle_info`.`kmreading`, `vehicle_info`.`vendor_userid`, `vehicle_info`.`price_time`, `vehicle_info`.`price_km`, `vehicle_info`.`lattitude`, `vehicle_info`.`longitude`, `vehicle_info`.`status`, `vehicle_info`.`model`, `vehicle_info`.`make`, `vehicle_info`.`photo`,`vehicle_info`.`basefare`,`vehicle_info`.`km_multiplier`,`vehicle_info`.`time_multiplier`,`vehicle_info`.`min_hrs`,`vehicle_info`.`country`,`vehicle_basetype`.`basetype` AS `basetype_name`,`vehiclecapacities`.`capacity` as capacity_name,`vehicle_info`.`revenue`,`users`.`firstname`,`users`.`lastname`,(SELECT `firstname` FROM `users` WHERE 1 AND `user_id`= vehicle_info.vendor_userid) AS vendorFristname, (SELECT `lastname` FROM `users` WHERE 1 AND `user_id`=vehicle_info.vendor_userid) AS vendorLastname  FROM `vehicle_info` LEFT JOIN `vehicle_basetype` ON `vehicle_info`.`basetype` = `vehicle_basetype`.`base_type_id` LEFT JOIN vehiclecapacities ON `vehicle_info`.`capacity` = `vehiclecapacities`.`capacity_id` LEFT JOIN `users` ON `vehicle_info`.`driver_id` = `users`.`user_id` WHERE 1";
        if ($this->session->userdata('role') != '1' || $this->session->userdata('role') != 1) {
            $sql .= " AND `vehicle_info`.`vendor_userid` = '" . $this->session->userdata('userid') . "'";
        }
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $rowRes) {
                $vehicles[] = array("idvendorprofile" => $rowRes->idvendorprofile, "driver_id" => $rowRes->driver_id, "vehicle_no" => $rowRes->vehicle_no, "capacity" => $rowRes->capacity, "basetype" => $rowRes->basetype, "kmreading" => $rowRes->kmreading, "vendor_userid" => $rowRes->vendor_userid, "price_time" => $rowRes->price_time, "price_km" => $rowRes->revenue, "model" => $rowRes->model, "photo" => $rowRes->photo, "basetype_name" => $rowRes->basetype_name, "make" => $rowRes->make, "capacity_name" => $rowRes->capacity_name, "assigneddriver" => $rowRes->firstname . " " . $rowRes->lastname, "status" => $rowRes->status, "vendorFristname" => $rowRes->vendorFristname, "vendorLastname" => $rowRes->vendorLastname,"basefare"=>$rowRes->basefare,"km_multiplier"=>$rowRes->km_multiplier,"time_multiplier"=>$rowRes->time_multiplier,"min_hrs"=>$rowRes->min_hrs,"country"=>$rowRes->country);
            }
            return $vehicles;
        } else {
            return 0;
        }
    }

    //add template details`basefare`, `km_multiplier`, `time_multiplier`, `min_hrs`
    public function addVehicle($basetype, $vehiclenumber, $make, $model, $capacity, $km, $file_name, $vendor_id,$basefare,$kmunit,$timeunit,$min_hrs,$country)
    {
        if ($vendor_id == 0) {
            $vendor_user_id = $this->session->userdata('userid');
        } else {
            $vendor_user_id = $vendor_id;
        }
        $data = array(
            'vehicle_no' => $vehiclenumber,
            'kmreading' => $km,
            'basetype' => $basetype,
            'make' => $make,
            'model' => $model,
            'vendor_userid' => $vendor_user_id,
            'photo' => $file_name,
            'capacity' => $capacity,
            'status' => 1,
            'basefare' => $basefare,
            'km_multiplier' => $kmunit,
            'time_multiplier' => $timeunit,
            'min_hrs' => $min_hrs,
            'country'=>$country
        );
        $this->db->insert('vehicle_info', $data);
        return 1;
    }

    //get the school template
    public function getVehicles($id)
    {
        $sql = "SELECT `vehicle_info`.`idvendorprofile`, `vehicle_info`.`driver_id`, `vehicle_info`.`vehicle_no`, `vehicle_info`.`make`,`vehicle_info`.`capacity`, `vehicle_info`.`basetype`, `vehicle_info`.`kmreading`, `vehicle_info`.`vendor_userid`, `vehicle_info`.`price_time`, `vehicle_info`.`price_km`, `vehicle_info`.`lattitude`, `vehicle_info`.`longitude`, `vehicle_info`.`status`, `vehicle_info`.`model`, `vehicle_info`.`make`, `vehicle_info`.`photo`,`vehicle_info`.`basefare`,`vehicle_info`.`km_multiplier`,`vehicle_info`.`time_multiplier`,`vehicle_info`.`min_hrs`,`vehicle_info`.`country`,`vehicle_basetype`.`basetype` AS `basetype_name` ,`vehicle_basetype`.`isdeleted`,`vehicle_info`.`revenue` FROM `vehicle_info` LEFT JOIN `vehicle_basetype` ON `vehicle_info`.`basetype` = `vehicle_basetype`.`base_type_id`   WHERE 1 AND `vehicle_info`.`idvendorprofile`='" . $id . "'";
        //echo $sql;
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $rowRes = $query->row();
            $vehicles = array("idvendorprofile" => $rowRes->idvendorprofile, "driver_id" => $rowRes->driver_id, "vehicle_no" => $rowRes->vehicle_no, "capacity" => $rowRes->capacity, "basetype" => $rowRes->basetype, "kmreading" => $rowRes->kmreading, "vendor_userid" => $rowRes->vendor_userid, "price_time" => $rowRes->revenue, "price_km" => $rowRes->revenue, "model" => $rowRes->model, "photo" => $rowRes->photo, "basetype_name" => $rowRes->basetype_name, "make" => $rowRes->make, "isdeleted" => $rowRes->isdeleted,"basefare"=>$rowRes->basefare,"km_multiplier"=>$rowRes->km_multiplier,"time_multiplier"=>$rowRes->time_multiplier,"min_hrs"=>$rowRes->min_hrs,"country"=>$rowRes->country);
            return $vehicles;
        } else {
            return 0;
        }
    }

    //update the temp
    public function updateVehicle($basetype, $vehiclenumber, $make, $model, $capacity, $km, $file_name, $id, $vendor_id,$basefare,$kmunit,$timeunit,$min_hrs,$country)
    {
        if ($vendor_id == 0) {
            $vendor_user_id = $this->session->userdata('userid');
        } else {
            $vendor_user_id = $vendor_id;
        }
        if ($file_name != '') {
            $data = array(
                'vehicle_no' => $vehiclenumber,
                'kmreading' => $km,
                'basetype' => $basetype,
                'model' => $model,
                'make' => $make,
                'vendor_userid' => $vendor_user_id,
                'photo' => $file_name,
                'capacity' => $capacity,
                'basefare' => $basefare,
                'km_multiplier' => $kmunit,
                'time_multiplier' => $timeunit,
                'min_hrs' => $min_hrs,
                'country'=>$country

            );
        } else {
            $data = array(
                'vehicle_no' => $vehiclenumber,
                'kmreading' => $km,
                'basetype' => $basetype,
                'model' => $model,
                'make' => $make,
                'vendor_userid' => $vendor_user_id,
                'capacity' => $capacity,
                'basefare' => $basefare,
                'km_multiplier' => $kmunit,
                'time_multiplier' => $timeunit,
                'min_hrs' => $min_hrs,
                'country'=>$country

            );

        }
        // print_r($data1);
        $this->db->where('idvendorprofile', $id);
        $this->db->update('vehicle_info', $data);
        return 1;
    }

    //delete the temp
    public function deleteVehicles($id, $status)
    {
        $sql = "SELECT `vehiclecapacities`.`status` FROM `vehicle_info` LEFT JOIN `vehiclecapacities` ON `vehicle_info`.`capacity` =  `vehiclecapacities`.`capacity_id` WHERE 1 AND `vehicle_info`.`idvendorprofile`='" . $id . "'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $rowRes = $query->row();
            if ($rowRes->status == '1' || $rowRes->status == 1) {

                //divers_allocated_vehicles
                $this->db->where('vehicle_id', $id);
                $this->db->delete('divers_allocated_vehicles');

                $this->db->where('idvendorprofile', $id);
                $this->db->update('vehicle_info', array('status' => $status, 'driver_id' => ''));

                $this->db->where('assignedvehicle_id', $id);
                $this->db->update('driver_profile', array('assignedvehicle_id' => ''));

                return 1;
            } else {
                return 2;

            }
        }
    }

    public function driverLoad($user_id)
    {
        $sql = "SELECT `driver_profile`.`id_drivers_profile`, `driver_profile`.`dob`, `driver_profile`.`licenseNo`, `driver_profile`.`address1`, `driver_profile`.`address`, `driver_profile`.`city`, `driver_profile`.`country`, `driver_profile`.`pin`, `driver_profile`.`companydetails`,  `users`.`user_id`, `users`.`firstname`, `users`.`lastname`, `users`.`useremail`, `users`.`password`, `users`.`type`, `users`.`status`, `users`.`phone`, `users`.`datetime`, `users`.`pictures`, `users`.`timezone` FROM `driver_profile` LEFT JOIN users on  `users`.`user_id` =`driver_profile`.`id_drivers_profile`  WHERE 1 AND `users`.`status`='1' AND `driver_profile`.`id_drivers_profile`='" . $user_id . "' ";

        $sqlAlreadyAllocated = "SELECT `id_drivers_allocated_vehicles` FROM `divers_allocated_vehicles` WHERE 1 AND `drivers_id`='" . $user_id . "'";
        $sqlAlreadyAllocatedquery = $this->db->query($sqlAlreadyAllocated);
        if ($sqlAlreadyAllocatedquery->num_rows() > 0) {
            $allocated = 1;
        } else {
            $allocated = 0;
        }
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $rowRes = $query->row();

            $drivers = array("id_drivers_profile" => $rowRes->id_drivers_profile, "dob" => $rowRes->dob, "licenseNo" => $rowRes->licenseNo, "address1" => $rowRes->address1, "address" => $rowRes->address, "city" => $rowRes->city, "country" => $rowRes->country, "pin" => $rowRes->pin, "firstname" => $rowRes->firstname, "lastname" => $rowRes->lastname, "useremail" => $rowRes->useremail, "phone" => $rowRes->phone, "pictures" => $rowRes->pictures, "allocated" => $allocated);

            return $drivers;
        } else {
            return 0;
        }
    }

    function vehicleUnassign($vehicle_id)
    {
        $this->db->where('vehicle_id', $vehicle_id);
        $this->db->delete('divers_allocated_vehicles');

        $this->db->where('assignedvehicle_id', $vehicle_id);
        $this->db->update('driver_profile', array('assignedvehicle_id' => ''));

        $this->db->where('idvendorprofile', $vehicle_id);
        $this->db->update('vehicle_info', array('driver_id' => ''));
        return 1;
    }
}
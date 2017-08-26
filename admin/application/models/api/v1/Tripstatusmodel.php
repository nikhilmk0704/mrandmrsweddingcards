<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tripstatusmodel extends CI_Model
{
    function getStatus($trip_id, $token, $country_code)
    {
        $this->load->model('api/v1/login_model');
        $userid = $this->login_model->get_userinfo_token($token);

        if ($userid != 'a') {
            date_default_timezone_set('GMT');

            $sql = "SELECT `trip_request`.`id_trip_request`, `trip_request`.`createdTime`, `trip_request`.`request_from_customer_id`, `trip_request`.`basetype`, `trip_request`.`vehicletype`, `trip_request`.`fromlat`, `trip_request`.`tolocation`, `trip_request`.`status`, `trip_request`.`drivers_id`, `trip_request`.`vehicle_current`, `trip_request`.`trip_start_time`, `trip_request`.`trip_end_time`, `trip_request`.`km_coverd`, `trip_request`.`trip_amount`, `trip_request`.`driver_acceptedTime`, `trip_request`.`fromlng`,`trip_request`.`couponValue`,`trip_request`.`customerPaidAmount`,
			`vehiclecapacities`.`capacity` AS `capacityname`,
			`vehicle_basetype`.`basetype` AS `basetypename`
			 FROM `trip_request` LEFT JOIN `vehiclecapacities` ON `trip_request`.`vehicletype` = `vehiclecapacities`.`capacity_id`LEFT JOIN `vehicle_basetype` ON `trip_request`.`basetype` = `vehicle_basetype`.`base_type_id`
			  WHERE 1
		 
		 AND `trip_request`.request_from_customer_id='" . $userid . "' AND `trip_request`.`id_trip_request` = '" . $trip_id . "'";
            $query = $this->db->query($sql);
            if ($query->num_rows() > 0) {
                $driverArray = null;
                $row = $query->row();
                if ($row->drivers_id != '') {
                    $sqlDrivers = "SELECT `driver_location`.`id`, `driver_location`.`timecreated`, `driver_location`.`latitude`, `driver_location`.`longitude`, `driver_location`.`userid`, `driver_location`.`created`, `driver_location`.`tripid`, `driver_location`.`iscompleted`,`users`.`firstname`,`users`.`lastname`,`users`.`useremail`,`users`.`phone` FROM `driver_location` LEFT JOIN `users` ON `driver_location`.`userid` = `users`.`user_id` WHERE 1 AND `userid`='" . $row->drivers_id . "' AND `tripid`='" . $trip_id . "' AND `driver_location`.`iscompleted`='0' ";
                    $queryDrivers = $this->db->query($sqlDrivers);
                    if ($queryDrivers->num_rows() > 0) {
                        $rowDrivers = $queryDrivers->row();
                        $driverArray = array("id" => $rowDrivers->id, "timecreated" => $rowDrivers->timecreated, "latitude" => $rowDrivers->latitude, "longitude" => $rowDrivers->longitude, "firstname" => $rowDrivers->firstname, "lastname" => $rowDrivers->lastname, "useremail" => $rowDrivers->useremail, "phone" => $rowDrivers->phone);

                    }
                }
                $sqlForStandard = "SELECT `id`, `country`, `countryCode`, `exchangeRate`, `distanceUnit`, `currencyCode` FROM `transactionStandards` WHERE 1 AND countryCode ='" . $country_code . "'";
                $standardData = null;
                $queryStandard = $this->db->query($sqlForStandard);
                if ($queryStandard->num_rows() > 0) {
                    $rowStandard = $queryStandard->row();

                    $standardData = array("country" => $rowStandard->country, "country_code" => $rowStandard->countryCode,
                        "exchangeRate" => $rowStandard->exchangeRate,
                        "distanceUnit" => $rowStandard->distanceUnit, "currencyCode" => $rowStandard->currencyCode);
                }
                $output = array("status" => "success",
                    "description" => "Trip Found",
                    "createdTime" => $row->createdTime,
                    "basetypename" => $row->basetypename,
                    "capacityname" => $row->capacityname,
                    "fromlat" => $row->fromlat,
                    "fromlng" => $row->fromlng,
                    "tolocation" => $row->tolocation,
                    "trip_status" => $row->status,
                    "drivers_id" => $row->drivers_id,
                    "driver_acceptedTime" => $row->driver_acceptedTime,
                    "drivers_id" => $row->drivers_id,
                    "vehicle_current" => $row->vehicle_current,
                    "trip_start_time" => $row->trip_start_time,
                    "trip_end_time" => $row->trip_end_time,
                    "km_coverd" => $row->km_coverd,
                    "trip_amount" => $row->trip_amount,
                    "customerPaidAmount" => $row->customerPaidAmount,
                    "couponValue" => $row->couponValue,
                    "driver_detail" => $driverArray,
                    "standardData" => $standardData
                );

            }else if($query->num_rows() == 0){
                $cancelledSql = "SELECT `id_trip_request` FROM `cancelled_trip_request` WHERE 1 AND `id_trip_request`='" . $trip_id . "'";

                $cancelledTrip = $this->db->query($cancelledSql);

                if ($cancelledTrip->num_rows() > 0) {

                    $output = array("status" => "fail", "description" => "Trip has been cancelled");

                }else{
                    $output = array("status" => "fail", "description" => "No trip found");
                }

            } else {
                $output = array("status" => "fail", "description" => "No Trip Found!");
            }
        } else {
            $output = array("status" => "fail", "description" => "Not a valid user token");
        }
        return $output;
    }
}
<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tripdeletemodel extends CI_Model
{
    function tripDelete($trip_id, $token)
    {
        $this->load->model('api/v1/login_model');
        $userid = $this->login_model->get_userinfo_token($token);

        if ($userid != 'a') {

            date_default_timezone_set('GMT');

            try {
                $sql = "INSERT INTO `cancelled_trip_request`

						(`id_trip_request`, `requestType`, `createdTime`, `request_from_customer_id`, `basetype`, `vehicletype`, `fromlat`, `tolocation`, `status`, `drivers_id`, `vehicle_current`,
						`trip_start_time`, `trip_end_time`, `km_coverd`, `trip_amount`, `driver_acceptedTime`, `fromlng`, `fldsendcount`, `charge_id`,
					  	`driver_rating`, `for_hire_id`, `coupon_code`, `trip_time`, `driver_payment_status`, `couponValue`, `customerPaidAmount`, `country`)


						SELECT `id_trip_request`, `requestType`, `createdTime`, `request_from_customer_id`, `basetype`, `vehicletype`, `fromlat`, `tolocation`, `status`, `drivers_id`, `vehicle_current`,
						`trip_start_time`, `trip_end_time`, `km_coverd`, `trip_amount`, `driver_acceptedTime`, `fromlng`, `fldsendcount`, `charge_id`,
					  	`driver_rating`, `for_hire_id`, `coupon_code`, `trip_time`, `driver_payment_status`, `couponValue`, `customerPaidAmount`, `country` FROM `trip_request` WHERE 1 AND `id_trip_request`='" . $trip_id . "'";

                $query = $this->db->query($sql);

                $sqlGetType = "SELECT `users`.`type` FROM `tbl_userdevice_manage` LEFT JOIN `users` ON `users`.`user_id` = `tbl_userdevice_manage`.`user_id` WHERE 1 AND `token`='" . $token . "'";

                $queryTpe = $this->db->query($sqlGetType);

                $row = $queryTpe->row();

                $dataType = array("cancelledType" => $row->type);

                $this->db->where('id_trip_request', $trip_id);
                $this->db->update('cancelled_trip_request', $dataType);

                //copy trip data to cancelled trip table..............

                //delete from trip request table
                $this->db->where('id_trip_request', $trip_id);
                $this->db->delete('trip_request');

                // delete from driver location table
                $this->db->where('tripid', $trip_id);
                $this->db->delete('driver_location');

                // delete from tbltriprequest_drivers
                $this->db->where('tripid', $trip_id);
                $this->db->delete('tbltriprequest_drivers');

                //send pushnotification

                $this->load->model('Pushnotification_model');
                $message = "Trip has been cancelled";

                $sqlGetId = "SELECT `request_from_customer_id`, `drivers_id` FROM `cancelled_trip_request` WHERE 1 AND `id_trip_request` = '" . $trip_id . "'";

                $queryId = $this->db->query($sqlGetId);

                $rowId = $queryId->row();

                $this->Pushnotification_model->sendPushNotification($rowId->request_from_customer_id, $message);
                $this->Pushnotification_model->sendPushNotification($rowId->drivers_id, $message);

                $output = array("status" => "success", "description" => "Trip request cancelled");
            } catch (Exception $e) {

                $output = array("status" => "fail", "description" => "Error Occured", "reason" => $e);

            }


        } else {
            $output = array("status" => "fail", "description" => "Not a valid user token");
        }
        return $output;
    }
}
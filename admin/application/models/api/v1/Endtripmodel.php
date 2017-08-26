<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
include_once("stripe/stripe-php/init.php");
/*sk_live_EN3mv8VBeJXw18gHLiDmVQZ6*/
\Stripe\Stripe::setApiKey("sk_test_mdJbzHsFHJp425OUolBNlBo2");
class Endtripmodel extends CI_Model
{
    function updateEndTrip($trip_id, $driver_token, $endtime, $kmFromDevice)
    {

        $this->load->model('api/v1/login_model');

        $userid = $this->login_model->get_userinfo_token($driver_token);

        if ($userid != 'a') {

            $getTripSQL = "SELECT `trip_request`.`request_from_customer_id`,`trip_request`.`country` FROM `trip_request` WHERE 1 AND id_trip_request = '" . $trip_id . "'";

            $tripQuery = $this->db->query($getTripSQL);

            if ($tripQuery->num_rows() > 0) {

                $rowTripQuery = $tripQuery->row();
            }

            $sqlForStandard = "SELECT `id`, `country`, `countryCode`, `exchangeRate`, `distanceUnit`, `currencyCode` FROM `transactionStandards` WHERE 1 AND countryCode ='" . $rowTripQuery->country . "'";
            $standardData = null;
            $queryStandard = $this->db->query($sqlForStandard);
            if ($queryStandard->num_rows() > 0) {
                $rowStandard = $queryStandard->row();

                $standardData = array("country" => $rowStandard->country, "country_code" => $rowStandard->countryCode,
                    "exchangeRate" => $rowStandard->exchangeRate,
                    "distanceUnit" => $rowStandard->distanceUnit, "currencyCode" => $rowStandard->currencyCode);

            }
            /*------------------------------ Distance Calculation From Server Side----------------------------*/

            $sql = "SELECT  `latitude`, `longitude` FROM `locationupdate` WHERE 1 AND `trip_id`='" . $trip_id . "'";

            $query = $this->db->query($sql);

            if ($query->num_rows() > 0) {
                foreach ($query->result() as $rowRes) {
                    $points[] = array("lat" => $rowRes->latitude, "lng" => $rowRes->longitude);
                }
                if (count($points) > 0) {
                    $kmFromServer = 0;
                    for ($i = 0; $i < count($points); $i++) {
                        if ($i < (count($points) - 1)) {
                            $kmFromServer += $this->distanceGeoPoints($points[$i]['lat'], $points[$i]['lng'], $points[$i + 1]['lat'], $points[$i + 1]['lng']);
                        }
                    }
                } else {
                    $kmFromServer = 0;
                }

            } else {
                $kmFromServer = 0;
            }
            /*------------------------------ !Distance Calculation From Server Side ----------------------------*/

            if ($kmFromDevice > $kmFromServer) {
                $km_done = $kmFromDevice;
            } else {
                $km_done = $kmFromServer;
            }
            // stripe payment completion.......

            $isStripeSql = "SELECT `stripe_cust_id` FROM `users` WHERE 1 AND `user_id`='" . $rowTripQuery->request_from_customer_id . "'";
            $getStripeID = $this->db->query($isStripeSql);
            if ($getStripeID->num_rows() > 0) {
                $rowStripe = $getStripeID->row();
                $stripe_cust_id = $rowStripe->stripe_cust_id;
                $isAlreadyPaid = "SELECT `id_trip_request` FROM `trip_request` WHERE 1 AND `charge_id` !='0' AND `id_trip_request`='" . $trip_id . "'";
                $isAlreadyPaidResult = $this->db->query($isAlreadyPaid);
                if ($isAlreadyPaidResult->num_rows() == 0) {
                    //fare calculation function call
                    $arrayData = $this->calculateFare($trip_id, $endtime, $km_done, $userid);
                    if ($arrayData['arrayData']['fare'] > 0) {
                        try {
                            $res = \Stripe\Charge::create(array(
                                "amount" => $arrayData['arrayData']['fare'],
                                "currency" => "usd",
                                "customer" => $stripe_cust_id
                            ));
                            $res = $res->__toArray(true);

                            // update trip request table

                            //send pushnotification
                            $this->load->model('Pushnotification_model');
                            $message = "Trip completed and payment is successful";
                            $this->Pushnotification_model->sendPushNotification($rowTripQuery->request_from_customer_id, $message);


                            $data1 = array('status' => 6, 'trip_end_time' => $endtime, 'km_coverd' => $km_done, 'trip_amount' => $arrayData['arrayData']['exactTripFare'], 'charge_id' => $res['id'], "trip_time" => $arrayData['arrayData']['trip_time'], "customerPaidAmount" => $arrayData['arrayData']['fare'], "couponValue" => $arrayData['arrayData']['couponValue']);

                            $emailStatus = $this->mailSendToCustomer($trip_id, $data1);

                            $output = array("status" => "success", "description" => "fare calculated", "data" => $arrayData['arrayData'], "stripedata" => $res, "standardData" => $standardData);


                        } catch (Stripe\Error\InvalidRequest $e) {

                            //send pushnotification
                            $this->load->model('Pushnotification_model');
                            $message = "Trip completed and payment unsuccessful";
                            $this->Pushnotification_model->sendPushNotification($rowTripQuery->request_from_customer_id, $message);

                            $data1 = array('status' => 5, 'trip_end_time' => $endtime, 'km_coverd' => $km_done, 'trip_amount' => $arrayData['arrayData']['exactTripFare'], 'charge_id' => 0, "trip_time" => $arrayData['arrayData']['trip_time'], "customerPaidAmount" => $arrayData['arrayData']['fare'], "couponValue" => $arrayData['arrayData']['couponValue']);

                            $emailStatus = $this->mailSendToCustomer($trip_id, $data1);
                            $output = array("status" => "stripefail", "description" => $e, "data" => $arrayData['arrayData'], "stripedata" => null, "standardData" => $standardData);
                        } catch (Stripe\Error\Card $e) {

                            //send pushnotification
                            $this->load->model('Pushnotification_model');
                            $message = "Trip completed and payment unsuccessfull";
                            $this->Pushnotification_model->sendPushNotification($rowTripQuery->request_from_customer_id, $message);

                            $data1 = array('status' => 5, 'trip_end_time' => $endtime, 'km_coverd' => $km_done, 'trip_amount' => $arrayData['arrayData']['exactTripFare'], 'charge_id' => 0, "trip_time" => $arrayData['arrayData']['trip_time'], "customerPaidAmount" => $arrayData['arrayData']['fare'], "couponValue" => $arrayData['arrayData']['couponValue']);
                            $emailStatus = $this->mailSendToCustomer($trip_id, $data1);

                            $output = array("status" => "stripefail", "description" => $e, "data" => $arrayData['arrayData'], "stripedata" => null, "standardData" => $standardData);
                        }
                    } else {

                        $this->load->model('Pushnotification_model');
                        $message = "Trip completed successfully";
                        $this->Pushnotification_model->sendPushNotification($rowTripQuery->request_from_customer_id, $message);

                        $data1 = array('status' => 6, 'trip_end_time' => $endtime, 'km_coverd' => $km_done, 'trip_amount' => $arrayData['arrayData']['exactTripFare'], 'charge_id' => -1, "trip_time" => $arrayData['arrayData']['trip_time'], "customerPaidAmount" => $arrayData['arrayData']['fare'], "couponValue" => $arrayData['arrayData']['couponValue']);

                        $emailStatus = $this->mailSendToCustomer($trip_id, $data1);

                        $output = array("status" => "success", "description" => "fare calculated", "data" => $arrayData['arrayData'], "stripedata" => null, "standardData" => $standardData);
                    }

                    $where = array('id_trip_request' => $trip_id);
                    $this->db->where($where);
                    $this->db->update('trip_request', $data1);

                    //delete driver location table
                    $where = array('tripid' => $trip_id, 'userid' => $userid);
                    $this->db->where($where);
                    $this->db->delete('driver_location');

                } else {
                    $output = array("status" => "fail", "description" => "Payment done already and trip completed");
                }
            }
        } else {
            $output = array("status" => "fail", "description" => "Not a valid user token");
        }
        return $output;
    }

    //fare calculation module

    function distanceGeoPoints($lat1, $lng1, $lat2, $lng2)
    {

        $earthRadius = 3958.75;

        $dLat = deg2rad($lat2 - $lat1);
        $dLng = deg2rad($lng2 - $lng1);


        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLng / 2) * sin($dLng / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $dist = $earthRadius * $c;

        // from miles
        $meterConversion = 1609;
        $geopointDistance = $dist * $meterConversion;

        return $geopointDistance;
    }

    function calculateFare($trip_id, $endtime, $km_done, $userid)
    {
        //get the trip detail

        $getTrip = "SELECT `trip_request`.`id_trip_request`,`trip_request`.`requestType`, `trip_request`.`request_from_customer_id`,

`trip_request`.`basetype`, `trip_request`.`for_hire_id`,`trip_request`.`vehicletype`,`trip_request`.`trip_start_time`,`trip_request`.`coupon_code`,

`vehicle_info`.`basefare`, `vehicle_info`.`km_multiplier`, `vehicle_info`.`time_multiplier`,`vehicle_info`.`min_hrs` FROM `trip_request`
LEFT JOIN `vehicle_info` ON `trip_request`.`vehicle_current` = `vehicle_info`.`idvendorprofile` WHERE 1 AND id_trip_request = '" . $trip_id . "'";

        $trip = $this->db->query($getTrip);
        if ($trip->num_rows() > 0) {
            $couponValue = 0;
            $rowTrip = $trip->row();
            $code = $rowTrip->coupon_code;

            //get the coupon detail if it available
            if ($code != '0' || $code != 0) {
                $sqlCoupon = "SELECT `id`,`value`,`used_count` FROM `coupons` WHERE 1 AND `couponcode`='" . $rowTrip->coupon_code . "'";
                $queryCoupon = $this->db->query($sqlCoupon);
                if ($queryCoupon->num_rows() > 0) {
                    $couponRow = $queryCoupon->row();
                    $couponValue = $couponRow->value * 100;
                    $used_count = $couponRow->used_count;
                    //update the coupon table
                    $couponUpdateData = array('used_count' => $used_count + 1);
                    $where = array('couponcode' => $code);
                    $this->db->where($where);
                    $this->db->update('coupons', $couponUpdateData);

                    //insert used coupon table
                    $data = array(
                        'coupon' => $code,
                        'userid' => $userid
                    );
                    $this->db->insert('user_used_coupon', $data);

                } else {
                    $couponValue = 0;
                }

            }

            //calulate the time
            $start_time = $rowTrip->trip_start_time;
            $end_time = $endtime;
            $trip_time = $this->timerFormat($start_time, $end_time);

            if ($rowTrip->requestType == '1' || $rowTrip->requestType == 1) {
                $getforHire = "SELECT `id`, `basetype`, `capacity`, `from_to`, `rates`, `free_hrs`, `per_hr` FROM `for_hire_trips` WHERE 1 AND `id` = '" . $rowTrip->for_hire_id . "'";
                $hireTrip = $this->db->query($getforHire);
                if ($hireTrip->num_rows() > 0) {
                    $hireTripRow = $hireTrip->row();
                    $trip_time = $trip_time / 60;
                    $rates = $hireTripRow->rates;
                    $per_hr = $hireTripRow->per_hr;
                    $free_hrs = $hireTripRow->free_hrs;
                    if ($trip_time > $hireTripRow->free_hrs) {
                        $waiting_hrs = $trip_time - $hireTripRow->free_hrs;
                        $fare = ceil($rates * 100 + ($per_hr * 100 * $waiting_hrs));
                    } else {
                        $fare = ceil($rates * 100 + ($per_hr * 100 * $free_hrs));
                    }
                    $fare = $fare + ($couponValue);
                    $arrayWhole = array("arrayData" => array("km_done" => $km_done, "trip_time" => $trip_time, "fare" => $fare), "customerId" => $rowTrip->request_from_customer_id);
                }

            } else {

                $basefare = $rowTrip->basefare;
                $timeUnit = $rowTrip->time_multiplier;
                $kmUnit = $rowTrip->km_multiplier;
                $km_done = $km_done / 1000;
                $trip_time_hr = $trip_time / 60;
                $min_hr_min = $rowTrip->min_hrs * 60;
                if ($rowTrip->min_hrs == 0) {
                    $fare = ceil($basefare * 100 + ($kmUnit * 100 * $km_done) + ($timeUnit * 100 * $trip_time));
                } else if ($rowTrip->min_hrs > $trip_time_hr) {
                    $fare = ceil($basefare * 100 + ($kmUnit * 100 * $km_done) + ($timeUnit * 100 * $min_hr_min));
                } else {
                    $fare = ceil($basefare * 100 + ($kmUnit * 100 * $km_done) + ($timeUnit * 100 * $trip_time));
                }
                $actualfare = $fare + ($couponValue);

                if ($actualfare <= 0) {
                    $amount = 0;

                } else {
                    $amount = $actualfare;
                }

                /*
                 * key fare = amount (+/-) coupon value
                 * key amountPaid = if zero gives zero or actual fare
                 * exactTripFare = without adding coupon value
                 * */

                $arrayWhole = array("arrayData" => array("km_done" => $km_done, "trip_time" => $trip_time, "fare" => $amount, "couponValue" => $couponValue, "exactTripFare" => $fare), "customerId" => $rowTrip->request_from_customer_id);
            }
            return $arrayWhole;
        } else {
            return 0;
        }
    }

    function timerFormat($start_time, $end_time)
    {
        $total_time = $end_time - $start_time;
        $hours = floor($total_time / 60);
        return $hours;
    }

    public function mailSendToCustomer($tripId, $data1)
    {

       $sql = "SELECT  `latitude`, `longitude` as longitude FROM `locationupdate` WHERE 1 AND `trip_id`='" . $tripId . "'";

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $rowRes) {
                $points[] = array("lat" => $rowRes->latitude, "lng" => $rowRes->longitude);
            }
            $map_url = $this->make_static_map($points);
            //$map_url = 0;

        } else {
            $map_url = "";
        }

        //get the trip detail from trip table
        $tripDetailSQL = "SELECT `trip_request`.`id_trip_request`,`users`.`firstname`,`users`.`useremail`,`vehicle_basetype`.`basetype`,`vehiclecapacities`.`capacity`,
`transactionStandards`.`country`, `transactionStandards`.`countryCode`, `transactionStandards`.`exchangeRate`, `transactionStandards`.`distanceUnit`, `transactionStandards`.`currencyCode`

		FROM `trip_request`

		LEFT JOIN `users` ON `trip_request`.`request_from_customer_id` = `users`.`user_id`

		LEFT JOIN `vehicle_basetype` ON `trip_request`.`basetype` =  `vehicle_basetype`.`base_type_id`

		LEFT JOIN `vehiclecapacities` ON `trip_request`.`vehicletype` = `vehiclecapacities`.`capacity_id`

		LEFT JOIN `transactionStandards` ON `trip_request`.`country`  = `transactionStandards`.`countryCode`

		WHERE 1 AND `id_trip_request` = '" . $tripId . "'";

        $queryTrip = $this->db->query($tripDetailSQL);

        $tripRow = $queryTrip->row();

        $message = $this->load->view('emailtemplates/endtrip', '', true);

        $tripTimeSeconds = $data1['trip_time'] * 60;
        $tripTimeDisplay = gmdate("H:i:s", $tripTimeSeconds);

        $distanceInMeter = $data1['km_coverd'];

        if ($tripRow->distanceUnit == 'km') {
            $unit = ' Km';
            $distanceToDisplay = $distanceInMeter / 1000;
        } else {
            $unit = ' Mi';
            $distanceToDisplay = $distanceInMeter * 0.00062137;

        }
        $distanceToDisplay = round($distanceToDisplay, 2);

        $exactFare = ($data1['trip_amount'] / 100) * $tripRow->exchangeRate;
        $couponAmount = ($data1['couponValue'] / 100) * $tripRow->exchangeRate;
        $chargedAmount = ($data1['customerPaidAmount'] / 100) * $tripRow->exchangeRate;

        $today = date("Y-m-d H:i:s");
        $email = $tripRow->useremail;
        $subject = "SCT - Trip Summary";
        $message = str_replace('{date}', $today, $message);
        $message = str_replace('{currencyCode}', $tripRow->currencyCode, $message);
        $message = str_replace('{user}', $tripRow->firstname, $message);
        $message = str_replace('{imageURL}', $map_url, $message);
        $message = str_replace('{vehicleType}', $tripRow->basetype . "-" . $tripRow->capacity, $message);
        $message = str_replace('{km}', $distanceToDisplay . $unit, $message);
        $message = str_replace('{tripTime}', $tripTimeDisplay, $message);
        $message = str_replace('{exactFare}', $exactFare, $message);
        $message = str_replace('{coupon}', $couponAmount, $message);
        $message = str_replace('{chargedAmount}', $chargedAmount, $message);

        $this->load->model('common_model');
        $this->common_model->sendEmail($email, $subject, $message);

        return true;

    }

    function make_static_map($points,$reduce_len=false,$reduce_count=false){

        $grp_points = array();
        $grps = array();
        $url = array();
        $max_len = 0;
        $width = 279;   //max 640 :(
        $height = 217;  //max 640 :(
        $marker_accuracy = 4; //Lat lng to 4 decimal places minimum, 3 would be less accurate

        $url[] = 'http://maps.googleapis.com/maps/api/staticmap?';
        $url[] = '&size='.$width.'x'.$height.'&scale=1';
        $url[] = '&path=';

        if($reduce_count){   //Last resort to shortening this
            array_splice($points, ceil(count($points)/2), 1);
        }

        foreach($points as $i => $point){
            if($reduce_len){
                $max_len = $reduce_len;
                $point['lat'] = number_format($point['lat'], $reduce_len, '.', '');
                $points[$i]['lat'] = $point['lat'];
                $point['lng'] = number_format($point['lng'], $reduce_len, '.', '');
                $points[$i]['lng'] = $point['lng'];
            }else{
                $t_len = max(strlen($point['lat']),strlen($point['lng']));
                if($t_len>$max_len){
                    $max_len = $t_len;
                }
            }

            $grps[] = array($point['lat'],$point['lng']);
        }

        //$grps = $this->remove_duplicate_points($grps);

        foreach($grps as $grp){

            $grp_points[] = implode(',',$grp);

        }


        $url[] = implode('|',$grp_points);
        $url[] = '&sensor=false';
        $url = implode('',$url);

        $decimalLength = 6;

        while(strlen($url) > 2048){
            if($decimalLength > 2){
                $reduce_len = $decimalLength - 1;
                $reduce_count = false;
            }else{
                $reduce_len = false;
                $reduce_count = true;
            }

            $url = $this->reduceStrLength($points,$reduce_len,$reduce_count);
            $decimalLength -= 1;
        }
        return($url);
    }

    function reduceStrLength($points,$reduce_len = false, $reduce_count = false){
        $grps = array();
        $max_len = 0;
        $width = 279;   //max 640 :(
        $height = 217;
        $url[] = 'http://maps.googleapis.com/maps/api/staticmap?';
        $url[] = '&size='.$width.'x'.$height.'&scale=1';
        $url[] = '&path=';
        if($reduce_count){   //Last resort to shortening this
            array_splice($points, ceil(count($points)/2), 1);
        }
        foreach($points as $i => $point){
            if($reduce_len){
                $max_len = $reduce_len;
                $point['lat'] = number_format($point['lat'], $reduce_len, '.', '');
                $points[$i]['lat'] = $point['lat'];
                $point['lng'] = number_format($point['lng'], $reduce_len, '.', '');
                $points[$i]['lng'] = $point['lng'];
            }else{
                $t_len = max(strlen($point['lat']),strlen($point['lng']));
                if($t_len>$max_len){
                    $max_len = $t_len;
                }
            }
            $grps[] = array($point['lat'],$point['lng']);
        }
        $grps = $this->remove_duplicate_points($grps);

        foreach($grps as $grp){
            $grp_points[] = implode(',',$grp);
        }

        $url[] = implode('|',$grp_points);
        $url[] = '&sensor=false';
        $url = implode('',$url);

        return $url;
    }

    function remove_duplicate_points($points){

        $points = array_map('serialize', $points);
        $points = array_unique($points);
        return(array_map('unserialize', $points));
    }


}

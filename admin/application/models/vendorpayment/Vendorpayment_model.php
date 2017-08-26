<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Vendorpayment_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Dubai');

    }


    public function upadateTable($vendor, $from, $toDate, $vehicleId)
    {
        $vehicleIds = explode("|", $vehicleId);
        $fromUnixtime = strtotime($from);
        $tounixTime = strtotime($toDate);
        $sql = "SELECT DISTINCT `vehicle_current` FROM `trip_request` WHERE 1 AND `vehicle_current` IN (SELECT `idvendorprofile` FROM `vehicle_info` WHERE 1 AND `vendor_userid` = '" . $vendor . "')";
        $query = $this->db->query($sql);
        if (count($vehicleIds) > 0) {
            for ($k = 0; $k < count($vehicleIds); $k++) {
                $update = "UPDATE `trip_request` SET `trip_request`.`status` = '10' WHERE 1  AND `trip_request`.`vehicle_current` =  '" . $vehicleIds[$k] . "'AND `trip_request`.`status`='8' AND `trip_request`.`trip_start_time` >= $fromUnixtime AND `trip_request`.`trip_end_time`<= $tounixTime";
                $getQuery = $this->db->query($update);
            }
            // $updateWages = "UPDATE `driver_wages` SET `status`='1' WHERE 1 AND `driver_wages`.`driver_id` IN (SELECT `trip_request`.`drivers_id` FROM `trip_request` WHERE 1 AND trip_request.status='10') AND `driver_wages`.`status`='0'";
            // $querySecond = $this->db->query($updateWages);
            return 1;

        } else {
            return 0;
        }

    }
    public function revertRowTable($vendor, $from, $toDate, $vehicleId)
    {
        $vehicleIds = explode("|", $vehicleId);
        $fromUnixtime = strtotime($from);
        $tounixTime = strtotime($toDate);
        $sql = "SELECT DISTINCT `vehicle_current` FROM `trip_request` WHERE 1 AND `vehicle_current` IN (SELECT `idvendorprofile` FROM `vehicle_info` WHERE 1 AND `vendor_userid` = '" . $vendor . "')";
        $query = $this->db->query($sql);
        $update = "UPDATE `trip_request` SET `trip_request`.`status` = '8' WHERE 1  AND `trip_request`.`vehicle_current` =  '" . $vehicleId . "'AND `trip_request`.`status`='10' AND `trip_request`.`trip_start_time` >= $fromUnixtime AND `trip_request`.`trip_end_time`<= $tounixTime";
        $getQuery = $this->db->query($update);
        return 100;

    }

    public function revenueDetails($vendor, $from, $toDate)
    {
        $fromUnixtime = strtotime($from);
        $tounixTime = strtotime($toDate);
        $str = '';
        $totalAmount = 0;
        $sql = "SELECT DISTINCT `vehicle_current` FROM `trip_request` WHERE 1 AND `vehicle_current` IN (SELECT `idvendorprofile` FROM `vehicle_info` WHERE 1 AND `vendor_userid` = '" . $vendor . "')";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {

            $dataWageResponse = array();
            $particularAmount = 0;

            foreach ($query->result() as $rowRes) {
                $getSQL = "SELECT `trip_request`.`id_trip_request`,sum(`trip_request`.`km_coverd`)/1000 as `totalkmran`,`trip_request`.`vehicle_current`,
                          `trip_request`.`drivers_id`, sum(`trip_request`.`trip_time`) as `totaltriptime`,sum(`trip_request`.`trip_amount`) as `totaltripamount`,
                          `vehicle_info`.`vehicle_no`,`vehiclecapacities`.`capacity`,`vehicle_basetype`.`basetype` FROM `trip_request`
                          LEFT JOIN `vehicle_info` ON `trip_request`.`vehicle_current` = `vehicle_info`.`idvendorprofile`
                          LEFT JOIN `vehiclecapacities` ON `trip_request`.`vehicletype` = `vehiclecapacities`.`capacity_id`
                          LEFT JOIN `vehicle_basetype` ON `trip_request`.`basetype` = `vehicle_basetype`.`base_type_id`
                          WHERE 1  AND `trip_request`.`vehicle_current` =  '" . $rowRes->vehicle_current . "'AND `trip_request`.`status`='8'
                          AND `trip_request`.`trip_start_time` >= $fromUnixtime AND `trip_request`.`trip_end_time`<= $tounixTime";
                $getQuery = $this->db->query($getSQL);
                if ($getQuery->num_rows() > 0) {

                    foreach ($getQuery->result() as $rowGetRes) {
                        $particularAmount += $rowGetRes->totaltripamount;
                        if ($rowGetRes->totaltripamount != 0) {

                            $dataWageResponse[] = array("kmcovered" => $rowGetRes->totalkmran, "totaltriptime" => $rowGetRes->totaltriptime,
                                "totaltripamount" => $rowGetRes->totaltripamount, "vehicle_no" => $rowGetRes->vehicle_no,
                                "capacity" => $rowGetRes->capacity, "basetype" => $rowGetRes->basetype, "vehicle_id" => $rowGetRes->vehicle_current, "paymentStatus" => 0);
                        }

                    }
                    $paid_amountData = $this->getCompletedTripDetails($vendor, $from, $toDate);

                    $wholeArray = array_values(array_merge($dataWageResponse,$paid_amountData));

                    $totalAmount += $particularAmount;
                    $sqlVendorCommission = "SELECT `commission` FROM `vendor_profile` WHERE 1 AND `user_id`='" . $vendor . "'";
                    $queryVendorCommission = $this->db->query($sqlVendorCommission);
                    if ($queryVendorCommission->num_rows() > 0) {
                        $rowVendor = $queryVendorCommission->row();
                        $sctCommission = $rowVendor->commission;
                    } else {
                        $sctCommission = 0;
                    }
                    $totalAmount = $totalAmount / 100;
                    $sctCommissionDecimal = $sctCommission / 100;

                    $sct_Commision = $totalAmount * $sctCommissionDecimal;

                    $totalPayableamount = $totalAmount - $sct_Commision;
                    // table creation
                    $i = 1;
                    $str = '';

                    $str .= '<table class="table table-striped table-bordered table-hover" id="sample_1">
                                    <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Vehicle No</th>
                                        <th>Total Km</th>
                                        <th> Trip Time</th>
                                        <th> Total Amount</th>
                                        <th> Base Type</th>
                                        <th> Capacity</th>
                                        <th> Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>';


                    foreach ($wholeArray as $revenueDetails) {
                        $str .= '<tr><td>' . $i . '</td><td>' . $revenueDetails['vehicle_no'] . '</td><td>' . number_format($revenueDetails['kmcovered'], 2) . 'Km</td><td>' . number_format($revenueDetails['totaltriptime'], 2) . '</td>
                            <td>' . '$' . number_format($revenueDetails['totaltripamount'] / 100, 2) . '</td><td>' . $revenueDetails['basetype'] . '</td><td>' . $revenueDetails['capacity'] . '</td>';
                        if($revenueDetails['paymentStatus'] == 0 ){
                        $str .= '<td><input type="checkbox" onchange="addPaymnet(this)" class="paycheck" id="' . $revenueDetails['vehicle_id'] . '" value="' . ($revenueDetails['totaltripamount'] / 100) . '"> Pay</td>';;
                        }elseif($revenueDetails['paymentStatus'] ==1){
                            $str .= '<td><span class="label label-sm label-info">Paid</span>&nbsp;<button onclick="revertPayment('.$revenueDetails['vehicle_id'].')" class="btn yellow">Revert <i class="fa fa-history"></i></button></td>';
                        }
                        $i += 1;
                    }
                    $str .= '</tr></tbody></table>|' . $sctCommission;

                } else {
                    $str = '';
                    $str .= '<table class="table table-striped table-bordered table-hover" id="sample_3">
                                    <thead>
                                    <tr>
                                       <th>Sl No</th>
                                        <th>Vehicle No</th>
                                        <th>Total Km</th>
                                        <th> Trip Time</th>
                                        <th> Total Amount</th>
                                        <th> Base Type</th>
                                        <th> Capacity</th>
                                        <th> Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>';
                    $str .= '<tr><td valign="top" colspan="6" class="dataTables_empty">No Pending Payments</td></tr>';
                    $str .= ' </tbody></table>';
                }
            }


        } else {
            $str = '';
            $str .= '<table class="table table-striped table-bordered table-hover" id="sample_3">
                                    <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Vehicle No</th>
                                        <th>Total Km</th>
                                        <th> Trip Time</th>
                                        <th> Total Amount</th>
                                        <th> Base Type</th>
                                        <th> Capacity</th>
                                        <th> Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>';
            $str .= '<tr><td valign="top" colspan="6" class="dataTables_empty">No Pending Payments</td></tr>';
            $str .= ' </tbody></table>';
        }
        return $str;

    }

    public function getCompletedTripDetails($vendor, $from, $toDate)
    {
        $dataWageResponse = array();
        $fromUnixtime = strtotime($from);
        $tounixTime = strtotime($toDate);
        $sql = "SELECT DISTINCT `vehicle_current` FROM `trip_request` WHERE 1 AND `vehicle_current` IN (SELECT `idvendorprofile` FROM `vehicle_info` WHERE 1 AND `vendor_userid` = '" . $vendor . "')";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {


            $particularAmount = 0;

            foreach ($query->result() as $rowRes) {
                $getSQL = "SELECT `trip_request`.`id_trip_request`,sum(`trip_request`.`km_coverd`) as `totalkmran`,`trip_request`.`vehicle_current`,
                          `trip_request`.`drivers_id`, sum(`trip_request`.`trip_time`) as `totaltriptime`,sum(`trip_request`.`trip_amount`) as `totaltripamount`,
                          `vehicle_info`.`vehicle_no`,`vehiclecapacities`.`capacity`,`vehicle_basetype`.`basetype` FROM `trip_request`
                          LEFT JOIN `vehicle_info` ON `trip_request`.`vehicle_current` = `vehicle_info`.`idvendorprofile`
                          LEFT JOIN `vehiclecapacities` ON `trip_request`.`vehicletype` = `vehiclecapacities`.`capacity_id`
                          LEFT JOIN `vehicle_basetype` ON `trip_request`.`basetype` = `vehicle_basetype`.`base_type_id`
                          WHERE 1  AND `trip_request`.`vehicle_current` =  '" . $rowRes->vehicle_current . "'AND `trip_request`.`status`='10'
                          AND `trip_request`.`trip_start_time` >= $fromUnixtime AND `trip_request`.`trip_end_time`<= $tounixTime";
                $getQuery = $this->db->query($getSQL);
                if ($getQuery->num_rows() > 0) {

                    foreach ($getQuery->result() as $rowGetRes) {
                        $particularAmount += $rowGetRes->totaltripamount;
                        if ($rowGetRes->totaltripamount != 0) {

                            $dataWageResponse[] = array("kmcovered" => $rowGetRes->totalkmran, "totaltriptime" => $rowGetRes->totaltriptime,
                                "totaltripamount" => $rowGetRes->totaltripamount, "vehicle_no" => $rowGetRes->vehicle_no,
                                "capacity" => $rowGetRes->capacity, "basetype" => $rowGetRes->basetype, "vehicle_id" => $rowGetRes->vehicle_current, "paymentStatus" => 1);
                        }

                    }
                }
            }
        }
        return $dataWageResponse;
    }


}
<?php 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Driverfindingmodel extends CI_Model {
	function findDriver(){
		$this->load->model('api/v1/driverfindingmodel');
		
		// select open requests
		$sql="SELECT `id_trip_request`, `requestType`, `createdTime`, `request_from_customer_id`, `basetype`, `vehicletype`, `fromlat`, `tolocation`, `status`, `drivers_id`, `vehicle_current`, `trip_start_time`, `trip_end_time`, `km_coverd`, `trip_amount`, `driver_acceptedTime`, `fromlng`, `fldsendcount`, `charge_id` FROM `trip_request` WHERE 1 AND `status` = '0' AND `fldsendcount` < (SELECT `tries` FROM `gen_settings_sendmail` WHERE 1) AND `drivers_id`=''";	
		
		$openRequests = $this->db->query($sql);
		
		if($openRequests->num_rows() > 0){
			foreach ($openRequests->result() as $row) {	
				
				$output = $this->getDriver($row->fromlat,$row->fromlng,$row->basetype,$row->vehicletype,$row->id_trip_request);
			}
			
		}else{
			 
			 $output=array("status"=>"fail","description"=>"No open requests find.");				
		}
				
		return $output;
	}
	
	// getting unassigned driver
	function getDriver($latitude,$longitude,$basetype,$capacity,$triprquest_id){

		$getCountSql = "SELECT `tries` FROM `gen_settings_sendmail` WHERE 1";
			
			$getCountSqlQuery = $this->db->query($getCountSql);
			
			$rowTriesCount = $getCountSqlQuery->row();
			
			$i=$rowTriesCount->tries;
		
		 $sql = "SELECT `driver_location`.`id`,`driver_location`.`userid`, `driver_location`.`created`, `driver_location`.`tripid`, `driver_location`.`latitude`, `driver_location`.`longitude`,
		
		( 6373 * ACOS( COS( RADIANS( $latitude ) ) * COS( RADIANS( `latitude` ) ) * COS( RADIANS(  `longitude` ) - RADIANS( $longitude ) ) + SIN( RADIANS( $latitude ) ) * SIN( RADIANS(  `latitude` ) ) ) )
		
		
		FROM `driver_location` WHERE 1 AND ( 6373 * ACOS( COS( RADIANS( $latitude ) ) * COS( RADIANS( `latitude` ) ) * COS( RADIANS(  `longitude` ) - RADIANS( $longitude ) ) + SIN( RADIANS( $latitude ) ) * SIN( RADIANS(  `latitude` ) ) ) ) < (SELECT `radius` FROM `gen_settings_sendmail` WHERE 1) 
		
		AND `tripid`='' 
		
		AND `driver_location`.`userid` NOT IN (SELECT `userid` FROM `tbltriprequest_drivers` WHERE 1 AND `tripid`='".$triprquest_id."' AND `status`='2')
		
		AND `driver_location`.`userid` NOT IN (SELECT `userid` FROM `tbltriprequest_drivers` WHERE 1 AND `tripid`='".$triprquest_id."' AND `status`='0')
		
		AND `driver_location`.`userid` IN (SELECT `drivers_id` FROM `divers_allocated_vehicles` WHERE 1 AND `basetype`='".$basetype."' AND `capacity`='".$capacity."')
		
		AND FROM_UNIXTIME(`driver_location`.`timecreated`) BETWEEN DATE_SUB(NOW() , INTERVAL 1 MINUTE) AND NOW()
		
		ORDER BY RAND()
		
		LIMIT 0, $i";

		$freeDrivers = $this->db->query($sql);
		$driverData = array();
		$driverID = '';
		if($freeDrivers->num_rows() > 0){
			$k = 1;
			foreach ($freeDrivers->result() as $row) {	

				$driverData[] = array('userid' => $row->userid,"tripid"=>$row->tripid);
				$checkSQL = "SELECT count(`id`) as totcount FROM `tbltriprequest_drivers` WHERE 1 AND `status`='0' AND `tripid` ='".$triprquest_id."'";
				$countQuery = $this->db->query($checkSQL);
				
				$rowCount = $countQuery->row();
				if($rowCount->totcount>0){
					$i=$rowCount->totcount;
					
				}else{
					$i=0;
				}
				if($i < $rowTriesCount->tries){
					$insertArray=array('userid'=>$row->userid,
									'tripid' => $triprquest_id,
									'status' => 0);

				$this->db->insert('tbltriprequest_drivers',$insertArray);
				$data = array('fldsendcount' => $i+1);
				$this->db->where('id_trip_request', $triprquest_id);
				$this->db->update('trip_request', $data);
					$driverID .= "'".$row->userid."'";

					if($k != $freeDrivers->num_rows()){
						$driverID .=",";
					}

					$i++;
				}					
				$k++;
			}
			if(count($driverID)>0){
				$this->sendPushNotification($driverID);
			}

			
		}else{
			$driverData = array("status"=>"fail","description"=>"No drivers near by.");
		}
				
		return $driverData;		
		
	}

	public function sendPushNotification($driverIdArray){
		$deviceDetailIOS = array();
		$deviceDetailAndroid = array();

			$sql = "SELECT `row_id`, `user_id`, `device_id`, `dev_type`, `req_type`, `token`, `timestamp` FROM `tbl_userdevice_manage` WHERE 1 AND `user_id` IN (".$driverIdArray.")";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				foreach ($query->result() as $row) {
					$registatoin_ids = trim($row->device_id);
					$ostype = trim($row->dev_type);
					if($ostype=='0'){

						$deviceDetailIOS[] = $registatoin_ids;

					}else{
						$deviceDetailAndroid[] = $registatoin_ids;
					}

				}
				
				$this->load->model('Pushnotification_model');

				$this->Pushnotification_model->sendMultiplePushNotificationIOS($deviceDetailIOS);
				$this->Pushnotification_model->sendMultiplePushNotificationAndroid($deviceDetailAndroid);

			}




	}
}
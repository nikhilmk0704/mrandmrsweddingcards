<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Fareestimatemodel extends CI_Model {
	function fareEstimate($source,$destination,$user_token,$basetype,$capacity,$country_code){
		$this->load->model('api/v1/login_model');
			$userid=$this->login_model->get_userinfo_token($user_token);
			
		if($userid!='a'){
            
			//estimate fare
            $start =urlencode($source); 
            $destination = urlencode($destination);
            $mode = "driving";  
            $json_resp = file_get_contents("http://maps.googleapis.com/maps/api/directions/json?origin=$start&destination=$destination&mode=$mode&language=en-EN&alternatives=true");
            
            $data = json_decode($json_resp,TRUE);
            $arrayKm = array();
            $arrayTime = array();
            for($i=0;$i<count($data['routes']);$i++){
                $arrayKm[] = $data['routes'][$i]['legs'][0]['distance']['value'];
                $arrayTime[] = $data['routes'][$i]['legs'][0]['duration']['value'];
            }
            if( count($arrayKm) > 0 && count($arrayTime) > 0 ){
                 $minHr = min($arrayTime)/60;
                 $maxHr = max($arrayTime)/60;

                 $minKm = min($arrayKm)/1000;
                 $maxKm = max($arrayKm)/1000;

            $sql = "SELECT `basefare`, `km_multiplier`, `time_multiplier`, `min_hrs` FROM `vehicle_info` WHERE 1 AND `capacity`='".$capacity."' AND `country` = '".$country_code."'";
            $query = $this->db->query($sql);
            $returnData = array();
            if($query->num_rows()>0){
                $row = $query->row();
                $basefare = $row->basefare;
                $km_multiplier = $row->km_multiplier;
                $time_multiplier = $row->time_multiplier;
                
                $min_hrs = $row->min_hrs*60;
                
                $minRate = $this->fareCalCulation($basefare,$km_multiplier,$time_multiplier,$minKm,$minHr,$min_hrs);
                
                $maxRate = $this->fareCalCulation($basefare,$km_multiplier,$time_multiplier,$maxKm,$maxHr,$min_hrs);
                
                $returnData = array("minimumFare"=>$basefare,"perMinute"=>$time_multiplier,"perKm"=>$km_multiplier,"minRate"=>$minRate,"maxRate"=>$maxRate);
                
            }

            $sqlForStandard = "SELECT `id`, `country`, `countryCode`, `exchangeRate`, `distanceUnit`, `currencyCode` FROM `transactionStandards` WHERE 1 AND countryCode ='".$country_code."'";
                $standardData = null;
		    $queryStandard = $this->db->query($sqlForStandard);
                if($queryStandard->num_rows()>0){
                    $rowStandard = $queryStandard->row();

                    $standardData = array("country"=>$rowStandard->country,"country_code"=>$rowStandard->countryCode,
                                            "exchangeRate"=>$rowStandard->exchangeRate,
                                            "distanceUnit"=>$rowStandard->distanceUnit,"currencyCode"=>$rowStandard->currencyCode);

                }

                $output = array("status"=>"success","description"=>"Done","data"=>$returnData,"standardData"=>$standardData);
            }else{
                $output=array("status"=>"fail","description"=>"error in google api");
            }
        }
		else{
				 $output=array("status"=>"fail","description"=>"Not a valid user token");
		}
		return $output;
	}
    
    function fareCalCulation($basefare,$kmUnit,$timeUnit,$km_done,$trip_time,$min_hrs){
        if($min_hrs == 0){
           
            $fare = ceil($basefare*100 + ( $kmUnit*100 * $km_done ) + ( $timeUnit*100 * $trip_time ));
        }else if($min_hrs > $trip_time ){
            $fare = ceil($basefare*100 + ( $kmUnit*100 * $km_done ) + ( $timeUnit*100 * $min_hrs ));
        }
        return $fare;
    }

}
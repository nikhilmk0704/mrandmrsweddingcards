<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Test_model extends CI_Model {
	function dataSave($dataArray){
		foreach($dataArray['points'] as $points){
			$dataInsert = array("description"=>$dataArray['description'],
								"distance"=>$points['distance'],
								"latitude"=>$points['latitude'],
								"longitude"=>$points['longitude'],
								"time"=>$points['time'],
								"accuracy"=>$points['accuracy']
							);
					$this->db->insert('test',$dataInsert);					
				}
		$output = array("status"=>"success","description"=>"saved successfully","data"=>$dataArray);
		return $output;
	}
}
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Dashboardmodel extends CI_Model {

     public function getSuperAdminData() {
		$data = array();
      	$data = array("totalProfits"=>0,"totalSale"=>0,"expense"=>0,"totalTrip"=>0,"totalUsers"=>0,"driversData"=>0);
		return $data;
     }

}
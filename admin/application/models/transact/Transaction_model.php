<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Transaction_model extends CI_Model {
    //school template list
    public function transactList()
    {
      $sql = "SELECT `id`, `country`, `countryCode`, `exchangeRate`, `distanceUnit`, `currencyCode` FROM `transactionStandards` WHERE 1";
      $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            foreach($query->result() as $rowRes){
                $standard[]=array("id"=>$rowRes->id,"country"=>$rowRes->country,
                          "countryCode"=>$rowRes->countryCode,"exchangeRate"=>$rowRes->exchangeRate,
                          "distanceUnit"=>$rowRes->distanceUnit,"currencyCode"=>$rowRes->currencyCode
                          );
            }
             return $standard;
        } else {
            return 0;
        }
    }
    public function getStandard($id)
    {
        $sql = "SELECT `id`, `country`, `countryCode`, `exchangeRate`, `distanceUnit`, `currencyCode` FROM `transactionStandards` WHERE 1 AND `id`='" . $id . "'";
        //echo $sql;
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $rowRes = $query->row();
            $data = array("id" => $rowRes->id, "country" => $rowRes->country, "countryCode" => $rowRes->countryCode, "exchangeRate" => $rowRes->exchangeRate, "distanceUnit" => $rowRes->distanceUnit, "currencyCode" => $rowRes->currencyCode);
            return $data;
            // return $query->result_array();
        } else {
            return 0;
        }
    }
    //add template details
    public function addStandard($country,$currency,$xRate,$distanceUnit,$countryName)
    {
    $sql = "SELECT `id` FROM `transactionStandards` WHERE 1 and countryCode='".$country."'";
      $query = $this->db->query($sql);
        if ($query->num_rows() == 0) {
            $data = array(
                'countryCode' => $country,
                'currencyCode'=>$currency,
                'exchangeRate'=>$xRate,
                'distanceUnit'=>$distanceUnit,
                'country'=>$countryName
              );
            $this->db->insert('transactionStandards', $data);
            return 1;
        }else{
            return 0;
        }
    }
	 //delete the temp
    public function deleteStandard($id)
    {
		$this->db->where('id' , $id);
    	$this->db->delete('transactionStandards');

       return 1;
    }
    //update the temp
    public function updateStandard($id,$country_edit, $currency_edit,$xRate_edit, $distanceUnit_edit, $countryName_edit)
    {


            $data = array(
                'countryCode' => $country_edit,
                'currencyCode'=>$currency_edit,
                'exchangeRate'=>$xRate_edit,
                'distanceUnit'=>$distanceUnit_edit,
                'country'=>$countryName_edit
            );

        $this->db->where('id', $id);
        $this->db->update('transactionStandards', $data);
        return 1;
    }
}

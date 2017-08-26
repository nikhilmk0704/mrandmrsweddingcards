<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Promocode_model extends CI_Model {
    //school template list
    public function couponList()
    {
      $sql = "SELECT `id`, `couponcode`, `createdtime`, `used_count`, `infinity_status`, `validfrom`, `validto`, 
                     `active_status`, `value`, `message` FROM `coupons` WHERE 1 AND active_status = '1'";
      $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            foreach($query->result() as $rowRes){
		$coupon[]=array("id"=>$rowRes->id,"couponcode"=>$rowRes->couponcode,
                          "used_count"=>$rowRes->used_count,"infinity_status"=>$rowRes->infinity_status,
                          "validfrom"=>$rowRes->validfrom,"validto"=>$rowRes->validto,
                          "value"=>$rowRes->value,"message"=>$rowRes->message
                          );
            }
             return $coupon;
        } else {
            return 0;
        }
    }
	
    //add template details
    public function addPromo($code,$total_count,$valid_from,$valid_to,$message,$value)
    {
    $sql = "SELECT `id` FROM `coupons` WHERE 1 AND `couponcode` = '".$code."'";
      $query = $this->db->query($sql);
        if ($query->num_rows() == 0) {      
            /*if($perperson_count==''){
                $perperson_count = -1;
            }*/
            if($total_count==''){
                $total_count = -1;
            }
            $data = array(
                'couponcode' => $code,
                'infinity_status'=>$total_count,
                'validfrom'=>$valid_from,
                'validto'=>$valid_to,
                'active_status'=>1,
                'value'=>$value,
                'message'=>$message
              );
            $this->db->insert('coupons', $data);
            return 1;
        }else{
            return 0;
        }
    }
	 //delete the temp
    public function deleteCoupon($id)
    {
		$data = array('active_status'=>0);
		$this->db->where('id' , $id);
    	$this->db->update('coupons',$data); 

       return 1;
    }
}

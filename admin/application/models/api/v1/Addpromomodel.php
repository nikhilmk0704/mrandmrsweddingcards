<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Addpromomodel extends CI_Model {
	function promoAdd($promocode,$user_token){
		$this->load->model('api/v1/login_model');
			$userid=$this->login_model->get_userinfo_token($user_token);
			
		if($userid!='a'){
            
			$sql_exists = "SELECT `id` FROM `coupons` WHERE 1 AND `couponcode`= '".$promocode."'";
			$coupon_exists = $this->db->query($sql_exists);
			
			if($coupon_exists->num_rows() > 0){

					$sql = "SELECT `id` FROM `coupons` WHERE 1 AND `couponcode`= '".$promocode."' AND `active_status`='1'";
					$coupon = $this->db->query($sql);
					
					if($coupon->num_rows() > 0){
						
						$sql_validity = "SELECT `id`,`infinity_status`,`message` FROM `coupons` WHERE 1 AND `couponcode`= '".$promocode."' AND `validfrom` <  UNIX_TIMESTAMP( ) AND `validto` >  UNIX_TIMESTAMP( )";
						$coupon_validity= $this->db->query($sql_validity);
						if($coupon_validity->num_rows() > 0){
                            
                            $sqlAlreadyUsed = "SELECT `id`, `coupon`, `userid` FROM `user_used_coupon` WHERE 1 AND `userid`='".$userid."' AND `coupon`='".$promocode."'";
                            
							$couponAlreadyUsed = $this->db->query($sqlAlreadyUsed);
                            
                            if($couponAlreadyUsed->num_rows() == 0){
                                
                                $row = $coupon_validity->row();
                                if($row->infinity_status==-1){

                                    $output=array("status"=>"success","description"=>"Coupon added successfully","message"=>$row->message );

                                }else{
                                    $sql_count_chk = "SELECT `id`,`no_of_times`,`message` FROM `coupons` WHERE 1 AND `couponcode`= '".$promocode."' AND `infinity_status` > `used_count`";
                                    $coupon_count_chk= $this->db->query($sql_count_chk);

                                    if($coupon_count_chk->num_rows() > 0){
                                        $output=array("status"=>"success","description"=>"Coupon added successfully","message"=>$row->message);
                                    }else{

                                        $output=array("status"=>"fail","description"=>"Coupon use exceeded");
                                    }	
                                }	
                            }else{
                                $output=array("status"=>"fail","description"=>"Coupon already used");
                            }


						}else{
							$output=array("status"=>"fail","description"=>"Coupon expired");
						}
					}else{
						$output=array("status"=>"fail","description"=>"Coupon cancelled");
					}

				}else{
					 $output=array("status"=>"fail","description"=>"Coupon does not exists");
				}
		}
		else{
				 $output=array("status"=>"fail","description"=>"Not a valid user token");
		}
		return $output;
	}
}
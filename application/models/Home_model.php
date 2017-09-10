<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Home_model extends CI_Model {
	public function __construct()
       {
            parent::__construct();
            date_default_timezone_set('Asia/Kolkata'); 
	   }
    //school template list
    public function productList(){
    	$sql = "SELECT `product`.`id`, `product`.`name`, `product`.`price`, `product`.`discountPercentage`, `product`.`status`, `product`.`productShapeId`, `product`.`productColorId`, `product`.`productType`, `product`.`quantity`, `product`.`description`, `product`.`vendorId`, `product`.`productCategoryId`, `product`.`weight`, `product`.`size`, `product`.`createdAt`, `product`.`updatedAt`, `product`.`enabled`, `product`.`productId`,`productcategory`.`categoryName`,`productcolor`.`colorName`,`productshape`.`shapeName`,`vendor`.`name` AS `vendorName` FROM `product` LEFT JOIN `productcategory` ON `productcategory`.`id` = `product`. `productCategoryId` LEFT JOIN `productcolor` ON `productcolor`.`id` = `product`. `productColorId` LEFT JOIN `productshape` ON `productshape`.`id` = `product`. `productShapeId` LEFT JOIN `vendor` ON `vendor`.`id` = `product`.`vendorId` WHERE 1";
    	
        $query = $this->db->query($sql);
        
        if ($query->num_rows() > 0) {
           foreach($query->result() as $rowRes){
                
                /*Get images for products*/
                $sqlImage = "SELECT * FROM `productimage` WHERE 1 AND `productId` = '".$rowRes->id."'";
                $queryImage = $this->db->query($sqlImage);
                $imagesArray = $queryImage->result_array();

                /*Get images for products*/
                $sqlRating = "SELECT `id`, `productId`, `userId`, `rating`, `createdAt`, `updatedAt` FROM `productrating` WHERE 1 AND `productId` = '".$rowRes->id."'";
                $queryRating = $this->db->query($sqlRating);
                $ratingArray = $queryRating->result_array();
                
                $products[]=array("id" => $rowRes->id,
                    "name" => $rowRes->name,
                    "price" => $rowRes->price, 
                    "discountPercentage" => $rowRes->discountPercentage, 
                    "status" => $rowRes->status, 
                    "productShapeId" => $rowRes->productShapeId,
                    "productColorId" => $rowRes->productColorId,
                    "productType" => $rowRes->productType,
                    "quantity" => $rowRes->quantity,
                    "description" => $rowRes->description,
                    "vendorId" => $rowRes->vendorId,
                    "productCategoryId" => $rowRes->productCategoryId,
                    "weight" => $rowRes->weight,
                    "size"=>$rowRes->size,
                    "createdAt"=>$rowRes->createdAt,
                    "updatedAt"=>$rowRes->updatedAt,
                    "enabled"=>$rowRes->enabled,
                    "productId"=>$rowRes->productId,
                    "vendorName" => $rowRes->vendorName,
                    "categoryName"=>$rowRes->categoryName,
                    "colorName"=>$rowRes->colorName,
                    "shapeName"=>$rowRes->shapeName,
                    "imagesArray" => $imagesArray,
                    "ratingArray" => $ratingArray 
                    );
            }
            return $products;
	
        } else {
            return 0;
        }
    }

    public function register($registerData){
        
        $sql = "SELECT  `emailId` FROM `user` WHERE 1 AND `emailId`='".$registerData['email']."'";
        
        $query = $this->db->query($sql);
    
        if($query->num_rows() == 0){
            $data = array(
                'firstName' => $registerData['firstName'],
                'lastName' =>$registerData['lastName'],
                'mobileNumber'=>$registerData['phone'],
                'emailId'=>$registerData['email'],
                'password'=>md5($registerData['password'])
            );
            $this->db->insert('user', $data);
            $userid = $this->db->insert_id();
            if($userid){
                $sessionValue = array(
                    'userloggedin' => TRUE,
                    'id' => $userid,
                    'firstName' => $registerData['firstName'],
                    'lastName' => $registerData['lastName'],
                    'emailId' => $registerData['email'],
                    'mobileNumber' => $registerData['phone']
                );
                $this->session->set_userdata($sessionValue);
                return 1;
            }else{
                return 0;
            }
            
        }else{
            return 2;
        }
        
    }

    //Check the username and password.
    public function login($loginData) {
        $pwd = md5($loginData['password_login']);
        $sql = "SELECT `id`, `firstName`, `lastName`, `mobileNumber`, `emailId`, `password`, `status`, `createdAt`, `updatedAt` FROM `user` WHERE 1 AND `emailId`='".$loginData['email_login']."' AND `password`='".$pwd."'";
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $row = $query->row();
            $id = $row->id;
            $firstName = $row->firstName;
            $lastName = $row->lastName;
            $emailId = $row->emailId;
            $status = $row->status;
            $mobileNumber = $row->mobileNumber;
            
            $sessionValue = array(
                'userloggedin' => TRUE,
                'id' => $id,
                'firstName' => $firstName,
                'lastName' => $lastName,
                'emailId' => $emailId,
                'status' => $status,
                'mobileNumber' => $mobileNumber
                );
            $this->session->set_userdata($sessionValue);
            return 1;
        } else {
            return 0;
        }
    }

     public function productListViewAll(){
        $sql = "SELECT `product`.`id`, `product`.`name`, `product`.`price`, `product`.`discountPercentage`, `product`.`status`, `product`.`productShapeId`, `product`.`productColorId`, `product`.`productType`, `product`.`quantity`, `product`.`description`, `product`.`vendorId`, `product`.`productCategoryId`, `product`.`weight`, `product`.`size`, `product`.`createdAt`, `product`.`updatedAt`, `product`.`enabled`, `product`.`productId`,`productcategory`.`categoryName`,`productcolor`.`colorName`,`productshape`.`shapeName`,`vendor`.`name` AS `vendorName` FROM `product` LEFT JOIN `productcategory` ON `productcategory`.`id` = `product`. `productCategoryId` LEFT JOIN `productcolor` ON `productcolor`.`id` = `product`. `productColorId` LEFT JOIN `productshape` ON `productshape`.`id` = `product`. `productShapeId` LEFT JOIN `vendor` ON `vendor`.`id` = `product`.`vendorId` WHERE 1";
        
        $query = $this->db->query($sql);
        
        if ($query->num_rows() > 0) {
           foreach($query->result() as $rowRes){
                
                /*Get images for products*/
                $sqlImage = "SELECT * FROM `productimage` WHERE 1 AND `productId` = '".$rowRes->id."'";
                $queryImage = $this->db->query($sqlImage);
                $imagesArray = $queryImage->result_array();

                /*Get images for products*/
                $sqlRating = "SELECT `id`, `productId`, `userId`, `rating`, `createdAt`, `updatedAt` FROM `productrating` WHERE 1 AND `productId` = '".$rowRes->id."'";
                $queryRating = $this->db->query($sqlRating);
                $ratingArray = $queryRating->result_array();
                
                $products[]=array("id" => $rowRes->id,
                    "name" => $rowRes->name,
                    "price" => $rowRes->price, 
                    "discountPercentage" => $rowRes->discountPercentage, 
                    "status" => $rowRes->status, 
                    "productShapeId" => $rowRes->productShapeId,
                    "productColorId" => $rowRes->productColorId,
                    "productType" => $rowRes->productType,
                    "quantity" => $rowRes->quantity,
                    "description" => $rowRes->description,
                    "vendorId" => $rowRes->vendorId,
                    "productCategoryId" => $rowRes->productCategoryId,
                    "weight" => $rowRes->weight,
                    "size"=>$rowRes->size,
                    "createdAt"=>$rowRes->createdAt,
                    "updatedAt"=>$rowRes->updatedAt,
                    "enabled"=>$rowRes->enabled,
                    "productId"=>$rowRes->productId,
                    "vendorName" => $rowRes->vendorName,
                    "categoryName"=>$rowRes->categoryName,
                    "colorName"=>$rowRes->colorName,
                    "shapeName"=>$rowRes->shapeName,
                    "imagesArray" => $imagesArray,
                    "ratingArray" => $ratingArray 
                    );
            }
            return $products;
    
        } else {
            return 0;
        }
    }

    public function shapeList(){
        $sql = "SELECT `id`, `shapeName`, `createdAt`, `updatedAt`, `enabled` FROM `productshape` WHERE 1 AND `enabled`='1'";
        
        $query = $this->db->query($sql);
        
        if ($query->num_rows() > 0) {
            foreach($query->result() as $rowRes){

                $sqlCount = "SELECT count(`id`) as `count` FROM `product` WHERE 1 AND `productShapeId` = '".$rowRes->id."'";
                $queryCount = $this->db->query($sqlCount);
                $count = $queryCount->row_array();

                $shapeList[] = array(
                    "id" => $rowRes->id,
                    "shapeName" => $rowRes->shapeName,
                    "count"=>$count['count']
                    );
            }
            return $shapeList;
    
        } else {
            return 0;
        }
    }

    public function colorList(){
        $sql = "SELECT `id`, `colorName`, `colorCode`, `createdAt`, `updatedAt`, `enabled` FROM `productcolor` WHERE 1 AND `enabled`='1'";
        $query = $this->db->query($sql);
        
        if ($query->num_rows() > 0) {
            foreach($query->result() as $rowRes){

                $sqlCount = "SELECT count(`id`) as `count` FROM `product` WHERE 1 AND `productColorId` = '".$rowRes->id."'";
                $queryCount = $this->db->query($sqlCount);
                $count = $queryCount->row_array();

                $colorList[] = array(
                    "id" => $rowRes->id,
                    "colorName" => $rowRes->colorName,
                    "colorCode" => $rowRes->colorCode,
                    "count"=>$count['count']
                    );
            }
            return $colorList;
    
        } else {
            return 0;
        }
    }

    public function categoryList(){
        $sql = "SELECT `id`, `categoryName`, `createdAt`, `updatedAt`, `enabled` FROM `productcategory` WHERE 1 AND `enabled`='1'";
        $query = $this->db->query($sql);    
        if ($query->num_rows() > 0) {
            foreach($query->result() as $rowRes){

                $sqlCount = "SELECT count(`id`) as `count` FROM `product` WHERE 1 AND `productCategoryId` = '".$rowRes->id."'";
                $queryCount = $this->db->query($sqlCount);
                $count = $queryCount->row_array();

                $categoryList[] = array(
                    "id" => $rowRes->id,
                    "categoryName" => $rowRes->categoryName,
                    "count"=>$count['count']
                    );
            }
            return $categoryList;
    
        } else {
            return 0;
        }
    }

    public function inStockCount(){
       
        $sqlCount = "SELECT count(`id`) as `count` FROM `product` WHERE 1 AND `status` != '0'";
        $queryCount = $this->db->query($sqlCount);
        $count = $queryCount->row_array();
        return $count['count'];     
    }
	
	
}
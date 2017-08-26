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
	
	
}
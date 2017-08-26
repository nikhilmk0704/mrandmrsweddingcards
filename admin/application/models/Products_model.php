<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Products_model extends CI_Model {
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
                    "imagesArray" => $imagesArray,
                    "categoryName"=>$rowRes->categoryName,
                    "colorName"=>$rowRes->colorName,
                    "shapeName"=>$rowRes->shapeName
                    );
            }
            return $products;
	
        } else {
            return 0;
        }
    }
	
    //add template details
    public function addProduct($insertArray){
		$sql = "SELECT `id`  FROM `product` WHERE 1 AND `productId`='".$insertArray['productId']."'";
		$query = $this->db->query($sql);
	
        if($query->num_rows() == 0){	
            $this->db->insert('product', $insertArray);
        	$insert_id = $this->db->insert_id();
        	return $insert_id;
        }else{
        	return 2;
        }
	}
    //add template details
    public function addProductImage($insertArray){
        $this->db->insert('productimage', $insertArray);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
    public function mail_notification($u_id){
    	
		$this->load->model('notification_model');
    	$type=2;
    	$tablename='users';
    	$this->notification_model->notification_save($type,$tablename,$u_id); 
    }
    //get the school template
    public function getProduct($id){
        
        $sql = "SELECT `product`.`id`, `product`.`name`, `product`.`price`, `product`.`discountPercentage`, `product`.`status`, `product`.`productShapeId`, `product`.`productColorId`, `product`.`productType`, `product`.`quantity`, `product`.`description`, `product`.`vendorId`, `product`.`productCategoryId`, `product`.`weight`, `product`.`size`, `product`.`createdAt`, `product`.`updatedAt`, `product`.`enabled`, `product`.`productId`,`productcategory`.`categoryName`,`productcolor`.`colorName`,`productshape`.`shapeName`,`vendor`.`name` AS `vendorName` FROM `product` LEFT JOIN `productcategory` ON `productcategory`.`id` = `product`. `productCategoryId` LEFT JOIN `productcolor` ON `productcolor`.`id` = `product`. `productColorId` LEFT JOIN `productshape` ON `productshape`.`id` = `product`. `productShapeId` LEFT JOIN `vendor` ON `vendor`.`id` = `product`.`vendorId` WHERE 1 AND `product`.`id`='".$id."'";
         //echo $sql;
    	$query = $this->db->query($sql);
        	if ($query->num_rows() > 0) {
            	$rowRes = $query->row_array();
                /*Get images for products*/
                $sqlImage = "SELECT * FROM `productimage` WHERE 1 AND `productId` = '".$rowRes['id']."'";
                $queryImage = $this->db->query($sqlImage);
                $imagesArray = $queryImage->result_array();
                $rowRes["imagesArray"] = $imagesArray;
                return $rowRes; 
        	} else {
            	return 0;
       		}
    }
    
    //update the temp

    public function updateProduct($data)
    {
		
       $insertArray = array(
                "name"=>$data['name'], 
                "price"=>$data['price'], 
                "discountPercentage"=>$data['discount'], 
                "status"=>$data['status'], 
                "productShapeId"=>$data['productShape'], 
                "productColorId"=>$data['productColor'], 
                "productType"=>$data['productType'], 
                "quantity"=>$data['quantity'], 
                "description"=>$data['description'], 
                "vendorId"=>$data['vendor'], 
                "productCategoryId"=>$data['productCategory'], 
                "weight"=>$data['weight'], 
                "size"=>$data['size'], 
                "productId"=>$data['productID']
                );
	  $this->db->where('id', $data['id']);
      $this->db->update('product', $insertArray);

      $this->db->where('productId', $data['id']);
      $this->db->delete('productimage');
      
      $productImageArray = explode('|',$data['filenames']);
      
      foreach ($productImageArray as $imageName) {
          $imageData = array("productId"=>$data['id'],
                              "path"=>$imageName
                              );
          $this->db->insert('productimage', $imageData);      
      }
       
	  return 1; 

    }

    
    public function changeStatus($id,$value){
        $data = array('status'=>$value);
        $this->db->where('id',$id);
        $this->db->update('product',$data);
        return 1;
    }
    //delete the temp
    public function activateProduct($id){
    	$sql = "SELECT `enabled` FROM `product` WHERE 1 AND `id`='".$id."'";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			$row = $query->row();
			$enabled = $row->enabled;
			if($enabled==0||$enabled=='0'){
				$data = array('enabled'=>1);
				$this->db->where('id',$id);
				$this->db->update('product',$data);
			}else{
				$data = array('enabled'=>0);
				$this->db->where('id',$id);
				$this->db->update('product',$data);
			}
			return 1;
		}
       
    }
	
}
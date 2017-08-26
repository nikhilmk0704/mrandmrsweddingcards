<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Products extends CI_Controller {
	public function __construct()
       {
            parent::__construct();
            $this->load->model('products_model');
            $this->load->model('common_model');
            $this->load->model('category_model');
            $this->load->model('color_model');
            $this->load->model('shape_model');
            $this->load->model('vendors_model');
      
	   }
	
    //Dashboard view
     public function index() {
        if ($this->session->userdata('userloggedin') == TRUE) {
            
			$userid = $this->session->userdata('id');

            $data['productLists']  = $this->products_model->productList();
            
            $data['categoryLists']  = $this->category_model->categoryList();
            $data['colorLists']  = $this->color_model->colorList();
            $data['shapeLists']  = $this->shape_model->shapeList();
            $data['vendorLists']  = $this->vendors_model->vendorList();

  
            $this->load->view('products/product_view',$data);     
		} else {
            
			redirect('login');
        }
    }
    //add template data
    public function add(){
      	if ($this->session->userdata('userloggedin') == TRUE) {
            
            $insertArray = array(
                "name"=>$_POST['name'], 
                "price"=>$_POST['price'], 
                "discountPercentage"=>$_POST['discount'], 
                "status"=>$_POST['status'], 
                "productShapeId"=>$_POST['productShape'], 
                "productColorId"=>$_POST['productColor'], 
                "productType"=>$_POST['productType'], 
                "quantity"=>$_POST['quantity'], 
                "description"=>$_POST['description'], 
                "vendorId"=>$_POST['vendor'], 
                "productCategoryId"=>$_POST['productCategory'], 
                "weight"=>$_POST['weight'], 
                "size"=>$_POST['size'], 
                "productId"=>$_POST['productID']
                );
            $insertedId = $this->products_model->addProduct($insertArray);
            
            /*Insert product image in tables*/
            if($insertedId > 0){
                $productImageArray = explode('|',$_POST['filenames']);
                foreach ($productImageArray as $imageName) {
                    $imageData = array("productId"=>$insertedId,
                                        "path"=>$imageName
                                        );
                    $this->products_model->addProductImage($imageData);      
                }  
            }

            echo $insertedId;
            
        }else {
            redirect('login');
        }			 
    	
    }
	 //edit the template 
    
    public function edit_view()
    {
         if ($this->session->userdata('userloggedin') == TRUE) {
			$id = $_POST['product_id']; 
        	$data['product'] = $this->products_model->getProduct($id);

            $data['categoryLists']  = $this->category_model->categoryList();
            $data['colorLists']  = $this->color_model->colorList();
            $data['shapeLists']  = $this->shape_model->shapeList();
            $data['vendorLists']  = $this->vendors_model->vendorList();

			$this->load->view('products/product_edit_view', $data);
        } else {
            redirect('login');
        }
    }
	 //update the school temp details
    public function updateProduct(){   
		$file_id = $this->products_model->updateProduct($_POST);
		 echo $file_id;			
    }
    //public function delete
    public function active()
    {
	   $id = $_POST['productId'];
       echo $this->products_model->activateProduct($id);
    }

    public function changeStatus(){
        $productId = $_POST['productId'];
        $value = $_POST['value'];
        echo $this->products_model->changeStatus($productId, $value);

    }
    public function productImageUpload(){

        $s3_name = S3_NAME;
        $upload_path_global = 'uploads';
        $config['upload_path'] = $upload_path_global;
        $config['allowed_types'] = 'png|PNG|jpeg|JPEG|jpg|JPG';
        $config['encrypt_name'] = TRUE;
        $tag = $_POST['tag'];
        if($tag=='edit'){
            $filename = 'productImage_edit';
        }else{
            $filename = 'productImage';
        }
        if (is_dir($config['upload_path']) == false) {
            mkdir($config['upload_path'], 0755, true);
        }
        $this -> load -> library('upload', $config);

        if ($this -> upload -> do_upload($filename)) {

            $data = array('upload_data' => $this -> upload -> data());

            if ($data) {
                $re = $this -> common_model -> s3Upload($upload_path_global . "/" . $data['upload_data']['file_name'],$s3_name);
                if($re->status==200){
                    unlink($upload_path_global . "/" . $data['upload_data']['file_name']);
                    echo $data['upload_data']['file_name'];
                }else{
                    echo 0;
                }
            }
        }
        else{print_r( $this->upload->display_errors());
            echo -1;
        }

                
    }

    public function productImageDelete(){
        $s3_name = S3_NAME;
        $ful_name = $_POST['imageName'];
        $response = $this -> common_model -> delete_s3_file($ful_name,$s3_name);
        echo $response->status;
    }	
}
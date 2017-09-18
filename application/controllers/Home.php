<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
    {
	    parent::__construct();
	    $this->load->model('home_model');
	}

	public function index()
	{
		$data['products'] = $this->home_model->productList();

		$this->load->view('home',$data);
	}

	public function register(){
		$response = $this->home_model->register($_POST);
		echo $response;
	}

	//user logout
	public function logout() {
	    $user_data = $this->session->all_userdata();
	    foreach ($user_data as $key => $value) {
	        if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
	            $this->session->unset_userdata($key);
	        }
	    }
	    $this->session->sess_destroy();
	    redirect('/home');
	}

	public function login(){
		$response = $this->home_model->login($_POST);
		echo $response;
	}

	public function products(){
		$data['productColor'] = $this->home_model->colorList();
		$data['productShape'] = $this->home_model->shapeList();
		$data['productCategory'] = $this->home_model->categoryList();
		$data['products'] = $this->home_model->productListViewAll();
		$data['inStockCount'] = $this->home_model->inStockCount();
		$data['minMax'] = $this->home_model->minMaxPrice();
		$this->load->view('products',$data);
	}

	public function filterProduct(){
		$shape = '';
		$color = '';
        $category = '';
        $stock = '';
   		if(isset($_POST['shape'])){
			if(count($_POST['shape']) > 0){
				 $shape = implode(', ', $_POST['shape']);
			}

		}

		if(isset($_POST['color'])){
			if(count($_POST['color']) > 0){
				 $color = implode(', ', $_POST['color']);
			}

		}
		if(isset($_POST['category'])){
			if(count($_POST['category']) > 0){
				 $category = implode(', ', $_POST['category']);
			}

		}
		if(isset($_POST['stock'])){
			if(count($_POST['stock']) > 0){
				$stock = 1;
			}
		}

		$data['products'] = $this->home_model->productListViewAll($shape,$color,$category,$stock,$_POST['min'],$_POST['max']);
		$this->load->view('product_list',$data);
	}


	
	public function productDetail(){
		$productID = $this->uri->segment(2);
		$data['product'] = $this->home_model->productListSingle($productID);
		$this->load->view('product_single',$data);
	}

	public function saveReview(){
		$response = $this->home_model->saveReview($_POST);
		echo $response;
	}

	public function wishListSave(){
		$response = $this->home_model->wishListSave($_POST);
		echo $response;
	}

	public function wishList(){
		$userId = $this->session->userdata("id");
		$data['wishlist'] = $this->home_model->wishList($userId);
		$this->load->view('wishList',$data);
	}

	public function wishListDelete(){
		$response = $this->home_model->wishListDelete($_POST);
		echo $response;
	}
	
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	 function __construct() {
        parent::__construct();
    }
	public function index()
	{
		$this->load->library('controllerlist');
		$res = $this->controllerlist->getControllers();
	    $keys=array_keys($res);
		for($i=0;$i<(count($res));$i++){
			 $controller_name=$keys[$i];
			for($j=0;$j<(count($res[$keys[$i]]));$j++){
				 
				 if($res[$keys[$i]][$j]=='index'){
				    $menus = $controller_name;
				 } else if($res[$keys[$i]][$j] =='add' || $res[$keys[$i]][$j]=='edit' || $res[$keys[$i]][$j]=='delete'){
					$menus = $controller_name.'/'.$res[$keys[$i]][$j];
				 }else{
					  $menus = '';
				 }
				 if($menus !=''){
				 $query=$this->db->query("select menu_id from menu where menu_url='".$menus."'");
				 if ($query->num_rows() == 0) {
					 
					 $menu_array = array(
                'menu_url' => $menus,
                'controllername' => $controller_name,
             );
			
			 $this->db->insert('menu', $menu_array);
				 }
				 }
			}
		}
		$this->load->view('welcome_message');
	}
}
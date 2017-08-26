<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Dashboard extends CI_Controller {
	 public function __construct()
       {
            parent::__construct();
			$this->load->model('dashboardmodel');
      
	   }
	
    //Dashboard view
    public function index() {
        if ($this->session->userdata('userloggedin') == TRUE) {
        	
			$data['superAdminData'] = $this->dashboardmodel->getSuperAdminData();
			$this->load->view('dashboard_view',$data);
			
        } else {
            redirect('login');
        }
    }

	public function filterData(){

		$type = $_POST['type'];

		$this->load->model('dashboardmodel');

		if($type == 1){
			$data = $this->dashboardmodel->getTodayData();
		}else if($type == 2){
			$data = $this->dashboardmodel->getWeekData();
		}else{
			$data = $this->dashboardmodel->getMonthData();
		}
		print_r(json_encode($data));
	}
	
}
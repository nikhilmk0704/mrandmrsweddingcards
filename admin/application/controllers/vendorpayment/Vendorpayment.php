<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Vendorpayment extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Dubai');

    }

//Dashboard view
    public function index()
    {
        if ($this->session->userdata('userloggedin') == TRUE) {
            $userid = $this->session->userdata('userid');


            $this->load->model('vendors/vendors_model');
            $data['vendorList'] = $this->vendors_model->vendorList();

            //checking permission
            $user_role_id = $this->session->userdata('role');
            $this->load->model('permission_models');
            $permission = $this->permission_models->getPermissionForController_view($user_role_id, $this->uri->segment(2));
            $data['checking'] = $this->permission_models->getPermissionForController($user_role_id, $this->uri->segment(2));
            $data['menus'] = $this->permission_models->getMenuNames();
            if ($permission == '1') {
                $this->load->view('vendorpayment/vendorpayment_view', $data);
            } else {
                $this->load->view('no_permission');
            }

        } else {
            redirect('login');
        }
    }

    public function getRevenueDetails()
    {
        if ($this->session->userdata('userloggedin') == TRUE) {

            $vendor = $_POST['vendor'];
            $from = $_POST['from'];
            $toDate = $_POST['to'];

            $this->load->model('vendorpayment/vendorpayment_model');
            $revenueDetails = $this->vendorpayment_model->revenueDetails($vendor, $from, $toDate);
            echo $revenueDetails;

        } else {
            redirect('login');
        }

    }
    public function rowUpdate()
    {
        if ($this->session->userdata('userloggedin') == TRUE) {

            $vendor = $_POST['vendor'];
            $from = $_POST['from'];
            $toDate = $_POST['to'];
            $vehicleId = $_POST['vehicle_id'];

            $this->load->model('vendorpayment/vendorpayment_model');
            $revenueDetails = $this->vendorpayment_model->upadateTable($vendor, $from, $toDate, $vehicleId);
            echo $revenueDetails;

        } else {
            redirect('login');
        }

    }
    public function revertPay()
    {
        if ($this->session->userdata('userloggedin') == TRUE) {

            $vendor = $_POST['vendor'];
            $from = $_POST['from'];
            $toDate = $_POST['to'];
            $vehicleId = $_POST['vehicle_id'];

            $this->load->model('vendorpayment/vendorpayment_model');
            $revenueDetails = $this->vendorpayment_model->revertRowTable($vendor, $from, $toDate, $vehicleId);
            echo $revenueDetails;

        } else {
            redirect('login');
        }

    }

}
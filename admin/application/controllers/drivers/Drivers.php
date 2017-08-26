<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Drivers extends CI_Controller
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

            $this->load->model('drivers/drivers_model');
            $driverlist = $this->drivers_model->driverList();


            $this->load->model('vendors/vendors_model');
            $data['vendorList'] = $this->vendors_model->vendorList();


            $this->load->model('vehicles/vehiclesmodel');
            $data['vehicleList'] = $this->vehiclesmodel->vehicleList();
            $data['driver'] = $driverlist;
            $user_role_id = $this->session->userdata('role');
            $this->load->model('permission_models');
            $permission = $this->permission_models->getPermissionForController_view($user_role_id, $this->uri->segment(2));
            $data['checking'] = $this->permission_models->getPermissionForController($user_role_id, $this->uri->segment(2));
            $data['menus'] = $this->permission_models->getMenuNames();
            if ($permission == '1') {
                $this->load->view('drivers/driver_view', $data);
            } else {
                $this->load->view('no_permission');
            }


        } else {

            redirect('login');
        }
    }

    //add template data
    public function add()
    {
        $file_element_name = 'driver_image';
        $config['upload_path'] = './uploads/drivers';
        $config['allowed_types'] = 'png|PNG|jpg|gif|bmp|jpeg';
        $config['max_size'] = 10242311;
        $config['max_width'] = '1000011';
        $config['max_height'] = '1000011';
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload', $config);
        $this->load->model("drivers/drivers_model");
        if ($_FILES['driver_image']['name'] != '') {
            if ($this->upload->do_upload($file_element_name)) {

                $data = $this->upload->data();

                $file_id = $this->drivers_model->addDriver($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['rating'], $_POST['phone'], $_POST['dob'], $_POST['lno'], $_POST['addr1'], $_POST['addr2'], $_POST['city'], $_POST['country'], $_POST['pin'], $data['file_name'], $_POST['vendor_id']);

                echo $file_id;

            } else {
                $file_id = '';
                echo $file_id;
            }
        } else {
            $file_id = $this->drivers_model->addDriver($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['rating'], $_POST['phone'], $_POST['dob'], $_POST['lno'], $_POST['addr1'], $_POST['addr2'], $_POST['city'], $_POST['country'], $_POST['pin'], $data['file_name'] = '', $_POST['vendor_id']);

            echo $file_id;
        }
    }

    //edit the template

    public function edit_view()
    {
        if ($this->session->userdata('userloggedin') == TRUE) {
            $id = $_POST['driver_id'];

            $this->load->model('drivers/drivers_model');
            $data['drivers'] = $this->drivers_model->getDrivers($id);

            $this->load->model('vendors/vendors_model');
            $data['vendorList'] = $this->vendors_model->vendorList();

            $this->load->view('drivers/driver_edit_view', $data);
        } else {
            redirect('login');
        }
    }

    //update the school temp details
    public function updateDrivers()
    {
        $file_element_name = 'driver_image_edit';
        $config['upload_path'] = './uploads/drivers';
        $config['allowed_types'] = 'png|PNG|jpg|gif|bmp|jpeg';
        $config['max_size'] = 10242311;
        $config['max_width'] = '1000011';
        $config['max_height'] = '1000011';
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload', $config);
        $this->load->model("drivers/drivers_model");
        if ($_FILES['driver_image_edit']['name'] != '') {
            if ($this->upload->do_upload($file_element_name)) {
                $data = $this->upload->data();
                //$msg = $this->upload->display_errors('', '');
                $file_id = $this->drivers_model->updateDrivers($_POST['id'], $_POST['firstname'], $_POST['lastname'], $_POST['rating'], $_POST['phone'], $_POST['dob'], $_POST['lno'], $_POST['addr1'], $_POST['addr2'], $_POST['city'], $_POST['country'], $_POST['pin'], $data['file_name'],$_POST['vendor_id']);
                if ($_POST['picture'] != '') {
                    if (file_exists("uploads/drivers/" . basename($_POST['picture']))) {
                        unlink("uploads/drivers/" . basename($_POST['picture']));
                    }
                }
                echo $file_id;
            } else {
                $file_id = '';
                echo $file_id;
            }
        } else {
            $filename = '';
            $file_id = $this->drivers_model->updateDrivers($_POST['id'], $_POST['firstname'], $_POST['lastname'], $_POST['rating'], $_POST['phone'], $_POST['dob'], $_POST['lno'], $_POST['addr1'], $_POST['addr2'], $_POST['city'], $_POST['country'], $_POST['pin'], $filename,$_POST['vendor_id']);
            echo $file_id;
        }
    }

    //public function delete
    public function updateStatus()
    {
        $id = $_POST['capacity_id'];
        $status = $_POST['status'];
        $this->load->model('drivers/drivers_model');
        echo $this->drivers_model->driverUpdate($id, $status);
    }

    public function assignVehicle()
    {
        $vehicle_id = $_POST['vehicle_id'];
        $driver_id = $_POST['driver_id'];
        $this->load->model('drivers/drivers_model');
        echo $this->drivers_model->vehicleAssign($vehicle_id, $driver_id);
    }

    public function getLoadVehicledata()
    {

        $vehicle_id = $_POST['vehicle_id'];
        $this->load->model('drivers/drivers_model');
        $vehicleData = $this->drivers_model->vehicleLoad($vehicle_id);
        $str = '';
        if ($vehicleData['allocated'] == 1) {
            $str .= '<label class="col-lg-12 font-red-haze">The Vehicle already assigned. On saving it will re assign</label>';
        }
        $str .= '
		<div class="col-md-3">
                    <p>Photo</p>
                    <img src="' . base_url() . 'uploads/vehicles/' . $vehicleData['photo'] . '" height="50" width="50"/> </div>
                  <div class="col-md-3">
                    <p>Vehicle No</p>' . $vehicleData['vehicle_no'] . '
                  </div>
                  <div class="col-md-3">
                    <p>Basetype</p>' . $vehicleData['basetype_name'] . '
                  </div>
				  <div class="col-md-3">
                    <p>Capacity</p>' . $vehicleData['capacity'] . '
                  </div>
				  ';
        echo $str;
    }

    public function unassignDriver()
    {
        $driver_id = $_POST['driver_id'];
        $this->load->model('drivers/drivers_model');
        echo $this->drivers_model->driverUnassign($driver_id);
    }

    public function updatePassword()
    {
        $url = $this->uri->segment(4);
        $url = urldecode($url);
        $urlencode = explode("|", $url);
        $id = $urlencode[1];
        $email = $urlencode[2];
        $this->load->model('drivers/drivers_model');
        if (preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email) && is_numeric($id)) {
            $data['details'] = $this->drivers_model->check_sh_data($id, $email);
            $result['userid'] = $id;
            $result['u_mailid'] = $email;

            if ($data['details'] != 0) {
                $this->load->view('drivers/reset_password', $data);
            } else {
                redirect('login');
            }
        } else {
            redirect('login');
        }
    }

    public function passwordUpdate()
    {
        $password = $_POST['password'];
        $userid = $_POST['userid'];
        $this->load->model('drivers/drivers_model');
        echo $this->drivers_model->passwordUpdate($password, $userid);
    }
}
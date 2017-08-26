<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Vehicles extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

    }

    //Dashboard view
    public function index()
    {
        if ($this->session->userdata('userloggedin') == TRUE) {
            $userid = $this->session->userdata('userid');

            $this->load->model('vehicles/vehiclesmodel');
            $data['vehicleList'] = $this->vehiclesmodel->vehicleList();

            $this->load->model('vehiclebasetypes/basetypemodel');
            $data['baseTypeList'] = $this->basetypemodel->baseTypeList();

            $this->load->model('vehiclecapacities/capacitymodel');
            $data['capacityList'] = $this->capacitymodel->capacityList();

            $this->load->model('drivers/drivers_model');
            $data['driverList'] = $this->drivers_model->driverList();

            $this->load->model('vendors/vendors_model');
            $data['vendorList']  = $this->vendors_model->vendorList();

            //permission checking
            $user_role_id = $this->session->userdata('role');
            $this->load->model('permission_models');
            $permission = $this->permission_models->getPermissionForController_view($user_role_id, $this->uri->segment(2));
            $data['checking'] = $this->permission_models->getPermissionForController($user_role_id, $this->uri->segment(2));
            $data['menus'] = $this->permission_models->getMenuNames();
            if ($permission == '1') {
                $this->load->view('vehicles/vehicleview', $data);
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
        $file_element_name = 'vehicle_image';
        $config['upload_path'] = './uploads/vehicles';

        $config['allowed_types'] = 'png|PNG|jpg|gif|bmp|jpeg';
        $config['max_size'] = 10242311;
        $config['max_width'] = '1000011';
        $config['max_height'] = '1000011';
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload', $config);
        $this->load->model("vehicles/vehiclesmodel");
        $this->load->model('vehiclecapacities/capacitymodel');
        if ($_FILES['vehicle_image']['name'] != '') {
            if ($this->upload->do_upload($file_element_name)) {
                $data = $this->upload->data();

                $file_id = $this->vehiclesmodel->addVehicle($_POST['basetype'], $_POST['vehiclenumber'], $_POST['make'], $_POST['model'], $_POST['capacity'], $_POST['km'], $data['file_name'],$_POST['vendor_id'],$_POST['basefare'],$_POST['kmunit'],$_POST['timeunit'],$_POST['min_hrs'],$_POST['country']);
                echo $file_id;
            } else {
                $file_id = '';
                echo $file_id;
            }
        } else {
            $filename = '';

            $file_id = $this->vehiclesmodel->addVehicle($_POST['basetype'], $_POST['vehiclenumber'], $_POST['make'], $_POST['model'], $_POST['capacity'], $_POST['km'], $filename,$_POST['vendor_id'],$_POST['basefare'],$_POST['kmunit'],$_POST['timeunit'],$_POST['min_hrs'],$_POST['country']);

            echo $file_id;
        }
    }

    //edit the template

    public function edit_view()
    {
        if ($this->session->userdata('userloggedin') == TRUE) {
            $vehicle_id = $_POST['vehicle_id'];
            $basetype_id = $_POST['basetype_id'];

            $this->load->model('vehicles/vehiclesmodel');
            $data['vehicles'] = $this->vehiclesmodel->getVehicles($vehicle_id);

            $this->load->model('vehiclebasetypes/basetypemodel');
            $data['baseTypeList'] = $this->basetypemodel->baseTypeList();

            $this->load->model('vehiclecapacities/capacitymodel');
            $data['capacityList'] = $this->capacitymodel->getCapacityBaseTypeBased($basetype_id);

            $this->load->model('vendors/vendors_model');
            $data['vendorList']  = $this->vendors_model->vendorList();

            $this->load->view('vehicles/vehicle_edit_view', $data);

        } else {
            redirect('login');
        }
    }

    //update the school temp details
    public function updateVehicle()
    {

        $file_element_name = 'vehicle_image_edit';
        $config['upload_path'] = './uploads/vehicles';

        $config['allowed_types'] = 'png|PNG|jpg|gif|bmp|jpeg';
        $config['max_size'] = 10242311;
        $config['max_width'] = '1000011';
        $config['max_height'] = '1000011';
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload', $config);
        $this->load->model("vehicles/vehiclesmodel");
        $this->load->model('vehiclecapacities/capacitymodel');
        if ($_FILES['vehicle_image_edit']['name'] != '') {
            if ($this->upload->do_upload($file_element_name)) {
                $data = $this->upload->data();
                $file_id = $this->vehiclesmodel->updateVehicle($_POST['basetype'], $_POST['vehiclenumber'], $_POST['make'], $_POST['model'], $_POST['capacity'], $_POST['km'], $data['file_name'], $_POST['idvendorprofile'],$_POST['vendor_id'],$_POST['basefare'],$_POST['kmunit'],$_POST['timeunit'],$_POST['min_hrs'],$_POST['country']);
                if ($_POST['image_old'] != '') {
                    if (file_exists("uploads/vehicles/" . basename($_POST['image_old']))) {
                        unlink("uploads/vehicles/" . basename($_POST['image_old']));
                    }
                }
                echo $file_id;
            } else {
                $file_id = '';
                echo $file_id;
            }
        } else {
            $filename = '';
            $file_id = $this->vehiclesmodel->updateVehicle($_POST['basetype'], $_POST['vehiclenumber'], $_POST['make'], $_POST['model'], $_POST['capacity'], $_POST['km'], $filename, $_POST['idvendorprofile'],$_POST['vendor_id'],$_POST['basefare'],$_POST['kmunit'],$_POST['timeunit'],$_POST['min_hrs'],$_POST['country']);

            echo $file_id;
        }
    }

    //public function delete
    public function delete()
    {
        $id = $_POST['vehicle_id'];
        $status = $_POST['status'];
        $this->load->model('vehicles/vehiclesmodel');
        echo $this->vehiclesmodel->deleteVehicles($id, $status);
    }

    public function getDriver()
    {
        $user_id = $_POST['user_id'];
        $this->load->model('vehicles/vehiclesmodel');
        $driverData = $this->vehiclesmodel->driverLoad($user_id);
        $str = '';
        if ($driverData['allocated'] == 1) {
            $str .= '<label class="col-lg-12 font-red-haze">The Driver already assigned. On saving it will re assign</label>';
        }
        $str .= '
		<div class="col-md-3">
                    <p>Photo</p>
                    <img src="' . base_url() . 'uploads/drivers/' . $driverData['pictures'] . '" height="50" width="50"/> </div>
                  <div class="col-md-3">
                    <p>Email</p>' . $driverData['useremail'] . '
                  </div>
                  <div class="col-md-3">
                    <p>Phone No</p>' . $driverData['phone'] . '
                  </div>';
        echo $str;
    }

    public function unassignVehicle()
    {
        $vehicle_id = $_POST['vehicle_id'];
        $this->load->model('vehicles/vehiclesmodel');
        echo $this->vehiclesmodel->vehicleUnassign($vehicle_id);
    }
}
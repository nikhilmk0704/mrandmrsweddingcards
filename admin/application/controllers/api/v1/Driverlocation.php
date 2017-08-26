<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Driverlocation extends CI_Controller
{
    function saveLocation()
    {
        if (isset($_POST['timecreated']) && isset($_POST['latitude']) && isset($_POST['longitude']) && isset($_POST['userid'])) {
            if ($_POST['timecreated'] != '' && $_POST['latitude'] != '' && $_POST['longitude'] != '' && $_POST['userid'] != '') {
                $this->load->model('api/v1/driver');
                $output = $this->driver->save($_POST['timecreated'], $_POST['latitude'], $_POST['longitude'], $_POST['userid']);
            } else {
                $output = array("status" => "fail", "description" => "You missed required data");
            }
        } else {
            $output = array("status" => "fail", "description" => "You missed required data");
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($output));
    }
}
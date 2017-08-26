<?php $this->load->view('header'); ?>
<!-- BEGIN CONTAINER -->
<div class="page-container">

    <?php $this->load->view('menu') ?>
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <div class="page-content">
            <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
            <div class="modal fade" id="assign" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">Assign Vehicle</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" role="form" id="assign_save">
                                <input type="hidden" value="" id="vehicle_pop_id"/>

                                <div class="form-group">
                                    <label class="control-label col-md-3">Vehicle Number</label>

                                    <div class="col-md-6">
                                        <select id="vehicle_select" onchange="loadVehicleData();" name="vehicle_select"
                                                class="form-control input-medium select2me"
                                                data-placeholder="Select Vehicle">
                                            <option value="0">Select Vehicle</option>
                                            <?php if ($vehicleList != 0) { ?>
                                                <?php foreach ($vehicleList as $item) { ?>

                                                    <?php if ($item['status'] == '1' || $item['status'] == 1) { ?>
                                                        <option
                                                            value="<?php echo $item['idvendorprofile']; ?>"><?php echo $item['vehicle_no']; ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group" id="userDetail">

                                </div>
                            </form>
                        </div>
                        <div class="modal-footer ">
                            <button type="button" class="btn green" onClick="saveAssign();">Assign</button>
                            <button type="button" data-dismiss="modal" class="btn default">Cancel</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
            <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">Add Driver</h4>
                        </div>
                        <div class="modal-body">


                            <form class="form-horizontal" role="form" id="default">
                                <div class="form-body">
                                    <?php if ($this->session->userdata('role') == '1' || $this->session->userdata('role') == 1) { ?>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Vendor</label>

                                            <div class="col-md-9">
                                                <select id="vendor" name="vendor"
                                                        class="form-control input-inline input-medium select2me">
                                                    <option value="0">Select</option>

                                                    <?php if ($vendorList != 0) { ?>
                                                        <?php foreach ($vendorList as $vendorList) { ?>
                                                            <?php if ($vendorList['status'] == '1' || $vendorList['status'] == 1) { ?>
                                                                <option
                                                                    value="<?php echo $vendorList['user_id']; ?>"><?php echo $vendorList['firstname'] . " " . $vendorList['lastname']; ?></option>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">First Name</label>

                                        <div class="col-md-9">
                                            <input type="text" name="firstname" id="firstname"
                                                   class="form-control input-inline input-medium" placeholder=""
                                                   required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Last Name</label>

                                        <div class="col-md-9">
                                            <input type="text" class="form-control input-inline input-medium"
                                                   placeholder="" name="lastname" id="lastname" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Email</label>

                                        <div class="col-md-9">
                                            <input type="text" class="form-control input-inline input-medium"
                                                   placeholder="" name="email" id="email" required>
                                            <span id="errorMsg" class="font-red-haze"></span>
                                        </div>
                                    </div>
                                    <!--<div class="form-group">
                                        <label class="col-md-3 control-label">Rating</label>

                                        <div class="col-md-9">
                                            <input type="text" class="form-control input-inline input-medium"
                                                   placeholder="Enter values 0-5" name="rating" id="rating">
                                        </div>
                                    </div>-->
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Phone</label>

                                        <div class="col-md-9">
                                            <input type="text" class="form-control input-inline input-medium"
                                                   placeholder="" name="phone" id="phone" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Photo</label>

                                        <div class="col-md-9">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="input-group input-large">
                                                    <div class="form-control uneditable-input span3"
                                                         data-trigger="fileinput">
                                                        <i class="fa fa-file fileinput-exists"></i>&nbsp; <span
                                                            class="fileinput-filename">
														</span>
                                                    </div>
													<span class="input-group-addon btn default btn-file">
													<span class="fileinput-new">
													Select file </span>
													<span class="fileinput-exists">
													Change </span>
													<input type="file" name="driver_image" id="driver_image">
													</span>
                                                    <a href="#" class="input-group-addon btn red fileinput-exists"
                                                       data-dismiss="fileinput">
                                                        Remove </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Date of Birth</label>

                                        <div class="col-md-9">
                                            <input class="form-control input-medium input-inline date-picker"
                                                   type="text" value="" name="dob" id="dob">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">License No</label>

                                        <div class="col-md-9">
                                            <input type="text" class="form-control input-inline input-medium"
                                                   placeholder="" name="lno" id="lno" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Address Line 1</label>

                                        <div class="col-md-9">
                                            <input type="text" class="form-control input-inline input-medium"
                                                   placeholder="" name="addr1" id="addr1" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Address Line 2</label>

                                        <div class="col-md-9">
                                            <input type="text" class="form-control input-inline input-medium"
                                                   placeholder="" name="addr2" id="addr2" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">City</label>

                                        <div class="col-md-9">
                                            <input type="text" class="form-control input-inline input-medium"
                                                   placeholder="" name="city" id="city" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Country</label>

                                        <div class="col-md-9">
                                            <input type="text" class="form-control input-inline input-medium"
                                                   placeholder="" name="country" id="country" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Pin</label>

                                        <div class="col-md-9">
                                            <input type="text" class="form-control input-inline input-medium"
                                                   placeholder="" name="pin" id="pin" required>

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer ">
                            <button type="button" class="btn blue" onClick="saveDriver();">Save changes</button>
                            <button type="button" class="btn default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    <!-- /.addmodal-content -->
                </div>
                <!-- /.addmodal-dialog -->
            </div>
            <div id="editview"></div>
            <!-- BEGIN PAGE HEAD -->
            <div class="page-head">
                <!-- BEGIN PAGE TITLE -->
                <div class="page-title">
                    <h1>Driver Management</h1>
                </div>
                <!-- END PAGE TITLE -->
            </div>
            <!-- END PAGE HEAD -->
            <!-- BEGIN PAGE BREADCRUMB -->

            <!-- END PAGE BREADCRUMB -->
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet box grey-cascade">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-globe"></i>Manage My Drivers
                            </div>
                            <div class="tools">
                                <a href="javascript:" class="collapse">
                                </a>
                                <a href="#portlet-config" data-toggle="modal" class="config">
                                </a>
                                <a href="javascript:" class="reload">
                                </a>
                                <a href="javascript:" class="remove">
                                </a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="table-toolbar">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="btn-group">
                                            <?php if ($checking['add'] == 1 || $checking['add'] == '1') { ?>
                                                <button id="sample_editable_1_new" class="btn green" data-toggle="modal"
                                                        href="#add"> Add New <i class="fa fa-plus"></i></button>
                                            <?php } ?>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <table class="table table-striped table-bordered table-hover" id="sample_1">
                                <thead>
                                <tr>
                                    <th>
                                        No.
                                    </th>
                                    <th>
                                        Photo
                                    </th>
                                    <th>
                                        Driver Name
                                    </th>
                                    <th>
                                        Contact Number
                                    </th>
                                    <th>
                                        Email
                                    </th>
                                    <th>
                                        Assigned Vehicle
                                    </th>
                                    <th>
                                        Last Active
                                    </th>
                                    <th>
                                        Actions
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1;
                                if ($driver != 0) { ?>
                                    <?php foreach ($driver as $driverList) { ?>
                                        <tr>
                                            <td> <?php echo $i; ?> </td>
                                            <td><img
                                                    src="<?php echo base_url() . "uploads/drivers/" . $driverList['pictures']; ?>"
                                                    height="50" width="50"/></td>
                                            <td> <?php echo $driverList['firstname'] . " " . $driverList['lastname']; ?> </td>
                                            <td> <?php echo $driverList['phone']; ?> </td>
                                            <td> <?php echo $driverList['useremail']; ?> </td>
                                            <td> <?php echo $driverList['assignedvehicle']; ?> </td>
                                            <td> <?php if ($driverList['lastactive'] != '') {
                                                    echo gmdate("M d Y H:i:s", $driverList['lastactive']);
                                                } ?> </td>
                                            <td>
                                                <?php if ($checking['edit'] == 1 || $checking['edit'] == '1') { ?>
                                                    <button
                                                        onClick="editDriver(<?php echo $driverList['id_drivers_profile']; ?>)"
                                                        class="btn btn-primary btn-xs" title="Edit"><i
                                                            class="fa fa-pencil"></i></button>
                                                    <?php if ($driverList['status'] == '1' || $driverList['status'] == 1) { ?>
                                                        <button class="btn btn-success btn-xs idLoad"
                                                                data-id="<?php echo $driverList['id_drivers_profile']; ?>"
                                                                title="Assign" data-toggle="modal" href="#assign"><i
                                                                class="fa fa-check"></i></button>
                                                        <button class="btn btn-warning btn-xs"
                                                                onClick="unAssign(<?php echo $driverList['id_drivers_profile']; ?>)"
                                                                title="Unassign"><i class="fa fa-times"></i></button>
                                                    <?php } ?>
                                                <?php } ?>
                                                <?php if ($checking['delete'] == 1 || $checking['delete'] == '1') { ?>
                                                    <?php if ($driverList['profile_status'] == '1' || $driverList['profile_status'] == 1) { ?>
                                                        <button class="btn btn-danger btn-xs" title="Disable"
                                                                onClick="activateDriver(<?php echo $driverList['id_drivers_profile']; ?>,0);">
                                                            <i class="fa fa-ban"></i></button>
                                                    <?php } else { ?>
                                                        <button class="btn btn-success btn-xs" title="Enable"
                                                                onClick="activateDriver(<?php echo $driverList['id_drivers_profile']; ?>,1);">
                                                            <i class="fa fa-check"></i></button>
                                                    <?php } ?>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php $i += 1;
                                    } ?>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END EXAMPLE TABLE PORTLET-->
                </div>
            </div>
            <!-- END PAGE CONTENT-->
        </div>
    </div>
    <!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<?php $this->load->view('footer'); ?>
<script>
    $(document).on("click", ".idLoad", function () {
        var vehicleId = $(this).data('id');
        $("#vehicle_pop_id").val(vehicleId);
    });
    jQuery.validator.setDefaults({debug: true});
    var form = $("#default");
    $.validator.addMethod("select_valid_vendor", function (value, element) {
        if (value != 0) {
            return 'true';
        }
    }, "Select a vendor");
    form.validate({
        errorElement: "label",
        errorClass: "font-red-haze",
        rules: {
            'vendor': {select_valid_vendor: true},
            'firstname': {required: true},
            'lastname': {required: true},
            'email': {required: true, email: true},
            'phone': {required: true},
            'dob': {required: true},
            'lno': {required: true},
            'addr1': {required: true},
            'city': {required: true},
            'country': {required: true},
            'pin': {required: true, number: true}

        },
        messages: {
            'vendor': {required: 'Please select vendor!'},
            'firstname': {required: 'Please select firstname.'},
            'lastname': {required: 'Please enter lastname.'},
            'email': {required: 'Please enter email.', email: "Email not valid."},
            'phone': {required: 'Please enter phone no.'},
            'dob': {required: 'Please enter date of birth.'},
            'lno': {required: 'Please enter license no.'},
            'addr1': {required: 'Please enter address.'},
            'city': {required: 'Please enter city.'},
            'country': {required: 'Please enter country.'},
            'pin': {required: 'Please enter pin.'}
        }
    });
    function saveDriver() {
        if (form.valid()) {
            var vendor_id = '';
            if($('#vendor option:selected').val() == null){
                vendor_id = 0;
            } else {
                vendor_id = $('#vendor option:selected').val();
            }
            $.ajaxFileUpload({
                url: "<?php echo site_url('drivers/drivers/add');?>",
                type: 'post',
                secureuri: false,
                fileElementId: 'driver_image',
                dataType: 'json',
                data: {
                    vendor_id: vendor_id,
                    firstname: $('#firstname').val(),
                    lastname: $('#lastname').val(),
                    email: $('#email').val(),
                    rating: $('#rating').val(),
                    phone: $('#phone').val(),
                    dob: $('#dob').val(),
                    lno: $('#lno').val(),
                    addr1: $('#addr1').val(),
                    addr2: $('#addr2').val(),
                    city: $('#city').val(),
                    country: $('#country').val(),
                    pin: $('#pin').val()
                },

                success: function (data) {
                    if (data == 1) {
                        location.reload();
                    } else if (data == 2) {
                        $("#errorMsg").html('Email already exists');
                    }
                }
            });
        }
    }

    function editDriver(id) {
        string_array = "driver_id=" + id;

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('drivers/drivers/edit_view');  ?>",
            data: string_array,
            success: function (msg) {
                $("#editview").html(msg);
                $('#edit_popup').trigger("click");
                ComponentsPickers.init();
            }
        });
    }
    function updateDriver(id, image) {
        var form_update = $("#default1");
        form_update.validate({
            errorElement: "label",
            errorClass: "font-red-haze",
            rules: {
                'vendor_edit': {select_valid_vendor: true},
                'firstname_edit': {required: true},
                'lastname_edit': {required: true},
                'email_edit': {required: true, email: true},
                'phone_edit': {required: true},
                'dob_edit': {required: true},
                'lno_edit': {required: true},
                'addr1_edit': {required: true},
                'city_edit': {required: true},
                'country_edit': {required: true},
                'pin_edit': {required: true, number: true}

            },
            messages: {
                'vendor_edit': {required: 'Please select vendor!'},
                'firstname_edit': {required: 'Please select firstname'},
                'lastname_edit': {required: 'Please enter lastname'},
                'email_edit': {required: 'Please enter email'},
                'phone_edit': {required: 'Please enter phone number'},
                'dob_edit': {required: 'Please enter date of birth'},
                'lno_edit': {required: 'Please enter license number'},
                'addr1_edit': {required: 'Please enter address'},
                'city_edit': {required: 'Please enter city'},
                'country_edit': {required: 'Please enter country'},
                'pin_edit': {required: 'Please enter pin'}
            }
        });
        if (form_update.valid()) {

            var vendor_id = '';
           if ($('#vendor option:selected').val() == null) {
              vendor_id = 0;
           } else {
               vendor_id = $('#vendor_edit option:selected').val();
           }
            $.ajaxFileUpload({
                url: "<?php echo site_url('drivers/drivers/updateDrivers');?>",
                type: 'post',
                secureuri: false,
                fileElementId: 'driver_image_edit',
                dataType: 'json',
                data: {
                    id: id,
                    picture: image,
                    vendor_id:vendor_id,
                    firstname: $('#firstname_edit').val(),
                    lastname: $('#lastname_edit').val(),
                    email: $('#email_edit').val(),
                    rating: $('#rating').val(),
                    phone: $('#phone_edit').val(),
                    dob: $('#dob_edit').val(),
                    lno: $('#lno_edit').val(),
                    addr1: $('#addr1_edit').val(),
                    addr2: $('#addr2_edit').val(),
                    city: $('#city_edit').val(),
                    country: $('#country_edit').val(),
                    pin: $('#pin_edit').val()

                },

                success: function (data) {

                   if (data == 1) {
                        location.reload();
                    }
                }
            });
        }
    }

    $.validator.addMethod("select_valid_vehicle", function (value, element) {
        var position = $('#vehicle_select').val();
        if (value != 0) {
            return 'true';
        }
    }, "Select a vehicle");
    //assign vehicle to a driver
    var assignForm = $("#assign_save");

    assignForm.validate({
        errorElement: "label",
        errorClass: "font-red-haze",
        rules: {
            'vehicle_select': {select_valid_vehicle: true}
        },
        messages: {
            'vehicle_select': {required: 'Please select vehicle!<br>'}
        }
    });
    function loadVehicleData() {
        if ($("#vehicle_select option:selected").val() != 0) {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('drivers/drivers/getLoadVehicledata'); ?>",
                data: {vehicle_id: $("#vehicle_select option:selected").val()},
                success: function (msg) {
                    $("#userDetail").html(msg)
                }
            });
        }
    }
    function saveAssign() {
        if (assignForm.valid()) {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('drivers/drivers/assignVehicle'); ?>",
                data: {
                    vehicle_id: $("#vehicle_select option:selected").val(),
                    driver_id: $("#vehicle_pop_id").val()
                },
                success: function (msg) {
                    if (msg == 1) {
                        location.reload();
                    }
                }
            });

        }
    }
    function unAssign(driver_id) {
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('drivers/drivers/unassignDriver'); ?>",
            data: {
                driver_id: driver_id
            },
            success: function (msg) {
                if (msg == 1) {
                    location.reload();
                }
            }
        });
    }
    function activateDriver(capacity_id, status) {
        if (status == 1 || status == '1') {
            var r = confirm("Are you sure want to activate this?");
        } else {
            var r = confirm("Are you sure want to deactivate this?");
        }
        if (r == true) {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('drivers/drivers/updateStatus'); ?>",
                data: {
                    capacity_id: capacity_id,
                    status: status
                },
                success: function (msg) {
                    if (msg == 1) {
                        location.reload();
                    } else if (msg == 2 || msg == '2') {
                        alert('Please activate the corresponding basetype first');
                        return false;
                    }
                }
            });
        }
    }

</script>
</body>
<!-- END BODY -->
</html>
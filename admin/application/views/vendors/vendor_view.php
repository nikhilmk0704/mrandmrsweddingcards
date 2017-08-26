<?php $this->load->view('header'); ?>
<!-- BEGIN CONTAINER -->
<div class="page-container">
    <?php $this->load->view('menu') ?>
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <div class="page-content">
            <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
            <div class="modal fade" tabindex="-1" id="add" role="dialog" aria-labelledby="myModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">Add Vendor</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" role="form" id="default">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Vendor Name</label>

                                        <div class="col-md-9">
                                            <input type="text" name="name" id="name"
                                                   class="form-control input-inline input-medium" placeholder=""
                                                   required>
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
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Phone</label>

                                        <div class="col-md-9">
                                            <input type="text" class="form-control input-inline input-medium"
                                                   placeholder="" name="phone" id="phone" required>
                                        </div>
                                    </div>
                                    <!-- <div class="form-group">
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
                                                   placeholder="" name="addr2" id="addr2">
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
                                    </div> -->
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn blue" onClick="saveVendor();">Save changes</button>
                            <button type="button" class="btn default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <div id="editview"></div>
            <!-- /.modal -->
            <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
            <!-- BEGIN PAGE HEADER-->
            <!-- BEGIN PAGE HEAD -->
            <div class="page-head">
                <!-- BEGIN PAGE TITLE -->
                <div class="page-title">
                    <h1>Vendor Management</h1>
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
                                <i class="fa fa-globe"></i>Vendors List
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="table-toolbar">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="btn-group">   
                                            <button id="sample_editable_1_new" class="btn green" data-toggle="modal"
                                                        href="#add"> Add New <i class="fa fa-plus"></i></button>
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
                                        Status
                                    </th>
                                    <th>
                                        Name
                                    </th>
                                    <th>
                                        Email
                                    </th>
                                    <th>
                                        Phone
                                    </th>
                                    <th>
                                        Created Time
                                    </th>
                                    <th>
                                        Updated Time
                                    </th>
                                    <th>
                                        Actions
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1;
                                if ($vendorList != 0) { ?>
                                    <?php foreach ($vendorList as $vendorList) { ?>
                                        <tr>
                                            <td> <?php echo $i; ?> </td>
                                            <td><?php if ($vendorList['enabled'] == 0 || $vendorList['enabled'] == '0') { ?>
                                                    <span class="label label-sm label-warning">Inactive</span>
                                                <?php } else { ?>
                                                    <span class="label label-sm label-info">Active</span>
                                                <?php } ?>
                                            </td>
                                            <td> <?php echo $vendorList['name'] ?></td>
                                            <td> <?php echo $vendorList['emailId']; ?></td>
                                            <td> <?php echo $vendorList['phoneNumber']; ?> </td>
                                            <td> <?php echo $vendorList['createdAt']; ?> </td>
                                            <td> <?php echo $vendorList['updatedAt']; ?> </td>
                                            <td>
                                               
                                                <button onClick="editVendor(<?php echo $vendorList['id']; ?>)"
                                                        class="btn btn-primary btn-xs" title="Edit"><i
                                                        class="fa fa-pencil"></i>
                                                </button>
                                                
                                        
                                                <?php if ($vendorList['enabled'] == 0 || $vendorList['enabled'] == '0') { ?>
                                                    <button class="btn btn-info btn-xs" title="Activate"
                                                            onclick="active(<?php echo $vendorList['id']; ?>)"><i
                                                                class="fa fa-check"></i></button>
                                                <?php } else { ?>
                                                    <button class="btn btn-danger btn-xs" title="Deactivate"
                                                            onclick="active(<?php echo $vendorList['id']; ?>)"><i
                                                                class="fa fa-ban"></i></button>
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
    jQuery.validator.setDefaults({debug: true});
    var form = $("#default");

    form.validate({
        errorElement: "label",
        errorClass: "font-red-haze",
        rules: {
            'name': {required: true},
            'email': {required: true, email: true},
            'phone': {required: true}
        },
        messages: {
            'name': {required: 'Please select vendor name.'},
            'email': {required: 'Please enter email.', email: "Email not valid."},
            'phone': {required: 'Please enter phone no.'}
        }
    });
    function saveVendor() {
        if (form.valid()) {
            $.ajax({
                url: "<?php echo site_url('add_vendor');?>",
                type: 'post',
                dataType: 'json',
                data: {
                    name: $('#name').val(),
                    email: $('#email').val(),
                    phone: $('#phone').val()
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

    function editVendor(id) {
        string_array = "vendor_id=" + id;

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('edit_vendor');  ?>",
            data: string_array,
            success: function (msg) {
                $("#editview").html(msg);
                $('#edit_popup').trigger("click");
                ComponentsPickers.init();
            }
        });
    }
    function updateVendor(id) {
        var form_update = $("#default1");
        form_update.validate({
            errorElement: "label",
            errorClass: "font-red-haze",
            rules: {
                'name_edit': {required: true},
                'email_edit': {required: true, email: true},
                'phone_edit': {required: true}

            },
            messages: {
                'name_edit': {required: 'Please select vendor name'},
                'email_edit': {required: 'Please enter email'},
                'phone_edit': {required: 'Please enter phone number'}
            }
        });
        if (form_update.valid()) {
            $.ajax({
                url: "<?php echo site_url('update_vendor');?>",
                type: 'post',
                dataType: 'json',
                data: {
                    id: id,
                    name: $('#name_edit').val(),
                    email: $('#email_edit').val(),
                    phone: $('#phone_edit').val()
                },

                success: function (data) {
                    if (data == 1) {
                        location.reload();
                    }
                }
            });
        }
    }
    function active(vendorId) {
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('activate_vendor'); ?>",
            data: {vendorId: vendorId},
            success: function (msg) {
                if (msg == 1) {
                    location.reload();
                }
            }
        });
    }


</script>
</body>
<!-- END BODY -->
</html>
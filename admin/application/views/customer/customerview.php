<?php $this->load->view('header'); ?>
<div class="page-container">
    <!-- BEGIN SIDEBAR -->
    <?php $this->load->view('menu'); ?>
    <!-- END SIDEBAR -->
    <div id="editview"></div>
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <!-- BEGIN PAGE HEAD -->
            <div class="page-head">
                <!-- BEGIN PAGE TITLE -->
                <div class="page-title">
                    <h1>Customer Management</h1>
                </div>
                <!-- END PAGE TITLE -->
            </div>
            <!-- END PAGE HEAD -->

            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet box grey-cascade">
                        <div class="portlet-title">
                            <div class="caption"><i class="fa fa-globe"></i>Customers</div>
                            <div class="tools"><a href="javascript:" class="collapse"> </a> <a href="#portlet-config"
                                                                                                data-toggle="modal"
                                                                                                class="config"> </a> <a
                                    href="javascript:" class="reload"> </a> <a href="javascript:" class="remove"> </a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="table-toolbar">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="btn-group">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <table class="table table-striped table-bordered table-hover" id="sample_1">
                                <thead>
                                <tr>
                                    <th> No.</th>
                                    <th> Status</th>
                                    <th> Customer Name</th>
                                    <th> Email</th>
                                    <th> Phone</th>
                                    <th> Trip Requests</th>
                                    <th> Revenue</th>
                                    <th> Devices</th>
                                    <th> Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1;
                                if ($customerList != 0) { ?>
                                    <?php foreach ($customerList as $customerList) { ?>
                                        <tr>
                                            <td> <?php echo $i; ?> </td>
                                            <td><?php if ($customerList['status'] == 0 || $customerList['status'] == '0') { ?>
                                                    <span
                                                        class="label label-sm label-warning">Inactive</span><?php } else { ?>
                                                    <span class="label label-sm label-info">Active</span><?php } ?></td>

                                            <td> <?php echo $customerList['firstname'] . " " . $customerList['lastname']; ?> </td>
                                            <td> <?php echo $customerList['useremail']; ?> </td>
                                            <td> <?php echo $customerList['phone']; ?> </td>
                                            <td> <?php echo $customerList['tripcount']; ?> </td>
                                            <td> <?php echo $customerList['total_revenue']; ?></td>
                                            <td><span class="label label-sm label-danger" title="iOS"><i
                                                        class="fa fa-apple"></i></span>
                                                - <?php echo $customerList['ioscount']; ?>&nbsp;&nbsp;<span
                                                    class="label label-sm label-danger" title="Android"><i
                                                        class="fa fa-android"></i></span>
                                                - <?php echo $customerList['androidcount']; ?></td>
                                            <td>
                                                <?php if ($checking['edit'] == 1 || $checking['edit'] == '1') { ?>
                                                    <button
                                                        onClick="editCustomer(<?php echo $customerList['user_id']; ?>)"
                                                        class="btn btn-primary btn-xs" title="Edit"><i
                                                            class="fa fa-pencil"></i></button>
                                                <?php } ?>
                                                <?php if ($checking['delete'] == 1 || $checking['delete'] == '1') { ?>
                                                    <?php if ($customerList['status'] == 0 || $customerList['status'] == '0') { ?>
                                                    <button class="btn btn-info btn-xs" title="Activate"
                                                            onclick="active(<?php echo $customerList['user_id']; ?>)"><i
                                                                class="fa fa-check"></i></button><?php } else { ?>
                                                    <button class="btn btn-danger btn-xs" title="Deactivate"
                                                            onclick="active(<?php echo $customerList['user_id']; ?>)"><i
                                                                class="fa fa-ban"></i></button><?php } ?>
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

    function active(customerId) {
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('customer/customers/active'); ?>",
            data: {customerId: customerId},
            success: function (msg) {
                if (msg == 1) {
                    location.reload();
                }
            }
        });
    }
    function editCustomer(id) {
        string_array = "customer_id=" + id;
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('customer/customers/edit_view');  ?>",
            data: string_array,
            success: function (msg) {
                $("#editview").html(msg);
                $('#edit_popup').trigger("click");
            }
        });
    }
    function updateCustomer(id) {
        var form_update = $("#default1");
        form_update.validate({
            errorElement: "label",
            errorClass: "font-red-haze",
            rules: {
                'first_name_edit': {required: true},
                'last_name_edit': {required: true},
                'phone_edit': {required: true, number: true}
            },
            messages: {
                'first_name_edit': {required: 'Please enter firstname.'},
                'last_name_edit': {required: 'Please enter lastname.'},
                'phone_edit': {required: 'Please enter phone no.'}
            }
        });
        if (form_update.valid()) {
            $.ajax({
                url: "<?php echo site_url('customer/customers/updateCustomer');?>",
                type: 'post',
                secureuri: false,
                dataType: 'json',
                data: {
                    id: id,
                    firstname: $('#first_name_edit').val(),
                    lastname: $('#last_name_edit').val(),
                    phone_edit: $('#phone_edit').val()
                },

                success: function (data) {
                    if (data == 1) {
                        location.reload();
                    }
                }
            });
        }
    }
</script>
</body>
<!-- END BODY -->
</html>
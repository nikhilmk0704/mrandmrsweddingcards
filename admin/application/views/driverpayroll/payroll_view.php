<?php $this->load->view('header'); ?>
<!-- BEGIN CONTAINER -->

<div class="page-container">
    <!-- BEGIN SIDEBAR -->
    <?php $this->load->view('menu'); ?>
    <style>
        .pac-container {
            z-index: 99999;
        }
    </style>
    <!-- END SIDEBAR -->
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <div class="page-content">
            <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
            <div id="editview"></div>
            <div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">Create Payroll</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" role="form" id="default">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Base Type</label>

                                        <div class="col-md-9">
                                            <select id="basetype" name="basetype" class="form-control input-medium"
                                                    onChange="loadCapacity();">
                                                <option value="0">Select</option>
                                                <?php if (count($baseTypeList) > 0) { ?>
                                                    <?php foreach ($baseTypeList as $baseTypeList) { ?>
                                                        <?php if ($baseTypeList['isdeleted'] == '1' || $baseTypeList['isdeleted'] == 1) { ?>
                                                            <option
                                                                value="<?php echo $baseTypeList['base_type_id']; ?>"><?php echo $baseTypeList['basetype']; ?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Capacity</label>

                                        <div class="col-md-9">
                                            <select id="capacity" name="capacity" class="form-control input-medium">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Monthly</label>

                                        <div class="col-md-9">
                                            <input type="text" class="form-control  input-medium" id="monthly"
                                                   name="monthly">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Min Duty Hour</label>

                                        <div class="col-md-9">
                                            <input type="text" class="form-control input-medium" id="min_duty_hr"
                                                   name="min_duty_hr">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">KM Unit</label>

                                        <div class="col-md-9">
                                            <input type="text" class="form-control  input-medium" id="km_unit"
                                                   name="km_unit">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Overtime Rate</label>

                                        <div class="col-md-9">
                                            <input type="text" class="form-control input-medium" id="ot_rate"
                                                   name="ot_rate">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn blue" onClick="saveForHire();">Save changes</button>
                            <button type="button" class="btn default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
            <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
            <!-- BEGIN PAGE HEADER-->
            <!-- BEGIN PAGE HEAD -->
            <div class="page-head">
                <!-- BEGIN PAGE TITLE -->
                <div class="page-title">
                    <h1>Driver Payroll</h1>
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
                            <div class="caption"><i class="fa fa-globe"></i> Driver Payroll</div>
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
                                            <?php if ($checking['add'] == 1 || $checking['add'] == '1') { ?>
                                                <a href="#portlet-config" data-toggle="modal" class="btn green">Add New
                                                    <i class="fa fa-plus"></i> </a>
                                            <?php } ?>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <table class="table table-striped table-bordered table-hover" id="sample_1">
                                <thead>
                                <tr>
                                    <th> No.</th>
                                    <th> Base Type</th>
                                    <th> Capacity</th>
                                    <th> Monthly</th>
                                    <th> Min Duty Hour</th>
                                    <th> KM Unit</th>
                                    <th> Overtime</th>
                                    <th> Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1;
                                if ($payrollList != 0) { ?>
                                    <?php foreach ($payrollList as $payrollList) { ?>
                                        <tr>
                                            <td> <?php echo $i; ?> </td>
                                            <td> <?php echo $payrollList['basetype_name']; ?> </td>
                                            <td> <?php echo $payrollList['capacity_name']; ?> </td>
                                            <td> <?php echo $payrollList['monthly']; ?> </td>
                                            <td> <?php echo $payrollList['min_duty_hr']; ?> </td>
                                            <td> <?php echo $payrollList['km_unit']; ?> </td>
                                            <td> <?php echo $payrollList['ot_rate']; ?> </td>
                                            <td>
                                                <?php if ($checking['delete'] == 1 || $checking['delete'] == '1') { ?>
                                                    <button class="btn btn-danger btn-xs" title="Delete"
                                                            onClick="deletePayroll(<?php echo $payrollList['id']; ?>);">
                                                        <i class="fa fa-trash"></i></button>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php $i = $i + 1;
                                    } ?>
                                <?php } else { ?>
                                    <tr>
                                        <td></td>

                                        <td></td>
                                        <td> No Data</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
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
<script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
<script src="<?php echo base_url(); ?>assets/admin/geocomplete/jquery.geocomplete.js?09865678987"></script>
<script src="<?php echo base_url(); ?>assets/admin/geocomplete/jquery.geocomplete1.js?09865678987"></script>
<script src="<?php echo base_url(); ?>assets/admin/geocomplete/logger.js"></script>
<script>
    $.validator.addMethod("select_valid", function (value, element) {
        var position = $('#basetype').val();
        if (value != 0) {
            return 'true';
        }
    }, "Select a basetype");
    jQuery.validator.setDefaults({debug: true});
    $.validator.addMethod("select_valid_capacity", function (value, element) {
        var position = $('#basetype').val();
        if (value != 0) {
            return 'true';
        }
    }, "Select a capacity");
    jQuery.validator.setDefaults({debug: true});

    var form = $("#default");

    form.validate({
        errorElement: "label",
        errorClass: "font-red-haze",
        rules: {
            'basetype': {select_valid: true},
            'capacity': {required: true},
            'monthly': {required: true, number: true},
            'min_duty_hr': {required: true, number: true},
            'km_unit': {required: true, number: true},
            'ot_rate': {required: true, number: true}
        }
    });
    function saveForHire() {
        if (form.valid()) {
            $.ajax({
                url: "<?php echo site_url('driverpayroll/driverpayroll/add'); ?>",
                type: 'post',
                data: {
                    basetype: $("#basetype option:selected").val(),
                    capacity: $("#capacity option:selected").val(),
                    monthly: $("#monthly").val(),
                    min_duty_hr: $("#min_duty_hr").val(),
                    km_unit: $("#km_unit").val(),
                    ot_rate: $("#ot_rate").val(),
                },
                success: function (msg) {
                    location.reload();
                }
            });
        }
    }

    function loadCapacity() {
        if ($("#basetype option:selected").val() > 0) {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('hire/for_hire_trip/ajaxLoadCapacity'); ?>",
                data: {
                    basetype_id: $("#basetype option:selected").val()
                },
                success: function (msg) {
                    $("#capacity").html(msg);
                }
            });

        }
    }
    function deletePayroll(hireId) {
        var r = confirm("Are you sure want to delete this?");
        if (r == true) {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('driverpayroll/driverpayroll/delete'); ?>",
                data: {hireId: hireId},
                success: function (msg) {
                    if (msg == 1) {
                        location.reload();
                    }
                }
            });
        } else {
            return false;
        }
    }


    <!---->
</script>
</body><!-- END BODY -->
</html>
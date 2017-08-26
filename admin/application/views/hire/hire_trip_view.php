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
                            <h4 class="modal-title">Create Hire Trip</h4>
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
                                        <label class="col-md-3 control-label">From - To</label>

                                        <div class="col-md-9">
                                            <select id="from_to" name="from_to" class="form-control input-medium">
                                                <option value="0">Select</option>
                                                <?php if (count($locationList) > 0) { ?>
                                                    <?php foreach ($locationList as $location) { ?>
                                                        <?php if ($location['isdeleted'] == '1' || $location['isdeleted'] == 1) { ?>
                                                            <?php
                                                            $from = explode(",", $location['from']);
                                                            $to = explode(",", $location['to']);
                                                            ?>
                                                            <option
                                                                value="<?php echo $location['id']; ?>"><?php echo $from[0] . " - " . $to[0]; ?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Rates</label>

                                        <div class="col-md-9">
                                            <input type="text" id="rates" name="rates" class="form-control input-medium"
                                                   placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Free Hours</label>

                                        <div class="col-md-9">
                                            <input type="text" id="free_hrs" name="free_hrs"
                                                   class="form-control input-medium" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Per Hour Rate</label>

                                        <div class="col-md-9">
                                            <input type="text" id="per_hr_rate" name="per_hr_rate"
                                                   class="form-control input-medium" placeholder="">
                                        </div>
                                    </div>
                                    <div class="map_canvas" id="map_canvas"></div>
                                    <div class="map_canvas1" id="map_canvas1"></div>
                                    <input type="hidden" id="lat1" name="lat1" value="">
                                    <input type="hidden" id="lng1" name="lng1" value="">
                                    <input type="hidden" id="lat2" name="lat2" value="">
                                    <input type="hidden" id="lng2" name="lng2" value="">

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
                    <h1>For Hire Trip Management</h1>
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
                            <div class="caption"><i class="fa fa-globe"></i> For Hire Trip List</div>
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
                                    <th> Basetype</th>
                                    <th> Vehicle Capacity</th>
                                    <th> From</th>
                                    <th> To</th>
                                    <th> Rates</th>
                                    <th> Free Hours</th>
                                    <th> Per Hour Charge</th>
                                    <th> Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1;
                                if ($forHireList != 0) { ?>
                                    <?php foreach ($forHireList as $forHireList) { ?>
                                        <tr>
                                            <td> <?php echo $i; ?> </td>
                                            <td> <?php echo $forHireList['basetype_name']; ?> </td>
                                            <td> <?php echo $forHireList['capacity']; ?> </td>
                                            <td> <?php echo $forHireList['from']; ?> </td>
                                            <td> <?php echo $forHireList['to']; ?> </td>
                                            <td> <?php echo $forHireList['rates']; ?> </td>
                                            <td> <?php echo $forHireList['free_hrs']; ?> </td>
                                            <td> <?php echo $forHireList['per_hr']; ?> </td>
                                            <td>
                                                <?php if ($checking['delete'] == 1 || $checking['delete'] == '1') { ?>
                                                    <button class="btn btn-danger btn-xs" title="Delete"
                                                            onClick="deleteHireTrip(<?php echo $forHireList['id']; ?>);">
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
    $.validator.addMethod("select_valid_location", function (value, element) {
        var position = $('#from_to').val();
        if (value != 0) {
            return 'true';
        }
    }, "Select a Location");
    jQuery.validator.setDefaults({debug: true});

    var form = $("#default");

    form.validate({
        errorElement: "label",
        errorClass: "font-red-haze",
        rules: {
            'basetype': {select_valid: true},
            'capacity': {required: true},
            'from_to': {select_valid_location: true},
            'rates': {required: true, number: true},
            'free_hrs': {required: true, number: true},
            'per_hr_rate': {required: true, number: true}
        },
        messages: {
            'basetype': {required: 'Please select basetype!'},
            'capacity': {required: 'Please add capacity'},
            'from_to': {required: 'Please add from and to location'},
            'rates': {required: 'Please add unit rate per time'},
            'free_hrs': {required: 'Please add free hours'},
            'per_hr_rate': {required: 'Please add per hour rate'}
        }
    });
    function saveForHire() {
        if (form.valid()) {
            $.ajax({
                url: "<?php echo site_url('hire/for_hire_trip/add'); ?>",
                type: 'post',
                data: {
                    basetype: $("#basetype option:selected").val(),
                    capacity: $("#capacity option:selected").val(),
                    from_to: $("#from_to option:selected").val(),
                    rates: $("#rates").val(),
                    free_hrs: $("#free_hrs").val(),
                    per_hr_rate: $("#per_hr_rate").val(),
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
    function deleteHireTrip(hireId) {
        var r = confirm("Are you sure want to delete this?");
        if (r == true) {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('hire/for_hire_trip/delete'); ?>",
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
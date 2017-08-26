<?php $this->load->view('header'); ?>
<!-- BEGIN CONTAINER -->

<div class="page-container">
    <!-- BEGIN SIDEBAR -->
    <?php $this->load->view('menu'); ?>
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
                            <h4 class="modal-title">Create Capacity</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" role="form" id="default">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Base Type</label>

                                        <div class="col-md-9">
                                            <select id="basetype" name="basetype" class="form-control input-medium">
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
                                            <input type="text" id="capacity" name="capacity"
                                                   class="form-control input-medium" placeholder="">
                                        </div>
                                    </div>
                                    <!--<div class="form-group">
                                        <label class="col-md-3 control-label">Base Fare</label>

                                        <div class="col-md-9">
                                            <input type="text" id="basefare" name="basefare"
                                                   class="form-control input-medium" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Specified Min Hrs</label>

                                        <div class="col-xs-2">
                                            <input type="checkbox" class="form-control" id="min_hr_chk"
                                                   name="min_hr_chk">
                                        </div>
                                    </div>
                                    <div class="form-group" id="div_min_hr" style="display:none">
                                        <label class="col-md-3 control-label">Minimum Hrs</label>

                                        <div class="col-md-9">
                                            <input type="text" id="min_hrs" name="min_hrs"
                                                   class="form-control input-medium" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Km Unit</label>

                                        <div class="col-md-9">
                                            <input type="text" id="kmunit" name="kmunit"
                                                   class="form-control input-medium" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Time Unit</label>

                                        <div class="col-md-9">
                                            <input type="text" id="timeunit" name="timeunit"
                                                   class="form-control input-medium" placeholder="">
                                        </div>
                                    </div>-->
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Icon</label>

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
													<input type="file" name="vehicle_capacity_image"
                                                           id="vehicle_capacity_image">
													</span>
                                                    <a href="#" class="input-group-addon btn red fileinput-exists"
                                                       data-dismiss="fileinput">
                                                        Remove </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer ">
                            <button type="button" class="btn blue" onClick="saveCapacity();">Save changes</button>
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
                    <h1>Vehicle Capacity Management</h1>
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
                            <div class="caption"><i class="fa fa-globe"></i>Create New Capacity</div>
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
                                    <th> Icon</th>
                                    <th> Vehicle Capacity</th>
                                    <th> Basetype</th>
                                   <!-- <th> Basefare</th>
                                    <th> Per KM Rate</th>
                                    <th> Per Time Rate</th>-->
                                    <th> Total Vehicles</th>
                                    <th> Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1;
                                if ($capacityList != 0) { ?>
                                    <?php foreach ($capacityList as $capacityList) { ?>
                                        <tr>
                                            <td> <?php echo $i; ?> </td>
                                            <td><img
                                                    src="<?php echo base_url() . "uploads/vehicle_capacity_image/" . $capacityList['photo']; ?>"
                                                    height="50" width="50"/></td>
                                            <td> <?php echo $capacityList['capacity']; ?> </td>
                                            <td> <?php echo $capacityList['basetype_name']; ?> </td>
                                            <!--<td> <?php /*echo $capacityList['basefare']; */?> </td>
                                            <td> <?php /*echo $capacityList['km_multiplier']; */?> </td>
                                            <td> <?php /*echo $capacityList['time_multiplier']; */?> </td>-->

                                            <td><?php echo $capacityList['countVehicle']; ?></td>

                                            <td>
                                                <?php if ($checking['edit'] == 1 || $checking['edit'] == '1') { ?>
                                                    <button class="btn btn-primary btn-xs" title="Edit"
                                                            data-toggle="modal"
                                                            onClick="editCapacity(<?php echo $capacityList['capacity_id']; ?>)">
                                                        <i class="fa fa-pencil"></i></button>
                                                <?php } ?>
                                                <?php if ($checking['delete'] == 1 || $checking['delete'] == '1') { ?>
                                                    <?php if ($capacityList['status'] == '1' || $capacityList['status'] == 1) { ?>
                                                        <button class="btn btn-danger btn-xs" title="Disable"
                                                                onClick="activateCapacity(<?php echo $capacityList['capacity_id']; ?>,0);">
                                                            <i class="fa fa-ban"></i></button>
                                                    <?php } else { ?>
                                                        <button class="btn btn-success btn-xs" title="Enable"
                                                                onClick="activateCapacity(<?php echo $capacityList['capacity_id']; ?>,1);">
                                                            <i class="fa fa-check"></i></button>
                                                    <?php } ?>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php $i = $i + 1;
                                    } ?>
                                <?php } else { ?>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td> No Data</td>
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
<script>
    $.validator.addMethod("select_valid", function (value, element) {
        var position = $('#basetype').val();
        if (value != 0) {
            return 'true';
        }
    }, "Select a basetype");
    jQuery.validator.setDefaults({debug: true});
    var form = $("#default");

    form.validate({
        errorElement: "label",
        errorClass: "font-red-haze",
        rules: {
            'basetype': {select_valid: true},
            'capacity': {required: true}
           /* 'basefare': {required: true, number: true},
            'min_hrs': {required: true, number: true},
            'kmunit': {required: true, number: true},
            'timeunit': {required: true, number: true}*/
        },
        messages: {
            'basetype': {required: 'Please select basetype!<br>'},
            'capacity': {required: 'Please add capacity'}
            /*'basefare': {required: 'Please add base fare'},
            'min_hrs': {required: 'Please add min hrs'},
            'kmunit': {required: 'Please add unit rate per km'},
            'timeunit': {required: 'Please add unit rate per time'}*/

        }
    });
    function saveCapacity() {
        if (form.valid()) {
            $.ajaxFileUpload({
                url: "<?php echo site_url('vehiclecapacities/vehiclecapacities/add'); ?>",
                type: 'post',
                secureuri: false,
                fileElementId: 'vehicle_capacity_image',
                dataType: 'json',
                data: {
                    basetype: $("#basetype option:selected").val(),
                    capacity: $("#capacity").val()
                   /* basefare: $("#basefare").val(),
                    kmunit: $("#kmunit").val(),
                    timeunit: $("#timeunit").val(),
                    min_hrs: $("#min_hrs").val()*/
                },
                success: function (msg) {
                    location.reload();
                }
            });
        }
    }

    function editCapacity(id) {
        string_array = "capacity_id=" + id;

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('vehiclecapacities/vehiclecapacities/edit_view');  ?>",
            data: string_array,
            success: function (msg) {

                $("#editview").html(msg);
                $('#edit_popup').trigger("click");

            }
        });
    }
    function updateCapacity(id, image) {
        var form_update = $("#default1");
        form_update.validate({
            errorElement: "label",
            errorClass: "font-red-haze",
            rules: {
                'basetype_edit': {select_valid: true},
                'capacity_edit': {required: true}
                /*'basefare_edit': {required: true, number: true},
                'kmunit_edit': {required: true, number: true},
                'timeunit_edit': {required: true, number: true}*/
            },
            messages: {
                'basetype_edit': {required: 'Please select basetype!<br>'},
                'capacity_edit': {required: 'Please add capacity'}
                /*'basefare_edit': {required: 'Please add basefare'},
                'kmunit_edit': {required: 'Please add unit rate per km'},
                'timeunit_edit': {required: 'Please add unit rate per time'}*/

            }
        });
        if (form_update.valid()) {
            $.ajaxFileUpload({
                url: "<?php echo site_url('vehiclecapacities/vehiclecapacities/updateCapacity'); ?>",
                type: 'post',
                secureuri: false,
                fileElementId: 'capacity_image_edit',
                dataType: 'json',
                data: {
                    capacity: $("#capacity_edit").val(),
                    capacity_id: id,
                    old_image: image,
                    basetype: $("#basetype_edit option:selected").val()
                  /*  basefare: $("#basefare_edit").val(),
                    kmunit: $("#kmunit_edit").val(),
                    timeunit: $("#timeunit_edit").val(),
                    min_hrs: $("#min_hrs_edit").val()*/
                },
                success: function (msg) {
                    location.reload();
                }
            });
        }
    }
    function activateCapacity(capacity_id, status) {
        if (status == 1 || status == '1') {
            var r = confirm("Are you sure want to activate this?");
        } else {
            var r = confirm("Are you sure want to deactivate this?");
        }
        if (r == true) {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('vehiclecapacities/vehiclecapacities/updateStatus'); ?>",
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
    $('#min_hr_chk').click(function () {
        $("#div_min_hr").toggle(this.checked);
    });
</script>
</body><!-- END BODY -->
</html>
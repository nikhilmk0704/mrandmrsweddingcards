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
                            <h4 class="modal-title">Create New Base Type</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" role="form" id="default">
                                <div class="form-body">


                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Base Type</label>

                                        <div class="col-md-9">
                                            <input type="text" id="basetype" name="basetype"
                                                   class="form-control input-medium" placeholder="">
                                        </div>
                                    </div>
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
													<input type="file" name="vehicle_basetype_image"
                                                           id="vehicle_basetype_image">
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
                        <div class="modal-footer">
                            <button type="button" class="btn blue" onClick="saveBasetype();">Save changes</button>
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
                    <h1>Fleet Management</h1>
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
                                <i class="fa fa-globe"></i>Create New base Type
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
                                                <a href="#portlet-config" data-toggle="modal" class="btn green config">
                                                    Add New <i class="fa fa-plus"></i>
                                                </a>
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
                                        Icon
                                    </th>
                                    <th>
                                        Base Type
                                    </th>
                                    <th>
                                        Total Vehicles
                                    </th>

                                    <th>
                                        Actions
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1;
                                if ($baseTypeList != 0) { ?>
                                    <?php foreach ($baseTypeList as $baseTypeList) { ?>
                                        <tr>
                                            <td> <?php echo $i; ?> </td>
                                            <td><img
                                                    src="<?php echo base_url() . "uploads/vehicle_basetype_image/" . $baseTypeList['photo']; ?>"
                                                    height="50" width="50"/></td>
                                            <td> <?php echo $baseTypeList['basetype']; ?> </td>
                                            <td><?php echo $baseTypeList['countVehicle']; ?></td>
                                            <td>
                                                <?php if ($checking['edit'] == 1 || $checking['edit'] == '1') { ?>
                                                    <button class="btn btn-primary btn-xs" title="Edit"
                                                            data-toggle="modal"
                                                            onClick="editBasetype(<?php echo $baseTypeList['base_type_id']; ?>)">
                                                        <i class="fa fa-pencil"></i></button>
                                                <?php } ?>
                                                <?php if ($checking['delete'] == 1 || $checking['delete'] == '1') { ?>
                                                    <?php if ($baseTypeList['isdeleted'] == '1' || $baseTypeList['isdeleted'] == 1) { ?>
                                                        <button class="btn btn-danger btn-xs" title="Disable"
                                                                onClick="deleteBasetype(<?php echo $baseTypeList['base_type_id']; ?>,0);">
                                                            <i class="fa fa-ban"></i></button>
                                                    <?php } else { ?>
                                                        <button class="btn btn-success btn-xs" title="Enable"
                                                                onClick="deleteBasetype(<?php echo $baseTypeList['base_type_id']; ?>,1);">
                                                            <i class="fa fa-check"></i></button>
                                                    <?php } ?>
                                                <?php } ?>
                                        </tr>
                                        <?php $i = $i + 1;
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
    <?php $this->load->view('footer'); ?>
    <script>
        jQuery.validator.setDefaults({debug: true});
        var form = $("#default");

        form.validate({
            errorElement: "label",
            errorClass: "font-red-haze",
            rules: {
                'basetype': {required: true}
            },
            messages: {
                'basetype': {required: 'Please enter basetype!<br>'}

            }
        });
        function saveBasetype() {
            if (form.valid()) {

                $.ajaxFileUpload({
                    url: "<?php echo site_url('vehiclebasetypes/vehiclebasetypes/add'); ?>",
                    type: 'post',
                    secureuri: false,
                    fileElementId: 'vehicle_basetype_image',
                    dataType: 'json',
                    data: {
                        basetype: $("#basetype").val()
                    },

                    success: function (data) {
                        location.reload();
                    }
                });
            }
        }

        function editBasetype(id) {
            string_array = "basetype_id=" + id;

            $.ajax({
                type: "POST",
                url: "<?php echo site_url('vehiclebasetypes/vehiclebasetypes/edit_view');  ?>",
                data: string_array,
                success: function (msg) {

                    $("#editview").html(msg);
                    $('#edit_popup').trigger("click");

                }
            });
        }
        function updateBasetype(id, photo) {
            var form_update = $("#default1");
            form_update.validate({
                errorElement: "label",
                errorClass: "font-red-haze",
                rules: {
                    'basetype_update': {required: true}
                },
                messages: {
                    'basetype_update': {required: 'Please enter basetype!<br>'}

                }
            });
            if (form_update.valid()) {

                $.ajaxFileUpload({
                    url: "<?php echo site_url('vehiclebasetypes/vehiclebasetypes/updateBasetype'); ?>",
                    type: 'post',
                    secureuri: false,
                    fileElementId: 'basetype_image_edit',
                    dataType: 'json',
                    data: {
                        basetype: $("#basetype_update").val(),
                        basetype_id: id,
                        old_image: photo
                    },

                    success: function (data) {
                        location.reload();
                    }
                });
            }
        }
        function deleteBasetype(basetypeId, status) {
            if (status == 1 || status == '1') {
                var r = confirm("Are you sure want to activate this?");
            } else {
                var r = confirm("Are you sure want to deactivate this?");
            }
            if (r == true) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('vehiclebasetypes/vehiclebasetypes/delete'); ?>",
                    data: {
                        basetypeId: basetypeId,
                        status: status
                    },
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
    </script>
    </body>
    <!-- END BODY -->
    </html>
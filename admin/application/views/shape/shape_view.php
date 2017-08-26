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
                            <h4 class="modal-title">Add Color</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" role="form" id="default">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Shape Name</label>

                                        <div class="col-md-9">
                                            <input type="text" name="name" id="name"
                                                   class="form-control input-inline input-medium" placeholder=""
                                                   required>
                                            <span id="errorMsg" class="font-red-haze"></span>       
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn blue" onClick="saveShape();">Save changes</button>
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
                    <h1>Shape Management</h1>
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
                                <i class="fa fa-globe"></i>Shape List
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
                                        Shape Name
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
                                if ($shapeList != 0) { ?>
                                    <?php foreach ($shapeList as $shapeList) { ?>
                                        <tr>
                                            <td> <?php echo $i; ?> </td>
                                            <td><?php if ($shapeList['enabled'] == 0 || $shapeList['enabled'] == '0') { ?>
                                                    <span class="label label-sm label-warning">Inactive</span>
                                                <?php } else { ?>
                                                    <span class="label label-sm label-info">Active</span>
                                                <?php } ?>
                                            </td>
                                            <td> <?php echo ucfirst($shapeList['shapeName']); ?> </td>
                                            <td> <?php echo $shapeList['createdAt']; ?> </td>
                                            <td> <?php echo $shapeList['updatedAt']; ?> </td>
                                            <td>
                                               
                                                <button onClick="editShape(<?php echo $shapeList['id']; ?>)"
                                                        class="btn btn-primary btn-xs" title="Edit"><i
                                                        class="fa fa-pencil"></i>
                                                </button>
                                                
                                        
                                                <?php if ($shapeList['enabled'] == 0 || $shapeList['enabled'] == '0') { ?>
                                                    <button class="btn btn-info btn-xs" title="Activate"
                                                            onclick="active(<?php echo $shapeList['id']; ?>)"><i
                                                                class="fa fa-check"></i></button>
                                                <?php } else { ?>
                                                    <button class="btn btn-danger btn-xs" title="Deactivate"
                                                            onclick="active(<?php echo $shapeList['id']; ?>)"><i
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
            'name': {required: true}
        },
        messages: {
            'name': {required: 'Please select shape name.'}
        }
    });
    function saveShape() {
        if (form.valid()) {
            $.ajax({
                url: "<?php echo site_url('add_shape');?>",
                type: 'post',
                dataType: 'json',
                data: {
                    name: $('#name').val()
                },

                success: function (data) {
                    if (data == 1) {
                        location.reload();
                    } else if (data == 2) {
                        $("#errorMsg").html('Shape already exists');
                    }
                }
            });
        }
    }

    function editShape(id) {
        string_array = "shape_id=" + id;

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('edit_shape');  ?>",
            data: string_array,
            success: function (msg) {
                $("#editview").html(msg);
                $('#edit_popup').trigger("click");
                ComponentsPickers.init();
            }
        });
    }
    function updateShape(id) {
        var form_update = $("#default1");
        form_update.validate({
            errorElement: "label",
            errorClass: "font-red-haze",
            rules: {
                'name_edit': {required: true}
            },
            messages: {
                'name_edit': {required: 'Please select shape name'}
            }
        });
        if (form_update.valid()) {
            $.ajax({
                url: "<?php echo site_url('update_shape');?>",
                type: 'post',
                dataType: 'json',
                data: {
                    id: id,
                    name: $('#name_edit').val()
                },
                success: function (data) {
                    if (data == 1) {
                        location.reload();
                    }
                }
            });
        }
    }
    function active(shape_id) {
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('activate_shape'); ?>",
            data: {shape_id: shape_id},
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
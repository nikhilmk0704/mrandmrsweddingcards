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
                                        <label class="col-md-3 control-label">Color Name</label>

                                        <div class="col-md-9">
                                            <input type="text" name="name" id="name"
                                                   class="form-control input-inline input-medium" placeholder=""
                                                   required>
                                            <span id="errorMsg" class="font-red-haze"></span>       
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Select Color</label>

                                        <div class="col-md-9">
                                            <input type="color" name="color" id="color"
                                                   class="form-control input-inline input-medium" placeholder=""
                                                   required>
                                            <span id="errorMsg" class="font-red-haze"></span>       
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn blue" onClick="saveColor();">Save changes</button>
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
                    <h1>Color Management</h1>
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
                                <i class="fa fa-globe"></i>Color List
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
                                        Color Code
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
                                if ($colorList != 0) { ?>
                                    <?php foreach ($colorList as $colorList) { ?>
                                        <tr>
                                            <td> <?php echo $i; ?> </td>
                                            <td><?php if ($colorList['enabled'] == 0 || $colorList['enabled'] == '0') { ?>
                                                    <span class="label label-sm label-warning">Inactive</span>
                                                <?php } else { ?>
                                                    <span class="label label-sm label-info">Active</span>
                                                <?php } ?>
                                            </td>
                                            <td> <?php echo ucfirst($colorList['colorName']); ?> 
                                                <span style="background:<?php echo $colorList['colorCode']; ?>;
                                                    width:30px;height:20px;display:inline-block;vertical-align:middle;"></span>
                                            </td>
                                            <td> <?php echo $colorList['colorCode']; ?></td>
                                            <td> <?php echo $colorList['createdAt']; ?> </td>
                                            <td> <?php echo $colorList['updatedAt']; ?> </td>
                                            <td>
                                               
                                                <button onClick="editColor(<?php echo $colorList['id']; ?>)"
                                                        class="btn btn-primary btn-xs" title="Edit"><i
                                                        class="fa fa-pencil"></i>
                                                </button>
                                                
                                        
                                                <?php if ($colorList['enabled'] == 0 || $colorList['enabled'] == '0') { ?>
                                                    <button class="btn btn-info btn-xs" title="Activate"
                                                            onclick="active(<?php echo $colorList['id']; ?>)"><i
                                                                class="fa fa-check"></i></button>
                                                <?php } else { ?>
                                                    <button class="btn btn-danger btn-xs" title="Deactivate"
                                                            onclick="active(<?php echo $colorList['id']; ?>)"><i
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
            'color': {required: true}
        },
        messages: {
            'name': {required: 'Please select color name.'},
            'color': {required:'Please select color'}
        }
    });
    function saveColor() {
        if (form.valid()) {
            $.ajax({
                url: "<?php echo site_url('add_color');?>",
                type: 'post',
                dataType: 'json',
                data: {
                    name: $('#name').val(),
                    color: $('#color').val()
                },

                success: function (data) {
                    if (data == 1) {
                        location.reload();
                    } else if (data == 2) {
                        $("#errorMsg").html('Color already exists');
                    }
                }
            });
        }
    }

    function editColor(id) {
        string_array = "color_id=" + id;

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('edit_color');  ?>",
            data: string_array,
            success: function (msg) {
                $("#editview").html(msg);
                $('#edit_popup').trigger("click");
                ComponentsPickers.init();
            }
        });
    }
    function updateColor(id) {
        var form_update = $("#default1");
        form_update.validate({
            errorElement: "label",
            errorClass: "font-red-haze",
            rules: {
                'name_edit': {required: true},
                'color_edit': {required: true}
            },
            messages: {
                'name_edit': {required: 'Please select color name'},
                'color_edit': {required: 'Please select color code'}
            }
        });
        if (form_update.valid()) {
            $.ajax({
                url: "<?php echo site_url('update_color');?>",
                type: 'post',
                dataType: 'json',
                data: {
                    id: id,
                    name: $('#name_edit').val(),
                    color: $('#color_edit').val()
                },
                success: function (data) {
                    if (data == 1) {
                        location.reload();
                    }
                }
            });
        }
    }
    function active(color_id) {
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('activate_color'); ?>",
            data: {color_id: color_id},
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
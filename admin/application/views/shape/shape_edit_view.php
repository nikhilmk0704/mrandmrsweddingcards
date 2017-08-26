<a href="#driverEdit" data-toggle="modal" class="config" id="edit_popup"></a>
<div class="modal fade" id="driverEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Edit Color</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" id="default1">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Shape Name</label>

                            <div class="col-md-9">
                                <input type="text" name="name_edit" id="name_edit"
                                       class="form-control input-inline input-medium" placeholder=""
                                       value="<?php echo ucfirst($shape['shapeName']); ?>" required>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer ">
                <button type="button" class="btn blue"
                        onclick="updateShape(<?php echo $shape['id']; ?>);">
                    Save changes
                </button>
                <button type="button" class="btn default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
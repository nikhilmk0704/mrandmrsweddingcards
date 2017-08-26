<a href="#vehicleEdit" data-toggle="modal" class="config" id="edit_popup"></a>
<div class="modal fade" id="vehicleEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Edit Customer</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" id="default1">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">First Name</label>

                            <div class="col-md-9">
                                <input type="text" name="first_name_edit" id="first_name_edit"
                                       value="<?php echo $customers['firstname']; ?>"
                                       class="form-control input-inline input-medium" placeholder="" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Last Name</label>

                            <div class="col-md-9">
                                <input type="text" class="form-control input-inline input-medium" placeholder=""
                                       name="last_name_edit" id="last_name_edit"
                                       value="<?php echo $customers['lastname']; ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Phone Number</label>

                            <div class="col-md-9">
                                <input type="text" class="form-control input-inline input-medium" placeholder=""
                                       name="phone_edit" id="phone_edit" value="<?php echo $customers['phone']; ?>"
                                       required>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer ">
                <button type="button" class="btn blue" onclick="updateCustomer(<?php echo $customers['user_id']; ?>);">
                    Save changes
                </button>
                <button type="button" class="btn default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
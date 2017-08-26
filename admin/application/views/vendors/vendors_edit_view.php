<a href="#driverEdit" data-toggle="modal" class="config" id="edit_popup"></a>
<div class="modal fade" id="driverEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Edit Vendor</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" id="default1">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Vendor Name</label>

                            <div class="col-md-9">
                                <input type="text" name="name_edit" id="name_edit"
                                       class="form-control input-inline input-medium" placeholder=""
                                       value="<?php echo $vendors['name']; ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Email</label>

                            <div class="col-md-9">
                                <input type="text" class="form-control input-inline input-medium" placeholder=""
                                       name="email_edit" id="email_edit" value="<?php echo $vendors['emailId']; ?>"
                                       required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Phone</label>

                            <div class="col-md-9">
                                <input type="text" class="form-control input-inline input-medium" placeholder=""
                                       name="phone_edit" id="phone_edit" value="<?php echo $vendors['phoneNumber']; ?>"
                                       required>
                            </div>
                        </div>
                       <!--  <div class="form-group">
                            <label class="col-md-3 control-label">Address Line 1</label>

                            <div class="col-md-9">
                                <input type="text" class="form-control input-inline input-medium" placeholder=""
                                       name="addr1_edit" id="addr1_edit" value="<?php echo $vendors['address1']; ?>"
                                       required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Address Line 2</label>

                            <div class="col-md-9">
                                <input type="text" class="form-control input-inline input-medium" placeholder=""
                                       name="addr2_edit" id="addr2_edit" value="<?php echo $vendors['address2']; ?>"
                                       required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">City</label>

                            <div class="col-md-9">
                                <input type="text" class="form-control input-inline input-medium" placeholder=""
                                       name="city_edit" id="city_edit" value="<?php echo $vendors['city']; ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Country</label>

                            <div class="col-md-9">
                                <input type="text" class="form-control input-inline input-medium" placeholder=""
                                       name="country_edit" id="country_edit" value="<?php echo $vendors['country']; ?>"
                                       required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Pin</label>

                            <div class="col-md-9">
                                <input type="text" class="form-control input-inline input-medium" placeholder=""
                                       name="pin_edit" id="pin_edit" value="<?php echo $vendors['pin']; ?>" required>
                            </div>
                        </div> -->
                    </div>
                </form>
            </div>
            <div class="modal-footer ">
                <button type="button" class="btn blue"
                        onclick="updateVendor(<?php echo $vendors['id']; ?>);">
                    Save changes
                </button>
                <button type="button" class="btn default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
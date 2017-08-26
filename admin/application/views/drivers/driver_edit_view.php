<a href="#driverEdit" data-toggle="modal" class="config" id="edit_popup"></a>
<div class="modal fade" id="driverEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
              <h4 class="modal-title">Edit Driver</h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" role="form" id="default1" >
                <div class="form-body">
                    <?php if ($this->session->userdata('role') == '1' || $this->session->userdata('role') == 1) { ?>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Vendor</label>

                            <div class="col-md-9">
                                <select id="vendor_edit" name="vendor_edit"
                                        class="form-control input-inline input-medium">
                                    <option value="0">Select</option>

                                    <?php if ($vendorList != 0) { ?>
                                        <?php foreach ($vendorList as $vendorList) { ?>
                                            <?php if ($vendorList['status'] == '1' || $vendorList['status'] == 1) { ?>
                                                <option
                                                    value="<?php echo $vendorList['user_id']; ?>" <?php if ($vendorList['user_id'] == $drivers['created_user_id']) { ?> selected="selected" <?php } ?>><?php echo $vendorList['firstname'] . " " . $vendorList['lastname']; ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    <?php } ?>
                  <div class="form-group">
                    <label class="col-md-3 control-label">First Name</label>
                    <div class="col-md-9">
                      <input type="text" name="firstname_edit" id="firstname_edit"  class="form-control input-inline input-medium" placeholder="" value="<?php echo $drivers['firstname']; ?>" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Last Name</label>
                    <div class="col-md-9">
                      <input type="text" class="form-control input-inline input-medium" placeholder="" name="lastname_edit" id="lastname_edit" value="<?php echo $drivers['lastname']; ?>" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Email</label>
                    <div class="col-md-9">
                      <input type="text" class="form-control input-inline input-medium" placeholder="" name="email_edit" id="email_edit" value="<?php echo $drivers['useremail']; ?>" required readonly="readonly">
                    </div>
                  </div>
                 <!--<div class="form-group">
                     <label class="col-md-3 control-label">Rating</label>
                    <div class="col-md-9">
                      <input type="text" class="form-control input-inline input-medium" value="<?php /*echo $drivers['rating']; */?>" name="rating" id="rating" >
                  </div>
                  </div>-->
                  <div class="form-group">
                    <label class="col-md-3 control-label">Phone</label>
                    <div class="col-md-9">
                      <input type="text" class="form-control input-inline input-medium" placeholder="" name="phone_edit" id="phone_edit" value="<?php echo $drivers['phone']; ?>" required>
                    </div>
                  </div>
                   <div class="form-group">
                    <label class="col-md-3 control-label"></label>
                    <div class="col-md-9">
                     <img src="<?php echo base_url()."uploads/drivers/". $drivers['pictures']; ?>" width="50" height="50" />
                    </div>
                  </div>
                  <div class="form-group">
                  
                     <label class="col-md-3 control-label">Photo</label>
                                        <div class="col-md-9">
											<div class="fileinput fileinput-new" data-provides="fileinput">
												<div class="input-group input-large">
													<div class="form-control uneditable-input span3" data-trigger="fileinput">
														<i class="fa fa-file fileinput-exists"></i>&nbsp; <span class="fileinput-filename">
														</span>
													</div>
													<span class="input-group-addon btn default btn-file">
													<span class="fileinput-new">
													Select file </span>
													<span class="fileinput-exists">
													Change </span>
													<input type="file" name="driver_image_edit" id="driver_image_edit">
													</span>
													<a href="#" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput">
													Remove </a>
												</div>
											</div>
										</div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Date of Birth</label>
                    <div class="col-md-9">
                               <input class="form-control input-medium input-inline date-picker" type="text" value="<?php echo $drivers['dob']; ?>" name="dob_edit" id="dob_edit">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">License No</label>
                    <div class="col-md-9">
                      <input type="text" class="form-control input-inline input-medium" placeholder=""  name="lno_edit" id="lno_edit" value="<?php echo $drivers['licenseNo']; ?>"  required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Address Line 1</label>
                    <div class="col-md-9">
                      <input type="text" class="form-control input-inline input-medium" placeholder="" name="addr1_edit" id="addr1_edit" value="<?php echo $drivers['address1']; ?>" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Address Line 2</label>
                    <div class="col-md-9">
                      <input type="text" class="form-control input-inline input-medium" placeholder="" name="addr2_edit" id="addr2_edit" value="<?php echo $drivers['address']; ?>" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">City</label>
                    <div class="col-md-9">
                      <input type="text" class="form-control input-inline input-medium" placeholder="" name="city_edit" id="city_edit" value="<?php echo $drivers['city']; ?>" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Country</label>
                    <div class="col-md-9">
                      <input type="text" class="form-control input-inline input-medium" placeholder="" name="country_edit" id="country_edit" value="<?php echo $drivers['country']; ?>" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Pin</label>
                    <div class="col-md-9">
                      <input type="text" class="form-control input-inline input-medium" placeholder="" name="pin_edit" id="pin_edit" value="<?php echo $drivers['pin']; ?>" required>
                    </div>
                  </div>
                  </div>
              </form>
            </div>
            <div class="modal-footer ">
              <button type="button" class="btn blue" onclick="updateDriver(<?php echo $drivers['id_drivers_profile']; ?>,'<?php echo $drivers['pictures'];?>');">Save changes</button>
              <button type="button" class="btn default" data-dismiss="modal">Close</button>
            </div>
          </div>
          <!-- /.modal-content --> 
        </div>
        <!-- /.modal-dialog --> 
      </div>
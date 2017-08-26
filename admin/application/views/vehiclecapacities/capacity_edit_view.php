<a href="#capacityEdit" data-toggle="modal" class="config" id="edit_popup"></a>
<div class="modal fade" id="capacityEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
              <h4 class="modal-title">Edit Capacity</h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" role="form" id="default1">
                <div class="form-body">
                  
                  <div class="form-group">
                    <label class="col-md-3 control-label">Base Type</label>
                    <div class="col-md-9">
                      <select id="basetype_edit" name="basetype_edit" class="form-control input-medium">
												<option value="0">Select</option>
												<?php if(count($baseTypeList)>0){ ?>
                                                	<?php foreach($baseTypeList as $baseTypeList){ ?>
                                                    <?php if($baseTypeList['isdeleted']=='1'||$baseTypeList['isdeleted']==1){ ?>
                                                    	<option value="<?php echo $baseTypeList['base_type_id']; ?>" <?php if($baseTypeList['base_type_id']==$capacity['basetype']) {?> selected="selected" <?php } ?>><?php echo $baseTypeList['basetype']; ?></option>
                                                     <?php } ?>
                                                    <?php } ?>
                                                <?php } ?>
											</select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Capacity</label>
                    <div class="col-md-9">
                      <input type="text" id="capacity_edit" name="capacity_edit" value="<?php echo $capacity['capacity']; ?>" class="form-control input-medium" placeholder="">
                    </div>
                  </div>
                 <!-- <div class="form-group">
                    <label class="col-md-3 control-label">Base Fare</label>
                    <div class="col-md-9">
                      <input type="text" value="<?php /*echo $capacity['basefare']; */?>" id="basefare_edit" name="basefare_edit" class="form-control input-medium" placeholder="">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Minimum Hrs</label>
                    <div class="col-md-9">
                      <input type="text" id="min_hrs_edit" name="min_hrs_edit" class="form-control input-medium" value="<?php /*echo $capacity['min_hrs']; */?>" placeholder="">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Km Unit</label>
                    <div class="col-md-9">
                      <input type="text" id="kmunit_edit" value="<?php /*echo $capacity['km_multiplier']; */?>" name="kmunit_edit" class="form-control input-medium" placeholder="">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Time Unit</label>
                    <div class="col-md-9">
                      <input type="text" id="timeunit_edit" value="<?php /*echo $capacity['time_multiplier']; */?>" name="timeunit_edit" class="form-control input-medium" placeholder="">
                    </div>
                  </div>-->
                  <div class="form-group">
                   <label class="col-md-3 control-label"></label>
                   <div class="col-md-9">
                   	<img src="<?php echo base_url()."uploads/vehicle_capacity_image/".$capacity['photo']; ?>" width="50" height="50" />
                    </div>
                    </div>
                  <div class="form-group">
                     <label class="col-md-3 control-label">Icon</label>
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
													<input type="file" name="capacity_image_edit" id="capacity_image_edit">
													</span>
													<a href="#" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput">
													Remove </a>
												</div>
											</div>
										</div>
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer ">
              <button type="button" class="btn blue" onclick="updateCapacity(<?php echo $capacity['capacity_id']; ?>,'<?php echo $capacity['photo']; ?>');">Save changes</button>
              <button type="button" class="btn default" data-dismiss="modal">Close</button>
            </div>
          </div>
          <!-- /.modal-content --> 
        </div>
        <!-- /.modal-dialog --> 
      </div>
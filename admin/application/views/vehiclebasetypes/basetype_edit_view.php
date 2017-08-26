<a href="#basetypeEdit" data-toggle="modal" class="config" id="edit_popup"></a>
<div class="modal fade" id="basetypeEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Edit Base Type</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" id="default1">
                    <div class="form-body">


                        <div class="form-group">
                            <label class="col-md-3 control-label">Base Type</label>

                            <div class="col-md-9">
                                <input type="text" id="basetype_update" name="basetype_update"
                                       value="<?php echo $basetype['basetype']; ?>" class="form-control input-medium"
                                       placeholder="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>

                            <div class="col-md-9">
                                <img
                                    src="<?php echo base_url() . "uploads/vehicle_basetype_image/" . $basetype['photo']; ?>"
                                    width="50" height="50"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Icon</label>

                            <div class="col-md-9">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="input-group input-large">
                                        <div class="form-control uneditable-input span3" data-trigger="fileinput">
                                            <i class="fa fa-file fileinput-exists"></i>&nbsp; <span
                                                class="fileinput-filename">
														</span>
                                        </div>
													<span class="input-group-addon btn default btn-file">
													<span class="fileinput-new">
													Select file </span>
													<span class="fileinput-exists">
													Change </span>
													<input type="file" name="basetype_image_edit"
                                                           id="basetype_image_edit">
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
                <button type="button" class="btn blue"
                        onclick="updateBasetype(<?php echo $basetype['base_type_id']; ?>,'<?php echo $basetype['photo']; ?>');">
                    Save changes
                </button>
                <button type="button" class="btn default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
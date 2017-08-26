<?php $this->load->view('header'); ?>
<!-- BEGIN CONTAINER -->

<div class="page-container"> 
  <!-- BEGIN SIDEBAR -->
  <?php $this->load->view('menu');?>
  <style>
  .pac-container{
  z-index:99999;
  }
  </style>
  <!-- END SIDEBAR --> 
  <!-- BEGIN CONTENT -->
  <div class="page-content-wrapper">
    <div class="page-content"> 
      <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
      <div id="editview"> </div>
      <div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
              <h4 class="modal-title">Create Hire Trip Location</h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" role="form" id="default">
                <div class="form-body">
                  <div class="form-group">
                    <label class="col-md-3 control-label">From</label>
                    <div class="col-md-9">
                     <input type="text" class="form-control input-medium" name="from" id="from" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">To</label>
                    <div class="col-md-9">
                      <input type="text" id="to" name="to" class="form-control input-medium">
                    </div>
                  </div>
                   <div class="map_canvas" id="map_canvas"></div>
                   <div class="map_canvas1" id="map_canvas1"></div>    
                        <input type="hidden" id="lat1"  name="lat1" value="">
                        <input type="hidden" id="lng1" name="lng1"  value="" >
                        <input type="hidden" id="lat2"  name="lat2" value="">
                        <input type="hidden" id="lng2" name="lng2"  value="" >
                                    
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn blue" onClick="saveForHire();">Save changes</button>
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
          <h1>For Hire Trip Management</h1>
        </div>
        <!-- END PAGE TITLE --> 
      </div>
      <!-- END PAGE HEAD --> 

      <!-- END PAGE HEADER--> 
      <!-- BEGIN PAGE CONTENT-->
      <div class="row">
        <div class="col-md-12"> 
          <!-- BEGIN EXAMPLE TABLE PORTLET-->
          <div class="portlet box grey-cascade">
            <div class="portlet-title">
              <div class="caption"> <i class="fa fa-globe"></i> For Hire Trip Location List </div>
              <div class="tools"> <a href="javascript:" class="collapse"> </a> <a href="#portlet-config" data-toggle="modal" class="config"> </a> <a href="javascript:" class="reload"> </a> <a href="javascript:" class="remove"> </a> </div>
            </div>
            <div class="portlet-body">
              <div class="table-toolbar">
                <div class="row">
                  <div class="col-md-6">
                    <div class="btn-group">
                      <?php if($checking['add']==1||$checking['add']=='1'){ ?>
                     <a href="#portlet-config" data-toggle="modal" class="btn green">Add New <i class="fa fa-plus"></i> </a>
                     <?php } ?>
                    </div>
                  </div>
                </div>
              </div>
              <table class="table table-striped table-bordered table-hover" id="sample_1">
                <thead>
                  <tr>
                    <th> No. </th>
                    <th> From </th>
                    <th> To </th>
                    <th> Actions </th>
                  </tr>
                </thead>
               <tbody>
                  <?php $i=1; if($forHireLocation != 0){ ?>
                  	<?php foreach($forHireLocation as $forHireList){ ?>
                    <tr>
                      <td> <?php echo $i; ?> </td>
                      <td> <?php echo $forHireList['from']; ?> </td>
                      <td> <?php echo $forHireList['to']; ?> </td>
                      <td>
                      <?php if($checking['delete']==1||$checking['delete']=='1'){ ?>
                       <button class="btn btn-danger btn-xs" title="Delete" onClick="deleteHireTrip(<?php echo $forHireList['id']; ?>);"><i class="fa fa-trash"></i></button>
                       <?php } ?>
                      </td>    
                    </tr>
                    <?php $i = $i+1; } ?>
                   <?php }else{ ?>
                   <tr>
                   <td></td>
                      <td> No Data </td>
                       <td></td>
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
<script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
<script src="<?php echo base_url(); ?>assets/admin/geocomplete/jquery.geocomplete.js?09865678987"></script>
<script src="<?php echo base_url(); ?>assets/admin/geocomplete/jquery.geocomplete1.js?09865678987"></script>
<script src="<?php echo base_url(); ?>assets/admin/geocomplete/logger.js"></script>
<script>
  jQuery.validator.setDefaults({debug:true});
  
  var form = $( "#default" );
 
form.validate({
			errorElement: "label",
			errorClass:"font-red-haze",
        rules: {
                
				'from':{required:true},
				'to':{required:true},
			
                },
        messages: {
              
			  'from':{required:'Please add from location'},
			  'to':{required:'Please add to location'},
			 
                  }                                           
        });
									function saveForHire() {
                                                if(form.valid()){ 
                                                    $.ajax({
														url: "<?php echo site_url('hire/for_hire_location/add'); ?>",
														type: 'post',
														data: {
															
															from:$("#from").val(),
															to:$("#to").val(),
															from_lat:$("#lat1").val(),
															from_long:$("#lng1").val(),
															to_lat:$("#lat2").val(),
															to_long:$("#lng2").val()
														},
                                                        success: function(msg) {
															location.reload();
                                                        }
                                                    });
											}
                                            }
											
			
			function deleteHireTrip(hireId){
				var r = confirm("Are you sure want to delete this?");
				if (r == true) {
	    		$.ajax({
                        type: "POST",
                        url: "<?php echo site_url('hire/for_hire_location/delete'); ?>",
                        data:{hireId : hireId},
                        success: function(msg) {
            				if(msg==1){
								location.reload();
							}
                        }
                });
				}else{
					return false;
				}
   			}

$(function () { 
 $("#from")
  .geocomplete()
  .bind("geocode:result", function (event, result) {      
   $("#lat1").val(result.geometry.location.lat());
   $("#lng1").val(result.geometry.location.lng());
   
 });
});

$(function () { 
 $("#to")
  .geocomplete1()
  .bind("geocode:result", function (event, result) {      
   $("#lat2").val(result.geometry.location.lat());
   $("#lng2").val(result.geometry.location.lng());
   
 });
});				
<!---->		
</script>
</body><!-- END BODY -->
</html>
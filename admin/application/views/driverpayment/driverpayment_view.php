<?php $this->load->view('header'); ?>
<div class="page-container"> 
  <!-- BEGIN SIDEBAR -->
   <?php $this->load->view('menu');?>
  <!-- END SIDEBAR --> 
   <div id="editview"> </div>
  <!-- BEGIN CONTENT -->
  <div class="page-content-wrapper">
    <div class="page-content"> 
      <!-- BEGIN PAGE HEADER--> 
      <!-- BEGIN PAGE HEAD -->
      <div class="page-head"> 
        <!-- BEGIN PAGE TITLE -->
        <div class="page-title">
          <h1>Driver Payment</h1>
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
              <div class="caption"> <i class="fa fa-globe"></i>Payment List </div>
              <div class="tools"> </div>
            </div>
            <div class="portlet-body">
              <div class="table-toolbar">
                <div class="row">
                  <div class="col-md-6">
                    <div class="btn-group">
                    </div>
                  </div>
                </div>
              </div>
              <table class="table table-striped table-bordered table-hover" id="sample_1">
                <thead>
                  <tr>
                        <th> No. </th>
                        <th>Name</th>
                        <th>Over Time</th>
                        <th> Kilometers </th>
                        <th> Total Amount </th>
                        <th> Actions </th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i=1; if($paymentList!=0){ ?>
                  <?php foreach($paymentList as $paymentList){ ?>
                    <tr>
                      <td> <?php echo $i; ?> </td>
                      <td><?php echo $paymentList['firstname']." ".$paymentList['lastname']; ?></td>
                      <td><?php echo number_format($paymentList['triptime'],2); ?></td>
                      <td> <?php echo number_format(($paymentList['kmran']/1000),2)." Km"; ?> </td>
                      <td> <?php echo "$".number_format($paymentList['totalamnt']/100,2); ?> </td>
                      <td> </td>
                    </tr>
                    <?php $i+=1; } ?>
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

<?php $this->load->view('footer');?>

<script>

	function active(customerId){
	    		$.ajax({
                        type: "POST",
                        url: "<?php echo site_url('customer/customers/active'); ?>",
                        data:{customerId : customerId},
                        success: function(msg) {
            				if(msg==1){
								location.reload();
							}
                        }
                });
   }
    function editCustomer(id)
    	{
		string_array="customer_id="+id;
		$.ajax({
               type: "POST",
               url: "<?php echo site_url('customer/customers/edit_view');  ?>",
               data: string_array,
               success:function (msg){
               $("#editview").html(msg);
               $('#edit_popup').trigger("click");
                }
               });
        }
		function updateCustomer(id) {
												 var form_update = $( "#default1" );	
													form_update.validate({
													errorElement: "label",
													errorClass:"font-red-haze",
        											rules: {
                'first_name_edit':{required: true},
				'last_name_edit':{required:true},
				'phone_edit':{required:true,number:true}
                },
        messages: {
                'first_name_edit':{required:'Please enter firstname.'},
				'last_name_edit':{required:'Please enter lastname.'},
				'phone_edit':{required:'Please enter phone no.'}
                  }               
        											});		
                                                if(form_update.valid()){ 
                                                   $.ajax({
												url: "<?php echo site_url('customer/customers/updateCustomer');?>",
												type: 'post',
												secureuri: false,
												dataType: 'json',
												data: {
													id:id,
													firstname: $('#first_name_edit').val(),
													lastname: $('#last_name_edit').val(),
													phone_edit: $('#phone_edit').val()
												},
												
												success: function(data)
												{
													if(data==1){
													location.reload();
													}
												}
											});
											}
                                            }
</script>
</body>
<!-- END BODY -->
</html>
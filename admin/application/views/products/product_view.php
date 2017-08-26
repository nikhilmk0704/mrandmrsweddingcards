<?php $this->load->view('header'); ?>
<!-- BEGIN CONTAINER -->
<div class="page-container">
    <?php $this->load->view('menu'); ?>
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <div class="page-content">
            <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
            <div class="modal fade" tabindex="-1" id="add" role="dialog" aria-labelledby="myModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-custom">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">Add Product</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" role="form" id="default">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-6"> 
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Product Name</label>

                                                    <div class="col-md-9">
                                                        <input type="text" name="name" id="name"
                                                               class="form-control input-inline input-medium" placeholder=""
                                                               required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Price</label>

                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control input-inline input-medium"
                                                               placeholder="" name="price" id="price" required>
                                                        
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Discount %</label>

                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control input-inline input-medium"
                                                               placeholder="" name="discount" id="discount" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Status</label>
                                                    <div class="col-md-9">
                                                        <select id="status" name="status"
                                                                class="form-control input-inline input-medium select2me">
                                                            <option value="">Select</option>    
                                                            <option value="1">New</option>
                                                            <option value="2">Sale</option>
                                                            <option value="0">Out of Stock</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Product Shape</label>
                                                    <div class="col-md-9">
                                                        <select id="productShape" name="productShape"
                                                                class="form-control input-inline input-medium select2me">
                                                            <option value="0">Select</option>    
                                                            <?php if ($shapeLists != 0) { ?>
                                                                <?php foreach ($shapeLists as $shapeList) { ?>
                                                                    <?php if ($shapeList['enabled'] == '1' || $shapeList['enabled'] == 1) { ?>
                                                                        <option
                                                                            value="<?php echo $shapeList['id']; ?>"><?php echo ucfirst($shapeList['shapeName']);?></option>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Product Color</label>
                                                    <div class="col-md-9">
                                                        <select id="productColor" name="productColor"
                                                                class="form-control input-inline input-medium select2me">
                                                            <option value="0">Select</option>    
                                                            <?php if ($colorLists != 0) { ?>
                                                                <?php foreach ($colorLists as $colorList) { ?>
                                                                    <?php if ($colorList['enabled'] == '1' || $colorLists['enabled'] == 1) { ?>
                                                                        <option
                                                                            value="<?php echo $colorList['id']; ?>"><i class="fa fa-circle" style="color : <?php echo $colorList['colorCode']?>"></i> <?php echo ucfirst($colorList['colorName']);?></option>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Product Type</label>
                                                    <div class="col-md-9">
                                                        <select id="productType" name="productType"
                                                                class="form-control input-inline input-medium select2me">
                                                            <option value="0">Select</option>
                                                            <option value="1">Normal</option>
                                                            <option value="2">Featured</option>    
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Quantity</label>

                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control input-inline input-medium"
                                                               placeholder="" name="quantity" id="quantity">
                                                    </div>
                                                </div>  
                                            </div>
                                            <div class="col-md-6">
                                               <div class="form-group">
                                                   <label class="col-md-3 control-label">Product Category</label>
                                                   <div class="col-md-9">
                                                       <select id="productCategory" name="productCategory"
                                                               class="form-control input-inline input-medium select2me">
                                                           <option value="0">Select</option>
                                                           <?php if ($categoryLists != 0) { ?>
                                                  
                                                               <?php foreach ($categoryLists as $categoryList) { ?>
                                                                   <?php if ($categoryList['enabled'] == '1' || $categoryList['enabled'] == 1) { ?>
                                                                       <option
                                                                           value="<?php echo $categoryList['id']; ?>"><?php echo ucfirst($categoryList['categoryName']); ?></option>
                                                                   <?php } ?>
                                                               <?php } ?>
                                                           <?php } ?>
                                                       </select>
                                                   </div>
                                               </div>
                                               <div class="form-group">
                                                   <label class="col-md-3 control-label">Weight</label>

                                                   <div class="col-md-9">
                                                       <input type="text" class="form-control input-inline input-medium"
                                                              placeholder="" name="weight" id="weight">
                                                   </div>
                                               </div>
                                               <div class="form-group">
                                                   <label class="col-md-3 control-label">Size</label>

                                                   <div class="col-md-9">
                                                       <input type="text" class="form-control input-inline input-medium"
                                                              placeholder="" name="size" id="size">
                                                   </div>
                                               </div>
                                               <div class="form-group">
                                                   <label class="col-md-3 control-label">Product ID</label>

                                                   <div class="col-md-9">
                                                       <input type="text" class="form-control input-inline input-medium"
                                                              placeholder="" name="productID" id="productID">
                                                   </div>
                                               </div>
                                               <div class="form-group">
                                                   <label class="col-md-3 control-label">Description</label>

                                                   <div class="col-md-9">
                                                       <textarea class="form-control input-inline input-medium" 
                                                           name="description" id="description"></textarea>
                                                   </div>
                                               </div>
                                               <div class="form-group">
                                                   <label class="col-md-3 control-label">Vendor</label>
                                                   <div class="col-md-9">
                                                       <select id="vendor" name="vendor"
                                                               class="form-control input-inline input-medium select2me">
                                                           <option value="0">Select</option>    
                                                           <?php if ($vendorLists != 0) { ?>
                                                               <?php foreach ($vendorLists as $vendorList) { ?>
                                                                   <?php if ($vendorList['enabled'] == '1' || $vendorList['enabled'] == 1) { ?>
                                                                       <option
                                                                           value="<?php echo $vendorList['id']; ?>"><?php echo $vendorList['name']; ?></option>
                                                                   <?php } ?>
                                                               <?php } ?>
                                                           <?php } ?>
                                                       </select>
                                                   </div>
                                               </div>
                                               <div class="form-group">
                                                   <label class="col-md-3 control-label">Images</label>

                                                   <div class="col-md-9">
                                                       <div class="fileinput fileinput-new" data-provides="fileinput">
                                                           <div class="input-group input-large">
                                                               <div class="form-control uneditable-input span3"
                                                                    data-trigger="fileinput">
                                                                   <i class="fa fa-file fileinput-exists"></i>&nbsp; <span
                                                                       class="fileinput-filename">
                                                                </span>
                                                               </div>
                                                            <span class="input-group-addon btn default btn-file">
                                                            <span class="fileinput-new">
                                                            Select file </span>
                                                            <span class="fileinput-exists">
                                                            Change </span>
                                                            <input type="file" name="productImage"
                                                                      id="productImage" onchange="uploadImage();">
                                                            </span>
                                                               <a href="#" class="input-group-addon btn red fileinput-exists"
                                                                  data-dismiss="fileinput">
                                                                   Remove </a>
                                                           </div>
                                                       </div>
                                                   </div>
                                               </div> 
                                               <input type="hidden" id="filenames" name="filenames">
                                               <div id="files" class="files-thumbnails" >
                                                 <img class="ajax-style"  id="loading_image" style="display:none" 
                                                    src="<?php echo base_url(); ?>assets/admin/layout4/img/ajax-loading.gif" height="20" width="20">
                                                 
                                               </div>
                                            </div>    
                                        </div>
                                    </div>
                                    
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn blue" onClick="saveProduct();">Save changes</button>
                            <button type="button" class="btn default" data-dismiss="modal">Close</button>
                            <span id="errorMsg" class="font-red-haze"></span>
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
                    <h1>Product Management</h1>
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
                                <i class="fa fa-globe"></i>Product List
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
                                        Price
                                    </th>
                                    <th>
                                        Discount %
                                    </th>
                                    <th>
                                        Product Type
                                    </th>
                                    <th>
                                        Quantity
                                    </th>
                                    <th>
                                        Description
                                    </th>
                                    <th>
                                        Vendor
                                    </th>
                                    <th>
                                        Weight
                                    </th>
                                    <th>
                                        Size
                                    </th>
                                    <th>
                                        Category
                                    </th>
                                    <th>
                                        Color
                                    </th>
                                    <th>
                                        Shape
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
                                if ($productLists != 0) { ?>
                                    <?php foreach ($productLists as $productList) { ?>
                                        <tr>
                                            <td> <?php echo $i; ?> </td>
                                            <td>
                                              <select id="status_table" onchange="updateStatus(this,<?php echo $productList['id']?>)" name="status_table"
                                                      class="form-control input-inline">
                                                  <option value="1" <?php if($productList['status'] == 1 || $productList['status'] == '1'){ ?> selected <?php } ?>> New</option>
                                                  <option value="2" <?php if($productList['status'] == 2 || $productList['status'] == '2'){ ?> selected <?php } ?>>Sale</option>
                                                  <option value="0" <?php if($productList['status'] == 0 || $productList['status'] == '0'){ ?> selected <?php } ?>>Out of Stock</option>
                                              </select>
                                            </td>
                                            <td> <?php echo $productList['name'] ?></td>
                                            <td> <?php echo $productList['price']; ?></td>
                                            <td> <?php echo $productList['discountPercentage']." %"; ?> </td>
                                            <td> <?php if( $productList['productType']=='1'||$productList['productType']==1){?>
                                                  <?php echo "Normal"; ?>
                                                  <?php }else if($productList['productType']=='2'||$productList['productType']==2){ ?>
                                                   <?php echo "Featured"; ?> 
                                                  <?php } ?>
                                            </td>
                                            <td> <?php echo $productList['quantity']; ?> </td>
                                            <td> <?php echo $productList['description']; ?> </td>
                                            <td> <?php echo $productList['vendorName']; ?> </td>
                                            <td> <?php echo $productList['weight']." gram"; ?> </td>
                                            <td> <?php echo $productList['size']." MM"; ?> </td>
                                            <td> <?php echo ucfirst($productList['categoryName']); ?> </td>
                                            <td> <?php echo ucfirst($productList['colorName']); ?> </td>
                                            <td> <?php echo ucfirst($productList['shapeName']); ?> </td>
                                            <td> <?php echo $productList['createdAt']; ?> </td>
                                            <td> <?php echo $productList['updatedAt']; ?> </td>
                                            <td>   
                                                <button onClick="editProduct(<?php echo $productList['id']; ?>)"
                                                        class="btn btn-primary btn-xs" title="Edit"><i
                                                        class="fa fa-pencil"></i>
                                                </button>
                                                
                                        
                                                <?php if ($productList['enabled'] == 0 || $productList['enabled'] == '0') { ?>
                                                    <button class="btn btn-info btn-xs" title="Activate"
                                                            onclick="active(<?php echo $productList['id']; ?>)"><i
                                                                class="fa fa-check"></i></button>
                                                <?php } else { ?>
                                                    <button class="btn btn-danger btn-xs" title="Deactivate"
                                                            onclick="active(<?php echo $productList['id']; ?>)"><i
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

     $.validator.addMethod("selectValid", function (value, element) {
        if (value != 0) {
            return 'true';
        }
    });
    $.validator.addMethod("lessThan", function (value, element) {
        if (value < 100) {
            return 'true';
        }
    });

    form.validate({
        errorElement: "label",
        errorClass: "font-red-haze",
        rules: {
            'name': {required: true},
            'price': {required: true, number: true},
            'discount': {required: true,lessThan:true,number: true},
            'status':{selectValid:true},
            'productShape':{selectValid:true},
            'productColor':{selectValid:true},
            'productType':{selectValid:true},
            'quantity':{required:true},
            'productCategory':{selectValid:true},
            'weight':{required:true},
            'size':{required:true},
            'productID':{required:true},
            'description':{required:true},
            'vendor':{selectValid:true}
        },
        messages: {
            'name': {required: 'Enter product name'},
            'price': {required: 'Enter price', number: "Not a valid number"},
            'discount': {required: 'Enter discount %',lessThan:'% should be < 100',number: 'Select Number'},
            'status':{selectValid:'Please select status'},
            'productShape':{selectValid:'Select product shape'},
            'productColor':{selectValid:'Select product color'},
            'productType':{selectValid:'Select product type'},
            'quantity':{required:'Select quantity'},
            'productCategory':{selectValid:'Select category'},
            'weight':{required:'Enter weight'},
            'size':{required:'Enter size'},
            'productID':{required:'Enter product id'},
            'description':{required:'Enter description'},
            'vendor':{selectValid:'Select vendor'}
        }
    });
    
    function saveProduct() {
        if (form.valid()) {
          if($('#filenames').val()!=''){

            $.ajax({
                url: "<?php echo site_url('add_product');?>",
                type: 'post',
                dataType: 'json',
                data: {
                    name: $('#name').val(),
                    price: $('#price').val(),
                    discount: $('#discount').val(),
                    status: $('#status').val(),
                    productShape: $('#productShape').val(),
                    productColor: $('#productColor').val(),
                    productType: $('#productType').val(),
                    quantity: $('#quantity').val(),
                    productCategory: $('#productCategory').val(),
                    weight: $('#weight').val(),
                    size: $('#size').val(),
                    productID: $('#productID').val(),
                    vendor: $('#vendor').val(),
                    description:$("#description").val(),
                    filenames:$('#filenames').val()
                },

                success: function (data) {
                    if (data > 0) {
                        location.reload();
                    }
                }
            });

          }else{
            alert('Select product images!')
            
        }
          }
    }

    function editProduct(id) {
        string_array = "product_id=" + id;

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('edit_product');  ?>",
            data: string_array,
            success: function (msg) {
                $("#editview").html(msg);
                $('#edit_popup').trigger("click");
                ComponentsPickers.init();
            }
        });
    }
    function updateStatus(th,id){
      $.ajax({
          type: "POST",
          url: "<?php echo site_url('update_product_status'); ?>",
          data: {productId: id,value:th.value},
          success: function (msg) {
              if (msg == 1) {
                  location.reload();
              }
          }
      });
    }
    function updateProduct(id) {
        var form_update = $("#default1");
         $.validator.addMethod("selectValid", function (value, element) {
            if (value != 0) {
                return 'true';
            }
        });
        $.validator.addMethod("lessThan", function (value, element) {
            if (value < 100) {
                return 'true';
            }
        });
        form_update.validate({
          errorElement: "label",
          errorClass: "font-red-haze",
          rules: {
              'name_edit': {required: true},
              'price_edit': {required: true, number: true},
              'discount_edit': {required: true,lessThan:true,number: true},
              'status_edit':{selectValid:true},
              'productShape_edit':{selectValid:true},
              'productColor_edit':{selectValid:true},
              'productType_edit':{selectValid:true},
              'quantity_edit':{required:true},
              'productCategory_edit':{selectValid:true},
              'weight_edit':{required:true},
              'size_edit':{required:true},
              'productID_edit':{required:true},
              'description_edit':{required:true},
              'vendor_edit':{selectValid:true}
          },
          messages: {
              'name_edit': {required: 'Enter product name'},
              'price_edit': {required: 'Enter price', number: "Not a valid number"},
              'discount_edit': {required: 'Enter discount %',lessThan:'% should be < 100',number:'Select number'},
              'status_edit':{selectValid:'Please select status'},
              'productShape_edit':{selectValid:'Select product shape'},
              'productColor_edit':{selectValid:'Select product color'},
              'productType_edit':{selectValid:'Select product type'},
              'quantity_edit':{required:'Select quantity'},
              'productCategory_edit':{selectValid:'Select category'},
              'weight_edit':{required:'Enter weight'},
              'size_edit':{required:'Enter size'},
              'productID_edit':{required:'Enter product id'},
              'description_edit':{required:'Enter description'},
              'vendor_edit':{selectValid:'Select vendor'}
          }
        });
        if (form_update.valid()) {
          if($('#filenames_edit').val()!=''){
            $.ajax({
                url: "<?php echo site_url('update_product');?>",
                type: 'post',
                dataType: 'json',
                data: {
                    id: id,
                    name: $('#name_edit').val(),
                    price: $('#price_edit').val(),
                    discount: $('#discount_edit').val(),
                    status: $('#status_edit').val(),
                    productShape: $('#productShape_edit').val(),
                    productColor: $('#productColor_edit').val(),
                    productType: $('#productType_edit').val(),
                    quantity: $('#quantity_edit').val(),
                    productCategory: $('#productCategory_edit').val(),
                    weight: $('#weight_edit').val(),
                    size: $('#size_edit').val(),
                    productID: $('#productID_edit').val(),
                    vendor: $('#vendor_edit').val(),
                    description:$("#description_edit").val(),
                    filenames:$('#filenames_edit').val()
                },

                success: function (data) {
                    if (data == 1) {
                        location.reload();
                    }
                }
            });
          }else{
            alert('Select product images!')   
          }
        }
    }
    function active(productId) {
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('activate_product'); ?>",
            data: {productId: productId},
            success: function (msg) {
                if (msg == 1) {
                    location.reload();
                }
            }
        });
    }

    
    function uploadImage(tag=''){
      if(tag=='edit'){
        var filename = 'productImage_edit';
      }else{
        var filename = 'productImage';
      }
      $("#loading_image").show();
      $.ajaxFileUpload({
          url: "<?php echo site_url('product_image_upload'); ?>",
          type: 'post',
          secureuri: false,
          fileElementId: filename,
          data: {
            tag: tag
          },
          dataType: 'text',
          success: function (msg) {
            if(msg != '0' && msg != '-1'){
              msg = msg.trim();
              $("#loading_image").hide();
              var nameArray = msg.split(".");
              var domElement = '<div id="'+nameArray[0]+'" class="product-image-thumb"><p style="text-align:center;" title="Delete"><i class="fa fa-trash" onclick="deleteImage('+"'"+msg+"'"+','+"'"+tag+"'"+')"></i></p>';
              domElement += '<img src="https://testbank-nc.s3.amazonaws.com/'+msg+'" height="150" width="100"></div>';
              
              

              if(tag==''){
                $("#files").append(domElement);
                if($("#filenames").val() != ''){
                  var files = $("#filenames").val() +"|"+ msg;
                  $("#filenames").val(files);  
                }else{  
                  $("#filenames").val(msg);
                }
              }else{
                $("#files_edit").append(domElement);
                if($("#filenames_edit").val() != ''){
                  var files = $("#filenames_edit").val() +"|"+ msg;
                  $("#filenames_edit").val(files);  
                }else{  
                  $("#filenames_edit").val(msg);
                }
              }
 
            }else{
              $("#loading_image").hide();
            }
              
          }
      });
    }

    function deleteImage(imageName,tag=''){
      if(tag==''){
        var images = $("#filenames").val();
        var filenamesArray = images.split("|");
        var index = filenamesArray.indexOf(imageName);
        filenamesArray.splice(index, 1);

        var fileNameString = filenamesArray.join("|");
        $("#filenames").val(fileNameString);
        var divID = imageName.split('.');
      }else{
        var images = $("#filenames_edit").val();
        var filenamesArray = images.split("|");
        var index = filenamesArray.indexOf(imageName);
        filenamesArray.splice(index, 1);
        filenamesArray.join("|");
        var fileNameString = filenamesArray.join("|");
        $("#filenames_edit").val(fileNameString);
        var divID = imageName.split('.');
      }
      
      
      $("#loading_image").show();
      $.ajax({
          type: "POST",
          dataType: 'JSON',
          url: "<?php echo site_url('product_image_delete'); ?>",
          data: {imageName: imageName},
          success: function (msg) {
              if(msg=='204'||msg==204){
                $( '#'+divID[0]).remove();
                $("#loading_image").hide();
              }
          }
      });
    }

   


</script>
</body>
<!-- END BODY -->
</html>
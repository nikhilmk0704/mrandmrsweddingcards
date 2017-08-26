<a href="#driverEdit" data-toggle="modal" class="config" id="edit_popup"></a>
<div class="modal fade" id="driverEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-custom">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Edit Product</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" id="default1">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6"> 
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Product Name</label>

                                        <div class="col-md-9">
                                            <input type="text" name="name_edit" id="name_edit"
                                                   class="form-control input-inline input-medium" value="<?php echo $product['name']; ?>" placeholder=""
                                                   required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Price</label>

                                        <div class="col-md-9">
                                            <input type="text" class="form-control input-inline input-medium"
                                                   placeholder="" name="price_edit" id="price_edit" value="<?php echo $product['price']; ?>" required>
                                            
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Discount %</label>

                                        <div class="col-md-9">
                                            <input type="text" class="form-control input-inline input-medium"
                                                   placeholder="" name="discount_edit" id="discount_edit"  value="<?php echo $product['price']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Status</label>
                                        <div class="col-md-9">
                                            <select id="status_edit" name="status_edit"
                                                    class="form-control input-inline input-medium select2me">
                                                <option value="">Select</option>    
                                                <option value="1" <?php if($product['status'] == 1 || $product['status'] == '1'){ ?> selected <?php } ?>>New</option>
                                                <option value="2" <?php if($product['status'] == 2 || $product['status'] == '2'){ ?> selected <?php } ?>>Sale</option>
                                                <option value="0" <?php if($product['status'] == 0 || $product['status'] == '0'){ ?> selected <?php } ?>>Out of Stock</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Product Shape</label>
                                        <div class="col-md-9">
                                            <select id="productShape_edit" name="productShape_edit"
                                                    class="form-control input-inline input-medium select2me">
                                                <option value="0">Select</option>    
                                                <?php if ($shapeLists != 0) { ?>
                                                    <?php foreach ($shapeLists as $shapeList) { ?>
                                                        <?php if ($shapeList['enabled'] == '1' || $shapeList['enabled'] == 1) { ?>
                                                            <option 
                                                                <?php if($product['productShapeId'] == $shapeList['id'] ){ ?> selected <?php } ?>
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
                                            <select id="productColor_edit" name="productColor_edit"
                                                    class="form-control input-inline input-medium select2me">
                                                <option value="0">Select</option>    
                                                <?php if ($colorLists != 0) { ?>
                                                    <?php foreach ($colorLists as $colorList) { ?>
                                                        <?php if ($colorList['enabled'] == '1' || $colorList['enabled'] == 1) { ?>
                                                            <option
                                                                <?php if($product['productColorId'] == $colorList['id'] ){ ?> selected <?php } ?>
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
                                            <select id="productType_edit" name="productType_edit"
                                                    class="form-control input-inline input-medium select2me">
                                                <option value="0">Select</option>
                                                <option  
                                                    <?php if($product['productType'] == '1' ){ ?> selected <?php } ?> value="1">Normal</option>
                                                <option  <?php if($product['productType'] == '2' ){ ?> selected <?php } ?> value="2">Featured</option>    
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Quantity</label>

                                        <div class="col-md-9">
                                            <input type="text" class="form-control input-inline input-medium"
                                                   placeholder="" name="quantity_edit" id="quantity_edit" value="<?php echo $product['quantity']; ?>">
                                        </div>
                                    </div>  
                                </div>
                                <div class="col-md-6">
                                   <div class="form-group">
                                       <label class="col-md-3 control-label">Product Category</label>
                                       <div class="col-md-9">
                                           <select id="productCategory_edit" name="productCategory_edit"
                                                   class="form-control input-inline input-medium select2me">
                                               <option value="0">Select</option>
                                               <?php if ($categoryLists != 0) { ?>
                                      
                                                   <?php foreach ($categoryLists as $categoryList) { ?>
                                                       <?php if ($categoryList['enabled'] == '1' || $categoryList['enabled'] == 1) { ?>
                                                           <option
                                                               <?php if($product['productCategoryId'] == $categoryList['id'] ){ ?> selected <?php } ?> 
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
                                                  placeholder="" name="weight_edit" id="weight_edit" value="<?php echo $product['weight']; ?>">
                                       </div>
                                   </div>
                                   <div class="form-group">
                                       <label class="col-md-3 control-label">Size</label>

                                       <div class="col-md-9">
                                           <input type="text" class="form-control input-inline input-medium"
                                                  placeholder="" name="size_edit" id="size_edit" value="<?php echo $product['size']; ?>">
                                       </div>
                                   </div>
                                   <div class="form-group">
                                       <label class="col-md-3 control-label">Product ID</label>

                                       <div class="col-md-9">
                                           <input type="text" class="form-control input-inline input-medium"
                                                  placeholder="" name="productID_edit" id="productID_edit" value="<?php echo $product['productId']; ?>">
                                       </div>
                                   </div>
                                   <div class="form-group">
                                       <label class="col-md-3 control-label">Description</label>

                                       <div class="col-md-9">
                                           <textarea class="form-control input-inline input-medium" name="description_edit" id="description_edit"><?php echo trim($product['description']); ?></textarea>
                                       </div>
                                   </div>
                                   <div class="form-group">
                                       <label class="col-md-3 control-label">Vendor</label>
                                       <div class="col-md-9">
                                           <select id="vendor_edit" name="vendor_edit"
                                                   class="form-control input-inline input-medium select2me">
                                               <option value="0">Select</option>    
                                               <?php if ($vendorLists != 0) { ?>
                                                   <?php foreach ($vendorLists as $vendorList) { ?>
                                                       <?php if ($vendorList['enabled'] == '1' || $vendorList['enabled'] == 1) { ?>
                                                           <option
                                                            <?php if($product['vendorId'] == $vendorList['id'] ){ ?> selected <?php } ?>
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
                                                <input type="file" name="productImage_edit"
                                                          id="productImage_edit" onchange="uploadImage('edit');">
                                                </span>
                                                   <a href="#" class="input-group-addon btn red fileinput-exists"
                                                      data-dismiss="fileinput">
                                                       Remove </a>
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                                   
                                   <div id="files_edit" class="files-thumbnails" >
                                     <img class="ajax-style"  id="loading_image" style="display:none" 
                                        src="<?php echo base_url(); ?>assets/admin/layout4/img/ajax-loading.gif" height="20" width="20">
                                     <?php $filenamesList = ""; ?>
                                     <?php if(count($product['imagesArray']) > 0){ ?>   
                                         <?php foreach ($product['imagesArray'] as $imageDetail) { ?>
                                            <?php $nameArray = explode('.', $imageDetail['path']);?>
                                            <?php if($filenamesList ==""){?>
                                                <?php $filenamesList .=$imageDetail['path']; ?>
                                            <?php }else{ ?>
                                                 <?php $filenamesList .="|".$imageDetail['path']; ?>
                                            <?php } ?>
                                             <div id="<?php echo $nameArray[0]; ?>" class="product-image-thumb"><p style="text-align:center;" title="Delete"><i class="fa fa-trash" onclick="deleteImage('<?php echo $imageDetail['path'];  ?>','edit')"></i></p><img src="https://testbank-nc.s3.amazonaws.com/<?php echo $imageDetail['path'];?>" height="150" width="100">
                                             </div>
                                         <?php } ?>
                                     <?php } ?>   
                                     
                                   </div>
                                   <input type="hidden" id="filenames_edit" value="<?php echo $filenamesList; ?>" name="filenames_edit">
                                </div>    
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer ">
                <button type="button" class="btn blue"
                        onclick="updateProduct(<?php echo $product['id']; ?>);">
                    Save changes
                </button>
                <button type="button" class="btn default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
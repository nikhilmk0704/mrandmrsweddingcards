 <?php $this->load->view('header'); ?>
 <!-- Main Wrap Start -->
    <div class="main-wrap">
        <div class="shop-page-main">
            <div class="container">
                <div class="row">                   
                    <!-- Cart Steps -->
                    <div class="col-md-12">
                        <ul class="cart-steps">
                            <li class="cart-step summery current">Wishlist</li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table id="cart_summary" class="cart_summery">
                            <tr>
                                <th class="cart_product">Product</th>
                                <th class="cart_description">Description</th>
                                <th class="cart_avail">Availability</th>
                                <th class="cart_unit_price">Unit price</th>
                                <th class="cart_delete">&nbsp;</th>
                            </tr>
                            <?php if($wishlist != 0){ ?>
                                <?php foreach ($wishlist as $wish){ ?>
                                    <tr>
                                        <td class="cart_product_content"><a class="product-thumbs" href="<?php echo base_url('product-detail/'.$wish['product']["id"])?>"><img src="https://testbank-nc.s3.amazonaws.com/<?php echo $wish['product']['imagesArray'][0]['path']; ?>" alt="Product Image"></a></td>
                                        
                                        <td class="cart_desc_content">
                                            <h5><?php echo $wish['product']["name"]; ?></h5>
                                            <p class="cart-sku">SKU: <?php echo $wish['product']["productId"]; ?></p>
                                            <p class="cart_size">Category: <?php echo ucfirst($wish['product']["categoryName"]); ?></p>
                                            <p class="cart_color">Color: <?php echo ucfirst($wish['product']["colorName"]); ?></p>
                                            <p class="cart_color">Shape: <?php echo ucfirst($wish['product']["shapeName"]); ?></p>
                                        </td>
                                        <td class="cart_avail_content">
                                            <?php if ($wish['product']["enabled"] == '1') {?>
                                                <?php if($wish['product']["status"]!='0'){ ?>
                                                    <span class="availability-status label label-success">In stock</span>
                                                <?php }elseif ($wish['product']["status"] == '0') {?>
                                                    <span class="availability-status label label-warning">Out of stock</span>
                                                <?php } ?>
                                            <?php }else{ ?>
                                                <span class="availability-status label label-danger">Discontinued</span>
                                            <?php } ?>    

                                        </td>
                                        <?php if($wish['product']['discountPercentage'] > 0){ ?>
                                            <?php
                                                $price =  $wish['product']['price'];
                                                $discount = $wish['product']['discountPercentage'];
                                                $discountAmount = $price * ($discount/100);
                                            ?>
                                         <td class="cart_unit_price_content"><span class="price">&#8377; <?php echo $wish['product']['price'] - $discountAmount; ?></span> &nbsp; <span class="regular-price"><strike>&#8377; <?php echo $wish['product']['price']; ?></strike></span></td>
                                           
                                        <?php }else{ ?>
                                         <td class="cart_unit_price_content"><span class="price"> &#8377; <?php echo $wish['product']['price'] ?></span></td>
                                        <?php } ?>
                                        
                                        <td class="cart_delete_item"><a title="Remove" onclick="removeWishList(<?php echo $wish['id'];?>)" class="deleteItem"><i class="fa fa-trash"></i></a></td>
                                    </tr>
                                <?php } ?>    
                            <?php }else{ ?>
                                <tr>
                                    <td class="cart_avail_content" colspan="5" align="center">No products found!</td>
                                </tr>
                            <?php } ?>    
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>             
    </div>
    <!-- Main Wrap End -->
    <?php $this->load->view('footer'); ?>
<div class="row">
<div class="loading">Loading&#8230;</div>
    <?php if($products != 0){ ?>
        <?php foreach ($products as $product) { ?>
           <div class="product col-lg-4 col-md-6">
                <!-- Thumb wrap -->
                <div class="thumb-wrap">
                    <!-- Product Thumb -->
                    <a class="product-thumbs" href="<?php echo base_url('product-detail/'.$product["id"])?>">
                        <img class="default-thumb product-thumb" src="https://testbank-nc.s3.amazonaws.com/<?php echo $product['imagesArray'][0]['path']; ?>" alt="Product Image">
                        <img class="hover-thumb product-thumb" src="https://testbank-nc.s3.amazonaws.com/<?php echo $product['imagesArray'][1]['path'];?>" alt="Product Image">
                    </a>
                    <!-- Product Attribute -->
                    <div class="attr-group">
                        <?php if($product['status']=='0'){ ?>
                            <span class="out-stock"><span>No Stock</span></span>
                        <?php }elseif($product['status']=='1'){ ?>    
                            <span class="new"><span>New</span></span>
                        <?php }elseif($product['status']=='2'){ ?>    
                            <span class="sale"><span>Sale</span></span>
                        <?php } ?>
                    </div>
                </div>
                <!-- Detail Wrap -->
                <div class="detail-wrap">
                    <h5 class="product-name"><a href="<?php echo base_url('product-detail/'.$product["id"])?>"><?php echo $product['name']; ?></a></h5>
                    <?php if($product['discountPercentage'] > 0){ ?>
                    <?php
                        $price =  $product['price'];
                        $discount = $product['discountPercentage'];
                        $discountAmount = $price * ($discount/100);
                    ?>
                     <p class="price">&#8377; <?php echo $product['price'] - $discountAmount; ?> <span class="regular-price">&#8377; <?php echo $product['price']; ?></span></p>
                       
                    <?php }else{ ?>
                       <p class="price"> &#8377; <?php echo $product['price']; ?></p> 
                    <?php } ?>
                    <div class="star-ratings">
                        <?php
                            $totalRating = 0;  
                            $averageRating = 0;
                            $noOfRating = count($product['ratingArray']);
                        ?>
                        <?php if(count($product['ratingArray']) > 0){ ?>
                            <?php foreach ($product['ratingArray'] as $rate){?> 
                                <?php 
                                    $totalRating += $rate['rating']; 
                                ?>
                            
                            <?php } ?>
                            <?php $averageRating = ceil($totalRating/$noOfRating); ?>
                        <?php }?>  
                        
                        <?php for($i=1; $i<=5; $i++){ ?>
                            <?php if( $i <= $averageRating){?>
                                <span class="star star-on"></span>
                            <?php }else{?>
                                <span class="star"></span>
                            <?php } ?>    
                        <?php } ?>
                    </div>
                    <p class="product-description">
                        <?php echo $product['description']; ?>
                    </p>
                    <a class="product-more" href="<?php echo base_url('product-detail/'.$product["id"])?>">Learn More...</a>
                    <div class="button-container">
                        <div class="tab_button">
                            <a class="shop-btn shop-cart-btn" href="#"><i class="fa fa-shopping-bag"></i>Add to cart</a>
                            <a class="shop-btn shop-wishlist-btn" href="#"><i class="fa fa-heart"></i></a>
                            <a class="shop-btn shop-compare-btn" href="#"><i class="fa fa-retweet"></i></a>
                            <a class="shop-btn shop-view-btn" href="#"><i class="fa fa-eye"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    <?php }else{ ?>
        <p class="no-result-text"> No Result Found..! </p> 
<?php } ?>
</div>
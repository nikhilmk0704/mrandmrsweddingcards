<?php $this->load->view('header'); ?>
<!-- Main Wrap Start -->
    <div class="main-wrap">
        <div class="product-page-main">
            <div class="container">
                <div class="row">
                                       
                    <!-- Shop Product Part -->
                    <div class="col-lg-12 col-md-8 col-sm-7">
                        <div class="product-bar">                            
                            <div id="product-wrap" class="product-wrap single-wrap">
                                <div class="row">
                                   <div class="product product-single">
                                        <div class="col-md-6">
                                            <!-- Thumb wrap -->
                                            <div class="thumb-wrap">
                                                <!-- Product Thumb -->
                                                <div id="main-thumb" class="product-thumbs">
                                                    <img class="default-thumb product-thumb" src="<?php echo base_url(); ?>images/product/1.jpg" alt="Product Image">
                                                </div>
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
                                            
                                            <div class="small-thumb">
                                                <div id="small-thumb-carousel" class="small-thumb-carousel owl-carousel">
                                                    <a class="active" href="<?php echo base_url(); ?>images/product/1.jpg"><img src="<?php echo base_url(); ?>images/product/1.jpg" alt="..."></a>
                                                    <a href="<?php echo base_url(); ?>images/product/2.jpg"><img src="<?php echo base_url(); ?>images/product/2.jpg" alt="..."></a>
                                                    <a href="<?php echo base_url(); ?>images/product/3.jpg"><img src="<?php echo base_url(); ?>images/product/3.jpg" alt="..."></a>
                                                    <a href="<?php echo base_url(); ?>images/product/2.jpg"><img src="<?php echo base_url(); ?>images/product/2.jpg" alt="..."></a>
                                                    <a href="<?php echo base_url(); ?>images/product/3.jpg"><img src="<?php echo base_url(); ?>images/product/3.jpg" alt="..."></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <!-- Detail Wrap -->
                                            <div class="detail-wrap">
                                                <h3 class="product-name"><?php echo $product['name']; ?></h3>
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
                                                
                                                <!-- To Review Section -->
                                                <div class="to-review">
                                                    <a class="to-review-block to-review-given" onclick="goToReview()"><i class="fa fa-comment"></i> Read reviews (<?php echo count($product['reviewArray']); ?>)</a>
                                                    <a class="to-review-block to-review-form" onclick="writeReview();"><i class="fa fa-pencil-square-o"></i> Write a review</a>
                                                </div>
                                                
                                                <!-- Stock Attr -->
                                               
                                                
                                                <p class="product-description">
                                                    <?php echo $product['description']; ?>
                                                </p>
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
                                                
                                               
                                                <div class="order-input">
                                                    <input type="number" min="1" max="12" value="1">
                                                    <button class="btn" type="submit"><i class="fa fa-shopping-bag"></i> Add to cart</button>
                                                </div>
                                                
                                                <div class="order-input">
                                                    <?php if(count($product['wishlist']) > 0){ ?>
                                                        <i title="Added to wishlist" class="fa fa-heart" style="color:#FF0000; font-size:30px;"></i>
                                                    <?php }else{?>
                                                        <button class="add-to-wish" type="button"  onclick="addTowishList(<?php echo $product['id']; ?>)" name="add-to-wish"><i class="fa fa-heart-o"></i> Add to wishlist</button>
                                                    <?php } ?>    
                                                    
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Product Information Tabs -->
                                    <div class="col-md-12">
                                        <div class="product-info-tabs" id="reviews_div">
                                            <!-- Nav tabs -->
                                            <ul class="nav nav-tabs" role="tablist">
                                                <li role="presentation" class="active"><a href="#more-info" aria-controls="more-info" role="tab" data-toggle="tab">More Info</a></li>
                                                <li role="presentation"><a href="#data-sheet" aria-controls="data-sheet" role="tab" data-toggle="tab">Data Sheet</a></li>
                                                <li role="presentation"><a href="#reviews" id="review_tab" aria-controls="reviews" role="tab" data-toggle="tab">Reviews</a></li>
                                            </ul>

                                            <!-- Tab panes -->
                                            <div class="tab-content">
                                                <div role="tabpanel" class="tab-pane fade in active" id="more-info">
                                                    <p><?php echo $product['moreInfo']; ?></p>
                                                </div>
                                                <div role="tabpanel" class="tab-pane fade" id="data-sheet">
                                                    <table class="data-sheet-table">
                                                        <tr>
                                                            <td>Size: <?php echo $product['size']; ?> (Height x Width in CM)</td>
                                                            <td>Category: <?php echo ucfirst($product['categoryName']); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Shape: <?php echo ucfirst($product['shapeName']); ?></td>
                                                            <td>Weight of one piece: <?php echo ucfirst($product['weight'])."gram"; ?></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div role="tabpanel" class="tab-pane fade" id="reviews">
                                                    <table class="review-table">
                                                        <?php if(count($product['reviewArray']) > 0){ ?>
                                                            <?php foreach($product['reviewArray'] as $review){ ?>
                                                                <tr class="review-item">
                                                                    <td class="review-head">
                                                                        <h5 class="grade">Rating</h5>
                                                                        <div class="star-ratings">
                                                                            <?php for($i=1; $i<=5; $i++){ ?>
                                                                                <?php if( $i <= $review['rating']){?>
                                                                                    <span class="star star-on"></span>
                                                                                <?php }else{?>
                                                                                    <span class="star"></span>
                                                                                <?php } ?>    
                                                                            <?php } ?>
                                                                        </div>
                                                                        <h5 class="review-reviewer"><?php echo $review['firstName']." ".$review['lastName']; ?></h5>
                                                                        <?php
                                                                            $dateFormatted = date('d-m-Y', strtotime($review['createdAt']));
                                                                        ?>
                                                                        <span class="review-date"><?php echo $dateFormatted; ?></span>
                                                                    </td>
                                                                    <td class="review-body">
                                                                        <h5 class="review-title"><?php echo $review['reviewTitle']; ?></h5>
                                                                        <p><?php echo $review['review']; ?></p>
                                                                    </td>
                                                                </tr>
                                                            <?php } ?>    
                                                        <?php } ?> 
                                                    </table>
                                                    
                                                    <a class="btn to-reviewform-btn" onclick="writeReview();"><i class="fa fa-pencil-square-o"></i> Write your review</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    
                                </div>
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>

    <div id="reviewModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Rating & Review</h4>
          </div>
          <div class="modal-body">
            <form id="ratingForm" name="ratingForm" action="#" method="post" class="form-horizontal ratingForm" role="form">
                <div class="row">
                    <div class="form-group">
                        <label for="rating" class="col-sm-3 control-label">Rating</label>
                        <div class="col-sm-6">
                            <div class="col-md-10 star-rating" id="star-rating">
                                <span class="fa fa-star-o star_style" data-rating="1"></span>
                                <span class="fa fa-star-o star_style" data-rating="2"></span>
                                <span class="fa fa-star-o star_style" data-rating="3"></span>
                                <span class="fa fa-star-o star_style" data-rating="4"></span>
                                <span class="fa fa-star-o star_style" data-rating="5"></span>
                                <input type="hidden" id="ratingValue" name="ratingValue" class="rating-value" value="0" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-sm-3 control-label">Title</label>
                        <div class="col-sm-6">
                            <input type="text" name="title" id="title" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-sm-3 control-label">Review</label>
                        <div class="col-sm-6">
                            <textarea class="form-control review" name="review" id="review" rows="3" id="review"></textarea>
                        </div>    
                    </div>
                    <div class="form-group">
                    <label for="title" class="col-sm-3 control-label"></label>
                        <div class="col-sm-6">
                            <button type="button" onclick="saveReview(<?php echo $product['id']; ?>);" class="btn"><i class="fa fa-edit" aria-hidden="true"></i> Save</button>  
                        </div>      
                    </div>
                    
                </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>
    <!-- Main Wrap End -->
    <?php $this->load->view('footer'); ?>
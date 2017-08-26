    <?php $this->load->view('header'); ?>
    <!-- Banner Slider Start -->
    <section id="banner-slider-wrap" class="banner-slider-wrap">
        <div id="banner-slider" class="owl-carousel banner-slider">
            <div class="banner-item banner-item-1">
                <div class="slider-content">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-5 col-md-offset-7 text-center">
                                <h1>
                                    <span class="level-2">Get your winter look</span>
                                    <span class="level-3">up to</span>
                                    <span class="level-1">50% Off</span>
                                </h1>
                                <a class="btn" href="product.html">Shop Now !</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="banner-item banner-item-2">
                <div class="slider-content">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h1>
                                    <span class="level-2">New collection</span>
                                    <span class="level-3">up to</span>
                                    <span class="level-1">50% Off</span>
                                </h1>
                                <a class="btn" href="product.html">Shop Now !</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="banner-item banner-item-3">
                <div class="slider-content">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-5">
                                <h1>
                                    <span class="level-2">Lookbook 2017</span>
                                    <span class="level-3">up to</span>
                                    <span class="level-1">50% Off</span>
                                </h1>
                                <a class="btn" href="product.html">Shop Now !</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Slider End -->
    
    <!-- Main Wrap Start -->
    <div class="main-wrap">
        
        <!-- Banner Module / 1-->
        <div class="shop-module banner-module">
            <div class="container">
                <div class="row">
                    <div class="banner-group">
                        <div class="col-sm-6">
                            <a href="#" class="banner">
                                <img src="images/banner/1.png" alt="...">
                            </a>
                        </div>
                        <div class="col-sm-6">
                            <a href="#" class="banner">
                                <img src="images/banner/2.png" alt="...">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            
        <!-- New Product Modue Start -->
        <div class="shop-module default-carousel-module">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h3 class="module-title">Products</h3>
                        <a class="btn view-all" href="product.html">View All</a>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="owl-carousel product-carousel">
                            <?php if(count($products) > 0){ ?>
                                <?php foreach ($products as $product) { ?>
                                    <div class="product">
                                        <!-- Thumb wrap -->
                                        <div class="thumb-wrap">
                                            <!-- Product Thumb -->
                                            <a class="product-thumbs" href="#">
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
                                            <h5 class="product-name">
                                                <a href="product-single.html"><?php echo $product['name']; ?></a>
                                            </h5>
                                            <?php
                                                $price =  $product['price'];
                                                $discount = $product['discountPercentage'];
                                                $discountAmount = $price * ($discount/100);
                                            ?>
                                            <p class="price">&#8377; <?php echo $product['price'] - $discountAmount; ?> <span class="regular-price">&#8377; <?php echo $product['price']; ?></span></p>
                                            
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
                                              
                                            
 
                                            <div class="button-container">
                                                <div class="tab_button">
                                                    <a class="shop-btn shop-cart-btn" href="#"><i class="fa fa-shopping-bag"></i>Add to cart</a>
                                                    <a title="Add to Wishlist" class="shop-btn shop-wishlist-btn" href="#"><i class="fa fa-heart"></i></a>
                                                    <a class="shop-btn shop-compare-btn" href="#"><i class="fa fa-retweet"></i></a>
                                                    <a class="shop-btn shop-view-btn" href="#"><i class="fa fa-eye"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>     
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- New Product Module End -->
        
        


        <!-- Featured Category Module Start -->
        <div class="shop-module featured-cat-module">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h3 class="module-title">Featured Categories</h3>
                        <a class="btn view-all" href="product.html">View All</a>
                    </div>
                </div>
                <div class="row">
                    <div class="featured-categories">
                        <div class="col-md-6">
                            <div class="featured-cat-column">
                                <div class="mini-category">
                                    <div id="cat-carousel-1" class="owl-carousel cat-carousel">
                                        <div class="cat-column">
                                            <a class="mini-cat" href="#">
                                                <img src="images/category/s1.png" alt="Mini Category">
                                                <h5>Clothing</h5>
                                            </a>
                                            <a class="mini-cat" href="#">
                                                <img src="images/category/s2.png" alt="Mini Category">
                                                <h5>Shoes</h5>
                                            </a>
                                            <a class="mini-cat" href="#">
                                                <img src="images/category/s3.png" alt="Mini Category">
                                                <h5>Watch</h5>
                                            </a>
                                        </div>
                                        <div class="cat-column">
                                            <a class="mini-cat" href="#">
                                                <img src="images/category/s4.png" alt="Mini Category">
                                                <h5>Handbag</h5>
                                            </a>
                                            <a class="mini-cat" href="#">
                                                <img src="images/category/s5.png" alt="Mini Category">
                                                <h5>Shoes</h5>
                                            </a>
                                            <a class="mini-cat" href="#">
                                                <img src="images/category/s6.png" alt="Mini Category">
                                                <h5>Clothing</h5>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <a class="head-category" href="#">
                                    <img src="images/category/1.jpg" alt="Head Category">
                                    <div class="head-cat-content">
                                        <h3>Men</h3>
                                        <h5>Top Brands</h5>
                                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="featured-cat-column">
                                <div class="mini-category">
                                    <div id="cat-carousel-2" class="owl-carousel cat-carousel">
                                       <div class="cat-column">
                                            <a class="mini-cat" href="#">
                                                <img src="images/category/s4.png" alt="Mini Category">
                                                <h5>Handbag</h5>
                                            </a>
                                            <a class="mini-cat" href="#">
                                                <img src="images/category/s5.png" alt="Mini Category">
                                                <h5>Shoes</h5>
                                            </a>
                                            <a class="mini-cat" href="#">
                                                <img src="images/category/s6.png" alt="Mini Category">
                                                <h5>Clothing</h5>
                                            </a>
                                        </div>
                                        <div class="cat-column">
                                            <a class="mini-cat" href="#">
                                                <img src="images/category/s1.png" alt="Mini Category">
                                                <h5>Clothing</h5>
                                            </a>
                                            <a class="mini-cat" href="#">
                                                <img src="images/category/s2.png" alt="Mini Category">
                                                <h5>Shoes</h5>
                                            </a>
                                            <a class="mini-cat" href="#">
                                                <img src="images/category/s3.png" alt="Mini Category">
                                                <h5>Watch</h5>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <a class="head-category" href="#">
                                    <img src="images/category/2.jpg" alt="Head Category">
                                    <div class="head-cat-content">
                                        <h3>Women</h3>
                                        <h5>Top Brands</h5>
                                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Featured Category Module End -->
        
         <!-- Testimonial Module Start -->
        <div class="shop-module testimonial-module image-bg">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h3 class="module-title">What clients say</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div id="testimonial-carousel" class="owl-carousel testimonial-carousel">
                            <div class="testimonial">
                                <blockquote>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.</blockquote>
                                <div class="commenter-mock"><img src="images/client/1.jpg" alt="Client"></div>
                            </div>
                            <div class="testimonial">
                                <blockquote>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.</blockquote>
                                <div class="commenter-mock"><img src="images/client/1.jpg" alt="Client"></div>
                            </div>
                            <div class="testimonial">
                                <blockquote>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.</blockquote>
                                <div class="commenter-mock"><img src="images/client/1.jpg" alt="Client"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="testimonial-side-image hidden-sm hidden-xs"></div>
            </div>
        </div>
        <!-- Testimonial Module Start -->        
    </div>
    <!-- Main Wrap End -->
    <?php $this->load->view('footer'); ?>
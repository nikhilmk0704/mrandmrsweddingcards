    <?php $this->load->view('header'); ?>
    <!-- Main Wrap Start -->
    <div class="main-wrap">
        <div class="product-page-main">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-5">
                        <div class="sidebar shop-sidebar">
                           
                            <div id="woocommerce-filter-module" class="widget sidebar-widget filter-widget">        
                                <div class="widget-header">
                                    <h3 class="widget-title">Filter</h3>
                                </div>
                                <div class="widget-content">
                                    <form id="filterform" class="filterform layered-form liveform" name="filterform" action="#" method="get">
                                       
                                        <!-- Price filter -->
                                        <div class="layered-filter">
                                            <h4 class="filter-title">Price</h4>
                                            <div class="filter-content">
                                                <label for="amount" class="top-label price-label">Range: </label>
                                                <input type="text" id="amount" class="range-data" readonly>
                                                <div id="price_ranger" class="price-ranger ui-ranger" data-min="9" data-max="125"></div>
                                            </div>
                                        </div>
                             
                                        <!-- Category filter -->
                                        <div class="layered-filter">
                                            <h4 class="filter-title">Shape</h4>
                                            <div class="filter-content">
                                                <div class="input-row">
                                                    <?php if(count($productShape) > 0){ ?>
                                                        <?php foreach ($productShape as $productShape) { ?>
                                                        <div class="input-col-2">
                                                            <div class="input-rule check">
                                                                <span class="input-style"></span>
                                                                <input id="<?php echo ucfirst($productShape['id']); ?>" type="checkbox" name="category" value="beds">
                                                            </div>
                                                            <label class="filter-label" for="beds"><?php echo ucfirst($productShape['shapeName']); ?> <span class="numofitems">(<?php echo $productShape['count']; ?>)</span></label>
                                                        </div>
                                                        <?php } ?> 
                                                    <?php } ?>
                                                
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Color filter -->
                                        <div class="layered-filter">
                                            <h4 class="filter-title">Color</h4>
                                            <div class="filter-content">
                                                <div class="color-input">
                                                <?php if(count($productColor) > 0){ ?>
                                                    <?php foreach ($productColor as $productColor) { ?>
                                                        <div class="input-col-2">
                                                            <input id="beige_color" type="button" name="color" value="1" style="background-color: <?php echo $productColor['colorCode']; ?>"><label class="filter-label" for="beige_color"><?php echo ucfirst($productColor['colorName']); ?> <span class="numofitems">(<?php echo $productColor['count']; ?>)</span></label>
                                                        </div>
                                                    <?php } ?>    
                                                <?php } ?>    
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Category filter -->
                                        <div class="layered-filter">
                                            <h4 class="filter-title">Shape</h4>
                                            <div class="filter-content">
                                                <div class="input-row">
                                                    <?php if(count($productCategory) > 0){ ?>
                                                        <?php foreach ($productCategory as $productCategory) { ?>
                                                        <div class="input-col-2">
                                                            <div class="input-rule check">
                                                                <span class="input-style"></span>
                                                                <input id="<?php echo ucfirst($productCategory['id']); ?>" type="checkbox" name="category" value="beds">
                                                            </div>
                                                            <label class="filter-label" for="beds"><?php echo ucfirst($productCategory['categoryName']); ?> <span class="numofitems">(<?php echo $productCategory['count']; ?>)</span></label>
                                                        </div>
                                                        <?php } ?> 
                                                    <?php } ?>
                                                
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Availablity filter -->
                                        <div class="layered-filter">
                                            <h4 class="filter-title">Availability</h4>
                                            <div class="filter-content">
                                                <div class="input-row">
                                                    <div class="input-col-1">
                                                        <div class="input-rule check">
                                                            <span class="input-style"></span>
                                                            <input id="stock" type="checkbox" name="availability" value="stock">
                                                        </div>
                                                        <label class="filter-label" for="stock">In Stock <span class="numofitems">(<?php echo $inStockCount; ?>)</span></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Shop Product Part -->
                    <div class="col-lg-9 col-md-8 col-sm-7">
                        <div class="product-bar">
                           
                            <!-- Product Up Toolbar -->
                            <div class="toolbar toolbar-top">
                                <div class="row">
                                    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-4">
                                        <!-- Viewmode -->
                                        <div class="view-modes">
                                            <a href="#" class="grid view-mode active" title="Grid" data-mode="grid_mode"><i class="fa fa-th"></i></a>
                                            <a href="#" class="list view-mode" title="List" data-mode="list_mode"><i class="fa fa-bars"></i></a>
                                        </div>
                                    </div>

                                    <!-- Product shorting -->
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-8">
                                        <div class="shop-short-by">
                                            <label>Sort by:</label>
                                            <form class="woocommerce-ordering live-form" method="get">
                                                <select name="orderby" class="orderby">
                                                    <option value="menu_order" selected="selected">Position</option>
                                                    <option value="price-low">Price: Lowest first</option>
                                                    <option value="price-high">Price: Highest first</option>
                                                    <option value="name-a">Product Name: A to Z</option>
                                                    <option value="name-z">Product Name: Z to A</option>
                                                    <option value="onStock">In stock</option>
                                                    <option value="refer-low">Reference: Lowest first</option>
                                                    <option value="refer-high">Reference: Highest first</option>
                                                </select>
                                            </form>
                                        </div>
                                    </div>
                                    
                                    <!-- Number of items in page -->
                                    <div class="col-lg-2 col-md-3 col-sm-6 col-xs-5">
                                        <div class="itemnum-wrap">
                                            <label>Show:</label>
                                            <form name="itemPage" action="#" method="get" class="itemPage liveform">
                                                <select name="numberItem">
                                                    <option value="12" selected="selected">12</option>
                                                    <option value="24">24</option>
                                                </select>
                                            </form>
                                        </div>
                                    </div>
                                    
                                    <!-- Pagination -->
                                    <div class="col-lg-4 col-md-3 col-sm-6 col-xs-7 pagination-wrap">
                                        <label>Page:</label>
                                        <div class="paginations">
                                            <a class="current" href="#">1</a>
                                            <a href="#">2</a>
                                            <a href="#">3</a>
                                            <a href="#">4</a>
                                            <a href="#">5</a>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            
                            <div id="product-wrap" class="grid_mode">
                                <div class="row">
                                <?php if(count($products) > 0){ ?>
                                    <?php foreach ($products as $product) { ?>
                                       <div class="product col-lg-4 col-md-6">
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
                                                <h5 class="product-name"><a href="#"><?php echo $product['name']; ?></a></h5>
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
                                                <a class="product-more" href="#">Learn More...</a>
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
                                <?php } ?>          
                                </div>
                            </div>
                            
                            <!-- Product Down Toolbar -->
                            <div class="toolbar toolbar-bottom">
                                <div class="row">
                                    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-4">
                                        <!-- Viewmode -->
                                        <div class="view-modes">
                                            <a href="#" class="grid view-mode active" title="Grid" data-mode="grid_mode"><i class="fa fa-th"></i></a>
                                            <a href="#" class="list view-mode" title="List" data-mode="list_mode"><i class="fa fa-bars"></i></a>
                                        </div>
                                    </div>

                                    <!-- Product shorting -->
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-8">
                                        <div class="shop-short-by">
                                            <label>Sort by:</label>
                                            <form class="woocommerce-ordering live-form" method="get">
                                                <select name="orderby" class="orderby">
                                                    <option value="menu_order" selected="selected">Position</option>
                                                    <option value="price-low">Price: Lowest first</option>
                                                    <option value="price-high">Price: Highest first</option>
                                                    <option value="name-a">Product Name: A to Z</option>
                                                    <option value="name-z">Product Name: Z to A</option>
                                                    <option value="onStock">In stock</option>
                                                    <option value="refer-low">Reference: Lowest first</option>
                                                    <option value="refer-high">Reference: Highest first</option>
                                                </select>
                                            </form>
                                        </div>
                                    </div>
                                    
                                    <!-- Number of items in page -->
                                    <div class="col-lg-2 col-md-3 col-sm-6 col-xs-5">
                                        <div class="itemnum-wrap">
                                            <label>Show:</label>
                                            <form name="itemPage" action="#" method="get" class="itemPage liveform">
                                                <select name="numberItem">
                                                    <option value="12" selected="selected">12</option>
                                                    <option value="24">24</option>
                                                </select>
                                            </form>
                                        </div>
                                    </div>
                                    
                                    <!-- Pagination -->
                                    <div class="col-lg-4 col-md-3 col-sm-6 col-xs-7 pagination-wrap">
                                        <label>Page:</label>
                                        <div class="paginations">
                                            <a class="current" href="#">1</a>
                                            <a href="#">2</a>
                                            <a href="#">3</a>
                                            <a href="#">4</a>
                                            <a href="#">5</a>
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
    <!-- Main Wrap End -->
    <?php $this->load->view('footer'); ?>
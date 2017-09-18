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
                                                <div onclick="filter()" id="price_ranger" class="price-ranger ui-ranger" data-min="<?php echo $minMax['minimum']; ?>" data-max="<?php echo $minMax['maximum']; ?>"></div>
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
                                                                <input class="shape" id="<?php echo ucfirst($productShape['id']); ?>" type="checkbox" name="shape">
                                                            </div>
                                                            <label class="filter-label"><?php echo ucfirst($productShape['shapeName']); ?> <span class="numofitems">(<?php echo $productShape['count']; ?>)</span></label>
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

                                                            <div class="input-rule check">
                                                                <span class="input-style"></span>
                                                                <input class="color" id="<?php echo $productColor['id']; ?>" type="checkbox" name="color" class="color">
                                                            </div>
                                                            <label class="filter-label" style="color: <?php echo $productColor['colorCode']; ?> !important"><?php echo ucfirst($productColor['colorName']); ?> <span class="numofitems">(<?php echo $productColor['count']; ?>)</span>
                                                            </label>

                                                            
                                                        </div>
                                                    <?php } ?>    
                                                <?php } ?>    
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Category filter -->
                                        <div class="layered-filter">
                                            <h4 class="filter-title">Category</h4>
                                            <div class="filter-content">
                                                <div class="input-row">
                                                    <?php if(count($productCategory) > 0){ ?>
                                                        <?php foreach ($productCategory as $productCategory) { ?>
                                                        <div class="input-col-2">
                                                            <div class="input-rule check">
                                                                <span class="input-style"></span>
                                                                <input class="category" id="<?php echo ucfirst($productCategory['id']); ?>" type="checkbox" name="category">
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
                                                            <input id="stock" class="stock" type="checkbox" name="stock" value="stock">
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
                                <?php $this->load->view('product_list'); ?>
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
                                            <a href="#">5</a>
                                            <a href="#">5</a>
                                            <a href="#">5</a>
                                            <a href="#">5</a>
                                            <a href="#">5</a>
                                            <a href="#">5</a>
                                            <a href="#">5</a>
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
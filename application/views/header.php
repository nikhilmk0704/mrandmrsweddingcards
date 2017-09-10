<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Metas -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mr & Mrs Wedding Cards</title>
    <meta name="description" content="Monaco is Responsive eCommerce Template">
    
    <!-- External CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/owl.carousel.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/responsive.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery.toast.css">
    
    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css6079.css?family=Poppins:300,400,500,600,700" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" href="<?php echo base_url(); ?>images/template/color-1/favicon.png">
	<link rel="apple-touch-icon" href="<?php echo base_url(); ?>images/template/color-1/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url(); ?>images/template/color-1/icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url(); ?>images/template/color-1/icon-114x114.png">
	
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="<?php echo base_url(); ?>assets/js/html5shiv.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/js/respond.min.js"></script>
    <![endif]-->
</head>

<body>
  
    <!-- Top Header Start -->
    <header id="top-header" class="top-header">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-5 col-xs-4">
                    <div class="top-block account-menu-block mobile-selector">
                        <div class="mobile-selected">Login</div>
                        <ul id="account-menu" class="menu account-menu mobile-select">
                            <li><a id="loginIcon" data-toggle="modal" data-target="#loginModal">Login</a></li>
                            <li><a id="registerIcon" data-toggle="modal" data-target="#registerModal">Register</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-8">
                    <div class="top-block welcome-block">
                        <p class="welcome-message">Welcome Mr & Mrs Wedding Cards!</p>
                    </div>
                </div>
                <?php if($this->session->userdata("userloggedin")){ ?>
                <div class="col-md-4 col-sm-3">
                    <div class="top-block localize-block">
                        <div class="currency-selector top-selector">
                            <div class="currency-selected top-selected"><span><?php echo ucfirst($this->session->userdata('firstName') . " " . $this->session->userdata('lastName')); ?></span><i class="fa fa-angle-down"></i></div>
                            <ul id="currency-select" class="top-select currency-select">
                                <li><a href="#">Wishlist</a></li>
                                <li><a href="#">Orders</a></li>
                                <li><a href="<?php echo base_url('logout'); ?>">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </header>
    <!-- Top Header End -->
    
    <!-- Login Modal -->
    <div id="loginModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Login</h4>
          </div>
          <div class="modal-body">
            <form id="signinForm" class="basicfields account-form" action="#" method="post">
                <input type="email" name="email_login" id="email_login" placeholder="Email address">
                <input type="password" name="password_login" id="password_login" placeholder="Password">
                <a onclick="toggleLoginPop()" class="resetlink">Register</a><br><br>
                <button type="button" onclick="login();" class="btn"><i class="fa fa-lock" aria-hidden="true"></i> Sign in</button>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>
    <!-- Login Modal -->
    

    <!-- Regitser Modal -->
    <div id="registerModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Register</h4>
          </div>
          <div class="modal-body">
            <form id="signupForm" class="basicfields account-form" action="#" method="post">
                <div class="row">
                    <div class="col-md-12 registerFormMain">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="firstName" id="firstName" placeholder="First Name">
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" id="email" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" id="password" placeholder="Password">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="lastName" id="lastName" placeholder="Last Name">
                            </div>
                            <div class="form-group">
                                <input type="text" name="phone" id="phone" placeholder="Phone Number">
                            </div>
                            <div class="form-group">
                                <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirm Password">
                            </div>
                        </div>
                            <button type="button" onclick="register()" class="btn"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> REGISTER</button>
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
    <!-- Regitser Modal -->
    <!-- Main header start -->
    <header id="main-header" class="main-header">
        <nav class="navbar navbar-default">
            <div class="container">
            
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-navigation" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo base_url('home'); ?>"><img src="images/template/color-1/logo.png" alt="Site Logo" height="100"></a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="main-navigation">
                    <ul class="nav navbar-nav navbar-center">   
                        <li <?php if($this->uri->segment(1)=='home'){ ?> class="active" <?php } ?>>
                            <a href="<?php echo base_url('home'); ?>">Home</a>
                        </li>
                        <li>
                            <a href="index.html">About</a>
                        </li>
                        <li><a href="contact.html">Contact</a></li>
                        <li>
                            <a href="index.html">Custom Cards</a>
                        </li>         
                    </ul>
              
                    <div class="nav navbar-nav navbar-right">
                        <div class="block-minicart">
                            <a href="cart.html" class="cartlink">
                                <i class="fa fa-shopping-bag"></i>
                                <span class="cart-sub">
                                    <span class="cart-subtotal"> 2 items</span> -
                                    <span class="cart-subtotalprice">$29.33</span>
                                </span>
                            </a>
                            <div class="on-minicart">
                                <dl class="cart-products">
                                    <dt class="cart-product">
                                        <a class="cart-thumb" href="#">
                                            <img src="images/product/s1.jpg" alt="Cart Thumb">
                                        </a>
                                        <div class="cart-info">
                                            <div class="product-name">
                                                <span class="quantity-formated">
                                                    <span class="quantity">1</span>x
                                                </span>
                                                <a href="#">Funnky hight</a>
                                            </div>
                                            <div class="product-attributes">
                                                <a href="#">S, Beige</a>
                                            </div>
                                            <span class="price">$50.99</span>
                                        </div>
                                        <span class="remove-link">
                                            <a href="#"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                                        </span>
                                    </dt>
                                    <dd></dd>
                                    <dt class="cart-product">
                                        <a class="cart-thumb" href="#">
                                            <img src="images/product/s2.jpg" alt="Cart Thumb">
                                        </a>
                                        <div class="cart-info">
                                            <div class="product-name">
                                                <span class="quantity-formated">
                                                    <span class="quantity">1</span>x
                                                </span>
                                                <a href="#">Funnky hight</a>
                                            </div>
                                            <div class="product-attributes">
                                                <a href="#">S, Beige</a>
                                            </div>
                                            <span class="price">$35</span>
                                        </div>
                                        <span class="remove-link">
                                            <a href="#"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                                        </span>
                                    </dt>
                                    <dd></dd>
                                </dl>
                                <p class="cart-no-product">No products</p>
                                <div class="cart-prices">
                                    <div class="cart-fee-wrap cart-shipping-fee">
                                        <span class="cart-text">Shipping</span>
                                        <span class="cart-fee price">$2.00</span>
                                    </div>
                                    <div class="cart-fee-wrap cart-total-fee">
                                        <span class="cart-text">Total</span>
                                        <span class="cart-fee price">$120.49</span>
                                    </div>
                                </div>
                                <div class="cart-checkout">
                                    <a href="#" class="btn checkout-btn">Check out<i class="fa fa-angle-right right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
    </header>
    <!-- Main header end -->
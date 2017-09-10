    <!-- Footer Start -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="display-flex">
                    <div class="col-md-3 hidden-sm hidden-xs">
                        <div class="footer-side-image"><img src="images/junk/2.png" alt="Footer Side Image"></div>
                    </div>
                    <div class="col-md-9">
                        <div class="footer-widgets">
                            <div class="row">
                                <div class="col-md-4 col-sm-6">
                                    <div class="widget about-widget">
                                        <a class="footer-logo" href="home-1.html"><img src="images/template/color-1/logo-white.png" alt="Footer Logo"></a>
                                        <p class="about-txt">Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim</p>
                                        <div class="about-items">
                                            <div class="about-item">
                                                <div class="display-flex">
                                                    <div class="about-icon"><i class="fa fa-map-marker"></i></div>
                                                    <p class="about-content">123 Main Street, Anytown,<br/>CA 12345 USA</p>
                                                </div>
                                            </div>
                                            <div class="about-item">
                                                <div class="display-flex">
                                                    <div class="about-icon"><i class="fa fa-phone"></i></div>
                                                    <p class="about-content">+1 800 123 1234</p>
                                                </div>
                                            </div>
                                            <div class="about-item">
                                                <div class="display-flex">
                                                    <div class="about-icon"><i class="fa fa-envelope"></i></div>
                                                    <p class="about-content">contact@company.com</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="widget recent-post-widget">
                                        <h4 class="widget-title">Recent Posts</h4>
                                        <div class="widget-inner">
                                            <div class="recent-posts">
                                                <div class="recent-post">
                                                    <a class="widget-thumb" href="blog-single.html">
                                                        <img src="images/blog/s1.jpg" alt="Widget Thumb">
                                                    </a>
                                                    <div class="recent-post-content">
                                                        <p>Lorem ipsum dolor sit amet, consectetuer adipic cing elit.</p>
                                                    </div>
                                                </div>
                                                <div class="recent-post">
                                                    <a class="widget-thumb" href="blog-single.html">
                                                        <img src="images/blog/s2.jpg" alt="Widget Thumb">
                                                    </a>
                                                    <div class="recent-post-content">
                                                        <p>Lorem ipsum dolor sit amet, consectetuer adipic cing elit.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="widget newsletter-widget">
                                        <h4 class="widget-title">Newsletter</h4>
                                        <div class="widget-inner">
                                            <p>Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit</p>
                                            <form id="subscribeForm" class="subscribe-form" action="#" method="post">
                                                <input type="email" name="email" placeholder="Enter your email" required>
                                                <button type="submit" name="emailsubmit">Subscribe</button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="widget social-widget">
                                        <h4 class="widget-title">Social Media</h4>
                                        <div class="widget-inner">
                                            <div class="socials">
                                                <a href="#" class="social facebook"><i class="fa fa-facebook"></i></a>
                                                <a href="#" class="social twitter"><i class="fa fa-twitter"></i></a>
                                                <a href="#" class="social gplus"><i class="fa fa-google-plus"></i></a>
                                                <a href="#" class="social pinterest"><i class="fa fa-pinterest"></i></a>
                                                <a href="#" class="social linkedin"><i class="fa fa-linkedin"></i></a>
                                                <a href="#" class="social skype"><i class="fa fa-skype"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="footer-copyright">
                            <div class="row">
                                <div class="display-flex">
                                    <div class="col-sm-6">
                                        <p class="copyright">Copyright &copy; 2017 <a href="https://themeforest.net/user/codechant">Code Chant</a>. All rights reserved.</p>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="payments">
                                            <a href="#" class="payment"><img src="images/payment/1.png" alt="Payment"></a>
                                            <a href="#" class="payment"><img src="images/payment/2.png" alt="Payment"></a>
                                            <a href="#" class="payment"><img src="images/payment/3.png" alt="Payment"></a>
                                            <a href="#" class="payment"><img src="images/payment/4.png" alt="Payment"></a>
                                            <a href="#" class="payment"><img src="images/payment/5.png" alt="Payment"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer End -->
    
    <!-- JS Plugins -->
    <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/owl.carousel.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.countdown.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/custom.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.validate.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootbox.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.toast.js"></script>
    <script type="text/javascript">
        $( "#signupForm" ).validate( {
                rules: {
                    firstName: "required",
                    lastName: "required",
                    password: {
                        required: true,
                    },
                    confirmPassword: {
                        required: true,
                        equalTo: "#password"
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    phone: {
                        required: true,
                        number: true,
                        minlength:10
                    }
                },
                messages: {
                    firstName: "Please enter your firstname",
                    lastName: "Please enter your lastname",
                    password: {
                        required: "Please provide a password",
                    },
                    confirmPassword: {
                        required: "Please provide a password",
                        equalTo: "Please enter the same password as above"
                    },
                    email: "Please enter a valid email address",
                    phone: "Please enter a valid phone number"
                },
                errorElement: "em",
                errorPlacement: function ( error, element ) {
                    // Add the `help-block` class to the error element
                    error.addClass( "help-block" );

                    error.insertAfter( element );
                    
                },
                highlight: function ( element, errorClass, validClass ) {
                    $( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
                },
                unhighlight: function (element, errorClass, validClass) {
                    $( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
                }
            } );

        function register(){
            if ($( "#signupForm" ).valid()) {
                $.ajax({
                url: "<?php echo site_url('register');?>",
                type: 'post',
                dataType: 'json',
                data: {
                    firstName: $('#firstName').val(),
                    lastName: $('#lastName').val(),
                    password: $('#password').val(),
                    email: $('#email').val(),
                    phone: $('#phone').val()
                },
                success: function (data) {
                    if(data=='1'||data==1){
                        location.reload();
                    }else if(data=='0'||data==0){
                        $.toast({
                            heading: 'Error',
                            text: 'User registration failed!',
                            position: 'top-right',
                            stack: false
                        })

                    }else if(data=='2'||data==2){
                        $.toast({
                            heading: 'Error',
                            text: 'User registration failed! Email address already Exists.',
                            position: 'top-right',
                            stack: false
                        })

                    }
                }
                });
            }
        }

        function toggleLoginPop(){
           $('#loginModal').modal('toggle');
           $('#registerModal').modal('toggle'); 
        }

        $( "#signinForm" ).validate( {
                rules: {
                    password_login: {
                        required: true,
                    },
                    email_login: {
                        required: true,
                        email: true
                    }
                },
                messages: {
                    password_login: {
                        required: "Please provide a password",
                    },
                    email_login: "Please enter a valid email address",
                },
                errorElement: "em",
                errorPlacement: function ( error, element ) {
                    // Add the `help-block` class to the error element
                    error.addClass( "help-block" );

                    error.insertAfter( element );
                    
                },
                highlight: function ( element, errorClass, validClass ) {
                    $( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
                },
                unhighlight: function (element, errorClass, validClass) {
                    $( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
                }
            } );

        function login(){
            if ($( "#signinForm" ).valid()) {
                $.ajax({
                url: "<?php echo site_url('login');?>",
                type: 'post',
                dataType: 'json',
                data: {
                    password_login: $('#password_login').val(),
                    email_login: $('#email_login').val()                },
                success: function (data) {
                   if(data=='1'||data==1){
                        location.reload();
                    }else if(data=='0'||data==0){
                        $.toast({
                            heading: 'Error',
                            text: 'Email and Password not matching',
                            position: 'top-right',
                            stack: false
                        })

                    }
                }
                });
            }

        }

        function addToCart(productId,quantity){
            var loginStatus =  '<?php echo $this->session->userdata("userloggedin")?>';
            if(loginStatus=='1'){
                $('#addToCart').modal('toggle');
                //alert(<?php echo $this->session->userdata("id")?>);
            }else{
                $('#loginModal').modal('toggle');
            }

        }

    </script>
</body>
</html>
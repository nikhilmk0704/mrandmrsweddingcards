<?php $this->load->view('header'); ?>
<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
<div class="menu-toggler sidebar-toggler"></div>
<!-- END SIDEBAR TOGGLER BUTTON -->
<!-- BEGIN LOGO -->
<div class="logo"><a href="#"> <img src="<?php echo base_url(); ?>assets/admin/layout/img/logo-white.png" alt=""/>
    </a></div>
<!-- END LOGO -->
<!-- BEGIN LOGIN -->
<div class="content">
    <input type="hidden" id="baseurl" name="baseurl" value="<?php echo base_url(); ?>"/>
    <!-- BEGIN LOGIN FORM -->
    <form class="login-form" method="post">
        <h3 class="form-title">Sign In</h3>
        <span class="help-block"></span>

        <div class="alert alert-danger display-hide">
            <button class="close" data-close="alert"></button>
            <span id="errorMsg">Enter valid user email and password.</span></div>
        <div class="form-group">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">User Email</label>
            <input class="form-control form-control-solid placeholder-no-fix" id="usermail" type="email"
                   autocomplete="off" placeholder="User Email" name="usermail"/>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Password</label>
            <input class="form-control form-control-solid placeholder-no-fix" type="password" id="password"
                   autocomplete="off" placeholder="Password" name="password"/>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-success uppercase">Login</button>
    </form>
    <!-- END LOGIN FORM -->
    <!-- BEGIN FORGOT PASSWORD FORM -->
    <form class="forget-form" action="#" method="post">
        <h3>Forget Password ?</h3>

        <p> Enter your e-mail address below to reset your password. </p>

        <div class="form-group">
            <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email"
                   name="email"/>
        </div>
        <div class="form-actions">
            <button type="button" id="back-btn" class="btn btn-default">Back</button>
            <button type="submit" class="btn btn-success uppercase pull-right">Submit</button>
        </div>
    </form>
    <!-- END FORGOT PASSWORD FORM -->

</div>
<div class="copyright"> 2017 © Mr&Mrs</div>
<?php $this->load->view('footer'); ?>
<script>
    jQuery(document).ready(function () {
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        Login.init();
        Demo.init();
    });
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
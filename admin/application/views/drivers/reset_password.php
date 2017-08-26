<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>
    <title>Reset Password</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
          type="text/css">
    <link href="<?php echo base_url(); ?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet"
          type="text/css">
    <link href="<?php echo base_url(); ?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css"
          rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"
          type="text/css">
    <link href="<?php echo base_url(); ?>assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet"
          type="text/css">
    <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css"
          rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN THEME STYLES -->
    <link href="<?php echo base_url(); ?>assets/global/css/components-rounded.css" id="style_components"
          rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/admin/layout4/css/layout.css" rel="stylesheet" type="text/css"/>
    <link id="style_color" href="<?php echo base_url(); ?>assets/admin/layout4/css/themes/light.css" rel="stylesheet"
          type="text/css"/>
    <!-- END THEME STYLES -->
    <link rel="shortcut icon" href="favicon.ico"/>
</head>
<body class="page-header-fixed page-sidebar-closed-hide-logo ">
<!-- BEGIN CONTAINER -->
<div class="page-container">
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-6" style="float:none;margin:0 auto;">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box grey-cascade">
                    <div class="portlet-title">
                        <div class="caption"><i class="fa fa-globe"></i>Update Password</div>
                    </div>
                    <div class="portlet-body">
                        <form class="form-horizontal" role="form" id="default">
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">New Password</label>

                                    <div class="col-md-9">
                                        <input type="password" id="password" name="password"
                                               class="form-control input-inline input-medium" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Confirm Password</label>

                                    <div class="col-md-9">
                                        <input type="password" id="password_confirm" name="password_confirm"
                                               class="form-control input-inline input-medium" placeholder="">
                                    </div>
                                </div>
                                <input type="hidden" id="userid" value="<?php echo $details['user_id']; ?>">

                                <div class="form-group">
                                    <div class="col-lg-offset-3 col-lg-9">
                                        <button type="button" class="btn green" onclick="updatePassword();">Save
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>

    </div>
    <!-- END CONTENT -->
</div>
<?php $this->load->view('footer'); ?>
<script type="text/javascript">
    jQuery.validator.setDefaults({debug: true});
    var form = $("#default");

    form.validate({
        errorElement: "label",
        errorClass: "font-red-haze",
        rules: {
            'password_confirm': {required: true, equalTo: '#password'},
            'password': {required: true}
        },
        messages: {
            'password': {required: 'Please enter password'},
            'password_confirm': {required: 'Please confirm password', equalTo: 'Password not matching'},
        },

    });
    function updatePassword() {
        if (form.valid()) {
            $.ajax({
                url: "<?php echo site_url('drivers/drivers/passwordUpdate');?>",
                type: 'post',
                dataType: 'json',
                data: {
                    password: $('#password').val(),
                    userid: $('#userid').val()
                },

                success: function (data) {
                    if (data == 1) {
                        window.location = "<?php echo site_url('login'); ?>";
                    }
                }
            });
        }

    }

</script>
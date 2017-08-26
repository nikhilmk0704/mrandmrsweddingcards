<!DOCTYPE html>
<html lang="en">
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>
    <title>Mr&Mrs-Admin</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta content="" name="description"/>
    <meta content="" name="author"/>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css"
          rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet"
          type="text/css"/>

    <!--NOT LOGIN-->
    <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css"
          rel="stylesheet" type="text/css"/>
    <!--NOT LOGIN-->

    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE STYLES(LOGIN) -->
    <link href="<?php echo base_url(); ?>assets/admin/pages/css/login.css" rel="stylesheet" type="text/css"/>
    <!-- END PAGE LEVEL SCRIPTS -->

    <!-- BEGIN PAGE STYLES(CRUD VIEW) -->
    <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css"
          rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css"
          href="<?php echo base_url(); ?>assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/global/plugins/select2/select2.css"/>
    <link rel="stylesheet" type="text/css"
          href="<?php echo base_url(); ?>assets/global/plugins/jstree/dist/themes/default/style.min.css"/>
    <!-- END PAGE LEVEL SCRIPTS -->
    <link rel="stylesheet" type="text/css"
          href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css"/>
    <!-- BEGIN THEME STYLES -->
    <link href="<?php echo base_url(); ?>assets/global/css/components-rounded.css" id="style_components"
          rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
    <?php $strurl = $this->uri->uri_string();
    if ($strurl == '' || $strurl == 'login') {
        ?>
        <link href="<?php echo base_url(); ?>assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>assets/admin/layout/css/themes/default.css" rel="stylesheet"
              type="text/css" id="style_color"/>
        <link href="<?php echo base_url(); ?>assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
    <?php } else { ?>
        <link href="<?php echo base_url(); ?>assets/admin/layout4/css/layout.css" rel="stylesheet" type="text/css"/>
        <link id="style_color" href="<?php echo base_url(); ?>assets/admin/layout4/css/themes/light.css"
              rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>assets/admin/layout4/css/custom.css" rel="stylesheet" type="text/css"/>
    <?php } ?>

    <link rel="stylesheet" type="text/css"
          href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/css/datepicker3.css"/>
    <!-- END THEME STYLES -->
    <link rel="shortcut icon" href="favicon.ico"/>
</head>
<?php
$chk_user = '';
if ($strurl != '') {
    $uri_array = $this->uri->segment_array();
    $chk_user = end($uri_array);
}
?>

<body <?php if ($strurl == '' || $strurl == 'login' || $chk_user == 'check_user') { ?> class="login" <?php } else { ?>class="page-header-fixed page-sidebar-closed-hide-logo page-sidebar-closed-hide-logo"<?php } ?>>
<?php $strurl = $this->uri->uri_string();
if ($strurl != '' && $strurl != 'login' && $chk_user != 'check_user') {
    ?>
    <!-- BEGIN HEADER -->
    <div class="page-header navbar navbar-fixed-top">
        <!-- BEGIN HEADER INNER -->
        <div class="page-header-inner">
            <!-- BEGIN LOGO -->
            <div class="page-logo"><a href="<?php echo site_url('dashboard'); ?>"> <img
                        src="<?php echo base_url(); ?>assets/admin/layout/img/logo-black.png" alt="logo"
                        class="logo-default" height="70"/> </a>

                <div class="menu-toggler sidebar-toggler">
                    <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
                </div>
            </div>
            <!-- END LOGO -->
            <!-- BEGIN RESPONSIVE MENU TOGGLER -->
            <a href="javascript:" class="menu-toggler responsive-toggler" data-toggle="collapse"
               data-target=".navbar-collapse"> </a>
            <!-- END RESPONSIVE MENU TOGGLER -->
            <!-- BEGIN PAGE TOP -->
            <div class="page-top">

                <!-- BEGIN TOP NAVIGATION MENU -->
                <div class="top-menu">
                    <ul class="nav navbar-nav pull-right">
                        <li class="separator hide"></li>
                        <!-- BEGIN TODO DROPDOWN -->
                        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                        <!-- BEGIN USER LOGIN DROPDOWN -->
                        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                        <li class="dropdown dropdown-user dropdown-dark"><a href="#" class="dropdown-toggle"
                                                                            data-toggle="dropdown" data-hover="dropdown"
                                                                            data-close-others="true"> <span
                                    class="username username-hide-on-mobile">  <?php echo ucfirst($this->session->userdata('firstName') . " " . $this->session->userdata('lastName')); ?> </span>
                                <!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used -->
                                <img alt="" class="img-circle"
                                     src="<?php echo base_url(); ?>assets/admin/layout4/img/avatar.png"/> </a>
                            <ul class="dropdown-menu dropdown-menu-default">
                                <li><a href="<?php echo site_url('logout'); ?>"> <i class="icon-key"></i> Log Out
                                    </a></li>
                            </ul>
                        </li>
                        <!-- END USER LOGIN DROPDOWN -->
                    </ul>
                </div>
                <!-- END TOP NAVIGATION MENU -->
            </div>
            <!-- END PAGE TOP -->
        </div>
        <!-- END HEADER INNER -->
    </div>
    <!-- END HEADER -->
    <div class="clearfix"></div>
<?php } ?>
</div>
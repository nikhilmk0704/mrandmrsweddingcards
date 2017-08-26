<?php $this->load->view('header'); ?>
<!-- BEGIN CONTAINER -->
<div class="page-container">
    <!-- BEGIN SIDEBAR -->
    <?php $this->load->view('menu'); ?>
    <!-- END SIDEBAR -->
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <div class="page-content">
            <!-- BEGIN PAGE HEAD -->
            <div class="page-head">
                <!-- BEGIN PAGE TITLE -->
                <div class="page-title">
                    <h1>Dashboard
                        <small>statistics & reports</small>
                    </h1>
                </div>
            </div>     
            <div class="row margin-top-10">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat2">
                        <div class="display">
                            <div class="number">
                                <h3 class="font-black-sharp"><?php echo $superAdminData['totalSale']; ?>
                                    <small class="font-black-sharp">$</small>
                                </h3>
                                <small>TOTAL SALE</small>
                            </div>
                            <div class="icon">
                                <i class=" icon-basket"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat2">
                        <div class="display">
                            <div class="number">
                                <h3 class="font-green-sharp"><?php echo $superAdminData['totalProfits']; ?>
                                    <small class="font-green-sharp">$</small>
                                </h3>
                                <small>TOTAL PROFIT</small>
                            </div>
                            <div class="icon">
                                <i class="icon-pie-chart"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat2">
                        <div class="display">
                            <div class="number">
                                <h3 class="font-red-haze"><?php echo $superAdminData['expense']; ?>
                                <small class="font-red-haze">$</small>
                                </h3>
                                <small>NEW EXPENSES</small>
                            </div>
                            <div class="icon">
                                <i class="icon-calculator"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat2">
                        <div class="display">
                            <div class="number">
                                <h3 class="font-blue-sharp"><?php echo $superAdminData['totalTrip']; ?></h3>
                                <small>TRIPS</small>
                            </div>
                            <div class="icon">
                                <i class="icon-compass"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat2">
                        <div class="display">
                            <div class="number">
                                <h3 class="font-purple-soft"><?php echo $superAdminData['totalUsers']; ?></h3>
                                <small>USERS</small>
                            </div>
                            <div class="icon">
                                <i class="icon-user"></i>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat2">
                        <div class="display">
                            <div class="number">
                                <h3 class="font-purple-soft"><?php echo $superAdminData['driversData']['totalDrivers']; ?></h3>
                                <small>TOTAL DRIVERS</small>
                            </div>
                            <div class="icon">
                                <i class="icon-user"></i>
                            </div>
                        </div>
                    </div>
                </div>
            
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat2">
                        <div class="display">
                            <div class="number">
                                <h3 class="font-green-sharp"><?php echo $superAdminData['driversData']['onlineDrivers']; ?></h3>
                                <small>ONLINE DRIVERS</small>
                            </div>
                            <div class="icon">
                                <i class="icon-user"></i>
                            </div>
                        </div>
                    </div>
                </div>
        
            
             <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat2">
                        <div class="display">
                            <div class="number">
                                <h3 class="font-red-haze"><?php echo $superAdminData['driversData']['pendingRegistration']; ?></h3>
                                <small>PENDING DRIVERS</small>
                            </div>
                            <div class="icon">
                                <i class="icon-user"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <!-- BEGIN PORTLET-->
                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption caption-md">
                                <i class="icon-bar-chart theme-font-color hide"></i>
                                <span class="caption-subject theme-font-color bold uppercase">Sales Summary</span>
                                <span class="caption-helper hide">weekly stats...</span>
                            </div>
                            <div class="actions">
                                <div class="btn-group btn-group-devided" data-toggle="buttons">
                                    <label class="btn btn-transparent grey-salsa btn-circle btn-sm" onclick="getFilteredData(1);">
                                        <input type="radio" name="options1" class="toggle" id="option1">Today</label>
                                    <label class="btn btn-transparent grey-salsa btn-circle btn-sm" onclick="getFilteredData(2);">
                                        <input type="radio"  name="options2" class="toggle" id="option2">Week</label>
                                    <label class="btn btn-transparent grey-salsa btn-circle btn-sm" onclick="getFilteredData(3);">
                                        <input type="radio"  name="options3" class="toggle" id="option3">Month</label>
                                </div>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="row list-separated">
                                <div class="col-md-3 col-sm-3 col-xs-6">
                                    <div class="font-grey-mint font-sm">
                                        Total Sales
                                    </div>
                                    <div class="uppercase font-hg font-black-flamingo">
                                        <span id="totalSale"><?php echo $superAdminData['totalSale']; ?></span><span class="font-lg font-grey-mint">$</span>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-6">
                                    <div class="font-grey-mint font-sm">
                                        Profit
                                    </div>
                                    <div class="uppercase font-hg theme-font-color">
                                        <span id="profit"><?php echo $superAdminData['totalProfits']; ?></span><span class="font-lg font-grey-mint">$</span>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-6">
                                    <div class="font-grey-mint font-sm">
                                        Expenses
                                    </div>
                                    <div class="uppercase font-hg font-purple">
                                        <span id="expenses"><?php echo $superAdminData['expense']; ?></span> <span class="font-lg font-grey-mint">$</span>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-6">
                                    <div class="font-grey-mint font-sm">
                                        Total Trips
                                    </div>
                                    <div class="uppercase font-hg font-green">
                                        <span id="totaltrips"><?php echo $superAdminData['totalTrip']; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END PORTLET-->
                </div>
            </div>
            <!-- END PAGE CONTENT INNER -->
        </div>
   
    <!-- END CONTENT -->
</div>
</div>
</div>

<!-- END CONTAINER -->
<?php $this->load->view('footer'); ?>
<script>

    function getFilteredData(value){

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('dashboard/filterData');  ?>",
            dataType : "json",
            data: {
                type: value
            },
            success: function (msg) {
                $("#totalSale").html(msg.totalSale);
                $("#profit").html(msg.totalProfits);
                $("#expenses").html(msg.expense);
                $("#totaltrips").html(msg.totalTrip);

            }
        });

    }


</script>
</body>
</html>
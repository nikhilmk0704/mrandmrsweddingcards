<?php $this->load->view('header'); ?>
<div class="page-container">
    <!-- BEGIN SIDEBAR -->
    <?php $this->load->view('menu'); ?>
    <!-- END SIDEBAR -->
    <div id="editview"></div>
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <!-- BEGIN PAGE HEAD -->
            <div class="page-head">
                <!-- BEGIN PAGE TITLE -->
                <div class="page-title">
                    <h1>Vendor Payment</h1>
                </div>
                <!-- END PAGE TITLE -->
            </div>
            <!-- END PAGE HEAD -->
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <div class="tab-content">
                <div class="tab-pane active" id="tab_0">
                    <div class="portlet box green">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-gift"></i>Select Vendor and Date Range
                            </div>

                        </div>
                        <div class="portlet-body form">
                            <!-- BEGIN FORM-->
                            <form class="form-horizontal" role="form" id="default1">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Vendor</label>

                                        <div class="col-md-9">
                                            <select id="vendor" name="vendor"
                                                    class="form-control input-inline input-medium select2me">
                                                <option value="0">Select</option>

                                                <?php if ($vendorList != 0) { ?>
                                                    <?php foreach ($vendorList as $vendorList) { ?>
                                                        <?php if ($vendorList['status'] == '1' || $vendorList['status'] == 1) { ?>
                                                            <option
                                                                value="<?php echo $vendorList['user_id']; ?>"><?php echo $vendorList['firstname'] . " " . $vendorList['lastname']; ?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Date Range</label>

                                        <div class="col-md-4">
                                            <div class="input-group input-large date-picker input-daterange"
                                                 data-date="" data-date-format="mm/dd/yyyy">
                                                <input type="text" class="form-control" name="from" id="from">
												<span class="input-group-addon">
												to </span>
                                                <input type="text" class="form-control" name="to" id="to">
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div style="float: left" class="col-md-offset-3 col-md-9">
                                            <button type="button" onclick="getRevenueData();"
                                                    class="btn btn-circle blue">Get Revenue Details
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- END FORM-->
                        </div>
                    </div>


                </div>

                <div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div class="portlet box grey-cascade">
                            <div class="portlet-title">
                                <div class="caption"><i class="fa fa-globe"></i>Payment List</div>
                                <div class="tools"></div>
                            </div>
                            <div class="portlet-body" id="sample_1_tbody">


                            </div>
                        </div>
                        <!-- END EXAMPLE TABLE PORTLET-->
                    </div>
                </div>
                <div class="tab-pane active" id="tab_1">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-gift"></i>Pay Vendor
                            </div>

                        </div>
                        <div class="portlet-body form">
                            <!-- BEGIN FORM-->
                            <form class="form-horizontal" role="form" id="default1">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Payment Amount</label>

                                        <div class="col-md-4">


                                            <input type="text" id="totalRevenue" name="totalRevenue"
                                                   class="form-control input-small removeLater" value="0" readonly>
                                        </div>


                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">SCT Commission</label>

                                        <div class="col-md-4">
                                            <input type="text" id="sctCommission" name="sctCommission"
                                                   class="form-control input-small" value="0" readonly>
                                            <label class="control-label">SCT Commission in %</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Commission Deducted</label>

                                        <div class="col-md-4">
                                            <input type="text" id="commissionDeducted" name="commissionDeducted"
                                                   class="form-control input-small removeLater" value="0" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Amount Payable</label>

                                        <div class="col-md-4" id="payable">
                                            <input type="text" id="payableamt" name="payableamt"
                                                   class="form-control input-small removeLater" value="0" readonly>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="vehicle_Id" name="vehicle_Id"
                                       class="form-control input-small removeLater1">

                                <div class="form-actions">
                                    <div class="row">
                                        <div style="float: left" class="col-md-offset-3 col-md-9">
                                            <button type="button" class="btn btn-circle green" onclick="updateRow()">Pay
                                                Vendor
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- END FORM-->
                        </div>
                    </div>

                </div>
                <!-- END PAGE CONTENT-->
            </div>
        </div>
        <!-- END CONTENT -->
    </div>
    <!-- END CONTAINER -->

    <?php $this->load->view('footer'); ?>

    <script>
        function addPaymnet(ob) {
            if (document.getElementById(ob.id).checked) {
                var amount = parseFloat(ob.value);
                var currentAmount = parseFloat($("#totalRevenue").val());
                var amountNow = currentAmount + amount;
                $("#totalRevenue").val(amountNow.toFixed(1));
                var commission = $("#sctCommission").val();
                var payablecommission = amountNow * (commission / 100);
                $("#commissionDeducted").val(payablecommission.toFixed(1));
                var payingAmount = amountNow - payablecommission;
                $("#payableamt").val(payingAmount.toFixed(1));

                var vehicle_id = $("#vehicle_Id").val();

                if ($("#vehicle_Id").val() == '') {

                    vehicle_id = ob.id;

                } else {

                    vehicle_id = vehicle_id + '|' + ob.id;

                }
                $("#vehicle_Id").val(vehicle_id);
            } else {
                var amount = parseFloat(ob.value);
                var currentAmount = parseFloat($("#totalRevenue").val());
                var amountNow = currentAmount - amount;
                $("#totalRevenue").val(amountNow.toFixed(1));
                var commission = $("#sctCommission").val();
                var payablecommission = amountNow * (commission / 100);
                $("#commissionDeducted").val(payablecommission.toFixed(1));
                var payingAmount = amountNow - payablecommission;
                $("#payableamt").val(payingAmount.toFixed(1));

                var ids = $("#vehicle_Id").val();
                var idArray = ids.split('|');
                var data_new = '';
                for (i = 0; i < idArray.length; i++) {
                    if (idArray[i] == ob.id) {
                        status = 'remove';
                    } else {
                        if (data_new == '') {
                            data_new = idArray[i];
                        } else {
                            data_new = data_new + '|' + idArray[i];
                        }
                    }
                }
                $("#vehicle_Id").val(data_new);
            }
        }


        $.validator.addMethod("select_valid_vendor", function (value, element) {
            if (value != 0) {
                return 'true';
            }
        }, "Select a vendor");
        function getRevenueData() {
            var form_update = $("#default1");
            form_update.validate({
                errorElement: "label",
                errorClass: "font-red-haze",
                rules: {
                    'vendor': {select_valid_vendor: true},
                    'from': {required: true},
                    'to': {required: true}
                },
                messages: {
                    'vendor': {select_valid_vendor: 'Please select vendor.'},
                    'from': {required: 'Please enter from date.'},
                    'to': {required: 'Please enter to date.'}
                }
            });
            if (form_update.valid()) {
                $.ajax({
                    url: "<?php echo site_url('vendorpayment/vendorpayment/getRevenueDetails');?>",
                    type: 'post',
                    secureuri: false,
                    data: {
                        vendor: $('#vendor option:selected').val(),
                        from: $('#from').val(),
                        to: $('#to').val()
                    },
                    success: function (data) {
                        var arrayData = data.split('|');
                        $("#sample_1_tbody").html(arrayData[0]);
                        TableManaged.init();
                        $("#sctCommission").val(parseFloat(arrayData[1]));
                    }
                });
            }
        }
        function updateRow() {
            var form_update = $("#default1");
            form_update.validate({
                errorElement: "label",
                errorClass: "font-red-haze",
                rules: {
                    'vendor': {select_valid_vendor: true},
                    'from': {required: true},
                    'to': {required: true}
                },
                messages: {
                    'vendor': {select_valid_vendor: 'Please select vendor.'},
                    'from': {required: 'Please enter from date.'},
                    'to': {required: 'Please enter to date.'}
                }
            });
            if (form_update.valid()) {
                $.ajax({
                    url: "<?php echo site_url('vendorpayment/vendorpayment/rowUpdate');?>",
                    type: 'post',
                    secureuri: false,
                    data: {
                        vendor: $('#vendor option:selected').val(),
                        from: $('#from').val(),
                        to: $('#to').val(),
                        vehicle_id: $('#vehicle_Id').val()
                    },
                    success: function (data) {
                        if (data == 1) {
                            getRevenueData();
                            $(".removeLater").val(0);
                            $(".removeLater1").val('');
                        }
                    }
                });
            }
        }
        function revertPayment(veicle_Id) {
            var form_update = $("#default1");
            form_update.validate({
                errorElement: "label",
                errorClass: "font-red-haze",
                rules: {
                    'vendor': {select_valid_vendor: true},
                    'from': {required: true},
                    'to': {required: true}
                },
                messages: {
                    'vendor': {select_valid_vendor: 'Please select vendor.'},
                    'from': {required: 'Please enter from date.'},
                    'to': {required: 'Please enter to date.'}
                }
            });
            if (form_update.valid()) {
                $.ajax({
                    url: "<?php echo site_url('vendorpayment/vendorpayment/revertPay');?>",
                    type: 'post',
                    secureuri: false,
                    data: {
                        vendor: $('#vendor option:selected').val(),
                        from: $('#from').val(),
                        to: $('#to').val(),
                        vehicle_id: veicle_Id
                    },
                    success: function (data) {
                        if (data == 100) {
                            getRevenueData();
                        }
                    }
                });
            }

        }

    </script>
    </body>
    <!-- END BODY -->
    </html>
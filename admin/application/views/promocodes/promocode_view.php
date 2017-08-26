<?php $this->load->view('header'); ?>
<style>
    .pac-container {
        z-index: 99999;
    }
</style>
<!-- BEGIN CONTAINER -->
<div class="page-container">
    <!-- BEGIN SIDEBAR -->
    <?php $this->load->view('menu'); ?>

    <?php
    function randomString()
    {
        $str = 'abcdefghijklmnopqrstuvwxyz';
        $part1 = substr(uniqid(str_shuffle($str)), 0, 3);
        $part2 = substr(uniqid(str_shuffle('0123456789')), 0, 2);
        $string = str_shuffle($part1 . $part2);
        return $string;
    }

    ?>

    <!-- END SIDEBAR -->
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <div class="page-content">
            <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
            <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-full">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">Add Coupon</h4>
                        </div>
                        <div class="modal-body">
                            <form action="#" class="form-horizontal" id="default">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Code</label>

                                                <div class="col-md-9">
                                                    <input id="code" name="code" type="text" class="form-control"
                                                           placeholder="" value="<?php echo randomString(); ?>">
                                                    <span id="errorMsg" style="color:red"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Total Usable Number</label>

                                                <div class="col-md-9">
                                                    <input type="text" class="form-control " id="total_count"
                                                           name="total_count" placeholder="If unlimited leave it blank">
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <!--/row-->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Valid From</label>

                                                <div class="col-md-9">
                                                    <div class="input-group date form_datetime">
                                                        <input type="text" id="valid_from" name="valid_from" size="16"
                                                               class="form-control">
                        <span class="input-group-btn">
                        <button class="btn default date-set" type="button"><i class="fa fa-calendar"></i></button>
                        </span>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Valid To</label>

                                                <div class="col-md-9">
                                                    <div class="input-group date form_datetime">
                                                        <input type="text" size="16" id="valid_to" name="valid_to"
                                                               class="form-control">
                        <span class="input-group-btn">
                        <button class="btn default date-set" type="button"><i class="fa fa-calendar"></i></button>
                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/row-->

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Message</label>

                                                <div class="col-md-9">
                                                    <textarea class="form-control" id="message" name="message"
                                                              style="resize:none"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Value</label>

                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" id="value" name="value"
                                                           placeholder="+/- Amount in Dollar">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/row-->

                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn green pull-left" onclick="savePromo();">Save</button>
                            <button type="button" data-dismiss="modal" class="btn default pull-left">Cancel</button>
                        </div>
                    </div>
                    <!-- /.addmodal-content -->
                </div>
                <!-- /.addmodal-dialog -->
            </div>
            <!-- /.modal -->
            <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
            <!-- BEGIN PAGE HEADER-->
            <!-- BEGIN PAGE HEAD -->
            <div class="page-head">
                <!-- BEGIN PAGE TITLE -->
                <div class="page-title">
                    <h1>Promocode Management</h1>
                </div>
                <!-- END PAGE TITLE -->
            </div>
            <!-- END PAGE HEAD -->
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet box grey-cascade">
                        <div class="portlet-title">
                            <div class="caption"><i class="fa fa-globe"></i>Codes</div>
                            <div class="tools"><a href="javascript:" class="collapse"> </a> <a href="#portlet-config"
                                                                                                data-toggle="modal"
                                                                                                class="config"> </a> <a
                                    href="javascript:" class="reload"> </a> <a href="javascript:" class="remove"> </a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="table-toolbar">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="btn-group">
                                            <button id="sample_editable_1_new" class="btn green" data-toggle="modal"
                                                    href="#add"> Add New <i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-striped table-bordered table-hover" id="sample_1">
                                <thead>
                                <tr>
                                    <th> No.</th>
                                    <th> Code</th>
                                    <th> Message</th>
                                    <th> Total Allowed Uses</th>
                                    <th> Valid From</th>
                                    <th> Valid To</th>
                                    <th> Value</th>
                                    <th> Used Count</th>
                                    <th> Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1;
                                if ($coupon != 0) { ?>
                                    <?php foreach ($coupon as $coupon) { ?>
                                        <?php
                                        if ($coupon['infinity_status'] == -1 || $coupon['infinity_status'] == '-1') {
                                            $infinity_status = 'Infinite';
                                        } else {
                                            $infinity_status = $coupon['infinity_status'];
                                        }

                                        ?>
                                        <tr>
                                            <td> <?php echo $i; ?> </td>
                                            <td> <?php echo $coupon['couponcode']; ?> </td>
                                            <td> <?php echo $coupon['message']; ?> </td>
                                            <td> <?php echo $infinity_status; ?> </td>
                                            <td> <?php echo gmdate("Y-m-d H:i:s", $coupon['validfrom']); ?> </td>
                                            <td> <?php echo gmdate("Y-m-d H:i:s", $coupon['validto']); ?> </td>
                                            <td> <?php echo $coupon['value']; ?> </td>
                                            <td> <?php echo $coupon['used_count']; ?> </td>
                                            <td>
                                                <?php if ($checking['delete'] == 1 || $checking['delete'] == '1') { ?>
                                                    <button class="btn btn-danger btn-xs" title="Disable"
                                                            onClick="activateCoupon(<?php echo $coupon['id']; ?>,0);"><i
                                                            class="fa fa-ban"></i></button>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php $i = $i + 1;
                                    } ?>
                                <?php } else { ?>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>No Data</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END EXAMPLE TABLE PORTLET-->
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
    jQuery.validator.setDefaults({debug: true});

    var form = $("#default");

    form.validate({
        errorElement: "div",
        errorClass: "font-red-haze",
        errorPlacement: function (error, element) {
            error.appendTo(element.parents(".col-md-9"));
        },
        rules: {
            'code': {required: true},
            'total_count': {number: true},
            'valid_from': {required: true},
            'valid_to': {required: true},
            'message': {required: true},
            'value': {required: true}
        }
    });
    function savePromo() {
        if (form.valid()) {
            var valid_from_unixtime = toTimestamp((document.getElementById("valid_from").value + ":00").replace("-", ""));
            var valid_to_unixtime = toTimestamp((document.getElementById("valid_to").value + ":00").replace("-", ""));
            $.ajax({
                url: "<?php echo site_url('promocodes/promocode/add'); ?>",
                type: 'POST',
                data: {
                    code: $("#code").val(),
                    total_count: $("#total_count").val(),
                    valid_from: valid_from_unixtime,
                    valid_to: valid_to_unixtime,
                    message: $("#message").val(),
                    value: $("#value").val()
                },
                success: function (msg) {
                    if (msg == 1 || msg == '1') {
                        location.reload();
                    } else {
                        $("#errorMsg").html('Coupon already added');
                    }
                }
            });
        }
    }

    function toTimestamp(strDate) {
        unixtime = Math.round(new Date(strDate).getTime() / 1000.0);
        return unixtime;
    }

    function activateCoupon(coupon_id) {
        var r = confirm("Are you sure want to delete this?");
        if (r == true) {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('promocodes/promocode/delete'); ?>",
                data: {coupon_id: coupon_id},
                success: function (msg) {
                    if (msg == 1) {
                        location.reload();
                    }
                }
            });
        } else {
            return false;
        }
    }


    <!---->
</script>
</body><!-- END BODY -->
</html>
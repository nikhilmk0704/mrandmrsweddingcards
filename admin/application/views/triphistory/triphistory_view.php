<?php $this->load->view('header'); ?>
<div class="page-container">
    <!-- BEGIN SIDEBAR -->
    <?php $this->load->view('menu'); ?>
    <div id="editview"></div>
    <!-- END SIDEBAR -->
    <a href="#vehicleEdit" data-toggle="modal" class="config" id="edit_popup"></a>

    <div class="modal fade" id="vehicleEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Route Map</h4>
                </div>
                <div class="modal-body">
                    <div id="map-canvas" style="height:350px;width:500px;"></div>
                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn default" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <!-- BEGIN PAGE HEAD -->
            <div class="page-head">
                <!-- BEGIN PAGE TITLE -->
                <div class="page-title">
                    <h1>Trip History</h1>
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
                            <div class="caption"><i class="fa fa-globe"></i>Trip List</div>
                            <div class="tools"></div>
                        </div>
                        <div class="portlet-body">
                            <div class="table-toolbar">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="btn-group">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <table class="table table-striped table-bordered table-hover" id="sample_1">
                                <thead>
                                <tr>
                                    <th> No.</th>
                                    <th> Trip Status</th>
                                    <th>Trip Time</th>
                                    <th> Driver</th>
                                    <th> Vehicle Number</th>
                                    <th> Customer</th>
                                    <th> Distance</th>
                                    <th> Fare</th>
                                    <th> Customer Paid Amount</th>
                                    <th>Coupon Deduction</th>
                                    <th> Rating</th>
                                    <th> Route</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1;
                                if ($tripList != 0) { ?>
                                    <?php foreach ($tripList as $tripList) { ?>
                                        <tr>
                                            <td> <?php echo $i; ?> </td>
                                            <td>

                                                <?php
                                                if ($tripList['status'] == 0) {
                                                    ?>
                                                    <span class="label label-sm label-info">Open Trip</span>
                                                <?php } else if ($tripList['status'] == 1) { ?>
                                                    <span class="label label-sm label-info">Driver Accepted</span>
                                                <?php } else if ($tripList['status'] == 2) { ?>
                                                    <span class="label label-sm label-info">Located Customer</span>
                                                <?php } else if ($tripList['status'] == 3) { ?>
                                                    <span class="label label-sm label-info">Truck Arrived</span>
                                                <?php } else if ($tripList['status'] == 4) { ?>
                                                    <span class="label label-sm label-info">Trip Started</span>
                                                <?php } else if ($tripList['status'] == 5) { ?>
                                                    <span class="label label-sm label-danger">Payment Fail</span>
                                                <?php } else if ($tripList['status'] == 6) { ?>
                                                    <span class="label label-sm label-info">Trip Done</span>
                                                <?php } else if ($tripList['status'] == 7) { ?>
                                                    <span class="label label-sm label-info">Rating Yet</span>
                                                <?php } else if ($tripList['status'] == 8) { ?>
                                                    <span class="label label-sm label-info">Rating Done</span>
                                                <?php } else if ($tripList['status'] == 9) { ?>
                                                    <span class="label label-sm label-info">Wage Added</span>
                                                <?php }else if ($tripList['status'] == 10) { ?>
                                                    <span class="label label-sm label-info">Vendor Payment Done</span>
                                                <?php } ?>

                                            </td>
                                            <td><?php echo gmdate("M d Y H:i:s",$tripList['trip_start_time']) . "</br> To </br>" . gmdate("M d Y H:i:s",$tripList['trip_end_time']); ?></td>
                                            <td><?php echo $tripList['driverName']; ?></td>
                                            <td><?php echo $tripList['vehicle_current']; ?></td>
                                            <td><?php echo $tripList['customername']; ?></td>
                                            <td><?php echo number_format(($tripList['km_coverd'] / 1000), 2) . " Km"; ?></td>
                                            <td><?php echo "$" . number_format($tripList['trip_amount'] / 100, 2); ?></td>
                                            <td><?php echo "$" . number_format($tripList['customerPaidAmount'] / 100, 2); ?></td>
                                            <td><?php echo "$" . number_format($tripList['couponValue'] / 100, 2); ?></td>
                                            <td><?php echo $tripList['driver_rating']; ?> </td>
                                            <td>
                                                <button class="btn btn-success btn-xs idLoad"
                                                        onClick="mapViewLoad('<?php echo $tripList['id_trip_request']; ?>');"
                                                        title="Map View" data-toggle="modal"><i
                                                        class="fa fa-map-marker"></i></button>
                                                <?php if ($tripList['status'] == 5) { ?>
                                                    <button type="button" onClick="customerPayment('<?php echo $tripList['id_trip_request']; ?>');" class="btn btn-primary">Pay</button>
                                                <?php } ?>


                                            </td>
                                        </tr>
                                        <?php $i += 1;
                                    } ?>
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
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places"></script>

<?php $this->load->view('footer'); ?>
<script>
    function mapViewLoad(id) {
        string_array = "tripid=" + id;
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('triphistory/triphistory/mapView');  ?>",
            data: string_array,
            dataType: "json",
            success: function (msg) {
                if (msg != 0) {
                    initialize(msg);
                    $('#edit_popup').trigger("click");
                }
            }
        });
    }

    function initialize(msg) {


        var flightPlanCoordinates = [];
        for (var i = 0; i < msg.length; i++) {

            flightPlanCoordinates.push(new google.maps.LatLng(msg[i]['latitude'], msg[i]['longitude']));

        }
        var mapOptions = {
            zoom: 10,
            center: new google.maps.LatLng(msg[Math.floor(msg.length / 2)]['latitude'], msg[Math.floor(msg.length / 2)]['longitude']),
            mapTypeId: google.maps.MapTypeId.TERRAIN
        };
        var map = new google.maps.Map(document.getElementById('map-canvas'),
            mapOptions);

        var flightPath = new google.maps.Polyline({
            path: flightPlanCoordinates,
            geodesic: true,
            strokeColor: '#FF0000',
            strokeOpacity: 1.0,
            strokeWeight: 2
        });

        flightPath.setMap(map);
    }
    function customerPayment(id) {
        string_array = "tripid=" + id;
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('triphistory/triphistory/updateTable');  ?>",
            data: string_array,
            success: function (msg) {
                if (msg == 1) {
                    location.reload();
                }
            }
        });
    }
</script>
</body>
<!-- END BODY -->
</html>
<?php $this->load->view('header'); ?>
<div class="page-container">
    <!-- BEGIN SIDEBAR -->
    <?php $this->load->view('menu'); ?>
    <!-- END SIDEBAR -->
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <div class="page-content">
            <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
            <div class="modal fade" id="assign" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">Assign Driver</h4>
                        </div>
                        <div class="modal-body">
                            <form action="#" class="form-horizontal" id="assign_save">
                                <input type="hidden" value="" id="driver_pop_id" name="driver_pop_id"/>

                                <div class="form-group">
                                    <label class="control-label col-md-3">Driver</label>

                                    <div class="col-md-6">
                                        <select name="driverselect" class="form-control input-medium select2me"
                                                data-placeholder="Select..." onchange="loadDriverData();"
                                                id="driverselect">
                                            <option value="0">Select</option>
                                            <?php if ($driverList != 0) { ?>
                                                <?php foreach ($driverList as $driverList) { ?>
                                                    <?php if ($driverList['profile_status'] == 1 || $driverList['profile_status'] == '1') { ?>
                                                        <option
                                                            value="<?php echo $driverList['id_drivers_profile']; ?>"><?php echo $driverList['firstname'] . " " . $driverList['lastname']; ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group" id="userDetail">

                                </div>
                            </form>
                        </div>
                        <div class="modal-footer ">
                            <button type="button" class="btn green" onClick="saveAssign();">Assign</button>
                            <button type="button" data-dismiss="modal" class="btn default">Cancel</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
            <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">Add Fleet</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" role="form" id="default">
                                <div class="form-body">
                                    <?php if ($this->session->userdata('role') == '1' || $this->session->userdata('role') == 1) { ?>
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
                                    <?php } ?>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Vehicle Number</label>

                                        <div class="col-md-9">
                                            <input type="text" name="vehiclenumber" id="vehiclenumber"
                                                   class="form-control input-inline input-medium" placeholder=""
                                                   required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Make</label>

                                        <div class="col-md-9">
                                            <input type="text" class="form-control input-inline input-medium"
                                                   placeholder="" name="make" id="make" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Model</label>

                                        <div class="col-md-9">
                                            <input type="text" class="form-control input-inline input-medium"
                                                   placeholder="" name="model" id="model" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Basetype</label>

                                        <div class="col-md-9">
                                            <select id="basetype" name="basetype"
                                                    class="form-control input-inline input-medium"
                                                    onChange="loadCapacity();">
                                                <option value="0">Select</option>

                                                <?php if ($baseTypeList != 0) { ?>
                                                    <?php foreach ($baseTypeList as $baseTypeList) { ?>
                                                        <?php if ($baseTypeList['isdeleted'] == '1' || $baseTypeList['isdeleted'] == 1) { ?>
                                                            <option
                                                                value="<?php echo $baseTypeList['base_type_id']; ?>"><?php echo $baseTypeList['basetype']; ?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Capacity</label>

                                        <div class="col-md-9">
                                            <select id="capacity" name="capacity" class="form-control input-medium">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Base Fare</label>

                                        <div class="col-md-9">
                                            <input type="text" id="basefare" name="basefare"
                                                   class="form-control input-inline input-medium" placeholder="Add base fare in dollar($)">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Specified Min Hrs</label>

                                        <div class="col-xs-2">
                                            <input type="checkbox" class="form-control" id="min_hr_chk"
                                                   name="min_hr_chk">
                                        </div>
                                    </div>
                                    <div class="form-group" id="div_min_hr" style="display:none">
                                        <label class="col-md-3 control-label">Minimum Hrs</label>

                                        <div class="col-md-9">
                                            <input type="text" id="min_hrs" name="min_hrs"
                                                   class="form-control input-inline input-medium" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Km Unit</label>

                                        <div class="col-md-9">
                                            <input type="text" id="kmunit" name="kmunit"
                                                   class="form-control input-inline input-medium" placeholder="Add per km rate in dollar($)">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Time Unit</label>

                                        <div class="col-md-9">
                                            <input type="text" id="timeunit" name="timeunit"
                                                   class="form-control input-inline input-medium" placeholder="Add per minute rate in dollar($)">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Icon</label>

                                        <div class="col-md-9">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="input-group input-large">
                                                    <div class="form-control uneditable-input span3"
                                                         data-trigger="fileinput">
                                                        <i class="fa fa-file fileinput-exists"></i>&nbsp; <span
                                                            class="fileinput-filename">
														</span>
                                                    </div>
													<span class="input-group-addon btn default btn-file">
													<span class="fileinput-new">
													Select file </span>
													<span class="fileinput-exists">
													Change </span>
													<input type="file" name="vehicle_image" id="vehicle_image">
													</span>
                                                    <a href="#" class="input-group-addon btn red fileinput-exists"
                                                       data-dismiss="fileinput">
                                                        Remove </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Country</label>

                                        <div class="col-md-9">
                                            <?php
                                            $country = array("AD"=>"Andorra","AE"=>"United Arab Emirates","AF"=>"Afghanistan","AG"=>"Antigua and Barbuda","AI"=>"Anguilla","AL"=>"Albania",
                                                "AM"=>"Armenia","AN"=>"Netherlands Antilles","AO"=>"Angola","AQ"=>"Antarctica","AR"=>"Argentina","AS"=>"American Samoa",
                                                "AT"=>"Austria","AU"=>"Australia","AW"=>"Aruba","AX"=>"Åland Islands","AZ"=>"Azerbaijan","BA"=>"Bosnia and Herzegovina","BB"=>"Barbados",
                                                "BD"=>"Bangladesh","BE"=>"Belgium","BF"=>"Burkina Faso","BG"=>"Bulgaria","BH"=>"Bahrain","BI"=>"Burundi","BJ"=>"Benin","BL"=>"Saint Barthélemy",
                                                "BM"=>"Bermuda","BN"=>"Brunei Darussalam","BO"=>"Bolivia, Plurinational State of","BQ"=>"Bonaire, Sint Eustatius and Saba","BR"=>"Brazil",
                                                "BS"=>"Bahamas","BT"=>"Bhutan","BV"=>"Bouvet Island","BW"=>"Botswana","BY"=>"Belarus","BZ"=>"Belize","CA"=>"Canada","CC"=>"Cocos (Keeling) Islands",
                                                "CD"=>"Congo, the Democratic Republic of the","CF"=>"Central African Republic","CG"=>"Congo","CH"=>"Switzerland",
                                                "CI"=>"Côte d'Ivoire","CK"=>"Cook Islands","CL"=>"Chile","CM"=>"Cameroon","CN"=>"China","CO"=>"Colombia","CR"=>"Costa Rica",
                                                "CS"=>"Czechoslovak Socialist Republic","CU"=>"Cuba","CV"=>"Cape Verde","CW"=>"Curaçao","CX"=>"Christmas Island","CY"=>"Cyprus",
                                                "CZ"=>"Czech Republic","DD"=>"German Democratic Republic","DE"=>"Germany","DJ"=>"Djibouti","DK"=>"Denmark","DM"=>"Dominica",
                                                "DO"=>"Dominican Republic","DZ"=>"Algeria","EC"=>"Ecuador","EE"=>"Estonia","EG"=>"Egypt","EH"=>"Western Sahara","ER"=>"Eritrea",
                                                "ES"=>"Spain","ET"=>"Ethiopia","FI"=>"Finland","FJ"=>"Fiji","FK"=>"Falkland Islands (Malvinas)","FM"=>"Micronesia, Federated States of",
                                                "FO"=>"Faroe Islands","FR"=>"France","GA"=>"Gabon","GB"=>"United Kingdom","GD"=>"Grenada","GE"=>"Georgia","GF"=>"French Guiana",
                                                "GG"=>"Guernsey","GH"=>"Ghana","GI"=>"Gibraltar","GL"=>"Greenland","GM"=>"Gambia","GN"=>"Guinea","GP"=>"Guadeloupe","GQ"=>"Equatorial Guinea",
                                                "GR"=>"Greece","GS"=>"South Georgia and the South Sandwich Islands","GT"=>"Guatemala","GU"=>"Guam","GW"=>"Guinea-Bissau","GY"=>"Guyana",
                                                "HK"=>"Hong Kong","HM"=>"Heard Island and McDonald Islands","HN"=>"Honduras","HR"=>"Croatia","HT"=>"Haiti","HU"=>"Hungary","ID"=>"Indonesia",
                                                "IE"=>"Ireland","IL"=>"Israel","IM"=>"Isle of Man","IN"=>"India","IO"=>"British Indian Ocean Territory","IQ"=>"Iraq","IR"=>"Iran, Islamic Republic of",
                                                "IS"=>"Iceland","IT"=>"Italy","JE"=>"Jersey","JM"=>"Jamaica","JO"=>"Jordan","JP"=>"Japan","KE"=>"Kenya","KG"=>"Kyrgyzstan","KH"=>"Cambodia",
                                                "KI"=>"Kiribati","KM"=>"Comoros","KN"=>"Saint Kitts and Nevis","KP"=>"Korea, Democratic People's Republic of","KR"=>"Korea, Republic of",
                                                "KW"=>"Kuwait","KY"=>"Cayman Islands","KZ"=>"Kazakhstan","LA"=>"Lao People's Democratic Republic","LB"=>"Lebanon","LC"=>"Saint Lucia",
                                                "LI"=>"Liechtenstein","LK"=>"Sri Lanka","LR"=>"Liberia","LS"=>"Lesotho","LT"=>"Lithuania","LU"=>"Luxembourg","LV"=>"Latvia","LY"=>"Libya",
                                                "MA"=>"Morocco","MC"=>"Monaco","MD"=>"Moldova, Republic of","ME"=>"Montenegro","MF"=>"Saint Martin (French part)","MG"=>"Madagascar",
                                                "MH"=>"Marshall Islands","MK"=>"Macedonia, The Former Yugoslav Republic of","ML"=>"Mali","MM"=>"Myanmar","MN"=>"Mongolia","MO"=>"Macao",
                                                "MP"=>"Northern Mariana Islands","MQ"=>"Martinique","MR"=>"Mauritania","MS"=>"Montserrat","MT"=>"Malta","MU"=>"Mauritius","MV"=>"Maldives",
                                                "MW"=>"Malawi","MX"=>"Mexico","MY"=>"Malaysia","MZ"=>"Mozambique","NA"=>"Namibia","NC"=>"New Caledonia","NE"=>"Niger","NF"=>"Norfolk Island",
                                                "NG"=>"Nigeria","NI"=>"Nicaragua","NL"=>"Netherlands","NO"=>"Norway","NP"=>"Nepal","NR"=>"Nauru","NU"=>"Niue","NZ"=>"New Zealand","OM"=>"Oman",
                                                "PA"=>"Panama","PE"=>"Peru","PF"=>"French Polynesia","PG"=>"Papua New Guinea","PH"=>"Philippines","PK"=>"Pakistan","PL"=>"Poland",
                                                "PM"=>"Saint Pierre and Miquelon","PN"=>"Pitcairn","PR"=>"Puerto Rico","PS"=>"Palestinian Territory, Occupied","PT"=>"Portugal",
                                                "PW"=>"Palau","PY"=>"Paraguay","QA"=>"Qatar","RE"=>"Réunion","RO"=>"Romania","RS"=>"Serbia","RU"=>"Russian Federation",
                                                "RW"=>"Rwanda","SA"=>"Saudi Arabia","SB"=>"Solomon Islands","SC"=>"Seychelles","SD"=>"Sudan","SE"=>"Sweden","SG"=>"Singapore",
                                                "SH"=>"Saint Helena, Ascension and Tristan da Cunha","SI"=>"Slovenia","SJ"=>"Svalbard and Jan Mayen","SK"=>"Slovakia",
                                                "SL"=>"Sierra Leone","SM"=>"San Marino","SN"=>"Senegal","SO"=>"Somalia","SR"=>"Suriname","SS"=>"South Sudan",
                                                "ST"=>"Sao Tome and Principe","SU"=>"U.S.S.R.","SV"=>"El Salvador","SX"=>"Sint Maarten (Dutch part)","SY"=>"Syrian Arab Republic",
                                                "SZ"=>"Swaziland","TC"=>"Turks and Caicos Islands","TD"=>"Chad","TF"=>"French Southern Territories","TG"=>"Togo",
                                                "TH"=>"Thailand","TJ"=>"Tajikistan","TK"=>"Tokelau","TL"=>"Timor-Leste","TM"=>"Turkmenistan","TN"=>"Tunisia","TO"=>"Tonga",
                                                "TR"=>"Turkey","TT"=>"Trinidad and Tobago","TV"=>"Tuvalu","TW"=>"Taiwan, Province of China","TZ"=>"Tanzania, United Republic of",
                                                "UA"=>"Ukraine","UG"=>"Uganda","UM"=>"United States Minor Outlying Islands","US"=>"United States","UY"=>"Uruguay","UZ"=>"Uzbekistan",
                                                "VA"=>"Holy See (Vatican City State)","VC"=>"Saint Vincent and the Grenadines","VE"=>"Venezuela, Bolivarian Republic of",
                                                "VG"=>"Virgin Islands, British","VI"=>"Virgin Islands, U.S.","VN"=>"Viet Nam","VU"=>"Vanuatu","WF"=>"Wallis and Futuna","WS"=>"Samoa",
                                                "YD"=>"People's Democratic Republic of Yemen","YE"=>"Yemen","YT"=>"Mayotte","YU"=>"Yugoslavia","ZA"=>"South Africa","ZM"=>"Zambia",
                                                "ZR"=>"Zaire","ZW"=>"Zimbabwe");

                                            asort($country);

                                            ?>
                                            <select id="country" name="country_edit" class="form-control input-medium">
                                                <?php foreach($country as $key => $value){ ?>
                                                    <option value="<?php echo $key; ?>"> <?php echo $value; ?> </option>
                                                <?php }  ?>
                                            </select>
                                            <span id="errorMsg" style="color:red"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">KM</label>

                                        <div class="col-md-9">
                                            <input type="text" class="form-control input-inline input-medium"
                                                   placeholder="" name="km" id="km" required>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer ">
                            <button type="button" class="btn blue" onClick="saveVehicle();">Save changes</button>
                            <button type="button" data-dismiss="modal" class="btn default">Close</button>
                        </div>
                    </div>
                    <!-- /.addmodal-content -->
                </div>
                <!-- /.addmodal-dialog -->
            </div>
            <div id="editview"></div>
            <!-- BEGIN PAGE HEAD -->
            <div class="page-head">
                <!-- BEGIN PAGE TITLE -->
                <div class="page-title">
                    <h1>Fleet Management</h1>
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
                            <div class="caption">
                                <i class="fa fa-globe"></i>Manage My Fleet
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="table-toolbar">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="btn-group">
                                            <?php if ($checking['add'] == 1 || $checking['add'] == '1') { ?>
                                                <button id="sample_editable_1_new" class="btn green" data-toggle="modal"
                                                        href="#add"> Add New <i class="fa fa-plus"></i></button>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-striped table-bordered table-hover" id="sample_1">
                                <thead>
                                <tr>
                                    <th>
                                        No.
                                    </th>
                                    <th>
                                        Image
                                    </th>
                                    <th>
                                        Number
                                    </th>
                                    <th>
                                        Make
                                    </th>
                                    <th>
                                        Model
                                    </th>
                                    <th>
                                        Base Type
                                    </th>
                                    <th>
                                        Capacity
                                    </th>

                                    <th>
                                        Vendor
                                    </th>
                                    <th>
                                        Driver
                                    </th>
                                    <th>
                                        Base Fare
                                    </th>
                                    <th>
                                        $/Km
                                    </th>
                                    <th>
                                        $/Minute
                                    </th>
                                    <th>
                                        Minimum Hrs
                                    </th>
                                    <th>
                                        Country
                                    </th>
                                    <th>
                                        Actions
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1;
                                if ($vehicleList != 0) { ?>
                                    <?php foreach ($vehicleList as $vehicleList) { ?>
                                        <tr>
                                            <td> <?php echo $i; ?> </td>
                                            <td><img
                                                    src="<?php echo base_url() . "uploads/vehicles/" . $vehicleList['photo']; ?>"
                                                    height="50" width="50"/></td>
                                            <td> <?php echo $vehicleList['vehicle_no']; ?> </td>
                                            <td> <?php echo $vehicleList['make']; ?> </td>
                                            <td> <?php echo $vehicleList['model']; ?> </td>
                                            <td> <?php echo $vehicleList['basetype_name']; ?> </td>
                                            <td> <?php echo $vehicleList['capacity_name']; ?> </td>

                                            <td> <?php echo $vehicleList['vendorFristname'] . " " . $vehicleList['vendorLastname']; ?> </td>
                                            <td> <?php echo $vehicleList['assigneddriver']; ?> </td>
                                            <td> <?php echo $vehicleList['basefare']; ?> </td>
                                            <td> <?php echo $vehicleList['km_multiplier']; ?> </td>
                                            <td> <?php echo $vehicleList['time_multiplier']; ?> </td>
                                            <td> <?php echo $vehicleList['min_hrs']; ?> </td>
                                            <td> <?php echo $vehicleList['country']; ?> </td>
                                            <td>
                                                <?php if ($checking['edit'] == 1 || $checking['edit'] == '1') { ?>
                                                    <button
                                                        onClick="editVehicles(<?php echo $vehicleList['idvendorprofile']; ?>,<?php echo $vehicleList['basetype']; ?>)"
                                                        class="btn btn-primary btn-xs" title="Edit"><i
                                                            class="fa fa-pencil"></i></button>
                                                    <button class="btn btn-success btn-xs idLoad"
                                                            data-id="<?php echo $vehicleList['idvendorprofile']; ?>"
                                                            title="Assign" data-toggle="modal" href="#assign"><i
                                                            class="fa fa-check"></i></button>
                                                    <button class="btn btn-warning btn-xs"
                                                            onClick="unAssign(<?php echo $vehicleList['idvendorprofile']; ?>)"
                                                            title="Unassign"><i class="fa fa-times"></i></button>
                                                <?php } ?>
                                                <?php if ($checking['delete'] == 1 || $checking['delete'] == '1') { ?>
                                                    <?php if ($vehicleList['status'] == '1' || $vehicleList['status'] == 1) { ?>
                                                        <button class="btn btn-danger btn-xs" title="Disable"
                                                                onClick="deleteVehicles(<?php echo $vehicleList['idvendorprofile']; ?>,0);">
                                                            <i class="fa fa-ban"></i></button>
                                                    <?php } else { ?>
                                                        <button class="btn btn-success btn-xs" title="Enable"
                                                                onClick="deleteVehicles(<?php echo $vehicleList['idvendorprofile']; ?>,1);">
                                                            <i class="fa fa-check"></i></button>
                                                    <?php } ?>
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

<?php $this->load->view('footer'); ?>

<script>
    $(document).on("click", ".idLoad", function () {
        var userId = $(this).data('id');
        $("#driver_pop_id").val(userId);
    });

    jQuery(document).ready(function () {
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        Demo.init(); // init demo features
        TableManaged.init();
    });

    $.validator.addMethod("select_valid_country", function (value, element) {
        var position = $('#country').val();
        if (value != 0) {
            return 'true';
        }
    }, "Select a country");

    $.validator.addMethod("select_valid", function (value, element) {
        if (value != 0) {
            return 'true';
        }
    }, "Select a basetype");

    $.validator.addMethod("select_valid_vendor", function (value, element) {
        if (value != 0) {
            return 'true';
        }
    }, "Select a vendor");

    jQuery.validator.setDefaults({debug: true});
    var form = $("#default");

    form.validate({
        errorElement: "label",
        errorClass: "font-red-haze",
        rules: {
            'basetype': {select_valid: true},
            'vendor': {select_valid_vendor: true},
            'vehiclenumber': {required: true},
            'make': {required: true},
            'model': {required: true},
            'km': {required: true, number: true},
            'capacity': {required: true},
            'basefare':{required: true},
            'kmunit':{required: true},
            'timeunit':{required: true},
            'country':{select_valid_country:true}

        },
        messages: {
            'vendor': {required: 'Please select vendor!'},
            'basetype': {required: 'Please select basetype!'},
            'vehiclenumber': {required: 'Please enter number!'},
            'make': {required: 'Please enter make!'},
            'model': {required: 'Please enter model!'},
            'capacity': {required: 'Please enter capacity!'},
            'km': {required: 'Please enter kilo meter!'},
            'basefare':{required: 'Please add basefare'},
            'kmunit':{required: 'Please add per km rate'},
            'timeunit':{required: 'Please add per minute charge'},
            'country':{required:'Please add country'}

        }
    });
    function saveVehicle() {
        if (form.valid()) {
            var vendor_id = '';
            if ($('#vendor option:selected').val() == null) {
                vendor_id = 0;
            } else {
                vendor_id = $('#vendor option:selected').val();
            }
            $.ajaxFileUpload({
                url: "<?php echo site_url('vehicles/vehicles/add');?>",
                type: 'post',
                secureuri: false,
                fileElementId: 'vehicle_image',
                dataType: 'json',
                data: {
                    vendor_id: vendor_id,
                    basetype: $('#basetype option:selected').val(),
                    vehiclenumber: $('#vehiclenumber').val(),
                    make: $('#make').val(),
                    model: $('#model').val(),
                    km: $('#km').val(),
                    capacity: $("#capacity option:selected").val(),
                    basefare: $('#basefare').val(),
                    kmunit: $('#kmunit').val(),
                    timeunit: $('#timeunit').val(),
                    min_hrs: $('#min_hrs').val(),
                    country:$("#country option:selected").val()

                },

                success: function (data) {
                    location.reload();
                }
            });
        }
    }

    function editVehicles(id, basetype_id) {

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('vehicles/vehicles/edit_view');  ?>",
            data: {
                vehicle_id: id,
                basetype_id: basetype_id
            },
            success: function (msg) {

                $("#vendor").select2();
                $("#editview").html(msg);
                $('#edit_popup').trigger("click");

            }
        });
    }
    function updateVehicle(id, image) {
        var form_update = $("#default1");
        var vendor_id = '';
        if ($('#vendor_edit option:selected').val() == null) {
            vendor_id = 0;
        } else {
            vendor_id = $('#vendor_edit option:selected').val();
        }
        form_update.validate({

            errorElement: "label",
            errorClass: "font-red-haze",
            rules: {
                'vendor_edit': {select_valid_vendor: true},
                'basetype_edit': {select_valid: true},
                'vehiclenumber_edit': {required: true},
                'make_edit': {required: true},
                'model_edit': {required: true},
                'km_edit': {required: true, number: true},
                'capacity_edit': {required: true},
                'basefare_edit':{required: true},
                'kmunit_edit':{required: true},
                'timeunit_edit':{required: true},
                'country':{select_valid_country:true}
            },
            messages: {
                'vendor_edit': {required: 'Please select vendor!'},
                'basetype_edit': {required: 'Please select basetype!'},
                'vehiclenumber_edit': {required: 'Please enter number!'},
                'make_edit': {required: 'Please enter make!'},
                'model_edit': {required: 'Please enter model!'},
                'capacity_edit': {required: 'Please enter capacity!'},
                'km_edit': {required: 'Please enter kilo meter!'},
                'basefare_edit':{required: 'Please add basefare'},
                'kmunit_edit':{required: 'Please add per km rate'},
                'timeunit_edit':{required: 'Please add per minute charge'},
                'country':{required:'Please add your country'}
            }
        });
        if (form_update.valid()) {

            $.ajaxFileUpload({
                url: "<?php echo site_url('vehicles/vehicles/updateVehicle');?>",
                type: 'post',
                secureuri: false,
                fileElementId: 'vehicle_image_edit',
                dataType: 'json',
                data: {
                    vendor_id: vendor_id,
                    basetype: $('#basetype_edit option:selected').val(),
                    vehiclenumber: $('#vehiclenumber_edit').val(),
                    make: $('#make_edit').val(),
                    model: $('#model_edit').val(),
                    capacity: $('#capacity_edit option:selected').val(),
                    km: $('#km_edit').val(),
                    basefare: $('#basefare_edit').val(),
                    kmunit: $('#kmunit_edit').val(),
                    timeunit: $('#timeunit_edit').val(),
                    min_hrs: $('#min_hrs_edit').val(),
                    image_old: image,
                    idvendorprofile: id,
                    country:$("#country_edit option:selected").val()
                },
                success: function (data) {
                    location.reload();
                }
            });
        }
    }

    function deleteVehicles(vehicle_id, status) {
        if (status == 1 || status == '1') {
            var r = confirm("Are you sure want to activate this?");
        } else {
            var r = confirm("Are you sure want to deactivate this?");
        }
        if (r == true) {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('vehicles/vehicles/delete'); ?>",
                data: {vehicle_id: vehicle_id, status: status},
                success: function (msg) {
                    if (msg == 1) {
                        location.reload();
                    } else if (msg == 2 || msg == '2') {
                        alert('Please activate the corresponding capacity first');
                        return false;
                    }
                }
            });
        }
    }
    function loadDriverData() {
        if ($("#driverselect option:selected").val() != 0) {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('vehicles/vehicles/getDriver'); ?>",
                data: {user_id: $("#driverselect option:selected").val()},
                success: function (msg) {
                    $("#userDetail").html(msg)
                }
            });
        }
    }
    $.validator.addMethod("select_valid_vehicle", function (value, element) {
        if (value != 0) {
            return 'true';
        }
    }, "Select a driver");
    //assign vehicle to a driver
    var assignForm = $("#assign_save");
    assignForm.validate({
        errorElement: "label",
        errorClass: "font-red-haze",
        rules: {
            'driverselect': {select_valid_vehicle: true}
        },
        messages: {
            'driverselect': {required: 'Please select driver!<br>'}
        }
    });
    function saveAssign() {
        if (assignForm.valid()) {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('drivers/drivers/assignVehicle'); ?>",
                data: {
                    vehicle_id: $("#driver_pop_id").val(),
                    driver_id: $("#driverselect option:selected").val()
                },
                success: function (msg) {
                    if (msg == 1) {
                        location.reload();
                    }
                }
            });

        }
    }
    function unAssign(vehicle_id) {

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('vehicles/vehicles/unassignVehicle'); ?>",
            data: {
                vehicle_id: vehicle_id
            },
            success: function (msg) {
                if (msg == 1) {
                    location.reload();
                }
            }
        });


    }

    function loadCapacity() {
        if ($("#basetype option:selected").val() > 0) {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('hire/for_hire_trip/ajaxLoadCapacity'); ?>",
                data: {
                    basetype_id: $("#basetype option:selected").val()
                },
                success: function (msg) {
                    $("#capacity").html(msg);
                }
            });

        }
    }

    function loadCapacityEdit() {
        if ($("#basetype_edit option:selected").val() > 0) {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('hire/for_hire_trip/ajaxLoadCapacity'); ?>",
                data: {
                    basetype_id: $("#basetype_edit option:selected").val()
                },
                success: function (msg) {
                    $("#capacity_edit").html(msg);
                }
            });

        }
    }

    $('#min_hr_chk').click(function () {
        $("#div_min_hr").toggle(this.checked);
    });
</script>
</body>
<!-- END BODY -->
</html>
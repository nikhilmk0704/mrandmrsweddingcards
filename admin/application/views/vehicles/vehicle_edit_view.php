<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/global/plugins/select2/select2.css"/>
<a href="#vehicleEdit" data-toggle="modal" class="config" id="edit_popup"></a>
<div class="modal fade" id="vehicleEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Edit Vehicles</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" id="default1">
                    <div class="form-body">
                        <?php if ($this->session->userdata('role') == '1' || $this->session->userdata('role') == 1) { ?>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Vendor</label>

                                <div class="col-md-9">
                                    <select id="vendor_edit" name="vendor_edit"
                                            class="form-control input-inline input-medium">
                                        <option value="0">Select</option>

                                        <?php if ($vendorList != 0) { ?>
                                            <?php foreach ($vendorList as $vendorList) { ?>
                                                <?php if ($vendorList['status'] == '1' || $vendorList['status'] == 1) { ?>
                                                    <option
                                                        value="<?php echo $vendorList['user_id']; ?>" <?php if ($vendorList['user_id'] == $vehicles['vendor_userid']) { ?> selected="selected" <?php } ?>><?php echo $vendorList['firstname'] . " " . $vendorList['lastname']; ?></option>
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
                                <input type="text" name="vehiclenumber_edit" id="vehiclenumber_edit"
                                       value="<?php echo $vehicles['vehicle_no']; ?>"
                                       class="form-control input-inline input-medium" placeholder="" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Make</label>

                            <div class="col-md-9">
                                <input type="text" class="form-control input-inline input-medium" placeholder=""
                                       name="make_edit" id="make_edit" value="<?php echo $vehicles['make']; ?>"
                                       required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Model</label>

                            <div class="col-md-9">
                                <input type="text" class="form-control input-inline input-medium" placeholder=""
                                       name="model_edit" id="model_edit" value="<?php echo $vehicles['model']; ?>"
                                       required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Basetype</label>

                            <div class="col-md-9">
                                <select id="basetype_edit" onChange="loadCapacityEdit();" name="basetype_edit" class="form-control input-medium">
                                    <option value="0">Select</option>

                                    <?php if (count($baseTypeList) > 0) { ?>
                                        <?php foreach ($baseTypeList as $baseTypeList) { ?>
                                            <?php if ($baseTypeList['isdeleted'] == '1' || $baseTypeList['isdeleted'] == 1) { ?>
                                                <option
                                                    value="<?php echo $baseTypeList['base_type_id']; ?>" <?php if ($baseTypeList['base_type_id'] == $vehicles['basetype']) { ?> selected="selected" <?php } ?>><?php echo $baseTypeList['basetype']; ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Capacity</label>

                            <div class="col-md-9">
                                <select id="capacity_edit" name="capacity_edit"
                                        class="form-control input-inline input-medium">
                                    <option value="0">Select</option>
                                        <?php if (count($capacityList) > 0) { ?>
                                            <?php foreach ($capacityList as $capacity) { ?>
                                                <?php if ($capacity['status'] == '1' || $capacity['status'] == 1) { ?>
                                                    <option
                                                        value="<?php echo $capacity['capacity_id']; ?>" <?php if ($vehicles['capacity'] == $capacity['capacity_id']) { ?> selected="selected" <?php } ?>><?php echo $capacity['capacity']; ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Base Fare</label>

                            <div class="col-md-9">
                                <input type="text" value="<?php echo $vehicles['basefare']; ?>" id="basefare_edit"
                                       name="basefare_edit" class="form-control input-medium" placeholder="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Minimum Hrs</label>

                            <div class="col-md-9">
                                <input type="text" id="min_hrs_edit" name="min_hrs_edit"
                                       class="form-control input-medium" value="<?php echo $vehicles['min_hrs']; ?>"
                                       placeholder="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Km Unit</label>

                            <div class="col-md-9">
                                <input type="text" id="kmunit_edit" value="<?php echo $vehicles['km_multiplier']; ?>"
                                       name="kmunit_edit" class="form-control input-medium" placeholder="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Time Unit</label>

                            <div class="col-md-9">
                                <input type="text" id="timeunit_edit"
                                       value="<?php echo $vehicles['time_multiplier']; ?>" name="timeunit_edit"
                                       class="form-control input-medium" placeholder="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>

                            <div class="col-md-9">
                                <img src="<?php echo base_url() . "uploads/vehicles/" . $vehicles['photo']; ?>"
                                     width="50" height="50"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Icon</label>

                            <div class="col-md-9">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="input-group input-large">
                                        <div class="form-control uneditable-input span3" data-trigger="fileinput">
                                            <i class="fa fa-file fileinput-exists"></i>&nbsp; <span
                                                class="fileinput-filename">
														</span>
                                        </div>
													<span class="input-group-addon btn default btn-file">
													<span class="fileinput-new">
													Select file </span>
													<span class="fileinput-exists">
													Change </span>
													<input type="file" name="vehicle_image_edit"
                                                           id="vehicle_image_edit">
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
                                <select id="country_edit" name="country_edit" class="form-control input-medium">
                                    <?php foreach($country as $key => $value){ ?>
                                        <option value="<?php echo $key; ?>" <?php if($vehicles['country']==$key){ ?>selected<?php } ?>> <?php echo $value; ?> </option>
                                    <?php }  ?>
                                </select>
                                <span id="errorMsg" style="color:red"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">KM</label>

                            <div class="col-md-9">
                                <input type="text" class="form-control input-inline input-medium" placeholder=""
                                       name="km_edit" id="km_edit" value="<?php echo $vehicles['kmreading']; ?>"
                                       required>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer ">
                <button type="button" class="btn blue"
                        onclick="updateVehicle(<?php echo $vehicles['idvendorprofile']; ?>,'<?php echo $vehicles['photo']; ?>');">
                    Save changes
                </button>
                <button type="button" class="btn default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


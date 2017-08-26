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

    <!-- END SIDEBAR -->
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <div class="page-content">
            <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
            <div id="editview"></div>
            <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">Add Standard</h4>
                        </div>
                        <div class="modal-body">
                            <form action="#" class="form-horizontal" id="default">
                                <div class="form-body">
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
                                            <select id="country" name="country" class="form-control input-medium">
                                                <?php foreach($country as $key => $value){ ?>
                                                    <option value="<?php echo $key; ?>"> <?php echo $value; ?> </option>
                                                <?php }  ?>
                                            </select>
                                            <span id="errorMsg" style="color:red"></span>
                                        </div>
                                    </div>
                                    <form action="#" class="form-horizontal" id="default">
                                        <div class="form-body">
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Currency</label>

                                                <div class="col-md-9">
                                                    <?php
                                                    $currency  = array("AFA"=>"Afghani","AFN"=>"Afghani","ALK"=>"Albanian old lek","ALL"=>"Lek","DZD"=>"Algerian Dinar",
                                                        "USD"=>"US Dollar","ADF"=>"Andorran Franc","ADP"=>"Andorran Peseta","EUR"=>"Euro","AOR"=>"Angolan Kwanza Readjustado",
                                                        "AON"=>"Angolan New Kwanza","AOA"=>"Kwanza","XCD"=>"East Caribbean Dollar","ARA"=>"Argentine austral","ARS"=>"Argentine Peso",
                                                        "ARL"=>"Argentine peso ley","ARM"=>"Argentine peso moneda nacional","ARP"=>"Peso argentino","AMD"=>"Armenian Dram",
                                                        "AWG"=>"Aruban Guilder","AUD"=>"Australian Dollar","ATS"=>"Austrian Schilling","AZM"=>"Azerbaijani manat","AZN"=>"Azerbaijanian Manat",
                                                        "BSD"=>"Bahamian Dollar","BHD"=>"Bahraini Dinar","BDT"=>"Taka","BBD"=>"Barbados Dollar","BYR"=>"Belarussian Ruble",
                                                        "BEC"=>"Belgian Franc (convertible)","BEF"=>"Belgian Franc (currency union with LUF)","BEL"=>"Belgian Franc (financial)",
                                                        "BZD"=>"Belize Dollar","XOF"=>"CFA Franc BCEAO","BMD"=>"Bermudian Dollar","INR"=>"Indian Rupee","BTN"=>"Ngultrum",
                                                        "BOP"=>"Bolivian peso","BOB"=>"Boliviano","BOV"=>"Mvdol","BAM"=>"Convertible Marks","BWP"=>"Pula",
                                                        "NOK"=>"Norwegian Krone","BRC"=>"Brazilian cruzado","BRB"=>"Brazilian cruzeiro","BRL"=>"Brazilian Real",
                                                        "BND"=>"Brunei Dollar","BGN"=>"Bulgarian Lev","BGJ"=>"Bulgarian lev A/52","BGK"=>"Bulgarian lev A/62",
                                                        "BGL"=>"Bulgarian lev A/99","BIF"=>"Burundi Franc","KHR"=>"Riel","XAF"=>"CFA Franc BEAC",
                                                        "CAD"=>"Canadian Dollar","CVE"=>"Cape Verde Escudo","KYD"=>"Cayman Islands Dollar","CLP"=>"Chilean Peso",
                                                        "CLF"=>"Unidades de fomento","CNX"=>"Chinese People's Bank dollar","CNY"=>"Yuan Renminbi",
                                                        "COP"=>"Colombian Peso","COU"=>"Unidad de Valor real","KMF"=>"Comoro Franc","CDF"=>"Franc Congolais",
                                                        "NZD"=>"New Zealand Dollar","CRC"=>"Costa Rican Colon","HRK"=>"Croatian Kuna","CUP"=>"Cuban Peso","CYP"=>"Cyprus Pound",
                                                        "CZK"=>"Czech Koruna","CSK"=>"Czechoslovak koruna","CSJ"=>"Czechoslovak koruna A/53","DKK"=>"Danish Krone","DJF"=>"Djibouti Franc",
                                                        "DOP"=>"Dominican Peso","ECS"=>"Ecuador sucre","EGP"=>"Egyptian Pound","SVC"=>"Salvadoran colón","EQE"=>"Equatorial Guinean ekwele",
                                                        "ERN"=>"Nakfa","EEK"=>"Kroon","ETB"=>"Ethiopian Birr","FKP"=>"Falkland Island Pound","FJD"=>"Fiji Dollar","FIM"=>"Finnish Markka",
                                                        "FRF"=>"French Franc","XFO"=>"Gold-Franc","XPF"=>"CFP Franc","GMD"=>"Dalasi","GEL"=>"Lari","DDM"=>"East German Mark of the GDR (East Germany)",
                                                        "DEM"=>"Deutsche Mark","GHS"=>"Ghana Cedi","GHC"=>"Ghanaian cedi","GIP"=>"Gibraltar Pound","GRD"=>"Greek Drachma","GTQ"=>"Quetzal",
                                                        "GNF"=>"Guinea Franc","GNE"=>"Guinean syli","GWP"=>"Guinea-Bissau Peso","GYD"=>"Guyana Dollar","HTG"=>"Gourde","HNL"=>"Lempira",
                                                        "HKD"=>"Hong Kong Dollar","HUF"=>"Forint","ISK"=>"Iceland Krona","ISJ"=>"Icelandic old krona","IDR"=>"Rupiah","IRR"=>"Iranian Rial",
                                                        "IQD"=>"Iraqi Dinar","IEP"=>"Irish Pound (Punt in Irish language)","ILP"=>"Israeli lira","ILR"=>"Israeli old sheqel",
                                                        "ILS"=>"New Israeli Sheqel","ITL"=>"Italian Lira","JMD"=>"Jamaican Dollar","JPY"=>"Yen","JOD"=>"Jordanian Dinar",
                                                        "KZT"=>"Tenge","KES"=>"Kenyan Shilling","KPW"=>"North Korean Won","KRW"=>"Won","KWD"=>"Kuwaiti Dinar","KGS"=>"Som",
                                                        "LAK"=>"Kip","LAJ"=>"Lao kip","LVL"=>"Latvian Lats","LBP"=>"Lebanese Pound","LSL"=>"Loti","ZAR"=>"Rand",
                                                        "LRD"=>"Liberian Dollar","LYD"=>"Libyan Dinar","CHF"=>"Swiss Franc","LTL"=>"Lithuanian Litas","LUF"=>"Luxembourg Franc (currency union with BEF)",
                                                        "MOP"=>"Pataca","MKD"=>"Denar","MKN"=>"Former Yugoslav Republic of Macedonia denar A/93","MGA"=>"Malagasy Ariary","MGF"=>"Malagasy franc","MWK"=>"Kwacha",
                                                        "MYR"=>"Malaysian Ringgit","MVQ"=>"Maldive rupee","MVR"=>"Rufiyaa","MAF"=>"Mali franc","MTL"=>"Maltese Lira","MRO"=>"Ouguiya","MUR"=>"Mauritius Rupee",
                                                        "MXN"=>"Mexican Peso","MXP"=>"Mexican peso","MXV"=>"Mexican Unidad de Inversion (UDI)","MDL"=>"Moldovan Leu","MCF"=>"Monegasque franc (currency union with FRF)",
                                                        "MNT"=>"Tugrik","MAD"=>"Moroccan Dirham","MZN"=>"Metical","MZM"=>"Mozambican metical","MMK"=>"Kyat","NAD"=>"Namibia Dollar","NPR"=>"Nepalese Rupee",
                                                        "NLG"=>"Netherlands Guilder","ANG"=>"Netherlands Antillian Guilder","NIO"=>"Cordoba Oro","NGN"=>"Naira","OMR"=>"Rial Omani","PKR"=>"Pakistan Rupee",
                                                        "PAB"=>"Balboa","PGK"=>"Kina","PYG"=>"Guarani","YDD"=>"South Yemeni dinar","PEN"=>"Nuevo Sol","PEI"=>"Peruvian inti","PEH"=>"Peruvian sol",
                                                        "PHP"=>"Philippine Peso","PLZ"=>"Polish zloty A/94","PLN"=>"Zloty","PTE"=>"Portuguese Escudo","TPE"=>"Portuguese Timorese escudo","QAR"=>"Qatari Rial",
                                                        "RON"=>"New Leu","ROL"=>"Romanian leu A/05","ROK"=>"Romanian leu A/52","RUB"=>"Russian Ruble","RWF"=>"Rwanda Franc","SHP"=>"Saint Helena Pound","WST"=>"Tala",
                                                        "STD"=>"Dobra","SAR"=>"Saudi Riyal","RSD"=>"Serbian Dinar","CSD"=>"Serbian Dinar","SCR"=>"Seychelles Rupee","SLL"=>"Leone","SGD"=>"Singapore Dollar",
                                                        "SKK"=>"Slovak Koruna","SIT"=>"Slovenian Tolar","SBD"=>"Solomon Islands Dollar","SOS"=>"Somali Shilling",
                                                        "ZAL"=>"South African financial rand (Funds code) (discont","ESP"=>"Spanish Peseta","ESA"=>"Spanish peseta (account A)",
                                                        "ESB"=>"Spanish peseta (account B)","LKR"=>"Sri Lanka Rupee","SDD"=>"Sudanese Dinar","SDP"=>"Sudanese Pound","SDG"=>"Sudanese Pound",
                                                        "SRD"=>"Surinam Dollar","SRG"=>"Suriname guilder","SZL"=>"Lilangeni","SEK"=>"Swedish Krona","CHE"=>"WIR Euro","CHW"=>"WIR Franc","SYP"=>"Syrian Pound",
                                                        "TWD"=>"New Taiwan Dollar","TJS"=>"Somoni","TJR"=>"Tajikistan ruble","TZS"=>"Tanzanian Shilling","THB"=>"Baht","TOP"=>"Pa'anga","TTD"=>"Trinidata and Tobago Dollar",
                                                        "TND"=>"Tunisian Dinar","TRY"=>"New Turkish Lira","TRL"=>"Turkish lira A/05","TMM"=>"Manat","RUR"=>"Russian rubleA/97","SUR"=>"Soviet Union ruble",
                                                        "UGX"=>"Uganda Shilling","UGS"=>"Ugandan shilling A/87","UAH"=>"Hryvnia","UAK"=>"Ukrainian karbovanets","AED"=>"UAE Dirham","GBP"=>"Pound Sterling",
                                                        "USN"=>"US Dollar (Next Day)","USS"=>"US Dollar (Same Day)","UYU"=>"Peso Uruguayo","UYN"=>"Uruguay old peso","UYI"=>"Uruguay Peso en Unidades Indexadas",
                                                        "UZS"=>"Uzbekistan Sum","VUV"=>"Vatu","VEF"=>"Bolivar Fuerte","VEB"=>"Venezuelan Bolivar","VND"=>"Dong","VNC"=>"Vietnamese old dong","YER"=>"Yemeni Rial",
                                                        "YUD"=>"Yugoslav Dinar","YUM"=>"Yugoslav dinar (new)","ZRN"=>"Zairean New Zaire","ZRZ"=>"Zairean Zaire","ZMK"=>"Kwacha","ZWD"=>"Zimbabwe Dollar",
                                                        "ZWC"=>"Zimbabwe Rhodesian dollar");
                                                    asort($currency);

                                                    ?>
                                                    <select id="currency" name="currency" class="form-control input-medium">
                                                        <?php foreach($currency as $key => $value){ ?>
                                                            <option value="<?php echo $key; ?>"> <?php echo $value; ?> </option>
                                                        <?php }  ?>

                                                    </select>
                                                    <span id="errorMsg" style="color:red"></span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Exchange Rate</label>

                                                <div class="col-md-9">
                                                    <input type="text" id="xRate" name="xRate"
                                                           class="form-control input-medium" placeholder="With Respect to USD">
                                                </div>
                                                <span id="errorMsg" style="color:red"></span>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Distance Unit</label>

                                                <div class="col-md-9">
                                                    <select id="distanceUnit" name="distanceUnit" class="form-control input-medium">
                                                        <option value="0">Select</option>
                                                        <option value="km">Kilo Meter</option>
                                                        <option value="mi">Mile</option>
                                                    </select>
                                                    <span id="errorMsg" style="color:red"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </form>
                        </div>
                        <div class="modal-footer ">
                            <button type="button" class="btn green pull-left" onclick="saveStandard();">Save</button>
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
                    <h1>Standard Management</h1>
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
                            <div class="caption"><i class="fa fa-globe"></i>Standards</div>
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
                                    <th>Country</th>
                                    <th>Country Code</th>
                                    <th>Currency Code</th>
                                    <th>Exchange Rate</th>
                                    <th>Distance Unit</th>
                                    <th> Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if ($transaction != 0) { ?>
                                    <?php foreach ($transaction as $transaction) { ?>
                                        <tr>
                                            <td> <?php echo $transaction['country']; ?> </td>
                                            <td> <?php echo $transaction['countryCode']; ?> </td>
                                            <td> <?php echo $transaction['currencyCode']; ?> </td>
                                            <td> <?php echo $transaction['exchangeRate']; ?> </td>
                                            <?php if($transaction['distanceUnit']=='km'){ ?>
                                                <td> Kilo Meter </td>
                                            <?php }else{ ?>
                                                <td> Mile </td>
                                            <?php } ?>
                                            <td>
                                                <?php if ($checking['edit'] == 1 || $checking['edit'] == '1') { ?>
                                                    <button class="btn btn-primary btn-xs" title="Edit"
                                                            data-toggle="modal"
                                                            onClick="editStandard(<?php echo $transaction['id']; ?>)">
                                                        <i class="fa fa-pencil"></i></button>
                                                <?php } ?>
                                        <?php if ($checking['delete'] == 1 || $checking['delete'] == '1') { ?>
                                                    <button class="btn btn-danger btn-xs" title="Disable"
                                                            onClick="activateCoupon(<?php echo $transaction['id']; ?>,0);"><i
                                                            class="fa fa-ban"></i></button>
                                        <?php } ?>
                                            </td>
                                        </tr>
                                        <?php
                                    } ?>
                                <?php } else { ?>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>No Data</td>
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

    $.validator.addMethod("select_valid", function (value, element) {
        var position = $('#country').val();
        if (value != 0) {
            return 'true';
        }
    }, "Select a country");
    $.validator.addMethod("select_valid_1", function (value, element) {
        var position = $('#currency').val();
        if (value != 0) {
            return 'true';
        }
    }, "Select a currency");

    $.validator.addMethod("select_valid_2", function (value, element) {
        var position = $('#distanceUnit').val();
        if (value != 0) {
            return 'true';
        }
    }, "Select a distance unit");

    jQuery.validator.setDefaults({debug: true});

    var form = $("#default");

    form.validate({
        errorElement: "div",
        errorClass: "font-red-haze",
        errorPlacement: function (error, element) {
            error.appendTo(element.parents(".col-md-9"));
        },
        rules: {
            'country': {select_valid: true},
            'currency': {select_valid_1: true},
            'xRate': {required: true},
            'xRate': {number: true},
            'distanceUnit': {select_valid_2: true}
        }
    });
    function saveStandard() {
        if (form.valid()) {
            $.ajax({
                url: "<?php echo site_url('transact/transaction/add'); ?>",
                type: 'POST',
                data: {
                    country: $("#country option:selected").val(),
                    currency: $("#currency option:selected").val(),
                    xRate:$("#xRate").val(),
                    distanceUnit: $("#distanceUnit").val(),
                    countryName: $("#country option:selected").text()
                },
                success: function (msg) {
                    if (msg == 1 || msg == '1') {
                        location.reload();
                    } else {
                        $("#errorMsg").html('Country already exists');
                    }
                }
            });
        }
    }
    function editStandard(id) {
        string_array = "standardId=" + id;

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('transact/transaction/edit_view');  ?>",
            data: string_array,
            success: function (msg) {

                $("#editview").html(msg);
                $('#edit_popup').trigger("click");

            }
        });
    }

    function activateCoupon(standardId) {
        var r = confirm("Are you sure want to delete this?");
        if (r == true) {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('transact/transaction/delete'); ?>",
                data: {standardId: standardId},
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

    function updateStandard(id) {
        var form_update = $("#default1");
        form_update.validate({
            errorElement: "label",
            errorClass: "font-red-haze",
            rules: {
                'country_edit': {select_valid: true},
                'currency_edit': {select_valid_1: true},
                'xRate_edit': {required: true},
                'xRate_edit': {number: true},
                'distanceUnit_edit': {select_valid_2: true}
            }
        });
        if (form_update.valid()) {
            $.ajaxFileUpload({
                url: "<?php echo site_url('transact/transaction/update'); ?>",
                type: 'post',
                secureuri: false,
                fileElementId: 'capacity_image_edit',
                dataType: 'json',
                data: {
                    id: id,
                    country_edit: $("#country_edit option:selected").val(),
                    currency_edit: $("#currency_edit option:selected").val(),
                    xRate_edit:$("#xRate_edit").val(),
                    distanceUnit_edit: $("#distanceUnit_edit").val(),
                    countryName_edit: $("#country_edit option:selected").text()
                },
                success: function (msg) {
                    location.reload();
                }
            });
        }
    }


    <!---->
</script>
</body><!-- END BODY -->
</html>
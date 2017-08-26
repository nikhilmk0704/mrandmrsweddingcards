<a href="#capacityEdit" data-toggle="modal" class="config" id="edit_popup"></a>
<div class="modal fade" id="capacityEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
              <h4 class="modal-title">Edit Capacity</h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" role="form" id="default1">
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
                              <select id="country_edit" name="country_edit" class="form-control input-medium">
                                  <?php foreach($country as $key => $value){ ?>
                                      <option value="<?php echo $key; ?>" <?php if($standard['countryCode']==$key){ ?>selected<?php } ?>> <?php echo $value; ?> </option>
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
                                      <select id="currency_edit" name="currency_edit" class="form-control input-medium">
                                          <?php foreach($currency as $key => $value){ ?>
                                              <option value="<?php echo $key; ?>" <?php if($standard['currencyCode']==$key){ ?>selected<?php } ?>> <?php echo $value; ?> </option>
                                          <?php }  ?>

                                      </select>
                                      <span id="errorMsg" style="color:red"></span>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="col-md-3 control-label">Exchange Rate</label>

                                  <div class="col-md-9">
                                      <input type="text" id="xRate_edit" name="xRate_edit" value="<?php echo $standard['exchangeRate']; ?>"
                                             class="form-control input-medium">
                                  </div>
                                  <span id="errorMsg" style="color:red"></span>
                              </div>
                              <div class="form-group">
                                  <label class="col-md-3 control-label">Distance Unit</label>

                                  <div class="col-md-9">
                                      <select id="distanceUnit_edit" name="distanceUnit_edit" class="form-control input-medium">
                                          <option value="0">Select</option>
                                          <option value="km" <?php if($standard['distanceUnit']== "km"){ ?>selected<?php } ?>>Kilo Meter</option>
                                          <option value="mi" <?php if($standard['distanceUnit']== "mi"){ ?>selected<?php } ?>>Mile</option>
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
              <button type="button" class="btn blue" onclick="updateStandard(<?php echo $standard['id']; ?>);">Save changes</button>
              <button type="button" class="btn default" data-dismiss="modal">Close</button>
            </div>
          </div>
          <!-- /.modal-content --> 
        </div>
        <!-- /.modal-dialog --> 
      </div>
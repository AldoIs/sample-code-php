<?php
	/*
	 * This is an example page of the form fields required for a PayGate PayWeb 3 transaction.
	 */

	/*
	 * Sessions used here only because we can't get the PayGate ID, Transaction reference and secret key on the result page.
	 *
	 * First input so we make sure there is nothing in the session.
	 */
	session_name('paygate_payweb3_testing_sample');
	session_start();
	session_destroy();

	/*
	 * Directory stuff
	 */
	include_once('lib/functions.php');

	$fullPath  = getCurrentUrl();
	$directory = getFinalDirectory($fullPath);

	/*
	 * Example function to generate unique transaction reference
	 */
	function generateReference(){
		return 'pgtest_' . getDateTime('YmdHis');
	}

	function getDateTime($format){
		$dateTime = new DateTime();
		return $dateTime->format($format);
	}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<title>PayWeb 3 - Initiate</title>
		<link rel="stylesheet" href="css/paygate.css">
	</head>
	<body>
		<div class="container">
			<div class="header">
				<img src="images/paygate-logo.png" alt="PayGate" height="60" width="175" /><span>PayWeb 3 Sample Code - Step 1: Input</span>
			</div>
			<div class="header-bar"><a class="btn btn-submit" href="input.php">Input</a> | <a class="btn btn-submit" href="query.php">Query</a></div>
			<form action="request.php" method="post" name="paygate_initiate_form">
				<label for="PAYGATE_ID">PayGate ID</label>
				<input class="form-input" type="text" name="PAYGATE_ID" id="PAYGATE_ID" value="10011072130" />
				<br>
				<label for="REFERENCE">Reference</label>
				<input class="form-input" type="text" name="REFERENCE" id="REFERENCE" value="<?php echo generateReference(); ?>" />
				<br>
				<label for="AMOUNT">Amount</label>
				<input class="form-input" type="text" name="AMOUNT" id="AMOUNT" value="100" />
				<br>
				<label for="CURRENCY">Currency</label>
				<input class="form-input" type="text" name="CURRENCY" id="CURRENCY" value="ZAR" />
				<br>
				<label for="RETURN_URL">Return URL</label>
				<input class="form-input" type="text" name="RETURN_URL" id="RETURN_URL" value="<?php echo $directory;?>result.php" />
				<br>
				<label for="TRANSACTION_DATE">Transaction Date</label>
				<input class="form-input" type="text" name="TRANSACTION_DATE" id="TRANSACTION_DATE" value="<?php echo getDateTime('Y-m-d H:i:s'); ?>" />
				<br>
				<label for="LOCALE">Locale</label>
				<input class="form-input" type="text" name="LOCALE" id="LOCALE" value="en-za" />
				<br>
				<label for="COUNTRY">Country</label>
				<select name="COUNTRY" id="COUNTRY">
					<optgroup label="">
						<option value="" >Select Country</option>
					</optgroup>
					<optgroup label="common choices">
						<option value="ARG">Argentina</option>
						<option value="BRA">Brazil</option>
						<option value="CHL">Chile</option>
						<option value="MEX">Mexico</option>
						<option value="GBR">United Kingdom</option>
						<option value="USA">United States</option>
						<option value="ZAF" selected="selected">South Africa</option>
					</optgroup>
					<optgroup label="other countries">
						<option value="AFG">Afghanistan</option>
						<option value="ALB">Albania</option>
						<option value="DZA">Algeria</option>
						<option value="ASM">American Samoa</option>
						<option value="AND">Andorra</option>
						<option value="AGO">Angola</option>
						<option value="AIA">Anguilla</option>
						<option value="ATA">Antarctica</option>
						<option value="ATG">Antigua and Barbuda</option>
						<option value="ARG">Argentina</option>
						<option value="ARM">Armenia</option>
						<option value="ABW">Aruba</option>
						<option value="AUS">Australia</option>
						<option value="AUT">Austria</option>
						<option value="AZE">Azerbaijan</option>
						<option value="BHS">Bahamas</option>
						<option value="BHR">Bahrain</option>
						<option value="BGD">Bangladesh</option>
						<option value="BRB">Barbados</option>
						<option value="BLR">Belarus</option>
						<option value="BEL">Belgium</option>
						<option value="BLZ">Belize</option>
						<option value="BEN">Benin</option>
						<option value="BMU">Bermuda</option>
						<option value="BTN">Bhutan</option>
						<option value="BOL">Bolivia</option>
						<option value="BIH">Bosnia and Herzegovina</option>
						<option value="BWA">Botswana</option>
						<option value="BVT">Bouvet Island</option>
						<option value="BRA">Brazil</option>
						<option value="IOT">British Indian Ocean Territory</option>
						<option value="VGB">British Virgin Islands</option>
						<option value="BRN">Brunei Darussalam</option>
						<option value="BGR">Bulgaria</option>
						<option value="BFA">Burkina Faso</option>
						<option value="BDI">Burundi</option>
						<option value="KHM">Cambodia</option>
						<option value="CMR">Cameroon</option>
						<option value="CAN">Canada</option>
						<option value="CPV">Cape Verde</option>
						<option value="CYM">Cayman Islands</option>
						<option value="CAF">Central African Republic</option>
						<option value="TCD">Chad</option>
						<option value="CHL">Chile</option>
						<option value="CHN">China</option>
						<option value="CXR">Christmas Island</option>
						<option value="CCK">Cocos (Keeling) Islands</option>
						<option value="COL">Colombia</option>
						<option value="COL">Comoros</option>
						<option value="COG">Congo</option>
						<option value="COD">Congo, The Democratic Republic of The</option>
						<option value="COK">Cook Islands</option>
						<option value="CRI">Costa Rica</option>
						<option value="CIV">Cote D'ivoire</option>
						<option value="CHRV">Croatia</option>
						<option value="CUB">Cuba</option>
						<option value="CYP">Cyprus</option>
						<option value="CZE">Czech Republic</option>
						<option value="DNK">Denmark</option>
						<option value="DJI">Djibouti</option>
						<option value="DMA">Dominica</option>
						<option value="DOM">Dominican Republic</option>
						<option value="ECU">Ecuador</option>
						<option value="EGY">Egypt</option>
						<option value="SLV">El Salvador</option>
						<option value="GNQ">Equatorial Guinea</option>
						<option value="ERI">Eritrea</option>
						<option value="EST">Estonia</option>
						<option value="ETH">Ethiopia</option>
						<option value="FLK">Falkland Islands (Malvinas)</option>
						<option value="FRO">Faroe Islands</option>
						<option value="FJI">Fiji</option>
						<option value="FIN">Finland</option>
						<option value="FRA">France</option>
						<option value="FXX">French Metropolitan</option>
						<option value="GUF">French Guiana</option>
						<option value="PYF">French Polynesia</option>
						<option value="ATF">French Southern Territories</option>
						<option value="GAB">Gabon</option>
						<option value="GMB">Gambia</option>
						<option value="GEO">Georgia</option>
						<option value="DEU">Germany</option>
						<option value="GHA">Ghana</option>
						<option value="GIB">Gibraltar</option>
						<option value="GRC">Greece</option>
						<option value="GRL">Greenland</option>
						<option value="GRD">Grenada</option>
						<option value="GLP">Guadeloupe</option>
						<option value="GUM">Guam</option>
						<option value="GTM">Guatemala</option>
						<option value="GIN">Guinea</option>
						<option value="GNB">Guinea-bissau</option>
						<option value="GUY">Guyana</option>
						<option value="HTI">Haiti</option>
						<option value="HMD">Heard Island and Mcdonald Islands</option>
						<option value="VAT">Holy See (Vatican City State)</option>
						<option value="HND">Honduras</option>
						<option value="HKG">Hong Kong</option>
						<option value="HUN">Hungary</option>
						<option value="ISL">Iceland</option>
						<option value="IND">India</option>
						<option value="IDN">Indonesia</option>
						<option value="IRN">Iran, Islamic Republic of</option>
						<option value="IRQ">Iraq</option>
						<option value="IRL">Ireland</option>
						<option value="ISR">Israel</option>
						<option value="ITA">Italy</option>
						<option value="JAM">Jamaica</option>
						<option value="JPN">Japan</option>
						<option value="JOR">Jordan</option>
						<option value="KAZ">Kazakhstan</option>
						<option value="KEN">Kenya</option>
						<option value="KIR">Kiribati</option>
						<option value="PRK">Korea, Democratic People's Republic of</option>
						<option value="KOR">Korea, Republic of</option>
						<option value="KWT">Kuwait</option>
						<option value="KGZ">Kyrgyzstan</option>
						<option value="LAO">Lao People's Democratic Republic</option>
						<option value="LVA">Latvia</option>
						<option value="LBN">Lebanon</option>
						<option value="LSO">Lesotho</option>
						<option value="LBR">Liberia</option>
						<option value="LBY">Libyan Arab Jamahiriya</option>
						<option value="LIE">Liechtenstein</option>
						<option value="LTU">Lithuania</option>
						<option value="LUX">Luxembourg</option>
						<option value="MAC">Macau China</option>
						<option value="MKD">Macedonia, The Former Yugoslav Republic of</option>
						<option value="MDG">Madagascar</option>
						<option value="MWI">Malawi</option>
						<option value="MYS">Malaysia</option>
						<option value="MDV">Maldives</option>
						<option value="MLI">Mali</option>
						<option value="MLT">Malta</option>
						<option value="MHL">Marshall Islands</option>
						<option value="MTQ">Martinique</option>
						<option value="MRT">Mauritania</option>
						<option value="MUS">Mauritius</option>
						<option value="MYT">Mayotte</option>
						<option value="MEX">Mexico</option>
						<option value="FSM">Micronesia, Federated States of</option>
						<option value="MDA">Moldova, Republic of</option>
						<option value="MCO">Monaco</option>
						<option value="MNG">Mongolia</option>
						<option value="MSR">Montserrat</option>
						<option value="MAR">Morocco</option>
						<option value="MOZ">Mozambique</option>
						<option value="MMR">Myanmar</option>
						<option value="NAM">Namibia</option>
						<option value="NRU">Nauru</option>
						<option value="NPL">Nepal</option>
						<option value="NLD">Netherlands</option>
						<option value="ANT">Netherlands Antilles</option>
						<option value="NCL">New Caledonia</option>
						<option value="NZL">New Zealand</option>
						<option value="NIC">Nicaragua</option>
						<option value="NER">Niger</option>
						<option value="NGA">Nigeria</option>
						<option value="NIU">Niue</option>
						<option value="NFK">Norfolk Island</option>
						<option value="MNP">Northern Mariana Islands</option>
						<option value="NOR">Norway</option>
						<option value="OMN">Oman</option>
						<option value="PAK">Pakistan</option>
						<option value="PLW">Palau</option>
						<option value="PAN">Panama</option>
						<option value="PNG">Papua New Guinea</option>
						<option value="PRY">Paraguay</option>
						<option value="PER">Peru</option>
						<option value="PHL">Philippines</option>
						<option value="PCN">Pitcairn</option>
						<option value="POL">Poland</option>
						<option value="PRT">Portugal</option>
						<option value="PRI">Puerto Rico</option>
						<option value="QAT">Qatar</option>
						<option value="REU">Reunion</option>
						<option value="ROM">Romania</option>
						<option value="RUS">Russian Federation</option>
						<option value="RWA">Rwanda</option>
						<option value="SHN">Saint Helena</option>
						<option value="KNA">Saint Kitts and Nevis</option>
						<option value="LCA">Saint Lucia</option>
						<option value="SPM">Saint Pierre and Miquelon</option>
						<option value="VCT">Saint Vincent and The Grenadines</option>
						<option value="WSM">Samoa</option>
						<option value="SMR">San Marino</option>
						<option value="STP">Sao Tome and Principe</option>
						<option value="SAU">Saudi Arabia</option>
						<option value="SEN">Senegal</option>
						<option value="SYC">Seychelles</option>
						<option value="SLE">Sierra Leone</option>
						<option value="SGP">Singapore</option>
						<option value="SVK">Slovakia</option>
						<option value="SVN">Slovenia</option>
						<option value="SLB">Solomon Islands</option>
						<option value="SOM">Somalia</option>
						<option value="ZAF">South Africa</option>
						<option value="SGS">South Georgia and The South Sandwich Islands</option>
						<option value="ESP">Spain</option>
						<option value="LKA">Sri Lanka</option>
						<option value="SDN">Sudan</option>
						<option value="SUR">Suriname</option>
						<option value="SJM">Svalbard and Jan Mayen</option>
						<option value="SWZ">Swaziland</option>
						<option value="SWE">Sweden</option>
						<option value="CHE">Switzerland</option>
						<option value="SYR">Syrian Arab Republic</option>
						<option value="TWN">Taiwan, Province of China</option>
						<option value="TJK">Tajikistan</option>
						<option value="TZA">Tanzania, United Republic of</option>
						<option value="THA">Thailand</option>
						<option value="TGO">Togo</option>
						<option value="TKL">Tokelau</option>
						<option value="TON">Tonga</option>
						<option value="TTO">Trinidad and Tobago</option>
						<option value="TUN">Tunisia</option>
						<option value="TUR">Turkey</option>
						<option value="TKM">Turkmenistan</option>
						<option value="TCA">Turks and Caicos Islands</option>
						<option value="TUV">Tuvalu</option>
						<option value="UGA">Uganda</option>
						<option value="UKR">Ukraine</option>
						<option value="ARE">United Arab Emirates</option>
						<option value="GBR">United Kingdom</option>
						<option value="USA">United States</option>
						<option value="UMI">United States Minor Outlying Islands</option>
						<option value="VIR">U.S. Virgin Islands</option>
						<option value="URY">Uruguay</option>
						<option value="UZB">Uzbekistan</option>
						<option value="VUT">Vanuatu</option>
						<option value="VEN">Venezuela</option>
						<option value="VNM">Vietnam</option>
						<option value="WLF">Wallis and Futuna</option>
						<option value="ESH">Western Sahara</option>
						<option value="YEM">Yemen</option>
						<option value="YUG">Yugoslavia</option>
						<option value="ZMB">Zambia</option>
						<option value="ZWE">Zimbabwe</option>
					</optgroup>
				</select>
				<br>
				<label for="EMAIL">Customer Email</label>
				<input class="form-input" type="text" name="EMAIL" id="EMAIL" value="support@paygate.co.za" />
				<br>
				<div id="extraFieldsDiv" class="well">
					<label for="PAY_METHOD">Pay Method</label>
					<input class="form-input" type="text" name="PAY_METHOD" id="PAY_METHOD" placeholder="optional" />
					<br>
					<label for="PAY_METHOD_DETAIL">Pay Method Detail</label>
					<input class="form-input" type="text" name="PAY_METHOD_DETAIL" id="PAY_METHOD_DETAIL" placeholder="optional" />
					<br>
					<label for="NOTIFY_URL">Notify URL</label>
					<input class="form-input" type="text" name="NOTIFY_URL" id="NOTIFY_URL" placeholder="optional" />
					<br>
					<label for="USER1">User Field 1</label>
					<input class="form-input" type="text" name="USER1" id="USER1"  placeholder="optional" />
					<br>
					<label for="USER2">User Field 2</label>
					<input class="form-input" type="text" name="USER2" id="USER2"  placeholder="optional" />
					<br>
					<label for="USER3">User Field 3</label>
					<input class="form-input" type="text" name="USER3" id="USER3" placeholder="optional" />
					<br>
					<label for="VAULT">Vault</label>
					<div class="radio">
						<label>
							<input type="radio" name="VAULT" id="VAULTOFF" value="" checked>
							No card Vaulting
						</label>
					</div>
					<div class="radio">
						<label>
							<input type="radio" name="VAULT" id="VAULTNO" value="0">
							Don't Vault card
						</label>
					</div>
					<div class="radio">
						<label>
							<input type="radio" name="VAULT" id="VAULTYES" value="1">
							Vault card
						</label>
					</div>
					<label for="VAULT_ID">Vault ID</label>
					<input class="form-control" type="text" name="VAULT_ID" id="VAULT_ID" placeholder="optional" />
				</div>
				<label for="encryption_key">Encryption Key</label>
				<input class="form-control" type="text" name="encryption_key" id="encryption_key" value="secret" />
				<br>
				<input class="btn btn-submit" type="submit" name="btnSubmit" value="Calculate Checksum" />
				<br>
			</form>
		</div>
	</body>
</html>
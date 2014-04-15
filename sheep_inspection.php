<?php
ini_set('memory_limit', '-1');
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Stock Certificate</title>
	<link rel="stylesheet" href="js/jquery-ui-1.10.3/css/smoothness/jquery-ui-1.10.3.custom.css" />
	<link rel="stylesheet" href="js/jquery-ui-1.10.3/development-bundle/themes/base/jquery.ui.all.css">
	<link rel="stylesheet" href="js/assets/jquery.signaturepad.css">
	<link rel="stylesheet" href="images/brands.css">

	<script src="js/jquery-ui-1.10.3/development-bundle/jquery-1.9.1.js"></script>
	<script src="js/jquery-ui-1.10.3/js/jquery-ui-1.10.3.custom.min.js"></script>
	<script src="js/jquery-ui-1.10.3/js/jquery-ui-1.10.3.custom.js"></script>
	<script src="js/jquery.min.js"></script>
	<script src="js/jquery.maxlength.js"></script>
	<script src="js/jquery-ui-1.10.3/development-bundle/ui/jquery.ui.core.js"></script>
	<script src="js/jquery-ui-1.10.3/development-bundle/ui/jquery.ui.widget.js"></script>
	<script src="js/jquery-ui-1.10.3/development-bundle/ui/jquery.ui.tabs.js"></script>
	<script src="js/jquery-ui-1.10.3/development-bundle/ui/jquery.ui.accordion.js"></script>
	<script src="js/livestock_000.js"></script>
	<script src="js/livestock_sheep.js"></script>

</head>
<body>
<div align="center">
  <center>
  <table border="0" cellpadding="5" cellspacing="0" width="1288" bgcolor="#FFFFFF">
    <tr>
      <td width="100%">
<!-- this is where the html formatting leaves off for the rest of the page -->
<?php
if(isset($_POST['add']))
{
include "zzzz.php";

//start calculations
$cert_date = date("Y-m-d");
$num_sheep = ($num_sheep_01 + $num_sheep_02 + $num_sheep_03 + $num_sheep_04 + $num_sheep_05 + $num_sheep_06 + $num_sheep_07 + $num_sheep_08 + $num_sheep_09 + $num_sheep_10);
$sheep_service_charge_fee = $num_sheep * .40;
$sheep_minimum_fee = 15;

if ($num_sheep < 1)
{
$sheep_minimum_fee = 0;
}
;
if ($num_sheep >= 1)
{
$sheep_minimum_fee = 15;
}
;
//this is for multiple/continuation stock certificates
$remove_min_fee = $_POST['remove_min_fee'];
if (!empty($remove_min_fee)){
$sheep_minimum_fee = 0;
}
;
$remove_svc_chg_fee = $_POST['remove_svc_chg_fee'];
if (!empty($remove_svc_chg_fee)){
$sheep_service_charge_fee = 0;
}
;

$total_due_fee = ($sheep_service_charge_fee + $sheep_minimum_fee);
//end calculations

// stuff to be reinstated once signatures are electronic again:
// , signature_inspector, signature_owner, signature_buyer - after inspection notes
// ,'$output_sig_inspector','$output_sig_owner', '$output_sig_buyer' - after inspection notes

$sql = "INSERT INTO certificates ".
       "(num_sheep, cert_date, clss_coin_owner, clss_name_owner, clss_address_owner,
clss_city_owner, clss_state_owner, clss_zip_owner, clss_county_owner, clss_coin_buyer,
clss_name_buyer, clss_address_buyer, clss_city_buyer, clss_state_buyer, clss_zip_buyer,
clss_county_buyer, num_sheep_01, num_sheep_02, num_sheep_03, num_sheep_04, num_sheep_05,
num_sheep_06, num_sheep_07, num_sheep_08, num_sheep_09, num_sheep_10,
sheep_breed_01, sheep_breed_02, sheep_breed_03, sheep_breed_04, sheep_breed_05,
sheep_breed_06, sheep_breed_07, sheep_breed_08, sheep_breed_09, sheep_breed_10,
sheep_color_01, sheep_color_02, sheep_color_03, sheep_color_04, sheep_color_05,
sheep_color_06, sheep_color_07, sheep_color_08, sheep_color_09, sheep_color_10,
sheep_gender_01, sheep_gender_02, sheep_gender_03, sheep_gender_04, sheep_gender_05,
sheep_gender_06, sheep_gender_07, sheep_gender_08, sheep_gender_09, sheep_gender_10,
sheep_minimum_fee, sheep_service_charge_fee, total_due_fee, paid_in_full, payment_method,
brand_sheep_01, brand_sheep_02, brand_sheep_03, brand_sheep_04, brand_sheep_05,
brand_sheep_06, brand_sheep_07, brand_sheep_08, brand_sheep_09, brand_sheep_10,
inspection_notes
) ".
       "VALUES('$num_sheep','$cert_date',
	   '$clss_coin_owner','$clss_name_owner','$clss_address_owner','$clss_city_owner','$clss_state_owner',
	   '$clss_zip_owner','$clss_county_owner','$clss_coin_buyer', '$clss_name_buyer',
	   '$clss_address_buyer','$clss_city_buyer','$clss_state_buyer','$clss_zip_buyer',
	   '$clss_county_buyer','$num_sheep_01', '$num_sheep_02', '$num_sheep_03', '$num_sheep_04', '$num_sheep_05',
	   '$num_sheep_06', '$num_sheep_07', '$num_sheep_08', '$num_sheep_09', '$num_sheep_10',
	   '$sheep_breed_01','$sheep_breed_02','$sheep_breed_03','$sheep_breed_04','$sheep_breed_05',
	   '$sheep_breed_06','$sheep_breed_07','$sheep_breed_08','$sheep_breed_09','$sheep_breed_10',
	   '$sheep_color_01','$sheep_color_02','$sheep_color_03','$sheep_color_04','$sheep_color_05',
	   '$sheep_color_06','$sheep_color_07','$sheep_color_08','$sheep_color_09','$sheep_color_10',
	   '$sheep_gender_01','$sheep_gender_02','$sheep_gender_03','$sheep_gender_04','$sheep_gender_05',
	   '$sheep_gender_06','$sheep_gender_07','$sheep_gender_08','$sheep_gender_09','$sheep_gender_10',
	   '$sheep_minimum_fee','$sheep_service_charge_fee','$total_due_fee','$paid_in_full','$payment_method',
	   '$output_sheep_01','$output_sheep_02','$output_sheep_03','$output_sheep_04','$output_sheep_05',
	   '$output_sheep_06','$output_sheep_07','$output_sheep_08','$output_sheep_09','$output_sheep_10',
	   '$inspection_notes'
	   )";
mysql_select_db('brands');
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}

//select a database to work with
$selected = mysql_select_db("brands",$conn)
  or die("Could not select brands");

// start of results display section
// gets the last stock certificate number from the database; this value will be used to display only the most recent record
$last_id = mysql_query("SELECT cert_serial_num FROM certificates ORDER BY cert_serial_num DESC LIMIT 1");
while($info = mysql_fetch_array( $last_id )){
$new = $info['cert_serial_num'];
}
//execute the SQL query and return records
$result = mysql_query("SELECT * FROM certificates WHERE cert_serial_num = $new");

require_once 'signature-to-image.php';

//fetch the data from the database
while ($row = mysql_fetch_array($result)) {
//if ($row['signature_inspector']) {
//	$imgInspector = sigJsonToImage($row['signature_inspector']);
//	imagepng($imgInspector, 'drawings/'.$new.'-inspector.png');
//	imagedestroy($imgInspector);
//}
//
//if ($row['signature_owner']) {
//	$imgOwner = sigJsonToImage($row['signature_owner']);
//	imagepng($imgOwner, 'drawings/'.$new.'-owner.png');
//	imagedestroy($imgOwner);
//}
//
//if ($row['signature_buyer']) {
//	$imgBuyer = sigJsonToImage($row['signature_buyer']);
//	imagepng($imgBuyer, 'drawings/'.$new.'-buyer.png');
//	imagedestroy($imgBuyer);
//}

if ($row['brand_sheep_01']) {
	$imgbrand_sheep_01 = sigJsonToImage($row['brand_sheep_01'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_sheep_01, 'drawings/'.$new.'-brand_sheep_01.png');
	imagedestroy($imgbrand_sheep_01);
}

if ($row['brand_sheep_02']) {
	$imgbrand_sheep_02 = sigJsonToImage($row['brand_sheep_02'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_sheep_02, 'drawings/'.$new.'-brand_sheep_02.png');
	imagedestroy($imgbrand_sheep_02);
}

if ($row['brand_sheep_03']) {
	$imgbrand_sheep_03 = sigJsonToImage($row['brand_sheep_03'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_sheep_03, 'drawings/'.$new.'-brand_sheep_03.png');
	imagedestroy($imgbrand_sheep_03);
}

if ($row['brand_sheep_04']) {
	$imgbrand_sheep_04 = sigJsonToImage($row['brand_sheep_04'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_sheep_04, 'drawings/'.$new.'-brand_sheep_04.png');
	imagedestroy($imgbrand_sheep_04);
}

if ($row['brand_sheep_05']) {
	$imgbrand_sheep_05 = sigJsonToImage($row['brand_sheep_05'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_sheep_05, 'drawings/'.$new.'-brand_sheep_05.png');
	imagedestroy($imgbrand_sheep_05);
}

if ($row['brand_sheep_06']) {
	$imgbrand_sheep_06 = sigJsonToImage($row['brand_sheep_06'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_sheep_06, 'drawings/'.$new.'-brand_sheep_06.png');
	imagedestroy($imgbrand_sheep_06);
}

if ($row['brand_sheep_07']) {
	$imgbrand_sheep_07 = sigJsonToImage($row['brand_sheep_07'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_sheep_07, 'drawings/'.$new.'-brand_sheep_07.png');
	imagedestroy($imgbrand_sheep_07);
}

if ($row['brand_sheep_08']) {
	$imgbrand_sheep_08 = sigJsonToImage($row['brand_sheep_08'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_sheep_08, 'drawings/'.$new.'-brand_sheep_08.png');
	imagedestroy($imgbrand_sheep_08);
}

if ($row['brand_sheep_09']) {
	$imgbrand_sheep_09 = sigJsonToImage($row['brand_sheep_09'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_sheep_09, 'drawings/'.$new.'-brand_sheep_09.png');
	imagedestroy($imgbrand_sheep_09);
}

if ($row['brand_sheep_10']) {
	$imgbrand_sheep_10 = sigJsonToImage($row['brand_sheep_10'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_sheep_10, 'drawings/'.$new.'-brand_sheep_10.png');
	imagedestroy($imgbrand_sheep_10);
}

echo "<h3>";
echo "<a href=\"pdf-output-sheep.php?cert_serial_num=".$row['cert_serial_num']."\">Click here to view Stock Certificate: " . $row['cert_series']. $row['cert_insp_num'] . $new . "</a>";
echo "</h3>";
}
// end of results display section

//close the connection
mysql_close($conn);
}
else
{
?>
<!-- below this comment is the data entry part of the stock certificate -->
<h3>Stock Certificate</h3>
<form method="post" action="<?php $_PHP_SELF ?>">

<div id="tabs">
	<ul>
		<li><a href="#tabs-1">Buyer/Seller Information</a></li>
		<li><a href="#tabs-4" onclick="figurePayment();return false;">Sheep/Goats</a></li>
		<li><a href="#tabs-7" onclick="unPlusPay();">Payment</a></li>
<!--		<li><a href="#tabs-8">Signatures</a></li>-->
	</ul>
	<div id="tabs-1"> <!-- address section -->
Owner COIN: <input name="clss_coin_owner" type="text" id="clss_coin_owner"><br>
Owner Name*: <input name="clss_name_owner" type="text" id="clss_name_owner" size="100"><br>
Owner Address*: <input name="clss_address_owner" type="text" id="clss_address_owner" size="100"><br>
Owner City*: <input name="clss_city_owner" type="text" id="clss_city_owner" size="50"><br>
Owner State*: <select size="1" name="clss_state_owner">
<option value="CO">No State Selected</option>
<option value="AK">ALASKA</option>
<option value="AL">ALABAMA</option>
<option value="AR">ARKANSAS</option>
<option value="AZ">ARIZONA</option>
<option value="CA">CALIFORNIA</option>
<option value="CO">COLORADO</option>
<option value="CT">CONNECTICUT</option>
<option value="DC">DISTRICT OF COLUMBIA</option>
<option value="DE">DELAWARE</option>
<option value="FL">FLORIDA</option>
<option value="GA">GEORGIA</option>
<option value="HI">HAWAII</option>
<option value="IA">IOWA</option>
<option value="ID">IDAHO</option>
<option value="IL">ILLINOIS</option>
<option value="IN">INDIANA</option>
<option value="KS">KANSAS</option>
<option value="KY">KENTUCKY</option>
<option value="LA">LOUISIANA</option>
<option value="MA">MASSACHUSETTS</option>
<option value="MD">MARYLAND</option>
<option value="ME">MAINE</option>
<option value="MI">MICHIGAN</option>
<option value="MN">MINNESOTA</option>
<option value="MO">MISSOURI</option>
<option value="MS">MISSISSIPPI</option>
<option value="MT">MONTANA</option>
<option value="NC">NORTH CAROLINA</option>
<option value="ND">NORTH DAKOTA</option>
<option value="NE">NEBRASKA</option>
<option value="NH">NEW HAMPSHIRE</option>
<option value="NJ">NEW JERSEY</option>
<option value="NM">NEW MEXICO</option>
<option value="NV">NEVADA</option>
<option value="NY">NEW YORK</option>
<option value="OH">OHIO</option>
<option value="OK">OKLAHOMA</option>
<option value="OR">OREGON</option>
<option value="PA">PENNSYLVANIA</option>
<option value="RI">RHODE ISLAND</option>
<option value="SC">SOUTH CAROLINA</option>
<option value="SD">SOUTH DAKOTA</option>
<option value="TN">TENNESSEE</option>
<option value="TX">TEXAS</option>
<option value="UT">UTAH</option>
<option value="VA">VIRGINIA</option>
<option value="VT">VERMONT</option>
<option value="WA">WASHINGTON</option>
<option value="WI">WISCONSIN</option>
<option value="WV">WEST VIRGINIA</option>
<option value="WY">WYOMING</option>
<option value="N_A">NOT APPLICABLE</option>
<option value="AGU">AGUASCALIENTES</option>
<option value="AL">ALBERTA</option>
<option value="ALS">ALSACE</option>
<option value="AS">ASUNCION</option>
<option value="BRI">BRITISH COLUMBIA</option>
<option value="CHA">CHAMPAGNE-ARDENNE</option>
<option value="CHI">CHIHUAHUA</option>
<option value="DUR">DURANGO</option>
<option value="GUA">GUANAJUATO</option>
<option value="JAL">JALISCO</option>
<option value="MAN">MANITOBA</option>
<option value="MEX">MÉXICO</option>
<option value="MIC">MICHOACAN</option>
<option value="NAY">NAYARIT</option>
<option value="NSW">NEW SOUTH WALES</option>
<option value="NOV">NOVA SCOTIA</option>
<option value="NUE">NUEVO LEON</option>
<option value="ONT">ONTARIO</option>
<option value="PH">PAULHIAC</option>
<option value="QUE">QUEBEC</option>
<option value="SAN">SAN LUIS POTOSI</option>
<option value="SAS">SASKATCHEWAN</option>
<option value="SIN">SINALOA</option>
<option value="SON">SONORA</option>
<option value="TAB">TABASCO</option>
<option value="TAM">TAMAULIPAS</option>
<option value="ZAC">ZACATECAS</option>
</select><br>
Owner Zip*: <input name="clss_zip_owner" type="text" id="clss_zip_owner"><br>
Owner County*: <select size="1" name="clss_county_owner">
<option value="">No County Selected</option>
<option value="Adams">Adams</option>
<option value="Alamosa">Alamosa</option>
<option value="Arapahoe">Arapahoe</option>
<option value="Archuleta">Archuleta</option>
<option value="Baca">Baca</option>
<option value="Bent">Bent</option>
<option value="Boulder">Boulder</option>
<option value="Broomfield">Broomfield</option>
<option value="Chaffee">Chaffee</option>
<option value="Cheyenne">Cheyenne</option>
<option value="Clear Creek">Clear Creek</option>
<option value="Conejos">Conejos</option>
<option value="Costilla">Costilla</option>
<option value="Crowley">Crowley</option>
<option value="Custer">Custer</option>
<option value="Delta">Delta</option>
<option value="Denver">Denver</option>
<option value="Dolores">Dolores</option>
<option value="Douglas">Douglas</option>
<option value="Eagle">Eagle</option>
<option value="El Paso">El Paso</option>
<option value="Elbert">Elbert</option>
<option value="Fremont">Fremont</option>
<option value="Garfield">Garfield</option>
<option value="Gilpin">Gilpin</option>
<option value="Grand">Grand</option>
<option value="Gunnison">Gunnison</option>
<option value="Hinsdale">Hinsdale</option>
<option value="Huerfano">Huerfano</option>
<option value="Jackson">Jackson</option>
<option value="Jefferson">Jefferson</option>
<option value="Kiowa">Kiowa</option>
<option value="Kit Carson">Kit Carson</option>
<option value="La Plata">La Plata</option>
<option value="Lake">Lake</option>
<option value="Larimer">Larimer</option>
<option value="Las Animas">Las Animas</option>
<option value="Lincoln">Lincoln</option>
<option value="Logan">Logan</option>
<option value="Mesa">Mesa</option>
<option value="Mineral">Mineral</option>
<option value="Moffat">Moffat</option>
<option value="Montezuma">Montezuma</option>
<option value="Montrose">Montrose</option>
<option value="Morgan">Morgan</option>
<option value="Otero">Otero</option>
<option value="Ouray">Ouray</option>
<option value="Park">Park</option>
<option value="Phillips">Phillips</option>
<option value="Pitkin">Pitkin</option>
<option value="Prowers">Prowers</option>
<option value="Pueblo">Pueblo</option>
<option value="Rio Blanco">Rio Blanco</option>
<option value="Rio Grande">Rio Grande</option>
<option value="Routt">Routt</option>
<option value="Saguache">Saguache</option>
<option value="San Juan">San Juan</option>
<option value="San Miguel">San Miguel</option>
<option value="Sedgwick">Sedgwick</option>
<option value="Summit">Summit</option>
<option value="Teller">Teller</option>
<option value="Washington">Washington</option>
<option value="Weld">Weld</option>
<option value="Yuma">Yuma</option>
</select>
<p>&nbsp;</p>
Buyer COIN: <input name="clss_coin_buyer" type="text" id="clss_coin_buyer"><br>
Buyer Name: <input name="clss_name_buyer" type="text" id="clss_name_buyer" size="100"><br>
Buyer Address: <input name="clss_address_buyer" type="text" id="clss_address_buyer" size="100"><br>
Buyer City: <input name="clss_city_buyer" type="text" id="clss_city_buyer" size="50"><br>
Buyer State: <select size="1" name="clss_state_buyer">
<option value="CO">No State Selected</option>
<option value="AK">ALASKA</option>
<option value="AL">ALABAMA</option>
<option value="AR">ARKANSAS</option>
<option value="AZ">ARIZONA</option>
<option value="CA">CALIFORNIA</option>
<option value="CO">COLORADO</option>
<option value="CT">CONNECTICUT</option>
<option value="DC">DISTRICT OF COLUMBIA</option>
<option value="DE">DELAWARE</option>
<option value="FL">FLORIDA</option>
<option value="GA">GEORGIA</option>
<option value="HI">HAWAII</option>
<option value="IA">IOWA</option>
<option value="ID">IDAHO</option>
<option value="IL">ILLINOIS</option>
<option value="IN">INDIANA</option>
<option value="KS">KANSAS</option>
<option value="KY">KENTUCKY</option>
<option value="LA">LOUISIANA</option>
<option value="MA">MASSACHUSETTS</option>
<option value="MD">MARYLAND</option>
<option value="ME">MAINE</option>
<option value="MI">MICHIGAN</option>
<option value="MN">MINNESOTA</option>
<option value="MO">MISSOURI</option>
<option value="MS">MISSISSIPPI</option>
<option value="MT">MONTANA</option>
<option value="NC">NORTH CAROLINA</option>
<option value="ND">NORTH DAKOTA</option>
<option value="NE">NEBRASKA</option>
<option value="NH">NEW HAMPSHIRE</option>
<option value="NJ">NEW JERSEY</option>
<option value="NM">NEW MEXICO</option>
<option value="NV">NEVADA</option>
<option value="NY">NEW YORK</option>
<option value="OH">OHIO</option>
<option value="OK">OKLAHOMA</option>
<option value="OR">OREGON</option>
<option value="PA">PENNSYLVANIA</option>
<option value="RI">RHODE ISLAND</option>
<option value="SC">SOUTH CAROLINA</option>
<option value="SD">SOUTH DAKOTA</option>
<option value="TN">TENNESSEE</option>
<option value="TX">TEXAS</option>
<option value="UT">UTAH</option>
<option value="VA">VIRGINIA</option>
<option value="VT">VERMONT</option>
<option value="WA">WASHINGTON</option>
<option value="WI">WISCONSIN</option>
<option value="WV">WEST VIRGINIA</option>
<option value="WY">WYOMING</option>
<option value="N_A">NOT APPLICABLE</option>
<option value="AGU">AGUASCALIENTES</option>
<option value="AL">ALBERTA</option>
<option value="ALS">ALSACE</option>
<option value="AS">ASUNCION</option>
<option value="BRI">BRITISH COLUMBIA</option>
<option value="CHA">CHAMPAGNE-ARDENNE</option>
<option value="CHI">CHIHUAHUA</option>
<option value="DUR">DURANGO</option>
<option value="GUA">GUANAJUATO</option>
<option value="JAL">JALISCO</option>
<option value="MAN">MANITOBA</option>
<option value="MEX">MÉXICO</option>
<option value="MIC">MICHOACAN</option>
<option value="NAY">NAYARIT</option>
<option value="NSW">NEW SOUTH WALES</option>
<option value="NOV">NOVA SCOTIA</option>
<option value="NUE">NUEVO LEON</option>
<option value="ONT">ONTARIO</option>
<option value="PH">PAULHIAC</option>
<option value="QUE">QUEBEC</option>
<option value="SAN">SAN LUIS POTOSI</option>
<option value="SAS">SASKATCHEWAN</option>
<option value="SIN">SINALOA</option>
<option value="SON">SONORA</option>
<option value="TAB">TABASCO</option>
<option value="TAM">TAMAULIPAS</option>
<option value="ZAC">ZACATECAS</option>
</select><br>
Buyer Zip: <input name="clss_zip_buyer" type="text" id="clss_zip_buyer"><br>
Buyer County: <select size="1" name="clss_county_buyer">
<option value="">No County Selected</option>
<option value="Adams">Adams</option>
<option value="Alamosa">Alamosa</option>
<option value="Arapahoe">Arapahoe</option>
<option value="Archuleta">Archuleta</option>
<option value="Baca">Baca</option>
<option value="Bent">Bent</option>
<option value="Boulder">Boulder</option>
<option value="Broomfield">Broomfield</option>
<option value="Chaffee">Chaffee</option>
<option value="Cheyenne">Cheyenne</option>
<option value="Clear Creek">Clear Creek</option>
<option value="Conejos">Conejos</option>
<option value="Costilla">Costilla</option>
<option value="Crowley">Crowley</option>
<option value="Custer">Custer</option>
<option value="Delta">Delta</option>
<option value="Denver">Denver</option>
<option value="Dolores">Dolores</option>
<option value="Douglas">Douglas</option>
<option value="Eagle">Eagle</option>
<option value="El Paso">El Paso</option>
<option value="Elbert">Elbert</option>
<option value="Fremont">Fremont</option>
<option value="Garfield">Garfield</option>
<option value="Gilpin">Gilpin</option>
<option value="Grand">Grand</option>
<option value="Gunnison">Gunnison</option>
<option value="Hinsdale">Hinsdale</option>
<option value="Huerfano">Huerfano</option>
<option value="Jackson">Jackson</option>
<option value="Jefferson">Jefferson</option>
<option value="Kiowa">Kiowa</option>
<option value="Kit Carson">Kit Carson</option>
<option value="La Plata">La Plata</option>
<option value="Lake">Lake</option>
<option value="Larimer">Larimer</option>
<option value="Las Animas">Las Animas</option>
<option value="Lincoln">Lincoln</option>
<option value="Logan">Logan</option>
<option value="Mesa">Mesa</option>
<option value="Mineral">Mineral</option>
<option value="Moffat">Moffat</option>
<option value="Montezuma">Montezuma</option>
<option value="Montrose">Montrose</option>
<option value="Morgan">Morgan</option>
<option value="Otero">Otero</option>
<option value="Ouray">Ouray</option>
<option value="Park">Park</option>
<option value="Phillips">Phillips</option>
<option value="Pitkin">Pitkin</option>
<option value="Prowers">Prowers</option>
<option value="Pueblo">Pueblo</option>
<option value="Rio Blanco">Rio Blanco</option>
<option value="Rio Grande">Rio Grande</option>
<option value="Routt">Routt</option>
<option value="Saguache">Saguache</option>
<option value="San Juan">San Juan</option>
<option value="San Miguel">San Miguel</option>
<option value="Sedgwick">Sedgwick</option>
<option value="Summit">Summit</option>
<option value="Teller">Teller</option>
<option value="Washington">Washington</option>
<option value="Weld">Weld</option>
<option value="Yuma">Yuma</option>
</select><br>
	</div>
	<div id="tabs-4"> <!-- sheep -->
<div id="accordion">
<h3>Group 1</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Sheep/Goats: <input name="num_sheep_01" type="text" id="num_sheep_01"><br>
Breed: <select size="1" name="sheep_breed_01">
<option value="">No Breed Selected</option>
<option value="Alpine">Alpine</option>
<option value="American Blackbelly">American Blackbelly</option>
<option value="Angora">Angora</option>
<option value="Babydoll">Babydoll</option>
<option value="Barbados Blackbelly">Barbados Blackbelly</option>
<option value="Black Welsh Mountain">Black Welsh Mountain</option>
<option value="Black-faced">Black-faced</option>
<option value="Boer">Boer</option>
<option value="Border Cheviot">Border Cheviot</option>
<option value="California Red">California Red</option>
<option value="California Variegated Mutant">California Variegated Mutant</option>
<option value="Cashmere">Cashmere</option>
<option value="Cheviot">Cheviot</option>
<option value="Columbia">Columbia</option>
<option value="Cormo">Cormo</option>
<option value="Cotswold">Cotswold</option>
<option value="Dairy-type crossbred">Dairy-type crossbred</option>
<option value="Debouillet">Debouillet</option>
<option value="Devon">Devon</option>
<option value="Dorper">Dorper</option>
<option value="Dorset">Dorset</option>
<option value="Eastern Friesian">Eastern Friesian</option>
<option value="Fiber-type crossbred">Fiber-type crossbred</option>
<option value="Finnish Landrace">Finnish Landrace</option>
<option value="Golden Guernsey">Golden Guernsey</option>
<option value="Gulf Coast">Gulf Coast</option>
<option value="Hairsheep crossbred">Hairsheep, crossbred</option>
<option value="Hampshire">Hampshire</option>
<option value="Horned Dorset">Horned Dorset</option>
<option value="Icelandic">Icelandic</option>
<option value="Jacob">Jacob</option>
<option value="Karakul">Karakul</option>
<option value="Kiko">Kiko</option>
<option value="La Mancha">La Mancha</option>
<option value="Leicester">Leicester</option>
<option value="Lincoln">Lincoln</option>
<option value="Meat-type crossbred">Meat-type crossbred</option>
<option value="Merino">Merino</option>
<option value="Montadale">Montadale</option>
<option value="Mottle-faced">Mottle-faced</option>
<option value="Myotonic">Myotonic</option>
<option value="Natural Colored">Natural Colored</option>
<option value="Navajo">Navajo</option>
<option value="Nigerian Dwarf">Nigerian Dwarf</option>
<option value="Nubian">Nubian</option>
<option value="Oberhasli">Oberhasli</option>
<option value="Other">Other</option>
<option value="Oxford">Oxford</option>
<option value="Perendale">Perendale</option>
<option value="Polled Dorset">Polled Dorset</option>
<option value="Polypay">Polypay</option>
<option value="Pygmy">Pygmy</option>
<option value="Pygora">Pygora</option>
<option value="Rambouillet">Rambouillet</option>
<option value="Romanov">Romanov</option>
<option value="Romnelet">Romnelet</option>
<option value="Romney">Romney</option>
<option value="Saanen">Saanen</option>
<option value="Sable">Sable</option>
<option value="Shetland">Shetland</option>
<option value="Shropshire">Shropshire</option>
<option value="Solid face color not black">Solid face color, not black</option>
<option value="Southdown">Southdown</option>
<option value="Spanish">Spanish</option>
<option value="St Croix">St Croix</option>
<option value="Suffolk">Suffolk</option>
<option value="Targhee">Targhee</option>
<option value="Teeswater">Teeswater</option>
<option value="Texel">Texel</option>
<option value="Toggenburg">Toggenburg</option>
<option value="Tunis">Tunis</option>
<option value="Wensleydale">Wensleydale</option>
<option value="White Dorper">White Dorper</option>
<option value="White-faced">White-faced</option>
<option value="Wiltshire Horn">Wiltshire Horn</option>
</select><br>
Gender: <select size="1" name="sheep_gender_01">
<option value="">No Gender Selected</option>
<option value="Billy">Billy</option>
<option value="Buck">Buck</option>
<option value="Buckling">Buckling</option>
<option value="Doe">Doe</option>
<option value="Doeling">Doeling</option>
<option value="Ewe">Ewe</option>
<option value="Kid">Kid</option>
<option value="Nanny">Nanny</option>
<option value="Ram">Ram</option>
<option value="Wether">Wether</option>
</select><br>
Color: <select size="1" name="sheep_color_01">
<option value="">No Color Selected</option>
<option value="Bezoar">Bezoar</option>
<option value="Black">Black</option>
<option value="Black & Tan">Black &amp; Tan</option>
<option value="Black Mask">Black Mask</option>
<option value="Blackbelly">Blackbelly</option>
<option value="Caramel">Caramel</option>
<option value="Eyebar">Eyebar</option>
<option value="Fishy">Fishy</option>
<option value="Grey">Grey</option>
<option value="Grey agouti">Grey agouti</option>
<option value="Lateral stripes">Lateral stripes</option>
<option value="Mahogany">Mahogany</option>
<option value="Other">Other</option>
<option value="Peacock">Peacock</option>
<option value="Red cheek">Red cheek</option>
<option value="Repartida">Repartida</option>
<option value="San Clemente">San Clemente</option>
<option value="Striped grey">Striped grey</option>
<option value="Tan sides">Tan sides</option>
<option value="Toggenburg">Toggenburg</option>
<option value="White">White</option>
</select>
	</td>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="left" valign="top">
Brand:
	<div class="sigPad">
		<ul class="sigNav">
			<li class="clearButton"><a href="#clear">Clear</a></li>
		</ul>
		<div class="sig sigBRANDWrapper">
			<div class="typed"></div>
				<canvas class="pad" width="250" height="250"></canvas>
				<input type="hidden" name="output_sheep_01" class="output">
		</div>
		<script src="js/jquery.signaturepad.min.js"></script>
		<script>
		$(document).ready(function () {
			$('.sigPad2').signaturePad({drawOnly : true});
		});
		</script>
		<script src="js/assets/json2.min.js"></script>
	</div>
	</td>
  </tr>
</table>
</div>

<h3>Group 2</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Sheep/Goats: <input name="num_sheep_02" type="text" id="num_sheep_02"><br>
Breed: <select size="1" name="sheep_breed_02">
<option value="">No Breed Selected</option>
<option value="Alpine">Alpine</option>
<option value="American Blackbelly">American Blackbelly</option>
<option value="Angora">Angora</option>
<option value="Babydoll">Babydoll</option>
<option value="Barbados Blackbelly">Barbados Blackbelly</option>
<option value="Black Welsh Mountain">Black Welsh Mountain</option>
<option value="Black-faced">Black-faced</option>
<option value="Boer">Boer</option>
<option value="Border Cheviot">Border Cheviot</option>
<option value="California Red">California Red</option>
<option value="California Variegated Mutant">California Variegated Mutant</option>
<option value="Cashmere">Cashmere</option>
<option value="Cheviot">Cheviot</option>
<option value="Columbia">Columbia</option>
<option value="Cormo">Cormo</option>
<option value="Cotswold">Cotswold</option>
<option value="Dairy-type crossbred">Dairy-type crossbred</option>
<option value="Debouillet">Debouillet</option>
<option value="Devon">Devon</option>
<option value="Dorper">Dorper</option>
<option value="Dorset">Dorset</option>
<option value="Eastern Friesian">Eastern Friesian</option>
<option value="Fiber-type crossbred">Fiber-type crossbred</option>
<option value="Finnish Landrace">Finnish Landrace</option>
<option value="Golden Guernsey">Golden Guernsey</option>
<option value="Gulf Coast">Gulf Coast</option>
<option value="Hairsheep crossbred">Hairsheep, crossbred</option>
<option value="Hampshire">Hampshire</option>
<option value="Horned Dorset">Horned Dorset</option>
<option value="Icelandic">Icelandic</option>
<option value="Jacob">Jacob</option>
<option value="Karakul">Karakul</option>
<option value="Kiko">Kiko</option>
<option value="La Mancha">La Mancha</option>
<option value="Leicester">Leicester</option>
<option value="Lincoln">Lincoln</option>
<option value="Meat-type crossbred">Meat-type crossbred</option>
<option value="Merino">Merino</option>
<option value="Montadale">Montadale</option>
<option value="Mottle-faced">Mottle-faced</option>
<option value="Myotonic">Myotonic</option>
<option value="Natural Colored">Natural Colored</option>
<option value="Navajo">Navajo</option>
<option value="Nigerian Dwarf">Nigerian Dwarf</option>
<option value="Nubian">Nubian</option>
<option value="Oberhasli">Oberhasli</option>
<option value="Other">Other</option>
<option value="Oxford">Oxford</option>
<option value="Perendale">Perendale</option>
<option value="Polled Dorset">Polled Dorset</option>
<option value="Polypay">Polypay</option>
<option value="Pygmy">Pygmy</option>
<option value="Pygora">Pygora</option>
<option value="Rambouillet">Rambouillet</option>
<option value="Romanov">Romanov</option>
<option value="Romnelet">Romnelet</option>
<option value="Romney">Romney</option>
<option value="Saanen">Saanen</option>
<option value="Sable">Sable</option>
<option value="Shetland">Shetland</option>
<option value="Shropshire">Shropshire</option>
<option value="Solid face color not black">Solid face color, not black</option>
<option value="Southdown">Southdown</option>
<option value="Spanish">Spanish</option>
<option value="St Croix">St Croix</option>
<option value="Suffolk">Suffolk</option>
<option value="Targhee">Targhee</option>
<option value="Teeswater">Teeswater</option>
<option value="Texel">Texel</option>
<option value="Toggenburg">Toggenburg</option>
<option value="Tunis">Tunis</option>
<option value="Wensleydale">Wensleydale</option>
<option value="White Dorper">White Dorper</option>
<option value="White-faced">White-faced</option>
<option value="Wiltshire Horn">Wiltshire Horn</option>
</select><br>
Gender: <select size="1" name="sheep_gender_02">
<option value="">No Gender Selected</option>
<option value="Billy">Billy</option>
<option value="Buck">Buck</option>
<option value="Buckling">Buckling</option>
<option value="Doe">Doe</option>
<option value="Doeling">Doeling</option>
<option value="Ewe">Ewe</option>
<option value="Kid">Kid</option>
<option value="Nanny">Nanny</option>
<option value="Ram">Ram</option>
<option value="Wether">Wether</option>
</select><br>
Color: <select size="1" name="sheep_color_02">
<option value="">No Color Selected</option>
<option value="Bezoar">Bezoar</option>
<option value="Black">Black</option>
<option value="Black & Tan">Black &amp; Tan</option>
<option value="Black Mask">Black Mask</option>
<option value="Blackbelly">Blackbelly</option>
<option value="Caramel">Caramel</option>
<option value="Eyebar">Eyebar</option>
<option value="Fishy">Fishy</option>
<option value="Grey">Grey</option>
<option value="Grey agouti">Grey agouti</option>
<option value="Lateral stripes">Lateral stripes</option>
<option value="Mahogany">Mahogany</option>
<option value="Other">Other</option>
<option value="Peacock">Peacock</option>
<option value="Red cheek">Red cheek</option>
<option value="Repartida">Repartida</option>
<option value="San Clemente">San Clemente</option>
<option value="Striped grey">Striped grey</option>
<option value="Tan sides">Tan sides</option>
<option value="Toggenburg">Toggenburg</option>
<option value="White">White</option>
</select>
	</td>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="left" valign="top">
Brand:
	<div class="sigPad">
		<ul class="sigNav">
			<li class="clearButton"><a href="#clear">Clear</a></li>
		</ul>
		<div class="sig sigBRANDWrapper">
			<div class="typed"></div>
				<canvas class="pad" width="250" height="250"></canvas>
				<input type="hidden" name="output_sheep_02" class="output">
		</div>
		<script src="js/jquery.signaturepad.min.js"></script>
		<script>
		$(document).ready(function () {
			$('.sigPad').signaturePad({drawOnly : true});
		});
		</script>
		<script src="js/assets/json2.min.js"></script>
	</div>
	</td>
  </tr>
</table>
</div>

<h3>Group 3</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Sheep/Goats: <input name="num_sheep_03" type="text" id="num_sheep_03"><br>
Breed: <select size="1" name="sheep_breed_03">
<option value="">No Breed Selected</option>
<option value="Alpine">Alpine</option>
<option value="American Blackbelly">American Blackbelly</option>
<option value="Angora">Angora</option>
<option value="Babydoll">Babydoll</option>
<option value="Barbados Blackbelly">Barbados Blackbelly</option>
<option value="Black Welsh Mountain">Black Welsh Mountain</option>
<option value="Black-faced">Black-faced</option>
<option value="Boer">Boer</option>
<option value="Border Cheviot">Border Cheviot</option>
<option value="California Red">California Red</option>
<option value="California Variegated Mutant">California Variegated Mutant</option>
<option value="Cashmere">Cashmere</option>
<option value="Cheviot">Cheviot</option>
<option value="Columbia">Columbia</option>
<option value="Cormo">Cormo</option>
<option value="Cotswold">Cotswold</option>
<option value="Dairy-type crossbred">Dairy-type crossbred</option>
<option value="Debouillet">Debouillet</option>
<option value="Devon">Devon</option>
<option value="Dorper">Dorper</option>
<option value="Dorset">Dorset</option>
<option value="Eastern Friesian">Eastern Friesian</option>
<option value="Fiber-type crossbred">Fiber-type crossbred</option>
<option value="Finnish Landrace">Finnish Landrace</option>
<option value="Golden Guernsey">Golden Guernsey</option>
<option value="Gulf Coast">Gulf Coast</option>
<option value="Hairsheep crossbred">Hairsheep, crossbred</option>
<option value="Hampshire">Hampshire</option>
<option value="Horned Dorset">Horned Dorset</option>
<option value="Icelandic">Icelandic</option>
<option value="Jacob">Jacob</option>
<option value="Karakul">Karakul</option>
<option value="Kiko">Kiko</option>
<option value="La Mancha">La Mancha</option>
<option value="Leicester">Leicester</option>
<option value="Lincoln">Lincoln</option>
<option value="Meat-type crossbred">Meat-type crossbred</option>
<option value="Merino">Merino</option>
<option value="Montadale">Montadale</option>
<option value="Mottle-faced">Mottle-faced</option>
<option value="Myotonic">Myotonic</option>
<option value="Natural Colored">Natural Colored</option>
<option value="Navajo">Navajo</option>
<option value="Nigerian Dwarf">Nigerian Dwarf</option>
<option value="Nubian">Nubian</option>
<option value="Oberhasli">Oberhasli</option>
<option value="Other">Other</option>
<option value="Oxford">Oxford</option>
<option value="Perendale">Perendale</option>
<option value="Polled Dorset">Polled Dorset</option>
<option value="Polypay">Polypay</option>
<option value="Pygmy">Pygmy</option>
<option value="Pygora">Pygora</option>
<option value="Rambouillet">Rambouillet</option>
<option value="Romanov">Romanov</option>
<option value="Romnelet">Romnelet</option>
<option value="Romney">Romney</option>
<option value="Saanen">Saanen</option>
<option value="Sable">Sable</option>
<option value="Shetland">Shetland</option>
<option value="Shropshire">Shropshire</option>
<option value="Solid face color not black">Solid face color, not black</option>
<option value="Southdown">Southdown</option>
<option value="Spanish">Spanish</option>
<option value="St Croix">St Croix</option>
<option value="Suffolk">Suffolk</option>
<option value="Targhee">Targhee</option>
<option value="Teeswater">Teeswater</option>
<option value="Texel">Texel</option>
<option value="Toggenburg">Toggenburg</option>
<option value="Tunis">Tunis</option>
<option value="Wensleydale">Wensleydale</option>
<option value="White Dorper">White Dorper</option>
<option value="White-faced">White-faced</option>
<option value="Wiltshire Horn">Wiltshire Horn</option>
</select><br>
Gender: <select size="1" name="sheep_gender_03">
<option value="">No Gender Selected</option>
<option value="Billy">Billy</option>
<option value="Buck">Buck</option>
<option value="Buckling">Buckling</option>
<option value="Doe">Doe</option>
<option value="Doeling">Doeling</option>
<option value="Ewe">Ewe</option>
<option value="Kid">Kid</option>
<option value="Nanny">Nanny</option>
<option value="Ram">Ram</option>
<option value="Wether">Wether</option>
</select><br>
Color: <select size="1" name="sheep_color_03">
<option value="">No Color Selected</option>
<option value="Bezoar">Bezoar</option>
<option value="Black">Black</option>
<option value="Black & Tan">Black &amp; Tan</option>
<option value="Black Mask">Black Mask</option>
<option value="Blackbelly">Blackbelly</option>
<option value="Caramel">Caramel</option>
<option value="Eyebar">Eyebar</option>
<option value="Fishy">Fishy</option>
<option value="Grey">Grey</option>
<option value="Grey agouti">Grey agouti</option>
<option value="Lateral stripes">Lateral stripes</option>
<option value="Mahogany">Mahogany</option>
<option value="Other">Other</option>
<option value="Peacock">Peacock</option>
<option value="Red cheek">Red cheek</option>
<option value="Repartida">Repartida</option>
<option value="San Clemente">San Clemente</option>
<option value="Striped grey">Striped grey</option>
<option value="Tan sides">Tan sides</option>
<option value="Toggenburg">Toggenburg</option>
<option value="White">White</option>
</select>
	</td>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="left" valign="top">
Brand:
	<div class="sigPad">
		<ul class="sigNav">
			<li class="clearButton"><a href="#clear">Clear</a></li>
		</ul>
		<div class="sig sigBRANDWrapper">
			<div class="typed"></div>
				<canvas class="pad" width="250" height="250"></canvas>
				<input type="hidden" name="output_sheep_03" class="output">
		</div>
		<script src="js/jquery.signaturepad.min.js"></script>
		<script>
		$(document).ready(function () {
			$('.sigPad').signaturePad({drawOnly : true});
		});
		</script>
		<script src="js/assets/json2.min.js"></script>
	</div>
	</td>
  </tr>
</table>
</div>

<h3>Group 4</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Sheep/Goats: <input name="num_sheep_04" type="text" id="num_sheep_04"><br>
Breed: <select size="1" name="sheep_breed_04">
<option value="">No Breed Selected</option>
<option value="Alpine">Alpine</option>
<option value="American Blackbelly">American Blackbelly</option>
<option value="Angora">Angora</option>
<option value="Babydoll">Babydoll</option>
<option value="Barbados Blackbelly">Barbados Blackbelly</option>
<option value="Black Welsh Mountain">Black Welsh Mountain</option>
<option value="Black-faced">Black-faced</option>
<option value="Boer">Boer</option>
<option value="Border Cheviot">Border Cheviot</option>
<option value="California Red">California Red</option>
<option value="California Variegated Mutant">California Variegated Mutant</option>
<option value="Cashmere">Cashmere</option>
<option value="Cheviot">Cheviot</option>
<option value="Columbia">Columbia</option>
<option value="Cormo">Cormo</option>
<option value="Cotswold">Cotswold</option>
<option value="Dairy-type crossbred">Dairy-type crossbred</option>
<option value="Debouillet">Debouillet</option>
<option value="Devon">Devon</option>
<option value="Dorper">Dorper</option>
<option value="Dorset">Dorset</option>
<option value="Eastern Friesian">Eastern Friesian</option>
<option value="Fiber-type crossbred">Fiber-type crossbred</option>
<option value="Finnish Landrace">Finnish Landrace</option>
<option value="Golden Guernsey">Golden Guernsey</option>
<option value="Gulf Coast">Gulf Coast</option>
<option value="Hairsheep crossbred">Hairsheep, crossbred</option>
<option value="Hampshire">Hampshire</option>
<option value="Horned Dorset">Horned Dorset</option>
<option value="Icelandic">Icelandic</option>
<option value="Jacob">Jacob</option>
<option value="Karakul">Karakul</option>
<option value="Kiko">Kiko</option>
<option value="La Mancha">La Mancha</option>
<option value="Leicester">Leicester</option>
<option value="Lincoln">Lincoln</option>
<option value="Meat-type crossbred">Meat-type crossbred</option>
<option value="Merino">Merino</option>
<option value="Montadale">Montadale</option>
<option value="Mottle-faced">Mottle-faced</option>
<option value="Myotonic">Myotonic</option>
<option value="Natural Colored">Natural Colored</option>
<option value="Navajo">Navajo</option>
<option value="Nigerian Dwarf">Nigerian Dwarf</option>
<option value="Nubian">Nubian</option>
<option value="Oberhasli">Oberhasli</option>
<option value="Other">Other</option>
<option value="Oxford">Oxford</option>
<option value="Perendale">Perendale</option>
<option value="Polled Dorset">Polled Dorset</option>
<option value="Polypay">Polypay</option>
<option value="Pygmy">Pygmy</option>
<option value="Pygora">Pygora</option>
<option value="Rambouillet">Rambouillet</option>
<option value="Romanov">Romanov</option>
<option value="Romnelet">Romnelet</option>
<option value="Romney">Romney</option>
<option value="Saanen">Saanen</option>
<option value="Sable">Sable</option>
<option value="Shetland">Shetland</option>
<option value="Shropshire">Shropshire</option>
<option value="Solid face color not black">Solid face color, not black</option>
<option value="Southdown">Southdown</option>
<option value="Spanish">Spanish</option>
<option value="St Croix">St Croix</option>
<option value="Suffolk">Suffolk</option>
<option value="Targhee">Targhee</option>
<option value="Teeswater">Teeswater</option>
<option value="Texel">Texel</option>
<option value="Toggenburg">Toggenburg</option>
<option value="Tunis">Tunis</option>
<option value="Wensleydale">Wensleydale</option>
<option value="White Dorper">White Dorper</option>
<option value="White-faced">White-faced</option>
<option value="Wiltshire Horn">Wiltshire Horn</option>
</select><br>
Gender: <select size="1" name="sheep_gender_04">
<option value="">No Gender Selected</option>
<option value="Billy">Billy</option>
<option value="Buck">Buck</option>
<option value="Buckling">Buckling</option>
<option value="Doe">Doe</option>
<option value="Doeling">Doeling</option>
<option value="Ewe">Ewe</option>
<option value="Kid">Kid</option>
<option value="Nanny">Nanny</option>
<option value="Ram">Ram</option>
<option value="Wether">Wether</option>
</select><br>
Color: <select size="1" name="sheep_color_04">
<option value="">No Color Selected</option>
<option value="Bezoar">Bezoar</option>
<option value="Black">Black</option>
<option value="Black & Tan">Black &amp; Tan</option>
<option value="Black Mask">Black Mask</option>
<option value="Blackbelly">Blackbelly</option>
<option value="Caramel">Caramel</option>
<option value="Eyebar">Eyebar</option>
<option value="Fishy">Fishy</option>
<option value="Grey">Grey</option>
<option value="Grey agouti">Grey agouti</option>
<option value="Lateral stripes">Lateral stripes</option>
<option value="Mahogany">Mahogany</option>
<option value="Other">Other</option>
<option value="Peacock">Peacock</option>
<option value="Red cheek">Red cheek</option>
<option value="Repartida">Repartida</option>
<option value="San Clemente">San Clemente</option>
<option value="Striped grey">Striped grey</option>
<option value="Tan sides">Tan sides</option>
<option value="Toggenburg">Toggenburg</option>
<option value="White">White</option>
</select>
	</td>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="left" valign="top">
Brand:
	<div class="sigPad">
		<ul class="sigNav">
			<li class="clearButton"><a href="#clear">Clear</a></li>
		</ul>
		<div class="sig sigBRANDWrapper">
			<div class="typed"></div>
				<canvas class="pad" width="250" height="250"></canvas>
				<input type="hidden" name="output_sheep_04" class="output">
		</div>
		<script src="js/jquery.signaturepad.min.js"></script>
		<script>
		$(document).ready(function () {
			$('.sigPad').signaturePad({drawOnly : true});
		});
		</script>
		<script src="js/assets/json2.min.js"></script>
	</div>
	</td>
  </tr>
</table>
</div>

<h3>Group 5</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Sheep/Goats: <input name="num_sheep_05" type="text" id="num_sheep_05"><br>
Breed: <select size="1" name="sheep_breed_05">
<option value="">No Breed Selected</option>
<option value="Alpine">Alpine</option>
<option value="American Blackbelly">American Blackbelly</option>
<option value="Angora">Angora</option>
<option value="Babydoll">Babydoll</option>
<option value="Barbados Blackbelly">Barbados Blackbelly</option>
<option value="Black Welsh Mountain">Black Welsh Mountain</option>
<option value="Black-faced">Black-faced</option>
<option value="Boer">Boer</option>
<option value="Border Cheviot">Border Cheviot</option>
<option value="California Red">California Red</option>
<option value="California Variegated Mutant">California Variegated Mutant</option>
<option value="Cashmere">Cashmere</option>
<option value="Cheviot">Cheviot</option>
<option value="Columbia">Columbia</option>
<option value="Cormo">Cormo</option>
<option value="Cotswold">Cotswold</option>
<option value="Dairy-type crossbred">Dairy-type crossbred</option>
<option value="Debouillet">Debouillet</option>
<option value="Devon">Devon</option>
<option value="Dorper">Dorper</option>
<option value="Dorset">Dorset</option>
<option value="Eastern Friesian">Eastern Friesian</option>
<option value="Fiber-type crossbred">Fiber-type crossbred</option>
<option value="Finnish Landrace">Finnish Landrace</option>
<option value="Golden Guernsey">Golden Guernsey</option>
<option value="Gulf Coast">Gulf Coast</option>
<option value="Hairsheep crossbred">Hairsheep, crossbred</option>
<option value="Hampshire">Hampshire</option>
<option value="Horned Dorset">Horned Dorset</option>
<option value="Icelandic">Icelandic</option>
<option value="Jacob">Jacob</option>
<option value="Karakul">Karakul</option>
<option value="Kiko">Kiko</option>
<option value="La Mancha">La Mancha</option>
<option value="Leicester">Leicester</option>
<option value="Lincoln">Lincoln</option>
<option value="Meat-type crossbred">Meat-type crossbred</option>
<option value="Merino">Merino</option>
<option value="Montadale">Montadale</option>
<option value="Mottle-faced">Mottle-faced</option>
<option value="Myotonic">Myotonic</option>
<option value="Natural Colored">Natural Colored</option>
<option value="Navajo">Navajo</option>
<option value="Nigerian Dwarf">Nigerian Dwarf</option>
<option value="Nubian">Nubian</option>
<option value="Oberhasli">Oberhasli</option>
<option value="Other">Other</option>
<option value="Oxford">Oxford</option>
<option value="Perendale">Perendale</option>
<option value="Polled Dorset">Polled Dorset</option>
<option value="Polypay">Polypay</option>
<option value="Pygmy">Pygmy</option>
<option value="Pygora">Pygora</option>
<option value="Rambouillet">Rambouillet</option>
<option value="Romanov">Romanov</option>
<option value="Romnelet">Romnelet</option>
<option value="Romney">Romney</option>
<option value="Saanen">Saanen</option>
<option value="Sable">Sable</option>
<option value="Shetland">Shetland</option>
<option value="Shropshire">Shropshire</option>
<option value="Solid face color not black">Solid face color, not black</option>
<option value="Southdown">Southdown</option>
<option value="Spanish">Spanish</option>
<option value="St Croix">St Croix</option>
<option value="Suffolk">Suffolk</option>
<option value="Targhee">Targhee</option>
<option value="Teeswater">Teeswater</option>
<option value="Texel">Texel</option>
<option value="Toggenburg">Toggenburg</option>
<option value="Tunis">Tunis</option>
<option value="Wensleydale">Wensleydale</option>
<option value="White Dorper">White Dorper</option>
<option value="White-faced">White-faced</option>
<option value="Wiltshire Horn">Wiltshire Horn</option>
</select><br>
Gender: <select size="1" name="sheep_gender_05">
<option value="">No Gender Selected</option>
<option value="Billy">Billy</option>
<option value="Buck">Buck</option>
<option value="Buckling">Buckling</option>
<option value="Doe">Doe</option>
<option value="Doeling">Doeling</option>
<option value="Ewe">Ewe</option>
<option value="Kid">Kid</option>
<option value="Nanny">Nanny</option>
<option value="Ram">Ram</option>
<option value="Wether">Wether</option>
</select><br>
Color: <select size="1" name="sheep_color_05">
<option value="">No Color Selected</option>
<option value="Bezoar">Bezoar</option>
<option value="Black">Black</option>
<option value="Black & Tan">Black &amp; Tan</option>
<option value="Black Mask">Black Mask</option>
<option value="Blackbelly">Blackbelly</option>
<option value="Caramel">Caramel</option>
<option value="Eyebar">Eyebar</option>
<option value="Fishy">Fishy</option>
<option value="Grey">Grey</option>
<option value="Grey agouti">Grey agouti</option>
<option value="Lateral stripes">Lateral stripes</option>
<option value="Mahogany">Mahogany</option>
<option value="Other">Other</option>
<option value="Peacock">Peacock</option>
<option value="Red cheek">Red cheek</option>
<option value="Repartida">Repartida</option>
<option value="San Clemente">San Clemente</option>
<option value="Striped grey">Striped grey</option>
<option value="Tan sides">Tan sides</option>
<option value="Toggenburg">Toggenburg</option>
<option value="White">White</option>
</select>
	</td>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="left" valign="top">
Brand:
	<div class="sigPad">
		<ul class="sigNav">
			<li class="clearButton"><a href="#clear">Clear</a></li>
		</ul>
		<div class="sig sigBRANDWrapper">
			<div class="typed"></div>
				<canvas class="pad" width="250" height="250"></canvas>
				<input type="hidden" name="output_sheep_05" class="output">
		</div>
		<script src="js/jquery.signaturepad.min.js"></script>
		<script>
		$(document).ready(function () {
			$('.sigPad').signaturePad({drawOnly : true});
		});
		</script>
		<script src="js/assets/json2.min.js"></script>
	</div>
	</td>
  </tr>
</table>
</div>

<h3>Group 6</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Sheep/Goats: <input name="num_sheep_06" type="text" id="num_sheep_06"><br>
Breed: <select size="1" name="sheep_breed_06">
<option value="">No Breed Selected</option>
<option value="Alpine">Alpine</option>
<option value="American Blackbelly">American Blackbelly</option>
<option value="Angora">Angora</option>
<option value="Babydoll">Babydoll</option>
<option value="Barbados Blackbelly">Barbados Blackbelly</option>
<option value="Black Welsh Mountain">Black Welsh Mountain</option>
<option value="Black-faced">Black-faced</option>
<option value="Boer">Boer</option>
<option value="Border Cheviot">Border Cheviot</option>
<option value="California Red">California Red</option>
<option value="California Variegated Mutant">California Variegated Mutant</option>
<option value="Cashmere">Cashmere</option>
<option value="Cheviot">Cheviot</option>
<option value="Columbia">Columbia</option>
<option value="Cormo">Cormo</option>
<option value="Cotswold">Cotswold</option>
<option value="Dairy-type crossbred">Dairy-type crossbred</option>
<option value="Debouillet">Debouillet</option>
<option value="Devon">Devon</option>
<option value="Dorper">Dorper</option>
<option value="Dorset">Dorset</option>
<option value="Eastern Friesian">Eastern Friesian</option>
<option value="Fiber-type crossbred">Fiber-type crossbred</option>
<option value="Finnish Landrace">Finnish Landrace</option>
<option value="Golden Guernsey">Golden Guernsey</option>
<option value="Gulf Coast">Gulf Coast</option>
<option value="Hairsheep crossbred">Hairsheep, crossbred</option>
<option value="Hampshire">Hampshire</option>
<option value="Horned Dorset">Horned Dorset</option>
<option value="Icelandic">Icelandic</option>
<option value="Jacob">Jacob</option>
<option value="Karakul">Karakul</option>
<option value="Kiko">Kiko</option>
<option value="La Mancha">La Mancha</option>
<option value="Leicester">Leicester</option>
<option value="Lincoln">Lincoln</option>
<option value="Meat-type crossbred">Meat-type crossbred</option>
<option value="Merino">Merino</option>
<option value="Montadale">Montadale</option>
<option value="Mottle-faced">Mottle-faced</option>
<option value="Myotonic">Myotonic</option>
<option value="Natural Colored">Natural Colored</option>
<option value="Navajo">Navajo</option>
<option value="Nigerian Dwarf">Nigerian Dwarf</option>
<option value="Nubian">Nubian</option>
<option value="Oberhasli">Oberhasli</option>
<option value="Other">Other</option>
<option value="Oxford">Oxford</option>
<option value="Perendale">Perendale</option>
<option value="Polled Dorset">Polled Dorset</option>
<option value="Polypay">Polypay</option>
<option value="Pygmy">Pygmy</option>
<option value="Pygora">Pygora</option>
<option value="Rambouillet">Rambouillet</option>
<option value="Romanov">Romanov</option>
<option value="Romnelet">Romnelet</option>
<option value="Romney">Romney</option>
<option value="Saanen">Saanen</option>
<option value="Sable">Sable</option>
<option value="Shetland">Shetland</option>
<option value="Shropshire">Shropshire</option>
<option value="Solid face color not black">Solid face color, not black</option>
<option value="Southdown">Southdown</option>
<option value="Spanish">Spanish</option>
<option value="St Croix">St Croix</option>
<option value="Suffolk">Suffolk</option>
<option value="Targhee">Targhee</option>
<option value="Teeswater">Teeswater</option>
<option value="Texel">Texel</option>
<option value="Toggenburg">Toggenburg</option>
<option value="Tunis">Tunis</option>
<option value="Wensleydale">Wensleydale</option>
<option value="White Dorper">White Dorper</option>
<option value="White-faced">White-faced</option>
<option value="Wiltshire Horn">Wiltshire Horn</option>
</select><br>
Gender: <select size="1" name="sheep_gender_06">
<option value="">No Gender Selected</option>
<option value="Billy">Billy</option>
<option value="Buck">Buck</option>
<option value="Buckling">Buckling</option>
<option value="Doe">Doe</option>
<option value="Doeling">Doeling</option>
<option value="Ewe">Ewe</option>
<option value="Kid">Kid</option>
<option value="Nanny">Nanny</option>
<option value="Ram">Ram</option>
<option value="Wether">Wether</option>
</select><br>
Color: <select size="1" name="sheep_color_06">
<option value="">No Color Selected</option>
<option value="Bezoar">Bezoar</option>
<option value="Black">Black</option>
<option value="Black & Tan">Black &amp; Tan</option>
<option value="Black Mask">Black Mask</option>
<option value="Blackbelly">Blackbelly</option>
<option value="Caramel">Caramel</option>
<option value="Eyebar">Eyebar</option>
<option value="Fishy">Fishy</option>
<option value="Grey">Grey</option>
<option value="Grey agouti">Grey agouti</option>
<option value="Lateral stripes">Lateral stripes</option>
<option value="Mahogany">Mahogany</option>
<option value="Other">Other</option>
<option value="Peacock">Peacock</option>
<option value="Red cheek">Red cheek</option>
<option value="Repartida">Repartida</option>
<option value="San Clemente">San Clemente</option>
<option value="Striped grey">Striped grey</option>
<option value="Tan sides">Tan sides</option>
<option value="Toggenburg">Toggenburg</option>
<option value="White">White</option>
</select>
	</td>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="left" valign="top">
Brand:
	<div class="sigPad">
		<ul class="sigNav">
			<li class="clearButton"><a href="#clear">Clear</a></li>
		</ul>
		<div class="sig sigBRANDWrapper">
			<div class="typed"></div>
				<canvas class="pad" width="250" height="250"></canvas>
				<input type="hidden" name="output_sheep_06" class="output">
		</div>
		<script src="js/jquery.signaturepad.min.js"></script>
		<script>
		$(document).ready(function () {
			$('.sigPad').signaturePad({drawOnly : true});
		});
		</script>
		<script src="js/assets/json2.min.js"></script>
	</div>
	</td>
  </tr>
</table>
</div>

<h3>Group 7</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Sheep/Goats: <input name="num_sheep_07" type="text" id="num_sheep_07"><br>
Breed: <select size="1" name="sheep_breed_07">
<option value="">No Breed Selected</option>
<option value="Alpine">Alpine</option>
<option value="American Blackbelly">American Blackbelly</option>
<option value="Angora">Angora</option>
<option value="Babydoll">Babydoll</option>
<option value="Barbados Blackbelly">Barbados Blackbelly</option>
<option value="Black Welsh Mountain">Black Welsh Mountain</option>
<option value="Black-faced">Black-faced</option>
<option value="Boer">Boer</option>
<option value="Border Cheviot">Border Cheviot</option>
<option value="California Red">California Red</option>
<option value="California Variegated Mutant">California Variegated Mutant</option>
<option value="Cashmere">Cashmere</option>
<option value="Cheviot">Cheviot</option>
<option value="Columbia">Columbia</option>
<option value="Cormo">Cormo</option>
<option value="Cotswold">Cotswold</option>
<option value="Dairy-type crossbred">Dairy-type crossbred</option>
<option value="Debouillet">Debouillet</option>
<option value="Devon">Devon</option>
<option value="Dorper">Dorper</option>
<option value="Dorset">Dorset</option>
<option value="Eastern Friesian">Eastern Friesian</option>
<option value="Fiber-type crossbred">Fiber-type crossbred</option>
<option value="Finnish Landrace">Finnish Landrace</option>
<option value="Golden Guernsey">Golden Guernsey</option>
<option value="Gulf Coast">Gulf Coast</option>
<option value="Hairsheep crossbred">Hairsheep, crossbred</option>
<option value="Hampshire">Hampshire</option>
<option value="Horned Dorset">Horned Dorset</option>
<option value="Icelandic">Icelandic</option>
<option value="Jacob">Jacob</option>
<option value="Karakul">Karakul</option>
<option value="Kiko">Kiko</option>
<option value="La Mancha">La Mancha</option>
<option value="Leicester">Leicester</option>
<option value="Lincoln">Lincoln</option>
<option value="Meat-type crossbred">Meat-type crossbred</option>
<option value="Merino">Merino</option>
<option value="Montadale">Montadale</option>
<option value="Mottle-faced">Mottle-faced</option>
<option value="Myotonic">Myotonic</option>
<option value="Natural Colored">Natural Colored</option>
<option value="Navajo">Navajo</option>
<option value="Nigerian Dwarf">Nigerian Dwarf</option>
<option value="Nubian">Nubian</option>
<option value="Oberhasli">Oberhasli</option>
<option value="Other">Other</option>
<option value="Oxford">Oxford</option>
<option value="Perendale">Perendale</option>
<option value="Polled Dorset">Polled Dorset</option>
<option value="Polypay">Polypay</option>
<option value="Pygmy">Pygmy</option>
<option value="Pygora">Pygora</option>
<option value="Rambouillet">Rambouillet</option>
<option value="Romanov">Romanov</option>
<option value="Romnelet">Romnelet</option>
<option value="Romney">Romney</option>
<option value="Saanen">Saanen</option>
<option value="Sable">Sable</option>
<option value="Shetland">Shetland</option>
<option value="Shropshire">Shropshire</option>
<option value="Solid face color not black">Solid face color, not black</option>
<option value="Southdown">Southdown</option>
<option value="Spanish">Spanish</option>
<option value="St Croix">St Croix</option>
<option value="Suffolk">Suffolk</option>
<option value="Targhee">Targhee</option>
<option value="Teeswater">Teeswater</option>
<option value="Texel">Texel</option>
<option value="Toggenburg">Toggenburg</option>
<option value="Tunis">Tunis</option>
<option value="Wensleydale">Wensleydale</option>
<option value="White Dorper">White Dorper</option>
<option value="White-faced">White-faced</option>
<option value="Wiltshire Horn">Wiltshire Horn</option>
</select><br>
Gender: <select size="1" name="sheep_gender_07">
<option value="">No Gender Selected</option>
<option value="Billy">Billy</option>
<option value="Buck">Buck</option>
<option value="Buckling">Buckling</option>
<option value="Doe">Doe</option>
<option value="Doeling">Doeling</option>
<option value="Ewe">Ewe</option>
<option value="Kid">Kid</option>
<option value="Nanny">Nanny</option>
<option value="Ram">Ram</option>
<option value="Wether">Wether</option>
</select><br>
Color: <select size="1" name="sheep_color_07">
<option value="">No Color Selected</option>
<option value="Bezoar">Bezoar</option>
<option value="Black">Black</option>
<option value="Black & Tan">Black &amp; Tan</option>
<option value="Black Mask">Black Mask</option>
<option value="Blackbelly">Blackbelly</option>
<option value="Caramel">Caramel</option>
<option value="Eyebar">Eyebar</option>
<option value="Fishy">Fishy</option>
<option value="Grey">Grey</option>
<option value="Grey agouti">Grey agouti</option>
<option value="Lateral stripes">Lateral stripes</option>
<option value="Mahogany">Mahogany</option>
<option value="Other">Other</option>
<option value="Peacock">Peacock</option>
<option value="Red cheek">Red cheek</option>
<option value="Repartida">Repartida</option>
<option value="San Clemente">San Clemente</option>
<option value="Striped grey">Striped grey</option>
<option value="Tan sides">Tan sides</option>
<option value="Toggenburg">Toggenburg</option>
<option value="White">White</option>
</select>
	</td>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="left" valign="top">
Brand:
	<div class="sigPad">
		<ul class="sigNav">
			<li class="clearButton"><a href="#clear">Clear</a></li>
		</ul>
		<div class="sig sigBRANDWrapper">
			<div class="typed"></div>
				<canvas class="pad" width="250" height="250"></canvas>
				<input type="hidden" name="output_sheep_07" class="output">
		</div>
		<script src="js/jquery.signaturepad.min.js"></script>
		<script>
		$(document).ready(function () {
			$('.sigPad').signaturePad({drawOnly : true});
		});
		</script>
		<script src="js/assets/json2.min.js"></script>
	</div>
	</td>
  </tr>
</table>
</div>

<h3>Group 8</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Sheep/Goats: <input name="num_sheep_08" type="text" id="num_sheep_08"><br>
Breed: <select size="1" name="sheep_breed_08">
<option value="">No Breed Selected</option>
<option value="Alpine">Alpine</option>
<option value="American Blackbelly">American Blackbelly</option>
<option value="Angora">Angora</option>
<option value="Babydoll">Babydoll</option>
<option value="Barbados Blackbelly">Barbados Blackbelly</option>
<option value="Black Welsh Mountain">Black Welsh Mountain</option>
<option value="Black-faced">Black-faced</option>
<option value="Boer">Boer</option>
<option value="Border Cheviot">Border Cheviot</option>
<option value="California Red">California Red</option>
<option value="California Variegated Mutant">California Variegated Mutant</option>
<option value="Cashmere">Cashmere</option>
<option value="Cheviot">Cheviot</option>
<option value="Columbia">Columbia</option>
<option value="Cormo">Cormo</option>
<option value="Cotswold">Cotswold</option>
<option value="Dairy-type crossbred">Dairy-type crossbred</option>
<option value="Debouillet">Debouillet</option>
<option value="Devon">Devon</option>
<option value="Dorper">Dorper</option>
<option value="Dorset">Dorset</option>
<option value="Eastern Friesian">Eastern Friesian</option>
<option value="Fiber-type crossbred">Fiber-type crossbred</option>
<option value="Finnish Landrace">Finnish Landrace</option>
<option value="Golden Guernsey">Golden Guernsey</option>
<option value="Gulf Coast">Gulf Coast</option>
<option value="Hairsheep crossbred">Hairsheep, crossbred</option>
<option value="Hampshire">Hampshire</option>
<option value="Horned Dorset">Horned Dorset</option>
<option value="Icelandic">Icelandic</option>
<option value="Jacob">Jacob</option>
<option value="Karakul">Karakul</option>
<option value="Kiko">Kiko</option>
<option value="La Mancha">La Mancha</option>
<option value="Leicester">Leicester</option>
<option value="Lincoln">Lincoln</option>
<option value="Meat-type crossbred">Meat-type crossbred</option>
<option value="Merino">Merino</option>
<option value="Montadale">Montadale</option>
<option value="Mottle-faced">Mottle-faced</option>
<option value="Myotonic">Myotonic</option>
<option value="Natural Colored">Natural Colored</option>
<option value="Navajo">Navajo</option>
<option value="Nigerian Dwarf">Nigerian Dwarf</option>
<option value="Nubian">Nubian</option>
<option value="Oberhasli">Oberhasli</option>
<option value="Other">Other</option>
<option value="Oxford">Oxford</option>
<option value="Perendale">Perendale</option>
<option value="Polled Dorset">Polled Dorset</option>
<option value="Polypay">Polypay</option>
<option value="Pygmy">Pygmy</option>
<option value="Pygora">Pygora</option>
<option value="Rambouillet">Rambouillet</option>
<option value="Romanov">Romanov</option>
<option value="Romnelet">Romnelet</option>
<option value="Romney">Romney</option>
<option value="Saanen">Saanen</option>
<option value="Sable">Sable</option>
<option value="Shetland">Shetland</option>
<option value="Shropshire">Shropshire</option>
<option value="Solid face color not black">Solid face color, not black</option>
<option value="Southdown">Southdown</option>
<option value="Spanish">Spanish</option>
<option value="St Croix">St Croix</option>
<option value="Suffolk">Suffolk</option>
<option value="Targhee">Targhee</option>
<option value="Teeswater">Teeswater</option>
<option value="Texel">Texel</option>
<option value="Toggenburg">Toggenburg</option>
<option value="Tunis">Tunis</option>
<option value="Wensleydale">Wensleydale</option>
<option value="White Dorper">White Dorper</option>
<option value="White-faced">White-faced</option>
<option value="Wiltshire Horn">Wiltshire Horn</option>
</select><br>
Gender: <select size="1" name="sheep_gender_08">
<option value="">No Gender Selected</option>
<option value="Billy">Billy</option>
<option value="Buck">Buck</option>
<option value="Buckling">Buckling</option>
<option value="Doe">Doe</option>
<option value="Doeling">Doeling</option>
<option value="Ewe">Ewe</option>
<option value="Kid">Kid</option>
<option value="Nanny">Nanny</option>
<option value="Ram">Ram</option>
<option value="Wether">Wether</option>
</select><br>
Color: <select size="1" name="sheep_color_08">
<option value="">No Color Selected</option>
<option value="Bezoar">Bezoar</option>
<option value="Black">Black</option>
<option value="Black & Tan">Black &amp; Tan</option>
<option value="Black Mask">Black Mask</option>
<option value="Blackbelly">Blackbelly</option>
<option value="Caramel">Caramel</option>
<option value="Eyebar">Eyebar</option>
<option value="Fishy">Fishy</option>
<option value="Grey">Grey</option>
<option value="Grey agouti">Grey agouti</option>
<option value="Lateral stripes">Lateral stripes</option>
<option value="Mahogany">Mahogany</option>
<option value="Other">Other</option>
<option value="Peacock">Peacock</option>
<option value="Red cheek">Red cheek</option>
<option value="Repartida">Repartida</option>
<option value="San Clemente">San Clemente</option>
<option value="Striped grey">Striped grey</option>
<option value="Tan sides">Tan sides</option>
<option value="Toggenburg">Toggenburg</option>
<option value="White">White</option>
</select>
	</td>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="left" valign="top">
Brand:
	<div class="sigPad">
		<ul class="sigNav">
			<li class="clearButton"><a href="#clear">Clear</a></li>
		</ul>
		<div class="sig sigBRANDWrapper">
			<div class="typed"></div>
				<canvas class="pad" width="250" height="250"></canvas>
				<input type="hidden" name="output_sheep_08" class="output">
		</div>
		<script src="js/jquery.signaturepad.min.js"></script>
		<script>
		$(document).ready(function () {
			$('.sigPad').signaturePad({drawOnly : true});
		});
		</script>
		<script src="js/assets/json2.min.js"></script>
	</div>
	</td>
  </tr>
</table>
</div>

<h3>Group 9</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Sheep/Goats: <input name="num_sheep_09" type="text" id="num_sheep_09"><br>
Breed: <select size="1" name="sheep_breed_09">
<option value="">No Breed Selected</option>
<option value="Alpine">Alpine</option>
<option value="American Blackbelly">American Blackbelly</option>
<option value="Angora">Angora</option>
<option value="Babydoll">Babydoll</option>
<option value="Barbados Blackbelly">Barbados Blackbelly</option>
<option value="Black Welsh Mountain">Black Welsh Mountain</option>
<option value="Black-faced">Black-faced</option>
<option value="Boer">Boer</option>
<option value="Border Cheviot">Border Cheviot</option>
<option value="California Red">California Red</option>
<option value="California Variegated Mutant">California Variegated Mutant</option>
<option value="Cashmere">Cashmere</option>
<option value="Cheviot">Cheviot</option>
<option value="Columbia">Columbia</option>
<option value="Cormo">Cormo</option>
<option value="Cotswold">Cotswold</option>
<option value="Dairy-type crossbred">Dairy-type crossbred</option>
<option value="Debouillet">Debouillet</option>
<option value="Devon">Devon</option>
<option value="Dorper">Dorper</option>
<option value="Dorset">Dorset</option>
<option value="Eastern Friesian">Eastern Friesian</option>
<option value="Fiber-type crossbred">Fiber-type crossbred</option>
<option value="Finnish Landrace">Finnish Landrace</option>
<option value="Golden Guernsey">Golden Guernsey</option>
<option value="Gulf Coast">Gulf Coast</option>
<option value="Hairsheep crossbred">Hairsheep, crossbred</option>
<option value="Hampshire">Hampshire</option>
<option value="Horned Dorset">Horned Dorset</option>
<option value="Icelandic">Icelandic</option>
<option value="Jacob">Jacob</option>
<option value="Karakul">Karakul</option>
<option value="Kiko">Kiko</option>
<option value="La Mancha">La Mancha</option>
<option value="Leicester">Leicester</option>
<option value="Lincoln">Lincoln</option>
<option value="Meat-type crossbred">Meat-type crossbred</option>
<option value="Merino">Merino</option>
<option value="Montadale">Montadale</option>
<option value="Mottle-faced">Mottle-faced</option>
<option value="Myotonic">Myotonic</option>
<option value="Natural Colored">Natural Colored</option>
<option value="Navajo">Navajo</option>
<option value="Nigerian Dwarf">Nigerian Dwarf</option>
<option value="Nubian">Nubian</option>
<option value="Oberhasli">Oberhasli</option>
<option value="Other">Other</option>
<option value="Oxford">Oxford</option>
<option value="Perendale">Perendale</option>
<option value="Polled Dorset">Polled Dorset</option>
<option value="Polypay">Polypay</option>
<option value="Pygmy">Pygmy</option>
<option value="Pygora">Pygora</option>
<option value="Rambouillet">Rambouillet</option>
<option value="Romanov">Romanov</option>
<option value="Romnelet">Romnelet</option>
<option value="Romney">Romney</option>
<option value="Saanen">Saanen</option>
<option value="Sable">Sable</option>
<option value="Shetland">Shetland</option>
<option value="Shropshire">Shropshire</option>
<option value="Solid face color not black">Solid face color, not black</option>
<option value="Southdown">Southdown</option>
<option value="Spanish">Spanish</option>
<option value="St Croix">St Croix</option>
<option value="Suffolk">Suffolk</option>
<option value="Targhee">Targhee</option>
<option value="Teeswater">Teeswater</option>
<option value="Texel">Texel</option>
<option value="Toggenburg">Toggenburg</option>
<option value="Tunis">Tunis</option>
<option value="Wensleydale">Wensleydale</option>
<option value="White Dorper">White Dorper</option>
<option value="White-faced">White-faced</option>
<option value="Wiltshire Horn">Wiltshire Horn</option>
</select><br>
Gender: <select size="1" name="sheep_gender_09">
<option value="">No Gender Selected</option>
<option value="Billy">Billy</option>
<option value="Buck">Buck</option>
<option value="Buckling">Buckling</option>
<option value="Doe">Doe</option>
<option value="Doeling">Doeling</option>
<option value="Ewe">Ewe</option>
<option value="Kid">Kid</option>
<option value="Nanny">Nanny</option>
<option value="Ram">Ram</option>
<option value="Wether">Wether</option>
</select><br>
Color: <select size="1" name="sheep_color_09">
<option value="">No Color Selected</option>
<option value="Bezoar">Bezoar</option>
<option value="Black">Black</option>
<option value="Black & Tan">Black &amp; Tan</option>
<option value="Black Mask">Black Mask</option>
<option value="Blackbelly">Blackbelly</option>
<option value="Caramel">Caramel</option>
<option value="Eyebar">Eyebar</option>
<option value="Fishy">Fishy</option>
<option value="Grey">Grey</option>
<option value="Grey agouti">Grey agouti</option>
<option value="Lateral stripes">Lateral stripes</option>
<option value="Mahogany">Mahogany</option>
<option value="Other">Other</option>
<option value="Peacock">Peacock</option>
<option value="Red cheek">Red cheek</option>
<option value="Repartida">Repartida</option>
<option value="San Clemente">San Clemente</option>
<option value="Striped grey">Striped grey</option>
<option value="Tan sides">Tan sides</option>
<option value="Toggenburg">Toggenburg</option>
<option value="White">White</option>
</select>
	</td>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="left" valign="top">
Brand:
	<div class="sigPad">
		<ul class="sigNav">
			<li class="clearButton"><a href="#clear">Clear</a></li>
		</ul>
		<div class="sig sigBRANDWrapper">
			<div class="typed"></div>
				<canvas class="pad" width="250" height="250"></canvas>
				<input type="hidden" name="output_sheep_09" class="output">
		</div>
		<script src="js/jquery.signaturepad.min.js"></script>
		<script>
		$(document).ready(function () {
			$('.sigPad').signaturePad({drawOnly : true});
		});
		</script>
		<script src="js/assets/json2.min.js"></script>
	</div>
	</td>
  </tr>
</table>
</div>

<h3>Group 10</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Sheep/Goats: <input name="num_sheep_10" type="text" id="num_sheep_10"><br>
Breed: <select size="1" name="sheep_breed_10">
<option value="">No Breed Selected</option>
<option value="Alpine">Alpine</option>
<option value="American Blackbelly">American Blackbelly</option>
<option value="Angora">Angora</option>
<option value="Babydoll">Babydoll</option>
<option value="Barbados Blackbelly">Barbados Blackbelly</option>
<option value="Black Welsh Mountain">Black Welsh Mountain</option>
<option value="Black-faced">Black-faced</option>
<option value="Boer">Boer</option>
<option value="Border Cheviot">Border Cheviot</option>
<option value="California Red">California Red</option>
<option value="California Variegated Mutant">California Variegated Mutant</option>
<option value="Cashmere">Cashmere</option>
<option value="Cheviot">Cheviot</option>
<option value="Columbia">Columbia</option>
<option value="Cormo">Cormo</option>
<option value="Cotswold">Cotswold</option>
<option value="Dairy-type crossbred">Dairy-type crossbred</option>
<option value="Debouillet">Debouillet</option>
<option value="Devon">Devon</option>
<option value="Dorper">Dorper</option>
<option value="Dorset">Dorset</option>
<option value="Eastern Friesian">Eastern Friesian</option>
<option value="Fiber-type crossbred">Fiber-type crossbred</option>
<option value="Finnish Landrace">Finnish Landrace</option>
<option value="Golden Guernsey">Golden Guernsey</option>
<option value="Gulf Coast">Gulf Coast</option>
<option value="Hairsheep crossbred">Hairsheep, crossbred</option>
<option value="Hampshire">Hampshire</option>
<option value="Horned Dorset">Horned Dorset</option>
<option value="Icelandic">Icelandic</option>
<option value="Jacob">Jacob</option>
<option value="Karakul">Karakul</option>
<option value="Kiko">Kiko</option>
<option value="La Mancha">La Mancha</option>
<option value="Leicester">Leicester</option>
<option value="Lincoln">Lincoln</option>
<option value="Meat-type crossbred">Meat-type crossbred</option>
<option value="Merino">Merino</option>
<option value="Montadale">Montadale</option>
<option value="Mottle-faced">Mottle-faced</option>
<option value="Myotonic">Myotonic</option>
<option value="Natural Colored">Natural Colored</option>
<option value="Navajo">Navajo</option>
<option value="Nigerian Dwarf">Nigerian Dwarf</option>
<option value="Nubian">Nubian</option>
<option value="Oberhasli">Oberhasli</option>
<option value="Other">Other</option>
<option value="Oxford">Oxford</option>
<option value="Perendale">Perendale</option>
<option value="Polled Dorset">Polled Dorset</option>
<option value="Polypay">Polypay</option>
<option value="Pygmy">Pygmy</option>
<option value="Pygora">Pygora</option>
<option value="Rambouillet">Rambouillet</option>
<option value="Romanov">Romanov</option>
<option value="Romnelet">Romnelet</option>
<option value="Romney">Romney</option>
<option value="Saanen">Saanen</option>
<option value="Sable">Sable</option>
<option value="Shetland">Shetland</option>
<option value="Shropshire">Shropshire</option>
<option value="Solid face color not black">Solid face color, not black</option>
<option value="Southdown">Southdown</option>
<option value="Spanish">Spanish</option>
<option value="St Croix">St Croix</option>
<option value="Suffolk">Suffolk</option>
<option value="Targhee">Targhee</option>
<option value="Teeswater">Teeswater</option>
<option value="Texel">Texel</option>
<option value="Toggenburg">Toggenburg</option>
<option value="Tunis">Tunis</option>
<option value="Wensleydale">Wensleydale</option>
<option value="White Dorper">White Dorper</option>
<option value="White-faced">White-faced</option>
<option value="Wiltshire Horn">Wiltshire Horn</option>
</select><br>
Gender: <select size="1" name="sheep_gender_10">
<option value="">No Gender Selected</option>
<option value="Billy">Billy</option>
<option value="Buck">Buck</option>
<option value="Buckling">Buckling</option>
<option value="Doe">Doe</option>
<option value="Doeling">Doeling</option>
<option value="Ewe">Ewe</option>
<option value="Kid">Kid</option>
<option value="Nanny">Nanny</option>
<option value="Ram">Ram</option>
<option value="Wether">Wether</option>
</select><br>
Color: <select size="1" name="sheep_color_10">
<option value="">No Color Selected</option>
<option value="Bezoar">Bezoar</option>
<option value="Black">Black</option>
<option value="Black & Tan">Black &amp; Tan</option>
<option value="Black Mask">Black Mask</option>
<option value="Blackbelly">Blackbelly</option>
<option value="Caramel">Caramel</option>
<option value="Eyebar">Eyebar</option>
<option value="Fishy">Fishy</option>
<option value="Grey">Grey</option>
<option value="Grey agouti">Grey agouti</option>
<option value="Lateral stripes">Lateral stripes</option>
<option value="Mahogany">Mahogany</option>
<option value="Other">Other</option>
<option value="Peacock">Peacock</option>
<option value="Red cheek">Red cheek</option>
<option value="Repartida">Repartida</option>
<option value="San Clemente">San Clemente</option>
<option value="Striped grey">Striped grey</option>
<option value="Tan sides">Tan sides</option>
<option value="Toggenburg">Toggenburg</option>
<option value="White">White</option>
</select>
	</td>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="left" valign="top">
Brand:
	<div class="sigPad">
		<ul class="sigNav">
			<li class="clearButton"><a href="#clear">Clear</a></li>
		</ul>
		<div class="sig sigBRANDWrapper">
			<div class="typed"></div>
				<canvas class="pad" width="250" height="250"></canvas>
				<input type="hidden" name="output_sheep_10" class="output">
		</div>
		<script src="js/jquery.signaturepad.min.js"></script>
		<script>
		$(document).ready(function () {
			$('.sigPad').signaturePad({drawOnly : false});
//			$('.sigPad').signaturePad({drawOnly : true});
// this is changed from true to false only because the signatures tab is commented out
// the last one in the series has to be false; the three signatures are marked false
		});
		</script>
		<script src="js/assets/json2.min.js"></script>
	</div>
	</td>
  </tr>
</table>
</div>

</div> <!-- end of accordion -->
</div> <!-- end of tab -->
	<div id="tabs-7"> <!-- payment -->
<table border="0" cellpadding="5" cellspacing="5" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
<table border="1" cellpadding="5" cellspacing="5" style="border-collapse: collapse" bordercolor="#999">
  <tr>
    <td align="center">
<table border="0" cellpadding="5" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">Remove Minimum Fee?:</td>
    <td align="left" valign="top"><input type="checkbox" name="remove_min_fee" id="remove_min_fee" value="no_min" onclick="figurePayment();"></td>
  </tr>
  <tr>
    <td align="left" valign="top">Remove Service Charge Fee?:</td>
    <td align="left" valign="top"><input type="checkbox" name="remove_svc_chg_fee" id="remove_svc_chg_fee" value="no_svc_chg" onclick="figurePayment();"></td>
  </tr>
</table>
</td>
  </tr>
</table>
&nbsp;<br>
<table border="1" cellpadding="5" cellspacing="5" style="border-collapse: collapse" bordercolor="#999">
  <tr>
    <td align="center">
<table border="0" cellpadding="5" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">Total # Sheep/Goats:</td>
    <td align="right" valign="top"><input type="text" id="totalSheep" value="" size="5" disabled></td>
  </tr>
  <tr>
  	<td align="left" valign="top">Service Charge Fee:</td>
<!--    <td align="left" valign="top">Minimum Fee:</td>-->
<!-- quick and dirty hack; the variables are mis-named throughout the whole application. FIX LATER -->
    <td align="right" valign="top">$<input type="text" id="minimumFee" value="" size="5" disabled></td>
  </tr>
  <tr>
  	<td align="left" valign="top">Minimum Fee:</td>
<!--    <td align="left" valign="top">Service Charge Fee:</td>-->
    <td align="right" valign="top">$<input type="text" id="serviceChargeFee" value="" size="5" disabled></td>
  </tr>
  <tr>
    <td align="left" valign="top">Total Due:</td>
    <td align="right" valign="top">$<input type="text" id="totalDueFee" value="" size="5" disabled></td>
  </tr>
</table>
</td>
  </tr>
</table>
</td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="left" valign="top">
Reference Number: <input name="prev_cert_number" type="text" id="prev_cert_number"><br>
Payment*: <select size="1" name="paid_in_full">
<option value="0">No</option>
<option value="1">Yes</option>
</select><br>
Payment Method*: <select size="1" name="payment_method">
<option value="AR">Accounts Receivable</option>
<option value="Cash">Cash</option>
<option value="Check">Check</option>
</select><br>
Inspection Notes: <textarea rows="5" cols="50" name="inspection_notes" id="inspection_notes" maxlength="200"></textarea><br>
<script type="text/javascript">
	$(document).ready(function($){
		$().maxlength();
	});
</script>
</td>
  </tr>
</table>
	</div>
<!--	<div id="tabs-8">  signature -->
<!--	<table border="0" cellpadding="5" cellspacing="0" style="border-collapse: collapse">-->
<!--  <tr>-->
<!--    <td align="left" valign="top">Inspector Signature:<p>-->
<!--	<div class="sigPad">-->
<!--		<ul class="sigNav">-->
<!--		    <li class="clearButton"><a href="#clear">Clear</a></li>-->
<!--		</ul>-->
<!--		<div class="sig sigWrapper">-->
<!--			<div class="typed"></div>-->
<!--				<canvas class="pad" width="250" height="50"></canvas>-->
<!--				<input type="hidden" name="output_sig_inspector" class="output">-->
<!--		</div>-->
<!--		<script src="js/jquery.signaturepad.min.js"></script>-->
<!--		<script>-->
<!--		$(document).ready(function () {-->
<!--			$('.sigPad').signaturePad({drawOnly : false});-->
<!--		});-->
<!--		</script>-->
<!--		<script src="js/assets/json2.min.js"></script>-->
<!--	</div>-->
<!--	</td>-->
<!--	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>-->
<!--    <td align="left" valign="top">Owner Signature:<p>-->
<!--	<div class="sigPad">-->
<!--		<ul class="sigNav">-->
<!--			<li class="clearButton"><a href="#clear">Clear</a></li>-->
<!--		</ul>-->
<!--		<div class="sig sigWrapper">-->
<!--			<div class="typed"></div>-->
<!--				<canvas class="pad" width="250" height="50"></canvas>-->
<!--				<input type="hidden" name="output_sig_owner" class="output">-->
<!--		</div>-->
<!--		<script src="js/jquery.signaturepad.min.js"></script>-->
<!--		<script>-->
<!--		$(document).ready(function () {-->
<!--			$('.sigPad').signaturePad({drawOnly : false});-->
<!--		});-->
<!--		</script>-->
<!--		<script src="js/assets/json2.min.js"></script>-->
<!--	</div>-->
<!--	</td>-->
<!--	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>-->
<!--    <td align="left" valign="top">Buyer Signature:<p>-->
<!--	<div class="sigPad">-->
<!--		<ul class="sigNav">-->
<!--			<li class="clearButton"><a href="#clear">Clear</a></li>-->
<!--		</ul>-->
<!--		<div class="sig sigWrapper">-->
<!--			<div class="typed"></div>-->
<!--				<canvas class="pad" width="250" height="50"></canvas>-->
<!--				<input type="hidden" name="output_sig_buyer" class="output">-->
<!--		</div>-->
<!--		<script src="js/jquery.signaturepad.min.js"></script>-->
<!--		<script>-->
<!--		$(document).ready(function () {-->
<!--			$('.sigPad').signaturePad({drawOnly : false});-->
<!--		});-->
<!--		</script>-->
<!--		<script src="js/assets/json2.min.js"></script>-->
<!--	</div>-->
<!--	</td>-->
<!--  </tr>-->
<!--</table>-->
<!---->
<!--	</div>-->
</div>
<p>
<input name="add" type="submit" id="add" value="Create Certificate">
<?php
}
?>
<!-- this is where the html formatting picks up again -->
</td>
    </tr>
  </table>

  </center>
</div>
</body>
</html>

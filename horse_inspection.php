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
<!--	<script src="js/livestock_horse.js"></script>-->

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
$num_horse_country = ($num_horse_country_01 + $num_horse_country_02);
$num_horse_permit = ($num_horse_permit_01 + $num_horse_permit_02);

$num_horse_01 = ($num_horse_country_01 + $num_horse_permit_01);
$num_horse_02 = ($num_horse_country_02 + $num_horse_permit_02);

$horse_country_fee = $num_horse_country * 1;
$num_horses = ($num_horse_country + $num_horse_permit);
$horse_service_charge_fee = ($horse_country_fee);

if ($num_horses < 1)
{
$horse_minimum_fee = 0;
}
;
if ($num_horses >= 1)
{
$horse_minimum_fee = 15;
}
;

$horse_permit_fee = $num_horse_permit * 25;

$horse_board_fee = $num_horses * 3;
if ($horse_board_fee > 100) {
$horse_board_fee = 100;
}
;
//this is for exempt conditions, such as mules, donkeys, card, out of state, more than 100 - no HB fee
$remove_hb_fee_01 = $_POST['horse_movement_01'];
if (!empty($remove_hb_fee_01)){
$neg_hb_fee_01 = (($num_horse_country_01 + $num_horse_permit_01) * (-3));
}
;
$remove_hb_fee_02 = $_POST['horse_movement_02'];
if (!empty($remove_hb_fee_02)){
$neg_hb_fee_02 = (($num_horse_country_02 + $num_horse_permit_02) * (-3));
}
;
$neg_hb_fee = ($neg_hb_fee_01 + $neg_hb_fee_02);

//this is for multiple/continuation stock certificates
$remove_min_fee = $_POST['remove_min_fee'];
if (!empty($remove_min_fee)){
$horse_minimum_fee = 0;
}
;
$remove_svc_chg_fee = $_POST['remove_svc_chg_fee'];
if (!empty($remove_svc_chg_fee)){
$horse_service_charge_fee = 0;
$horse_board_fee = 0;
$neg_hb_fee = 0;
}
;
$horse_board_fee = ($horse_board_fee + $neg_hb_fee);
$total_due_fee = ($horse_service_charge_fee + $horse_minimum_fee + $horse_board_fee + $horse_permit_fee);
//end calculations

// once signatures are reinstated, add these in back after inspection notes:
// , signature_inspector, signature_owner, signature_buyer
// ,'$output_sig_inspector','$output_sig_owner','$output_sig_buyer'
$sql = "INSERT INTO certificates ".
 "(num_horses, cert_date, clss_coin_owner, clss_name_owner, clss_address_owner,
clss_city_owner, clss_state_owner, clss_zip_owner, clss_county_owner, clss_coin_buyer,
clss_name_buyer, clss_address_buyer, clss_city_buyer, clss_state_buyer, clss_zip_buyer,
clss_county_buyer, num_horse_01, num_horse_02, 
brand_horse_01, brand_horse_02, brand_horse_03, brand_horse_04, brand_horse_05, brand_horse_06,
brand_horse_07, brand_horse_08, brand_horse_09, brand_horse_10, horse_breed_01, horse_breed_02,
horse_color_01, horse_color_02, horse_gender_01, horse_gender_02, horse_marking_all_01, horse_marking_all_02, 
horse_marking_bf_01, horse_marking_bf_02, horse_marking_bh_01, horse_marking_bh_02, 
horse_marking_eyes_01, horse_marking_eyes_02, horse_marking_head_01, horse_marking_head_02, 
horse_marking_lf_01, horse_marking_lf_02, horse_marking_lh_01, horse_marking_lh_02,
horse_marking_rf_01, horse_marking_rf_02, horse_marking_rh_01, horse_marking_rh_02,
horse_brand_location_01_LJ, horse_brand_location_01_LN, horse_brand_location_01_LS, horse_brand_location_01_LR, horse_brand_location_01_LH, 
horse_brand_location_01_LT, horse_brand_location_01_LB, horse_brand_location_01_RJ, horse_brand_location_01_RN, horse_brand_location_01_RS, 
horse_brand_location_01_RR, horse_brand_location_01_RH, horse_brand_location_01_RT, horse_brand_location_01_RB, horse_brand_location_01_DIM, 
horse_brand_location_01_BOTCH, horse_brand_location_01_FREEZE, horse_brand_location_02_LJ, horse_brand_location_02_LN, horse_brand_location_02_LS, 
horse_brand_location_02_LR, horse_brand_location_02_LH, horse_brand_location_02_LT, horse_brand_location_02_LB, horse_brand_location_02_RJ, 
horse_brand_location_02_RN, horse_brand_location_02_RS, horse_brand_location_02_RR, horse_brand_location_02_RH, horse_brand_location_02_RT, 
horse_brand_location_02_RB, horse_brand_location_02_DIM, horse_brand_location_02_BOTCH, horse_brand_location_02_FREEZE, horse_brand_location_03_LJ, 
horse_brand_location_03_LN, horse_brand_location_03_LS, horse_brand_location_03_LR, horse_brand_location_03_LH, horse_brand_location_03_LT, 
horse_brand_location_03_LB, horse_brand_location_03_RJ, horse_brand_location_03_RN, horse_brand_location_03_RS, horse_brand_location_03_RR, 
horse_brand_location_03_RH, horse_brand_location_03_RT, horse_brand_location_03_RB, horse_brand_location_03_DIM, horse_brand_location_03_BOTCH, 
horse_brand_location_03_FREEZE, horse_brand_location_04_LJ, horse_brand_location_04_LN, horse_brand_location_04_LS, horse_brand_location_04_LR, 
horse_brand_location_04_LH, horse_brand_location_04_LT, horse_brand_location_04_LB, horse_brand_location_04_RJ, horse_brand_location_04_RN, 
horse_brand_location_04_RS, horse_brand_location_04_RR, horse_brand_location_04_RH, horse_brand_location_04_RT, horse_brand_location_04_RB, 
horse_brand_location_04_DIM, horse_brand_location_04_BOTCH, horse_brand_location_04_FREEZE, horse_brand_location_05_LJ, horse_brand_location_05_LN, 
horse_brand_location_05_LS, horse_brand_location_05_LR, horse_brand_location_05_LH, horse_brand_location_05_LT, horse_brand_location_05_LB, 
horse_brand_location_05_RJ, horse_brand_location_05_RN, horse_brand_location_05_RS, horse_brand_location_05_RR, horse_brand_location_05_RH, 
horse_brand_location_05_RT, horse_brand_location_05_RB, horse_brand_location_05_DIM, horse_brand_location_05_BOTCH, horse_brand_location_05_FREEZE, 
horse_brand_location_06_LJ, horse_brand_location_06_LN, horse_brand_location_06_LS, horse_brand_location_06_LR, horse_brand_location_06_LH, 
horse_brand_location_06_LT, horse_brand_location_06_LB, horse_brand_location_06_RJ, horse_brand_location_06_RN, horse_brand_location_06_RS, 
horse_brand_location_06_RR, horse_brand_location_06_RH, horse_brand_location_06_RT, horse_brand_location_06_RB, horse_brand_location_06_DIM, 
horse_brand_location_06_BOTCH, horse_brand_location_06_FREEZE, horse_brand_location_07_LJ, horse_brand_location_07_LN, horse_brand_location_07_LS, 
horse_brand_location_07_LR, horse_brand_location_07_LH, horse_brand_location_07_LT, horse_brand_location_07_LB, horse_brand_location_07_RJ, 
horse_brand_location_07_RN, horse_brand_location_07_RS, horse_brand_location_07_RR, horse_brand_location_07_RH, horse_brand_location_07_RT, 
horse_brand_location_07_RB, horse_brand_location_07_DIM, horse_brand_location_07_BOTCH, horse_brand_location_07_FREEZE, horse_brand_location_08_LJ, 
horse_brand_location_08_LN, horse_brand_location_08_LS, horse_brand_location_08_LR, horse_brand_location_08_LH, horse_brand_location_08_LT, 
horse_brand_location_08_LB, horse_brand_location_08_RJ, horse_brand_location_08_RN, horse_brand_location_08_RS, horse_brand_location_08_RR, 
horse_brand_location_08_RH, horse_brand_location_08_RT, horse_brand_location_08_RB, horse_brand_location_08_DIM, horse_brand_location_08_BOTCH, 
horse_brand_location_08_FREEZE, horse_brand_location_09_LJ, horse_brand_location_09_LN, horse_brand_location_09_LS, horse_brand_location_09_LR, 
horse_brand_location_09_LH, horse_brand_location_09_LT, horse_brand_location_09_LB, horse_brand_location_09_RJ, horse_brand_location_09_RN, 
horse_brand_location_09_RS, horse_brand_location_09_RR, horse_brand_location_09_RH, horse_brand_location_09_RT, horse_brand_location_09_RB, 
horse_brand_location_09_DIM, horse_brand_location_09_BOTCH, horse_brand_location_09_FREEZE, horse_brand_location_10_LJ, horse_brand_location_10_LN, 
horse_brand_location_10_LS, horse_brand_location_10_LR, horse_brand_location_10_LH, horse_brand_location_10_LT, horse_brand_location_10_LB, 
horse_brand_location_10_RJ, horse_brand_location_10_RN, horse_brand_location_10_RS, horse_brand_location_10_RR, horse_brand_location_10_RH, 
horse_brand_location_10_RT, horse_brand_location_10_RB, horse_brand_location_10_DIM, horse_brand_location_10_BOTCH, horse_brand_location_10_FREEZE, 
horse_minimum_fee, horse_service_charge_fee, horse_board_fee, horse_permit_fee, total_due_fee, paid_in_full, payment_method,
inspection_notes
) ".
     "VALUES('$num_horses','$cert_date',
	 '$clss_coin_owner','$clss_name_owner','$clss_address_owner','$clss_city_owner','$clss_state_owner',
	 '$clss_zip_owner','$clss_county_owner','$clss_coin_buyer','$clss_name_buyer',
	 '$clss_address_buyer','$clss_city_buyer','$clss_state_buyer','$clss_zip_buyer',
	 '$clss_county_buyer','$num_horse_01','$num_horse_02',
	 '$output_horse_01','$output_horse_02','$output_horse_03','$output_horse_04','$output_horse_05',
	 '$output_horse_06','$output_horse_07','$output_horse_08','$output_horse_09','$output_horse_10', '$horse_breed_01','$horse_breed_02', 
	 '$horse_color_01','$horse_color_02', '$horse_gender_01','$horse_gender_02', '$horse_marking_all_01','$horse_marking_all_02',
	 '$horse_marking_bf_01','$horse_marking_bf_02', '$horse_marking_bh_01','$horse_marking_bh_02',
	 '$horse_marking_eyes_01','$horse_marking_eyes_02', '$horse_marking_head_01','$horse_marking_head_02',
	 '$horse_marking_lf_01','$horse_marking_lf_02', '$horse_marking_lh_01','$horse_marking_lh_02',
	 '$horse_marking_rf_01','$horse_marking_rf_02', '$horse_marking_rh_01','$horse_marking_rh_02',
	 '$horse_brand_location_01_LJ','$horse_brand_location_01_LN','$horse_brand_location_01_LS','$horse_brand_location_01_LR','$horse_brand_location_01_LH',
	 '$horse_brand_location_01_LT','$horse_brand_location_01_LB','$horse_brand_location_01_RJ','$horse_brand_location_01_RN','$horse_brand_location_01_RS',
	 '$horse_brand_location_01_RR','$horse_brand_location_01_RH','$horse_brand_location_01_RT','$horse_brand_location_01_RB','$horse_brand_location_01_DIM',
	 '$horse_brand_location_01_BOTCH','$horse_brand_location_01_FREEZE','$horse_brand_location_02_LJ','$horse_brand_location_02_LN','$horse_brand_location_02_LS',
	 '$horse_brand_location_02_LR','$horse_brand_location_02_LH','$horse_brand_location_02_LT','$horse_brand_location_02_LB','$horse_brand_location_02_RJ',
	 '$horse_brand_location_02_RN','$horse_brand_location_02_RS','$horse_brand_location_02_RR','$horse_brand_location_02_RH','$horse_brand_location_02_RT',
	 '$horse_brand_location_02_RB','$horse_brand_location_02_DIM','$horse_brand_location_02_BOTCH','$horse_brand_location_02_FREEZE','$horse_brand_location_03_LJ',
	 '$horse_brand_location_03_LN','$horse_brand_location_03_LS','$horse_brand_location_03_LR','$horse_brand_location_03_LH','$horse_brand_location_03_LT',
	 '$horse_brand_location_03_LB','$horse_brand_location_03_RJ','$horse_brand_location_03_RN','$horse_brand_location_03_RS','$horse_brand_location_03_RR',
	 '$horse_brand_location_03_RH','$horse_brand_location_03_RT','$horse_brand_location_03_RB','$horse_brand_location_03_DIM','$horse_brand_location_03_BOTCH',
	 '$horse_brand_location_03_FREEZE','$horse_brand_location_04_LJ','$horse_brand_location_04_LN','$horse_brand_location_04_LS','$horse_brand_location_04_LR',
	 '$horse_brand_location_04_LH','$horse_brand_location_04_LT','$horse_brand_location_04_LB','$horse_brand_location_04_RJ','$horse_brand_location_04_RN',
	 '$horse_brand_location_04_RS','$horse_brand_location_04_RR','$horse_brand_location_04_RH','$horse_brand_location_04_RT','$horse_brand_location_04_RB',
	 '$horse_brand_location_04_DIM','$horse_brand_location_04_BOTCH','$horse_brand_location_04_FREEZE','$horse_brand_location_05_LJ','$horse_brand_location_05_LN',
	 '$horse_brand_location_05_LS','$horse_brand_location_05_LR','$horse_brand_location_05_LH','$horse_brand_location_05_LT','$horse_brand_location_05_LB',
	 '$horse_brand_location_05_RJ','$horse_brand_location_05_RN','$horse_brand_location_05_RS','$horse_brand_location_05_RR','$horse_brand_location_05_RH',
	 '$horse_brand_location_05_RT','$horse_brand_location_05_RB','$horse_brand_location_05_DIM','$horse_brand_location_05_BOTCH','$horse_brand_location_05_FREEZE',
	 '$horse_brand_location_06_LJ','$horse_brand_location_06_LN','$horse_brand_location_06_LS','$horse_brand_location_06_LR','$horse_brand_location_06_LH',
	 '$horse_brand_location_06_LT','$horse_brand_location_06_LB','$horse_brand_location_06_RJ','$horse_brand_location_06_RN','$horse_brand_location_06_RS',
	 '$horse_brand_location_06_RR','$horse_brand_location_06_RH','$horse_brand_location_06_RT','$horse_brand_location_06_RB','$horse_brand_location_06_DIM',
	 '$horse_brand_location_06_BOTCH','$horse_brand_location_06_FREEZE','$horse_brand_location_07_LJ','$horse_brand_location_07_LN','$horse_brand_location_07_LS',
	 '$horse_brand_location_07_LR','$horse_brand_location_07_LH','$horse_brand_location_07_LT','$horse_brand_location_07_LB','$horse_brand_location_07_RJ',
	 '$horse_brand_location_07_RN','$horse_brand_location_07_RS','$horse_brand_location_07_RR','$horse_brand_location_07_RH','$horse_brand_location_07_RT',
	 '$horse_brand_location_07_RB','$horse_brand_location_07_DIM','$horse_brand_location_07_BOTCH','$horse_brand_location_07_FREEZE','$horse_brand_location_08_LJ',
	 '$horse_brand_location_08_LN','$horse_brand_location_08_LS','$horse_brand_location_08_LR','$horse_brand_location_08_LH','$horse_brand_location_08_LT',
	 '$horse_brand_location_08_LB','$horse_brand_location_08_RJ','$horse_brand_location_08_RN','$horse_brand_location_08_RS','$horse_brand_location_08_RR',
	 '$horse_brand_location_08_RH','$horse_brand_location_08_RT','$horse_brand_location_08_RB','$horse_brand_location_08_DIM','$horse_brand_location_08_BOTCH',
	 '$horse_brand_location_08_FREEZE','$horse_brand_location_09_LJ','$horse_brand_location_09_LN','$horse_brand_location_09_LS','$horse_brand_location_09_LR',
	 '$horse_brand_location_09_LH','$horse_brand_location_09_LT','$horse_brand_location_09_LB','$horse_brand_location_09_RJ','$horse_brand_location_09_RN',
	 '$horse_brand_location_09_RS','$horse_brand_location_09_RR','$horse_brand_location_09_RH','$horse_brand_location_09_RT','$horse_brand_location_09_RB',
	 '$horse_brand_location_09_DIM','$horse_brand_location_09_BOTCH','$horse_brand_location_09_FREEZE','$horse_brand_location_10_LJ','$horse_brand_location_10_LN',
	 '$horse_brand_location_10_LS','$horse_brand_location_10_LR','$horse_brand_location_10_LH','$horse_brand_location_10_LT','$horse_brand_location_10_LB',
	 '$horse_brand_location_10_RJ','$horse_brand_location_10_RN','$horse_brand_location_10_RS','$horse_brand_location_10_RR','$horse_brand_location_10_RH',
	 '$horse_brand_location_10_RT', '$horse_brand_location_10_RB', '$horse_brand_location_10_DIM', '$horse_brand_location_10_BOTCH', '$horse_brand_location_10_FREEZE',
	 '$horse_minimum_fee','$horse_service_charge_fee','$horse_board_fee','$horse_permit_fee', '$total_due_fee','$paid_in_full','$payment_method',
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

if ($row['brand_horse_01']) {
	$imgbrand_horse_01 = sigJsonToImage($row['brand_horse_01'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_horse_01, 'drawings/'.$new.'-brand_horse_01.png');
	imagedestroy($imgbrand_horse_01);
}

if ($row['brand_horse_02']) {
	$imgbrand_horse_02 = sigJsonToImage($row['brand_horse_02'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_horse_02, 'drawings/'.$new.'-brand_horse_02.png');
	imagedestroy($imgbrand_horse_02);
}

if ($row['brand_horse_03']) {
	$imgbrand_horse_03 = sigJsonToImage($row['brand_horse_03'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_horse_03, 'drawings/'.$new.'-brand_horse_03.png');
	imagedestroy($imgbrand_horse_03);
}

if ($row['brand_horse_04']) {
	$imgbrand_horse_04 = sigJsonToImage($row['brand_horse_04'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_horse_04, 'drawings/'.$new.'-brand_horse_04.png');
	imagedestroy($imgbrand_horse_04);
}

if ($row['brand_horse_05']) {
	$imgbrand_horse_05 = sigJsonToImage($row['brand_horse_05'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_horse_05, 'drawings/'.$new.'-brand_horse_05.png');
	imagedestroy($imgbrand_horse_05);
}

if ($row['brand_horse_06']) {
	$imgbrand_horse_06 = sigJsonToImage($row['brand_horse_06'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_horse_06, 'drawings/'.$new.'-brand_horse_06.png');
	imagedestroy($imgbrand_horse_06);
}

if ($row['brand_horse_07']) {
	$imgbrand_horse_07 = sigJsonToImage($row['brand_horse_07'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_horse_07, 'drawings/'.$new.'-brand_horse_07.png');
	imagedestroy($imgbrand_horse_07);
}

if ($row['brand_horse_08']) {
	$imgbrand_horse_08 = sigJsonToImage($row['brand_horse_08'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_horse_08, 'drawings/'.$new.'-brand_horse_08.png');
	imagedestroy($imgbrand_horse_08);
}

if ($row['brand_horse_09']) {
	$imgbrand_horse_09 = sigJsonToImage($row['brand_horse_09'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_horse_09, 'drawings/'.$new.'-brand_horse_09.png');
	imagedestroy($imgbrand_horse_09);
}

if ($row['brand_horse_10']) {
	$imgbrand_horse_10 = sigJsonToImage($row['brand_horse_10'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_horse_10, 'drawings/'.$new.'-brand_horse_10.png');
	imagedestroy($imgbrand_horse_10);
}

echo "<h3>";
echo "<a href=\"pdf-output-horse.php?cert_serial_num=".$row['cert_serial_num']."\">Click here to view Stock Certificate: " . $row['cert_series']. $row['cert_insp_num'] . $new . "</a>";
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
		<li><a href="#tabs-3" onclick="figurePayment();return false;">Horses/Mules/Donkeys</a></li>
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
	<div id="tabs-3"> <!-- horses -->
<div id="accordion">
<h3>Group 1</h3>
<div>
<table border="0" cellpadding="5" cellspacing="0" width="100%" style="border-collapse: collapse">
<tr>
<td align="left" valign="top" rowspan="7" width="33%">
# Country: <input name="num_horse_country_01" type="text" id="num_horse_country_01"><br>
# Travel Permits: <input name="num_horse_permit_01" type="text" id="num_horse_permit_01"><br>
Exemption: <input type="checkbox" name="horse_movement_01" value="no_min"><br>
Breed: <select size="1" name="horse_breed_01">
<option value="">No Breed Selected</option>
<option value="Andalusian">Andalusian</option>
<option value="Appaloosa">Appaloosa</option>
<option value="Arabian">Arabian</option>
<option value="Belgian">Belgian</option>
<option value="Berkshire">Berkshire</option>
<option value="Burro">Burro</option>
<option value="Clydesdale">Clydesdale</option>
<option value="Donkey">Donkey</option>
<option value="Draft Breed">Draft Breed</option>
<option value="Draft Cross">Draft Cross</option>
<option value="Fjord">Fjord</option>
<option value="Friesian">Friesian</option>
<option value="Grade">Grade</option>
<option value="Haflinger">Haflinger</option>
<option value="Hinny">Hinny</option>
<option value="Miniature">Miniature</option>
<option value="Missouri Fox Trotter">Missouri Fox Trotter</option>
<option value="Morgan">Morgan</option>
<option value="Mule">Mule</option>
<option value="Mustang">Mustang</option>
<option value="Other">Other</option>
<option value="Paint">Paint</option>
<option value="Paso Fino Peruvian">Paso Fino Peruvian</option>
<option value="Percheron">Percheron</option>
<option value="Pony">Pony</option>
<option value="Quarter Horse">Quarter Horse</option>
<option value="Rocky Mtn">Rocky Mtn</option>
<option value="Saddlebred">Saddlebred</option>
<option value="Salers">Salers</option>
<option value="Shire">Shire</option>
<option value="Tennessee Walker">Tennessee Walker</option>
<option value="Thoroughbred">Thoroughbred</option>
<option value="Warmblood">Warmblood</option>
</select><br>
Gender: <select size="1" name="horse_gender_01">
<option value="">No Gender Selected</option>
<option value="Filly">Filly</option>
<option value="Gelding">Gelding</option>
<option value="Jack">Jack</option>
<option value="Jenny">Jenny</option>
<option value="John">John</option>
<option value="Mare">Mare</option>
<option value="Molly">Molly</option>
<option value="Mule">Mule</option>
<option value="Other">Other</option>
<option value="Stallion">Stallion</option>
</select><br>
Color: <select size="1" name="horse_color_01">
<option value="">No Color Selected</option>
<option value="Bay">Bay</option>
<option value="Bay_Wht Pt">Bay &amp; Wht Pt</option>
<option value="Bay dun">Bay dun</option>
<option value="Black">Black</option>
<option value="Blk_Wht Pt">Blk &amp; Wht Pt</option>
<option value="Blonde">Blonde</option>
<option value="Blue Roan">Blue Roan</option>
<option value="Brown">Brown</option>
<option value="Buckskin">Buckskin</option>
<option value="Chestnut">Chestnut</option>
<option value="Cremello">Cremello</option>
<option value="Dun">Dun</option>
<option value="Dun_wht">Dun/wht</option>
<option value="Gray">Gray</option>
<option value="Grulla">Grulla</option>
<option value="Other">Other</option>
<option value="Pal_wht">Pal/wht</option>
<option value="Palomino">Palomino</option>
<option value="Red dun">Red dun</option>
<option value="Red Roan">Red Roan</option>
<option value="Sor_chest">Sor/chest</option>
<option value="Sorrel">Sorrel</option>
<option value="White">White</option>
</select><br>
</td>
<td align="center" valign="top" colspan="2" width="33%">Eyes<br>
<select size="1" name="horse_marking_eyes_01">
<option value="">No Markings</option>
<option value="Both Eyes">Both</option>
<option value="Left Eye">Left</option>
<option value="Right Eye">Right</option>
</select></td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td align="left" valign="top" rowspan="7" width="34%">
Brand:
	<div class="sigPad">
		<ul class="sigNav">
			<li class="clearButton"><a href="#clear">Clear</a></li>
		</ul>
		<div class="sig sigBRANDWrapper">
			<div class="typed"></div>
				<canvas class="pad" width="250" height="250"></canvas>
				<input type="hidden" name="output_horse_01" class="output">
		</div>
		<script src="js/jquery.signaturepad.min.js"></script>
		<script>
		$(document).ready(function () {
			$('.sigPad2').signaturePad({drawOnly : true});
		});
		</script>
		<script src="js/assets/json2.min.js"></script>
	</div>
<table border="0" cellpadding="0" cellspacing="0" width="250">
  <tr>
    <td align="center" width="100%">
      <input type="checkbox" name="horse_brand_location_01_LJ" value="LJ">LJ
      <input type="checkbox" name="horse_brand_location_01_LN" value="LN">LN
      <input type="checkbox" name="horse_brand_location_01_LS" value="LS">LS
      <input type="checkbox" name="horse_brand_location_01_LR" value="LR">LR
      <input type="checkbox" name="horse_brand_location_01_LH" value="LH">LH<br>
      <input type="checkbox" name="horse_brand_location_01_LT" value="LT">LT
      <input type="checkbox" name="horse_brand_location_01_LB" value="LB">LB
      <input type="checkbox" name="horse_brand_location_01_RJ" value="RJ">RJ
      <input type="checkbox" name="horse_brand_location_01_RN" value="RN">RN
      <input type="checkbox" name="horse_brand_location_01_RS" value="RS">RS<br>
      <input type="checkbox" name="horse_brand_location_01_RR" value="RR">RR
      <input type="checkbox" name="horse_brand_location_01_RH" value="RH">RH
      <input type="checkbox" name="horse_brand_location_01_RT" value="RT">RT
      <input type="checkbox" name="horse_brand_location_01_RB" value="RB">RB<br>
      <input type="checkbox" name="horse_brand_location_01_DIM" value="DIM">DIM
      <input type="checkbox" name="horse_brand_location_01_BOTCH" value="BOTCH">BOTCH
      <input type="checkbox" name="horse_brand_location_01_FREEZE" value="FREEZE">FREEZE
      </td>
  </tr>
</table>	
</td>
</tr>
<tr>
<td align="center" valign="top" colspan="2"><p>
Head<br>
<select size="1" name="horse_marking_head_01">
<option value="">No Markings</option>
<option value="Bald Face Head">Bald Face</option>
<option value="Blaze Head">Blaze</option>
<option value="Half Bald Face Head">Half Bald Face</option>
<option value="IRR Blaze Head">IRR Blaze</option>
<option value="IRR star stripe snip Head">IRR star, stripe, snip</option>
<option value="Lower Lip Head">Lower Lip</option>
<option value="Snip Head">Snip</option>
<option value="Star Head">Star</option>
<option value="Stripe Head">Stripe</option>
</select></td>
</tr>
<tr>
<td align="center" valign="top" colspan="2">ALL<br>
<select size="1" name="horse_marking_all_01">
<option value="">No Markings</option>
<option value="Cornet ALL">Cornet</option>
<option value="Half Cornet ALL">Half Cornet</option>
<option value="Half Pastern ALL">Half Pastern</option>
<option value="Pastern ALL">Pastern</option>
<option value="Sock ALL">Sock</option>
<option value="Stocking ALL">Stocking</option>
</select></td>
</tr>
<tr>
<td align="center" valign="top" colspan="2">BF<br>
<select size="1" name="horse_marking_bf_01">
<option value="">No Markings</option>
<option value="Cornet BF">Cornet</option>
<option value="Half Cornet BF">Half Cornet</option>
<option value="Half Pastern BF">Half Pastern</option>
<option value="Pastern BF">Pastern</option>
<option value="Sock BF">Sock</option>
<option value="Stocking BF">Stocking</option>
</select></td>
</tr>
<tr>
<td align="center" valign="top">
<p align="left">LF<br>
<select size="1" name="horse_marking_lf_01">
<option value="">No Markings</option>
<option value="Cornet LF">Cornet</option>
<option value="Half Cornet LF">Half Cornet</option>
<option value="Half Pastern LF">Half Pastern</option>
<option value="Pastern LF">Pastern</option>
<option value="Sock LF">Sock</option>
<option value="Stocking LF">Stocking</option>
</select></p>
</td>
<td align="center" valign="top">
<p align="right">RF<br>
<select size="1" name="horse_marking_rf_01">
<option value="">No Markings</option>
<option value="Cornet RF">Cornet</option>
<option value="Half Cornet RF">Half Cornet</option>
<option value="Half Pastern RF">Half Pastern</option>
<option value="Pastern RF">Pastern</option>
<option value="Sock RF">Sock</option>
<option value="Stocking RF">Stocking</option>
</select></p>
</td>
</tr>
<tr>
<td align="center" valign="top">
<p align="left">LH<br>
<select size="1" name="horse_marking_lh_01">
<option value="">No Markings</option>
<option value="Cornet LH">Cornet</option>
<option value="Half Cornet LH">Half Cornet</option>
<option value="Half Pastern LH">Half Pastern</option>
<option value="Pastern LH">Pastern</option>
<option value="Sock LH">Sock</option>
<option value="Stocking LH">Stocking</option>
</select></p>
</td>
<td align="center" valign="top">
<p align="right">RH<br>
<select size="1" name="horse_marking_rh_01">
<option value="">No Markings</option>
<option value="Cornet RH">Cornet</option>
<option value="Half Cornet RH">Half Cornet</option>
<option value="Half Pastern RH">Half Pastern</option>
<option value="Pastern RH">Pastern</option>
<option value="Sock RH">Sock</option>
<option value="Stocking RH">Stocking</option>
</select></p>
</td>
</tr>
<tr>
<td align="center" valign="top" colspan="2">BH<br>
<select size="1" name="horse_marking_bh_01">
<option value="">No Markings</option>
<option value="Cornet BH">Cornet</option>
<option value="Half Cornet BH">Half Cornet</option>
<option value="Half Pastern BH">Half Pastern</option>
<option value="Pastern BH">Pastern</option>
<option value="Sock BH">Sock</option>
<option value="Stocking BH">Stocking</option>
</select></td>
</tr>
<tr>
<td align="right" valign="top" colspan="7"> </td>
</tr>
</table>
<table border="0" cellpadding="5" cellspacing="0" width="100%" style="border-collapse: collapse">
<tr>
<td align="center" valign="top" colspan="2">
Brand:
	<div class="sigPad">
		<ul class="sigNav">
			<li class="clearButton"><a href="#clear">Clear</a></li>
		</ul>
		<div class="sig sigBRANDWrapper">
			<div class="typed"></div>
				<canvas class="pad" width="250" height="250"></canvas>
				<input type="hidden" name="output_horse_02" class="output">
		</div>
		<script src="js/jquery.signaturepad.min.js"></script>
		<script>
		$(document).ready(function () {
			$('.sigPad').signaturePad({drawOnly : true});
		});
		</script>
		<script src="js/assets/json2.min.js"></script>
	</div>
<table border="0" cellpadding="0" cellspacing="0" width="250">
  <tr>
    <td align="center" width="100%">
      <input type="checkbox" name="horse_brand_location_02_LJ" value="LJ">LJ
      <input type="checkbox" name="horse_brand_location_02_LN" value="LN">LN
      <input type="checkbox" name="horse_brand_location_02_LS" value="LS">LS
      <input type="checkbox" name="horse_brand_location_02_LR" value="LR">LR
      <input type="checkbox" name="horse_brand_location_02_LH" value="LH">LH<br>
      <input type="checkbox" name="horse_brand_location_02_LT" value="LT">LT
      <input type="checkbox" name="horse_brand_location_02_LB" value="LB">LB
      <input type="checkbox" name="horse_brand_location_02_RJ" value="RJ">RJ
      <input type="checkbox" name="horse_brand_location_02_RN" value="RN">RN
      <input type="checkbox" name="horse_brand_location_02_RS" value="RS">RS<br>
      <input type="checkbox" name="horse_brand_location_02_RR" value="RR">RR
      <input type="checkbox" name="horse_brand_location_02_RH" value="RH">RH
      <input type="checkbox" name="horse_brand_location_02_RT" value="RT">RT
      <input type="checkbox" name="horse_brand_location_02_RB" value="RB">RB<br>
      <input type="checkbox" name="horse_brand_location_02_DIM" value="DIM">DIM
      <input type="checkbox" name="horse_brand_location_02_BOTCH" value="BOTCH">BOTCH
      <input type="checkbox" name="horse_brand_location_02_FREEZE" value="FREEZE">FREEZE
      </td>
  </tr>
</table>
</td>
<td align="center" valign="top" colspan="2">
Brand:
	<div class="sigPad">
		<ul class="sigNav">
			<li class="clearButton"><a href="#clear">Clear</a></li>
		</ul>
		<div class="sig sigBRANDWrapper">
			<div class="typed"></div>
				<canvas class="pad" width="250" height="250"></canvas>
				<input type="hidden" name="output_horse_03" class="output">
		</div>
		<script src="js/jquery.signaturepad.min.js"></script>
		<script>
		$(document).ready(function () {
			$('.sigPad').signaturePad({drawOnly : true});
		});
		</script>
		<script src="js/assets/json2.min.js"></script>
	</div>
<table border="0" cellpadding="0" cellspacing="0" width="250">
  <tr>
    <td align="center" width="100%">
      <input type="checkbox" name="horse_brand_location_03_LJ" value="LJ">LJ
      <input type="checkbox" name="horse_brand_location_03_LN" value="LN">LN
      <input type="checkbox" name="horse_brand_location_03_LS" value="LS">LS
      <input type="checkbox" name="horse_brand_location_03_LR" value="LR">LR
      <input type="checkbox" name="horse_brand_location_03_LH" value="LH">LH<br>
      <input type="checkbox" name="horse_brand_location_03_LT" value="LT">LT
      <input type="checkbox" name="horse_brand_location_03_LB" value="LB">LB
      <input type="checkbox" name="horse_brand_location_03_RJ" value="RJ">RJ
      <input type="checkbox" name="horse_brand_location_03_RN" value="RN">RN
      <input type="checkbox" name="horse_brand_location_03_RS" value="RS">RS<br>
      <input type="checkbox" name="horse_brand_location_03_RR" value="RR">RR
      <input type="checkbox" name="horse_brand_location_03_RH" value="RH">RH
      <input type="checkbox" name="horse_brand_location_03_RT" value="RT">RT
      <input type="checkbox" name="horse_brand_location_03_RB" value="RB">RB<br>
      <input type="checkbox" name="horse_brand_location_03_DIM" value="DIM">DIM
      <input type="checkbox" name="horse_brand_location_03_BOTCH" value="BOTCH">BOTCH
      <input type="checkbox" name="horse_brand_location_03_FREEZE" value="FREEZE">FREEZE
      </td>
  </tr>
</table>
</td>
<td align="center" valign="top" colspan="2">
Brand:
	<div class="sigPad">
		<ul class="sigNav">
			<li class="clearButton"><a href="#clear">Clear</a></li>
		</ul>
		<div class="sig sigBRANDWrapper">
			<div class="typed"></div>
				<canvas class="pad" width="250" height="250"></canvas>
				<input type="hidden" name="output_horse_04" class="output">
		</div>
		<script src="js/jquery.signaturepad.min.js"></script>
		<script>
		$(document).ready(function () {
			$('.sigPad').signaturePad({drawOnly : true});
		});
		</script>
		<script src="js/assets/json2.min.js"></script>
	</div>
<table border="0" cellpadding="0" cellspacing="0" width="250">
  <tr>
    <td align="center" width="100%">
      <input type="checkbox" name="horse_brand_location_04_LJ" value="LJ">LJ
      <input type="checkbox" name="horse_brand_location_04_LN" value="LN">LN
      <input type="checkbox" name="horse_brand_location_04_LS" value="LS">LS
      <input type="checkbox" name="horse_brand_location_04_LR" value="LR">LR
      <input type="checkbox" name="horse_brand_location_04_LH" value="LH">LH<br>
      <input type="checkbox" name="horse_brand_location_04_LT" value="LT">LT
      <input type="checkbox" name="horse_brand_location_04_LB" value="LB">LB
      <input type="checkbox" name="horse_brand_location_04_RJ" value="RJ">RJ
      <input type="checkbox" name="horse_brand_location_04_RN" value="RN">RN
      <input type="checkbox" name="horse_brand_location_04_RS" value="RS">RS<br>
      <input type="checkbox" name="horse_brand_location_04_RR" value="RR">RR
      <input type="checkbox" name="horse_brand_location_04_RH" value="RH">RH
      <input type="checkbox" name="horse_brand_location_04_RT" value="RT">RT
      <input type="checkbox" name="horse_brand_location_04_RB" value="RB">RB<br>
      <input type="checkbox" name="horse_brand_location_04_DIM" value="DIM">DIM
      <input type="checkbox" name="horse_brand_location_04_BOTCH" value="BOTCH">BOTCH
      <input type="checkbox" name="horse_brand_location_04_FREEZE" value="FREEZE">FREEZE
      </td>
  </tr>
</table>
</td>
<td align="center" valign="top" colspan="2">
Brand:
	<div class="sigPad">
		<ul class="sigNav">
			<li class="clearButton"><a href="#clear">Clear</a></li>
		</ul>
		<div class="sig sigBRANDWrapper">
			<div class="typed"></div>
				<canvas class="pad" width="250" height="250"></canvas>
				<input type="hidden" name="output_horse_05" class="output">
		</div>
		<script src="js/jquery.signaturepad.min.js"></script>
		<script>
		$(document).ready(function () {
			$('.sigPad').signaturePad({drawOnly : true});
		});
		</script>
		<script src="js/assets/json2.min.js"></script>
	</div>
<table border="0" cellpadding="0" cellspacing="0" width="250">
  <tr>
    <td align="center" width="100%">
      <input type="checkbox" name="horse_brand_location_05_LJ" value="LJ">LJ
      <input type="checkbox" name="horse_brand_location_05_LN" value="LN">LN
      <input type="checkbox" name="horse_brand_location_05_LS" value="LS">LS
      <input type="checkbox" name="horse_brand_location_05_LR" value="LR">LR
      <input type="checkbox" name="horse_brand_location_05_LH" value="LH">LH<br>
      <input type="checkbox" name="horse_brand_location_05_LT" value="LT">LT
      <input type="checkbox" name="horse_brand_location_05_LB" value="LB">LB
      <input type="checkbox" name="horse_brand_location_05_RJ" value="RJ">RJ
      <input type="checkbox" name="horse_brand_location_05_RN" value="RN">RN
      <input type="checkbox" name="horse_brand_location_05_RS" value="RS">RS<br>
      <input type="checkbox" name="horse_brand_location_05_RR" value="RR">RR
      <input type="checkbox" name="horse_brand_location_05_RH" value="RH">RH
      <input type="checkbox" name="horse_brand_location_05_RT" value="RT">RT
      <input type="checkbox" name="horse_brand_location_05_RB" value="RB">RB<br>
      <input type="checkbox" name="horse_brand_location_05_DIM" value="DIM">DIM
      <input type="checkbox" name="horse_brand_location_05_BOTCH" value="BOTCH">BOTCH
      <input type="checkbox" name="horse_brand_location_05_FREEZE" value="FREEZE">FREEZE
      </td>
  </tr>
</table>
</td>
</tr>
</table>
</div>
<h3>Group 2</h3>
<div>
<table border="0" cellpadding="5" cellspacing="0" width="100%" style="border-collapse: collapse">
<tr>
<td align="left" valign="top" rowspan="7" width="33%">
# Country: <input name="num_horse_country_02" type="text" id="num_horse_country_02"><br>
# Travel Permits: <input name="num_horse_permit_02" type="text" id="num_horse_permit_02"><br>
Exemption: <input type="checkbox" name="horse_movement_02" value="no_min"><br>
Breed: <select size="1" name="horse_breed_02">
<option value="">No Breed Selected</option>
<option value="Andalusian">Andalusian</option>
<option value="Appaloosa">Appaloosa</option>
<option value="Arabian">Arabian</option>
<option value="Belgian">Belgian</option>
<option value="Berkshire">Berkshire</option>
<option value="Burro">Burro</option>
<option value="Clydesdale">Clydesdale</option>
<option value="Donkey">Donkey</option>
<option value="Draft Breed">Draft Breed</option>
<option value="Draft Cross">Draft Cross</option>
<option value="Fjord">Fjord</option>
<option value="Friesian">Friesian</option>
<option value="Grade">Grade</option>
<option value="Haflinger">Haflinger</option>
<option value="Hinny">Hinny</option>
<option value="Miniature">Miniature</option>
<option value="Missouri Fox Trotter">Missouri Fox Trotter</option>
<option value="Morgan">Morgan</option>
<option value="Mule">Mule</option>
<option value="Mustang">Mustang</option>
<option value="Other">Other</option>
<option value="Paint">Paint</option>
<option value="Paso Fino Peruvian">Paso Fino Peruvian</option>
<option value="Percheron">Percheron</option>
<option value="Pony">Pony</option>
<option value="Quarter Horse">Quarter Horse</option>
<option value="Rocky Mtn">Rocky Mtn</option>
<option value="Saddlebred">Saddlebred</option>
<option value="Salers">Salers</option>
<option value="Shire">Shire</option>
<option value="Tennessee Walker">Tennessee Walker</option>
<option value="Thoroughbred">Thoroughbred</option>
<option value="Warmblood">Warmblood</option>
</select><br>
Gender: <select size="1" name="horse_gender_02">
<option value="">No Gender Selected</option>
<option value="Filly">Filly</option>
<option value="Gelding">Gelding</option>
<option value="Jack">Jack</option>
<option value="Jenny">Jenny</option>
<option value="John">John</option>
<option value="Mare">Mare</option>
<option value="Molly">Molly</option>
<option value="Mule">Mule</option>
<option value="Other">Other</option>
<option value="Stallion">Stallion</option>
</select><br>
Color: <select size="1" name="horse_color_02">
<option value="">No Color Selected</option>
<option value="Bay">Bay</option>
<option value="Bay_Wht Pt">Bay &amp; Wht Pt</option>
<option value="Bay dun">Bay dun</option>
<option value="Black">Black</option>
<option value="Blk_Wht Pt">Blk &amp; Wht Pt</option>
<option value="Blonde">Blonde</option>
<option value="Blue Roan">Blue Roan</option>
<option value="Brown">Brown</option>
<option value="Buckskin">Buckskin</option>
<option value="Chestnut">Chestnut</option>
<option value="Cremello">Cremello</option>
<option value="Dun">Dun</option>
<option value="Dun_wht">Dun/wht</option>
<option value="Gray">Gray</option>
<option value="Grulla">Grulla</option>
<option value="Other">Other</option>
<option value="Pal_wht">Pal/wht</option>
<option value="Palomino">Palomino</option>
<option value="Red dun">Red dun</option>
<option value="Red Roan">Red Roan</option>
<option value="Sor_chest">Sor/chest</option>
<option value="Sorrel">Sorrel</option>
<option value="White">White</option>
</select><br>
</td>
<td align="center" valign="top" colspan="2" width="33%">Eyes<br>
<select size="1" name="horse_marking_eyes_02">
<option value="">No Markings</option>
<option value="Both Eyes">Both</option>
<option value="Left Eye">Left</option>
<option value="Right Eye">Right</option>
</select></td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td align="left" valign="top" rowspan="7" width="34%">
Brand:
	<div class="sigPad">
		<ul class="sigNav">
			<li class="clearButton"><a href="#clear">Clear</a></li>
		</ul>
		<div class="sig sigBRANDWrapper">
			<div class="typed"></div>
				<canvas class="pad" width="250" height="250"></canvas>
				<input type="hidden" name="output_horse_06" class="output">
		</div>
		<script src="js/jquery.signaturepad.min.js"></script>
		<script>
		$(document).ready(function () {
			$('.sigPad').signaturePad({drawOnly : true});
		});
		</script>
		<script src="js/assets/json2.min.js"></script>
	</div>
<table border="0" cellpadding="0" cellspacing="0" width="250">
  <tr>
    <td align="center" width="100%">
      <input type="checkbox" name="horse_brand_location_06_LJ" value="LJ">LJ
      <input type="checkbox" name="horse_brand_location_06_LN" value="LN">LN
      <input type="checkbox" name="horse_brand_location_06_LS" value="LS">LS
      <input type="checkbox" name="horse_brand_location_06_LR" value="LR">LR
      <input type="checkbox" name="horse_brand_location_06_LH" value="LH">LH<br>
      <input type="checkbox" name="horse_brand_location_06_LT" value="LT">LT
      <input type="checkbox" name="horse_brand_location_06_LB" value="LB">LB
      <input type="checkbox" name="horse_brand_location_06_RJ" value="RJ">RJ
      <input type="checkbox" name="horse_brand_location_06_RN" value="RN">RN
      <input type="checkbox" name="horse_brand_location_06_RS" value="RS">RS<br>
      <input type="checkbox" name="horse_brand_location_06_RR" value="RR">RR
      <input type="checkbox" name="horse_brand_location_06_RH" value="RH">RH
      <input type="checkbox" name="horse_brand_location_06_RT" value="RT">RT
      <input type="checkbox" name="horse_brand_location_06_RB" value="RB">RB<br>
      <input type="checkbox" name="horse_brand_location_06_DIM" value="DIM">DIM
      <input type="checkbox" name="horse_brand_location_06_BOTCH" value="BOTCH">BOTCH
      <input type="checkbox" name="horse_brand_location_06_FREEZE" value="FREEZE">FREEZE
      </td>
  </tr>
</table>
</td>
</tr>
<tr>
<td align="center" valign="top" colspan="2"><p>
Head<br>
<select size="1" name="horse_marking_head_02">
<option value="">No Markings</option>
<option value="Bald Face Head">Bald Face</option>
<option value="Blaze Head">Blaze</option>
<option value="Half Bald Face Head">Half Bald Face</option>
<option value="IRR Blaze Head">IRR Blaze</option>
<option value="IRR star stripe snip Head">IRR star, stripe, snip</option>
<option value="Lower Lip Head">Lower Lip</option>
<option value="Snip Head">Snip</option>
<option value="Star Head">Star</option>
<option value="Stripe Head">Stripe</option>
</select></td>
</tr>
<tr>
<td align="center" valign="top" colspan="2">ALL<br>
<select size="1" name="horse_marking_all_02">
<option value="">No Markings</option>
<option value="Cornet ALL">Cornet</option>
<option value="Half Cornet ALL">Half Cornet</option>
<option value="Half Pastern ALL">Half Pastern</option>
<option value="Pastern ALL">Pastern</option>
<option value="Sock ALL">Sock</option>
<option value="Stocking ALL">Stocking</option>
</select></td>
</tr>
<tr>
<td align="center" valign="top" colspan="2">BF<br>
<select size="1" name="horse_marking_bf_02">
<option value="">No Markings</option>
<option value="Cornet BF">Cornet</option>
<option value="Half Cornet BF">Half Cornet</option>
<option value="Half Pastern BF">Half Pastern</option>
<option value="Pastern BF">Pastern</option>
<option value="Sock BF">Sock</option>
<option value="Stocking BF">Stocking</option>
</select></td>
</tr>
<tr>
<td align="center" valign="top">
<p align="left">LF<br>
<select size="1" name="horse_marking_lf_02">
<option value="">No Markings</option>
<option value="Cornet LF">Cornet</option>
<option value="Half Cornet LF">Half Cornet</option>
<option value="Half Pastern LF">Half Pastern</option>
<option value="Pastern LF">Pastern</option>
<option value="Sock LF">Sock</option>
<option value="Stocking LF">Stocking</option>
</select></p>
</td>
<td align="center" valign="top">
<p align="right">RF<br>
<select size="1" name="horse_marking_rf_02">
<option value="">No Markings</option>
<option value="Cornet RF">Cornet</option>
<option value="Half Cornet RF">Half Cornet</option>
<option value="Half Pastern RF">Half Pastern</option>
<option value="Pastern RF">Pastern</option>
<option value="Sock RF">Sock</option>
<option value="Stocking RF">Stocking</option>
</select></p>
</td>
</tr>
<tr>
<td align="center" valign="top">
<p align="left">LH<br>
<select size="1" name="horse_marking_lh_02">
<option value="">No Markings</option>
<option value="Cornet LH">Cornet</option>
<option value="Half Cornet LH">Half Cornet</option>
<option value="Half Pastern LH">Half Pastern</option>
<option value="Pastern LH">Pastern</option>
<option value="Sock LH">Sock</option>
<option value="Stocking LH">Stocking</option>
</select></p>
</td>
<td align="center" valign="top">
<p align="right">RH<br>
<select size="1" name="horse_marking_rh_02">
<option value="">No Markings</option>
<option value="Cornet RH">Cornet</option>
<option value="Half Cornet RH">Half Cornet</option>
<option value="Half Pastern RH">Half Pastern</option>
<option value="Pastern RH">Pastern</option>
<option value="Sock RH">Sock</option>
<option value="Stocking RH">Stocking</option>
</select></p>
</td>
</tr>
<tr>
<td align="center" valign="top" colspan="2">BH<br>
<select size="1" name="horse_marking_bh_02">
<option value="">No Markings</option>
<option value="Cornet BH">Cornet</option>
<option value="Half Cornet BH">Half Cornet</option>
<option value="Half Pastern BH">Half Pastern</option>
<option value="Pastern BH">Pastern</option>
<option value="Sock BH">Sock</option>
<option value="Stocking BH">Stocking</option>
</select></td>
</tr>
<tr>
<td align="right" valign="top" colspan="7"> </td>
</tr>
</table>
<table border="0" cellpadding="5" cellspacing="0" width="100%" style="border-collapse: collapse">
<tr>
<td align="center" valign="top" colspan="2">
Brand:
	<div class="sigPad">
		<ul class="sigNav">
			<li class="clearButton"><a href="#clear">Clear</a></li>
		</ul>
		<div class="sig sigBRANDWrapper">
			<div class="typed"></div>
				<canvas class="pad" width="250" height="250"></canvas>
				<input type="hidden" name="output_horse_07" class="output">
		</div>
		<script src="js/jquery.signaturepad.min.js"></script>
		<script>
		$(document).ready(function () {
			$('.sigPad').signaturePad({drawOnly : true});
		});
		</script>
		<script src="js/assets/json2.min.js"></script>
	</div>
<table border="0" cellpadding="0" cellspacing="0" width="250">
  <tr>
    <td align="center" width="100%">
      <input type="checkbox" name="horse_brand_location_07_LJ" value="LJ">LJ
      <input type="checkbox" name="horse_brand_location_07_LN" value="LN">LN
      <input type="checkbox" name="horse_brand_location_07_LS" value="LS">LS
      <input type="checkbox" name="horse_brand_location_07_LR" value="LR">LR
      <input type="checkbox" name="horse_brand_location_07_LH" value="LH">LH<br>
      <input type="checkbox" name="horse_brand_location_07_LT" value="LT">LT
      <input type="checkbox" name="horse_brand_location_07_LB" value="LB">LB
      <input type="checkbox" name="horse_brand_location_07_RJ" value="RJ">RJ
      <input type="checkbox" name="horse_brand_location_07_RN" value="RN">RN
      <input type="checkbox" name="horse_brand_location_07_RS" value="RS">RS<br>
      <input type="checkbox" name="horse_brand_location_07_RR" value="RR">RR
      <input type="checkbox" name="horse_brand_location_07_RH" value="RH">RH
      <input type="checkbox" name="horse_brand_location_07_RT" value="RT">RT
      <input type="checkbox" name="horse_brand_location_07_RB" value="RB">RB<br>
      <input type="checkbox" name="horse_brand_location_07_DIM" value="DIM">DIM
      <input type="checkbox" name="horse_brand_location_07_BOTCH" value="BOTCH">BOTCH
      <input type="checkbox" name="horse_brand_location_07_FREEZE" value="FREEZE">FREEZE
      </td>
  </tr>
</table>
</td>
<td align="center" valign="top" colspan="2">
Brand:
	<div class="sigPad">
		<ul class="sigNav">
			<li class="clearButton"><a href="#clear">Clear</a></li>
		</ul>
		<div class="sig sigBRANDWrapper">
			<div class="typed"></div>
				<canvas class="pad" width="250" height="250"></canvas>
				<input type="hidden" name="output_horse_08" class="output">
		</div>
		<script src="js/jquery.signaturepad.min.js"></script>
		<script>
		$(document).ready(function () {
			$('.sigPad').signaturePad({drawOnly : true});
		});
		</script>
		<script src="js/assets/json2.min.js"></script>
	</div>
<table border="0" cellpadding="0" cellspacing="0" width="250">
  <tr>
    <td align="center" width="100%">
      <input type="checkbox" name="horse_brand_location_08_LJ" value="LJ">LJ
      <input type="checkbox" name="horse_brand_location_08_LN" value="LN">LN
      <input type="checkbox" name="horse_brand_location_08_LS" value="LS">LS
      <input type="checkbox" name="horse_brand_location_08_LR" value="LR">LR
      <input type="checkbox" name="horse_brand_location_08_LH" value="LH">LH<br>
      <input type="checkbox" name="horse_brand_location_08_LT" value="LT">LT
      <input type="checkbox" name="horse_brand_location_08_LB" value="LB">LB
      <input type="checkbox" name="horse_brand_location_08_RJ" value="RJ">RJ
      <input type="checkbox" name="horse_brand_location_08_RN" value="RN">RN
      <input type="checkbox" name="horse_brand_location_08_RS" value="RS">RS<br>
      <input type="checkbox" name="horse_brand_location_08_RR" value="RR">RR
      <input type="checkbox" name="horse_brand_location_08_RH" value="RH">RH
      <input type="checkbox" name="horse_brand_location_08_RT" value="RT">RT
      <input type="checkbox" name="horse_brand_location_08_RB" value="RB">RB<br>
      <input type="checkbox" name="horse_brand_location_08_DIM" value="DIM">DIM
      <input type="checkbox" name="horse_brand_location_08_BOTCH" value="BOTCH">BOTCH
      <input type="checkbox" name="horse_brand_location_08_FREEZE" value="FREEZE">FREEZE
      </td>
  </tr>
</table>
</td>
<td align="center" valign="top" colspan="2">
Brand:
	<div class="sigPad">
		<ul class="sigNav">
			<li class="clearButton"><a href="#clear">Clear</a></li>
		</ul>
		<div class="sig sigBRANDWrapper">
			<div class="typed"></div>
				<canvas class="pad" width="250" height="250"></canvas>
				<input type="hidden" name="output_horse_09" class="output">
		</div>
		<script src="js/jquery.signaturepad.min.js"></script>
		<script>
		$(document).ready(function () {
			$('.sigPad').signaturePad({drawOnly : true});
		});
		</script>
		<script src="js/assets/json2.min.js"></script>
	</div>
<table border="0" cellpadding="0" cellspacing="0" width="250">
  <tr>
    <td align="center" width="100%">
      <input type="checkbox" name="horse_brand_location_09_LJ" value="LJ">LJ
      <input type="checkbox" name="horse_brand_location_09_LN" value="LN">LN
      <input type="checkbox" name="horse_brand_location_09_LS" value="LS">LS
      <input type="checkbox" name="horse_brand_location_09_LR" value="LR">LR
      <input type="checkbox" name="horse_brand_location_09_LH" value="LH">LH<br>
      <input type="checkbox" name="horse_brand_location_09_LT" value="LT">LT
      <input type="checkbox" name="horse_brand_location_09_LB" value="LB">LB
      <input type="checkbox" name="horse_brand_location_09_RJ" value="RJ">RJ
      <input type="checkbox" name="horse_brand_location_09_RN" value="RN">RN
      <input type="checkbox" name="horse_brand_location_09_RS" value="RS">RS<br>
      <input type="checkbox" name="horse_brand_location_09_RR" value="RR">RR
      <input type="checkbox" name="horse_brand_location_09_RH" value="RH">RH
      <input type="checkbox" name="horse_brand_location_09_RT" value="RT">RT
      <input type="checkbox" name="horse_brand_location_09_RB" value="RB">RB<br>
      <input type="checkbox" name="horse_brand_location_09_DIM" value="DIM">DIM
      <input type="checkbox" name="horse_brand_location_09_BOTCH" value="BOTCH">BOTCH
      <input type="checkbox" name="horse_brand_location_09_FREEZE" value="FREEZE">FREEZE
      </td>
  </tr>
</table>
</td>
<td align="center" valign="top" colspan="2">
Brand:
	<div class="sigPad">
		<ul class="sigNav">
			<li class="clearButton"><a href="#clear">Clear</a></li>
		</ul>
		<div class="sig sigBRANDWrapper">
			<div class="typed"></div>
				<canvas class="pad" width="250" height="250"></canvas>
				<input type="hidden" name="output_horse_10" class="output">
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
<table border="0" cellpadding="0" cellspacing="0" width="250">
  <tr>
    <td align="center" width="100%">
      <input type="checkbox" name="horse_brand_location_10_LJ" value="LJ">LJ
      <input type="checkbox" name="horse_brand_location_10_LN" value="LN">LN
      <input type="checkbox" name="horse_brand_location_10_LS" value="LS">LS
      <input type="checkbox" name="horse_brand_location_10_LR" value="LR">LR
      <input type="checkbox" name="horse_brand_location_10_LH" value="LH">LH<br>
      <input type="checkbox" name="horse_brand_location_10_LT" value="LT">LT
      <input type="checkbox" name="horse_brand_location_10_LB" value="LB">LB
      <input type="checkbox" name="horse_brand_location_10_RJ" value="RJ">RJ
      <input type="checkbox" name="horse_brand_location_10_RN" value="RN">RN
      <input type="checkbox" name="horse_brand_location_10_RS" value="RS">RS<br>
      <input type="checkbox" name="horse_brand_location_10_RR" value="RR">RR
      <input type="checkbox" name="horse_brand_location_10_RH" value="RH">RH
      <input type="checkbox" name="horse_brand_location_10_RT" value="RT">RT
      <input type="checkbox" name="horse_brand_location_10_RB" value="RB">RB<br>
      <input type="checkbox" name="horse_brand_location_10_DIM" value="DIM">DIM
      <input type="checkbox" name="horse_brand_location_10_BOTCH" value="BOTCH">BOTCH
      <input type="checkbox" name="horse_brand_location_10_FREEZE" value="FREEZE">FREEZE
      </td>
  </tr>
</table>
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
    <td align="left" valign="top">Fee Waiver?:</td>
    <td align="left" valign="top"><input type="checkbox" name="remove_ten_only" id="remove_ten_only" value="no_chg_but_10" onclick="figurePayment();"></td>
  </tr>
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
    <td align="left" valign="top">Total # Horses/Mules/Donkeys:</td>
    <td align="right" valign="top"><input type="text" id="totalHorse" value="" size="5" disabled></td>
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
<!--<table border="0" cellpadding="5" cellspacing="0" style="border-collapse: collapse">-->
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

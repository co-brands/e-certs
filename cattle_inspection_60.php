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
<!--	<script src="js/livestock_cattle_60.js"></script>-->

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
// aggregate values, constants
$cert_date = date("Y-m-d");

$num_cattle = 
(
$num_cattle_01 + $num_cattle_02 + $num_cattle_03 + $num_cattle_04 + $num_cattle_05 + 
$num_cattle_06 + $num_cattle_07 + $num_cattle_08 + $num_cattle_09 + $num_cattle_10 +
$num_cattle_11 + $num_cattle_12 + $num_cattle_13 + $num_cattle_14 + $num_cattle_15 + 
$num_cattle_16 + $num_cattle_17 + $num_cattle_18 + $num_cattle_19 + $num_cattle_20 +
$num_cattle_21 + $num_cattle_22 + $num_cattle_23 + $num_cattle_24 + $num_cattle_25 + 
$num_cattle_26 + $num_cattle_27 + $num_cattle_28 + $num_cattle_29 + $num_cattle_30 +
$num_cattle_31 + $num_cattle_32 + $num_cattle_33 + $num_cattle_34 + $num_cattle_35 + 
$num_cattle_36 + $num_cattle_37 + $num_cattle_38 + $num_cattle_39 + $num_cattle_40 +
$num_cattle_41 + $num_cattle_42 + $num_cattle_43 + $num_cattle_44 + $num_cattle_45 + 
$num_cattle_46 + $num_cattle_47 + $num_cattle_48 + $num_cattle_49 + $num_cattle_50 +
$num_cattle_51 + $num_cattle_52 + $num_cattle_53 + $num_cattle_54 + $num_cattle_55 + 
$num_cattle_56 + $num_cattle_57 + $num_cattle_58 + $num_cattle_59 + $num_cattle_60
);

//cattle charges
$cattle_beef_council_fee = ($num_cattle * 1);

if ($num_cattle < 1)
{
$cattle_minimum_fee = 0;
}
;
if ($num_cattle >= 1)
{
$cattle_minimum_fee = 10;
}
;
if ($num_cattle < 1)
{
$cattle_service_charge_fee = 0;
}
;
if ($num_cattle > 0 && $cat_num_slaughter < 29)
{
$cattle_service_charge_fee = 15;
}
;
if ($num_cattle > 28 && $num_cattle <= 500)
{
$cattle_service_charge_fee = ($num_cattle * .53);
}
;
if ($num_cattle >= 501)
{
$cat_num_over = ($num_cattle - 500);
$cattle_service_charge_fee = (($cat_num_over * .50) + (500 * .53));
}

//certified feedlot charges
// haven't yet invoked with checkbox that these are feedlot direct to slaughter
//if ($cat_num_slaughter_cf < 1)
//{
//$cattle_slaughter_CF_charge_fee = 0;
//}
//;
//if ($cat_num_slaughter_cf >= 1)
//{
//$cattle_slaughter_CF_charge_fee = 15;
//}
//;
//$cattle_slaughter_CF_charge_fee = ($cat_num_slaughter_cf * .38);

//need to add checkbox for exempt, which removes BCF amounts
//BCF fees don't apply to exempt, rodeo, show, no change of ownership
// add $1000 per feedlot fee
// TODO: when you get to multiple certs, need to check for mult sellers to one buyer; this condition satisfies the minimum fee requirement

//totals
$total_due_fee = ($cattle_service_charge_fee + $cattle_minimum_fee + $cattle_beef_council_fee);
//end calculations

//, signature_inspector, signature_owner, signature_buyer - add back in after inspection notes once signatures are reinstated
$sql = "INSERT INTO certificates ".
       "(num_cattle, cert_date, clss_coin_owner, clss_name_owner, clss_address_owner,
clss_city_owner, clss_state_owner, clss_zip_owner, clss_county_owner, clss_coin_buyer,
clss_name_buyer, clss_address_buyer, clss_city_buyer, clss_state_buyer, clss_zip_buyer,
clss_county_buyer, 
num_cattle_01, num_cattle_02, num_cattle_03, num_cattle_04, num_cattle_05, 
num_cattle_06, num_cattle_07, num_cattle_08, num_cattle_09, num_cattle_10, 
num_cattle_11, num_cattle_12, num_cattle_13, num_cattle_14, num_cattle_15, 
num_cattle_16, num_cattle_17, num_cattle_18, num_cattle_19, num_cattle_20, 
num_cattle_21, num_cattle_22, num_cattle_23, num_cattle_24, num_cattle_25, 
num_cattle_26, num_cattle_27, num_cattle_28, num_cattle_29, num_cattle_30, 
num_cattle_31, num_cattle_32, num_cattle_33, num_cattle_34, num_cattle_35, 
num_cattle_36, num_cattle_37, num_cattle_38, num_cattle_39, num_cattle_40, 
num_cattle_41, num_cattle_42, num_cattle_43, num_cattle_44, num_cattle_45, 
num_cattle_46, num_cattle_47, num_cattle_48, num_cattle_49, num_cattle_50, 
num_cattle_51, num_cattle_52, num_cattle_53, num_cattle_54, num_cattle_55, 
num_cattle_56, num_cattle_57, num_cattle_58, num_cattle_59, num_cattle_60,
cattle_movement, cattle_movement_state, cattle_minimum_fee,
cattle_service_charge_fee, cattle_beef_council_fee, total_due_fee, paid_in_full, payment_method,
brand_cattle_01, brand_cattle_02, brand_cattle_03, brand_cattle_04, brand_cattle_05, 
brand_cattle_06, brand_cattle_07, brand_cattle_08, brand_cattle_09, brand_cattle_10, 
brand_cattle_11, brand_cattle_12, brand_cattle_13, brand_cattle_14, brand_cattle_15, 
brand_cattle_16, brand_cattle_17, brand_cattle_18, brand_cattle_19, brand_cattle_20, 
brand_cattle_21, brand_cattle_22, brand_cattle_23, brand_cattle_24, brand_cattle_25, 
brand_cattle_26, brand_cattle_27, brand_cattle_28, brand_cattle_29, brand_cattle_30, 
brand_cattle_31, brand_cattle_32, brand_cattle_33, brand_cattle_34, brand_cattle_35, 
brand_cattle_36, brand_cattle_37, brand_cattle_38, brand_cattle_39, brand_cattle_40, 
brand_cattle_41, brand_cattle_42, brand_cattle_43, brand_cattle_44, brand_cattle_45, 
brand_cattle_46, brand_cattle_47, brand_cattle_48, brand_cattle_49, brand_cattle_50, 
brand_cattle_51, brand_cattle_52, brand_cattle_53, brand_cattle_54, brand_cattle_55, 
brand_cattle_56, brand_cattle_57, brand_cattle_58, brand_cattle_59, brand_cattle_60,
inspection_notes
) ".
       "VALUES('$num_cattle','$cert_date',
	   '$clss_coin_owner','$clss_name_owner','$clss_address_owner','$clss_city_owner','$clss_state_owner',
	   '$clss_zip_owner','$clss_county_owner','$clss_coin_buyer','$clss_name_buyer',
		'$clss_address_buyer','$clss_city_buyer','$clss_state_buyer','$clss_zip_buyer',
		'$clss_county_buyer',
		'$num_cattle_01','$num_cattle_02','$num_cattle_03','$num_cattle_04','$num_cattle_05',
		'$num_cattle_06','$num_cattle_07','$num_cattle_08','$num_cattle_09','$num_cattle_10',
		'$num_cattle_11','$num_cattle_12','$num_cattle_13','$num_cattle_14','$num_cattle_15',
		'$num_cattle_16','$num_cattle_17','$num_cattle_18','$num_cattle_19','$num_cattle_20',
		'$num_cattle_21','$num_cattle_22','$num_cattle_23','$num_cattle_24','$num_cattle_25',
		'$num_cattle_26','$num_cattle_27','$num_cattle_28','$num_cattle_29','$num_cattle_30',
		'$num_cattle_31','$num_cattle_32','$num_cattle_33','$num_cattle_34','$num_cattle_35',
		'$num_cattle_36','$num_cattle_37','$num_cattle_38','$num_cattle_39','$num_cattle_40',
		'$num_cattle_41','$num_cattle_42','$num_cattle_43','$num_cattle_44','$num_cattle_45',
		'$num_cattle_46','$num_cattle_47','$num_cattle_48','$num_cattle_49','$num_cattle_50',
		'$num_cattle_51','$num_cattle_52','$num_cattle_53','$num_cattle_54','$num_cattle_55',
		'$num_cattle_56','$num_cattle_57','$num_cattle_58','$num_cattle_59','$num_cattle_60',
	   '$cattle_movement','$cattle_movement_state',
	   '$cattle_minimum_fee','$cattle_service_charge_fee','$cattle_beef_council_fee',
	   '$total_due_fee','$paid_in_full','$payment_method',
	   '$output_cattle_01','$output_cattle_02','$output_cattle_03','$output_cattle_04','$output_cattle_05',
		'$output_cattle_06','$output_cattle_07','$output_cattle_08','$output_cattle_09','$output_cattle_10',
		'$output_cattle_11','$output_cattle_12','$output_cattle_13','$output_cattle_14','$output_cattle_15',
		'$output_cattle_16','$output_cattle_17','$output_cattle_18','$output_cattle_19','$output_cattle_20',
		'$output_cattle_21','$output_cattle_22','$output_cattle_23','$output_cattle_24','$output_cattle_25',
		'$output_cattle_26','$output_cattle_27','$output_cattle_28','$output_cattle_29','$output_cattle_30',
		'$output_cattle_31','$output_cattle_32','$output_cattle_33','$output_cattle_34','$output_cattle_35',
		'$output_cattle_36','$output_cattle_37','$output_cattle_38','$output_cattle_39','$output_cattle_40',
		'$output_cattle_41','$output_cattle_42','$output_cattle_43','$output_cattle_44','$output_cattle_45',
		'$output_cattle_46','$output_cattle_47','$output_cattle_48','$output_cattle_49','$output_cattle_50',
		'$output_cattle_51','$output_cattle_52','$output_cattle_53','$output_cattle_54','$output_cattle_55',
		'$output_cattle_56','$output_cattle_57','$output_cattle_58','$output_cattle_59','$output_cattle_60',
	   '$inspection_notes'
	   )";	   
	   
//,'$output_sig_inspector','$output_sig_owner', '$output_sig_buyer' - add this back in after inspection notes once signatures reinstated
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

if ($row['brand_cattle_01']) {
	$imgbrand_cattle_01 = sigJsonToImage($row['brand_cattle_01'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_cattle_01, 'drawings/'.$new.'-brand_cattle_01.png');
	imagedestroy($imgbrand_cattle_01);
}

if ($row['brand_cattle_02']) {
	$imgbrand_cattle_02 = sigJsonToImage($row['brand_cattle_02'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_cattle_02, 'drawings/'.$new.'-brand_cattle_02.png');
	imagedestroy($imgbrand_cattle_02);
}

if ($row['brand_cattle_03']) {
	$imgbrand_cattle_03 = sigJsonToImage($row['brand_cattle_03'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_cattle_03, 'drawings/'.$new.'-brand_cattle_03.png');
	imagedestroy($imgbrand_cattle_03);
}

if ($row['brand_cattle_04']) {
	$imgbrand_cattle_04 = sigJsonToImage($row['brand_cattle_04'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_cattle_04, 'drawings/'.$new.'-brand_cattle_04.png');
	imagedestroy($imgbrand_cattle_04);
}

if ($row['brand_cattle_05']) {
	$imgbrand_cattle_05 = sigJsonToImage($row['brand_cattle_05'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_cattle_05, 'drawings/'.$new.'-brand_cattle_05.png');
	imagedestroy($imgbrand_cattle_05);
}

if ($row['brand_cattle_06']) {
	$imgbrand_cattle_06 = sigJsonToImage($row['brand_cattle_06'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_cattle_06, 'drawings/'.$new.'-brand_cattle_06.png');
	imagedestroy($imgbrand_cattle_06);
}

if ($row['brand_cattle_07']) {
	$imgbrand_cattle_07 = sigJsonToImage($row['brand_cattle_07'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_cattle_07, 'drawings/'.$new.'-brand_cattle_07.png');
	imagedestroy($imgbrand_cattle_07);
}

if ($row['brand_cattle_08']) {
	$imgbrand_cattle_08 = sigJsonToImage($row['brand_cattle_08'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_cattle_08, 'drawings/'.$new.'-brand_cattle_08.png');
	imagedestroy($imgbrand_cattle_08);
}

if ($row['brand_cattle_09']) {
	$imgbrand_cattle_09 = sigJsonToImage($row['brand_cattle_09'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_cattle_09, 'drawings/'.$new.'-brand_cattle_09.png');
	imagedestroy($imgbrand_cattle_09);
}

if ($row['brand_cattle_10']) {
	$imgbrand_cattle_10 = sigJsonToImage($row['brand_cattle_10'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_cattle_10, 'drawings/'.$new.'-brand_cattle_10.png');
	imagedestroy($imgbrand_cattle_10);
}
if ($row['brand_cattle_11']) {
	$imgbrand_cattle_11 = sigJsonToImage($row['brand_cattle_11'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_cattle_11, 'drawings/'.$new.'-brand_cattle_11.png');
	imagedestroy($imgbrand_cattle_11);
}

if ($row['brand_cattle_12']) {
	$imgbrand_cattle_12 = sigJsonToImage($row['brand_cattle_12'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_cattle_12, 'drawings/'.$new.'-brand_cattle_12.png');
	imagedestroy($imgbrand_cattle_12);
}

if ($row['brand_cattle_13']) {
	$imgbrand_cattle_13 = sigJsonToImage($row['brand_cattle_13'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_cattle_13, 'drawings/'.$new.'-brand_cattle_13.png');
	imagedestroy($imgbrand_cattle_13);
}

if ($row['brand_cattle_14']) {
	$imgbrand_cattle_14 = sigJsonToImage($row['brand_cattle_14'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_cattle_14, 'drawings/'.$new.'-brand_cattle_14.png');
	imagedestroy($imgbrand_cattle_14);
}

if ($row['brand_cattle_15']) {
	$imgbrand_cattle_15 = sigJsonToImage($row['brand_cattle_15'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_cattle_15, 'drawings/'.$new.'-brand_cattle_15.png');
	imagedestroy($imgbrand_cattle_15);
}

if ($row['brand_cattle_16']) {
	$imgbrand_cattle_16 = sigJsonToImage($row['brand_cattle_16'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_cattle_16, 'drawings/'.$new.'-brand_cattle_16.png');
	imagedestroy($imgbrand_cattle_16);
}

if ($row['brand_cattle_17']) {
	$imgbrand_cattle_17 = sigJsonToImage($row['brand_cattle_17'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_cattle_17, 'drawings/'.$new.'-brand_cattle_17.png');
	imagedestroy($imgbrand_cattle_17);
}

if ($row['brand_cattle_18']) {
	$imgbrand_cattle_18 = sigJsonToImage($row['brand_cattle_18'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_cattle_18, 'drawings/'.$new.'-brand_cattle_18.png');
	imagedestroy($imgbrand_cattle_18);
}

if ($row['brand_cattle_19']) {
	$imgbrand_cattle_19 = sigJsonToImage($row['brand_cattle_19'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_cattle_19, 'drawings/'.$new.'-brand_cattle_19.png');
	imagedestroy($imgbrand_cattle_19);
}

if ($row['brand_cattle_20']) {
	$imgbrand_cattle_20 = sigJsonToImage($row['brand_cattle_20'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_cattle_20, 'drawings/'.$new.'-brand_cattle_20.png');
	imagedestroy($imgbrand_cattle_20);
}
if ($row['brand_cattle_21']) {
	$imgbrand_cattle_21 = sigJsonToImage($row['brand_cattle_21'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_cattle_21, 'drawings/'.$new.'-brand_cattle_21.png');
	imagedestroy($imgbrand_cattle_21);
}

if ($row['brand_cattle_22']) {
	$imgbrand_cattle_22 = sigJsonToImage($row['brand_cattle_22'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_cattle_22, 'drawings/'.$new.'-brand_cattle_22.png');
	imagedestroy($imgbrand_cattle_22);
}

if ($row['brand_cattle_23']) {
	$imgbrand_cattle_23 = sigJsonToImage($row['brand_cattle_23'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_cattle_23, 'drawings/'.$new.'-brand_cattle_23.png');
	imagedestroy($imgbrand_cattle_23);
}

if ($row['brand_cattle_24']) {
	$imgbrand_cattle_24 = sigJsonToImage($row['brand_cattle_24'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_cattle_24, 'drawings/'.$new.'-brand_cattle_24.png');
	imagedestroy($imgbrand_cattle_24);
}

if ($row['brand_cattle_25']) {
	$imgbrand_cattle_25 = sigJsonToImage($row['brand_cattle_25'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_cattle_25, 'drawings/'.$new.'-brand_cattle_25.png');
	imagedestroy($imgbrand_cattle_25);
}

if ($row['brand_cattle_26']) {
	$imgbrand_cattle_26 = sigJsonToImage($row['brand_cattle_26'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_cattle_26, 'drawings/'.$new.'-brand_cattle_26.png');
	imagedestroy($imgbrand_cattle_26);
}

if ($row['brand_cattle_27']) {
	$imgbrand_cattle_27 = sigJsonToImage($row['brand_cattle_27'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_cattle_27, 'drawings/'.$new.'-brand_cattle_27.png');
	imagedestroy($imgbrand_cattle_27);
}

if ($row['brand_cattle_28']) {
	$imgbrand_cattle_28 = sigJsonToImage($row['brand_cattle_28'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_cattle_28, 'drawings/'.$new.'-brand_cattle_28.png');
	imagedestroy($imgbrand_cattle_28);
}

if ($row['brand_cattle_29']) {
	$imgbrand_cattle_29 = sigJsonToImage($row['brand_cattle_29'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_cattle_29, 'drawings/'.$new.'-brand_cattle_29.png');
	imagedestroy($imgbrand_cattle_29);
}

if ($row['brand_cattle_30']) {
	$imgbrand_cattle_30 = sigJsonToImage($row['brand_cattle_30'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_cattle_30, 'drawings/'.$new.'-brand_cattle_30.png');
	imagedestroy($imgbrand_cattle_30);
}
if ($row['brand_cattle_31']) {
	$imgbrand_cattle_31 = sigJsonToImage($row['brand_cattle_31'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_cattle_31, 'drawings/'.$new.'-brand_cattle_31.png');
	imagedestroy($imgbrand_cattle_31);
}

if ($row['brand_cattle_32']) {
	$imgbrand_cattle_32 = sigJsonToImage($row['brand_cattle_32'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_cattle_32, 'drawings/'.$new.'-brand_cattle_32.png');
	imagedestroy($imgbrand_cattle_32);
}

if ($row['brand_cattle_33']) {
	$imgbrand_cattle_33 = sigJsonToImage($row['brand_cattle_33'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_cattle_33, 'drawings/'.$new.'-brand_cattle_33.png');
	imagedestroy($imgbrand_cattle_33);
}

if ($row['brand_cattle_34']) {
	$imgbrand_cattle_34 = sigJsonToImage($row['brand_cattle_34'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_cattle_34, 'drawings/'.$new.'-brand_cattle_34.png');
	imagedestroy($imgbrand_cattle_34);
}

if ($row['brand_cattle_35']) {
	$imgbrand_cattle_35 = sigJsonToImage($row['brand_cattle_35'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_cattle_35, 'drawings/'.$new.'-brand_cattle_35.png');
	imagedestroy($imgbrand_cattle_35);
}

if ($row['brand_cattle_36']) {
	$imgbrand_cattle_36 = sigJsonToImage($row['brand_cattle_36'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_cattle_36, 'drawings/'.$new.'-brand_cattle_36.png');
	imagedestroy($imgbrand_cattle_36);
}

if ($row['brand_cattle_37']) {
	$imgbrand_cattle_37 = sigJsonToImage($row['brand_cattle_37'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_cattle_37, 'drawings/'.$new.'-brand_cattle_37.png');
	imagedestroy($imgbrand_cattle_37);
}

if ($row['brand_cattle_38']) {
	$imgbrand_cattle_38 = sigJsonToImage($row['brand_cattle_38'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_cattle_38, 'drawings/'.$new.'-brand_cattle_38.png');
	imagedestroy($imgbrand_cattle_38);
}

if ($row['brand_cattle_39']) {
	$imgbrand_cattle_39 = sigJsonToImage($row['brand_cattle_39'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_cattle_39, 'drawings/'.$new.'-brand_cattle_39.png');
	imagedestroy($imgbrand_cattle_39);
}

if ($row['brand_cattle_40']) {
	$imgbrand_cattle_40 = sigJsonToImage($row['brand_cattle_40'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_cattle_40, 'drawings/'.$new.'-brand_cattle_40.png');
	imagedestroy($imgbrand_cattle_40);
}
if ($row['brand_cattle_41']) {
	$imgbrand_cattle_41 = sigJsonToImage($row['brand_cattle_41'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_cattle_41, 'drawings/'.$new.'-brand_cattle_41.png');
	imagedestroy($imgbrand_cattle_41);
}

if ($row['brand_cattle_42']) {
	$imgbrand_cattle_42 = sigJsonToImage($row['brand_cattle_42'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_cattle_42, 'drawings/'.$new.'-brand_cattle_42.png');
	imagedestroy($imgbrand_cattle_42);
}

if ($row['brand_cattle_43']) {
	$imgbrand_cattle_43 = sigJsonToImage($row['brand_cattle_43'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_cattle_43, 'drawings/'.$new.'-brand_cattle_43.png');
	imagedestroy($imgbrand_cattle_43);
}

if ($row['brand_cattle_44']) {
	$imgbrand_cattle_44 = sigJsonToImage($row['brand_cattle_44'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_cattle_44, 'drawings/'.$new.'-brand_cattle_44.png');
	imagedestroy($imgbrand_cattle_44);
}

if ($row['brand_cattle_45']) {
	$imgbrand_cattle_45 = sigJsonToImage($row['brand_cattle_45'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_cattle_45, 'drawings/'.$new.'-brand_cattle_45.png');
	imagedestroy($imgbrand_cattle_45);
}

if ($row['brand_cattle_46']) {
	$imgbrand_cattle_46 = sigJsonToImage($row['brand_cattle_46'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_cattle_46, 'drawings/'.$new.'-brand_cattle_46.png');
	imagedestroy($imgbrand_cattle_46);
}

if ($row['brand_cattle_47']) {
	$imgbrand_cattle_47 = sigJsonToImage($row['brand_cattle_47'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_cattle_47, 'drawings/'.$new.'-brand_cattle_47.png');
	imagedestroy($imgbrand_cattle_47);
}

if ($row['brand_cattle_48']) {
	$imgbrand_cattle_48 = sigJsonToImage($row['brand_cattle_48'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_cattle_48, 'drawings/'.$new.'-brand_cattle_48.png');
	imagedestroy($imgbrand_cattle_48);
}

if ($row['brand_cattle_49']) {
	$imgbrand_cattle_49 = sigJsonToImage($row['brand_cattle_49'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_cattle_49, 'drawings/'.$new.'-brand_cattle_49.png');
	imagedestroy($imgbrand_cattle_49);
}

if ($row['brand_cattle_50']) {
	$imgbrand_cattle_50 = sigJsonToImage($row['brand_cattle_50'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_cattle_50, 'drawings/'.$new.'-brand_cattle_50.png');
	imagedestroy($imgbrand_cattle_50);
}
if ($row['brand_cattle_51']) {
	$imgbrand_cattle_51 = sigJsonToImage($row['brand_cattle_51'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_cattle_51, 'drawings/'.$new.'-brand_cattle_51.png');
	imagedestroy($imgbrand_cattle_51);
}

if ($row['brand_cattle_52']) {
	$imgbrand_cattle_52 = sigJsonToImage($row['brand_cattle_52'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_cattle_52, 'drawings/'.$new.'-brand_cattle_52.png');
	imagedestroy($imgbrand_cattle_52);
}

if ($row['brand_cattle_53']) {
	$imgbrand_cattle_53 = sigJsonToImage($row['brand_cattle_53'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_cattle_53, 'drawings/'.$new.'-brand_cattle_53.png');
	imagedestroy($imgbrand_cattle_53);
}

if ($row['brand_cattle_54']) {
	$imgbrand_cattle_54 = sigJsonToImage($row['brand_cattle_54'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_cattle_54, 'drawings/'.$new.'-brand_cattle_54.png');
	imagedestroy($imgbrand_cattle_54);
}

if ($row['brand_cattle_55']) {
	$imgbrand_cattle_55 = sigJsonToImage($row['brand_cattle_55'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_cattle_55, 'drawings/'.$new.'-brand_cattle_55.png');
	imagedestroy($imgbrand_cattle_55);
}

if ($row['brand_cattle_56']) {
	$imgbrand_cattle_56 = sigJsonToImage($row['brand_cattle_56'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_cattle_56, 'drawings/'.$new.'-brand_cattle_56.png');
	imagedestroy($imgbrand_cattle_56);
}

if ($row['brand_cattle_57']) {
	$imgbrand_cattle_57 = sigJsonToImage($row['brand_cattle_57'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_cattle_57, 'drawings/'.$new.'-brand_cattle_57.png');
	imagedestroy($imgbrand_cattle_57);
}

if ($row['brand_cattle_58']) {
	$imgbrand_cattle_58 = sigJsonToImage($row['brand_cattle_58'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_cattle_58, 'drawings/'.$new.'-brand_cattle_58.png');
	imagedestroy($imgbrand_cattle_58);
}

if ($row['brand_cattle_59']) {
	$imgbrand_cattle_59 = sigJsonToImage($row['brand_cattle_59'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_cattle_59, 'drawings/'.$new.'-brand_cattle_59.png');
	imagedestroy($imgbrand_cattle_59);
}

if ($row['brand_cattle_60']) {
	$imgbrand_cattle_60 = sigJsonToImage($row['brand_cattle_60'], array('imageSize'=>array(250, 250)));
	imagepng($imgbrand_cattle_60, 'drawings/'.$new.'-brand_cattle_60.png');
	imagedestroy($imgbrand_cattle_60);
}

echo "<h3>";
echo "<a href=\"pdf-output-cattle-60.php?cert_serial_num=".$row['cert_serial_num']."\">Click here to view Stock Certificate: " . $row['cert_series']. $row['cert_insp_num'] . $new . "</a>";
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
		<li><a href="#tabs-2" onclick="figurePayment();return false;">Cattle</a></li>
		<li><a href="#tabs-7" onclick="unPlusPay();">Payment</a></li>
<!--		<li><a href="#tabs-8">Signatures</a></li>-->
<!-- once signatures are reinstated, uncomment out the tab and the whole div that correlates to tabs-8 -->
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
	<div id="tabs-2"> <!-- cattle -->
	Cattle Movement: <select size="1" name="cattle_movement">
	<option value="">None</option>
	<option value="Dairy">Dairy</option>
	<option value="Stocker">Stocker</option>
	<option value="Entering Feedlot">Entering Feedlot</option>
	<option value="Fat Cattle">Fat Cattle</option>
	<option value="Private Fed">Private Fed</option>
	<option value="Commercial Fed">Commercial Fed</option>
	<option value="Killer">Killer</option>
	<option value="-30 Days">-30 Days</option>
	</select><br>
	State of Origin: <select size="1" name="cattle_movement_state">
	<option value="">No State Selected</option>
	<option value="AK">ALASKA</option>
	<option value="AL">ALABAMA</option>
	<option value="AR">ARKANSAS</option>
	<option value="AZ">ARIZONA</option>
	<option value="CA">CALIFORNIA</option>
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
<div id="accordion">
<h3>Group 1</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Cattle: <input name="num_cattle_01" type="text" id="num_cattle_01"><br>
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
				<input type="hidden" name="output_cattle_01" class="output">
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
# Cattle: <input name="num_cattle_02" type="text" id="num_cattle_02"><br>
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
				<input type="hidden" name="output_cattle_02" class="output">
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
# Cattle: <input name="num_cattle_03" type="text" id="num_cattle_03"><br>
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
				<input type="hidden" name="output_cattle_03" class="output">
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
# Cattle: <input name="num_cattle_04" type="text" id="num_cattle_04"><br>
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
				<input type="hidden" name="output_cattle_04" class="output">
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
# Cattle: <input name="num_cattle_05" type="text" id="num_cattle_05"><br>
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
				<input type="hidden" name="output_cattle_05" class="output">
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
# Cattle: <input name="num_cattle_06" type="text" id="num_cattle_06"><br>
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
				<input type="hidden" name="output_cattle_06" class="output">
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
# Cattle: <input name="num_cattle_07" type="text" id="num_cattle_07"><br>
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
				<input type="hidden" name="output_cattle_07" class="output">
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
# Cattle: <input name="num_cattle_08" type="text" id="num_cattle_08"><br>
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
				<input type="hidden" name="output_cattle_08" class="output">
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
# Cattle: <input name="num_cattle_09" type="text" id="num_cattle_09"><br>
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
				<input type="hidden" name="output_cattle_09" class="output">
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
# Cattle: <input name="num_cattle_10" type="text" id="num_cattle_10"><br>
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
				<input type="hidden" name="output_cattle_10" class="output">
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
<h3>Group 11</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Cattle: <input name="num_cattle_11" type="text" id="num_cattle_11"><br>
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
				<input type="hidden" name="output_cattle_11" class="output">
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
<h3>Group 12</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Cattle: <input name="num_cattle_12" type="text" id="num_cattle_12"><br>
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
				<input type="hidden" name="output_cattle_12" class="output">
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
<h3>Group 13</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Cattle: <input name="num_cattle_13" type="text" id="num_cattle_13"><br>
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
				<input type="hidden" name="output_cattle_13" class="output">
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
<h3>Group 14</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Cattle: <input name="num_cattle_14" type="text" id="num_cattle_14"><br>
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
				<input type="hidden" name="output_cattle_14" class="output">
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
<h3>Group 15</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Cattle: <input name="num_cattle_15" type="text" id="num_cattle_15"><br>
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
				<input type="hidden" name="output_cattle_15" class="output">
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
<h3>Group 16</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Cattle: <input name="num_cattle_16" type="text" id="num_cattle_16"><br>
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
				<input type="hidden" name="output_cattle_16" class="output">
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
<h3>Group 17</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Cattle: <input name="num_cattle_17" type="text" id="num_cattle_17"><br>
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
				<input type="hidden" name="output_cattle_17" class="output">
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
<h3>Group 18</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Cattle: <input name="num_cattle_18" type="text" id="num_cattle_18"><br>
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
				<input type="hidden" name="output_cattle_18" class="output">
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
<h3>Group 19</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Cattle: <input name="num_cattle_19" type="text" id="num_cattle_19"><br>
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
				<input type="hidden" name="output_cattle_19" class="output">
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
<h3>Group 20</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Cattle: <input name="num_cattle_20" type="text" id="num_cattle_20"><br>
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
				<input type="hidden" name="output_cattle_20" class="output">
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
<h3>Group 21</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Cattle: <input name="num_cattle_21" type="text" id="num_cattle_21"><br>
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
				<input type="hidden" name="output_cattle_21" class="output">
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
<h3>Group 22</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Cattle: <input name="num_cattle_22" type="text" id="num_cattle_22"><br>
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
				<input type="hidden" name="output_cattle_22" class="output">
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
<h3>Group 23</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Cattle: <input name="num_cattle_23" type="text" id="num_cattle_23"><br>
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
				<input type="hidden" name="output_cattle_23" class="output">
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
<h3>Group 24</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Cattle: <input name="num_cattle_24" type="text" id="num_cattle_24"><br>
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
				<input type="hidden" name="output_cattle_24" class="output">
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
<h3>Group 25</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Cattle: <input name="num_cattle_25" type="text" id="num_cattle_25"><br>
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
				<input type="hidden" name="output_cattle_25" class="output">
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
<h3>Group 26</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Cattle: <input name="num_cattle_26" type="text" id="num_cattle_26"><br>
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
				<input type="hidden" name="output_cattle_26" class="output">
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
<h3>Group 27</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Cattle: <input name="num_cattle_27" type="text" id="num_cattle_27"><br>
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
				<input type="hidden" name="output_cattle_27" class="output">
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
<h3>Group 28</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Cattle: <input name="num_cattle_28" type="text" id="num_cattle_28"><br>
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
				<input type="hidden" name="output_cattle_28" class="output">
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
<h3>Group 29</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Cattle: <input name="num_cattle_29" type="text" id="num_cattle_29"><br>
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
				<input type="hidden" name="output_cattle_29" class="output">
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
<h3>Group 30</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Cattle: <input name="num_cattle_30" type="text" id="num_cattle_30"><br>
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
				<input type="hidden" name="output_cattle_30" class="output">
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
<h3>Group 31</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Cattle: <input name="num_cattle_31" type="text" id="num_cattle_31"><br>
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
				<input type="hidden" name="output_cattle_31" class="output">
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
<h3>Group 32</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Cattle: <input name="num_cattle_32" type="text" id="num_cattle_32"><br>
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
				<input type="hidden" name="output_cattle_32" class="output">
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
<h3>Group 33</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Cattle: <input name="num_cattle_33" type="text" id="num_cattle_33"><br>
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
				<input type="hidden" name="output_cattle_33" class="output">
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
<h3>Group 34</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Cattle: <input name="num_cattle_34" type="text" id="num_cattle_34"><br>
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
				<input type="hidden" name="output_cattle_34" class="output">
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
<h3>Group 35</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Cattle: <input name="num_cattle_35" type="text" id="num_cattle_35"><br>
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
				<input type="hidden" name="output_cattle_35" class="output">
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
<h3>Group 36</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Cattle: <input name="num_cattle_36" type="text" id="num_cattle_36"><br>
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
				<input type="hidden" name="output_cattle_36" class="output">
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
<h3>Group 37</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Cattle: <input name="num_cattle_37" type="text" id="num_cattle_37"><br>
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
				<input type="hidden" name="output_cattle_37" class="output">
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
<h3>Group 38</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Cattle: <input name="num_cattle_38" type="text" id="num_cattle_38"><br>
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
				<input type="hidden" name="output_cattle_38" class="output">
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
<h3>Group 39</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Cattle: <input name="num_cattle_39" type="text" id="num_cattle_39"><br>
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
				<input type="hidden" name="output_cattle_39" class="output">
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
<h3>Group 40</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Cattle: <input name="num_cattle_40" type="text" id="num_cattle_40"><br>
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
				<input type="hidden" name="output_cattle_40" class="output">
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
<h3>Group 41</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Cattle: <input name="num_cattle_41" type="text" id="num_cattle_41"><br>
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
				<input type="hidden" name="output_cattle_41" class="output">
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
<h3>Group 42</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Cattle: <input name="num_cattle_42" type="text" id="num_cattle_42"><br>
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
				<input type="hidden" name="output_cattle_42" class="output">
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
<h3>Group 43</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Cattle: <input name="num_cattle_43" type="text" id="num_cattle_43"><br>
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
				<input type="hidden" name="output_cattle_43" class="output">
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
<h3>Group 44</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Cattle: <input name="num_cattle_44" type="text" id="num_cattle_44"><br>
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
				<input type="hidden" name="output_cattle_44" class="output">
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
<h3>Group 45</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Cattle: <input name="num_cattle_45" type="text" id="num_cattle_45"><br>
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
				<input type="hidden" name="output_cattle_45" class="output">
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
<h3>Group 46</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Cattle: <input name="num_cattle_46" type="text" id="num_cattle_46"><br>
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
				<input type="hidden" name="output_cattle_46" class="output">
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
<h3>Group 47</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Cattle: <input name="num_cattle_47" type="text" id="num_cattle_47"><br>
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
				<input type="hidden" name="output_cattle_47" class="output">
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
<h3>Group 48</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Cattle: <input name="num_cattle_48" type="text" id="num_cattle_48"><br>
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
				<input type="hidden" name="output_cattle_48" class="output">
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
<h3>Group 49</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Cattle: <input name="num_cattle_49" type="text" id="num_cattle_49"><br>
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
				<input type="hidden" name="output_cattle_49" class="output">
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
<h3>Group 50</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Cattle: <input name="num_cattle_50" type="text" id="num_cattle_50"><br>
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
				<input type="hidden" name="output_cattle_50" class="output">
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
<h3>Group 51</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Cattle: <input name="num_cattle_51" type="text" id="num_cattle_51"><br>
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
				<input type="hidden" name="output_cattle_51" class="output">
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
<h3>Group 52</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Cattle: <input name="num_cattle_52" type="text" id="num_cattle_52"><br>
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
				<input type="hidden" name="output_cattle_52" class="output">
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
<h3>Group 53</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Cattle: <input name="num_cattle_53" type="text" id="num_cattle_53"><br>
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
				<input type="hidden" name="output_cattle_53" class="output">
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
<h3>Group 54</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Cattle: <input name="num_cattle_54" type="text" id="num_cattle_54"><br>
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
				<input type="hidden" name="output_cattle_54" class="output">
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
<h3>Group 55</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Cattle: <input name="num_cattle_55" type="text" id="num_cattle_55"><br>
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
				<input type="hidden" name="output_cattle_55" class="output">
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
<h3>Group 56</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Cattle: <input name="num_cattle_56" type="text" id="num_cattle_56"><br>
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
				<input type="hidden" name="output_cattle_56" class="output">
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
<h3>Group 57</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Cattle: <input name="num_cattle_57" type="text" id="num_cattle_57"><br>
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
				<input type="hidden" name="output_cattle_57" class="output">
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
<h3>Group 58</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Cattle: <input name="num_cattle_58" type="text" id="num_cattle_58"><br>
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
				<input type="hidden" name="output_cattle_58" class="output">
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
<h3>Group 59</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Cattle: <input name="num_cattle_59" type="text" id="num_cattle_59"><br>
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
				<input type="hidden" name="output_cattle_59" class="output">
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
<h3>Group 60</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Cattle: <input name="num_cattle_60" type="text" id="num_cattle_60"><br>
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
				<input type="hidden" name="output_cattle_60" class="output">
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
    <td align="left" valign="top">Total # Cattle:</td>
    <td align="right" valign="top"><input type="text" id="totalCattle" value="" size="5" disabled></td>
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
    <td align="left" valign="top">Beef Council Fee:</td>
    <td align="right" valign="top">$<input type="text" id="beefCouncilFee" value="" size="5" disabled></td>
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

<?php
ini_set('memory_limit', '-1');
?>
<!DOCTYPE html>
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
<!--	<script src="js/livestock_cattle.js"></script>-->

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

//$num_cattle = ($num_cattle_01 + $num_cattle_02 + $num_cattle_03 + $num_cattle_04 + $num_cattle_05 + $num_cattle_06 + $num_cattle_07 + $num_cattle_08 + $num_cattle_09 + $num_cattle_10);
$num_cattle_01 = ($cat_num_country_01 + $cat_num_slaughter_01 + $cat_num_rodeo_01 + $cat_num_show_01);
$num_cattle_02 = ($cat_num_country_02 + $cat_num_slaughter_02 + $cat_num_rodeo_02 + $cat_num_show_02);
$num_cattle_03 = ($cat_num_country_03 + $cat_num_slaughter_03 + $cat_num_rodeo_03 + $cat_num_show_03);
$num_cattle_04 = ($cat_num_country_04 + $cat_num_slaughter_04 + $cat_num_rodeo_04 + $cat_num_show_04);
$num_cattle_05 = ($cat_num_country_05 + $cat_num_slaughter_05 + $cat_num_rodeo_05 + $cat_num_show_05);
$num_cattle_06 = ($cat_num_country_06 + $cat_num_slaughter_06 + $cat_num_rodeo_06 + $cat_num_show_06);
$num_cattle_07 = ($cat_num_country_07 + $cat_num_slaughter_07 + $cat_num_rodeo_07 + $cat_num_show_07);
$num_cattle_08 = ($cat_num_country_08 + $cat_num_slaughter_08 + $cat_num_rodeo_08 + $cat_num_show_08);
$num_cattle_09 = ($cat_num_country_09 + $cat_num_slaughter_09 + $cat_num_rodeo_09 + $cat_num_show_09);
$num_cattle_10 = ($cat_num_country_10 + $cat_num_slaughter_10 + $cat_num_rodeo_10 + $cat_num_show_10);

$cat_num_country = ($cat_num_country_01 + $cat_num_country_02 + $cat_num_country_03 + $cat_num_country_04 + $cat_num_country_05 + $cat_num_country_06 + $cat_num_country_07 + $cat_num_country_08 + $cat_num_country_09 + $cat_num_country_10);
$cat_num_slaughter = ($cat_num_slaughter_01 + $cat_num_slaughter_02 + $cat_num_slaughter_03 + $cat_num_slaughter_04 + $cat_num_slaughter_05 + $cat_num_slaughter_06 + $cat_num_slaughter_07 + $cat_num_slaughter_08 + $cat_num_slaughter_09 + $cat_num_slaughter_10);
$cat_num_rodeo = ($cat_num_rodeo_01 + $cat_num_rodeo_02 + $cat_num_rodeo_03 + $cat_num_rodeo_04 + $cat_num_rodeo_05 + $cat_num_rodeo_06 + $cat_num_rodeo_07 + $cat_num_rodeo_08 + $cat_num_rodeo_09 + $cat_num_rodeo_10);
$cat_num_show = ($cat_num_show_01 + $cat_num_show_02 + $cat_num_show_03 + $cat_num_show_04 + $cat_num_show_05 + $cat_num_show_06 + $cat_num_show_07 + $cat_num_show_08 + $cat_num_show_09 + $cat_num_show_10);
$cattle_hides = ($cattle_hides_01 + $cattle_hides_02 + $cattle_hides_03 + $cattle_hides_04 + $cattle_hides_05 + $cattle_hides_06 + $cattle_hides_07 + $cattle_hides_08 + $cattle_hides_09 + $cattle_hides_10);

//country cattle charges
$cattle_country_service_charge_fee = ($cat_num_country * .55);
$cattle_BCF_01 = ($cat_num_country * 1);
if ($cat_num_country < 1)
{
$cattle_minimum_fee = 0;
}
;
if ($cat_num_country >= 1)
{
$cattle_minimum_fee = 10;
}
;
$cattle_no_brand_calf_mileage_fee = ($calf_miles * .50);
$cattle_rodeo_permit_fee = (($cat_num_rodeo * 1) + ($cat_num_rodeo * .55));
$cattle_show_permit_fee = ($cat_num_show * 10);
$cattle_hide_fee = ($cattle_hides * .25);

//slaughter cattle charges
if ($cat_num_slaughter < 1)
{
$cattle_slaughter_service_charge_fee = 0;
}
;
if ($cat_num_slaughter > 0 && $cat_num_slaughter < 29)
{
$cattle_slaughter_service_charge_fee = 15;
}
;
if ($cat_num_slaughter > 28 && $cat_num_slaughter <= 500)
{
$cattle_slaughter_service_charge_fee = ($cat_num_slaughter * .53);
}
;
if ($cat_num_slaughter >= 501)
{
$cat_num_over = ($cat_num_slaughter - 500);
$cattle_slaughter_service_charge_fee = (($cat_num_over * .50) + (500 * .53));
$cattle_BCF_02 = ($cat_num_slaughter * 1);
}

//certified feedlot charges
// haven't yet invoked with checkbox that these are feedlot direct to slaughter
if ($cat_num_slaughter_cf < 1)
{
$cattle_slaughter_CF_charge_fee = 0;
}
;
if ($cat_num_slaughter_cf >= 1)
{
$cattle_slaughter_CF_charge_fee = 15;
}
;
$cattle_slaughter_CF_charge_fee = ($cat_num_slaughter_cf * .38);

//need to add checkbox for exempt, which removes BCF amounts
//BCF fees don't apply to exempt, rodeo, show, no change of ownership
// add $1000 per feedlot fee
// TODO: when you get to multiple certs, need to check for mult sellers to one buyer; this condition satisfies the minimum fee requirement

//subtotals
$cattle_beef_council_fee = ($cattle_BCF_01 + $cattle_BCF_02);
$cattle_service_charge_fee = ($cattle_country_service_charge_fee + $cattle_slaughter_service_charge_fee);
$num_cattle = ($cat_num_country + $cat_num_slaughter + $cat_num_rodeo + $cat_num_show);

//totals
$total_due_fee = ($cattle_service_charge_fee + $cattle_minimum_fee + $cattle_beef_council_fee + $cattle_show_permit_fee + $cattle_rodeo_permit_fee + $cattle_no_brand_calf_mileage_fee + $cattle_hide_fee);
//end calculations
// stuff to be reinstated once signatures are electronic again:
// , signature_inspector, signature_owner, signature_buyer - after inspection notes
// ,'$output_sig_inspector','$output_sig_owner', '$output_sig_buyer' - after inspection notes
$sql = "INSERT INTO certificates ".
       "(num_cattle, cert_date, clss_coin_owner, clss_name_owner, clss_address_owner,
clss_city_owner, clss_state_owner, clss_zip_owner, clss_county_owner, clss_coin_buyer,
clss_name_buyer, clss_address_buyer, clss_city_buyer, clss_state_buyer, clss_zip_buyer,
clss_county_buyer, 
cat_num_country_01, cat_num_country_02, cat_num_country_03, cat_num_country_04, cat_num_country_05,
cat_num_country_06, cat_num_country_07, cat_num_country_08, cat_num_country_09, cat_num_country_10,
cat_num_slaughter_01, cat_num_slaughter_02, cat_num_slaughter_03, cat_num_slaughter_04, cat_num_slaughter_05,
cat_num_slaughter_06, cat_num_slaughter_07, cat_num_slaughter_08, cat_num_slaughter_09, cat_num_slaughter_10,
cat_num_rodeo_01, cat_num_rodeo_02, cat_num_rodeo_03, cat_num_rodeo_04, cat_num_rodeo_05,
cat_num_rodeo_06, cat_num_rodeo_07, cat_num_rodeo_08, cat_num_rodeo_09, cat_num_rodeo_10,
cat_num_show_01, cat_num_show_02, cat_num_show_03, cat_num_show_04, cat_num_show_05,
cat_num_show_06, cat_num_show_07, cat_num_show_08, cat_num_show_09, cat_num_show_10,
cattle_position_01, cattle_position_02, cattle_position_03, cattle_position_04, cattle_position_05,
cattle_position_06, cattle_position_07, cattle_position_08, cattle_position_09, cattle_position_10,
cattle_breed_01, cattle_breed_02, cattle_breed_03, cattle_breed_04, cattle_breed_05,
cattle_breed_06, cattle_breed_07, cattle_breed_08, cattle_breed_09, cattle_breed_10,
cattle_color_01, cattle_color_02, cattle_color_03, cattle_color_04, cattle_color_05,
cattle_color_06, cattle_color_07, cattle_color_08, cattle_color_09, cattle_color_10,
cattle_gender_01, cattle_gender_02, cattle_gender_03, cattle_gender_04, cattle_gender_05,
cattle_gender_06, cattle_gender_07, cattle_gender_08, cattle_gender_09, cattle_gender_10,
cattle_hides_01, cattle_hides_02, cattle_hides_03, cattle_hides_04, cattle_hides_05,
cattle_hides_06, cattle_hides_07, cattle_hides_08, cattle_hides_09, cattle_hides_10,
num_cattle_01, num_cattle_02, num_cattle_03, num_cattle_04, num_cattle_05,
num_cattle_06, num_cattle_07, num_cattle_08, num_cattle_09, num_cattle_10,
cattle_brand_location_01_LJ, cattle_brand_location_01_LN, cattle_brand_location_01_LS, cattle_brand_location_01_LR, cattle_brand_location_01_LH, 
cattle_brand_location_01_LT, cattle_brand_location_01_LB, cattle_brand_location_01_RJ, cattle_brand_location_01_RN, cattle_brand_location_01_RS, 
cattle_brand_location_01_RR, cattle_brand_location_01_RH, cattle_brand_location_01_RT, cattle_brand_location_01_RB, cattle_brand_location_01_DIM, 
cattle_brand_location_01_BOTCH, cattle_brand_location_01_FREEZE, cattle_brand_location_02_LJ, cattle_brand_location_02_LN, cattle_brand_location_02_LS, 
cattle_brand_location_02_LR, cattle_brand_location_02_LH, cattle_brand_location_02_LT, cattle_brand_location_02_LB, cattle_brand_location_02_RJ, 
cattle_brand_location_02_RN, cattle_brand_location_02_RS, cattle_brand_location_02_RR, cattle_brand_location_02_RH, cattle_brand_location_02_RT, 
cattle_brand_location_02_RB, cattle_brand_location_02_DIM, cattle_brand_location_02_BOTCH, cattle_brand_location_02_FREEZE, cattle_brand_location_03_LJ, 
cattle_brand_location_03_LN, cattle_brand_location_03_LS, cattle_brand_location_03_LR, cattle_brand_location_03_LH, cattle_brand_location_03_LT, 
cattle_brand_location_03_LB, cattle_brand_location_03_RJ, cattle_brand_location_03_RN, cattle_brand_location_03_RS, cattle_brand_location_03_RR, 
cattle_brand_location_03_RH, cattle_brand_location_03_RT, cattle_brand_location_03_RB, cattle_brand_location_03_DIM, cattle_brand_location_03_BOTCH, 
cattle_brand_location_03_FREEZE, cattle_brand_location_04_LJ, cattle_brand_location_04_LN, cattle_brand_location_04_LS, cattle_brand_location_04_LR, 
cattle_brand_location_04_LH, cattle_brand_location_04_LT, cattle_brand_location_04_LB, cattle_brand_location_04_RJ, cattle_brand_location_04_RN, 
cattle_brand_location_04_RS, cattle_brand_location_04_RR, cattle_brand_location_04_RH, cattle_brand_location_04_RT, cattle_brand_location_04_RB, 
cattle_brand_location_04_DIM, cattle_brand_location_04_BOTCH, cattle_brand_location_04_FREEZE, cattle_brand_location_05_LJ, cattle_brand_location_05_LN, 
cattle_brand_location_05_LS, cattle_brand_location_05_LR, cattle_brand_location_05_LH, cattle_brand_location_05_LT, cattle_brand_location_05_LB, 
cattle_brand_location_05_RJ, cattle_brand_location_05_RN, cattle_brand_location_05_RS, cattle_brand_location_05_RR, cattle_brand_location_05_RH, 
cattle_brand_location_05_RT, cattle_brand_location_05_RB, cattle_brand_location_05_DIM, cattle_brand_location_05_BOTCH, cattle_brand_location_05_FREEZE, 
cattle_brand_location_06_LJ, cattle_brand_location_06_LN, cattle_brand_location_06_LS, cattle_brand_location_06_LR, cattle_brand_location_06_LH, 
cattle_brand_location_06_LT, cattle_brand_location_06_LB, cattle_brand_location_06_RJ, cattle_brand_location_06_RN, cattle_brand_location_06_RS, 
cattle_brand_location_06_RR, cattle_brand_location_06_RH, cattle_brand_location_06_RT, cattle_brand_location_06_RB, cattle_brand_location_06_DIM, 
cattle_brand_location_06_BOTCH, cattle_brand_location_06_FREEZE, cattle_brand_location_07_LJ, cattle_brand_location_07_LN, cattle_brand_location_07_LS, 
cattle_brand_location_07_LR, cattle_brand_location_07_LH, cattle_brand_location_07_LT, cattle_brand_location_07_LB, cattle_brand_location_07_RJ, 
cattle_brand_location_07_RN, cattle_brand_location_07_RS, cattle_brand_location_07_RR, cattle_brand_location_07_RH, cattle_brand_location_07_RT, 
cattle_brand_location_07_RB, cattle_brand_location_07_DIM, cattle_brand_location_07_BOTCH, cattle_brand_location_07_FREEZE, cattle_brand_location_08_LJ, 
cattle_brand_location_08_LN, cattle_brand_location_08_LS, cattle_brand_location_08_LR, cattle_brand_location_08_LH, cattle_brand_location_08_LT, 
cattle_brand_location_08_LB, cattle_brand_location_08_RJ, cattle_brand_location_08_RN, cattle_brand_location_08_RS, cattle_brand_location_08_RR, 
cattle_brand_location_08_RH, cattle_brand_location_08_RT, cattle_brand_location_08_RB, cattle_brand_location_08_DIM, cattle_brand_location_08_BOTCH, 
cattle_brand_location_08_FREEZE, cattle_brand_location_09_LJ, cattle_brand_location_09_LN, cattle_brand_location_09_LS, cattle_brand_location_09_LR, 
cattle_brand_location_09_LH, cattle_brand_location_09_LT, cattle_brand_location_09_LB, cattle_brand_location_09_RJ, cattle_brand_location_09_RN, 
cattle_brand_location_09_RS, cattle_brand_location_09_RR, cattle_brand_location_09_RH, cattle_brand_location_09_RT, cattle_brand_location_09_RB, 
cattle_brand_location_09_DIM, cattle_brand_location_09_BOTCH, cattle_brand_location_09_FREEZE, cattle_brand_location_10_LJ, cattle_brand_location_10_LN, 
cattle_brand_location_10_LS, cattle_brand_location_10_LR, cattle_brand_location_10_LH, cattle_brand_location_10_LT, cattle_brand_location_10_LB, 
cattle_brand_location_10_RJ, cattle_brand_location_10_RN, cattle_brand_location_10_RS, cattle_brand_location_10_RR, cattle_brand_location_10_RH, 
cattle_brand_location_10_RT, cattle_brand_location_10_RB, cattle_brand_location_10_DIM, cattle_brand_location_10_BOTCH, cattle_brand_location_10_FREEZE, 
cattle_movement, cattle_movement_state, cattle_minimum_fee,
cattle_service_charge_fee, cattle_no_brand_calf_mileage_fee, cattle_hide_fee, cattle_rodeo_permit_fee,
cattle_show_permit_fee, cattle_beef_council_fee, total_due_fee, paid_in_full, payment_method,
brand_cattle_01, brand_cattle_02, brand_cattle_03, brand_cattle_04, brand_cattle_05,
brand_cattle_06, brand_cattle_07, brand_cattle_08, brand_cattle_09, brand_cattle_10,
inspection_notes) ".
		"VALUES('$num_cattle','$cert_date',
		'$clss_coin_owner','$clss_name_owner','$clss_address_owner','$clss_city_owner','$clss_state_owner',
		'$clss_zip_owner','$clss_county_owner','$clss_coin_buyer','$clss_name_buyer',
		'$clss_address_buyer','$clss_city_buyer','$clss_state_buyer','$clss_zip_buyer',
		'$clss_county_buyer',
		'$cat_num_country_01','$cat_num_country_02','$cat_num_country_03','$cat_num_country_04','$cat_num_country_05',
		'$cat_num_country_06','$cat_num_country_07','$cat_num_country_08','$cat_num_country_09','$cat_num_country_10',
		'$cat_num_slaughter_01','$cat_num_slaughter_02','$cat_num_slaughter_03','$cat_num_slaughter_04','$cat_num_slaughter_05',
		'$cat_num_slaughter_06','$cat_num_slaughter_07','$cat_num_slaughter_08','$cat_num_slaughter_09','$cat_num_slaughter_10',
		'$cat_num_rodeo_01','$cat_num_rodeo_02','$cat_num_rodeo_03','$cat_num_rodeo_04','$cat_num_rodeo_05',
		'$cat_num_rodeo_06','$cat_num_rodeo_07','$cat_num_rodeo_08','$cat_num_rodeo_09','$cat_num_rodeo_10',
		'$cat_num_show_01','$cat_num_show_02','$cat_num_show_03','$cat_num_show_04','$cat_num_show_05',
		'$cat_num_show_06','$cat_num_show_07','$cat_num_show_08','$cat_num_show_09','$cat_num_show_10',
		'$cattle_position_01','$cattle_position_02','$cattle_position_03','$cattle_position_04','$cattle_position_05',
		'$cattle_position_06','$cattle_position_07','$cattle_position_08','$cattle_position_09','$cattle_position_10',
		'$cattle_breed_01','$cattle_breed_02','$cattle_breed_03','$cattle_breed_04','$cattle_breed_05',
		'$cattle_breed_06','$cattle_breed_07','$cattle_breed_08','$cattle_breed_09','$cattle_breed_10',
		'$cattle_color_01','$cattle_color_02','$cattle_color_03','$cattle_color_04','$cattle_color_05',
		'$cattle_color_06','$cattle_color_07','$cattle_color_08','$cattle_color_09','$cattle_color_10',
		'$cattle_gender_01','$cattle_gender_02','$cattle_gender_03','$cattle_gender_04','$cattle_gender_05',
		'$cattle_gender_06','$cattle_gender_07','$cattle_gender_08','$cattle_gender_09','$cattle_gender_10',
		'$cattle_hides_01','$cattle_hides_02','$cattle_hides_03','$cattle_hides_04','$cattle_hides_05',
		'$cattle_hides_06','$cattle_hides_07','$cattle_hides_08','$cattle_hides_09','$cattle_hides_10',
		'$num_cattle_01','$num_cattle_02','$num_cattle_03','$num_cattle_04','$num_cattle_05',
		'$num_cattle_06','$num_cattle_07','$num_cattle_08','$num_cattle_09','$num_cattle_10',
		'$cattle_brand_location_01_LJ','$cattle_brand_location_01_LN','$cattle_brand_location_01_LS','$cattle_brand_location_01_LR','$cattle_brand_location_01_LH',
		'$cattle_brand_location_01_LT','$cattle_brand_location_01_LB','$cattle_brand_location_01_RJ','$cattle_brand_location_01_RN','$cattle_brand_location_01_RS',
		'$cattle_brand_location_01_RR','$cattle_brand_location_01_RH','$cattle_brand_location_01_RT','$cattle_brand_location_01_RB','$cattle_brand_location_01_DIM',
		'$cattle_brand_location_01_BOTCH','$cattle_brand_location_01_FREEZE','$cattle_brand_location_02_LJ','$cattle_brand_location_02_LN','$cattle_brand_location_02_LS',
		'$cattle_brand_location_02_LR','$cattle_brand_location_02_LH','$cattle_brand_location_02_LT','$cattle_brand_location_02_LB','$cattle_brand_location_02_RJ',
		'$cattle_brand_location_02_RN','$cattle_brand_location_02_RS','$cattle_brand_location_02_RR','$cattle_brand_location_02_RH','$cattle_brand_location_02_RT',
		'$cattle_brand_location_02_RB','$cattle_brand_location_02_DIM','$cattle_brand_location_02_BOTCH','$cattle_brand_location_02_FREEZE','$cattle_brand_location_03_LJ',
		'$cattle_brand_location_03_LN','$cattle_brand_location_03_LS','$cattle_brand_location_03_LR','$cattle_brand_location_03_LH','$cattle_brand_location_03_LT',
		'$cattle_brand_location_03_LB','$cattle_brand_location_03_RJ','$cattle_brand_location_03_RN','$cattle_brand_location_03_RS','$cattle_brand_location_03_RR',
		'$cattle_brand_location_03_RH','$cattle_brand_location_03_RT','$cattle_brand_location_03_RB','$cattle_brand_location_03_DIM','$cattle_brand_location_03_BOTCH',
		'$cattle_brand_location_03_FREEZE','$cattle_brand_location_04_LJ','$cattle_brand_location_04_LN','$cattle_brand_location_04_LS','$cattle_brand_location_04_LR',
		'$cattle_brand_location_04_LH','$cattle_brand_location_04_LT','$cattle_brand_location_04_LB','$cattle_brand_location_04_RJ','$cattle_brand_location_04_RN',
		'$cattle_brand_location_04_RS','$cattle_brand_location_04_RR','$cattle_brand_location_04_RH','$cattle_brand_location_04_RT','$cattle_brand_location_04_RB',
		'$cattle_brand_location_04_DIM','$cattle_brand_location_04_BOTCH','$cattle_brand_location_04_FREEZE','$cattle_brand_location_05_LJ','$cattle_brand_location_05_LN',
		'$cattle_brand_location_05_LS','$cattle_brand_location_05_LR','$cattle_brand_location_05_LH','$cattle_brand_location_05_LT','$cattle_brand_location_05_LB',
		'$cattle_brand_location_05_RJ','$cattle_brand_location_05_RN','$cattle_brand_location_05_RS','$cattle_brand_location_05_RR','$cattle_brand_location_05_RH',
		'$cattle_brand_location_05_RT','$cattle_brand_location_05_RB','$cattle_brand_location_05_DIM','$cattle_brand_location_05_BOTCH','$cattle_brand_location_05_FREEZE',
		'$cattle_brand_location_06_LJ','$cattle_brand_location_06_LN','$cattle_brand_location_06_LS','$cattle_brand_location_06_LR','$cattle_brand_location_06_LH',
		'$cattle_brand_location_06_LT','$cattle_brand_location_06_LB','$cattle_brand_location_06_RJ','$cattle_brand_location_06_RN','$cattle_brand_location_06_RS',
		'$cattle_brand_location_06_RR','$cattle_brand_location_06_RH','$cattle_brand_location_06_RT','$cattle_brand_location_06_RB','$cattle_brand_location_06_DIM',
		'$cattle_brand_location_06_BOTCH','$cattle_brand_location_06_FREEZE','$cattle_brand_location_07_LJ','$cattle_brand_location_07_LN','$cattle_brand_location_07_LS',
		'$cattle_brand_location_07_LR','$cattle_brand_location_07_LH','$cattle_brand_location_07_LT','$cattle_brand_location_07_LB','$cattle_brand_location_07_RJ',
		'$cattle_brand_location_07_RN','$cattle_brand_location_07_RS','$cattle_brand_location_07_RR','$cattle_brand_location_07_RH','$cattle_brand_location_07_RT',
		'$cattle_brand_location_07_RB','$cattle_brand_location_07_DIM','$cattle_brand_location_07_BOTCH','$cattle_brand_location_07_FREEZE','$cattle_brand_location_08_LJ',
		'$cattle_brand_location_08_LN','$cattle_brand_location_08_LS','$cattle_brand_location_08_LR','$cattle_brand_location_08_LH','$cattle_brand_location_08_LT',
		'$cattle_brand_location_08_LB','$cattle_brand_location_08_RJ','$cattle_brand_location_08_RN','$cattle_brand_location_08_RS','$cattle_brand_location_08_RR',
		'$cattle_brand_location_08_RH','$cattle_brand_location_08_RT','$cattle_brand_location_08_RB','$cattle_brand_location_08_DIM','$cattle_brand_location_08_BOTCH',
		'$cattle_brand_location_08_FREEZE','$cattle_brand_location_09_LJ','$cattle_brand_location_09_LN','$cattle_brand_location_09_LS','$cattle_brand_location_09_LR',
		'$cattle_brand_location_09_LH','$cattle_brand_location_09_LT','$cattle_brand_location_09_LB','$cattle_brand_location_09_RJ','$cattle_brand_location_09_RN',
		'$cattle_brand_location_09_RS','$cattle_brand_location_09_RR','$cattle_brand_location_09_RH','$cattle_brand_location_09_RT','$cattle_brand_location_09_RB',
		'$cattle_brand_location_09_DIM','$cattle_brand_location_09_BOTCH','$cattle_brand_location_09_FREEZE','$cattle_brand_location_10_LJ','$cattle_brand_location_10_LN',
		'$cattle_brand_location_10_LS','$cattle_brand_location_10_LR','$cattle_brand_location_10_LH','$cattle_brand_location_10_LT','$cattle_brand_location_10_LB',
		'$cattle_brand_location_10_RJ','$cattle_brand_location_10_RN','$cattle_brand_location_10_RS','$cattle_brand_location_10_RR','$cattle_brand_location_10_RH',
		'$cattle_brand_location_10_RT', '$cattle_brand_location_10_RB', '$cattle_brand_location_10_DIM', '$cattle_brand_location_10_BOTCH', '$cattle_brand_location_10_FREEZE',
		'$cattle_movement','$cattle_movement_state',
		'$cattle_minimum_fee','$cattle_service_charge_fee','$cattle_no_brand_calf_mileage_fee',
		'$cattle_hide_fee','$cattle_rodeo_permit_fee','$cattle_show_permit_fee','$cattle_beef_council_fee',
		'$total_due_fee','$paid_in_full','$payment_method',
		'$output_cattle_01','$output_cattle_02','$output_cattle_03','$output_cattle_04','$output_cattle_05',
		'$output_cattle_06','$output_cattle_07','$output_cattle_08','$output_cattle_09','$output_cattle_10',
		'$inspection_notes')";	   
	   
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

echo "<h3>";
echo "<a href=\"pdf-output-cattle-10.php?cert_serial_num=".$row['cert_serial_num']."\">Click here to view Stock Certificate: " . $row['cert_series']. $row['cert_insp_num'] . $new . "</a>";
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
	No Brand Calf Mileage: <input name="calf_miles" type="text" id="calf_miles"><br>
<div id="accordion">
<h3>Group 1</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Country Cattle: <input name="cat_num_country_01" type="text" id="cat_num_country_01"><br>
# Slaughter Cattle: <input name="cat_num_slaughter_01" type="text" id="cat_num_slaughter_01"><br>
# Rodeo Cattle: <input name="cat_num_rodeo_01" type="text" id="cat_num_rodeo_01"><br>
# Show Cattle: <input name="cat_num_show_01" type="text" id="cat_num_show_01"><br>
# Hides: <input name="cattle_hides_01" type="text" id="cattle_hides_01"><br>
Breed: <select size="1" name="cattle_breed_01">
<option value="">No Breed Selected</option>
<option value="Beefmaster">Beefmaster</option>
<option value="Black Angus">Black Angus</option>
<option value="Brahman">Brahman</option>
<option value="Braunvieh">Braunvieh</option>
<option value="Brown swiss">Brown swiss</option>
<option value="Charolais">Charolais</option>
<option value="Chianina">Chianina</option>
<option value="Corriente">Corriente</option>
<option value="Crossbreed">Crossbreed</option>
<option value="Galloway">Galloway</option>
<option value="Gelbvieh">Gelbvieh</option>
<option value="Guernsey">Guernsey</option>
<option value="Hereford">Hereford</option>
<option value="Highland">Highland</option>
<option value="Holstein">Holstein</option>
<option value="Jersey">Jersey</option>
<option value="Limousin">Limousin</option>
<option value="Longhorn">Longhorn</option>
<option value="Maine Anjou">Maine Anjou</option>
<option value="Other">Other</option>
<option value="Red Angus">Red Angus</option>
<option value="Shorthorn">Shorthorn</option>
<option value="Simmental">Simmental</option>
</select><br>
Gender: <select size="1" name="cattle_gender_01">
<option value="">No Gender Selected</option>
<option value="Bull">Bull</option>
<option value="Bull Calfs">Bull Calfs</option>
<option value="Cow">Cow</option>
<option value="Cows_Bulls">Cows &amp; Bulls</option>
<option value="Heifer">Heifer</option>
<option value="Heifer Calfs">Heifer Calfs</option>
<option value="Mixed Calfs">Mixed Calfs</option>
<option value="Other">Other</option>
<option value="Steer">Steer</option>
<option value="Steer Calfs">Steer Calfs</option>
<option value="Steers_Heifers">Steers &amp; Heifers</option>
</select><br>
Color: <select size="1" name="cattle_color_01">
<option value="">No Color Selected</option>
<option value="Black">Black</option>
<option value="Blkbroc">Blkbroc</option>
<option value="Blkwf">Blkwf</option>
<option value="Char">Char</option>
<option value="Gray">Gray</option>
<option value="Gray wf">Gray wf</option>
<option value="Holstein">Holstein</option>
<option value="Longhorn">Longhorn</option>
<option value="Mixed">Mixed</option>
<option value="Other">Other</option>
<option value="Red">Red</option>
<option value="Red wf">Red wf</option>
<option value="Redbroc">Redbroc</option>
<option value="Wf">Wf</option>
</select><br>
Brand Location: <select size="1" name="cattle_position_01">
<option value="">No Brand</option>
<option value="Left">Left</option>
<option value="Left Hip">Left Hip</option>
<option value="Left Shoulder">Left Shoulder</option>
<option value="Right">Right</option>
<option value="Right Hip">Right Hip</option>
<option value="Right Shoulder">Right Shoulder</option>
</select><br>
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
<table border="0" cellpadding="0" cellspacing="0" width="250">
  <tr>
    <td align="center" width="100%">
      <input type="checkbox" name="cattle_brand_location_01_LJ" value="LJ">LJ
      <input type="checkbox" name="cattle_brand_location_01_LN" value="LN">LN
      <input type="checkbox" name="cattle_brand_location_01_LS" value="LS">LS
      <input type="checkbox" name="cattle_brand_location_01_LR" value="LR">LR
      <input type="checkbox" name="cattle_brand_location_01_LH" value="LH">LH<br>
      <input type="checkbox" name="cattle_brand_location_01_LT" value="LT">LT
      <input type="checkbox" name="cattle_brand_location_01_LB" value="LB">LB
      <input type="checkbox" name="cattle_brand_location_01_RJ" value="RJ">RJ
      <input type="checkbox" name="cattle_brand_location_01_RN" value="RN">RN
      <input type="checkbox" name="cattle_brand_location_01_RS" value="RS">RS<br>
      <input type="checkbox" name="cattle_brand_location_01_RR" value="RR">RR
      <input type="checkbox" name="cattle_brand_location_01_RH" value="RH">RH
      <input type="checkbox" name="cattle_brand_location_01_RT" value="RT">RT
      <input type="checkbox" name="cattle_brand_location_01_RB" value="RB">RB<br>
      <input type="checkbox" name="cattle_brand_location_01_DIM" value="DIM">DIM
      <input type="checkbox" name="cattle_brand_location_01_BOTCH" value="BOTCH">BOTCH
      <input type="checkbox" name="cattle_brand_location_01_FREEZE" value="FREEZE">FREEZE
      </td>
  </tr>
</table>
	</td>
  </tr>
</table>
</div>
<h3>Group 2</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Country Cattle: <input name="cat_num_country_02" type="text" id="cat_num_country_02"><br>
# Slaughter Cattle: <input name="cat_num_slaughter_02" type="text" id="cat_num_slaughter_02"><br>
# Rodeo Cattle: <input name="cat_num_rodeo_02" type="text" id="cat_num_rodeo_02"><br>
# Show Cattle: <input name="cat_num_show_02" type="text" id="cat_num_show_02"><br>
# Hides: <input name="cattle_hides_02" type="text" id="cattle_hides_02"><br>
Breed: <select size="1" name="cattle_breed_02">
<option value="">No Breed Selected</option>
<option value="Beefmaster">Beefmaster</option>
<option value="Black Angus">Black Angus</option>
<option value="Brahman">Brahman</option>
<option value="Braunvieh">Braunvieh</option>
<option value="Brown swiss">Brown swiss</option>
<option value="Charolais">Charolais</option>
<option value="Chianina">Chianina</option>
<option value="Corriente">Corriente</option>
<option value="Crossbreed">Crossbreed</option>
<option value="Galloway">Galloway</option>
<option value="Gelbvieh">Gelbvieh</option>
<option value="Guernsey">Guernsey</option>
<option value="Hereford">Hereford</option>
<option value="Highland">Highland</option>
<option value="Holstein">Holstein</option>
<option value="Jersey">Jersey</option>
<option value="Limousin">Limousin</option>
<option value="Longhorn">Longhorn</option>
<option value="Maine Anjou">Maine Anjou</option>
<option value="Other">Other</option>
<option value="Red Angus">Red Angus</option>
<option value="Shorthorn">Shorthorn</option>
<option value="Simmental">Simmental</option>
</select><br>
Gender: <select size="1" name="cattle_gender_02">
<option value="">No Gender Selected</option>
<option value="Bull">Bull</option>
<option value="Bull Calfs">Bull Calfs</option>
<option value="Cow">Cow</option>
<option value="Cows_Bulls">Cows &amp; Bulls</option>
<option value="Heifer">Heifer</option>
<option value="Heifer Calfs">Heifer Calfs</option>
<option value="Mixed Calfs">Mixed Calfs</option>
<option value="Other">Other</option>
<option value="Steer">Steer</option>
<option value="Steer Calfs">Steer Calfs</option>
<option value="Steers_Heifers">Steers &amp; Heifers</option>
</select><br>
Color: <select size="1" name="cattle_color_02">
<option value="">No Color Selected</option>
<option value="Black">Black</option>
<option value="Blkbroc">Blkbroc</option>
<option value="Blkwf">Blkwf</option>
<option value="Char">Char</option>
<option value="Gray">Gray</option>
<option value="Gray wf">Gray wf</option>
<option value="Holstein">Holstein</option>
<option value="Longhorn">Longhorn</option>
<option value="Mixed">Mixed</option>
<option value="Other">Other</option>
<option value="Red">Red</option>
<option value="Red wf">Red wf</option>
<option value="Redbroc">Redbroc</option>
<option value="Wf">Wf</option>
</select><br>
Brand Location: <select size="1" name="cattle_position_02">
<option value="">No Brand</option>
<option value="Left">Left</option>
<option value="Left Hip">Left Hip</option>
<option value="Left Shoulder">Left Shoulder</option>
<option value="Right">Right</option>
<option value="Right Hip">Right Hip</option>
<option value="Right Shoulder">Right Shoulder</option>
</select><br>
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
<table border="0" cellpadding="0" cellspacing="0" width="250">
  <tr>
    <td align="center" width="100%">
      <input type="checkbox" name="cattle_brand_location_02_LJ" value="LJ">LJ
      <input type="checkbox" name="cattle_brand_location_02_LN" value="LN">LN
      <input type="checkbox" name="cattle_brand_location_02_LS" value="LS">LS
      <input type="checkbox" name="cattle_brand_location_02_LR" value="LR">LR
      <input type="checkbox" name="cattle_brand_location_02_LH" value="LH">LH<br>
      <input type="checkbox" name="cattle_brand_location_02_LT" value="LT">LT
      <input type="checkbox" name="cattle_brand_location_02_LB" value="LB">LB
      <input type="checkbox" name="cattle_brand_location_02_RJ" value="RJ">RJ
      <input type="checkbox" name="cattle_brand_location_02_RN" value="RN">RN
      <input type="checkbox" name="cattle_brand_location_02_RS" value="RS">RS<br>
      <input type="checkbox" name="cattle_brand_location_02_RR" value="RR">RR
      <input type="checkbox" name="cattle_brand_location_02_RH" value="RH">RH
      <input type="checkbox" name="cattle_brand_location_02_RT" value="RT">RT
      <input type="checkbox" name="cattle_brand_location_02_RB" value="RB">RB<br>
      <input type="checkbox" name="cattle_brand_location_02_DIM" value="DIM">DIM
      <input type="checkbox" name="cattle_brand_location_02_BOTCH" value="BOTCH">BOTCH
      <input type="checkbox" name="cattle_brand_location_02_FREEZE" value="FREEZE">FREEZE
      </td>
  </tr>
</table>
	</td>
  </tr>
</table>
</div>
<h3>Group 3</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Country Cattle: <input name="cat_num_country_03" type="text" id="cat_num_country_03"><br>
# Slaughter Cattle: <input name="cat_num_slaughter_03" type="text" id="cat_num_slaughter_03"><br>
# Rodeo Cattle: <input name="cat_num_rodeo_03" type="text" id="cat_num_rodeo_03"><br>
# Show Cattle: <input name="cat_num_show_03" type="text" id="cat_num_show_03"><br>
# Hides: <input name="cattle_hides_03" type="text" id="cattle_hides_03"><br>
Breed: <select size="1" name="cattle_breed_03">
<option value="">No Breed Selected</option>
<option value="Beefmaster">Beefmaster</option>
<option value="Black Angus">Black Angus</option>
<option value="Brahman">Brahman</option>
<option value="Braunvieh">Braunvieh</option>
<option value="Brown swiss">Brown swiss</option>
<option value="Charolais">Charolais</option>
<option value="Chianina">Chianina</option>
<option value="Corriente">Corriente</option>
<option value="Crossbreed">Crossbreed</option>
<option value="Galloway">Galloway</option>
<option value="Gelbvieh">Gelbvieh</option>
<option value="Guernsey">Guernsey</option>
<option value="Hereford">Hereford</option>
<option value="Highland">Highland</option>
<option value="Holstein">Holstein</option>
<option value="Jersey">Jersey</option>
<option value="Limousin">Limousin</option>
<option value="Longhorn">Longhorn</option>
<option value="Maine Anjou">Maine Anjou</option>
<option value="Other">Other</option>
<option value="Red Angus">Red Angus</option>
<option value="Shorthorn">Shorthorn</option>
<option value="Simmental">Simmental</option>
</select><br>
Gender: <select size="1" name="cattle_gender_03">
<option value="">No Gender Selected</option>
<option value="Bull">Bull</option>
<option value="Bull Calfs">Bull Calfs</option>
<option value="Cow">Cow</option>
<option value="Cows_Bulls">Cows &amp; Bulls</option>
<option value="Heifer">Heifer</option>
<option value="Heifer Calfs">Heifer Calfs</option>
<option value="Mixed Calfs">Mixed Calfs</option>
<option value="Other">Other</option>
<option value="Steer">Steer</option>
<option value="Steer Calfs">Steer Calfs</option>
<option value="Steers_Heifers">Steers &amp; Heifers</option>
</select><br>
Color: <select size="1" name="cattle_color_03">
<option value="">No Color Selected</option>
<option value="Black">Black</option>
<option value="Blkbroc">Blkbroc</option>
<option value="Blkwf">Blkwf</option>
<option value="Char">Char</option>
<option value="Gray">Gray</option>
<option value="Gray wf">Gray wf</option>
<option value="Holstein">Holstein</option>
<option value="Longhorn">Longhorn</option>
<option value="Mixed">Mixed</option>
<option value="Other">Other</option>
<option value="Red">Red</option>
<option value="Red wf">Red wf</option>
<option value="Redbroc">Redbroc</option>
<option value="Wf">Wf</option>
</select><br>
Brand Location: <select size="1" name="cattle_position_03">
<option value="">No Brand</option>
<option value="Left">Left</option>
<option value="Left Hip">Left Hip</option>
<option value="Left Shoulder">Left Shoulder</option>
<option value="Right">Right</option>
<option value="Right Hip">Right Hip</option>
<option value="Right Shoulder">Right Shoulder</option>
</select><br>
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
<table border="0" cellpadding="0" cellspacing="0" width="250">
  <tr>
    <td align="center" width="100%">
      <input type="checkbox" name="cattle_brand_location_03_LJ" value="LJ">LJ
      <input type="checkbox" name="cattle_brand_location_03_LN" value="LN">LN
      <input type="checkbox" name="cattle_brand_location_03_LS" value="LS">LS
      <input type="checkbox" name="cattle_brand_location_03_LR" value="LR">LR
      <input type="checkbox" name="cattle_brand_location_03_LH" value="LH">LH<br>
      <input type="checkbox" name="cattle_brand_location_03_LT" value="LT">LT
      <input type="checkbox" name="cattle_brand_location_03_LB" value="LB">LB
      <input type="checkbox" name="cattle_brand_location_03_RJ" value="RJ">RJ
      <input type="checkbox" name="cattle_brand_location_03_RN" value="RN">RN
      <input type="checkbox" name="cattle_brand_location_03_RS" value="RS">RS<br>
      <input type="checkbox" name="cattle_brand_location_03_RR" value="RR">RR
      <input type="checkbox" name="cattle_brand_location_03_RH" value="RH">RH
      <input type="checkbox" name="cattle_brand_location_03_RT" value="RT">RT
      <input type="checkbox" name="cattle_brand_location_03_RB" value="RB">RB<br>
      <input type="checkbox" name="cattle_brand_location_03_DIM" value="DIM">DIM
      <input type="checkbox" name="cattle_brand_location_03_BOTCH" value="BOTCH">BOTCH
      <input type="checkbox" name="cattle_brand_location_03_FREEZE" value="FREEZE">FREEZE
      </td>
  </tr>
</table>
	</td>
  </tr>
</table>
</div>
<h3>Group 4</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Country Cattle: <input name="cat_num_country_04" type="text" id="cat_num_country_04"><br>
# Slaughter Cattle: <input name="cat_num_slaughter_04" type="text" id="cat_num_slaughter_04"><br>
# Rodeo Cattle: <input name="cat_num_rodeo_04" type="text" id="cat_num_rodeo_04"><br>
# Show Cattle: <input name="cat_num_show_04" type="text" id="cat_num_show_04"><br>
# Hides: <input name="cattle_hides_04" type="text" id="cattle_hides_04"><br>
Breed: <select size="1" name="cattle_breed_04">
<option value="">No Breed Selected</option>
<option value="Beefmaster">Beefmaster</option>
<option value="Black Angus">Black Angus</option>
<option value="Brahman">Brahman</option>
<option value="Braunvieh">Braunvieh</option>
<option value="Brown swiss">Brown swiss</option>
<option value="Charolais">Charolais</option>
<option value="Chianina">Chianina</option>
<option value="Corriente">Corriente</option>
<option value="Crossbreed">Crossbreed</option>
<option value="Galloway">Galloway</option>
<option value="Gelbvieh">Gelbvieh</option>
<option value="Guernsey">Guernsey</option>
<option value="Hereford">Hereford</option>
<option value="Highland">Highland</option>
<option value="Holstein">Holstein</option>
<option value="Jersey">Jersey</option>
<option value="Limousin">Limousin</option>
<option value="Longhorn">Longhorn</option>
<option value="Maine Anjou">Maine Anjou</option>
<option value="Other">Other</option>
<option value="Red Angus">Red Angus</option>
<option value="Shorthorn">Shorthorn</option>
<option value="Simmental">Simmental</option>
</select><br>
Gender: <select size="1" name="cattle_gender_04">
<option value="">No Gender Selected</option>
<option value="Bull">Bull</option>
<option value="Bull Calfs">Bull Calfs</option>
<option value="Cow">Cow</option>
<option value="Cows_Bulls">Cows &amp; Bulls</option>
<option value="Heifer">Heifer</option>
<option value="Heifer Calfs">Heifer Calfs</option>
<option value="Mixed Calfs">Mixed Calfs</option>
<option value="Other">Other</option>
<option value="Steer">Steer</option>
<option value="Steer Calfs">Steer Calfs</option>
<option value="Steers_Heifers">Steers &amp; Heifers</option>
</select><br>
Color: <select size="1" name="cattle_color_04">
<option value="">No Color Selected</option>
<option value="Black">Black</option>
<option value="Blkbroc">Blkbroc</option>
<option value="Blkwf">Blkwf</option>
<option value="Char">Char</option>
<option value="Gray">Gray</option>
<option value="Gray wf">Gray wf</option>
<option value="Holstein">Holstein</option>
<option value="Longhorn">Longhorn</option>
<option value="Mixed">Mixed</option>
<option value="Other">Other</option>
<option value="Red">Red</option>
<option value="Red wf">Red wf</option>
<option value="Redbroc">Redbroc</option>
<option value="Wf">Wf</option>
</select><br>
Brand Location: <select size="1" name="cattle_position_04">
<option value="">No Brand</option>
<option value="Left">Left</option>
<option value="Left Hip">Left Hip</option>
<option value="Left Shoulder">Left Shoulder</option>
<option value="Right">Right</option>
<option value="Right Hip">Right Hip</option>
<option value="Right Shoulder">Right Shoulder</option>
</select><br>
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
<table border="0" cellpadding="0" cellspacing="0" width="250">
  <tr>
    <td align="center" width="100%">
      <input type="checkbox" name="cattle_brand_location_04_LJ" value="LJ">LJ
      <input type="checkbox" name="cattle_brand_location_04_LN" value="LN">LN
      <input type="checkbox" name="cattle_brand_location_04_LS" value="LS">LS
      <input type="checkbox" name="cattle_brand_location_04_LR" value="LR">LR
      <input type="checkbox" name="cattle_brand_location_04_LH" value="LH">LH<br>
      <input type="checkbox" name="cattle_brand_location_04_LT" value="LT">LT
      <input type="checkbox" name="cattle_brand_location_04_LB" value="LB">LB
      <input type="checkbox" name="cattle_brand_location_04_RJ" value="RJ">RJ
      <input type="checkbox" name="cattle_brand_location_04_RN" value="RN">RN
      <input type="checkbox" name="cattle_brand_location_04_RS" value="RS">RS<br>
      <input type="checkbox" name="cattle_brand_location_04_RR" value="RR">RR
      <input type="checkbox" name="cattle_brand_location_04_RH" value="RH">RH
      <input type="checkbox" name="cattle_brand_location_04_RT" value="RT">RT
      <input type="checkbox" name="cattle_brand_location_04_RB" value="RB">RB<br>
      <input type="checkbox" name="cattle_brand_location_04_DIM" value="DIM">DIM
      <input type="checkbox" name="cattle_brand_location_04_BOTCH" value="BOTCH">BOTCH
      <input type="checkbox" name="cattle_brand_location_04_FREEZE" value="FREEZE">FREEZE
      </td>
  </tr>
</table>
	</td>
  </tr>
</table>
</div>
<h3>Group 5</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Country Cattle: <input name="cat_num_country_05" type="text" id="cat_num_country_05"><br>
# Slaughter Cattle: <input name="cat_num_slaughter_05" type="text" id="cat_num_slaughter_05"><br>
# Rodeo Cattle: <input name="cat_num_rodeo_05" type="text" id="cat_num_rodeo_05"><br>
# Show Cattle: <input name="cat_num_show_05" type="text" id="cat_num_show_05"><br>
# Hides: <input name="cattle_hides_05" type="text" id="cattle_hides_05"><br>
Breed: <select size="1" name="cattle_breed_05">
<option value="">No Breed Selected</option>
<option value="Beefmaster">Beefmaster</option>
<option value="Black Angus">Black Angus</option>
<option value="Brahman">Brahman</option>
<option value="Braunvieh">Braunvieh</option>
<option value="Brown swiss">Brown swiss</option>
<option value="Charolais">Charolais</option>
<option value="Chianina">Chianina</option>
<option value="Corriente">Corriente</option>
<option value="Crossbreed">Crossbreed</option>
<option value="Galloway">Galloway</option>
<option value="Gelbvieh">Gelbvieh</option>
<option value="Guernsey">Guernsey</option>
<option value="Hereford">Hereford</option>
<option value="Highland">Highland</option>
<option value="Holstein">Holstein</option>
<option value="Jersey">Jersey</option>
<option value="Limousin">Limousin</option>
<option value="Longhorn">Longhorn</option>
<option value="Maine Anjou">Maine Anjou</option>
<option value="Other">Other</option>
<option value="Red Angus">Red Angus</option>
<option value="Shorthorn">Shorthorn</option>
<option value="Simmental">Simmental</option>
</select><br>
Gender: <select size="1" name="cattle_gender_05">
<option value="">No Gender Selected</option>
<option value="Bull">Bull</option>
<option value="Bull Calfs">Bull Calfs</option>
<option value="Cow">Cow</option>
<option value="Cows_Bulls">Cows &amp; Bulls</option>
<option value="Heifer">Heifer</option>
<option value="Heifer Calfs">Heifer Calfs</option>
<option value="Mixed Calfs">Mixed Calfs</option>
<option value="Other">Other</option>
<option value="Steer">Steer</option>
<option value="Steer Calfs">Steer Calfs</option>
<option value="Steers_Heifers">Steers &amp; Heifers</option>
</select><br>
Color: <select size="1" name="cattle_color_05">
<option value="">No Color Selected</option>
<option value="Black">Black</option>
<option value="Blkbroc">Blkbroc</option>
<option value="Blkwf">Blkwf</option>
<option value="Char">Char</option>
<option value="Gray">Gray</option>
<option value="Gray wf">Gray wf</option>
<option value="Holstein">Holstein</option>
<option value="Longhorn">Longhorn</option>
<option value="Mixed">Mixed</option>
<option value="Other">Other</option>
<option value="Red">Red</option>
<option value="Red wf">Red wf</option>
<option value="Redbroc">Redbroc</option>
<option value="Wf">Wf</option>
</select><br>
Brand Location: <select size="1" name="cattle_position_05">
<option value="">No Brand</option>
<option value="Left">Left</option>
<option value="Left Hip">Left Hip</option>
<option value="Left Shoulder">Left Shoulder</option>
<option value="Right">Right</option>
<option value="Right Hip">Right Hip</option>
<option value="Right Shoulder">Right Shoulder</option>
</select><br>
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
<table border="0" cellpadding="0" cellspacing="0" width="250">
  <tr>
    <td align="center" width="100%">
      <input type="checkbox" name="cattle_brand_location_05_LJ" value="LJ">LJ
      <input type="checkbox" name="cattle_brand_location_05_LN" value="LN">LN
      <input type="checkbox" name="cattle_brand_location_05_LS" value="LS">LS
      <input type="checkbox" name="cattle_brand_location_05_LR" value="LR">LR
      <input type="checkbox" name="cattle_brand_location_05_LH" value="LH">LH<br>
      <input type="checkbox" name="cattle_brand_location_05_LT" value="LT">LT
      <input type="checkbox" name="cattle_brand_location_05_LB" value="LB">LB
      <input type="checkbox" name="cattle_brand_location_05_RJ" value="RJ">RJ
      <input type="checkbox" name="cattle_brand_location_05_RN" value="RN">RN
      <input type="checkbox" name="cattle_brand_location_05_RS" value="RS">RS<br>
      <input type="checkbox" name="cattle_brand_location_05_RR" value="RR">RR
      <input type="checkbox" name="cattle_brand_location_05_RH" value="RH">RH
      <input type="checkbox" name="cattle_brand_location_05_RT" value="RT">RT
      <input type="checkbox" name="cattle_brand_location_05_RB" value="RB">RB<br>
      <input type="checkbox" name="cattle_brand_location_05_DIM" value="DIM">DIM
      <input type="checkbox" name="cattle_brand_location_05_BOTCH" value="BOTCH">BOTCH
      <input type="checkbox" name="cattle_brand_location_05_FREEZE" value="FREEZE">FREEZE
      </td>
  </tr>
</table>
	</td>
  </tr>
</table>
</div>
<h3>Group 6</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Country Cattle: <input name="cat_num_country_06" type="text" id="cat_num_country_06"><br>
# Slaughter Cattle: <input name="cat_num_slaughter_06" type="text" id="cat_num_slaughter_06"><br>
# Rodeo Cattle: <input name="cat_num_rodeo_06" type="text" id="cat_num_rodeo_06"><br>
# Show Cattle: <input name="cat_num_show_06" type="text" id="cat_num_show_06"><br>
# Hides: <input name="cattle_hides_06" type="text" id="cattle_hides_06"><br>
Breed: <select size="1" name="cattle_breed_06">
<option value="">No Breed Selected</option>
<option value="Beefmaster">Beefmaster</option>
<option value="Black Angus">Black Angus</option>
<option value="Brahman">Brahman</option>
<option value="Braunvieh">Braunvieh</option>
<option value="Brown swiss">Brown swiss</option>
<option value="Charolais">Charolais</option>
<option value="Chianina">Chianina</option>
<option value="Corriente">Corriente</option>
<option value="Crossbreed">Crossbreed</option>
<option value="Galloway">Galloway</option>
<option value="Gelbvieh">Gelbvieh</option>
<option value="Guernsey">Guernsey</option>
<option value="Hereford">Hereford</option>
<option value="Highland">Highland</option>
<option value="Holstein">Holstein</option>
<option value="Jersey">Jersey</option>
<option value="Limousin">Limousin</option>
<option value="Longhorn">Longhorn</option>
<option value="Maine Anjou">Maine Anjou</option>
<option value="Other">Other</option>
<option value="Red Angus">Red Angus</option>
<option value="Shorthorn">Shorthorn</option>
<option value="Simmental">Simmental</option>
</select><br>
Gender: <select size="1" name="cattle_gender_06">
<option value="">No Gender Selected</option>
<option value="Bull">Bull</option>
<option value="Bull Calfs">Bull Calfs</option>
<option value="Cow">Cow</option>
<option value="Cows_Bulls">Cows &amp; Bulls</option>
<option value="Heifer">Heifer</option>
<option value="Heifer Calfs">Heifer Calfs</option>
<option value="Mixed Calfs">Mixed Calfs</option>
<option value="Other">Other</option>
<option value="Steer">Steer</option>
<option value="Steer Calfs">Steer Calfs</option>
<option value="Steers_Heifers">Steers &amp; Heifers</option>
</select><br>
Color: <select size="1" name="cattle_color_06">
<option value="">No Color Selected</option>
<option value="Black">Black</option>
<option value="Blkbroc">Blkbroc</option>
<option value="Blkwf">Blkwf</option>
<option value="Char">Char</option>
<option value="Gray">Gray</option>
<option value="Gray wf">Gray wf</option>
<option value="Holstein">Holstein</option>
<option value="Longhorn">Longhorn</option>
<option value="Mixed">Mixed</option>
<option value="Other">Other</option>
<option value="Red">Red</option>
<option value="Red wf">Red wf</option>
<option value="Redbroc">Redbroc</option>
<option value="Wf">Wf</option>
</select><br>
Brand Location: <select size="1" name="cattle_position_06">
<option value="">No Brand</option>
<option value="Left">Left</option>
<option value="Left Hip">Left Hip</option>
<option value="Left Shoulder">Left Shoulder</option>
<option value="Right">Right</option>
<option value="Right Hip">Right Hip</option>
<option value="Right Shoulder">Right Shoulder</option>
</select><br>
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
<table border="0" cellpadding="0" cellspacing="0" width="250">
  <tr>
    <td align="center" width="100%">
      <input type="checkbox" name="cattle_brand_location_06_LJ" value="LJ">LJ
      <input type="checkbox" name="cattle_brand_location_06_LN" value="LN">LN
      <input type="checkbox" name="cattle_brand_location_06_LS" value="LS">LS
      <input type="checkbox" name="cattle_brand_location_06_LR" value="LR">LR
      <input type="checkbox" name="cattle_brand_location_06_LH" value="LH">LH<br>
      <input type="checkbox" name="cattle_brand_location_06_LT" value="LT">LT
      <input type="checkbox" name="cattle_brand_location_06_LB" value="LB">LB
      <input type="checkbox" name="cattle_brand_location_06_RJ" value="RJ">RJ
      <input type="checkbox" name="cattle_brand_location_06_RN" value="RN">RN
      <input type="checkbox" name="cattle_brand_location_06_RS" value="RS">RS<br>
      <input type="checkbox" name="cattle_brand_location_06_RR" value="RR">RR
      <input type="checkbox" name="cattle_brand_location_06_RH" value="RH">RH
      <input type="checkbox" name="cattle_brand_location_06_RT" value="RT">RT
      <input type="checkbox" name="cattle_brand_location_06_RB" value="RB">RB<br>
      <input type="checkbox" name="cattle_brand_location_06_DIM" value="DIM">DIM
      <input type="checkbox" name="cattle_brand_location_06_BOTCH" value="BOTCH">BOTCH
      <input type="checkbox" name="cattle_brand_location_06_FREEZE" value="FREEZE">FREEZE
      </td>
  </tr>
</table>
	</td>
  </tr>
</table>
</div>
<h3>Group 7</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Country Cattle: <input name="cat_num_country_07" type="text" id="cat_num_country_07"><br>
# Slaughter Cattle: <input name="cat_num_slaughter_07" type="text" id="cat_num_slaughter_07"><br>
# Rodeo Cattle: <input name="cat_num_rodeo_07" type="text" id="cat_num_rodeo_07"><br>
# Show Cattle: <input name="cat_num_show_07" type="text" id="cat_num_show_07"><br>
# Hides: <input name="cattle_hides_07" type="text" id="cattle_hides_07"><br>
Breed: <select size="1" name="cattle_breed_07">
<option value="">No Breed Selected</option>
<option value="Beefmaster">Beefmaster</option>
<option value="Black Angus">Black Angus</option>
<option value="Brahman">Brahman</option>
<option value="Braunvieh">Braunvieh</option>
<option value="Brown swiss">Brown swiss</option>
<option value="Charolais">Charolais</option>
<option value="Chianina">Chianina</option>
<option value="Corriente">Corriente</option>
<option value="Crossbreed">Crossbreed</option>
<option value="Galloway">Galloway</option>
<option value="Gelbvieh">Gelbvieh</option>
<option value="Guernsey">Guernsey</option>
<option value="Hereford">Hereford</option>
<option value="Highland">Highland</option>
<option value="Holstein">Holstein</option>
<option value="Jersey">Jersey</option>
<option value="Limousin">Limousin</option>
<option value="Longhorn">Longhorn</option>
<option value="Maine Anjou">Maine Anjou</option>
<option value="Other">Other</option>
<option value="Red Angus">Red Angus</option>
<option value="Shorthorn">Shorthorn</option>
<option value="Simmental">Simmental</option>
</select><br>
Gender: <select size="1" name="cattle_gender_07">
<option value="">No Gender Selected</option>
<option value="Bull">Bull</option>
<option value="Bull Calfs">Bull Calfs</option>
<option value="Cow">Cow</option>
<option value="Cows_Bulls">Cows &amp; Bulls</option>
<option value="Heifer">Heifer</option>
<option value="Heifer Calfs">Heifer Calfs</option>
<option value="Mixed Calfs">Mixed Calfs</option>
<option value="Other">Other</option>
<option value="Steer">Steer</option>
<option value="Steer Calfs">Steer Calfs</option>
<option value="Steers_Heifers">Steers &amp; Heifers</option>
</select><br>
Color: <select size="1" name="cattle_color_07">
<option value="">No Color Selected</option>
<option value="Black">Black</option>
<option value="Blkbroc">Blkbroc</option>
<option value="Blkwf">Blkwf</option>
<option value="Char">Char</option>
<option value="Gray">Gray</option>
<option value="Gray wf">Gray wf</option>
<option value="Holstein">Holstein</option>
<option value="Longhorn">Longhorn</option>
<option value="Mixed">Mixed</option>
<option value="Other">Other</option>
<option value="Red">Red</option>
<option value="Red wf">Red wf</option>
<option value="Redbroc">Redbroc</option>
<option value="Wf">Wf</option>
</select><br>
Brand Location: <select size="1" name="cattle_position_07">
<option value="">No Brand</option>
<option value="Left">Left</option>
<option value="Left Hip">Left Hip</option>
<option value="Left Shoulder">Left Shoulder</option>
<option value="Right">Right</option>
<option value="Right Hip">Right Hip</option>
<option value="Right Shoulder">Right Shoulder</option>
</select><br>
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
<table border="0" cellpadding="0" cellspacing="0" width="250">
  <tr>
    <td align="center" width="100%">
      <input type="checkbox" name="cattle_brand_location_07_LJ" value="LJ">LJ
      <input type="checkbox" name="cattle_brand_location_07_LN" value="LN">LN
      <input type="checkbox" name="cattle_brand_location_07_LS" value="LS">LS
      <input type="checkbox" name="cattle_brand_location_07_LR" value="LR">LR
      <input type="checkbox" name="cattle_brand_location_07_LH" value="LH">LH<br>
      <input type="checkbox" name="cattle_brand_location_07_LT" value="LT">LT
      <input type="checkbox" name="cattle_brand_location_07_LB" value="LB">LB
      <input type="checkbox" name="cattle_brand_location_07_RJ" value="RJ">RJ
      <input type="checkbox" name="cattle_brand_location_07_RN" value="RN">RN
      <input type="checkbox" name="cattle_brand_location_07_RS" value="RS">RS<br>
      <input type="checkbox" name="cattle_brand_location_07_RR" value="RR">RR
      <input type="checkbox" name="cattle_brand_location_07_RH" value="RH">RH
      <input type="checkbox" name="cattle_brand_location_07_RT" value="RT">RT
      <input type="checkbox" name="cattle_brand_location_07_RB" value="RB">RB<br>
      <input type="checkbox" name="cattle_brand_location_07_DIM" value="DIM">DIM
      <input type="checkbox" name="cattle_brand_location_07_BOTCH" value="BOTCH">BOTCH
      <input type="checkbox" name="cattle_brand_location_07_FREEZE" value="FREEZE">FREEZE
      </td>
  </tr>
</table>
	</td>
  </tr>
</table>
</div>
<h3>Group 8</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Country Cattle: <input name="cat_num_country_08" type="text" id="cat_num_country_08"><br>
# Slaughter Cattle: <input name="cat_num_slaughter_08" type="text" id="cat_num_slaughter_08"><br>
# Rodeo Cattle: <input name="cat_num_rodeo_08" type="text" id="cat_num_rodeo_08"><br>
# Show Cattle: <input name="cat_num_show_08" type="text" id="cat_num_show_08"><br>
# Hides: <input name="cattle_hides_08" type="text" id="cattle_hides_08"><br>
Breed: <select size="1" name="cattle_breed_08">
<option value="">No Breed Selected</option>
<option value="Beefmaster">Beefmaster</option>
<option value="Black Angus">Black Angus</option>
<option value="Brahman">Brahman</option>
<option value="Braunvieh">Braunvieh</option>
<option value="Brown swiss">Brown swiss</option>
<option value="Charolais">Charolais</option>
<option value="Chianina">Chianina</option>
<option value="Corriente">Corriente</option>
<option value="Crossbreed">Crossbreed</option>
<option value="Galloway">Galloway</option>
<option value="Gelbvieh">Gelbvieh</option>
<option value="Guernsey">Guernsey</option>
<option value="Hereford">Hereford</option>
<option value="Highland">Highland</option>
<option value="Holstein">Holstein</option>
<option value="Jersey">Jersey</option>
<option value="Limousin">Limousin</option>
<option value="Longhorn">Longhorn</option>
<option value="Maine Anjou">Maine Anjou</option>
<option value="Other">Other</option>
<option value="Red Angus">Red Angus</option>
<option value="Shorthorn">Shorthorn</option>
<option value="Simmental">Simmental</option>
</select><br>
Gender: <select size="1" name="cattle_gender_08">
<option value="">No Gender Selected</option>
<option value="Bull">Bull</option>
<option value="Bull Calfs">Bull Calfs</option>
<option value="Cow">Cow</option>
<option value="Cows_Bulls">Cows &amp; Bulls</option>
<option value="Heifer">Heifer</option>
<option value="Heifer Calfs">Heifer Calfs</option>
<option value="Mixed Calfs">Mixed Calfs</option>
<option value="Other">Other</option>
<option value="Steer">Steer</option>
<option value="Steer Calfs">Steer Calfs</option>
<option value="Steers_Heifers">Steers &amp; Heifers</option>
</select><br>
Color: <select size="1" name="cattle_color_08">
<option value="">No Color Selected</option>
<option value="Black">Black</option>
<option value="Blkbroc">Blkbroc</option>
<option value="Blkwf">Blkwf</option>
<option value="Char">Char</option>
<option value="Gray">Gray</option>
<option value="Gray wf">Gray wf</option>
<option value="Holstein">Holstein</option>
<option value="Longhorn">Longhorn</option>
<option value="Mixed">Mixed</option>
<option value="Other">Other</option>
<option value="Red">Red</option>
<option value="Red wf">Red wf</option>
<option value="Redbroc">Redbroc</option>
<option value="Wf">Wf</option>
</select><br>
Brand Location: <select size="1" name="cattle_position_08">
<option value="">No Brand</option>
<option value="Left">Left</option>
<option value="Left Hip">Left Hip</option>
<option value="Left Shoulder">Left Shoulder</option>
<option value="Right">Right</option>
<option value="Right Hip">Right Hip</option>
<option value="Right Shoulder">Right Shoulder</option>
</select><br>
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
<table border="0" cellpadding="0" cellspacing="0" width="250">
  <tr>
    <td align="center" width="100%">
      <input type="checkbox" name="cattle_brand_location_08_LJ" value="LJ">LJ
      <input type="checkbox" name="cattle_brand_location_08_LN" value="LN">LN
      <input type="checkbox" name="cattle_brand_location_08_LS" value="LS">LS
      <input type="checkbox" name="cattle_brand_location_08_LR" value="LR">LR
      <input type="checkbox" name="cattle_brand_location_08_LH" value="LH">LH<br>
      <input type="checkbox" name="cattle_brand_location_08_LT" value="LT">LT
      <input type="checkbox" name="cattle_brand_location_08_LB" value="LB">LB
      <input type="checkbox" name="cattle_brand_location_08_RJ" value="RJ">RJ
      <input type="checkbox" name="cattle_brand_location_08_RN" value="RN">RN
      <input type="checkbox" name="cattle_brand_location_08_RS" value="RS">RS<br>
      <input type="checkbox" name="cattle_brand_location_08_RR" value="RR">RR
      <input type="checkbox" name="cattle_brand_location_08_RH" value="RH">RH
      <input type="checkbox" name="cattle_brand_location_08_RT" value="RT">RT
      <input type="checkbox" name="cattle_brand_location_08_RB" value="RB">RB<br>
      <input type="checkbox" name="cattle_brand_location_08_DIM" value="DIM">DIM
      <input type="checkbox" name="cattle_brand_location_08_BOTCH" value="BOTCH">BOTCH
      <input type="checkbox" name="cattle_brand_location_08_FREEZE" value="FREEZE">FREEZE
      </td>
  </tr>
</table>
	</td>
  </tr>
</table>
</div>
<h3>Group 9</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Country Cattle: <input name="cat_num_country_09" type="text" id="cat_num_country_09"><br>
# Slaughter Cattle: <input name="cat_num_slaughter_09" type="text" id="cat_num_slaughter_09"><br>
# Rodeo Cattle: <input name="cat_num_rodeo_09" type="text" id="cat_num_rodeo_09"><br>
# Show Cattle: <input name="cat_num_show_09" type="text" id="cat_num_show_09"><br>
# Hides: <input name="cattle_hides_09" type="text" id="cattle_hides_09"><br>
Breed: <select size="1" name="cattle_breed_09">
<option value="">No Breed Selected</option>
<option value="Beefmaster">Beefmaster</option>
<option value="Black Angus">Black Angus</option>
<option value="Brahman">Brahman</option>
<option value="Braunvieh">Braunvieh</option>
<option value="Brown swiss">Brown swiss</option>
<option value="Charolais">Charolais</option>
<option value="Chianina">Chianina</option>
<option value="Corriente">Corriente</option>
<option value="Crossbreed">Crossbreed</option>
<option value="Galloway">Galloway</option>
<option value="Gelbvieh">Gelbvieh</option>
<option value="Guernsey">Guernsey</option>
<option value="Hereford">Hereford</option>
<option value="Highland">Highland</option>
<option value="Holstein">Holstein</option>
<option value="Jersey">Jersey</option>
<option value="Limousin">Limousin</option>
<option value="Longhorn">Longhorn</option>
<option value="Maine Anjou">Maine Anjou</option>
<option value="Other">Other</option>
<option value="Red Angus">Red Angus</option>
<option value="Shorthorn">Shorthorn</option>
<option value="Simmental">Simmental</option>
</select><br>
Gender: <select size="1" name="cattle_gender_09">
<option value="">No Gender Selected</option>
<option value="Bull">Bull</option>
<option value="Bull Calfs">Bull Calfs</option>
<option value="Cow">Cow</option>
<option value="Cows_Bulls">Cows &amp; Bulls</option>
<option value="Heifer">Heifer</option>
<option value="Heifer Calfs">Heifer Calfs</option>
<option value="Mixed Calfs">Mixed Calfs</option>
<option value="Other">Other</option>
<option value="Steer">Steer</option>
<option value="Steer Calfs">Steer Calfs</option>
<option value="Steers_Heifers">Steers &amp; Heifers</option>
</select><br>
Color: <select size="1" name="cattle_color_09">
<option value="">No Color Selected</option>
<option value="Black">Black</option>
<option value="Blkbroc">Blkbroc</option>
<option value="Blkwf">Blkwf</option>
<option value="Char">Char</option>
<option value="Gray">Gray</option>
<option value="Gray wf">Gray wf</option>
<option value="Holstein">Holstein</option>
<option value="Longhorn">Longhorn</option>
<option value="Mixed">Mixed</option>
<option value="Other">Other</option>
<option value="Red">Red</option>
<option value="Red wf">Red wf</option>
<option value="Redbroc">Redbroc</option>
<option value="Wf">Wf</option>
</select><br>
Brand Location: <select size="1" name="cattle_position_09">
<option value="">No Brand</option>
<option value="Left">Left</option>
<option value="Left Hip">Left Hip</option>
<option value="Left Shoulder">Left Shoulder</option>
<option value="Right">Right</option>
<option value="Right Hip">Right Hip</option>
<option value="Right Shoulder">Right Shoulder</option>
</select><br>
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
<table border="0" cellpadding="0" cellspacing="0" width="250">
  <tr>
    <td align="center" width="100%">
      <input type="checkbox" name="cattle_brand_location_09_LJ" value="LJ">LJ
      <input type="checkbox" name="cattle_brand_location_09_LN" value="LN">LN
      <input type="checkbox" name="cattle_brand_location_09_LS" value="LS">LS
      <input type="checkbox" name="cattle_brand_location_09_LR" value="LR">LR
      <input type="checkbox" name="cattle_brand_location_09_LH" value="LH">LH<br>
      <input type="checkbox" name="cattle_brand_location_09_LT" value="LT">LT
      <input type="checkbox" name="cattle_brand_location_09_LB" value="LB">LB
      <input type="checkbox" name="cattle_brand_location_09_RJ" value="RJ">RJ
      <input type="checkbox" name="cattle_brand_location_09_RN" value="RN">RN
      <input type="checkbox" name="cattle_brand_location_09_RS" value="RS">RS<br>
      <input type="checkbox" name="cattle_brand_location_09_RR" value="RR">RR
      <input type="checkbox" name="cattle_brand_location_09_RH" value="RH">RH
      <input type="checkbox" name="cattle_brand_location_09_RT" value="RT">RT
      <input type="checkbox" name="cattle_brand_location_09_RB" value="RB">RB<br>
      <input type="checkbox" name="cattle_brand_location_09_DIM" value="DIM">DIM
      <input type="checkbox" name="cattle_brand_location_09_BOTCH" value="BOTCH">BOTCH
      <input type="checkbox" name="cattle_brand_location_09_FREEZE" value="FREEZE">FREEZE
      </td>
  </tr>
</table>
	</td>
  </tr>
</table>
</div>
<h3>Group 10</h3>
<div>
<table border="0" cellpadding="10" cellspacing="0" style="border-collapse: collapse">
  <tr>
    <td align="left" valign="top">
# Country Cattle: <input name="cat_num_country_10" type="text" id="cat_num_country_10"><br>
# Slaughter Cattle: <input name="cat_num_slaughter_10" type="text" id="cat_num_slaughter_10"><br>
# Rodeo Cattle: <input name="cat_num_rodeo_10" type="text" id="cat_num_rodeo_10"><br>
# Show Cattle: <input name="cat_num_show_10" type="text" id="cat_num_show_10"><br>
# Hides: <input name="cattle_hides_10" type="text" id="cattle_hides_10"><br>
Breed: <select size="1" name="cattle_breed_10">
<option value="">No Breed Selected</option>
<option value="Beefmaster">Beefmaster</option>
<option value="Black Angus">Black Angus</option>
<option value="Brahman">Brahman</option>
<option value="Braunvieh">Braunvieh</option>
<option value="Brown swiss">Brown swiss</option>
<option value="Charolais">Charolais</option>
<option value="Chianina">Chianina</option>
<option value="Corriente">Corriente</option>
<option value="Crossbreed">Crossbreed</option>
<option value="Galloway">Galloway</option>
<option value="Gelbvieh">Gelbvieh</option>
<option value="Guernsey">Guernsey</option>
<option value="Hereford">Hereford</option>
<option value="Highland">Highland</option>
<option value="Holstein">Holstein</option>
<option value="Jersey">Jersey</option>
<option value="Limousin">Limousin</option>
<option value="Longhorn">Longhorn</option>
<option value="Maine Anjou">Maine Anjou</option>
<option value="Other">Other</option>
<option value="Red Angus">Red Angus</option>
<option value="Shorthorn">Shorthorn</option>
<option value="Simmental">Simmental</option>
</select><br>
Gender: <select size="1" name="cattle_gender_10">
<option value="">No Gender Selected</option>
<option value="Bull">Bull</option>
<option value="Bull Calfs">Bull Calfs</option>
<option value="Cow">Cow</option>
<option value="Cows_Bulls">Cows &amp; Bulls</option>
<option value="Heifer">Heifer</option>
<option value="Heifer Calfs">Heifer Calfs</option>
<option value="Mixed Calfs">Mixed Calfs</option>
<option value="Other">Other</option>
<option value="Steer">Steer</option>
<option value="Steer Calfs">Steer Calfs</option>
<option value="Steers_Heifers">Steers &amp; Heifers</option>
</select><br>
Color: <select size="1" name="cattle_color_10">
<option value="">No Color Selected</option>
<option value="Black">Black</option>
<option value="Blkbroc">Blkbroc</option>
<option value="Blkwf">Blkwf</option>
<option value="Char">Char</option>
<option value="Gray">Gray</option>
<option value="Gray wf">Gray wf</option>
<option value="Holstein">Holstein</option>
<option value="Longhorn">Longhorn</option>
<option value="Mixed">Mixed</option>
<option value="Other">Other</option>
<option value="Red">Red</option>
<option value="Red wf">Red wf</option>
<option value="Redbroc">Redbroc</option>
<option value="Wf">Wf</option>
</select><br>
Brand Location: <select size="1" name="cattle_position_10">
<option value="">No Brand</option>
<option value="Left">Left</option>
<option value="Left Hip">Left Hip</option>
<option value="Left Shoulder">Left Shoulder</option>
<option value="Right">Right</option>
<option value="Right Hip">Right Hip</option>
<option value="Right Shoulder">Right Shoulder</option>
</select><br>
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
      <input type="checkbox" name="cattle_brand_location_10_LJ" value="LJ">LJ
      <input type="checkbox" name="cattle_brand_location_10_LN" value="LN">LN
      <input type="checkbox" name="cattle_brand_location_10_LS" value="LS">LS
      <input type="checkbox" name="cattle_brand_location_10_LR" value="LR">LR
      <input type="checkbox" name="cattle_brand_location_10_LH" value="LH">LH<br>
      <input type="checkbox" name="cattle_brand_location_10_LT" value="LT">LT
      <input type="checkbox" name="cattle_brand_location_10_LB" value="LB">LB
      <input type="checkbox" name="cattle_brand_location_10_RJ" value="RJ">RJ
      <input type="checkbox" name="cattle_brand_location_10_RN" value="RN">RN
      <input type="checkbox" name="cattle_brand_location_10_RS" value="RS">RS<br>
      <input type="checkbox" name="cattle_brand_location_10_RR" value="RR">RR
      <input type="checkbox" name="cattle_brand_location_10_RH" value="RH">RH
      <input type="checkbox" name="cattle_brand_location_10_RT" value="RT">RT
      <input type="checkbox" name="cattle_brand_location_10_RB" value="RB">RB<br>
      <input type="checkbox" name="cattle_brand_location_10_DIM" value="DIM">DIM
      <input type="checkbox" name="cattle_brand_location_10_BOTCH" value="BOTCH">BOTCH
      <input type="checkbox" name="cattle_brand_location_10_FREEZE" value="FREEZE">FREEZE
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
    <td align="left" valign="top">No Brand Calf Mileage Fee:</td>
    <td align="right" valign="top">$<input type="text" id="noBrandFee" value="" size="5" disabled></td>
  </tr>
    <tr>
    <td align="left" valign="top">Cattle Hides Fee:</td>
    <td align="right" valign="top">$<input type="text" id="cattleHidesFee" value="" size="5" disabled></td>
  </tr>
  <tr>
    <td align="left" valign="top">Rodeo Permit Fee:</td>
    <td align="right" valign="top">$<input type="text" id="rodeoFee" value="" size="5" disabled></td>
  </tr>
  <tr>
    <td align="left" valign="top">Show Permit Fee:</td>
    <td align="right" valign="top">$<input type="text" id="showFee" value="" size="5" disabled></td>
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
<!-- this has been commented out because as of right now, they're not doing electronic signatures but will in the future -->
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

<?php


if(isset($_GET['cert_serial_num']))
{
	include "zzzz.php";

	//select a database to work with
	$selected = mysql_select_db("brands",$conn)
	  or die("Could not select brands");


	$sql = "
	SELECT *,DATE_FORMAT(cert_date, '%m/%d/%y') AS cert_dateShow
	FROM certificates
	WHERE cert_serial_num = '".mysql_real_escape_string($_GET['cert_serial_num'])."'
	";
	$result = mysql_query($sql);
	$myrow = mysql_fetch_array($result);



	if ($myrow['cert_serial_num']) {
		$date = date("F j, Y");
		require_once("dompdf/dompdf_config.inc.php");
		$outPut = '
		<html>
		<head>
		<title>Stock Certificate</title>
		</head>

		<body topmargin="0" leftmargin="0">

		<table border="0" cellpadding="0" width="102%" style="border-collapse: collapse" cellspacing="0">
		  <tr>
		    <td colspan="1" align="center" valign="bottom">
		    <img border="0" src="images/co_state_seal_small.jpg" width="50" height="48"></td>
		    <td colspan="4" align="center" valign="top"><b><font size="4">STATE&nbsp;BOARD&nbsp;OF&nbsp;STOCK&nbsp;INSPECTION</font></b><br>
		    <font size="2">COLORADO DEPARTMENT OF AGRICULTURE</font></td>
		    <td colspan="1" align="center" valign="bottom">No.
		    <font color="#FF0000" size="4"><b>'.htmlentities($myrow['cert_series']).htmlentities($myrow['cert_insp_num']).htmlentities($myrow['cert_serial_num']).'</b></font></td>
		   </tr>
		  <tr>
		    <td><b>No. Cattle </b>'.htmlentities($myrow['num_cattle']).'</td>
		    <td colspan="5"><b>Date: </b>'.htmlentities($myrow['cert_dateShow']).'</td>
		   </tr>
		   <tr>
		    <td colspan="5" valign="top"><b>Owned by: </b>'.htmlentities($myrow['clss_name_owner']).', '.htmlentities($myrow['clss_city_owner']).', 
		    '.htmlentities($myrow['clss_state_owner']).', COIN: '.htmlentities($myrow['clss_coin_owner']).'</td>
		    <td rowspan="2" valign="top">
		<table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#000" width="100%">
		  <tr>
		    <td valign="top"><font size="2"><u>Cattle Movement</u><br>
		    ( ) Dairy<br>
		    ( ) Stocker<br>
		    ( ) Entering Feedlot<br>
		    ( ) Fat Cattle<br>
		    ( ) Private Fed<br>
		    ( ) Commercial Fed<br>
		    ( ) Killer<br>
		    ( ) -30 Days&nbsp;<u>'.htmlentities($myrow['cattle_movement_state']).'</u></font></td>
		  </tr>
		</table>
		</td>
		   </tr>
		   <tr>
		    <td colspan="5" valign="top"><b>Sold to: </b>'.htmlentities($myrow['clss_name_buyer']).', '.htmlentities($myrow['clss_city_buyer']).', 
		    '.htmlentities($myrow['clss_state_buyer']).', COIN: '.htmlentities($myrow['clss_coin_buyer']).'</td>
		   </tr>
		   <tr>
		    <td colspan="6"><b>No., Brand</b></td>
		   </tr>
		   <tr>
		    <td colspan="6" valign="top">';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_cattle_01.png')) {
			$outPut .= ''.htmlentities($myrow['num_cattle_01']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_cattle_01.png" alt="" border="0"  width="50" height="50">
			';}$outPut .= '&nbsp;';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_cattle_02.png')) {
			$outPut .= ''.htmlentities($myrow['num_cattle_02']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_cattle_02.png" alt="" border="0"  width="50" height="50">
			';}$outPut .= '&nbsp;';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_cattle_03.png')) {
			$outPut .= ''.htmlentities($myrow['num_cattle_03']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_cattle_03.png" alt="" border="0"  width="50" height="50">
			';}$outPut .= '&nbsp;';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_cattle_04.png')) {
			$outPut .= ''.htmlentities($myrow['num_cattle_04']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_cattle_04.png" alt="" border="0"  width="50" height="50">
			';}$outPut .= '&nbsp;';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_cattle_05.png')) {
			$outPut .= ''.htmlentities($myrow['num_cattle_05']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_cattle_05.png" alt="" border="0"  width="50" height="50">
			';}$outPut .= '&nbsp;';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_cattle_06.png')) {
			$outPut .= ''.htmlentities($myrow['num_cattle_06']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_cattle_06.png" alt="" border="0"  width="50" height="50">
			';}$outPut .= '&nbsp;';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_cattle_07.png')) {
			$outPut .= ''.htmlentities($myrow['num_cattle_07']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_cattle_07.png" alt="" border="0"  width="50" height="50">
			';}$outPut .= '&nbsp;';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_cattle_08.png')) {
			$outPut .= ''.htmlentities($myrow['num_cattle_08']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_cattle_08.png" alt="" border="0"  width="50" height="50">
			';}$outPut .= '&nbsp;';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_cattle_09.png')) {
			$outPut .= ''.htmlentities($myrow['num_cattle_09']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_cattle_09.png" alt="" border="0"  width="50" height="50">
			';}$outPut .= '&nbsp;';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_cattle_10.png')) {
			$outPut .= ''.htmlentities($myrow['num_cattle_10']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_cattle_10.png" alt="" border="0"  width="50" height="50">
			';}$outPut .= '&nbsp;';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_cattle_11.png')) {
			$outPut .= ''.htmlentities($myrow['num_cattle_11']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_cattle_11.png" alt="" border="0"  width="50" height="50">
			';}$outPut .= '&nbsp;';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_cattle_12.png')) {
			$outPut .= ''.htmlentities($myrow['num_cattle_12']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_cattle_12.png" alt="" border="0"  width="50" height="50">
			';}$outPut .= '&nbsp;';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_cattle_13.png')) {
			$outPut .= ''.htmlentities($myrow['num_cattle_13']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_cattle_13.png" alt="" border="0"  width="50" height="50">
			';}$outPut .= '&nbsp;';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_cattle_14.png')) {
			$outPut .= ''.htmlentities($myrow['num_cattle_14']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_cattle_14.png" alt="" border="0"  width="50" height="50">
			';}$outPut .= '&nbsp;';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_cattle_15.png')) {
			$outPut .= ''.htmlentities($myrow['num_cattle_15']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_cattle_15.png" alt="" border="0"  width="50" height="50">
			';}$outPut .= '&nbsp;';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_cattle_16.png')) {
			$outPut .= ''.htmlentities($myrow['num_cattle_16']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_cattle_16.png" alt="" border="0"  width="50" height="50">
			';}$outPut .= '&nbsp;';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_cattle_17.png')) {
			$outPut .= ''.htmlentities($myrow['num_cattle_17']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_cattle_17.png" alt="" border="0"  width="50" height="50">
			';}$outPut .= '&nbsp;';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_cattle_18.png')) {
			$outPut .= ''.htmlentities($myrow['num_cattle_18']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_cattle_18.png" alt="" border="0"  width="50" height="50">
			';}$outPut .= '&nbsp;';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_cattle_19.png')) {
			$outPut .= ''.htmlentities($myrow['num_cattle_19']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_cattle_19.png" alt="" border="0"  width="50" height="50">
			';}$outPut .= '&nbsp;';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_cattle_20.png')) {
			$outPut .= ''.htmlentities($myrow['num_cattle_20']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_cattle_20.png" alt="" border="0"  width="50" height="50">
			';}$outPut .= '&nbsp;';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_cattle_21.png')) {
			$outPut .= ''.htmlentities($myrow['num_cattle_21']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_cattle_21.png" alt="" border="0"  width="50" height="50">
			';}$outPut .= '&nbsp;';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_cattle_22.png')) {
			$outPut .= ''.htmlentities($myrow['num_cattle_22']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_cattle_22.png" alt="" border="0"  width="50" height="50">
			';}$outPut .= '&nbsp;';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_cattle_23.png')) {
			$outPut .= ''.htmlentities($myrow['num_cattle_23']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_cattle_23.png" alt="" border="0"  width="50" height="50">
			';}$outPut .= '&nbsp;';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_cattle_24.png')) {
			$outPut .= ''.htmlentities($myrow['num_cattle_24']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_cattle_24.png" alt="" border="0"  width="50" height="50">
			';}$outPut .= '&nbsp;';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_cattle_25.png')) {
			$outPut .= ''.htmlentities($myrow['num_cattle_25']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_cattle_25.png" alt="" border="0"  width="50" height="50">
			';}$outPut .= '&nbsp;';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_cattle_26.png')) {
			$outPut .= ''.htmlentities($myrow['num_cattle_26']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_cattle_26.png" alt="" border="0"  width="50" height="50">
			';}$outPut .= '&nbsp;';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_cattle_27.png')) {
			$outPut .= ''.htmlentities($myrow['num_cattle_27']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_cattle_27.png" alt="" border="0"  width="50" height="50">
			';}$outPut .= '&nbsp;';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_cattle_28.png')) {
			$outPut .= ''.htmlentities($myrow['num_cattle_28']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_cattle_28.png" alt="" border="0"  width="50" height="50">
			';}$outPut .= '&nbsp;';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_cattle_29.png')) {
			$outPut .= ''.htmlentities($myrow['num_cattle_29']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_cattle_29.png" alt="" border="0"  width="50" height="50">
			';}$outPut .= '&nbsp;';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_cattle_30.png')) {
			$outPut .= ''.htmlentities($myrow['num_cattle_30']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_cattle_30.png" alt="" border="0"  width="50" height="50">
			';}$outPut .= '&nbsp;';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_cattle_31.png')) {
			$outPut .= ''.htmlentities($myrow['num_cattle_31']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_cattle_31.png" alt="" border="0"  width="50" height="50">
			';}$outPut .= '&nbsp;';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_cattle_32.png')) {
			$outPut .= ''.htmlentities($myrow['num_cattle_32']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_cattle_32.png" alt="" border="0"  width="50" height="50">
			';}$outPut .= '&nbsp;';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_cattle_33.png')) {
			$outPut .= ''.htmlentities($myrow['num_cattle_33']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_cattle_33.png" alt="" border="0"  width="50" height="50">
			';}$outPut .= '&nbsp;';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_cattle_34.png')) {
			$outPut .= ''.htmlentities($myrow['num_cattle_34']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_cattle_34.png" alt="" border="0"  width="50" height="50">
			';}$outPut .= '&nbsp;';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_cattle_35.png')) {
			$outPut .= ''.htmlentities($myrow['num_cattle_35']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_cattle_35.png" alt="" border="0"  width="50" height="50">
			';}$outPut .= '&nbsp;';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_cattle_36.png')) {
			$outPut .= ''.htmlentities($myrow['num_cattle_36']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_cattle_36.png" alt="" border="0"  width="50" height="50">
			';}$outPut .= '&nbsp;';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_cattle_37.png')) {
			$outPut .= ''.htmlentities($myrow['num_cattle_37']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_cattle_37.png" alt="" border="0"  width="50" height="50">
			';}$outPut .= '&nbsp;';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_cattle_38.png')) {
			$outPut .= ''.htmlentities($myrow['num_cattle_38']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_cattle_38.png" alt="" border="0"  width="50" height="50">
			';}$outPut .= '&nbsp;';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_cattle_39.png')) {
			$outPut .= ''.htmlentities($myrow['num_cattle_39']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_cattle_39.png" alt="" border="0"  width="50" height="50">
			';}$outPut .= '&nbsp;';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_cattle_40.png')) {
			$outPut .= ''.htmlentities($myrow['num_cattle_40']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_cattle_40.png" alt="" border="0"  width="50" height="50">
			';}$outPut .= '&nbsp;';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_cattle_41.png')) {
			$outPut .= ''.htmlentities($myrow['num_cattle_41']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_cattle_41.png" alt="" border="0"  width="50" height="50">
			';}$outPut .= '&nbsp;';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_cattle_42.png')) {
			$outPut .= ''.htmlentities($myrow['num_cattle_42']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_cattle_42.png" alt="" border="0"  width="50" height="50">
			';}$outPut .= '&nbsp;';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_cattle_43.png')) {
			$outPut .= ''.htmlentities($myrow['num_cattle_43']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_cattle_43.png" alt="" border="0"  width="50" height="50">
			';}$outPut .= '&nbsp;';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_cattle_44.png')) {
			$outPut .= ''.htmlentities($myrow['num_cattle_44']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_cattle_44.png" alt="" border="0"  width="50" height="50">
			';}$outPut .= '&nbsp;';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_cattle_45.png')) {
			$outPut .= ''.htmlentities($myrow['num_cattle_45']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_cattle_45.png" alt="" border="0"  width="50" height="50">
			';}$outPut .= '&nbsp;';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_cattle_46.png')) {
			$outPut .= ''.htmlentities($myrow['num_cattle_46']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_cattle_46.png" alt="" border="0"  width="50" height="50">
			';}$outPut .= '&nbsp;';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_cattle_47.png')) {
			$outPut .= ''.htmlentities($myrow['num_cattle_47']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_cattle_47.png" alt="" border="0"  width="50" height="50">
			';}$outPut .= '&nbsp;';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_cattle_48.png')) {
			$outPut .= ''.htmlentities($myrow['num_cattle_48']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_cattle_48.png" alt="" border="0"  width="50" height="50">
			';}$outPut .= '&nbsp;';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_cattle_49.png')) {
			$outPut .= ''.htmlentities($myrow['num_cattle_49']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_cattle_49.png" alt="" border="0"  width="50" height="50">
			';}$outPut .= '&nbsp;';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_cattle_50.png')) {
			$outPut .= ''.htmlentities($myrow['num_cattle_50']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_cattle_50.png" alt="" border="0"  width="50" height="50">
			';}$outPut .= '&nbsp;';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_cattle_51.png')) {
			$outPut .= ''.htmlentities($myrow['num_cattle_51']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_cattle_51.png" alt="" border="0"  width="50" height="50">
			';}$outPut .= '&nbsp;';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_cattle_52.png')) {
			$outPut .= ''.htmlentities($myrow['num_cattle_52']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_cattle_52.png" alt="" border="0"  width="50" height="50">
			';}$outPut .= '&nbsp;';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_cattle_53.png')) {
			$outPut .= ''.htmlentities($myrow['num_cattle_53']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_cattle_53.png" alt="" border="0"  width="50" height="50">
			';}$outPut .= '&nbsp;';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_cattle_54.png')) {
			$outPut .= ''.htmlentities($myrow['num_cattle_54']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_cattle_54.png" alt="" border="0"  width="50" height="50">
			';}$outPut .= '&nbsp;';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_cattle_55.png')) {
			$outPut .= ''.htmlentities($myrow['num_cattle_55']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_cattle_55.png" alt="" border="0"  width="50" height="50">
			';}$outPut .= '&nbsp;';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_cattle_56.png')) {
			$outPut .= ''.htmlentities($myrow['num_cattle_56']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_cattle_56.png" alt="" border="0"  width="50" height="50">
			';}$outPut .= '&nbsp;';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_cattle_57.png')) {
			$outPut .= ''.htmlentities($myrow['num_cattle_57']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_cattle_57.png" alt="" border="0"  width="50" height="50">
			';}$outPut .= '&nbsp;';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_cattle_58.png')) {
			$outPut .= ''.htmlentities($myrow['num_cattle_58']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_cattle_58.png" alt="" border="0"  width="50" height="50">
			';}$outPut .= '&nbsp;';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_cattle_59.png')) {
			$outPut .= ''.htmlentities($myrow['num_cattle_59']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_cattle_59.png" alt="" border="0"  width="50" height="50">
			';}$outPut .= '&nbsp;';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_cattle_60.png')) {
			$outPut .= ''.htmlentities($myrow['num_cattle_60']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_cattle_60.png" alt="" border="0"  width="50" height="50">
			';}$outPut .= '
		    </td>
		   </tr>
		   <tr>
		    <td valign="top"><u><b>Brand Board Fees</b></u></td>
		    <td colspan="1" valign="top">&nbsp;</td>
		    <td colspan="4" rowspan="11" valign="top">Proof of Ownership and Other Inspection Notes:<br>
		    '.htmlentities($myrow['inspection_notes']).'</td>
		   </tr>
		   <tr>
		    <td valign="top">Inspection Fee/Minimum Fee</td>
		    <td colspan="1" valign="top">$ '.htmlentities($myrow['cattle_minimum_fee']).'</td>
		   </tr>
		   <tr>
		    <td valign="top">Service Charge</td>
		    <td colspan="1" valign="top">$ '.htmlentities($myrow['cattle_service_charge_fee']).'</td>
		   </tr>
		   <tr>
		    <td valign="top"><u><b>Promotional Fees</b></u></td>
		    <td colspan="1" valign="top">&nbsp;</td>
		   </tr>
		   <tr>
		    <td valign="top">Beef Council</td>
		    <td colspan="1" valign="top">$ '.htmlentities($myrow['cattle_beef_council_fee']).'</td>
		   </tr>
		   <tr>
		    <td valign="top"><b>TOTAL FEES DUE</b></td>
		    <td colspan="1" valign="top">$ '.htmlentities($myrow['total_due_fee']).'</td>
		   </tr>
		   <tr>
		    <td valign="top"><font size="1">Paid: '.htmlentities($myrow['paid_in_full']).'</font></td>
		    <td colspan="1" valign="top"><font size="1">'.htmlentities($myrow['payment_method']).'</font></td>
		   </tr>
		   <tr>
		    <td colspan="6"><font size="2">This is to certify that I, Colorado Brand
		    Inspector, have this day inspected, according to law, above described
		    livestock. NOTE: If valid transaction, bill of sale portion is required to
		    be completed and signed properly.</font><br>
		    <font size="1">Ref 1973, CRS 35-54-103, State of Colorado, County of
		    '.htmlentities($myrow['clss_county_owner']).', '.htmlentities($myrow['cert_dateShow']).'</font><br>
		    <font size="1">This is to certify that I, the undersigned seller, have this
		    day sold and delivered to the undersigned buyer certain livestock described
		    above. The title I hereby transfer and guarantee to defend against all
		    lawful claims.</font></td>
		   </tr>
		   <tr>
		   ';
			// check for each image file individually
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-inspector.png')) {
		$outPut .= '
		<table border="0" cellpadding="5" cellspacing="0" style="border-collapse: collapse">
		  	<tr>
			<td align="left" valign="top"><font size="1">Inspector Signature:</font><p><img src="drawings/'.$myrow['cert_serial_num'].'-inspector.png" alt="" border="0"></td>
		';
			}
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-owner.png')) {
		$outPut .= '
			<td align="left" valign="top"><font size="1">Owner Signature:</font><p><img src="drawings/'.$myrow['cert_serial_num'].'-owner.png" alt="" border="0"></td>
		';
			}
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-buyer.png')) {
		$outPut .= '
			<td align="left" valign="top"><font size="1">Buyer Signature:</font><p><img src="drawings/'.$myrow['cert_serial_num'].'-buyer.png" alt="" border="0"></td>
			</tr>
		</table>
		</tr>
		';
			}
		$outPut .= '
		</table>
		</body>
		</html>
		';
		$dompdf = new DOMPDF();
		$dompdf->load_html($outPut);
		$dompdf->render();
		$dompdf->stream("".htmlentities($myrow['cert_series']).htmlentities($myrow['cert_insp_num']).htmlentities($myrow['cert_serial_num'])."_stock_certificate.pdf");
	}
}
?>
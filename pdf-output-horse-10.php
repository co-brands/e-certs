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
		    <td><b>No. Horses </b>'.htmlentities($myrow['num_horses']).'</td>
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
		    ( ) -30 Days</font></td>
		  </tr>
		</table>
		</td>
		   </tr>
		   <tr>
		    <td colspan="5" valign="top"><b>Sold to: </b>'.htmlentities($myrow['clss_name_buyer']).', '.htmlentities($myrow['clss_city_buyer']).', 
		    '.htmlentities($myrow['clss_state_buyer']).', COIN: '.htmlentities($myrow['clss_coin_buyer']).'</td>
		   </tr>
		   <tr>
		    <td colspan="3"><b>No., Description, Brand</b></td>
		    <td colspan="3"><b>No., Description, Brand</b></td>
		   </tr>
		   <tr>
		    <td colspan="3" valign="top">';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_horse_01.png')) {
			$outPut .= '
			'.htmlentities($myrow['num_horse_01']).'&nbsp;'.htmlentities($myrow['horse_breed_01']).'&nbsp;'
		    .htmlentities($myrow['horse_color_01']).'&nbsp;'.htmlentities($myrow['horse_gender_01']).'&nbsp;'
		    .htmlentities($myrow['horse_marking_eyes_01']).'&nbsp;'.htmlentities($myrow['horse_marking_head_01']).'&nbsp;'
			.htmlentities($myrow['horse_marking_all_01']).'&nbsp;'.htmlentities($myrow['horse_marking_bf_01']).'&nbsp;'
			.htmlentities($myrow['horse_marking_lf_01']).'&nbsp;'.htmlentities($myrow['horse_marking_rf_01']).'&nbsp;'
			.htmlentities($myrow['horse_marking_lh_01']).'&nbsp;'.htmlentities($myrow['horse_marking_rh_01']).'&nbsp;'
			.htmlentities($myrow['horse_marking_bh_01']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_horse_01.png" alt="" border="0"  width="50" height="50">
			';
			}
			$outPut .= '<br>
			';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_horse_02.png')) {
			$outPut .= '
			'.htmlentities($myrow['num_horse_02']).'&nbsp;'.htmlentities($myrow['horse_breed_02']).'&nbsp;'
			.htmlentities($myrow['horse_color_02']).'&nbsp;'.htmlentities($myrow['horse_gender_02']).'&nbsp;'
			.htmlentities($myrow['horse_marking_eyes_02']).'&nbsp;'.htmlentities($myrow['horse_marking_head_02']).'&nbsp;'
			.htmlentities($myrow['horse_marking_all_02']).'&nbsp;'.htmlentities($myrow['horse_marking_bf_02']).'&nbsp;'
			.htmlentities($myrow['horse_marking_lf_02']).'&nbsp;'.htmlentities($myrow['horse_marking_rf_02']).'&nbsp;'
			.htmlentities($myrow['horse_marking_lh_02']).'&nbsp;'.htmlentities($myrow['horse_marking_rh_02']).'&nbsp;'
			.htmlentities($myrow['horse_marking_bh_02']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_horse_02.png" alt="" border="0"  width="50" height="50">
			';
			}
			$outPut .= '<br>
			';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_horse_03.png')) {
			$outPut .= '
			'.htmlentities($myrow['num_horse_03']).'&nbsp;'.htmlentities($myrow['horse_breed_03']).'&nbsp;'
			.htmlentities($myrow['horse_color_03']).'&nbsp;'.htmlentities($myrow['horse_gender_03']).'&nbsp;'
			.htmlentities($myrow['horse_marking_eyes_03']).'&nbsp;'.htmlentities($myrow['horse_marking_head_03']).'&nbsp;'
			.htmlentities($myrow['horse_marking_all_03']).'&nbsp;'.htmlentities($myrow['horse_marking_bf_03']).'&nbsp;'
			.htmlentities($myrow['horse_marking_lf_03']).'&nbsp;'.htmlentities($myrow['horse_marking_rf_03']).'&nbsp;'
			.htmlentities($myrow['horse_marking_lh_03']).'&nbsp;'.htmlentities($myrow['horse_marking_rh_03']).'&nbsp;'
			.htmlentities($myrow['horse_marking_bh_03']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_horse_03.png" alt="" border="0"  width="50" height="50">
			';
			}
			$outPut .= '<br>
			';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_horse_04.png')) {
			$outPut .= '
			'.htmlentities($myrow['num_horse_04']).'&nbsp;'.htmlentities($myrow['horse_breed_04']).'&nbsp;'
			.htmlentities($myrow['horse_color_04']).'&nbsp;'.htmlentities($myrow['horse_gender_04']).'&nbsp;'
			.htmlentities($myrow['horse_marking_eyes_04']).'&nbsp;'.htmlentities($myrow['horse_marking_head_04']).'&nbsp;'
			.htmlentities($myrow['horse_marking_all_04']).'&nbsp;'.htmlentities($myrow['horse_marking_bf_04']).'&nbsp;'
			.htmlentities($myrow['horse_marking_lf_04']).'&nbsp;'.htmlentities($myrow['horse_marking_rf_04']).'&nbsp;'
			.htmlentities($myrow['horse_marking_lh_04']).'&nbsp;'.htmlentities($myrow['horse_marking_rh_04']).'&nbsp;'
			.htmlentities($myrow['horse_marking_bh_04']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_horse_04.png" alt="" border="0"  width="50" height="50">
			';
			}
			$outPut .= '<br>
			';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_horse_05.png')) {
			$outPut .= '
			'.htmlentities($myrow['num_horse_05']).'&nbsp;'.htmlentities($myrow['horse_breed_05']).'&nbsp;'
			.htmlentities($myrow['horse_color_05']).'&nbsp;'.htmlentities($myrow['horse_gender_05']).'&nbsp;'
			.htmlentities($myrow['horse_marking_eyes_05']).'&nbsp;'.htmlentities($myrow['horse_marking_head_05']).'&nbsp;'
			.htmlentities($myrow['horse_marking_all_05']).'&nbsp;'.htmlentities($myrow['horse_marking_bf_05']).'&nbsp;'
			.htmlentities($myrow['horse_marking_lf_05']).'&nbsp;'.htmlentities($myrow['horse_marking_rf_05']).'&nbsp;'
			.htmlentities($myrow['horse_marking_lh_05']).'&nbsp;'.htmlentities($myrow['horse_marking_rh_05']).'&nbsp;'
			.htmlentities($myrow['horse_marking_bh_05']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_horse_05.png" alt="" border="0"  width="50" height="50">
			';
			}
			$outPut .= '
			</td>
		    <td colspan="3" valign="top">
		    ';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_horse_06.png')) {
			$outPut .= '
			'.htmlentities($myrow['num_horse_06']).'&nbsp;'.htmlentities($myrow['horse_breed_06']).'&nbsp;'
			.htmlentities($myrow['horse_color_06']).'&nbsp;'.htmlentities($myrow['horse_gender_06']).'&nbsp;'
			.htmlentities($myrow['horse_marking_eyes_06']).'&nbsp;'.htmlentities($myrow['horse_marking_head_06']).'&nbsp;'
			.htmlentities($myrow['horse_marking_all_06']).'&nbsp;'.htmlentities($myrow['horse_marking_bf_06']).'&nbsp;'
			.htmlentities($myrow['horse_marking_lf_06']).'&nbsp;'.htmlentities($myrow['horse_marking_rf_06']).'&nbsp;'
			.htmlentities($myrow['horse_marking_lh_06']).'&nbsp;'.htmlentities($myrow['horse_marking_rh_06']).'&nbsp;'
			.htmlentities($myrow['horse_marking_bh_06']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_horse_06.png" alt="" border="0"  width="50" height="50">
			';
			}
			$outPut .= '<br>
			';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_horse_07.png')) {
			$outPut .= '
			'.htmlentities($myrow['num_horse_07']).'&nbsp;'.htmlentities($myrow['horse_breed_07']).'&nbsp;'
			.htmlentities($myrow['horse_color_07']).'&nbsp;'.htmlentities($myrow['horse_gender_07']).'&nbsp;'
			.htmlentities($myrow['horse_marking_eyes_07']).'&nbsp;'.htmlentities($myrow['horse_marking_head_07']).'&nbsp;'
			.htmlentities($myrow['horse_marking_all_07']).'&nbsp;'.htmlentities($myrow['horse_marking_bf_07']).'&nbsp;'
			.htmlentities($myrow['horse_marking_lf_07']).'&nbsp;'.htmlentities($myrow['horse_marking_rf_07']).'&nbsp;'
			.htmlentities($myrow['horse_marking_lh_07']).'&nbsp;'.htmlentities($myrow['horse_marking_rh_07']).'&nbsp;'
			.htmlentities($myrow['horse_marking_bh_07']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_horse_07.png" alt="" border="0"  width="50" height="50">
			';
			}
			$outPut .= '<br>
			';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_horse_08.png')) {
			$outPut .= '
			'.htmlentities($myrow['num_horse_08']).'&nbsp;'.htmlentities($myrow['horse_breed_08']).'&nbsp;'
			.htmlentities($myrow['horse_color_08']).'&nbsp;'.htmlentities($myrow['horse_gender_08']).'&nbsp;'
			.htmlentities($myrow['horse_marking_eyes_08']).'&nbsp;'.htmlentities($myrow['horse_marking_head_08']).'&nbsp;'
			.htmlentities($myrow['horse_marking_all_08']).'&nbsp;'.htmlentities($myrow['horse_marking_bf_08']).'&nbsp;'
			.htmlentities($myrow['horse_marking_lf_08']).'&nbsp;'.htmlentities($myrow['horse_marking_rf_08']).'&nbsp;'
			.htmlentities($myrow['horse_marking_lh_08']).'&nbsp;'.htmlentities($myrow['horse_marking_rh_08']).'&nbsp;'
			.htmlentities($myrow['horse_marking_bh_08']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_horse_08.png" alt="" border="0"  width="50" height="50">
			';
			}
			$outPut .= '<br>
			';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_horse_09.png')) {
			$outPut .= '
			'.htmlentities($myrow['num_horse_09']).'&nbsp;'.htmlentities($myrow['horse_breed_09']).'&nbsp;'
			.htmlentities($myrow['horse_color_09']).'&nbsp;'.htmlentities($myrow['horse_gender_09']).'&nbsp;'
			.htmlentities($myrow['horse_marking_eyes_09']).'&nbsp;'.htmlentities($myrow['horse_marking_head_09']).'&nbsp;'
			.htmlentities($myrow['horse_marking_all_09']).'&nbsp;'.htmlentities($myrow['horse_marking_bf_09']).'&nbsp;'
			.htmlentities($myrow['horse_marking_lf_09']).'&nbsp;'.htmlentities($myrow['horse_marking_rf_09']).'&nbsp;'
			.htmlentities($myrow['horse_marking_lh_09']).'&nbsp;'.htmlentities($myrow['horse_marking_rh_09']).'&nbsp;'
			.htmlentities($myrow['horse_marking_bh_09']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_horse_09.png" alt="" border="0"  width="50" height="50">
			';
			}
			$outPut .= '<br>
			';
			if (file_exists('drawings/'.$myrow['cert_serial_num'].'-brand_horse_10.png')) {
			$outPut .= '
			'.htmlentities($myrow['num_horse_10']).'&nbsp;'.htmlentities($myrow['horse_breed_10']).'&nbsp;'
			.htmlentities($myrow['horse_color_10']).'&nbsp;'.htmlentities($myrow['horse_gender_10']).'&nbsp;'
			.htmlentities($myrow['horse_marking_eyes_10']).'&nbsp;'.htmlentities($myrow['horse_marking_head_10']).'&nbsp;'
			.htmlentities($myrow['horse_marking_all_10']).'&nbsp;'.htmlentities($myrow['horse_marking_bf_10']).'&nbsp;'
			.htmlentities($myrow['horse_marking_lf_10']).'&nbsp;'.htmlentities($myrow['horse_marking_rf_10']).'&nbsp;'
			.htmlentities($myrow['horse_marking_lh_10']).'&nbsp;'.htmlentities($myrow['horse_marking_rh_10']).'&nbsp;'
			.htmlentities($myrow['horse_marking_bh_10']).'&nbsp;
			<img src="drawings/'.$myrow['cert_serial_num'].'-brand_horse_10.png" alt="" border="0"  width="50" height="50">
			';
			}
			$outPut .= '
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
		    <td colspan="1" valign="top">$ '.htmlentities($myrow['horse_minimum_fee']).'</td>
		   </tr>
		   <tr>
		    <td valign="top">Service Charge</td>
		    <td colspan="1" valign="top">$ '.htmlentities($myrow['horse_service_charge_fee']).'</td>
		   </tr>
		   <tr>
		    <td valign="top">No Brand Calf Mileage</td>
		    <td colspan="1" valign="top">$ </td>
		   </tr>
		   <tr>
		    <td valign="top">Rodeo Cattle Permit</td>
		    <td colspan="1" valign="top">$ </td>
		   </tr>
		   <tr>
		    <td valign="top">Horse Permit</td>
		    <td colspan="1" valign="top">$ '.htmlentities($myrow['horse_permit_fee']).'</td>
		   </tr>
		   <tr>
		    <td valign="top"><u><b>Promotional Fees</b></u></td>
		    <td colspan="1" valign="top">&nbsp;</td>
		   </tr>
		   <tr>
		    <td valign="top">Beef Council</td>
		    <td colspan="1" valign="top">$ </td>
		   </tr>
		   <tr>
		    <td valign="top">Horse Board</td>
		    <td colspan="1" valign="top">$ '.htmlentities($myrow['horse_board_fee']).'</td>
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
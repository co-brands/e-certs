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

	<script>
	$(function() {
		$("#accordion").accordion();
		$("#tabs").tabs();
		$("#sigPad").signaturePad();
	});
	</script>
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
//$cert_date = localtime();
$cattle_service_charge_fee = $cat_num * .53;

//end calculations
$sql = "INSERT INTO certificates ".
       "(num_deer_elk, cert_date, clss_coin_owner, clss_name_owner, clss_address_owner,
clss_city_owner, clss_state_owner, clss_zip_owner, clss_county_owner, clss_coin_buyer,
clss_name_buyer, clss_address_buyer, clss_city_buyer, clss_state_buyer, clss_zip_buyer,
clss_county_buyer, total_due_fee, paid_in_full, payment_method,
brand, brand_description, inspection_notes, signature_movement_auth, signature_inspector,
signature_owner, signature_buyer, signature_witness) ".
       "VALUES('$num_deer_elk','$cert_date',
	   '$clss_coin_owner','$clss_name_owner','$clss_address_owner','$clss_city_owner','$clss_state_owner',
	   '$clss_zip_owner','$clss_county_owner','$clss_coin_buyer','$clss_name_buyer',
	 '$clss_address_buyer','$clss_city_buyer','$clss_state_buyer','$clss_zip_buyer',
	 '$clss_county_buyer',
	   '$total_due_fee','$paid_in_full','$payment_method','$brand','$brand_description',
	   '$inspection_notes','$signature_movement_auth','$signature_inspector','$signature_owner',
	   '$signature_buyer','$signature_witness')";
mysql_select_db('brands');
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}
//echo "Stock Certificate\n"."<p>";

//select a database to work with
$selected = mysql_select_db("brands",$conn)
  or die("Could not select brands");


// start of results display section
// gets the last stock certificate number from the database; this value will be used to display only the most recent record
$last_id = mysql_query("SELECT cert_serial_num FROM certificates ORDER BY cert_serial_num DESC LIMIT 1");
while($info = mysql_fetch_array( $last_id )){
echo "<p>last brand cert number:".$new = $info['cert_serial_num'];
echo "<p>";
}
//execute the SQL query and return records
$result = mysql_query("SELECT * FROM certificates WHERE cert_serial_num = $new");

//fetch the data from the database
while ($row = mysql_fetch_array($result)) {
echo "Inspector Number: " . $row['cert_insp_num'];
echo "<br>Number of Deer/Elk: " . $row['num_deer_elk'];
echo "<br>Certificate Date: " . date('m/d/Y',localtime($row['cert_date']));
//echo "<br>Certificate Date: " . $row['cert_date'];
//echo "<br>Certificate Date: " . date('F/j/Y',strtotime($row['cert_date']));
//echo "<br>Certificate Date: " . $row['cert_date'];
echo "<br>Owner COIN: " . $row['clss_coin_owner'];
echo "<br>Owner Name: " . $row['clss_name_owner'];
echo "<br>Owner Address: " . $row['clss_address_owner'];
echo "<br>Owner City: " . $row['clss_city_owner'];
echo "<br>Owner State: " . $row['clss_state_owner'];
echo "<br>Owner Zip: " . $row['clss_zip_owner'];
echo "<br>Owner County: " . $row['clss_county_owner'];
echo "<br>Buyer COIN: " . $row['clss_coin_seller'];
echo "<br>Buyer Name: " . $row['clss_name_seller'];
echo "<br>Buyer Address: " . $row['clss_address_seller'];
echo "<br>Buyer City: " . $row['clss_city_seller'];
echo "<br>Buyer State: " . $row['clss_state_seller'];
echo "<br>Buyer Zip: " . $row['clss_zip_seller'];
echo "<br>Buyer County: " . $row['clss_county_seller'];
echo "<br>Total Fees Due: " . $row['total_due_fee'];
echo "<br>Paid In Full: " . $row['paid_in_full'];
echo "<br>Payment Method: " . $row['payment_method'];
echo "<br>Brand: " . $row['brand'];
echo "<br>Brand Description: " . $row['brand_description'];
echo "<br>Inspection Notes: " . $row['inspection_notes'];
echo "<br>Inspector Signature: " . $row['signature_inspector'];
echo "<br>Owner Signature: " . $row['signature_owner'];
echo "<br>Buyer Signature: " . $row['signature_buyer'];

echo "<p>";
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
		<li><a href="#tabs-5">Elk/Deer</a></li>
		<li><a href="#tabs-6">Brand</a></li>
		<li><a href="#tabs-7">Payment</a></li>
		<li><a href="#tabs-8">Signatures</a></li>
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
	<div id="tabs-5"> <!-- elk/deer -->
		<p>xxx</p>
	</div>
	<div id="tabs-6"> <!-- brand -->
brand: <input name="brand" type="file" id="brand"><br>
brand_description: <input name="brand_description" type="text" id="brand_description"><br>
	</div>
	<div id="tabs-7"> <!-- payment -->
Paid in full*: <select size="1" name="paid_in_full">
<option value="1">Yes</option>
<option value="0">No</option>
</select><br>
Payment Method*: <select size="1" name="payment_method">
<option value="Cash">Cash</option>
<option value="Check">Check</option>
<option value="TBD">To Be Collected</option>
</select><br>
Inspection Notes: <textarea rows="5" cols="50" name="inspection_notes" id="inspection_notes" maxlength="200"></textarea><br>
<script type="text/javascript">
	$(document).ready(function($){
		$().maxlength();
	});
</script>
	</div>
	<div id="tabs-8"> <!-- signature -->
signature_movement_auth: <input name="signature_movement_auth" type="file" id="signature_movement_auth"><br>
signature_inspector: <input name="signature_inspector" type="file" id="signature_inspector"><br>
signature_owner: <input name="signature_owner" type="file" id="signature_owner"><br>
signature_buyer: <input name="signature_buyer" type="file" id="signature_buyer"><br>
signature_witness: <input name="signature_witness" type="file" id="signature_witness">
	</div>
</div>
<p>
<input name="add" type="submit" id="add" value="Create Certificate">
</form>
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

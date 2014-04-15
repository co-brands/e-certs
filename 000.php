<?php
$dbhost = 'himblauc.ipowermysql.com';
$dbuser = 'brands';
$dbpass = 'brands';
$conn = mysql_connect($dbhost, $dbuser, $dbpass);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}

mysql_select_db('brands');
$retval = mysql_query( $sql, $conn );

if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}

//select a database to work with
$selected = mysql_select_db("brands", $conn)
  or die("Could not select brands");

// start of results display section
// gets the last stock certificate number from the database; this value will be used to display only the most recent record
$last_id = mysql_query("SELECT cert_serial_num FROM certificates ORDER BY cert_serial_num DESC LIMIT 1");
while($info = mysql_fetch_array( $last_id )){
$new = $info['cert_serial_num'];
}
//execute the SQL query and return records
$result = mysql_query("SELECT * FROM certificates WHERE cert_serial_num = $new");

{
	echo $row['cert_series']. $row['cert_insp_num'] . $new;
}

mysql_free_result($retval);
echo "zzzzz";
//close the connection
mysql_close($conn);
?>
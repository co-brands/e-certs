<html>
<head>
<title>Search data</title>
</head>
<body>
<table>
  <tr>
    <td align="center">EMPLOYEES DATA</td>
  </tr>
  <tr>
    <td>
      <table border="1">
      <tr>
        <td>NAME</td>
        <td>EMPLOYEES<br>NUMBER</td>
        <td>ADDRESS</td>
      </tr>
<?php
$dbhost = 'himblauc.ipowermysql.com';
$dbuser = 'brands';
$dbpass = 'brands';
$conn = mysql_connect($dbhost, $dbuser, $dbpass);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}

mysql_select_db("brands",$conn);
				
$order = "SELECT * FROM test ORDER BY counter DESC LIMIT 1";
	
$result = mysql_query($order);	
				
while($data = mysql_fetch_row($result)){
  echo $data['counter'];
  echo "<br>Counter: " . $row['counter'];
}
?>
    </table>
  </td>
</tr>
</table>
</body>
</html>
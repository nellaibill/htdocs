<?php
$xItemName = $_GET['itemname'];

$xReturnValue=0;
$con = @mysql_connect ( "localhost", "root", "" ) or die ( mysql_error () );
mysql_select_db ( "barani" ) or die ( mysql_error () );
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}
$sql="SELECT * FROM m_item WHERE itemname = '".$xItemName."'";

//echo $sql;
$query = mysql_query ($sql);
while ( $row = mysql_fetch_array ( $query) ) {
	$xReturnValue = $row ['itemamount'];
}
echo $xReturnValue;
mysql_close($con);

?>


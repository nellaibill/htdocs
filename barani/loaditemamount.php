<?php
$xItemName = $_GET['itemname'];

$xReturnValue=0;
$con = mysqli_connect ( "localhost", "root", "", "barani" );
if (!$con) {
    die('Could not connect: ' . mysqli_connect_error());
}
$sql="SELECT * FROM m_item WHERE itemname = '".$xItemName."'";

//echo $sql;
$query = mysqli_query ($con, $sql);
while ( $row = mysqli_fetch_array ( $query) ) {
	$xReturnValue = $row ['itemamount'];
}
echo $xReturnValue;
mysqli_close($con);

?>


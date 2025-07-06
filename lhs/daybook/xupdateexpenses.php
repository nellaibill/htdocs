<?php
$id=$_GET['value'];
$name=$_GET['name'];
$xDate=$_GET['date'];

require_once('config1.php');

$sql1 = "UPDATE xexpenses SET $name='$id' WHERE date='$xDate'";


if (mysqli_query($con, $sql1)) {
    echo "Record updated successfully";
	echo 'confirm("Not Updated!")';
	header ( "Location: xeditexpenses.php?date=".$xDate );
	

} else {
    echo "Error updating record: " . mysqli_error($con);
}

?>

<?php
$id=$_GET['value'];
$name=$_GET['name'];
$xDate=$_GET['date'];

require_once('config1.php');

$sql = "UPDATE expenses SET $name='$id' WHERE date='$xDate'";
$sql1 = "UPDATE xexpenses SET $name='$id' WHERE date='$xDate'";

if (mysqli_query($con, $sql)) {
    echo "Record updated successfully";
	echo 'confirm("Not Updated!")';
	header ( "Location: editexpenses.php?date=".$xDate );
	

} else {
    echo "Error updating record: " . mysqli_error($con);
}
if (mysqli_query($con, $sql1)) {
    echo "Record updated successfully";
	echo 'confirm("Not Updated!")';
	header ( "Location: editexpenses.php?date=".$xDate );
	

} else {
    echo "Error updating record: " . mysqli_error($con);
}

?>

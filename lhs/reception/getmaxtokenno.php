<?php
$xDoctorName = $_GET['doctorname'];
$xDate= $_GET['date'];
$xCaseType= $_GET['casetype'];
$xNoonType= $_GET['noontype'];
$xMode= $_GET['mode'];
$xReturnValue=0;
$con = mysqli_connect('localhost','lakshmih_admin','admin','lakshmih_daybook');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}
if($xMode!='F')
{
$sql="SELECT  CASE WHEN max(tokenno)IS NULL OR max(tokenno)= '' 
       THEN '1' 
       ELSE max(tokenno)+1 END AS tokenno
 FROM outpatientdetails WHERE doctorname= '".$xDoctorName."' 
 and date='".$xDate."' and noontype='".$xNoonType."' and casetype='".$xCaseType."'";

//echo $sql;
$result=mysqli_query($con,$sql);
while($row = mysqli_fetch_array($result)) {
$xReturnValue= $row['tokenno'] ;
}
echo $xReturnValue;
mysqli_close($con);
}
?>
<?php
require_once('config1.php');

$xIp= !empty($_POST[ip]) ? "$_POST[ip]" :0;
$xOpl= !empty($_POST[opl]) ? "$_POST[opl]" :0;
$xOpm= !empty($_POST[opm]) ? "$_POST[opm]" :0;
$xLab= !empty($_POST[lab]) ? "$_POST[lab]" :0;
$xScan= !empty($_POST[scan]) ? "$_POST[scan]" :0;
$xXray= !empty($_POST[xray]) ? "$_POST[xray]" :0;
$xEcg= !empty($_POST[ecg]) ? "$_POST[ecg]" :0;
$xOthers= !empty($_POST[others]) ? "$_POST[others]" :0;




$insert="INSERT INTO income (date,ip,opl,opm,lab,scan,xray,ecg,others)
VALUES
('$_POST[date]',$xIp,$xOpl,$xOpm,$xLab,$xScan,$xXray,$xEcg,$xOthers)";


$insertforxincome="INSERT INTO xincome (date,ip,opl,opm,lab,scan,xray,ecg,others)
VALUES
('$_POST[date]',$xIp,$xOpl,$xOpm,$xLab,$xScan,$xXray,$xEcg,$xOthers)";


$con1=mysqli_connect("localhost","lakshmih_admin","admin","lakshmih_daybook");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$sql="SELECT * FROM income  WHERE date='$_POST[date]'";
if ($result=mysqli_query($con1,$sql))
  {
  // Return the number of rows in result set
  $rowcount=mysqli_num_rows($result);
if($rowcount > 0)
{
echo '<script language="javascript">';
echo 'alert("Sorry-Already Entered")';
echo '</script>';
}
else {
$con->query($insert);
$con->query($insertforxincome);
echo '<script language="javascript">';
echo 'alert("Records Inserted")';
echo '</script>';
}
  // Free result set
  mysqli_free_result($result);
  }

mysqli_close($con1);
require_once('index.php');

?>
<?php
$xEbNo= $_GET['ebno'];
$xReturnValue=0;
$con = mysqli_connect('localhost','lakshmih_admin','admin','lakshmih_daybook');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}
if($xMode!='F')
{
//Here txno with refers to ebno
$xQry="SELECT  newreading  FROM t_ebdetails_new WHERE ebno= '".$xEbNo."' order by txno desc limit 1";
//echo $xQry;
$result=mysqli_query($con,$xQry);
while($row = mysqli_fetch_array($result)) {
$xReturnValue= $row['newreading'] ;
}
echo $xReturnValue;
mysqli_close($con);
}
?>
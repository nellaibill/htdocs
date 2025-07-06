<?php
include('globalfile.php');
$GLOBALS ['xCurrentDate']=date('Y-m-d');
$xDoctorName=$GLOBALS ['xDoctorName'];
if (empty ( $_POST ['fromdate'] )) {
		$GLOBALS ['xFromDate']=$GLOBALS ['xCurrentDate'];
	} else {
		$GLOBALS ['xFromDate']=$_POST['fromdate'];
	}
if (empty ( $_POST ['todate'] )) {
		$GLOBALS ['xToDate']=$GLOBALS ['xCurrentDate'];
	} else {
		$GLOBALS ['xToDate']=$_POST['todate'];
	}
$xNoonType=$GLOBALS ['xNoonType'];
$xCaseType1=$GLOBALS ['xCaseType1'];
$xDoctorName=$GLOBALS ['xDoctorName'];
$xDoctorNo=$GLOBALS ['xDoctorNo'];
?>
<html>
<title> VIEW - O/P </title>
<div id="divToPrint" >
<div class="panel panel-success">
<div class="panel-heading">
<b><h3 class="panel-title text-center"><?php echo " $xDoctorName O/P Records Generated -- $xNoonType--$xCaseType1 -- FROM $xFromDate TO $xToDate As On ". date("m-d-Y h:i:sa"); ?></h3></b>
</div>
<div class="panel-body">
<div class="container">
<?php
$xSlNo=0;
$xTotalAmount=0;
$xCount=0;
$xQryFilter='';
if($xDoctorNo!="0")
{
$xQryFilter= $xQryFilter. ' ' . "and doctorname='$xDoctorNo'";
}
if($xNoonType!="ALL")
{
$xQryFilter= $xQryFilter. ' ' . "and noontype='$xNoonType'";
}
if($xCaseType1!="ALL")
{
$xQryFilter= $xQryFilter. ' ' . "and casetype1='$xCaseType1'";
}
echo "<table class='table table-hover' border='1' id='lastrow'>
      <thead>
        <tr>
           <th>SL.NO </th>
           <th>PATIENT NAME</th>
           <th> FEES</th>
        </tr>
      </thead>
<tbody>";
require_once('config.php');
$xQry="SELECT txno,tokenno,patientname,fees,casetype,casetype1,date,status,updatedason,0 as orderbit from outpatientdetails WHERE date >= '$xFromDate' AND date<= '$xToDate'  "; 
$xQry.= $xQryFilter. ' ' . "order by date ;";
$result2=mysql_query($xQry);
while ($row = mysql_fetch_array($result2)) {
if($xCheckDate!= $row['date'])
{
$xSlNo=0;
}
    $xCheckDate= $row['date'];
    echo '<tr>';
    echo '<td >' . $xSlNo+=1  . '</td>';
    echo '<td>' . $row['patientname']  . '</td>';
    echo '<td>' . $row['fees']  . '</td>';
    echo '</tr>'; 
$xTotalAmount+=	$row['fees'] ;
$xCount+=1;
 
}

?>	

<tr style='font-weight:bold;'>
<td> GRAND TOTAL </td>
<?php  echo '<td> TOTAL  '. $xCount. ' CASES </td>'; ?>
<?php  echo '<td>' .money_format("%!n", $xTotalAmount)  . '</td>'; ?>

</tbody>
    </table>	</div>
  
</div></div></div>
</body></html>	
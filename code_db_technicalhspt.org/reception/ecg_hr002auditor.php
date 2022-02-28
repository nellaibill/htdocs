<?php
include('globalfile.php');
$GLOBALS ['xCurrentDate']=date('Y-m-d');
/*if($login_session=="admin")
{
$xFromDate=$GLOBALS ['xFromDate'];
$xToDate=$GLOBALS ['xToDate'];
}
else
{
$xFromDate=$GLOBALS ['xCurrentDate'];
$xToDate=$GLOBALS ['xCurrentDate'];
}
*/

//Change As On 16/09/2016 For Auditing

$xFromDate=$GLOBALS ['xFromDate'];
$xToDate=$GLOBALS ['xToDate'];
?>
<html>
<title> VIEW -ECG-XRAYS</title>
<head><link href="bootstrap.css" rel="stylesheet">
<link href="css/reportstyle.css" rel="stylesheet">
</head>
<body>
<div id="divToPrint" >
  <div class="container">
<table class="table table-hover" border="1" id="lastrow">
<thead>
 <tr>
 <th width="5%"> SL.NO</th>
 <th width="20%"> DATE </th>
 <th width="10%">AMOUNT</th>
 </tr>
</thead>
 <tbody>

<?php
require_once('config.php');
$xSlNo=0;
$xTotalAmount=0;
$xQry="SELECT date,SUM(testamount)as testamount,count(txno) as txno  from t_ecgxraybilling WHERE date >= '".$xFromDate."' 
		 AND date<= '".$xToDate."' group by date order by date; "; 
$result2=mysql_query($xQry);
ReportHeader("ECG-XRAY");
while ($row = mysql_fetch_array($result2)) {

echo '<tr style=font-size:25px>';
echo '<td>' . $xSlNo+=1 . '</td>';
echo '<td>' . date('d-M-Y',strtotime($row['date']))  . '</td>';
echo '<td>' . money_format("%!n", $row['testamount']) . '</td>';
echo '</tr>'; 
$xTotalAmount+=	$row['testamount'] ;
$xCount+=$row['txno'];
}

?>	
<tr style=font-size:25px>
<?php  echo '<td></td>'; ?> 
<td> GRAND TOTAL </td>
<?php  echo '<td>' .money_format("%!n", $xTotalAmount)  . '</td>'; ?>
</tbody>


    </table>	
  </div><!-- /container -->
</div>
</body></html>	
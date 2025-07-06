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
<title> VIEW - O/P </title>
<head>
<link href="bootstrap.css" rel="stylesheet">
<link href="css/reportstyle.css" rel="stylesheet">
</head>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
</form>
<body>
<div id="divToPrint" >
    <div class="panel-body">
<?php ReportHeader("Out-Patient"); ?>
<table class="table table-condensed" border="1" id="lastrow">
<thead>
<tr style="font-size:25px">
<th width="10%">DATE </th>
<th width="10%">TOKENS</th>
 <th width="10%"> FEES</th>
 </tr>
  </thead>
 
 
      <tbody>

<?php
$xSlNo=0;
$xTotalAmount=0;
$xCount=0;
require_once('config.php');
$xQry="SELECT date,count(tokenno)as tokenno,sum(fees)as fees  from outpatientdetails  WHERE date >= '$xFromDate' AND date<= '$xToDate' and doctorname!='DR.KUMARAGURU' group by date  order by date"; 
$result2=mysql_query($xQry);
echo '</b>'; 

while ($row = mysql_fetch_array($result2)) {
if($xCheckDate!= $row['date'])
{
$xSlNo=0;
}
$xCheckDate= $row['date'];
  echo '<tr style=font-size:25px>';
  echo '<td>' . date('d-M-Y',strtotime($row['date']))   . '</td>';
    echo '<td>' . $row['tokenno']  . '</td>';
    echo '<td>' . money_format("%!n", $row['fees']) . '</td>';
  echo '</tr>'; 
$xTotalAmount+=	$row['fees'] ;
$xCount+=$row['tokenno'];
	 
}
?>	

<tr style=font-size:25px>
<td> GRAND TOTAL </td>
<?php  echo '<td> TOTAL  '. $xCount. ' CASES </td>'; ?>
<?php  echo '<td>' .money_format("%!n", $xTotalAmount)  . '</td>'; ?>

</tbody>
    </table>	</div>
  
</div>
</body></html>	
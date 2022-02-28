<?php
include('globalfile.php');
$GLOBALS ['xCurrentDate']=date('Y-m-d');
if($login_session=="admin")
{
$xFromDate=$GLOBALS ['xFromDate'];
$xToDate=$GLOBALS ['xToDate'];
}
else
{
$xFromDate=$GLOBALS ['xCurrentDate'];
$xToDate=$GLOBALS ['xCurrentDate'];
}

?>
<html>
<title> VIEW -COLLECTION </title>
<head><link href="bootstrap.css" rel="stylesheet">
<link href="css/reportstyle.css" rel="stylesheet">
</head>
<form action="hr_a_collection.php" method="post">
</form>
<body>
<div id="divToPrint" >
  <div class="container">
<table class="table table-hover" border="1" id="lastrow">
<thead>
 <tr>
 <th width="10%"> SL.NO</th>
 <th width="20%"> DATE </th>
 <th width="10%">EXPENSES</th>
 <th width="10%"> OTHERS</th>
 </tr>
</thead>
 <tbody>

<?php
require_once('config.php');
$total=0;
$xSlNo=0;
$xQry="SELECT txno,date ,advance,receipt,expenses,others,nettotal  from collection WHERE date >= '".$xFromDate."' 
		 AND date<= '".$xToDate."' union all select '','GRAND-TOTAL','','','','',sum(nettotal)  from collection
		 WHERE date >= '".$xFromDate."' 
		 AND date<= '".$xToDate."' order by date ; "; 
$result2=mysql_query($xQry);
ReportHeader("COLLECTION");
while ($row = mysql_fetch_array($result2)) {

if($row['date']=='GRAND-TOTAL')
{
echo '<tr>';
echo '<td>' . $row['date']  . '</td>';
echo '<td></td>';
echo '<td>' . money_format("%!n", $row['nettotal']) . '</td>';
echo '<td></td>';
echo '</tr>';
}
else
{
echo '<tr>';
echo '<td>' . $xSlNo+=1 . '</td>';
echo '<td>' . date('d-M-Y',strtotime($row['date']))  . '</td>';
echo '<td>' . money_format("%!n", $row['expenses']) . '</td>';
echo '<td>' . money_format("%!n", $row['others']) . '</td>';
echo '</tr>'; 
}
}
?>	

</tbody>


    </table>	
  </div><!-- /container -->
</div>
</body></html>	
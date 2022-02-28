<?php
//include 'session.php';
include 'globalfunctions.php';
  $xItemNo= $_GET['itemno'];
?>

<html>
<title> V-SALES</title>
<head><link href="bootstrap.css" rel="stylesheet">
<link href="css/reportstyle.css" rel="stylesheet">

</head>
<body>
 
<div id="divToPrint" >
<div class="container">

<?php
$xSlNo=0;
$xGrandQty=0;
$xQry="SELECT *  from inv_salesentry where itemno=$xItemNo order by salesinvoiceno limit 10;"; 
$result2=mysql_query($xQry);
?>
<div class="panel panel-info">
  <!-- Default panel contents -->
  <div class="panel-heading  text-center"><b><?php echo "Last Ten Entries" ?></b></div>
<table class="table table-hover" border="1" >
      <thead>
        <tr>
           <th width="5%">S.NO</th>
           <th width="10%">DATE</th>
           <th width="25%">ITEMNAME</th>
           <th width="15%">QTY</th>
            <th width="20%">PATIENT</th>
            <th width="5%">SALES-INVOICENO</th>
          </tr>
      </thead>
      <tbody>

<?php
while ($row = mysql_fetch_array($result2)) {
    echo '<tr>';
    finditemname($row['itemno']);
    fn_PatientDetails($row['patientid']);
 //  findcustomername($row['customerno']);
   // findstockpointname($row['usagestockpointno']);
    echo '<td>' . $xSlNo+=1  . '</td>';
    echo '<td>' . date('d/M/y', strtotime($row['date'])). '</td>';
    echo '<td>' . $GLOBALS['xItemName']  . '</td>';
    echo '<td>' . $row['qty']  . '</td>';
    $xGrandQty+=$row['qty'];
        echo '<td>' . $GLOBALS ['xPatientName']  . '</td>';
       echo '<td>' . $row['salesinvoiceno']  . '</td>';
?>
<!--
<td><a href="inv_ht004salesentry.php<?php echo '?salesinvoiceno='.$row['salesinvoiceno'] . '&xmode=edit'; ?>"  onclick="return confirm_edit()">
  <img src="../images/edit.png" alt="HTML tutorial" style="width:30px;height:30px;border:0">
</a>
</td>
<td><a href="inv_ht004salesentry.php<?php echo '?salesinvoiceno='.$row['salesinvoiceno']. '&xmode=delete';  ?>"  onclick="return confirm_delete()">
  <img src="../images/delete.png" alt="HTML tutorial" style="width:30px;height:30px;border:0">
</a>
</td>
!-->
<?php
echo '</tr>'; 
}
echo '<tr>';
echo '<td colspan=3>GRAND TOTAL</td>';
echo '<td>' . $xGrandQty. '</td>';
echo '</tr>';  
?>	
</tbody>
    </table>	
  </div><!-- /container -->
</div></div>
</body></html>	
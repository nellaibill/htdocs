<?php
include('globalfile.php');
include('export_excel.php');
$xFromDate=$GLOBALS ['xFromDate'];
$xToDate=$GLOBALS ['xToDate'];
?>
<html>
<title> VIEW - O/P </title>
<div id="divToPrint" >
<div class="panel panel-success">
<div class="panel-heading">
<b><h3 class="panel-title text-center"><?php echo "  O/P Records Generated FROM $xFromDate TO $xToDate As On ". date("m-d-Y h:i:sa"); ?></h3></b>
</div>
<div class="panel-body">
<div class="container">
<?php
$xSlNo=0;
$xTotalAmount=0;
$xCount=0;

echo "<table class='table table-hover' border='1' id='lastrow'>
      <thead>
        <tr>
           <th>SL.NO </th>
           <th>DATE</th>
           <th> FEES</th>
        </tr>
      </thead>
<tbody>";
require_once('config.php');
$xQry="SELECT date,sum(fees) as fees from outpatientdetails  WHERE date >= '$xFromDate' AND date<= '$xToDate'  "; 
$xQry.= $xQryFilter. ' ' . " group by date order by date ;";
//echo $xQry;
$result2=mysql_query($xQry);
while ($row = mysql_fetch_array($result2)) {

    echo '<tr>';
    echo '<td >' . $xSlNo+=1  . '</td>';
    echo '<td>' . $row['date']  . '</td>';
    echo '<td align=right>' . $row['fees']  . '</td>';
    echo '</tr>'; 
$xTotalAmount+=	$row['fees'] ;
$xCount+=1;
 
}

?>	

<tr style='font-weight:bold;'>
<td> GRAND TOTAL </td>
<?php  echo '<td> </td>'; ?>
<?php  echo '<td align=right>' .money_format("%!n", $xTotalAmount)  . '</td>'; ?>

</tbody>
    </table>	</div>
  
</div></div></div>
</body></html>	
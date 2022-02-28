<?php
include 'globalfile.php';
$GLOBALS ['xDate']=$GLOBALS ['xCurrentDate'];
$GLOBALS ['xCompletedDate']=$GLOBALS ['xCurrentDate'];
$xReportDate=$GLOBALS ['xCurrentDate'];

if ( isset( $_GET['complaintno'] ) && !empty( $_GET['complaintno'] ) )
{
  DataProcess( $_GET['complaintno']);
}

function DataProcess($xComplaintNo) 
 {
    $xQry = "UPDATE t_complaint   SET paymentstatus='PAID' WHERE complaintno=$xComplaintNo";
    $retval = mysql_query ( $xQry ) or die ( mysql_error () );
    if (! $retval) 
    {
     die ( 'Could not enter data: ' . mysql_error () );
    }
 }
?>
 <script type="text/javascript">     
function RefreshPage() {
    location.reload();
}
function confirm_pay() {
  return confirm('Would you Like to Pay this Bill?');
}



</script>
<!-- Report Started Here !-->
<div class="panel panel-success">
<div class="panel-heading">
        <h3 class="panel-title text-center"> PENDING PAYMENTS</h3>
</div>
<div class="panel-body">
<div id="divToPrint" >
<div class="tables">
	<!--<p>
		<label for="search">
			<strong>Enter keyword to search </strong>
		</label>
		<input type="text" id="search"/>
	</p>!-->
<table class="table table-bordered">
		 <thead>
        <tr>
           <th width="5%">S.NO</th>
           <th width="5%">COMP.NO</th>
           <th width="10%"> ITEMNAME </th>
           <th width="10%"> STOCKPOINT</th>
           <th width="20%"> DESCRIPTION</th>
           <th width="13%"> COMPLAINTBY</th>
           <th width="7%"> AMOUNT</th>
           <th width="8%"> STATUS</th>
           <th width="15%"> REMARKS</th>
           <th width="10%"> START</th>
           <th width="10%"> FINISH</th>
           <th width="10%"> BILLNO</th>
<th colspan="2" width="5%">ACTIONS</td>
        </tr>
      </thead>
      <tbody>

<?php

$xQry='';
$xSlNo=0;

$xQry="SELECT *  from t_complaint where paymentstatus='NOT-PAID' and status='Completed' order by  complaintno desc "; 
$result2=mysql_query($xQry);

$rowCount = mysql_num_rows($result2);
echo '</br>'; 

while ($row = mysql_fetch_array($result2)) {
    if($row['paymentstatus']=='NOTPAID')
     {
      echo '<tr bgcolor=yellow>';
     }
else
{
    echo '<tr>';
}
    $xSlNo+=1;
    echo '<td>' . $xSlNo  . '</td>';
    finditemname($row['itemno']);
    echo '<td>' . $row['complaintno']  . '</td>';
?>
<td><a href="inv_hr001_a_oldcomplaints.php<?php echo '?itemno='.$row['itemno'] . '&xmode=edit'; ?>"> <?php echo  $GLOBALS['xItemName'] ?>
</a>  </td>
<?php
    findstockpointname($row['stockpointno']);
    echo '<td>' . $GLOBALS['xStockPointShortName']  . '</td>';

    echo '<td>' . $row['complaintdescription']  . '</td>';
    echo '<td>' . $row['complaintby']  . '</td>';
    echo '<td align=right> Rs.' . $row['amount']  .'</td>';
if($row['status']=='Processing')
{
    echo '<td bgcolor=red>' . $row['status']  . '</td>';
}
else
{
    echo '<td>' . $row['status']  . '</td>';
}
    echo '<td>' . $row['remarks']  . '</td>';
    echo '<td>' . date('d/M/y',strtotime( $row['date']))  . '</td>';
    echo '<td>' . date('d/M/y',strtotime( $row['completeddate']))  . '</td>';
    echo '<td>' . $row['billno']  . '</td>';
   
?>
<td><a href="inv_ht001_c_complaintpayment.php<?php echo '?complaintno='.$row['complaintno'] . '&xmode=edit'; ?>"  onclick="return confirm_pay()">
  <img src="../images/pay.png" alt="HTML tutorial" style="width:30px;height:30px;border:0">
</a>
</td>
<?
echo '</tr>'; 
}
  
?>	
</tbody>
    </table>	
	
</div>
</div>
</div>
<!-- Report Ended Here !-->
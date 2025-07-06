<?php
 include 'globalfile.php';
$xFromDate=$GLOBALS ['xInvFromDate'];
$xToDate=$GLOBALS ['xInvToDate'];
?>
<title>AUD-SALES</title>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<div class="panel panel-success">
<div class="panel-heading text-center">FILTER[GROUP]
<div class="btn-group pull-right">
          <input type="submit"  name="save"   class="btn btn-primary" value="VIEW" >
</div>

</div>
<div class="panel-body">
<div class="form-group">


<div class="col-xs-4">
<label>From Date:</label>
<input type="date" class="form-control"  name="f_fromdate" value="<?php echo $GLOBALS ['xInvFromDate']; ?>">
</div>

<div class="col-xs-4">
<label>To Date:</label>
<input type="date" class="form-control"  name="f_todate" value="<?php echo $GLOBALS ['xInvToDate']; ?>">
</div>


</div><!-- Form-Group !-->
</div><!-- Panel Body !-->
</div><!-- Panel !-->
</form>

<!--             ----------------------- REPORT GOES HERE  ------------------------  !-->
<div id="divToPrint" >
 <div class="panel panel-primary">
  <div class="panel-heading  text-center">
<b><?php echo "Sales Entries From[".date('d/M/y', strtotime($xFromDate))."]TO [".date('d/M/y', strtotime($xToDate))."] As On ". date("d/M/y h:i:sa"); ?></b>
        
  </div>
 <div class="panel-body">

  <div class="container">
<!--
<p><label for="search"><strong>Enter keyword to search </strong></label><input type="text" id="search"/></p>!-->
<table class="table table-striped  table-bordered " data-responsive="table">
      <thead>
        <tr>
               <th> S.No</th>
           <th>Bill No</th>
           <th> Date</th>
           <th>Name Of the Party</th>
           <th>GSTIN</th>
           <th>Qty</th>
           <th>Value</th>
           <th>Discount</th>           
           <th>GST%</th>
           <th>GST Value</th>
           <th>Total Value</th>
        </tr>
      </thead>
      

      <tbody>

<?php
$xQry='';
$xSlNo=0;
    $xGrandVat=0;
    $xGrandTotal=0;
    $xGrandNetTotal=0;
	$xVatValue=0;
	$xNetTotal=0;
$xQryFilter='';
 if (isSet($_POST['save'])) 
    {
      $xFromDate= $_POST['f_fromdate'];
      $xToDate= $_POST['f_todate'];
      $xQry = "update config_inventory set fromdate='$xFromDate',todate='$xToDate'";
      mysql_query($xQry);
      header('Location: auditor_sales.php');
    }
else
{
$xFromDate=$GLOBALS ['xInvFromDate'];
$xToDate= $GLOBALS ['xInvToDate'];
}

$xQry="SELECT itemno,batchid,salesinvoiceno,date,sum(qty)as qty,sum(amount) as amount,patientid,vat
from inv_salesentry where date>= '$xFromDate' AND date<= '$xToDate'  and salesinvoiceno>0 group by salesinvoiceno,vat order by salesinvoiceno";

//echo $xQry;
$result2=mysql_query($xQry);
$rowCount = mysql_num_rows($result2);
echo '</br>'; 

if(mysql_num_rows($result2)){
while ($row = mysql_fetch_array($result2)) {
    $xSlNo+=1;
    finditemname($row['itemno']);
    fn_PatientDetails($row['patientid']);
   // findsuppliername($row['supplierno']);
    finditempricevat($row['itemno'],$row['batchid'])
 ?>
 <tr>
 <?php 

 	$xItemVat=$row['vat'];	
    echo '<td>' . $xSlNo. '</td>';
    echo '<td>'.$GLOBALS ['xPatientName'].'</td>';
    echo '<td></td>';
    echo '<td></td>';
    echo '<td>' . $row['salesinvoiceno']  . '</td>';
    echo '<td>' . date('d/M/y', strtotime($row['date']))   . '</td>';
    $xInvoiceItemValue=$row['amount'];
    echo '<td>' . fn_RupeeFormat($xInvoiceItemValue) . '</td>';
    echo '<td>'.$GLOBALS ['xSelectedItemVat'].'</td>';
    echo '<td>'  .fn_RupeeFormat($xInvoiceItemValue*( $xItemVat/100) ). '</td>';
    $xNetTotal=  ( $xInvoiceItemValue*( $xItemVat/100))+ $xInvoiceItemValue;
    echo '<td></td>';
    echo '<td>' .fn_RupeeFormat($xNetTotal).'</td>';
    $xGrandTotal+=$xInvoiceItemValue;
    $xGrandVat+=$xInvoiceItemValue*($xItemVat/100);
    $xGrandNetTotal+= $xNetTotal;
   $xOldSalesInvoiceNo=$row['salesinvoiceno'];


}
echo '</tr>'; 
   echo '<tr>';
    echo '<td colspan=6> TOTAL .  </td>';
    echo '<td>' . fn_RupeeFormat( $xGrandTotal) . '</td>';
    echo '<td></td>';
    echo '<td>' . fn_RupeeFormat( $xGrandVat) . '</td>';
    echo '<td></td>';
    echo '<td>' . fn_RupeeFormat( $xGrandNetTotal) . '</td>';


echo '</tr>'; 
}

else 
 {     
    fn_NoDataFound();
 }
  
?>	
</tbody>
    </table>	

  </div><!-- /container -->
</div>
</div>
</div>
<!--             ----------------------- REPORT ENDS HERE  ------------------------  !-->

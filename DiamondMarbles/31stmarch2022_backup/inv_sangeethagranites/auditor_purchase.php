<?php
 include 'globalfile.php';
$xFromDate=$GLOBALS ['xInvFromDate'];
$xToDate=$GLOBALS ['xInvToDate'];
?>
<title>AUD-PURCHASE</title>
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
<b><?php echo "Purchase Entries From[".date('d/M/y', strtotime($xFromDate))."]TO [".date('d/M/y', strtotime($xToDate))."] As On ". date("d/M/y h:i:sa"); ?></b>
        
  </div>
 <div class="panel-body">

  <div class="container">
<!--
<p><label for="search"><strong>Enter keyword to search </strong></label><input type="text" id="search"/></p>!-->
<table class="table table-striped  table-bordered " data-responsive="table">
      <thead>
        <tr>
           <th> S.No</th>
           <th>Name of the Seller</th>
           <th> Seller_TIN</th>
           <th>Commodity_Code</th>
           <th>Invoice_No</th>
           <th>Invoice_Date</th>
           <th>NetTotal</th>
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
      header('Location: auditor_purchase.php');
    }
else
{
$xFromDate=$GLOBALS ['xInvFromDate'];
$xToDate= $GLOBALS ['xInvToDate'];
}

$xQry="SELECT itemno,supplierno,companyinvoiceno,date,	 sum(total)as total
  from inv_purchaseentry where date>= '$xFromDate' AND date<= '$xToDate' group by purchaseinvoiceno order by purchaseinvoiceno";
//echo $xQry;
$result2=mysql_query($xQry);
$rowCount = mysql_num_rows($result2);
echo '</br>'; 

if(mysql_num_rows($result2)){
while ($row = mysql_fetch_array($result2)) {
    $xSlNo+=1;
    finditemname($row['itemno']);
    findsuppliername($row['supplierno']);
 ?>
 <tr>
 <?php 
    echo '<td>' . $xSlNo. '</td>';
    echo '<td>' . $GLOBALS ['xSupplierName']  . '</td>';
    echo '<td>' . $GLOBALS ['xSupplierTinNo'] . '</td>';
    echo '<td></td>';
    echo '<td>' . $row['companyinvoiceno']  . '</td>';
    echo '<td>' . date('d/M/y', strtotime($row['date']))   . '</td>';

    $xInvoiceItemValue=$row['total'];
    echo '<td>' . fn_RupeeFormat($xInvoiceItemValue) . '</td>';

    $xGrandTotal+=$xInvoiceItemValue;
    $xGrandNetTotal+= $xNetTotal;

}
echo '</tr>'; 
   echo '<tr>';
    echo '<td colspan=6> TOTAL .  </td>';
    echo '<td>' . fn_RupeeFormat( $xGrandTotal) . '</td>';

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

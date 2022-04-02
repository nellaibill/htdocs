<?php
 include 'globalfile.php';
$xFromDate=$GLOBALS ['xInvFromDate'];
$xToDate=$GLOBALS ['xInvToDate'];
$GLOBALS ['xDatePEnt1']='';
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
<b><?php echo "Purchase Report From[".date('d/M/y', strtotime($xFromDate))."]TO [".date('d/M/y', strtotime($xToDate))."] As On ". date("d/M/y h:i:sa"); ?></b>
        
  </div>
 <div class="panel-body">

  <div class="container">
<!--
<p><label for="search"><strong>Enter keyword to search </strong></label><input type="text" id="search"/></p>!-->
<table class="table table-striped  table-bordered " data-responsive="table" border="1">
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

function GetPurchaseEntry1Details($xPurchaseInvocieNo) {
	$result = mysql_query ( "SELECT *  FROM inv_purchaseentry1
			 where purchaseinvoiceno=$xPurchaseInvocieNo") or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		findsuppliername($row['supplierno']);
		$GLOBALS ['xDatePEnt1'] = $row ['date'];	
	}
}
function checkSalesEntriesAvailable($xPurchaseInvocieNo,$xFrom,$xTo) {
	$result = mysql_query ( "SELECT *  FROM inv_purchaseentry1
			where purchaseinvoiceno=$xPurchaseInvocieNo and
			date>='$xFrom' and date<='$xTo' ") or die ( mysql_error () );
	$num_rows = mysql_num_rows($result);
	if ($num_rows>=1) {
		return true;
	} else {
		return false;
	}
}
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
      header('Location: auditor_purchase_details.php');
    }
else
{
$xFromDate=$GLOBALS ['xInvFromDate'];
$xToDate= $GLOBALS ['xInvToDate'];
}

$xQry="SELECT *  from inv_purchaseentry 
 order by purchaseinvoiceno";
//echo $xQry;
$result2=mysql_query($xQry);
$rowCount = mysql_num_rows($result2);
echo '</br>'; 

if(mysql_num_rows($result2)){
while ($row = mysql_fetch_array($result2)) {
    $xSlNo+=1;
    finditemname($row['itemno']);
    GetPurchaseEntry1Details($row['purchaseinvoiceno']);
   if(checkSalesEntriesAvailable($row['purchaseinvoiceno'],$xFromDate,$xToDate))
   {

 ?>
 <tr>
 <?php 
    echo '<td>' . $xSlNo. '</td>';
    echo '<td>' . $row['purchaseinvoiceno']  . '</td>';
   echo '<td>' . date('d/M/y', strtotime($GLOBALS ['xDatePEnt1']))   . '</td>';
    echo '<td>' . $GLOBALS ['xSupplierName']  . '</td>';
    echo '<td>' . $GLOBALS ['xSupplierGSTINNo'] . '</td>';
    echo '<td align=right>' . $row['qty'] .'</td>';
    $xInvoiceItemValue=$row['qty']*$row['originalprice'];
    echo '<td align=right>' . fn_RupeeFormat($xInvoiceItemValue) . '</td>';
    echo '<td align=right>' . $row['discount'] .'</td>';
    echo '<td align=right>' . $row['vat'] .'</td>';
	echo '<td align=right>'  .$xInvoiceItemValue*( $row['vat']/100) . '</td>';
    $xNetTotal=  ( $xInvoiceItemValue*( $row['vat']/100))+ $xInvoiceItemValue;
    echo '<td align=right>' .$xNetTotal.'</td>';
    $xGrandTotal+=$xInvoiceItemValue;
    $xGrandVat+=$xInvoiceItemValue*($row['vat']/100);
    $xGrandNetTotal+= $xNetTotal;
   }
}
echo '</tr>'; 
   echo '<tr>';
    echo '<td colspan=3> TOTAL .  </td>';
    echo '<td></td>';
    echo '<td></td>';
    echo '<td></td>';
    echo '<td align=right>' . fn_RupeeFormat( $xGrandTotal) . '</td>';
    echo '<td></td>';
    echo '<td></td>';
    echo '<td align=right>' . fn_RupeeFormat( $xGrandVat) . '</td>';

    echo '<td align=right>' . fn_RupeeFormat( $xGrandNetTotal) . '</td>';


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

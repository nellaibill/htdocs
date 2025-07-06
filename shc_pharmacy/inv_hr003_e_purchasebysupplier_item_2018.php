<?php
include 'globalfile.php';

$xFromDate = $GLOBALS ['xInvFromDate'];
$xToDate = $GLOBALS ['xInvToDate'];
$xQryFilter = '';
if (isset ( $_GET ['passpurchaseinvoiceno'] ) && ! empty ( $_GET ['passpurchaseinvoiceno'] )) {
	$xPurchaseInvoiceNo = $_GET ['passpurchaseinvoiceno'];
	$xQryFilter = $xQryFilter . ' ' . "and purchaseinvoiceno=$xPurchaseInvoiceNo";
} else {
	// if($xSupplierNo!=0) { $xQryFilter= $xQryFilter. ' ' . "and supplierno=$xSupplierNo"; }
	$xQryFilter = '';
}

function fn_GetPurchaseEntry1($xPurchaseInvoiceNo){
	$result = mysql_query ( "SELECT *  FROM shc_pharmacy_2018.inv_purchaseentry1 where purchaseinvoiceno=" . $xPurchaseInvoiceNo ) or die ( mysql_error () );
	$xCount= mysql_num_rows($result);
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xSupplierNo']=$row ['supplierno'];
		$GLOBALS ['xCompanyInvoiceNo']=$row ['companyinvoiceno'];
		$GLOBALS ['xDate']=$row ['date'];
		$GLOBALS ['xFrieght']=$row ['freight'];
		$GLOBALS ['xOthers']=$row ['others'];
	}
}
?>
<title>Consolidated-Purchase</title>

<!--             ----------------------- REPORT GOES HERE  ------------------------  !-->
<div id="divToPrint">
	<div class="panel panel-primary">
		<div class="panel-heading  text-center">
			<b><?php echo "Purchase Details  From[".date('d/M/y', strtotime($xFromDate))."]TO [".date('d/M/y', strtotime($xToDate))."] As On ". date("d/M/y h:i:sa"); ?></b>

		</div>
		<div class="panel-body">

			<div class="container">
				<!--
<p><label for="search"><strong>Enter keyword to search </strong></label><input type="text" id="search"/></p>!-->
				<input id="filter" type="text" class="col-xs-8"
				placeholder="Search here...">
				<table border="1" class="table">
					<thead>
						<tr>
							<th>S.No</th>
							<th>Inv.No</th>
                                                        <th>Date</th>
							<th>Track</th>
							<th>Supplier Name</th>
							<th>Item Name</th>
							<th>Qty</th>
                            <th>FreeQty</th>
                            <th>Packing</th>
                            <th>TotalQty</th>
							<th>Price</th>
							<th>Gst%</th>
							<th>Total</th>
						</tr>
					</thead>


					<tbody class="searchable">

<?php
$xQry = '';
$xSlNo = 0;
$xGrandVat = 0;
$xGrandDiscount = 0;
$xGrandTotal = 0;
$xGrandNetTotal = 0;
$xGrandProfit = 0;

if (isset($_GET ['passitemno']) && !empty($_GET ['passitemno'])) {
    $xItemNo = $_GET ['passitemno'];
    $xQryFilter = $xQryFilter . ' ' . "and itemno=$xItemNo";
} else {
    // if($xSupplierNo!=0) { $xQryFilter= $xQryFilter. ' ' . "and supplierno=$xSupplierNo"; }
    $xQryFilter = '';
}
$xQry = "SELECT * from shc_pharmacy_2018.inv_purchaseentry where txno>0 $xQryFilter";
//echo $xQry;

$result2 = mysql_query ( $xQry );
$rowCount = mysql_num_rows ( $result2 );

if (mysql_num_rows ( $result2 )) {
	$xGrandTotal = 0;
        $xNetQty=0;
	while ( $row = mysql_fetch_array ( $result2 ) ) {
		$xSlNo += 1;
		finditemname( $row ['itemno'] );
		?>
<tr>
<?php
		echo '<td>' . $xSlNo . '</td>';
		echo '<td align=right>' . $row ['purchaseinvoiceno'] . '</td>';
                echo '<td align=left>' . $row ['date'] . '</td>';
		fn_GetPurchaseEntry1( $row ['purchaseinvoiceno']);
		$xSupplierNo=$GLOBALS ['xSupplierNo'];
		findsuppliername($xSupplierNo);		
		echo '<td align=right>' . $row ['txno'] . '</td>';
		echo '<td align=left>' . $GLOBALS ['xSupplierName'] . '</td>';
        echo '<td align=left>' . $GLOBALS ['xItemName'] . '</td>';
	    $xPackNo=$GLOBALS ['xPackNo'];
		echo '<td align=right>' . $row ['qty'] . '</td>';
        echo '<td align=right>' . $row ['freeqty'] . '</td>';
        echo '<td align=right>' . $row ['packno'] ." - ". $GLOBALS ['xPackDescription'].'</td>';
        $xQty= $row ['qty'];
        $xFreeQty= $row ['freeqty'];
        $xQtyandFreeQty=$xQty+$xFreeQty;
        $xQtyandFreeQtyintoPackNo=$xQtyandFreeQty*$xPackNo;            
        echo '<td align=right>' . $xQtyandFreeQtyintoPackNo. '</td>';
		echo '<td align=right>' . $row ['originalprice'] . '</td>';
		echo '<td align=right>' . $row ['vat'] . '</td>';
		echo '<td align=right>' . $row ['total'] . '</td>';
		$xGrandTotal += $row ['total'];
                $xNetQty+=$xQtyandFreeQtyintoPackNo;	
	 ?>
     <td><a href="accounts_debit_note.php<?php   echo '?mrp='.$row ['sellingprice'].
                 '&batchid='.$row['batchid']. 
                 '&expdate='.$row['dateexpired'].
                 '&itemno='.$row['itemno']. 
                 '&purchaseqty='.$xQtyandFreeQtyintoPackNo.
                 '&purchaseinvoiceno='.$row['purchaseinvoiceno']. 
                  '&supplierno='.$xSupplierNo.
                 '&xmode=purchasereturn';  ?>"
		onclick="return confirm_()"> 
             <img src="images/salesreturn.jpg" style="width: 30px; height: 30px; border: 0"></a></td>
             
             <?php
		echo '</tr>';
	}
	
	echo '<tr>';
	echo '<td colspan=9>Grand Total</td>';
        echo '<td align=right>' . $xNetQty . '</td>';
                echo '<td></td>';
                 echo '<td></td>';
	echo '<td align=right>' . fn_RupeeFormat ( $xGrandTotal ) . '</td>';
	echo '</tr>';
} 

else {
	fn_NoDataFound ();
}

?>	

					
					
					
					</tbody>
				</table>

			</div>
			<!-- /container -->
		</div>
	</div>
</div>
<!--             ----------------------- REPORT ENDS HERE  ------------------------  !-->

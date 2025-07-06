<?php
include 'globalfile.php';
setlocale(LC_MONETARY, 'en_IN');
date_default_timezone_set("Asia/Kolkata");
$xHostName="localhost";
$xUserName="root";
$xPassword="nellaibill";
$xDbName="shc_pharmacy_2018";
 $con =@mysql_connect($xHostName, $xUserName, $xPassword) or die(mysql_error());
mysql_select_db($xDbName) or die(mysql_error());
$xFromDate = $GLOBALS ['xInvFromDate'];
$xToDate = $GLOBALS ['xInvToDate'];
$xQryFilter = '';
$xNetQty=0;
if (isset ( $_GET ['passsalesinvoiceno'] ) && ! empty ( $_GET ['passsalesinvoiceno'] )) {
	$xSalesInvoiceNo = $_GET ['passsalesinvoiceno'];
	$xQryFilter = $xQryFilter . ' ' . "and salesinvoiceno=$xSalesInvoiceNo";
} else {
	// if($xSupplierNo!=0) { $xQryFilter= $xQryFilter. ' ' . "and supplierno=$xSupplierNo"; }
	$xQryFilter = '';
}
if (isset($_GET ['passitemno']) && !empty($_GET ['passitemno'])) {
    $xItemNo = $_GET ['passitemno'];
    $xQryFilter = $xQryFilter . ' ' . "and itemno=$xItemNo";
}
?>
<title>Consolidated-Sales</title>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<!--             ----------------------- REPORT GOES HERE  ------------------------  !-->
   <div class="panel-body">
<div class="form-group">

<div class="col-xs-3" style="display:none">
<label>Report From Date</label>
<input type="date" class="form-control"  name="reportfromdate" value="<?php echo $GLOBALS ['xFromDate']; ?>">
</div>


<div class="col-xs-3" style="display:none">
<label>Report To Date</label>
<input type="date" class="form-control"  name="reporttodate" value="<?php echo $GLOBALS ['xToDate']; ?>">
</div>

<div class="col-xs-4">
					<label>Customer
						Name</label> <select class="form-control" name="reportcustomerno" id="f_customerno">
<?php
	$result = mysql_query ( "SELECT *  FROM account_ledger 
		where ledger_undergroup_no=5 
		order by ledger_name" );
		?>
		<option value="0">All</option>
		<?php
	while ( $row = mysql_fetch_array ( $result ) ) {
		?>
<option value="<?php echo $row['account_ledger_id']; ?>"
							<?php
		//if ($row ['account_ledger_id'] == $GLOBALS ['xSupplierNo']) {
			//echo 'selected="selected"';
		//}
		?>>
	
 <?php echo $row['ledger_name']; ?> 
</option>
<?php
	}
	
	?>
</select>

				</div>
				
				
                            <div class="col-xs-6">
                                <label>Item Name:</label> <select class="form-control"
                                                                  name="f_itemno" id="f_itemno" onchange="GetBatch();">
                                    <option value="0">Choose Item</option>
                                    <?php
                                    $result = mysql_query("SELECT *  FROM m_item  where itemno in(select itemno from inv_stockentry where stock>0) order by itemname");
                                    while ($row = mysql_fetch_array($result)) {
                                        ?>
                                        <option value="<?php echo $row['itemno']; ?>"
                                        <?php
                                       // if ($row ['itemno'] == $GLOBALS ['xItemNo']) {
                                          //  echo 'selected="selected"';
                                       // }
                                        ?>>
                                                     <?php echo $row['itemname'] ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>

                            </div>

<input type="submit"  name="save"   class="btn btn-primary" value="VIEW" >
				
</div></div>

</form>
<!--             ----------------------- REPORT GOES HERE  ------------------------  !-->
<div id="divToPrint">


	<div class="panel panel-primary">
		<div class="panel-heading  text-center">
			<b><?php echo "Sales Details  From[".date('d/M/y', strtotime($xFromDate))."]TO [".date('d/M/y', strtotime($xToDate))."] As On ". date("d/M/y h:i:sa"); ?></b>

		</div>
  
		<div class="panel-body">

			<div class="container">
                                          <input id="filter" type="text" class="col-xs-8"
				placeholder="Search here...">
				<!--
<p><label for="search"><strong>Enter keyword to search </strong></label><input type="text" id="search"/></p>!-->
				<table class="table table-striped  table-bordered "
					data-responsive="table">
					<thead>
						<tr>
							<th>S.No</th>
							<th>Inv.No</th>
							<th>Item Name</th>
							<th width="15%">Customer Name</th>
							<th>Qty</th>
							<th>MRP</th>
                 
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
 if (isSet($_POST['save'])) 
    {
   $xFromDate=$_POST['reportfromdate'];
   $xToDate= $_POST['reporttodate'];
   $xCustomerNo= $_POST['reportcustomerno'];
      $xItemNo= $_POST['f_itemno'];
   if( $xCustomerNo!=0)
   {
	   $xQryFilter="and customerno=$xCustomerNo";
   }
    if( $xItemNo!=0)
   {
	   $xQryFilter="and itemno=$xItemNo";
   }
$xQry = "SELECT * from inv_salesentry where salesinvoiceno>0 $xQryFilter order by salesinvoiceno,TXNO";
$result2 = mysql_query ( $xQry );
$rowCount = mysql_num_rows ( $result2 );

if (mysql_num_rows ( $result2 )) {
	$xGrandTotal = 0;
	while ( $row = mysql_fetch_array ( $result2 ) ) {
		$xSlNo += 1;
		finditemname( $row ['itemno'] );
                	findcustomername ( $row ['customerno'] );
		?>
<tr>
<?php
		echo '<td>' . $xSlNo . '</td>';
		echo '<td align=right>' . $row ['salesinvoiceno'] . '</td>';
		//echo '<td align=right>' . $row ['txno'] . '</td>';

		echo '<td align=left>' . $GLOBALS ['xItemName'] . '</td>';
                	echo '<td align=left>' . $GLOBALS ['xCustomerName'] . '</td>';
		//echo '<td align=left>' . $GLOBALS ['xItemDescription'] . '</td>';
		echo '<td align=right>' .$row ['qty'] . '</td>';
		echo '<td align=right>' . $row ['unitmrp'] . '</td>';
		echo '<td align=right>' . $row ['vat'] . '</td>';
                $xQtyIntoMrp=$row ['qty']*$row ['unitmrp'];
		echo '<td align=right>' . $xQtyIntoMrp . '</td>';
		$xGrandTotal += $xQtyIntoMrp;
		$xNetQty+=$row ['qty'];
                 ?>
     <td><a href="accounts_credit_note.php<?php   echo '?mrp='.$row ['unitmrp'].
                 '&batchid='.$row['batchid']. 
                 '&expdate='.$row['dateexpired'].
                 '&itemno='.$row['itemno']. 
                 '&salesqty='.$row['qty'].
                 '&salesinvoiceno='.$row['salesinvoiceno']. 
                  '&customerno='.$row['customerno'].
                 '&xmode=salesreturn';  ?>"
		onclick="return confirm_()"> 
             <img src="images/salesreturn.jpg" style="width: 30px; height: 30px; border: 0"></a></td>
             
             <?php
		echo '</tr>';
	}
	
	echo '<tr>';
	echo '<td colspan=4>Grand Total</td>';
	echo '<td align=right>' .  $xNetQty . '</td>';
		echo '<td></td>';
		echo '<td></td>';
	echo '<td align=right>' . fn_RupeeFormat ( $xGrandTotal ) . '</td>';
	echo '</tr>';
} 

else {
	fn_NoDataFound ();
}
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

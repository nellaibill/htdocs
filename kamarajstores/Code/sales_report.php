<?php
include 'globalfile.php';
$xFromDate = $GLOBALS ['xInvFromDate'];
$xToDate = $GLOBALS ['xInvToDate'];
?>
<title>AUD-SALES</title>

<div class="panel panel-success">
	<div class="panel-heading text-center">
		FILTER[GROUP]
		<div class="btn-group pull-right"></div>

	</div>
	<div class="panel-body">
		<div class="form-group">

			<div class="row">


				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
					<div class="col-xs-3">

						From Date:<input type="date" class="form-control"
							name="f_fromdate"
							>
					</div>

					<div class="col-xs-3">

						To Date:<input type="date" class="form-control" name="f_todate"
							>
					</div>
					<div class="col-xs-2">
						<input type="submit" name="report_date" class="btn btn-primary"
							value="VIEW">
					</div>
				</form>
			</div>
                   
			</div>
			<!-- Form-Group !-->
		</div>
		<!-- Panel Body !-->
	</div>
	<!-- Panel !-->


	<!--             ----------------------- REPORT GOES HERE  ------------------------  !-->
        <div id="divToPrint">	
<?php

$xQry = '';
$xSlNo = 0;
$xGrandVat = 0;
$xGrandTotal = 0;
$xGrandNetTotal = 0;
$xVatValue = 0;
$xNetTotal = 0;
$xQryFilter = '';
$xTotalAmountForSalesReturn=0;

$xNetAmount=0;
$xGrandLessAmount =0;
if (isSet ( $_POST ['save'] )) {
	$xFromDate = $_POST ['f_fromdate'];
	$xToDate = $_POST ['f_todate'];
	$xBillNo = $_POST ['f_billno'];
	$xItemNo = $_POST ['f_itemno'];
	$xCustomerNo = $_POST ['f_customerno'];
	$xQry = "update config_inventory " . "set fromdate='$xFromDate'," . "todate='$xToDate' ," . "customerno=$xCustomerNo," . "itemno=$xItemNo," . "sales_invoice_no=$xBillNo";
	mysql_query ( $xQry );
	// echo $xQry;
	header ( 'Location: sales_report.php' );
} else if (isSet ( $_POST ['sendmail'] )) {
	$xEmail = $_POST ['f_email'];
	$xMessage = "Welcome";
	SendMail ( $xEmail, $xMessage );
}
else if (isSet ( $_POST ['report_date'] )) {
	$xFromDate = $_POST ['f_fromdate'];
	$xToDate = $_POST ['f_todate'];
	$xQry = "SELECT * from inv_salesentry where date>= '$xFromDate' AND date<= '$xToDate'";
        $xQryForTotalAmount = "SELECT sum(totalamount) as totalamount from inv_salesentry1 "
                . "where date>= '$xFromDate' AND date<= '$xToDate'";
        
        $xQryForCash = "SELECT sum(totalamount) as totalamount,sum(lessamount)as lessamount from inv_salesentry1 "
                . "where modeofpayment='Cash' and date>= '$xFromDate' AND date<= '$xToDate'";
        
         $xQryForCard = "SELECT sum(totalamount) as totalamount from inv_salesentry1 "
                . "where modeofpayment='Card' and date>= '$xFromDate' AND date<= '$xToDate'";
         
                  $xQryForSalesReturn = "SELECT qty,mrp from accounts_credit_note "
                . "where  credit_note_date>= '$xFromDate' AND credit_note_date<= '$xToDate'";
                  
         $xResultForTotalAmount = mysql_query ( $xQryForTotalAmount );
	while ( $row = mysql_fetch_array ( $xResultForTotalAmount ) ) {
            $xTotalAmount=$row ['totalamount'];
        }
        
    
       $xResultForCash = mysql_query ( $xQryForCash );
	while ( $row = mysql_fetch_array ( $xResultForCash ) ) {
            $xTotalAmountBeforeLess=$row ['totalamount'];
			$xLessAmount=$row ['lessamount'];
			$xTotalAmountForCash=$xTotalAmountBeforeLess-$xLessAmount;
        }
        
             $xResultForCard = mysql_query ( $xQryForCard );
	while ( $row = mysql_fetch_array ( $xResultForCard ) ) {
            $xTotalAmountForCard=$row ['totalamount'];
        }
        
             $xResultForSalesReturn = mysql_query ( $xQryForSalesReturn );
	while ( $row = mysql_fetch_array ( $xResultForSalesReturn ) ) {
            $xQty=$row ['qty'];
                 $xMrp=$row ['mrp'];
                   $xTotalAmountForSalesReturn+=$xQty*$xMrp;
        }
echo '</br><h3>';




echo '<i style="color:blue;">
      Cash ' .$xTotalAmountForCash.'</i> ';
	  
	  echo '<i style="color:red;">
      || Card ' .$xTotalAmountForCard.'</i> ';
	  
echo "|| Sales Return".$xTotalAmountForSalesReturn ;
$xTotalAmount=$xTotalAmountForCash+$xTotalAmountForCard-$xTotalAmountForSalesReturn;
echo "|| Total Amount " .fn_RupeeFormat($xTotalAmount);
echo '</br></h3>';
} 
 else if (isSet ( $_POST ['report_billno'] )) {
	$xBillNo = $_POST ['f_billno'];
	$xQry = "SELECT * from inv_salesentry where " . "salesinvoiceno=$xBillNo " . "order by salesinvoiceno";
} 

else if (isSet ( $_POST ['report_customerno'] )) {
	$xCustomerNo = $_POST ['f_customerno'];
	$xQry = "SELECT * from inv_salesentry where customerno=$xCustomerNo";
} 
else if (isSet ( $_POST ['report_itemno'] )) {
	$xItemNo = $_POST ['f_itemno'];
	$xQry = "SELECT * from inv_salesentry where itemno=$xItemNo";
}
else {
	$xFromDate = $GLOBALS ['xCurrentDate'];
        $xToDate = $GLOBALS ['xCurrentDate'];
$xQry = "SELECT * from inv_salesentry where date>= '$xFromDate' AND date<= '$xToDate'";
        $xQryForTotalAmount = "SELECT sum(totalamount) as totalamount from inv_salesentry1 "
                . "where date>= '$xFromDate' AND date<= '$xToDate'";
        
        $xQryForCash = "SELECT sum(totalamount) as totalamount from inv_salesentry1 "
                . "where modeofpayment='Cash' and date>= '$xFromDate' AND date<= '$xToDate'";
        
         $xQryForCard = "SELECT sum(totalamount) as totalamount from inv_salesentry1 "
                . "where modeofpayment='Card' and date>= '$xFromDate' AND date<= '$xToDate'";
         
                  $xQryForSalesReturn = "SELECT qty,mrp from accounts_credit_note "
                . "where  credit_note_date>= '$xFromDate' AND credit_note_date<= '$xToDate'";
                  
         $xResultForTotalAmount = mysql_query ( $xQryForTotalAmount );
	while ( $row = mysql_fetch_array ( $xResultForTotalAmount ) ) {
            $xTotalAmount=$row ['totalamount'];
        }
        
    
        $xResultForCash = mysql_query ( $xQryForCash );
	while ( $row = mysql_fetch_array ( $xResultForCash ) ) {
            $xTotalAmountForCash=$row ['totalamount'];
        }
        
             $xResultForCard = mysql_query ( $xQryForCard );
	while ( $row = mysql_fetch_array ( $xResultForCard ) ) {
            $xTotalAmountForCard=$row ['totalamount'];
        }
        
             $xResultForSalesReturn = mysql_query ( $xQryForSalesReturn );
	while ( $row = mysql_fetch_array ( $xResultForSalesReturn ) ) {
            $xQty=$row ['qty'];
                 $xMrp=$row ['mrp'];
                   $xTotalAmountForSalesReturn+=$xQty*$xMrp;
        }
echo '</br><h3>';

echo '<i style="color:blue;">
      Cash ' .$xTotalAmountForCash.'</i> ';
	  
	  echo '<i style="color:red;">
      || Card ' .$xTotalAmountForCard.'</i> ';


echo "|| Sales Return".$xTotalAmountForSalesReturn ;
$xTotalAmount=$xTotalAmountForCash+$xTotalAmountForCard-$xTotalAmountForSalesReturn;
echo "|| Total Amount " .fn_RupeeFormat($xTotalAmount);
echo '</br></h3>';
}

// $xQry="SELECT itemno,batchid,salesinvoiceno,date, qty,unitrate,patientid
// from inv_salesentry where date>= '$xFromDate' AND date<= '$xToDate' order by salesinvoiceno";
// echo $xQry;
$result2 = mysql_query ( $xQry );
$rowCount = mysql_num_rows ( $result2 );
echo '</br>';
?>

		
            
            
<!--             ----------------------- REPORT GOES HERE  ------------------------  !-->
<div id="divToPrint">
	<div class="panel panel-primary">
		<div class="panel-heading  text-center">
			<b><?php echo "Consolidated Sales Entries From[".date('d/M/y', strtotime($xFromDate))."]TO [".date('d/M/y', strtotime($xToDate))."] As On ". date("d/M/y h:i:sa"); ?></b>

		</div>
		<div class="panel-body">

			<div class="container">
				<!--
<p><label for="search"><strong>Enter keyword to search </strong></label><input type="text" id="search"/></p>!-->
				<table class="table table-striped  table-bordered "
					data-responsive="table">
					<thead>
						<tr>
							<th>S.No</th>
							<th>Customer Name</th>
							<th>Mode of Payment</th>
							<th>Amount</th>
						</tr>
					</thead>


					<tbody>

<?php
$xQry = '';
$xSlNo = 0;

$xQry = "SELECT s.customerno as customerno,  sum(totalamount)as totalamount,sum(lessamount)as lessamount,
modeofpayment from inv_salesentry1 as s ,
account_ledger as al where s.date >= '$xFromDate' 
and s.date <= '$xToDate' and al.account_ledger_id=s.customerno
 group by s.customerno order by s.salesinvoiceno";

$result2 = mysql_query ( $xQry );
$rowCount = mysql_num_rows ( $result2 );

if (mysql_num_rows ( $result2 )) {
	$xGrandTotal = 0;
	while ( $row = mysql_fetch_array ( $result2 ) ) {
		$xSlNo += 1;
		findcustomername ( $row ['customerno'] );
		?>
<tr class='clickable-row'
							data-href='inv_hr004_e_salesbycustomer.php<?php echo '?passcustomerno='.$row['customerno'] . '&xmode=report'; ?>"> <?php echo  $GLOBALS['xCustomerName']?>'>
<?php
		echo '<td>' . $xSlNo . '</td>';
		echo '<td>' . $GLOBALS ['xCustomerName'] . '</td>';
		
		if($row ['modeofpayment'] =='Cash')
		{
		echo '<td style="color:blue;font-size:20px;">' . $row ['modeofpayment'] . '</td>';
		}
		if($row ['modeofpayment'] =='Card')
		{
		echo '<td style="color:red;font-size:20px;">' . $row ['modeofpayment'] . '</td>';
		}
		echo '<td align=right>' . fn_RupeeFormat ( $row ['totalamount'] ) . '</td>';
		echo '<td align=right>' . fn_RupeeFormat ( $row ['lessamount'] ) . '</td>';
		$xGrandLessAmount+= $row ['lessamount'];
		$xGrandTotal += $row ['totalamount'];
		echo '</tr>';
	}

	echo '<tr>';
	echo '<td colspan=3>Grand Total</td>';
	echo '<td align=right>' . fn_RupeeFormat ( $xGrandTotal ) . '</td>';
	echo '<td align=right>' . fn_RupeeFormat ( $xGrandLessAmount ) . '</td>';
	echo '</tr>';
		$xNetAmount=$xGrandTotal-$xGrandLessAmount;
		echo '<tr>';
	echo '<td colspan=3>Grand Total</td>';
	echo '<td align=right></td>';
	echo '<td align=right>' . fn_RupeeFormat ( $xNetAmount ) . '</td>';
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

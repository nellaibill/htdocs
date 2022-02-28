<?php
ob_start ();
include 'globalfile.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Payment</title>
</head>

<body onload='document.accounts_payment.f_amount.focus()'>
	<form class="form" name="accounts_payment"
		action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			<div class="col-xs-3">
			<label>From Date:</label> <input class="form-control"
				name="f_fromdate" type="date"
				value="<?php echo $GLOBALS ['xFromDate']; ?>">
		</div>

		<div class="col-xs-3">
			<label>To Date:</label> <input class="form-control" name="f_todate"
				type="date" value="<?php echo $GLOBALS ['xToDate']; ?>">
		</div>
		<div class="col-xs-4">
<label>Ledger List:</label> 
<select class="form-control" name="f_account_ledger_id">
<?php
$result = mysql_query ( "SELECT *  FROM account_ledger  order by ledger_name" );
while ( $row = mysql_fetch_array ( $result ) ) {
	?>
<option value="<?php echo $row['account_ledger_id']; ?>">
 <?php echo $row['ledger_name']; ?> 
</option>
<?php
}
?>
</select>
	</div>
		<div>
			<input type="submit" name="search" class="btn btn-primary"
				value="SEARCH" id="search">
		</div>
		
		</form>

<div id="divToPrint">
        <input id="filter" type="text" class="col-xs-8"
               placeholder="Search here...">
		<table class="table table-hover table-bordered" border="1"
		id="example">
		<thead>
			<tr>
				<th width="20%">Date</th>
				<th width="40%">Ledger Name</th>
				<th width="15%">Amount</th>
				<th width="15%">Remarks</th>

			</tr>
		</thead>

		<tbody class="searchable">
			<tr>
<?php
$xQry = '';
$xSlNo = 0;
$xGrandTotalReceipt= 0;
$today = date ( "Y-m-d" );
if (isSet ( $_POST ['search'] )) {
	$xFromDate=$_POST ['f_fromdate'];
	$xToDate=$_POST ['f_todate'];
	$xLedgerId=$_POST ['f_account_ledger_id'];
$xQry = "SELECT *  from accounts_receipt where accounts_receipt_date<='$xToDate'  
and accounts_receipt_date>='$xFromDate' 
and accounts_receipt_ledger_id=".$xLedgerId." order by  accounts_receipt_date desc";
}
else{
	$xQry = "SELECT *  from accounts_receipt   order by  accounts_receipt_date desc";
}
 //echo $xQry;
$result2 = mysql_query ( $xQry );
$rowCount = mysql_num_rows ( $result2 );
while ( $row = mysql_fetch_array ( $result2 ) ) {
	$xSlNo += 1;
	echo '<td>' . date ( "d/M/Y", strtotime ( $row ['accounts_receipt_date'] ) ) . '</td>';
	fn_FindAccountLedgerDetails ( $row ['accounts_receipt_ledger_id'] );
	echo '<td>' .	$GLOBALS ['xAccountLedgerName'].  '</td>';
	echo '<td>Rs ' . $row ['accounts_receipt_amount'].  '</td>';
	echo '<td>' . $row ['accounts_receipt_remarks'].  '</td>';
	$xGrandTotalReceipt=$row ['accounts_receipt_amount'];
	echo '</tr>';
}
	echo '<tr>';
	echo '<td colspan=2>GRAND TOTAL</td>';
	echo '<td align=right>Rs ' . $xGrandTotalReceipt.'</td>';
	echo '</tr>';

?>	

		
		</tbody>
	</table>
</div>

	<!--             ----------------------- REPORT ENDS HERE  ------------------------  !-->

<?php ob_end_flush(); ?>
</body>
</html>
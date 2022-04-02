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
		<br/>
		<div>
			<input type="submit" name="search" class="btn btn-primary"
				value="SEARCH" id="search">
		</div>
		
		</form>

	<?php include 'customtable.html';?>
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

		<tbody>
			<tr>
<?php
$xQry = '';
$xSlNo = 0;
$xGrandLitres = 0;
$xGrandRecievedAmount = 0;
$today = date ( "Y-m-d" );
if (isSet ( $_POST ['search'] )) {
	$xFromDate=$_POST ['f_fromdate'];
	$xToDate=$_POST ['f_todate'];
$xQry = "SELECT *  from accounts_payment where accounts_payment_date<='$xToDate'  
and accounts_payment_date>='$xFromDate' order by  accounts_payment_date desc";
}
else{
	$xQry = "SELECT *  from accounts_payment   order by  accounts_payment_date desc";
}
// echo $xQry;
$result2 = mysql_query ( $xQry );
$rowCount = mysql_num_rows ( $result2 );
echo '</br>';

while ( $row = mysql_fetch_array ( $result2 ) ) {
	$xSlNo += 1;
	echo '<td>' . date ( "d/M/Y", strtotime ( $row ['accounts_payment_date'] ) ) . '</td>';
	
	fn_FindAccountLedgerDetails ( $row ['accounts_payment_id'] );
	echo '<td>' . $GLOBALS ['xAccountLedgerName'] . '</td>';
	echo '<td>Rs ' . $row ['accounts_payment_amount'] . '</td>';
	
	echo '<td>' . $row ['accounts_payment_remarks'] . '</td>';
	echo '</tr>';
}

?>	

		
		</tbody>
	</table>


	<!--             ----------------------- REPORT ENDS HERE  ------------------------  !-->

<?php ob_end_flush(); ?>
</body>
</html>
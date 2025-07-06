<?php
ob_start ();
include 'globalfile.php';
$xGrandLitres = 0;
$xGrandRecievedAmount = 0;
fn_DataClear ();
if (isset ( $_GET ['accounts_payment_id'] ) && ! empty ( $_GET ['accounts_payment_id'] )) {
	$xId = $_GET ['accounts_payment_id'];
	if ($_GET ['xmode'] == 'edit') {
		$GLOBALS ['xMode'] = 'F';
		DataFetch ( $_GET ['accounts_payment_id'] );
	} else {
		$xQry = "DELETE FROM accounts_payment WHERE accounts_payment_id= $xId";
		mysql_query ( $xQry ) or die ( mysql_error () );
		header ( 'Location: accounts_payment.php' );
		// header("refresh:3;");
	}
} elseif (isset ( $_POST ['save'] )) {
	
	DataProcess ( "S" );
} elseif (isset ( $_POST ['update'] )) {
	DataProcess ( "U" );
} 

else {
	GetMaxIdNo ();
}
function fn_DataClear() {
	$GLOBALS ['xaccounts_paymentid'] = '';
	$GLOBALS ['xCustomerNo'] = '';
	$GLOBALS ['xShift'] = '';
$GLOBALS ['xRemarks']='';
	$GLOBALS ['xDate'] = date ( "Y-m-d" );
	$GLOBALS ['xAmount'] = "";
}
function GetMaxIdNo() {
	$sql = "SELECT  CASE WHEN max(accounts_payment_id)IS NULL OR max(accounts_payment_id)= '' 
   THEN '1' 
   ELSE max(accounts_payment_id)+1 END AS accounts_payment_id
FROM accounts_payment";
	$result = mysql_query ( $sql ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xaccounts_paymentid'] = $row ['accounts_payment_id'];
	}
}
function DataFetch($xaccounts_paymentid) {
	$result = mysql_query ( "SELECT *  FROM accounts_payment where accounts_payment_id=$xaccounts_paymentid" ) or die ( mysql_error () );
	$count = mysql_num_rows ( $result );
	if ($count > 0) {
		while ( $row = mysql_fetch_array ( $result ) ) {
			
			$GLOBALS ['xaccounts_paymentid'] = $row ['accounts_payment_id'];
			$GLOBALS ['xDate'] = $row ['accounts_payment_date'];
			$GLOBALS ['xAmount'] = $row ['accounts_payment_amount'];
			$GLOBALS ['xRemarks'] = $row ['remarks'];
			
		}
	}
}
function DataProcess($mode) {
	$xaccounts_paymentid = $_POST ['f_accounts_paymentid'];
	$xDate = $_POST ['f_date'];
	$xAccountLedgerId = $_POST ['f_account_ledger_id'];
	
	$xAmount = $_POST ['f_amount'];
	$xRemarks = $_POST ['f_remarks'];

	$xQry = "";
	$xMsg = "";
	if ($mode == 'S') {
		
		
		$xQry = "INSERT INTO accounts_payment(accounts_payment_id,
		accounts_payment_date,
		accounts_payment_ledger_id,
		accounts_payment_amount,
		accounts_payment_remarks)
		  VALUES ($xaccounts_paymentid,'$xDate',$xAccountLedgerId,$xAmount,'$xRemarks')";
	} elseif ($mode == 'U') {
		$xQry = "UPDATE accounts_payment   
		SET 
		accounts_payment_date='$xDate',
		accounts_payment_ledger_id=$xAccountLedgerId,
		accounts_payment_amount=$xAmount,
		accounts_payment_remarks='$xRemarks'
		 WHERE accounts_payment_id=$xaccounts_paymentid";
	}
	//echo $xQry;
	$retval = mysql_query ( $xQry ) or die ( mysql_error () );
	GetMaxIdNo ();
}

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
		<div class="panel panel-success">
			<div class="panel panel-info">
				<div class="panel-heading  text-center">
					<h3 class="panel-title">Payment-Entry</h3>
				</div>
				<div class="panel-body">
					<div class="form-group">

						<div class="col-xs-2" style="display: none;">
							<label> NO</label> <input type="text" class="form-control"
								id="f_accounts_paymentid" name="f_accounts_paymentid"
								value="<?php echo $GLOBALS ['xaccounts_paymentid']; ?>" readonly>
						</div>

						<div class="col-xs-3">
							<label>DATE</label> <input type="date" class="form-control"
								name="f_date" value="<?php echo $GLOBALS ['xDate']; ?>">
						</div>
<div class="col-xs-3">
<label>Ledger List:</label> <select
				class="form-control" name="f_account_ledger_id">
<?php
$result = mysql_query ( "SELECT *  FROM account_ledger order by ledger_name" );
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
						<div class="col-xs-2">

							<label>Amount</label> <input type="text" class="form-control"
								name="f_amount" maxlength="20"
								value="<?php echo $GLOBALS ['xAmount']; ?>" placeholder="">
						</div>
						
							<div class="col-xs-4">

							<label>Remarks</label> <input type="text" class="form-control"
								name="f_remarks" maxlength="20"
								value="<?php echo $GLOBALS ['xRemarks']; ?>" placeholder="">
						</div>

					</div>
				</div>
			</div>

			<div class="panel-footer clearfix">
				<div class="pull-right">
	  <?php if ($GLOBALS ['xMode'] == "") {  ?> 
		   <input type="submit" name="save" class="btn btn-primary"
						value="SAVE" id="save" onclick="return validateForm()"
						accesskey="s"> 
	   <?php } else{ ?>
		   <input type="submit" name="update" class="btn btn-primary"
						value="UPDATE" onclick="return validateForm()"> 
	   <?php }  ?>
	</div>
			</div>

		</div>

	</form>

	<?php include 'customtable.html';?>
				<table class="table table-hover table-bordered" border="1" id="example">
					<thead>
						<tr>
													<th width="20%">Date</th>
							<th width="40%">Ledger Name</th>
							<th width="15%">Amount</th>
													<th width="15%">Remarks</th>
							<th  width="5%">EDIT</th>
								<th  width="5%">DELETE</th>
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
$xQry = "SELECT *  from accounts_payment   order by  accounts_payment_date desc";
// echo $xQry;
$result2 = mysql_query ( $xQry );
$rowCount = mysql_num_rows ( $result2 );
echo '</br>';

while ( $row = mysql_fetch_array ( $result2 ) ) {
	$xSlNo += 1;
	echo '<td>' . date ( "d/M/Y", strtotime ( $row ['accounts_payment_date'] ) ) . '</td>';
	
	fn_FindAccountLedgerDetails($row ['accounts_payment_id']);
	echo '<td>' .	$GLOBALS ['xAccountLedgerName'].  '</td>';
	echo '<td>Rs ' . $row ['accounts_payment_amount'].  '</td>';

	echo '<td>' . $row ['accounts_payment_remarks'].  '</td>';
	
	?>
<td><a
								href="accounts_payment.php<?php echo '?accounts_payment_id='.$row['accounts_payment_id'] . '&xmode=edit'; ?>"
								onclick="return confirm_edit()"> <img src="images/edit.png"
									alt="HTML tutorial"
									style="width: 30px; height: 30px; border: 0">
							</a></td>
							<td><a
								href="accounts_payment.php<?php echo '?accounts_payment_id='.$row['accounts_payment_id']. '&xmode=delete';  ?>"
								onclick="return confirm_delete()"> <img src="images/delete.png"
									alt="HTML tutorial"
									style="width: 30px; height: 30px; border: 0">
							</a></td>

<?php
echo '</tr>';
}

?>	
</tbody></table>


	<!--             ----------------------- REPORT ENDS HERE  ------------------------  !-->

<?php ob_end_flush(); ?>
</body>
</html>
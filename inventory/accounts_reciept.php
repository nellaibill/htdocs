<?php
ob_start ();
include 'globalfile.php';
$xGrandLitres = 0;
$xGrandRecievedAmount = 0;
fn_DataClear ();
if (isset ( $_GET ['accounts_receipt_id'] ) && ! empty ( $_GET ['accounts_receipt_id'] )) {
	$xId = $_GET ['accounts_receipt_id'];
	if ($_GET ['xmode'] == 'edit') {
		$GLOBALS ['xMode'] = 'F';
		DataFetch ( $_GET ['accounts_receipt_id'] );
	} else {
		$xQry = "DELETE FROM accounts_receipt WHERE accounts_receipt_id= $xId";
		mysql_query ( $xQry ) or die ( mysql_error () );
		header ( 'Location: accounts_reciept.php' );
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
	$GLOBALS ['xaccounts_receiptid'] = '';
	$GLOBALS ['xCustomerNo'] = '';
	$GLOBALS ['xShift'] = '';
$GLOBALS ['xRemarks']='';
	$GLOBALS ['xDate'] = date ( "Y-m-d" );
	$GLOBALS ['xAmount'] = "";
}
function GetMaxIdNo() {
	$sql = "SELECT  CASE WHEN max(accounts_receipt_id)IS NULL OR max(accounts_receipt_id)= '' 
   THEN '1' 
   ELSE max(accounts_receipt_id)+1 END AS accounts_receipt_id
FROM accounts_receipt";
	$result = mysql_query ( $sql ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xaccounts_receiptid'] = $row ['accounts_receipt_id'];
	}
}
function DataFetch($xaccounts_receiptid) {
	$result = mysql_query ( "SELECT *  FROM accounts_receipt where accounts_receipt_id=$xaccounts_receiptid" ) or die ( mysql_error () );
	$count = mysql_num_rows ( $result );
	if ($count > 0) {
		while ( $row = mysql_fetch_array ( $result ) ) {
			
			$GLOBALS ['xaccounts_receiptid'] = $row ['accounts_receipt_id'];
			$GLOBALS ['xDate'] = $row ['accounts_receipt_date'];
			$GLOBALS ['xAmount'] = $row ['accounts_receipt_amount'];
			$GLOBALS ['xRemarks'] = $row ['accounts_receipt_remarks'];
			
		}
	}
}
function DataProcess($mode) {
	$xaccounts_receiptid = $_POST ['f_accounts_receiptid'];
	$xDate = $_POST ['f_date'];
	$xAccountLedgerId = $_POST ['f_account_ledger_id'];
	
	$xAmount = $_POST ['f_amount'];
	$xRemarks = $_POST ['f_remarks'];

	$xQry = "";
	$xMsg = "";
	if ($mode == 'S') {
		
		
		$xQry = "INSERT INTO accounts_receipt(accounts_receipt_id,
		accounts_receipt_date,
		accounts_receipt_ledger_id,
		accounts_receipt_amount,
		accounts_receipt_remarks)
		  VALUES ($xaccounts_receiptid,'$xDate',$xAccountLedgerId,$xAmount,'$xRemarks')";
	} elseif ($mode == 'U') {
		$xQry = "UPDATE accounts_receipt   
		SET 
		accounts_receipt_date='$xDate',
		accounts_receipt_ledger_id=$xAccountLedgerId,
		accounts_receipt_amount=$xAmount,
		accounts_receipt_remarks='$xRemarks'
		 WHERE accounts_receipt_id=$xaccounts_receiptid";
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
<title>Receipt</title>
</head>

<body onload='document.accounts_receipt.f_amount.focus()'>
	<form class="form" name="accounts_receipt"
		action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<div class="panel panel-success">
			<div class="panel panel-info">
				<div class="panel-heading  text-center">
					<h3 class="panel-title">Receipt-Entry</h3>
				</div>
				<div class="panel-body">
					<div class="form-group">

						<div class="col-xs-2" style="display: none;">
							<label> NO</label> <input type="text" class="form-control"
								id="f_accounts_receiptid" name="f_accounts_receiptid"
								value="<?php echo $GLOBALS ['xaccounts_receiptid']; ?>" readonly>
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
								name="f_remarks"
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
$xQry = "SELECT *  from accounts_receipt   order by  accounts_receipt_date desc";
// echo $xQry;
$result2 = mysql_query ( $xQry );
$rowCount = mysql_num_rows ( $result2 );
echo '</br>';

while ( $row = mysql_fetch_array ( $result2 ) ) {
	$xSlNo += 1;
	echo '<td>' . date ( "d/M/Y", strtotime ( $row ['accounts_receipt_date'] ) ) . '</td>';
	
	fn_FindAccountLedgerDetails($row ['accounts_receipt_ledger_id']);
	echo '<td>' .	$GLOBALS ['xAccountLedgerName'].  '</td>';
	echo '<td>Rs ' . $row ['accounts_receipt_amount'].  '</td>';

	echo '<td>' . $row ['accounts_receipt_remarks'].  '</td>';
	
	?>
<td><a
								href="accounts_reciept.php<?php echo '?accounts_receipt_id='.$row['accounts_receipt_id'] . '&xmode=edit'; ?>"
								onclick="return confirm_edit()"> <img src="images/edit.png"
									alt="HTML tutorial"
									style="width: 30px; height: 30px; border: 0">
							</a></td>
							<td><a
								href="accounts_reciept.php<?php echo '?accounts_receipt_id='.$row['accounts_receipt_id']. '&xmode=delete';  ?>"
								onclick="return confirm_delete()"> <img src="images/delete.png"
									alt="HTML tutorial"
									style="width: 30px; height: 30px; border: 0">
							</a>
						
										<td><a
								href="print_reciept.php<?php echo '?accounts_receipt_id='.$row['accounts_receipt_id'];  ?>"
								> <img src="images/print.png"
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
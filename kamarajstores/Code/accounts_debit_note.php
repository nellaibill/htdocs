<?php
include 'globalfile.php';

$GLOBALS ['xdebit_note_date'] = $GLOBALS ['xCurrentDate'];
/*
 * $xPurchaseaccounts_debit_note_id=$_GET['passaccounts_debit_note_id'];
 * $xPurchaseInvoiceNo=$_GET['passpurchaseinvoiceno'];
 * $xItemNo=$_GET['passitemno'];
 */
fn_DataClear ();
getconfig_purchase();

if (isset($_GET ['xmode']) && !empty($_GET ['xmode'])) {
	$xMode=$_GET ['xmode'];
}
else {
	$xMode='';
}
if (isset ( $_GET ['accounts_debit_note_id'] ) && ! empty ( $_GET ['accounts_debit_note_id'] )) {
	$no = $_GET ['accounts_debit_note_id'];
	if ($_GET ['xmode'] == 'edit') {
		$GLOBALS ['xMode'] = 'F';
		DataFetch ( $_GET ['accounts_debit_note_id'] );
	} else {
		$xOldQty = $_GET ['qty'];
		$xItemNo = $_GET ['itemno'];
		$xBatchId = $_GET ['batchid'];
		$xQry = "DELETE FROM accounts_debit_note 
		WHERE accounts_debit_note_id= $no";
		
		$xStockUpdateQry = "update inv_stockentry 
		set stock=stock+$xOldQty 
		where itemno=$xItemNo and batch='$xBatchId'";
		$xQ1=mysql_query ( $xQry);
		$xQ2=mysql_query ( $xStockUpdateQry);
		

		if ($xQ1 and $xQ2) {
			mysql_query ( "COMMIT" );
		} else {
			mysql_query ( "ROLLBACK" );
		}
		
		
		header ( 'Location: accounts_debit_note.php' );
	}
} else if (isset ( $_POST ['save'] )) {
	DataProcess ( "S" );
} else if (isset ( $_POST ['update'] )) {
	DataProcess ( "U" );
} else if ($xMode == 'purchasereturn') {
    $GLOBALS ['xDateExpired'] = $_GET ['expdate'];
    $GLOBALS ['xBatchId'] = $_GET ['batchid'];
    $GLOBALS ['xMrp'] = $_GET ['mrp'];
    $GLOBALS ['xItemNo'] = $_GET ['itemno'];
    $GLOBALS ['xSupplierNo'] = $_GET ['supplierno'];
    $GLOBALS ['xOldQty'] = $_GET ['purchaseqty'];
    GetMaxIdNo();
} else {
	GetMaxIdNo ();
}
function fn_DataClear() {
	$GLOBALS ['xaccounts_debit_note_id'] = '';
	$GLOBALS ['xItemNo'] = '';
	$GLOBALS ['xOldQty'] = '';
	$GLOBALS ['xReturnDetails'] = '';
	$GLOBALS ['xReturnQty'] = '';
	$GLOBALS ['xDateExpired'] = '';
	$GLOBALS ['xBatchId'] = '';
}
function GetMaxIdNo() {
	$result = mysql_query ( "SELECT  CASE WHEN max(accounts_debit_note_id)IS NULL OR max(accounts_debit_note_id)= '' THEN '1' 
					  ELSE max(accounts_debit_note_id)+1 END AS accounts_debit_note_id FROM  accounts_debit_note" ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xaccounts_debit_note_id'] = $row ['accounts_debit_note_id'];
	}
}
function DataFetch($xaccounts_debit_note_id) {
	$result = mysql_query ( "SELECT *  FROM accounts_debit_note where accounts_debit_note_id=$xaccounts_debit_note_id" ) or die ( mysql_error () );
	$count = mysql_num_rows ( $result );
	if ($count > 0) {
		while ( $row = mysql_fetch_array ( $result ) ) {
			
			$GLOBALS ['xaccounts_debit_note_id'] = $row ['accounts_debit_note_id'];
			finditemname ( $row ['itemno'] );
			$GLOBALS ['xItemNo'] = $row ['itemno'];
			/*
			 * $GLOBALS ['xPurchaseaccounts_debit_note_id'] = $row ['purchaseaccounts_debit_note_id'];
			 * $GLOBALS ['xPurchaseInvoiceNo'] = $row ['purchaseinvoiceno'];
			 */
			$GLOBALS ['xOldQty'] = $row ['returnqty'];
			$GLOBALS ['xReturnDetails'] = $row ['returndetails'];
			$GLOBALS ['xDateExpired'] = $row ['dateexpired'];
			$GLOBALS ['xBatchId'] = $row ['batchid'];
			
		}
	}
}
function DataProcess($mode) {
	$xOldQty = $_POST ['f_oldqty'];
	$xReturnQty = $_POST ['f_returnqty'];
	if($xOldQty>=$xReturnQty){
	$xaccounts_debit_note_id = $_POST ['f_accounts_debit_note_id'];
	$xdebit_note_date = $_POST ['f_debitnote_date'];
	/*
	 * $xPurchaseaccounts_debit_note_id= $_POST ['f_purchaseaccounts_debit_note_id'];
	 * $xPurchaseInvoiceNo= $_POST ['f_purchaseinvoiceno'];
	 */
	$xPartyNo = $_POST ['f_party_no'];
	$xItemNo = $_POST ['f_itemno'];
	$xReturnQty = $_POST ['f_returnqty'];
	
	$xReturnDetails = $_POST ['f_returndetails'];
	//$xCurrentUser = $GLOBALS ['xCurrentUser'];
	$xCurrentUser = "";
	$xCurrentDate = $GLOBALS ['xCurrentDateTime'];
	
	
	
$xExpiredDate = $_POST ['f_dateexpired'];
	if (empty ( $_POST ['f_batchid'] )) {
		$xBatchId = "";
	} else {
		$xBatchId = $_POST ['f_batchid'];
	}
	
	$xQry = "";
	$xStockUpdateQry = "";
	$xMsg = "";
	if ($mode == 'S') {
		$xQry = "INSERT INTO accounts_debit_note 
		(accounts_debit_note_id,ledger_no,
debit_note_date,
itemno,qty,details,
created_as_on,
updated_as_on,
logged_user,batchid,dateexpired) 
			VALUES ($xaccounts_debit_note_id,$xPartyNo,
'$xdebit_note_date',
$xItemNo,
$xReturnQty,
'$xReturnDetails',
'$xCurrentDate','$xCurrentDate',
'$xCurrentUser','$xBatchId','$xExpiredDate')";
		$xStockUpdateQry = "update inv_stockentry 
		set stock=stock-$xReturnQty 
		where itemno=$xItemNo 
		and batch='$xBatchId'";
		$xMsg = "Inserted";
	} /* elseif ($mode == 'U') {
		$xOldQty = $_POST ['f_oldqty'];
		$xQry = "UPDATE accounts_debit_note set 
		debit_note_date='$xdebit_note_date',
		ledger_no=$xPartyNo
	 itemno=$xItemNo,
		qty=$xReturnQty,
		details='$xReturnDetails',
		updated_as_on='$xCurrentDate',logged_user='$xCurrentUser' where accounts_debit_note_id=$xaccounts_debit_note_id";
		$xStockUpdateQry = "update inv_stockentry set stock=(stock+$xOldQty)-$xReturnQty where itemno=$xItemNo";
		$xMsg = "Updated";
	} */
	//echo $xQry;

	$xQ1=mysql_query ( $xQry);
	$xQ2=mysql_query ( $xStockUpdateQry);
	if ($xQ1 and $xQ2) {
		mysql_query ( "COMMIT" );
	} else {
		mysql_query ( "ROLLBACK" );
	}
	
	// header('Location: inv_ht004_a_salesreturn.php');
	GetMaxIdNo ();
}

else {
	echo '<script type="text/javascript">alert("Quantity Exceeds");</script>';
	//  header('Location: inv_hr004_e_salesbycustomer_item.php');
	echo '<H1><a href=inv_hr003_e_purchasebysupplier_item.php>GO BACK</a></h1>';
}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>SALES-RETURN</title>
<script type="text/javascript">


function validateForm() 
 {
 
 var xQty= document.forms["salesreturnform"]["f_returnqty"].value;
	 if (xQty== "") 
   {
	alert("Enter Qty");
	document.salesreturnform.f_returnqty.focus();
	return false;
   }

}

  </script>
</head>

<body onload='document.debit_note.f_returnqty.focus()'>
	<form class="form" name="debit_note"
		action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<div class="panel panel-primary">
			<div class="panel-heading  text-center">
				<h3 class="panel-title">Purchase Return</h3>
			</div>
			<div class="panel-body">


				<div class="col-xs-2">
					<label>Debit Note No :</label> <input type="text" readonly
						class="form-control" name="f_accounts_debit_note_id"
						value="<?php echo $GLOBALS ['xaccounts_debit_note_id']; ?>"
						readonly>
				</div>
				<div class="col-xs-2">
					<label>Date:</label> <input type="date" class="form-control" readonly
						name="f_debitnote_date"
						value="<?php echo $GLOBALS ['xdebit_note_date']; ?>">
				</div>
				<div class="col-xs-4">
					<label>Party Name:</label> <select class="form-control" readonly
						name="f_party_no">

<?php
$result = mysql_query ( "SELECT *  FROM account_ledger 
		where ledger_undergroup_no=4 
		order by ledger_name" );
while ( $row = mysql_fetch_array ( $result ) ) {
	?>
<option value="<?php echo $row['account_ledger_id']; ?>"
							<?php
	if ($row ['account_ledger_id'] ==  $GLOBALS ['xSupplierNo']) {
		echo 'selected="selected"';
	}
	?>>
	
 <?php echo $row['ledger_name']; ?> 
</option>
<?php
}

?>
</select>

				</div>
				<div class="col-xs-4">
					<label>Item Name:</label> <select class="form-control" readonly
						name="f_itemno">
<?php
$result = mysql_query ( "SELECT *  FROM  m_item order by itemname " );
while ( $row = mysql_fetch_array ( $result ) ) {
	?>
<option value="<?php echo $row['itemno']; ?>"
							<?php
	if ($row ['itemno'] == $xItemNo) {
		echo 'selected="selected"';
	}
	?>>
 <?php echo $row['itemname'] ?> 
</option>
<?php
}
?>
</select>

				</div>

			  <div class="col-xs-2">
					<label>Old Qty:</label> <input type="number" 
					class="form-control"
						name="f_oldqty" 
						required="required"
						value="<?php echo $GLOBALS ['xOldQty']; ?>"
						readonly>
				</div>	              


<?php
if ($GLOBALS ['xConfigPurchase_Batch'] == 'Yes') {
	echo "<div class=col-xs-2>";
	?>

		<?php }else { ?>
		<div class="col-xs-2" style="display: none;">
		<?php }?>
					<label>BatchId:</label> <input type="text" 
					class="form-control"
						name="f_batchid"  required="required" readonly
						value="<?php echo $GLOBALS ['xBatchId']; ?>">
				</div>

				<?php
if ($GLOBALS ['xConfigPurchase_Expiry'] == 'Yes') {
	echo "<div class=col-xs-2>";
	?>

		<?php }else { ?>
		<div class="col-xs-2" style="display: none;">
		<?php }?>
					<label>Expiry-Date:</label> <input type="date" class="form-control"
						name="f_dateexpired" required="required" readonly
						value="<?php echo $GLOBALS ['xDateExpired']; ?>">
				</div>
	
<div class="col-xs-2">
					<label>Qty:</label> <input min="0" max="99999" maxlength="5"
						class="form-control" name="f_returnqty"
						required="required"
						value="<?php echo $GLOBALS ['xReturnQty']; ?>"
						style="text-align: right;">
				</div>


				<div class="col-xs-4">
					<label>Narration:</label>
					<textarea class="form-control" rows="5" name ="f_returndetails" id="f_returndetails"></textarea>

				</div>


			</div>

			<div class="panel-footer clearfix">
				<div class="pull-right">

			   <input type="submit" name="save" class="btn btn-primary"
						value="Save" id="save" accesskey="s" onclick="return validateForm()"> 

		</div>
			</div>


		</div>
	</form>

	<hr>
	<!--             ----------------------- REPORT GOES HERE  ------------------------  !-->
	<div id="divToPrint">
		<div class="container">
			<div class="panel panel-info">
				<!-- Default panel contents -->
				<div class="panel-heading  text-center">
					<b><?php echo "Purchare   Return As On ". date("d/M/y h:i:sa"); ?></b>
				</div>
				<table class="table">
					<thead>
						<tr>
							<th width="5%">S.No</th>

							<th width="30%">ItemName</th>
							<th width="10%">Batch</th>
							<th width="10%">Expiry</th>
							<th width="10%">ReturnQty</th>
							<th width="10%">ReturnDetails</th>
							<th colspan="2" width="5%">ACTIONS</th>
						</tr>
					</thead>
					<tbody class="searchable">

<?php
$xQry = '';
$xSlNo = 0;
$xQry = "SELECT *  from accounts_debit_note";
$result2 = mysql_query ( $xQry );
$rowCount = mysql_num_rows ( $result2 );
echo '</br>';
while ( $row = mysql_fetch_array ( $result2 ) ) {
	?>
	<tr>
	<?php
	
	echo '<td>' . $xSlNo += 1 . '</td>';
	finditemname ( $row ['itemno'] );
	echo '<td>' . $GLOBALS ['xItemName'] . '</td>';
			echo '<td>' . $row ['batchid'] . '</td>';
			echo '<td>' . $row ['dateexpired'] . '</td>';
	echo '<td>' . $row ['qty'] . '</td>';

	echo '<td>' . $row ['details'] . '</td>';
	
	?>

<!-- 

Mark Saleem 27/Nov/2015 Edit Option Removed 
Reason While changing the item name Old Qty ,New Qty Problem Arises 

<td><a href="inv_ht004_a_salesreturn.php<?php echo '?accounts_debit_note_id='.$row['accounts_debit_note_id'] . '&xmode=edit'; ?>"  onclick="return confirm_edit()">
<img src="../images/edit.png" alt="HTML tutorial" style="width:30px;height:30px;border:0">
</a>
</td>

!-->
							<td><a
								href="accounts_debit_note.php<?php echo '?accounts_debit_note_id='.$row['accounts_debit_note_id'].'&qty='.$row['qty']. '&itemno='.$row['itemno']. '&batchid='.$row['batchid']. '&xmode=delete';  ?>"
								onclick="return confirm_delete()"> <img
									src="images/delete.png"
									style="width: 30px; height: 30px; border: 0">
							</a></td>

<?php
	
	echo '</tr>';
}

?>	

					
					
					
					
					
					</tbody>
				</table>
			</div>
			<!-- /container -->
		</div>
	</div>
	<!--             ----------------------- REPORT ENDS HERE  ------------------------  !-->
</body>
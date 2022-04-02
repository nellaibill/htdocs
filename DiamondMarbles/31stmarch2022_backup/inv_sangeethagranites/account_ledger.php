<?php
include 'globalfile.php';
fn_DataClear ();
if (isset ( $_GET ['account_ledger_id'] ) && ! empty ( $_GET ['account_ledger_id'] )) {
	$xGetaccount_ledger_id = $_GET ['account_ledger_id'];
	if ($_GET ['xmode'] == 'edit') {
		$GLOBALS ['xMode'] = 'F';
		DataFetch ( $_GET ['account_ledger_id'] );
	} else {
		$xQry = "DELETE FROM account_ledger WHERE account_ledger_id=$xGetaccount_ledger_id";
		$result = mysql_query ( $xQry );
		if (! $result) {
			die ( 'Invalid query: ' . mysql_error () );
		} else {
			header ( 'Location: account_ledger.php' );
		}
	}
} 

elseif (isset ( $_POST ['save_ledger'] )) {
	DataProcess ( "S" );
} elseif (isset ( $_POST ['update_ledger'] )) {
	DataProcess ( "U" );
}
else {
	GetMaxIdNo ();
}
function DataFetch($xaccount_ledger_id) {
	$result = mysql_query ( "SELECT *  FROM account_ledger WHERE account_ledger_id=$xaccount_ledger_id" ) or die ( mysql_error () );
	$count = mysql_num_rows ( $result );
	if ($count > 0) {
		while ( $row = mysql_fetch_array ( $result ) ) {
			
			$GLOBALS ['xaccount_ledger_id'] = $row ['account_ledger_id'];
			$GLOBALS ['xLedger_Name'] = $row ['ledger_name'];
			$GLOBALS ['xLedger_Address'] = $row ['ledger_address'];
			$GLOBALS ['xMobileNo'] = $row ['ledger_mobile_no'];
			$GLOBALS ['xLedger_Unique_No'] = $row ['ledger_unique_no'];
				$GLOBALS ['xCreditLimit']  =$row ['credit_limit'];
		}
	}
}
function fn_DataClear() {
	$xQry = "";
	$xMsg = "";
	$GLOBALS ['xaccount_ledger_id'] = '';
	$GLOBALS ['xLedger_Name'] = '';
	$GLOBALS ['xLedger_Address'] = '';
	$GLOBALS ['xMobileNo'] = '';
	$GLOBALS ['xLedger_Unique_No'] = '';
	$GLOBALS ['xCreditLimit'] = 0;
}

function GetMaxIdNo() {
	$result = mysql_query ( "SELECT  CASE WHEN max(account_ledger_id)IS NULL OR max(account_ledger_id)= '' THEN '1'
					  ELSE max(account_ledger_id)+1 END AS account_ledger_id FROM  account_ledger" ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xaccount_ledger_id'] = $row ['account_ledger_id'];
	}
}
function DataProcess($mode) {
	$xaccount_ledger_id = $_POST ['f_account_ledger_id'];
	$xLedger_Name = $_POST ['f_ledger_name'];
	$xLedger_Alias_Name = $_POST ['f_ledger_alias_name'];
	$xLedger_Under_Group_No = $_POST ['f_under_groupno'];
	$xLedger_Address = $_POST ['f_ledger_address'];
	
	$xLedger_MobileNo = $_POST ['f_ledger_mobileno'];
	$xLedger_Unique_No = $_POST ['f_ledger_unique_no'];
	$xCreditLimit = $_POST ['f_credit_limit'];
	
	
	$xQry = "";
	$xMsg = "";
	if ($mode == 'S') {
		$xQry = "INSERT INTO account_ledger
		(account_ledger_id,ledger_name,ledger_alias_name,
		ledger_undergroup_no,ledger_address,ledger_mobile_no,ledger_unique_no,credit_limit)
		VALUES($xaccount_ledger_id,'$xLedger_Name','$xLedger_Alias_Name',$xLedger_Under_Group_No,
		'$xLedger_Address','$xLedger_MobileNo','$xLedger_Unique_No',$xCreditLimit)";

		mysql_query ( $xQry ) or die ( mysql_error () );
		echo '<script type="text/javascript">swal("Good job!", "Ledger Created!", "success");</script>';
	} elseif ($mode == 'U') {

		$xQry="update account_ledger set ledger_name='$xLedger_Name',
		ledger_address='$xLedger_Address',
		ledger_mobile_no='$xLedger_MobileNo',ledger_unique_no='$xLedger_Unique_No',
		credit_limit=$xCreditLimit
				WHERE account_ledger_id=$xaccount_ledger_id";
		mysql_query ( $xQry ) or die ( mysql_error () );
	}
	GetMaxIdNo ();
}

?>
<link href='css/fonts.css' rel='stylesheet' type='text/css'>
<!-- <link href='css/newstyle.css' rel='stylesheet' type='text/css'> -->

<body onload='document.ledger_creation.f_ledger_name.focus()'>
	<div class="form-style-8">
		<h2>Ledger Creation</h2>
		<form class="form" name="ledger_creation"
			action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<div class="panel-body">
	<div class="col-xs-1">
	<label>Id:</label>
			<input type="text" name="f_account_ledger_id" placeholder="No"  class="form-control"
				value="<?php echo $GLOBALS ['xaccount_ledger_id']; ?>" readonly/> 
				</div>
						<div class="col-xs-3">
						<label>Name:</label>
				<input type="text" name="f_ledger_name" class="form-control"
				value="<?php echo $GLOBALS ['xLedger_Name']; ?>" />

	</div>
	<div class="col-xs-3" style="display: none;">
			<input type="text" name="f_ledger_alias_name"  class="form-control"
				/>
					</div>
	<div class="col-xs-5">
			<label>Address:</label>
					<input type="text" name="f_ledger_address"  class="form-control"
				 value="<?php echo $GLOBALS ['xLedger_Address']; ?>" />
					</div>
	<div class="col-xs-3">
			<label>MobileNo:</label>
					<input type="text" name="f_ledger_mobileno"  class="form-control"
				 value="<?php echo $GLOBALS ['xMobileNo']; ?>" />
					</div>
	<div class="col-xs-3">
					<label>Unique No:</label>
					<input type="text" name="f_ledger_unique_no"  class="form-control"
				 value="<?php echo $GLOBALS ['xLedger_Unique_No']; ?>" />
					</div>
	<div class="col-xs-3">
				 <label>Under Group:</label> <select
				class="form-control" name="f_under_groupno">
<?php
$result = mysql_query ( "SELECT *  FROM account_group order by account_group_name" );
while ( $row = mysql_fetch_array ( $result ) ) {
	?>
<option value="<?php echo $row['account_group_id']; ?>">
 <?php echo $row['account_group_name']; ?> 
</option>
<?php
}

?>
</select>	</div>
	<div class="col-xs-2">

				 <label>Set Credit Limit:</label>	<input type="text" name="f_credit_limit"  class="form-control"
				value="<?php echo $GLOBALS ['xCreditLimit']; ?>" />
		</div>
</div>
		<div class="panel-footer clearfix">
				<div class="pull-right">
	  <?php if ($GLOBALS ['xMode'] == "") {  ?> 
		   <input type="submit" class="btn btn-primary"
						name="save_ledger" value="Save" accesskey="s"> 
	   <?php } else{ ?>
		   <input type="submit" class="btn btn-primary"
						name="update_ledger" value="Update"
				accesskey="s">
	   <?php }  ?>
	</div>
			</div>
			
				
		</form>
		<br/><br/><br/><br/><br/>
	</div>

	<div id="divToPrint">
		<div class="container">
			<div class="panel panel-info">

				<!-- Default panel contents -->
				<div class="panel-heading  text-center">
					<h3 class="panel-title">Ledger Details</h3>
				</div>
				<div class="input-group">
					<span class="input-group-addon">Filter</span> <input id="filter"
						type="text" class="form-control">
				</div>
				<table class="table">
					<tr>
						<th>Name</th>
						<th>Mobile No</th>
						<th>Under Group</th>
						<th>Edit</th>
						<th>Delete</th>
					</tr>
					<tbody class="searchable">
						<tr>
<?php
$xQry = '';
$xSlNo = 0;
$xTotalAmount = 0;
$xQry = "SELECT *  from account_ledger  order by ledger_name";
$result2 = mysql_query ( $xQry );
$rowCount = mysql_num_rows ( $result2 );
echo '</br>';

while ( $row = mysql_fetch_array ( $result2 ) ) {
	
	echo '<td width=30%>' . $row ['ledger_name'] . '</td>';
	echo '<td width=30%>' . $row ['ledger_mobile_no'] . '</td>';
	fn_FindAccountGroupName($row['ledger_undergroup_no']);
	echo '<td width=30%>' .$GLOBALS ['xAccountGroupName'] . '</td>';
	?>
	<td><a
								href="account_ledger.php<?php echo '?account_ledger_id='.$row['account_ledger_id']. '&xmode=edit';  ?>"
								onclick="return confirm_edit()"> <img src="images/edit.png"
									style="width: 30px; height: 30px; border: 0">
							</a></td>
							<td><a
								href="account_ledger.php<?php echo '?account_ledger_id='.$row['account_ledger_id']. '&xmode=delete';  ?>"
								onclick="return confirm_delete()"> <img src="images/delete.png"
									style="width: 30px; height: 30px; border: 0">
							</a></td>
						</tr>
<?php
}

?>			</tbody>
				</table>
			</div>

		</div>
	</div>
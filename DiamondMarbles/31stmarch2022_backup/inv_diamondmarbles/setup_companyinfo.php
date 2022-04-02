	<?php
include 'globalfile.php';
if (isset ( $_GET ['companyno'] ) && ! empty ( $_GET ['companyno'] )) {
	$no = $_GET ['companyno'];
	if ($_GET ['xmode'] == 'edit') {
		DataFetch ( $_GET ['companyno'] );
	} 
	else {
		$xQry = "DELETE FROM setup_companyinfo where companyno= $no";
		mysql_query ( $xQry ) or die ( mysql_error () );
		echo '<script type="text/javascript">swal("Good job!", "Deleted!", "success");</script>';
		header ( 'Location: setup_companyinfo.php' );
	}
}
else {
	fn_DataClear ();
}

if (isset ( $_POST ['save'] )) {
	DataProcess ( "S" );
} elseif (isset ( $_POST ['update'] )) {
	DataProcess ( "U" );
} 
function fn_DataClear() {
	$GLOBALS ['xCompanyTitle'] = '';
	$GLOBALS ['xCompanyAddress1'] = '';
	$GLOBALS ['xCompanyAddress2'] = '';
	$GLOBALS ['xCompanyAddress3'] = '';
	$GLOBALS ['xCompanyContactNo'] = '';
	$GLOBALS ['xGSTINNo'] = '';
}
function DataFetch($xcompanyno) {
	$result = mysql_query ( "SELECT *  FROM setup_companyinfo where companyno=$xcompanyno" ) or die ( mysql_error () );
	$count = mysql_num_rows ( $result );
	if ($count > 0) {
		while ( $row = mysql_fetch_array ( $result ) ) {
			$GLOBALS ['xCompanyNo'] = $row ['companyno'];
			$GLOBALS ['xCompanyTitle'] = $row ['companytitle'];
			$GLOBALS ['xCompanyAddress1'] = $row ['companyaddress1'];
			$GLOBALS ['xCompanyAddress2'] = $row ['companyaddress2'];
			$GLOBALS ['xCompanyAddress3'] = $row ['companyaddress3'];
			$GLOBALS ['xCompanyContactNo'] = $row ['companycontactno'];
			$GLOBALS ['xGSTINNo'] = $row ['gstinno'];
		}
	}
}
function DataProcess($mode) {
	$xCompanyNo = $_POST ['f_companyno'];
	$xCompanyTitle = strtoupper ( $_POST ['f_companytitle'] );
	$xCompanyAddress1 = strtoupper ( $_POST ['f_companyaddress1'] );
	$xCompanyAddress2 = $_POST ['f_companyaddress2'];
	$xCompanyAddress3 = $_POST ['f_companyaddress3'];
	$xCompanyContactNo = $_POST ['f_companycontactno'];
	$xGSTINNo = $_POST ['f_gstinno'];
	
	$xQry = "";
	$xMsg = "";
	if ($mode == 'S') {
		$xQry = "INSERT INTO setup_companyinfo  
		(companytitle,companyaddress1,companyaddress2,companyaddress3,companycontactno,gstinno)
		VALUES
		('$xCompanyTitle','$xCompanyAddress1','$xCompanyAddress2','$xCompanyAddress3',
		'$xCompanyContactNo','$xGSTINNo')";
		$xMsg = "Inserted";
	} elseif ($mode == 'U') {
		$xQry = "UPDATE setup_companyinfo  SET  
		companytitle='$xCompanyTitle',companyaddress1='$xCompanyAddress1',
		companyaddress2='$xCompanyAddress2',companyaddress3='$xCompanyAddress3',
		companycontactno='$xCompanyContactNo',gstinno='$xGSTINNo'
		 WHERE companyno=1";
		$xMsg = "Updated";
	} elseif ($mode == 'D') {
		$xQry = "DELETE FROM setup_companyinfo WHERE companyno=$xTxno";
		$xMsg = "Deleted";
	}
	//echo $xQry;
	$retval = mysql_query ( $xQry ) or die ( mysql_error () );
	if (! $retval) {
		die ( 'Could not enter data: ' . mysql_error () );
	}
	
	// GetMaxIdNo ();
	//ShowAlert ( $xMsg );
}

?>

<!-- HTML CONTENTS!-->

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>USER PAGE</title>
<script type="text/javascript">
</script>
</head>
<body onload='document.userpage.f_companytitle.focus()'>

	<form class="form" name="userpage"
		action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<div class="panel panel-success">
			<div class="panel-heading">
				<h3 class="panel-title text-center">COMPANY -DETAILS</h3>
			</div>
			<div class="panel-body">
				<div class="form-group" style="display: none">
					<div class="col-xs-2">
						<input type="text" class="form-control" name="f_companyno" id=""
							value="<?php echo $GLOBALS ['xCompanyNo']; ?>" readonly>
					</div>
				</div>
				<div class="form-group">
					<div class="col-xs-4">
					<LABEL>Company Name</LABEL>
						<input type="text" class="form-control" name="f_companytitle"
							id="" value="<?php echo $GLOBALS ['xCompanyTitle']; ?>">
					</div>
					<div class="col-xs-4">
					<LABEL>AddressLine 1</LABEL>
						<input type="text" class="form-control" name="f_companyaddress1"
							id="" value="<?php echo $GLOBALS ['xCompanyAddress1']; ?>">
					</div>
					<div class="col-xs-4">
					<label>AddressLine 2</label>
						<input type="text" class="form-control" name="f_companyaddress2"
							id="" value="<?php echo $GLOBALS ['xCompanyAddress2']; ?>">
					</div>
						<div class="col-xs-4">
					<label>AddressLine 3</label>
						<input type="text" class="form-control" name="f_companyaddress3"
							id="" value="<?php echo $GLOBALS ['xCompanyAddress3']; ?>">
					</div>
					<div class="col-xs-4">
<label>Contact</label>
						<input type="text" class="form-control" name="f_companycontactno"
							id="" value="<?php echo $GLOBALS ['xCompanyContactNo']; ?>">

					</div>
					
										<div class="col-xs-4">
<label>GSTIN No</label>
						<input type="text" class="form-control" name="f_gstinno"
							id="" value="<?php echo $GLOBALS ['xGSTINNo']; ?>">

					</div>
				</div>
			</div>

			<div class="panel-footer clearfix">
				<div class="pull-right">
					 <input type="submit" name="update"
						class="btn btn-primary" value="UPDATE">
				</div>
			</div>

		</div>
	</form>
	<HR>
	<div id="divToPrint">
		<div class="container">
			<div class="panel panel-info">
				<!-- Default panel contents -->
				<div class="panel-heading  text-center">
					<h3 class="panel-title">VIEW COMPANY-DETAILS</h3>
				</div>
				<table class="table">
					<thead>
						<tr>
							<th width="20%">Name</th>
							<th width="20%">Address1</th>
							<th width="20%">Address2</th>
							<th width="10%">Address3</th>
							<th width="10%">Contact</th>
							<th width="10%">GSTINNo</th>
							<th colspan="2" width="10%">ACTIONS</th>
						</tr>
					</thead>
					<tbody>
						<tr>

<?php

$xQry = "SELECT *  from setup_companyinfo where companyno!=3";
$result2 = mysql_query ( $xQry );
while ( $row = mysql_fetch_array ( $result2 ) ) {
	echo '<td>' . $row ['companytitle'] . '</td>';
	echo '<td>' . $row ['companyaddress1'] . '</td>';
	echo '<td>' . $row ['companyaddress2'] . '</td>';
	echo '<td>' . $row ['companyaddress3'] . '</td>';
	echo '<td>' . $row ['companycontactno'] . '</td>';
	echo '<td>' . $row ['gstinno'] . '</td>';
	
	?>
<td><a
								href="setup_companyinfo.php<?php echo '?companyno='.$row['companyno'] . '&xmode=edit'; ?>"
								onclick="return confirm_edit()"> <img src="images/edit.png"
									alt="HTML tutorial"
									style="width: 30px; height: 30px; border: 0">
							</a></td>

							<!--  
											<td><a
									href="setup_companyinfo.php<?php echo '?companyno='.$row['companyno']. '&xmode=delete';  ?>"
									onclick="return confirm_delete()"> <img alt="HTML tutorial"
										src="images/delete.png"
										style="width: 30px; height: 30px; border: 0">
								</a></td>
								!-->
						
<?php
	echo '</tr>';
}

?>

						
						
					
					</tbody>
				</table>
			</div>
		</div>
	</div>

</body>
</html>
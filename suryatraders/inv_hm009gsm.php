<?php
include 'globalfile.php';
$GLOBALS ['xMode'] = '';
// Get the Patient Id value from Patient Id TextBox On KeyEnter
if (isset ( $_GET ['gsmno'] ) && ! empty ( $_GET ['gsmno'] )) {
	$xGetgsmno = $_GET ['gsmno'];
	if ($_GET ['xmode'] == 'edit') {
		$GLOBALS ['xMode'] = 'F';
		DataFetch ( $_GET ['gsmno'] );
	} else {
		$xQry = "DELETE FROM m_gsm WHERE gsmno=$xGetgsmno";
		$result = mysql_query ( $xQry );
		if (! $result) {
			die ( 'Invalid query: ' . mysql_error () );
		} else {
			header ( 'Location: inv_hm009gsm.php' );
		}
	}
} else {
	fn_DataClear ();
}

// Post Method Data To be Executed Here

if (isset ( $_POST ['f_BtnSaveGsm'] )) {
	// S- Save ,U-Update
	DataProcess ( "S" );
} elseif (isset ( $_POST ['f_BtnUpdateGsm'] )) {
	DataProcess ( "U" );
} 
function DataFetch($xgsmno) {
	$result = mysql_query ( "SELECT *  FROM m_gsm WHERE gsmno=$xgsmno" ) or die ( mysql_error () );
	$count = mysql_num_rows ( $result );
	if ($count > 0) {
		while ( $row = mysql_fetch_array ( $result ) ) {
			
			$GLOBALS ['xGsmNo'] = $row ['gsmno'];
			$GLOBALS ['xGsmName'] = $row ['gsmname'];
		}
	}
}
function DataProcess($mode) {
	// Get Values from the Patient Registration Form
	$xGsmNo = $_POST ['f_gsmno'];
	$xGsmName= $_POST ['f_gsmname'];
	if ($mode == 'S') {
		$xQry = "INSERT INTO m_gsm (gsmno,gsmname) 
		VALUES ($xGsmNo,'$xGsmName')";
		$xMsg = "Added";
	} elseif ($mode == 'U') {
		$xQry = "UPDATE m_gsm   SET gsmname='$xGsmName'
		 WHERE gsmno=$xGsmNo";
		$xMsg = "Updated";
	}
	//echo $xQry;
	$retval = mysql_query ( $xQry ) or die ( mysql_error () );
	if (! $retval) {
		die ( 'Could not enter data: ' . mysql_error () );
	}
	fn_DataClear ();
	ShowAlert ( $xMsg );
}
function fn_DataClear() {
	$xQry = "";
	$xMsg = "";
	$GLOBALS ['xGsmNo'] = '';
	$GLOBALS ['xGsmName'] = '';
	GetMaxIdNo ();
}
function GetMaxIdNo() {
	$sql = "SELECT  CASE WHEN max(gsmno)IS NULL OR max(gsmno)= ''
       THEN '1'
       ELSE max(gsmno)+1 END AS gsmno
FROM m_gsm";
	
	$result = mysql_query ( $sql ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xGsmNo'] = $row ['gsmno'];
	}
}
?>


<!DOCTYPE body PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<body onload='document.gsmform.f_gsmname.focus()'>
	<form class="form" name="gsmform"
		action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<div class="panel panel-success">
			<div class="panel-heading">
				<h3 class="panel-title  text-center">MASTER -GSM</h3>
			</div>
		</div>
		<!-- Panel Body !-->

		<div class="panel-body">

			<!-- Panel -Room Type Number General Information !-->

			<div class="form-group">

				<div class="col-xs-3" style="display: none;">
					<label>Gsm No</label> <input type="text" class="form-control"
						name="f_gsmno" value="<?php echo $GLOBALS ['xGsmNo']; ?>" readonly="readonly"
						>
				</div>
				<div class="col-xs-3">
					<label>Gsm Name</label> <input type="text" class="form-control"
						name="f_gsmname" value="<?php echo $GLOBALS ['xGsmName']; ?>"
						>
				</div>
			</div>


		</div>
		<!-- Panel -Room Type Number Information Ended !-->

		<div class="panel-footer clearfix">
			<div class="pull-right">

				<input type="submit" name="f_BtnSaveGsm" class="btn btn-primary"
					value="SAVE" id="add" onclick="return validateForm()">
						<input type="submit" name="f_BtnUpdateGsm" class="btn btn-primary"
					value="UPDATE" id="add" onclick="return validateForm()">
		
			</div>
		</div>

	</form>


<!--             ----------------------- REPORT GOES HERE  ------------------------  !-->
<div id="divToPrint">
	<div class="container">
		<div class="panel panel-info">

			<!-- Default panel contents -->
			<div class="panel-heading  text-center">
				<h3 class="panel-title">VIEW GSM DETAILS</h3>
			</div>
			<div class="input-group">
				<span class="input-group-addon">Filter</span> <input id="filter"
					type="text" class="form-control">
			</div>
			<table class="table">
				<thead>
					<tr>

						<th width="30%">GSM NAME</th>
						<th width="5%" colspan="2">ACTIONS</th>
				
					</tr>
				</thead>
				<tbody class="searchable">
					<tr>

<?php
$xQry = '';
$xSlNo = 0;
$xTotalAmount = 0;
$xQry = "SELECT *  from m_gsm  order by gsmno";
$result2 = mysql_query ( $xQry );
$rowCount = mysql_num_rows ( $result2 );
echo '</br>';

while ( $row = mysql_fetch_array ( $result2 ) ) {
	echo '<td>' . $row ['gsmname'] . '</td>';
	?>
					<td><a
							href="inv_hm009gsm.php<?php echo '?gsmno='.$row['gsmno']. '&xmode=edit';  ?>"
							onclick="return confirm_edit()"> <img src="images/edit.png"
								style="width: 30px; height: 30px; border: 0">
						</a></td>

<?php
	echo '</tr>';
}

?>		</tbody>
			</table>
		</div>

	</div>
</div>

</body>

<!--             ----------------------- REPORT ENDS HERE  ------------------------  !-->

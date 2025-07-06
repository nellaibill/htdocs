<?php
include 'globalfile.php';
$GLOBALS ['xMode'] = '';
$GLOBALS ['xDate'] = $GLOBALS ['xCurrentDate'];

// Get the Patient Id value from Patient Id TextBox On KeyEnter
if (isset ( $_GET ['unitno'] ) && ! empty ( $_GET ['unitno'] )) {
	$xGetunitno = $_GET ['unitno'];
	if ($_GET ['xmode'] == 'edit') {
		$GLOBALS ['xMode'] = 'F';
		DataFetch ( $_GET ['unitno'] );
	} else {
		$xQry = "DELETE FROM m_unit WHERE unitno=$xGetunitno";
		$result = mysql_query ( $xQry );
		if (! $result) {
			die ( 'Invalid query: ' . mysql_error () );
		} else {
			header ( 'Location: inv_hm007unit.php' );
		}
	}
} else {
	fn_DataClear ();
}

// Post Method Data To be Executed Here

if (isset ( $_POST ['f_BtnSaveUnit'] )) {
	// S- Save ,U-Update
	DataProcess ( "S" );
} elseif (isset ( $_POST ['f_BtnUpdateUnit'] )) {
	DataProcess ( "U" );
} 
function DataFetch($xunitno) {
	$result = mysql_query ( "SELECT *  FROM m_unit WHERE unitno=$xunitno" ) or die ( mysql_error () );
	$count = mysql_num_rows ( $result );
	if ($count > 0) {
		while ( $row = mysql_fetch_array ( $result ) ) {
			
			$GLOBALS ['xUnitNo'] = $row ['unitno'];
			$GLOBALS ['xUnitName'] = $row ['unitname'];
		}
	}
}
function DataProcess($mode) {
	// Get Values from the Patient Registration Form
	$xUnitNo = $_POST ['f_unitno'];
	$xUnitName= $_POST ['f_unitname'];
	if ($mode == 'S') {
		$xQry = "INSERT INTO m_unit (unitno,unitname) 
		VALUES ($xUnitNo,'$xUnitName')";
		$xMsg = "Added";
	} elseif ($mode == 'U') {
		$xQry = "UPDATE m_unit   SET unitname='$xUnitName'
		 WHERE unitno=$xUnitNo";
		$xMsg = "Updated";
	}
	//echo $xQry;
	$retval = mysql_query ( $xQry ) or die ( mysql_error () );
	if (! $retval) {
		die ( 'Could not enter data: ' . mysql_error () );
	}
	fn_DataClear ();
	//ShowAlert ( $xMsg );
}
function fn_DataClear() {
	$xQry = "";
	$xMsg = "";
	$GLOBALS ['xUnitNo'] = '';
	$GLOBALS ['xUnitName'] = '';
	GetMaxIdNo ();
}
function GetMaxIdNo() {
	$sql = "SELECT  CASE WHEN max(unitno)IS NULL OR max(unitno)= ''
       THEN '1'
       ELSE max(unitno)+1 END AS unitno
FROM m_unit";
	
	$result = mysql_query ( $sql ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xUnitNo'] = $row ['unitno'];
	}
}
?>


<!DOCTYPE body PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<body onload='document.unitform.f_unitname.focus()'>
	<form class="form" name="unitform"
		action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<div class="panel panel-success">
			<div class="panel-heading">
				<h3 class="panel-title  text-center">MASTER -UNITS</h3>
			</div>
		</div>
		<!-- Panel Body !-->

		<div class="panel-body">

			<!-- Panel -Room Type Number General Information !-->

			<div class="form-group">

				<div class="col-xs-3">
					<label>Unit No</label> <input type="text" class="form-control"
						name="f_unitno" value="<?php echo $GLOBALS ['xUnitNo']; ?>" readonly="readonly"
						>
				</div>
				<div class="col-xs-3">
					<label>Unit Name</label> <input type="text" class="form-control"
						name="f_unitname" value="<?php echo $GLOBALS ['xUnitName']; ?>"
						>
				</div>
			</div>


		</div>
		<!-- Panel -Room Type Number Information Ended !-->

		<div class="panel-footer clearfix">
			<div class="pull-right">

				<input type="submit" name="f_BtnSaveUnit" class="btn btn-primary"
					value="SAVE" id="add" onclick="return validateForm()">
						<input type="submit" name="f_BtnUpdateUnit" class="btn btn-primary"
					value="UPDATE" id="add" onclick="return validateForm()">
		
			</div>
		</div>

	</form>


<!--             ----------------------- REPORT GOES HERE  ------------------------  !-->
<div id="divToPrint">
	<div class="container">
	<input id="filter" type="text" class="col-xs-8">
	<div class="panel panel-info">


			<table class="table">
				<thead>
					<tr>
						<th width="30%">UNIT NO</th>
						<th width="30%">UNIT NAME</th>
						<th width="5%" colspan="2">ACTIONS</th>
				
					</tr>
				</thead>
				<tbody class="searchable">
					<tr>

<?php
$xQry = '';
$xSlNo = 0;
$xTotalAmount = 0;
$xQry = "SELECT *  from m_unit  order by unitno";
$result2 = mysql_query ( $xQry );
$rowCount = mysql_num_rows ( $result2 );
echo '</br>';

while ( $row = mysql_fetch_array ( $result2 ) ) {
	echo '<td>' . $row ['unitno'] . '</td>';
	echo '<td>' . $row ['unitname'] . '</td>';
	?>
					<td><a
							href="inv_hm007unit.php<?php echo '?unitno='.$row['unitno']. '&xmode=edit';  ?>"
							onclick="return confirm_edit()"> <img src="images/edit.png"
								style="width: 30px; height: 30px; border: 0">
						</a></td>
						<td><a
							href="inv_hm007unit.php<?php echo '?unitno='.$row['unitno']. '&xmode=delete';  ?>"
							onclick="return confirm_delete()"> <img src="images/delete.png"
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

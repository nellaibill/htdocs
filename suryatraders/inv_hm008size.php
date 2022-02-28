<?php
include 'globalfile.php';
$GLOBALS ['xMode'] = '';
// Get the Patient Id value from Patient Id TextBox On KeyEnter
if (isset ( $_GET ['sizeno'] ) && ! empty ( $_GET ['sizeno'] )) {
	$xGetsizeno = $_GET ['sizeno'];
	if ($_GET ['xmode'] == 'edit') {
		$GLOBALS ['xMode'] = 'F';
		DataFetch ( $_GET ['sizeno'] );
	} else {
		$xQry = "DELETE FROM m_size WHERE sizeno=$xGetsizeno";
		$result = mysql_query ( $xQry );
		if (! $result) {
			die ( 'Invalid query: ' . mysql_error () );
		} else {
			header ( 'Location: inv_hm008size.php' );
		}
	}
} else {
	fn_DataClear ();
}

// Post Method Data To be Executed Here

if (isset ( $_POST ['f_BtnSaveSize'] )) {
	// S- Save ,U-Update
	DataProcess ( "S" );
} elseif (isset ( $_POST ['f_BtnUpdateSize'] )) {
	DataProcess ( "U" );
} 
function DataFetch($xsizeno) {
	$result = mysql_query ( "SELECT *  FROM m_size WHERE sizeno=$xsizeno" ) or die ( mysql_error () );
	$count = mysql_num_rows ( $result );
	if ($count > 0) {
		while ( $row = mysql_fetch_array ( $result ) ) {
			
			$GLOBALS ['xSizeNo'] = $row ['sizeno'];
			$GLOBALS ['xSizeName'] = $row ['sizename'];
			$GLOBALS ['xSizeA'] = $row ['sizea'];
			$GLOBALS ['xSizeB'] = $row ['sizeb'];
			
		}
	}
}
function DataProcess($mode) {
	// Get Values from the Patient Registration Form
	$xSizeNo = $_POST ['f_sizeno'];
	$xSizeName= $_POST ['f_sizename'];
	$xSizeA = $_POST ['f_sizea'];
	$xSizeB= $_POST ['f_sizeb'];
	$xTotalSize=$xSizeA*$xSizeB;
	if ($mode == 'S') {
		$xQry = "INSERT INTO m_size (sizeno,sizename,sizea,sizeb,totalsize) 
		VALUES ($xSizeNo,'$xSizeName',$xSizeA,$xSizeB,$xTotalSize)";
		$xMsg = "Added";
	} elseif ($mode == 'U') {
		$xQry = "UPDATE m_size   SET sizename='$xSizeName',sizea=$xSizeA,sizeb=$xSizeB,totalsize=$xTotalSize
		 WHERE sizeno=$xSizeNo";
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
	$GLOBALS ['xSizeNo'] = '';
	$GLOBALS ['xSizeName'] = '';
	$GLOBALS ['xSizeA'] = '';
	$GLOBALS ['xSizeB'] = '';
	GetMaxIdNo ();
}
function GetMaxIdNo() {
	$sql = "SELECT  CASE WHEN max(sizeno)IS NULL OR max(sizeno)= ''
       THEN '1'
       ELSE max(sizeno)+1 END AS sizeno
FROM m_size";
	
	$result = mysql_query ( $sql ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xSizeNo'] = $row ['sizeno'];
	}
}
?>


<!DOCTYPE body PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<body onload='document.sizeform.f_sizename.focus()'>
	<form class="form" name="sizeform"
		action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<div class="panel panel-success">
			<div class="panel-heading">
				<h3 class="panel-title  text-center">MASTER -SIZES</h3>
			</div>
		</div>
		<!-- Panel Body !-->

		<div class="panel-body">

			<!-- Panel -Room Type Number General Information !-->

			<div class="form-group">

				<div class="col-xs-3" style="display: none;">
					<label>Size No</label> <input type="text" class="form-control"
						name="f_sizeno" value="<?php echo $GLOBALS ['xSizeNo']; ?>" readonly="readonly"
						>
				</div>
				<div class="col-xs-3">
					<label>Size Name</label> <input type="text" class="form-control"
						name="f_sizename" value="<?php echo $GLOBALS ['xSizeName']; ?>"
						>
				</div>
				
				<div class="col-xs-3">
					<label>Size A</label> <input type="text" class="form-control"
						name="f_sizea" value="<?php echo $GLOBALS ['xSizeA']; ?>"
						>
				</div>
				
				<div class="col-xs-3">
					<label>Size B</label> <input type="text" class="form-control"
						name="f_sizeb" value="<?php echo $GLOBALS ['xSizeB']; ?>"
						>
				</div>
			</div>


		</div>
		<!-- Panel -Room Type Number Information Ended !-->

		<div class="panel-footer clearfix">
			<div class="pull-right">

				<input type="submit" name="f_BtnSaveSize" class="btn btn-primary"
					value="SAVE" id="add" onclick="return validateForm()">
						<input type="submit" name="f_BtnUpdateSize" class="btn btn-primary"
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
				<h3 class="panel-title">VIEW SIZE DETAILS</h3>
			</div>
			<div class="input-group">
				<span class="input-group-addon">Filter</span> <input id="filter"
					type="text" class="form-control">
			</div>
			<table class="table">
				<thead>
					<tr>

						<th width="30%">SIZE NAME</th>
						<th width="5%" colspan="2">ACTIONS</th>
				
					</tr>
				</thead>
				<tbody class="searchable">
					<tr>

<?php
$xQry = '';
$xSlNo = 0;
$xTotalAmount = 0;
$xQry = "SELECT *  from m_size  order by sizeno";
$result2 = mysql_query ( $xQry );
$rowCount = mysql_num_rows ( $result2 );
echo '</br>';

while ( $row = mysql_fetch_array ( $result2 ) ) {
	echo '<td>' . $row ['sizename']. '</td>';
	?>
					<td><a
							href="inv_hm008size.php<?php echo '?sizeno='.$row['sizeno']. '&xmode=edit';  ?>"
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

<?php
include 'globalfile.php';

if (isset ( $_GET ['salesperson_id'] ) && ! empty ( $_GET ['salesperson_id'] )) {
	$xGetsalesperson_id = $_GET ['salesperson_id'];
	if ($_GET ['xmode'] == 'edit') {
		$GLOBALS ['xMode'] = 'F';
		DataFetch ( $_GET ['salesperson_id'] );
	} else {
		$xQry = "DELETE FROM m_salesperson WHERE salesperson_id=$xGetsalesperson_id";
		$result = mysql_query ( $xQry );
		if (! $result) {
			die ( 'Invalid query: ' . mysql_error () );
		} else {
			header ( 'Location: m_salesperson.php' );
		}
	}
} else {
	fn_DataClear ();
}

if (isset ( $_POST ['save_salesperson'] )) {
	DataProcess ( "S" );
} elseif (isset ( $_POST ['update_salesperson'] )) {
	DataProcess ( "U" );
}
function DataFetch($xsalesperson_id) {
	$result = mysql_query ( "SELECT *  FROM m_salesperson 
			WHERE salesperson_id=$xsalesperson_id" ) or die ( mysql_error () );
	$count = mysql_num_rows ( $result );
	if ($count > 0) {
		while ( $row = mysql_fetch_array ( $result ) ) {
			
			$GLOBALS ['xsalesperson_id'] = $row ['salesperson_id'];
			$GLOBALS ['xsalesperson_name'] = $row ['salesperson_name'];
			$GLOBALS ['xsalesperson_mobileno'] = $row ['salesperson_mobileno'];
			$GLOBALS ['xsalesperson_address'] = $row ['salesperson_address'];
		}
	}
}
function fn_DataClear() {
	$xQry = "";
	$xMsg = "";
	$GLOBALS ['xsalesperson_id'] = '';
	$GLOBALS ['xsalesperson_name'] = '';
	$GLOBALS ['xsalesperson_mobileno'] = '';
	$GLOBALS ['xsalesperson_address'] = '';
}
function DataProcess($mode) {
	$xsalesperson_id = $_POST ['f_salesperson_id'];
	$xsalesperson_name = $_POST ['f_salesperson_name'];
	$xsalesperson_mobileno = $_POST ['f_salesperson_mobileno'];
	$xsalesperson_address = $_POST ['f_salesperson_address'];
	
	$xQry = "";
	$xMsg = "";
	if ($mode == 'S') {
		$xQry = "INSERT INTO m_salesperson
		(salesperson_name,salesperson_mobileno,salesperson_address)
		VALUES('$xsalesperson_name','$xsalesperson_mobileno','$xsalesperson_address')";
		
		mysql_query ( $xQry ) or die ( mysql_error () );
		echo '<script type="text/javascript">swal("Good job!", "salesperson Created!", "success");</script>';
	} elseif ($mode == 'U') {
		mysql_query ( "update m_salesperson set 
				salesperson_name='$xsalesperson_name',
				salesperson_mobileno='$xsalesperson_mobileno',
				salesperson_address='$xsalesperson_address'
				WHERE salesperson_id=$xsalesperson_id" ) or die ( mysql_error () );
	}
}

?>
<link href='css/fonts.css' rel='stylesheet' type='text/css'>
<link href='css/newstyle.css' rel='stylesheet' type='text/css'>

<body onload='document.salesperson_creation.f_salesperson_name.focus()'>
	<div class="form-style-8">
		<h2>Employee Creation</h2>
		<form class="form" name="salesperson_creation"
			action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

			<input type="text" name="f_salesperson_id" placeholder="No"
				value="<?php echo $GLOBALS ['xsalesperson_id']; ?>"
				style="display: none;" /> 
				
				<input type="text"
				name="f_salesperson_name" placeholder="Name"
				value="<?php echo $GLOBALS ['xsalesperson_name']; ?>" /> 
				<input
				type="text" name="f_salesperson_mobileno"
				value="<?php echo  $GLOBALS ['xsalesperson_mobileno']; ?>" 
				placeholder="Mobile No" />
				<label>Joining Date:</label>
				<input
				type="date" name="f_salesperson_mobileno"
				value="<?php echo  $GLOBALS ['xsalesperson_mobileno']; ?>" 
				placeholder="Mobile No" />
			<input type="text" name="f_salesperson_address"
				value="<?php echo  $GLOBALS ['xsalesperson_address']; ?>"
				placeholder="Address" /> 
				  <?php if ($GLOBALS ['xMode'] == "") {  ?> 
			 <input type="submit" name="save_salesperson" value="Save"
				accesskey="s" />
				  <?php } else{ ?>
				  			 <input type="submit" name="update_salesperson" value="Update"
				accesskey="s" />
				  	   <?php }  ?>
		</form>
	</div>

	<div id="divToPrint">
		<div class="container">
			<div class="panel panel-info">

				<!-- Default panel contents -->
				<div class="panel-heading  text-center">
					<h3 class="panel-title">Employee Details</h3>
				</div>
				<div class="input-group">
					<span class="input-group-addon">Filter</span> <input id="filter"
						type="text" class="form-control">
				</div>
				<table class="table">
					<tr>
						<th>Name</th>
						<th>Mobile No</th>
						<th>Address</th>
						<th>Edit</th>
						<th>Delete</th>
					</tr>
					<tbody class="searchable">
						<tr>
<?php
$xQry = '';
$xSlNo = 0;
$xTotalAmount = 0;
$xQry = "SELECT *  from m_salesperson  order by salesperson_name";
$result2 = mysql_query ( $xQry );
$rowCount = mysql_num_rows ( $result2 );
echo '</br>';

while ( $row = mysql_fetch_array ( $result2 ) ) {
	
	echo '<td width=30%>' . $row ['salesperson_name'] . '</td>';
	echo '<td width=30%>' . $row ['salesperson_mobileno'] . '</td>';
	echo '<td width=30%>' . $row ['salesperson_address'] . '</td>';
	?>
	<td><a
								href="m_salesperson.php<?php echo '?salesperson_id='.$row['salesperson_id']. '&xmode=edit';  ?>"
								onclick="return confirm_edit()"> <img src="images/edit.png"
									style="width: 30px; height: 30px; border: 0">
							</a></td>
							<td><a
								href="m_salesperson.php<?php echo '?salesperson_id='.$row['salesperson_id']. '&xmode=delete';  ?>"
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
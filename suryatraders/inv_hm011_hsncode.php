<?php
include 'globalfile.php';
fn_DataClear ();
if (isset ( $_GET ['hsncodeid'] ) && ! empty ( $_GET ['hsncodeid'] )) {
	$no = $_GET ['hsncodeid'];
	if ($_GET ['xmode'] == 'edit') {
		$GLOBALS ['xMode'] = 'F';
		DataFetch ( $_GET ['hsncodeid'] );
	} else {
		$xQry = "DELETE FROM m_hsncode WHERE hsncodeid= $no";
		$result = mysql_query ( $xQry );
		if (! $result) {
			die ( 'This Item is Referring to Some Where Else' );
		}
		header ( 'Location: inv_hm011_hsncode.php' );
	}
} else {

}
$GLOBALS ['xCurrentDate'] = date ( 'Y-m-d H:i:s' );

if (isset ( $_POST ['save'] )) {
	
	DataProcess ( "S" );
} elseif (isset ( $_POST ['update'] )) {
	DataProcess ( "U" );
}
function fn_DataClear() {
	$GLOBALS ['xhsncode'] = '';
	$GLOBALS ['xhsncodeid'] = '';

}

function DataFetch($xhsncodeid) {
	$result = mysql_query ( "SELECT *  FROM m_hsncode where hsncodeid=$xhsncodeid" ) or die ( mysql_error () );
	$count = mysql_num_rows ( $result );
	if ($count > 0) {
		while ( $row = mysql_fetch_array ( $result ) ) {
			
			$GLOBALS ['xhsncode'] = $row ['hsncode'];
			$GLOBALS ['xhsncodeid'] = $row ['hsncodeid'];

			
		}
	}
}
function DataProcess($mode) {
	$xhsncode = $_POST ['f_hsncode'];
	$xhsncodeid = $_POST ['f_hsncodeid'];
	
	$xQry = "";
	$xMsg = "";
	if ($mode == 'S') {
		
		$xQry = "INSERT INTO m_hsncode(hsncode)  VALUES ('$xhsncode')";
		$xQ1 = mysql_query ( $xQry );

	} elseif ($mode == 'U') {
		$xQry = "UPDATE m_hsncode   SET hsncode='$xhsncode' WHERE hsncodeid=$xhsncodeid";
		//ECHO $xQry;
		$xMsg = "Updated";
				//header ( 'Location: inv_hm011_hsncode.php' );
		$retval = mysql_query ( $xQry ) or die ( mysql_error () );
		if (! $retval) {
			die ( 'Could not enter data: ' . mysql_error () );
		}
	}
	
	//GetMaxIdNo ();
	ShowAlert ( $xMsg );
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Item</title>
</head>
<!--<link rel="stylesheet" href="../css/table.css">!-->

<script type="text/javascript" src="../js/table.js"></script>

<body onload='document.itemform.f_itemname.focus()'>
	<form class="form" name="itemform"
		action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<div class="panel panel-primary">
			<div class="panel-heading  text-center">
				<h3 class="panel-title">MASTER -ITEM</h3>
			</div>
			<div class="panel-body">
							<div class="col-xs-2" >
					<input type="text" class="form-control" id=""f_hsncodeid""
						name="f_hsncodeid" value="<?php echo $GLOBALS ['xhsncodeid']; ?>" readonly
						>
				</div>
			

				<div class="col-xs-2" >
					<input type="text" class="form-control" id="f_hsncode"
						name="f_hsncode" value="<?php echo $GLOBALS ['xhsncode']; ?>"
						>
				</div>



			</div>
		</div>
		<!-- PANEL BODY !-->
		<div class="panel-footer clearfix">
			<div class="pull-right">
	  <?php if ($GLOBALS ['xMode'] == "") {  ?> 
		   <input type="submit" name="save" class="btn btn-primary"
					value="SAVE" id="save" onclick="return validateForm()"> 
	   <?php } else{ ?>
		   <input type="submit" name="update" class="btn btn-primary"
					value="UPDATE" onclick="return validateForm()"> 
	   <?php }  ?>
	</div>
		</div>


		<!-- PANEL !-->
	</form>

	<hr>

	<!--             ----------------------- REPORT GOES HERE  ------------------------  !-->
	<div id="divToPrint">
		<div class="container">
			<div class="panel panel-info">
				<div class="panel-heading  text-center">
					<h3 class="panel-title">View HSNCODE</h3>
				</div>
				<table class="table table-hover" border="1">
					<thead>
		
						<tr>
											<th width="20%">HSNCODEID</th>
							<th width="70%">HSNCODE</th>
										<th width="10%">Actions</th>
						</tr>
					</thead>
					<tbody>
						<tr>

<?php
$xQry = '';
$xQry = "SELECT *  from m_hsncode";
$result2 = mysql_query ( $xQry );
while ( $row = mysql_fetch_array ( $result2 ) ) {
	echo '<td>' . $row ['hsncodeid'] . '</td>';
	echo '<td>' . $row ['hsncode'] . '</td>';



?>	
<td><a href="inv_hm011_hsncode.php<?php echo '?hsncodeid='.$row['hsncodeid'] . '&xmode=edit'; ?>"  onclick="return confirm_edit()">
  <img src="images/edit.png" alt="HTML tutorial" style="width:30px;height:30px;border:0">
</a>
</td>


</tr>
<?php }?>
					
					</tbody>
				</table>
			</div>
			<!-- /container -->
		</div>
	</div>

	<!--             ----------------------- REPORT ENDS HERE  ------------------------  !-->
</body>
</html>

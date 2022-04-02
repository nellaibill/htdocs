<?php
include 'globalfile.php';
fn_DataClear ();
if (isset ( $_GET ['userno'] ) && ! empty ( $_GET ['userno'] )) {
	$no = $_GET ['userno'];
	if ($_GET ['xmode'] == 'edit') {
		DataFetch ( $_GET ['userno'] );
	} else {
		$xQry = "DELETE FROM m_login WHERE userno= $no";
		mysql_query ( $xQry );
		header ( 'Location: inv_hm010userdetails.php.php' );
	}
} else {
	GetMaxIdNo ();
}
if (isset ( $_POST ['save'] )) {
	DataProcess ( "S" );
} elseif (isset ( $_POST ['update'] )) {
	DataProcess ( "U" );
}
function fn_DataClear() {
	$GLOBALS ['xUserName'] = '';
	$GLOBALS ['xPassword'] = '';
	$GLOBALS ['xLoginDepartmentNo'] = '';
	$GLOBALS ['xRole'] = '';
}
function GetMaxIdNo() {
	$result = mysql_query ( "SELECT  CASE WHEN max(userno)IS NULL OR max(userno)= '' THEN '1' ELSE max(userno)+1 END AS userno FROM m_login" ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xUserNo'] = $row ['userno'];
	}
}
function DataFetch($xuserno) {
	$result = mysql_query ( "SELECT *  FROM m_login where userno=$xuserno" ) or die ( mysql_error () );
	$count = mysql_num_rows ( $result );
	if ($count > 0) {
		while ( $row = mysql_fetch_array ( $result ) ) {
			$GLOBALS ['xUserNo'] = $row ['userno'];
			$GLOBALS ['xUserName'] = $row ['username'];
			$GLOBALS ['xPassword'] = $row ['password'];
			$GLOBALS ['xLoginDepartmentNo'] = $row ['departmentno'];
			$GLOBALS ['xRole'] = $row ['role'];
		}
	}
}
function DataProcess($mode) {
	$xUserNo = $_POST ['f_userno'];
	$xUserName = strtoupper ( $_POST ['f_username'] );
	$xPassword = strtoupper ( $_POST ['f_password'] );
	$xDepartmentNo = $_POST ['f_departmentno'];
	$xRole = $_POST ['f_role'];
	$xQry = "";
	$xMsg = "";
	if ($mode == 'S') {
		$xQry = "INSERT INTO m_login VALUES ($xUserNo,'$xUserName','$xPassword',$xDepartmentNo,'$xRole')";
		$xMsg = "Inserted";
	} elseif ($mode == 'U') {
		$xQry = "UPDATE m_login  SET  username='$xUserName',password='$xPassword',departmentno=$xDepartmentNo,role='$xRole' WHERE userno=$xUserNo";
		$xMsg = "Updated";
	} elseif ($mode == 'D') {
		$xQry = "DELETE FROM m_login WHERE userno=$xTxno";
		$xMsg = "Deleted";
	}
	$retval = mysql_query ( $xQry ) or die ( mysql_error () );
	if (! $retval) {
		die ( 'Could not enter data: ' . mysql_error () );
	}
	// echo $xQry;
	GetMaxIdNo ();
	ShowAlert ( $xMsg );
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
<body onload='document.userpage.f_username.focus()'>

			<form class="form" name="userpage"
				action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<div class="panel panel-success">
		<div class="panel-heading">
			<h3 class="panel-title text-center">USER-CREDENTIALS</h3>
		</div>
		<div class="panel-body">
				<div class="form-group" style="display: none">
					<div class="col-xs-2">
						<input type="text" class="form-control" name="f_userno" id=""
							value="<?php echo $GLOBALS ['xUserNo']; ?>" placeholder=""
							readonly>
					</div>
				</div>
				<div class="form-group">
					<div class="col-xs-2">
						<input type="text" class="form-control" name="f_username" id=""
							value="<?php echo $GLOBALS ['xUserName']; ?>"
							placeholder="USERNAME">
					</div>
					<div class="col-xs-2">
						<input type="text" class="form-control" name="f_password" id=""
							value="<?php echo $GLOBALS ['xPassword']; ?>"
							placeholder="PASSWORD">
					</div>
					<div class="col-xs-2">
						<select class="form-control" id=""  name="f_departmentno">
							<option value="1"
								<?php if($GLOBALS ['xLoginDepartmentNo']=="1") echo 'selected="selected"'; ?>>SALES</option>
							<option value="2"
								<?php  if($GLOBALS ['xLoginDepartmentNo']=="2") echo 'selected="selected"'; ?>>PURCHASE</option>
							<option value="3"
								<?php  if($GLOBALS ['xLoginDepartmentNo']=="3") echo 'selected="selected"'; ?>>MANAGER</option>
						</select>
					</div>
					<div class="col-xs-2">
						<select class="form-control" id="" name="f_role">
							<option value="U"
								<?php if($GLOBALS ['xRole']=="U") echo 'se  lected="selected"'; ?>>USER</option>
							<option value="S"
								<?php if( $GLOBALS ['xRole']=="S") echo 'selected="selected"'; ?>>SUPER-USER</option>
							<option value="A"
								<?php if( $GLOBALS ['xRole']=="A") echo 'selected="selected"'; ?>>ADMIN</option>
						</select>

					</div>
				</div>
		</div>
		
		<div class="panel-footer clearfix">
			<div class="pull-right">
				<input type="submit" name="save" class="btn btn-primary"
					value="SAVE" id="save"> <input type="submit" name="update"
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
						<h3 class="panel-title">VIEW CREDENTIALS</h3>
					</div>
					<table class="table">
						<thead>
							<tr>
								<th width="20%">USERNAME</th>
								<th width="20%">PASSWORD</th>
								<th width="20%">DEPARTMENT</th>
								<th width="10%">ROLE</th>
								<th colspan="2" width="10%">ACTIONS</th>
							</tr>
						</thead>
						<tbody>
							<tr>

<?php

$xQry = "SELECT *  from m_login where userno!=3";
$result2 = mysql_query ( $xQry );
while ( $row = mysql_fetch_array ( $result2 ) ) {
	echo '<td>' . $row ['username'] . '</td>';
	echo '<td>' . $row ['password'] . '</td>';
	echo '<td>' . $row ['departmentno'] . '</td>';
	echo '<td>' . $row ['role'] . '</td>';
	
	?>
<td><a
									href="inv_hm010userdetails.php.php<?php echo '?userno='.$row['userno'] . '&xmode=edit'; ?>"
									onclick="return confirm_edit()"> <img src="images/edit.png"
										alt="HTML tutorial"
										style="width: 30px; height: 30px; border: 0">
								</a></td>
								<td><a
									href="inv_hm010userdetails.php.php<?php echo '?userno='.$row['userno']. '&xmode=delete';  ?>"
									onclick="return confirm_delete()"> <img src="images/delete.png"
										alt="HTML tutorial"
										style="width: 30px; height: 30px; border: 0">
								</a></td>
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
<?php
fn_DataClear ();
include 'globalfile.php';
//echo $GLOBALS ['xItemCategoryNo'];

if (isset ( $_GET ['itemcategoryno'] ) && ! empty ( $_GET ['itemcategoryno'] )) {
	$GLOBALS ['xItemCategoryNo']=$_GET ['itemcategoryno'];
}
if (isset ( $_GET ['itemgroupno'] ) && ! empty ( $_GET ['itemgroupno'] )) {
	$no = $_GET ['itemgroupno'];
	if ($_GET ['xmode'] == 'edit') {
		$GLOBALS ['xMode'] = 'F';
		DataFetch ( $_GET ['itemgroupno'] );
	} else {
		$xQry = "DELETE FROM m_itemgroup WHERE itemgroupno= $no";
		mysql_query ( $xQry ) or die ( mysql_error () );
		echo '<script type="text/javascript">swal("Good job!", "Deleted!", "success");</script>';
		header ( 'Location: inv_hm003itemgroup.php' );
	}
} else {
	GetMaxIdNo ();
}
$GLOBALS ['xCurrentDate'] = date ( 'Y-m-d H:i:s' );

if (isset ( $_POST ['save'] )) {
	
	DataProcess ( "S" );
} elseif (isset ( $_POST ['update'] )) {
	DataProcess ( "U" );
}
function fn_DataClear() {
	$GLOBALS ['xItemGroupNo'] = '';
	$GLOBALS ['xItemGroupName'] = '';
	$GLOBALS ['xItemCategoryNo'] = '';
}
function GetMaxIdNo() {
	$sql = "SELECT  CASE WHEN max(itemgroupno)IS NULL OR max(itemgroupno)= '' 
   THEN '1' 
   ELSE max(itemgroupno)+1 END AS itemgroupno
FROM m_itemgroup";
	$result = mysql_query ( $sql ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xItemGroupNo'] = $row ['itemgroupno'];
	}
}
function DataFetch($xItemGroupNo) {
	$result = mysql_query ( "SELECT *  FROM m_itemgroup where itemgroupno=$xItemGroupNo" ) or die ( mysql_error () );
	$count = mysql_num_rows ( $result );
	if ($count > 0) {
		while ( $row = mysql_fetch_array ( $result ) ) {
			$GLOBALS ['xItemGroupNo'] = $row ['itemgroupno'];
			$GLOBALS ['xItemGroupName'] = $row ['itemgroupname'];
			$GLOBALS ['xItemCategoryNo'] = $row ['itemcategoryno'];
		}
	}
}
function DataProcess($mode) {
	$xItemGroupNo = $_POST ['f_itemgroupno'];
	$xItemGroupName = strtoupper ( $_POST ['f_itemgroupname'] );
	$xItemCategoryNo = $_POST ['f_itemcategoryno'];
	
	$xQry = "";
	$xMsg = "";
	if ($mode == 'S') {
		$xQry = "INSERT INTO m_itemgroup  VALUES ($xItemGroupNo,$xItemCategoryNo,'$xItemGroupName')";
		echo '<script type="text/javascript">swal("Good job!", "Inserted!", "success");</script>';
	} elseif ($mode == 'U') {
		$xQry = "UPDATE m_itemgroup   SET itemgroupname='$xItemGroupName',itemcategoryno=$xItemCategoryNo WHERE itemgroupno=$xItemGroupNo";
		echo '<script type="text/javascript">swal("Good job!", "Updated!", "success");</script>';
	}
	$retval = mysql_query ( $xQry ) or die ( mysql_error () );
	GetMaxIdNo ();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Group</title>
</head>
<script type="text/javascript">
function validateForm() 
{

var xItemGroupName= document.forms["itemgroupform"]["f_itemgroupname"].value;
if (xItemGroupName== null || xItemGroupName== "") 
{
	alert("Doctor-Name must be filled out");
	document.itemgroupform.f_itemgroupname.focus();
	return false;
}


}

document.getElementById("save").value="SAVE"; 
function changeupdate()
{
document.getElementById("save").value="UPDATE"; 
}

</script>
<body onload='document.itemgroupform.f_itemgroupname.focus()'>
	<form class="form" name="itemgroupform"
		action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<div class="panel panel-success">
			<div class="panel panel-info">
				<div class="panel-heading  text-center">
					<h3 class="panel-title">Master Item Group</h3>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<div class="col-xs-2" style=" display: none;">

							<label> NO</label> <input type="text" class="form-control"
								id="f_itemgroupno" name="f_itemgroupno"
								value="<?php echo $GLOBALS ['xItemGroupNo']; ?>" readonly>
						</div>
						<div class="col-xs-4">

							<label>ITEM GROUP NAME</label> <input type="text"
								class="form-control" name="f_itemgroupname"
								value="<?php echo $GLOBALS ['xItemGroupName']; ?>"
								placeholder="">
						</div>


						<div class="col-xs-4">
							<label>CHOOSE CATEGORY</label> <select class="form-control"
								name="f_itemcategoryno">
		<?php
		$result = mysql_query ( "SELECT *  FROM m_itemcategory  where itemcategoryno!=0 " );
	
		while ( $row = mysql_fetch_array ( $result ) ) {
			?>

  <option value="<?php echo $row['itemcategoryno']; ?>"
									<?php
			if ($row ['itemcategoryno'] == $GLOBALS ['xItemCategoryNo']) {
				echo 'selected="selected"';
			}
			?>>
		<?php echo $row['itemcategoryname']; ?> 
		</option>

		 <?php
		}
		?>
		 </select>
						</div>
					</div>
				</div>
			</div>
			<div class="panel-footer clearfix">
				<div class="pull-right">
	  <?php if ($GLOBALS ['xMode'] == "") {  ?> 
		   <input type="submit" name="save" class="btn btn-primary"
						value="SAVE" id="save" onclick="return validateForm()" accesskey="s"> 
	   <?php } else{ ?>
		   <input type="submit" name="update" class="btn btn-primary"
						value="UPDATE" onclick="return validateForm()" accesskey="s"> 
	   <?php }  ?>
	</div>
			</div>
		</div>

	</form>
	<hr>

	<!--             ----------------------- REPORT GOES HERE  ------------------------  !-->
	<div id="divToPrint">
		<div class="container">
			<div class="panel panel-info">
				<div class="panel-heading  text-center">
					<h3 class="panel-title">View Item Group</h3>
				</div>
				<table class="table table-hover" border="1">
					<thead>
						<tr>
							<th width="45%">ITEM GROUP NAME</th>
							<th width="45%">ITEM CATEGORY NAME</th>
							<th colspan="2" width="5%">ACTIONS</th>
						</tr>
					</thead>
					<tbody>

<?php



$xQry = '';
if (isset ( $_GET ['itemcategoryno'] ) && ! empty ( $_GET ['itemcategoryno'] )) {
	$xItemCategoryNo=$_GET ['itemcategoryno'];
	$xQry = "SELECT *  from m_itemgroup where itemgroupno!=0 
	and itemcategoryno= $xItemCategoryNo order by  itemgroupno ";
	
}
else
{
$xQry = "SELECT *  from m_itemgroup where itemgroupno!=0 order by  itemgroupname ";
}


$result2 = mysql_query ( $xQry );
$rowCount = mysql_num_rows ( $result2 );
echo '</br>';

while ( $row = mysql_fetch_array ( $result2 ) ) {
	?>
	<tr class='clickable-row'
								data-href='inv_hm005item.php<?php echo '?itemgroupno='.$row['itemgroupno'] . '&xmode=entry'; ?>'>
	<?php
	echo '<td>' . $row ['itemgroupname'] . '</td>';
	finditemcategoryname ( $row ['itemcategoryno'] );
	echo '<td>' . $GLOBALS ['xItemCategoryName'] . '</td>';
	
	?>
<td><a
							href="inv_hm003itemgroup.php<?php echo '?itemgroupno='.$row['itemgroupno'] . '&xmode=edit'; ?>"
							onclick="return confirm_edit()"> <img src="images/edit.png"
								alt="HTML tutorial" style="width: 30px; height: 30px; border: 0">
						</a></td>
						<td><a
							href="inv_hm003itemgroup.php<?php echo '?itemgroupno='.$row['itemgroupno']. '&xmode=delete';  ?>"
							onclick="return confirm_delete()"> <img src="images/delete.png"
								alt="HTML tutorial" style="width: 30px; height: 30px; border: 0">
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
</html>
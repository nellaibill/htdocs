

<?php
include 'globalfile.php';
fn_DataClear ();
if (isset ( $_GET ['itemcategoryno'] ) && ! empty ( $_GET ['itemcategoryno'] )) {
	$no = $_GET ['itemcategoryno'];
	if ($_GET ['xmode'] == 'edit') {
		$GLOBALS ['xMode'] = 'F';
		DataFetch ( $_GET ['itemcategoryno'] );
	} else {
		$xQry = "DELETE FROM m_itemcategory WHERE itemcategoryno= $no";
		mysql_query ( $xQry ) or die ( mysql_error () );
		echo '<script type="text/javascript">swal("Good job!", "Deleted!", "success");</script>';
		header ( 'Location: inv_hm002itemcategory.php' );
	}
} elseif (isset ( $_POST ['save'] )) {
	
	DataProcess ( "S" );
} elseif (isset ( $_POST ['update'] )) {
	DataProcess ( "U" );
} 

else {
	GetMaxIdNo ();
}
function fn_DataClear() {
	$GLOBALS ['xItemCategoryNo'] = '';
	$GLOBALS ['xItemCategoryName'] = '';
	$GLOBALS ['xItemCategoryShortName'] = '';
	$GLOBALS ['xItemCategoryColor'] = '';
}
function GetMaxIdNo() {
	$sql = "SELECT  CASE WHEN max(itemcategoryno)IS NULL OR max(itemcategoryno)= '' 
   THEN '1' 
   ELSE max(itemcategoryno)+1 END AS itemcategoryno
FROM m_itemcategory";
	$result = mysql_query ( $sql ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xItemCategoryNo'] = $row ['itemcategoryno'];
	}
}
function DataFetch($xItemCategoryNo) {
	$result = mysql_query ( "SELECT *  FROM m_itemcategory where itemcategoryno=$xItemCategoryNo" ) or die ( mysql_error () );
	$count = mysql_num_rows ( $result );
	if ($count > 0) {
		while ( $row = mysql_fetch_array ( $result ) ) {
			
			$GLOBALS ['xItemCategoryNo'] = $row ['itemcategoryno'];
			$GLOBALS ['xItemCategoryName'] = $row ['itemcategoryname'];
			$GLOBALS ['xItemCategoryShortName'] = $row ['itemcategoryshortname'];
			$GLOBALS ['xItemCategoryColor'] = $row ['itemcategorycolor'];
		}
	}
}
function DataProcess($mode) {
	$xItemCategoryNo = $_POST ['f_itemcategoryno'];
	$xItemCategoryName = strtoupper ( $_POST ['f_itemcategoryname'] );
	$xItemCategoryShortName = strtoupper ( $_POST ['f_itemcategoryshortname'] );
	$xItemCategoryColor = $_POST ['f_itemcategorycolor'];
	$xQry = "";
	$xMsg = "";
	if ($mode == 'S') {
		$xQry = "INSERT INTO m_itemcategory  VALUES ($xItemCategoryNo,'$xItemCategoryName','$xItemCategoryShortName','$xItemCategoryColor')";
		echo '<script type="text/javascript">swal("Good job!", "Saved!", "success");</script>';
		// echo '<script type="text/javascript">swal("Good job!", "Inserted!", "success");</script>';
	} elseif ($mode == 'U') {
		$xQry = "UPDATE m_itemcategory   SET itemcategoryname='$xItemCategoryName',itemcategoryshortname='$xItemCategoryShortName',itemcategorycolor='$xItemCategoryColor' WHERE itemcategoryno=$xItemCategoryNo";
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
<title>Category</title>
</head>

<body onload='document.itemcategoryform.f_itemcategoryname.focus()'>
	<form class="form" name="itemcategoryform"
		action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<div class="panel panel-success">
			<div class="panel panel-info">
				<div class="panel-heading  text-center">
					<h3 class="panel-title">Master Item Category</h3>
				</div>
				<div class="panel-body">
					<div class="form-group">

						<div class="col-xs-2" style="display: none">
							<label> NO</label> <input type="text" class="form-control"
								id="f_itemcategoryno" name="f_itemcategoryno"
								value="<?php echo $GLOBALS ['xItemCategoryNo']; ?>" readonly>
						</div>

						<div class="col-xs-4">

							<label>CATEGORY NAME</label> <input type="text"
								class="form-control" name="f_itemcategoryname"
								value="<?php echo $GLOBALS ['xItemCategoryName']; ?>">
						</div>
						<div class="col-xs-1" style="display: none;">
							<input type="color" class="form-control"
								name="f_itemcategorycolor"
								value="<?php echo $GLOBALS ['xItemCategoryColor']; ?>">
						</div>
						<div class="col-xs-4" style="display: none">

							<label>SHORT NAME</label> <input type="text" class="form-control"
								name="f_itemcategoryshortname" maxlength="20"
								value="<?php echo $GLOBALS ['xItemCategoryShortName']; ?>"
								placeholder="">
						</div>

					</div>
					</div></div>

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
	<!--             ----------------------- REPORT GOES HERE  ------------------------  !-->

	<div id="divToPrint">
		<div class="container">
			<div class="panel panel-info">
				<div class="panel-heading  text-center">
					<h3 class="panel-title">View Item Category</h3>
				</div>
				<table class="table table-hover" border="1">
					<thead>
						<tr>
							<th width="5%">NO</th>
							<th width="50%">CATEGORY NAME</th>
							<th colspan="2" width="5%">ACTIONS
							
							</th>
						</tr>
					</thead>
					<tbody>
<tr>
<?php
$xQry = '';
$xQry = "SELECT *  from m_itemcategory where itemcategoryno!=0 order by  itemcategoryno";
$result2 = mysql_query ( $xQry );
$rowCount = mysql_num_rows ( $result2 );
echo '</br>';

while ( $row = mysql_fetch_array ( $result2 ) ) {
	?>
		<tr class='clickable-row'
								data-href='inv_hm003itemgroup.php<?php echo '?itemcategoryno='.$row['itemcategoryno'] . '&xmode=entry'; ?>'>
	<?php 
	echo '<td>' . $row ['itemcategoryno'] . '</td>';
	echo '<td>' . $row ['itemcategoryname'] . '</td>';
	
	?>
<td><a
							href="inv_hm002itemcategory.php<?php echo '?itemcategoryno='.$row['itemcategoryno'] . '&xmode=edit'; ?>"
							onclick="return confirm_edit()"> <img src="images/edit.png"
								alt="HTML tutorial" style="width: 30px; height: 30px; border: 0">
						</a></td>
						<!--  <td><a
							href="inv_hm002itemcategory.php<?php echo '?itemcategoryno='.$row['itemcategoryno']. '&xmode=delete';  ?>"
							onclick="return confirm_delete()"> <img src="images/delete.png"
								alt="HTML tutorial" style="width: 30px; height: 30px; border: 0">
						</a></td>
!-->
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


<script type="text/javascript">
function validateForm() 
{
var xItemCategoryName= document.forms["itemcategoryform"]["f_itemcategoryname"].value;
var xItemCategoryShortName= document.forms["itemcategoryform"]["f_itemcategoryshortname"].value;
if (xItemCategoryName== null || xItemCategoryName== "") 
{
	alert("Category-Name must be filled out");
	document.itemcategoryform.f_itemcategoryname.focus();
	return false;
}


}
</script>



</body>
</html>
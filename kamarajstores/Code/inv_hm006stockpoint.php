<?php
include 'globalfile.php';
fn_DataClear ();

if (isset ( $_GET ['stockpointno'] ) && ! empty ( $_GET ['stockpointno'] )) {
	$no = $_GET ['stockpointno'];
	if ($_GET ['xmode'] == 'edit') {
		$GLOBALS ['xMode'] = 'F';
		DataFetch ( $_GET ['stockpointno'] );
	} else {
		$xQry = "DELETE FROM m_stockpoint WHERE stockpointno= $no";
		mysql_query ( $xQry ) or die ( mysql_error () );
		header ( 'Location: inv_hm006stockpoint.php' );
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
	$GLOBALS ['xStockPointNo'] = '';
	$GLOBALS ['xStockPointName'] = '';
	$GLOBALS ['xStockPointShortName'] = '';
}
function GetMaxIdNo() {
	$sql = "SELECT  CASE WHEN max(stockpointno)IS NULL OR max(stockpointno)= '' 
   THEN '1' 
   ELSE max(stockpointno)+1 END AS stockpointno
FROM m_stockpoint";
	$result = mysql_query ( $sql ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xStockPointNo'] = $row ['stockpointno'];
	}
}
function DataFetch($xStockPointNo) {
	$result = mysql_query ( "SELECT *  FROM m_stockpoint where stockpointno=$xStockPointNo" ) or die ( mysql_error () );
	$count = mysql_num_rows ( $result );
	if ($count > 0) {
		while ( $row = mysql_fetch_array ( $result ) ) {
			$GLOBALS ['xStockPointNo'] = $row ['stockpointno'];
			$GLOBALS ['xStockPointName'] = $row ['stockpointname'];
			$GLOBALS ['xStockPointShortName'] = $row ['stockpointshortname'];
		}
	}
}
function DataProcess($mode) {
	GetMaxIdNo ();
	$xStockPointNo = $_POST ['f_stockpointno'];
	$xStockPointName = strtoupper ( $_POST ['f_stockpointname'] );
	$xStockPointShortName = strtoupper ( $_POST ['f_stockpointshortname'] );
	$xQry = "";
	$xMsg = "";
	if ($mode == 'S') {
		$xQry = "INSERT INTO m_stockpoint  VALUES ($xStockPointNo,'$xStockPointName','$xStockPointShortName')";
		echo '<script type="text/javascript">swal("Good job!", "Inserted!", "success");</script>';
	} elseif ($mode == 'U') {
		$xQry = "UPDATE m_stockpoint   SET stockpointname='$xStockPointName',stockpointshortname='$xStockPointShortName' WHERE stockpointno=$xStockPointNo";
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
<title>StockPoint</title>
</head>
<script type="text/javascript">
function validateForm() 
{

var xStockPointName= document.forms["stockpointform"]["f_stockpointname"].value;
var xStockPointShortName= document.forms["stockpointform"]["f_stockpointshortname"].value;
if (xStockPointName== null || xStockPointName== "") 
{
	alert("StockPoint-Name must be filled out");
	document.stockpointform.f_stockpointname.focus();
	return false;
}


if (xStockPointShortName== null || xStockPointShortName== "") 
{
	alert("StockPoint Short-Name must be filled out");
	document.stockpointform.f_stockpointshortname.focus();
	return false;
}


}
</script>
<body onload='document.stockpointform.f_stockpointname.focus()'>
	<form class="form" name="stockpointform"
		action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<div class="panel panel-success">
			<div class="panel panel-info">
				<div class="panel-heading  text-center">
					<h3 class="panel-title">Master StockPoint</h3>
				</div>
			</div>
			<div class="panel-body">
				<div class="form-group">
					<div class="col-xs-2">

						<label>STOCK POINT NO</label> <input type="text"
							class="form-control" name="f_stockpointno"
							value="<?php echo $GLOBALS ['xStockPointNo']; ?>" readonly>
					</div>
					<div class="col-xs-4">

						<label>STOCK POINT NAME</label> <input type="text"
							class="form-control" name="f_stockpointname"
							value="<?php echo $GLOBALS ['xStockPointName']; ?>">
					</div>
					<div class="col-xs-4">

						<label>STOCK POINT SHORT NAME</label> <input type="text"
							class="form-control" name="f_stockpointshortname"
							value="<?php echo $GLOBALS ['xStockPointShortName']; ?>"
							maxlength="10">
					</div>
				</div>
			</div>
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
		</div>

	</form>


	<div id="divToPrint">
		<div class="container">
			<div class="panel panel-info">
				<!-- Default panel contents -->
				<div class="panel-heading  text-center">
					<h3 class="panel-title">View StockPoint</h3>
				</div>
				<table class="table">
					<thead>
						<tr>
							<th width="5%">S.NO</th>
							<th width="70%">STOCK POINT NAME</th>
							<th width="20%">SHORT NAME</th>
							<th colspan="2" width="5%">ACTIONS</th>
						</tr>
					</thead>
					<tbody>

<?php
$xSlNo = 0;
$xQry = "SELECT *  from m_stockpoint where stockpointno!=0 order by stockpointname ;";
$result2 = mysql_query ( $xQry );
while ( $row = mysql_fetch_array ( $result2 ) ) {
	?>
	<tr>
	<?php 
	echo '<td>' . $xSlNo += 1 . '</td>';
	echo '<td>' . $row ['stockpointname'] . '</td>';
	echo '<td>' . $row ['stockpointshortname'] . '</td>';
	?>
<td width="5%"><a
							href="inv_hm006stockpoint.php<?php echo '?stockpointno='.$row['stockpointno'] . '&xmode=edit'; ?>"
							onclick="return confirm_edit()"> <img src="images/edit.png"
								alt="HTML tutorial" style="width: 30px; height: 30px; border: 0"></a></td>
						<td width="5%"><a
							href="inv_hm006stockpoint.php<?php echo '?stockpointno='.$row['stockpointno']. '&xmode=delete';  ?>"
							onclick="return confirm_delete()"> <img src=" images/delete.png"
								alt="HTML tutorial" style="width: 30px; height: 30px; border: 0"></a></td>
<?php
	echo '</tr>';
}
?>	
</tbody>
				</table>
			</div></div></div>
			<!-- /container -->

</body>
</html>

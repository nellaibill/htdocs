<?php
fn_DataClear ();
include 'globalfile.php';

if (isset ( $_GET ['itemgroupno'] ) && ! empty ( $_GET ['itemgroupno'] )) {
	$GLOBALS ['xItemGroupNo'] = $_GET ['itemgroupno'];
}
if (isset ( $_GET ['itemno'] ) && ! empty ( $_GET ['itemno'] )) {
	$no = $_GET ['itemno'];
	if ($_GET ['xmode'] == 'edit') {
		$GLOBALS ['xMode'] = 'F';
		DataFetch ( $_GET ['itemno'] );
	} else {
		$xItemNo = $_GET ['itemno'];
		finditemstock ( $xItemNo );
		$xCurrentStock = $GLOBALS ['xCurrentStock'];
		if ($xCurrentStock == 0) {
			$xQry = "DELETE FROM inv_stockentry WHERE itemno= $no";
			$result = mysql_query ( $xQry );
			$xQry = "DELETE FROM m_item WHERE itemno= $no";
			$result = mysql_query ( $xQry );
			if (! $result) {
				die ( 'This Item is Referring to Some Where Else' );
			}
			header ( 'Location: inv_hm005item.php' );
		} else {
			echo '<script type="text/javascript">swal("Stock  ! ", "Stock Available on this item you cannot delete..", "error");</script>';
		}
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
	$GLOBALS ['xStockNo'] = '';
	$GLOBALS ['xItemNo'] = '';
	$GLOBALS ['xStockPointNo'] = '';
	$GLOBALS ['xItemCategoryNo'] = '';
	$GLOBALS ['xItemGroupNo'] = '';
	$GLOBALS ['xItemSubGroupNo'] = '';
	$GLOBALS ['xItemName'] = '';
	$GLOBALS ['xItemDescription'] = '';
	$GLOBALS ['xHSNCode'] = '';
	$GLOBALS ['xPackNo'] = 1;
	$GLOBALS ['xPackDescription'] = '';
	$GLOBALS ['xGst'] = '';
}
function GetMaxIdNo() {
	$sql = "SELECT  CASE WHEN max(itemno)IS NULL OR max(itemno)= '' 
   THEN '1' 
   ELSE max(itemno)+1 END AS itemno
FROM m_item";
	$result = mysql_query ( $sql ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xItemNo'] = $row ['itemno'];
	}
}
function GetMaxStockEntry() {
	$sql = "SELECT  CASE WHEN max(stockno)IS NULL OR max(stockno)= ''
   THEN '1'
   ELSE max(stockno)+1 END AS stockno
FROM inv_stockentry";
	$result = mysql_query ( $sql ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xStockNo'] = $row ['stockno'];
	}
}
function DataFetch($xItemNo) {
	$result = mysql_query ( "SELECT *  FROM m_item where itemno=$xItemNo" ) or die ( mysql_error () );
	$count = mysql_num_rows ( $result );
	if ($count > 0) {
		while ( $row = mysql_fetch_array ( $result ) ) {
			
			$GLOBALS ['xItemNo'] = $row ['itemno'];
			$GLOBALS ['xStockPointNo'] = $row ['stockpointno'];
			$GLOBALS ['xItemGroupNo'] = $row ['itemgroupno'];
			$GLOBALS ['xItemName'] = $row ['itemname'];
			$GLOBALS ['xItemDescription'] = $row ['itemdescription'];
			$GLOBALS ['xHSNCode'] = $row ['hsncode'];
			$GLOBALS ['xPackNo'] = $row ['packno'];
			$GLOBALS ['xPackDescription'] = $row ['packdescription'];
			$GLOBALS ['xGst'] = $row ['gst'];
		}
	}
}
function DataProcess($mode) {
	$xItemNo = $_POST ['f_itemno'];
	$xStockPointNo = $_POST ['f_stockpointno'];
	$xItemGroupNo = $_POST ['f_itemgroupno'];
	$xItemName = strtoupper ( $_POST ['f_itemname'] );
	$xItemDescription = $_POST ['f_itemdescription'];
	$xHSNCode = $_POST ['f_hsncode'];
	$xGst = $_POST ['f_gst'];
	$xPackNo = $_POST ['f_packno'];
	$xPackDescription = $_POST ['f_packdescription'];
	finditemgroupname ( $xItemGroupNo );
	$xItemCategoryNo = $GLOBALS ['xItemCategoryNo'];
	$xQry = "";
	$xMsg = "";
	if ($mode == 'S') {
		$xQry = "INSERT INTO m_item
		(itemno,stockpointno,itemcategoryno,itemgroupno,itemsubgroupno,itemname,
		itemdescription,hsncode,packno,packdescription,gst)  
		VALUES 
		($xItemNo,$xStockPointNo,$xItemCategoryNo,
		$xItemGroupNo,0,
		'$xItemName','$xItemDescription','$xHSNCode',
		$xPackNo,'$xPackDescription','$xGst')";
		echo '<script type="text/javascript">swal("Good job!", "Inserted!", "success");</script>';
		// echo $xQry;
		GetMaxStockEntry ();
		$xStockNo = $GLOBALS ['xStockNo'];
		$xStockQry = "insert into inv_stockentry 
		(stockno,itemno,stock,minstock,maxstock,mrp,batch) 
		values($xStockNo,$xItemNo,0,0,0,0,'OS')";
		$retval = mysql_query ( $xQry ) or die ( mysql_error () );
		if (! $retval) {
			die ( 'Could not enter data: ' . mysql_error () );
		}
		mysql_query ( $xStockQry ) or die ( mysql_error () );
	} elseif ($mode == 'U') {
		$xQry = "UPDATE m_item  
		 SET itemcategoryno=$xItemCategoryNo,
		itemgroupno=$xItemGroupNo,
		itemname='$xItemName',itemdescription='$xItemDescription',
		hsncode='$xHSNCode',gst='$xGst',
		packno=$xPackNo,packdescription='$xPackDescription' WHERE itemno=$xItemNo";
		$xMsg = "Updated";
		echo '<script type="text/javascript">swal("Good job!", "Updated!", "success");</script>';
		header ( 'Location: inv_hm005item.php' );
		$retval = mysql_query ( $xQry ) or die ( mysql_error () );
		if (! $retval) {
			die ( 'Could not enter data: ' . mysql_error () );
		}
	}
	
	GetMaxIdNo ();
	// ShowAlert ( $xMsg );
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Item</title>
</head>

<script type="text/javascript">
function validateForm() 
{

var xItemName= document.forms["itemform"]["f_itemname"].value;
if (xItemName== null || xItemName== "") 
{
	alert("Item Name must be filled out");
	document.itemform.f_itemname.focus();
	return false;
}
var xGst= document.forms["itemform"]["f_gst"].value;
if (xGst== null || xGst== "") 
{
	alert("Gst Percentage of this item to be filled out");
	document.itemform.f_gst.focus();
	return false;
}
var xPackNo= document.forms["itemform"]["f_packno"].value;
if (xPackNo== null || xPackNo== "") 
{
	alert("Pack No must be filled out");
	document.itemform.f_packno.focus();
	return false;
}
}
</script>
<body onload='document.itemform.f_itemname.focus()'>
	<form class="form" name="itemform"
		action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<div class="panel panel-primary">
			<div class="panel-heading  text-center">
				<h3 class="panel-title">MASTER -ITEM</h3>
			</div>
			<div class="panel-body">
				<div class="col-xs-2" style="display: none;">
					<input type="text" class="form-control" id="f_itemno"
						name="f_itemno" value="<?php echo $GLOBALS ['xItemNo']; ?>"
						readonly>
				</div>
				<div class="col-xs-3" style="display: none;">
					<label>StockPoint:</label> <select class="form-control"
						name="f_stockpointno">
<?php
$result = mysql_query ( "SELECT *  FROM m_stockpoint order by stockpointname" );
while ( $row = mysql_fetch_array ( $result ) ) {
	?>
<option value="<?php echo $row['stockpointno']; ?>"
							<?php
	if ($row ['stockpointno'] == $GLOBALS ['xStockPointNo']) {
		echo 'selected="selected"';
	}
	?>>
 <?php echo $row['stockpointname']; ?> 
</option>
<?php
}

?>
</select>



				</div>




				<div class="col-xs-3">
					<label>Group:</label> <select class="form-control"
						name="f_itemgroupno">
<?php
$result = mysql_query ( "SELECT *  FROM m_itemgroup order by itemgroupname" );
while ( $row = mysql_fetch_array ( $result ) ) {
	?>
<option value="<?php echo $row['itemgroupno']; ?>"
							<?php
	if ($row ['itemgroupno'] == $GLOBALS ['xItemGroupNo']) {
		echo 'selected="selected"';
	}
	?>>
 <?php echo $row['itemgroupname']; ?> 
</option>
<?php
}

?>
</select>



				</div>



				<div class="col-xs-4">
					<label>ItemName:</label> <input type="text" class="form-control"
						name="f_itemname" value="<?php echo $GLOBALS ['xItemName']; ?>">
				</div>
				<div class="col-xs-3" style="display: none;">
					<label>ItemDescription:</label> <input type="text"
						class="form-control" name="f_itemdescription"
						value="<?php echo $GLOBALS ['xItemDescription']; ?>">
				</div>
				<div class="col-xs-2">
					<label>HSNCODE:</label> <input type="text" class="form-control"
						name="f_hsncode" value="<?php echo $GLOBALS ['xHSNCode']; ?>">
				</div>
				<div class="col-xs-2">
					<label>GST:</label> <input type="text" class="form-control"
						name="f_gst" value="<?php echo $GLOBALS ['xGst']; ?>">
				</div>
				<div class="col-xs-1">
					<label>Pack No:</label> <input type="text" class="form-control"
						name="f_packno" value="<?php echo $GLOBALS ['xPackNo']; ?>">
				</div>
				<div class="col-xs-2" >
					<label>Pack Description:</label> <select class="form-control"
						name="f_packdescription">
<?php
$result = mysql_query ( "SELECT *  FROM m_unit order by unitname" );
while ( $row = mysql_fetch_array ( $result ) ) {
	?>
<option value="<?php echo $row['unitname']; ?>"
							<?php
	if ($row ['unitname'] == $GLOBALS ['xPackDescription']) {
		echo 'selected="selected"';
	}
	?>>
 <?php echo $row['unitname']; ?> 
</option>
<?php
}

?>
</select>

				</div>

			</div>
			<!-- PANEL BODY !-->
			<div class="panel-footer clearfix">
				<div class="pull-right">
	  <?php if ($GLOBALS ['xMode'] == "") {  ?> 
		   <input type="submit" name="save" class="btn btn-primary"
						value="SAVE" id="save" accesskey="s"
						onclick="return validateForm()"> 
	   <?php } else{ ?>
		   <input type="submit" name="update" class="btn btn-primary"
						value="UPDATE" accesskey="s" onclick="return validateForm()"> 
	   <?php }  ?>
	</div>
			</div>

		</div>
		<!-- PANEL !-->
	</form>

	<!--             ----------------------- REPORT GOES HERE  ------------------------  !-->

	<div id="divToPrint">
				<div class="container">

					<input id="filter" type="text" class="col-xs-8"
						placeholder="Search here...">

			<div class="panel panel-info">
		

				<table class="table table-hover" border="1">
					<thead>
						<tr>
							<th width="20%">Category</th>
							<th width="20%">Group</th>
							<th width="20%">ItemName</th>

							<th width="20%">HSNCODE</th>
										<th width="10%">GST</th>
							<th width="10%">STOCK</th>
							<!-- 			<th width="20%">Pack</th>
															<th width="20%">Units</th>-->

							<th colspan="2" width="5%">ACTIONS</th>
						</tr>
					</thead>
					<tbody class="searchable">
						<tr>
<?php
function fn_FindCurrentStock($xItemNo) {
	$xCurrentStock = '';
	$xQry = "select stock from inv_stockentry where  itemno=$xItemNo";
	$result = mysql_query ( $xQry ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$xCurrentStock = $row ['stock'];
	}
	return $xCurrentStock;
}

$xQry = '';
if (isset ( $_GET ['itemgroupno'] ) && ! empty ( $_GET ['itemgroupno'] )) {
	$xItemGroupNo = $_GET ['itemgroupno'];
	$xQry = "SELECT *  from m_item where itemgroupno= $xItemGroupNo order by  itemname";
} else {
	$xQry = "SELECT *  from m_item order by  itemname";
}
$result2 = mysql_query ( $xQry );
$rowCount = mysql_num_rows ( $result2 );
echo '</br>';

while ( $row = mysql_fetch_array ( $result2 ) ) {
	
	finditemcategoryname ( $row ['itemcategoryno'] );
	finditemgroupname ( $row ['itemgroupno'] );
	finditemsubgroupname ( $row ['itemsubgroupno'] );
	echo '<td>' . $GLOBALS ['xItemCategoryName'] . '</td>';
	echo '<td>' . $GLOBALS ['xItemGroupName'] . '</td>';
	echo '<td>' . $row ['itemname'] . '</td>';
	
	echo '<td>' . $row ['hsncode'] . '</td>';
	echo '<td>' . $row ['gst'] . '</td>';
	echo '<td>' . fn_FindCurrentStock ( $row ['itemno'] ) . '</td>';
	// echo '<td>' . $row ['packno'] . '</td>';
	// echo '<td>' . $row ['packdescription'] . '</td>';
	
	?>
<td><a
								href="inv_hm005item.php<?php echo '?itemno='.$row['itemno'] . '&xmode=edit'; ?>"
								onclick="return confirm_edit()"> <img src="images/edit.png"
									alt="HTML tutorial"
									style="width: 30px; height: 30px; border: 0">
							</a></td>
							<!--  <td><a
							href="inv_hm005item.php<?php echo '?itemno='.$row['itemno']. '&xmode=delete';  ?>"
							onclick="return confirm_delete()"> <img src="images/delete.png"
								alt="HTML tutorial" style="width: 30px; height: 30px; border: 0">
						</a></td>!-->

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
</body>
</html>
<!--             ----------------------- REPORT ENDS HERE  ------------------------  !-->

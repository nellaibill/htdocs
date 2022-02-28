<?php
include 'globalfile.php';
fn_GetCompanyInfo ( 1 );
$GLOBALS ['xMode'] = '';
$GLOBALS ['xDate'] = $GLOBALS ['xCurrentDate'];
$xCompanyTitle = $GLOBALS ['xCompanyTitle'];
$GLOBALS ['xExpDate'] = date ( 'Y-m-d', strtotime ( '+1 years' ) );
// Get the Patient Id value from Patient Id TextBox On KeyEnter
if (isset ( $_GET ['openingstockno'] ) && ! empty ( $_GET ['openingstockno'] )) {
	$xOpeningStockNo = $_GET ['openingstockno'];
	$xItemNo = $_GET ['itemno'];
	$xQty = $_GET ['qty'];
	$xBatch = $_GET ['batch'];
	$xExpDate = $_GET ['expdate'];
	if ($_GET ['xmode'] == 'edit') {
		$GLOBALS ['xMode'] = 'F';
		DataFetch ( $_GET ['openingstockno'] );
	} else {
		$xQry = "DELETE FROM m_openingstock WHERE openingstockno=$xOpeningStockNo";
		
		$xStockQry = "DELETE FROM inv_stockentry 
		where itemno=$xItemNo and batch='$xBatch' and expdate='$xExpDate'";
		
		$xQ1 = mysql_query ( $xQry );
		$xQ2 = mysql_query ( $xStockQry );
		
		if ($xQ1 and $xQ2) {
			mysql_query ( "COMMIT" );
			header ( 'Location: openingstockentry.php' );
		} else {
			mysql_query ( "ROLLBACK" );
		}
		
		// UpdateStockValues ( $xItemNo, $xQty, '', $xBatch, $xExpDate );
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
function DataFetch($xopeningstockno) {
	$result = mysql_query ( "SELECT *  FROM m_openingstock WHERE openingstockno=$xopeningstockno" ) or die ( mysql_error () );
	$count = mysql_num_rows ( $result );
	if ($count > 0) {
		while ( $row = mysql_fetch_array ( $result ) ) {
			
			$GLOBALS ['xopeningstockno'] = $row ['openingstockno'];
			$GLOBALS ['xitemno'] = $row ['itemno'];
			$GLOBALS ['xQty'] = $row ['qty'];
			$GLOBALS ['xMrp'] = $row ['mrp'];
		}
	}
}
function DataProcess($mode) {
	$xopeningstockno = $_POST ['f_openingstockno'];
	$xitemno = $_POST ['f_itemno'];
	$xqty = $_POST ['f_qty'];
	$xmrp = $_POST ['f_mrp'];
	$xbatch = $_POST ['f_batch'];
	$xexpdate = $_POST ['f_expdate'];
	
	if ($mode == 'S') {
		$xQry = "INSERT INTO m_openingstock (openingstockno,itemno,qty,mrp,batch,expdate) 
		VALUES ($xopeningstockno,$xitemno,$xqty,$xmrp,'$xbatch','$xexpdate')";
		
		
	} elseif ($mode == 'U') {
		$xQry = "UPDATE m_openingstock   SET itemno=$xitemno,qty=$xqty
		 WHERE openingstockno=$xopeningstockno";
	}
	echo $xQry;
	GetMaxStockEntry ();
	$xStockNo = $GLOBALS ['xStockNo'];
	$xStockQry = "insert into inv_stockentry
	(stockno,itemno,stock,minstock,maxstock,mrp,batch,expdate)
	values($xStockNo,$xitemno,$xqty,0,0,$xmrp,'$xbatch','$xexpdate')";
	
	$xQ1 = mysql_query ( $xQry );
	$xQ2 = mysql_query ( $xStockQry );
	
	if ($xQ1 and $xQ2) {
		mysql_query ( "COMMIT" );
                echo '<script type="text/javascript">swal("Good job!", "Added!", "success");</script>';
	} else {
		mysql_query ( "ROLLBACK" );
                echo '<script type="text/javascript">swal("Error ! ", "Data Not Stored", "error");</script>';
	}
	
	/*
	 * $xQryUpdateStock = "update inv_stockentry set stock=stock+($xqty),mrp=$xmrp,
	 * batch='$xbatch',expdate='$xexpdate' where itemno=$xitemno and batch='OS'";
	 * //echo $xQryUpdateStock;
	 * mysql_query ( $xQryUpdateStock ) or die ( mysql_error () );
	 *
	 * if (! $retval) {
	 * die ( 'Could not enter data: ' . mysql_error () );
	 * }
	 */
	fn_DataClear ();
}
function fn_DataClear() {
	$xQry = "";
	$xMsg = "";
	$GLOBALS ['xopeningstockno'] = '';
	$GLOBALS ['xitemno'] = '';
	$GLOBALS ['xQty'] = '';
	$GLOBALS ['xMrp'] = '';
	$GLOBALS ['xBatch'] = 'OS';
	GetMaxIdNo ();
}
function GetMaxIdNo() {
	$sql = "SELECT  CASE WHEN max(openingstockno)IS NULL OR max(openingstockno)= ''
       THEN '1'
       ELSE max(openingstockno)+1 END AS openingstockno
FROM m_openingstock";
	
	$result = mysql_query ( $sql ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xopeningstockno'] = $row ['openingstockno'];
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
function UpdateStockValues($xCurrentItemNo, $xCurrentQty, $xMode, $xCurrentBatch, $xCurrentExpDate) {
	if ($xMode == 'S') {
		$xQry = "update inv_stockentry set stock=stock+($xCurrentQty) 
		where itemno=$xCurrentItemNo and batch=$xCurrentBatch' and expdate='$xCurrentExpDate'";
	} else {
		$xQry = "update inv_stockentry set stock=stock-($xCurrentQty) 
	where itemno=$xCurrentItemNo and batch=$xCurrentBatch' and expdate='$xCurrentExpDate'";
	}
	
	mysql_query ( $xQry ) or die ( mysql_error () );
}
?>



<body onload='document.unitform.f_itemno.focus()'>
	<form class="form" name="unitform"
		action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<div class="panel panel-success">
			<div class="panel-heading">
				<h3 class="panel-title  text-center">Opening Stock-Entry</h3>
			</div>
		</div>
		<!-- Panel Body !-->

		<div class="panel-body">

			<!-- Panel -Room Type Number General Information !-->

			<div class="form-group">

				<div class="col-xs-3" style="display: none">
					<label> No</label> <input type="text" class="form-control"
						name="f_openingstockno"
						value="<?php echo $GLOBALS ['xopeningstockno']; ?>"
						readonly="readonly">
				</div>

				<div class="col-xs-4">
					<label>Item Name:</label> <select class="form-control"
						name="f_itemno" id="f_itemno">
						<option value="0">Choose Item</option>
<?php
$result = mysql_query ( "SELECT *  FROM m_item as i order by i.itemname" );
while ( $row = mysql_fetch_array ( $result ) ) {
	?>
<option value="<?php echo $row['itemno']; ?>"
							<?php
	if ($row ['itemno'] == $GLOBALS ['xItemNo']) {
		echo 'selected="selected"';
	}
	?>>
 <?php echo $row['itemname']?> 
</option>
<?php
}
?>
</select>

				</div>

				<div class="col-xs-3">
					<label>Qty</label> <input type="number" class="form-control"
                                                                  name="f_qty" required="" value="<?php echo $GLOBALS ['xQty']; ?>">
				</div>

				<div class="col-xs-3">
					<label>Mrp</label> <input type="text" class="form-control"
						name="f_mrp" 
                                                required="" value="<?php echo $GLOBALS ['xMrp']; ?>">
				</div>

				<div class="col-xs-3">
					<label>Batch</label> <input type="text" class="form-control"
						name="f_batch" value="<?php echo $GLOBALS ['xBatch']; ?>">
				</div>

				<div class="col-xs-3">
					<label>ExpiryDate</label> <input type="date" class="form-control"
						name="f_expdate" value="<?php echo $GLOBALS ['xExpDate']; ?>">
				</div>
			</div>


		</div>
		<!-- Panel -Room Type Number Information Ended !-->

		<div class="panel-footer clearfix">
			<div class="pull-right">

				<input type="submit" name="f_BtnSaveUnit" class="btn btn-primary"
					value="SAVE" id="add" onclick="return validateForm()" accesskey="s">


			</div>
		</div>

	</form>


	<!--             ----------------------- REPORT GOES HERE  ------------------------  !-->
	<div id="divToPrint">
		<div class="container">
			<div class="panel panel-info">

				<!-- Default panel contents -->
				<div class="panel-heading  text-center">
					<h3 class="panel-title"><?php echo $xCompanyTitle;	 ?> (Opening Stock Report)</h3>
				</div>
				<input id="filter" type="text" class="col-xs-8"
					placeholder="Search here...">
				<table class="table">
					<thead>

						<tr>


							<td width="30%">Item Name</td>
							<td align="right" width="20%">Qty</td>
							<td align="right" width="20%">Mrp</td>
								<td align="right" width="20%">Batch</td>
							<td align="right" width="20%">ExpDate</td>
							<td align="right" width="20%">Total</td>
							<td width="5%" colspan="2">ACTIONS</td>

						</tr>
					</thead>
					<tbody class="searchable">
						<tr>

<?php
$xQry = '';
$xSlNo = 0;
$xTotalAmount = 0;
$xGTotalAmount = 0;
$xQry = "SELECT *  from m_openingstock  order by openingstockno asc";
$result2 = mysql_query ( $xQry );
$rowCount = mysql_num_rows ( $result2 );
echo '</br>';

while ( $row = mysql_fetch_array ( $result2 ) ) {
	finditemname ( $row ['itemno'] );
	echo '<td>' . $GLOBALS ['xItemName'] . '</td>';
	echo '<td align=right>' . $row ['qty'] . '</td>';
	echo '<td align=right>' . fn_RupeeFormat($row ['mrp']) . '</td>';
	echo '<td align=right>' . $row ['batch'] . '</td>';
	echo '<td align=right>' . $row ['expdate'] . '</td>';
	$xTotalAmount = $row ['qty'] * $row ['mrp'];
	echo '<td align=right>' . $xTotalAmount . '</td>';
	$xGTotalAmount += $xTotalAmount;
	?>
	
						<td><a
								href="openingstockentry.php<?php
	
	echo '?openingstockno=' . $row ['openingstockno'] . ' &itemno=
							' . $row ['itemno'] . ' &qty=' . $row ['qty'] . '&batch=' . $row ['batch'] . '&expdate=' . $row ['expdate'] . '&xmode=delete';
	?>"
								onclick="return confirm_delete()"> <img src="images/delete.png"
									style="width: 30px; height: 30px; border: 0">
							</a></td>
						
<?php
	echo '</tr>';
}
echo '<tr>';
echo '<td colspan=5>Grand Total</td>';
echo '<td align=right>' . fn_RupeeFormat ( $xGTotalAmount ) . '</td>';
echo '</tr>';
?>	
	
					
					
					
					
					
					</tbody>
				</table>
			</div>

		</div>
	</div>

</body>

<!--             ----------------------- REPORT ENDS HERE  ------------------------  !-->


<?php
include 'globalfile.php';
$xFromDate = $GLOBALS ['xInvFromDate'];
$xToDate = $GLOBALS ['xInvToDate'];
function fn_C_S_FindPurchaseBetweenDate($xItemNo, $xFromDate, $xToDate) {
	$xQty = '';
	$xQry = "SELECT  CASE WHEN sum(qty)IS NULL  THEN '0' else sum(qty) END as qty  
                   from inv_purchaseentry  where  itemno=$xItemNo";
	$result = mysql_query ( $xQry ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$xQty = $row ['qty'];
	}
	return $xQty;
}

function fn_C_S_FindPurchaseReturn($xItemNo, $xFromDate, $xToDate) {
	$xPurchaseReturn = 0;
	$xQry = "select return_qty from inv_purchase_return where returndate>='$xFromDate' and returndate<='$xToDate' and  itemno=$xItemNo";
	
	$result = mysql_query ( $xQry ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$xPurchaseReturn += $row ['return_qty'];
	}
	return $xPurchaseReturn;
}

function fn_C_S_FindSalesReturn($xItemNo, $xFromDate, $xToDate) {
	$xSalesReturn = 0;
	$xQry = "select return_qty from inv_sales_return where returndate>='$xFromDate' and returndate<='$xToDate' and  itemno=$xItemNo";
	$result = mysql_query ( $xQry ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$xSalesReturn += $row ['return_qty'];
	}
	return $xSalesReturn;
}

function fn_C_S_FindSalesBetweenDate($xItemNo, $xFromDate, $xToDate) {
	$xQty = '';
	$xQry = "SELECT  CASE WHEN sum(qty)IS NULL  THEN '0' else sum(qty) END as qty  
                   from inv_salesentry where date>= '$xFromDate' AND date<= '$xToDate' and itemno=$xItemNo";
	$result = mysql_query ( $xQry ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$xQty = $row ['qty'];
	}
	return $xQty;
}

function fn_C_S_FindExcess($xItemNo, $xFromDate, $xToDate) {
	$xQty = '';
	$xQry = "SELECT  CASE WHEN sum(excessshortageqty)IS NULL  THEN '0' else sum(excessshortageqty) END as excessshortageqty
                   from inv_excessshortage where invoicedate>= '$xFromDate' AND invoicedate<= '$xToDate' and itemno=$xItemNo and excessshortagename='Excess'";
	$result = mysql_query ( $xQry ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$xQty = $row ['excessshortageqty'];
	}
	return $xQty;
}
function fn_C_S_FindShortage($xItemNo, $xFromDate, $xToDate) {
	$xQty = '';
	$xQry = "SELECT  CASE WHEN sum(excessshortageqty)IS NULL  THEN '0' else sum(excessshortageqty) END as excessshortageqty
                   from inv_excessshortage where invoicedate>= '$xFromDate' AND invoicedate<= '$xToDate' and itemno=$xItemNo and excessshortagename='Shortage'";
	$result = mysql_query ( $xQry ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$xQty = $row ['excessshortageqty'];
	}
	return $xQty;
}


function fn_O_S_FindPurchaseReturn($xItemNo, $xFromDate, $xToDate) {
	$xPurchaseReturn = 0;
	$xQry = "select return_qty from inv_purchase_return where returndate<'$xFromDate'  and  itemno=$xItemNo";

	$result = mysql_query ( $xQry ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$xPurchaseReturn = $row ['return_qty'];
	}
	return $xPurchaseReturn;
}

function fn_O_S_FindSalesReturn($xItemNo, $xFromDate, $xToDate) {
	$xSalesReturn = 0;
	$xQry = "select return_qty from inv_sales_return where returndate<'$xFromDate' and  itemno=$xItemNo";

	$result = mysql_query ( $xQry ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$xSalesReturn = $row ['return_qty'];
	}
	return $xSalesReturn;
}

function fn_O_S_FindPurchaseBetweenDate($xItemNo, $xFromDate, $xToDate) {
	$xQty = '';
	$xQry = "SELECT  CASE WHEN sum(qty)IS NULL  THEN '0' else sum(qty) END as qty  
                   from inv_purchaseentry where   itemno=$xItemNo";
	$result = mysql_query ( $xQry ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$xQty = $row ['qty'];
	}
	return $xQty;
}
function fn_O_S_FindSalesBetweenDate($xItemNo, $xFromDate, $xToDate) {
	$xQty = '';
	$xQry = "SELECT  CASE WHEN sum(qty)IS NULL  THEN '0' else sum(qty) END as qty  
                   from inv_salesentry where  itemno=$xItemNo";
	$result = mysql_query ( $xQry ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$xQty = $row ['qty'];
	}
	return $xQty;
}
function fn_FindCurrentStock($xItemNo) {
	$xCurrentStock = '';
	$xQry = "select stock from inv_stockentry where  itemno=$xItemNo";
	$result = mysql_query ( $xQry ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$xCurrentStock = $row ['stock'];
	}
	return $xCurrentStock;
}

?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<div class="panel panel-success">
		<div class="panel-heading text-center">
			FILTER[GROUP]
			<div class="btn-group pull-right">
				<input type="submit" name="save" class="btn btn-primary"
					value="VIEW">
			</div>
		</div>
		<div class="panel-body">
			<div class="form-group">


				<div class="col-xs-3">
					<label>From Date:</label> <input type="date" class="form-control"
						name="f_fromdate" value="<?php echo $xFromDate; ?>">
				</div>

				<div class="col-xs-3">
					<label>To Date:</label> <input type="date" class="form-control"
						name="f_todate" value="<?php echo $xToDate; ?>">
				</div>



				<div class="col-xs-3">
					<label>Item:</label> <select class="form-control" name="f_itemno">
						<option value="0">All</option>
<?php

$result = mysql_query ( "SELECT *  FROM inv_stockentry a, m_item b WHERE a.itemno = b.itemno order by b.itemname " );
while ( $row = mysql_fetch_array ( $result ) ) {
	?>
    <option value="<?php echo $row['itemno']; ?>"
							<?php
	if ($row ['itemno'] == $GLOBALS ['xItemNo']) {
		echo 'selected="selected"';
	}
	?>>
     <?php echo $row['itemname']; ?> 
    </option>
    <?php } ?>
</select>
				</div>

			</div>
			<!-- Form-Group !-->
		</div>
		<!-- Panel Body !-->
	</div>
	<!-- Panel !-->
</form>
<html>
<title>V-SALES</title>
<head>
<link href="bootstrap.css" rel="stylesheet">
<link href="css/reportstyle.css" rel="stylesheet">
<script type="text/javascript">


$(document).ready(function () {

    (function ($) {

        $('#filter').keyup(function () {

            var rex = new RegExp($(this).val(), 'i');
            $('.searchable tr').hide();
            $('.searchable tr').filter(function () {
                return rex.test($(this).text());
            }).show();

        })

    }(jQuery));

});
</script>
</head>
<body>
	<div class="input-group">
		<span class="input-group-addon">Filter</span> <input id="filter"
			type="text" class="form-control" placeholder="Search here...">
	</div>
	<div id="divToPrint">
		<div class="panel panel-primary">
			<div class="panel-heading  text-center">
				<h3 class="panel-title"><?php echo "Stock From [".date('d/M/y', strtotime($xFromDate))."]TO [".date('d/M/y', strtotime($xToDate))."] As On ". date("d/M/y h:i:sa"); ?></h3>
			</div>
			<div class="panel-body">

				<div class="container">
<?php
$xSlNo = 0;
$xPurOrderValue = 0;
$xPurOrder = 0;
$xQryFilter = '';
if (isSet ( $_POST ['save'] )) {
	$xItemNo = $_POST ['f_itemno'];
	$xFromDate = $_POST ['f_fromdate'];
	$xToDate = $_POST ['f_todate'];
	mysql_query ( "update config_inventory set fromdate='$xFromDate',todate='$xToDate',itemno=$xItemNo" ) or die ( mysql_error () );
	header ( 'Location: inv_hr002_c_betweendates.php' );
} 

else {
	$xFromDate = $GLOBALS ['xInvFromDate'];
	$xToDate = $GLOBALS ['xInvToDate'];
	$xItemNo = $GLOBALS ['xItemNo'];
}

if ($xItemNo != 0) {
	$xQryFilter = $xQryFilter . ' ' . "and itemno=$xItemNo";
}
$xQry = "SELECT  distinct(i.itemno)
FROM   (
            SELECT  itemno
            FROM    inv_purchaseentry  $xQryFilter
            UNION   ALL
            SELECT  itemno
            FROM    inv_salesentry  $xQryFilter
        ) subquery,
m_item as i  order by i.itemname";

/*
 * $xQry="SELECT itemno from
 * m_item as i where i.stockpointno=31 order by i.itemname";
 */

// echo $xQry;
$result2 = mysql_query ( $xQry );
?>
<table class="table table-hover" border="1">
						<thead>
							<tr>
								<th width="5%">S.NO</th>
								<th width="15%">ItemName</th>
								<th width="10%">OpeningStock</th>
								<th width="10%">Purchased</th>
								<th width="10%">Sales</th>
								<th width="10%">P.R</th>
								<th width="10%">S.R</th>
								<!-- <th width="10%">SalesReturn</th>
           <th width="10%">Excess</th>
           <th width="10%">Shortage</th> !-->
								<th width="10%">ClosingStock</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th width="5%">S.NO</th>
								<th width="15%">ItemName</th>
								<th width="10%">OpeningStock</th>
								<th width="10%">Purchased</th>
								<th width="10%">Sales</th>
								<th width="10%">P.R</th>
								<th width="10%">S.R</th>
								<!-- <th width="10%">SalesReturn</th>
           <th width="10%">Excess</th>
           <th width="10%">Shortage</th> !-->
								<th width="10%">ClosingStock</th>
							</tr>
						</tfoot>
						<tbody class="searchable">
<?php
while ( $row = mysql_fetch_array ( $result2 ) ) {
	$xOpeningStock = 0;
	$xClosingStock = 0;
	
	$xO_S_Purchased = 0;
	$xO_S_Sales = 0;
	$xO_S_PurchaseReturn=0;
	$xO_S_SalesReturn = 0;
	$xO_S_Excess = 0;
	$xO_S_Shortage = 0;
	
	$xC_S_Purchased = 0;
	$xC_S_Sales = 0;
	$xC_S_PurchaseReturn=0;
	$xC_S_SalesReturn = 0;
	$xC_S_Excess = 0;
	$xC_S_Shortage = 0;
	
	$xO_S_Purchased = fn_O_S_FindPurchaseBetweenDate ( $row ['itemno'], $xFromDate, $xToDate );
	$xO_S_Sales = fn_O_S_FindSalesBetweenDate ( $row ['itemno'], $xFromDate, $xToDate );
	$xO_S_PurchaseReturn = fn_O_S_FindPurchaseReturn ( $row ['itemno'], $xFromDate, $xToDate );
	$xO_S_SalesReturn = fn_O_S_FindSalesReturn ( $row ['itemno'], $xFromDate, $xToDate );
	$xOpeningStock = $xO_S_Purchased -$xO_S_PurchaseReturn + $xO_S_SalesReturn - $xO_S_Sales;
	
	$xC_S_Purchased = fn_C_S_FindPurchaseBetweenDate ( $row ['itemno'], $xFromDate, $xToDate );
	$xC_S_Sales = fn_C_S_FindSalesBetweenDate ( $row ['itemno'], $xFromDate, $xToDate );
	$xC_S_PurchaseReturn = fn_C_S_FindPurchaseReturn ( $row ['itemno'], $xFromDate, $xToDate );
	$xC_S_SalesReturn=fn_C_S_FindSalesReturn($row['itemno'],$xFromDate,$xToDate);
	$xClosingStock = $xOpeningStock + $xC_S_Purchased -$xC_S_PurchaseReturn- $xC_S_Sales + $xC_S_SalesReturn + $xC_S_Excess - $xC_S_Shortage;
	$xPurOrderValue = (($xC_S_Sales - $xClosingStock) * $xPurOrder / 100) + ($xC_S_Sales - $xClosingStock);
	echo '<tr>';
	finditemname ( $row ['itemno'] );
	echo '<td align=right>' . $xSlNo += 1 . '</td>';
	echo '<td>' . $GLOBALS ['xItemName'] . '</td>';
	echo '<td align=right> ' . $xOpeningStock . '</td>';
	echo '<td align=right>' . $xC_S_Purchased . '</td>';
	echo '<td align=right>' . $xC_S_Sales . '</td>';
	echo '<td align=right>' .$xC_S_PurchaseReturn.  '</td>';
	echo '<td align=right>' .$xC_S_SalesReturn.  '</td>';
	echo '<td align=right> ' . $xClosingStock . '</td>';
	?>
<!--
<td><a href="inv_ht004salesentry.php<?php echo '?salesinvoiceno='.$row['salesinvoiceno'] . '&xmode=edit'; ?>"  onclick="return confirm_edit()">
  <img src="../images/edit.png" alt="HTML tutorial" style="width:30px;height:30px;border:0">
</a>
</td>
<td><a href="inv_ht004salesentry.php<?php echo '?salesinvoiceno='.$row['salesinvoiceno']. '&xmode=delete';  ?>"  onclick="return confirm_delete()">
  <img src="../images/delete.png" alt="HTML tutorial" style="width:30px;height:30px;border:0">
</a>
</td>
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
	</div>
</body>
</html>

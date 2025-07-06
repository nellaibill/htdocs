
<?php
include 'globalfile.php';
$GLOBALS ['xStockNo']='';
$GLOBALS ['xMrp']='';
$GLOBALS ['xStock']='';
$xFromDate = $GLOBALS ['xInvFromDate'];
$xToDate = $GLOBALS ['xInvToDate'];
if (isset ( $_GET ['stockno'] ) && ! empty ( $_GET ['stockno'] )) {
	$no = $_GET ['stockno'];
	if ($_GET ['xmode'] == 'edit') {
		$GLOBALS ['xMode'] = 'F';
		DataFetch ( $_GET ['stockno'] );
	}
}
if (isset ( $_POST ['update'] )) {
	DataProcess ( "U" );
} 
function DataFetch($xNo) {
	$result = mysql_query ( "SELECT *  FROM inv_stockentry where stockno=$xNo" ) or die ( mysql_error () );
	$count = mysql_num_rows ( $result );
	if ($count > 0) {
		while ( $row = mysql_fetch_array ( $result ) ) {
			
			$GLOBALS ['xStockNo'] = $row ['stockno'];
			$GLOBALS ['xMrp'] = $row ['mrp'];
						$GLOBALS ['xStock'] = $row ['stock'];
		}
	}
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
function fn_FindItemOriginalPrice($xItemNo) {
	$xOriginalPrice	 = 0;
	$xQry = "select originalprice from inv_purchaseentry where  itemno=$xItemNo";
	$result = mysql_query ( $xQry ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$xOriginalPrice = $row ['originalprice'];
	}
	return $xOriginalPrice;
}

function DataProcess($mode) {
	$xStockNo = $_POST ['f_stockno'];
	$xMrp =  $_POST ['f_mrp'];
		$xStock =  $_POST ['f_stock'];
	$xQry = "";
	$xMsg = "";
	if ($mode == 'S') {
		
	} elseif ($mode == 'U') {
		$xQry = "UPDATE inv_stockentry   SET stock='$xStock' , mrp=$xMrp WHERE stockno=$xStockNo";
		//echo $xQry;
		echo '<script type="text/javascript">swal("Good job!", "Updated!", "success");</script>';
	}
	$retval = mysql_query ( $xQry ) or die ( mysql_error () );
	header ( 'Location: inv_hr002_e_batch_stock.php' );
}
?>
<html>
<head>
<?php include 'title.php'?>
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
	<form class="form" name="itemcategoryform"
		action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<div id="divToPrint">
		<div class="panel panel-primary">
			<div class="panel-body">
				<div class="container">
		
				 <div class="row">
    <div class="col-xs-2">
	<label> STOCKNO</label> <input type="text" class="form-control"
								id="f_stockno" name="f_stockno"
								value="<?php echo $GLOBALS ['xStockNo']; ?>" readonly >
								</div>
								
	<div class="col-xs-4">
	<label> MRP</label> <input type="text" class="form-control"
								id="f_mrp" name="f_mrp" 
								value="<?php echo $GLOBALS ['xMrp']; ?>" >
								
								</div>
	<div class="col-xs-4">
	<label> Stock</label> <input type="text" class="form-control"
								id="f_stock" name="f_stock" 
								value="<?php echo $GLOBALS ['xStock']; ?>" >
								
								</div>
	 <input type="submit" name="update" class="btn btn-primary"
									value="UPDATE" onclick="return validateForm()" accesskey="s"> 
  </div>
		
		</form>			

					
<?php
$xSlNo = 0;	
$xQry = "select s.itemno,s.stock,p.originalprice ,s.batch,s.expdate,s.stockno from inv_stockentry as s,m_item as i ,inv_purchaseentry p where i.itemno=s.itemno and p.batchid = s.batch order by i.itemname";
$result2 = mysql_query ( $xQry );
?>
</br></br></br>
	<div class="col-xs-4">
	<input id="filter" type="text" class="col-xs-8"
						placeholder="Search here...">
	</div>
<table class="table table-hover" border="1" width="100%">
						<thead>
							<tr>
			<th width="5%">S.No</th>
					<th width="5%">Stock.No</th>
								
								<th width="45%">ItemName</th>
								<th width="10%">Stock</th>
							
                                                                	<th width="10%">MRP</th>
								<th width="10%">BATCH</th>
                                                                <th width="10%">Total</th>
								
								
							</tr>
						</thead>

						<tbody class="searchable">
<?php
$xGrandTotal=0;
while ( $row = mysql_fetch_array ( $result2 ) ) {
	echo '<tr>';
	finditemname ( $row ['itemno'] );
	$xSlNo +=1;
        //$xMrp=$row ['mrp'];
        $xPurchaseRate=$row ['originalprice'];
        $xStock=$row ['stock'];
        $xTotalValue=$xStock*$xPurchaseRate;
        $xGrandTotal+=$xTotalValue;
        echo '<td>' . $xSlNo . '</td>';
			echo '<td>' . $row ['stockno'] . '</td>';
	echo '<td>' . $GLOBALS ['xItemName'] . '</td>';
	echo '<td>' . $xStock . '</td>';        
	echo '<td>' . $xPurchaseRate. '</td>';
	echo '<td>' . $row ['batch'] . '</td>';
    echo '<td align=right>' . fn_RupeeFormat($xTotalValue). '</td>';
	
		?>
   <?php if ($xUserRole == 'A') { ?>
<td><a
							href="inv_hr002_e_batch_stock.php<?php echo '?stockno='.$row['stockno'] . '&xmode=edit'; ?>"
							onclick="return confirm_edit()"> <img src="images/edit.png"
								alt="HTML tutorial" style="width: 30px; height: 30px; border: 0">
						</a></td>
						 <?php } ?>
						<?php
	echo '</tr>';    
	
}
	echo '<tr>';
	echo '<td colspan=6>Stock Value</td>';
        echo '<td align=right>' . fn_RupeeFormat($xGrandTotal). '</td>';
	echo '</tr>';
	
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

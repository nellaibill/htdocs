
<?php
include 'globalfile.php';
$xFromDate = $GLOBALS ['xInvFromDate'];
$xToDate = $GLOBALS ['xInvToDate'];
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

	<div id="divToPrint">
		<div class="panel panel-primary">
	
			<div class="panel-body">

				<div class="container">

					<input id="filter" type="text" class="col-xs-8"
						placeholder="Search here...">
<?php
$xSlNo = 0;	
$xQry = "select s.itemno,s.stock,s.mrp,s.batch,s.expdate from inv_stockentry as s,m_item as i where i.itemno=s.itemno  order by i.itemname";

$result2 = mysql_query ( $xQry );
?>
<table class="table table-hover" border="1">
						<thead>
							<tr>
			<th width="5%">S.No</th>
								
								<th width="15%">ItemName</th>
								<th width="10%">Stock</th>
								<th width="10%">P.Rate</th>
                                                                	<th width="10%">S.Rate</th>
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
        $xMrp=$row ['mrp'];
        $xPurchaseRate=fn_FindItemOriginalPrice($row ['itemno']);
        $xStock=$row ['stock'];
        $xTotalValue=$xStock*$xPurchaseRate;
        $xGrandTotal+=$xTotalValue;
        echo '<td>' . $xSlNo . '</td>';
	echo '<td>' . $GLOBALS ['xItemName'] . '</td>';
	echo '<td>' . $xStock . '</td>';
             echo '<td>' .fn_FindItemOriginalPrice($row ['itemno']) . '</td>';
	echo '<td>' . $xMrp. '</td>';
	echo '<td>' . $row ['batch'] . '</td>';
   
        
        echo '<td align=right>' . fn_RupeeFormat($xTotalValue). '</td>';
	echo '</tr>';    
}
	echo '<tr>';
	echo '<td colspan=6 align=right>Stock Value</td>';
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

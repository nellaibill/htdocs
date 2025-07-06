
<?php
include 'globalfile.php';
$xFromDate = $GLOBALS ['xInvFromDate'];
$xToDate = $GLOBALS ['xInvToDate'];
$xNetTotal=0;
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
	$xQry = "select originalprice,vat from inv_purchaseentry where  itemno=$xItemNo";
	$result = mysql_query ( $xQry ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$xOriginalPrice = $row ['originalprice'];
                $xVat = $row ['vat'];
                $xOriginalPrice=$xOriginalPrice+($xOriginalPrice*$xVat/100);
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
$xQry = "select salesinvoiceno,itemno,qty,updatedason from inv_salesentry where date='0000-00-00' group by salesinvoiceno order by salesinvoiceno";
$result2 = mysql_query ( $xQry );
?>
<table class="table table-hover" border="1">
						<thead>
							<tr>
								<th width="5%">S.NO</th>
										<th width="15%">InvoiceNo</th>
								<th width="15%">ItemName</th>
								<th width="10%">Missing Stock</th>
									<th width="10%">Updated Time</th>
										<th width="10%">Edit</th>
											<th width="10%">Print</th>
						
							</tr>
						</thead>

						<tbody class="searchable">
<?php
while ( $row = mysql_fetch_array ( $result2 ) ) {
	echo '<tr>';
         $GLOBALS ['xItemName']='';
	finditemname ( $row ['itemno'] );
	echo '<td align=right>' . $xSlNo += 1 . '</td>';
		echo '<td align=left>' . $row ['salesinvoiceno'] . '</td>';

		
	echo '<td>' . $GLOBALS ['xItemName'] . '</td>';
	$xQty=$row ['qty'];
	echo '<td align=right>' . $xQty . '</td>';
				echo '<td align=left>' . $row ['updatedason'] . '</td>';
	

	?>
									<td><a
								href="inv_ht004salesentry.php
						<?php echo '?passsalesinvoiceno='.$row['salesinvoiceno']  ?>"
								onclick="return confirm_edit()"> <img src="images/edit.png"
									style="width: 30px; height: 30px; border: 0">
							</a></td>
	<td><a
								href="<?php echo $xPrintTemplate .'?salesinvoiceno='.$row['salesinvoiceno'] . '&xmode=report'; ?>">
									PRINT </a></td>
			
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

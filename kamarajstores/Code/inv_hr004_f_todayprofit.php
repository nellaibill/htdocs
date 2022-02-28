<?php
include 'globalfile.php';
$xCurrentDate=$GLOBALS ['xCurrentDate'];
function fn_FindItemOriginalPrice($xItemNo) {
	$xCurrentStock = '';
	$xQry = "select originalprice from inv_purchaseentry where  itemno=$xItemNo";
	$result = mysql_query ( $xQry ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$xOriginalPrice = $row ['originalprice'];
	}
	return $xOriginalPrice;
}
?>

<html>
<title>V-SALES</title>
<head>
<link href="bootstrap.css" rel="stylesheet">
<link href="css/reportstyle.css" rel="stylesheet">

</head>
<body>

	<div id="divToPrint">
		<div class="container">

		<?php
		$xSlNo=0;
		$xGrandTotal=0;
$xGrandPurchaseRate=0;
		$xDate=date ( 'Y-m-d' );

		/* ------------- Area Executes from Home Page  ----------- */
		$xQry="SELECT i.vat as vat,i.itemno,sum(i.qty) as qty,sum(i.amount)as amount from
		inv_salesentry as i ,m_item as m 
		where  m.itemno=i.itemno   and date='$xDate' group by i.itemno order by m.itemname;";
		//$xQry="SELECT itemno,sum(qty) as qty from inv_salesentry as i ,m_item m where date= ' $xCurrentDate'  where m.itemno=i.itemno group by itemno order by m.itemname;";
		// /echo $xQry;
		$result2=mysql_query($xQry);
		?>	<input id="filter" type="text" class="col-xs-8"
				placeholder="Search here...">
                </br>
			<div class="panel panel-info">
				<!-- Default panel contents -->
				<div class="panel-heading  text-center">
					<b><?php echo "Daily Sales Report As On ". date("d/M/y h:i:sa"); ?>
					</b>
				</div>
				<table class="table table-hover" border="1">
					<thead>
						<tr>
							<th width="5%">S.NO</th>
							<th width="25%">ITEM NAME</th>
							<th width="10%">QTY</th>
                                                        <th width="10%">P.RATE</th>
							<th width="10%">AMOUNT</th>
						</tr>
					</thead>

					<tfoot>
					
					<tbody class="searchable">

					<?php
					if(mysql_num_rows($result2)){
						while ($row = mysql_fetch_array($result2)) {

							echo '<tr>';
							finditemname($row['itemno']);
                                                      
                                                        $xPurchaseRate=fn_FindItemOriginalPrice($row ['itemno']);
							echo '<td>' . $xSlNo+=1  . '</td>';
							echo '<td>' . $GLOBALS['xItemName']  . '</td>';
                                                        $xQty=$row['qty'] ;
							echo '<td align=right>' . $xQty  . '</td>';
                                                          $xTotalPurchaseRate=  $xPurchaseRate*$xQty;
                                                        echo '<td align=right>' . $xTotalPurchaseRate . '</td>';
							$xGst=$row['vat']/100;
							$xAmount=$row['amount'] ;
							$GstValue=$row['amount']*$xGst;
							$xAmountIncludedGst=$xAmount+$GstValue;
							echo '<td align=right>' . round($xAmountIncludedGst,2) . '</td>';
							$xGrandTotal+=round($xAmountIncludedGst,2);
                                                        $xGrandPurchaseRate+=$xTotalPurchaseRate;
							?>
							<?php
							echo '</tr>';

						}
						echo '<tr>';
						echo '<td colspan=3 align=right> GRAND TOTAL</td>';
                                                echo '<td align=right> ' . $xGrandPurchaseRate . '</td>';
						echo '<td align=right> ' . $xGrandTotal . '</td>';
						echo '</tr>';
                                                $xTotalProfit=$xGrandTotal-$xGrandPurchaseRate;
                                                echo '<tr>';
						echo '<td colspan=3 align=right> NET PROFIT</td>';
                                                echo '<td align=right></td>';
						echo '<td align=right> ' . $xTotalProfit . '</td>';
						echo '</tr>';
					}

					else
					{
						fn_NoDataFound();
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

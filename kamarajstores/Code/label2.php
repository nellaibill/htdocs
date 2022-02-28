<?php
include 'globalfile.php';
$GLOBALS ['xName'] = '';
$GLOBALS ['xItemMrp'] = '';
$GLOBALS ['xItemSize'] = '';
$GLOBALS ['xItemColor'] ='';
$GLOBALS ['xItemCode'] ='';
$GLOBALS ['xItemDiscount']='';
$GLOBALS ['xItemSupplierNo']='';
 $xPurchaseCode='';
?>
<style>
@media all {
	.page-break	{ display: none; }
}

@media print {
	.page-break	{ display: block; page-break-before: always; }
}
.rowstyle
{
	font-size:8px;  
	font-weight: bold; 
	font-family: Times New Roman;
	align:center;
}

</style>
<form
	action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<div class="panel panel-success">
		<div class="panel-heading  text-center">
			<h3 class="panel-title">LABEL 2</h3>
		</div>
		<div class="panel-body">
			<div class="form-group">

				<div class="col-xs-3">
					<label>Item Name:</label> <select class="form-control"
						name="f_itemno">
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
				<div class="col-xs-1">
					<label>Count:</label> <input type="text" class="form-control"
						name="f_printcount" value="1">
				</div>
			</div>
			<div class="col-xs-3">

				<input type="submit" name="save" class="btn btn-primary"
					value="CREATE BARCODE"> <input type="submit" value="PRINT"
					class="btn btn-primary" onclick="PrintDiv();" />
			</div>



		</div>
		<!-- Form-Group !-->
	</div>
	<!-- Panel Body !-->

	<!-- Panel !-->
	
</form>
						<?php
						// Create BarCode
						if (isSet ( $_POST ['save'] )) {
							include "Barcode39.php";

							$xItemNo= $_POST ['f_itemno'];
							$xPrintCount = $_POST ['f_printcount'];

							$resultitemname = mysql_query ( "SELECT *  from m_item where itemno= ".$xItemNo );
							while ( $row1 = mysql_fetch_array ( $resultitemname ) ) {
								$xBarCode = $row1 ['barcode'];
								$GLOBALS ['xName'] = $row1 ['itemname'];
								$GLOBALS ['xItemMrp'] = $row1 ['mrp'];
								$GLOBALS ['xItemSize'] = $row1 ['size'];
								$GLOBALS ['xItemColor'] =$row1 ['color'];
								$GLOBALS ['xItemCode'] =$row1 ['originalprice'];
								$GLOBALS ['xItemDiscount']=$row1 ['disamount'];
								$GLOBALS ['xItemSupplierNo']=$row1 ['supplierno'];
								$bc = new Barcode39 ( $xBarCode );
								//$bc->barcode_text_size = 2;
								//$bc->barcode_bar_thick = 1;
								//$bc->barcode_bar_thin = 1;
								$bc->barcode_height = 40;
								$bc->draw ( $xBarCode . ".gif" );
							}

							?>
<div id="divToPrint">

<?php

for($i = 0; $i < $xPrintCount; $i ++) {
	$xPurchaseCode="";
	$image = "<img src='" . $xBarCode . ".gif'/>";
	$xItemName=$GLOBALS ['xName'];
	$xMrp=$GLOBALS ['xItemMrp'];
	$xSize=$GLOBALS ['xItemSize'];
	$xColor=$GLOBALS ['xItemColor'];
									$xSplittedString = $GLOBALS ['xItemCode'] ;
$xPurchaseCode.= fn_GetPurchaseCode($xSplittedString[0]);
$xPurchaseCode.= fn_GetPurchaseCode($xSplittedString[1]);
$xPurchaseCode.= fn_GetPurchaseCode($xSplittedString[2]);
	fn_FindColorName($xColor);
	fn_FindSizeName($xSize);
	$xCode=$GLOBALS ['xItemCode'];
	$xDiscount=$GLOBALS ['xItemDiscount'];
	$xSupplierNo=$GLOBALS ['xItemSupplierNo'];
	fn_FindAccountLedgerDetails($xSupplierNo);
	$xItemSupplierName=$GLOBALS ['xAccountLedgerName'];
	$xHiddenCode=$xPurchaseCode;
	?>
<table height="96px" width="384px">
<td width="192px">
<p>GLOBAL TRADERS
<?php echo $image; ?></br>
<?php echo substr($xItemName,0,15); ?>/Mrp:<?php echo $xMrp ?>
<?php echo $xHiddenCode ?>  /S- <?php echo $xSize ?>/ C-<?php echo $xColor ?> / <?php echo $xDiscount ?>
</p>
</td><td width="192px">
<p>GLOBAL TRADERS
<?php echo $image; ?></br>
<?php echo substr($xItemName,0,15); ?>/Mrp:<?php echo $xMrp ?>
<?php echo $xHiddenCode ?>  /S- <?php echo $xSize ?>/ C-<?php echo $xColor ?> / <?php echo $xDiscount ?>
</p>
</p>
</td>
</tr>

<div class="page-break"></div>

			<?php $xHiddenCode="" ;}}?>
			</table>
		</div>


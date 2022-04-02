
<?php
include ('globalfile.php');
$GLOBALS ['xCurrentDate'] = date ( 'Y-m-d' );
$xLessAmount = 0;
fn_GetCompanyInfo (1);
$xSalesInvoiceNo = $_GET ['salesinvoiceno'];
$xQry = "SELECT * from inv_salesentry1 where salesinvoiceno=$xSalesInvoiceNo";
$result = mysql_query ( $xQry );
while ( $row = mysql_fetch_array ( $result ) ) { // Creates a loop to loop through results
	findcustomername ( $row ['customerno'] );
	$xBillDate = $row ['date'];
	$xDespatch = $row ['despatch'];
	$xVehicleNo = $row ['vehicleno'];
	$xDestination = $row ['destination'];
}

?>
<html>
<head>
<script type="text/javascript"> 
window.onload=PrintDiv;     
</script>
</head>
<body onload="window.print(); setTimeout(window.close, 0);">    
	<div id="divToPrint">
		<?php
		echo "<center>TAX INVOICE</CENTER>";
		echo "<table border=1 width=100% >";
		echo "<tr><td align=left width=40%>  " . $GLOBALS ['xCompanyTitle'] . " </td>
				  <td align=left  width=30% > " . $GLOBALS ['xCustomerName'] . " </td>
				  <td align=left width=20%> BillNo </td>
		          <td align=left width=10%> " . $xSalesInvoiceNo . " </td>
		</tr>";
				echo "<tr><td align=left > " . $GLOBALS ['xCompanyAddress1'] . " </td>
			<td align=left > " . $GLOBALS ['xCustomerAddress'] . " </td>
			<td align=left width=20% > Date  </td>
				<td align=left width=10%> " . date ( 'd/m/Y', strtotime ( $xBillDate ) ) . " </td>
		</tr>";
				
				echo "<tr><td align=left > " . $GLOBALS ['xCompanyAddress2'] . " </td>
		<td align=left > GSTIN No" . $GLOBALS ['xCustomerGSTINNo'] . " </td>
        		<td align=left width=20%> Despatch Through</td>
       		
       				<td align=left width=10%> " . $xDespatch . " </td></tr>";
				
				echo "<tr><td align=left > GSTIN No" . $GLOBALS ['xCompanyGSTINNo'] . " </td><td>AADHAR NO: " . $GLOBALS ['xCustomerAADHARNo'] . "</td>
        		<td align=left >Vehicle No</td>
       		<td align=left width=10%> " . $xVehicleNo . " </td></tr>";
				
				echo "<tr><td></td><td></td>
        		<td align=left >Destination </td>
			<td align=left width=10%> " . $xDestination . " </td></tr>";
				echo "</table>";
				
				echo "<table border=1 width=100% height=450px> ";
				
				echo "<tr > 
						<td align=left  height=60px width=20%> Product Name  </td>
							<td align=left width=10%> HSN Code  </td>
								<td align=left width=10% > Qty </td>
								<td align=left width=10%>Rate </td>
								<td align=left width=10%> Total  </td>
								<td align=left width=10%>Tax%  </td>
						<td align=left width=5%>Dis%  </td>
						<td align=left width=5%>Dis Amt  </td>
						<td align=left width=5%>SGST </td>
						<td align=left width=5%>CGST </td>
						<td align=left width=10%>NetAmount </td>
						</tr>";
				
				$xSlNo = 0;
				$xCount = 1;
				$xTotalAmount = 0;
				$xSalesInvoiceNo = $_GET ['salesinvoiceno'];
				
				$xGrandNetAmount = 0;
				$xGrandCgst = 0;
				$xGrandSgst = 0;
				$xQry = "SELECT * from inv_salesentry where salesinvoiceno=$xSalesInvoiceNo";
				$result = mysql_query ( $xQry );
				
				while ( $row = mysql_fetch_array ( $result ) ) { // Creates a loop to loop through results
					
					$xSlNo += 1;
					finditemname ( $row ['itemno'] );
					finditempricevat ( $row ['itemno'], $row ['batchid'] );
					
					$xGst = $row ['vat'] / 2;
					$xAmount = $row ['amount'];
					$xDiscountPercentage = $row ['discountpercentage'];
					$xDiscountValue = $xAmount * ($xDiscountPercentage / 100);
					$xAmountMinusDiscValue = $xAmount - $xDiscountValue;
					$Cgst = round ( $xAmountMinusDiscValue * ($xGst / 100), 2 );
					$xGrandCgst += $Cgst;
					$Sgst = round ( $xAmountMinusDiscValue * ($xGst / 100), 2 );
					$xGrandSgst += $Sgst;
					$xNetAmount = $xAmountMinusDiscValue + $Cgst + $Sgst;
					
					$xGrandNetAmount += $xNetAmount;
					
					echo "<tr class=hide_bottom> 
				
				 <td align=left width=40%> " . $GLOBALS ['xItemName'] . " </td>
				 <td align=left width=10%> " . $GLOBALS ['xHSNCode'] . " </td>	
						<td align=right width=5%>" . $row ['qty'] . " </td>
						<td align=right width=5%> " . $row ['unitrate'] . "</td>
						<td align=right width=5%> " . $xAmount . "  </td>
						<td align=right width=5%>" . $row ['vat'] . " </td>
						<td align=right width=5%> " . $xDiscountPercentage . " </td>
						<td align=right width=5%> " . $xDiscountValue . " </td>
						<td align=right width=5%> " . $Cgst . "</td>
						<td align=right width=5%>" . $Sgst . " </td>
						<td align=right width=10%>" . $xNetAmount . " </td>			

		 </tr>";
					$xTotalAmount += $row ['amount'];
					$xCount += 1;
				}
				$xQry = "SELECT * from inv_salesentry1 where salesinvoiceno=$xSalesInvoiceNo";
				$result = mysql_query ( $xQry );
				while ( $row = mysql_fetch_array ( $result ) ) { // Creates a loop to loop through results
					$xLessAmount = $row ['lessamount'];
				}
				if ($xLessAmount > 0) {
					echo "<tr><td align=left colspan=3>LESS AMOUNT </td><td align=right>" . $xLessAmount . "</td></tr>";
					$xTotalAmount = $xTotalAmount - $xLessAmount;
				}
				for($i = $xCount; $xCount <= 9; $xCount ++) {
					echo "<tr class=hide_top>
				
				 <td align=left width=20%>  </td>
				 <td align=left width=10%>  </td>
						<td align=left width=10%> </td>
						<td align=left width=10%> </td>
						<td align=left width=10%>  </td>
						<td align=left width=10%> </td>
						<td align=left width=5%> </td>
						<td align=left width=5%>  </td>
						<td align=left width=5%> </td>
						<td align=left width=5%> </td>
						<td align=left width=10%> </td>
				
		 </tr>";
				}
				
				$xBeforeRoundOffNetTotal = $xGrandNetAmount;
				$xAfterRoundOffNetTotal = (round ( $xGrandNetAmount, 0 ));
				$xRoundOff = (round ( $xAfterRoundOffNetTotal - $xBeforeRoundOffNetTotal, 2 ));
				
				echo "<tr>
				

		<td align=right colspan=10>Round Off</td>
			
						<td align=right width=10%>" . $xRoundOff . " </td>
				
		 </tr>";
				
				echo "<tr>
				
				 <td align=left width=20%> Total </td>
		<td align=left colspan=4>" . ucwords ( convert_number_to_words ( $xAfterRoundOffNetTotal ) ) . " Rupees Only</td>
						<td align=right width=10%> </td>
						<td align=right width=5%> </td>
						<td align=right width=5%>  </td>
						<td align=right width=5%>" . $xGrandCgst . " </td>
						<td align=right width=5%>" . $xGrandSgst . "</td>
						<td align=right width=10%>" . $xAfterRoundOffNetTotal . " </td>
				
		 </tr>";
				echo "<tr class=hide_bottom height=50px>
								<td align=right colspan=11 width=100%>For " . $GLOBALS ['xCompanyTitle'] . " </td>
								</tr>";
				echo "</table>";
				
				echo "<table border=1 WIDTH=100%> ";
				echo "<tr><td align=center colspan=4>COLLECTION COPY</td>";
				echo "<tr> <td align=center width=25%>Bill No " . $xSalesInvoiceNo . "  </td>
						<td align=center width=25%>Date </br>" . date ( 'd/m/Y', strtotime ( $xBillDate ) ) . "  </td>
							<td align=center width=25%>Name </br>" . $GLOBALS ['xCustomerName'] . "  </td>
						<td align=center width=25%>Total Amount " . $xAfterRoundOffNetTotal . "  </td>
						</tr> ";
				
				echo "</table>";
				
				echo "<table  border=1 width=100% > ";
				echo "<tr  height=50px>
						<td align=left width=30% >Customer Signature </br></br></br></br></br></br>Please check goods before signing</td> 
						<td align=right width=70%> </td>
					</tr>";
				
				echo "</table>";
				
				mysql_close (); // Make sure to close out the database connection
				
				?>

	</div>
</body>
</html>


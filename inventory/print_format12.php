<?php
include ('globalfunctions.php');
$GLOBALS ['xCurrentDate'] = date ( 'Y-m-d' );
$xLessAmount = 0;
$xGrandDiscountValue=0;
fn_GetCompanyInfo ( 1 );
$xSalesInvoiceNo = $_GET ['salesinvoiceno'];
$xQry = "SELECT * from inv_salesentry1 where salesinvoiceno=$xSalesInvoiceNo";
$result = mysql_query ( $xQry );
while ( $row = mysql_fetch_array ( $result ) ) { // Creates a loop to loop through results
	findcustomername ( $row ['customerno'] );
	$xBillDate = $row ['date'];
	$xDespatch = $row ['despatch'];
	$xDestination = $row ['destination'];
	$xModeofPayment = $row ['modeofpayment'];
	$TermsofDelivery = $row ['termsofdelivery'];
	$xVehicleNo = $row ['vehicleno'];
	$xServiceCharges = $row ['servicecharges'];
}
?>
<html>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<body onload="window.print(); setTimeout(window.close, 0);">
	<div id="divToPrint">
				<?php
				
				echo "<table width=100% > ";
					echo "<tr>
		
				<td  align=left width=15% >
		<img src=images/logo.jpg
		width=100px height=70px> </td>
				<td style='font-size: 20pt; font-family:Arial' align=center > " . $GLOBALS ['xCompanyTitle'] . " </td>
</tr>";	echo "</table>";
			echo "<table width=100% > ";
				echo "<tr><td align=center style='font-size: 14pt; font-family:Arial' > " . $GLOBALS ['xCompanyAddress1'] . " </td></tr>";
				echo "<tr><td align=center >" . $GLOBALS ['xCompanyAddress2'] . " " . $GLOBALS ['xCompanyAddress3'] . " " . $GLOBALS ['xCompanyContactNo'] . " </td></tr>";
				
				
				echo "</table>";
				
				echo "<table  width=100% > ";
				
				echo "<tr>
						<td width=50% align=left > " . $GLOBALS ['xCustomerName'] . " </td>
				
						<td align=left width=12.5% > Date </td>
						<td width=12.5%>" . date ( 'd/m/Y', strtotime ( $xBillDate ) ) . " </td>
				</tr>";
				echo "<tr>
					
						<td colspan=2>" . $xModeofPayment . "  - Bill</td>
								<td align=left width=12.5%> BillNo</td>
						<td width=12.5%>" . $xSalesInvoiceNo . " </td>
						</tr>";
				
				echo "</table>";
				echo "<hr>";
				// echo "<table border=1 width=100% height=350px>";
				echo "<table  width=100%>";
				echo "<tr >
				<td align=left width=5%> SL  </td>

						<td align=left width=20%> Particulars  </td>
						<td align=right width=10% > Qty </td>
						<td align=right width=10%>MRP </td>
												<td align=right width=10%>GRP </td>
			
				
						</tr>";
				echo "</table>";
				echo "<hr>";
				echo "<table  width=100%>";
				
				$xSlNo = 0;
				$xCount = 0;
				$xTotalAmount = 0;
				$xSalesInvoiceNo = $_GET ['salesinvoiceno'];
				
				$xGrandQty = 0;
				$xGrandNetAmount = 0;
				$xGrandCgst = 0;
				$xGrandSgst = 0;
				
				$xZeroPercentage = '';
				$xFivePercentage = '';
				$xTwelvePercentage = '';
				$xEighteenPercentage = '';
				$xTwentyEightPercentage = '';
				
				$xQry = "SELECT * from inv_salesentry where salesinvoiceno=$xSalesInvoiceNo";
				$result = mysql_query ( $xQry );
				
				while ( $row = mysql_fetch_array ( $result ) ) { // Creates a loop to loop through results
					
					$xSlNo += 1;
					finditemname ( $row ['itemno'] );
					finditempricevat ( $row ['itemno'], $row ['batchid'] );
					
					$xGst = $row ['vat'];
					$xQty = $row ['qty'];
					$xUnitRate = $row ['unitrate'];
					$xUnitMrp = $row ['unitmrp'];
					
					$xUnitAmount = $xQty * $xUnitMrp;
					$xDiscountPercentage = $row ['discountpercentage'];
					$xAfterDiscountValue = $xUnitMrp - ($xUnitMrp * ($xDiscountPercentage / 100));
					$xGrandQty += $xQty;
					$xGrandDiscountValue+=$xUnitMrp * ($xDiscountPercentage / 100);
					
					$Cgst = $xAfterDiscountValue * ($xGst / 100);
					$xGrandCgst += $Cgst;
					$Sgst = $xAfterDiscountValue * ($xGst / 100);
					$xGrandSgst += $Sgst;
					$xNetAmount = $xAfterDiscountValue + $Cgst;
					$xGrandNetAmount += $xAfterDiscountValue;
					
					echo "<tr class=hide_bottom> 
						<td height = 30px align=left width=5%> " . $xSlNo . "  </td>
						<td align=left width=20%> " . $GLOBALS ['xItemDescription'] . " </td>
						<td align=right width=10%>" . $row ['qty'] . " </td>
						
						<td align=right width=10%> " . $row ['unitmrp'] . "</td>
							
						<td align=right width=10%> " . fn_RupeeFormat ( $xAfterDiscountValue ) . "</td>
					 </tr>";
					$xCount += 1;
					
					// $xTotalAmount += $row ['amount'];
					$xTotalAmount += $xAfterDiscountValue;
					
					$xCount += 1;
					
					if ($xGst == 0.00) {
						$xZeroPercentage += ($Cgst / 2);
					}
					if ($xGst == 5.00) {
						$xFivePercentage += ($Cgst / 2);
					}
					
					if ($xGst == 12.00) {
						$xTwelvePercentage += ($Cgst / 2);
					}
					if ($xGst == 18.00) {
						$xEighteenPercentage += ($Cgst / 2);
					}
					if ($xGst == 28.00) {
						$xTwentyEightPercentage += ($Cgst / 2);
					}
				}
				/*
				 * for($i = $xCount; $xCount <= 10; $xCount ++) {
				 * echo "<tr class=hide_top>
				 *
				 * <td align=left width=5%> </td>
				 * <td align=left width=20%> </td>
				 * <td align=left width=15%> </td>
				 * <td align=left width=15%> </td>
				 * <td align=left width=10%> </td>
				 * <td align=left width=10%> </td>
				 * <td align=left width=10%> </td>
				 * <td align=left width=10%> </td>
				 *
				 *
				 * </tr>";
				 * }
				 */
				
				echo "</table>";
				$xRoundOffTotal = (round ( $xTotalAmount, 2 ));
				$xRoundOffGst = (round ( $xGrandCgst, 2 ));
				//$xBeforeRoundOffNetTotal = $xRoundOffTotal + $xRoundOffGst;
				$xBeforeRoundOffNetTotal = $xRoundOffTotal ;
				$xAfterRoundOffNetTotal = (round ( $xBeforeRoundOffNetTotal, 0 ));
				$xRoundOff = (round ( $xBeforeRoundOffNetTotal - $xAfterRoundOffNetTotal, 2 ));
				$xcgst = $xRoundOffGst / 2;
				$xsgst = $xRoundOffGst / 2;
				/*
				 * echo "<table width=100%>";
				 * echo "<tr><td align=center width=60% colspan=6> </td><td align=left> Service Charges " . $xServiceCharges . " </td></tr>";
				 * echo "</table>";
				 */
				
				echo "<table width=100%>";
				echo "<tr><td align=center  width=60% colspan=6> </td><td align=left> T.Qty " . $xGrandQty . " </td></tr>";
				
				/*echo "<tr><td align=center  width=10% colspan=2></td><td width=10%> 2.5% </td><td width=10%> 6% </td><td width=10%> 9% </td><td width=10%> 14% </td><td width=20% align=right> Total </td><td width=20% align=right> " . $xRoundOffTotal . " </td></tr>";
				echo "<tr><td align=center  width=10% colspan=2>CGST</td><td width=10%> " . round ( $xFivePercentage, 2 ) . "  </td><td width=10%> " . round ( $xTwelvePercentage, 2 ) . " </td><td width=10%> " . round ( $xEighteenPercentage, 2 ) . " </td><td width=10%> " . round ( $xTwentyEightPercentage, 2 ) . " </td><td width=20% align=right> GstTax </td><td width=20% align=right> " . $xRoundOffGst . " </td></tr>";
				echo "<tr><td align=center  width=10% colspan=2>SGST</td><td width=10%> " . round ( $xFivePercentage, 2 ) . "  </td><td width=10%> " . round ( $xTwelvePercentage, 2 ) . "</td><td width=10%>" . round ( $xEighteenPercentage, 2 ) . " </td><td width=10%> " . round ( $xTwentyEightPercentage, 2 ) . " </td><td width=20% align=right> Round Off </td><td width=20% align=right> " . $xRoundOff . " </td></tr>";
				echo "<tr><td align=center  width=60% colspan=6>" . ucwords ( convert_number_to_words ( $xAfterRoundOffNetTotal ) ) . " Rupees Only </td><td width=20% align=right> NetAmount </td><td width=20% align=right> " . number_format ( $xAfterRoundOffNetTotal, 2 ) . " </td></tr>";
				*/
				echo "<tr><td align=center  width=60% colspan=6></td><td width=20% align=right> Total </td><td width=20% align=right> " . $xRoundOffTotal . " </td></tr>";
				//echo "<tr><td align=center  width=60% colspan=6></td><td width=20% align=right> GstTax </td><td width=20% align=right> " . $xRoundOffGst . " </td></tr>";
				echo "<tr><td align=center  width=60% colspan=6></td><td width=20% align=right> Round Off </td><td width=20% align=right> " . $xRoundOff . " </td></tr>";
				echo "<tr><td align=center  width=60% colspan=6></td><td width=20% align=right> NetAmount </td><td width=20% align=right> " . number_format ( $xAfterRoundOffNetTotal, 2 ) . " </td></tr>";
				
				echo "</table>";
				echo "<h3>Total  Rupees " . number_format ( $xAfterRoundOffNetTotal, 2 );
				echo "<h4>Your Discount of this bill is Rs " . fn_RupeeFormat(round ( $xGrandDiscountValue));
				echo "<hr>";
				
				mysql_close (); // Make sure to close out the database connection
				
				?>

	</div>

</body>
</html>


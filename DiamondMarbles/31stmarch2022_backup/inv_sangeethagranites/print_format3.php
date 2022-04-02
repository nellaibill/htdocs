<?php
include ('globalfile.php');
$GLOBALS ['xCurrentDate'] = date ( 'Y-m-d' );
$xLessAmount = 0;
fn_GetCompanyInfo ( 1 );
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
<title>SALES BILL</title>
<head>
<link href="bootstrap.css" rel="stylesheet">
<style type="text/css">
table {
    border-collapse: collapse;
    font-size: 14px;
}

  hr{
    padding: 0px;
    margin: 0px;    
  }
</style>	
<script type="text/javascript"> 
window.onload=PrintDiv;     
</script>
</head>

<body>
	<input type="submit" value="print" onclick="PrintDiv();" />
	<div id="divToPrint">
				<?php
				echo "<font color=blue><center>TAX INVOICE</CENTER></font>";
				echo "<table border=0 width=100%>";
				echo "<tr><td align=left > <font color=blue>" . $GLOBALS ['xCompanyTitle'] . " </font></td><td align=right><font color=blue> GSTIN No : " . $GLOBALS ['xCompanyGSTINNo'] . " </font></td></tr>";
				echo "<tr><td align=left > <font color=blue>" . $GLOBALS ['xCompanyAddress1'] . " </font></td></tr>";
				echo "<tr><td align=left > <font color=blue>" . $GLOBALS ['xCompanyAddress2'] . " </font></td></tr>";
				echo "<tr><td align=left > <font color=blue>" . $GLOBALS ['xCompanyAddress3'] . " " . $GLOBALS ['xCompanyContactNo'] . " </font></td></tr>";
					
				echo "</table></font>";
				
				echo "<hr>";
				echo "<table border=0 width=100%>";
				echo "<tr>";
				
				echo "<td width=50%>";
				echo "<table border=0 >"; // start a table tag in the HTML
				echo "<tr><td align=left > " . $GLOBALS ['xCustomerName'] . " </td></tr>";
				echo "<tr><td align=left > " . $GLOBALS ['xCustomerAddress'] . " </td></tr>";
				echo "<tr><td align=left > GSTIN No : " . $GLOBALS ['xCustomerGSTINNo'] . " </td></tr>";
				echo "</table>";
				echo "</td>";
				
				echo "<td width=50%>";
				echo "<table> ";
				echo "<tr><td align=left width=20%> Inv Type </td><td width=20%>Credit Bill</td></tr>";
				echo "<tr><td align=left width=20%> BillNo</td><td>" . $xSalesInvoiceNo . " </td></tr>";
				echo "<tr><td align=left width=20% > Date </td><td>" . date('d/m/Y', strtotime($xBillDate))  . " </td></tr>";
				echo "</table>";
				echo "</td>";
				
				echo "</table>";
				echo "<hr>";
				
				echo "<table border=0 width=100%>";

				echo "<tr > 
				<td align=left width=5%> SL  </td>
						<td align=left width=15%> HSN Code  </td>
						<td align=left width=40%> Particulars  </td>
						<td align=right width=10% > Qty </td>
						<td align=right width=10%>Rate </td>
						<td align=right width=10%>GST%  </td>
						<td align=right width=10%> Total  </td>

						</tr>";
				echo "</table>";
				echo "<hr>";
				echo "<table border=0 width=100%>";
	
				$xSlNo = 0;
				$xCount = 1;
				$xTotalAmount = 0;
				$xSalesInvoiceNo = $_GET ['salesinvoiceno'];

				$xGrandQty = 0;
				$xGrandNetAmount = 0;
				$xGrandCgst = 0;
				$xGrandSgst = 0;
				
				
				$xZeroPercentage='';
				$xFivePercentage='';
				$xTwelvePercentage='';
				$xEighteenPercentage='';
				$xTwentyEightPercentage='';
				
				
				$xQry = "SELECT * from inv_salesentry where salesinvoiceno=$xSalesInvoiceNo";
				$result = mysql_query ( $xQry );
				
				while ( $row = mysql_fetch_array ( $result ) ) { // Creates a loop to loop through results
					
					$xSlNo += 1;
					finditemname ( $row ['itemno'] );
					finditempricevat ( $row ['itemno'], $row ['batchid'] );
					
					$xGst = $row ['vat'];
				
					$xAmount = $row ['amount'];
					$xGrandQty+=$row ['qty'];
					$Cgst = $xAmount * ($xGst / 100);
					$xGrandCgst += $Cgst;
					$Sgst = $xAmount * ($xGst / 100);
					$xGrandSgst += $Sgst;
					$xNetAmount = $xAmount + $Cgst ;
					$xGrandNetAmount += $xNetAmount;
					echo "<tr> 
<td align=left width=5%> " . $xSlNo . "  </td>
	     				<td align=left width=15%> " . $GLOBALS ['xHSNCode'] . " </td>
				 		<td align=left width=40%> " . $GLOBALS ['xItemName'] . " </td>
						<td align=right width=10%>" . $row ['qty'] . " </td>
						<td align=right width=10%> " . $row ['unitrate'] . "</td>
						<td align=right width=10%>" . $xGst . " </td>
						<td align=right width=10%> " . $xAmount . "  </td>
 </tr>";
					$xTotalAmount += $row ['amount'];
					$xCount += 1;
					
					if ($xGst == 0.00) {
						$xZeroPercentage +=($Cgst/2);
					}
					if ($xGst == 5.00) {
						$xFivePercentage  +=($Cgst/2);
					}
						
					if ($xGst == 12.00) {
						$xTwelvePercentage  +=($Cgst/2);
					}
					if ($xGst == 18.00) {
						$xEighteenPercentage  +=($Cgst/2);
					}
					if ($xGst == 28.00) {
						$xTwentyEightPercentage  +=($Cgst/2);
					}
				}
		
				echo "</table>";
				$xRoundOffTotal=(round($xTotalAmount,2));
				$xRoundOffGst=(round($xGrandCgst,2));
				$xBeforeRoundOffNetTotal=$xRoundOffTotal+$xRoundOffGst;
				$xAfterRoundOffNetTotal=(round($xBeforeRoundOffNetTotal,0));
				$xRoundOff=		(round($xBeforeRoundOffNetTotal-$xAfterRoundOffNetTotal,2));
				$xcgst=$xRoundOffGst/2;
				$xsgst=$xRoundOffGst/2;
				
			
				
				echo "<hr>";
				echo "<table width=100%>";
				echo "<tr><td align=center  width=60% colspan=6> GST SUMMARY</td><td align=left> T.Qty " . $xGrandQty . " </td></tr>";
				echo "<tr><td align=center  width=10% colspan=2></td><td width=10%> 2.5% </td><td width=10%> 6% </td><td width=10%> 9% </td><td width=10%> 14% </td><td width=20% align=right> Total </td><td width=20% align=right> " . $xRoundOffTotal . " </td></tr>";
				echo "<tr><td align=center  width=10% colspan=2>CGST</td><td width=10%> ". round($xFivePercentage,2)."  </td><td width=10%> ". round($xTwelvePercentage,2)." </td><td width=10%> ". round($xEighteenPercentage,2)." </td><td width=10%> ". round($xTwentyEightPercentage,2)." </td><td width=20% align=right> GstTax </td><td width=20% align=right> " . $xRoundOffGst . " </td></tr>";
				echo "<tr><td align=center  width=10% colspan=2>SGST</td><td width=10%> ". round($xFivePercentage,2)."  </td><td width=10%> ". round($xTwelvePercentage,2)."</td><td width=10%>". round($xEighteenPercentage,2)." </td><td width=10%> ". round($xTwentyEightPercentage,2)." </td><td width=20% align=right> Round Off </td><td width=20% align=right> " . $xRoundOff . " </td></tr>";
				echo "<tr><td align=center  width=60% colspan=6>" . ucwords ( convert_number_to_words ( $xAfterRoundOffNetTotal ) ) . " Rupees Only </td><td width=20% align=right> NetAmount </td><td width=20% align=right> " . number_format($xAfterRoundOffNetTotal, 2)  . " </td></tr>";
			

				/* echo "<tr><td align=center  width=20%> GST SUMMARY </td><td align=right  width=60%> Total </td><td align=right width=20%>" . $xRoundOffTotal . " </td></tr>";
				echo "<tr><td align=left  width=20%> CGST ".$xcgst."</td><td align=right  width=60%> GST Tax </td><td align=right width=20%>" . $xRoundOffGst . " </td></tr>";
				echo "<tr><td align=left  width=20%> SGST ".$xsgst." </td><td align=right  width=60%> Round Off </td><td align=right width=20%>" . $xRoundOff . " </td></tr>";
				echo "<tr><td align=right  width=20%>  </td><td align=right  width=60%> NetAmount </td><td align=right width=20%>" . number_format($xAfterRoundOffNetTotal, 2)  . " </td></tr>";
				echo "<tr><td colspan=2>" . ucwords ( convert_number_to_words ( $xAfterRoundOffNetTotal ) ) . " Rupees Only</td></tr>";
			 */	echo "</table>";
				echo "<table  border=0 width=100% height=100px>";
				echo "<tr>";
				
				echo "<td align=left width=50%>Terms and condition</br>
							Subject to Tirunelveli Jurisdication </br>E.& O.E..</td></tr>";

				
				echo "<td align=right width=50%><font color=blue>For " . $GLOBALS ['xCompanyTitle'] . "</font></td></tr>";
		
				

				echo "</table>";
				
				mysql_close (); // Make sure to close out the database connection
				
				?>

	</div>
</body>
</html>


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
	$xDestination = $row ['destination'];
	$xModeofPayment = $row ['modeofpayment'];
	$TermsofDelivery = $row ['termsofdelivery'];
	$xVehicleNo = $row ['vehicleno'];
	$xServiceCharges = $row ['servicecharges'];
	
}

?>
<html>
<title>SALES BILL</title>
<head>
<link href="bootstrap.css" rel="stylesheet">
<style type="text/css">
   th {
        font-size: 20px;
        font-weight: bold;
     
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
				echo "<center>TAX INVOICE</CENTER></font>";
			
				echo "<table width=100% > ";
					echo "<tr><td  align=left width=50%> " . $GLOBALS ['xCompanyTitle'] . " </td><td align=left width=25%> Inv Type </td><td width=25%>Credit Bill</td></tr>";
				echo "<tr><td align=left width=50%> " . $GLOBALS ['xCompanyAddress1'] . " </td><td align=left width=25%> BillNo</td><td>" . $xSalesInvoiceNo . " </td></tr>";
				echo "<tr><td align=left width=50%>" . $GLOBALS ['xCompanyAddress2'] . " </td><td align=left width=25% > Date </td><td>" . date('d/m/Y', strtotime($xBillDate))  . " </td></tr>";
				echo "<tr><td align=left > " . $GLOBALS ['xCompanyAddress3'] . " " . $GLOBALS ['xCompanyContactNo'] . " </td></tr>";
				echo "<tr><td align=left > GSTIN No : " . $GLOBALS ['xCompanyGSTINNo'] . " </td></tr>";				
				echo "</table>";
					
				echo "<hr>";
				echo "<table width=100% > ";
				echo "<tr><td width=50% align=left > " . $GLOBALS ['xCustomerName'] . " </td>
       					   <td align=left width=25%> Delivery Note </td>
       					   <td width=25%>Mode/Terms of Payment ". $xModeofPayment."</td></tr>";
				echo "<tr><td width=50% align=left > " . $GLOBALS ['xCustomerAddress'] . " </td><td align=left width=25%> Supplier Ref </td><td width=25%>Other Ref</td></tr>";
				echo "<tr><td width=50% align=left > " . $GLOBALS ['xCustomerMobileNo'] . " </td><td align=left width=25%> Buyer Order No </td><td width=25%>Dated</td></tr>";
				echo "<tr><td width=50% align=left > GSTIN No : " . $GLOBALS ['xCustomerGSTINNo'] . " </td><td align=left width=25%> Despatch Document No</td><td width=25%>Delivery Note Date</td></tr>";

	
				echo "<tr><td width=50%> </td><td align=left width=25%> Despatch Through ".$xDespatch."</td><td width=25%>Destination".$xDestination."</td></tr>";
					
				echo "</table>";
			
				echo "<hr>";

				
				echo " <table width=100% >

				<tr > 
				<th align=left width=5% > SL  </th>
					
						<th align=left width=40%> Description of Goods-Sizes  </th>
							<th align=left width=15%> HSN Code  </th>
						<th align=right width=10% > Qty </th>
						<th align=right width=10%>Rate </th>
						<th align=right width=10%>GST%  </th>
						<th align=right width=10%> Total  </th>
						</tr>
				</table>";
				 
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
	     			
				 		<td align=left width=40%> " . $GLOBALS ['xItemName'] . " </td>
      			<td align=left width=15%> " . $GLOBALS ['xHSNCode'] . " </td>
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
				echo "<hr>";
				$xRoundOffTotal=(round($xTotalAmount,2));
				$xRoundOffGst=(round($xGrandCgst,2));
				$xBeforeRoundOffNetTotal=$xRoundOffTotal+$xRoundOffGst;
				$xAfterRoundOffNetTotal=(round($xBeforeRoundOffNetTotal,0));
				$xRoundOff=		(round($xBeforeRoundOffNetTotal-$xAfterRoundOffNetTotal,2));
				$xcgst=$xRoundOffGst/2;
				$xsgst=$xRoundOffGst/2;
				
				
				//Service Charges
				$xAfterRoundOffNetTotal+=$xServiceCharges;
			
				
		
				echo "<table width=100%>";
	

				 echo "<tr><td align=right  width=60%> Total </td><td align=right width=20%>" . $xRoundOffTotal . " </td></tr>";
				 echo "<tr><td align=right  width=60%> Service Charge </td><td align=right width=20%>" . $xServiceCharges . " </td></tr>";
				echo "<tr><td align=right  width=60%> SGST  </td><td align=right width=20%>" . $xcgst . " </td></tr>";
				echo "<tr><td align=right  width=60%> CGST </td><td align=right width=20%>" . $xsgst . " </td></tr>";
				echo "<tr><td align=right  width=60%> Round Off </td><td align=right width=20%>" . $xRoundOff . " </td></tr>";
				echo "<tr><td align=right  width=60%> NetAmount </td><td align=right width=20%>" . number_format($xAfterRoundOffNetTotal, 2)  . " </td></tr>";
				echo "</table>";
				echo "<hr>";
				echo "<table  border=0 width=100% ";
				echo "<tr><td colspan=2>" . ucwords ( convert_number_to_words ( $xAfterRoundOffNetTotal ) ) . " Rupees Only</td></tr>";
			echo "</table>";
			echo "<hr>";
				echo "<table  border=0 width=100% height=100px>";
				
				echo "<tr>";
				echo "<td width=40% colspan=4  align=center  style='font-size: 11pt; font-family:Arial'></td>";
				echo "<td width=20% colspan=2  align=center style='font-size: 11pt; font-family:Arial'>Taxable Value</td>";
				echo "<td width=20% colspan=4  align=center style='font-size: 11pt; font-family:Arial'>Central Tax</td>";
				echo "<td width=20% colspan=4  align=center style='font-size: 11pt; font-family:Arial'>State Tax</td>";
				echo "</tr>";
				
				
				
				echo "<tr>";
				echo "<td width=40% colspan=4  align=center style='font-size: 11pt; font-family:Arial'></td>";
				echo "<td width=20% colspan=2  align=center style='font-size: 11pt; font-family:Arial'>".$xRoundOffGst."</td>";
				echo "<td width=10% colspan=2  align=center style='font-size: 11pt; font-family:Arial'>14%</td>";
				echo "<td width=10% colspan=2  align=center style='font-size: 11pt; font-family:Arial'>".$xcgst."</td>";
				echo "<td width=10% colspan=2  align=center style='font-size: 11pt; font-family:Arial'>14%</td>";
				echo "<td width=10% colspan=2  align=center style='font-size: 11pt; font-family:Arial'>".$xsgst."</td>";
				echo "</tr>";
				echo "<tr>";
				
				echo "<tr>";
				echo "<td width=22% colspan=14  style='font-size: 11pt; font-family:Arial'>Tax Amount in Words ". ucwords ( convert_number_to_words ( $xRoundOffGst ) ) . "  Only</td>";
				echo "</tr>";
				echo "</table>";
				echo "<hr>";

				echo "<table  border=0 width=100%> ";
				echo "<td align=left  width=50%>E.& O.E..</br>Declaration</br>
      					We declare that this invoice shows the actual price of the goods described and that all particulars are true and correct</td>";


				echo "<td align=right width=50%>For " . $GLOBALS ['xCompanyTitle'] . "</td>";
				echo "</tr>";
				

				echo "</table>";
				
				mysql_close (); // Make sure to close out the database connection
				
				?>

	</div>
</body>
</html>


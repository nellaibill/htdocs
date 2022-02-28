
<?php
GetMaxIdNo ();
$xHsnCode = '';
function GetMaxIdNo() {
	$sql = "SELECT  salesbillno from config_print";
	$result = mysql_query ( $sql ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xSalesBillNo'] = $row ['salesbillno'];
	}
}
$xMaxSalesBillNo = $GLOBALS ['xSalesBillNo'];
echo "<center><img src=images/uh.png></br></br>";
echo "		<font size=3><b>
TAX INVOICE</b></center>";
echo "<table border=1  width=100% style=border-collapse:collapse;>";

echo "<tr>";
echo "<td width=10%  style='border-right:none;border-left:none;border-bottom:none;border-top:none'><img src=images/logo1.png> </td>";
echo "<td width=90% style='font-size: 36pt; font-family:Algerian'  ><center>SRI SURIYA TRADERS</center></td>";

echo "</tr>";

echo "<tr>";

echo "<td style='border-right:none;border-left:none;border-bottom:none;border-top:none'></td>";
echo "<td colspan=8 align=center>		
					
	
		<b>			
1D/A1 SASTHIRI NAGAR, KOVILPATTI - 628 501.		</b>	</br>			
CELLNo.9176769823  gmail - sreedhanalakshmi2011@gmail.com		</br>				
<b>	GSTIN NO. 33ACMFS1308R1ZP	</b>
";
echo "</td>";

echo "</tr></b>";

echo "</table>";
echo "<table border=1  width=100% style=border-collapse:collapse;>";

// Invoice Section

echo "<tr>";
echo "<td width=55% colspan=9 align=left style='font-size: 11pt; font-family:Algerian'>  $xCopyName </font></td>";
echo "</tr>";
$result = mysql_query ( "SELECT *  FROM bill_suryatraders_section1 WHERE salesbillno=" . $xMaxSalesBillNo ) or die ( mysql_error () );
if ($row = mysql_fetch_array ( $result )) {
	// Buyer Section
	
	findcustomerdata ( $row ['customerno'] );
	$xCustomerName = $GLOBALS ['xCustomerName'];
	$xCustomerAddress1 = $GLOBALS ['xCustomerAddress1'];
	$xCustomerAddress2 = $GLOBALS ['xCustomerAddress2'];
	$xCustomerAddress3 = $GLOBALS ['xCustomerAddress3'];
	$xCustomerCstNo = $GLOBALS ['xCustomerCstNo'];
	$xCustomerTinNo = $GLOBALS ['xCustomerTinNo'];
	$xCustomerCExNo = $GLOBALS ['xCustomerCexNo'];
	$xInvoiceNo1 = $row ['invoiceno1'];
	$originalDate = $row ['date'];
	$xDate = date ( "d.m.Y", strtotime ( $originalDate ) );
	
	$xTransporter = $row ['transporter'];
	$xDespto = $row ['despto'];
	$xDeliveryAt = $row ['deliveryat'];
	$xAmountofDuty = $row ['amountofduty'];
	$xInvIssueDate = date ( "d.m.y ", strtotime ( $row ['invissue'] ) );
	$xInvIssueTime = date ( "H:i:A", strtotime ( $row ['invissue'] ) );
	$xInvRemoveDate = date ( "d.m.y ", strtotime ( $row ['invremove'] ) );
	$xInvRemoveTime = date ( "H:i:A", strtotime ( $row ['invremove'] ) );
	
	echo "<tr >";
	echo "<td width=33% colspan=3 style='border-right:none;border-left:none;border-bottom:none;border-top:none'>Buyer</td>";
	echo "<td width=7.5% colspan=4></td>";
	echo "<td width=11% ><font size=2>Inv No.</font></td>";
	echo "<td width=11%>$xInvoiceNo1</td> </font>";
	echo "</tr>";
	
	echo "<tr >";
	echo "<td width=33% colspan=3 style='border-right:none;border-left:none;border-bottom:none;border-top:none'
			 align=left style='font-size: 11pt; font-family:Arial'><b></b></td>";
	echo "<td width=11%  colspan=4></td>";
	echo "<td width=11% >Inv Date</td>";
	echo "<td width=11% >$xDate</td>";
	echo "</tr>";
	
	echo "<tr>";
	echo "<b>	<td colspan=3 style='border-right:none;border-left:none;
	border-bottom:none;border-top:none' style='font-size: 14pt; font-family:Arial'><b>
	$xCustomerName</br>
$xCustomerAddress1</br>
$xCustomerAddress2</br>
$xCustomerAddress3</br>
GSTIN No $xCustomerTinNo</br></b>	
</td>";
	echo "<td colspan=6 style='font-size: 11pt; font-family:Arial'>

Despatch Through   &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;

  &nbsp; &nbsp; &nbsp;                        $xTransporter</br>
Destination     &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp;   
 &nbsp; &nbsp; &nbsp; &nbsp;
  &nbsp;    &nbsp; &nbsp; &nbsp; &nbsp;
  &nbsp; &nbsp; 
  &nbsp;$xDespto</br>
  
  Delivery At     &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp;   
 &nbsp; &nbsp; &nbsp; &nbsp;
  &nbsp;    &nbsp; &nbsp; &nbsp; &nbsp;
  &nbsp; &nbsp; 
  &nbsp;$xDeliveryAt</br>

		</td>";
	echo "</tr>";
}

echo "</table>";
echo "<table border=1  width=100% style=border-collapse:collapse;>";
echo "<tr>";

echo "<td width=22% colspan=2 style='font-size: 11pt; font-family:Arial'><b>DESCRIPTION OF GOODS</b>	</td>";

echo "<td width=7.5% style='font-size: 11pt; font-family:Arial'><b>HSN/SAC</b></td>";
echo "<td width=7.5% style='font-size: 11pt; font-family:Arial'><b>SizeCms</b></td>";
echo "<td width=7.5% style='font-size: 11pt; font-family:Arial'><b>G.S.M</b></td>";
echo "<td width=7.5% style='font-size: 11pt; font-family:Arial'><b>RmWt in kgs</b></td>";

echo "<td width=2.5% style='font-size: 11pt; font-family:Arial'><b>Qty</b></td>";
echo "<td width=7.5% style='font-size: 11pt; font-family:Arial'><b>Total Wt in Kgs</b></td>";
echo "<td width=7.5% style='font-size: 11pt; font-family:Arial'><b>RatePer kg./ Rm</b></td>";
echo "<td width=7.5% style='font-size: 11pt; font-family:Arial'><b>Amount</b></td>";

echo "<td width=2.5% style='font-size: 11pt; font-family:Arial'><b>DISC</b></td>";
echo "<td width=15% colspan=2 style='font-size: 11pt; font-family:Arial'><b>IGST(12%)</b></td>";
echo "<td width=7.5% style='font-size: 11pt; font-family:Arial'><b>TOTAL</b></td>";

echo "</tr>";
for($i = 1; $i <= 1; $i ++) {
	echo "<tr>";
	echo "<td width=22% colspan=14 align=left>.</td>";
	echo "</tr>";
}
$xGrandTotalWt = 0;
$xGrandTotalQty = 0;
$xGrandDisc = 0;
$xGrandAmount = 0;

$xGrandCgst = 0;
$xGrandSgst = 0;
$xGrandTotalPer = 0;

$xRowCount = 0;
// $result = mysql_query ( "SELECT * FROM bill_suryatraders_section2 WHERE salesbillno=".$xMaxSalesBillNo ) or die ( mysql_error () );
// while ( $row = mysql_fetch_array ( $result ) ) {

$result = mysql_query ( "SELECT *  FROM bill_suryatraders_section2 WHERE salesbillno=" . $xMaxSalesBillNo ) or die ( mysql_error () );
while ( $row = mysql_fetch_array ( $result ) ) {
	$font = "fonts/trichy.ttf";
	finditemcategoryname ( $row ['categoryno'] );
	$xCategoryName = $GLOBALS ['xItemCategoryName'];
	findsizename ( $row ['sizeno'] );
	$xSizeName = $GLOBALS ['xSizeName'];
	findgsmname ( $row ['gsmno'] );
	$xGsmName = $GLOBALS ['xGsmName'];
	$xTotalSize = $GLOBALS ['xSizeTotal'];
	$xItemName = strtoupper ( $row ['itemno'] );
	//$xRmWt = ($xTotalSize * $xGsmName * 144) / 10000000;
		$xRmWt =$row ['rmwt'];
	$xRmWt1 = round ( $xRmWt, 1 );
	$xQty = $row ['qty'];
	$xTotalWt = $row ['totalwt'];
	$xRate = $row ['rate'];
	$xAmount = $row ['amount'];
	
	$xDiscount = $row ['discount'];
	$xCgst = round ( $row ['cgst'] );
	$xSgst = round ( $row ['sgst'] );
	$xIgst=$xCgst+$xSgst;
	$xTotal = round ( $row ['total'] );
	$xHsnCode = $row ['hsncode'];
	echo "<tr>";
	
	echo "<td width=22% colspan=2 style='font-size: 8pt; font-family:Arial'>$xItemName   $xCategoryName</td>";
	
	echo "<td width=7.5% align=center style='font-size: 8pt; font-family:Arial'>$xHsnCode</td>";
	echo "<td width=7.5% align=center style='font-size: 8pt; font-family:Arial'>$xSizeName</td>";
	echo "<td width=7.5% align=center style='font-size: 8pt; font-family:Arial'>$xGsmName</td>";
	
	if ($row ['itemno'] == 'Duplex Reel') {
		echo "<td width=7.5% align=center style='font-size: 8pt; font-family:Arial'>0</td>";
	} else {
		echo "<td width=7.5% align=center style='font-size: 8pt; font-family:Arial'>$xRmWt1</td>";
	}
	
	echo "<td width=2.5% align=right style='font-size: 8pt; font-family:Arial'>$xQty</td>";
	echo "<td width=7.5% align=right style='font-size: 8pt; font-family:Arial'>$xTotalWt</td>";
	echo "<td width=7.5% align=right style='font-size: 8pt; font-family:Arial'>$xRate</td>";
	echo "<td width=7.5% align=right style='font-size: 8pt; font-family:Arial'>$xAmount</td>";
	
	echo "<td width=2.5% align=right style='font-size: 8pt; font-family:Arial'>$xDiscount</td>";
	echo "<td width=15 colspan=2 align=right style='font-size: 8pt; font-family:Arial'>$xIgst</td>";
		echo "<td width=7.5% align=right style='font-size: 8pt; font-family:Arial'>$xTotal</td>";
	
	echo "</tr>";
	$xGrandAmount += $row ['amount'];
	$xGrandTotalWt += $row ['totalwt'];
	$xGrandTotalQty += $row ['qty'];
	$xGrandDisc += $row ['discount'];
	$xGrandCgst += $xCgst;
	$xGrandSgst += $xSgst;
	$xGrandTotalPer += $xTotal;
	
	$xRowCount += 1;
}
$xGrandTotalPer = ceil ( $xGrandTotalPer );
for($i = $xRowCount; $i <= 6; $i ++) {
	echo "<tr>";
	echo "<td width=22% colspan=14 align=left>.</td>";
	echo "</tr>";
}
// }

// $xVatValue = ceil ( $xGrandAmount * 0.05 );
// $xRupeeString = ucwords ( convert_number_to_words ( $xGrandAmount + ceil ( $xGrandAmount * 0.05 ) ) );
$xRupeeString = ucwords ( getStringOfAmount ( ceil ( $xGrandTotalPer ) ) );
// $xGrandTotal = moneyFormatIndia($row ['total']);
// $xRupeeString = ucwords ( getStringOfAmount ($xGrandTotal) );
$xGrandIgst=$xGrandCgst+$xGrandSgst;
echo "<tr >";
echo "<td style='font-size: 11pt; font-family:Algerian'width=22% colspan=2>Total Bill  Rupees.</td>";
echo "<td width=44% colspan=4 style='font-size: 11pt; font-family:Arial'>$xRupeeString  Only</td>";
echo "<td width=7.5% align=right style='font-size: 11pt; font-family:Arial'>$xGrandTotalQty</td>";
echo "<td width=7.5% align=right style='font-size: 11pt; font-family:Arial'>$xGrandTotalWt</td>";
echo "<td width=7.5%></td>";
echo "<td width=7.5% align=right style='font-size: 11pt; font-family:Arial'>$xGrandAmount</td>";

echo "<td width=7.5% align=right style='font-size: 11pt; font-family:Arial'>$xGrandDisc</td>";

echo "<td width=15%  colspan=2 align=right style='font-size: 11pt; font-family:Arial'>$xGrandIgst</td>";
echo "<td width=7.5% align=right style='font-size: 11pt; font-family:Arial'> $xGrandTotalPer</td>";
echo "</tr>";

echo "</tr>";
for($i = 1; $i <= 1; $i ++) {
	echo "<tr>";
	echo "<td width=22% colspan=14 align=left>.</td>";
	echo "</tr>";
}
echo "<tr>";
echo "<td width=40% colspan=4  align=center  style='font-size: 11pt; font-family:Arial'>HSN/SAC</td>";
echo "<td width=20% colspan=2  align=center style='font-size: 11pt; font-family:Arial'>Taxable Value</td>";
echo "<td width=20% colspan=8  align=center style='font-size: 11pt; font-family:Arial'>IGST</td>";

echo "</tr>";
$Gst = $xGrandCgst + $xGrandSgst;
$xRupeeString1 = ucwords ( convert_number_to_words ( ceil ( $Gst ) ) );
$xGrandAmount=$xGrandAmount-$xGrandDisc;
echo "<tr>";
echo "<td width=40% colspan=4  align=center style='font-size: 11pt; font-family:Arial'>$xHsnCode</td>";
echo "<td width=20% colspan=2  align=center style='font-size: 11pt; font-family:Arial'>$xGrandAmount</td>";
echo "<td width=10% colspan=4  align=center style='font-size: 11pt; font-family:Arial'>12%</td>";
echo "<td width=10% colspan=4  align=center style='font-size: 11pt; font-family:Arial'>$Gst</td>";

echo "</tr>";

echo "<tr >";
echo "<td width=22% colspan=14  style='font-size: 11pt; font-family:Arial'>Tax Amount in Words $xRupeeString1 Only</td>";
echo "</tr>";

echo "<tr style='border-right:none;border-left:none;border-bottom:none;border-top:none' colspan=3 style='font-weight: bold; font-size: 11pt; font-family:Arial'>";
echo "<td width=25%   colspan=3 style=' font-weight: bold; font-size: 11pt; font-family:Arial'><b>Name</td>";
echo "<td width=25% 
	' align=center  colspan=4 style='font-weight: bold; font-size: 11pt; font-family:Arial'>SRI SURIYA TRADERS</td>";
echo "<td width=25%   colspan=3 style='font-weight: bold; font-size: 11pt; font-family:Arial'>Account No</td>";
echo "<td width=25% align=center  colspan=4 style='font-weight: bold; font-size: 11pt; font-family:Arial'>175700050900119</td>";
echo "</tr>";

echo "<tr  style='border-right:none;border-left:none;border-bottom:none;border-top:none' colspan=3 style='font-weight: bold; font-size: 11pt; font-family:Arial'>";
echo "<td width=25%   colspan=3 style='font-weight: bold; font-size: 11pt; font-family:Arial'>Bank Name</td>";
echo "<td width=25%
	' align=center  colspan=4 style='font-weight: bold; font-size: 11pt; font-family:Arial'>Tamilnadu Mercandile Bank</td>";
echo "<td width=25%   colspan=3 style='font-weight: bold; font-size: 11pt; font-family:Arial'>IFSC No</td>";
echo "<td width=25% align=center  colspan=4 style='font-weight: bold; font-size: 11pt; font-family:Arial'>TMBL0000175</td>";
echo "</tr>";

echo "<tr style='border-right:none;border-left:none;border-top:none' colspan=3 style='font-weight: bold; font-size: 11pt; font-family:Arial'>";
echo "<td width=25% colspan=3 style='font-weight: bold; font-size: 11pt; font-family:Arial'>A/c Type </td>";
echo "<td width=25% colspan=4 align=center style='font-weight: bold; font-size: 11pt; font-family:Arial'>OD </td>";
echo "<td width=25%   colspan=3 style='font-weight: bold; font-size: 11pt; font-family:Arial'>Branch</td>";
echo "<td width=25% align=center  colspan=4 style='font-weight: bold; font-size: 11pt; font-family:Arial'>Pasuvandanai Road, Kovilpatti</td>";
echo "</tr>";
echo "<tr>";
echo "<td colspan=5><font size=1>
		* Subject to Kovilpatti Jurisdiction Only.		</br>
* Goods once sold can't taken back		</br>
* Our responsibility ceases after goods leave our godown.		</br>
* Interest @12% Will be charged from the due date.		</br>
		
	E.& O.E.	
		</font>
		</td>";

echo "<td colspan=3 align=center><font size=1 ></br>Prepared By</br>
</br><hr>Checked By </br></td></font>";

echo "<td colspan=6 align=center><font size=1></br>For SRI SURIYA TRADERS		
		</br></br></br>
	
		 </br>Partner / Authorised Signatory		
		 </br></br></br></td></font>";

echo "</tr>";

echo "</table>";
?>
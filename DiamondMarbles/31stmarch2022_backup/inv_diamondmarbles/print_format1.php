<?php
include ('globalfile.php');
$GLOBALS ['xCurrentDate'] = date ( 'Y-m-d' );
fn_GetCompanyInfo ( 1 );
$xLessAmount = 0;
$xSalesInvoiceNo = $_GET ['salesinvoiceno'];
$xQry = "SELECT * from inv_salesentry1 where salesinvoiceno=$xSalesInvoiceNo";
$result = mysql_query ( $xQry );
while ( $row = mysql_fetch_array ( $result ) ) { 
findcustomername ( $row ['customerno'] );
}
?>
<html>
<title>SALES BILL</title>
<head>
<link href="bootstrap.css" rel="stylesheet">
<script type="text/javascript"> 
window.onload=PrintDiv;     

</script>

<body>
	<input type="submit" value="print" onclick="PrintDiv();" />
	<div id="divToPrint">
				<?php
				echo "<table border=0 width=40%>"; // start a table tag in the HTML
				echo "<tr><td></td><td></td><td></td><td></td>";
				echo "<tr><td align=center > " . $GLOBALS ['xCompanyTitle'] . " </td></tr>";
				echo "<tr><td align=center > " . $GLOBALS ['xCompanyAddress1'] . " </td></tr>";
				echo "<tr><td align=center > " . $GLOBALS ['xCompanyAddress2'] . " </td></tr>";
				echo "<tr><td align=center > GSTIN No" . $GLOBALS ['xCompanyGSTINNo'] . " </td></tr>";
				echo "</table>";
				echo "<hr width=40% >";
				?>

<?php
$xSlNo = 0;
$xTotalAmount = 0;
$xSalesInvoiceNo = $_GET ['salesinvoiceno'];
$xQry = "SELECT * from inv_salesentry where salesinvoiceno=$xSalesInvoiceNo";
//echo $xQry;
$result = mysql_query ( $xQry );
echo "<table border=0 width=40%>"; // start a table tag in the HTML
echo "<tr><td></td><td></td><td></td><td></td><td></td>";
while ( $row = mysql_fetch_array ( $result ) ) { // Creates a loop to loop through results
	if ($xSlNo < 1) {
		//findcustomername ( $row ['customerno'] );
		
		echo "<tr><td align=left > Name </td><td align=left >" . $GLOBALS ['xCustomerName'] . "</td><td align=left > DATE </td><td align=left >" . date ( 'd/m/y', strtotime ( $row ['date'] ) ) . "</td></tr>";
		echo "<tr><td align=left> BILL </td><td align=left >" . $row ['salesinvoiceno'] . "</td></tr>";
		echo "</table>";
		echo "<hr width=40% >";

		echo "<table width=40%>";
		echo "<tr><td> No </td><td align=left> Particulars </td><td>Qty </td><td>Amount</td></tr>";
		echo "</table>";
		echo "<hr width=40% >";
		
		echo "<table width=40%>";
	}
	$xSlNo += 1;
	finditemname ( $row ['itemno'] );
	finditempricevat ( $row ['itemno'], $row ['batchid'] );
	echo "<tr> 
				<td align=left>" . $xSlNo . "</td>
				 <td align=left> " . $GLOBALS ['xItemName'] . " </td>
				 <td align=left >" . $row ['qty'] . "</td>
						 <td align=left >" . $row ['batchid'] . "</td>
		<td align=left >" . $row ['dateexpired'] . "</td>
				 <td align=right colspan=2>" . $row ['amount'] . "</td>
		 </tr>";
	$xTotalAmount += $row ['amount'];
}
$xQry = "SELECT * from inv_salesentry1 where salesinvoiceno=$xSalesInvoiceNo";
$result = mysql_query ( $xQry );
while ( $row = mysql_fetch_array ( $result ) ) { // Creates a loop to loop through results
	$xLessAmount = $row ['lessamount'];
}
if($xLessAmount>0)
{
	echo "<tr><td align=left colspan=3>LESS AMOUNT </td><td align=right>" .  $xLessAmount . "</td></tr>";
	$xTotalAmount=$xTotalAmount-$xLessAmount;
}
echo "</table>";
echo "<hr width=40% >";
echo "</br>";
echo "</br>";
echo "<table width=40%>";
$xCgst=$xTotalAmount*0.09;
$xSgst=$xTotalAmount*0.09;
$xRoundOff=0.00;
echo "<tr><td></td><td align=right colspan=2>CGST 9%  </td><td align=right>".$xCgst."</tr>";
echo "<tr><td></td><td align=right colspan=2>SGST 9%  </td><td align=right>".$xSgst."</tr>";
echo "<tr><td></td><td align=right colspan=2>ROUNDOFF  </td><td align=right>".$xRoundOff."</tr>";

echo "</table>";
echo "<hr width=40% >";

echo "<table width=40%>";
echo "<tr><td align=left colspan=3>TOTAL RS </td><td align=right>" . fn_RupeeFormat ( round($xTotalAmount+$xCgst+$xSgst+$xRoundOff)) . "</td></tr>";

echo "<tr><td align=left colspan=4>" . ucwords ( convert_number_to_words ( $xTotalAmount+$xCgst+$xSgst+$xRoundOff  ) ) . " Rupees Only</td></tr>";
echo "<tr><td align=right colspan=4>Authorized Signature</td></tr>";
echo "</table>"; // Close the table in HTML

mysql_close (); // Make sure to close out the database connection

?>

	</div>
</body>
</html>


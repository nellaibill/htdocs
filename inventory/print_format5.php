
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
  tr.hide_right > td, td.hide_right{
        border-right-style:hidden;
      }
       tr.hide_top > td, td.hide_top{
        border-top-style:hidden;
      }
      tr.hide_all > td, td.hide_all{
        border-style:hidden;
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
	echo "<p align=left>GSTIN No : " . $GLOBALS ['xCompanyGSTINNo'] . "</p>";
echo "<table border=0 width=100% style=border-collapse:collapse;>";


echo "<tr>";
echo "<td width=100%><center style='font-size: 24pt; font-family:Arial'>" . $GLOBALS ['xCompanyTitle'] . "</center></td>";
echo "</tr>";
echo "<tr>";
echo "<td align=center  width=100%>		
<b>	" . $GLOBALS ['xCompanyAddress1'] . " </b>	</br>			
" . $GLOBALS ['xCompanyAddress2'] . "	</br>				
" . $GLOBALS ['xCompanyAddress3'] . " " . $GLOBALS ['xCompanyContactNo'] . "
";
echo "</td>";

echo "</tr></b>";
echo "</table>";

echo "<table border=1 width=100%>
<tr>
<tr><td width=25%>Consignee</td><td width=25%></td><td width=25%>Invoice No</td><td width=25%>" . $xSalesInvoiceNo . "</td></tr>
<tr><td width=25%>" . $GLOBALS ['xCustomerName'] . "</td><td width=25%></td><td width=25%>Date</td><td width=25%>" . date('d/m/Y', strtotime($xBillDate))  . "</td></tr>
<tr><td width=25%>" . $GLOBALS ['xCustomerAddress'] . "</td><td width=25%></td><td width=25%>Place of Supply</td><td width=25%></td></tr>
<tr><td width=25%></td><td width=25%></td><td width=25%>LR/RR No</td><td width=25%></td></tr>
<tr><td width=25%>GSTIN No</td><td width=25%>" . $GLOBALS ['xCustomerGSTINNo'] . "</td><td width=25%>Transport </td><td width=25%>".$xDespatch."</td></tr>
<tr><td width=25%>CellNo</td><td width=25%>" . $GLOBALS ['xCustomerMobileNo'] . "</td><td width=25%>Vehicle No</td><td width=25%>".$xVehicleNo."</td></tr>
</table>";
echo "<table border=1 width=100%>
<tr><td width=10%>S.NO</td>
		<td width=40%>Description of Goods</td>
			<td width=10%>HSNCODE</td>
		<td width=10%>Qty in Bundles</td>
		<td width=15%>Rate per Bundles</td>
		<td width=15%>Amount</td>
		</tr>
</table>";

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
	$xCount=1;
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

	echo "<table border=1 width=100% >
	<tr >
		
		<td width=10% height=50px> " . $xSlNo . " </td>
		<td width=40%>" . $GLOBALS ['xItemName'] . "</td>
         <td width=10%>" . $GLOBALS ['xHSNCode'] . "</td>
		<td width=10%>" . $row ['qty'] . "</td>
		<td width=15%>" . $row ['unitrate'] . "</td>
		<td width=15%>" . $xAmount . " </td>
		
		</tr>";	

	$xCount+=1;
}
for($i=$xCount;$xCount<=9;$xCount++)
{
echo "<tr class=hide_top>
<td width=10% height=50px> </td>
<td width=40%></td>
<td width=10%></td>
<td width=10%></td>
<td width=15%></td>
<td width=15%> </td></tr>";
				
}
echo "</table>";
		echo "<table border=1 width=100%>
<tr><td width=100% colspan=5>FB</td></tr>
<tr><td width=50%><td width=10%>TOTAL</td><td width=10%></td><td width=10%></td><td width=15%></td><td width=15%></td></tr>
</table>
		

<table border=1 width=100%>
<tr><td colspan=2 width=100%>Rupees in Words</td></tr>
		<tr><td width=60%></td><td width=40%>CGST</td></tr>
				<tr><td width=60%></td><td width=40%>SGST</td></tr>
				<tr><td width=60%></td><td width=40%>GRAND TOTAL</td></tr>

</table>

		";

		




echo  "<table border=1 width=100% cellspacing=0 cellpadding=0>
    <tbody>
        <tr>
            <td width=30% valign=top>
                <p>
                    Terms and conditions
                </p>
                <p>
                    1. Goods once sold will not be taken back.
                </p>
                <p>
                    2. Interest @18% p.a will be charged if payment is not made
                    with in the stipulated time.
                </p>
                <p>
                    3. Subjected to KOVILPATTI jurisdiction only.
                </p>
            </td>
            <td width=40% valign=top>
                <p>
                    Our Bank Details all KOVILPATTI Branches
                </p>
                <p>
                    BANK OF BARODA : 298 40 20 00 00 114
                </p>
                <p>
                    IFS CODE : BARB 0 KOVILP
                </p>
                <p>
                    STATE BANK OF INDIA : 11017710524
                </p>
                <p>
                    IFS CODE : SBIN 0000 859
                </p>
            </td>
            <td width=30% valign=top>
                <p>
                    For Sarraf Sales Corporation
                </p><br><br><br><br>
                <p>
                    PROP/MANAGER
                </p>
            </td>
        </tr>
    </tbody>
</table>";
?>
	</div>
</body>
</html>

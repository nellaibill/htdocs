
<?php
include ('globalfunctions.php');
$GLOBALS ['xCurrentDate'] = date('Y-m-d');
$xLessAmount = 0;
fn_GetCompanyInfo(1);
getconfig_print();
$xSalesInvoiceNo = $_GET ['salesinvoiceno'];
$xImageFileName = "d:/softwarebackup/images/" . $GLOBALS ['xPrintSrc'];
//echo $xImageFileName;
$xQry = "SELECT * from inv_salesentry1 where salesinvoiceno=$xSalesInvoiceNo";
$result = mysql_query($xQry);
while ($row = mysql_fetch_array($result)) { // Creates a loop to loop through results
    findcustomername($row ['customerno']);
    $xBillDate = $row ['date'];
    $xDespatch = $row ['despatch'];
    $xVehicleNo = $row ['vehicleno'];
    $xDestination = $row ['destination'];
}
?>
<html>
    <title>SALES BILL</title>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <link href="bootstrap.css" rel="stylesheet">

        <style type="text/css">
            .alignleft {
                float: left;
            }
            .alignright {
                float: right;
            }
            .aligncenter{
                text-align:center;
            }

            table {
                border-collapse: collapse;
                font-size: 14px;
            }

            .sales_footer{font-size:30px;}


            hr{
                padding: 0px;
                margin: 0px;    
            }
        </style>

    </head>

    <body onload="window.print(); setTimeout(window.close, 0);">    

        <div id="divToPrint">

            <?php
            echo "<table border=1 width=100% >";
            echo "<tr>
		
				<td  align=left width=15% >
		<img src=images/dosslogo.png
		width=100px height=70px> </td>
		<td style='font-size: 14pt; font-family:Arial' align=center > " . $GLOBALS ['xCompanyTitle'] . " </br>" . $GLOBALS ['xCompanyAddress1'] . " </br>" . $GLOBALS ['xCompanyAddress2'] . " </br>" . $GLOBALS ['xCompanyAddress3'] . "</td>
</tr>";
            echo "</table>";
            echo "<table border=1 width=100% >";
            echo "<tr>
		<td  align=left width=50% >Invoice No : ".$xSalesInvoiceNo."</td>
		<td  align=left width=50% >Transport Mode ".$xDespatch."</td>
                </tr>
                <tr>
		
                <td  align=left width=50% >Invoice Date ".$xBillDate."</td>
                <td  align=left width=50% >Vehicle No ".$xVehicleNo."</td>
		
                </tr>
                <tr>
                <td  align=left width=50% >Reverse Charge</td>
                <td  align=left width=50% >Date Of Supply ".$xSalesInvoiceNo."</td>
                </tr>
                <tr>
		<td  align=left width=50% >State:TamilNadu</td>
		<td  align=left width=50% >Place Of Supply ".$xDestination."</td>
                </tr>
                <tr>
		<td  align=center width=50% >BILL TO PARTY</td>
		<td  align=center width=50% >SHIP TO PARTY</td>
                </tr>
                <tr>
		<td  align=left width=50% >Name :" . $GLOBALS ['xCustomerName'] . "</td>
		<td  align=left width=50% >Name :" . $GLOBALS ['xCustomerName'] . "</td>
                </tr>
                
                <tr>
		<td  align=left width=50% >Address :" . $GLOBALS ['xCustomerAddress'] . "</td>
		<td  align=left width=50% >Address :" . $GLOBALS ['xCustomerAddress'] . "</td>
                </tr>
                <tr>
		<td  align=left width=50% >GSTIN :" . $GLOBALS ['xCustomerGSTINNo'] . "</td>
		<td  align=left width=50% >GSTIN :" . $GLOBALS ['xCustomerGSTINNo'] . "</td>
                </tr>
                <tr>
		<td  align=left width=50% >State  : TamilNadu</td>
		<td  align=left width=50% >State  : TamilNadu</td>
          
                </tr>";
            echo "</table>";
            echo "<table border=1 width=100% height=350px> ";

            echo "<tr > 
                        <td align=left width=10%> S.No </td>
			<td align=left  width=20%> Product Name  </td>
			<td align=left width=10%> HSN Code  </td>
                        <td align=left width=10% > UOM </td>
			<td align=left width=10% > Qty </td>
			<td align=left width=10% > Rate </td>
			<td align=left width=10%>Amount </td>
                        <td align=left width=10%>Taxable Value </td>
			<td align=left width=10%> Total  </td>
			<td colspan=2 align=center  width=5%>SGST</td>
                        <td colspan=2  align=center width=5%>CGST</td>
                        <td align=left width=10%>Total </td>
		</tr>";

            $xSlNo = 0;
            $xCount = 1;
            $xTotalAmount = 0;
            $xSalesInvoiceNo = $_GET ['salesinvoiceno'];
            $xTotalUnitAmount = 0;
            $xGrandNetAmount = 0;
            $xGrandCgst = 0;
            $xGrandSgst = 0;
            $xQry = "SELECT * from inv_salesentry where salesinvoiceno=$xSalesInvoiceNo";
            $result = mysql_query($xQry);

            while ($row = mysql_fetch_array($result)) { // Creates a loop to loop through results
                $xSlNo += 1;
                finditemname($row ['itemno']);
                finditempricevat($row ['itemno'], $row ['batchid']);
                $xGst = $row ['vat'] / 2;
                $xQty = $row ['qty'];
                $xUnitRate = $row ['unitrate'];
                $xUnitAmount = $xQty * $xUnitRate;

                $xAmount = $row ['amount'];
                /* 					$xDiscountPercentage = $row ['discountpercentage'];
                  $xDiscountValue = $xAmount * ($xDiscountPercentage / 100);
                  $xAmountMinusDiscValue = $xAmount - $xDiscountValue; */

                $Cgst = round($xUnitAmount * ($xGst / 100), 2);
                $xGrandCgst += $Cgst;
                $Sgst = round($xUnitAmount * ($xGst / 100), 2);
                $xGrandSgst += $Sgst;
                $xNetAmount = $xUnitAmount + $Cgst + $Sgst;

                $xGrandNetAmount += $xNetAmount;

                echo "<tr class=hide_bottom> 
						
<td align=left width=10%>".$xSlNo."</td>
			<td align=left  width=20%>  " . $GLOBALS ['xItemName'] . "  </td>
			<td align=left width=10%>" . $GLOBALS ['xHSNCode'] . "  </td>
                        <td align=left width=10% > ".$GLOBALS ['xPackDescription']." </td>
			<td align=left width=10% > " . $row ['qty'] . " </td>
			<td align=left width=10% >  " . $row ['unitmrp'] . " </td>
			<td align=left width=10%>" . $xUnitAmount . " </td>
                        <td align=left width=10%>" . $xUnitAmount . "</td>
			<td align=left width=10%> " . $row ['unitmrp'] . "  </td>
			<td colspan=2 align=center  width=5%>".$Cgst."</td>
                        <td colspan=2  align=center width=5%>".$Sgst."</td>
                        <td align=left width=10%>" . $row ['unitmrp'] . " </td>
			
		 </tr>";


                $xTotalAmount += $row ['amount'];
                $xTotalUnitAmount += $xUnitAmount;
                $xCount += 1;
            }
            for ($i = $xCount; $xCount <= 9; $xCount ++) {
                echo "<tr class=hide_top>
			<td align=left width=10%> </td>
			<td align=left  width=20%>  </td>
			<td align=left width=10%>  </td>
                        <td align=left width=10% >  </td>
			<td align=left width=10% >  </td>
			<td align=left width=10% >  </td>
			<td align=left width=10%> </td>
                        <td align=left width=10%>  </td>
			<td align=left width=10%>   </td>
			<td colspan=2 align=center  width=5%></td>
                        <td colspan=2  align=center width=5%></td>
                        <td align=left width=10%> </td>	
                        	
		 </tr>";
            }
            $xQry = "SELECT * from inv_salesentry1 where salesinvoiceno=$xSalesInvoiceNo";
            $result = mysql_query($xQry);
            while ($row = mysql_fetch_array($result)) { // Creates a loop to loop through results
                $xLessAmount = $row ['lessamount'];
            }
            if ($xLessAmount > 0) {
                echo "<tr><td align=left colspan=3>LESS AMOUNT </td><td align=right>" . $xLessAmount . "</td></tr>";
                $xTotalAmount = $xTotalAmount - $xLessAmount;
            }
            echo "<tr class=hide_top>
			<td align=left colspan=4 width=10%>TOTAL </td>
			
			<td align=left width=10% >  </td>
			<td align=left width=10% >  </td>
			<td align=left width=10%> </td>
                        <td align=left width=10%>  </td>
			<td align=left width=10%>   </td>
			<td colspan=2 align=center  width=5%></td>
                        <td colspan=2  align=center width=5%></td>
                        <td align=left width=10%> </td>	
                        	
		 </tr>";




            echo "</table>";
            echo "<table border=1 width=100% >";
            echo "<tr>
		<td width=40% >Bank Details </td>
		<td width=20% ></td>
                <td width=40% ></td>
</tr>";
            echo "</table>";

            mysql_close(); // Make sure to close out the database connection
            ?>

        </div>
        <table border="1" width=100%>
<tr><td align ="center" width =40%> Bank Details </td>
<td cellpadding=100 rowspan=5 align = center width=20% ></td><td> Gst On reverse charge </td></tr>
<tr><td> City Union Bank </td><td></td></tr>
<tr><td> Bank A/c No :515616114514  </td> <td rowspan=5></td></tr>
<tr><td> IFSC Code : CUB155661</td></tr>
<tr><td> Branch: TVL</td></tr>
<tr><td  rowspan=3> Terms and conditions : PAYMENT : 30 days from supply date 
Goods once sold will not be taken back Interest 
@ 24% will be charged if the payment is not made in the stipulated Date</td></tr>
<tr><td> Common Seal</td></tr>
</table>
    </body>
</html>


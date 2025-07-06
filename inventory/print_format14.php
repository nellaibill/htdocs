
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
		<img src=images/tigerlogo.jpg
		width=100px height=70px> </td>
		<td style='font-size: 14pt; font-family:Arial' align=center > " . $GLOBALS ['xCompanyTitle'] . " </br>" . $GLOBALS ['xCompanyAddress1'] . " </br>" . $GLOBALS ['xCompanyAddress2'] . " </br>" . $GLOBALS ['xCompanyAddress3'] . "</td>
</tr>";
            echo "</table>";
            echo "<table border=1 width=100% >";
            echo "
                <tr>
		<td  align=center width=50% >BILL TO PARTY</td>
		<td  align=right width=50% >Original for the Recipient</td>
                </tr>
                <tr>
		<td  align=left width=50% >Name :" . $GLOBALS ['xCustomerName'] . "</td>
		<td  align=right width=50% >Place Of Supply -Tamil Nadu :" . $GLOBALS ['xCustomerName'] . "</td>
                </tr>
                
                <tr>
		<td  align=left width=50% >Address :" . $GLOBALS ['xCustomerAddress'] . "</td>
		<td  align=left width=50% >Invoice No :" .$xSalesInvoiceNo . "</td>
                </tr>
                <tr>
		<td  align=left width=50% >GSTIN :" . $GLOBALS ['xCustomerGSTINNo'] . "</td>
		<td  align=left width=50% >Invoice Date :" . $xBillDate . "</td>
                </tr>
                <tr>
		<td  align=left width=50% >State  : TamilNadu</td>
		<td  align=left width=50% ></td>
          
                </tr>";
            echo "</table>";
 echo "<table border=1 width=100%  height=350px>";

            echo "<tr >
				<td align=left width=5% height = 50px align=left> SL  </td>

						<td align=left width=55%> Item Description  </td>
						<td align=left width=10%> HSN Code  </td>
						<td align=right width=5% > Qty </td>
						<td align=right width=5% > Units </td>
						<td align=right width=5%>Rate </td>
                                                <td align=right width=5%>Item Value </td>
                         
						<td align=right width=5%>GST%  </td>
                                                <td align=right width=5%>Taxable Value  </td>
						<td align=right width=5%> Total  </td>
				
						</tr>";

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
$xGstValue=0;
            $xQry = "SELECT * from inv_salesentry where salesinvoiceno=$xSalesInvoiceNo";
            $result = mysql_query($xQry);

            while ($row = mysql_fetch_array($result)) { // Creates a loop to loop through results
                $xSlNo += 1;
                finditemname($row ['itemno']);
                finditempricevat($row ['itemno'], $row ['batchid']);
                $xGst = $row ['vat'];
                $xQty = $row ['qty'];
                $xUnitMrp = $row ['unitmrp'];
                $xUnitRate = $row ['unitrate'];
                $xTotalBeforeDiscount = $xQty * $xUnitMrp;
                $xItemValue=$xQty * $xUnitRate;
                $xTaxableValue=$xQty * $xUnitRate;
                $xDiscountPercentage = $row ['discountpercentage'];
                $xDiscountValue = round(($xTotalBeforeDiscount * ($xDiscountPercentage / 100)), 2);
                $xTotalAfterDiscount = $xTotalBeforeDiscount - $xDiscountValue;
                $xGst = $row ['vat'];
                $xGstValue+= (round($xTotalAfterDiscount * ($xGst / 100), 2));
                $xAmount = (round($xTotalAfterDiscount , 2));
                $xTotalAmount += $xAmount;
                $xGrandQty += $xQty;

                $Cgst =  ($xAmount) * ($xGst / 100);
                $xGrandCgst += $Cgst;
                $Sgst =  ($xAmount) * ($xGst / 100);
                $xGrandSgst += $Sgst;
                echo "<tr class=hide_all style='font-size: 8pt;'> 
						<td height = 40px align=left > " . $xSlNo . "  </td>
						<td align=left> "  . $GLOBALS ['xItemName'] . " </td>
						<td align=left> "  . $GLOBALS ['xHSNCode'] . "   </td>
						<td align=right>"  . $xQty  . " </td>
						<td align=right>"  . $GLOBALS ['xPackDescription'] . " </td>
						<td align=right>"  . $xUnitRate . "</td>
                                                    <td align=right>"  . $xItemValue . "</td>
						<td align=right>"  . $xGst . " </td>
                                                       <td align=right>"  . $xTaxableValue . "</td>
						<td align=right>"  . $xAmount . "  </td>
 </tr>";
                $xCount += 1;

                // $xTotalAmount += $row ['amount'];


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
            for ($i = $xCount; $xCount <= 10; $xCount ++) {
                echo "<tr class=hide_bottom>
				
				 <td align=left>  </td>
				 <td align=left>  </td>
						<td align=left> </td>
						<td align=left> </td>
						<td align=left>  </td>
						<td align=left> </td>
                                                		<td align=left> </td>
                                                <td align=left> </td>
						<td align=left> </td>
						<td align=left>  </td>
	
				
		 </tr>";
            }

            echo "</table>";
            $xRoundOffTotal = (round($xTotalAmount, 2));
            $xRoundOffGst = (round($xGstValue, 2));
            $xBeforeRoundOffNetTotal = $xRoundOffTotal + $xRoundOffGst;
            $xAfterRoundOffNetTotal = (round($xBeforeRoundOffNetTotal, 0));
            $xRoundOff = (round($xAfterRoundOffNetTotal - $xBeforeRoundOffNetTotal, 2));
            $xcgst = $xRoundOffGst / 2;
            $xsgst = $xRoundOffGst / 2;
            /*
             * echo "<table width=100%>";
             * echo "<tr><td align=center width=60% colspan=6> </td><td align=left> Service Charges " . $xServiceCharges . " </td></tr>";
             * echo "</table>";
             */


            echo "<table width=100% border=1>";
            echo "<tr><td align=center  width=60% colspan=6> GST SUMMARY</td><td align=left> </td><td colspan=4></td></tr>";

            echo "<tr><td align=center  width=10% colspan=2></td><td width=10%> 2.5% </td><td width=10%> 6% </td><td width=10%> 9% </td><td width=10%> 14% </td><td width=20% align=right> Gross Amount </td><td width=20% align=right> " . fn_RupeeFormat($xRoundOffTotal) . " </td></tr>";
            echo "<tr><td align=center  width=10% colspan=2>CGST</td><td width=10%> " . round($xFivePercentage, 2) . "  </td><td width=10%> " . round($xTwelvePercentage, 2) . " </td><td width=10%> " . round($xEighteenPercentage, 2) . " </td><td width=10%> " . round($xTwentyEightPercentage, 2) . " </td><td width=20% align=right> Taxable Value </td><td width=20% align=right> " . fn_RupeeFormat($xRoundOffTotal) . " </td></tr>";
            echo "<tr><td align=center  width=10% colspan=2>SGST</td><td width=10%> " . round($xFivePercentage, 2) . "  </td><td width=10%> " . round($xTwelvePercentage, 2) . "</td><td width=10%>" . round($xEighteenPercentage, 2) . " </td><td width=10%> " . round($xTwentyEightPercentage, 2) . " </td><td width=20% align=right> Total CGST </td><td width=20% align=right> " . $xGstValue/2  . " </td></tr>";
            echo "<tr><td align=center  width=60% colspan=6></td><td width=20% align=right> Total SGST</td><td width=20% align=right> ". $xGstValue/2 . " </td></tr>";
            echo "<tr><td align=center  width=60% colspan=6>" . ucwords(convert_number_to_words($xAfterRoundOffNetTotal)) . " Rupees Only </td><td width=20% align=right> NetAmount </td><td width=20% align=right> " . number_format($xAfterRoundOffNetTotal, 2) . " </td></tr>";

            echo "</table>";

            echo "<hr>";
            echo "<table  border=0 width=100% height=100px>";
            echo "<tr><td align=left width=50%>Terms and condition</td>
						<td align=right width=50%><font color=blue>For " . $GLOBALS ['xCompanyTitle'] . "</font></td>
						</tr>
						<tr><td align=left width=50%>Subject to Tirunelveli Jurisdication </br>E.& O.E..</td>
						<td align=right width=50%>Authorized Signatory</td>
						</tr>
							</tr>";

            echo "</table>";

            mysql_close(); // Make sure to close out the database connection
            ?>

        </div>
    </body>
</html>


<?php
include ('globalfunctions.php');
$GLOBALS ['xCurrentDate'] = date('Y-m-d');
$xLessAmount = 0;
fn_GetCompanyInfo(1);
$xSalesInvoiceNo = $_GET ['salesinvoiceno'];
$xQry = "SELECT * from inv_salesentry1 where salesinvoiceno=$xSalesInvoiceNo";
$result = mysql_query($xQry);
while ($row = mysql_fetch_array($result)) { // Creates a loop to loop through results
    findcustomername($row ['customerno']);
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
    <link href="bootstrap.css" rel="stylesheet">
    <style type="text/css">
        table {
            border-collapse: collapse;
            font-size: 14px;
        }

        .sales_footer{font-size:30px;}


        hr{
            padding: 0px;
            margin: 0px;    
        }
          tr.hide_right > td, td.hide_right{
        border-right-style:hidden;
      }
       tr.hide_top > td, td.hide_top{
        border-top-style:hidden;
      }
             tr.hide_bottom > td, td.hide_bottom{
        border-bottom-style:hidden;
      }
      tr.hide_all > td, td.hide_all{
        border-style:hidden;
      }
    </style>
    <body onload="window.print(); setTimeout(window.close, 0);">
        <div id="divToPrint">
            <?php
                      echo "<table  width=100% >";
            echo "<tr>
		<td align=right>TAX INVOICE</td>
		<td align=right>ORIGINAL</td>
</tr>";
            echo "</table>";
            echo "<hr>";
           echo "<table border=1 width=100% >";
            echo "<tr>
		

		<td style='font-size: 14pt; font-family:Arial' align=center > " . $GLOBALS ['xCompanyTitle'] . " </br>" . $GLOBALS ['xCompanyAddress1'] . " </br>" . $GLOBALS ['xCompanyAddress2'] . " </br>" . $GLOBALS ['xCompanyAddress3'] . "</br> " . "GSTIN  : " . $GLOBALS ['xCompanyGSTINNo'] . "</td>
</tr>";
            echo "</table>";

            echo "<table border=1  width=100% > ";

            echo "<tr class=hide_bottom>
						<td width=50% align=left >Buyer : " . $GLOBALS ['xCustomerName'] . " </td>
						<td align=left width=12.5%> Bill No</td>
						<td width=12.5%>" . $xSalesInvoiceNo . " </td>
						<td align=left width=12.5% > Date </td>
						<td width=12.5%>" . date('d/m/Y', strtotime($xBillDate)) . " </td>
				</tr>";
            echo "<tr class=hide_bottom>
						<td width=50% align=left > " . $GLOBALS ['xCustomerAddress'] . " </td>
						<td align=left > Inv Type </td>
						<td>" . $xModeofPayment . "</td>
						<td align=left > Despach </td>
						<td>" . $xDespatch . "</td>
						
						</tr>";
            echo "<tr><td width=50% align=left > Mob No : " . $GLOBALS ['xCustomerMobileNo'] . " </td>

					<td align=left> Vehicle No </td>
					<td>" . $xVehicleNo . "</td>
					<td align=left> Destination </td>
					<td>" . $xDestination . "</td>
					</tr>";
            echo "<tr>
					<td width=50% align=left >  GSTIN No" . $GLOBALS ['xCustomerGSTINNo'] . " </td>
					<td></td><td></td><td></td><td></td>
					</tr>";
            echo "</table>";
            echo "<table border=1 width=100%  height=80px>";

            echo "<tr >
				<td align=left width=5% height = 40px align=left> SL  </td>

						<td align=left width=55%> Particulars  </td>
						<td align=left width=10%> HSN Code  </td>
						<td align=right width=5% > Pieces </td>
						<td align=right width=5%>Rate </td>
                                                <td align=right width=5%>GST% </td>
						<td align=right width=5%>GST(Value)  </td>
						<td align=right width=5%> Total  </td>
				
						</tr>";

            $xSlNo = 0;
            $xCount = 0;
            $xTotalAmount = 0;
            $xSalesInvoiceNo = $_GET ['salesinvoiceno'];

            $xGrandpieces = 0;
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
                $xpieces = $row ['pieces'];
                $xUnitMrp = $row ['unitmrp'];
                $xUnitRate = $row ['unitrate'];
                $xTotalBeforeDiscount = $xpieces * $xUnitRate;
				$xRowRate= $xpieces * $xUnitMrp;
                $xDiscountPercentage = $row ['discountpercentage'];
                $xDiscountValue = round(($xTotalBeforeDiscount * ($xDiscountPercentage / 100)), 2);
                $xTotalAfterDiscount = $xTotalBeforeDiscount - $xDiscountValue;
                $xGst = $row ['vat'];
                $xGstValue+= (round($xTotalAfterDiscount * ($xGst / 100), 2));
                $xAmount = (round($xTotalAfterDiscount , 2));
                $xTotalAmount += $xAmount;
                $xGrandpieces += $xpieces;

                $Cgst =  (round(($xAmount) * ($xGst / 100),2));
                $xGrandCgst += $Cgst;
                $Sgst =  ($xAmount) * ($xGst / 100);
                $xGrandSgst += $Sgst;
                echo "<tr class=hide_bottom style='font-size: 10pt;'> 
						<td height = 10px align=left > " . $xSlNo . "  </td>
						<td align=left> "  . $GLOBALS ['xItemName'] . " " . $row ['usagestockdetails'] . "</td>
						<td align=left> "  . $GLOBALS ['xHSNCode'] . "   </td>
						<td align=right>"  . $xpieces  . " </td>
						<td align=right>"  . $xUnitRate . "</td>
                        <td align=right>"  . $xGst . " </td>
						<td align=right>"  . $Cgst . " </td>
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
			            $xRoundOffTotal = (round($xTotalAmount, 2));
            $xRoundOffGst = (round($xGstValue, 2));
            $xBeforeRoundOffNetTotal = $xRoundOffTotal + $xRoundOffGst;
            $xAfterRoundOffNetTotal = (round($xBeforeRoundOffNetTotal, 0));
            $xRoundOff = (round($xAfterRoundOffNetTotal - $xBeforeRoundOffNetTotal, 2));
            $xcgst = $xRoundOffGst / 2;
            $xsgst = $xRoundOffGst / 2;
			$xSingleGst=$Cgst/2;
			 echo "<tr class=hide_bottom style='font-size: 12pt;'> 
						<td height = 10px align=left >  </td>
						<td align=right> </td>
						<td> </td>
						<td> </td>
						<td> </td>
						<td> </td>
						<td> </td>
						<td align=right></td>

 </tr>";
 			 echo "<tr class=hide_bottom style='font-size: 12pt;'> 
						<td height = 10px align=left >  </td>
						<td align=right> </td>
						<td> </td>
						<td> </td>
						<td> </td>
						<td> </td>
						<td> </td>
						<td align=right></td>

 </tr>";
 echo "<tr class=hide_bottom style='font-size: 10pt;'> 
						<td height = 10px align=left >  </td>
						<td align=right> CGST(2.5%)</td>
						<td> </td>
						<td> </td>
						<td> </td>
						<td> </td>
						<td> </td>
						<td align=right>".$xSingleGst." </td>

 </tr>";
  echo "<tr class=hide_bottom style='font-size: 10pt;'> 
						<td height = 10px align=left >  </td>
						<td align=right> SGST(2.5%)</td>
						<td> </td>
						<td> </td>
						<td> </td>
						<td> </td>
						<td> </td>
						<td align=right>".$xSingleGst." </td>

 </tr>";
	  echo "<tr class=hide_bottom style='font-size: 10pt;'> 
						<td height = 10px align=left >  </td>
						<td align=right> Round Off</td>
						<td> </td>
						<td> </td>
						<td> </td>
						<td> </td>
						<td> </td>
						<td align=right>".fn_RupeeFormat($xRoundOff)." </td>

 </tr>";		   
            for ($i = $xCount; $xCount <= 10; $xCount++) {
                echo "<tr  class=hide_bottom>
				
				 <td align=left>  </td>
				 <td align=left>  </td>
						<td align=left> </td>
						<td align=left> </td>
						<td align=left>  </td>
					
                                                <td align=left> </td>
						<td align=left> </td>
						<td align=left>  </td>
	
				
		 </tr>";
            }
	  echo "<tr class=hide_bottom style='font-size: 10pt;'> 
	  			<td align=right> </td>
						<td height = 10px align=Right > Total </td>
			
						<td align=right> </td>
							<td align=right>".$xGrandpieces." </td>
						<td> </td>
						<td> </td>
						<td> </td>
					
					<td> </td>

 </tr>";
            echo "</table>";

            /*
             * echo "<table width=100%>";
             * echo "<tr><td align=center width=60% colspan=6> </td><td align=left> Service Charges " . $xServiceCharges . " </td></tr>";
             * echo "</table>";
             */


            echo "<table width=100% border=1>";
            echo "<tr class=hide_bottom><td align=left  width=60% colspan=6>Rupees : " . ucwords(convert_number_to_words($xAfterRoundOffNetTotal)) . " Rupees Only </td><td width=20% align=right> NetAmount </td><td width=20% align=right> " . number_format($xAfterRoundOffNetTotal, 2) . " </td></tr>";

            echo "</table>";
			


            echo "<hr>";
            echo "<table  border=1 width=100% height=80px>";
            echo "<tr><td class=hide_bottom align=left width=50%>Declaration:</td>
						<td class=hide_bottom align=right width=50%><font color=blue>For " . $GLOBALS ['xCompanyTitle'] . "</font></td>
						</tr>
						<tr ><td align=left width=50%>We declare that this invoice shows the actual price of the </br>
						goods declared and all the particulars are true and correct.</td>
						<td align=right width=50%>Authorized Signatory</td>
						</tr>
							</tr>";

            echo "</table>";

            mysql_close(); // Make sure to close out the database connection
            ?>

        </div>
    </body>
</html>


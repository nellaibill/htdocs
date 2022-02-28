
<?php
include ('globalfunctions.php');
$GLOBALS ['xCurrentDate'] = date('Y-m-d');
$xLessAmount = 0;
fn_GetCompanyInfo(1);
getconfig_print();
$xSalesInvoiceNo = $_GET ['salesinvoiceno'];
$xImageFileName = "d:/softwarebackup/images/".$GLOBALS ['xPrintSrc'];
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
<img src="d:/softwarebackup/images/logo.jpg">
        <div id="divToPrint">

            <?php
            echo "<center>INVOICE</center>";
            echo "<table border=1 width=100% >";

            echo "<tr  class=hide_bottom>
			<td  align=left width=15% >
                                <img src=images/logo.jpg
		width=100px height=70px> </td>
		 <td align=left  width=30% > Customer Name " . $GLOBALS ['xCustomerName'] . " </td>
							<td align=left width=20%> BillNo </td>
		<td align=left width=20%> " . $xSalesInvoiceNo . " </td>
		</tr>";
            echo "<tr class=hide_bottom>"
            . "<td align=left >  " . $GLOBALS ['xCompanyTitle'] . " " . $GLOBALS ['xCompanyAddress1'] . " </td>
			<td align=left > Mobile No " . $GLOBALS ['xCustomerMobileNo'] . " </td>
			<td align=left width=20% > Date  </td>
		<td align=left width=10%> " . date('d/m/Y', strtotime($xBillDate)) . " </td>
		</tr>";

            echo "<tr  class=hide_bottom>"
            . "<td align=left > " . $GLOBALS ['xCompanyAddress2'] . " </td>
		<td align=left > GSTIN No " . $GLOBALS ['xCustomerGSTINNo'] . " </td>
        		<td align=left width=20%> </td>
       		
       				<td align=left width=10%>  </td></tr>";

            echo "<tr class=hide_bottom>"
            . "<td align=left > GSTIN No" . $GLOBALS ['xCompanyGSTINNo'] . " </td>"
            . "<td></td>
        		<td align=left ></td>
       		<td align=left width=10%>  </td></tr>";

            echo "<tr class=hide_bottom>"
            . "<td align=left > </td>"
            . "<td></td>
        		<td align=left></td>
       		<td align=left width=10%>  </td></tr>";
            echo "</table>";

            echo "<table border=1 width=100% height=650px> ";

            echo "<tr > <td align=left width=10%> S.No </td>
						<td align=left  width=40%> Product Name  </td>
							<td align=left width=10%> HSN Code  </td>
								<td align=left width=10% > Qty </td>
									<td align=left width=10% > MRP </td>
								<td align=left width=10%>Rate </td>
								<td align=left width=10%> Total  </td>

						<td colspan=2 align=center  width=5%>SGST</td>
                                     	<td colspan=2  align=center width=5%>CGST</td>
                                     
						<td align=left width=10%>NetAmount </td>
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
					<td align=left width=5%>" . $xSlNo . " </td>
				 <td align=left width=40%> " . $GLOBALS ['xItemDescription'] . " </td>
				 <td align=left width=10%> " . $GLOBALS ['xHSNCode'] . " </td>	
						<td align=right width=10%>" . $row ['qty'] . " </td>
						<td align=right width=10%> " . $row ['unitmrp'] . "</td>
						<td align=right width=10%> " . $row ['unitrate'] . "</td>
						<td align=right width=10%> " . $xUnitAmount . "  </td>
						<td align=right width=5%> " . $xGst . "%</td>
                                                    	<td align=right width=5%> " . $Cgst . "</td>
						<td align=right width=5%>" . $xGst . "% </td>
                                                    	<td align=right width=5%> " . $Cgst . "</td>
						<td align=right width=10%>" . fn_RupeeFormat($xNetAmount) . " </td>			

		 </tr>";


                $xTotalAmount += $row ['amount'];
                $xTotalUnitAmount += $xUnitAmount;
                $xCount += 1;
            }
            for ($i = $xCount; $xCount <= 9; $xCount ++) {
                echo "<tr class=hide_top>
				 <td align=left width=5%>  </td>
				 <td align=left width=40%>  </td>
				 <td align=left width=10%>  </td>
						<td align=left width=10%> </td>
						<td align=left width=10%> </td>
						<td align=left width=10%>  </td>
			
						<td align=left width=5%> </td>
						<td align=left width=5%> </td>
                                                			<td align=right width=5%> </td>
						<td align=right width=5%></td>
						<td align=left width=10%> </td>
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
            for ($i = $xCount; $xCount <= 9; $xCount ++) {
                echo "<tr class=hide_bottom>
				 <td align=left width=5%>  </td>
				 <td align=left width=40%>  </td>
				 <td align=left width=10%>  </td>
						<td align=left width=10%> </td>
						<td align=left width=10%> </td>
						<td align=left width=10%>  </td>
			<td align=left width=10%>  </td>
						<td align=left width=5%> </td>
						<td align=left width=5%> </td>
                                                			<td align=right width=5%> </td>
						<td align=right width=5%></td>
						<td align=left width=10%> </td>
				
		 </tr>";
            }

            $xBeforeRoundOffNetTotal = $xGrandNetAmount;
            $xAfterRoundOffNetTotal = (round($xGrandNetAmount, 0));
            $xRoundOff = (round($xAfterRoundOffNetTotal - $xBeforeRoundOffNetTotal, 2));
            echo "<tr>
		<td align=left  Total </td>
		<td align=left  colspan=5>" . ucwords(convert_number_to_words($xAfterRoundOffNetTotal)) . " Rupees Only</td>           
                <td align=right width=5%>" . $xTotalUnitAmount . " </td>
		<td align=right colspan=2 width=5%>" . $xGrandSgst . "</td>
		<td align=right colspan=2 width=5%>" . $xGrandSgst . "</td>
		<td align=right width=10%>" . fn_RupeeFormat(round($xAfterRoundOffNetTotal)) . " </td>
				
		 </tr>";

            echo "<tr height=50px>
                    <td align=left colspan=9 width=100%>Amount </br>
                    Tax Before &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$xTotalUnitAmount </br>
                    CGST &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$xGrandSgst </br>
                    SGST &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$xGrandSgst </br>
                    Total Amount" . fn_RupeeFormat(round($xAfterRoundOffNetTotal)) . "</td>
		<td align=right colspan=5 width=100%>For " . $GLOBALS ['xCompanyTitle'] . " </td>
								</tr>";
            echo "</table>";


            mysql_close(); // Make sure to close out the database connection
            ?>

        </div>
    </body>
</html>


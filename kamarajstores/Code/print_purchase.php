<?php
include ('globalfunctions.php');

$GLOBALS ['xCurrentDate'] = date('Y-m-d');
$xLessAmount = 0;
$xGrandDiscountValue = 0;
fn_GetCompanyInfo(1);
$xPurchaseInvoiceNo = $_GET ['purchaseinvoiceno'];
$xQry = "SELECT * from inv_purchaseentry1 where purchaseinvoiceno=$xPurchaseInvoiceNo";
$result = mysql_query($xQry);
while ($row = mysql_fetch_array($result)) { // Creates a loop to loop through results
    findsuppliername($row ['supplierno']);
    $xBillDate = $row ['date'];
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
            echo "<center>VOUCHER PURCHASE</CENTER></font>";
            echo "<hr>";
           echo "<table border=1 width=100% >";
            echo "<tr>
		

		<td style='font-size: 14pt; font-family:Arial' align=center > " . $GLOBALS ['xCompanyTitle'] . " </br>" . $GLOBALS ['xCompanyAddress1'] . " </br>" . $GLOBALS ['xCompanyAddress2'] . " </br>" . $GLOBALS ['xCompanyAddress3'] . " " . "GSTIN No : " . $GLOBALS ['xCompanyGSTINNo'] . "</td>
</tr>";
            echo "</table>";

            echo "<table  width=100% border=1> ";

            echo "<tr>
		<td width=50% align=left >Name : " . $GLOBALS ['xSupplierName'] . " </td>
			<td align=left width=12.5% > No : " . $xPurchaseInvoiceNo . "  </td>
		<td align=left width=12.5% > Date </td>
		<td width=12.5%>" . date('d/m/Y', strtotime($xBillDate)) . " </td>
		</tr>";

            echo "</table>";
            echo "<hr>";
            // echo "<table border=1 width=100% height=350px>";
            echo "<table  width=100% border=1 >";
            echo "<tr >
			<td align=left width=10%>Rate </td>
			<td align=left width=20%> Particulars  </td>
			<td align=right width=10% > Qty </td>
			<td align=right width=10% > Kg </td>
			<td align=right width=10% >Amount </td>
			</tr>";
            echo "</table>";
            echo "<hr>";
            echo "<table  width=100% border=1>";

            $xSlNo = 0;
            $xCount = 0;
            $xTotalAmount = 0;
            $xPurchaseInvoiceNo = $_GET ['purchaseinvoiceno'];

            $xGrandQty = 0;
            $xGrandNetAmount = 0;
            $xGrandCgst = 0;
            $xGrandSgst = 0;
            $xGrandUnitAmount = 0;
            $xZeroPercentage = '';
            $xFivePercentage = '';
            $xTwelvePercentage = '';
            $xEighteenPercentage = '';
            $xTwentyEightPercentage = '';

            $xQry = "SELECT * from inv_purchaseentry where purchaseinvoiceno=$xPurchaseInvoiceNo";
            $result = mysql_query($xQry);

            while ($row = mysql_fetch_array($result)) { // Creates a loop to loop through results
                $xSlNo += 1;
                finditemname($row ['itemno']);
                finditempricevat($row ['itemno'], $row ['batchid']);

                $xGst = $row ['vat'];
                $xQty = $row ['qty'];
                $xUnitRate = $row ['originalprice'];
                $xQtyForKg = $row ['currentqty'];

                $xUnitAmount = $xQty * $xUnitRate;
                $xKgs = $xQty * $xQtyForKg;
                $xGrandQty += $xQty;
                $xGrandUnitAmount += $xUnitAmount;


                echo "<tr class=hide_bottom  > 

						<td align=left width=10%> " . $xUnitRate . "</td>
						<td align=left width=20%> " . $GLOBALS ['xItemName'] . " </td>
						<td align=right width=10%>" . $row ['qty'] . " </td>
						<td align=right width=10%> " . $xKgs . "</td>
						<td align=right width=10%>" . $xUnitAmount . " </td>	
		
					 </tr>";
          $xCount += 1;
            }
			for ($i = $xCount; $xCount <= 10; $xCount++) {
                echo "<tr  class=hide_bottom height=20px>
				
				 <td>  </td>
 <td>  </td>
  <td>  </td>
   <td>  </td>
    <td>  </td>
	
				
		 </tr>";
            }
            echo "<tr ><td colspan=3>Rupees " . ucwords(convert_number_to_words($xGrandUnitAmount)) . " Rupees Only </td><td>Total</td><td align=right>" . $xGrandUnitAmount . "</td></tr>";

            echo "<tr > 

							<td align=left width=10%>Seller</td>
		<td></td><td></td><td></td>
								<td align=right width=10%>For " . $GLOBALS ['xCompanyTitle'] . "  </br></br></br>Buyer </td>	
					
							
		
					 </tr>";

            mysql_close(); // Make sure to close out the database connection
            ?>

        </div>

    </body>
</html>


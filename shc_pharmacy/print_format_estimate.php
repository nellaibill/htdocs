<?php
include ('globalfunctions.php');
$GLOBALS ['xCurrentDate'] = date('Y-m-d');
fn_GetCompanyInfo(1);
$xGrandNetAmount = 0;
getconfig_quotation();
$xEstimateId = $_GET ['estimate_id'];
$xQry = "SELECT * from inv_estimateentry1 where estimate_id=$xEstimateId";
$result = mysql_query($xQry);
while ($row = mysql_fetch_array($result)) { // Creates a loop to loop through results
    findcustomername($row ['estimate_customerno']);
    $xBillDate = $row ['estimate_date'];
}
?>
<html>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <body onload="window.print(); setTimeout(window.close, 0);">
        <div id="divToPrint">
            <?php
            echo "<table width=100% > ";
            echo "<tr>
		

				<td style='font-size: 20pt; font-family:Arial' align=center > " . $GLOBALS ['xCompanyTitle'] . " </td>
</tr>";
            echo "</table>";
            echo "<table width=100% > ";
            echo "<tr><td align=center style='font-size: 14pt; font-family:Arial' > " . $GLOBALS ['xCompanyAddress1'] . " </td></tr>";
            echo "<tr><td align=center >" . $GLOBALS ['xCompanyAddress2'] . " " . $GLOBALS ['xCompanyAddress3'] . " " . $GLOBALS ['xCompanyContactNo'] . " </td></tr>";


            echo "</table>";

            echo "<table  width=100% > ";

            echo "<tr>
						<td width=25% align=left > ATTN COMPANY : </td><td width=50% align=left  colspan=2> " . $GLOBALS ['xCustomerName'] . " </td>
				
						<td align=left width=12.5% > Date </td>
						<td width=12.5%>" . date('d/m/Y', strtotime($xBillDate)) . " </td>
				</tr>";
            echo "<tr>
					<td width=25% align=left >  ADDRESS : </td><td width=25% align=left > " . $GLOBALS ['xCustomerAddress'] . " </td>
						
								<td align=left width=12.5%> </td>
						<td width=12.5%></td>
						</tr>";
            echo "<tr>
					<td width=25% align=left >  SUBJECT : </td><td width=25% align=left >  " . $GLOBALS ['xLine2'] . " </td>
				        </tr>";
            echo "<tr>
					<td width=25% align=left >  " . $GLOBALS ['xLine3'] . " </td>     </tr>";
            echo "<tr><td width=85% align=left colspan=4  > " . $GLOBALS ['xLine4'] . "</td> </tr>";

            echo "</table>";
            echo "<hr>";
            // echo "<table border=1 width=100% height=350px>";
            echo "<table  width=100% border=1 height=400px>";
            echo "<tr >
				<td align=left width=5% height=30px> SL  </td>
                                               <td align=left width=20%> Description  </td>
                                                <td align=left width=10%> Make  </td>
                                                <td align=left width=10%> Unit  </td>
						<td align=right width=10% > Qty </td>
						<td align=right width=10%>U.Price </td>
						<td align=right width=10%>Total </td>
			</tr>";


            $xSlNo = 0;
            $xCount = 0;
            $xTotalAmount = 0;
            $xEstimateId = $_GET ['estimate_id'];
            $xQry = "SELECT * from inv_estimateentry where estimate_id=$xEstimateId";
            $result = mysql_query($xQry);

            while ($row = mysql_fetch_array($result)) { // Creates a loop to loop through results
                $xSlNo += 1;
                finditemname($row ['itemno']);
                $xGroupNo=$GLOBALS ['xItemGroupNo'];
                $xGroupName=$xGroupNo;  
                finditemgroupname($xGroupNo);
                $xGroupName=$GLOBALS ['xItemGroupName'];              
                $xQty = $row ['qty'];
                $xAmount = $row ['amount'];
                $xNetAmount = $xQty * $xAmount;
                $xGrandNetAmount += $xNetAmount;
                echo "<tr class=hide_bottom height=30px>  
						<td height = 30px align=left width=5%> " . $xSlNo . "  </td>
						<td align=left width=20%> " . $GLOBALS ['xItemName'] . " </td>
                                                 <td align=right width=10%>" . $xGroupName . " </td>
                                                 <td align=right width=10%>" .$GLOBALS ['xPackDescription'] . " </td>    
						<td align=right width=10%>" .$row ['qty']  . " </td>
						<td align=right width=10%> " . $row ['amount'] . "</td>
                                                    <td align=right width=10%> " . $xNetAmount . "</td>
					 </tr>";
            }
            for($i = $xCount; $xCount <= 10; $xCount ++) {
					echo "<tr class=hide_top>
				
				 <td align=left width=5%>  </td>
				 <td align=left width=30%>  </td>
						<td align=left width=15%> </td>
						<td align=left width=10%> </td>
						<td align=left width=10%>  </td>
						<td align=left width=10%> </td>
						<td align=left width=10%> </td>
						
	
				
		 </tr>";
				}
            echo "<tr height=30px><td align=right colspan=4>GRAND TOTAL </td><td align=right colspan=4>" . $xGrandNetAmount . "</td></tr>";
                    echo "<tr><td align=right colspan=4></td><td align=right colspan=4></td></tr>";
                    echo  "</table>";
            echo "<table width=100% > ";
            echo "<tr><td width=40%>TERMS OF QUOTATION </td> <td> </td></tr>";
            echo "<tr><td width=10%>VALIDITY </td> <td>" . $GLOBALS ['xLine5'] . " </td></tr>";
            echo "<tr><td width=10%>MAINTENANCE </td> <td>" . $GLOBALS ['xLine6'] . " </td></tr>";
            echo "<tr><td width=10%>WARRANTY </td> <td>" . $GLOBALS ['xLine7'] . " </td></tr>";
            echo "<tr><td width=10%>PAYMENT </td> <td>" . $GLOBALS ['xLine8'] . " </td></tr>";




            echo "</table>";

            mysql_close(); // Make sure to close out the database connection
            ?>
             </BR>
            Thanks and Regards,
            
            </BR>
            <b>MOHAMED YASIN</BR>
                Mob : +91- 960081 8531
                </br>
            </b>
            Email : tigercctv@gmail.com
            <hr>
        </div>

    </body>
</html>


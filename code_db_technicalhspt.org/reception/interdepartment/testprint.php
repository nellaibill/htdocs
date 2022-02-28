<?php
include('globalfile.php');
?>
<html>
<head>
<script type="text/javascript"> 
window.onload=PrintDiv;     
function PrintDiv() 
 {    
       window.close();
       var divToPrint = document.getElementById('divToPrint');
       var popupWin = window.open('', '_blank', 'width=600,height=300');
       popupWin.document.open();
       popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
       popupWin.document.close();
       popupWin.close();
}
</script>
</head>
<body><input type="submit" value="PRINT" onclick="PrintDiv();" />
<input type="submit" value="BACK"  onclick="window.location='inv_ht006reprint.php';" />
<div id="divToPrint" >
<div class="container">
<?php
$xSalesInvoiceNo= $_GET['salesinvoiceno'];
$xQry="SELECT * from inv_salesentry where salesinvoiceno=$xSalesInvoiceNo"; 
$result = mysql_query($xQry);
?>
<font size="3">
<p>
<?php
$xSlNo=0;
echo "<font size= 3>";
echo "<center>TAX  INVOICE </center>";
echo "<table border=1  width=100% style=border-collapse:collapse;>";
echo "<tr>";
echo "<td width=10%> </td>";
echo "<td width=10%> </td>";
echo "<td width=10%></td>";
echo "<td width=10%></td>";
echo "<td width=10%></td>";
echo "<td width=10%></td>";
echo "<td width=10%></td>";
echo "<td width=10%></td>";
echo "<td width=10%></td>";
echo "<td width=10%></td>";
echo "</tr>";
echo "<b><tr>";
echo "<td colspan=6>
JJ AIR CONDITIONARES</br>
# 496,Vanavil Complex,Madurai Main Road,</br>
Udayarpatti,Tirunelveli 627001.</br>
0462 2332125,94421 12127,Service N0:94875 12125</br>
";
echo "</td>";
echo "<td colspan=4>
Blue Star</br>
Authorized Experts For</br>
Sales and Service</br>
";
echo "</td>";
echo "</tr></b>";

echo "<tr>";
echo "<td colspan=6>
Customer Name :
                    </br>
                    </br>
                    </br>
                    </br>
Ph No         :</br>
Contact Person:</br>
Tin No        :</br>
AN No         :</br>
CST No        :</br>
Area          :
";
echo "</td>";
echo "<td colspan=4>
Invoice No :</br>
Date         :</br>
Dc No:</br>
Dc Date        :</br>
Po No         :</br>
Po Date        :</br>
";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>SL.No</td>";
echo "<td colspan=5>Particulars</td>";
echo "<td>Qty</td>";
echo "<td colspan=2>Unit Rate</td>";
echo "<td>Amount</td>";
echo "</tr>";

echo "<tr >";
echo "<td>1</td>";
echo "<td colspan=5></td>";
echo "<td></td>";
echo "<td colspan=2></td>";
echo "<td></td>";
echo "</tr>";


echo "<tr >";
echo "<td>1</td>";
echo "<td colspan=5></td>";
echo "<td></td>";
echo "<td colspan=2></td>";
echo "<td></td>";
echo "</tr>";

echo "<tr >";
echo "<td>1</td>";
echo "<td colspan=5></td>";
echo "<td></td>";
echo "<td colspan=2></td>";
echo "<td></td>";
echo "</tr>";

echo "<tr >";
echo "<td>1</td>";
echo "<td colspan=5></td>";
echo "<td></td>";
echo "<td colspan=2></td>";
echo "<td></td>";
echo "</tr>";

echo "<tr >";
echo "<td>1</td>";
echo "<td colspan=5></td>";
echo "<td></td>";
echo "<td colspan=2></td>";
echo "<td></td>";
echo "</tr>";


echo "<tr >";
echo "<td colspan=6>Rupees</td>";
echo "<td colspan=3>Grand Total</td>";
echo "<td></td>";
echo "</tr>";


echo "<tr >";
echo "<td colspan=6>
Terms and Conditions </br>
1.Goods once sold will not be taken back.</br>
2.Interest @18% p.a will be if the payment is not made with in the stipulated day.</br>
3.Subject to Tirunelveli Jurisdicated Only.</br></br></br></b>
VAT TIN NO : </br>
CST  NO : </br>
Service Tax No : </br>
Pan No : </b></td>";
echo "<td colspan=4></br></br></br>FOR JJ AIR CONDITIONERS</td>";
echo "</tr>";


echo "</table>";

?>	
</div><!-- /container -->
</div>
</body></html>	
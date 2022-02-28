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

<?php
$xSlNo=0;
echo "<font size= 3>";
echo "JJ SALES BILL ";
echo "</br>";
echo "</br>";
echo "Date - "  . date(" d-M-Y h:i:s a ");

    echo "<table border=1>";
echo "<tr><th width=10>S.NO</th><th width=60>   ITEMNAME </th><th width=10>   QTY</th></tr>";
while($row = mysql_fetch_array($result))
  {   
    echo "<tr>";
    finditemname($row['itemno']);
    finditemprice($row['itemno']);
    findstockpointname($row['usagestockpointno']);
    findcustomername($row['empno']);
    echo "<td>" . $xSlNo+=1  . "</td>";
    echo "<td>" . $GLOBALS ['xItemName']  . "</td>";
    echo "<td align=right>" . $row['qty']  . "</td>";
    //echo "<td align=right>" . $row['usagestockdetails']  . "</td>";
    //echo "<td align=right>" . money_format("%!n", $row['qty'] * $GLOBALS ['xItemSellingPrice'] )   . "</td>";
    //$xGrandSellingPrice+=$row['qty'] * $GLOBALS ['xItemSellingPrice'] ;
    echo "</tr>";
  }

echo "</br>";
echo "Bill No - "  . $xSalesInvoiceNo;
echo "</br>";
echo "Staff Name - "  . $GLOBALS ['xEmpName'];
echo "</br>";
echo "Stock Point  - "  . $GLOBALS ['xStockPointName'];
echo "</br>";
echo "</br>";
mysql_close(); //Make sure to close out the database connection
?>	
</div><!-- /container -->
</div>
</body></html>	
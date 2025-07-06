<?php
include ('globalfunctions.php');
$xRecieptNo = $_GET ['accounts_receipt_id'];
fn_GetCompanyInfo ( 1 );
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
<body>
	<input type="submit" value="PRINT" onclick="PrintDiv();" />
	<input type="submit" value="BACK"
		onclick="window.location='index.php';" />
	<div id="divToPrint">
		<div class="container">
<?php
$xSlNo = 1;
echo "<table width=100% >";
echo "<tr>";

echo "<td align=left width=75% > " . $GLOBALS ['xCompanyTitle'] . "<br/>
		" . $GLOBALS ['xCompanyAddress1'] . "<br/>
		" . $GLOBALS ['xCompanyAddress2'] . "<br/>
		" . $GLOBALS ['xCompanyAddress3'] . "</td>";
echo "<td  align=right width=25% ><img src=images/logo.gif 
		width=100px height=50px> </td>";
echo "</tr>";
echo "</table>";
echo "<hr>";

$xQry = "SELECT * from accounts_receipt where accounts_receipt_id=$xRecieptNo";
$result = mysql_query ( $xQry );
while ( $row = mysql_fetch_array ( $result ) ) {
	echo "<table>";
	echo "<tr>";
	echo "<td width=25% >No : " . $row ['accounts_receipt_id'] . "</td>";
	echo "<td width=50% align=center><u>Reciept</u></td>";
	echo "<td width=25% align=right>Date" . date ( 'd/M/Y', strtotime ( $row ['accounts_receipt_date'] ) ) . "</td>";
	echo "</tr>";
	echo "</table>";
	echo "<hr>";
	fn_FindAccountLedgerDetails ( $row ['accounts_receipt_ledger_id'] );
	echo " <div style=font-size:120%> Recieved with thanks from <b><u> 
				" . $GLOBALS ['xAccountLedgerName'] . "</u></b> the sum of Rupees <b>" . ucwords ( convert_number_to_words ( round ( $row ['accounts_receipt_amount'] ) ) ) . "</b>
				Rupees Only by Cash Dated on  " . date ( 'd/M/Y', strtotime ( $row ['accounts_receipt_date'] ) ) . "
		towards " . $row ['accounts_receipt_remarks'] . "
		 </div>";
	
	echo "</tr>";
	echo "</table>";
	echo "<hr>";
	echo "<table width=100%>";
	echo "<tr>";
	echo "<td width=20%>Rs " . $row ['accounts_receipt_amount'] . "</td>";
	echo "<td width=80% align=right >" . $GLOBALS ['xCompanyTitle'] . " </br> </br> 
Authorised Signature
</td>";
	echo "</tr>";
	echo "</table>";
}
?>	
</div>
		<!-- /container -->
	</div>
</body>
</html>

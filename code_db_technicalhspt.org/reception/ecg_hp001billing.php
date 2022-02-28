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
       //popupWin.close();
      
  }
</script>
</head>
<body>
<input type="submit" value="print" onclick="PrintDiv();" />
<div id="divToPrint" >
<div class="container">
<?php
$xTxNo = $_GET['txno'];
$xQry="SELECT * from t_ecgxraybilling  where txno=$xTxNo; ";  //You don't need a ; like you do in SQL
$result = mysql_query($xQry);
?>
<font size="3">
<p>

<?php
while($row = mysql_fetch_array($result)){   //Creates a loop to loop through results
echo "<center>";
echo "<font size= 3>";
echo "LAKSHMI HOSPITAL DIAGNOSTIC CENTRE";
echo "</br>";
echo "TIRUNELVELI";
echo "</br>";
echo "</center>";
echo "DATE & TIME  -"  . date(" d-M-Y h:i:s a ");
echo "</br>";
echo "PATIENT NAME -" . $row['patientname'];
echo "</br>";
echo "AGE          -" .$row['age'] . "-" . $row['dmy'] . " SEX - " .  $row['gender'] ;
echo "</br>";
findtesttypename($row['testtypeno']);
if($row['testtypeno']==1)
{
echo "TEST NAME  - ECG" ;
}
else
{
echo "TEST NAME  - XRAY" ;
echo "</br>";
echo "TEST TYPE NAME    -" . $GLOBALS ['xTestTypeName'] ;
}
echo "</br>";
echo "AMOUNT    -" . $row['testamount'];
echo "</br>";
echo "SECTION[DEPARTMENT]    -" . $row['section'];
echo "</br>";
finddoctorname($row['doctorno']);
echo "REFERENCE     -" . $GLOBALS ['xDoctorName'];
echo "</br>"; 
}

mysql_close(); //Make sure to close out the database connection
?>	
</div><!-- /container -->
</div>
</body></html>	
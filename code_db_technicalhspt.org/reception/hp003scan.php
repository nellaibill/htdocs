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
$xQry="SELECT * from t_scanbilling  where txno=$xTxNo; ";  //You don't need a ; like you do in SQL
$result = mysql_query($xQry);
?>
<font size="3">
<p>

<?php
while($row = mysql_fetch_array($result)){   //Creates a loop to loop through results
echo "DATE & TIME  -"  . date(" d-M-Y h:i:s a ");
echo "</br>";
echo "PATIENT NAME -" . $row['patientname'];
echo "</br>";
echo "AGE          -" .$row['age'] . "-" . $row['dmy'] . " SEX - " .  $row['gender'] ;
echo "</br>";
findtesttypename($row['testtypeno']);
/*

if($row['testtypeno']==3)
{
echo "TEST NAME  - SCAN" ;
}
else
{
echo "TEST NAME  - SCAN" ;
echo "</br>";
echo "TEST TYPE NAME    -" . $GLOBALS ['xTestTypeName'] ;
}*/
echo "TEST & AMOUNT  -" . $GLOBALS ['xTestTypeName'] . "[" . $row['testamount']. "]" ;
echo "</br>";

//echo "SECTION      -" . $row['section'];
//echo "</br>";
finddoctorname($row['doctorno']);
echo "REF.BY       -" . $GLOBALS ['xDoctorName'];
echo "</br>"; 
}

mysql_close(); //Make sure to close out the database connection
?>	
</div><!-- /container -->
</div>
</body></html>	
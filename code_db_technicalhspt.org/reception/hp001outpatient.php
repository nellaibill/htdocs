<?php
include('session.php');
include('globalfunctions.php');
$GLOBALS ['xCurrentDate']=date('Y-m-d');
?>
<html>
<title> VIEW - O/P </title>
<head><link href="bootstrap.css" rel="stylesheet">
<script type="text/javascript"> 
//window.onload=PrintDiv;     
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
<form action="hr001outpatient.php" method="post">
<center><h1>PATIENT DATA</h1></center>
<h3>
<!--<a href="ht001outpatient.php" >Go Back Click Here</a></h3>!-->
</form>
<br>
<br>
<body>
<!--<input type="submit" value="print" onclick="PrintDiv();" />!-->
<div id="divToPrint" >
<div class="container">
<?php
//GetMaxIdNoForOP();
$xTxNo = $_GET['txno'];
//$xTxNo = $GLOBALS ['xMaxIdForOp']-1;
$xQry="SELECT * from outpatientdetails where txno=$xTxNo; ";  //You don't need a ; like you do in SQL
$result = mysql_query($xQry);

echo "<table border=0>"; // start a table tag in the HTML

while($row = mysql_fetch_array($result)){   //Creates a loop to loop through results
$date = $row['createdason'];
if ($row['sex']=='MALE')
{
$xSex='M';
}
if ($row['sex']=='FEMALE')
{
$xSex='F';
}
if($row['dmy']=='DAYS')
{
$xdmy='D';
}
if($row['dmy']=='MONTHS')
{
$xdmy='M';
}
if($row['dmy']=='YEARS')
{
$xdmy='Y';
}

echo "<tr><td width =200> OP-NUMBER </td><td width =200>" . $row['txno'] . "</td><td></tr>" ;  
echo "<tr><td> TOKEN NO </td><td>" . $row['tokenno'] . "-". $row['casetype'] . "</td><td></tr>" ;  
echo "<tr><td> DATE & TIME</td><td>" . date(' d/m/Y h:i A', strtotime($date)) . "</td><td></tr>" ;  
echo "<tr><td> PATIENT DATA</td><td>" . $row['patientname']."  - " .$row['age'] . "-" . $xdmy . "-" . $xSex .  "</td><td></tr>" ; 
finddoctorname( $row['doctorname']); 
echo "<tr><td> DOCTOR NAME </td><td>" . $GLOBALS ['xDoctorName'] . "</td><td></tr>" ;  
//echo "<tr><td> PLACE </td><td>" . $row['place'] . "</td><td></tr>" ;  
echo "<tr><td> FEES </td><td>" . $row['fees']."  - " .$row['paymentstatus']  . "</td><td></tr>" ;  
//echo "<tr><td> DOCTOR NOTE </td><td>" . $row['doctornote'] . "</td><td></tr>" ;  

/*
echo "<tr><td> TOKEN </td><td>" . $row['tokenno'] . "-". $row['casetype'] .date(' d/m h:i A', strtotime($date)). "</td><td></tr>" ;  
echo "<tr><td> PATIENT </td><td>" . $row['patientname']."  - " .$row['age'] .  "</td><td></tr>" ;  
echo "<tr><td> DOCTOR</td><td>" . $row['doctorname'] . "</td><td></tr>" ;  */
}

echo "</table>"; //Close the table in HTML
echo "<p> Receptionist Sign   ______    </br> Doctors Sign  _____</P>";


mysql_close(); //Make sure to close out the database connection


?>	


  </div><!-- /container -->
</div>
</body></html>	
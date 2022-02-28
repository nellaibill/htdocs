<?php
include('session.php');
?>
<html>
<head>
<title>IT INCOME B/W D&P</title>
<link href="bootstrap.css" rel="stylesheet">
</head>
<form action="xviewincomebetweendateandproduct.php" method="post">
<center><h1>VIEW ALL PERSONAL INCOME BETWEEN SELECTED NAMES DISPLAYS HERE</h1></center>
<h3>
<a href="viewincome.php" >Go Back Click Here</a></h3>

From Date     :	  <input type="date" name="fromdate">
To Date     :	  <input type="date" name="todate">
<select id="sc" name="productname">
    <option value="ip">IP</option>
    <option value="opl">OPL</option>
<option value="opm">OPM</option>
    <option value="lab">LAB</option>
    <option value="scan">SCAN</option>
    <option value="xray">XRAY</option>
    <option value="ecg">ECG</option>
<option value="others">OTHERS</option>
</select>
<input type="submit" value="VIEW" name='sentForm' width="75" height="48">
</form>
<br>
<br>
<body>
  <div class="container">
<table class="table table-hover">
<caption>INCOME DETAILS</caption>
      <thead>
        <tr>
          <th> DATE </th>
          <th>SELECTED NAME</th>

        </tr>
      </thead>
 
 
      <tbody>

<?php
$total=0;
if (isSet($_POST['sentForm'])) {
require_once('config.php');

$query2="SELECT date , ".$_POST['productname']." as name from xincome WHERE date >= '".$_POST['fromdate']."' 
		 AND date<= '".$_POST['todate']."' union all select 'GRAND-TOTAL',sum( ".$_POST['productname'].") from xincome 
		 WHERE date >= '".$_POST['fromdate']."' 
		 AND date<= '".$_POST['todate']."' order by date ; "; 
$result2=mysql_query($query2); 


echo "Records Displaying Between ";
echo  "$_POST[fromdate] ";
echo  "$_POST[todate] ";

while ($row = mysql_fetch_array($result2)) {
    echo '<tr>';
    echo '<td>' . $row['date']  . '</td>';
    echo '<td>' . $row['name']  . '</td>';
    $total+= $row['name'] ;
	echo '</tr>'; 
	
	 
}
}
?>	

</tbody>


    </table>	
  </div><!-- /container -->
</body></html>	
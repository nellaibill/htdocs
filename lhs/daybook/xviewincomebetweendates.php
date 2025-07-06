<?php
include('session.php');
?>
<title> IT INCOME B/W D</title>
<head>
<link href="bootstrap.css" rel="stylesheet">
</head>
<a href="xviewincome.php" >Go Back Click Here</a>


<body>
  <div class="container">
<table class="table table-hover">
<caption>INCOME DETAILS</caption>
      <thead>
        <tr bgcolor="#CC66CC">
          <th> DATE </th>
          <th>IP</th>
 
          <th>OPL</th>
<th>OPM</th>
 
          <th>LAB</th>
 
          <th>SCAN</th>
        
<th>XRAY</th>
 
          <th>ECG</th>
 
          <th>OTHERS</th>
 <th>TOTAL</th>
 

        </tr>
      </thead>
 
 
      <tbody>


<?php

  
require_once('config.php');
$query2="SELECT *,(ip+opl+opm+lab+scan+xray+ecg+others) as total from xincome  WHERE date >= '".$_POST['fromdate']."' AND date<= '".$_POST['todate']."' union all select 'GRAND-TOTAL',sum(ip),sum(opl),sum(opm),sum(lab),sum(scan),sum(xray),sum(ecg),sum(others),sum(ip+opl+opm+lab+scan+xray+ecg+others) from xincome  WHERE date >= '".$_POST['fromdate']."' AND date<= '".$_POST['todate']."' order by date ; "; 
$result2=mysql_query($query2); 


echo '<p style="color:blue;font-size:30px;font-family:calibri ;">IT INCOME RECORDS SHOWING FROM  ';
echo  "$_POST[fromdate] ";
echo "TO ";
echo  "$_POST[todate] ";
echo '</p>';

while ($row = mysql_fetch_array($result2)) {
    echo '<tr>';
    echo '<td>' . $row['date']  . '</td>';
    echo '<td>' . $row['ip'] . '</td>';
    echo '<td>' . $row['opl'] . '</td>';
  echo '<td>' . $row['opm'] . '</td>';
    echo '<td>' . $row['lab'] . '</td>';
    echo '<td>' . $row['scan'] . '</td>';
    echo '<td>' . $row['xray'] . '</td>';
    echo '<td>' . $row['ecg'] . '</td>';
    echo '<td>' . $row['others'] . '</td>';
	 echo '<td>' . $row['total'] . '</td>';
	 if($row['date']!='GRAND-TOTAL')
	 {
	 
	 	echo '<td><a href=xeditincome.php?date='.$row['date']. '>EDIT</a></td>';
	 	echo '<td><a href=xdeleteincome.php?date='.$row['date'].'>DELETE</a></td>';
	 }
	 echo '</tr>';
	
}
?>
   <tr  bgcolor="#CC66CC">
          <th> DATE </th>

          <th>IP</th>
 
          <th>OPL</th>

          <th>OPM</th>
          <th>LAB</th>
 
          <th>SCAN</th>
        
          <th>XRAY</th>
 
          <th>ECG</th>
 
          <th>OTHERS</th>
		  
          <th>TOTAL</th>
 

        </tr>
</tbody>	
</tbody>
<tr>

    </table>	
  </div><!-- /container -->
</body></html>	
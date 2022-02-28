<head><link href="bootstrap.css" rel="stylesheet"></head>
<a href="datewise.php" >Go Back Click Here</a>


<body>
  <div class="container">
<table class="table table-hover">
<caption>INCOME DETAILS</caption>
      <thead>
        <tr>
          <th> DATE </th>
          <th>IP</th>
 
          <th>OP</th>
 
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
$result = mysql_query("SELECT * FROM income") or die(mysql_error());
$query2="SELECT * FROM income WHERE date >= '".$_POST['fromdate']."' AND date<= '".$_POST['todate']."'; "; 
$result2=mysql_query($query2); 


echo "Records Displaying Between ";
echo  "$_POST[fromdate] ";
echo  "$_POST[todate] ";

while ($row = mysql_fetch_array($result2)) {
    echo '<tr>';
    echo '<td>' . $row['date']  . '</td>';
    echo '<td>' . $row['ip'] . '</td>';
    echo '<td>' . $row['op'] . '</td>';
    echo '<td>' . $row['lab'] . '</td>';
    echo '<td>' . $row['scan'] . '</td>';
    echo '<td>' . $row['xray'] . '</td>';
    echo '<td>' . $row['ecg'] . '</td>';
    echo '<td>' . $row['others'] . '</td>';
$total=$row['ip']+$row['op']+$row['lab']+$row['scan']+$row['xray']+$row['ecg']+$row['others'];
    echo '<td>' . $total. '</td>';
$TOTAL=0;
  $ip+=$row['ip'];
   $op+=$row['op'];
   $lab+=$row['lab'];
   $scan+=$row['scan'];
   $xray+=$row['xray'];
   $ecg+=$row['ecg'];
   $others+=$row['others'];

}
?>	
</tbody>
<tr>
<tbody>
<td>TOTAL</td>
  <?  echo '<td>' . $ip . '</td>';?>
  <?  echo '<td>' . $op. '</td>';?>
  <?  echo '<td>' . $lab. '</td>';?>
  <?  echo '<td>' . $scan. '</td>';?>
  <?  echo '<td>' . $xray. '</td>';?>
  <?  echo '<td>' . $ecg. '</td>';?>
  <?  echo '<td>' . $others. '</td>';?>


</tbody>
    </table>	
  </div><!-- /container -->
</body></html>	
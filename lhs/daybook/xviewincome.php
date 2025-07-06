<?php
include('session.php');
?>
<html>
<title>IT INCOME</title>
<head>
<link href="bootstrap.css" rel="stylesheet">
<script src="js/saleem.js"></script>
<script type="text/javascript">
function confirm_edit() {
  return confirm('Would you Like to Edit ?');
}
</script>
<script type="text/javascript">
function confirm_delete() {
  return confirm('Would you Like to Delete ?');
}
</script>
</head>
<form action="xviewincomebetweendates.php" method="post">
<a href="index.php" >Go Back Click Here</a>

From Date     :	  <input type="date" name="fromdate">
To Date     :	  <input type="date" name="todate">
<input type="submit" value="VIEW">
<br>
<br>
<body>
  <div class="container">
<table class="table table-hover">
<caption>INCOME DETAILS</caption>
      <thead>
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
      </thead>
 
 
   


<?php
require_once('config.php');

// Retrieve all the data from the "tblstudent" table
$result = mysql_query("SELECT *,(ip+opl+opm+lab+scan+xray+ecg+others) as total from xincome union all select 'GRAND-TOTAL',sum(ip),sum(opl),sum(opm),sum(lab),sum(scan),sum(xray),sum(ecg),sum(others),sum(ip+opl+opm+lab+scan+xray+ecg+others) from xincome order by date") or die(mysql_error());
//$numResults = mysql_num_rows($result);
$counter = 0;
?>
   <tbody>
<?php

while($income_rows=mysql_fetch_array($result)){
?>

<td bgcolor="#A00000"><?php echo  $income_rows['date'] ; ?></td>
<td><?php echo money_format("%!n", $income_rows['ip']) ; ?></td>
<td><?php echo money_format("%!n", $income_rows['opl']) ; ?></td>
<td><?php echo money_format("%!n", $income_rows['opm']) ; ?></td>
<td><?php echo money_format("%!n", $income_rows['lab']) ; ?></td>
<td><?php echo money_format("%!n", $income_rows['scan']) ; ?></td>
<td><?php echo money_format("%!n", $income_rows['xray']) ; ?></td>
<td><?php echo money_format("%!n", $income_rows['ecg']) ; ?></td>
<td><?php echo money_format("%!n", $income_rows['others']) ; ?></td>
<td ><?php echo money_format("%!n", $income_rows['total']) ; ?></td>
<?php
if($income_rows['date']!='GRAND-TOTAL')
{
?>
<td><a href="xeditincome.php<?php echo '?date='.$income_rows['date']; ?>" onclick="return confirm_edit()" >EDIT</a></td>
<td><a href="xdeleteincome.php<?php echo '?date='.$income_rows['date']; ?>" onclick="return confirm_delete()" >DELETE</a></td>
<?php
}
?>

</tr>

<?php }?>
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
</table>	
  </div><!-- /container -->
</body></html>	
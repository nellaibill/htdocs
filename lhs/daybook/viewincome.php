<?php
include('session.php');
?>
<html>
<title> VIEW INCOME</title>
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

<form action="viewincomebetweendates.php" method="post">
<center><h1> VIEW INCOME RECORDS </H1></center>
From Date     :	  <input type="date" name="fromdate">
To Date     :	  <input type="date" name="todate">
<input type="submit" value="VIEW">

<body >
<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
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

$result = mysql_query("SELECT *,(ip+opl+opm+lab+scan+xray+ecg+others) as total from income union all select 'GRAND-TOTAL',sum(ip),sum(opl),sum(opm),sum(lab),sum(scan),sum(xray),sum(ecg),sum(others),sum(ip+opl+opm+lab+scan+xray+ecg+others) from income order by date desc limit 15") or die(mysql_error());
$counter = 0;
?>
   <tbody>
<?php

while($income_rows=mysql_fetch_array($result)){
?>
<?php
if($income_rows['date']!='GRAND-TOTAL')
{
?>
<tr>
<td  bgcolor="#CC6633"><?php echo  $income_rows['date'] ; ?></td>
<td><?php echo money_format("%!n",$income_rows['ip']) ; ?></td>
<td><?php echo money_format("%!n",$income_rows['opl']) ; ?></td>
<td><?php echo money_format("%!n",$income_rows['opm']) ; ?></td>
<td><?php echo money_format("%!n",$income_rows['lab']) ; ?></td>
<td><?php echo money_format("%!n",$income_rows['scan']) ; ?></td>
<td><?php echo money_format("%!n",$income_rows['xray']) ; ?></td>
<td><?php echo money_format("%!n",$income_rows['ecg']) ; ?></td>
<td><?php echo money_format("%!n",$income_rows['others']) ; ?></td>
<td><?php echo money_format("%!n",$income_rows['total']) ; ?></td>



<td><a href="editincome.php<?php echo '?date='.$income_rows['date']; ?>" onclick="return confirm_edit()" >EDIT</a></td>
<td><a href="deleteincome.php<?php echo '?date='.$income_rows['date']; ?>" onclick="return confirm_delete()" >DELETE</a></td>
</tr>
<tr>
<?php
}
else
{
?>
<tr  bgcolor="#CC66CC">
<td><?php echo  $income_rows['date'] ; ?></td>
<td><?php echo money_format("%!n",$income_rows['ip']) ; ?></td>
<td><?php echo money_format("%!n",$income_rows['opl']) ; ?></td>
<td><?php echo money_format("%!n",$income_rows['opm']) ; ?></td>
<td><?php echo money_format("%!n",$income_rows['lab']) ; ?></td>
<td><?php echo money_format("%!n",$income_rows['scan']) ; ?></td>
<td><?php echo money_format("%!n",$income_rows['xray']) ; ?></td>
<td><?php echo money_format("%!n",$income_rows['ecg']) ; ?></td>
<td><?php echo money_format("%!n",$income_rows['others']) ; ?></td>
<td  bgcolor="#A00000"><b><?php echo money_format("%!n",$income_rows['total']) ; ?></b></td>

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
</body>
  <!-- /container -->
</body></html>	
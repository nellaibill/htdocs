<?php

include('globalfunctions.php');
$xFromDate=$GLOBALS ['xFromDate'];
$xToDate=$GLOBALS ['xToDate'];
?>
<head>
<title> VIEW INCOME B/W D</title>
<body>
  <div class="container">
<div id="divToPrint" >
<div class="container">
<div class="panel panel-info">
  <!-- Default panel contents -->
  <div class="panel-heading  text-center"><h3 class="panel-title">VIEW INCOMES AS ON  <?php echo date('d/M/Y',strtotime($GLOBALS ['xFromDate'])) ?> TO <?php echo date('d/M/Y',strtotime( $GLOBALS ['xToDate']))?></h3></div>
<table class="table table-hover" border="1">
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
  <th COLSPAN="2">ACTIONS</th>

        </tr>
      </thead>
 
 
      <tbody>


<?php

  
require_once('config.php');

$query2="SELECT *,(ip+opl+opm+lab+scan+xray+ecg+others) as total from income  WHERE date >= '".$xFromDate."' AND date<= '".$xToDate."' union all select 'GRAND-TOTAL',sum(ip),sum(opl),sum(opm),sum(lab),sum(scan),sum(xray),sum(ecg),sum(others),sum(ip+opl+opm+lab+scan+xray+ecg+others) from income  WHERE date >= '".$xFromDate."' AND date<= '".$xToDate."' order by date ; "; 
$result2=mysql_query($query2); 

while ($income_rows= mysql_fetch_array($result2)) {
?>
<?php
if($income_rows['date']!='GRAND-TOTAL')
{
?>
<tr>
<td  bgcolor="#CC6633"><?php echo  date('d/M/Y',strtotime($income_rows['date']))  ; ?></td>
<td><?php echo  fn_RupeeFormat($income_rows['ip']) ; ?></td>
<td><?php echo  fn_RupeeFormat($income_rows['opl']) ; ?></td>
<td><?php echo  fn_RupeeFormat($income_rows['opm']) ; ?></td>
<td><?php echo  fn_RupeeFormat($income_rows['lab']) ; ?></td>
<td><?php echo  fn_RupeeFormat($income_rows['scan']) ; ?></td>
<td><?php echo  fn_RupeeFormat($income_rows['xray']) ; ?></td>
<td><?php echo  fn_RupeeFormat($income_rows['ecg']) ; ?></td>
<td><?php echo  fn_RupeeFormat($income_rows['others']) ; ?></td>
<td><?php echo  fn_RupeeFormat($income_rows['total']) ; ?></td>
<td><a href="index.php<?php echo '?date='.$income_rows['date'] . '&xmode=edit'; ?>" onclick="return confirm_edit()" ><img src="images/edit.png"  style="width:30px;height:30px;border:0"></a></td>
<td><a href="index.php<?php echo '?date='.$income_rows['date'] . '&xmode=delete'; ?>" onclick="return confirm_delete()" ><img src="images/delete.png"  style="width:30px;height:30px;border:0"></a></td>
</tr>
<tr>
<?php
}
else
{
?>
<tr  bgcolor="#CC66CC">
<td><?php echo  $income_rows['date'] ; ?></td>
<td><?php echo  fn_RupeeFormat($income_rows['ip']) ; ?></td>
<td><?php echo  fn_RupeeFormat($income_rows['opl']) ; ?></td>
<td><?php echo  fn_RupeeFormat($income_rows['opm']) ; ?></td>
<td><?php echo  fn_RupeeFormat($income_rows['lab']) ; ?></td>
<td><?php echo  fn_RupeeFormat($income_rows['scan']) ; ?></td>
<td><?php echo  fn_RupeeFormat($income_rows['xray']) ; ?></td>
<td><?php echo  fn_RupeeFormat($income_rows['ecg']) ; ?></td>
<td><?php echo  fn_RupeeFormat($income_rows['others']) ; ?></td>
<td><b><?php echo  fn_RupeeFormat($income_rows['total']) ; ?></b></td>

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
   <th COLSPAN="2">ACTIONS</th>

        </tr>
</tbody>
    </table>	
  </div><!-- /container -->
</body></html>	
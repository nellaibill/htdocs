<?php
include 'globalfile.php';
$GLOBALS ['xDate'] = $GLOBALS ['xCurrentDate'];
?>
<!--             ----------------------- REPORT GOES HERE  ------------------------  !-->
<div id="divToPrint" >
<div class="panel panel-info">
  <!-- Default panel contents -->
  <div class="panel-heading  text-center"><h3 class="panel-title">SCAN REPORT AS ON <?php echo date('d/F/Y', strtotime($GLOBALS ['xDate'])); ?></h3></div>
<table class="table">
      <thead>
        <tr>
  <th width="5%">SL.NO</th>
  <th width="15%"> PATIENT NAME</th>
 <th width="15%"> DOCTOR NAME</th>
 <th width="15%"> TEST NAME</th>
 <th width="15%"> AMOUNT</th>
<th width="15%"> STATUS</th>
<th colspan="2" width="5%">ACTIONS</td>
        </tr>
      </thead>
      <tbody>

<?php
$xTotalAmount=0;
$xSlNo=1;
$xQry='';
$xDate=$GLOBALS ['xDate'];
$xQry="SELECT *  from t_scanbilling where date='$xDate'   order by  txno"; 
$result2=mysql_query($xQry);
$rowCount = mysql_num_rows($result2);
echo '</br>'; 

while ($row = mysql_fetch_array($result2)) {

    echo '<tr>';
    echo '<td>' . $xSlNo. '</td>';
    $xSlNo+=1;
    echo '<td>' . $row['saluation'] .$row['patientname']  . '</td>';
    findtesttypename( $row['testtypeno'] );
    finddoctorname( $row['doctorno'] );
    echo '<td>' .  $GLOBALS ['xDoctorName']  . '</td>';
    echo '<td>' .  $GLOBALS ['xTestTypeName']  . '</td>';
    echo '<td>' . $row['testamount']  . '</td>';
    echo '<td>' . $row['status']  . '</td>';
   $xTotalAmount+= $row['testamount'];
?>
<td><a href="ht008scan.php<?php echo '?txno='.$row['txno'] . '&xmode=update'; ?>"  onclick="return confirm_confirm()">
CONFIRM
</a>
</td>

<?
echo '</tr>'; 
} 
?>
<tr style='font-weight:bold;'>
<td></td>
<td></td>
<td></td>
<td colspan="2"> GRAND TOTAL </td>
<?php  echo '<td>' . $xTotalAmount . '</td>'; ?>
</tr>		
</tbody>
    </table>	
</div><!-- /PANEL -->
</div><!-- / TO PRINT-->
<!--             ----------------------- REPORT ENDS HERE  ------------------------  !-->
<?php
include 'globalfile.php';
?>
<!--             ----------------------- REPORT GOES HERE  ------------------------  !-->
<div id="divToPrint" >
<div class="container">
<div class="panel panel-info">
  <!-- Default panel contents -->
  <div class="panel-heading  text-center"><h3 class="panel-title">EXCESS STOCKS</h3></div>
<table class="table">
      <thead>
        <tr>
           <th width="5%">SL.NO</th>
           <th width="10%"> ITEMNAME</th>
           <th width="10%"> STOCK</th>
           <th width="10%"> MAX-STOCK</th>
           <th width="10%"> EXCESS</th>
<?php
if ($login_session == "admin") {
?>
<th colspan="2" width="5%">ACTIONS</th>
<?
}
?>

        </tr>
      </thead>
      <tbody>

<?php
$xQry='';
$xSlNo=0;
$xQry="SELECT itemno,stock,maxstock-stock as excess,maxstock FROM inv_stockentry  WHERE  maxstock>stock  order by  stockno"; 
$result2=mysql_query($xQry);
$rowCount = mysql_num_rows($result2);
echo '</br>'; 
while ($row = mysql_fetch_array($result2)) {
?>
<tr>
<?php 
    echo '<td>' .  $xSlNo+=1 . '</td>';
    finditemname($row['itemno']);
    echo '<td>' .  $GLOBALS ['xItemName']  . '</td>';
    echo '<td>' . $row['stock']  . '</td>';
    echo '<td>' . $row['maxstock']  . '</td>';
    echo '<td>' . $row['excess']  . '</td>';

                 if ($login_session == "admin") {

?>
<td><a href="inv_ht002stockentry.php<?php echo '?stockno='.$row['stockno'] . '&xmode=edit'; ?>"  onclick="return confirm_edit()">
  <img src="../images/edit.png" alt="HTML tutorial" style="width:30px;height:30px;border:0">
</a>
</td>
<td><a href="inv_ht002stockentry.php<?php echo '?stockno='.$row['stockno']. '&xmode=delete';  ?>"  onclick="return confirm_delete()">
  <img src="../images/delete.png" alt="HTML tutorial" style="width:30px;height:30px;border:0">
</a>
</td>

<?
}
echo '</tr>'; 
}
  
?>	
</tbody>
    </table>	
  </div><!-- /container -->
</div>
</div>
<!--             ----------------------- REPORT ENDS HERE  ------------------------  !-->
<?php
include 'globalfile.php';
?>
<!--             ----------------------- REPORT GOES HERE  ------------------------  !-->
<div id="divToPrint" >
<div class="container">
<div class="panel panel-info">
  <!-- Default panel contents -->
  <div class="panel-heading  text-center"><h3 class="panel-title">LOW STOCKS</h3></div>
<table class="table">
      <thead>
        <tr>
           <th width="5%">SL.NO</th>
           <th width="10%"> ItemName</th>
           <th width="10%"> Stock</th>
             <th width="10%"> Min Stock</th>

        </tr>
      </thead>
      <tbody>

<?php
$xQry='';
$xSlNo=0;
$xQry="SELECT itemno,sum(stock) as stock 
FROM inv_stockentry
group by itemno"; 
$result2=mysql_query($xQry);
$rowCount = mysql_num_rows($result2);
echo '</br>'; 
while ($row = mysql_fetch_array($result2)) {
	finditemname($row['itemno']);
	$xItemCurrentStock=$row['stock'];
	$xItemMinStock=$GLOBALS ['xMinStock'];
	if($xItemCurrentStock<$xItemMinStock)
	{
?>
<tr>
<?php  
   echo '<td>' .  $xSlNo+=1 . '</td>';
   
    echo '<td>' .  $GLOBALS ['xItemName']  . '</td>';
    echo '<td>' .$xItemCurrentStock . '</td>';
    echo '<td>' .   $xItemMinStock  . '</td>';

echo '</tr>'; 
}}
  
?>	
</tbody>
    </table>	
  </div><!-- /container -->
</div>
</div>
<!--             ----------------------- REPORT ENDS HERE  ------------------------  !-->
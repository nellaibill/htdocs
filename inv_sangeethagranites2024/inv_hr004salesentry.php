<?php
 include 'globalfile.php';
 $xFromDate=$GLOBALS ['xInvFromDate'];
 $xToDate=$GLOBALS ['xInvToDate'];
fn_DataClear();
function fn_DataClear()
{
$_GET['form']='';
}
?>

<div id="divToPrint" >
<div class="container">

<?php
$xSlNo=0;
$xAmount=0;
 $xQryFilter=''; 
 
$xQry="SELECT *  from inv_salesentry where salesinvoiceno>0 $xQryFilter order by salesinvoiceno;"; 
//echo $xQry;
$result2=mysql_query($xQry);
?>
<div class="panel panel-info">
  <!-- Default panel contents -->
  <div class="panel-heading  text-center"><b><?php echo "Sales Report  From[".date('d/M/y', strtotime($xFromDate))."]TO [".date('d/M/y', strtotime($xToDate))."] As On ". date("d/M/y h:i:sa"); ?></b></div>
<table class="table table-hover" border="1" >
      <thead>
        <tr>


           <th width="25%">ITEM NAME</th>
           <th width="10%">QTY</th>
           <th width="20%">UNITRATE</th>
           <th width="20%" align=right>AMOUNT</th>
           	           <th width="10%">Inv/Track</th>

          </tr>
      </thead>

    <tfoot>
        <tr>



           <th width="25%">ITEM NAME</th>
           <th width="10%">QTY</th>
           <th width="20%">UNITRATE</th>
           <th width="20%" align=right>AMOUNT</th>
                  	           <th width="10%">Inv/Track</th>
          </tr>
      </tfoot>
      <tbody>

<?php
$xQty=0;
if(mysql_num_rows($result2)){
while ($row = mysql_fetch_array($result2)) {
?>
<tr>
<?php 
    finditemname($row['itemno']);
 echo  '<td>'.$GLOBALS['xItemName'] . '</td>';
    echo '<td>' . $row['qty']  . '</td>';
    echo '<td>' . $row['unitrate']  . '</td>';
    echo '<td align=right>' . $row['amount']  . '</td>';
    echo '<td>' . $row['salesinvoiceno'] ." / ".$row['txno']  . '</td>';
   
	$xQty+= $row['qty'] ;
	$xAmount+= $row['amount'] ;
echo '</tr>'; 
}
echo '<tr>';
    echo '<td colspan=3></td>';
	 echo '<td align=right>' . $xAmount. '</td>';
	 echo '<td colspan=3></td>';
echo '</tr>'; 
}

else 
 {     
    fn_NoDataFound();
 }
  
?>	
</tbody>
    </table>	
  </div><!-- /container -->
</div></div>
</body></html>	
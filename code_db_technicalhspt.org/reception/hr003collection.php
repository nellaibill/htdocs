<?php
include('globalfile.php');
if($login_session=="admin")
{
$xFromDate=$GLOBALS ['xFromDate'];
$xToDate=$GLOBALS ['xToDate'];
}
else
{
$xFromDate=$GLOBALS ['xCurrentDate'];
$xToDate=$GLOBALS ['xCurrentDate'];
}

?>
<html>
<title> VIEW -COLLECTION </title>
<form action="hr003collection.php" method="post">
<center><h3 id="headertext">VIEW ALL COLLECTION </h3></center>
<?php
if($login_session=="admin")
{
?>
<select name="collectiontype">
<option value="advance">ADVANCE</option>
<option value="receipt">RECEIPT</option>
<option value="BOTH">BOTH</option>
</select>
<!-- we are going update some values to zero !-->
<input type="submit" value="DELETE" name='delete' width="75" height="48"  class="btn btn-danger" >
<?php
}
else
{
?>


<?php
}
?>
</form>
<body>
<div id="divToPrint" >
  <div class="container">

<table class="table table-hover" border="1" id="lastrow">
      <thead>
        <tr>
          <th width="20%"> DATE </th>
           <th width="20%"> ADVANCE</th>
          <th width="10%">RECEIPT</th>
           <th width="10%">EXPENSES</th>
           <th width="10%"> OTHERS</th>
          <th width="20%">TOTAL</th>
<th colspan="2" width="5%">ACTIONS</td>

        </tr>
      </thead>
 
 
      <tbody>

<?php
require_once('config.php');
$total=0;
$xCollectionType=$_POST['collectiontype'];
$xQry='';
if (isSet($_POST['delete'])) {
if($xCollectionType=="BOTH")
{
$xQry="update collection  set receipt=0,advance=0  WHERE date >= '".$xFromDate."' 
		 AND date<= '".$xToDate."'";
}
else
{
$xQry="update collection  set ".$xCollectionType."=0  WHERE date >= '".$xFromDate."' 
		 AND date<= '".$xToDate."'";
}
$result2=mysql_query($xQry);
}
else {

if($login_session=="admin")
{
$query2="SELECT txno,date ,advance,receipt,expenses,others,nettotal,optradio  from collection WHERE date >= '".$xFromDate."' 
		 AND date<= '".$xToDate."' order by date ; "; 
}
else
{
$query2="SELECT txno,date ,advance,receipt,expenses,others,nettotal,optradio  from collection WHERE date >= '".$GLOBALS ['xCurrentDate']."' 
		 AND date<= '".$GLOBALS ['xCurrentDate']."' order by date ; "; 
}

$result2=mysql_query($query2);
ReportHeader("OUTPATIENT DETAILS");
while ($row = mysql_fetch_array($result2)) {
echo '<tr>';
echo '<td>' . date('d-M-Y',strtotime($row['date']))  . '</td>';
echo '<td align=right>' . money_format("%!n", $row['advance'])  . '</td>';
echo '<td align=right>' . money_format("%!n", $row['receipt']) . '</td>';
echo '<td align=right>' . money_format("%!n", $row['expenses']) . '</td>';
echo '<td align=right>' . $row['optradio'] . ' ' . money_format("%!n", $row['others']).'</td>';
echo '<td align=right>' . money_format("%!n", $row['nettotal']) . '</td>';
$total+= $row['nettotal'] ;
if ($login_session == "admin") {
	?>
	<td><a href="ht002collection.php<?php echo '?txno='.$row['txno'] . '&xmode=edit'; ?>"  onclick="return confirm_edit()"> <img src="../images/edit.png" alt="HTML tutorial" style="width:30px;height:30px;border:0"></a></td>
	<td><a href="ht002collection.php<?php echo '?txno='.$row['txno']. '&xmode=delete';  ?>"  onclick="return confirm_delete()"> <img src="../images/delete.png" alt="HTML tutorial" style="width:30px;height:30px;border:0"></a></td>
	<?
	}
echo '</tr>'; 
}
echo '<tr>';
echo '<td colspan=5>GRAND-TOTAL</td>';
echo '<td align=right>' . money_format("%!n", $total) . '</td>';
echo '</tr>'; 
}
?>	

</tbody>


    </table>	
  </div><!-- /container -->
</div>
</body></html>	
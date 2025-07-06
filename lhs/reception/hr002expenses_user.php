<?php
include('globalfile.php');
$GLOBALS ['xCurrentDate']=date('Y-m-d');
$GLOBALS ['xProductName']=$_POST['productname'];
$xFromDate=$GLOBALS ['xFromDate'];
$xToDate=$GLOBALS ['xToDate'];
?>
<html>
<title> V-EXP B/W D& P </title>
<form action="hr002expenses_user.php" method="post">
<div class="form-group">
<label for="lbltxno" class="control-label col-xs-2">CHOOSE GROUP</label>
<div class="col-xs-4">
<select class="form-control" id="sc" value="" name="productname">
<?php
$result = mysql_query("SELECT *  FROM expenses_group where exgrpno in(7,15)");
while($row = mysql_fetch_array($result))
{
?>
<option value = "<?php echo $row['exgrpname']; ?>" 
<?php
  if ($row['exgrpname']== $GLOBALS ['xGroupName'])
  {
      echo 'selected="selected"';
   } 
    ?> >
 <?php echo $row['exgrpname']; ?> 
  </option>
<?
  }
  echo "</select>";

?>
</div>
</div>
<input type="submit" value="VIEW" name='view' width="75" height="48"  class="btn btn-primary" >
<input type="submit" value=".   ." name='delete' width="75" height="48"  class="btn btn-danger" >
</form>
<br>
<div class="input-group"> <span class="input-group-addon">Filter</span>
  <input id="filter" type="text" class="form-control" placeholder="Search here...">
</div>
<div id="divToPrint" >
<div class="panel panel-success">
<div class="panel-heading">

<b><h3 class="panel-title text-center"><?php echo "Expenses From " .date(' d/M/y', strtotime($xFromDate)) . " TO " .date(' d/M/y', strtotime($xToDate)) . " As On ". date("d/M/y h:i:sa"); ?></h3></b>
</div>
<div class="panel-body">
<div class="container">

<?php
$total=0;
$xSlNo=0;
$product=$_POST['productname'];
require_once('config.php');
if (isSet($_POST['view'])) {
if($product=='All')
{
$query2="SELECT txno,date , groupname as name ,details,amount  from dailyexpenses WHERE date >= '".$xFromDate."' 
		 AND date<= '".$xToDate."'  union all select '','TOTAL','','',sum(amount)  from dailyexpenses 
		 WHERE date >= '".$xFromDate."' 
		 AND date<= '".$xToDate."' order by date ; "; 
}
else
{

$query2="SELECT txno,date , groupname as name ,details,amount  from dailyexpenses WHERE date >= '".$xFromDate."' 
		 AND date<= '".$xToDate."' and groupname='".$_POST['productname']."' union all select '','GRAND-TOTAL','','',sum(amount)  from dailyexpenses 
		 WHERE date >= '".$xFromDate."' 
		 AND date<= '".$xToDate."' and groupname='".$_POST['productname']."' order by date ; "; 
}

$result2=mysql_query($query2);
echo "<table class='table table-hover' border='1' id='lastrow'>
      <thead>
        <tr>
          <th> S.NO</th>
          <th> TXNO</th>
          <th> DATE </th>
          <th>SELECTED NAME</th>
          <th> DETAILS</th>
          <th >AMOUNT</th>
        </tr>
      </thead>
      <tbody class=searchable>";

while ($row = mysql_fetch_array($result2)) {
    echo '<tr>';
    echo '<td>' . $xSlNo+=1 . '</td>';
    echo '<td>' . $row['txno']  . '</td>';
    echo '<td>' . date('d/M/y', strtotime($row['date']))   . '</td>';
?>
<td><a href="hr002expenses_old.php<?php echo '?name='.$row['name'] . '&xmode=edit'; ?>"  onclick="basicPopup(this.href);return false"> <?php echo  $row['name']?>
</a>  </td>
<?php
   //echo '<td>' . $row['name']  . '</td>';
    echo '<td>' . $row['details']  . '</td>';
    echo '<td align="right">' .money_format("%!n", $row['amount']) . '</td>';
if ($login_session == "admin") {
	?>
	<td><a href="ht007expenses.php<?php echo '?txno='.$row['txno'] . '&xmode=edit'; ?>"  onclick="return confirm_edit()"> <img src="../images/edit.png" alt="HTML tutorial" style="width:30px;height:30px;border:0"></a></td>
	<td><a href="ht007expenses.php<?php echo '?txno='.$row['txno']. '&xmode=delete';  ?>"  onclick="return confirm_delete()"> <img src="../images/delete.png" alt="HTML tutorial" style="width:30px;height:30px;border:0"></a></td>
	<?
	}
    echo '</tr>'; 
}
    echo '</tbody>';
    echo '</table>';
}

if (isSet($_POST['delete'])) {

if($product=='All')
{
//$query2="delete  from dailyexpenses WHERE date >= '".$_POST['fromdate']."' 
		// AND date<= '".$_POST['todate']."' "; 
}
else
{

$query2="delete from dailyexpenses WHERE date >= '".$xFromDate."' 
		 AND date<= '".$xToDate."' and groupname='".$_POST['productname']."' "; 
}

$result2=mysql_query($query2);


}
if (isSet($_POST['consolidated'])) {

$query2="select groupname as name,sum(amount) as amount  from dailyexpenses  where date>= '".$xFromDate."' 
		 AND date<= '".$xToDate."'  group by groupname order by date"; 
$result2=mysql_query($query2);
echo "<table class='table table-hover' border='1'>
      <thead>
        <tr>
          <th >NAME</th>
          <th >AMOUNT</th>
        </tr>
      </thead>
      <tbody>";
   while ($row = mysql_fetch_array($result2)) 
   {
    echo '<tr>';
    echo '<td>' . $row['name']  . '</td>';
    echo '<td align="right">' .money_format("%!n", $row['amount']) . '</td>';
    $total+= $row['amount'] ;
    echo '</tr>'; 


    }
    echo '<tr bgcolor=#5D7B9D>';
    $xEmpty ='GRAND -TOTAL';
    echo '<td>' . $xEmpty . '</td>';
    echo '<td align="right">' . money_format("%!n", $total) . '</td>';
    echo '</tr>';
    echo '</tbody>';
    echo '</table>';
}
?>	
</div>
</div>
</div>
</body>
</form></html>	

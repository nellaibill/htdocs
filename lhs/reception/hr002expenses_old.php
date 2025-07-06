<?php
include 'session.php';
include 'globalfunctions.php';
  $xName= $_GET['name'];
?>

<html>
<title> V-SALES</title>
<head><link href="bootstrap.css" rel="stylesheet">
<link href="css/reportstyle.css" rel="stylesheet">

</head>
<body>
 
<div id="divToPrint" >
<div class="container">

<?php
$xSlNo=0;
$xGrandQty=0;

$xQry="SELECT *  from dailyexpenses where groupname='$xName' order by date desc limit 10;";  
//echo $xQry;
$result2=mysql_query($xQry);
?>
<div class="panel panel-info">
  <!-- Default panel contents -->
  <div class="panel-heading  text-center"><b><h3 class="panel-title text-center"><?php echo "Last Ten Entries" ?></h3></b></div>
<table class="table table-hover" border="1" >
      <thead>
       <tr>
          <th> S.NO</th>
          <th> TXNO</th>
          <th> DATE </th>
          <th>SELECTED NAME</th>
          <th> DETAILS</th>
          <th >AMOUNT</th>
          <th colspan=2>ACTIONS</th>
        </tr>
      </thead>
      <tbody>

<?php
while ($row = mysql_fetch_array($result2)) {
    echo '<tr>';
    echo '<td>' . $xSlNo+=1 . '</td>';
    echo '<td>' . $row['txno']  . '</td>';
    echo '<td>' . date('d/M/y', strtotime($row['date']))   . '</td>';
    echo '<td>' . $row['groupname']  . '</td>';
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
?>	
</tbody>
    </table>	
  </div><!-- /container -->
</div></div>
</body></html>	
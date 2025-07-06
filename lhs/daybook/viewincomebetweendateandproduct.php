<?php
include('globalfunctions.php');
$xFromDate=$GLOBALS ['xFromDate'];
$xToDate=$GLOBALS ['xToDate'];
?>
<html>
<title> VIEW INCOME B/W D& P</title>
<head>
<link href="bootstrap.css" rel="stylesheet">
</head>
<body>

<form action="viewincomebetweendateandproduct.php" method="post">
<div class="col-xs-3">
<select id="sc" name="productname" class="form-control">
    <option value="ip">IP</option>
    <option value="opl">OPL</option>
    <option value="opm">OPM</option>
    <option value="lab">LAB</option>
    <option value="scan">SCAN</option>
    <option value="xray">XRAY</option>
    <option value="ecg">ECG</option>
    <option value="others">OTHERS</option>
</select>
</div>
 <input type="submit"  name="sentForm"   class="btn btn-primary" value="VIEW" id="save"> 
  <div class="container">
<div id="divToPrint" >
<div class="container">
<div class="panel panel-info">
  <!-- Default panel contents -->
  <div class="panel-heading  text-center"><h3 class="panel-title">VIEW INCOMES AS ON  <?php echo date('d/M/Y',strtotime($GLOBALS ['xFromDate'])) ?> TO <?php echo date('d/M/Y',strtotime( $GLOBALS ['xToDate']))?> GENERATED ON <?php echo date('d/M/Y h:i:s',strtotime( $GLOBALS ['xCurrentDate']))?></h3>
</div>
<table class="table table-hover" border="1">
      <thead>
        <tr>
          <th width="20%"> DATE </th>
          <th width="20%">SELECTED NAME(AMOUNT)</th>

        </tr>
      </thead>
 
 
      <tbody>

<?php
$total=0;
if (isSet($_POST['sentForm'])) {
require_once('config.php');

$query2="SELECT date , ".$_POST['productname']." as name from income WHERE date >= '".$xFromDate."' 
		 AND date<= '".$xToDate."' union all select 'GRAND-TOTAL',sum( ".$_POST['productname'].") from income 
		 WHERE date >= '".$xFromDate."' 
		 AND date<= '".$xToDate."' order by date ; "; 
$result2=mysql_query($query2); 
while ($row = mysql_fetch_array($result2)) {
    echo '<tr>';
    echo '<td>' . date('d/M/Y',strtotime($row['date'])) . '</td>';
    echo '<td align=right>' .  fn_RupeeFormat($row['name']) . '</td>';
    $total+= $row['name'] ;
	echo '</tr>'; 
	
	 
}
}
?>	

</tbody>


    </table>	
  </div><!-- /container -->
</form>
</body></html>	
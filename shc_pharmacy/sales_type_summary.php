<?php
include 'globalfile.php';
$xFromDate = '';
$xToDate = '';
$xNetTotalCase=0;
$xNetTotal=0;
$xType='';
if (isset($_GET ['type']) && !empty($_GET ['type'])) {
    $xType = $_GET ['type'];
}

?>
<html>
<head>
<style>
td,thead {
 text-align: right;	
}
.footer{
	 background-color:black;
  border-color: #337ab7;
  color: red;
  font-weight: bold;
}
</style>
<?php include 'title.php'?>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
</br>
<div class="container">

<form action="sales_type_summary.php?type=<?php echo $xType ?>" method="post">

<div class="panel-body">
<div class="form-group">


<div class="col-xs-3">
<label>From Date:</label>
<input type="date" class="form-control"  name="f_fromdate" value="<?php echo $xFromDate; ?>">
</div>

<div class="col-xs-3">
<label>To Date:</label>
<input type="date" class="form-control"  name="f_todate" value="<?php echo $xToDate; ?>">
</div>
<div class="col-xs-3">
</BR>
  <input type="submit"  name="view"   class="btn btn-primary" value="VIEW REPORT" >
</div>



</div><!-- Form-Group !-->
</div><!-- Panel Body !-->
</form>

<?php
 if (isSet($_POST['view'])) 
    {
   $xFromDate=$_POST['f_fromdate'];
   $xToDate= $_POST['f_todate'];
$xSlNo = 0;	
$xQry = "SELECT DATE_FORMAT( DATE, '%M-%Y' ) AS month_year, 
SUM( totalamount-lessamount ) AS total_amount,count(DISTINCT(customerno) ) AS count
FROM inv_salesentry1
WHERE termsofdelivery = '$xType'
AND DATE >= '$xFromDate'
AND DATE <= '$xToDate'
GROUP BY YEAR( DATE ) , MONTH( DATE )";
}
else {
	$xQry = "SELECT DATE_FORMAT( DATE, '%M-%Y' ) AS month_year, 
SUM( totalamount-lessamount ) AS total_amount,count(DISTINCT(customerno) ) AS count
FROM inv_salesentry1
WHERE termsofdelivery = '$xType'
AND DATE >= '2015-01-01'
AND DATE <= '2020-12-31'
GROUP BY YEAR( DATE ) , MONTH( DATE )";
}
//echo $xQry;
$result2 = mysql_query ( $xQry );

?>
<div id="divToPrint">
<h1><?php echo $xType ?> SUMMARY REPORT</h1>
<table  class="table table-striped  table-bordered" width="50%">
						<thead class="thead-dark">
							<tr>
								<th width="20%">Month/Year</th>
								<th width="10%" >Total <?php echo $xType ?></th>
								<th width="10%"><?php echo $xType ?>SALES</th>
							</tr>
						</thead>
						<tbody>
<?php
while ( $row = mysql_fetch_array ( $result2 ) ) {
	echo '<tr>';
	echo '<td>' . $row ['month_year'] . '</td>';
	echo '<td>' . $row ['count'] . '</td>';
	echo '<td>' . $row ['total_amount'] . '</td>';
	$xNetTotalCase+=$row ['count'];
	$xNetTotal+=$row ['total_amount'];
	?>
<?php
	echo '</tr>';
}
	    echo '<tr class=footer>';	
		echo '<td>Net Total</td>';
		echo '<td>' .$xNetTotalCase . '</td>';
		echo '<td>' .fn_RupeeFormat($xNetTotal) . '</td>';
		echo '</tr>';
?>	
</tbody>
</table>
</div>

</div>

</body>
</html>

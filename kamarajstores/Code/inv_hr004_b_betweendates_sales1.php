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


<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<div class="panel panel-success">
<div class="panel-heading text-center">FILTER[GROUP]
<div class="btn-group pull-right">
          <input type="submit"  name="save"   class="btn btn-primary" value="VIEW" >
      </div>
</div>
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




</div><!-- Form-Group !-->
</div><!-- Panel Body !-->
</div><!-- Panel !-->
</form>
<html>
<title> V-SALES</title>
<head><link href="bootstrap.css" rel="stylesheet">
<link href="css/reportstyle.css" rel="stylesheet">

</head>
<body>
 
<div id="divToPrint" >
<div class="container">
  <div class="panel-heading  text-center"><b>
  <?php echo "Sales Details Report  From[".date('d/M/y', strtotime($xFromDate))."]TO [".date('d/M/y', strtotime($xToDate))."] As On ". date("d/M/y h:i:sa");?></b></div>
<div class="col-xs-6">
<?php
$xSlNo=0;
$xGrandTotalForSales=0;
 $xQryFilter=''; 
 if (isSet($_POST['save'])) 
    {
   $xFromDate=$_POST['f_fromdate'];
   $xToDate= $_POST['f_todate'];

$xQry="SELECT date,sum(totalamount)as totalamount FROM inv_salesentry1 where date>='$xFromDate' and date<='$xToDate' group by date";
$result2=mysql_query($xQry);
?>
<div class="panel panel-info">
  <!-- Default panel contents -->

<table class="table table-hover" border="1" >
     <thead>
        <tr>
           <th>Date</th>
			<th >Sales Amount</th>
          </tr>
      </thead>

    <tfoot>
      <tbody>

<?php

while ($row = mysql_fetch_array($result2)) {

    echo '<tr>';

	echo '<td align=left>' . date('d/M/y', strtotime($row['date']))   . '</td>';
	echo '<td align=right>' . $row['totalamount']  . '</td>';
	$xGrandTotalForSales+=$row['totalamount'] ;
}
echo '</tr>'; 
echo '<tr>';
echo '<td  align=right> GRAND TOTAL</td>';
echo '<td align=right>' . fn_RupeeFormat($xGrandTotalForSales) . '</td>';
echo '</tr>';


	}
?>	

</tbody>
    </table>	
  </div><!-- /container -->
</div>

<div class="col-xs-6">
<?php
$xSlNo=0;
$xGrandTotalForSalesReturn=0;
 $xQryFilter=''; 
 if (isSet($_POST['save'])) 
    {
   $xFromDate=$_POST['f_fromdate'];
   $xToDate= $_POST['f_todate'];

$xQry="SELECT t1.credit_note_date as date,sum(qty*mrp)as totalamount FROM accounts_credit_note as t1 
where t1.credit_note_date>='$xFromDate' and t1.credit_note_date<='$xToDate' group by t1.`credit_note_date`";
$result2=mysql_query($xQry);
?>
<div class="panel panel-info">
  <!-- Default panel contents -->

<table class="table table-hover" border="1" >
     <thead>
        <tr>
           <th>Date</th>
			<th >Sales Return</th>
          </tr>
      </thead>

    <tfoot>
      <tbody>

<?php

while ($row = mysql_fetch_array($result2)) {

    echo '<tr>';

	echo '<td align=left>' . date('d/M/y', strtotime($row['date']))   . '</td>';
	echo '<td align=right>' . $row['totalamount']  . '</td>';
	$xGrandTotalForSalesReturn+=$row['totalamount'] ;
}
echo '</tr>'; 
echo '<tr>';
echo '<td  align=right> GRAND TOTAL</td>';
echo '<td align=right>' . fn_RupeeFormat($xGrandTotalForSalesReturn) . '</td>';
echo '</tr>';


	}
	

?>	

</tbody>
    </table>	
  </div>
  <?php
  	$xNetAmount=$xGrandTotalForSales-$xGrandTotalForSalesReturn;
	echo " <h1>Net Amount-".fn_RupeeFormat($xNetAmount)."</h1>";
	?>
</div></div>
</div>
</body></html>	
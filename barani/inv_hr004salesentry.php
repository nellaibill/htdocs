<?php
 include 'globalfile.php';
fn_DataClear();
 $xDate=date ( 'Y-m-d' );
function fn_DataClear()
{
$_GET['form']='';
$GLOBALS ['xItemName']='';
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
<input type="date" class="form-control"  name="f_fromdate" value="<?php echo $xDate; ?>">
</div>

<div class="col-xs-3">
<label>To Date:</label>
<input type="date" class="form-control"  name="f_todate" value="<?php echo $xDate; ?>">
</div>


			<div class="col-xs-6">
					<label>Item Name:</label> <select class="form-control"
						name="f_itemno">
						<option value="0">Choose Item</option>
<?php
global $con;
$result = mysqli_query ( $con, "SELECT *  FROM m_item as i order by i.itemname" );
while ( $row = mysqli_fetch_array ( $result ) ) {
	?>
<option value="<?php echo $row['itemname']; ?>"
							<?php
	if ($row ['itemname'] == $GLOBALS ['xItemName']) {
		echo 'selected="selected"';
	}
	?>>
	
 <?php echo $row['itemname']?> 
</option>
<?php
}
?>
</select>

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

<?php
$xSlNo=0;
$xTotalAmount=0;
 $xQryFilter=''; 
 if (isSet($_POST['save'])) 
    {
   $xFromDate=$_POST['f_fromdate'];
   $xToDate= $_POST['f_todate'];
   $xItemNo=$_POST['f_itemno'];
   if (empty ( $_POST ['f_salesinvoiceno'] )) {
	$xSalesInvoiceNo = 0;
   } 

$xQry="SELECT *  from inv_sales where date>= '$xFromDate' AND date<= '$xToDate'"; 
//echo $xQry;
$result2=mysqli_query($con, $xQry);
    
?>
<div class="panel panel-info">
  <!-- Default panel contents -->
  <div class="panel-heading  text-center"><b><?php echo "Sales Report  From[".date('d/M/y', strtotime($xFromDate))."]TO [".date('d/M/y', strtotime($xToDate))."] As On ". date("d/M/y h:i:sa"); ?></b></div>
<table class="table table-hover" border="1" >
      <thead>
         <tr>
          <th width="5%">S.NO</th>
           <th width="10%">Date</th>
		   <th width="10%">PrintBillNo</th>
           <th width="20%">CustomerName</th>
           <th width="10%">Plan</th>
                      <th width="10%">Details</th>
           <th width="10%">Days</th>
           <th width="10%">Amount</th>
           						<th width="10%" colspan="4">	Actions</th>
           	          
          </tr>
      </thead>

      <tbody>

<?php
$xQty=0;
if(mysqli_num_rows($result2)){
while ($row = mysqli_fetch_array($result2)) {
?>
<tr>
<?php 

    echo '<td>' . $xSlNo+=1  . '</td>';
    echo '<td>' . date('d/M/y', strtotime($row['date'])). '</td>';
    findcustomername ($row['customerno']); 
	echo '<td>' . $row['print_bill_no']  . '</td>';
    echo '<td>' . $GLOBALS ['xCustomerName']  . '</td>';
    echo '<td>' . $row['itemname']  . '</td>';
    echo '<td>' . $row['particulars']  . '</td>';
    echo '<td>' . $row['qty']  . '</td>';
    echo '<td>' . $row['totalamount']  . '</td>';
    $xTotalAmount+=$row['totalamount'];
?>

<td><a href="inv_ht004salesentry.php<?php echo '?salesinvoiceno='.$row['salesinvoiceno'] . '&xmode=edit'; ?>"  onclick="return confirm_edit()">
  <img src="images/edit.png" alt="HTML tutorial" style="width:30px;height:30px;border:0">
</a>
</td>
<td><a href="inv_ht004salesentry.php<?php echo '?salesinvoiceno='.$row['salesinvoiceno']. '&xmode=delete';  ?>"  onclick="return confirm_delete()">
  <img src="images/delete.png" alt="HTML tutorial" style="width:30px;height:30px;border:0">
</a>
</td>
<td><a
								href="printOrder1.php<?php echo '?salesinvoiceno='.$row['salesinvoiceno'];  ?>"
								onclick="return confirm_delete()"> <img src="images/print.jpg"
									style="width: 30px; height: 30px; border: 0">
							</a></td>
							<td><a
								href="printOrder2.php<?php echo '?salesinvoiceno='.$row['salesinvoiceno'];  ?>"
								onclick="return confirm_delete()"> <img src="images/print.jpg"
									style="width: 30px; height: 30px; border: 0">
							</a></td>
							<td><a href="inv_ht004salesentry.php<?php echo '?salesinvoiceno='.$row['salesinvoiceno']. '&xmode=delete';  ?>"  onclick="return confirm_delete()">
  <img src="images/delete.png" alt="HTML tutorial" style="width:30px;height:30px;border:0">
</a>

<?php
echo '</tr>'; 
}
echo '<tr>';
    echo '<td colspan=7></td>';
	 echo '<td>' . $xTotalAmount. '</td>';
	 echo '<td colspan=3></td>';
echo '</tr>'; 
}

else 
 {     
    echo "No Records Found";
 }
    }
?>	
</tbody>
    </table>	
  </div><!-- /container -->
</div></div>
</body></html>
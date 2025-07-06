<?php
include 'globalfile.php';
$GLOBALS ['xInvoiceDate']=$GLOBALS ['xCurrentDate'];
fn_DataClear();
if ( isset( $_GET['txno'] ) && !empty( $_GET['txno'] ) )
{
$no= $_GET['txno'];

if($_GET['xmode']=='edit')
{
$GLOBALS ['xMode']='F';
DataFetch ( $_GET['txno']);
}
else
{         
  $xOldQty=$_GET['qty'];
  $xItemNo=$_GET['itemno'];
  $xExcessShortageName=$_GET['excessshortagename'];
  $xQry = "DELETE FROM inv_excessshortage WHERE txno= $no";

 if($xExcessShortageName=='Excess')
  {
  $xStockUpdateQry="update inv_stockentry set stock=stock-$xOldQty where itemno=$xItemNo";
  } 
 else if($xExcessShortageName=='Shortage')
  {
  $xStockUpdateQry="update inv_stockentry set stock=stock+$xOldQty where itemno=$xItemNo";
  } 
  mysql_query ($xQry) or die ( mysql_error () );
  mysql_query ($xStockUpdateQry) or die ( mysql_error () );
  echo '<script type="text/javascript">swal("Good job!", "Deleted!", "success");</script>';
  header('Location: inv_ht007_excess_shortage.php'); 	
}
}
elseif (isset ( $_POST ['save'] ))
{

DataProcess ( "S");
}
elseif (isset ( $_POST ['update'] )) 
{
DataProcess ( "U" );
}
else
{
fn_GetMaxIdNo();
}
function fn_DataClear()
{
			$GLOBALS ['xtxno'] ='';
			$GLOBALS ['xInvoiceNo'] = '';
			$GLOBALS ['xInvoiceDate'] ='';
			$GLOBALS ['xItemNo'] = '';
			$GLOBALS ['xBatchNo'] = '';
			$GLOBALS ['xExcessShortageName'] = '';
			$GLOBALS ['xExcessShortageQty'] ='';
			$GLOBALS ['xDescription'] ='';
}

function fn_GetMaxIdNo() {
$xQry="SELECT  CASE WHEN max(txno)IS NULL OR max(txno)= '' THEN '1' ELSE max(txno)+1 END AS txno FROM inv_excessshortage";
$result = mysql_query ($xQry) or die ( mysql_error () );
while ( $row = mysql_fetch_array ( $result ) ) {
	$GLOBALS ['xtxno'] = $row ['txno'];
			$GLOBALS ['xMobileNo']=0;
}
}

function DataFetch($xtxno) {
$result = mysql_query ( "SELECT *  FROM inv_excessshortage where txno=$xtxno" ) or die ( mysql_error () );
$count = mysql_num_rows($result);
if($count>0){
while ( $row = mysql_fetch_array ( $result ) ) {
			$GLOBALS ['xtxno'] = $row ['txno'];
			$GLOBALS ['xInvoiceNo'] = $row ['invoiceno'];
			$GLOBALS ['xInvoiceDate'] = $row ['invoicedate'];
			$GLOBALS ['xItemNo'] = $row ['itemno'];
			$GLOBALS ['xBatchNo'] = $row ['batchno'];
			$GLOBALS ['xExcessShortageName'] = $row ['excessshortagename'];
			$GLOBALS ['xExcessShortageQty'] = $row ['excessshortageqty'];
			$GLOBALS ['xDescription'] = $row ['description'];
		}
}
}

function DataProcess($mode) {
$xtxno= $_POST ['f_txno'];
$xInvoiceNo= strtoupper($_POST ['f_invoiceno']);
$xInvoiceDate= $_POST ['f_invoicedate'];
$xItemNo= $_POST ['f_itemno'];
if(empty($_POST['f_batchno'])){
$xBatchNo= 0;
}      
else $xBatchNo= $_POST ['f_batchno'];
$xExcessShortageName= $_POST ['f_excessshortagename'];
$xExcessShortageQty= $_POST ['f_excessshortageqty'];
$xDescription= $_POST ['f_description'];

$xQry="";
$xMsg="";

if ($mode == 'S') 
{
$xQry = "INSERT INTO inv_excessshortage  VALUES ($xtxno,'$xInvoiceNo','$xInvoiceDate',$xItemNo,'$xBatchNo','$xExcessShortageName',$xExcessShortageQty,'$xDescription')";
if($xExcessShortageName=='Excess')
{
$xStockUpdateQry="update inv_stockentry set stock=stock+$xExcessShortageQty where itemno=$xItemNo";
} 
else if($xExcessShortageName=='Shortage')
{
$xStockUpdateQry="update inv_stockentry set stock=stock-$xExcessShortageQty where itemno=$xItemNo";
} 
  echo '<script type="text/javascript">swal("Good job!", "Inserted!", "success");</script>';
} 
/*
elseif ($mode == 'U')
{
$xQry = "UPDATE inv_excessshortage   SET invoiceno='$xInvoiceNo',invoicedate='$xInvoiceDate',itemno=$xItemNo,batchno='$xBatchNo',excessshortagename='$xExcessShortageName',excessshortageqty=$xExcessShortageQty,description='$xDescription' WHERE txno=$xtxno";
  echo '<script type="text/javascript">swal("Good job!", "Updated!", "success");</script>';
} 
*/
mysql_query ( $xQry ) or die ( mysql_error () );
mysql_query ($xStockUpdateQry) or die ( mysql_error () );
fn_GetMaxIdNo();
ShowAlert($xMsg);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Excess/Shortage</title>
</head>
<script type="text/javascript">
function validateForm() 
{

var xInvoiceNo= document.forms["excessshortageform"]["f_invoiceno"].value;
if (xInvoiceNo== null || xInvoiceNo== "") 
{
	alert("Invoice-No must be filled out");
	document.excessshortageform.f_invoiceno.focus();
	return false;
}


}
</script>
<body onload='document.excessshortageform.f_invoiceno.focus()'> 
<form class="form" name="excessshortageform" action="<?php echo $_SERVER['PHP_SELF']; ?>"method="post">
<div class="panel panel-primary">
<div class="panel-heading  text-center">
	<h3 class="panel-title">Excess Shortage Form</h3>
	</div>
</div>

<div class="panel-body">

<div class="col-xs-2" >
<label>TxNo:</label>
<input type="text" class="form-control"  name="f_txno" value="<?php echo $GLOBALS ['xtxno']; ?>"readonly>
</div>

<div class="col-xs-3">
<label>Invoice No :</label>
<input type="text" class="form-control" name="f_invoiceno" value="<?php echo $GLOBALS ['xInvoiceNo']; ?>">
</div>

<div class="col-xs-3">
<label>Invoice Date:</label>
<input type="date" class="form-control" name="f_invoicedate" value="<?php echo $GLOBALS ['xInvoiceDate']; ?>">
</div>

<div class="col-xs-4">
<label>Item Name:</label>
<select class="form-control"   name="f_itemno" >
<option value="0">Choose Item</option>
<?php
$result = mysql_query("SELECT *  FROM  m_item where stockpointno=31 order by itemname ");
while($row = mysql_fetch_array($result))
{
 ?>
<option value = "<?php echo $row['itemno']; ?>" 
 <?php
  if ($row['itemno']== $GLOBALS ['xItemNo']){echo 'selected="selected"';} 
?> >
 <?php echo $row['itemname']?> 
</option>
<?php } 
?>
</select>

</div>

<div class="col-xs-3">
<label>Batch No:</label>
<input type="text" class="form-control" name="f_batchno" value="<?php echo $GLOBALS ['xBatchNo']; ?>">
</div>
<div class="col-xs-3">
<label>Excess OR Shortage:</label>
<select class="form-control" name="f_excessshortagename" >
		  <option value="Excess" <?php if($GLOBALS ['xExcessShortageName']=="Excess") echo 'selected="selected"'; ?>>Excess</option>
		   <option value="Shortage" <?php if( $GLOBALS ['xExcessShortageName']=="Shortage") echo 'selected="selected"'; ?>>Shortage</option>
		   </select>

</div>

<div class="col-xs-2">
<label>Excess Shortage Qty:</label>
<input type="text" class="form-control" name="f_excessshortageqty" value="<?php echo $GLOBALS ['xExcessShortageQty']; ?>">
</div>

<div class="col-xs-5">
<label>Description:</label>
<input type="text" class="form-control" name="f_description" value="<?php echo $GLOBALS ['xDescription']; ?>">
</div>
</div>

<div class="panel-footer clearfix">
<div class="pull-right">
	  <?php if ($GLOBALS ['xMode'] == "") {  ?> 
		   <input type="submit"  name="save"   class="btn btn-primary" value="SAVE" id="save" onclick="return validateForm()"> 
	   <?php } else{ ?>
		   <input type="submit"  name="update"   class="btn btn-primary" value="UPDATE" onclick="return validateForm()" > 
	   <?php }  ?>
	</div>
</div>

</form>
<!--             ----------------------- REPORT GOES HERE  ------------------------  !-->

<div id="divToPrint" >
<div class="container">
<div class="panel panel-info">
<div class="panel-heading  text-center"><h3 class="panel-title">View Excess/Shortage</h3></div>
<table class="table table-hover" border="1">
  <thead>
	<tr>
	   <th width="5%"> InvNo</th>
	   <th width="30%">Item Name</th>
	   <th width="30%">Type</th>
	   <th width="10%">ShortageQty</th>
	   <th width="10%">BatchNo</th>
	   <th width="10%">Description</th>
	   <th colspan="2" width="5%">ACTIONS</th>
	</tr>
  </thead>
  <tbody>

<?php
$xQry='';
$xQry="SELECT *  from inv_excessshortage"; 
$result2=mysql_query($xQry);
$rowCount = mysql_num_rows($result2);
echo '</br>'; 

while ($row = mysql_fetch_array($result2)) {
?>
<tr>
<?php 
echo '<td>' . $row['invoiceno']  . '</td>';
finditemname($row['itemno']);
echo '<td>' . $GLOBALS ['xItemName']  . '</td>';
echo '<td>' . $row['excessshortagename']  . '</td>';
echo '<td>' . $row['excessshortageqty']  . '</td>';
echo '<td>' . $row['batchno']  . '</td>';
echo '<td>' . $row['description']  . '</td>'; 
?>
<td><a href="inv_ht007_excess_shortage.php<?php echo '?txno='.$row['txno'].'&qty='.$row['excessshortageqty']. '&itemno='.$row['itemno']. '&xmode=delete'. '&excessshortagename='.$row['excessshortagename'];  ?>"  onclick="return confirm_delete()">
<img src="images/delete.png" alt="HTML tutorial" style="width:30px;height:30px;border:0">
</a>
</td>

<?php
echo '</tr>'; 
}

?>	

</tbody>
</table>	
</div><!-- /container -->
</div>
</div>
<!--             ----------------------- REPORT ENDS HERE  ------------------------  !-->
</body>
</html>

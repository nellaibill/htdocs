<?php
include 'globalfile.php';
$GLOBALS ['xDate'] = $GLOBALS ['xCurrentDate'];
$GLOBALS ['xCompletedDate'] = $GLOBALS ['xCurrentDate'];
$xReportDate = $GLOBALS ['xCurrentDate'];
if (isset ( $_POST ['save'] )) {
	
	DataProcess ( "S" );
}
function DataProcess($mode) {
	$xReturnDate = $_POST ['f_date'];
	$xInvoiceNo = $_POST ['f_invoiceno'];
	$xItemNo = $_POST ['f_itemno'];
	$xReturnQuantity = $_POST ['f_returnquantity'];
	$xQry = "";
	$xMsg = "";
	$xRowCount=0;
	$result = mysql_query ( "SELECT *  FROM inv_salesentry
			where salesinvoiceno=$xInvoiceNo and itemno=$xItemNo" ) or die ( mysql_error () );
	$count = mysql_num_rows ( $result );
	
	if ($count > 0) {
		while ( $row = mysql_fetch_array ( $result ) ) {
			if ($row ['qty'] > 0  && $xRowCount==0) {
				if ($xReturnQuantity <= $row ['qty']) {
					$xPurchaseInvoiceNo=$row ['purchaseinvoiceno'];
					$xUpdateQry="update inv_purchaseentry set  currentqty=currentqty+$xReturnQuantity
					where purchaseinvoiceno=$xPurchaseInvoiceNo and itemno=$xItemNo";
					//echo $xUpdateQry;
					$xUpdatePurchaseReturn = mysql_query ($xUpdateQry ) or die ( mysql_error () );
					if (! $xUpdatePurchaseReturn) {
						die ( 'Could not enter data: ' . mysql_error () );
					} else {
						$xQry = "INSERT INTO inv_sales_return(returndate,itemno,inv_no,return_qty)values
 		 ('$xReturnDate',$xItemNo,$xInvoiceNo,$xReturnQuantity)";
						//echo $xQry;
						mysql_query ( $xQry ) or die ( mysql_error () );
					}
				} else {
					$xAlertMsg = "Please Enter Return Qty is Less than Sold Qty (i.e)" . $row ['qty'];
					fn_Alert ( $xAlertMsg );
				}
				$xRowCount+=1;
			}

		}

	} else {
		fn_Alert ( "Item Not Matched" );
	}
}
function fn_Alert($msg) {
	echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}
?>
<title>SALES RETURN</title>
<body onload='document.sales_return_form.f_itemno.focus()'>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>"
		name="sales_return_form" method="post">
		<div class="panel panel-success">
			<div class="panel-heading text-center">SALES RETURN</div>

			<div class="panel-body">
				<div class="form-group">

					<div class="col-xs-2">
						<label>Return Date</label> <input type="date" class="form-control"
							name="f_date" value="<?php echo $GLOBALS ['xDate'];?>"
							readonly="readonly">
					</div>


					<div class="col-xs-4">
						<label>Item Name:</label> <select class="form-control"
							name="f_itemno">
							<option value="0">Choose Item</option>
<?php
$result = mysql_query ( "SELECT *  FROM m_item as i order by i.itemname" );
while ( $row = mysql_fetch_array ( $result ) ) {
	?>
<option value="<?php echo $row['itemno']; ?>"
								<?php
	if ($row ['itemno'] == $GLOBALS ['xItemNo']) {
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
					<div class="col-xs-3">
						<label>Invoice No</label> <input type="number"
							class="form-control" name="f_invoiceno">
					</div>
					<!--  
					<div class="col-xs-3">
						<label>Sold</label> <input type="number"
							class="form-control" name="f_sold">
					</div>
!-->
					<div class="col-xs-3">
						<label>Return Quantity</label> <input type="number"
							class="form-control" name="f_returnquantity"
							onkeydown="javascript:if (event.which || event.keyCode){if ((event.which == 13) || (event.keyCode == 13)) {document.getElementById('save').click();}};">
					</div>
				</div>
			</div>
			<div class="panel-footer clearfix">
				<div class="pull-right">

					<input type="submit" name="save" class="btn btn-primary"
						value="SAVE" id="save" onclick="return validateForm()">
				</div>
			</div>
	</div>
	</form>

<hr>
<!--             ----------------------- REPORT GOES HERE  ------------------------  !-->
<div class="input-group"> <span class="input-group-addon">Filter</span>
  <input id="filter" type="text" class="form-control" placeholder="Search here...">
</div>
<div id="divToPrint" >
<div class="container">
<div class="panel panel-info">
  <!-- Default panel contents -->
  <div class="panel-heading  text-center"><b><?php echo "Sales Return Till ". date("d/M/y h:i:sa"); ?></b></div>
<table class="table">
      <thead>
        <tr>
           <th width="5%">SL.NO</th>

           <th width="30%"> ITEMNAME</th>
           <th width="30%"> INVOICE NO</th>
           <th width="30%"> RETURN QTY</th>
  </tr>
      </thead>
      <tbody class="searchable">

<?php
$xQry='';
$xSlNo=0;
$xQry="SELECT *  from inv_sales_return sr,m_item i where i.itemno=sr.itemno  order by  i.itemname";
$result2=mysql_query($xQry);
$rowCount = mysql_num_rows($result2);
echo '</br>'; 
while ($row = mysql_fetch_array($result2)) {
  echo '<tr>';
    echo '<td>' .  $xSlNo+=1 . '</td>';
    finditemname($row['itemno']);
    echo '<td>' .  $GLOBALS ['xItemName']  . '</td>';
    echo '<td>' . $row['inv_no']  . '</td>';
    echo '<td>' . $row['return_qty']  . '</td>';
?>

<?php

echo '</tr>'; 
}

?>

</tbody>
    </table>	
    </div></div>
  </div><!-- /container -->
	<script type="text/javascript">
$('body').on('keydown', 'input, select, textarea', function(e) {
var self = $(this)
  , form = self.parents('form:eq(0)')
  , focusable
  , next
  ;
if (e.keyCode == 13) {
	focusable = form.find('input,a,select,button,textarea').filter(':visible');
	next = focusable.eq(focusable.index(this)+1);
	if (next.length) {
		next.focus();
	} else {
		form.submit();
	}
	return false;
}
});

function validateForm() 
{
var xItemNo= document.forms["sales_return_form"]["f_itemno"].value;

if (xItemNo== null || xItemNo== "0") 
{
	alert("Item Name to be Filled");
	document.sales_return_form.f_itemno.focus();
	return false;
}

var xInvoiceNo= document.forms["sales_return_form"]["f_invoiceno"].value;

if (xInvoiceNo== null || xInvoiceNo== "" ) 
{
	alert("Missing-Invoice No");
	document.sales_return_form.f_invoiceno.focus();
	return false;
}


var xCurrentQty= document.forms["sales_return_form"]["f_sales"].value;

if (xCurrentQty== null || xCurrentQty== "" ) 
{
	alert("Missing-Sold Qty");
	document.sales_return_form.f_sales.focus();
	return false;
}



var xReturnQty= document.forms["sales_return_form"]["f_returnquantity"].value;

if (xReturnQty== null || xReturnQty== "" ) 
{
	alert("Missing-Return Qty");
	document.sales_return_form.f_returnquantity.focus();
	return false;
}




}

	</script>